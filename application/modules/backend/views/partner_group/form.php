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
                <h3><i class="icon-edit"></i> <?php echo $action_name; ?></h3>
            </div>
            <div class="box-content">
                <?php echo form_open('', array('class' => 'form-horizontal', 'autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?>
                <div class="control-group">
                    <label for="textfield" class="control-label">Tên</label>

                    <div class="controls">
                        <input type="text" name="name" id="name" class="input-xlarge"
                               value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label for="textarea" class="control-label">Mô tả</label>

                    <div class="controls">
                        <textarea rows="2" name="description" id="description"
                                  class="input-block-level"><?php echo (isset($record->description)) ? html_escape($record->description) : ''; ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label for="textfield" class="control-label">Phân quyền</label>

                    <div class="controls">
                        <?php
                        $str_permission = array();
                        if (!empty($permission)) {
                            foreach ($permission as $v) {
                                $str_permission[] = $v->group . '::' . $v->controller . '::' . $v->method;
                            }
                        }
                        ?>

                        <?php $menu = require APPPATH . 'modules/backend/assets/config_menu_partner.php'; ?>
                        <?php foreach ($menu as $k => $v) : ?>
                            <div class="box box-color box-bordered group-permission">
                                <div class="box-title">
                                    <h3>
                                        <i class="icon-table"></i>
                                        <?php echo $v['name']; ?>
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <?php foreach ($v['item'] as $kk => $vv) : ?>
                                        <table class="table table-nomargin group-permission">
                                            <thead>
                                            <tr>
                                                <th class="controller"><?php echo $vv['name']; ?></th>
                                                <?php foreach ($vv['permission'] as $kkk => $vvv) : ?>
                                                    <th><?php echo $vvv; ?></th>
                                                <?php endforeach; ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td></td>
                                                <?php foreach ($vv['permission'] as $kkk => $vvv) : ?>
                                                    <td>
                                                        <?php $value_permission = strtolower($k . '::' . $kk . '::' . $kkk); ?>
                                                        <input <?php echo (in_array($value_permission, $str_permission)) ? 'checked="checked"' : ''; ?>
                                                            name="permission[]" type="checkbox"
                                                            value="<?php echo $value_permission; ?>"/>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                            </tbody>
                                        </table>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>