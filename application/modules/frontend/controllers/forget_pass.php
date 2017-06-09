<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Forget_pass extends Frontend_Controller
{
    private $email_info;
    
    private $captcha;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('frontend/user_model'));
        
        /*
         * Load hepler captcha
         */
        $this->load->helper('captcha');
    }
    
    public function index()
    {
        /*
         *  Check login
         */
        if ($this->session->userdata('user'))
            redirect(base_url());
            
        $this->data['step'] = 1;
        
        /*
         *  Submit step 2
         */
        if ($this->input->post('step') && $this->input->post('step') == 1)
        {
           
            $this->email_info = $this->input->post('email');
            $this->captcha = $this->input->post('captcha');

            /*
             * Validate
             */
            $this->form_validation->set_rules('email', 'Tài khoản', 'trim|required|max_length[50]|xss_clean|callback_check_exist_email');
            $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|max_length[4]|xss_clean');
            
            /*
             * Check captcha
             */
            if (strcasecmp($this->session->userdata('captcha_word_front'), $this->captcha) == 0)
            {
                
                //success
                if ($this->form_validation->run() == true)
                {
                    $user_info = $this->user_model->find_by(array('email' => $this->email_info));
                    
                    $mxt = substr(str_shuffle('zxcvbnmasdfghjklqwertyuiop1234567890'), 0, 6); 
                    
                    $message = 'Chào bạn <b>' . $user_info->name . '</b>,' . '<br>';
                    $message .= 'Bạn vừa mới yêu cầu lấy lại mật khẩu tại Azy.vn. Bạn cần nhập mã sau vào ô xác thực để tiếp tục quá trình lấy lại mật khẩu.' . '<br>';
                    $message .= 'Mã xác thực: ' . '<br>';
                    $message .= '<b>' . $mxt . '</b>';
                     
                    $config_mail = $this->config->item('sendmail');
                    
                    /*
                     *  Set up send mail
                     */ 
                    $this->load->library('email', $config_mail);
                    
                    $this->email->set_newline("\r\n");
                    $this->email->from($config_mail['smtp_user'], $config_mail['from_name']);
                    $this->email->to($this->email_info);
                    $this->email->subject('Thay đổi mật khẩu azy.vn');
                    $this->email->message($message);
                    
                    /*
                     *  Send mail
                     */
                    if($this->email->send())
                    {
                        $this->data['step'] = 2;
                        
                        /*
                         * Save session
                         */
                        $this->data['user_info'] = $user_info = array('mxt' => $mxt, 'email' => $this->email_info); 
                        $this->session->set_userdata('user_forget_pass', $user_info);
                    }
                    else
                    {
                        $this->data['error'] = 'Lỗi hệ thống.';
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
        
        /*
         *  Submit step 2
         */ 
        else if ($this->input->post('step') && $this->input->post('step') == 2)
        {               
            if ($this->session->userdata('user_forget_pass'))
            {
                $uf = $this->session->userdata('user_forget_pass');
                
                $uf_mxt = $uf['mxt'];
                
                $uf_email = $uf['email'];
                
                $mxt_post = $this->input->post('mxt');
                
                $password_post = $this->input->post('password');
                
                if ($mxt_post == $uf_mxt)
                {
                    $data = array();
                    $data['password'] = encrypt_password($password_post);
                    $data['update_time'] = date('Y-m-d H:i:s');
                    
                    $update = $this->user_model->update_where(array('email' => $uf_email), $data);
                    
                    $this->session->unset_userdata('user_forget_pass');
                    
                    $this->data['success'] = 'Thay đổi mật khẩu cho tài khoản <b>' . $uf_email . '</b> thành công. Vui lòng ghi nhớ mật khẩu mới để sử dụng lần sau.<br>Hệ thống sẽ chuyển trang sau 5 giây.';
                    
                    $this->data['step'] = 3;
                }
                else
                {
                    $this->data['step'] = 2;
                    
                    $this->data['error'] = 'Mã xác thực không đúng.';
                }
            }
            else
            {
                $this->data['error'] = 'Lỗi hệ thống.';
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
        $user = $this->user_model->select('COUNT(id) as total')->find_by(array('email' => $this->email_info, 'type' => 'insite'));
        
        if ($user->total == 0)
        {
            $this->form_validation->set_message('check_login', 'Email không tồn tại trong hệ thống.');
            
            return false;
        }
        return true;
    }
}