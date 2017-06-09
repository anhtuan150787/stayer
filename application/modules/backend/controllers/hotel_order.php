<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel_order extends Backend_Controller
{

    protected $limit = 20;

    protected $model = 'hotel_order_model';

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Quản lý đơn hàng';

        /*
         * Load model
         */
        $this->load->model(array(
            $this->model,
            'hotel_order_contact_model',
            'hotel_order_contact_stay_model',
            'hotel_order_room_model',
            'hotel_model',
            'room_type_model',
            'hotel_info_model',
            'admin_model',
        ));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Quản lý đơn hàng' => site_url() . '/backend/' . $this->data['controller'],
        );

        /*
         * Load js
         */
        $this->data['js'] = array('hotel_order.js');

        /*
         *  Trang thai
         */
        if ($this->data['admin']['group_id'] == 6)  //Xu ly khach san
        {
            $this->data['status'] = array(
                '3' => 'Đang xử lý',
                '4' => 'Thất bại',
                '5' => 'Chờ duyệt',
            );
        } else if ($this->data['admin']['group_id'] == 8) //Ke toan
        {
            $this->data['status'] = array(
                '5' => 'Chờ duyệt',
                '6' => 'Thành công',
                '7' => 'Hủy',
            );
        } else {
            $this->data['status'] = list_status_order();
        }
    }

    public function index()
    {
        /*
         * Show Mesg
         */
        if ($this->uri->segment(4) == 'edit-success')
            $this->data['success'] = 'Cập nhật thành công.';

        if ($this->uri->segment(4) == 'change-user-process-success')
            $this->data['success'] = 'Chuyển đơn hàng thành công.';

        if ($this->uri->segment(4) == 'change-user-process-error')
            $this->data['error'] = 'Đơn hàng này đã được xử lý trước đó.';

        if ($this->uri->segment(4) == 'user-order-process-error')
            $this->data['error'] = 'Không có quyền truy cập vào đơn hàng này.';

        $action_export = $this->input->get('btn_action_export');

        /*
         * Search
         */
        $where = array();

        $where['hotel_order.deleted'] = 0;

        if ($this->data['admin']['group_id'] == 6)  //Xu ly don hang
            $where['hotel_order.user_process'] = $this->data['admin']['id'];

        if ($this->data['admin']['group_id'] == 8)  //Ke toan
            $where['(hotel_order.status = 5 || hotel_order.status = 6 || hotel_order.status = 7)'] = NULL;


        //  Order code
        $code_search = $this->input->get('code_search');

        if ($code_search != '') {
            $where['hotel_order.order_code'] = $code_search;
        }

        //  Status search
        $status_search = $this->input->get('status_search');

        if ($status_search != '') {
            $where['hotel_order.status'] = $status_search;
        }

        //  User search
        $user_search = $this->input->get('user_search');

        if ($user_search != '') {
            $where['user.email'] = $user_search;
        }

        //  Admin search
        $admin_search = $this->input->get('admin_search');

        if ($admin_search != '') {
            $where['admin.username'] = $admin_search;
        }

        //  Paid search
        $paid_search = $this->input->get('paid_search');

        if ($paid_search != '') {
            $where['hotel_order.paid'] = $paid_search;
        }

        // deposit_partner_confirm_search
        $deposit_partner_confirm_search = $this->input->get('deposit_partner_confirm_search');

        if ($deposit_partner_confirm_search != '') {
            $where['deposit_partner_confirm'] = $deposit_partner_confirm_search;
        }

        //  Time search
        $date_from_search = $this->input->get('date_from_search');

        $date_to_search = $this->input->get('date_to_search');

        if ($date_from_search != '') {
            $date_from_search_format = bk_format_date('Y-m-d', str_replace('/', '-', $this->input->get('date_from_search'))) . ' 00:00:00';

            $where['hotel_order.create_time >= "' . $date_from_search_format . '"'] = NULL;
        }

        if ($date_to_search != '') {
            $date_to_search_format = bk_format_date('Y-m-d', str_replace('/', '-', $this->input->get('date_to_search'))) . ' 23:59:59';

            $where['hotel_order.create_time <= "' . $date_to_search_format . '"'] = NULL;
        }

        //  hotel name search
        $hotel_name_search = $this->input->get('hotel_name_search');

        if ($hotel_name_search != '') {
            $where['hotel.name LIKE "%' . $hotel_name_search . '%"'] = NULL;
        }

        /*
         * Pagination
         */

        $this->{$this->model}->join('user', 'hotel_order.user_id = user.id', 'left');
        $this->{$this->model}->join('admin', 'hotel_order.user_process = admin.id', 'left');
        $this->{$this->model}->join('hotel', 'hotel_order.hotel_id = hotel.id', 'left');
        $count = $this->{$this->model}->select('COUNT(hotel_order.id) as count_total, SUM(hotel_order.price_payment) as total_price, SUM(hotel_order.price_origin_payment) as total_price_origin')->find_by($where);

        $limit = $this->limit;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination');

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] . '/index/' . $str_param;

        $config['total_rows'] = $this->data['total_rows'] = $count->count_total;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */

        $this->{$this->model}->select('hotel_order.*, user.email as user_email, admin.username as admin_username');
        $this->{$this->model}->join('user', 'hotel_order.user_id = user.id', 'left');
        $this->{$this->model}->join('admin', 'hotel_order.user_process = admin.id', 'left');
        $this->{$this->model}->join('hotel', 'hotel_order.hotel_id = hotel.id', 'left');

        if ($action_export != '') {

            $records = $this->{$this->model}->where($where)->order_by('hotel_order.id', 'desc')->find_all();

            $this->export_excel($records);

            return;
        } else {
            $records = $this->{$this->model}->where($where)->limit($limit, $offset)->order_by('hotel_order.id', 'desc')->find_all();
        }

        $this->data['records'] = $records;

        /*
         *  Tong doanh thu
         */
        $this->data['price_total'] = $count->total_price;

        /*
         *  Tong tien tra cho khach san
         */
        $this->data['price_origin_total'] = $count->total_price_origin;

        /*
         *  Tong so don hang dang cho xu ly
         */
        if ($this->data['admin']['group_id'] == 6)  //Xu ly don hang
            $this->data['order_wait_process'] = $this->hotel_order_model->where(array('status' => 2))->count_all();

        /*
         * Danh sach user xu ly don hang
         */
        $this->data['user_process'] = $this->admin_model->find_all_by(array('deleted' => 0, 'group_id' => 6));

        /*
         * Dem tong tinh trang thanh toan
         */
        $this->data['paid_count'] = $this->getCountPaidStatus();

        /*
         *  Dem tong trang thai
         */
        $this->data['status_count'] = $this->getCountStatus();

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function add()
    {
        $user_id = $this->data['admin']['id'];

        /*
         * Action name
         */
        $this->data['action_name'] = 'Lấy đơn hàng';

        /*
         *  Kiem tra user con don hang nao dang xu ly ko
         */
        $order_process = $this->{$this->model}->select('COUNT(id) as num')->find_by(array('status' => '3', 'user_process' => $user_id));

        if ($order_process->num == 0) {
            /*
             *  Query don hang co trang thai cho xu ly co thoi gian gan nhat
             */
            $order = $this->{$this->model}->order_by('create_time', 'asc')->find_by(array('status' => '2'));

            /*
             *  Gan user xu ly cho don hang nay, chuyen thanh trang thai dang xu ly
             */

            $data_update = array();
            $data_update['user_process'] = $user_id;
            $data_update['status'] = '3';
            $data_update['process_start_time'] = date('Y-m-d H:i:s');

            $this->{$this->model}->update($order->id, $data_update);
        }

        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index');

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/form', $this->data);
    }

    public function edit()
    {
        /*
         * Action name
         */
        $this->data['action_name'] = 'Cập nhật';

        $id = $this->uri->segment(4);

        /*
         * Kiem tra don hang nay co phai la cua user khong
         */
        if ($this->data['admin']['group_id'] == 6) {
            $order_of_user = $this->{$this->model}->find_by(array('id' => $id, 'user_process' => $this->data['admin']['id']));
            if (empty($order_of_user))
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/user-order-process-error');
        }
        /*
         * Get record
         */
        $where = array();
        $where['hotel_order.id'] = $id;

        if ($this->data['admin']['group_id'] == 6)
            $where['hotel_order.user_process'] = $this->data['admin'];

        $this->{$this->model}->select('hotel_order.*, user.email as user_email');
        $this->{$this->model}->join('user', 'hotel_order.user_id = user.id', 'left');
        $this->data['record'] = $this->{$this->model}->find_by(array('hotel_order.id' => $id));

        if (empty($this->data['record']))
            redirect(site_url() . '/backend/' . $this->data['controller'] . '/index');

        /*
         * Submit update
         */
        if ($this->input->post()) {
            if ($this->save($id)) {
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/edit-success');
            }
        }

        /*
         *  Get order room
         */
        $this->data['order_room'] = $this->hotel_order_room_model->find_all_by(array('order_id' => $this->data['record']->id));

        /*
         *  Thong tin nguoi dat phong
         */
        $this->hotel_order_contact_model->select('hotel_order_contact.*, province.name as province_name');
        $this->hotel_order_contact_model->join('province', 'hotel_order_contact.province_id = province.id');
        $this->data['order_contact'] = $this->hotel_order_contact_model->find_by(array('hotel_order_contact.order_id' => $this->data['record']->id));

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

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/form', $this->data);
    }

    public function save($id = null)
    {
        /*
         * Validate
         */
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('paid', 'Paid', 'trim|xss_clean');
        $this->form_validation->set_rules('note', 'Note', 'trim|xss_clean');
        $this->form_validation->set_rules('deposit', 'Deposit', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->data['error'] = validation_errors();

            return false;
        }

        /*
         *  Kiem tra status co hop le voi user
         */
        if (!isset($this->data['status'][$this->input->post('status')]))
            redirect(site_url() . '/backend/' . $this->data['controller'] . '/index');

        $params = array();
        $params['status'] = $this->input->post('status');
        $params['note'] = $this->input->post('note');
        $params['update_time'] = date('Y-m-d H:i:s');

        if ($this->data['admin']['group_id'] == 6)  //Xu ly don hang
        {
            $params['user_process'] = $this->data['admin']['id'];
            $params['process_finish_time'] = date('Y-m-d H:i:s');
        }

        if ($this->data['admin']['group_id'] == 8)  //Ke toan
        {
            $params['user_verify'] = $this->data['admin']['id'];
            $params['verify_time'] = date('Y-m-d H:i:s');
        }

        if ($this->data['admin']['group_id'] != 6) {
            $params['paid'] = $this->input->post('paid');
            $params['deposit'] = ($params['paid'] == 2) ? str_replace('.', '', $this->input->post('deposit')) : '';
            $params['payment_type'] = $this->input->post('payment_type');

            $params['deposit_partner_confirm'] = $this->input->post('deposit_partner_confirm');
            $params['deposit_partner_money'] = str_replace('.', '',$this->input->post('deposit_partner_money'));
        }
        /*
         * Update record
         */
        $where = array();
        $where['id'] = $id;

        if ($this->data['admin']['group_id'] == 6)  //Xu ly don hang
            $where['user_process'] = $this->data['admin']['id'];

        $this->{$this->model}->update_where($where, $params);

        /*
         *  Send mail
         */
        if ($this->input->post('send_mail') && $this->input->post('send_mail') == 1) {
            $this->send_mail($id);
        }

        return true;
    }

    public function send_mail($order_id)
    {
        $order_id = $order_id;

        $order = $this->hotel_order_model->find($order_id);

        $hotel = $this->hotel_model->find($order->hotel_id);

        if (empty($order))
            redirect(base_url());

        $this->hotel_order_contact_model->select('hotel_order_contact.*, province.name as province_name');
        $this->hotel_order_contact_model->join('province', 'hotel_order_contact.province_id = province.id');
        $order_contact = $this->hotel_order_contact_model->find_by(array('hotel_order_contact.order_id' => $order_id));

        $this->hotel_order_contact_stay_model->select('hotel_order_contact_stay.*, province.name as province_name');
        $this->hotel_order_contact_stay_model->join('province', 'hotel_order_contact_stay.province_id = province.id');
        $order_contact_stay = $this->hotel_order_contact_stay_model->find_by(array('hotel_order_contact_stay.order_id' => $order_id));

        $order_room = $this->hotel_order_room_model->find_all_by(array('order_id' => $order_id));

        foreach ($order_room as $k => $v) {
            $order_room[$k] = $v;

            $order_room[$k]->room_info = $this->room_type_model->find($v->room_id);
        }

        //  Thong tin lien he khach sang
        $hotel_info = $this->hotel_info_model->find_by(array('hotel_id' => $order->hotel_id));

        $this->data['order'] = $order;

        $this->data['order_contact'] = $order_contact;

        $this->data['order_contact_stay'] = $order_contact_stay;

        $this->data['order_room'] = $order_room;

        $this->data['hotel'] = $hotel;

        //  So dem
        $this->data['night'] = $night = show_day_between_date($order->date_stay_from, $order->date_stay_to);

        // Hash auth pdf order
        $this->data['hash_auth'] = hash_auth_pdf_order_hotel($order_contact->email, $order->hotel_id, $order->id);

        /*
         *  Load send mail library
         */
        $message_customer = $this->load->view(strtolower(__CLASS__) . '/customer_email_template_success', $this->data, true);

        $message_partner = $this->load->view(strtolower(__CLASS__) . '/partner_email_template_success', $this->data, true);

        $config_mail = $this->config->item('sendmail');

        /*
         *  Set up send mail
         */
        $this->load->library('email', $config_mail);

        //Send mail cho khach hang
        $this->email->set_newline("\r\n");
        $this->email->from($config_mail['smtp_user'], $config_mail['from_name']);
        $this->email->to($order_contact->email);
        $this->email->subject('Đặt phòng thành công tại Azy.vn');
        $this->email->set_mailtype("html");
        $this->email->message($message_customer);
        $this->email->send();

        //Send mail cho khach san
        $this->email->set_newline("\r\n");
        $this->email->from($config_mail['smtp_user'], $config_mail['from_name']);
        $this->email->to($hotel_info->booking_email);
        $this->email->subject('Đặt phòng thành công tại Azy.vn');
        $this->email->set_mailtype("html");
        $this->email->message($message_partner);
        $this->email->send();
    }

    function change_user_process()
    {
        $order_id = $this->input->get('order');
        $user_id = $this->input->get('user');

        /*
         * Kiem tra don hang nay da dc xu ly chua
         */
        $order = $this->hotel_order_model->find($order_id);

        if ($order->status == 2 || $order->status == 3) {
            $this->hotel_order_model->update($order_id, array('user_process' => $user_id, 'status' => 3));

            redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/change-user-process-success');
        } else {
            redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/change-user-process-error');
        }
    }

    public function export_excel($records)
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=data.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $html = '<meta charset="utf-8" />
        <table>
            <thead>
            <tr>
                <td>Mã đơn hàng</td>
                <td>Khách sạn</td>
                <td>Tài khoản đặt</td>
                <td>Thời gian đặt</td>
                <td>Giá gốc</td>
                <td>Giá</td>
                <td>User xử lý</td>
                <td>Tình trạng</td>
                <td>Trạng thái</td>
            </tr>
            </thead>
            <tbody>';

        foreach ($records as $v) {
            $html .= '<tr>
                    <td>\'' . html_escape($v->order_code) . '</td>
                    <td>\'' . html_escape($v->hotel_name) . '</td>
                    <td>\'' . (($v->user_email) ? html_escape($v->user_email) : 'Khách') . '</td>
                    <td>\'' . bk_format_date('d/m/Y', $v->create_time) . '</td>
                    <td>' . $v->price_origin_payment . '</td>
                    <td>' . $v->price_payment . '</td>
                    <td>\'' . html_escape($v->admin_username) . '</td>
                    <td>' .  show_paid($v->paid) . ' ' . (($v->paid == 2) ? '<br>' . show_price_bk($v->deposit) : '') . '</td>
                    <td>' . show_status_order($v->status) . '</td>
                </tr>';
        }
        $html .= '</tbody></table>';
        echo $html;
    }

    public function getCountPaidStatus(){
        $paids = array();
        $paids[0] = $this->hotel_order_model->count_by('paid', 0);
        $paids[1] = $this->hotel_order_model->count_by('paid', 1);
        $paids[2] = $this->hotel_order_model->count_by('paid', 2);

        return $paids;
    }

    public function getCountStatus() {
        $status = array();
        $status[2] = $this->hotel_order_model->count_by('status', 2); //Cho xu ly
        $status[3] = $this->hotel_order_model->count_by('status', 3); //Dang xu ly
        $status[5] = $this->hotel_order_model->count_by('status', 5); //Cho duyet
        $status[6] = $this->hotel_order_model->count_by('status', 6); //Thanh cong
        $status[4] = $this->hotel_order_model->count_by('status', 4); //That bai
        $status[7] = $this->hotel_order_model->count_by('status', 7); //Huy

        return $status;
    }

    public function delay_order_cancel() {

        $order_id = $this->input->get('order_id');
        $time = $this->input->get('time');

        $this->{$this->model}->update($order_id, array('time_cancel' => date('Y-m-d H:i:s', strtotime('+24 hours', strtotime($time)))));
        echo '<script>window.history.back();</script>';
        exit();
    }
}
