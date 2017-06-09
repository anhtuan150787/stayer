<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupon_group extends Backend_Controller
{

    protected $limit = 20;

    protected $model = 'coupon_group_model';

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Nhóm mã khuyến mãi';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'area_model'));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Nhóm mã khuyến mãi' => site_url() . '/backend/' . $this->data['controller'],
        );

        /*
         * Load js
         */
        $this->data['js'] = array('coupon_group.js');
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
         * Mien
         */
        $this->data['area'] = $this->area_model->find_all_by(array('national_id' => 2, 'deleted' => 0));

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
         * Mien
         */
        $this->data['area'] = $this->area_model->find_all_by(array('national_id' => 2, 'deleted' => 0));

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
        $this->form_validation->set_rules('hotel', 'Hotel', 'trim|xss_clean');
        $this->form_validation->set_rules('use_date_from', 'Use date from', 'trim|xss_clean');
        $this->form_validation->set_rules('use_date_to', 'Use date to', 'trim|xss_clean');
        $this->form_validation->set_rules('order_date_from', 'Order date from', 'trim|xss_clean');
        $this->form_validation->set_rules('order_date_to', 'Order date to', 'trim|xss_clean');
        $this->form_validation->set_rules('night', 'Night', 'trim|xss_clean');
        $this->form_validation->set_rules('use_time', 'Use time', 'trim|xss_clean');
        $this->form_validation->set_rules('discount', 'Discount', 'trim|xss_clean');
        $this->form_validation->set_rules('discount_max_price', 'Discount max price', 'trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['area'] = ($this->input->post('area') != '') ? ',' . implode(',', $this->input->post('area')) . ',' : '';
        $params['hotel'] = ($this->input->post('hotel') != '') ? ',' . trim($this->input->post('hotel'), ',') . ',' : '';
        $params['use_date_from'] = $this->input->post('use_date_from');
        $params['use_date_to'] = $this->input->post('use_date_to');
        $params['order_date_from'] = $this->input->post('order_date_from');
        $params['order_date_to'] = $this->input->post('order_date_to');
        $params['night'] = $this->input->post('night');
        $params['use_time'] = $this->input->post('use_time');
        $params['discount'] = $this->input->post('discount');
        $params['discount_max_price'] = str_replace('.', '', $this->input->post('discount_max_price'));
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
