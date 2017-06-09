<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends Frontend_Controller
{
    private $username;
    
    private $password;
    
    private $remember;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('frontend/user_model'));
    }
    
    public function index()
    {
        if ($this->input->get('back_url'))
            $back_url = urldecode($this->input->get('back_url'));
        else
            $back_url = base_url();

        /*
         *  Check login
         */
        if ($this->session->userdata('user'))
            redirect(base_url());


            
        if ($this->input->post())
        {
            $this->username = $this->input->post('u_n');
            
            $this->password = $this->input->post('p_w');
            
            $this->remember = $this->input->post('remember_user');
            
            /*
             *  Validate
             */
            $this->form_validation->set_rules('u_n', 'Username', 'trim|required|xss_clean|max_length[50]');
             
            $this->form_validation->set_rules('p_w', 'Password', 'trim|required|xss_clean|max_length[50]|callback_check_login');
        
            if ($this->form_validation->run() == FALSE)
            {
                $this->data['error'] = validation_errors();
            }
            else
            {

                redirect($back_url);
            }   
        }
        
        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
    
    public function check_login()
    {
        //Lay thong tin user
        $user = $this->user_model->find_by(array(
            'email' => $this->username, 
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
            $user_info = new stdClass();
            $user_info->id = $user->id;
            $user_info->email = $user->email;
            $user_info->name = $user->name;
            
            /*
             * Save session user
             */
            $this->session->set_userdata('user', $user_info);
            
            if ($this->remember == 1)
            {
                setcookie("user[id]", $user->id, time() + (3600 * 24 * 30));  /* expire in 1 month */
                
                setcookie("user[email]", $user->email, time() + (3600 * 24 * 30)); 
                
                setcookie("user[name]", $user->name, time() + (3600 * 24 * 30)); 
            }
           
            return true;
        }
        //Fail
        else
        {
            $this->form_validation->set_message('check_login', 'Email hoặc mật khẩu không đúng.');

            return false;
        }
    }
    
    public function logout()
    {
        setcookie("user[email]", '', 1);  /* expire in 1 month */
        
        setcookie("user[id]", '', 1); 

        setcookie("user[name]", '', 1); 
        
        session_destroy();
                        
        $this->session->unset_userdata('user');
        
        redirect(base_url());
    }
}