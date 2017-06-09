<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends Frontend_Controller
{
    protected $breadcrumbs = array();
    
    public function __construct() {
        
        parent::__construct();     

        /*
         *  Load model
         */
        $this->load->model(array(
            'frontend/hotel_model', 'frontend/province_model', 'frontend/district_model', 'frontend/geonear_model',
            'frontend/sight_model', 'frontend/hotel_image_model', 'frontend/hotel_facilities_model', 'frontend/hotel_comment_model',
            'frontend/room_type_model', 'frontend/promotion_model', 'frontend/room_price_model', 'frontend/hotel_order_model',
            'frontend/hotel_order_room_model',
        ));
        
        $this->breadcrumbs = array(
            'Khách sạn' => base_url(),
        );
    }
    
    public function index()
    {   
        //  Where
        $where = 'hotel.status = 1 AND hotel.deleted = 0';

        //  key type
        $this->data['search']['keyword_search'] = $keyword_search = $this->security->xss_clean($this->input->get('keyword-search'));

        //  key type
        $this->data['search']['key_type'] = $key_type = $this->security->xss_clean($this->input->get('type'));

        //  Key id
        $this->data['search']['key_id'] = $key_id = $this->security->xss_clean($this->input->get('id'));
        
        // Date from
        $this->data['search']['df'] = date('d/m/Y', strtotime('+1 day'));

        if ($this->input->get('df'))
            $this->data['search']['df'] = $this->security->xss_clean($this->input->get('df'));
            
        //  Date to
        $this->data['search']['dt'] = date('d/m/Y', strtotime('+2 day'));

        if ($this->input->get('dt'))
            $this->data['search']['dt'] = $this->security->xss_clean($this->input->get('dt'));

        // day from and day to
        $this->data['search']['day_from'] = show_day_of_week($this->data['search']['df']);

        $this->data['search']['day_to'] = show_day_of_week($this->data['search']['dt']);

        $this->data['search']['date_from_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['df']));

        $this->data['search']['date_to_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['dt']));

        $this->data['search']['night'] = show_day_between_date($this->data['search']['date_from_format'], $this->data['search']['date_to_format']);

        // Range day
        $this->data['search']['range_day'] = get_range_day_now($this->data['search']['df'], $this->data['search']['dt']);

        /*
         *  Search khoa theo Tinh thanh
         */
        if ($key_type == 'p')
        {   
            $where .= ' AND hotel.province_id = ' . $key_id;

            $province = $this->province_model->select('id, name, description')->find($key_id);

            $this->data['location_name'] = 'Khách sạn tại ' . $province->name;

            $this->data['location_description'] = $province->description;
            
            $this->breadcrumbs = array_merge($this->breadcrumbs, array($province->name => show_link($province->id, $province->name, 'province')));
        }
        //  Search theo quan huyen
        else if ($key_type == 'd')
        {
            $where .= ' AND hotel.district_id = ' . $key_id;

            $district = $this->district_model->select('id, name, province_id, description')->find($key_id);

            $province = $this->province_model->select('id, name')->find($district->province_id);

            $this->data['location_name'] = 'Khách sạn tại ' . $district->name . ' - ' . $province->name;
            
            $this->breadcrumbs = array_merge($this->breadcrumbs, array($province->name => show_link($province->id, $province->name, 'province')));
            
            $this->breadcrumbs = array_merge($this->breadcrumbs, array($district->name => show_link($district->id, $district->name, 'district')));

            $this->data['location_description'] = $district->description;
        }
        //  Search theo khu vuc
        else if ($key_type == 'ge')
        {
            $where .= ' AND hotel.geonear_id = ' . $key_id;

            $geonear = $this->geonear_model->select('id, name, description, province_id')->find($key_id);

            $province = $this->province_model->select('id, name')->find($geonear->province_id);
            
            $this->breadcrumbs = array_merge($this->breadcrumbs, array($province->name => show_link($province->id, $province->name, 'province')));
            
            $this->breadcrumbs = array_merge($this->breadcrumbs, array($geonear->name => show_link($geonear->id, $geonear->name, 'geonear')));

            $this->data['location_name'] = 'Khách sạn tại ' . $geonear->name . ' - ' . $province->name;

            $this->data['location_description'] = $geonear->description;
        }
        //  Search theo dia danh
        else if ($key_type == 'si')
        {
            $where .= ' AND hotel.sight_id = ' . $key_id;

            $sight = $this->sight_model->select('id, name, description, province_id')->find($key_id);

            $province = $this->province_model->select('id, name')->find($sight->province_id);
            
            $this->breadcrumbs = array_merge($this->breadcrumbs, array($province->name => show_link($province->id, $province->name, 'province')));
            
            $this->breadcrumbs = array_merge($this->breadcrumbs, array($sight->name => show_link($sight->id, $sight->name, 'sight')));

            $this->data['location_name'] = 'Khách sạn tại ' . $sight->name . ' - ' . $province->name;

            $this->data['location_description'] = $sight->description;
        }
        //Search theo khuyen mai
        else if($key_type == 'prm')
        {
            $this->breadcrumbs = array_merge($this->breadcrumbs, array('Khách sạn khuyến mãi' => show_link('', 'khách sạn khuyến mãi', 'prm')));

            //  Ngay ap dung
            $where .= ' AND (promotion.date_apply_from <= "' . date('Y-m-d') . '"  AND promotion.date_apply_to >= "' . date('Y-m-d') . '")';

            //  Ngay o
            $where .= ' AND (promotion.stay_day_from <= "' . $this->data['search']['date_from_format'] . '"  AND promotion.stay_day_to >= "' . $this->data['search']['date_to_format'] . '")';

            //  Dem o toi thieu
            $where .= ' AND (promotion.night <= ' . $this->data['search']['night'] . ')';
            
            $where .= ' AND (promotion.deleted = 0)';

            $this->data['location_name'] = 'Khách sạn khuyến mãi tốt nhất';

            $this->data['location_description'] = '';
        }
        
        /*
         * Title trang
         */
        if($key_type == 'prm')
            $this->data['title'] = $this->data['location_name'];
        else    
            $this->data['title'] = 'Khách sạn tại ' . $this->data['location_name'];

        if ($this->data['search']['keyword_search'] == '')
            $this->data['search']['keyword_search'] = $this->data['title'];

        /*
         *  Search theo gia
         */
        if ($this->input->get('price_range'))
        {
            $where .= ' AND (room_type.price_type = "vnd" AND room_price.day IN (' . implode(',', $this->data['search']['range_day']) . ') AND room_price.status = 1 AND room_price.price <> 0 AND room_price.deleted = 0 AND room_price.hide_price = 0)';
            
            $this->data['search']['price_range'] = $price_range_search = $this->input->get('price_range');

            $where .= ' AND (';

            foreach ($price_range_search as $v)
            {
                switch ($v) {

                    //Duoi 500.000
                    case '1':
                        $where .= ' (room_price.price > 0 AND room_price.price < 500000) OR';
                        break;

                    //500.000 - 1.000.000
                    case '2':
                        $where .= ' (room_price.price >= 500000 AND room_price.price <= 1000000) OR';
                        break;   

                    //1.000.000 - 1.500.000
                    case '3':
                        $where .= ' (room_price.price >= 1000000 AND room_price.price <= 1500000) OR';
                        break;     

                    //1.500.000 - 2.000.000
                    case '4':
                        $where .= ' (room_price.price >= 1500000 AND room_price.price <= 2000000) OR';
                        break; 

                    //2.000.000 - 2.500.000
                    case '5':
                        $where .= ' (room_price.price >= 2000000 AND room_price.price <= 2500000) OR';
                        break;  

                    //2.500.000 - 3.000.000
                    case '6':
                        $where .= ' (room_price.price >= 2500000 AND room_price.price <= 3000000) OR';
                        break;  

                    //Trên 3.000.000
                    case '7':
                        $where .= ' (room_price.price > 3000000) OR';
                        break;                
                    
                    default:
                        break;
                }
            }

            $where = trim($where, 'OR');

            $where .= ')';
        }

        /*
         *  Search theo so sao
         */
        if ($this->input->get('star'))
        {
            $this->data['search']['star'] = $star_search = $this->input->get('star');

            $where .= ' AND (';

            foreach($star_search as $v)
            {
                $where .= ' (hotel.star = ' . $v . ') OR';
            }

            $where = trim($where, 'OR');

            $where .= ')';
        }   

        /*
         *  Search theo tien ich
         */
        if ($this->input->get('hotel_facilities'))
        {
            $this->data['search']['hotel_facilities'] = $hotel_facilities = $this->input->get('hotel_facilities');

            $where .= ' AND (';

            foreach($hotel_facilities as $v)
            {
                $where .= ' (hotel.facilities_id LIKE "%,' . $v . ',%") AND';
            }

            $where = trim($where, 'AND');

            $where .= ')';
        } 

        /*
         *  Search theo khu vuc
         */
        if ($this->input->get('geonear'))
        {
            $this->data['search']['geonear'] = $geonear = $this->input->get('geonear');

            $where .= ' AND (hotel.geonear_id = ' . $geonear . ')';
        }

        /*
         *  Sort
         */
        //  Moi nhat
        $sort = array('hotel.id' => 'desc');

        if ($this->input->get('sort-name'))
        {
            $sort = array($this->input->get('sort-name') => $this->input->get('sort-value'));

            $this->data['search']['sort'] = $sort;

            //  Khuyen mai
            if ($this->input->get('sort-name') == 'promotion')
            {
                $sort = array('hotel.id' => 'desc');

                $this->data['search']['sort'] = array('promotion' => 'desc');

                //  Ngay ap dung
                $where .= ' AND (promotion.date_apply_from <= "' . date('Y-m-d') . '"  AND promotion.date_apply_to >= "' . date('Y-m-d') . '")';

                //  Ngay o
                $where .= ' AND (promotion.stay_day_from <= "' . $this->data['search']['date_from_format'] . '"  AND promotion.stay_day_to >= "' . $this->data['search']['date_to_format'] . '")';

                //  Ngay dat
                $where .= ' AND (promotion.book_day_from <= "' . date('Y-m-d') . '"  AND promotion.book_day_to >= "' . date('Y-m-d') . '")';
                
                //  Dem o toi thieu
                $where .= ' AND (promotion.night <= ' . $this->data['search']['night'] . ')';
                
                $where .= ' AND (promotion.deleted = 0) AND promotion.status = 1';
            }

            //  Danh gia
            if ($this->input->get('sort-name') == 'evaluation')
            {
                $sort = array('AVG(hotel_comment.evaluation)' => $this->input->get('sort-value'));
                
                $where .= ' AND (hotel_comment.deleted = 0)';

                $this->data['search']['sort'] = array('evaluation' => $this->input->get('sort-value'));
            }

            //  Gia
            if ($this->input->get('sort-name') == 'room_price.price')
            {
                $where .= ' AND (room_type.price_type = "vnd" AND room_price.day IN (' . implode(',', $this->data['search']['range_day']) . ') AND room_price.status = 1 AND room_price.price <> 0 AND room_price.deleted = 0 AND room_price.hide_price = 0)';

                $sort = array('MIN(room_price.price)' => $this->input->get('sort-value'));
            }
        }    

        /*
         * Pagination
         */
        $this->hotel_model->select('hotel.id');
        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');
        $this->hotel_model->join('province', 'hotel.province_id = province.id', 'left');
        $this->hotel_model->join('room_price', 'hotel.id = room_price.hotel_id', 'left');
        $this->hotel_model->join('room_type', 'hotel.id = room_type.hotel_id', 'left');
        $this->hotel_model->join('promotion', 'hotel.id = promotion.hotel_id', 'left');
        $this->hotel_model->group_by('hotel.id');
        $records = $this->hotel_model->find_all_by(array($where => null));
        $total_rows = count($records);
        
        $limit = 20;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination_fr');

        $config['base_url'] = base_url() . '/' . uri_string() . $str_param;

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        
        /*
         *  Query
         */
        $select = 'hotel.id as id, hotel.name as name, hotel.picture as picture, hotel.address as address, hotel.star as star,
                    AVG(hotel_comment.evaluation) as point, province.name as province_name, MIN(room_price.price) as price,
                    promotion.name as promotion_name';
        $this->hotel_model->select($select);
        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');
        $this->hotel_model->join('province', 'hotel.province_id = province.id', 'left');
        $this->hotel_model->join('room_price', 'hotel.id = room_price.hotel_id', 'left');
        $this->hotel_model->join('room_type', 'hotel.id = room_type.hotel_id', 'left');
        $this->hotel_model->join('promotion', 'hotel.id = promotion.hotel_id', 'left');
        $this->hotel_model->order_by($sort);
        $this->hotel_model->group_by('hotel.id');
        $this->hotel_model->limit($limit, $offset);
        $records = $this->hotel_model->find_all_by(array($where => null));  

        $data = array();

        if ($records)
        {
            foreach($records as $k => $v)
            {
                $data[$k] = $v;

                $data[$k] = $v;

                $data[$k]->url = show_link($v->id, html_escape($v->name));

                $data[$k]->picture = show_picture(html_escape($v->picture), 214, 148);

                $data[$k]->name = html_escape($v->name);

                $data[$k]->address = html_escape($v->address);

                $data[$k]->price = show_price_low($v->id, $this->data['search']['range_day']);

                $data[$k]->point = show_point($v->point);

                $data[$k]->bookmark = show_bookmark($data[$k]->point);
            }
        }

        /*
         * Khach san duoc dat phong cung thanh pho
         */
        if (isset($province)) {
            $this->load->database();
            $select = 'hotel.star as star, hotel.name as name, hotel.picture as picture, hotel.id as id,
                        hotel.address as address, hotel_order_room.room_id as room_id, h_o.create_time as create_time';
            $query = $this->db->query("SELECT " . $select . "
                                FROM (SELECT * FROM hotel_order ORDER BY create_time DESC) h_o
                                INNER JOIN hotel ON h_o.hotel_id = hotel.id
                                INNER JOIN hotel_order_room ON h_o.hotel_id = hotel_order_room.hotel_id
                                WHERE hotel.province_id = '" . $province->id . "'
                                GROUP BY h_o.hotel_id
                                LIMIT 5
                                ");
            $hotel_near_city = $query->result();

            $data_hotel_order_near_city = array();

            if ($hotel_near_city) {
                foreach ($hotel_near_city as $k => $v) {
                    $data_hotel_order_near_city[$k] = $v;

                    $data_hotel_order_near_city[$k] = $v;

                    $data_hotel_order_near_city[$k]->url = show_link($v->id, html_escape($v->name));

                    $data_hotel_order_near_city[$k]->picture = show_picture(html_escape($v->picture), 90, 71);

                    $data_hotel_order_near_city[$k]->name = html_escape($v->name);

                    $data_hotel_order_near_city[$k]->address = html_escape($v->address);

                    $data_hotel_order_near_city[$k]->create_time = $v->create_time;

                    $data_hotel_order_near_city[$k]->room = $this->room_type_model->find($v->room_id);
                }
            }

            // hotel near city
            $this->data['hotel_order_near_city'] = $data_hotel_order_near_city;

            //Province name
            $this->data['province_name'] = $province->name;
        }

        //  Records
        $this->data['records'] = $data; 

        //  Total
        $this->data['search']['total'] = $total_rows; 

        //  Price range
        $this->data['price_range'] = $this->get_price_range();

        //  Star
        $this->data['star'] = $this->get_star();

        //  Facilities
        $this->data['hotel_facilities'] = $this->get_hotel_facilities();

        // Geonear
        $this->data['geonear'] = $this->get_geonear();
        
        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->breadcrumbs;

        /*
         *  Luu session
         */
        $this->session->set_userdata('search', array(
            'df' => $this->data['search']['df'],
            'dt' => $this->data['search']['dt'],
            'night' => $this->data['search']['night'],
        ));
    
        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function search()
    {
        $this->data['search']['keyword_search'] = $keyword_search = $this->input->get('keyword-search');

        $this->breadcrumbs = array_merge($this->breadcrumbs, array('Tìm kiếm' => '#'));

        $this->data['location_name'] = 'Tìm kiếm với "' . html_escape($keyword_search) . '""';

        $this->data['location_description'] = 'Tìm kiếm từ khóa theo tên khách sạn và địa điểm';

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->breadcrumbs;

        // Date from
        $this->data['search']['df'] = date('d/m/Y', strtotime('+1 day'));

        //  Date to
        $this->data['search']['dt'] = date('d/m/Y', strtotime('+2 day'));

        if ($this->input->get('df'))
            $this->data['search']['df'] = $this->security->xss_clean($this->input->get('df'));

        if ($this->input->get('dt'))
            $this->data['search']['dt'] = $this->security->xss_clean($this->input->get('dt'));

        // day from and day to
        $this->data['search']['day_from'] = show_day_of_week($this->data['search']['df']);

        $this->data['search']['day_to'] = show_day_of_week($this->data['search']['dt']);

        $this->data['search']['date_from_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['df']));

        $this->data['search']['date_to_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['dt']));

        $this->data['search']['night'] = show_day_between_date($this->data['search']['date_from_format'], $this->data['search']['date_to_format']);

        // Range day
        $this->data['search']['range_day'] = get_range_day_now($this->data['search']['df'], $this->data['search']['dt']);

        //  Where
        $where = 'hotel.status = 1 AND hotel.deleted = 0';

        $where .= ' AND (
                        (hotel.name like "%' . $keyword_search . '%")
                        OR (province.name like "%' . $keyword_search . '%")
                        OR (district.name like "%' . $keyword_search . '%")
                        OR (ward.name like "%' . $keyword_search . '%")
                        OR (geonear.name like "%' . $keyword_search . '%")
                        OR (sight.name like "%' . $keyword_search . '%")
                    )
                   ';


        /*
         * Pagination
         */
        $this->hotel_model->select('hotel.id');
        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');
        $this->hotel_model->join('province', 'hotel.province_id = province.id', 'left');
        $this->hotel_model->join('district', 'hotel.district_id = district.id', 'left');
        $this->hotel_model->join('ward', 'hotel.ward_id = ward.id', 'left');
        $this->hotel_model->join('geonear', 'hotel.geonear_id = geonear.id', 'left');
        $this->hotel_model->join('sight', 'hotel.sight_id = sight.id', 'left');
        $this->hotel_model->join('room_price', 'hotel.id = room_price.hotel_id', 'left');
        $this->hotel_model->join('promotion', 'hotel.id = promotion.hotel_id', 'left');
        $this->hotel_model->group_by('hotel.id');
        $records = $this->hotel_model->find_all_by(array($where => null));
        $total_rows = count($records);

        $limit = 20;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination_fr');

        $config['base_url'] = base_url() . '/' . uri_string() . $str_param;

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         *  Query
         */
        $select = 'hotel.id as id, hotel.name as name, hotel.picture as picture, hotel.address as address, hotel.star as star,
                    AVG(hotel_comment.evaluation) as point, province.name as province_name, MIN(room_price.price) as price,
                    promotion.name as promotion_name';
        $this->hotel_model->select($select);
        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');
        $this->hotel_model->join('province', 'hotel.province_id = province.id', 'left');
        $this->hotel_model->join('district', 'hotel.district_id = district.id', 'left');
        $this->hotel_model->join('ward', 'hotel.ward_id = ward.id', 'left');
        $this->hotel_model->join('geonear', 'hotel.geonear_id = geonear.id', 'left');
        $this->hotel_model->join('sight', 'hotel.sight_id = sight.id', 'left');
        $this->hotel_model->join('room_price', 'hotel.id = room_price.hotel_id', 'left');
        $this->hotel_model->join('promotion', 'hotel.id = promotion.hotel_id', 'left');
        $this->hotel_model->group_by('hotel.id');
        $this->hotel_model->limit($limit, $offset);
        $records = $this->hotel_model->find_all_by(array($where => null));

        $data = array();

        if ($records)
        {
            foreach($records as $k => $v)
            {
                $data[$k] = $v;

                $data[$k] = $v;

                $data[$k]->url = show_link($v->id, html_escape($v->name));

                $data[$k]->picture = show_picture(html_escape($v->picture), 214, 148);

                $data[$k]->name = html_escape($v->name);

                $data[$k]->address = html_escape($v->address);

                $data[$k]->price = show_price_low($v->id, $this->data['search']['range_day']);

                $data[$k]->point = show_point($v->point);

                $data[$k]->bookmark = show_bookmark($data[$k]->point);
            }
        }

        $this->data['records'] = $data;

        /*
         *  Luu session
         */
        $this->session->set_userdata('search', array(
            'df' => $this->data['search']['df'],
            'dt' => $this->data['search']['dt'],
            'night' => $this->data['search']['night'],
        ));

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function get_price_range()
    {
        $price_range = array(
            '1' => 'Dưới 500.000',
            '2' => '500.000 - 1.000.000',
            '3' => '1.000.000 - 1.500.000',
            '4' => '1.500.000 - 2.000.000',
            '5' => '2.000.000 - 2.500.000',
            '6' => '2.500.000 - 3.000.000',
            '7' => 'Trên 3.000.000',
        );

        return $price_range;
    }

    public function get_star()
    {
        $price_range = array(5, 4, 3, 2, 1);

        return $price_range;
    }

    public function get_hotel_facilities()
    {
        $this->load->model('frontend/hotel_facilities_model');

        return $this->hotel_facilities_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
    }

    public function get_geonear()
    {
        $this->load->model('frontend/geonear_model');

        $where = array();

        $where['status'] = 1;
        
        $where['deleted'] = 0;

        if ($this->data['search']['key_type'] == 'p')
            $where['province_id'] = $this->data['search']['key_id'];

        return $this->geonear_model->select('id, name')->find_all_by($where);
    }

    public function get_params_url()
    {
        $param = $this->input->get();

        $str_param = '?';

        if (isset($param['per_page']))
        {
            unset($param['per_page']);
        }
        if (is_array($param) && count($param) > 0)
        {
            foreach ($param as $p_val => $p_key)
            {
                if (!is_array($p_key))
                {
                    $str_param .= $p_val . '=' . $p_key . '&';
                }
                else
                {
                    foreach($p_key as $k => $v)
                    {
                        $str_param .= $p_val . '[' . $k . ']=' . $v . '&';
                    }
                }

            }
            $str_param = rtrim($str_param, '&');
        }
        
        return $str_param;
    }

    public function detail($hotel_name, $hotel_id = 0)
    {
        /*
         *  Get session search
         */
        $this->data['search'] = $search = $this->session->userdata('search');

        // Date from
        if ($this->input->get('df'))
            $this->data['search']['df'] = $this->security->xss_clean($this->input->get('df'));
        else if (!isset($this->data['search']['df']))
            $this->data['search']['df'] = date('d/m/Y', strtotime('+1 day'));

        //  Date to
        if ($this->input->get('dt'))
            $this->data['search']['dt'] = $this->security->xss_clean($this->input->get('dt'));
        else if (!isset($this->data['search']['dt']))
            $this->data['search']['dt'] = $date_to = date('d/m/Y', strtotime('+2 day'));
            
        //  Room count
        if ($this->input->get('room_num'))
            $this->data['search']['room_num'] = $this->security->xss_clean($this->input->get('room_num'));
        else
            $this->data['search']['room_num'] = 1;
            
        //  Room persion
        if ($this->input->get('room_person'))
            $this->data['search']['room_person'] = $this->security->xss_clean($this->input->get('room_person'));
        else
            $this->data['search']['room_person'] = 2;     
                

        //  Hotel id
        $id = $this->security->xss_clean($hotel_id);

        /*
         *  Hotel info
         */
        $record = $this->hotel_model->find_by(array('hotel.status = 1 AND hotel.id = ' . $id => NULL));
        
        /*
         * Province
         */
        $province = $this->province_model->select('id, name')->find($record->province_id);
        
        /*
         * Breadcrumbs
         */
        $this->breadcrumbs = array_merge($this->breadcrumbs, array($province->name => show_link($province->id, $province->name, 'province')));
        
        $this->breadcrumbs = array_merge($this->breadcrumbs, array($record->name => show_link($record->id, $record->name, 'hotel')));
        
        /*
         * Tien nghi khach san
         */
        $facilities = $this->hotel_facilities_model->select('id, name')->find_all_by(array('status' => 1, 'id IN (' . trim($record->facilities_id, ',') . ')' => NULL));

        /*
         * Dia danh
         */
        $sight = $this->sight_model->select('id, name, picture')->find_all_by(array('status' => 1, 'district_id' => $record->district_id, 'deleted' => 0));

        /*
         *  Picture
         */
        $picture = $this->hotel_image_model->find_all_by(array('hotel_id' => $id));
        
        /*
         * Comment
         */
        $this->hotel_comment_model->select('COUNT(id) as total');
        $comment_total = $this->hotel_comment_model->find_by(array('status' => 1, 'hotel_id' => $id, 'deleted' => 0));
        
        $this->hotel_comment_model->select('hotel_comment.*, user.name as user_fullname');
        $this->hotel_comment_model->join('user', 'hotel_comment.user_id = user.id', 'left');
        $this->hotel_comment_model->limit(10);
        $comment = $this->hotel_comment_model->find_all_by(array('hotel_comment.status' => 1, 'hotel_comment.hotel_id' => $id, 'hotel_comment.deleted' => 0));

        /*
         *  Khach san o gan cung sao
         */
        $range_day = get_range_day_now($this->data['search']['df'], $this->data['search']['dt']);

        $where_hotel_other  = 'hotel.status = 1 AND hotel.deleted = 0';
        $where_hotel_other .= ' AND hotel.id <> ' . $id;
        $where_hotel_other .= ' AND hotel.star = ' . $record->star;
        
        $this->hotel_model->select('hotel.*, AVG(hotel_comment.evaluation) as point, province.name as province_name, room_price.price as price, promotion.name as promotion_name');
        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');
        $this->hotel_model->join('province', 'hotel.province_id = province.id', 'left');
        $this->hotel_model->join('room_price', 'hotel.id = room_price.hotel_id', 'left');
        $this->hotel_model->join('promotion', 'hotel.id = promotion.hotel_id', 'left');
        $this->hotel_model->order_by(array('room_price.price' => 'asc'));
        $this->hotel_model->group_by('hotel.id');
        $this->hotel_model->limit(5);
        $hotel_other = $this->hotel_model->find_all_by(array($where_hotel_other => NULL));  

        $data_hotel_other = array();

        if ($hotel_other)
        {
            foreach($hotel_other as $k => $v)
            {
                $data_hotel_other[$k] = $v;

                $data_hotel_other[$k] = $v;

                $data_hotel_other[$k]->url = show_link($v->id, html_escape($v->name));

                $data_hotel_other[$k]->picture = show_picture(html_escape($v->picture), 90, 71);

                $data_hotel_other[$k]->name = html_escape($v->name);

                $data_hotel_other[$k]->address = html_escape($v->address);

                $data_hotel_other[$k]->price = show_price_low($v->id, $range_day);

                $data_hotel_other[$k]->point = show_point($v->point);

                $data_hotel_other[$k]->bookmark = show_bookmark($data_hotel_other[$k]->point);
            }
        }

        /*
         * Khach san duoc dat phong cung thanh pho
         */
        $this->load->database();
        $select = 'hotel.star as star, hotel.name as name, hotel.picture as picture, hotel.id as id,
                        hotel.address as address, hotel_order_room.room_id as room_id, h_o.create_time as create_time';
        $query = $this->db->query("SELECT " . $select . "
                                FROM (SELECT * FROM hotel_order ORDER BY create_time DESC) h_o
                                INNER JOIN hotel ON h_o.hotel_id = hotel.id
                                INNER JOIN hotel_order_room ON h_o.hotel_id = hotel_order_room.hotel_id
                                WHERE hotel.province_id = '" . $record->province_id . "'
                                GROUP BY h_o.hotel_id
                                LIMIT 5
                                ");
        $hotel_near_city = $query->result();

        $data_hotel_order_near_city = array();

        if ($hotel_near_city)
        {
            foreach($hotel_near_city as $k => $v)
            {
                $data_hotel_order_near_city[$k] = $v;

                $data_hotel_order_near_city[$k] = $v;

                $data_hotel_order_near_city[$k]->url = show_link($v->id, html_escape($v->name));

                $data_hotel_order_near_city[$k]->picture = show_picture(html_escape($v->picture), 90, 71);

                $data_hotel_order_near_city[$k]->name = html_escape($v->name);

                $data_hotel_order_near_city[$k]->address = html_escape($v->address);

                $data_hotel_order_near_city[$k]->create_time = $v->create_time;

                $data_hotel_order_near_city[$k]->room = $this->room_type_model->find($v->room_id);
            }
        }

        /*
         * Kiem tra user neu co login xem da tung dat phong chua moi cho comment
         */
        if (isset($this->data['user']))
        {
            $check_order = $this->hotel_order_model->where(array('user_id' => $this->data['user']->id, 'status' => 6))->count_all();
            if ($check_order > 0)
                $this->data['comment_allow'] = true;
            else
                $this->data['comment_allow'] = false;
        }

            //  Night
        $this->data['search']['day_from'] = show_day_of_week($this->data['search']['df']);

        $this->data['search']['day_to'] = show_day_of_week($this->data['search']['dt']);

        $this->data['search']['date_from_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['df']));

        $this->data['search']['date_to_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['dt']));

        $this->data['search']['night'] = show_day_between_date($this->data['search']['date_from_format'], $this->data['search']['date_to_format']);
        
        //  Data
        $this->data['record'] = $record;

        $this->data['picture'] = $picture;
        
        $this->data['facilities'] = $facilities;
        
        $this->data['comment'] = $comment;
        
        $this->data['comment_total'] = $comment_total->total;
        
        $this->data['hotel_other'] = $data_hotel_other;

        $this->data['hotel_order_near_city'] = $data_hotel_order_near_city;
        
        $this->data['sight'] = $sight;
        
        $this->data['breadcrumbs'] = $this->breadcrumbs;

        $this->data['province_name'] = $province->name;

        $this->data['back_url'] = urlencode(current_url());

        $this->data['main_title'] = strip_tags($record->name);
        $this->data['main_keyword'] = strip_tags($record->keyword);
        $this->data['main_description'] = strip_tags($record->description);

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
}

