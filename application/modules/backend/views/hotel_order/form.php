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
                    <?php echo $record->order_code; ?>
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
                        <span>Thông tin người đặt</span>
                        <strong><?php echo html_escape($order_contact->name); ?></strong>
                        <address>
                            <?php echo html_escape($order_contact->address); ?> <br>
                            <abbr title="Phone">Phone:</abbr> <?php echo html_escape($order_contact->phone); ?> <br>
                            <abbr title="Email">Email:</abbr> <?php echo html_escape($order_contact->email); ?> <br>
                            <abbr title="Email">Tỉnh
                                Thành:</abbr> <?php echo html_escape($order_contact->province_name); ?> <br>
                        </address>
                    </div>

                    <div class="invoice-from" style="margin-left: 30px">
                        <span>Thông tin người nhận phòng</span>
                        <strong><?php echo html_escape($order_contact_stay->name); ?></strong>
                        <address>
                            <?php echo html_escape($order_contact_stay->address); ?> <br>
                            <abbr title="Phone">Phone:</abbr> <?php echo html_escape($order_contact_stay->phone); ?>
                            <br>
                            <abbr title="Email">Email:</abbr> <?php echo html_escape($order_contact_stay->email); ?>
                            <br>
                            <abbr title="Email">Tỉnh
                                Thành:</abbr> <?php echo html_escape($order_contact_stay->province_name); ?> <br>
                        </address>
                    </div>

                    <div class="invoice-infos" style="margin-left: 50px;">
                        <table>
                            <tr>
                                <th>Ngày đặt:</th>
                                <td><?php echo bk_format_date('d/m/Y', html_escape($record->create_time)); ?></td>
                            </tr>
                            <tr>
                                <th>Nhận phòng:</th>
                                <td><?php echo bk_format_date('d/m/Y', html_escape($record->date_stay_from)); ?></td>
                            </tr>
                            <tr>
                                <th>Trả phòng:</th>
                                <td><?php echo bk_format_date('d/m/Y', html_escape($record->date_stay_to)); ?></td>
                            </tr>
                            <tr>
                                <th>Tài khoản đặt:</th>
                                <td><?php echo ($record->user_email) ? html_escape($record->user_email) : 'Khách'; ?></td>
                            </tr>

                            <?php if ($record->member_promotion == 1): ?>
                                <tr>
                                    <th>Hưởng ưu đãi:</th>
                                    <td> <?php echo ($record->user_email == '') ? 'Không' : 'Có'; ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>

                    <div class="invoice-to" style="width: 300px; margin-left: 0">
                        <span>Khách sạn</span>
                        <strong><?php echo html_escape($record->hotel_name); ?></strong>
                        <address>
                            <?php echo html_escape($record->hotel_address); ?> <br>
                            <abbr title="Phone">Phone:</abbr> <?php echo html_escape($hotel->phone); ?> <br>
                            <abbr title="Email">Email:</abbr> <?php echo html_escape($hotel->email); ?> <br>
                            <abbr title="Email">Ưu đãi thành
                                viên:</abbr> <?php echo ($record->member_promotion == 1) ? $record->member_promotion_discount . '%' : 'Không'; ?>
                            <br>
                            <a href="#myModal" data-toggle="modal">Xem thêm</a>
                        </address>
                    </div>

                </div>

                <div class="span12" style="margin-left: 0;">
                    <strong>Lưu ý:</strong> <?php echo html_escape($record->order_note); ?>
                </div>

                <!-- Gia goc-->
                <?php if ($admin['group_id'] != 6): ?>
                    <div class="clearfix"></div>
                    <div class="invoice-payment">
                        <p><span><strong>Giá gốc</strong></span></p>
                    </div>
                    <table class="table table-striped table-invoice">
                        <thead>
                        <tr>
                            <th>Loại phòng</th>
                            <th>Số phòng</th>
                            <th>Số đêm</th>
                            <th>Giá</th>
                            <th>Giá cuối</th>
                            <th>Thêm giường</th>
                            <th class='tr' style="text-align: center">Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($order_room as $v): ?>
                            <tr>
                                <td><?php echo html_escape($v->room_name); ?></td>
                                <td><?php echo $v->room_number_booking; ?></td>
                                <td><?php echo $v->night; ?></td>
                                <td>
                                    <?php echo show_price_bk($v->price_origin); ?>
                                    <?php
                                    if ($v->promotion_id != 0) {
                                        echo '<br><img src="' . base_url() . 'public/backend/img/icon-promotion.png" />';
                                        echo ' Giảm ' . $v->promotion_discount . '%';
                                    }
                                    ?>
                                </td>
                                <td><?php echo show_price_bk($v->price_origin_final); ?></td>
                                <td>
                                    <?php echo show_price_bk($v->price_bedmore); ?>
                                </td>
                                <td class='total'><?php echo show_price_bk($v->price_origin_total); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="5"></td>
                            <td class='taxes' colspan="2">
                                <p>
                                    <span class="light"><i class="icon-money"></i> Tổng tiền:</span>
                                    <span><?php echo show_price_bk($record->price_origin_payment); ?></span>
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                <?php endif; ?>

                <!-- Gia ban-->
                <div class="clearfix"></div>
                <div class="invoice-payment">
                    <p><span><strong>Giá bán</strong></span></p>
                </div>
                <table class="table table-striped table-invoice">
                    <thead>
                    <tr>
                        <th>Loại phòng</th>
                        <th>Số phòng</th>
                        <th>Số đêm</th>
                        <th>Giá</th>
                        <th>Giá cuối</th>
                        <th>Thêm giường</th>
                        <th class='tr' style="text-align: center">Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $price_room_total = 0;?>
                    <?php foreach ($order_room as $v): ?>
                        <tr>
                            <td><?php echo html_escape($v->room_name); ?></td>
                            <td><?php echo $v->room_number_booking; ?></td>
                            <td><?php echo $v->night; ?></td>
                            <td>
                                <?php echo show_price_bk($v->price); ?>
                                <?php
                                if ($v->promotion_id != 0) {
                                    echo '<br><img src="' . base_url() . 'public/backend/img/icon-promotion.png" />';
                                    echo ' Giảm ' . $v->promotion_discount . '%';
                                }
                                ?>

                            </td>
                            <td><?php echo show_price_bk($v->price_final); ?></td>
                            <td>
                                <?php echo show_price_bk($v->price_bedmore); ?>
                            </td>
                            <td class='total'><?php echo show_price_bk($v->price_total); ?></td>
                        </tr>
                        <?php $price_room_total += $v->price_total;?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4"></td>
                        <td class='taxes' colspan="3">
                            <?php if ($record->coupon != ''):?>
                            <p>
                                <span class="light"><i class="icon-money"></i> Mã khuyến mãi:</span>
                                <span>
                                    <?php echo $record->coupon; ?> <strong>(<?php echo $record->coupon_discount; ?>%, <?php echo show_price_bk($record->coupon_discount_max_price); ?>)</strong>
                                    <br>
                                    <?php echo '-' . show_price_bk($price_room_total - $record->price_payment);?>
                                </span>
                            </p>
                            <?php endif;?>
                            <p>
                                <span class="light"><i class="icon-money"></i> Tổng tiền:</span>
                                <span><?php echo show_price_bk($record->price_payment); ?></span>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="invoice-info">
                    <div class="invoice-from">
                        <span>Phương thức thanh toán</span>
                        <?php if (($admin['group_id'] != 6 && $record->status == 5) || ($admin['group_id'] != 6 && $admin['group_id'] != 8)): ?>
                            <select id="payment_type" name="payment_type" style="margin-top: 5px;">
                                <option
                                    value="1" <?php echo ($record->payment_type == '1') ? 'selected="selected"' : ''; ?>>
                                    Thanh toán tại văn phòng Azy
                                </option>
                                <option
                                    value="2" <?php echo ($record->payment_type == '2') ? 'selected="selected"' : ''; ?>>
                                    Chuyển khoản
                                </option>
                                <option
                                    value="3" <?php echo ($record->payment_type == '3') ? 'selected="selected"' : ''; ?>>
                                    Thẻ ATM nội địa
                                </option>
                                <option
                                    value="4" <?php echo ($record->payment_type == '4') ? 'selected="selected"' : ''; ?>>
                                    Thẻ quốc tế Visa, Master
                                </option>
                            </select>
                        <?php else: ?>
                            <strong><?php echo show_payment_type($record->payment_type); ?></strong>
                        <?php endif; ?>
                        <br>
                        <?php if (($admin['group_id'] != 6 && $record->status == 5) || ($admin['group_id'] != 6 && $admin['group_id'] != 8)): ?>
                            <select id="paid_select" name="paid" style="margin-top: 5px;">
                                <option value="0" <?php echo ($record->paid == '0') ? 'selected="selected"' : ''; ?>>
                                    Chưa thanh toán
                                </option>
                                <option value="1" <?php echo ($record->paid == '1') ? 'selected="selected"' : ''; ?>>Đã
                                    thanh toán
                                </option>
                                <option value="2" <?php echo ($record->paid == '2') ? 'selected="selected"' : ''; ?>>Đã
                                    thanh toán 1 phần
                                </option>
                            </select>
                            <p class="form-inline" id="deposit_content"
                               style="margin-top:5px; <?php echo ($record->paid != '2') ? 'display: none' : ''; ?>">
                                <strong>Trả trước</strong>
                                <br>
                                <input onkeyup="this.value = (addCommas(this.value));"
                                       value="<?php echo show_price_bk($record->deposit); ?>" type="" name="deposit"
                                       id="deposit" style="padding: 3px; border: 1px solid #CCC;"/>
                            </p>
                        <?php else: ?>
                            <?php echo show_paid($record->paid); ?>
                            <?php if ($record->paid == '2'): ?>
                                <p class="form-inline" id="deposit_content" style="margin-top:5px;">
                                    <strong>Trả trước</strong>
                                    <br>
                                    <?php echo show_price_bk($record->deposit); ?>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="invoice-to" style="margin-left: 80px; float: left !important">
                        <span>Ghi chú (nếu có)</span>
                        <?php if (($admin['group_id'] != 6 && $record->status == 5) || ($record->status == 3 && $admin['group_id'] == 6) || ($admin['group_id'] != 6 && $admin['group_id'] != 8)): ?>
                            <textarea name="note"
                                      style="width: 220px; height: 43px"><?php echo html_escape($record->note); ?></textarea>
                        <?php else: ?>
                            <?php echo html_escape($record->note); ?>
                        <?php endif; ?>
                    </div>

                    <div class="invoice-to" style="margin-left: 80px; display: none; float: left !important"
                         id="send_mail">
                        <span>Gửi email</span>
                        <label><input type="checkbox" name="send_mail" value="1"> Gửi email cho khách hàng</label>
                    </div>
                </div>
                <div class="form-actions" style="text-align: right">
                    <?php if (($admin['group_id'] != 6 && $record->status == 5) || ($record->status == 3 && $admin['group_id'] == 6) || ($admin['group_id'] != 6 && $admin['group_id'] != 8)): ?>
                        <select name="status" style="margin-right: 10px;" class="input-medium valid">
                            <?php foreach ($status as $k => $v): ?>
                                <option <?php echo ($k == $record->status) ? 'selected="selected"' : ''; ?>
                                    value="<?php echo $k; ?>"><?php echo $v; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>
                    <?php else: ?>
                        Trạng thái:
                        <?php
                        echo show_status_order($record->status);
                        ?>
                    <?php endif; ?>
                </div>

                <?php if ($admin['group_id'] != 6):?>
                <div class="invoice-from">
                    <span><strong>Thanh toán cho khách sạn</strong></span>
                    <?php if (($admin['group_id'] != 6 && $record->status == 5) || ($admin['group_id'] != 6 && $admin['group_id'] != 8)): ?>
                        <br>
                        <select id="deposit_partner_confirm" name="deposit_partner_confirm" style="margin-top: 5px;">
                            <option
                                value="0" <?php echo ($record->deposit_partner_confirm == '0') ? 'selected="selected"' : ''; ?>>
                                Chưa thanh toán
                            </option>
                            <option
                                value="1" <?php echo ($record->deposit_partner_confirm == '1') ? 'selected="selected"' : ''; ?>>
                                Đã
                                thanh toán
                            </option>

                        </select>
                        <br>
                        <input type="text" onkeyup="this.value=(addCommas(this.value));" id="deposit_partner_money"
                               name="deposit_partner_money"
                               value="<?php echo show_price_bk($record->deposit_partner_money); ?>"
                               style="margin-top: 5px"/>
                    <?php else: ?>
                        <br>
                        <?php
                        echo ($record->deposit_partner_confirm == 1) ? '<span style="color: #393; font-weight: bold">Đã thanh toán</span>' : '<span style="color: #b94a48; font-weight: bold">Chưa thanh toán</span>';
                        ?>
                        <br>
                        <?php echo show_price_bk($record->deposit_partner_money); ?>
                    <?php endif; ?>
                </div>
                <?php endif;?>


                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Thông tin chung khách sạn</h3>
        </div>
        <div class="modal-body">
            <blockquote>
                <p>Thông tin</p>
            </blockquote>
            <dl class="dl-horizontal">
                <dt>Tài khoản ngân hàng</dt>
                <dd><?php echo $hotel->bank_account; ?></dd>
                <dt>Tên ngân hàng</dt>
                <dd><?php echo $hotel->bank_name; ?></dd>
                <dt>Chi nhánh ngân hàng</dt>
                <dd><?php echo $hotel->bank_branch; ?></dd>
                <dt>Số tài khoản</dt>
                <dd><?php echo $hotel->account_number; ?></dd>
                <dt>Mã số thuế</dt>
                <dd><?php echo $hotel->mst; ?></dd>
                <dt>Điện thoại</dt>
                <dd><?php echo $hotel->phone; ?></dd>
                <dt>Email</dt>
                <dd><?php echo $hotel->email; ?></dd>
                <dt>Website</dt>
                <dd><?php echo $hotel->website; ?></dd>
                <dt>Fax</dt>
                <dd><?php echo $hotel->fax; ?></dd>
            </dl>

            <blockquote>
                <p>Bộ phận quản lý</p>
            </blockquote>
            <dl class="dl-horizontal">
                <dt>Tên</dt>
                <dd><?php echo $hotel->manager_name; ?></dd>
                <dt>Email</dt>
                <dd><?php echo $hotel->manager_email; ?></dd>
                <dt>Điện thoại</dt>
                <dd><?php echo $hotel->manager_phone; ?></dd>
            </dl>

            <blockquote>
                <p>Bộ phận kinh doanh</p>
            </blockquote>
            <dl class="dl-horizontal">
                <dt>Tên</dt>
                <dd><?php echo $hotel->business_name; ?></dd>
                <dt>Email</dt>
                <dd><?php echo $hotel->business_email; ?></dd>
                <dt>Điện thoại</dt>
                <dd><?php echo $hotel->business_phone; ?></dd>
            </dl>

            <blockquote>
                <p>Bộ phận đặt phòng</p>
            </blockquote>
            <dl class="dl-horizontal">
                <dt>Tên</dt>
                <dd><?php echo $hotel->booking_name; ?></dd>
                <dt>Email</dt>
                <dd><?php echo $hotel->booking_email; ?></dd>
                <dt>Điện thoại</dt>
                <dd><?php echo $hotel->booking_phone; ?></dd>
            </dl>

            <blockquote>
                <p>Bộ phận kế toán</p>
            </blockquote>
            <dl class="dl-horizontal">
                <dt>Tên</dt>
                <dd><?php echo $hotel->accountant_name; ?></dd>
                <dt>Email</dt>
                <dd><?php echo $hotel->accountant_email; ?></dd>
                <dt>Điện thoại</dt>
                <dd><?php echo $hotel->accountant_phone; ?></dd>
            </dl>

        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
</div>
