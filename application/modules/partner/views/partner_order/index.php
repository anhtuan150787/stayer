<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách
        </div>
        <div class="panel-heading dataTables_filter" id="DataTables_Table_4_filter">
            <?php echo form_open(site_url('partner/' . $controller), array('autocomplete' => 'off', 'method' => 'get', 'id' => 'frm')); ?>
            <label><input class="form-control input-sm" value="<?php echo ($this->input->get('code_search')) ? $this->input->get('code_search') : '';?>" type="text" name="code_search" placeholder="Mã đơn hàng"></label>
            <label><input class="form-control input-sm" value="<?php echo ($this->input->get('user_search')) ? $this->input->get('user_search') : '';?>" type="text" name="user_search" placeholder="Email khách hàng"></label>
            <label><input class="form-control input-sm datepick" data-date-format="dd/mm/yyyy" value="<?php echo ($this->input->get('date_from_search')) ? $this->input->get('date_from_search') : '';?>" type="text" name="date_from_search" placeholder="Từ ngày"></label>
            <label><input class="form-control input-sm datepick" data-date-format="dd/mm/yyyy" value="<?php echo ($this->input->get('date_to_search')) ? $this->input->get('date_to_search') : '';?>" type="text" name="date_to_search" placeholder="Đến ngày"></label>
            &nbsp;
            <input type="submit" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Tìm kiếm" style="float: right;">

            <?php echo form_close(); ?>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tài khoản đặt</th>
                        <th>Thời gian hoàn tất</th>
                        <th>Giá gốc</th>
                        <th>Giá</th>
                        <th>Tình trạng</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($records)) : ?>
                        <?php foreach ($records as $v) : ?>
                            <tr>
                                <td>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target=".order_detail" data-url="<?php echo site_url() . '/partner/' . $controller . '/edit/' . $v->id; ?>"><strong><?php echo html_escape($v->order_code); ?></strong></a>
                                </td>

                                <td>
                                    <?php echo ($v->user_email) ? html_escape($v->user_email) : 'Khách'; ?>
                                </td>

                                <td>
                                    <?php echo bk_format_date('d/m/Y', $v->verify_time); ?>
                                </td>

                                <td>
                                    <?php echo show_price_bk($v->price_origin_payment); ?>
                                </td>

                                <td>
                                    <?php echo show_price_bk($v->price_payment); ?>
                                </td>

                                <td>

                                    <?php

                                    if ($v->paid == 1)
                                        echo '<span style="color: #468847; font-weight: bold">' . show_paid($v->paid) . '</span>';
                                    else
                                        echo '<span style="color: #b94a48; font-weight: bold">' . show_paid($v->paid) . '</span>';
                                    ?>

                                </td>
                                <td class="text-center">
                                    <?php
                                    echo show_status_order($v->status);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="dataTables_info" id="DataTables_Table_0_info">
                    Tổng số: <strong><?php echo $total_rows; ?></strong> đơn hàng
                    | Tổng doanh thu: <strong><?php echo show_price_bk($price_origin_total); ?> VND</strong>
                    (Tính theo giá gốc)
                </div>
                <?php echo $this->pagination->create_links(); ?>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>

<!-- Modal -->
<div class="modal fade order_detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Chi tiết đặt phòng</h4>
            </div>
            <div class="modal-body" style="height: 500px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->