<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backend_Controller extends CI_Controller
{
    protected $data = array();

    public function __construct()
    {

        parent::__construct();

        /*
         * Check user admin
         */
        if (!$this->session->userdata('admin'))
        {
            redirect('/backend/login');
        }
        else
        {
            $this->data['admin'] = $_SESSION['admin'] = $this->session->userdata('admin');
        }

        /*
         * Title trang
         */
        $this->data['title'] = 'Admin';

        /*
         * Set layout
         */
        $this->load->library('my_layout');
        $this->my_layout->setLayout('layout/index');

        /*
         * Get info module, class, function
         */
        $this->data['controller'] = $this->router->fetch_class();
        $this->data['action'] = $this->router->fetch_method();

        /*
         * Set language
         */
        //$this->config->set_item('language', 'vn');

        /*
         * Get Group admin permission
         */
        $this->load->model('admin_permission_model');
        $permission = array();
        $permission = $this->admin_permission_model->find_all_by(array('group_admin_id' => $this->data['admin']['group_id']));

        /*
         * Filter menu by permission
         */
        $this->data['menu'] = $this->menu_filter_permission($permission);
        
        /*
         * Check permission
         */
        if ($this->data['admin']['group_id'] != 1) {
            if (!$this->check_permission()) {
                show_error('Không có quyền truy cập.');
                exit();
            }
        }
    }

    public function menu_filter_permission($permission)
    {
        $menu = require APPPATH . 'modules/backend/assets/config_menu.php';

        $menu_filter = array();

        foreach ($menu as $k => $v)
        {
            foreach ($permission as $k_p => $v_p)
            {
                if (strtolower($k) == strtolower($v_p->group))
                {
                    $menu_filter[$k] = $v;
                    unset($menu_filter[$k]['item']);

                    foreach ($v['item'] as $kk => $vv)
                    {
                        foreach ($permission as $kk_p => $vv_p)
                        {
                            if (strtolower($kk) == strtolower($vv_p->controller))
                            {
                                $menu_filter[$k]['item'][$vv_p->controller] = $vv;
                            }
                        }
                    }
                }
            }
        }

        return $menu_filter;
    }

    public function check_permission()
    {
        $this->load->model('admin_permission_model');

        $permission = $this->admin_permission_model->find_all_by(array(
            'controller'        => $this->data['controller'],
            'method'            => $this->data['action'],
            'group_admin_id'    => $this->data['admin']['group_id'],
        ));

        if (empty($permission) && $this->data['controller'] != 'index')
            return false;
        
        return true;
    }
    
    public function get_params_url()
    {
        $param = $this->input->get();

        $str_param = '?';

        if (isset($param['per_page']))
        {
            unset($param['per_page']);
        }
        if (is_array($param) && count($param) > 0)
        {
            foreach ($param as $p_val => $p_key)
            {
                $str_param .= $p_val . '=' . $p_key . '&';
            }
            $str_param = rtrim($str_param, '&');
        }
        
        return $str_param;
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
        $admin = $this->{$this->model}->find($id);
      
        $status = 1;
        
        if ($admin->status == 1)
            $status = 0;
        
        /*
         * Update Status
         */
        $result = $this->{$this->model}->update($id, array('status' => $status));
        
        echo json_encode(array('result' => $result, 'status' => $status));
    }

}
