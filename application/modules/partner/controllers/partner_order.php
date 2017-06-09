<?php

class Partner_order extends Partner_Controller
{
    public function __construct()
    {
        parent::__construct();

        /*
         * Title
         */
        $this->data['title'] = 'Đơn đặt phòng';

        /*
         * Load model
         */
        $this->load->model(array(
            'partner/hotel_order_model',
            'partner/hotel_order_contact_model',
            'partner/hotel_order_contact_stay_model',
            'partner/hotel_order_room_model',
            'partner/hotel_model',
            'partner/room_type_model',
            'partner/hotel_info_model'
        ));

        /*
         * Load js
         */
        $this->data['js'] = array('partner_order.js');

    }

    public function index()
    {
        /*
         * Search
         */
        $where = array();

        $where['hotel_order.deleted'] = 0;
        $where['hotel_order.status'] = 6;
        $where['hotel_order.paid'] = 1;
        $where['hotel.partner_id'] = $this->data['partner']['id'];

        //  Order code
        $code_search = $this->input->get('code_search');

        if ($code_search != '') {
            $where['hotel_order.order_code'] = $code_search;
        }

        //  User search
        $user_search = $this->input->get('user_search');

        if ($user_search != '') {
            $where['user.email'] = $user_search;
        }

        //  Time search
        $date_from_search = $this->input->get('date_from_search');

        $date_to_search = $this->input->get('date_to_search');

        if ($date_from_search != '') {
            $date_from_search_format = bk_format_date('Y-m-d', str_replace('/', '-', $this->input->get('date_from_search'))) . ' 00:00:00';

            $where['hotel_order.verify_time >= "' . $date_from_search_format . '"'] = NULL;
        }

        if ($date_to_search != '') {
            $date_to_search_format = bk_format_date('Y-m-d', str_replace('/', '-', $this->input->get('date_to_search'))) . ' 23:59:59';

            $where['hotel_order.verify_time <= "' . $date_to_search_format . '"'] = NULL;
        }

        $this->hotel_order_model->join('user', 'hotel_order.user_id = user.id', 'left');
        $this->hotel_order_model->join('admin', 'hotel_order.user_process = admin.id', 'left');
        $this->hotel_order_model->join('hotel', 'hotel_order.hotel_id = hotel.id', 'left');
        $count = $this->hotel_order_model->select('COUNT(hotel_order.id) as count_total, SUM(hotel_order.price_payment) as total_price, SUM(hotel_order.price_origin_payment) as total_price_origin')->find_by($where);

        $limit = 20;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination_partner');

        $config['base_url'] = site_url() . '/partner/' . $this->data['controller'] . '/index/' . $str_param;

        $config['total_rows'] = $this->data['total_rows'] = $count->count_total;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */
        $this->hotel_order_model->select('hotel_order.*, user.email as user_email, admin.username as admin_username');
        $this->hotel_order_model->join('user', 'hotel_order.user_id = user.id', 'left');
        $this->hotel_order_model->join('admin', 'hotel_order.user_process = admin.id', 'left');
        $this->hotel_order_model->join('hotel', 'hotel_order.hotel_id = hotel.id', 'left');
        $records = $this->hotel_order_model->where($where)->limit($limit, $offset)->order_by('hotel_order.id', 'desc')->find_all();

        $this->data['records'] = $records;

        /*
         *  Tong doanh thu
         */
        $this->data['price_total'] = $count->total_price;

        /*
         *  Tong tien tra cho khach san
         */
        $this->data['price_origin_total'] = $count->total_price_origin;

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function edit()
    {
        $this->my_layout->setLayout('layout/ajax');

        $id = $this->uri->segment(4);

        /*
         * Get record
         */
        $this->hotel_order_model->select('hotel_order.*, user.email as user_email');
        $this->hotel_order_model->join('user', 'hotel_order.user_id = user.id', 'left');
        $this->data['record'] = $this->hotel_order_model->find_by(array('hotel_order.id' => $id, 'hotel_order.hotel_id' => $this->data['partner']['hotel_id']));

        if (empty($this->data['record']))
            redirect(site_url() . '/backend/' . $this->data['controller'] . '/index');

        /*
         *  Get order room
         */
        $this->data['order_room'] = $this->hotel_order_room_model->find_all_by(array('order_id' => $this->data['record']->id));

        /*
         *  Thong tin nguoi nhan phong
         */
        $this->hotel_order_contact_stay_model->select('hotel_order_contact_stay.*, province.name as province_name');
        $this->hotel_order_contact_stay_model->join('province', 'hotel_order_contact_stay.province_id = province.id');
        $this->data['order_contact_stay'] = $this->hotel_order_contact_stay_model->find_by(array('hotel_order_contact_stay.order_id' => $this->data['record']->id));

        /*
         *  Hotel info
         */
        $this->hotel_order_room_model->join('hotel_info', 'hotel.id = hotel_info.hotel_id', 'left');
        $this->data['hotel'] = $this->hotel_model->find($this->data['record']->hotel_id);

        //View
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
}