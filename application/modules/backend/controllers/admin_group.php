<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_group extends Backend_Controller
{
    
    protected $limit = 20;

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Nhóm admin';

        /*
         * Load model admin group
         */
        $this->load->model(array('admin_group_model', 'admin_permission_model'));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Nhóm admin' => site_url() . '/backend/admin_group/',
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('admin_group.js');
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
        
        $config['base_url'] = site_url() . '/backend/admin_group/index/' . $str_param;
        
        $config['total_rows'] = $this->admin_group_model->where(array('deleted' => 0))->count_all();
        
        $config['per_page'] = $limit;
        
        $this->pagination->initialize($config);

        /*
         * Data view
         */
        $records = $this->admin_group_model->where(array('deleted' => 0))->limit($limit, $offset)->find_all();
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
                redirect(site_url() . '/backend/admin_group/index/add-success');
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
                redirect(site_url() . '/backend/admin_group/index/edit-success');
            }
        }

        /*
         * Get record
         */
        $this->data['record'] = $this->admin_group_model->find($id);

        /*
         * Get permission
         */
        $this->data['permission'] = $this->admin_permission_model->find_all_by(array('group_admin_id' => $id));

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
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['description'] = $this->input->post('description');

        if ($id == null)
        {
            /*
             * Add Group admin
             */
            $group_id = $this->admin_group_model->insert($params);

            /*
             * Add Permission
             */
            if ($group_id)
                $this->add_permission($group_id);

            return true;
        }
        else
        {
            /*
             * Update Group admin
             */
            $this->admin_group_model->update($id, $params);

            /*
             * Delete Permission
             */
            $this->admin_permission_model->delete_where(array('group_admin_id' => $id));

            /*
             * Add Permission
             */
            $this->add_permission($id);

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
             * Delete Group admin
             */
            $this->admin_group_model->delete($v);

            /*
             * Delete Permission
             */
            $this->admin_permission_model->delete_where(array('group_admin_id' => $v));
        }
        redirect(site_url() . '/backend/admin_group/index/delete-success');
    }

    public function add_permission($group_id)
    {
        foreach ($this->input->post('permission') as $v)
        {
            $permission = explode('::', $v);
            $params_permiss = array(
                'group_admin_id' => $group_id,
                'group' => $permission[0],
                'controller' => $permission[1],
                'method' => $permission[2],
            );
            $this->admin_permission_model->insert($params_permiss);
        }
    }

}
