<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller
{
    /*
     *  Load ajax area
     */

    public function load_area()
    {
        $this->load->model(array('area_model'));

        $national_id = $this->input->post('national_id');

        $area = $this->area_model->find_all_by(array('national_id' => $national_id, 'deleted' => 0));

        $str_area_options = '<option value="">--- Chọn Miền ---</option>';

        foreach ($area as $v) {
            $str_area_options .= '<option value="' . $v->id . '">' . html_escape($v->name) . '</option>';
        }

        echo $str_area_options;
    }

    /*
     *  Load ajax province
     */

    public function load_province()
    {
        $this->load->model(array('province_model'));

        $area_id = $this->input->post('area_id');

        $province = $this->province_model->find_all_by(array('area_id' => $area_id, 'deleted' => 0));

        $str_province_options = '<option value="">--- Chọn Tỉnh/Thành ---</option>';

        foreach ($province as $v) {
            $str_province_options .= '<option value="' . $v->id . '">' . html_escape($v->name) . '</option>';
        }

        echo $str_province_options;
    }

    /*
     *  Load ajax district
     */

    public function load_district()
    {
        $this->load->model(array('district_model'));

        $province_id = $this->input->post('province_id');

        $district = $this->district_model->find_all_by(array('province_id' => $province_id, 'deleted' => 0));

        $str_district_options = '<option value="">--- Chọn Quận/Huyện ---</option>';

        foreach ($district as $v) {
            $str_district_options .= '<option value="' . $v->id . '">' . html_escape($v->name) . '</option>';
        }

        echo $str_district_options;
    }

    /*
     *  Load ajax ward
     */

    public function load_ward()
    {
        $this->load->model(array('ward_model'));

        $district_id = $this->input->post('district_id');

        $ward = $this->ward_model->find_all_by(array('district_id' => $district_id, 'deleted' => 0));

        $str_ward_options = '<option value="">--- Chọn Phường/Xã ---</option>';

        foreach ($ward as $v) {
            $str_ward_options .= '<option value="' . $v->id . '">' . html_escape($v->name) . '</option>';
        }

        echo $str_ward_options;
    }

    /*
     *  Load ajax geonear
     */

    public function load_geonear()
    {
        $this->load->model(array('geonear_model'));

        $district_id = $this->input->post('district_id');

        $geonear = $this->geonear_model->find_all_by(array('district_id' => $district_id, 'deleted' => 0));

        $str_geonear_options = '<option value="">--- Chọn Khu vực ---</option>';

        foreach ($geonear as $v) {
            $str_geonear_options .= '<option value="' . $v->id . '">' . html_escape($v->name) . '</option>';
        }

        echo $str_geonear_options;
    }

    /*
     *  Load ajax sight
     */

    public function load_sight()
    {
        $this->load->model(array('sight_model'));

        $district_id = $this->input->post('district_id');

        $sight = $this->sight_model->find_all_by(array('district_id' => $district_id, 'deleted' => 0));

        $str_sight_options = '<option value="">--- Chọn Địa danh ---</option>';

        foreach ($sight as $v) {
            $str_sight_options .= '<option value="' . $v->id . '">' . html_escape($v->name) . '</option>';
        }

        echo $str_sight_options;
    }

    /*
     *  Load ajax beach
     */

    public function load_beach()
    {
        $this->load->model(array('beach_model'));

        $province_id = $this->input->post('province_id');

        $beach = $this->beach_model->find_all_by(array('province_id' => $province_id, 'deleted' => 0));

        $str_beach_options = '<option value="">--- Chọn Bãi biển ---</option>';

        foreach ($beach as $v) {
            $str_beach_options .= '<option value="' . $v->id . '">' . html_escape($v->name) . '</option>';
        }

        echo $str_beach_options;
    }

    /*
     * Upload list image ajax
     */

    public function upload_list_image()
    {
        $this->load->model(array('image_tmp_model'));

        $config = $this->config->item('upload_img');

        $valid_formats = explode('|', $config['allowed_types']);

        $max_size = $config['max_size'];

        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            $uploaddir = $this->config->item('pic_path') . 'tmp/';

            $uploadurl = $this->config->item('pic_url') . 'tmp/';

            foreach ($_FILES['photos']['name'] as $name => $value) {
                $filename = stripslashes($_FILES['photos']['name'][$name]);

                $size = filesize($_FILES['photos']['tmp_name'][$name]);

                $i = strrpos($filename, ".");

                if (!$i)
                    return "";

                $l = strlen($filename) - $i;

                $ext = substr($filename, $i + 1, $l);

                $ext = strtolower($ext);

                if (in_array($ext, $valid_formats)) {
                    if ($size < ($max_size * 1024)) {
                        $image_name = time() . $filename;

                        $newname = $uploaddir . $image_name;

                        if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) {
                            $gallery = '<li>
                                            <a href="#">
                                                    <img src="' . $uploadurl . $image_name . '" alt="">
                                                    <input type="hidden" name="picture_upload[]" value="' . $image_name . '" />    
                                            </a>
                                            <div class="extras">
                                                    <div class="extras-inner">
                                                            <a href="javascript:void(0)" class="del-gallery-pic-tmp" pic="' . $image_name . '"><i class="icon-trash"></i></a>
                                                    </div>
                                            </div>
                                        </li>';

                            /*
                             * Save database
                             */
                            $this->image_tmp_model->insert(array('name' => $image_name, 'create_time' => time() + 3600, 'type' => 'hotel'));

                            echo $gallery;
                        } else {
                            echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
                        }
                    } else {
                        echo '<span class="imgList">You have exceeded the size limit!</span>';
                    }
                } else {
                    echo '<span class="imgList">Unknown extension!</span>';
                }
            }
        }
    }

    /*
     * Delete picture hotel
     */
    public function delete_pic_hotel()
    {
        $this->load->model(array('hotel_image_model'));

        $pic_id = $this->input->post('pic_id');

        $picture = $this->hotel_image_model->find($pic_id);

        $delete = $this->hotel_image_model->delete($pic_id);

        if ($delete) {
            unlink($this->config->item('pic_path') . 'hotels/' . $picture->name);

            echo true;
        }

        echo false;
    }

    /*
     * Delete picture hotel
     */
    public function delete_pic_tour()
    {
        $this->load->model(array('tour_image_model'));

        $pic_id = $this->input->post('pic_id');

        $picture = $this->tour_image_model->find($pic_id);

        $delete = $this->tour_image_model->delete($pic_id);

        if ($delete) {
            unlink($this->config->item('pic_path') . 'tours/' . $picture->name);

            echo true;
        }

        echo false;
    }

    /*
     *  Upload image tmp
     */
    public function upload_tmp()
    {
        $type = $this->input->get('type');

        $this->load->model(array('image_tmp_model'));

        $config = $this->config->item('upload_img');

        $config['upload_path'] = $this->config->item('pic_path') . 'tmp/';

        $config['file_name'] = time() . '_' . $_FILES['img']['name'];

        $this->upload->initialize($config);

        /*
         * Upload image tmp
         */
        if (!$this->upload->do_upload('img')) {
            echo json_encode(array('code' => 1, 'mesg' => strip_tags($this->upload->display_errors())));
        } else {
            /*
             * Save database
             */
            $this->image_tmp_model->insert(array('name' => $config['file_name'], 'create_time' => time() + 3600, 'type' => $type));

            echo json_encode(array('code' => 0, 'url' => $this->config->item('pic_url') . 'tmp/' . $config['file_name'], 'img_name' => $config['file_name']));
        }
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
        $this->session->set_userdata(array('captcha_word' => $this->data['captcha']['word']));

        echo $this->data['captcha']['image'];
    }

    /*
     * Count order waitting process
     */
    function count_order_wait_process()
    {
        $this->load->model(array('hotel_order_model'));

        echo $this->hotel_order_model->where(array('status' => 2))->count_all();
    }

    /*
     * Count order waitting verify
     */
    function count_order_wait_verify()
    {
        $this->load->model(array('hotel_order_model'));

        echo $this->hotel_order_model->where(array('status' => 5))->count_all();
    }

    /*
     * Count tour order waitting verify
     */
    function count_tour_order_wait_process()
    {
        $this->load->model(array('tour_order_model'));

        echo $this->tour_order_model->where(array('status' => 2))->count_all();
    }

    /*
     * Count tour order waitting verify
     */
    function count_tour_order_wait_verify()
    {
        $this->load->model(array('tour_order_model'));

        echo $this->tour_order_model->where(array('status' => 5))->count_all();
    }

    /*
     * PDF order hotel
     */
    function export_pdf_order_hotel()
    {
        $this->load->model(array(
            'hotel_order_model',
            'hotel_order_contact_model',
            'hotel_order_contact_stay_model',
            'hotel_order_room_model',
            'hotel_model',
            'room_type_model',
            'hotel_info_model',
            'admin_model',
        ));

        if ($this->input->get('auth') && $this->input->get('id')) {
            $auth = $this->security->xss_clean($this->input->get('auth'));
            $order_id = $this->security->xss_clean($this->input->get('id'));

            $order = $this->hotel_order_model->find($order_id);
            $order_contact = $this->hotel_order_contact_model->find_by(array('order_id' => $order_id));
            $order_contact_stay = $this->hotel_order_contact_stay_model->find_by(array('order_id' => $order_id));
            $order_room = $this->hotel_order_room_model->find_all_by(array('order_id' => $order_id));
            $hotel = $this->hotel_model->find($order->hotel_id);
            $night = show_day_between_date($order->date_stay_from, $order->date_stay_to);

            foreach ($order_room as $k => $v) {
                $order_room[$k] = $v;

                $order_room[$k]->room_info = $this->room_type_model->find($v->room_id);
            }

            //echo hash_auth_pdf_order_hotel($order_contact->email, $order->hotel_id, $order->id);

            if ($auth != hash_auth_pdf_order_hotel($order_contact->email, $order->hotel_id, $order->id))
                return false;

        }


        $room = '<table style="font-size: 9px" cellspacing="0" cellpadding="4">';
        $price_room_total = 0;
        foreach ($order_room as $v) {
            $room .= '<tr>
                        <td>' . html_escape($v->room_info->name) . ' (tối đa ' . $v->slot . ' người lớn)
                        <br>' . $v->room_number_booking . ' phòng  x
                            ' . (($v->price_bedmore != 0) ? '(' . show_price_bk($v->price_final) . ' đ + ' . show_price_bk($v->price_bedmore) . ' đ thêm giường)' : show_price_bk($v->price_final)) .
                ' đ  = ' . show_price_bk($v->price_total) . ' đ
                        </td>
                      </tr>
                      ';
            $price_room_total += $v->price_total;
        }
        $room .= '<tr><td><table cellspacing="0" cellpadding="4">
                            <tr>
                                <td>Tổng giá phòng:</td>
                                <td><strong>' . show_price_bk($price_room_total) . ' đ</strong></td>
                            </tr>
                            <tr>
                                <td>Mã khuyến mãi:</td>
                                <td><strong>' . $order->coupon . '</strong></td>
                            </tr>
                            <tr>
                                <td style="border-top: 1px solid #333">Tổng tiền thanh toán:</td>
                                <td style="border-top: 1px solid #333"><strong>' . show_price_bk($order->price_payment) . ' đ</strong></td>
                            </tr>
                            <tr><td colspan="2" align="right">(Đã bao gồm thuế và phí dịch vụ)</td></tr>
                        </table>
                    </td></tr>';
        $room .= '</table>';


        $html = '
<div style="font-size: 9px; color: #666">
    <table class="header" style="background-color: #F1F1F1;">
        <tr>
            <td><img src="/public/frontend/images/logo.png" /></td>
            <td><br><h1 style="color: #666;">PHIẾU NHẬN PHÒNG</h1></td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td>Mã đặt phòng: <span style="font-size: 13px; font-weight: bold">' . $order->order_code . '</span></td>
            <td></td>
        </tr>
    </table>

    <br><br>

    <table cellspacing="0" cellpadding="4">
        <tr>
            <td style="border-bottom: 1px solid #333;" width="48%">THÔNG TIN ĐẶT PHÒNG</td>
            <td width="10px"></td>
            <td style="border-bottom: 1px solid #333; border-top: 1px dashed #333;  border-right: 1px dashed #333; border-left: 1px dashed #333;" width="48%">THÔNG TIN THANH TOÁN</td>
        </tr>
        <tr>
            <td><table cellspacing="2" cellpadding="2" style="font-size: 9px;">
                <tr><td><strong>Khách sạn:</strong> ' . html_escape($hotel->name) . '</td></tr>
                <tr><td><strong>Địa chỉ:</strong> ' . html_escape($hotel->address) . '</td></tr>
                <tr><td><strong>Ngày nhận:</strong> ' . show_name_day_of_week(show_day_of_week($order->date_stay_from)) . ', ngày ' . show_date($order->date_stay_from) . '</td></tr>
                <tr><td><strong>Ngày trả:</strong> ' . show_name_day_of_week(show_day_of_week($order->date_stay_to)) . ', ngày ' . show_date($order->date_stay_to) . '</td></tr>
                <tr><td><strong>Số đêm:</strong> ' . $night . ' đêm</td></tr></table>
            </td>
            <td></td>
            <td rowspan="5" style="border-bottom: 1px dashed #333; border-left: 1px dashed #333; border-right: 1px dashed #333;">' . $room . '</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;">THÔNG TIN ĐẶT PHÒNG</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><table cellspacing="2" cellpadding="2" style="font-size: 9px;">
                    <tr><td><strong>Khách hàng:</strong> ' . html_escape($order_contact_stay->name) . '</td></tr>
                    <tr><td><strong>Địa chỉ:</strong> ' . html_escape($order_contact_stay->email) . '</td></tr>
                    <tr><td><strong>Điện thoại:</strong> ' . html_escape($order_contact_stay->phone) . '</td></tr>
                </table>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br><br>
    <table cellspacing="0" cellpadding="4">
        <tr>
            <td style="border-bottom: 1px dashed #333">GHI CHÚ</td>
        </tr>
        <tr>
            <td>Đã thanh toán 100% qua Azy</td>
        </tr>
    </table>
    <br><br>
    <table cellspacing="0" cellpadding="4">
        <tr>
            <td style="border: 1px dashed #333"><strong>Lưu ý:</strong><br>
            - Khi nhận phòng, Quý khách phải xuất trình phiếu này kèm theo giấy Chứng minh nhân dân hoặc Hộ chiếu.<br>
            Trường hợp Quý khách không xuất trình được, khách sạn có thể yêu cầu trả thêm chi phí hoặc không cho nhận phòng.<br>
            - Tất cả các phòng đặt trước được đảm bảo còn trống đến ngày nhận phòng.Trong trường hợp Quý khách không đến, phòng sẽ được giải phóng và xử lí theo quy định, điều khoản theo chính sách hoàn hủy.<br>
            - Tổng số tiền cho đơn đặt phòng này không bao gồm chi phí ăn uống tại quầy bar của khách sạn, chi phí điện thoại, dịch vụ giặt là,...Tất cả chi phí này sẽ thanh toán trực tiếp với khách sạn.
            </td>
        </tr>
    </table>
    <br><br><br>
    <table cellspacing="0" cellpadding="4">
        <tr>
            <td style="border-top: 1px solid #333; font-size: 8px"><strong>CÔNG TY TNHH AZY VIỆT NAM</strong>
                <br><br><strong>VP Hà Nội:</strong> Tầng 4, tòa nhà GP Invest, 170 Đê La Thành, Đống Đa - Tel: (04) 7109 9999 / (04) 7309 9899
                <br><strong>VP Hồ Chí Minh:</strong> Tầng 5, Tòa Nhà HDTC, Số 36 Bùi Thị Xuân, Q.1 - Tel: (08) 7309 9899
            </td>
        </tr>
    </table>
</div>';
        $this->load->library('my_pdf');
        $pdf = new My_pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetTitle('Phiếu nhận phòng');
        $pdf->SetHeaderMargin(0);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(0);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('dejavusans', '', 14, '', true);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Phieu_Nhan_Phong.pdf', 'I');
    }

    /*
     * PDF order hotel
     */
    function export_pdf_order_tour()
    {
        $this->load->model(array(
            'tour_order_model',
            'tour_order_contact_model',
            'tour_model',
            'admin_model',
            'province_model',
        ));

        if ($this->input->get('auth') && $this->input->get('id')) {
            $auth = $this->security->xss_clean($this->input->get('auth'));
            $order_id = $this->security->xss_clean($this->input->get('id'));

            $order = $this->tour_order_model->find($order_id);
            $order_contact = $this->tour_order_contact_model->find_by(array('order_id' => $order_id));
            $tour = $this->tour_model->find($order->tour_id);
            $order_detail = unserialize($order->content_tour);
            $order_detail = (object) $order_detail;

            $province = $this->province_model->select('id, name')->find_all_by(array('status' => 1, 'deleted' => 0));
            $province_data = array();
            foreach($province as $k => $v)
                $province_data[$v->id] = $v;


            //echo hash_auth_pdf_order_hotel($order_contact->email, $order->hotel_id, $order->id);

            if ($auth != hash_auth_pdf_order_tour($order_contact->email, $order->tour_id, $order->id))
                return false;

        }


        $room = '<table style="font-size: 9px" cellspacing="0" cellpadding="4">';
        $room .= '<tr><td>
                        <br>' . $order->slot . ' phiếu  x
                            ' . $order_detail->price .' đ  = ' . show_price_bk($order->price_payment) . ' đ
                        </td>
                      </tr>
                      ';
        $room .= '<tr><td><table cellspacing="0" cellpadding="4">
                            <tr>
                                <td>Tổng giá tour:</td>
                                <td><strong>' . show_price_bk($order->price_payment) . ' đ</strong></td>
                            </tr>
                            <tr>
                                <td style="border-top: 1px solid #333">Tổng tiền thanh toán:</td>
                                <td style="border-top: 1px solid #333"><strong>' . show_price_bk($order->price_payment) . ' đ</strong></td>
                            </tr>
                            <tr><td colspan="2" align="right">(Đã bao gồm thuế và phí dịch vụ)</td></tr>
                        </table>
                    </td></tr>';
        $room .= '</table>';


        $html = '<div style="font-size: 9px; color: #666">
    <table class="header" style="background-color: #F1F1F1;">
        <tr>
            <td><img src="/public/frontend/images/logo.png" /></td>
            <td><br><h1 style="color: #666;">PHIẾU NHẬN TOUR</h1></td>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <td>Mã đặt tour: <span style="font-size: 13px; font-weight: bold">' . $order->order_code . '</span></td>
            <td></td>
        </tr>
    </table>

    <br><br>

    <table cellspacing="0" cellpadding="4">
        <tr>
            <td style="border-bottom: 1px solid #333;" width="48%">THÔNG TIN ĐẶT TOUR</td>
            <td width="10px"></td>
            <td style="border-bottom: 1px solid #333; border-top: 1px dashed #333;  border-right: 1px dashed #333; border-left: 1px dashed #333;" width="48%">THÔNG TIN THANH TOÁN</td>
        </tr>
        <tr>
            <td><table cellspacing="2" cellpadding="2" style="font-size: 9px;">
                <tr><td><strong>Tên tour:</strong> ' . html_escape($order_detail->name) . '</td></tr>
                <tr><td><strong>Thời gian:</strong> ' . html_escape($order_detail->time) . '</td></tr>
                <tr><td><strong>Điểm khởi hành:</strong> ' . ((isset($province_data[$order_detail->from_province_id])) ? $province_data[$order_detail->from_province_id]->name : '') . '</td></tr>
                <tr><td><strong>Điển đến:</strong> ' . ((isset($province_data[$order_detail->to_province_id])) ? $province_data[$order_detail->to_province_id]->name : '') . '</td></tr>
                <tr><td><strong>Phương tiện:</strong> ' . html_escape($order_detail->transportation) . '</td></tr>
                <tr><td><strong>Ngày khởi hành:</strong> ' . date('d-m-Y', strtotime($order->date_start)) . '</td></tr></table>
            </td>
            <td></td>
            <td rowspan="6" style="border-bottom: 1px dashed #333; border-left: 1px dashed #333; border-right: 1px dashed #333;">' . $room . '</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #333;">THÔNG TIN ĐẶT TOUR</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><table cellspacing="2" cellpadding="2" style="font-size: 9px;">
                    <tr><td><strong>Khách hàng:</strong> ' . html_escape($order_contact->name) . '</td></tr>
                    <tr><td><strong>Địa chỉ:</strong> ' . html_escape($order_contact->email) . '</td></tr>
                    <tr><td><strong>Điện thoại:</strong> ' . html_escape($order_contact->phone) . '</td></tr>
                </table>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br><br>
    <table cellspacing="0" cellpadding="4">
        <tr>
            <td style="border-bottom: 1px dashed #333">GHI CHÚ</td>
        </tr>
        <tr>
            <td>Đã thanh toán 100% qua Azy</td>
        </tr>
    </table>
    <br><br>
    <table cellspacing="0" cellpadding="4">
        <tr>
            <td style="border: 1px dashed #333"><strong>Lưu ý:</strong><br>
            - Khi nhận phòng, Quý khách phải xuất trình phiếu này kèm theo giấy Chứng minh nhân dân hoặc Hộ chiếu.<br>
            Trường hợp Quý khách không xuất trình được, khách sạn có thể yêu cầu trả thêm chi phí hoặc không cho nhận phòng.<br>
            - Tất cả các phòng đặt trước được đảm bảo còn trống đến ngày nhận phòng.Trong trường hợp Quý khách không đến, phòng sẽ được giải phóng và xử lí theo quy định, điều khoản theo chính sách hoàn hủy.<br>
            - Tổng số tiền cho đơn đặt phòng này không bao gồm chi phí ăn uống tại quầy bar của khách sạn, chi phí điện thoại, dịch vụ giặt là,...Tất cả chi phí này sẽ thanh toán trực tiếp với khách sạn.
            </td>
        </tr>
    </table>
    <br><br><br>
    <table cellspacing="0" cellpadding="4">
        <tr>
            <td style="border-top: 1px solid #333; font-size: 8px"><strong>CÔNG TY TNHH AZY VIỆT NAM</strong>
                <br><br><strong>VP Hà Nội:</strong> Tầng 4, tòa nhà GP Invest, 170 Đê La Thành, Đống Đa - Tel: (04) 7109 9999 / (04) 7309 9899
                <br><strong>VP Hồ Chí Minh:</strong> Tầng 5, Tòa Nhà HDTC, Số 36 Bùi Thị Xuân, Q.1 - Tel: (08) 7309 9899
            </td>
        </tr>
    </table>
</div>';

        $this->load->library('my_pdf');
        $pdf = new My_pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetTitle('Phiếu nhận tour');
        $pdf->SetHeaderMargin(0);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(0);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetFont('dejavusans', '', 14, '', true);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('Phieu_Nhan_Tour.pdf', 'I');
    }

    public function cancel_hotel_order_late() {
        $this->load->model(array(
            'hotel_order_model',
        ));

        $this->hotel_order_model->delete_where(array('status' => 2, 'time_cancel <>' => 'null' ,'time_cancel < ' => date('Y-m-d H:i:s')));
    }
}
