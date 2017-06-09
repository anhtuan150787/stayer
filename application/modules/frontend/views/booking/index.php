<div class="container" style="margin-top:10px;">
    <form method="post" id="fr-booking-1" action="" autocomplete="off">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel-login" style="border-bottom:1px solid #dadada;">
                    <h4>Chi tiết đặt phòng</h4>
                </div>

                <?php if (isset($error) && $error != '') :?>
                <div class="alert alert-danger" role="alert" style="margin-top: 10px">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?php echo $error;?>
                </div>
                <?php endif;?>

                <div class="myroomhistory clearfix">
                    <div class="col-lg-3 hidden-md hidden-sm hidden-xs">
                        <div class="row">
                            <img class="img-responsive"
                                 src="<?php echo show_picture(html_escape($hotel->picture), 170, 134); ?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row" style="padding-bottom: 5px;">
                                    <span class="txt-color-bluey"
                                          style="float: left;"><b><?php echo html_escape($hotel->name); ?></b></span>

                                    <ul class="star">
                                        <?php for ($i_star = 1; $i_star <= 5; $i_star++) : ?>
                                            <li <?php echo ($hotel->star >= $i_star) ? 'class="active"' : ''; ?>></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>

                                <div class="row">
                                    <label class="col-lg-3 text-left row">
                                        Địa điểm:
                                    </label>

                                    <label class="col-lg-9 text-left fontnormal row">
                                        <?php echo html_escape($hotel->address); ?>
                                    </label>
                                </div>

                                <div class="row">
                                    <label class="col-lg-3 text-left row">
                                        Nhận phòng:
                                    </label>

                                    <label class="col-lg-9 text-left fontnormal row">
                                        <?php echo $date_from; ?>
                                    </label>
                                </div>

                                <div class="row">
                                    <label class="col-lg-3 text-left row">
                                        Trả phòng:
                                    </label>
                                    <label class="col-lg-9 text-left fontnormal row">
                                        <?php echo $date_to; ?>
                                    </label>
                                </div>
                                <div class="row">
                                    <label class="col-lg-3 text-left row">
                                        Số đêm ở:
                                    </label>
                                    <label class="col-lg-9 text-left fontnormal row">
                                        <?php echo $night; ?> đêm
                                    </label>
                                </div>
                                <div class="back_hotel_detail">
                                    <a href="<?php echo show_link($hotel->id, $hotel->name); ?>"><span
                                            class="glyphicon glyphicon-arrow-left"></span> Quay lại khách sạn</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-login" style="border-bottom:1px solid #dadada; margin-top:20px;">
                    <h4>Thông tin người đặt phòng</h4>
                </div>

                <div class="paymentform">

                    <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Họ tên</label>
                        <input type="text" class="form-control" name="name" id="name" maxlength="50" value=""/>
                        <label class="error-login" for="name"></label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" id="email" maxlength="50" value=""/>
                        <label class="error-login" for="email"></label>
                    </div>

                    <div class="form-group col-lg-8">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" id="address" maxlength="255"/>
                        <label class="error-login" for="address"></label>
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="exampleInputEmail1">Tỉnh thành</label>
                        <select class="form-control" name="province" id="province">
                            <option value=""></option>
                            <?php foreach ($province as $v): ?>
                                <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="error-login" for="province"></label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Điện thoại</label>
                        <input type="text" class="form-control" name="phone" id="phone" maxlength="11"/>
                        <label class="error-login" for="phone"></label>
                    </div>

                    <div class="clearfix"></div>
                </div>


                <div class="panel-login" style="border-bottom:1px solid #dadada; margin-top:20px;">
                    <h4 id="person_get_room" style="cursor: pointer">Thông tin người nhận phòng</h4>
                </div>

                <div class="paymentform" id="form_person_get_room" style="display: none">

                    <p style="margin-top: 10px"><label style="font-weight: normal"><input type="checkbox"
                                                                                          id="copy_order_contact"> Giống
                            thông tin người đặt phòng</label></p>


                    <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Họ tên</label>
                        <input type="text" class="form-control" name="name_stay" id="name_stay" maxlength="50"
                               value=""/>
                        <label class="error-login" for="name_stay"></label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email_stay" id="email_stay" maxlength="50"
                               value=""/>
                        <label class="error-login" for="email_stay"></label>
                    </div>

                    <div class="form-group col-lg-8">
                        <label for="exampleInputEmail1">Địa chỉ</label>
                        <input type="text" class="form-control" name="address_stay" id="address_stay" maxlength="255"/>
                        <label class="error-login" for="address_stay"></label>
                    </div>

                    <div class="form-group col-lg-4">
                        <label for="exampleInputEmail1">Tỉnh thành</label>
                        <select class="form-control" name="province_stay" id="province_stay">
                            <option value=""></option>
                            <?php foreach ($province as $v): ?>
                                <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label class="error-login" for="province_stay"></label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="exampleInputEmail1">Điện thoại</label>
                        <input type="text" class="form-control" name="phone_stay" id="phone_stay" maxlength="11"/>
                        <label class="error-login" for="phone_stay"></label>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="panel-login" style="border-bottom:1px solid #dadada; margin-top:20px;">
                    <h4>Ghi chú khi đặt phòng</h4>
                </div>


                <div class="form-group col-lg-12 paymentform">
                    <textarea placeholder="Lưu ý cho đơn hàng" class="form-control" name="note"></textarea>
                </div>
                <div class="clearfix"></div>


                <div class="paymentform">
                    <label style="color: #ef8723">Lưu ý:</label>
                    <ul>
                        <li>
                            <p>Azy sẽ liên hệ với quý khách (qua email hoặc điện thoại) trong vòng 30 phút để xác nhận
                                phòng và thời hạn thanh toán.</p>
                        </li>
                        <li>
                            <p>Quý khách sẽ thanh toán (tại Azy, chuyển khoản hay thẻ) sau khi có xác nhận còn phòng
                                trống từ Azy.</p>
                        </li>
                        <li>
                            <p>
                                Trường hợp Quý khách muốn xác nhận ngay, vui lòng liên hệ với Azy theo Hotline:
                                Hà Nội: (04) 7109 9999
                                Hồ Chí Minh: (08) 7309 9899
                            </p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel-login" style="border-bottom:1px solid #dadada;">
                    <h4>Thông tin thanh toán</h4>
                </div>

                <div class="paymentinfo">
                    <?php $price_room_total = 0;?>
                    <?php foreach ($room as $v): ?>
                        <div class="clearfix" style="padding-bottom: 5px;">
                            <label class="col-lg-12 row"><?php echo $v->name; ?> (tối đa <?php echo $v->slot; ?> người
                                lớn)</label>
                            <label class="col-lg-12 fontnormal" style="padding: 0;">
                                <?php echo $v->room_number_booking; ?> phòng &nbsp; x &nbsp;
                                <?php echo ($v->price_bedmore != 0) ? '(' . show_price($v->price_final) . ' + ' . show_price($v->price_bedmore) . ' thêm giường)' : show_price($v->price_final); ?>
                                &nbsp; x &nbsp;<?php echo $night; ?> đêm &nbsp; =
                                &nbsp; <?php echo show_price($v->price_total); ?>
                            </label>
                        </div>
                        <?php $price_room_total += $v->price_total;?>
                    <?php endforeach; ?>

                    <div class="clearfix"
                         style="margin-top:5px; margin-bottom: 10px; border-bottom: 1px solid #dadada"></div>

                    <div class="clearfix">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Tổng giá phòng:</label>
                        <label
                            class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal"><?php echo show_price($price_room_total); ?></label>
                    </div>

                    <div class="clearfix" id="coupon_wrap" style="display: none">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Mã giảm giá:</label>
                        <label
                            class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal" id="coupon_price"></label>
                    </div>

                    <div class="clearfix">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Số tiền thanh toán:</label>
                        <label
                            class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal" id="price_payment"><?php echo show_price($price_total); ?></label>
                    </div>
                    <p class="orangeC">
                        (Đã bao gồm thuế và phí dịch vụ)
                    </p>
                    <div class="clearfix">
                        <label class="col-lg-6 col-md-7 col-sm-12 col-xs-12 row">Mã khuyến mãi:</label>
                        <label
                            class="col-lg-6 col-md-5 col-sm-12 col-xs-12 row fontnormal">
                            <input type="text" name="coupon" id="coupon" value="" class="form-control" />
                            <button type="button" id="btn-coupon" class="btn btn-success" style="margin-top: 5px">Áp dụng</button>
                        </label>
                    </div>
                </div>

                <div class="paymentform">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="headspan">Chọn phương thức thanh toán</div>
                    </div>
                    <label class="error-login" for="payment_type"></label>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="radio">
                            <label> <input type="radio" name="payment_type"
                                           id="payment_type_1" value="1"> <strong>Thanh toán tại văn phòng Azy</strong>
                            </label>
                        </div>
                        <div class="title_pay">Tầng 4, tòa nhà GP Invest, 170 Đê La Thành, Đống Đa</div>
                        <div class="radio">
                            <label> <input type="radio" name="payment_type"
                                           id="payment_type_2" value="2"> <strong>Chuyển khoản</strong>
                            </label>
                        </div>
                        <div class="title_pay">Tài khoản ngân hàng của Azy</div>
                        <div class="radio">
                            <label> <input type="radio" name="payment_type"
                                           id="payment_type_3" value="3"> <strong>Thẻ ATM nội địa</strong>
                            </label>
                        </div>
                        <div class="title_pay">Thanh toán qua cổng thanh toán Onepay, miễn phí giao dịch</div>
                        <div class="radio">
                            <label> <input type="radio" name="payment_type"
                                           id="payment_type_3" value="4"> <strong>Thẻ quốc tế Visa, Master</strong>
                            </label>
                        </div>
                        <div class="title_pay">Thanh toán qua cổng thanh toán Onepay, miễn phí giao dịch</div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                        <button type="button" id="btn-fr-booking-1" class="btn btn btn-success">THANH TOÁN VÀ ĐẶT
                            PHÒNG
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
        <input type="hidden" name="room-date-from-search"
               value="<?php echo $this->input->post('room-date-from-search'); ?>"/>
        <input type="hidden" name="room-date-to-search"
               value="<?php echo $this->input->post('room-date-to-search'); ?>"/>
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $this->input->post('hotel_id'); ?>"/>
        <input type="hidden" name="area" id="area" value="<?php echo $hotel->area_id;?>" />
        <input type="hidden" name="night" id="night" value="<?php echo $night;?>" />
        <input type="hidden" name="price_total" id="price_total" value="<?php echo $price_total;?>" />

        <?php if ($this->input->post('num-room')): ?>
            <?php foreach ($this->input->post('num-room') as $k => $v): ?>
                <?php if ($v != 0): ?>
                    <input type="hidden" name="num-room[<?php echo $k; ?>]" value="<?php echo $v; ?>"/>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </form>
</div>