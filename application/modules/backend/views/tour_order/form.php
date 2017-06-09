<?php
if (!empty($success))
    show_mesg_success($success);
?>

<?php
if (!empty($error))
    show_mesg_error($error);
?>

<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-qrcode"></i>
                    <?php echo $record->order_code;?>
                </h3>
            </div>
            <div class="box-content">

                <?php echo form_open('', array('class' => 'form-horizontal', 'autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?>
                <div class="invoice-info">
                    <!--
                    <div class="invoice-name">
                        Company Name
                    </div>
                    -->
                    <div class="invoice-from">
                        <span>Thông tin người đặt tour</span>
                        <strong><?php echo html_escape($order_contact->name);?></strong>
                        <address>
                            <?php echo html_escape($order_contact->address);?> <br>
                            <abbr title="Phone">Phone:</abbr> <?php echo html_escape($order_contact->phone);?> <br>
                            <abbr title="Email">Email:</abbr> <?php echo html_escape($order_contact->email);?> <br>
                            <abbr title="Email">Tỉnh Thành:</abbr> <?php echo html_escape($order_contact->province_name);?> <br>
                        </address>
                    </div>

                    <div class="invoice-from" style="margin-left: 50px;">
                        <span>Thông tin tour</span>
                        <strong><?php echo html_escape($order_detail->name);?></strong>
                        <address>
                            <abbr title="Phone">Tour ID:</abbr> <?php echo html_escape($order_detail->id);?> <br>
                        </address>
                    </div>

                </div>

                <div class="span12" style="margin-left: 0;">
                    <strong>Lưu ý:</strong> <?php echo html_escape($record->order_note); ?>
                </div>


                <!-- Gia ban-->
                <div class="clearfix"></div>
                <div class="invoice-payment">
                    <p><span><strong>Giá bán</strong></span></p>
                </div>
                <table class="table table-striped table-invoice">
                    <thead>
                        <tr>
                            <th>Ngày khởi hành</th>
                            <th>Thời gian</th>
                            <th>Điểm khởi hành</th>
                            <th>Điểm đến</th>
                            <th>Phương tiện</th>
                            <th>Số người</th>
                            <th class='tr' style="text-align: center">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><?php echo date('d-m-Y', strtotime($record->date_start));?></td>
                            <td><?php echo html_escape($order_detail->time);?></td>
                            <td>
                                <?php
                                echo (isset($province_booking_tour[$order_detail->from_province_id])) ? $province_booking_tour[$order_detail->from_province_id]->name : '';
                                ?>
                            </td>
                            <td>
                                <?php
                                echo (isset($province_booking_tour[$order_detail->to_province_id])) ? $province_booking_tour[$order_detail->to_province_id]->name : '';
                                ?>
                            </td>
                            <td>
                                <?php echo html_escape($order_detail->transportation);?>
                            </td>
                            <td>
                                <?php echo $record->slot;?>
                            </td>
                            <td class='total'><?php echo show_price_bk($record->price_payment);?></td>
                        </tr>

                        <tr>
                            <td colspan="5"></td>
                            <td class='taxes' colspan="2">
                                <p>
                                    <span class="light"><i class="icon-money"></i> Tổng tiền:</span>
                                    <span><?php echo show_price_bk($record->price_payment);?></span>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="invoice-info">
                    <div class="invoice-from">
                        <span>Phương thức thanh toán</span>
                        <?php if (($admin['group_id'] != 9 && $record->status == 5) || ($admin['group_id'] != 9 && $admin['group_id'] != 8)):?>
                        <select id="payment_type" name="payment_type" style="margin-top: 5px;">
                            <option value="1" <?php echo ($record->payment_type == '1') ? 'selected="selected"' : '';?>>Thanh toán tại văn phòng Azy</option>
                            <option value="2" <?php echo ($record->payment_type == '2') ? 'selected="selected"' : '';?>>Chuyển khoản</option>
                            <option value="3" <?php echo ($record->payment_type == '3') ? 'selected="selected"' : '';?>>Thẻ ATM nội địa</option>
                            <option value="4" <?php echo ($record->payment_type == '4') ? 'selected="selected"' : '';?>>Thẻ quốc tế Visa, Master</option>
                        </select>
                        <?php else:?>
                            <strong><?php echo show_payment_type($record->payment_type);?></strong>
                        <?php endif;?>
                        <br>
                        <?php if (($admin['group_id'] != 9 && $record->status == 5) || ($admin['group_id'] != 9 && $admin['group_id'] != 8)):?>
                        <select id="paid_select" name="paid" style="margin-top: 5px;">
                            <option value="0" <?php echo ($record->paid == '0') ? 'selected="selected"' : '';?>>Chưa thanh toán</option>
                            <option value="1" <?php echo ($record->paid == '1') ? 'selected="selected"' : '';?>>Đã thanh toán</option>
                        </select>
                        <?php endif;?>        
                    </div>

                    <div class="invoice-to" style="margin-left: 80px; float: left !important">
                        <span>Ghi chú (nếu có)</span>
                        <?php if (($admin['group_id'] != 9 && $record->status == 5) || ($record->status == 3 && $admin['group_id'] == 9) || ($admin['group_id'] != 9 && $admin['group_id'] != 8)):?>
                        <textarea name="note" style="width: 220px; height: 43px"><?php echo html_escape($record->note);?></textarea>
                        <?php else:?>
                        <?php echo html_escape($record->note);?>    
                        <?php endif;?> 
                    </div>

                    <div class="invoice-to" style="margin-left: 80px; display: none; float: left !important"  id="send_mail">
                        <span>Gửi email</span>
                        <label><input type="checkbox" name="send_mail" value="1"> Gửi email cho khách hàng</label>
                    </div>
                </div>
                <div class="form-actions" style="text-align: right">
                    <?php if (($admin['group_id'] != 9 && $record->status == 5) || ($record->status == 3 && $admin['group_id'] == 9) || ($admin['group_id'] != 9 && $admin['group_id'] != 8)):?>
                    <select name="status" style="margin-right: 10px;" class="input-medium valid">
                        <?php foreach($status as $k => $v):?>
                        <option <?php echo ($k == $record->status) ? 'selected="selected"' : '';?> value="<?php echo $k;?>"><?php echo $v;?></option>    
                        <?php endforeach;?>    
                    </select>
                    <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>  
                    <?php else:?>   
                    Trạng thái:
                    <?php
                        echo show_status_order($record->status);
                    ?> 
                    <?php endif;?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>