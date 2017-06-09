<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends Frontend_Controller
{

    public function __construct()
    {

        parent::__construct();

         $this->load->model(array('frontend/hotel_model', 'frontend/display_model'));
    }

    public function index()
    {
        /*
         *  unset session search
         */
        $this->session->unset_userdata('search');

        /*
         *  Range day
         */
        $this->data['search']['range_day'] = get_range_day_now();

        /*
         * 	Lay danh sach khach san xem nhieu
         */
        $hotel_most_view = $this->hotel_most_view();
        
        /*
         *  Khach san dat nhieu
         *  Tam thoi chua co module dat phong nen query khach san xem nhieu   
         */
        $hotel_most_order = $this->hotel_most_order();

        /*
         *  Dia diem pho bien
         */
        $province_common = $this->province_model->select('id, name, picture')
                            ->limit(6)->order_by('id', 'asc')
                            ->find_all_by(array('status' => 1, 'common' => 1, 'deleted' => 0));

        /*
         *  Quang cao
         */
        $adv = $this->display_model->select('id, name, url, picture')
                ->find_all_by(array('type_id' => 1, 'deleted' => 0)); // Quang cao trang chu. id = 1
        
        /*
         * Banner
         */
        $banner_home = $this->display_model->select('id, picture')
                        ->find_all_by(array('type_id' => 2, 'deleted' => 0)); // Banner trang chu. id = 2

        /*
         * Cam nhan khach hang
         */
        $comment_customer = $this->display_model->select('id, name, url, picture, content')
            ->find_all_by(array('type_id' => 5, 'deleted' => 0));

        /*
         *  Data load view
         */
        $this->data['hotel_most_view'] = $hotel_most_view;

        $this->data['hotel_most_order'] = $hotel_most_order;

        $this->data['province_common'] = $province_common;

        $this->data['adv'] = $adv;

        $this->data['comment_customer'] = $comment_customer;
        
        $this->data['banner_home'] = $banner_home;

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function hotel_most_view()
    {
        $this->hotel_model->select('
            hotel.picture as picture, hotel.id as id, hotel.name as name, hotel.address as address, hotel.star as star,
            AVG(hotel_comment.evaluation) as point, COUNT(hotel_comment.id) as comment_total
            ');

        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');

        $this->hotel_model->order_by('hotel.view', 'desc');

        $this->hotel_model->group_by('hotel.id');

        $this->hotel_model->limit(20);

        $hotel_most_view = $this->hotel_model->find_all_by(array('hotel.status' => 1, 'hotel.deleted' => 0));

        $data = array();

        if ($hotel_most_view)
        {    
            foreach($hotel_most_view as $k => $v)
            {
                $data[$k] = $v;

                $data[$k]->url = show_link($v->id, html_escape($v->name));

                $data[$k]->picture = show_picture(html_escape($v->picture), 150, 100);

                $data[$k]->name = html_escape($v->name);

                $data[$k]->address = html_escape($v->address);

                $data[$k]->price = show_price_low($v->id, $this->data['search']['range_day']);

                $data[$k]->point = show_point($v->point);

                $data[$k]->bookmark = show_bookmark($data[$k]->point);
            }
        }    
        return $data;
    }

    public function hotel_most_order()
    {
        $this->hotel_model->select('
            hotel.picture as picture, hotel.id as id, hotel.name as name, hotel.address as address, hotel.star as star,
            AVG(hotel_comment.evaluation) as point, COUNT(hotel_comment.id) as comment_total
        ');

        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');

        $this->hotel_model->order_by('AVG(hotel_comment.evaluation)', 'desc');

        $this->hotel_model->group_by('hotel.id');

        $this->hotel_model->limit(20);

        $hotel_most_view = $this->hotel_model->find_all_by(array('hotel.status' => 1, 'hotel.deleted' => 0));

        $data = array();

        if ($hotel_most_view)
        {    
            foreach($hotel_most_view as $k => $v)
            {
                $data[$k] = $v;

                $data[$k]->url = show_link($v->id, html_escape($v->name));

                $data[$k]->picture = show_picture(html_escape($v->picture), '', 195);

                $data[$k]->name = html_escape($v->name);

                $data[$k]->address = html_escape($v->address);

                $data[$k]->price = show_price_low($v->id, $this->data['search']['range_day']);

                $data[$k]->point = show_point($v->point);

                $data[$k]->bookmark = show_bookmark($data[$k]->point);
            }
        }    
        return $data;
    }

}
