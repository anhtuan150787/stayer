<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends Backend_Controller
{

    protected $limit = 20;
    protected $model = 'user_model';

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Thành viên';

        /*
         * Load model
         */
        $this->load->model(array($this->model));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Thành viên' => site_url() . '/backend/' . $this->data['controller'],
        );

        /*
         * Load js
         */
        $this->data['js'] = array('user.js');
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

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] . '/index/' . $str_param;

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
        
        /*
         * Show Mesg
         */
        if ($this->uri->segment(5) == 'add-success')
            $this->data['success'] = 'Tạo mới thành công khách sạn. Vui lòng cập nhật thông tin đối tác để hoàn tất.';

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
         * Record info
         */
        if ($id != null)
            $admin = $this->{$this->model}->find($id);

        /*
         * Validate
         */
        
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');

        if ($id == null)
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');

            /*
             * Validate email
             */
            if ($id == null || ($id != null && $this->input->post('email') != $admin->email))
            {
                $validate_email = 'valid_email|trim|xss_clean|is_unique[user.email]';
            }
            else
            {
                $validate_email = 'valid_email|trim|xss_clean';
            }
            $this->form_validation->set_rules('email', 'Email', $validate_email);
            
            /*
             * Validate phone
             */
            if ($id == null || ($id != null && $this->input->post('phone') != $admin->phone))
            {
                $validate_phone = 'trim|xss_clean|is_unique[user.phone]';
            }
            else
            {
                $validate_phone = 'trim|xss_clean';
            }
            $this->form_validation->set_rules('phone', 'Phone', $validate_phone);
        }

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

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        
        $params['status'] = $this->input->post('status');
        $params['password'] = encrypt_password($this->input->post('password'));
        $params['update_by'] = $this->data['admin']['username'];
        $params['type'] = 'insite';

        if ($id == null)
        {
            $params['phone'] = $this->input->post('phone');
            $params['email'] = $this->input->post('email');
            $params['name'] = $this->input->post('name');

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
            //Update password
            if ($this->input->post('password') == '')
                unset($params['password']);
            
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
