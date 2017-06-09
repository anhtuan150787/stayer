<?php

class Index extends Partner_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->data['title'] = 'Dashboard';
    }

    public function index()
    {

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
}