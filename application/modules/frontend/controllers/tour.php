<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tour extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs = array(
            'Tour' => base_url(),
        );

        /*
         *  Load model
         */
        $this->load->model(array(
            'frontend/tour_model', 'frontend/province_model',
            'frontend/tour_image_model', 'frontend/tour_comment_model',
            'frontend/tour_topic_model', 'frontend/tour_service_model',
            'frontend/national_model', 'frontend/partner_tour_model',
            'frontend/display_model', 'frontend/tour_order_model',
        ));
    }

    public function index()
    {
        /*
         * Banner
         */
        $banner_home = $this->display_model->select('id, picture')
            ->find_all_by(array('type_id' => 4, 'deleted' => 0)); // Banner trang chu. id = 4

        /*
         *  Dia diem pho bien trong nuoc
         */
        $province_vn_common = $this->province_model->select('id, name, picture')
            ->limit(8)->order_by('id', 'asc')
            ->find_all_by(array('status' => 1, 'national_id' => 2, 'deleted' => 0,));

        /*
         *  Dia diem pho bien ngoai nuoc
         */
//        $province_nn_common = $this->province_model->select('id, name, picture')
//            ->limit(8)->order_by('id', 'asc')
//            ->find_all_by(array('status' => 1, 'national_id != 2' => null, 'deleted' => 0));

        $national_nn_common = $this->national_model->select('id, name, picture')
            ->limit(8)->order_by('id', 'asc')
            ->find_all_by(array('status' => 1, 'id != 2' => null, 'deleted' => 0));


        $this->data['banner_home'] = $banner_home;

        $this->data['province_vn_common'] = $province_vn_common;

        $this->data['national_nn_common'] = $national_nn_common;


        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function search()
    {
        $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $province_data = array();
        foreach($province as $k => $v)
            $province_data[$v->id] = $v;

        $national = $this->national_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $national_data = array();
        foreach($national as $k => $v)
            $national_data[$v->id] = $v;

        //  Where
        $where = 'tour.status = 1 AND tour.deleted = 0';

        //  key type
        $this->data['search']['keyword_search'] = $keyword_search = $this->security->xss_clean($this->input->get('keyword-search'));

        // start from
        $this->data['search']['start_from_search'] = $start_from_search = $this->security->xss_clean($this->input->get('start-from-search'));

        //  key type
        $this->data['search']['key_type'] = $key_type = $this->security->xss_clean($this->input->get('type'));

        //  Key id
        $this->data['search']['key_id'] = $key_id = $this->security->xss_clean($this->input->get('id'));

        //  Service
        $this->data['search']['tour_service'] = $tour_service = $this->security->xss_clean($this->input->get('tour_service', null));

        //  Topic
        $this->data['search']['tour_topic'] = $tour_topic = $this->security->xss_clean($this->input->get('tour_topic', null));

        // Date from
        $this->data['search']['df'] = date('d/m/Y', strtotime('+1 day'));

        if ($this->input->get('df'))
            $this->data['search']['df'] = $this->security->xss_clean($this->input->get('df'));

        //  Date to
        $this->data['search']['dt'] = date('d/m/Y', strtotime('+10 day'));

        if ($this->input->get('dt'))
            $this->data['search']['dt'] = $this->security->xss_clean($this->input->get('dt'));

        // day from and day to
        $this->data['search']['day_from'] = show_day_of_week($this->data['search']['df']);

        $this->data['search']['day_to'] = show_day_of_week($this->data['search']['dt']);

        $this->data['search']['date_from_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['df']));

        $this->data['search']['date_to_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['dt']));

        /*
         * Search khoa theo Quoc Gia
         */
        if ($key_type == 'na') {
            $where .= ' AND tour.to_national_id = ' . $key_id;

            $national = $this->national_model->select('id, name, description')->find($key_id);

            $this->data['location_name'] = 'Tour đi ' . $national->name;

            $this->data['location_description'] = $national->description;

            $this->breadcrumbs = array_merge($this->breadcrumbs, array($national->name => show_link($national->id, $national->name, 'tour_national')));
        }

        /*
         *  Search khoa theo Tinh thanh
         */
        if ($key_type == 'p')
        {
            $where .= ' AND tour.to_province_id = ' . $key_id;

            $province = $this->province_model->select('id, name, description')->find($key_id);

            $this->data['location_name'] = 'Tour đi ' . $province->name;

            $this->data['location_description'] = $province->description;

            $this->breadcrumbs = array_merge($this->breadcrumbs, array($province->name => show_link($province->id, $province->name, 'province')));
        }

        /*
         * Search theo ngay
         */
        //$where .= ' AND (start_date = 1 OR (start_date >= "' . $this->data['search']['date_from_format'] . '" AND start_date <= "' . $this->data['search']['date_to_format'] . '"))';


        /*
         * Title trang
         */
        if($key_type == 'prm')
            $this->data['title'] = $this->data['location_name'];
        else
            $this->data['title'] = 'Tour tại ' . $this->data['location_name'];

        if ($this->data['search']['keyword_search'] == '')
            $this->data['search']['keyword_search'] = $this->data['title'];

        /*
         * Search theo dia diem khoi hanh
         */
        if ($this->input->get('start-from-search'))
        {
            $where .= ' AND (tour.from_province_id = ' . $this->input->get('start-from-search') . ') ';
        }

        /*
         *  Search theo gia
         */
        if ($this->input->get('price_range'))
        {
            $this->data['search']['price_range'] = $price_range_search = $this->input->get('price_range');

            $where .= ' AND (';

            foreach ($price_range_search as $v)
            {
                switch ($v) {

                    //Duoi 500.000
                    case '1':
                        $where .= ' (tour.price > 0 AND tour.price < 500000) OR';
                        break;

                    //500.000 - 1.000.000
                    case '2':
                        $where .= ' (tour.price >= 500000 AND tour.price <= 1000000) OR';
                        break;

                    //1.000.000 - 1.500.000
                    case '3':
                        $where .= ' (tour.price >= 1000000 AND tour.price <= 1500000) OR';
                        break;

                    //1.500.000 - 2.000.000
                    case '4':
                        $where .= ' (tour.price >= 1500000 AND tour.price <= 2000000) OR';
                        break;

                    //2.000.000 - 2.500.000
                    case '5':
                        $where .= ' (tour.price >= 2000000 AND tour.price <= 2500000) OR';
                        break;

                    //2.500.000 - 3.000.000
                    case '6':
                        $where .= ' (tour.price >= 2500000 AND tour.price <= 3000000) OR';
                        break;

                    //Trên 3.000.000
                    case '7':
                        $where .= ' (tour.price > 3000000) OR';
                        break;

                    default:
                        break;
                }
            }

            $where = trim($where, 'OR');

            $where .= ')';
        }

        /*
         *  Search theo chu de
         */
        if ($this->input->get('tour_topic'))
        {
            $this->data['search']['tour_topic'] = $tour_topic = $this->input->get('tour_topic');

            $where .= ' AND (';

            foreach($tour_topic as $v)
            {
                $where .= ' (tour.topic_id LIKE "%,' . $v . ',%") OR';
            }

            $where = trim($where, 'OR');

            $where .= ')';
        }

        /*
         *  Search theo dich vu
         */
        if ($this->input->get('tour_service'))
        {
            $this->data['search']['tour_service'] = $tour_service = $this->input->get('tour_service');

            $where .= ' AND (';

            foreach($tour_service as $v)
            {
                $where .= ' (tour.service_id LIKE "%,' . $v . ',%") AND';
            }

            $where = trim($where, 'AND');

            $where .= ')';
        }


        /*
         *  Sort
         */
        //  Moi nhat
        $sort = array('tour.id' => 'desc');

        if ($this->input->get('sort-name'))
        {
            $sort = array($this->input->get('sort-name') => $this->input->get('sort-value'));

            $this->data['search']['sort'] = $sort;

            //  Danh gia
            if ($this->input->get('sort-name') == 'evaluation')
            {
                $sort = array('AVG(tour_comment.evaluation)' => $this->input->get('sort-value'));

                $where .= ' AND (tour_comment.deleted = 0)';

                $this->data['search']['sort'] = array('evaluation' => $this->input->get('sort-value'));
            }

            //  Gia
            if ($this->input->get('sort-name') == 'room_price.price')
            {
                $sort = array('MIN(room_price.price)' => $this->input->get('sort-value'));
            }
        }

        /*
         * Pagination
         */
        $this->tour_model->select('tour.id');
        $this->tour_model->join('tour_comment', 'tour.id = tour_comment.tour_id', 'left');
        $this->tour_model->join('province', 'tour.to_province_id = province.id', 'left');
        $this->tour_model->group_by('tour.id');
        $records = $this->tour_model->find_all_by(array($where => null));
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
        $select = 'tour.id as id,
                    tour.name as name,
                    tour.picture as picture,
                    tour.price,
                    AVG(tour_comment.evaluation) as point,
                    tour.start_date,
                    tour.time,
                    tour.to_province_id,
                    tour.from_province_id,
                    tour.to_national_id,
                    tour.from_national_id,
                    tour.transportation,
                    ';
        $this->tour_model->select($select);
        $this->tour_model->join('tour_comment', 'tour.id = tour_comment.tour_id', 'left');
        $this->tour_model->join('province', 'tour.to_province_id = province.id', 'left');
        $this->tour_model->order_by($sort);
        $this->tour_model->group_by('tour.id');
        $this->tour_model->limit($limit, $offset);
        $records = $this->tour_model->find_all_by(array($where => null));

        $data = array();

        if ($records)
        {
            foreach($records as $k => $v)
            {
                $data[$k] = $v;

                $data[$k] = $v;

                $data[$k]->url = show_link($v->id, html_escape($v->name), 'tour_detail');

                $data[$k]->picture = show_picture(html_escape($v->picture), 214, 148, 'tour');

                $data[$k]->name = html_escape($v->name);

                $data[$k]->point = show_point($v->point);

                $data[$k]->bookmark = show_bookmark($data[$k]->point);

                $data[$k]->price = show_price($v->price);

                $data[$k]->start_date = $v->start_date;

                $data[$k]->time = html_escape($v->time);

                $data[$k]->to_province = (isset($province_data[$v->to_province_id])) ? $province_data[$v->to_province_id]->name : '';

                $data[$k]->from_province = (isset($province_data[$v->from_province_id])) ? $province_data[$v->from_province_id]->name : '';

                $data[$k]->to_national = (isset($national_data[$v->to_national_id])) ? $national_data[$v->to_national_id]->name : '';

                $data[$k]->from_national = (isset($national_data[$v->from_national_id])) ? $national_data[$v->from_national_id]->name : '';

                $data[$k]->transportation = html_escape($v->transportation);
            }
        }

        //  Records
        $this->data['records'] = $data;

        //  Total
        $this->data['search']['total'] = $total_rows;

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->breadcrumbs;

        //  Price range
        $this->data['price_range'] = $this->get_price_range();

        // Topic
        $this->data['topic'] = $this->tour_topic_model->where(array('deleted' => 0))->find_all();

        // Service
        $this->data['service'] = $this->tour_service_model->where(array('deleted' => 0))->find_all();

        /*
         *  Luu session
         */
        $this->session->set_userdata('search-tour', array(
            'df' => $this->data['search']['df'],
            'dt' => $this->data['search']['dt'],
            'start_from_search' => $this->data['search']['start_from_search'],
        ));

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function search_default()
    {
        $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $province_data = array();
        foreach($province as $k => $v)
            $province_data[$v->id] = $v;

        $national = $this->national_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $national_data = array();
        foreach($national as $k => $v)
            $national_data[$v->id] = $v;

        //  Where
        $where = 'tour.status = 1 AND tour.deleted = 0';

        $this->data['search']['keyword_search'] = $keyword_search = $this->input->get('keyword-search');

        $this->breadcrumbs = array_merge($this->breadcrumbs, array('Tìm kiếm' => '#'));

        $this->data['location_name'] = 'Tìm kiếm với "' . html_escape($keyword_search) . '""';

        $this->data['location_description'] = 'Tìm kiếm từ khóa theo tên tour và điểm đến';

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->breadcrumbs;

        // Date from
        $this->data['search']['df'] = date('d/m/Y', strtotime('+1 day'));

        //  Date to
        $this->data['search']['dt'] = date('d/m/Y', strtotime('+10 day'));

        if ($this->input->get('df'))
            $this->data['search']['df'] = $this->security->xss_clean($this->input->get('df'));

        if ($this->input->get('dt'))
            $this->data['search']['dt'] = $this->security->xss_clean($this->input->get('dt'));

        // day from and day to
        $this->data['search']['day_from'] = show_day_of_week($this->data['search']['df']);

        $this->data['search']['day_to'] = show_day_of_week($this->data['search']['dt']);

        $this->data['search']['date_from_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['df']));

        $this->data['search']['date_to_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['dt']));

        // start from
        $this->data['search']['start_from_search'] = $this->security->xss_clean($this->input->get('start-from-search', null));;

        /*
         * Search theo ngay
         */
        $where .= ' AND (start_date = 1 OR (start_date >= "' . $this->data['search']['date_from_format'] . '" AND start_date <= "' . $this->data['search']['date_to_format'] . '"))';

        /*
         * Search theo dia diem khoi hanh
         */
        if ($this->data['search']['start_from_search'] != null)
        {
            $where .= ' AND (tour.from_province_id = ' . $this->input->get('start-from-search') . ') ';
        }

        $where .= ' AND (
                        (tour.name like "%' . $keyword_search . '%")
                        OR (province.name like "%' . $keyword_search . '%")
                    )';

        /*
         *  Sort
         */
        //  Moi nhat
        $sort = array('tour.id' => 'desc');

        /*
         * Pagination
         */
        $this->tour_model->select('tour.id');
        $this->tour_model->join('tour_comment', 'tour.id = tour_comment.tour_id', 'left');
        $this->tour_model->join('province', 'tour.to_province_id = province.id', 'left');
        $this->tour_model->group_by('tour.id');
        $records = $this->tour_model->find_all_by(array($where => null));
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
        $select = 'tour.id as id,
                    tour.name as name,
                    tour.picture as picture,
                    tour.price,
                    AVG(tour_comment.evaluation) as point,
                    tour.start_date,
                    tour.time,
                    tour.to_province_id,
                    tour.from_province_id,
                    tour.to_national_id,
                    tour.from_national_id,
                    tour.transportation,
                    ';
        $this->tour_model->select($select);
        $this->tour_model->join('tour_comment', 'tour.id = tour_comment.tour_id', 'left');
        $this->tour_model->join('province', 'tour.to_province_id = province.id', 'left');
        $this->tour_model->order_by($sort);
        $this->tour_model->group_by('tour.id');
        $this->tour_model->limit($limit, $offset);
        $records = $this->tour_model->find_all_by(array($where => null));

        $data = array();

        if ($records)
        {
            foreach($records as $k => $v)
            {
                $data[$k] = $v;

                $data[$k] = $v;

                $data[$k]->url = show_link($v->id, html_escape($v->name), 'tour_detail');

                $data[$k]->picture = show_picture(html_escape($v->picture), 214, 148, 'tour');

                $data[$k]->name = html_escape($v->name);

                $data[$k]->point = show_point($v->point);

                $data[$k]->bookmark = show_bookmark($data[$k]->point);

                $data[$k]->price = show_price($v->price);

                $data[$k]->start_date = $v->start_date;

                $data[$k]->time = html_escape($v->time);

                $data[$k]->to_province = (isset($province_data[$v->to_province_id])) ? $province_data[$v->to_province_id]->name : '';

                $data[$k]->from_province = (isset($province_data[$v->from_province_id])) ? $province_data[$v->from_province_id]->name : '';

                $data[$k]->to_national = (isset($national_data[$v->to_national_id])) ? $national_data[$v->to_national_id]->name : '';

                $data[$k]->from_national = (isset($national_data[$v->from_national_id])) ? $national_data[$v->from_national_id]->name : '';

                $data[$k]->transportation = html_escape($v->transportation);
            }
        }

        //  Records
        $this->data['records'] = $data;

        //  Total
        $this->data['search']['total'] = $total_rows;

        //Breadcrumbs
        $this->data['breadcrumbs'] = $this->breadcrumbs;

        //  Price range
        $this->data['price_range'] = $this->get_price_range();

        /*
         *  Luu session
         */
        $this->session->set_userdata('search-tour', array(
            'df' => $this->data['search']['df'],
            'dt' => $this->data['search']['dt'],
            'start_from_search' => $this->data['search']['start_from_search'],
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

    public function detail($tour_name, $tour_id = 0)
    {
        /*
         *  Get session search
         */
        $this->data['search'] = $search = $this->session->userdata('search-tour');

        // Date from
        if ($this->input->get('df'))
            $this->data['search']['df'] = $this->security->xss_clean($this->input->get('df'));
        else if (!isset($this->data['search']['df']))
            $this->data['search']['df'] = date('d/m/Y', strtotime('+1 day'));

        //  Date to
        if ($this->input->get('dt'))
            $this->data['search']['dt'] = $this->security->xss_clean($this->input->get('dt'));
        else if (!isset($this->data['search']['dt']))
            $this->data['search']['dt'] = $date_to = date('d/m/Y', strtotime('+10 day'));

        if (!isset($this->data['search']['start_from_search']))
            $this->data['search']['df'] = date('d/m/Y', strtotime('+1 day'));

        //  Date to
        if ($this->input->get('start_from_search'))
            $this->data['search']['start_from_search'] = $this->security->xss_clean($this->input->get('start_from_search'));
        else if (!isset($this->data['search']['start_from_search']))
            $this->data['search']['start_from_search'] = $start_from_search = 98;


        //  Tour id
        $id = $this->security->xss_clean($tour_id);

        /*
         *  Tour info
         */
        $record = $this->tour_model->find_by(array('tour.status = 1 AND tour.id = ' . $id => NULL));

        /*
         * Province
         */
        $province = $this->province_model->select('id, name')->find($record->from_province_id);

        /*
         * Breadcrumbs
         */
        $this->breadcrumbs = array_merge($this->breadcrumbs, array($province->name => show_link($province->id, $province->name, 'province')));

        $this->breadcrumbs = array_merge($this->breadcrumbs, array($record->name => show_link($record->id, $record->name, 'tour')));

        /*
         *  Picture
         */
        $picture = $this->tour_image_model->find_all_by(array('tour_id' => $id));

        /*
         * Comment
         */
        $this->tour_comment_model->select('COUNT(id) as total');
        $comment_total = $this->tour_comment_model->find_by(array('status' => 1, 'tour_id' => $id, 'deleted' => 0));

        $this->tour_comment_model->select('tour_comment.*, user.name as user_fullname');
        $this->tour_comment_model->join('user', 'tour_comment.user_id = user.id', 'left');
        $this->tour_comment_model->limit(10);
        $comment = $this->tour_comment_model->find_all_by(array('tour_comment.status' => 1, 'tour_comment.tour_id' => $id, 'tour_comment.deleted' => 0));

        /*
         * Tour lien quan
         */
        $where_tour_other  = 'tour.status = 1 AND tour.deleted = 0';
        $where_tour_other .= ' AND tour.id <> ' . $id;
        $where_tour_other .= ' AND tour.to_province_id = ' . $record->to_province_id;

        $select = 'tour.id as id,
                    tour.name as name,
                    tour.picture as picture,
                    tour.price,
                    AVG(tour_comment.evaluation) as point,
                    tour.start_date,
                    tour.time,
                    tour.to_province_id,
                    tour.from_province_id,
                    tour.to_national_id,
                    tour.from_national_id,
                    tour.transportation,
                    ';
        $this->tour_model->select($select);
        $this->tour_model->join('tour_comment', 'tour.id = tour_comment.tour_id', 'left');
        $this->tour_model->join('province', 'tour.to_province_id = province.id', 'left');
        $this->tour_model->order_by(array('tour.id' => 'desc'));
        $this->tour_model->group_by('tour.id');
        $this->tour_model->limit(10);
        $tour_other = $this->tour_model->find_all_by(array($where_tour_other => null));

        $data_tour_other = array();

        if ($tour_other)
        {
            foreach($tour_other as $k => $v)
            {
                $data_tour_other[$k] = $v;

                $data_tour_other[$k] = $v;

                $data_tour_other[$k]->url = show_link($v->id, html_escape($v->name), 'tour_detail');

                $data_tour_other[$k]->picture = show_picture(html_escape($v->picture), 90, 71, 'tour');

                $data_tour_other[$k]->name = html_escape($v->name);

                $data_tour_other[$k]->point = show_point($v->point);

                $data_tour_other[$k]->bookmark = show_bookmark($data_tour_other[$k]->point);

                $data_tour_other[$k]->price = show_price($v->price);

                $data_tour_other[$k]->start_date = ($v->start_date == 1) ? 'Hằng ngày' : format_date('d/m/Y',$v->start_date);

                $data_tour_other[$k]->time = html_escape($v->time);

                $data_tour_other[$k]->to_province = (isset($province_data[$v->to_province_id])) ? $province_data[$v->to_province_id]->name : '';

                $data_tour_other[$k]->from_province = (isset($province_data[$v->from_province_id])) ? $province_data[$v->from_province_id]->name : '';

                $data_tour_other[$k]->to_national = (isset($national_data[$v->to_national_id])) ? $national_data[$v->to_national_id]->name : '';

                $data_tour_other[$k]->from_national = (isset($national_data[$v->from_national_id])) ? $national_data[$v->from_national_id]->name : '';

                $data_tour_other[$k]->transportation = html_escape($v->transportation);
            }
        }



        /*
         * Kiem tra user neu co login xem da tung dat phong chua moi cho comment
         */
        if (isset($this->data['user']))
        {
            $check_order = $this->tour_order_model->where(array('user_id' => $this->data['user']->id, 'status' => 6))->count_all();
            if ($check_order > 0)
                $this->data['comment_allow'] = true;
            else
                $this->data['comment_allow'] = false;
        }

        $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $province_data = array();
        foreach($province as $k => $v)
            $province_data[$v->id] = $v;

        $national = $this->national_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $national_data = array();
        foreach($national as $k => $v)
            $national_data[$v->id] = $v;


        /*
         *  Luu session
         */
        $this->session->set_userdata('search-tour', array(
            'df' => $this->data['search']['df'],
            'dt' => $this->data['search']['dt'],
            'start_from_search' => $this->data['search']['start_from_search'],
        ));

        /*
         *  Dia diem pho bien trong nuoc
         */
        $province_vn_common = $this->province_model->select('id, name, picture')
            ->limit(10)->order_by('id', 'asc')
            ->find_all_by(array('status' => 1, 'national_id' => 2, 'deleted' => 0,));

        /*
         *  Dia diem pho bien ngoai nuoc
         */
        $province_nn_common = $this->province_model->select('id, name, picture')
            ->limit(10)->order_by('id', 'asc')
            ->find_all_by(array('status' => 1, 'national_id != 2' => null, 'deleted' => 0));

        $this->data['province_vn_common'] = $province_vn_common;

        $this->data['province_nn_common'] = $province_nn_common;

        $this->data['tour_other'] = $data_tour_other;

        $this->data['partner_tour'] = $this->partner_tour_model->find($record->partner_tour_id);

        $this->data['national_data'] = $national_data;

        $this->data['province_data'] = $province_data;

        $this->data['record'] = $record;

        $this->data['picture'] = $picture;

        $this->data['comment'] = $comment;

        $this->data['comment_total'] = $comment_total->total;

        $this->data['breadcrumbs'] = $this->breadcrumbs;

        $this->data['main_title'] = strip_tags($record->name);
        $this->data['main_description'] = strip_tags($record->description_meta);
        $this->data['main_keyword'] = strip_tags($record->keyword);

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
}