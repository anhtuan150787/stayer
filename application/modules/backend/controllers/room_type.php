<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Room_type extends Backend_Controller
{

    protected $limit = 20;
    protected $model = 'room_type_tmp_model';
    protected $hotel_id;
    protected $hotel;

    public function __construct()
    {
        parent::__construct();

        /*
         * Load model
         */
        $this->load->model(array(
            $this->model, 'room_type_model' , 'hotel_model',
            'image_tmp_model', 'room_type_facilities_model',
            'room_price_model', 'holiday_model',
            'room_price_tmp_model', 'room_price_stage_model',
            'room_price_stage_tmp_model',
            ));

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
         * Title trang
         */
        $this->data['title'] = 'Loại phòng';

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
            'Loại phòng' => site_url() . '/backend/' . $this->data['controller'] . '/?hotel_id=' . $this->hotel_id,
        );

        /*
         * Load js
         */
        $this->data['js'] = array('room_type.js');

        /*
         * Xoa hinh tam
         */
        $last_image_time = $this->image_tmp_model->find_all_by(array('type' => 'hotel', 'create_time <' => time()));

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

        $config['base_url'] = site_url() . '/backend/' . $this->data['controller'] . '/index/' . $str_param;

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        /*
         * Data view
         */

        $this->{$this->model}->select('room_type_tmp.*, hotel.name as hotel_name, admin.username as admin_username');
        $this->{$this->model}->join('hotel', 'room_type_tmp.hotel_id = hotel.id', 'left');
        $this->{$this->model}->join('admin', 'room_type_tmp.user_id = admin.id', 'left');
        $this->{$this->model}->where(array('hotel_id' => $this->hotel_id, 'room_type_tmp.deleted' => 0));
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
            $room_id = $this->save();

            if ($room_id)
            {
                /*
                 * Save price
                 */

                $this->save_price($room_id, $this->hotel_id);

                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/add-success?hotel_id=' . $this->hotel_id);
            }
        }

        /*
         *  Tien ich
         */
        $this->data['facilities'] = $this->room_type_facilities_model->where(array('deleted' => 0))->find_all();

        /*
         *  Ngay le
         */
        $this->data['holiday'] = $this->holiday_model->find_all();

        $this->data['difference'] = array();
        $this->data['difference_price'] = array();
        $this->data['difference_price_origin'] = array();

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
                /*
                 * Save price
                 */
                $this->save_price($id, $this->hotel_id, 'update');

                redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/edit-success?hotel_id=' . $this->hotel_id);
            }
        }

        /*
         * Get record
         */
        $this->data['record'] = $this->{$this->model}->find($id);

        /*
         *  Tien ich
         */
        $this->data['facilities'] = $this->room_type_facilities_model->where(array('deleted' => 0))->find_all();

        /*
         * Get price stage
         */
        $this->data['room_price_stage'] = $this->room_price_stage_tmp_model->find_all_by(array('hotel_id' => $this->data['record']->hotel_id, 'room_id' => $this->data['record']->id));

        /*
         *  Gia phong
         */
        $price = $this->room_price_tmp_model->find_all_by(array('room_id' => $id));
        $this->data['price'] = array();
        foreach($price as $v)
        {
            $this->data['price'][$v->day] = $v;
        }

        /*
         *  Ngay le
         */
        $this->data['holiday'] = $this->holiday_model->find_all();

        /*
         * Load du lieu room chinh so sanh voi dieu lieu tam
         */
        $difference = array();
        $room_primary = $this->room_type_model->find($id);
        foreach($room_primary as $k => $v)
        {
            if (isset($this->data['record']->$k))
            {
                if (strcasecmp($this->data['record']->$k, $v))
                    $difference[$k] = ($v == '') ? true : $v;
            }
        }
        $this->data['difference'] = $difference;

        /*
         * Load du lieu room price chinh so sanh voi dieu lieu tam
         */
        $difference_price = array();
        $room__price_primary = $this->room_price_model->find_all_by(array('room_id' => $id));
        foreach($room__price_primary as $v)
        {
            if (isset($this->data['price'][$v->day]))
            {
                if (strcasecmp($this->data['price'][$v->day]->price, $v->price))
                    $difference_price[$v->day] = ($v->price == '') ? true : $v->price;
            }
        }
        $this->data['difference_price'] = $difference_price;

        /*
         * Load du lieu room price origin chinh so sanh voi dieu lieu tam
         */
        $difference_price_origin = array();
        $room__price_origin_primary = $this->room_price_model->find_all_by(array('room_id' => $id));
        foreach($room__price_origin_primary as $v)
        {
            if (isset($this->data['price'][$v->day]))
            {
                if (strcasecmp($this->data['price'][$v->day]->price_origin, $v->price_origin))
                    $difference_price_origin[$v->day] = ($v->price_origin == '') ? true : $v->price_origin;
            }
        }
        $this->data['difference_price_origin'] = $difference_price_origin;

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
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('policy', 'Policy', 'trim');
        $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('size', 'Size', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bed', 'Bed', 'trim|required|xss_clean');
        $this->form_validation->set_rules('slot', 'Slot', 'trim|required|xss_clean');
        $this->form_validation->set_rules('slot_child', 'Slot child', 'trim|xss_clean');
        $this->form_validation->set_rules('bed_more', 'Bed more', 'trim|xss_clean');
        $this->form_validation->set_rules('bed_more_price', 'Bed more price', 'trim|xss_clean');
        $this->form_validation->set_rules('room_number', 'Room number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('hide_price', 'Hide price', 'trim|xss_clean');
        $this->form_validation->set_rules('price_type', 'Price type', 'trim|xss_clean|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['status'] = $this->input->post('status');
        $params['picture'] = $this->input->post('img_name');
        $params['update_by'] = $this->data['admin']['username'];
        $params['facilities_id'] = ',' . implode(',', $this->input->post('facilities')) . ',';
        $params['description'] = $this->input->post('description');
        $params['policy'] = $this->input->post('policy');
        $params['type'] = $this->input->post('type');
        $params['size'] = $this->input->post('size');
        $params['bed'] = $this->input->post('bed');
        $params['slot'] = $this->input->post('slot');
        $params['slot_child'] = $this->input->post('slot_child');
        $params['holiday'] = implode(',', $this->input->post('holiday'));
        $params['bed_more'] = $this->input->post('bed_more');
        $params['bed_more_price'] = str_replace('.', '', $this->input->post('bed_more_price'));
        $params['room_number'] = $this->input->post('room_number');
        $params['hide_price'] = $this->input->post('hide_price');
        $params['price_type'] = $this->input->post('price_type');

        if ($id == null)
        {
            $params['hotel_id'] = $this->hotel_id;

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
            $room_id = $this->{$this->model}->insert($params);

            /*
             * Add record to primary
             */
            if ($room_id)
            {
                $params['id'] = $room_id;
                $this->room_type_model->insert($params);
            }

            return $room_id;
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

            /*
             * Update primary  
             */
            if ($this->data['admin']['group_id'] != 2 && ($params['status'] != 3 && $params['status'] != 2))  // Khac Sale
                $this->room_type_model->update($id, $params);

            return true;
        }
    }

    public function save_price($room_id, $hotel_id, $type = 'insert')
    {
        $price = $this->input->post('price');

        $price_origin = $this->input->post('price_origin');

        $datefrom_price_stage = $this->input->post('datefrom_price_stage');

        $dateto_price_stage = $this->input->post('dateto_price_stage');

        $price_stage_origin = $this->input->post('price_stage_origin');

        $price_stage = $this->input->post('price_stage');

        $room_type = $this->{$this->model}->find($room_id);

        if ($type == 'insert')
        {
            foreach($price as $k => $v)
            {
                $params = array();
                $params['room_id'] = $room_id;
                $params['day'] = $k;
                $params['price_origin'] = str_replace('.', '', $price_origin[$k]);
                $params['price'] = str_replace('.', '', $v);
                $params['hotel_id'] = $hotel_id;
                $params['hide_price'] = $room_type->hide_price;
                $params['status'] = $room_type->status;
                $params['deleted'] = $room_type->deleted;

                if ($this->data['admin']['group_id'] == 2)  // Khac Sale
                    $params['status'] = 2;

                $this->room_price_tmp_model->insert($params);

                $this->room_price_model->insert($params);
            }

            foreach($datefrom_price_stage as $k => $v) {
                if ($datefrom_price_stage[$k] != '') {
                    $params = array();
                    $params['room_id'] = $room_id;
                    $params['price_origin'] = str_replace('.', '', $price_stage_origin[$k]);
                    $params['price'] = str_replace('.', '', $price_stage[$k]);
                    $params['hotel_id'] = $hotel_id;
                    $params['date_from'] = $v;
                    $params['date_to'] = $dateto_price_stage[$k];

                    if ($this->data['admin']['group_id'] != 2)  // Khac Sale
                        $this->room_price_stage_model->insert($params);

                    $this->room_price_stage_tmp_model->insert($params);
                }
            }
        }
        else
        {
            foreach($price as $k => $v)
            {
                $params = array();
                $params['price_origin'] = str_replace('.', '', $price_origin[$k]);
                $params['price'] = str_replace('.', '', $v);
                $params['hide_price'] = $room_type->hide_price;
                $params['status'] = $room_type->status;
                $params['deleted'] = $room_type->deleted;

                $this->room_price_tmp_model->update_where(
                    array('room_id' => $room_id, 'day' => $k),
                    $params
                );

                if ($this->data['admin']['group_id'] != 2 && ($params['status'] != 3 && $params['status'] != 2))  // Khac Sale
                    $this->room_price_model->update_where(
                    array('room_id' => $room_id, 'day' => $k),
                    $params
                );
            }


            $this->room_price_stage_tmp_model->delete_where(array('room_id' => $room_id, 'hotel_id' => $hotel_id));

            if ($this->data['admin']['group_id'] != 2 && ($room_type->status != 3 && $room_type->status != 2)) {
                $this->room_price_stage_model->delete_where(array('room_id' => $room_id, 'hotel_id' => $hotel_id));
            }

            foreach($datefrom_price_stage as $k => $v) {
                if ($datefrom_price_stage[$k] != '') {
                    $params = array();
                    $params['room_id'] = $room_id;
                    $params['price_origin'] = str_replace('.', '', $price_stage_origin[$k]);
                    $params['price'] = str_replace('.', '', $price_stage[$k]);
                    $params['hotel_id'] = $hotel_id;
                    $params['date_from'] = $v;
                    $params['date_to'] = $dateto_price_stage[$k];

                    $this->room_price_stage_tmp_model->insert($params);

                    if ($this->data['admin']['group_id'] != 2 && ($room_type->status != 3 && $room_type->status != 2)) {  // Khac Sale
                        $this->room_price_stage_model->insert($params);
                    }
                }
            }
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
             * Delete room type primary
             */
            $this->room_type_model->delete($v);

            /*
             *  Delete Price
             */
            $this->room_price_model->delete_where(array('room_id' => $v));
            $this->room_price_tmp_model->delete_where(array('room_id' => $v));

            /*
             *  Delete picture
             */
            unlink($this->config->item('pic_path') . 'hotels/' . $record->picture);
        }

        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success?hotel_id=' . $this->hotel_id);
    }

    public function save_image($img_name)
    {
        $source = $this->config->item('pic_path') . 'tmp/' . $img_name;

        $des = $this->config->item('pic_path') . 'hotels/' . $img_name;

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
