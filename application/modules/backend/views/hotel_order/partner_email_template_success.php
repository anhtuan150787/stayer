<div style="margin-top:10px; color: black">
    <div>
    <p style="line-height: 1.7; color: black;">
        Đơn hàng <?php echo html_escape($order->order_code);?></b> đã xử lý thành công.
        Khách hàng sẽ nhận phòng vào thời gian theo thông tin như sau:
    </p>
        <div>
            <div >
                <div style="border-bottom:1px solid #dadada; margin-top:20px; padding-bottom: 10px">
                    <b style="font-size: 13px; color: black;">Chi tiết đặt phòng<b>
                </div>
                
                <div style="margin-top: 5px; line-height: 1.7; color: black; font-weight: normal">
                    
                        <div>
                            <label>Khách sạn: </label>
                            <label><?php echo html_escape($hotel->name);?></label>
                        </div>
                        
                        <div>
                            <label>Địa điểm: </label>
                            <label><?php echo html_escape($hotel->address);?></label>
                        </div>
                        
                        <div>
                            <label>Nhận phòng: </label>
                            <label>
                            <?php echo show_name_day_of_week(show_day_of_week($order->date_stay_from)) . ', ngày ' . show_date($order->date_stay_from);?>
                            </label>
                        </div>
                        
                        <div>
                            <label>Trả phòng: </label>
                            <label>
                            <?php echo show_name_day_of_week(show_day_of_week($order->date_stay_to)) . ', ngày ' . show_date($order->date_stay_to);?>
                            </label>
                        </div>
                        <div>
                            <label>Thời gian: </label>
                            <label><?php echo $night;?> đêm</label>
                        </div>
                </div>
    
    
                <div style="margin-top:20px; border-bottom:1px solid #dadada; padding-bottom: 10px">
                    <b style="font-size: 13px; color: black;">Thông tin người đặt phòng</b>
                </div>
    
                <div style="margin-top: 5px; line-height: 1.7; color: black; font-weight: normal">
                    
                        <div>
                            <label>Họ tên: </label>
                            <label><?php echo html_escape($order_contact->name);?></label>
                        </div>
                        
                        <div>
                            <label>Điện thoại: </label>
                            <label><?php echo html_escape($order_contact->phone);?></label>
                        </div>
    
                        <div>
                            <label>Email: </label>
                            <label><?php echo html_escape($order_contact->email);?></label>
                        </div>
    
                        <div>
                            <label>Địa chỉ: </label>
                            <label><?php echo html_escape($order_contact->address);?></label>
                        </div>
                        <div>
                            <label>Tỉnh Thành: </label>
                            <label><?php echo html_escape($order_contact->province_name);?></label>
                        </div>
                </div>

                <div style="margin-top:20px; border-bottom:1px solid #dadada; padding-bottom: 10px">
                    <b style="font-size: 13px; color: black;">Thông tin người nhận phòng</b>
                </div>

                <div style="margin-top: 5px; line-height: 1.7; color: black; font-weight: normal">

                    <div>
                        <label>Họ tên: </label>
                        <label><?php echo html_escape($order_contact_stay->name);?></label>
                    </div>

                    <div>
                        <label>Điện thoại: </label>
                        <label><?php echo html_escape($order_contact_stay->phone);?></label>
                    </div>

                    <div>
                        <label>Email: </label>
                        <label><?php echo html_escape($order_contact_stay->email);?></label>
                    </div>

                    <div>
                        <label>Địa chỉ: </label>
                        <label><?php echo html_escape($order_contact_stay->address);?></label>
                    </div>

                    <div>
                        <label>Tỉnh Thành: </label>
                        <label><?php echo html_escape($order_contact_stay->province_name);?></label>
                    </div>
                </div>
            </div>

            <div>
                <div style="margin-top:20px; border-bottom:1px solid #dadada; padding-bottom: 10px">
                    <b style="font-size: 13px; color: black;">Thông tin thanh toán</b>
                </div>
    
                <div class="paymentinfo" style="margin-top: 5px; line-height: 1.7; color: black; font-weight: normal">
                    <?php foreach($order_room as $v):?>
                        <?php $price_room_total = 0;?>
                    <div class="clearfix" style="padding-bottom: 5px;">
                        <label><?php echo html_escape($v->room_info->name);?> (tối đa <?php echo $v->slot;?> người lớn)</label>
                        <label style="padding: 0;">
                        <?php echo $v->room_number_booking;?> phòng &nbsp; x &nbsp; 
                        <?php echo ($v->price_bedmore != 0) ? '(' . show_price($v->price_final) . ' + ' . show_price($v->price_bedmore) . ' thêm giường)' : show_price($v->price_final);?>
                         &nbsp; x &nbsp;<?php echo $v->night;?> đêm &nbsp; = &nbsp; <?php echo show_price($v->price_total);?>
                        </label>
                    </div>
                        <?php $price_room_total += $v->price_total;?>
                    <?php endforeach;?>
                    
                    <div style="margin-top:5px; margin-bottom: 10px;"></div>
                    
                    <div>
                        <label>Tổng giá phòng:</label>
                        <label><?php echo show_price($price_room_total);?></label>
                    </div>

                    <?php if ($order->coupon != ''):?>
                        <div>
                            <label>Mã khuyến mãi:</label>
                            <label><?php echo $order->coupon;?></label>
                        </div>
                    <?php endif;?>
    
                    <div>
                        <label>Số tiền thanh toán:</label>
                        <label><?php echo show_price($order->price_payment);?></label>
                    </div>
                    <p>
                        (Đã bao gồm thuế và phí dịch vụ)
                    </p>
                </div>
                
                <div style="margin-top: 10px; font-weight: normal">
                    <div>
                        <div><b>Phương thức thanh toán</b></div>
                        </div>
                        <label></label>
                            <div>
                                <div>
                                    <label><?php echo show_payment_type($order->payment_type);?>
                                    </label>
                                    <p style="color: green; font-weight: bold;">Đã thanh toán</p>
                                </div>
                            </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
        </div>

    
        </div>
    </div>       
</div>
