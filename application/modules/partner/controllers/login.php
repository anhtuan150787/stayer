<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    private $username;
    
    private $password;
    
    private $remember;

    private $data = array();
    
    public function __construct()
    {
        parent::__construct();

        /*
         * Kiem tra dang nhap
         */
        if ($this->session->userdata('partner'))
        {
            redirect(site_url() . '/partner/partner_order');
        }

        /*
         * Title trang
         */
        $this->data['title'] = 'Azy.vn';

        /*
         * Set layout
         */
        $this->load->library('my_layout');
        $this->my_layout->setLayout('layout/login');

        /*
         * Load model
         */
        $this->load->model(array('partner/partner_model', 'partner/hotel_model'));

        /*
         * Load hepler captcha
         */
        $this->load->helper('captcha');

        /*
         * Load js
         */
        $this->data['js'] = array('login.js');
    }
    
    public function index()
    {
        /*
         *  Check login
         */
        if ($this->session->userdata('user'))
            redirect(base_url());
            
        if ($this->input->post())
        {
            $this->username = $this->input->post('u_n');
            
            $this->password = $this->input->post('p_w');

            $this->captcha = $this->input->post('captcha');

            /*
             * Check captcha
             */
            if (strcasecmp($this->session->userdata('captcha_word'), $this->captcha) == 0) {

                /*
                 *  Validate
                 */
                $this->form_validation->set_rules('u_n', 'Username', 'trim|required|xss_clean|max_length[50]');

                $this->form_validation->set_rules('p_w', 'Password', 'trim|required|xss_clean|max_length[50]|callback_check_login');

                if ($this->form_validation->run() == FALSE) {
                    $this->data['error'] = validation_errors();
                } else {
                    redirect(base_url() . 'partner/partner_order');
                }

            }
            else
            {
                $this->data['error'] = 'Mã xác thực không chính xác.';
            }
        }

        //Get Captcha
        $this->data['captcha'] = create_captcha($this->config->item('captcha'));
        //Save session captcha
        $this->session->set_userdata(array('captcha_word' => $this->data['captcha']['word']));
        
        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
    
    public function check_login()
    {
        //Lay thong tin user
        $user = $this->partner_model->find_by(array(
            'username' => $this->username,
            'password' => encrypt_password($this->password),
            'status' => 1,
            'deleted' => 0,
        ));
        
        //Success
        if (!empty($user))
        {
            /*
             * User
             */
            $partner_info = array();
            $partner_info['id'] = $user->id;
            $partner_info['username'] = $user->username;
            $partner_info['email'] = $user->email;
            $partner_info['name'] = $user->name;
            $partner_info['group_id'] = $user->group_id;

            /*
             * Lay thong tin hotel
             */
            $hotel = $this->hotel_model->find_by(array('partner_id' => $partner_info['id']));
            $partner_info['hotel_id'] = $hotel->id;
            $partner_info['hotel_name'] = $hotel->name;
            
            /*
             * Save session user
             */
            $this->session->set_userdata('partner', $partner_info);
           
            return true;
        }
        //Fail
        else
        {
            $this->form_validation->set_message('check_login', 'Tài khoản hoặc mật khẩu không đúng.');

            return false;
        }
    }
    
    public function logout()
    {
        setcookie("partner[email]", '', 1);  /* expire in 1 month */
        
        setcookie("partner[id]", '', 1);

        setcookie("partner[name]", '', 1);
        
        session_destroy();
                        
        $this->session->sess_destroy();
        
        redirect(base_url());
    }
}