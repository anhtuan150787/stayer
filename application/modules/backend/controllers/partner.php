<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partner extends Backend_Controller
{

    protected $limit = 20;
    protected $model = 'partner_model';

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Đối tác';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'hotel_model', 'partner_group_model'));

        /*
         * Breadcrum
         */
        $this->data['hotel'] = $hotel = $this->hotel_model->find_by(array('partner_id' => $this->uri->segment(4)));
        
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Khách sạn ' . $hotel->name => site_url() . '/backend/hotel/edit/' . $hotel->id,
            'Đối tác' => '',
        );

        /*
         * Load js
         */
        $this->data['js'] = array('partner.js');

        /*
         * Check permission hotel of sale
         */
        if (!check_own_hotel($this->data['admin']['group_id'], $this->data['admin']['id'], $hotel->id))
            redirect(site_url() . '/backend/hotel/index');
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

        $config['total_rows'] = $this->{$this->model}->count_all();

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */
        $records = $this->{$this->model}->limit($limit, $offset)->find_all();

        $this->data['records'] = $records;

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
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
                redirect(site_url() . '/backend/hotel/index/edit-success');
            }
        }

        /*
         * Get record
         */
        $this->data['record'] = $this->{$this->model}->find($id);

        /*
         * Group
         */
        $this->data['group_partner'] = $this->partner_group_model->find_all();

        /*
         * View
         */
        $this->my_layout->view('backend/' . strtolower(__CLASS__) . '/form', $this->data);
    }

    public function save($id = null)
    {
        /*
         * Record info
         */
        if ($id != null)
            $admin = $this->partner_model->find($id);

        /*
         * Validate
         */
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('group_id', 'Group', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');

        /*
         * Validate username
         */
        if ($id == null || ($id != null && $this->input->post('username') != $admin->username))
        {
            $validate_username = 'trim|required|xss_clean|is_unique[partner.username]';
        }
        else
        {
            $validate_username = 'trim|required|xss_clean';
        }
        $this->form_validation->set_rules('username', 'Username', $validate_username);

        /*
         * Validate email
         */
        if ($id == null || ($id != null && $this->input->post('email') != $admin->email))
        {
            $validate_email = 'valid_email|trim|xss_clean|is_unique[partner.email]';
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

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['status'] = $this->input->post('status');
        $params['phone'] = $this->input->post('phone');
        $params['username'] = $this->input->post('username');
        $params['email'] = $this->input->post('email');
        $params['group_id'] = $this->input->post('group_id');
        $params['password'] = encrypt_password($this->input->post('password'));
        $params['description'] = $this->input->post('description');
        $params['update_by'] = $this->data['admin']['username'];

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

}
