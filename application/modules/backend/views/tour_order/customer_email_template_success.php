<div style="margin-top:10px; color: black">
    <div>
    <p style="line-height: 1.7; color: black;">
        Đơn đặt tour của bạn đã thành công.<br>
        Azy xin chân thành cám ơn bạn đã chọn chúng tôi để phục vụ nhu cầu của bạn. Bạn vui lòng xem thông tin đặt phòng dưới đây.<br><br>
        Mã đặt tour: <br /><b style="font-size: 20px;"><?php echo html_escape($order->order_code);?></b>
    </p>
        <div>
            <div >
                <div style="border-bottom:1px solid #dadada; margin-top:20px; padding-bottom: 10px">
                    <b style="font-size: 13px; color: black;">Chi tiết đặt tour<b>
                </div>
                
                <div style="margin-top: 5px; line-height: 1.7; color: black;">

                    <div>
                        <label>Tên tour: </label>
                        <label><?php echo html_escape($order_detail->name);?></label>
                    </div>

                    <div>
                        <label>Thời gian: </label>
                        <label>
                            <?php echo html_escape($order_detail->time);?>
                        </label>
                    </div>

                    <div>
                        <label>Điểm khởi hành: </label>
                        <label>
                            <?php
                            echo (isset($province_booking_tour[$order_detail->from_province_id])) ? $province_booking_tour[$order_detail->from_province_id]->name : '';
                            ?>
                        </label>
                    </div>

                    <div>
                        <label>Điểm đến: </label>
                        <label>
                            <?php
                            echo (isset($province_booking_tour[$order_detail->to_province_id])) ? $province_booking_tour[$order_detail->to_province_id]->name : '';
                            ?>
                        </label>
                    </div>

                    <div>
                        <label>Phương tiện: </label>
                        <label>
                            <?php echo html_escape($order_detail->transportation);?>
                        </label>
                    </div>

                    <div>
                        <label>Ngày khởi hành: </label>
                        <label><?php echo date('d-m-Y', strtotime($order->date_start));?></label>
                    </div>

                </div>

                <div style="margin-top:20px; border-bottom:1px solid #dadada; padding-bottom: 10px">
                    <b style="font-size: 13px; color: black;">Thông tin người đặt</b>
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

            </div>
    
            <div>
                <div style="margin-top:20px; border-bottom:1px solid #dadada; padding-bottom: 10px">
                    <b style="font-size: 13px; color: black;">Thông tin thanh toán</b>
                </div>
    
                <div class="paymentinfo" style="margin-top: 5px; line-height: 1.7; color: black;">
                    <div class="clearfix" style="padding-bottom: 5px;">
                        <label><?php echo html_escape($order_detail->name);?></label>
                        <br>
                        <label style="padding: 0;">
                            <?php echo $order->slot;?> người &nbsp; x &nbsp;<?php echo show_price($order_detail->price);?>&nbsp; = &nbsp; <?php echo show_price($order->price_payment);?>
                        </label>
                    </div>
                    
                    <div style="margin-top:5px; margin-bottom: 10px;"></div>
                    
                    <div>
                        <label>Tổng giá phòng:</label>
                        <label><?php echo show_price($order->price_payment);?></label>
                    </div>
    
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
                                    <p style="color: green; font-weight: bold; font-size: 15px">Đã thanh toán</p>
    							</div>
    						</div>
    					<div class="clearfix"></div>
    				</div>
            </div>
        </div>
        </div>
    </div>       
</div>
<br>
<p style="line-height: 1.7; color: black;">
    Lưu ý:<br>
    Download và in phiếu nhận phòng tại link:<br>
    <?php echo site_url() . '/backend/api/export_pdf_order_tour/?auth=' . $hash_auth . '&id=' . $order->id;?>
</p>