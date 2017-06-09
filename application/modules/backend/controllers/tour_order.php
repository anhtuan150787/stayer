<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tour_order extends Backend_Controller
{

    protected $limit = 20;

    protected $model = 'tour_order_model';

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
            'tour_order_contact_model',
            'tour_model',
            'admin_model',
            'province_model',
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
        $this->data['js'] = array('tour_order.js');

        /*
         *  Trang thai
         */
        if ($this->data['admin']['group_id'] == 9)  //Xu ly
        {
            $this->data['status'] = array(
                '3' =>  'Đang xử lý',
                '4' =>  'Thất bại',
                '5' =>  'Chờ duyệt',
            );
        }
        else if ($this->data['admin']['group_id'] == 8) //Ke toan
        {
            $this->data['status'] = array(
                '5' =>  'Chờ duyệt',
                '6' =>  'Thành công',
                '7' =>  'Hủy',
            );
        }
        else
        {
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

        /*
         * Search
         */
        $where = array();

        $where['tour_order.deleted'] = 0;

        if ($this->data['admin']['group_id'] == 9)  //Xu ly don hang
            $where['tour_order.user_process'] = $this->data['admin']['id'];

        if ($this->data['admin']['group_id'] == 8)  //Ke toan
            $where['(tour_order.status = 5 || tour_order.status = 6 || tour_order.status = 7)'] = NULL;


        //  Order code
        $code_search = $this->input->get('code_search');

        if ($code_search != '')
        {
            $where['tour_order.order_code'] = $code_search;
        }

        //  Status search
        $status_search = $this->input->get('status_search');

        if ($status_search != '')
        {
            $where['tour_order.status'] = $status_search;
        }

        //  User search
        $user_search = $this->input->get('user_search');

        if ($user_search != '')
        {
            $where['user.email'] = $user_search;
        }

        //  Admin search
        $admin_search = $this->input->get('admin_search');

        if ($admin_search != '')
        {
            $where['admin.username'] = $admin_search;
        }

        //  Paid search
        $paid_search = $this->input->get('paid_search');

        if ($paid_search != '')
        {
            $where['tour_order.paid'] = $paid_search;
        }

        //  Time search
        $date_from_search = $this->input->get('date_from_search');

        $date_to_search = $this->input->get('date_to_search');

        if ($date_from_search != '')
        {
            $date_from_search_format = bk_format_date('Y-m-d', str_replace('/', '-', $this->input->get('date_from_search'))) . ' 00:00:00';

            $where['tour_order.create_time >= "' . $date_from_search_format .'"'] = NULL;
        }

        if ($date_to_search != '')
        {
            $date_to_search_format = bk_format_date('Y-m-d', str_replace('/', '-', $this->input->get('date_to_search'))) . ' 23:59:59';

            $where['tour_order.create_time <= "' . $date_to_search_format.'"'] = NULL;
        }

        //  hotel name search
        $tour_name_search = $this->input->get('tour_name_search');

        if ($tour_name_search != '')
        {
            $where['tour.name LIKE "%' . $tour_name_search . '%"'] = NULL;
        }

        /*
         * Pagination
         */

        $this->{$this->model}->join('user', 'tour_order.user_id = user.id', 'left');
        $this->{$this->model}->join('admin', 'tour_order.user_process = admin.id', 'left');
        $this->{$this->model}->join('tour', 'tour_order.tour_id = tour.id', 'left');

        $count = $this->{$this->model}->select('COUNT(tour_order.id) as count_total, SUM(tour_order.price_payment) as total_price')->find_by($where);

        $limit = $this->limit;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination');

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] .'/index/' . $str_param;

        $config['total_rows'] = $this->data['total_rows'] = $count->count_total;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */
        $this->{$this->model}->select('tour_order.*, user.email as user_email, admin.username as admin_username');
        $this->{$this->model}->join('user', 'tour_order.user_id = user.id', 'left');
        $this->{$this->model}->join('admin', 'tour_order.user_process = admin.id', 'left');
        $this->{$this->model}->join('tour', 'tour_order.tour_id = tour.id', 'left');
        $records = $this->{$this->model}->where($where)->limit($limit, $offset)->order_by('tour_order.id', 'desc')->find_all();

        $this->data['records'] = $records;

        /*
         *  Tong doanh thu
         */
        $this->data['price_total'] = $count->total_price;

        /*
         *  Tong so don hang dang cho xu ly
         */
        if ($this->data['admin']['group_id'] == 9)  //Xu ly don hang
            $this->data['order_wait_process'] = $this->tour_order_model->where(array('status' => 2))->count_all();

        /*
         * Danh sach user xu ly don hang
         */
        $this->data['user_process'] = $this->admin_model->find_all_by(array('deleted' => 0, 'group_id' => 6));

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

        if ($order_process->num == 0)
        {
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
        if ($this->data['admin']['group_id'] == 6)
        {
            $order_of_user = $this->{$this->model}->find_by(array('id' => $id, 'user_process' => $this->data['admin']['id']));
            if (empty($order_of_user))
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/user-order-process-error');
        }
        /*
         * Get record
         */
        $where = array();
        $where['tour_order.id'] = $id;

        if ($this->data['admin']['group_id'] == 6)
            $where['tour_order.user_process'] = $this->data['admin'];

        $this->{$this->model}->select('tour_order.*, user.email as user_email');
        $this->{$this->model}->join('user', 'tour_order.user_id = user.id', 'left');
        $this->data['record'] = $this->{$this->model}->find_by(array('tour_order.id' => $id));

        if (empty($this->data['record']))
            redirect(site_url() . '/backend/' . $this->data['controller'] . '/index');

        /*
         * Submit update
         */
        if ($this->input->post())
        {
            if ($this->save($id))
            {
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/edit-success');
            }
        }

        /*
         *  Get order detail
         */
        $this->data['order_detail'] = unserialize($this->data['record']->content_tour);
        $this->data['order_detail'] = (object) $this->data['order_detail'];

        /*
         *  Thong tin nguoi dat phong
         */
        $this->tour_order_contact_model->select('tour_order_contact.*, province.name as province_name');
        $this->tour_order_contact_model->join('province', 'tour_order_contact.province_id = province.id');
        $this->data['order_contact'] = $this->tour_order_contact_model->find_by(array('tour_order_contact.order_id' => $this->data['record']->id));

        /*
         *  Tour info
         */
        $this->data['tour'] = $this->tour_model->find($this->data['record']->tour_id);

        $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
        $province_data = array();
        foreach($province as $k => $v)
            $province_data[$v->id] = $v;

        $this->data['province_booking_tour'] = $province_data;

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

        if ($this->form_validation->run() == FALSE)
        {
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

        if ($this->data['admin']['group_id'] == 9)  //Xu ly don hang
        {
            $params['user_process'] = $this->data['admin']['id'];
            $params['process_finish_time'] = date('Y-m-d H:i:s');
        }

        if ($this->data['admin']['group_id'] == 8)  //Ke toan
        {
            $params['user_verify'] = $this->data['admin']['id'];
            $params['verify_time'] = date('Y-m-d H:i:s');
        }

        if ($this->data['admin']['group_id'] != 9)
        {
            $params['paid'] = $this->input->post('paid');
            $params['payment_type'] = $this->input->post('payment_type');
        }
        /*
         * Update record
         */
        $where = array();
        $where['id'] = $id;

        if ($this->data['admin']['group_id'] == 9)  //Xu ly don hang
            $where['user_process'] = $this->data['admin']['id'];

        $this->{$this->model}->update_where($where, $params);

        /*
         *  Send mail
         */
        if ($this->input->post('send_mail') && $this->input->post('send_mail') == 1)
        {
            $this->send_mail($id);
        }

        return true;
    }

    public function send_mail($order_id)
    {
        $order_id = $order_id;

        $order = $this->tour_order_model->find($order_id);

        $tour = $this->tour_model->find($order->tour_id);

        $order_detail = unserialize($order->content_tour);
        $order_detail = (object) $order_detail;

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

        $this->data['order_contact'] = $order_contact;

        $this->data['tour'] = $tour;

        $this->data['order_detail'] = $order_detail;

        // Hash auth pdf order
        $this->data['hash_auth'] = hash_auth_pdf_order_tour($order_contact->email, $order->tour_id, $order->id);

        /*
         *  Load send mail library
         */
        $message_customer = $this->load->view(strtolower(__CLASS__) . '/customer_email_template_success', $this->data , true);

        $config_mail = $this->config->item('sendmail');

        /*
         *  Set up send mail
         */
        $this->load->library('email', $config_mail);

        //Send mail cho khach hang
        $this->email->set_newline("\r\n");
        $this->email->from($config_mail['smtp_user'], $config_mail['from_name']);
        $this->email->to($order_contact->email);
        $this->email->subject('Đặt tour thành công tại Azy.vn');
        $this->email->set_mailtype("html");
        $this->email->message($message_customer);
        $this->email->send();
    }

    function change_user_process()
    {
        $order_id = $this->input->get('order');
        $user_id = $this->input->get('user');

        /*
         * Kiem tra don hang nay da dc xu ly chua
         */
        $order = $this->tour_order_model->find($order_id);

        if ($order->status == 2 || $order->status == 3)
        {
            $this->tour_order_model->update($order_id, array('user_process' => $user_id, 'status' => 3));

            redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/change-user-process-success');
        }
        else
        {
            redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/change-user-process-error');
        }
    }
}
