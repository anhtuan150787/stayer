<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends Frontend_Controller
{

    protected $breadcrumbs = array();

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs = array(
            'Trang chủ' => base_url(),
        );
    }

    public function index($id = 0)
    {
        $id = $this->input->get('id');

        /*
         *  Load model
         */
        $this->load->model('frontend/page_model');

        $record = $this->page_model->find($id);

        $this->breadcrumbs = array_merge($this->breadcrumbs, array($record->name => show_link($record->id, format_title($record->name), 'page')));

        $this->data['record'] = $record;

        $this->data['breadcrumbs'] = $this->breadcrumbs;

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

}
