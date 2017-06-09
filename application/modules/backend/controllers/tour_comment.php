<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tour_comment extends Backend_Controller
{

    protected $limit = 20;

    protected $model = 'tour_comment_model';

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Bình luận Tour';

        /*
         * Load model
         */
        $this->load->model(array($this->model));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Bình luận Tour' => site_url() . '/backend/' . $this->data['controller'],
        );
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

        /*
         * Pagination
         */
        $limit = $this->limit;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination');

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] .'/index/' . $str_param;

        $config['total_rows'] = $this->{$this->model}->where(array('deleted' => 0))->count_all();

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */
        $this->{$this->model}->select('tour_comment.*, tour.name as tour_name, user.name as member_name, user.email as member_email');
        $this->{$this->model}->join('tour', 'tour_comment.tour_id = tour.id', 'left');
        $this->{$this->model}->join('user', 'tour_comment.user_id = user.id', 'left');
        $this->{$this->model}->where(array('tour_comment.deleted' => 0));
        $this->{$this->model}->limit($limit, $offset);
        $this->{$this->model}->order_by('id', 'desc');
        $records = $this->{$this->model}->find_all();

        $this->data['records'] = $records;

        /*
         * View
         */
        $this->my_layout->view(strtolower(__CLASS__) . '/' . __FUNCTION__, $this->data);
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
