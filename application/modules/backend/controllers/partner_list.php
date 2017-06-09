<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partner_list extends Backend_Controller
{

    protected $limit = 20;
    protected $model = 'partner_model';

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Đối tác';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'hotel_model', 'partner_group_model'));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Đối tác' => site_url() . '/backend/' . $this->data['controller'],
        );

        /*
         * Load js
         */
        $this->data['js'] = array('partner.js');
    }

    public function index()
    {
        /*
         * Search
         */
        $where = array();

        //Keyword
        $keyword_search = $this->input->get('keyword_search');

        if ($keyword_search != '')
        {
            $where['(partner.username like "%' . $keyword_search . '%" OR partner.email like "%' . $keyword_search . '%" OR partner.name like "%' . $keyword_search . '%")'] = NULL;
        }

        //Loai khach san
        $status_search = $this->input->get('status_search');

        if ($status_search != '')
        {
            $where['partner.status'] = $status_search;
        }

        /*
         * Pagination
         */
        $this->{$this->model}->select('partner.*, partner_group.name as group_name');
        $this->{$this->model}->join('partner_group', 'partner.group_id=partner_group.id');
        $total_rows = $this->{$this->model}->where($where)->count_all();

        $limit = $this->limit;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination');

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] . '/index/' . $str_param;

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */
        $this->{$this->model}->select('partner.*, partner_group.name as group_name');
        $this->{$this->model}->join('partner_group', 'partner.group_id=partner_group.id');
        $records = $this->{$this->model}->where($where)->limit($limit, $offset)->find_all();

        $this->data['records'] = $records;

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
    }
}
