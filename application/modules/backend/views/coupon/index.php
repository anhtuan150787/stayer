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

                <input value="<?php echo ($this->input->get('keyword_search')) ? $this->input->get('keyword_search') : '';?>" type="text" name="keyword_search" placeholder="Mã...">
                &nbsp;
                <input type="submit" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Tìm kiếm" style="float: right;">
            </div>
            <div class="box-content nopadding">
                <table class="table table-nomargin">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkbox-all" /></th>
                            <th>Mã</th>
                            <th>Nhóm</th>
                            <th>Ngày tạo</th>
                            <th>User tạo</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($records)) : ?>
                            <?php foreach ($records as $v) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox-item" name="check_item[]" value="<?php echo $v->id; ?>" />
                                    </td>
                                    <td>
                                        <a href="#"><?php echo html_escape($v->code); ?></a>
                                    </td>
                                    <td><?php echo html_escape($v->group_name); ?></td>
                                    <td><?php echo html_escape($v->create_time); ?></td>
                                    <td><?php echo html_escape($v->username); ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($v->status == 1)
                                            $img = 'tick-circle.png';
                                        else
                                            $img = 'disabled.png';
                                        ?>
                                        <img 
                                            class="img_status" 
                                            params='{"id":"<?php echo $v->id; ?>"}' 
                                            src="<?php echo base_url() . 'public/backend/img/' . $img; ?>" />
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

<div class="form-actions" style="margin-top: 0;">
    <select id="list_action" style="float: left; margin-right: 10px;" class="input-small valid">
        <option value="">Thao tác</option>
        <option value="delete">Xóa</option>
    </select>
    <input onclick="return confirm_action()" type="submit" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Thực hiện" style="float: left;">
    <input onclick="location.href = '<?php echo site_url() . '/backend/' . $controller . '/add'; ?>'" type="button" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Tạo mới" style="float: right;">
</div>
<?php echo form_close(); ?>