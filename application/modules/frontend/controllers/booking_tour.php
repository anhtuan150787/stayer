<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking_tour extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'frontend/tour_model',
            'frontend/setting_model',
            'frontend/province_model',
            'frontend/tour_order_model',
            'frontend/tour_order_contact_model',
            'frontend/tour_order_detail_model',
            'frontend/national_model',
        ));
    }

    public function index()
    {
        /*
         *  Get session search
         */
        //$this->data['search'] = $search = $this->session->userdata('search-tour');

        $start_date = $this->input->post('book_start_date');
        $tour_id = $this->input->post('book_tour_id');

        if ($this->input->post('payment_type'))
        {
            $session_order = $this->session->userdata('order');

            $payment_type = $this->input->post('payment_type');
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            $province = $this->input->post('province');

            $start_date = $this->input->post('start_date');

            $slot = $this->input->post('slot');

            $order_note = $this->input->post('note');

            /*
             * Validate
             */
            $this->form_validation->set_rules('name', 'Họ tên người đặt phòng', 'trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('phone', 'Số điện thoại người đặt phòng', 'trim|required|max_length[11]|xss_clean|integer');
            $this->form_validation->set_rules('email', 'Email người đặt phòng', 'trim|required|max_length[50]|xss_clean|valid_email');
            $this->form_validation->set_rules('address', 'Địa chỉ người đặt phòng', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('payment_type', 'Phương thức thanh toán', 'trim|required|max_length[1]|xss_clean|integer');

            $this->form_validation->set_rules('start_date', 'Ngày khởi hành', 'trim|required|max_length[50]|xss_clean');

            $this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean');

            //success
            if ($this->form_validation->run() == true)
            {
                $data_session_contact = array();
                $data_session_contact['name']           = $name;
                $data_session_contact['phone']          = $phone;
                $data_session_contact['email']          = $email;
                $data_session_contact['address']        = $address;
                $data_session_contact['province_id']    = $province;

                $session_order['payment_type'] = $payment_type;
                $session_order['order_contact'] = $data_session_contact;
                $session_order['slot'] = $slot;
                $session_order['price_payment'] = $slot * $session_order['tour']['price'];
                $session_order['start_date'] = $start_date;

                $session_order['order_note'] = $order_note;

                $this->session->set_userdata('order', $session_order);

                redirect(base_url() . 'booking-tour-2');
            }
            else
            {
                $this->data['error'] = validation_errors();
            }
        }

        //  Province
        $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0, 'national_id' => 2));
        $province_data = array();
        foreach($province as $k => $v)
            $province_data[$v->id] = $v;

        $national = $this->national_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $national_data = array();
        foreach($national as $k => $v)
            $national_data[$v->id] = $v;

        // Tour info
        $tour = $this->tour_model->find($tour_id);

        //  Thong tin tour
        $this->data['tour'] = $tour;

        //  Thong tin user
        $this->data['user_info'] = $this->session->userdata('user');

        //  Thong tin tinh thanh
        $this->data['province'] = $province_data;

        $this->data['national'] = $national_data;

        /*
         *  Luu session
         */
        $session_order                      = array();

        unset($tour->description);
        unset($tour->policy);
        unset($tour->price_description);

        foreach($tour as $k => $v)
            $session_order['tour'][$k] = $v;

        $this->session->set_userdata('order', $session_order);

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function step2()
    {
        /*
         *  Check login
         */
        if (!$this->session->userdata('order'))
            redirect(base_url());

        $user = $this->session->userdata('user');

        $user_id = 0;
        if ($user)
            $user_id = $user->id;

        $session_order = $this->session->userdata('order');

        $this->load->database();

        /*
         *  Transaction
         */
        $this->db->trans_start();

        //  Luu thong tin don hang
        $this->db->query('INSERT tour_order
                            (tour_id,
                            date_start,
                            create_time,
                            user_id,
                            price_payment,
                            payment_type,
                            status,
                            ip,
                            content_tour,
                            slot,
                            order_note
                            )
                        values
                            (' . $session_order['tour']['id'] . ',
                            \'' . format_date('Y-m-d', $session_order['start_date']) . '\',
                            \'' . date('Y-m-d H:i:s') . '\',
                            \'' . $user_id . '\',
                            \'' . $session_order['price_payment'] . '\',
                            \'' . $session_order['payment_type'] . '\',
                            \'2\',
                            \'' . real_ip() . '\',
                            \'' . serialize($session_order['tour']) . '\',
                            \'' . $session_order['slot'] . '\',
                            \'' . $session_order['order_note'] . '\'
                            )');

        $order_id = $this->db->insert_id();

        //  Luu thong tin nguoi dat
        $this->db->query('INSERT tour_order_contact
                            (name,
                            phone,
                            email,
                            address,
                            order_id,
                            province_id)
                          values
                            ("' . $session_order['order_contact']['name'] . '",
                            "' . $session_order['order_contact']['phone'] . '",
                            "' . $session_order['order_contact']['email'] . '",
                            "' . $session_order['order_contact']['address'] . '",
                            "' . $order_id . '",
                            "' . $session_order['order_contact']['province_id'] . '"
                            )');


        //  Update order code
        $order_code = strtoupper(substr(str_shuffle('zxcvbnmasdfghjklqwertyuiop'), 0, 2) . substr(time(), -3) . $order_id);

        $this->db->query('UPDATE tour_order SET order_code = "' . $order_code . '" WHERE id =' . $order_id);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();

            $this->session->unset_userdata('order');
        }
        else
        {
            $this->db->trans_commit();

            $this->session->unset_userdata('order');

            $this->send_mail($order_id);

            redirect(base_url() . 'tour-order-finish/?order_id=' . $order_id);
        }

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    function order_finish()
    {
        $order_id = $this->input->get('order_id');

        $order = $this->tour_order_model->find($order_id);

        $order_detail = unserialize($order->content_tour);

        $order_detail = (object) $order_detail;

        $tour = $this->tour_model->find($order->tour_id);

        if(empty($order))
            redirect(base_url());

        $this->tour_order_contact_model->select('tour_order_contact.*, province.name as province_name');
        $this->tour_order_contact_model->join('province', 'tour_order_contact.province_id = province.id');
        $order_contact = $this->tour_order_contact_model->find_by(array('tour_order_contact.order_id' => $order_id));

        //  Province
        $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $province_data = array();
        foreach($province as $k => $v)
            $province_data[$v->id] = $v;

        $this->data['province_data'] = $province_data;

        $this->data['order'] = $order;

        $this->data['order_detail'] = $order_detail;

        $this->data['order_contact'] = $order_contact;

        $this->data['tour'] = $tour;

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function send_mail($order_id)
    {
        $order_id = $order_id;

        $order = $this->tour_order_model->find($order_id);

        $order_detail = unserialize($order->content_tour);

        $order_detail = (object) $order_detail;

        $tour = $this->tour_model->find($order->tour_id);

        if(empty($order))
            redirect(base_url());

        $this->tour_order_contact_model->select('tour_order_contact.*, province.name as province_name');
        $this->tour_order_contact_model->join('province', 'tour_order_contact.province_id = province.id');
        $order_contact = $this->tour_order_contact_model->find_by(array('tour_order_contact.order_id' => $order_id));

        $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $province_data = array();
        foreach($province as $k => $v)
            $province_data[$v->id] = $v;

        $this->data['province_booking_tour'] = $province_data;

        $this->data['order'] = $order;

        $this->data['order_detail'] = $order_detail;

        $this->data['order_contact'] = $order_contact;

        $this->data['tour'] = $tour;

        /*
         *  Load send mail library
         */
        $message_customer = $this->load->view(strtolower(__CLASS__) . '/customer_email_template', $this->data , true);

        $config_mail = $this->config->item('sendmail');

        /*
         *  Set up send mail
         */
        $this->load->library('email', $config_mail);

        //Send mail cho khach hang
        $this->email->set_newline("\r\n");
        $this->email->from($config_mail['smtp_user'], $config_mail['from_name']);
        $this->email->to($order_contact->email);
        $this->email->subject('Thông tin đặt tour tại Azy.vn');
        $this->email->set_mailtype("html");
        $this->email->message($message_customer);
        $this->email->send();
    }
}