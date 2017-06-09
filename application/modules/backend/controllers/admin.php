<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends Backend_Controller
{
    protected $limit = 20;
    
    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Admin';

        /*
         * Load model admin group
         */
        $this->load->model(array('admin_group_model', 'admin_model'));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Admin' => site_url() . '/backend/admin/',
        );
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
        
        $config['base_url'] = site_url() . '/backend/admin/index/' . $str_param;
        
        $config['total_rows'] = $this->admin_model->where(array('deleted' => 0))->count_all();
        
        $config['per_page'] = $limit;
        
        $this->pagination->initialize($config);
        
        /*
         * Data view
         */
        $this->admin_model->select('admin.*, admin_group.name as group_name');
        $this->admin_model->join('admin_group', 'admin.group_id = admin_group.id', 'left');
        $this->admin_model->where(array('admin.deleted' => 0));
        $this->admin_model->limit($limit, $offset);
        $records = $this->admin_model->find_all();
        
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
                redirect(site_url() . '/backend/admin/index/add-success');
            }
        }
        
        /*
         * Group admin
         */
        $this->data['admin_group'] = $this->admin_group_model->where(array('deleted' => 0))->find_all();

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
                redirect(site_url() . '/backend/admin/index/edit-success');
            }
        }

        /*
         * Get record
         */
        $this->data['record'] = $this->admin_model->find($id);
        
        /*
         * Group admin
         */
        $this->data['admin_group'] = $this->admin_group_model->find_all();

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/form', $this->data);
    }
    
    public function save($id = null)
    {
        /*
         * Record info
         */
        if ($id != null)
            $admin = $this->admin_model->find($id);
        
        /*
         * Validate
         */
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('group_id', 'Group_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        
        /*
         * Validate username
         */
        if ($id == null)
        {    
            if ($id == null || ($id != null && $this->input->post('username') != $admin->username))
            {
                $validate_username = 'trim|required|xss_clean|is_unique[admin.username]';
            }
            else
            {
                $validate_username = 'trim|required|xss_clean';
            }
            $this->form_validation->set_rules('username', 'Username', $validate_username); 
        }
        
        /*
         * Validate email
         */
        if ($id == null || ($id != null && $this->input->post('email') != $admin->email))
        {
            $validate_email = 'valid_email|trim|xss_clean|is_unique[admin.email]';
        }
        else
        {
            $validate_email = 'valid_email|trim|xss_clean';
        }
        $this->form_validation->set_rules('email', 'Email', $validate_email);     
            
        /*
         * Validate password
         */
        if ($id == null)
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name']     = $this->input->post('name');
        $params['email']    = $this->input->post('email');
        $params['status']   = $this->input->post('status');  
        $params['group_id'] = $this->input->post('group_id');
        $params['phone'] = $this->input->post('phone');
        $params['password'] = encrypt_password($this->input->post('password'));
        
        if ($id == null)
        {
            $params['username'] = $this->input->post('username');
            
            /*
             * Add record
             */
            $this->admin_model->insert($params);

            return true;
        }
        else
        {
            if ($this->input->post('password') == '')
                unset($params['password']);
            
            /*
             * Update record
             */
            $this->admin_model->update($id, $params);

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
            $this->admin_model->delete($v);
        }
        
        redirect(site_url() . '/backend/admin/index/delete-success');
    }
    
    public function change_status()
    {
        /*
         * id
         */
        $id = $this->input->get('id');
        
        /*
         * Record info
         */
        $admin = $this->admin_model->find($id);
      
        $status = 1;
        
        if ($admin->status == 1)
            $status = 0;
        
        /*
         * Update Status
         */
        $result = $this->admin_model->update($id, array('status' => $status));
        
        echo json_encode(array('result' => $result, 'status' => $status));
    }
}
