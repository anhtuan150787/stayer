<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post_category extends Backend_Controller
{   
    protected $model = 'post_category_model';

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Danh mục bài viết';

        /*
         * Load model
         */
        $this->load->model(array($this->model));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Danh mục' => site_url() . '/backend/' . $this->data['controller'],
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('post_category.js');
    }
    
    public function index()
    {
        /*
         * Show Mesg
         */
        if ($this->uri->segment(4) == 'add-success')
            $this->data['success'] = 'Tạo mới thành công.';

        if ($this->uri->segment(4) == 'edit-success')
            $this->data['success'] = 'Cập nhật thành công.';

        if ($this->uri->segment(4) == 'delete-success')
            $this->data['success'] = 'Xóa thành công.';

        
        /*
         * Data view
         */
        $this->data['records'] = $this->{$this->model}->getAll();

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
    
    public function add()
    {
        /*
         * Action name
         */
        $this->data['action_name'] = 'Tạo mới';

        /*
         * Submit update
         */
        if ($this->input->post())
        {
            if ($this->save())
            {
                redirect(site_url() . '/backend/' . $this->data['controller'] .'/index/add-success');
            }
        }
        
        /*
         * Category
         */
        $this->data['category'] = $this->{$this->model}->getAll();

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/form', $this->data);
    }
    
    public function edit()
    {
        /*
         * Action name
         */
        $this->data['action_name'] = 'Cập nhật';

        $id = $this->uri->segment(4);

        /*
         * Submit update
         */
        if ($this->input->post())
        {
            if ($this->save($id))
            {
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/edit-success');
            }
        }

        /*
         * Get record
         */
        $this->data['record'] = $this->{$this->model}->find($id);
        
        /*
         * Category
         */
        $this->data['category'] = $this->{$this->model}->getAll();

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/form', $this->data);
    }
    
    public function save($id = null)
    {   
        /*
         * Validate
         */
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('parent', 'Parent', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['parent'] = $this->input->post('parent');
        $params['description'] = $this->input->post('description');
        $params['status'] = $this->input->post('status');  
        
        if ($id == null)
        {
            /*
             * Add record
             */
            $this->{$this->model}->insert($params);

            return true;
        }
        else
        {
            /*
             * Update record
             */
            $this->{$this->model}->update($id, $params);

            return true;
        }
    }
    
    public function delete()
    {
        $data = array();

        if ($this->input->post())
            $data = $this->input->post('check_item');
        else
            $data = array($this->uri->segment(4));

        foreach ($data as $v)
        {
            /*
             * Delete
             */
            $this->{$this->model}->delete($v);
        }
        
        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success');
    }
}
