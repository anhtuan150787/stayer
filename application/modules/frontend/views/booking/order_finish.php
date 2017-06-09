<div class="container order-finish" style="margin-top:10px;">
    <div style="height: 30px"></div>
    <div class="row register-container">
    <h3>Yêu cầu đặt phòng</h3>
    <hr />
    <p class="text-primary" style="padding: 15px; line-height: 1.7">
        Bạn đã gửi yêu cầu đặt phòng thành công.<br />
        Azy sẽ liên hệ với bạn trong thời gian vòng 30 phút. Trường hợp bạn muốn xác nhận ngay, vui lòng liên hệ với Azy theo Hotline: Hà Nội : (04) 7109 9999 / (04) 7309 9899, Hồ Chí Minh : (08) 7309 9899.<br>
        Việc thanh toán sẽ được tiến hành sau khi Quý Khách nhận được xác nhận phòng trống từ Mytour.<br><br>
        Mã đặt phòng của bạn: <br /><b style="font-size: 20px;"><?php echo html_escape($order->order_code);?></b>
    </p>
        <form method="post" id="fr-booking-1" action="" autocomplete="off">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel-login" style="border-bottom:1px solid #dadada; margin-top:20px;">
                    <h4>Chi tiết đặt phòng</h4>
                </div>

                <div class="paymentform">

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Khách sạn</b></label>
                            <label class="col-lg-9"><?php echo html_escape($hotel->name);?></label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Địa điểm</b></label>
                            <label class="col-lg-9"><?php echo html_escape($hotel->address);?></label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Nhận phòng</b></label>
                            <label class="col-lg-9">
                            <?php echo show_name_day_of_week(show_day_of_week($order->date_stay_from)) . ', ngày ' . show_date($order->date_stay_from);?>
                            </label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Trả phòng</b></label>
                            <label class="col-lg-9">
                            <?php echo show_name_day_of_week(show_day_of_week($order->date_stay_to)) . ', ngày ' . show_date($order->date_stay_to);?>
                            </label>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Số đêm ở</b></label>
                            <label class="col-lg-9"><?php echo $night;?> đêm</label>
                        </div>

                    <div class="clearfix"></div>
                </div>


                <div class="panel-login" style="margin-top:20px; border-bottom:1px solid #dadada;">
                    <h4>Thông tin người đặt phòng</h4>
                </div>
    
                <div class="paymentform">
                    
                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Họ tên</b></label>
                            <label class="col-lg-9"><?php echo html_escape($order_contact->name);?></label>
                        </div>
                        
                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Điện thoại</b></label>
                            <label class="col-lg-9"><?php echo html_escape($order_contact->phone);?></label>
                        </div>
    
                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Email</b></label>
                            <label class="col-lg-9"><?php echo html_escape($order_contact->email);?></label>
                        </div>
    
                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Địa chỉ</b></label>
                            <label class="col-lg-9"><?php echo html_escape($order_contact->address);?></label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Tỉnh Thành</b></label>
                            <label class="col-lg-9"><?php echo html_escape($order_contact->province_name);?></label>
                        </div>
                    
                    <div class="clearfix"></div>
                </div>

                <div class="panel-login" style="margin-top:20px; border-bottom:1px solid #dadada;">
                    <h4>Thông tin người nhận phòng</h4>
                </div>

                <div class="paymentform">

                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 row"><b>Họ tên</b></label>
                        <label class="col-lg-9"><?php echo html_escape($order_contact_stay->name);?></label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 row"><b>Điện thoại</b></label>
                        <label class="col-lg-9"><?php echo html_escape($order_contact_stay->phone);?></label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 row"><b>Email</b></label>
                        <label class="col-lg-9"><?php echo html_escape($order_contact_stay->email);?></label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 row"><b>Địa chỉ</b></label>
                        <label class="col-lg-9"><?php echo html_escape($order_contact_stay->address);?></label>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-lg-3 row"><b>Tỉnh Thành</b></label>
                        <label class="col-lg-9"><?php echo html_escape($order_contact_stay->province_name);?></label>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
    
            <div class="col-lg-4">
                <div class="panel-login" style="margin-top:20px; border-bottom:1px solid #dadada;">
                    <h4>Thông tin thanh toán</h4>
                </div>
    
                <div class="paymentinfo">
                    <?php $price_room_total = 0;?>
                    <?php foreach($order_room as $v):?>
                    <div class="clearfix" style="padding-bottom: 5px;">
                        <label class="col-lg-12 row"><?php echo html_escape($v->room_info->name);?> (tối đa <?php echo $v->slot;?> người lớn)</label>
                        <label class="col-lg-12 fontnormal" style="padding: 0;">
                        <?php echo $v->room_number_booking;?> phòng &nbsp; x &nbsp; 
                        <?php echo ($v->price_bedmore != 0) ? '(' . show_price($v->price_final) . ' + ' . show_price($v->price_bedmore) . ' thêm giường)' : show_price($v->price_final);?>
                         &nbsp; x &nbsp;<?php echo $v->night;?> đêm &nbsp; = &nbsp; <?php echo show_price($v->price_total);?>
                        </label>
                    </div>
                        <?php $price_room_total += $v->price_total;?>
                    <?php endforeach;?>
                    
                    <div class="clearfix" style="margin-top:5px; margin-bottom: 10px; border-bottom: 1px solid #dadada"></div>
                    
                    <div class="clearfix">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Tổng giá phòng:</label>
                        <label class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal"><?php echo show_price($price_room_total);?></label>
                    </div>

                    <div class="clearfix">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Mã giảm giá:</label>
                        <label class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal"><?php echo '-' . show_price($price_room_total - $order->price_payment);?></label>
                    </div>
    
                    <div class="clearfix">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Số tiền thanh toán:</label>
                        <label class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal"><?php echo show_price($order->price_payment);?></label>
                    </div>
                    <p class="orangeC">
                        (Đã bao gồm thuế và phí dịch vụ)
                    </p>
                </div>
                
                <div class="paymentform">
    				<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    					<div class="headspan">Phương thức thanh toán</div>
    					</div>
                        <label class="error-login" for="payment_type"></label>
    						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    							<div class="radio">
    								<label><strong><?php echo show_payment_type($order->payment_type);?></strong>
    								</label>
    							</div>
    						</div>
    					<div class="clearfix"></div>
    				</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel-login" style="margin-top:20px; border-bottom:1px solid #dadada;">
                    <h4>Thông tin chuyển khoản ngân hàng</h4>
                </div>
    
                <div class="paymentform bank-info">

                    <div class="form-group col-lg-4">
                        <p><b>Agribank - NH nông nghiệp và phát triển nông thôn</b></p>
                        
                        Chi nhánh Hà Thành<br>
                        Số TK: 1303 201 045 741<br>
                        Chủ TK: Công ty TNHH Mytour Việt Nam
                    </div>  
                    <div class="form-group col-lg-4">
                        <p><b>Agribank - NH nông nghiệp và phát triển nông thôn</b></p>
                        
                        Chi nhánh Hà Thành<br>
                        Số TK: 1303 201 045 741<br>
                        Chủ TK: Công ty TNHH Mytour Việt Nam
                    </div>
                    <div class="form-group col-lg-4">
                        <p><b>Agribank - NH nông nghiệp và phát triển nông thôn</b></p>
                        
                        Chi nhánh Hà Thành<br>
                        Số TK: 1303 201 045 741<br>
                        Chủ TK: Công ty TNHH Mytour Việt Nam
                    </div>

                    <div class="form-group col-lg-4">
                        <p><b>Agribank - NH nông nghiệp và phát triển nông thôn</b></p>
                        
                        Chi nhánh Hà Thành<br>
                        Số TK: 1303 201 045 741<br>
                        Chủ TK: Công ty TNHH Mytour Việt Nam
                    </div>  
                    <div class="form-group col-lg-4">
                        <p><b>Agribank - NH nông nghiệp và phát triển nông thôn</b></p>
                        
                        Chi nhánh Hà Thành<br>
                        Số TK: 1303 201 045 741<br>
                        Chủ TK: Công ty TNHH Mytour Việt Nam
                    </div>
                    <div class="form-group col-lg-4">
                        <p><b>Agribank - NH nông nghiệp và phát triển nông thôn</b></p>
                        
                        Chi nhánh Hà Thành<br>
                        Số TK: 1303 201 045 741<br>
                        Chủ TK: Công ty TNHH Mytour Việt Nam
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            </div>
        </div>
        
        <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" />
        <input type="hidden" name="room-date-from-search" value="<?php echo $this->input->post('room-date-from-search');?>" />
        <input type="hidden" name="room-date-to-search" value="<?php echo $this->input->post('room-date-to-search');?>" />
        <input type="hidden" name="hotel_id" value="<?php echo $this->input->post('hotel_id');?>" />
        
        <?php if ($this->input->post('num-room')):?>
        <?php foreach($this->input->post('num-room') as $k => $v):?>
        <?php if ($v != 0):?>
        <input type="hidden" name="num-room[<?php echo $k;?>]" value="<?php echo $v;?>" />
        <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
        </form>
    </div>       
</div>