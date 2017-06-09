<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Handbook extends Backend_Controller
{

    protected $limit = 20;
    
    protected $model = 'handbook_model';

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Bài viết cẩm nang';

        /*
         * Load model
         */
        $this->load->model(array(
            $this->model, 'handbook_category_model', 'image_tmp_model',
            'national_model', 'area_model', 'province_model',
            'beach_model', 'handbook_tag_model'
        ));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Bài viết cẩm nang' => site_url() . '/backend/' . $this->data['controller'],
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('handbook.js');
        
        /*
         * Xoa hinh tam
         */
        
        $last_image_time = $this->image_tmp_model->find_all_by(array('type' => 'handbook', 'create_time <' => time()));
        
        if (!empty($last_image_time))
        {
            foreach($last_image_time as $v)
            {
                unlink($this->config->item('pic_path') . 'tmp/' . $v->name);

                $this->image_tmp_model->delete($v->id);
            }
        }
        
        /*
         *  Config path upload image tinymce
         */
        $config_tinymce = $this->config->item('tinymce');
        
        $date = date('Y_m_d');
        
        $_SESSION['tinymce_upload_dir'] = $config_tinymce['upload_dir'] . 'handbooks/' . $date . '/';
        
        $_SESSION['tinymce_current_path'] = $config_tinymce['current_path'] . 'handbooks/' . $date . '/';
        
        $_SESSION['tinymce_thumbs_base_path'] = $config_tinymce['thumbs_base_path'] . 'handbooks/' . $date . '/thumbs/';
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
        $this->{$this->model}->select('handbook.*, handbook_category.name as category_name');
        $this->{$this->model}->join('handbook_category', 'handbook.category_id = handbook_category.id', 'left');
        $this->{$this->model}->where(array('handbook.deleted' => 0));
        $this->{$this->model}->order_by('handbook.id', 'desc');
        $records = $this->{$this->model}->limit($limit, $offset)->find_all();
        
        $this->data['records'] = $records;
        
        /*
         * Category
         */
        $this->data['category'] = $this->handbook_category_model->getAll();

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
         * Category
         */
        $this->data['category'] = $this->handbook_category_model->getAll();
        
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
         * Category
         */
        $this->data['category'] = $this->handbook_category_model->getAll();

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
         * Tinh/Thanh
         */
        $this->data['province'] = $this->province_model->find_all_by(array('area_id' => $this->data['record']->area_id, 'deleted' => 0));

        /*
         * Bai bien
         */
        $this->data['beach'] = $this->beach_model->find_all_by(array('province_id' => $this->data['record']->province_id, 'deleted' => 0));
        
        /*
         *  Tag
         */
        $this->data['tag'] = $this->handbook_tag_model->find_where_in('id', explode(',', $this->data['record']->tag_id));

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
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('img_name', 'Picture', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        $this->form_validation->set_rules('national_id', 'National', 'trim|required|xss_clean');
        $this->form_validation->set_rules('area_id', 'Area', 'trim|required|xss_clean');
        $this->form_validation->set_rules('province_id', 'Province', 'trim|required|xss_clean');
        $this->form_validation->set_rules('beach_id', 'Beach', 'trim|xss_clean');
        $this->form_validation->set_rules('tags', 'Tag', 'trim|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['status'] = $this->input->post('status');  
        $params['picture'] = $this->input->post('img_name');
        $params['description'] = $this->input->post('description');
        $params['content'] = $this->input->post('content'); 
        $params['category_id'] = ',' . implode(',', $this->input->post('category_id')) . ',';
        $params['national_id'] = $this->input->post('national_id');
        $params['area_id'] = $this->input->post('area_id');
        $params['province_id'] = $this->input->post('province_id');
        $params['beach_id'] = $this->input->post('beach_id');
        $params['keyword'] = $this->input->post('keyword');
        
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
            $id_insert = $this->{$this->model}->insert($params);

            if ($id_insert)
                $this->save_tags($this->input->post('tags'), $id_insert);

            return $id_insert;
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
                
                unlink($this->config->item('pic_path') . 'handbooks/' . $record->picture);
            }
            
            /*
             * Update record
             */
            $update = $this->{$this->model}->update($id, $params);

            if ($update)
                $this->save_tags($this->input->post('tags'), $id);

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
            unlink($this->config->item('pic_path') . 'handbooks/' . $record->picture);
        }
        
        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success');
    }
    
    public function save_image($img_name)
    {
        $source = $this->config->item('pic_path') . 'tmp/' . $img_name;
        
        $des = $this->config->item('pic_path') . 'handbooks/' . $img_name;
        
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

    public function save_tags($tags, $handbook_id)
    {
        
            $arr_tag = explode(',', $tags);

            $id_insert_tag = '';

            if (count($arr_tag) > 0)
            {
                foreach ($arr_tag as $value) 
                {
                    if ($value != '')
                    {
                        $check_exist = $this->handbook_tag_model->select('COUNT(id) as total')->find_by(array('name' => trim($value)));    
                        
                        if ($check_exist->total <= 0)
                        {
                            $id_insert_tag .= ',' . $this->handbook_tag_model->insert(array('name' => trim($value), 'handbook_id' => $handbook_id));
                        }    
                        else
                        {
                            $tag = $this->handbook_tag_model->find_by(array('name' => trim($value)));

                            $id_insert_tag .= ',' . $tag->id;
                        }
                    }

                }
                $id_insert_tag = ',' . trim($id_insert_tag, ',') . ',';
            }
            $this->{$this->model}->update_where(array('id' => $handbook_id), array('tag_id' => $id_insert_tag));
    }
}
