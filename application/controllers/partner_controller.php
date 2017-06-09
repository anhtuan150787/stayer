<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partner_Controller extends CI_Controller
{
    protected $data = array();

    public function __construct()
    {

        parent::__construct();

        /*
         * Check user admin
         */
        if (!$this->session->userdata('partner'))
        {
            redirect('/partner/login');
        }
        else
        {
            $this->data['partner'] = $this->session->userdata('partner');
        }

        /*
         * Title trang
         */
        $this->data['title'] = 'Azy.vn';

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
         * Get Group admin permission
         */
        $this->load->model('partner/partner_permission_model');
        $permission = array();
        $permission = $this->partner_permission_model->find_all_by(array('group_partner_id' => $this->data['partner']['group_id']));

        /*
         * Filter menu by permission
         */
        $this->data['menu'] = $this->menu_filter_permission($permission);

        /*
         * Check permission
         */
        if (!$this->check_permission())
        {
            show_error('Không có quyền truy cập.');
            exit();
        }
    }

    public function menu_filter_permission($permission)
    {
        $menu = require APPPATH . 'modules/backend/assets/config_menu_partner.php';

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
        $this->load->model('partner/partner_permission_model');

        $permission = $this->partner_permission_model->find_all_by(array(
            'controller'        => $this->data['controller'],
            'method'            => $this->data['action'],
            'group_partner_id'    => $this->data['partner']['group_id'],
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
}
