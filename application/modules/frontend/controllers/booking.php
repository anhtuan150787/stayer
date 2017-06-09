<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking extends Frontend_Controller
{

    public function __construct()
    {

        parent::__construct();
        
        $this->load->model(array(
            'frontend/room_type_model',
            'frontend/hotel_model',
            'frontend/promotion_model',
            'frontend/hotel_order_model',
            'frontend/hotel_order_contact_model',
            'frontend/hotel_order_room_model',
            'frontend/hotel_info_model',
            'frontend/setting_model',
            'frontend/province_model',
            'frontend/hotel_order_contact_stay_model',
            'frontend/room_price_model',
            'frontend/room_price_stage_model',
            'frontend/coupon_group_model',
            ));
    }

    public function index()
    {
        if ($this->input->post('payment_type'))
        {
            $payment_type = $this->input->post('payment_type');
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            $province = $this->input->post('province');

            $name_stay = $this->input->post('name_stay');
            $phone_stay = $this->input->post('phone_stay');
            $email_stay = $this->input->post('email_stay');
            $address_stay = $this->input->post('address_stay');
            $province_stay = $this->input->post('province_stay');

            $order_note = $this->input->post('note');

            $coupon = $this->input->post('coupon');
            $area = $this->input->post('area');
            $night = $this->input->post('night');
            $hotel_id = $this->input->post('hotel_id');
            $price_total = $this->input->post('price_total');
            
            /*
             * Validate
             */
            $this->form_validation->set_rules('name', 'Họ tên người đặt phòng', 'trim|required|max_length[50]|xss_clean');
            $this->form_validation->set_rules('phone', 'Số điện thoại người đặt phòng', 'trim|required|max_length[11]|xss_clean|integer');
            $this->form_validation->set_rules('email', 'Email người đặt phòng', 'trim|required|max_length[50]|xss_clean|valid_email');
            $this->form_validation->set_rules('address', 'Địa chỉ người đặt phòng', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('payment_type', 'Phương thức thanh toán', 'trim|required|max_length[1]|xss_clean|integer');

            $this->form_validation->set_rules('name_stay', 'Họ tên người nhận phòng', 'trim|max_length[50]|xss_clean');
            $this->form_validation->set_rules('phone_stay', 'Số điện thoại người nhận phòng', 'trim|max_length[11]|xss_clean|integer');
            $this->form_validation->set_rules('email_stay', 'Email người nhận phòng', 'trim|max_length[50]|xss_clean|valid_email');
            $this->form_validation->set_rules('address_stay', 'Địa chỉ người nhận phòng', 'trim|max_length[255]|xss_clean');

            $this->form_validation->set_rules('note', 'Ghi chú', 'trim|xss_clean');
            $this->form_validation->set_rules('coupon', 'Mã khuyến mãi', 'trim|xss_clean');
            $this->form_validation->set_rules('area', 'Miền', 'trim|xss_clean');
            $this->form_validation->set_rules('night', 'Đêm ở', 'trim|xss_clean');
            $this->form_validation->set_rules('hotel_id', 'Mã khách sạn', 'trim|xss_clean');
            $this->form_validation->set_rules('price_total', 'Tổng giá phòng', 'trim|xss_clean');

            /*
             * Check ma khuyen mai neu co
             */
            if ($coupon != '') {
                $paramsCheckCoupon = array();
                $paramsCheckCoupon['coupon_code'] = $coupon;
                $paramsCheckCoupon['area_id'] = $area;
                $paramsCheckCoupon['hotel_id'] = $hotel_id;
                $paramsCheckCoupon['night'] = $night;
                $paramsCheckCoupon['price_total'] = $price_total;
                $paramsCheckCoupon['email'] = $email;
                $paramsCheckCoupon['phone'] = $phone;

                $checkCoupon = check_coupon($paramsCheckCoupon);

                if (!$checkCoupon['ReturnCode']) {
                    $this->data['error'] = 'Mã khuyến mãi không hợp lệ.';
                }
            }

            if (!isset($this->data['error'])) {

                //success
                if ($this->form_validation->run() == true) {

                    $data_session_contact = array();
                    $data_session_contact['name'] = $name;
                    $data_session_contact['phone'] = $phone;
                    $data_session_contact['email'] = $email;
                    $data_session_contact['address'] = $address;
                    $data_session_contact['province_id'] = $province;

                    $data_session_contact_stay = array();
                    $data_session_contact_stay['name'] = ($name_stay != '') ? $name_stay : $name;
                    $data_session_contact_stay['phone'] = ($phone_stay != '') ? $phone_stay : $phone;
                    $data_session_contact_stay['email'] = ($email_stay != '') ? $email_stay : $email;
                    $data_session_contact_stay['address'] = ($address_stay != '') ? $address_stay : $address;
                    $data_session_contact_stay['province_id'] = ($province_stay != '') ? $province_stay : $province;

                    $session_order = $this->session->userdata('order');

                    $session_order['payment_type'] = $payment_type;
                    $session_order['order_contact'] = $data_session_contact;
                    $session_order['order_contact_stay'] = $data_session_contact_stay;
                    $session_order['order_note'] = $order_note;

                    $session_order['coupon'] = $coupon;

                    $this->session->set_userdata('order', $session_order);

                    redirect(base_url() . 'booking_2');
                } else {
                    $this->data['error'] = validation_errors();
                }
            }
        }
        
        //  Ngay nhan phong
        $room_date_from = $this->input->post('room-date-from-search');
        
        $room_date_from_format = format_date('Y-m-d', str_replace('/', '-', $room_date_from));
        
        $room_day_from = show_day_of_week($room_date_from);
        
        $this->data['date_from'] = show_name_day_of_week($room_day_from) . ', ngày ' . $room_date_from;
        
        //  Ngay tra phong
        $room_date_to = $this->input->post('room-date-to-search');
        
        $room_date_to_format = format_date('Y-m-d', str_replace('/', '-', $room_date_to));
        
        $room_day_to = show_day_of_week($room_date_to);
        
        $this->data['date_to'] = show_name_day_of_week($room_day_to) . ', ngày ' . $room_date_to;
        
        //  So dem
        $this->data['night'] = $night = show_day_between_date($room_date_from_format, $room_date_to_format);
        
        //  Hotel id
        $hotel_id = $this->input->post('hotel_id');
        
        //  So luong phong
        $room = $this->input->post('num-room');

        //  Giuong them
        $bedmore = $this->input->post('bedmore-room');
        
        //  Thong tin hotel
        $hotel = $this->hotel_model->find($hotel_id);

        //  Thong tin tinh thanh
        $province = $this->province_model->find_all_by(array('deleted' => 0, 'status' => 1, 'national_id' => 2));
        
        $price_total = 0;
        
        $price_promotion = 0;
        
        $price_origin_total = 0;
                
        $data_room = array();
        
        //  Lay thong tin phong
        if ($room)
        foreach($room as $k => $v)
        {
            if ($v != 0)
            {
                $room_info = $this->room_type_model->select('id, name, slot, bed_more_price, price_type')->find($k);
                
                $data_room[$k] = $room_info;          
                
                //  Gia
                $data_room[$k]->price = $data_room[$k]->price_final = get_avg_price($room_date_from_format, $room_date_to_format, $room_info->id);  
                
                //  Gia goc
                $data_room[$k]->price_origin = $data_room[$k]->price_origin_final = get_avg_price_origin($room_date_from_format, $room_date_to_format, $room_info->id);
                
                //  Gia uu dai
                if (!$this->session->userdata('user') && $hotel->member_promotion == 1)
                {
                    $data_room[$k]->price_final = $data_room[$k]->price + (($data_room[$k]->price * $hotel->member_promotion_discount)/100);

                    $data_room[$k]->price_origin_final = $data_room[$k]->price_origin + (($data_room[$k]->price_origin * $hotel->member_promotion_discount)/100);
                }
                
                //  Gia them giuong
                if (!empty($bedmore) && isset($bedmore[$k]) && $bedmore[$k] == 1)
                {
                    $setting = $this->setting_model->find(1);

                    $data_room[$k]->price_bedmore = ($room_info->price_type == 'vnd') ? $room_info->bed_more_price : $setting->value * $room_info->bed_more_price;
                }
                else
                {
                    $data_room[$k]->price_bedmore = 0;
                }

                $data_room[$k]->room_number_booking = $v;
                
                /*
                 *  Khuyen mai
                 */
                //  Phong ap dung
                $where_promotion = 'status = 1 AND deleted = 0 AND room_id LIKE "%,' . $room_info->id . ',%"';
                
                //  Ngay ap dung
                $where_promotion .= ' AND (date_apply_from <= "' . date('Y-m-d') . '"  AND date_apply_to >= "' . date('Y-m-d') . '")';
    
                //  Ngay o
                $where_promotion .= ' AND (stay_day_from <= "' . $room_date_from_format . '"  AND stay_day_to >= "' . $room_date_to_format . '")';
    
                // Ngay dat
                $where_promotion .= ' AND (book_day_from <= "' . date('Y-m-d') . '"  AND book_day_to >= "' . date('Y-m-d') . '")';
                
                //  Dem o toi thieu
                $where_promotion .= ' AND (night <= ' . $night . ')';
                
                $promotion = $this->promotion_model->select('id, name, discount')->find_by(array($where_promotion => NULL));
                
                if (!empty($promotion))
                {    
                    $data_room[$k]->promotion = $promotion;
                    
                    //  Gia cuoi co khuyen mai
                    $data_room[$k]->price_final = $data_room[$k]->price_final - ($data_room[$k]->price_final * $promotion->discount)/100;

                    //  Gia goc cuoi co khuyen mai
                    $data_room[$k]->price_origin_final = $data_room[$k]->price_origin_final - ($data_room[$k]->price_origin_final * $promotion->discount)/100;
                }
                else
                {
                    $data_room[$k]->promotion = false;
                }

                //  Tong gia giuong phu neu co
                $data_room[$k]->price_bedmore_total = $data_room[$k]->room_number_booking * ($night * $data_room[$k]->price_bedmore);
                
                //  Tong gia cua phong
                $data_room[$k]->price_total =  ($data_room[$k]->room_number_booking * ($night * $data_room[$k]->price_final)) + $data_room[$k]->price_bedmore_total;
                
                //  Tong gia goc cua phong
                $data_room[$k]->price_origin_total =  ($data_room[$k]->room_number_booking * ($night * $data_room[$k]->price_origin_final)) + $data_room[$k]->price_bedmore_total;

                $price_total += $data_room[$k]->price_total;
                
                $price_origin_total += $data_room[$k]->price_origin_total;
            }
        }    
        
        //  Tong tien
        $this->data['price_total'] = $price_total; 
        
        //  Tong tien gia goc
        $this->data['price_origin_total'] = $price_origin_total;
        
        //  Phong    
        $this->data['room'] = $data_room;    
        
        //  Thong tin khach san
        $this->data['hotel'] = $hotel;

        //  Thong tin user
        $this->data['user_info'] = $this->session->userdata('user');

        //  Thong tin tinh thanh
        $this->data['province'] = $province;
        
        /*
         *  Luu session
         */
         $session_order                     = array();
         $session_order['hotel_id']         = $hotel_id;
         $session_order['hotel_name']       = $this->data['hotel']->name;
         $session_order['hotel_address']    = $this->data['hotel']->address;
         $session_order['date_stay_from']   = $room_date_from_format;
         $session_order['date_stay_to']     = $room_date_to_format;
         $session_order['night']            = $night;
         $session_order['price_total']      = $this->data['price_total'];
         $session_order['price_origin_total'] = $this->data['price_origin_total'];
         $session_order['order_detail']     = $data_room;
         $session_order['member_promotion'] = $this->data['hotel']->member_promotion;
         $session_order['member_promotion_discount'] = $this->data['hotel']->member_promotion_discount;
         
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
        
        $session_order = $this->session->userdata('order');
        
        $this->load->database();

        $hotel_log = $this->hotel_model->find($session_order['hotel_id']);

        $room_log = $this->room_type_model->find_by(array('hotel_id' => $session_order['hotel_id']));

        $room_price_log = $this->room_price_model->find_by(array('hotel_id' => $session_order['hotel_id']));

        $promotion_log = $this->promotion_model->find_by(array('hotel_id' => $session_order['hotel_id']));

        $room_price_stage_log = $this->room_price_stage_model->find_by(array('hotel_id' => $session_order['hotel_id']));


        if ($session_order['coupon'] != '') {
            $this->coupon_group_model->select('coupon_group.discount as discount, coupon_group.discount_max_price as discount_max_price, coupon_group.id as group_id');
            $this->coupon_group_model->join('coupon', 'coupon_group.id = coupon.group', 'right');
            $coupon_info = $this->coupon_group_model->find_by(array('coupon.code' => $session_order['coupon']));

            $price_coupon = ($session_order['price_total'] * $coupon_info->discount)/100;
            $price_coupon = min($price_coupon, $coupon_info->discount_max_price);

            $session_order['price_total'] = $session_order['price_total'] - $price_coupon;
        }


        /*
         *  Transaction
         */
        $this->db->trans_start();
        
        //  Luu thong tin don hang
        $this->db->query('INSERT hotel_order
                            (hotel_id,
                            date_stay_from,
                            date_stay_to,
                            create_time,
                            user_id,
                            price_payment,
                            payment_type,
                            status,
                            ip,
                            price_origin_payment,
                            hotel_name,
                            hotel_address,
                            member_promotion,
                            member_promotion_discount,
                            order_note,
                            time_cancel,
                            coupon,
                            coupon_discount,
                            coupon_discount_max_price
                            )
                        values
                            (' . $session_order['hotel_id'] . ',
                            "' . $session_order['date_stay_from'] . '",
                            "' . $session_order['date_stay_to'] . '",
                            "' . date('Y-m-d H:i:s') . '",
                            "' . $user->id . '",
                            "' . $session_order['price_total'] . '",
                            "' . $session_order['payment_type'] . '",
                            "2",
                            "' . real_ip() . '",
                            "' . $session_order['price_origin_total'] . '",
                            "' . $session_order['hotel_name'] . '",
                            "' . $session_order['hotel_address'] . '",
                            "' . $session_order['member_promotion'] . '",
                            "' . $session_order['member_promotion_discount'] . '",
                            "' . $session_order['order_note'] . '",
                            "' . date('Y-m-d H:i:s', strtotime('+24 hours', time())) . '",
                            "' . $session_order['coupon'] . '",
                            "' . $coupon_info->discount . '",
                            "' . $coupon_info->discount_max_price . '"
                            )');
        
        $order_id = $this->db->insert_id();
        
        //  Luu thong tin nguoi dat phong
        $this->db->query('INSERT hotel_order_contact
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

        //  Luu thong tin nguoi nhan phong
        $this->db->query('INSERT hotel_order_contact_stay
                            (name,
                            phone,
                            email,
                            address,
                            order_id,
                            province_id)
                          values
                            ("' . $session_order['order_contact_stay']['name'] . '",
                            "' . $session_order['order_contact_stay']['phone'] . '",
                            "' . $session_order['order_contact_stay']['email'] . '",
                            "' . $session_order['order_contact_stay']['address'] . '",
                            "' . $order_id . '",
                            "' . $session_order['order_contact_stay']['province_id'] . '"
                            )');
        
        //  Luu thong tin chi tiet
        foreach($session_order['order_detail'] as $v)
        {
            $promotion_id = ($v->promotion != false) ? $v->promotion->id : '';
            
            $promotion_discount = ($v->promotion != false) ? $v->promotion->discount : '';
            
            $this->db->query('INSERT hotel_order_room
                                (room_id,
                                hotel_id,
                                price,
                                night,
                                room_number_booking,
                                order_id,
                                price_total,
                                price_final,
                                promotion_id,
                                promotion_discount,
                                slot,
                                price_origin,
                                price_origin_total,
                                room_name,
                                price_origin_final,
                                price_bedmore)
                            values
                                ("' . $v->id . '",
                                "' . $session_order['hotel_id'] . '",
                                "' . $v->price . '",
                                "' . $session_order['night'] . '",
                                "' . $v->room_number_booking . '",
                                "' . $order_id . '",
                                "' . $v->price_total . '",
                                "' . $v->price_final . '",
                                "' . $promotion_id . '",
                                "' . $promotion_discount . '",
                                "' . $v->slot . '",
                                "' . $v->price_origin . '",
                                "' . $v->price_origin_total . '",
                                "' . $v->name . '",
                                "' . $v->price_origin_final . '",
                                "' . $v->price_bedmore . '"
                                )');
        }
        
        //  Update order code
        $order_code = strtoupper(substr(str_shuffle('zxcvbnmasdfghjklqwertyuiop'), 0, 2) . substr(time(), -3) . $order_id);
        
        $this->db->query('UPDATE hotel_order SET order_code = "' . $order_code . '" WHERE id =' . $order_id);


        /*
         * Insert hotel order log
         */
        unset($hotel_log->description);
        unset($hotel_log->policy);

        unset($room_log->description);
        unset($room_log->policy);

        $this->db->query("INSERT INTO hotel_order_log (hotel, room, order_id, room_price, promotion, room_price_stage, coupon)
                          VALUES ('" . json_encode($hotel_log) . "', '" . json_encode($room_log) . "', '" . $order_id . "', '" . json_encode($room_price_log) . "', '" . json_encode($promotion_log) . "', '" . json_encode($room_price_stage_log) . "', '" . json_encode($coupon_info) . "')");


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
            
            redirect(base_url() . 'order_finish/?order_id=' . $order_id);
        }
         
        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
    
    function order_finish()
    {
        $order_id = $this->input->get('order_id');
        
        $order = $this->hotel_order_model->find($order_id);
        
        $hotel = $this->hotel_model->find($order->hotel_id);
        
        if(empty($order))
            redirect(base_url());

        $this->hotel_order_contact_model->select('hotel_order_contact.*, province.name as province_name');
        $this->hotel_order_contact_model->join('province', 'hotel_order_contact.province_id = province.id');
        $order_contact = $this->hotel_order_contact_model->find_by(array('hotel_order_contact.order_id' => $order_id));

        $this->hotel_order_contact_stay_model->select('hotel_order_contact_stay.*, province.name as province_name');
        $this->hotel_order_contact_stay_model->join('province', 'hotel_order_contact_stay.province_id = province.id');
        $order_contact_stay = $this->hotel_order_contact_stay_model->find_by(array('hotel_order_contact_stay.order_id' => $order_id));
        
        $order_room = $this->hotel_order_room_model->find_all_by(array('order_id' => $order_id));
        
        foreach($order_room as $k => $v)
        {
            $order_room[$k] = $v;
            
            $order_room[$k]->room_info = $this->room_type_model->find($v->room_id);    
        }

        $this->data['order'] = $order;
        
        $this->data['order_contact'] = $order_contact;

        $this->data['order_contact_stay'] = $order_contact_stay;
        
        $this->data['order_room'] = $order_room;
        
        $this->data['hotel'] = $hotel;

        //  So dem
        $this->data['night'] = $night = show_day_between_date($order->date_stay_from, $order->date_stay_to);
        
        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);  
    }

    public function send_mail($order_id)
    {
        $order_id = $order_id;
        
        $order = $this->hotel_order_model->find($order_id);
        
        $hotel = $this->hotel_model->find($order->hotel_id);
        
        if(empty($order))
            redirect(base_url());

        $this->hotel_order_contact_model->select('hotel_order_contact.*, province.name as province_name');
        $this->hotel_order_contact_model->join('province', 'hotel_order_contact.province_id = province.id');
        $order_contact = $this->hotel_order_contact_model->find_by(array('hotel_order_contact.order_id' => $order_id));

        $this->hotel_order_contact_stay_model->select('hotel_order_contact_stay.*, province.name as province_name');
        $this->hotel_order_contact_stay_model->join('province', 'hotel_order_contact_stay.province_id = province.id');
        $order_contact_stay = $this->hotel_order_contact_stay_model->find_by(array('hotel_order_contact_stay.order_id' => $order_id));
        
        $order_room = $this->hotel_order_room_model->find_all_by(array('order_id' => $order_id));
        
        foreach($order_room as $k => $v)
        {
            $order_room[$k] = $v;
            
            $order_room[$k]->room_info = $this->room_type_model->find($v->room_id);    
        }

        $this->data['order'] = $order;
        
        $this->data['order_contact'] = $order_contact;

        $this->data['order_contact_stay'] = $order_contact_stay;
        
        $this->data['order_room'] = $order_room;
        
        $this->data['hotel'] = $hotel;

        //  So dem
        $this->data['night'] = $night = show_day_between_date($order->date_stay_from, $order->date_stay_to);

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
        $this->email->subject('Thông tin đặt phòng tại Azy.vn');
        $this->email->set_mailtype("html");
        $this->email->message($message_customer);
        $this->email->send();
    }
}