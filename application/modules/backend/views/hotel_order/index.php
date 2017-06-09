<?php
if (!empty($success))
    show_mesg_success($success);
?>

<?php
if (!empty($error))
    show_mesg_error($error);
?>

<?php echo form_open(site_url('backend/' . $controller), array('autocomplete' => 'off', 'method' => 'get', 'id' => 'frm')); ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="icon-table"></i>
                        Danh sách
                    </h3>
                </div>
                <div style="margin-top: 10px;" id="DataTables_Table_4_filter">
                    <input class="input-small"
                           value="<?php echo ($this->input->get('code_search')) ? $this->input->get('code_search') : ''; ?>"
                           type="text" name="code_search" placeholder="Mã đơn hàng">
                    <input class="input-medium"
                           value="<?php echo ($this->input->get('user_search')) ? $this->input->get('user_search') : ''; ?>"
                           type="text" name="user_search" placeholder="Email khách hàng">
                    <input class="input-medium"
                           value="<?php echo ($this->input->get('hotel_name_search')) ? $this->input->get('hotel_name_search') : ''; ?>"
                           type="text" name="hotel_name_search" placeholder="Tên khách sạn">
                    <input class="input-small"
                           value="<?php echo ($this->input->get('admin_search')) ? $this->input->get('admin_search') : ''; ?>"
                           type="text" name="admin_search" placeholder="User xử lý">
                    <input class="input-small datepick" data-date-format="dd/mm/yyyy"
                           value="<?php echo ($this->input->get('date_from_search')) ? $this->input->get('date_from_search') : ''; ?>"
                           type="text" name="date_from_search" placeholder="Từ ngày">
                    <input class="input-small datepick" data-date-format="dd/mm/yyyy"
                           value="<?php echo ($this->input->get('date_to_search')) ? $this->input->get('date_to_search') : ''; ?>"
                           type="text" name="date_to_search" placeholder="Đến ngày">
                    <select name="paid_search" class="input-medium">
                        <option value="">Tình trạng</option>
                        <option <?php echo ('0' === $this->input->get('paid_search')) ? 'selected="selected"' : ''; ?>
                            value="0">Chưa thanh toán
                        </option>
                        <option <?php echo ('1' === $this->input->get('paid_search')) ? 'selected="selected"' : ''; ?>
                            value="1">Đã thanh toán
                        </option>
                        <option <?php echo ('2' === $this->input->get('paid_search')) ? 'selected="selected"' : ''; ?>
                            value="2">Đã thanh toán 1 phần
                        </option>
                    </select>
                    <select name="status_search" class="input-medium">
                        <option value="">Trạng thái</option>
                        <?php foreach ($status as $k => $v) : ?>
                            <option <?php echo ($k == $this->input->get('status_search')) ? 'selected="selected"' : ''; ?>
                                value="<?php echo $k; ?>"><?php echo $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="deposit_partner_confirm_search" class="input-medium">
                        <option value="">Thanh toán cho khách sạn</option>
                        <option <?php echo ('0' === $this->input->get('deposit_partner_confirm_search')) ? 'selected="selected"' : ''; ?>
                            value="0">Chưa thanh toán
                        </option>
                        <option <?php echo ('1' === $this->input->get('deposit_partner_confirm_search')) ? 'selected="selected"' : ''; ?>
                            value="1">Đã thanh toán
                        </option>
                    </select>

                    &nbsp;
                    <input type="submit" id="btn_action_submit"
                           class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Tìm kiếm"
                           style="float: right;">
                    &nbsp;
                    <input id="btn_action_export" name="btn_action_export" type="submit"
                           class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Excel"
                           style="float: right; margin-right: 5px">
                    &nbsp;
                </div>
                <div class="dataTables_info" id="DataTables_Table_0_info">
                    <span class="label label-important"><?php echo $paid_count[0]; ?></span> Chưa thanh toán
                    &nbsp;
                    <span class="label label-success"><?php echo $paid_count[1]; ?></span> Đã thanh toán
                    &nbsp;
                    <span class="label"><?php echo $paid_count[2]; ?></span> Đã thanh toán 1 phần
                    &nbsp;|&nbsp;
                    <span class="label label-default"><?php echo $status_count[2]; ?></span> Chờ xử lý
                    &nbsp;
                    <span class="label label-warning"><?php echo $status_count[3]; ?></span> Đang xử lý
                    &nbsp;
                    <span class="label label-info"><?php echo $status_count[5]; ?></span> Chờ duyệt
                    &nbsp;
                    <span class="label label-success"><?php echo $status_count[6]; ?></span> Thành công
                    &nbsp;
                    <span class="label label-important"><?php echo $status_count[4]; ?></span> Thất bại
                    &nbsp;
                    <span class="label label-inverse"><?php echo $status_count[7]; ?></span> Hủy

                </div>
                <div class="box-content nopadding">
                    <table class="table table-nomargin">
                        <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Khách sạn</th>
                            <th>Tài khoản đặt</th>
                            <th>Thời gian đặt</th>
                            <?php if ($admin['group_id'] != 6): ?>
                                <th>Giá gốc</th>
                            <?php endif; ?>
                            <th>Giá</th>
                            <th>User xử lý</th>
                            <?php if ($admin['group_id'] != 6): ?>
                            <th>Thanh toán khách sạn</th>
                            <?php endif;?>
                            <th>Tình trạng</th>
                            <th>Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($records)) : ?>
                            <?php foreach ($records as $v) : ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo site_url() . '/backend/' . $controller . '/edit/' . $v->id; ?>"><strong><?php echo html_escape($v->order_code); ?></strong></a>
                                    </td>
                                    <td>
                                        <?php echo html_escape($v->hotel_name); ?>
                                    </td>
                                    <td>
                                        <?php echo ($v->user_email) ? html_escape($v->user_email) : 'Khách'; ?>
                                    </td>
                                    <td>
                                        <?php echo bk_format_date('d/m/Y', $v->create_time); ?>
                                    </td>
                                    <?php if ($admin['group_id'] != 6): ?>
                                        <td>
                                            <?php echo show_price_bk($v->price_origin_payment); ?>
                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <?php echo show_price_bk($v->price_payment); ?>
                                    </td>
                                    <td>
                                        <?php echo html_escape($v->admin_username); ?>
                                        <?php if (($v->status == 2 || $v->status == 3) && $admin['group_id'] != 6): ?>
                                            <br><a onclick="get_order_change(<?php echo $v->id; ?>)" href="#myModal"
                                                   data-toggle="modal">Chuyển đơn hàng</a>
                                        <?php endif; ?>
                                    </td>
                                    <?php if ($admin['group_id'] != 6): ?>
                                    <td>
                                        <?php
                                        echo show_deposit_partner($v->deposit_partner_confirm);
                                        ?>
                                    </td>
                                    <?php endif;?>
                                    <td>
                                        <?php
                                        echo show_paid($v->paid);
                                        ?>
                                        <?php echo ($v->paid == 2) ? '<br>' . show_price_bk($v->deposit) : ''; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        echo show_status_order($v->status);
                                        if ($v->status == 2 && $v->time_cancel != '') {
                                            echo '<br>' . $v->time_cancel . ' (hủy)';
                                            echo '<br><a href="' . site_url('backend/' . $controller . '/delay_order_cancel/?time=' . $v->time_cancel . '&order_id=' . $v->id) . '">Gia hạn</a>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="dataTables_info" id="DataTables_Table_0_info">
                        Tổng số: <strong><?php echo $total_rows; ?></strong> đơn hàng
                        <?php if ($admin['group_id'] != 6): ?>
                            | Tổng doanh thu: <strong><?php echo show_price_bk($price_total); ?></strong>
                            | Tổng tiền trả khách sạn:
                            <strong><?php echo show_price_bk($price_origin_total); ?></strong>
                        <?php endif; ?>
                    </div>

                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>

<?php if ($admin['group_id'] == 6): ?>
    <div class="form-actions" style="margin-top: 0;">
        <button onclick="location.href = '<?php echo site_url() . '/backend/' . $controller . '/add'; ?>'" type="button"
                class="btn btn-primary ui-wizard-content ui-formwizard-button" style="float: right;">
            <span id="count_order_wait_process" class="badge badge-important"
                  style="top: -10px; left: -15px; border-radius: 5px !important; box-shadow: 0 0 5px black"><?php echo $order_wait_process; ?></span>
            Lấy đơn hàng
        </button>
    </div>
<?php endif; ?>

<?php echo form_close(); ?>

<?php if ($admin['group_id'] != 6): ?>
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Danh sách User</h3>
            </div>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-content nopadding">
                                <table class="table table-nomargin dataTable table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Tài khoản</th>
                                        <th>Email</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($user_process as $v): ?>
                                        <tr>
                                            <td><?php echo html_escape($v->username); ?></td>
                                            <td>
                                                <?php echo html_escape($v->email); ?>
                                            </td>
                                            <td>
                                                <button onclick="change_user_process(<?php echo $v->id; ?>)"
                                                        type="button" class="btn btn-primary">Chuyển
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input id="order_change" type="hidden" value=""/>

    <!-- dataTables -->
    <script src="<?php echo base_url(); ?>public/backend/js/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>public/backend/js/plugins/datatable/TableTools.min.js"></script>
    <script src="<?php echo base_url(); ?>public/backend/js/plugins/datatable/ColReorder.min.js"></script>
    <script src="<?php echo base_url(); ?>public/backend/js/plugins/datatable/ColVis.min.js"></script>

    <script>
        function get_order_change(id) {
            $("#order_change").val(id);
        }

        function change_user_process(id) {
            location.href = '<?php echo site_url() . 'backend/hotel_order/change_user_process';?>/?order=' + $("#order_change").val() + '&user=' + id;
        }
    </script>
<?php endif; ?>