<style>
    body {
        background: white;
    }
</style>
<div class="col-sm-4" style="font-size: 13px;">
    <div class="panel-body">
        <h4>Người nhận phòng</h4>
        <address>
            <strong><?php echo html_escape($order_contact_stay->name); ?></strong>
            <br><?php echo html_escape($order_contact_stay->address); ?>
            <br><abbr title="Phone">Phone:</abbr> <?php echo html_escape($order_contact_stay->phone); ?>
            <br><abbr title="Email">Email:</abbr> <?php echo html_escape($order_contact_stay->email); ?>
            <br><abbr title="Email">Tỉnh Thành:</abbr> <?php echo html_escape($order_contact_stay->province_name); ?>
            <br>
        </address>
    </div>
</div>

<div class="col-sm-5" style="font-size: 13px;">
    <div class="panel-body">
        <h4>Thông tin đặt phòng</h4>
        <address>
            <strong>Ngày đặt phòng:</strong> <?php echo bk_format_date('d/m/Y', html_escape($record->create_time)); ?>
            <br><strong>Ngày nhận
                phòng:</strong> <?php echo bk_format_date('d/m/Y', html_escape($record->date_stay_from)); ?>
            <br><strong>Ngày trả
                phòng:</strong> <?php echo bk_format_date('d/m/Y', html_escape($record->date_stay_to)); ?>
            <br><strong>Tài
                khoản:</strong> <?php echo ($record->user_email) ? html_escape($record->user_email) : 'Khách'; ?>
            <?php if ($record->member_promotion == 1): ?>
                <br><strong>Hưởng ưu đãi (<?php echo $record->member_promotion_discount . '%'; ?>
                    ):</strong> <?php echo ($record->user_email == '') ? 'Không' : 'Có'; ?>
            <?php endif; ?>
        </address>
    </div>
</div>

<div class="col-sm-3" style="font-size: 13px;">
    <div class="panel-body">
        <h4>Trạng thái</h4>
        <p><?php echo show_status_order($record->status);?></p>
        <?php if($record->paid == '0'):?>
            <p style="color: #b94a48; font-weight: bold">(<?php echo show_paid($record->paid);?>)</p>
        <?php else:?>
            <p style="color: #468847; font-weight: bold">(<?php echo show_paid($record->paid);?>)</p>
        <?php endif;?>
    </div>
</div>

<div class="col-sm-12">
    <!-- Gia goc-->

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
                <p style="text-align: right">
                    <span class="light"><i class="icon-money"></i> Tổng tiền:</span>
                    <span style="font-weight: bold"><?php echo show_price_bk($record->price_origin_payment); ?>
                        VND</span>
                </p>
            </td>
        </tr>
        </tbody>
    </table>


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
        <?php endforeach; ?>
        <tr>
            <td colspan="5"></td>
            <td class='taxes' colspan="2">
                <p style="text-align: right">
                    <span class="light"><i class="icon-money"></i> Tổng tiền:</span>
                    <span style="font-weight: bold"><?php echo show_price_bk($record->price_payment); ?> VND</span>
                </p>
            </td>
        </tr>
        </tbody>
    </table>
</div>