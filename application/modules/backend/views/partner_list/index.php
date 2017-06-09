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
                <div class="dataTables_filter" id="DataTables_Table_4_filter">

                    <input value="<?php echo ($this->input->get('keyword_search')) ? $this->input->get('keyword_search') : '';?>" type="text" name="keyword_search" placeholder="Tài khoản, email, tên...">

                    <select name="status_search">
                        <option value="">Trạng thái</option>
                            <option <?php echo ($this->input->get('status_search') === '1') ? 'selected="selected"' : '';?> value="1">Kích hoạt</option>
                            <option <?php echo ($this->input->get('status_search') === '0') ? 'selected="selected"' : '';?> value="0">Tạm dừng</option>
                    </select>

                    &nbsp;
                    <input type="submit" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Tìm kiếm" style="float: right;">
                </div>
                <div class="box-content nopadding">
                    <table class="table table-nomargin">
                        <thead>
                        <tr>
                            <th>Tài khoản</th>
                            <th>Email</th>
                            <th>Nhóm</th>
                            <th>Tên</th>
                            <th>Điện thoại</th>
                            <th>Ngày tạo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($records)) : ?>
                            <?php foreach ($records as $v) : ?>
                                <tr>
                                    <td class="text-center">
                                        <a href="<?php echo site_url() . '/backend/partner/edit/' . $v->id; ?>"><?php echo html_escape($v->username); ?></a>
                                    </td>
                                    <td class="text-center">
                                        <?php echo html_escape($v->email); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo html_escape($v->group_name); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo html_escape($v->name); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo html_escape($v->phone); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo bk_format_date('d/m/Y', $v->create_time); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close(); ?>