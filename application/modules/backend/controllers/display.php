<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Display extends Backend_Controller
{

    protected $limit = 20;
    
    protected $model = 'display_model';

    protected $type_id;

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Giao diện';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'image_tmp_model', 'display_type_model'));

        /*
         *  Display type
         */
        if ($this->input->get('type_id'))
            $this->type_id = $this->input->get('type_id');

        if ($this->input->post('type_id'))
            $this->type_id = $this->input->post('type_id');

        $this->data['type_id'] = $this->type_id;
        
        $display_type = $this->display_type_model->find($this->type_id);

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Loại giao diện' => site_url() . '/backend/display_type',
            $display_type->name => site_url() . '/backend/' . $this->data['controller'] . '/index/?type_id=' . $this->type_id,
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('display.js');

        /*
         * Xoa hinh tam
         */
        
        $last_image_time = $this->image_tmp_model->find_all_by(array('type' => 'display', 'create_time <' => time()));
        
        if (!empty($last_image_time))
        {
            foreach($last_image_time as $v)
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
        
        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] .'/index/' . $str_param;
        
        $config['total_rows'] = $this->{$this->model}->where(array('deleted' => 0))->count_all();
        
        $config['per_page'] = $limit;
        
        $this->pagination->initialize($config);
        
        /*
         * Data view
         */
        $this->{$this->model}->select('display.*, display_type.name as display_type_name');
        $this->{$this->model}->join('display_type', 'display.type_id = display_type.id', 'left');
        $this->{$this->model}->where(array('display.type_id' => $this->type_id, 'display.deleted' => 0));
        $records = $this->{$this->model}->limit($limit, $offset)->order_by('display.id', 'desc')->find_all();
        
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
                redirect(site_url() . '/backend/' . $this->data['controller'] .'/index/add-success/?type_id=' . $this->type_id);
            }
        }

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
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/edit-success?type_id=' . $this->type_id);
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
        /*
         * Validate
         */
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('url', 'Url', 'trim|xss_clean');
        $this->form_validation->set_rules('content', 'Content', 'trim');
        $this->form_validation->set_rules('img_name', 'Picture', 'trim|required|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['url'] = $this->input->post('url');
        $params['content'] = $this->input->post('content');
        $params['picture'] = $this->input->post('img_name');
        $params['status'] = $this->input->post('status');  
        
        if ($id == null)
        {
            $params['type_id'] = $this->input->post('type_id'); 

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
                
                unlink($this->config->item('pic_path') . 'displays/' . $record->picture);
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
            unlink($this->config->item('pic_path') . 'displays/' . $record->picture);
        }
        
        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success?type_id=' . $this->type_id);
    }

    public function save_image($img_name)
    {
        $source = $this->config->item('pic_path') . 'tmp/' . $img_name;
        
        $des = $this->config->item('pic_path') . 'displays/' . $img_name;
        
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
