<?php

function format_title($str)
{
    if (!$str)
    {
        return false;
    }
    $str = strip_tags($str);
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd' => 'đ', 'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i' => 'í|ì|ỉ|ĩ|ị', 'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D' => 'Đ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',);
    foreach ($unicode as $nonUnicode => $uni)
    {
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $strText = preg_replace('/[^A-Za-z0-9-]/', ' ', $str);
    $strText = preg_replace('/ +/', ' ', $strText);
    $strText = trim($strText);
    $strText = str_replace(' ', '-', $strText);
    $strText = preg_replace('/-+/', '-', $strText);
    $strText = preg_replace("/-$/", "", $strText);

    return strtolower($strText);
}

function show_picture($picture, $width = '', $height = '', $type = 'hotel')
{
    $ci = & get_instance();

    $url_thumb = base_url() . 'public/thumbs/timthumb.php?src=';

    $url_pic = $url_thumb . $ci->config->item('pic_url');

    switch ($type)
    {
        case 'hotel':
            $url_pic .= 'hotels/' . $picture;
            break;

        case 'province':
            $url_pic .= 'provinces/' . $picture;
            break;

        case 'display':
            $url_pic .= 'displays/' . $picture;
            break;

        case 'sight':
            $url_pic .= 'sights/' . $picture;
            break;

        case 'handbook':
            $url_pic .= 'handbooks/' . $picture;
            break;

        case 'tour':
            $url_pic .= 'tours/' . $picture;
            break;

        case 'national':
            $url_pic .= 'nationals/' . $picture;
            break;

        default:
            break;
    }

    if (!empty($width))
        $url_pic .= '&w=' . $width;

    if (!empty($height))
        $url_pic .= '&h=' . $height;

    return $url_pic;
}

function show_price($price)
{
    if (!empty($price))
        return number_format($price, 0, '.', '.') . 'đ';

    return 'Liên hệ để lấy giá tốt';
}

function show_point($point)
{
    $p = 0;
    if (!empty($point))
        $p = round($point, 1);
        
    if (strlen($p) == 1)
        $p .= '.0';
        
    return $p;        
}

function show_point_detail($hotel_id)
{
    if (!empty($hotel_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/hotel_comment_model');

        $ci->hotel_comment_model->select('AVG(evaluation) as point');

        $record = $ci->hotel_comment_model->find_by(array('hotel_id' => $hotel_id, 'status' => 1, 'deleted' => 0));

        return $record->point;
    }
}

function show_point_tour_detail($tour_id)
{
    if (!empty($tour_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/tour_comment_model');

        $ci->tour_comment_model->select('AVG(evaluation) as point');

        $record = $ci->tour_comment_model->find_by(array('tour_id' => $tour_id, 'status' => 1, 'deleted' => 0));

        return $record->point;
    }
}

function show_bookmark($point)
{
    $str = '';

    if ($point <= 5)
    {
        $str .= 'Thấp';
    }

    if ($point > 5 && $point <= 6)
    {
        $str .= 'Trung bình';
    }
    if ($point > 6 && $point <= 7)
    {
        $str .= 'Hài lòng';
    }
    if ($point > 7 && $point <= 8)
    {
        $str .= 'Rất tốt';
    }
    if ($point > 8 && $point <= 9)
    {
        $str .= 'Tuyệt vời';
    }
    if ($point > 9 && $point <= 10)
    {
        $str .= 'Xuất sắc';
    }

    return $str;
}

function show_comment_total($hotel_id)
{
    if (!empty($hotel_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/hotel_comment_model');

        $ci->hotel_comment_model->select("COUNT(id) as total");

        $comment = $ci->hotel_comment_model->find_by(array('hotel_id' => $hotel_id, 'status' => 1, 'deleted' => 0));

        return $comment->total;
    }

    return false;
}

function show_tour_comment_total($hotel_id)
{
    if (!empty($hotel_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/tour_comment_model');

        $ci->tour_comment_model->select("COUNT(id) as total");

        $comment = $ci->tour_comment_model->find_by(array('tour_id' => $hotel_id, 'status' => 1, 'deleted' => 0));

        return $comment->total;
    }

    return false;
}

function show_hotel_total($province_id)
{
    if (!empty($province_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/hotel_model');

        $ci->hotel_model->select("COUNT(id) as total");

        $comment = $ci->hotel_model->find_by(array('province_id' => $province_id, 'status' => 1, 'deleted' => 0));

        return $comment->total;
    }
}

function show_tour_total($province_id)
{
    if (!empty($province_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/tour_model');

        $ci->tour_model->select("COUNT(id) as total");

        $result = $ci->tour_model->find_by(array('to_province_id' => $province_id, 'status' => 1, 'deleted' => 0));

        return $result->total;
    }
}

function show_tour_total_by_national($national_id)
{
    if (!empty($national_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/tour_model');

        $ci->tour_model->select("COUNT(id) as total");

        $result = $ci->tour_model->find_by(array('to_national_id' => $national_id, 'status' => 1, 'deleted' => 0));

        return $result->total;
    }
}

function format_date($format, $date)
{
    if (!empty($format) && !empty($date))
    {
        return date($format, strtotime(str_replace('/', '-', $date)));
    }

    return false;
}

function show_day_of_week($date)
{
    if (!empty($date))
    {
        return date('N', strtotime(str_replace('/', '-', $date)));
    }

    return false;
}

function show_price_low($hotel_id, $day_range = '')
{
    if (!empty($hotel_id))
    {
        $ci = & get_instance();

        $ci->load->model(array('frontend/room_price_model', 'frontend/room_type_model', 'frontend/setting_model'));

        $where = array();
        $where['room_price.hotel_id'] = $hotel_id;
        $where['room_price.day != 8'] = NULL;
        $where['room_price.status'] = 1;
        $where['room_price.deleted'] = 0;
        $where['room_price.hide_price'] = 0;   
        
        if (!empty($day_range))
            $where['room_price.day IN (' . implode(',', $day_range) . ')'] = NULL;

        $record = $ci->room_price_model->order_by('price', 'asc')->find_by($where);

        if (empty($record))
            return show_price(0);
            
        $room = $ci->room_type_model->find($record->room_id);
        
        $setting = $ci->setting_model->find(1);
        
        if ($room->price_type == 'usd')
            $record->price = $setting->value * $record->price;

        return show_price($record->price);
    }
}

function show_link($id, $name, $type = 'hotel')
{
    $link = base_url();

    if ($type == 'hotel')
        $link .= 'h/' . format_title($name) . '-' . $id . '.html';
    elseif ($type == 'province')
        $link .= 's/' . format_title($name) . '.html?type=p&id=' . $id;
    elseif ($type == 'district')
        $link .= 's/' . format_title($name) . '.html?type=d&id=' . $id;
    elseif ($type == 'sight')
        $link .= 's/' . format_title($name) . '.html?type=si&id=' . $id;
    elseif ($type == 'geonear')
        $link .= 's/' . format_title($name) . '.html?type=ge&id=' . $id;
    elseif ($type == 'prm')
        $link .= 's/' . format_title($name) . '.html?type=prm';
    elseif ($type == 'page')
        $link .= 'p/' . format_title($name) . '.html?id=' . $id;
    elseif ($type == 'handbook')
        $link .= 'hb/' . format_title($name) . '.html';
    elseif ($type == 'handbook_detail')
        $link .= 'hb/' . format_title($name) . '-' . $id .'.html';
    elseif ($type == 'tour')
        $link .= 'tour.html';
    elseif ($type == 'tour_detail')
        $link .= 'tour/' . format_title($name) . '-' . $id . '.html';
    elseif ($type == 'tour_national')
        $link .= 'tour/' . format_title($name) . '.html?type=na&id=' . $id;
    elseif ($type == 'tour_province')
        $link .= 'tour/' . format_title($name) . '.html?type=p&id=' . $id;
    elseif ($type == 'login')
        $link .= 'dang-nhap';
    elseif ($type == 'logout')
        $link .= 'thoat';    
    elseif ($type == 'registration')
        $link .= 'dang-ky';  
    elseif ($type == 'forget_pass')
        $link .= 'quen-mat-khau';   
    elseif ($type == 'booking')
        $link .= 'booking';        
    return $link;
}

function show_hotel_facilities($hotel_id)
{
    if (!empty($hotel_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/hotel_model');

        $ci->load->model('frontend/hotel_facilities_model');

        $hotel = $ci->hotel_model->find_by(array('status' => 1, 'id' => $hotel_id));

        $facilities = $ci->hotel_facilities_model->find_where_in('id', explode(',', $hotel->facilities_id));

        return $facilities;
    }
    return false;
}

function check_promotion($hotel_id)
{
    if (!empty($hotel_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/promotion_model');

        $ci->promotion_model->select('COUNT(id) as num');
        $record = $ci->promotion_model->find_by(array('status' => 1, 'hotel_id' => $hotel_id, 'deleted' => 0, 'night' => 1));

        if ($record->num > 0)
            return $record->num;

        return false;
    }
}

function check_promotion_by_day($hotel_id, $date_from, $date_to, $night)
{
    if (!empty($hotel_id))
    {
        $ci = & get_instance();

        $ci->load->model('frontend/promotion_model');

        $where = 'status = 1';

        $where .= ' AND hotel_id = ' . $hotel_id;

        //  Ngay ap dung
        $where .= ' AND (date_apply_from <= "' . date('Y-m-d') . '"  AND date_apply_to >= "' . date('Y-m-d') . '")';

        //  Ngay o
        $where .= ' AND (stay_day_from <= "' . $date_from . '"  AND stay_day_to >= "' . $date_from . '")';
        
        //  Ngay dat
        $where .= ' AND (book_day_from <= "' . date('Y-m-d') . '"  AND book_day_to >= "' . date('Y-m-d') . '")';

        //  Dem o toi thieu
        $where .= ' AND (night <= ' . $night . ')';
        
        $where .= ' AND (deleted = 0 AND status = 1)';

        $ci->promotion_model->select('COUNT(id) as num');
        
        $record = $ci->promotion_model->find_by(array($where => NULL));

        if ($record->num > 0)
            return $record->num;

        return false;
    }
}

function show_day_between_date($date_from, $date_to)
{
    $datetime1 = new DateTime($date_from); // Y-m-d

    $datetime2 = new DateTime($date_to); // Y-m-d

    $interval = $datetime1->diff($datetime2);

    return $interval->format("%a");
}

function show_facilities_room($str_facilities_id)
{
    $ci = & get_instance();
    
    $ci->load->model('frontend/room_type_facilities_model');
    
    $where = 'deleted = 0 AND status = 1 AND id IN (' . $str_facilities_id . ')';

    return $ci->room_type_facilities_model->find_all_by(array($where => NULL));
}

function show_date($date, $format = 'd/m/Y')
{
    if (!empty($date))
    {
        return date($format, strtotime($date));
    }
    return false;
}

function get_avg_price($date_from, $date_to, $room_id)
{
    $ci =& get_instance();

    $ci->load->model(array('frontend/room_price_model', 'frontend/room_type_model', 'frontend/setting_model', 'frontend/hotel_model', 'frontend/room_price_stage_model'));

    $room_type = $ci->room_type_model->find($room_id);
    
    $hotel = $ci->hotel_model->find($room_type->hotel_id);

    $room_type_holiday = explode(',', $room_type->holiday);

    $price = 0;

    $night = show_day_between_date($date_from, $date_to);

    $price_stage = $ci->room_price_stage_model->find_all_by(array('hotel_id' => $room_type->hotel_id, 'room_id' => $room_type->id));

    $setting = $ci->setting_model->find(1);

    for($i = 0; $i < $night; $i++)
    {
        $day_normal = true;

        $date_f = date('Y-m-d', strtotime('+' . $i .' day', strtotime($date_from)));

        $arr_date_f = explode('-', $date_f);

        $date_check_holiday = $arr_date_f[2] . '/' . $arr_date_f[1];

        $day = show_day_of_week($date_f);

        /*
         * Ngay le
         */
        if (in_array($date_check_holiday, $room_type_holiday)) {

            $day = 8;

            $room_price = $ci->room_price_model->find_by(array('day' => $day, 'room_id' => $room_id, 'hide_price' => 0, 'status' => 1, 'deleted' => 0));

            if (!empty($room_price))
            {
                $room = $ci->room_type_model->find($room_price->room_id);

                $setting = $ci->setting_model->find(1);

                if ($room->price_type == 'usd')
                    $room_price->price = $setting->value * $room_price->price;

                $price += $room_price->price;
            }

        } else {

            /*
             * Ngay theo giai doan
             */
            if ($day != 7) {
                if ($price_stage)
                foreach ($price_stage as $v_price_stage) {

                    $p = 0;

                    if (strtotime($date_f) >= strtotime($v_price_stage->date_from)
                        && strtotime($date_f) <= strtotime($v_price_stage->date_to)
                    ) {

                        if ($room_type->price_type == 'usd') {
                            $p = $setting->value * $v_price_stage->price;
                        } else {
                            $p = $v_price_stage->price;
                        }

                        $price += $p;

                        $day_normal = false;

                        break;
                    }
                }
            }

            if ($day_normal == true) {
                /*
                 * Ngay thuong
                 */
                $room_price = $ci->room_price_model->find_by(array('day' => $day, 'room_id' => $room_id, 'hide_price' => 0, 'status' => 1, 'deleted' => 0));

                if (!empty($room_price)) {

                    if ($room_type->price_type == 'usd')
                        $room_price->price = $setting->value * $room_price->price;

                    $price += $room_price->price;
                }
            }

        }
    }

    return $price/$night;
}

function get_avg_price_origin($date_from, $date_to, $room_id)
{

    $ci =& get_instance();

    $ci->load->model(array('frontend/room_price_model', 'frontend/room_type_model', 'frontend/setting_model', 'frontend/hotel_model', 'frontend/room_price_stage_model'));

    $room_type = $ci->room_type_model->find($room_id);

    $hotel = $ci->hotel_model->find($room_type->hotel_id);

    $room_type_holiday = explode(',', $room_type->holiday);

    $price = 0;

    $night = show_day_between_date($date_from, $date_to);

    $price_stage = $ci->room_price_stage_model->find_all_by(array('hotel_id' => $room_type->hotel_id, 'room_id' => $room_type->id));

    for($i = 0; $i < $night; $i++)
    {
        $date_f = date('Y-m-d', strtotime('+' . $i .' day', strtotime($date_from)));

        $arr_date_f = explode('-', $date_f);

        $date_check_holiday = $arr_date_f[2] . '/' . $arr_date_f[1];

        $day = show_day_of_week($date_f);

        $day_normal = true;

        $setting = $ci->setting_model->find(1);

        /*
         * Ngay le
         */
        if (in_array($date_check_holiday, $room_type_holiday)) {

            $day = 8;

            $room_price = $ci->room_price_model->find_by(array('day' => $day, 'room_id' => $room_id, 'hide_price' => 0, 'status' => 1, 'deleted' => 0));

            if (!empty($room_price))
            {
                $room = $ci->room_type_model->find($room_price->room_id);

                $setting = $ci->setting_model->find(1);

                if ($room->price_type == 'usd')
                    $room_price->price = $setting->value * $room_price->price;

                $price += $room_price->price;
            }

        } else {

            /*
             * Ngay theo giai doan
             */
            if ($day != 7) {
                if ($price_stage)
                foreach ($price_stage as $v_price_stage) {

                    $p = 0;

                    if (strtotime($date_f) >= strtotime($v_price_stage->date_from)
                        && strtotime($date_f) <= strtotime($v_price_stage->date_to)
                    ) {

                        if ($room_type->price_type == 'usd') {
                            $p = $setting->value * $v_price_stage->price_origin;
                        } else {
                            $p = $v_price_stage->price_origin;
                        }

                        $price += $p;

                        $day_normal = false;

                        break;
                    }
                }
            }

            if ($day_normal == true) {
                /*
                 * Ngay thuong
                 */
                $room_price = $ci->room_price_model->find_by(array('day' => $day, 'room_id' => $room_id, 'hide_price' => 0, 'status' => 1, 'deleted' => 0));

                if (!empty($room_price)) {

                    if ($room_type->price_type == 'usd')
                        $room_price->price_origin = $setting->value * $room_price->price_origin;

                    $price += $room_price->price_origin;
                }
            }

        }
    }

    return $price/$night;

}

function get_range_day_now($date_from = '', $date_to = '')
{
    $data = array();

    $data['search']['df'] = date('d/m/Y', strtotime('+1 day'));

    if ($date_from != '')
        $data['search']['df'] = $date_from;

    $data['search']['dt'] = date('d/m/Y', strtotime('+2 day'));

    if ($date_to != '')
        $data['search']['dt'] = $date_to;

    $data['search']['day_from'] = show_day_of_week($data['search']['df']);

    $data['search']['day_to'] = show_day_of_week($data['search']['dt']);

    // Day
    if ($data['search']['day_from'] < $data['search']['day_to'])
        $range_day = range($data['search']['day_from'], $data['search']['day_to']);
    else if($data['search']['day_from'] > $data['search']['day_to'])
        $range_day = array_merge(range($data['search']['day_from'], 7), range(1, $data['search']['day_to']));
    
    array_pop($range_day);

    return $range_day;
}

function show_name_day_of_week($day)
{
    if ($day >= 0)
    {
        $day_name = '';
        
        switch($day)
        {
            case '1': $day_name = 'Thứ Hai'; break;
            
            case '2': $day_name = 'Thứ Ba'; break;
            
            case '3': $day_name = 'Thứ Tư'; break;
            
            case '4': $day_name = 'Thứ Năm'; break;
            
            case '5': $day_name = 'Thứ Sáu'; break;
            
            case '6': $day_name = 'Thứ Bảy'; break;
            
            default: $day_name = 'Chủ nhật'; break;
        }
        
        return $day_name;
    }
    return false;
}

function show_payment_type($payment_type)
{
    $name = '';
    
    switch($payment_type)
    {
        case 1:
            $name = 'Thanh toán tại văn phòng Azy';
            break;
            
        case 2:
            $name = 'Chuyển khoản';
            break;
        
        case 3:
            $name = 'Thẻ ATM nội địa';
            break;
            
        case 4:
            $name = 'Thẻ quốc tế Visa, Master';
            break;            
    }
    
    return $name;
}

function real_ip()
{
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
		$_SERVER['REMOTE_ADDR']=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
    elseif(isset($_SERVER['HTTP_X_REAL_IP']))
    {
		$_SERVER['REMOTE_ADDR']=$_SERVER['HTTP_X_REAL_IP'];
	}
    return $_SERVER['REMOTE_ADDR'];
}

function getNameTime($time) {
    if ($time != null) {
        $unixTime = strtotime($time);
        $timeNow = time();
        $arrTime = explode(' ', $time);
        $date = $arrTime[0];
        $hour = $arrTime[1];
        $arrDate = explode('-', $date);
        $arrHour = explode(':', $hour);
        $lastTime = $timeNow - $unixTime;
        $minuteLastTime = round($lastTime / 60);
        $hourLastTime = round(($lastTime / 60) / 60);

        if ($minuteLastTime == 0) {
            $nameTime = 'Mới đây';
        } else if ($minuteLastTime < 60) {
            $nameTime = $minuteLastTime . ' phút';
        } else if ($minuteLastTime > 60 && $hourLastTime < 24) {
            $nameTime = $hourLastTime . ' giờ';
        } else if ($hourLastTime > 24 && $hourLastTime < 48) {
            $nameTime = 'Hôm qua lúc ' . $arrHour[0] . ':' . $arrHour[1];
        } else if ($hourLastTime > 48 && $arrDate[0] == date('Y')) {
            $nameTime = $arrDate[2] . ' tháng ' . $arrDate[1] . ' lúc ' . $arrHour[0] . ':' . $arrHour[1];
        } else {
            $nameTime = $arrDate[2] . ' tháng ' . $arrDate[1] . ' ' . $arrDate[0] . ' lúc ' . $arrHour[0] . ':' . $arrHour[1];
        }
        return $nameTime;
    }
}

function checkShowPage($id) {
    $ci =& get_instance();

    $ci->load->model(array('frontend/page_model'));

    $record = $ci->page_model->find($id);

    return $record->status;
}

function check_coupon($params) {

    $error = '';

    $ci =& get_instance();

    $ci->load->model(array('frontend/coupon_group_model', 'frontend/coupon_model', 'frontend/hotel_order_model'));

    $coupon         = $params['coupon_code'];
    $area_id        = $params['area_id'];
    $hotel_id       = $params['hotel_id'];
    $night          = $params['night'];
    $price_total    = $params['price_total'];
    $email          = $params['email'];
    $phone          = $params['phone'];

    $coupon = $ci->coupon_model->find_by(array('code' => $coupon, 'status' => 1));

    $price_payment = 0;

    if (!empty($coupon)) {
        $coupon_group = $ci->coupon_group_model->find_by(array('id' => $coupon->group, 'status' => 1));

        if (!empty($coupon_group)) {

            $where = array();

            //Check area
            if ($coupon_group->area != '') {
                $where['area LIKE "%,' . $area_id . ',%"'] = null;
            }

            //Check hotel
            if ($coupon_group->hotel != '') {
                $where['hotel LIKE "%,' . $hotel_id . ',%"'] = null;
            }

            //Check use date
            $where['use_date_from <= "' . date('Y-m-d') . '"'] = NULL;
            $where['use_date_to >= "' . date('Y-m-d') . '"'] = NULL;

            //Check order date
            $where['order_date_from <= "' . date('Y-m-d') . '"'] = NULL;
            $where['order_date_to >= "' . date('Y-m-d') . '"'] = NULL;

            //Check night
            $where['night = ' . $night] = NULL;

            $check_coupon_group = $ci->coupon_group_model->find_by($where);

            if (empty($check_coupon_group)) {
                $error = 'Mã khuyến mãi không hợp lệ';
            }

            if ($error == '') {
                //Check use time
                $check_coupon_group = $ci->hotel_order_model->find_by(array('coupon' => $coupon->code));
                if (!empty($check_coupon_group)) {
                    $error = 'Mã khuyến mãi đã được sử dụng';
                }
            }

            if ($error == '') {
                $where = array();
                $where['hotel_order.coupon IS NOT NULL'] = null;
                $where['(hotel_order_contact.email = "' . $email . '" || hotel_order_contact.phone = "' . $phone . '")'] = null;
				$where['coupon.group = ' . $coupon_group->id] = null;
                $ci->hotel_order_model->join('hotel_order_contact', 'hotel_order.id = hotel_order_contact.order_id');
				$ci->hotel_order_model->join('coupon', 'coupon.code = hotel_order.coupon');
                $use_time = $ci->hotel_order_model->where($where)->count_all();

                if ($use_time >= $coupon_group->use_time) {
                    $error = 'Thông tin đặt phòng đã từng tham gia khuyến mãi trong thời gian này. Khuyến mãi không hợp lệ.';
                }

                if ($error == '') {
                    $price_coupon = ($price_total * $coupon_group->discount) / 100;
                    $price_coupon = min($price_coupon, $coupon_group->discount_max_price);

                    $price_payment = $price_total - $price_coupon;
                    return array('ReturnCode' => true, 'Price_payment' => show_price($price_payment), 'Price_coupon' => show_price($price_coupon));
                }
            }
        }
    } else {
        $error = 'Mã khuyến mãi không tồn tại';
    }

    return array('ReturnCode' => false, 'Price_payment' => $price_payment, 'Error' => $error);
}

function show_button_like_face($option) {
    $html = '<meta property="og:url" content="' . $option['url'] . '" />
                    <meta property="og:type"          content="website" />
                    <meta property="og:title"         content="' . $option['title'] . '" />
                    <meta property="og:description"   content="' . $option['description'] . '" />
                    <meta property="og:image"         content="' . $option['picture'] . '" />

                    <div class="fb-like"
                         data-href="' . $option['url'] . '"
                         data-layout="standard"
                         data-action="like"
                         data-show-faces="true"
                         data-share="true">
                    </div>';

    return $html;
}