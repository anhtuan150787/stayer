<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tour extends Backend_Controller
{

    protected $limit = 20;
    protected $model = 'tour_model';
    protected $status = array();

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Tour';

        /*
         * Load model
         */
        $this->load->model(array(
            $this->model, 'image_tmp_model',
            'partner_tour_model', 'tour_image_model',
            'national_model', 'area_model',
            'province_model', 'tour_service_model',
            'tour_topic_model',
        ));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Tour' => site_url() . '/backend/' . $this->data['controller'],
        );

        /*
         * Load js
         */
        $this->data['js'] = array('tour.js');

        /*
         * Xoa hinh tam
         */
        $last_image_time = $this->image_tmp_model->find_all_by(array('type' => 'tour', 'create_time <' => time()));

        if (!empty($last_image_time))
        {
            foreach ($last_image_time as $v)
            {
                if (is_file($this->config->item('pic_path') . 'tmp/' . $v->name))
                {
                    unlink($this->config->item('pic_path') . 'tmp/' . $v->name);

                    $this->image_tmp_model->delete($v->id);
                }
            }
        }

        /*
         *  Trang thai khach san
         */
        $this->data['status'] = $this->status = array(
            '0' => 'Ẩn',
            '1' => 'Hiển thị',
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
         * Search
         */
        $where = array();

        //Keyword
        $keyword_search = $this->input->get('keyword_search');

        if ($keyword_search != '')
        {
            $where['(tour.name like "%' . $keyword_search . '%")'] = NULL;
        }

        $where['tour.deleted'] = 0;

        /*
         * Pagination
         */
        $total_rows = $this->{$this->model}->where($where)->count_all();

        $limit = $this->limit;

        $offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $str_param = $this->get_params_url();

        $config = $this->config->item('pagination');

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] . '/index/' . $str_param;

        $config['total_rows'] = $this->data['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */

        $this->{$this->model}->select('tour.*');
        $this->{$this->model}->where($where);
        $this->{$this->model}->order_by('tour.id', 'desc');
        $this->{$this->model}->limit($limit, $offset);
        $records = $this->{$this->model}->find_all();

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
         * Nha cung cap
         */
        $this->data['partner_tour'] = $this->partner_tour_model->where(array('deleted' => 0))->find_all();

        /*
         * Quoc gia
         */
        $this->data['from_national'] = $this->data['to_national']= $this->national_model->where(array('deleted' => 0))->find_all();

        /*
         * Chu de
         */
        $this->data['topic'] = $this->tour_topic_model->where(array('deleted' => 0))->find_all();

        /*
         * Dich vu
         */
        $this->data['service'] = $this->tour_service_model->where(array('deleted' => 0))->find_all();

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
         * Nha cung cap
         */
        $this->data['partner_tour'] = $this->partner_tour_model->where(array('deleted' => 0))->find_all();

        /*
         * Hinh anh
         */
        $this->data['pictures'] = $this->tour_image_model->find_all_by(array('tour_id' => $id));

        /*
         * Quoc gia
         */
        $this->data['from_national'] = $this->data['to_national'] = $this->national_model->where(array('deleted' => 0))->find_all();

        /*
         * Mien
         */
        $this->data['from_area'] = $this->area_model->find_all_by(array('national_id' => $this->data['record']->from_national_id, 'deleted' => 0));
        $this->data['to_area'] = $this->area_model->find_all_by(array('national_id' => $this->data['record']->to_national_id, 'deleted' => 0));

        /*
         * Tinh/Thanh
         */
        $this->data['from_province'] = $this->province_model->find_all_by(array('area_id' => $this->data['record']->from_area_id, 'deleted' => 0));
        $this->data['to_province'] = $this->province_model->find_all_by(array('area_id' => $this->data['record']->to_area_id, 'deleted' => 0));

        /*
         * Chu de
         */
        $this->data['topic'] = $this->tour_topic_model->where(array('deleted' => 0))->find_all();

        /*
         * Dich vu
         */
        $this->data['service'] = $this->tour_service_model->where(array('deleted' => 0))->find_all();

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
        $this->form_validation->set_rules('partner_tour_id', 'Partner', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('from_national_id', 'National From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('from_area_id', 'Area From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('from_province_id', 'Province From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_national_id', 'National To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_area_id', 'Area To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_province_id', 'Province To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('keyword', 'Keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('description_meta', 'Description_meta', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name']             = $this->input->post('name');
        $params['partner_tour_id']  = $this->input->post('partner_tour_id');
        $params['status']           = $this->input->post('status');
        $params['update_by']        = $this->data['admin']['username'];
        $params['picture']          = $this->input->post('img_name');
        $params['description']      = $this->input->post('description');
        $params['policy']           = $this->input->post('policy');
        $params['from_national_id'] = $this->input->post('from_national_id');
        $params['from_area_id']     = $this->input->post('from_area_id');
        $params['from_province_id'] = $this->input->post('from_province_id');
        $params['to_national_id']   = $this->input->post('to_national_id');
        $params['to_area_id']       = $this->input->post('to_area_id');
        $params['to_province_id']   = $this->input->post('to_province_id');
        $params['start_date']       = $this->input->post('start_date');
        $params['time']             = $this->input->post('time');
        $params['transportation']   = $this->input->post('transportation');
        $params['price_description']   = $this->input->post('price_description');
        $params['price']            = str_replace('.', '', $this->input->post('price'));
        $params['topic_id']         = ',' . implode(',', $this->input->post('topic_id')) . ',';
        $params['service_id']       = ',' . implode(',', $this->input->post('service_id')) . ',';
        $params['hide_provider']             = $this->input->post('hide_provider');
        $params['keyword']             = $this->input->post('keyword');
        $params['description_meta']             = $this->input->post('description_meta');

        if ($this->input->post('daily') == 1)
            $params['start_date'] = $this->input->post('daily');

        if ($id == null)
        {
            //User create
            $params['user_id'] = $this->data['admin']['id'];

            //Create time
            $params['create_time'] = date('Y-m-d H:i:s');
            $params['update_time'] = date('Y-m-d H:i:s');

            /*
             *  Save picture
             */
            if ($params['picture'] != '')
                $this->save_image($params['picture']);

            /*
             * Add record
             */
            $id = $this->{$this->model}->insert($params);
        }
        else
        {
            //Update time
            $params['update_time'] = date('Y-m-d H:i:s');

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

                unlink($this->config->item('pic_path') . 'hotels/' . $record->picture);
            }

            /*
             * Update record
             */
            $this->{$this->model}->update($id, $params);
        }

        /*
         * Xu ly upload picture list
         */
        $picture_upload = $this->input->post('picture_upload');

        if (!empty($picture_upload))
        {
            $data_insert_pic = array();

            foreach ($picture_upload as $v)
            {
                $data_insert_pic[] = array('name' => $v, 'tour_id' => $id);

                //Copy tmp to hotel folder
                copy($this->config->item('pic_path') . 'tmp/' . $v, $this->config->item('pic_path') . 'tours/' . $v);
                //Xoa hinh tmp
                unlink($this->config->item('pic_path') . 'tmp/' . $v);

                //Xoa hinh tmp trong database
                $this->image_tmp_model->delete_where(array('name' => $v));
            }

            //Insert to table hotel_image
            $this->tour_image_model->insert_batch($data_insert_pic);
        }

        return true;
    }

    public function delete()
    {
        $data = array();

        if ($this->input->get())
            $data = $this->input->get('check_item');
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
             *  Delete avatar
             */
            unlink($this->config->item('pic_path') . 'tours/' . $record->picture);

            /*
             * Delete pictures
             */
            $pictures = $this->tour_image_model->find_all_by(array('tour_id' => $v));

            if (!empty($pictures))
            {
                foreach ($pictures as $pic_val)
                {
                    if (is_file($this->config->item('pic_path') . 'tours/' . $pic_val->name))
                        unlink($this->config->item('pic_path') . 'tours/' . $pic_val->name);
                }

                $this->tour_image_model->delete_where(array('tour_id' => $v));
            }
        }

        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success');
    }

    public function save_image($img_name)
    {
        $source = $this->config->item('pic_path') . 'tmp/' . $img_name;

        $des = $this->config->item('pic_path') . 'tours/' . $img_name;

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
}
