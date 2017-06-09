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
                    <label for="textfield" class="control-label">Số lượng mã</label>
                    <div class="controls">
                        <input type="text" name="num" id="num" class="input-xlarge" value="">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Nhóm mã</label>

                    <div class="controls">
                        <select name="group" id="group">
                            <option value="">--- Chọn Nhóm mã ---</option>
                            <?php foreach ($group as $v) : ?>
                                <option value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                        <label class="control-label">Trạng thái</label>
                        <div class="controls">
                            <label class='radio'>
                                <input <?php echo (isset($record->status) && $record->status == 1) ? 'checked="checked"' : '';?> type="radio" name="status" value="1" checked="checked"> Hiển thị
                            </label>
                            <label class='radio'>
                                <input <?php echo (isset($record->status) && $record->status == 0) ? 'checked="checked"' : '';?> type="radio" name="status" value="0"> Ẩn
                            </label>
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
