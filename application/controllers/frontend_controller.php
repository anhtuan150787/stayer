<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_Controller extends CI_Controller
{
    protected $data = array();

    public function __construct()
    {

        parent::__construct();

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
         * Set language
         */
        //$this->config->set_item('language', 'vn');

        /*
         *  Lay danh sach tinh thanh
         */
        $this->load->model('frontend/province_model');

        $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'national_id' => 2, 'deleted' => 0));

        $provincenn = $this->province_model->select('id, name')->limit(14)->find_all_by(array('status' => 1, 'national_id != 2' => null, 'deleted' => 0));

        $this->data['province'] = $province;
        $this->data['provincenn'] = $provincenn;
        
        /*
         *  Session login
         */
         if (isset($_COOKIE['user']) && $_COOKIE['user']['email'] != '' && !$this->session->userdata('user'))
         {
            $user = new stdClass();
            $user->id = $_COOKIE['user']['id'];
            $user->email = $_COOKIE['user']['email'];
            $user->name = $_COOKIE['user']['name'];
            
            $this->session->set_userdata('user', $user); 
         }
         
         if ($this->session->userdata('user'))
            $this->data['user'] = $this->session->userdata('user');

        /*
         * Minify css, js
         */
        // $this->minify();

        /*
         * Keyword - title - description
         */
        $this->load->model(array('frontend/display_model'));
        $meta_home = $this->display_model->select('id, content')
            ->find_all_by(array('type_id' => 6, 'deleted' => 0)); // Banner trang chu. id = 2

        $this->data['main_title'] = strip_tags($meta_home[0]->content);
        $this->data['main_keyword'] = strip_tags($meta_home[1]->content);
        $this->data['main_description'] = strip_tags($meta_home[2]->content);
    }
    
    public function get_params_url()
    {
        $param = $this->input->get();

        $str_param = '?';

        if (isset($param['per_page'])) {
            unset($param['per_page']);
        }
        if (is_array($param) && count($param) > 0) {
            foreach ($param as $p_val => $p_key) {
                $str_param .= $p_val . '=' . $p_key . '&';
            }
            $str_param = rtrim($str_param, '&');
        }

        return $str_param;
    }

    public function minify()
    {
        $this->load->library('minify');

        $this->minify->css(array(
            'style.css', 'bootstrap.min.css',
            'style_mobile.css', 'style_tablet.css',
            'datepicker3.css', 'jquery.bxslider.css',
            'jquery-ui.css', 'font-awesome.min.css',
            'photo-galleries/sliderkit-core.css', 'photo-galleries/sliderkit-demos.css',
            'star-rating/jquery.rating.css',
        ));
        $this->minify->deploy_css(true);

        $js_array = array(
            'jquery-1.11.3.min.js', 'bootstrap.min.js',
            'script.js', 'bootstrap-datepicker.js',
            'jquery.bxslider.min.js', 'jquery.nicescroll.min.js',
            'jquery-ui.js', 'star-rating/jquery.rating.js',
            'photp-galleries/lib/js/external/_oldies/jquery-1.3.min.js',
            'photp-galleries/lib/js/external/jquery.easing.1.3.min.js',
            'photp-galleries/lib/js/external/jquery.mousewheel.min.js',
            'photp-galleries/lib/js/sliderkit/jquery.sliderkit.1.9.2.pack.js',
            'photp-galleries/lib/js/sliderkit/addons/sliderkit.delaycaptions.1.1.pack.js',
            'photp-galleries/lib/js/sliderkit/addons/sliderkit.counter.1.0.pack.js',
            'photp-galleries/lib/js/sliderkit/addons/sliderkit.timer.1.0.pack.js',
            'photp-galleries/lib/js/sliderkit/addons/sliderkit.imagefx.1.0.pack.js',
        );
        foreach($js_array as $v)
        {
            $this->minify->js(array($v));
            $this->minify->js_file = $v;
            $this->minify->deploy_js();
        }

    }
}
