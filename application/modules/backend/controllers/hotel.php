<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hotel extends Backend_Controller
{

    protected $limit = 20;
    protected $model = 'hotel_tmp_model';
    protected $status = array();

    public function __construct()
    {
        parent::__construct();

        /*
         * Title trang
         */
        $this->data['title'] = 'Khách sạn';

        /*
         * Load model
         */
        $this->load->model(array(
            $this->model, 'national_model', 'area_model',
            'province_model', 'district_model', 'ward_model',
            'image_tmp_model', 'geonear_model', 'hotel_type_model',
            'hotel_facilities_model', 'hotel_image_model',
            'room_type_model', 'partner_model', 'hotel_model',
            'sight_model', 'hotel_info_model',
        ));

        /*
         * Breadcrum
         */
        $this->data['breadcrumbs'] = array(
            'Trang chủ' => site_url() . '/backend/index',
            'Khách sạn' => site_url() . '/backend/' . $this->data['controller'],
        );

        /*
         * Load js
         */
        $this->data['js'] = array('hotel.js');

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
         *  Trang thai khach san
         */
        $this->data['status'] = $this->status = array(
            '0' => 'Ẩn',
            '1' => 'Hiển thị',
            '2' => 'Chờ duyệt hiển thị',
            '3' => 'Chờ duyệt cập nhật',
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
        
        /*
         * Permission access hotel for sale
         */
        if ($this->data['admin']['group_id'] == 2)
        {
            $where['hotel_tmp.user_id'] = $this->data['admin']['group_id'];
        }

        //Keyword
        $keyword_search = $this->input->get('keyword_search');

        if ($keyword_search != '')
        {
            $where['(hotel_tmp.name like "%' . $keyword_search . '%" OR partner.username like "%' . $keyword_search . '%" OR partner.email like "%' . $keyword_search . '%" OR partner.name like "%' . $keyword_search . '%" OR hotel_tmp.address like "%' . $keyword_search . '%")'] = NULL;
        }

        //Loai khach san
        $type_search = $this->input->get('type_search');

        if ($type_search != '')
        {
            $where['type_id'] = $type_search;
        }

        //Hang sao
        $star_search = $this->input->get('star_search');

        if ($star_search != '')
        {
            $where['star'] = $star_search;
        }

        $where['hotel_tmp.deleted'] = 0;

        /*
         * Pagination
         */

        $this->{$this->model}->join('partner', 'hotel_tmp.partner_id = partner.id', 'left');
        $this->{$this->model}->join('hotel_type', 'hotel_tmp.type_id = hotel_type.id', 'left');
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

        $this->{$this->model}->select('hotel_tmp.*, partner.name as partner_name, hotel_type.name as type_name, admin.username as admin_username');
        $this->{$this->model}->where($where);
        $this->{$this->model}->join('partner', 'hotel_tmp.partner_id = partner.id', 'left');
        $this->{$this->model}->join('admin', 'hotel_tmp.user_id = admin.id', 'left');
        $this->{$this->model}->join('hotel_type', 'hotel_tmp.type_id = hotel_type.id', 'left');
        $this->{$this->model}->order_by('hotel_tmp.id', 'desc');
        $this->{$this->model}->limit($limit, $offset);
        $records = $this->{$this->model}->find_all();

        $this->data['records'] = $records;

        /*
         *  Loai khach san
         */
        $this->data['hotel_type'] = $this->hotel_type_model->find_all();

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
            /*
             * Insert hotel with status -2
             */
            $insert_hotel_id = $this->{$this->model}->insert(array('status' => -2));

            if ($insert_hotel_id)
            {

                /*
                 *  Insert hotel primary
                 */
                $this->hotel_model->insert(array('id' => $insert_hotel_id, 'status' => -2));

                if ($this->save($insert_hotel_id))
                {
                    /*
                     *  Tao thong tin chung
                     */
                    $this->hotel_info_model->insert(array('hotel_id' => $insert_hotel_id));

                    /*
                     * Tao doi tac
                     */
                    $partner_id = $this->partner_model->insert(array(
                        'status' => -2,
                        'create_time' => date('Y-m-d H:i:s'),
                        'user_id' => $this->data['admin']['id'],
                        'update_time' => date('Y-m-d H:i:s'),
                        'update_by' => $this->data['admin']['username'],
                    ));

                    /*
                     * Cap nhat doi tac cho khach san
                     */
                    if ($partner_id)
                    {
                        $this->{$this->model}->update($insert_hotel_id, array('partner_id' => $partner_id));

                        $this->hotel_model->update($insert_hotel_id, array('partner_id' => $partner_id));

                        redirect(site_url() . '/backend/' . $this->data['controller'] .'/index/add-success');
                    }
                }
            }
        }

        /*
         * Quoc gia
         */
        $this->data['national'] = $this->national_model->where(array('deleted' => 0))->find_all();

        /*
         *  Loai khach san
         */
        $this->data['hotel_type'] = $this->hotel_type_model->where(array('deleted' => 0))->find_all();

        /*
         *  Tien ich
         */
        $this->data['facilities'] = $this->hotel_facilities_model->where(array('deleted' => 0))->find_all();

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
         * Check permission hotel of sale
         */
        if (!check_own_hotel($this->data['admin']['group_id'], $this->data['admin']['id'], $id))
            redirect(site_url() . '/backend/hotel/index');
        

        /*
         * Submit update
         */
        if ($this->input->post())
        {
            if ($this->save($id, 'update'))
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
         * Tinh/Thanh
         */
        $this->data['province'] = $this->province_model->find_all_by(array('area_id' => $this->data['record']->area_id, 'deleted' => 0));

        /*
         * Quan/Huyen
         */
        $this->data['district'] = $this->district_model->find_all_by(array('province_id' => $this->data['record']->province_id, 'deleted' => 0));

        /*
         * Phuong/Xa
         */
        $this->data['ward'] = $this->ward_model->find_all_by(array('district_id' => $this->data['record']->district_id, 'deleted' => 0));

        /*
         * Khu vuc
         */
        $this->data['geonear'] = $this->geonear_model->find_all_by(array('district_id' => $this->data['record']->district_id, 'deleted' => 0));
        
        /*
         * Dia danh
         */
        $this->data['sight'] = $this->sight_model->find_all_by(array('district_id' => $this->data['record']->district_id, 'deleted' => 0));

        /*
         * Loai khach san
         */
        $this->data['hotel_type'] = $this->hotel_type_model->where(array('deleted' => 0))->find_all();

        /*
         *  Tien ich
         */
        $this->data['facilities'] = $this->hotel_facilities_model->where(array('deleted' => 0))->find_all();

        /*
         * Hinh anh
         */
        $this->data['pictures'] = $this->hotel_image_model->find_all_by(array('hotel_id' => $id));

        /*
         * Load du lieu hotel chinh so sanh voi dieu lieu tam
         */
        $difference = array();
        $hotel_primary = $this->hotel_model->find($id);
        foreach($hotel_primary as $k => $v)
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

    public function save($id = null, $type = 'insert')
    {
        /*
         * Validate
         */
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('national_id', 'National', 'trim|required|xss_clean');
        $this->form_validation->set_rules('area_id', 'Area', 'trim|required|xss_clean');
        $this->form_validation->set_rules('province_id', 'Province', 'trim|required|xss_clean');
        $this->form_validation->set_rules('district_id', 'District', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ward_id', 'Ward', 'trim|required|xss_clean');
        $this->form_validation->set_rules('img_name', 'Picture', 'trim|required|xss_clean');
        $this->form_validation->set_rules('geonear_id', 'Geonear', 'trim|xss_clean');
        $this->form_validation->set_rules('sight_id', 'Sight', 'trim|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('type_id', 'Hotel Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('star', 'Star', 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('policy', 'Policy', 'trim');
        $this->form_validation->set_rules('lat', 'Lat', 'trim|xss_clean');
        $this->form_validation->set_rules('lng', 'Lng', 'trim|xss_clean');
        $this->form_validation->set_rules('zoom', 'Zoom', 'trim|xss_clean');
        $this->form_validation->set_rules('member_promotion', 'Member promotion', 'trim|xss_clean');
        $this->form_validation->set_rules('member_promotion_discount', 'Member promotion discount', 'trim|xss_clean');
        $this->form_validation->set_rules('keyword', 'Keyword', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['error'] = validation_errors();

            $this->{$this->model}->delete($id);

            return false;
        }

        $params = array();
        $params['name'] = $this->input->post('name');
        $params['national_id'] = $this->input->post('national_id');
        $params['area_id'] = $this->input->post('area_id');
        $params['province_id'] = $this->input->post('province_id');
        $params['district_id'] = $this->input->post('district_id');
        $params['ward_id'] = $this->input->post('ward_id');
        $params['picture'] = $this->input->post('img_name');
        $params['geonear_id'] = $this->input->post('geonear_id');
        $params['sight_id'] = $this->input->post('sight_id');
        $params['address'] = $this->input->post('address');
        $params['type_id'] = $this->input->post('type_id');
        $params['facilities_id'] = ',' . implode(',', $this->input->post('facilities')) . ',';
        $params['star'] = $this->input->post('star');
        $params['description'] = $this->input->post('description');
        $params['policy'] = $this->input->post('policy');
        $params['lat'] = $this->input->post('lat');
        $params['zoom'] = $this->input->post('zoom');
        $params['lng'] = $this->input->post('lng');
        $params['update_by'] = $this->data['admin']['username'];
        $params['status'] = $this->input->post('status');
        $params['member_promotion'] = $this->input->post('member_promotion');
        $params['member_promotion_discount'] = $this->input->post('member_promotion_discount');
        $params['keyword'] = $this->input->post('keyword');

        /*
         * Xu ly upload picture list
         */
        $picture_upload = $this->input->post('picture_upload');

        if (!empty($picture_upload))
        {
            $data_insert_pic = array();

            foreach ($picture_upload as $v)
            {
                $data_insert_pic[] = array('name' => $v, 'hotel_id' => $id);

                //Copy tmp to hotel folder
                copy($this->config->item('pic_path') . 'tmp/' . $v, $this->config->item('pic_path') . 'hotels/' . $v);
                //Xoa hinh tmp
                unlink($this->config->item('pic_path') . 'tmp/' . $v);

                //Xoa hinh tmp trong database
                $this->image_tmp_model->delete_where(array('name' => $v));
            }

            //Insert to table hotel_image
            $this->hotel_image_model->insert_batch($data_insert_pic);
        }

        if ($type == 'insert')
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
        }

        /*
         * Update record
         */
        $this->{$this->model}->update($id, $params);

        /*
         *  Update hotel chinh
         */
        //Insert vao hotel chinh
        if ($type == 'insert')
        {
            $params['id'] = $id;

            $this->hotel_model->update($id, $params);
        }
        //Update hotel chinh
        else
        {
            if ($this->data['admin']['group_id'] != 2 && ($params['status'] != 3 && $params['status'] != 2))  // Khac Sale
                $this->hotel_model->update($id, $params);
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
            * Check permission hotel of sale
            */
            if (!check_own_hotel($this->data['admin']['group_id'], $this->data['admin']['id'], $v))
               redirect(site_url() . '/backend/hotel/index');
        
            /*
             *  Record
             */
            $record = $this->{$this->model}->find($v);

            /*
             * Delete
             */
            $this->{$this->model}->delete($v);

            /*
             * Delete hotel primary
             */
            $this->hotel_model->delete($v);

            /*
             * Delete partner
             */
            $this->partner_model->delete($record->partner_id);

            /*
             * Delete room type
             */
            $room_type = $this->room_type_model->find_all_by(array('hotel_id' => $v));

            foreach ($room_type as $room_val)
            {
                unlink($this->config->item('pic_path') . 'hotels/' . $room_val->picture);
            }

            $this->room_type_model->delete_where(array('hotel_id' => $v));

            /*
             *  Delete avatar
             */
            unlink($this->config->item('pic_path') . 'hotels/' . $record->picture);

            /*
             * Delete pictures
             */
            $pictures = $this->hotel_image_model->find_all_by(array('hotel_id' => $v));

            if (!empty($pictures))
            {
                foreach ($pictures as $pic_val)
                {
                    if (is_file($this->config->item('pic_path') . 'hotels/' . $pic_val->name))
                        unlink($this->config->item('pic_path') . 'hotels/' . $pic_val->name);
                }

                $this->hotel_image_model->delete_where(array('hotel_id' => $v));
            }
        }

        redirect(site_url() . '/backend/' . $this->data['controller'] . '/index/delete-success');
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
