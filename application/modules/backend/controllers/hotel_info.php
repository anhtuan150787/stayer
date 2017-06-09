<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel_info extends Backend_Controller
{

    protected $model = 'hotel_info_model';

    public function __construct()
    {
        parent::__construct();

        $hotel_id = '';

        if ($this->input->get('hotel_id'))
            $hotel_id = $this->input->get('hotel_id');

        if ($this->input->post('hotel_id'))
            $hotel_id = $this->input->post('hotel_id');

        $this->data['hotel_id'] = $this->hotel_id = $hotel_id;

        /*
         * Title trang
         */
        $this->data['title'] = 'Thông tin chung';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'hotel_model', 'admin_model'));

        /*
         * Breadcrum
         */
        $this->data['hotel'] = $hotel = $this->hotel_model->find($this->hotel_id);

        $this->data['record'] = $this->{$this->model}->find_by(array('hotel_id' => $this->hotel_id));
        
        $admin_info = $this->admin_model->find($this->data['hotel']->user_id);
        
        $this->data['user_hotel'] = $admin_info;
        
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Khách sạn ' . $hotel->name => site_url() . '/backend/hotel/edit/' . $hotel->id,
            'Thông tin chung' => '',
        );

        /*
         * Check permission hotel of sale
         */
        if (!check_own_hotel($this->data['admin']['group_id'], $this->data['admin']['id'], $hotel->id))
            redirect(site_url() . '/backend/hotel/index');
    }

    public function edit()
    {
        /*
         * Action name
         */
        $this->data['action_name'] = 'Cập nhật';

        /*
         * Submit update
         */
        if ($this->input->post())
        {
            if ($this->save($this->data['record']->id))
            {
                redirect(site_url() . '/backend/hotel/index/edit-success');
            }
        }

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
        $this->form_validation->set_rules('bank_account', 'Bank account', 'trim|xss_clean');
        $this->form_validation->set_rules('bank_name', 'Bank name', 'trim|xss_clean');
        $this->form_validation->set_rules('bank_branch', 'Bank branch', 'trim|xss_clean');
        $this->form_validation->set_rules('account_number', 'Account number', 'trim|xss_clean');
        
        $this->form_validation->set_rules('mst', 'Mã số thuế', 'trim|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|xss_clean');
        $this->form_validation->set_rules('website', 'Website', 'trim|xss_clean');
        $this->form_validation->set_rules('fax', 'Fax', 'trim|xss_clean');
        
        $this->form_validation->set_rules('manager_name', 'Manager name', 'trim|xss_clean');
        $this->form_validation->set_rules('manager_email', 'Manager phone', 'trim|xss_clean');
        $this->form_validation->set_rules('manager_phone', 'Manager phone', 'trim|xss_clean');
        
        $this->form_validation->set_rules('business_name', 'Business name', 'trim|xss_clean');
        $this->form_validation->set_rules('business_email', 'Business phone', 'trim|xss_clean');
        $this->form_validation->set_rules('business_phone', 'Business phone', 'trim|xss_clean');
        
        $this->form_validation->set_rules('booking_name', 'Booking name', 'trim|xss_clean');
        $this->form_validation->set_rules('booking_email', 'Booking phone', 'trim|xss_clean');
        $this->form_validation->set_rules('booking_phone', 'Booking phone', 'trim|xss_clean');
        
        $this->form_validation->set_rules('accountant_name', 'Accountant name', 'trim|xss_clean');
        $this->form_validation->set_rules('accountant_email', 'Accountant phone', 'trim|xss_clean');
        $this->form_validation->set_rules('accountant_phone', 'Accountant phone', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['bank_account'] = $this->input->post('bank_account');
        $params['bank_name'] = $this->input->post('bank_name');
        $params['bank_branch'] = $this->input->post('bank_branch');
        $params['account_number'] = $this->input->post('account_number');
        
        $params['mst'] = $this->input->post('mst');
        $params['phone'] = $this->input->post('phone');
        $params['email'] = $this->input->post('email');
        $params['website'] = $this->input->post('website');
        $params['fax'] = $this->input->post('fax');
        
        $params['manager_name'] = $this->input->post('manager_name');
        $params['manager_email'] = $this->input->post('manager_email');
        $params['manager_phone'] = $this->input->post('manager_phone');
        
        $params['booking_name'] = $this->input->post('booking_name');
        $params['booking_email'] = $this->input->post('booking_email');
        $params['booking_phone'] = $this->input->post('booking_phone');
        
        $params['business_name'] = $this->input->post('business_name');
        $params['business_phone'] = $this->input->post('business_phone');
        $params['business_email'] = $this->input->post('business_email');
        
        $params['accountant_name'] = $this->input->post('accountant_name');
        $params['accountant_phone'] = $this->input->post('accountant_phone');
        $params['accountant_email'] = $this->input->post('accountant_email');

        /*
         * Update record
         */
        $this->{$this->model}->update($id, $params);

        return true;
        
    }

}
