<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Handbook extends Frontend_Controller
{

    protected $breadcrumbs = array();

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array(
            'frontend/display_model', 'frontend/province_model', 
            'frontend/beach_model', 'frontend/handbook_model',
            'frontend/hotel_model', 'frontend/handbook_tag_model'));
    }
    
    public function index()
    {
        /*
         *  Get main data
         */
        $this->get_main();

        /*
         *  List handbook
         */

        //Where
        $where = 'status = 1 AND deleted = 0';

        $keyword = '';

        if ($this->input->get('k'))
        {
            $keyword = $this->input->get('k');

            $where .= ' AND name LIKE "%' . $keyword . '%"';
        }

        $province_id = '';

        if ($this->input->get('p'))
        {
            $province_id = $this->input->get('p');

            $where .= ' AND province_id = ' . $province_id;
        }

        $beach_id = '';

        if ($this->input->get('b'))
        {
            $beach_id = $this->input->get('b');

            $where .= ' AND beach_id = ' . $beach_id;
        }

        $tag_id = '';

        if ($this->input->get('tag'))
        {
            $tag_id = $this->input->get('tag');

            $where .= ' AND tag_id LIKE "%,' . $tag_id . ',%"';
        }

        //Paging

        $limit = 10;

        $records = $this->handbook_model->find_all_by(array($where => NULL));

        $total_rows = count($records);

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination_fr');

        $config['base_url'] = base_url() . '/' . uri_string() . $str_param;

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        $this->handbook_model->limit($limit, $offset);

        $records = $this->handbook_model->select('id, name, picture, description, view, update_time')->find_all_by(array($where => NULL));

        /*
         *  View data
         */
    
        $this->data['records'] = $records;

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function detail($name = '', $id = 0)
    {
        /*
         *  Get main data
         */
        $this->get_main();

        /*
         *  Record
         */
        $record = $this->handbook_model->find($id);

        /*
         *  Tin khac
         */
        $other = $this->handbook_model->limit(10)->find_all_by(array('status = 1 AND deleted = 0 AND id <> ' . $record->id => NULL));

        /*
         *  Cap nhat so luot xem
         */
        $this->handbook_model->update($id, array('view' => $record->view + 1));

        /*
         *  Data view
         */
        $this->data['record'] = $record;

        $this->data['other'] = $other;

        $this->data['main_title'] = strip_tags($record->name);
        $this->data['main_description'] = strip_tags($record->description);
        $this->data['main_keyword'] = strip_tags($record->keyword);
        
        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function get_main()
    {
        /*
         * Banner
         */
        $banner_hankbook = $this->display_model->select('id, picture')->find_all_by(array('type_id' => 3, 'deleted' => 0)); // Banner trang handbook. id = 3

        /*
         *  Lay danh sach tinh thanh
         */
        $province = $this->province_model->select('id, name, area_id')->where(array('status = 1 AND deleted = 0' => NULL))->find_all();

        /*
         *  Lay danh sach bai bien
         */
        $beach = $this->beach_model->select('id, name')->where(array('status = 1 AND deleted = 0' => NULL))->find_all();

        /*
         *  Bai viet doc nhieu
         */
        $handbook_viewmost = $this->handbook_model->select('id, name, picture, update_time')->where(array('status = 1 AND deleted = 0' => NULL))->limit(5)->order_by(array('view' => 'desc'))->find_all();

        /*
         *  Bai viet moi nhat
         */
        $handbook_new = $this->handbook_model->select('id, name, picture, update_time')->where(array('status = 1 AND deleted = 0' => NULL))->limit(5)->order_by(array('id' => 'desc'))->find_all();

        /*
         *  Cam nang du lich
         */
        $handbook_cn = $this->handbook_model->select('id, name')->where(array('category_id LIKE "%,41,%" AND status = 1 AND deleted = 0' => NULL))->order_by(array('id' => 'desc'))->find_all();

        /*
         *  Lay danh sach tag
         */
        $handbook_tag = $this->handbook_tag_model->limit(50)->find_all();

        /*
         *  Khach san noi bat - So sao cao nhat
         */
        
        //  Range day
        $range_day = get_range_day_now();

        $where_hotel_other = 'hotel.status = 1 AND hotel.deleted = 0';
        
        $this->hotel_model->select('hotel.*, AVG(hotel_comment.evaluation) as point, province.name as province_name, room_price.price as price, promotion.name as promotion_name');
        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');
        $this->hotel_model->join('province', 'hotel.province_id = province.id', 'left');
        $this->hotel_model->join('room_price', 'hotel.id = room_price.hotel_id', 'left');
        $this->hotel_model->join('promotion', 'hotel.id = promotion.hotel_id', 'left');
        $this->hotel_model->order_by(array('AVG(hotel_comment.evaluation)' => 'desc', 'room_price.price' => 'asc'));
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

                $data_hotel_other[$k]->picture = show_picture(html_escape($v->picture), 95, 75);

                $data_hotel_other[$k]->name = html_escape($v->name);

                $data_hotel_other[$k]->address = html_escape($v->address);

                $data_hotel_other[$k]->price = show_price_low($v->id, $range_day);

                $data_hotel_other[$k]->point = show_point($v->point);

                $data_hotel_other[$k]->bookmark = show_bookmark($data_hotel_other[$k]->point);
            }
        }

        $this->data['province'] = $province;

        $this->data['beach'] = $beach;

        $this->data['handbook_viewmost'] = $handbook_viewmost;

        $this->data['handbook_cn'] = $handbook_cn;

        $this->data['handbook_new'] = $handbook_new;

        $this->data['hotel_other'] = $data_hotel_other;

        $this->data['banner_hankbook'] = $banner_hankbook;

        $this->data['handbook_tag'] = $handbook_tag;
    }

}