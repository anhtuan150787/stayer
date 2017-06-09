<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{

    protected $data = array();
   
    protected $username;
   
    protected $password;
   
    protected $captcha;

    public function __construct()
    {
        parent::__construct();

        /*
         * Kiem tra dang nhap
         */
        if ($this->session->userdata('admin'))
        {
            redirect(site_url() . '/backend/index');
        }

        /*
         * Title trang
         */
        $this->data['title'] = 'Đăng nhập';

        /*
         * Load thu vien Layout
         * Set Layout
         */
        $this->load->library('my_layout');
        $this->my_layout->setLayout('layout/login');

        /*
         * Set ngon ngu
         */
        //$this->config->set_item('language', 'vn');
        
        /*
         * Load model admin
         */
        $this->load->model('admin_model');
        
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
         * Submit login
         */
        if ($this->input->post())
        {
            $this->username = $this->input->post('username');
            $this->password = $this->input->post('password');
            $this->captcha = $this->input->post('captcha');

            /*
             * Validate
             */
            $this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|max_length[50]|xss_clean|callback_check_login');
            $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|max_length[4]|xss_clean|callback_validate_captcha');

            /*
             * Check captcha
             */
            if (strcasecmp($this->session->userdata('captcha_word'), $this->captcha) == 0)
            {
                //Login success
                if ($this->form_validation->run() == true)
                {
                    redirect(site_url() . '/backend/index');
                }
                //Login fail
                else
                {
                    $this->data['error'] = validation_errors();
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
        //Lay thong tin user admin
        $admin = $this->admin_model->get_admin($this->username, encrypt_password($this->password));
        //Success
        if (!empty($admin))
        {
            /*
             * User
             */
            $user = array();
            $user['id'] = $admin->id;
            $user['username'] = $admin->username;
            $user['group_id'] = $admin->group_id;
            
            /*
             * Save session user
             */
            $this->session->set_userdata('admin', $user);
           
            return true;
        }
        //Fail
        else
        {
            $this->form_validation->set_message('check_login', 'Tài khoản hoặc mật khẩu không đúng.');

            return false;
        }
    }
    
    public function forget()
    {
        /*
         * Title trang
         */
        $this->data['title'] = 'Quên mật khẩu';
        
        /*
         * Submit login
         */
        if ($this->input->post())
        {
            /*
             * Validate
             */
            $this->form_validation->set_rules('username', 'Tài khoản', 'trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|max_length[4]|xss_clean|callback_validate_captcha');

            /*
             * Check captcha
             */
            if (strcasecmp($this->session->userdata('captcha_word'), $this->input->post('captcha')) == 0)
            {
                //success
                if ($this->form_validation->run() == true)
                {
                    $user = $this->admin_model->find_by(array('username' => $this->input->post('username')));
                    
                    if (!empty($user))
                    {
                        /*
                         *  Load send mail library
                         */
                        $pass_new = substr(str_shuffle('zxcvbnmasdfghjklqwertyuiop1234567890'), 0, 6); 
                         
                        $message = 'Mật khẩu mới của bạn là: ' . $pass_new;
                         
                        $config_mail = $this->config->item('sendmail');
                        
                        /*
                         *  Set up send mail
                         */ 
                        $this->load->library('email', $config_mail);
                        
                        $this->email->set_newline("\r\n");
                        $this->email->from($config_mail['smtp_user'], $config_mail['from_name']);
                        $this->email->to($user->email);
                        $this->email->subject('Thay đổi mật khẩu login admin azy.vn');
                        $this->email->message($message);
                        
                        /*
                         *  Send mail
                         */
                        if($this->email->send())
                        {
                            //Update database
                            $this->admin_model->update($user->id, array('password' => encrypt_password($pass_new)));
                            
                            $this->data['info'] = 'Hệ thống đã gửi email có chứa mật khẩu mới.';
                        }
                        else
                        {
                            $this->data['error'] = 'Lỗi hệ thống.';
                        }
                    }
                    else
                    {
                        $this->data['error'] = 'Tài khoản không tồn tại.';
                    }
                }
                //fail
                else
                {
                    $this->data['error'] = validation_errors();
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
}
