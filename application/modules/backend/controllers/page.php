<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends Backend_Controller
{

    protected $limit = 20;
    
    protected $model = 'page_model';

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Trang nội dung';

        /*
         * Load model
         */
        $this->load->model(array($this->model));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Trang nội dung' => site_url() . '/backend/' . $this->data['controller'],
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('page.js');
        
        /*
         *  Config path upload image tinymce
         */
        $config_tinymce = $this->config->item('tinymce');
        
        $date = date('Y_m_d');
        
        $_SESSION['tinymce_upload_dir'] = $config_tinymce['upload_dir'] . 'pages/' . $date . '/';
        
        $_SESSION['tinymce_current_path'] = $config_tinymce['current_path'] . 'pages/' . $date . '/';
        
        $_SESSION['tinymce_thumbs_base_path'] = $config_tinymce['thumbs_base_path'] . 'pages/' . $date . '/thumbs/';
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
         * Pagination
         */
        $limit = $this->limit;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination');
        
        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] .'/index/' . $str_param;
        
        $config['total_rows'] = $this->{$this->model}->where(array('deleted' => 0))->count_all();
        
        $config['per_page'] = $limit;
        
        $this->pagination->initialize($config);
        
        /*
         * Data view
         */
        $records = $this->{$this->model}->where(array('deleted' => 0))->limit($limit, $offset)->order_by('id', 'desc')->find_all();
        
        $this->data['records'] = $records;

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
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['status'] = $this->input->post('status');  
        $params['content'] = $this->input->post('content'); 
        
        if ($id == null)
        {
            //User create
            $params['user_id'] = $this->data['admin']['id'];

            //Create time
            $params['create_time'] = date('Y-m-d H:i:s');
            $params['update_time'] = date('Y-m-d H:i:s');
                
            /*
             * Add record
             */
            $this->{$this->model}->insert($params);

            return true;
        }
        else
        {
            //Update time
            $params['update_time'] = date('Y-m-d H:i:s');
            
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
