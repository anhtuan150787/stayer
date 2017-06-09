<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ward extends Backend_Controller
{

    protected $limit = 20;
    
    protected $model = 'ward_model';

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Phường/Xã';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'national_model', 'area_model', 'province_model', 'district_model'));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Phường/Xã' => site_url() . '/backend/' . $this->data['controller'],
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('ward.js');
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
        $this->{$this->model}->select('ward.*, district.name as district_name, province.name as province_name');
        $this->{$this->model}->join('district', 'ward.district_id = district.id', 'left');
        $this->{$this->model}->join('province', 'ward.province_id = province.id', 'left');
        $this->{$this->model}->where(array('ward.deleted' => 0));
        $this->{$this->model}->order_by('ward.id', 'desc');
        $records = $this->{$this->model}->limit($limit, $offset)->find_all();
        
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
         * Quoc gia
         */
        $this->data['national'] = $this->national_model->where(array('deleted' => 0))->find_all();

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
         * Quoc gia
         */
        $this->data['national'] = $this->national_model->where(array('deleted' => 0))->find_all();
        
        /*
         * Mien
         */
        $this->data['area'] = $this->area_model->find_all_by(array('national_id' => $this->data['record']->national_id, 'deleted' => 0));
        
        /*
         * Tinh/Thanh
         */
        $this->data['province'] = $this->province_model->find_all_by(array('area_id' => $this->data['record']->area_id, 'deleted' => 0));
        
        /*
         * Quan/Huyen
         */
        $this->data['district'] = $this->district_model->find_all_by(array('province_id' => $this->data['record']->province_id, 'deleted' => 0));
        
        
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
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('national_id', 'National', 'trim|required|xss_clean');
        $this->form_validation->set_rules('area_id', 'Area', 'trim|required|xss_clean');
        $this->form_validation->set_rules('province_id', 'Province', 'trim|required|xss_clean');
        $this->form_validation->set_rules('district_id', 'District', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['type'] = $this->input->post('type');
        $params['status'] = $this->input->post('status'); 
        $params['national_id'] = $this->input->post('national_id');
        $params['area_id'] = $this->input->post('area_id');
        $params['province_id'] = $this->input->post('province_id');
        $params['district_id'] = $this->input->post('district_id');
        
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
