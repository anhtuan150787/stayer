<?php
if (!empty($success))
    show_mesg_success($success);
?>

<?php
if (!empty($error))
    show_mesg_error($error);
?>

<?php echo form_open(site_url('backend/admin'), array('autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?> 
<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3>
                    <i class="icon-table"></i>
                    Danh sách
                </h3>
            </div>
            <div class="box-content nopadding">
                <table class="table table-nomargin">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="checkbox-all" /></th>
                            <th>Username</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Nhóm</th>
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
                                        <a href="<?php echo site_url() . '/backend/admin/edit/' . $v->id; ?>"><?php echo html_escape($v->username); ?></a>
                                    </td>
                                    <td><?php echo html_escape($v->name); ?></td>
                                    <td><?php echo html_escape($v->email); ?></td>
                                    <td><?php echo html_escape($v->group_name); ?></td>
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
                <?php echo $this->pagination->create_links();?>
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
    <input onclick="location.href = '<?php echo site_url() . '/backend/admin/add'; ?>'" type="button" class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Tạo mới" style="float: right;">
</div>
<?php echo form_close(); ?>