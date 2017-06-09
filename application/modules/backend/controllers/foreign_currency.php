<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Foreign_currency extends Backend_Controller
{
    protected $limit = 20;
    
    protected $model = 'setting_model';

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Tỷ giá USD';

        /*
         * Load model
         */
        $this->load->model(array($this->model));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Tỷ giá USD' => site_url() . '/backend/' . $this->data['controller'],
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('setting.js');
    }
    
    public function index()
    {
        /*
         * Show Mesg
         */
        if ($this->uri->segment(4) == 'edit-success')
            $this->data['success'] = 'Cập nhật thành công.';
            
        /*
         * Action name
         */
        $this->data['action_name'] = 'Cập nhật';
        
        $id = 1;
        
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
        $this->form_validation->set_rules('value', 'Value', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['value'] = str_replace('.', '', $this->input->post('value'));;
        
        /*
         * Update record
         */
        $this->{$this->model}->update($id, $params);

        return true;
    }
}