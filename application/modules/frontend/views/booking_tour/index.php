<div class="container" style="margin-top:10px;">
    <form method="post" id="fr-booking-tour" action="" autocomplete="off">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel-login" style="border-bottom:1px solid #dadada;">
                    <h4>Chi tiết đặt tour</h4>
                </div>

                <div class="myroomhistory clearfix">
                    <div class="col-lg-4 hidden-md hidden-sm hidden-xs">
                        <div class="row">
                            <img class="img-responsive"
                                 src="<?php echo show_picture(html_escape($tour->picture), 200, 164, 'tour'); ?>"
                                 alt="">
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row" style="padding-bottom: 5px;">
                                    <span class="txt-color-bluey"
                                          style="float: left;"><b><?php echo html_escape($tour->name); ?></b></span>
                                </div>

                                <div class="row">
                                    <label class="col-lg-4 text-left row">
                                        Thời gian:
                                    </label>

                                    <label class="col-lg-8 text-left fontnormal row">
                                        <?php echo $tour->time; ?>
                                    </label>
                                </div>

                                <div class="row">
                                    <label class="col-lg-4 text-left row">
                                        Điểm khởi hành:
                                    </label>

                                    <label class="col-lg-8 text-left fontnormal row">
                                        <?php echo ((isset($province[$tour->from_province_id])) ? $province[$tour->from_province_id]->name : '') . ' - ' . ((isset($national[$tour->from_national_id])) ? $national[$tour->from_national_id]->name : ''); ?>
                                    </label>
                                </div>

                                <div class="row">
                                    <label class="col-lg-4 text-left row">
                                        Điểm đến:
                                    </label>

                                    <label class="col-lg-8 text-left fontnormal row">
                                        <?php echo ((isset($province[$tour->to_province_id])) ? $province[$tour->to_province_id]->name : '') . ' - ' . ((isset($national[$tour->to_national_id])) ? $national[$tour->to_national_id]->name : ''); ?>
                                    </label>
                                </div>

                                <div class="row">
                                    <label class="col-lg-4 text-left row">
                                        Phương tiện:
                                    </label>

                                    <label class="col-lg-8 text-left fontnormal row">
                                        <?php echo $tour->transportation; ?>
                                    </label>
                                </div>

                                <div class="row">
                                    <label class="col-lg-4 text-left row">
                                        Ngày khởi hành:
                                    </label>

                                    <label class="col-lg-8 text-left fontnormal row">
                                        <?php if ($tour->start_date == 1) : ?>
                                            <input type="text" class="form-control" id="start_date" name="start_date"
                                                   style="width: 150px"/>
                                        <?php else : ?>
                                            <?php
                                            $start_date_arr = explode(';', $tour->start_date);
                                            echo '<select style="width: 150px" class="form-control" id="start_date" name="start_date">';
                                            foreach($start_date_arr as $v) {
                                                if (trim($v) != '')
                                                    echo '<option value="' . format_date('d/m/Y', trim($v)) . '">' . format_date('d/m/Y', trim($v)) . '</option>';
                                            }
                                            echo '</select>';
                                            ?>

                                        <?php endif; ?>
                                        <label class="error-login" for="start_date"></label>
                                    </label>
                                </div>

                                <div class="back_hotel_detail" style="bottom: 0px;">
                                    <a href="<?php echo show_link($tour->id, $tour->name, 'tour_detail'); ?>"><span
                                            class="glyphicon glyphicon-arrow-left"></span> Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-login" style="border-bottom:1px solid #dadada; margin-top:20px;">
                    <h4>Thông tin người đặt tour</h4>
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
                    <div class="clearfix" style="padding-bottom: 5px;">
                        <label class="col-lg-12 row"><?php echo html_escape($tour->name); ?></label>
                        <label class="col-lg-12 fontnormal" style="padding: 0;">
                            <select id="slot_tour_booking" name="slot" class="form-control"
                                    style="width: 70px; display: inline;">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                            người &nbsp; x &nbsp;<?php echo show_price($tour->price); ?>&nbsp; = &nbsp;
                            <span class="total_money"><?php echo show_price($tour->price); ?></span>
                        </label>
                    </div>

                    <div class="clearfix"
                         style="margin-top:5px; margin-bottom: 10px; border-bottom: 1px solid #dadada"></div>

                    <div class="clearfix">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Tổng giá tour:</label>
                        <label
                            class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal total_money"><?php echo show_price($tour->price); ?></label>
                    </div>

                    <div class="clearfix">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Số tiền thanh toán:</label>
                        <label
                            class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal total_money"><?php echo show_price($tour->price); ?></label>
                    </div>
                    <p class="orangeC">
                        (Đã bao gồm thuế và phí dịch vụ)
                    </p>
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
                        <button type="button" id="btn-fr-booking-tour" class="btn btn btn-success">THANH TOÁN VÀ ĐẶT
                            PHÒNG
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
        <input type="hidden" name="tour_id" value="<?php echo $this->input->post('tour_id'); ?>"/>
        <input type="hidden" name="price" value="<?php echo $tour->price; ?>" id="price_tour"/>
    </form>
</div>