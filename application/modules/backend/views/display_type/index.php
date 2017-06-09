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
                            <th>Loại giao diện</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($records)) : ?>
                            <?php foreach ($records as $v) : ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo site_url() . '/backend/display/index/?type_id=' . $v->id; ?>"><?php echo html_escape($v->name); ?></a>
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
</div>
<?php echo form_close(); ?>