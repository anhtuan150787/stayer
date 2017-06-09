<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promotion extends Backend_Controller
{

    protected $limit = 20;
    
    protected $model = 'promotion_tmp_model';

    public function __construct()
    {
        parent::__construct();
        
        /*
         * Title trang
         */
        $this->data['title'] = 'Khuyến mãi';

        /*
         * Load model
         */
        $this->load->model(array($this->model, 'promotion_model', 'hotel_model', 'room_type_model'));
        
        /*
         *  Hotel
         */
        $hotel_id = '';

        if ($this->input->get('hotel_id'))
            $hotel_id = $this->input->get('hotel_id');

        if ($this->input->post('hotel_id'))
            $hotel_id = $this->input->post('hotel_id');

        $this->data['hotel_id'] = $this->hotel_id = $hotel_id;

        $this->data['hotel'] = $this->hotel = $this->hotel_model->find($this->hotel_id);

        /*
         * Breadcrum
         */
        $hotel_name = '';
        
        if (isset($this->hotel->name))
        {
            $hotel_name = $this->hotel->name;
        }
        
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Khách sạn ' . $hotel_name => site_url() . '/backend/hotel/edit/' . $this->hotel_id,
            'Khuyến mãi' => site_url() . '/backend/' . $this->data['controller'] . '/?hotel_id=' . $this->hotel_id,
        );
        
        /*
         * Load js
         */
        $this->data['js'] = array('promotion.js');

        /*
         *  Trang thai
         */
        $this->data['status'] = $this->status = array(
            '0' => 'Ẩn',
            '1' => 'Hiển thị',
            '2' => 'Chờ duyệt hiển thị',
            '3' => 'Chờ duyệt cập nhật',
        );

        /*
         * Check permission hotel of sale
         */
        if (!check_own_hotel($this->data['admin']['group_id'], $this->data['admin']['id'], $this->hotel_id))
            redirect(site_url() . '/backend/hotel/index');
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
        $this->{$this->model}->where(array('hotel_id' => $this->hotel_id, 'deleted' => 0));
        $total_rows = $this->{$this->model}->count_all(); 
         
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
        $this->{$this->model}->select('promotion_tmp.*, hotel.name as hotel_name, admin.username as admin_username');
        $this->{$this->model}->join('hotel', 'promotion_tmp.hotel_id = hotel.id', 'left');
        $this->{$this->model}->join('admin', 'promotion_tmp.user_id = admin.id', 'left');
        $this->{$this->model}->where(array('hotel_id' => $this->hotel_id, 'promotion_tmp.deleted' => 0));
        $records = $this->{$this->model}->limit($limit, $offset)->find_all();
        
        $this->data['records'] = $records;
        
        /*
         *  Room
         */
        $this->data['rooms'] = $this->room_type_model->find_all_by(array('hotel_id' => $this->hotel_id)); 

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
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/add-success?hotel_id=' . $this->hotel_id);
            }
        }
        
        /*
         *  Room
         */
        $this->data['rooms'] = $this->room_type_model->find_all_by(array('hotel_id' => $this->hotel_id, 'deleted' => 0));

        $this->data['difference'] = array();

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
                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/edit-success?hotel_id=' . $this->hotel_id);
            }
        }
        
        /*
         *  Room
         */
        $this->data['rooms'] = $this->room_type_model->find_all_by(array('hotel_id' => $this->hotel_id, 'deleted' => 0)); 

        /*
         * Get record
         */
        $this->data['record'] = $this->{$this->model}->find($id);

        /*
         * Load du lieu hotel chinh so sanh voi dieu lieu tam
         */
        $difference = array();
        $promotion_primary = $this->promotion_model->find($id);
        foreach($promotion_primary as $k => $v)
        {
            if (isset($this->data['record']->$k))
            {
                if (strcasecmp($this->data['record']->$k, $v))
                    $difference[$k] = $v;
            }
        }
        $this->data['difference'] = $difference;

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
        $this->form_validation->set_rules('discount', 'Discount', 'trim|xss_clean');
        $this->form_validation->set_rules('book_day_from', 'Book day from', 'trim|xss_clean');
        $this->form_validation->set_rules('book_day_to', 'Book day to', 'trim|xss_clean');
        $this->form_validation->set_rules('stay_day_from', 'Stay day from', 'trim|xss_clean');
        $this->form_validation->set_rules('stay_day_to', 'Stay day to', 'trim|xss_clean');
        $this->form_validation->set_rules('night', 'Night', 'trim|xss_clean');
        $this->form_validation->set_rules('policy', 'Policy', 'trim|xss_clean');
        $this->form_validation->set_rules('date_apply_from', 'Date apply from', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_apply_to', 'Date apply to', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['status'] = $this->input->post('status');
        $params['update_by'] = $this->data['admin']['username'];  
        $params['discount'] = $this->input->post('discount');
        $params['book_day_from'] = $this->input->post('book_day_from');
        $params['book_day_to'] = $this->input->post('book_day_to');
        $params['stay_day_from'] = $this->input->post('stay_day_from');
        $params['stay_day_to'] = $this->input->post('stay_day_to');
        $params['night'] = $this->input->post('night');
        $params['policy'] = $this->input->post('policy');
        $params['room_id'] = ',' . implode(',', $this->input->post('room_id')) . ',';
        $params['date_apply_from'] = $this->input->post('date_apply_from');
        $params['date_apply_to'] = $this->input->post('date_apply_to');
        
        if ($id == null)
        {
            $params['hotel_id'] = $this->hotel_id;

            //User create
            $params['user_id'] = $this->data['admin']['id'];

            //Create time
            $params['create_time'] = date('Y-m-d H:i:s');
            $params['update_time'] = date('Y-m-d H:i:s');


            /*
             * Add record
             */
            $last_id = $this->{$this->model}->insert($params);

            /*
             * Add record to primary
             */
            if ($last_id)
            {    
                $params['id'] = $last_id;
                $this->promotion_model->insert($params);
            }

            return true;
        }
        else
        {
            //Update time
            $params['update_time'] = date('Y-m-d H:i:s');
            
            /*
             * Update record
             */
            $this->{$this->model}->update($id, $params);

            /*
             * Update primary
             */
            if ($this->data['admin']['group_id'] != 2 && ($params['status'] != 3 && $params['status'] != 2))  // Khac Sale
                $this->promotion_model->update($id, $params);

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
             * Delete
             */
            $this->{$this->model}->delete($v);

            /*
             * Delete primary 
             */
            $this->promotion_model->delete($v);
        }
        
        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success?hotel_id=' . $this->hotel_id);
    }
}
