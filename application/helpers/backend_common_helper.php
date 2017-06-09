<?php
function encrypt_password($password)
{
    if ($password != '')
    {
        return md5(md5($password));
    }
    return false;
}

function show_mesg_success($mesg)
{
    $str = '<div class="row-fluid margin-top">
            	<div class="span12">
            		<div class="alert alert-success">		
                        ' . $mesg . '
            		</div>
            	</div>
            </div>';
    echo $str;
}

function show_mesg_error($mesg)
{
    $str = '<div class="row-fluid margin-top">
            	<div class="span12">
            		<div class="alert alert-danger">
                        ' . $mesg . '
            		</div>
            	</div>
            </div>';
    echo $str;
}

function breadcrumb($params, $separator = '<i class="icon-angle-right"></i>')
{   
    $str = '<div class="breadcrumbs">
				<ul>
					%s
				</ul>
				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i></a>
				</div>
			</div>';
     
    $strReplace = '';
    $countParams = count($params);
    $t = 1;        
    if ($countParams > 0)
    {
        foreach($params as $k => $v)
        {
           if ($t == $countParams) 
                $separator = '';
                
           $strReplace .= '<li>
						      <a href="' . $v . '">' . $k . '</a>
						      ' . $separator . '
	                       </li>';
           $t++; 
        }
        
        return sprintf($str, $strReplace);
    }
}


function format_alias($str)
{    
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/is", 'a', $str);

    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/is", 'e', $str);

    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/is", 'i', $str);

    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/is", 'o', $str);

    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);

    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);

    $str = preg_replace("/(đ)/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);

    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);

    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);

    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);

    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);

    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);

    $str = preg_replace("/(Đ)/", 'D', $str);

    $str = preg_replace("/(!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_)/", '-', $str);

    $str = preg_replace("/(-+-)/", '-', $str);

    $str = preg_replace("/(^\-+|\-+$)/", '', $str);    

    return strtolower($str);
}

function day_name($day)
{
    if ($day >= 0)
    {
        $day_name = '';
        
        switch($day)
        {
            case '1': $day_name = 'Hai'; break;
            
            case '2': $day_name = 'Ba'; break;
            
            case '3': $day_name = 'Tư'; break;
            
            case '4': $day_name = 'Năm'; break;
            
            case '5': $day_name = 'Sáu'; break;
            
            case '6': $day_name = 'Bảy'; break;
            
            default: $day_name = 'Chủ nhật'; break;
        }
        
        return $day_name;
    }
    return false;
}

function show_price_bk($price)
{
    if (!empty($price))
        return number_format($price, 0, '.', '.');

    return 0;
}

function check_own_hotel($group_id, $user_id, $hotel_id)
{
    $ci =& get_instance();

    $ci->load->model(array('hotel_tmp_model'));

    /*
     * Check permission hotel of sale
     */
    if ($group_id == 2)
    {
        $hotel_permission = $ci->hotel_tmp_model->find_by(array('id' => $hotel_id, 'user_id' => $user_id));
        
        if (empty($hotel_permission))
            return false;
    }
    return true;
}

function check_wait_verify_room($hotel_id)
{
    $ci =& get_instance();

    $ci->load->model(array('room_type_tmp_model'));

    $room_active = $ci->room_type_tmp_model->select('COUNT(id) as total')->find_by(array('hotel_id' => $hotel_id, 'deleted' => 0, 'status <> 1' => NULL));

    $total = $ci->room_type_tmp_model->select('COUNT(id) as total')->find_by(array('hotel_id' => $hotel_id, 'deleted' => 0));
    
    if ($total->total == 0)
        return 'Không';

    if ($room_active->total != 0)
        return 'Chờ duyệt';

    return NULL;
}

function check_wait_verify_promotion($hotel_id)
{
    $ci =& get_instance();

    $ci->load->model(array('promotion_tmp_model'));

    $promotion = $ci->promotion_tmp_model->select('COUNT(id) as total')->find_by(array('hotel_id' => $hotel_id, 'deleted' => 0, 'status <> 1' => NULL));

    $total = $ci->promotion_tmp_model->select('COUNT(id) as total')->find_by(array('hotel_id' => $hotel_id, 'deleted' => 0));

    if ($total->total == 0)
        return 'Không';

    if ($promotion->total != 0)
        return 'Chờ duyệt';

    return NULL;
}

function bk_format_date($format, $date)
{
    if (!empty($format) && !empty($date))
    {
        $arr_date = explode(' ', $date);

        if (count($arr_date) == 1)
            return date($format, strtotime($date));
        else
            return date($format, strtotime($arr_date[0])) . ' ' . $arr_date[1];
    }

    return false;
}

function list_status_order()
{
    return array(
        '2' => 'Chờ xử lý',
        '3' => 'Đang xử lý',
        '4' => 'Thất bại',
        '5' => 'Chờ duyệt',
        '6' => 'Thành công',
        '7' => 'Hủy',
    );
}

function show_status_order($status)
{
    $name = '';

    switch ($status) {

        case '2':
            $name = '<span style="color: #f8a31f; font-weight: bold">Chờ xử lý</span>';
            break;

        case '3':
            $name = '<span style="color: #006dcc; font-weight: bold">Đang xử lý</span>';
            break;

        case '4':
            $name = '<span style="color: #222222; font-weight: bold">Thất bại</span>';
            break;

        case '5':
            $name = '<span style="color: #e671b8; font-weight: bold">Chờ duyệt</span>';
            break;  

        case '6':
            $name = '<span style="color: #393; font-weight: bold">Thành công</span>';
            break;  

        case '7':
            $name = '<span style="color: #bd362f; font-weight: bold">Hủy</span>';
            break;         

        default:
            break;
    }
    return $name;
}

function show_paid($paid)
{
    switch ($paid) {
        case '0':
            return '<span style="color: #b94a48; font-weight: bold">Chưa thanh toán</span>';
            break;

        case '2':
            return '<span style="color: #f8a31f; font-weight: bold">Đã thanh toán 1 phần</span>';
            break;

        default:
            return '<span style="color: #468847; font-weight: bold">Đã thanh toán</span>';
            break;
    }
}

function show_deposit_partner($status)
{
    switch ($status) {
        case '0':
            return '<span style="color: #b94a48; font-weight: bold">Chưa thanh toán</span>';
            break;

        case '1':
            return '<span style="color: #468847; font-weight: bold">Đã thanh toán</span>';
            break;
    }
}

function diffrence_str($name, $diffrence)
{
    if (!preg_match('/::/', $name))
    {
        if (isset($diffrence[$name]))
            return '<span class="help-block diffrence">Được cập nhật</span>';
    }
    else
    {
        $name_arr = explode('::', $name);

        foreach($name_arr as $v)
        {
            if (isset($diffrence[$v]))
                return '<span class="help-block diffrence">Được cập nhật</span>';
        }
    }


    return false;
}

function hash_auth_pdf_order_hotel($email, $hotel_id, $order_id)
{
    return md5($email . '::' . $hotel_id . '::' . $order_id);
}

function hash_auth_pdf_order_tour($email, $tour_id, $order_id)
{
    return md5($email . '::' . $tour_id . '::' . $order_id);
}