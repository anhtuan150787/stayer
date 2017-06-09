<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request extends CI_Controller
{
    /*
     *  Reload captcha
     */
    function reload_captcha()
    {
        /*
         * Load hepler captcha
         */
        $this->load->helper('captcha');
        //Get Captcha
        $this->data['captcha'] = create_captcha($this->config->item('captcha'));
        //Save session captcha
        $this->session->set_userdata(array('captcha_word' => $this->data['captcha']['word']));

        echo $this->data['captcha']['image'];
    }
}