<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request extends Frontend_Controller
{

    public function __construct()
    {

        parent::__construct();
    }

    /*
     * 	Tim kiem
     */

    public function search()
    {
        $keyword = $this->input->post('keyword');

        $keyword = $this->security->xss_clean($keyword);

        $result_search = '<ul>';

        /*
         *  Search Province
         */
        $this->load->model('frontend/province_model');

        $province = $this->province_model->select('id, name')->find_all_by(array('name like "%' . $keyword . '%"' => NULL, 'status' => 1, 'deleted' => 0));

        if (!empty($province))
        {
            $result_search .= '<li class="list-name-search-item-title">Tỉnh/Thành</li>';

            foreach ($province as $v)
            {
                $result_search .= '<li val_title_seo="' . format_title($v->name) . '" val_id="' . $v->id . '" type="province" val="' . html_escape($v->name) . '" class="list-name-search-item">' . html_escape($v->name) . ' - ' . '<label>Các khách sạn tại ' . html_escape($v->name) . '</label>' . '</li>';
            }
        }

        /*
         *  Search district
         */
        $this->load->model('frontend/district_model');

        $district = $this->district_model->select('id, name')->find_all_by(array('name like "%' . $keyword . '%"' => NULL, 'status' => 1, 'deleted' => 0));

        if (!empty($district))
        {
            $result_search .= '<li class="list-name-search-item-title">Quận/Huyện</li>';

            foreach ($district as $v)
            {
                $result_search .= '<li val_title_seo="' . format_title($v->name) . '" val_id="' . $v->id . '" type="district" val="' . html_escape($v->name) . '" class="list-name-search-item">' . html_escape($v->name) . ' - ' . '<label>Các khách sạn tại ' . html_escape($v->name) . '</label>' . '</li>';
            }
        }

        /*
         *  Search geonear
         */
        $this->load->model('frontend/geonear_model');

        $geonear = $this->geonear_model->select('id, name')->find_all_by(array('name like "%' . $keyword . '%"' => NULL, 'status' => 1, 'deleted' => 0));

        if (!empty($geonear))
        {
            $result_search .= '<li class="list-name-search-item-title">Khu vực</li>';

            foreach ($geonear as $v)
            {
                $result_search .= '<li val_title_seo="' . format_title($v->name) . '" val_id="' . $v->id . '" type="geonear" val="' . html_escape($v->name) . '" class="list-name-search-item">' . html_escape($v->name) . ' - ' . '<label>Các khách sạn tại ' . html_escape($v->name) . '</label>' . '</li>';
            }
        }

        /*
         *  Search sight
         */
        $this->load->model('frontend/sight_model');

        $sight = $this->sight_model->select('id, name')->find_all_by(array('name like "%' . $keyword . '%"' => NULL, 'status' => 1, 'deleted' => 0));

        if (!empty($sight))
        {
            $result_search .= '<li class="list-name-search-item-title">Địa danh</li>';

            foreach ($sight as $v)
            {
                $result_search .= '<li val_title_seo="' . format_title($v->name) . '" val_id="' . $v->id . '" type="sight" val="' . html_escape($v->name) . '" class="list-name-search-item">' . html_escape($v->name) . ' - ' . '<label>Các khách sạn tại ' . html_escape($v->name) . '</label>' . '</li>';
            }
        }

        /*
         *  Search hotel
         */
        $this->load->model('frontend/hotel_model');

        $this->hotel_model->select("hotel.id as id, hotel.name as name, district.name as district_name, province.name as province_name");
        $this->hotel_model->join('district', 'hotel.district_id = district.id', 'left');
        $this->hotel_model->join('province', 'hotel.province_id = province.id', 'left');
        $hotel = $this->hotel_model->find_all_by(array('hotel.name like "%' . $keyword . '%"' => NULL, 'hotel.status' => 1, 'hotel.deleted' => 0));

        if (!empty($hotel))
        {
            $result_search .= '<li class="list-name-search-item-title">Khách sạn</li>';

            foreach ($hotel as $v)
            {
                $result_search .= '<li val_title_seo="' . format_title($v->name) . '" val_id="' . $v->id . '" type="hotel" val="' . html_escape($v->name) . '" class="list-name-search-item">' . html_escape($v->name) . ' - ' . '<label>' . html_escape($v->district_name) . ', ' . html_escape($v->province_name) . '</label>' . '</li>';
            }
        }

        $result_search .= '</ul>';

        echo $result_search;
    }

    /*
     * 	Tim kiem tour
     */

    public function search_tour()
    {
        $keyword = $this->input->post('keyword');

        $keyword = $this->security->xss_clean($keyword);

        $result_search = '<ul>';

        /*
         *  Search National
         */
        $this->load->model('frontend/national_model');

        $national = $this->national_model->select('id, name')->find_all_by(array('name like "%' . $keyword . '%"' => NULL, 'status' => 1, 'deleted' => 0));

        if (!empty($national))
        {
            $result_search .= '<li class="list-name-search-item-title">Tour đi qua</li>';

            foreach ($national as $v)
            {
                $result_search .= '<li val_title_seo="' . format_title($v->name) . '" val_id="' . $v->id . '" type="national" val="' . html_escape($v->name) . '" class="list-name-search-item">' . html_escape($v->name) . '</li>';
            }
        }

        /*
         *  Search Province
         */
        $this->load->model('frontend/province_model');

        $province = $this->province_model->select('id, name')->find_all_by(array('name like "%' . $keyword . '%"' => NULL, 'status' => 1, 'deleted' => 0));

        if (!empty($province))
        {
            $result_search .= '<li class="list-name-search-item-title">Tour đi qua</li>';

            foreach ($province as $v)
            {
                $result_search .= '<li val_title_seo="' . format_title($v->name) . '" val_id="' . $v->id . '" type="province" val="' . html_escape($v->name) . '" class="list-name-search-item">' . html_escape($v->name) . '</li>';
            }
        }

        /*
         *  Search hotel
         */
        $this->load->model('frontend/tour_model');

        $this->tour_model->select("tour.id as id, tour.name as name, province.name as province_name");
        $this->tour_model->join('province', 'tour.to_province_id = province.id', 'left');
        $hotel = $this->tour_model->find_all_by(array('tour.name like "%' . $keyword . '%"' => NULL, 'tour.status' => 1, 'tour.deleted' => 0));

        if (!empty($hotel))
        {
            $result_search .= '<li class="list-name-search-item-title">Danh sách tour</li>';

            foreach ($hotel as $v)
            {
                $result_search .= '<li val_title_seo="' . format_title($v->name) . '" val_id="' . $v->id . '" type="tour" val="' . html_escape($v->name) . '" class="list-name-search-item">' . html_escape($v->name) . '</li>';
            }
        }

        $result_search .= '</ul>';

        echo $result_search;
    }

    public function home_hotel_province()
    {
        /*
         *  Range day
         */
        $this->data['search']['range_day'] = get_range_day_now();

        $province_id = $this->security->xss_clean($this->input->post('province_id'));

        if (!empty($province_id))
        {
            $this->load->model(array('frontend/hotel_model', 'frontend/province_model'));

            $province = $this->province_model->select("id, name")->find($province_id);

            /*
             *  Total
             */    
            $where = array('province_id' => $province_id, 'status' => 1, 'deleted' => 0);

            $hotel_hcm_total = $this->hotel_model->where($where)->count_all();

            /*
             *  Records
             */
            $where = array('hotel.province_id' => $province_id, 'hotel.status' => 1, 'hotel.deleted' => 0);

            $this->hotel_model->select('
                hotel.picture as picture, hotel.id as id, hotel.name as name, hotel.address as address, hotel.star as star,
                province.name as province_name, province.id as province_id
            ');
            
            $this->hotel_model->join('province', 'hotel.province_id = province.id', 'left');
            
            $this->hotel_model->order_by('hotel.id', 'desc');
            
            $this->hotel_model->group_by('hotel.id');
            
            $this->hotel_model->limit(5);
            
            $hotel = $this->hotel_model->find_all_by($where);

            $records = array();

            if ($hotel)
            {    
                foreach($hotel as $k => $v)
                {
                    $records[$k] = $v;

                    $records[$k]->url = show_link($v->id, html_escape($v->name));

                    $records[$k]->picture = show_picture(html_escape($v->picture), 115, 77);

                    $records[$k]->name = html_escape($v->name);

                    $records[$k]->address = html_escape($v->address);

                    $records[$k]->price = show_price_low($v->id, $this->data['search']['range_day']);
                }
            }

            $str_data = '';

            $star_str = '';

            $i = 0;

            if (!empty($records))
            {
                foreach ($records as $k => $v)
                {
                    $star_str = '<ul class="star">';

                    for ($i_star = 1; $i_star <= 5; $i_star++)
                    {
                        $star_str .= '<li ' . (($v->star >= $i_star) ? "class='active'" : "") . '></li>';
                    }
                    
                    $star_str .= '</ul>';

                    $str_data .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-hotel">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 picture">
                                    <a href="' . $v->url . '"><img class="img-responsive" src="' . $v->picture . '" /></a>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 description">
                                        <p class="title"><a href="' . $v->url . '">' . $v->name . '</a></p>
                                        <p class="address">' . $v->address . '</p>
                                        ' . $star_str . '
                                        <p class="price">Giá 1 đêm từ <label>' . $v->price . '</label></p>
                                    </div>
                                  </div>';
                    $i++;
                }
            }

            $url_province = show_link($province->id, $province->name, 'province');

            $data = array(
                'total' => number_format($hotel_hcm_total, 0, ',', ',') . ' <label>Khách sạn</label>',
                'data' => $str_data,
                'url_province' => $url_province,
            );

            echo json_encode($data);
        }
    }

    function show_map()
    {
        $hotel_id = $this->input->get('hotel_id');

        $this->load->model('frontend/hotel_model');

        $data = array();
        $this->hotel_model->select('hotel.lat as lat, hotel.lng as lng, hotel.zoom as zoom, hotel.province_id as province_id, hotel.id as id, hotel.name as name, hotel.picture as picture, hotel.address as address, hotel.star as star,
                                    AVG(hotel_comment.evaluation) as point');
        $this->hotel_model->join('hotel_comment', 'hotel.id = hotel_comment.hotel_id', 'left');
        $this->hotel_model->group_by('hotel.id');
        $hotel = $this->hotel_model->find_by(array('hotel.id' => $hotel_id));

        $hotel_other = $this->hotel_model->find_all_by(array('star = ' . $hotel->star . ' AND status = 1 AND deleted = 0 AND id <> ' . $hotel_id . ' AND province_id = ' . $hotel->province_id => NULL));

        $data_hotel_other = array();

        if ($hotel_other)
        {
            foreach($hotel_other as $k => $v)
            {
                $data_hotel_other[$k] = $v;

                $data_hotel_other[$k] = $v;

                $data_hotel_other[$k]->url = show_link($v->id, html_escape($v->name));

                $data_hotel_other[$k]->picture = show_picture(html_escape($v->picture), 111, 94);

                $data_hotel_other[$k]->name = html_escape($v->name);

                $data_hotel_other[$k]->address = html_escape($v->address);

                $data_hotel_other[$k]->price = show_price_low($v->id);
            }
        }

        $data['hotel'] = $hotel;

        $data['hotel_other'] = $data_hotel_other;

        $this->load->view('frontend/request/map', $data);
    }

    public function map_show_hotel_order()
    {
        $this->load->model('frontend/hotel_model');

        $cur_hotel = $this->input->get('cur_hotel');

        $stars = $this->input->get('stars');

        $stars = implode(',', $stars);

        $hotel = $this->hotel_model->select('hotel.lat as lat, hotel.lng as lng, hotel.zoom as zoom, hotel.province_id as province_id, hotel.id as id,
                                            hotel.name as name, hotel.picture as picture, hotel.address as address, hotel.star as star')
                ->find_all_by(array('star IN (' . $stars . ') AND id <> ' . $cur_hotel . ' AND status = 1 AND deleted = 0' => NULL));

        $data_hotel = array();

        $locations_str = '';

        if ($hotel)
        {
            foreach($hotel as $k => $v)
            {
                $data_hotel[$k] = $v;

                $data_hotel[$k] = $v;

                $data_hotel[$k]->url = show_link($v->id, html_escape($v->name));

                $data_hotel[$k]->picture = show_picture(html_escape($v->picture), 111, 94);

                $data_hotel[$k]->name = html_escape($v->name);

                $data_hotel[$k]->address = html_escape($v->address);

                $data_hotel[$k]->price = show_price_low($v->id);

                $str_li_star = '';
                for($i_star = 1; $i_star <= 5; $i_star++) {
                    $str_li_star .= '<li ' . (($v->star >= $i_star) ? 'class="active"' : '') . '></li>';
                }

                $locations_str .= '[\'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-hotel"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 picture"><a href="' . $data_hotel[$k]->url . '" target="_blank"><img class="img-responsive" src="' . $data_hotel[$k]->picture . '" /></a></div><div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 description"><p class="title"><a href="' . $data_hotel[$k]->url . '" target="_blank">' . $data_hotel[$k]->name . '</a></p><p class="address">' . $data_hotel[$k]->address . '</p><ul class="star">' . $str_li_star . '</ul><p class="price">Giá 1 đêm từ <label>' . $data_hotel[$k]->price . '</label></p></div></div>\',
                                ' . $v->lat . ',
                                ' . $v->lng . ', 13],';
            }
        }

        $data = array(
            'script' => 'var locations = [' . $locations_str . '];',
            'total_data' => count($data_hotel),
        );

        echo json_encode($data);
    }

    public function comment_paging()
    {
        $page = $this->input->post('page_comment');
        $hotel_id = $this->input->post('hotel_id');

        $this->load->model('frontend/hotel_comment_model');

        $this->hotel_comment_model->select('hotel_comment.*, user.name as user_fullname');
        $this->hotel_comment_model->join('user', 'hotel_comment.user_id = user.id', 'left');
        $this->hotel_comment_model->limit(10, (($page - 1) * 10));
        $comment = $this->hotel_comment_model->find_all_by(array('hotel_comment.status' => 1, 'hotel_comment.hotel_id' => $hotel_id, 'hotel_comment.deleted' => 0));

        $str_list_comment = '';

        if (!empty($comment))
        {
            foreach ($comment as $v)
            {
                $str_list_comment .= '<div class="col-lg-12 item">
                                        <div class="col-lg-2 picture">
                                            <p class="name">' . html_escape($v->user_fullname) . '</p>
                                            ' . ((!isset($v->picture) || $v->picture == '') ? '<img class="img-responsive" src="' . base_url() . 'public/frontend/images/logo.png">' : '') . '
                                        </div>
                                        <div class="col-lg-9 description">
                                            ' . ((isset($v->title) && $v->title != '') ? '<p class="title">' . html_escape($v->title) . ' <time>' . html_escape($v->create_time) . '</time></p>' : '') . '
                                            <p class="content">
                                                ' . html_escape($v->content) . '
                                            </p>
                                        </div>
                                        <div class="col-lg-1 rate">
                                            <button id="search-btn" class="btn btn-orange btn-arrow pull-left btn-block" type="submit">' . show_point($v->evaluation) . '</button>
                                        </div>
                                    </div>';
            }
        }
        echo $str_list_comment;
    }

    function search_room()
    {
        $this->load->model(array('frontend/room_type_model', 'frontend/promotion_model', 'frontend/setting_model', 'frontend/hotel_model'));

        $this->data['search'] = array();

        $this->data['search']['df'] = $this->input->post('room_date_from_search');

        $this->data['search']['dt'] = $this->input->post('room_date_to_search');

        $this->data['search']['slot'] = $this->input->post('room_persion_search');
        
        $this->data['search']['room_number'] = $this->input->post('room_num_search');

        $hotel_id = $this->input->post('hotel_id');

        //  Thong tin hotel
        $hotel = $this->hotel_model->find($hotel_id);

        //  Night
        $this->data['search']['day_from'] = show_day_of_week($this->data['search']['df']);

        $this->data['search']['day_to'] = show_day_of_week($this->data['search']['dt']);

        $this->data['search']['date_from_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['df']));

        $this->data['search']['date_to_format'] = format_date('Y-m-d', str_replace('/', '-', $this->data['search']['dt']));

        $this->data['search']['night'] = $night = show_day_between_date($this->data['search']['date_from_format'], $this->data['search']['date_to_format']);

        /*
         * Search phong
         */
        $where_room = 'room_type.status = 1 AND room_type.deleted = 0 AND room_type.hotel_id=' . $hotel_id;

        $where_room .= ' AND (room_type.slot >= ' . $this->data['search']['slot'] . ') ';
        
        $where_room .= ' AND (room_type.room_number >= ' . $this->data['search']['room_number'] . ')';

        $this->room_type_model->select('room_type.*, hotel.member_promotion, hotel.member_promotion_discount');
        
        $this->room_type_model->join('hotel', 'room_type.hotel_id = hotel.id', 'left');

        $room_type = $this->room_type_model->find_all_by(array($where_room => NULL));

        $data_room_type = array();

        if ($room_type)
        {
            foreach($room_type as $k => $v)
            {
                $data_room_type[$k] = $v;
                
                /*
                 * Khuyen mai
                 */

                //  Phong ap dung
                $where_promotion = 'status = 1 AND deleted = 0 AND room_id LIKE "%,' . $v->id . ',%"';
                
                //  Ngay ap dung
                $where_promotion .= ' AND (date_apply_from <= "' . date('Y-m-d') . '"  AND date_apply_to >= "' . date('Y-m-d') . '")';

                //  Ngay o
                $where_promotion .= ' AND (stay_day_from <= "' . $this->data['search']['date_from_format'] . '"  AND stay_day_to >= "' . $this->data['search']['date_to_format'] . '")';

                // Ngay dat
                $where_promotion .= ' AND (book_day_from <= "' . date('Y-m-d') . '"  AND book_day_to >= "' . date('Y-m-d') . '")';
                
                //  Dem o toi thieu
                $where_promotion .= ' AND (night <= ' . $night . ')';
                
                $promotion = $this->promotion_model->find_by(array($where_promotion => NULL));

                $v->price = get_avg_price($this->data['search']['date_from_format'], $this->data['search']['date_to_format'], $v->id);

                //  Gia uu dai
                if (!$this->session->userdata('user') && $hotel->member_promotion == 1)
                    $v->price = $v->price + (($v->price * $hotel->member_promotion_discount)/100);

                if ($v->price_type == 'usd')
                {
                    $setting = $this->setting_model->find(1);

                    $v->bed_more_price = $v->bed_more_price * $setting->value;
                }

                if (!empty($promotion))
                {    
                    $data_room_type[$k]->promotion = $promotion;
                    
                    $data_room_type[$k]->price_promotion = $v->price;
                    
                    $data_room_type[$k]->price = $v->price - (($v->price * $promotion->discount)/100);
                }
                else
                {
                    $data_room_type[$k]->promotion = false;
                }
            }
        }

        /*
         *  Luu session
         */
        $this->session->set_userdata('search', array(
            'df' => $this->data['search']['df'],
            'dt' => $this->data['search']['dt'],
            'slot' => $this->data['search']['slot'],
            'room_number' => $this->data['search']['room_number'],
            'night' => $this->data['search']['night'],
        ));
        
        $this->data['room_type'] = $data_room_type;

        $this->load->view('frontend/request/search_room', $this->data);
    }

    public function email_customer()
    {
        sleep(2);

        $email_customer = $this->input->post('email');

        $this->load->model('email_customer_model');

        $email = $this->email_customer_model->find_all_by(array('email' => $email_customer));

        if (empty($email))
            $this->email_customer_model->insert(array('email' => $email_customer));

        //echo $email->total;
    }

    /*
     *  Check exist email
     */
    public function exist_email()
    {
        $email = $this->input->post('email');
        
        $this->load->model('frontend/user_model');
        
        $record = $this->user_model->select('COUNT(id) as total')->find_by(array('email' => $email));
        
        if ($record->total == 0)
            echo false;
        else
            echo true;    
    }
    
    /*
     *  Reload captcha
     */
     function reload_captcha()
     {
        /*
         * Load hepler captcha
         */
        $this->load->helper('captcha');
        //Get Captcha
        $this->data['captcha'] = create_captcha($this->config->item('captcha'));
        //Save session captcha
        $this->session->set_userdata(array('captcha_word_front' => $this->data['captcha']['word']));
        
        echo $this->data['captcha']['image'];
     }

     /*
      * Check login facebook
      */
     public function check_login_outsite()
     {
        $this->load->model(array('frontend/user_model'));

        $email = $this->input->post('email');

        $name = $this->input->post('name');

        $user_app_id = $this->input->post('user_app_id');

        $type = $this->input->post('type');

        //  Check exist
        $count_all = $this->user_model->where(array('email' => $email))->count_all();

        if ($count_all == 0)
        {
            $user_insert = array();
            $user_insert['email'] = $email;
            $user_insert['name'] = $name;
            $user_insert['user_app_id'] = $user_app_id;
            $user_insert['create_time'] = date('Y-m-d H:i:s');
            $user_insert['login_time'] = date('Y-m-d H:i:s');
            $user_insert['status'] = 1;
            $user_insert['type'] = $type;

            $this->user_model->insert($user_insert);
        }
        else
        {
            $this->user_model->update_where(array('email' => $email), array('login_time' => date('Y-m-d H:i:s')));
        }

        $user = $this->user_model->find_by(array('email' => $email));

        //  Tao session
        $user_info = new stdClass();
        $user_info->id = $user->id;
        $user_info->email = $user->email;
        $user_info->name = $user->name;
        
        /*
         * Save session user
         */
        $this->session->set_userdata('user', $user_info);

        echo true;
     }
     
     /*
      * Login
      */
      public function login()
      {
        $url_current = $this->input->get('url_current');
        
        $df = $this->input->get('df');
        
        $dt = $this->input->get('dt');
        
        $room_num = $this->input->get('room_num');
        
        $room_person = $this->input->get('room_person');
        
        $url_current = $url_current . '?df=' . $df . '&dt=' . $dt . '&room_num=' . $room_num . '&room_person=' . $room_person . '#check-price';
        
        $this->data['url_current'] = $url_current;
        
        if ($this->input->post())
        {
            $this->username = $this->input->post('u_n');
            
            $this->password = $this->input->post('p_w');
            
            $this->remember = $this->input->post('remember_user');
            
            /*
             *  Validate
             */
            $this->form_validation->set_rules('u_n', 'Username', 'trim|required|xss_clean|max_length[50]');
             
            $this->form_validation->set_rules('p_w', 'Password', 'trim|required|xss_clean|max_length[50]|callback_check_login');
        
            if ($this->form_validation->run() == FALSE)
            {
                $this->data['error'] = validation_errors();
                
                $this->load->view('frontend/request/login', $this->data);
            }   
            else
            {
                if ($url_current != '')     
                    echo '<script>window.parent.location.href="' . urldecode($url_current) . '";</script>';
                else
                    echo '<script>window.parent.location.href="opener.location.reload()";</script>';    
            }
        }
        else
        {
            $this->load->view('frontend/request/login', $this->data);
        }
        
      }
      
      public function check_login()
      {
        $this->load->model(array('frontend/user_model'));
        
        //Lay thong tin user
        $user = $this->user_model->find_by(array(
            'email' => $this->username, 
            'password' => encrypt_password($this->password),
            'status' => 1,
            'deleted' => 0,
        ));
        
        //Success
        if (!empty($user))
        {
            /*
             * User
             */
            $user_info = new stdClass();
            $user_info->id = $user->id;
            $user_info->email = $user->email;
            $user_info->name = $user->name;
            
            /*
             * Save session user
             */
            $this->session->set_userdata('user', $user_info);
            
            if ($this->remember == 1)
            {
                setcookie("user[id]", $user->id, time() + (3600 * 24 * 30));  /* expire in 1 month */
                
                setcookie("user[email]", $user->email, time() + (3600 * 24 * 30)); 
                
                setcookie("user[name]", $user->name, time() + (3600 * 24 * 30)); 
            }
           
            return true;
        }
        //Fail
        else
        {
            $this->form_validation->set_message('check_login', 'Email hoặc mật khẩu không đúng.');

            return false;
        }
    }

    public function comment()
    {
        $this->load->model(array('hotel_comment_model'));

        if (!$this->session->userdata('user')) {
            echo false;
            return false;
        }
        $comment_body = $this->input->post('comment_body');

        $hotel_id = $this->input->post('hotel_id');

        $rating = $this->input->post('rating');

        $user = $this->session->userdata('user');

        $data = array(
            'content' => trim($comment_body),
            'user_id' => $user->id,
            'status' => 2,
            'hotel_id' => $hotel_id,
            'create_time' => date('Y-m-d H:i:s'),
            'evaluation' => $rating,
            'deleted' => 0,
        );

        if ($this->hotel_comment_model->insert($data))
            echo true;
    }

    public function write_comment_tour()
    {
        $this->load->model(array('tour_comment_model'));

        if (!$this->session->userdata('user')) {
            echo false;
            return false;
        }
        $comment_body = $this->input->post('comment_body');

        $tour_id = $this->input->post('tour_id');

        $rating = $this->input->post('rating');

        $user = $this->session->userdata('user');

        $data = array(
            'content' => trim($comment_body),
            'user_id' => $user->id,
            'status' => 2,
            'tour_id' => $tour_id,
            'create_time' => date('Y-m-d H:i:s'),
            'evaluation' => $rating,
            'deleted' => 0,
        );

        if ($this->tour_comment_model->insert($data))
            echo true;
    }


    public function check_ajax_coupon() {

        $params = array();
        $params['coupon_code']  = $this->input->post('coupon');
        $params['area_id']      = $this->input->post('area_id');
        $params['hotel_id']     = $this->input->post('hotel_id');
        $params['night']        = $this->input->post('night');
        $params['price_total']  = $this->input->post('price_total');
        $params['email']        = $this->input->post('email');
        $params['phone']        = $this->input->post('phone');

        echo json_encode(check_coupon($params));
    }
}
