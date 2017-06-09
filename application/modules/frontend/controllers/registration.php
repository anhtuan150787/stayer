<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration extends Frontend_Controller
{
    private $name;
    
    private $email;
    
    private $password;
    
    private $captcha;
    
    public function __construct()
    {
        parent::__construct();
        
        /*
         * Load hepler captcha
         */
        $this->load->helper('captcha');
        
        /*
         *  Load model
         */
        $this->load->model(array('frontend/user_model'));

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
            $this->email = $this->input->post('email');
            $this->password = $this->input->post('password');
            $this->name = $this->input->post('name');
            $this->captcha = $this->input->post('captcha');

            /*
             * Validate
             */
            $this->form_validation->set_rules('name', 'Họ tên', 'trim|required|max_length[50]|xss_clean'); 
            $this->form_validation->set_rules('email', 'Tài khoản', 'trim|required|max_length[50]|xss_clean|callback_check_exist_email');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|max_length[4]|xss_clean');
            
            /*
             * Check captcha
             */
            if (strcasecmp($this->session->userdata('captcha_word_front'), $this->captcha) == 0)
            {
                
                //success
                if ($this->form_validation->run() == true)
                {
                    $data = array();
                    $data['name'] = $this->name;
                    $data['email'] = $this->email;
                    $data['password'] = encrypt_password($this->password);
                    $data['status'] = 1;
                    $data['create_time'] = date('Y-m-d H:i:s');
                    $data['type'] = 'insite';
                    
                    $insert = $this->user_model->insert($data);   
                    
                    if ($insert)
                        $this->data['success'] = 'Đăng ký tài khoản thành công. Bạn có thể đăng nhập và đặt phòng.<br>Hệ thống sẽ chuyển trang sau 3 giây.';       
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
        $this->session->set_userdata(array('captcha_word_front' => $this->data['captcha']['word'])); 
           
        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
    
    public function check_exist_email()
    {
        $user = $this->user_model->select('COUNT(id) as total')->find_by(array('email' => $this->email));
        
        if ($user->total > 0)
        {
            $this->form_validation->set_message('check_login', 'Email này đã tồn tại. Vui lòng nhập Email khác');
            
            return false;
        }
        return true;
    }
}