<?php
if (!empty($success))
    show_mesg_success($success);
?>

<?php
if (!empty($error))
    show_mesg_error($error);
?>

<?php echo form_open(site_url('backend/' . $controller), array('autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?> 
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
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($records)) : ?>
                            <?php foreach ($records as $v) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox-item" name="check_item[]" value="<?php echo $v['id']; ?>" />
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url() . '/backend/' . $controller .'/edit/' . $v['id']; ?>"><?php echo html_escape(str_repeat('___', $v['level']) . ' ' . $v['name']);?></a>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($v['status'] == 1)
                                            $img = 'tick-circle.png';
                                        else
                                            $img = 'disabled.png';
                                        ?>
                                        <img 
                                            class="img_status" 
                                            params='{"id":"<?php echo $v['id']; ?>"}' 
                                            src="<?php echo base_url() . 'public/backend/img/' . $img; ?>" />
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
              
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