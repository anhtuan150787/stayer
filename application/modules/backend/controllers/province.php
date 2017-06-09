<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Province extends Backend_Controller
{

    protected $limit = 20;
    protected $model = 'province_model';

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Tỉnh/Thành';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'area_model', 'national_model', 'image_tmp_model'));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Tỉnh/Thành' => site_url() . '/backend/' . $this->data['controller'],
        );

        /*
         * Load js
         */
        $this->data['js'] = array('province.js');

        /*
         * Xoa hinh tam
         */

        $last_image_time = $this->image_tmp_model->find_all_by(array('type' => 'province', 'create_time <' => time()));

        if (!empty($last_image_time))
        {
            foreach ($last_image_time as $v)
            {
                unlink($this->config->item('pic_path') . 'tmp/' . $v->name);

                $this->image_tmp_model->delete($v->id);
            }
        }
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

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] . '/index/' . $str_param;

        $config['total_rows'] = $this->{$this->model}->where(array('deleted' => 0))->count_all();

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */
        $this->{$this->model}->select('province.*, area.name as area_name');
        $this->{$this->model}->join('area', 'province.area_id = area.id', 'left');
        $this->{$this->model}->where(array('province.deleted' => 0));
        $this->{$this->model}->order_by('province.id', 'desc');
        $records = $this->{$this->model}->limit($limit, $offset)->find_all();

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
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/add-success');
            }
        }

        /*
         * Quoc gia
         */
        $this->data['national'] = $this->national_model->where(array('deleted' => 0))->find_all();

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
         * Quoc gia
         */
        $this->data['national'] = $this->national_model->where(array('deleted' => 0))->find_all();

        /*
         * Mien
         */
        $this->data['area'] = $this->area_model->find_all_by(array('national_id' => $this->data['record']->national_id, 'deleted' => 0));

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
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('national_id', 'National', 'trim|required|xss_clean');
        $this->form_validation->set_rules('area_id', 'Area', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type', 'type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('img_name', 'Picture', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['national_id'] = $this->input->post('national_id');
        $params['area_id'] = $this->input->post('area_id');
        $params['type'] = $this->input->post('type');
        $params['status'] = $this->input->post('status');
        $params['picture'] = $this->input->post('img_name');
        $params['description'] = $this->input->post('description');

        if ($id == null)
        {
            /*
             *  Save picture
             */
            if ($params['picture'] != '')
                $this->save_image($params['picture']);

            /*
             * Add record
             */
            $this->{$this->model}->insert($params);

            return true;
        }
        else
        {
            /*
             *  Record
             */
            $record = $this->{$this->model}->find($id);

            /*
             * Save picture
             */
            if ($params['picture'] != '' && $params['picture'] != $record->picture)
            {
                $this->save_image($params['picture']);

                unlink($this->config->item('pic_path') . 'provinces/' . $record->picture);
            }

            /*
             * Update record
             */
            $this->{$this->model}->update($id, $params);

            return true;
        }
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
             *  Record
             */
            $record = $this->{$this->model}->find($v);

            /*
             * Delete
             */
            $this->{$this->model}->delete($v);

            /*
             *  Delete picture
             */
            unlink($this->config->item('pic_path') . 'provinces/' . $record->picture);
        }

        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success');
    }

    public function save_image($img_name)
    {
        $source = $this->config->item('pic_path') . 'tmp/' . $img_name;

        $des = $this->config->item('pic_path') . 'provinces/' . $img_name;

        /*
         * Copy image
         */
        $copy = copy($source, $des);

        if ($copy)
        {
            /*
             * Delete tmp database
             */
            $this->image_tmp_model->delete_where(array('name' => $img_name));

            /*
             * Delete image in tmp folder
             */
            unlink($source);
        }

        return $copy;
    }

    public function change_status_common()
    {
        /*
         * id
         */
        $id = $this->input->get('id');

        /*
         * Record info
         */
        $admin = $this->{$this->model}->find($id);

        $status = 1;

        if ($admin->common == 1)
            $status = 0;

        /*
         * Update Status
         */
        $result = $this->{$this->model}->update($id, array('common' => $status));

        echo json_encode(array('result' => $result, 'status' => $status));
    }

}
