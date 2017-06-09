<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupon extends Backend_Controller
{

    protected $limit = 20;

    protected $model = 'coupon_model';

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Mã giảm giá';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'coupon_group_model'));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Mã giảm giá' => site_url() . '/backend/' . $this->data['controller'],
        );

        /*
         * Load js
         */
        $this->data['js'] = array('coupon.js');
    }

    public function index()
    {
        /*
         * Show Mesg
         */
        if ($this->uri->segment(4) == 'add-success')
            $this->data['success'] = 'Tạo mới thành công.';

        if ($this->uri->segment(4) == 'edit-success')
            $this->data['success'] = 'Cập nhật thành công.';

        if ($this->uri->segment(4) == 'delete-success')
            $this->data['success'] = 'Xóa thành công.';

        $where = array();

        //Keyword
        $keyword_search = $this->input->get('keyword_search');

        if ($keyword_search != '')
        {
            $where['(coupon.code = "' . $keyword_search . '")'] = NULL;
        }

        $where['coupon.deleted'] = 0;

        /*
         * Pagination
         */
        $this->{$this->model}->join('coupon_group', 'coupon.group = coupon_group.id', 'left');
        $total_rows = $this->{$this->model}->where($where)->count_all();


        $limit = $this->limit;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination');

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] .'/index/' . $str_param;

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */
        $this->{$this->model}->select('coupon.*, coupon_group.name as group_name, admin.username as username');
        $this->{$this->model}->join('coupon_group', 'coupon.group = coupon_group.id', 'left');
        $this->{$this->model}->join('admin', 'coupon.user = admin.id', 'left');
        $this->{$this->model}->where($where);
        $records = $this->{$this->model}->limit($limit, $offset)->order_by('id', 'desc')->find_all();

        $this->data['records'] = $records;

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }

    public function add()
    {
        /*
         * Action name
         */
        $this->data['action_name'] = 'Tạo mới';

        /*
         * Submit update
         */
        if ($this->input->post())
        {
            if ($this->save())
            {
                redirect(site_url() . '/backend/' . $this->data['controller'] .'/index/add-success');
            }
        }

        /*
         * Nhom ma
         */
        $this->data['group'] = $this->coupon_group_model->find_all();

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
         * Get record
         */
        $this->data['record'] = $this->{$this->model}->find($id);

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/form', $this->data);
    }

    public function save($id = null)
    {
        $num    = $this->input->post('num');
        $group  = $this->input->post('group');

        for($t = 1; $t <= $num; $t++) {
            /*
            * Add record
            */
            $insert_id = $this->{$this->model}->insert(array(
                'group' => $group,
                'status' => 1,
                'create_time' => date('Y-m-d H:i:s'),
                'user' => $this->data['admin']['id'],
            ));

            //  Update order code
            $code = strtoupper(substr(str_shuffle('zxcvbnmasdfghjklqwertyuiop'), 0, 2) . $group . substr(time(), -3) . $insert_id);

            $this->{$this->model}->update($insert_id, array('code' => $code));
        }

        return true;
    }

    public function delete()
    {
        $data = array();

        if ($this->input->post())
            $data = $this->input->post('check_item');
        else
            $data = array($this->uri->segment(4));

        foreach ($data as $v)
        {
            /*
             * Delete
             */
            $this->{$this->model}->delete($v);
        }

        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success');
    }
}
