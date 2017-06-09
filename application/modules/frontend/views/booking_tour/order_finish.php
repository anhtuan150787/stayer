<div class="container order-finish" style="margin-top:10px;">
    <div style="height: 30px"></div>
    <div class="row register-container">
    <h3>Yêu cầu đặt tour</h3>
    <hr />
    <p class="text-primary" style="padding: 15px; line-height: 1.7">
        Bạn đã gửi yêu cầu đặt tour thành công.<br />
        Azy sẽ liên hệ với bạn trong thời gian vòng 30 phút. Trường hợp bạn muốn xác nhận ngay, vui lòng liên hệ với Azy theo Hotline: Hà Nội : (04) 7109 9999 / (04) 7309 9899, Hồ Chí Minh : (08) 7309 9899.<br>
        Việc thanh toán sẽ được tiến hành sau khi Quý Khách nhận được xác nhận từ Mytour.<br><br>
        Mã đặt tour của bạn: <br /><b style="font-size: 20px;"><?php echo html_escape($order->order_code);?></b>
    </p>
        <form method="post" id="fr-booking-1" action="" autocomplete="off">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel-login" style="border-bottom:1px solid #dadada; margin-top:20px;">
                    <h4>Chi tiết đặt tour</h4>
                </div>

                <div class="paymentform">

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Tour</b></label>
                            <label class="col-lg-9"><?php echo html_escape($order_detail->name);?></label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Thời gian</b></label>
                            <label class="col-lg-9"><?php echo $order_detail->time;?></label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Điểm khởi hành</b></label>
                            <label class="col-lg-9">
                                <?php echo ((isset($province_data[$order_detail->from_province_id])) ? $province_data[$order_detail->from_province_id]->name : ''); ?>
                            </label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Điểm đến</b></label>
                            <label class="col-lg-9">
                                <?php echo ((isset($province_data[$order_detail->to_province_id])) ? $province_data[$order_detail->to_province_id]->name : ''); ?>
                            </label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Phương tiện</b></label>
                            <label class="col-lg-9"><?php echo $order_detail->transportation;?></label>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-lg-3 row"><b>Ngày khởi hành</b></label>
                            <label class="col-lg-9"><?php echo format_date('d/m/Y', $order->date_start);?></label>
                        </div>
                    <div class="clearfix"></div>
                </div>


                <div class="panel-login" style="margin-top:20px; border-bottom:1px solid #dadada;">
                    <h4>Thông tin người đặt tour</h4>
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
            </div>
    
            <div class="col-lg-4">
                <div class="panel-login" style="margin-top:20px; border-bottom:1px solid #dadada;">
                    <h4>Thông tin thanh toán</h4>
                </div>
    
                <div class="paymentinfo">
                    <div class="clearfix" style="padding-bottom: 5px;">
                        <label class="col-lg-12 row"><?php echo html_escape($order_detail->name);?></label>
                        <label class="col-lg-12 fontnormal" style="padding: 0;">
                            <?php echo $order->slot;?> người &nbsp; x &nbsp;<?php echo show_price($order_detail->price);?>&nbsp; = &nbsp; <?php echo show_price($order->price_payment);?>
                        </label>
                    </div>
                    
                    <div class="clearfix" style="margin-top:5px; margin-bottom: 10px; border-bottom: 1px solid #dadada"></div>
                    
                    <div class="clearfix">
                        <label class="col-lg-8 col-md-7 col-sm-12 col-xs-12 row">Tổng giá tour:</label>
                        <label class="col-lg-4 col-md-5 col-sm-12 col-xs-12 row fontnormal"><?php echo show_price($order->price_payment);?></label>
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