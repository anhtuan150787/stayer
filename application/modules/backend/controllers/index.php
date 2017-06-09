<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Index extends Backend_Controller
{
    public function __construct() {
        
        parent::__construct();     

        /*
         * Title trang
         */
        $this->data['title'] = 'CMS Ver 1.0';

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Thống kê' => site_url() . '/backend/index',
        );

        $this->load->model(array('hotel_model', 'user_model', 'hotel_order_model', 'hotel_comment_model', 'handbook_model'));
    }
    
    public function index()
    {
        $this->data['hotel_count_all'] = $this->hotel_model->select('id')->count_all();

        $this->data['user_count_all'] = $this->user_model->select('id')->count_all();

        $this->data['order_count_all'] = $this->hotel_order_model->select('id')->count_all();

        $this->data['comment_count_all'] = $this->hotel_comment_model->select('id')->count_all();

        $this->data['handbook_count_all'] = $this->handbook_model->select('id')->count_all();

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
}

