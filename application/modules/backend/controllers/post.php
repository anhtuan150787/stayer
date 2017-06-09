<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post extends Backend_Controller
{

    protected $limit = 20;
    
    protected $model = 'post_model';

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Bài viết';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'post_category_model', 'image_tmp_model'));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Bài viết' => site_url() . '/backend/' . $this->data['controller'],
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('post.js');
        
        /*
         * Xoa hinh tam
         */
        
        $last_image_time = $this->image_tmp_model->find_all_by(array('type' => 'news', 'create_time <' => time()));
        
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
        
        $_SESSION['tinymce_upload_dir'] = $config_tinymce['upload_dir'] . 'news/' . $date . '/';
        
        $_SESSION['tinymce_current_path'] = $config_tinymce['current_path'] . 'news/' . $date . '/';
        
        $_SESSION['tinymce_thumbs_base_path'] = $config_tinymce['thumbs_base_path'] . 'news/' . $date . '/thumbs/';
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
        $this->{$this->model}->select('post.*, post_category.name as category_name');
        $this->{$this->model}->join('post_category', 'post.category_id = post_category.id', 'left');
        $this->{$this->model}->where(array('post.deleted' => 0));
        $this->{$this->model}->order_by('post.id', 'desc');
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
                redirect(site_url() . '/backend/' . $this->data['controller'] .'/index/add-success');
            }
        }
        
        /*
         * Category
         */
        $this->data['category'] = $this->post_category_model->getAll();

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
        $this->data['category'] = $this->post_category_model->getAll();

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
        /*
         * Validate
         */
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        $this->form_validation->set_rules('img_name', 'Picture', 'trim|required|xss_clean');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        
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
        $params['category_id'] = $this->input->post('category_id');
        
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
            $this->{$this->model}->insert($params);

            return true;
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
                
                unlink($this->config->item('pic_path') . 'news/' . $record->picture);
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
            unlink($this->config->item('pic_path') . 'news/' . $record->picture);
        }
        
        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success');
    }
    
    public function save_image($img_name)
    {
        $source = $this->config->item('pic_path') . 'tmp/' . $img_name;
        
        $des = $this->config->item('pic_path') . 'news/' . $img_name;
        
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
