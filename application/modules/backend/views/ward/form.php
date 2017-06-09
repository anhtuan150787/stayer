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
                        <input type="text" name="name" id="name" class="input-xlarge" value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Loại</label>
                    <div class="controls">
                        <select name="type">
                            <option value="">--- Chọn loại ---</option>
                            <option <?php echo (isset($record->type) && $record->type == 'Phường') ? 'selected="selected"' : ''; ?> value="Phường">Phường</option>
                            <option <?php echo (isset($record->type) && $record->type == 'Xã') ? 'selected="selected"' : ''; ?> value="Xã">Xã</option>
                            <option <?php echo (isset($record->type) && $record->type == 'Thị Trấn') ? 'selected="selected"' : ''; ?> value="Thị Trấn">Thị Trấn</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label for="textfield" class="control-label">Quốc gia</label>
                    <div class="controls">
                        <select name="national_id">
                            <option value="">--- Chọn Quốc Gia ---</option>
                            <?php foreach ($national as $v) : ?>
                                <option <?php echo (isset($record->national_id) && $record->national_id == $v->id) ? 'selected="selected"' : ''; ?> value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="textfield" class="control-label">Miền</label>
                    <div class="controls">
                        <select name="area_id">
                            <option value="">--- Chọn Miền ---</option>
                            <?php if (isset($area) && !empty($area)) : ?>
                            <?php foreach ($area as $v) : ?>
                                <option <?php echo (isset($record->area_id) && $record->area_id == $v->id) ? 'selected="selected"' : ''; ?> value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                            <?php endforeach; ?>
                            <?php endif;?>    
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="textfield" class="control-label">Tỉnh/Thành</label>
                    <div class="controls">
                        <select name="province_id">
                            <option value="">--- Tỉnh/Thành ---</option>
                            <?php if (isset($province) && !empty($province)) : ?>
                            <?php foreach ($province as $v) : ?>
                                <option <?php echo (isset($record->province_id) && $record->province_id == $v->id) ? 'selected="selected"' : ''; ?> value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                            <?php endforeach; ?>
                            <?php endif;?>    
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="textfield" class="control-label">Quận/Huyện</label>
                    <div class="controls">
                        <select name="district_id">
                            <option value="">--- Quận/Huyện ---</option>
                            <?php if (isset($district) && !empty($district)) : ?>
                            <?php foreach ($district as $v) : ?>
                                <option <?php echo (isset($record->district_id) && $record->district_id == $v->id) ? 'selected="selected"' : ''; ?> value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                            <?php endforeach; ?>
                            <?php endif;?>    
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Trạng thái</label>
                    <div class="controls">
                        <label class='radio'>
                            <input <?php echo (isset($record->status) && $record->status == 1) ? 'checked="checked"' : ''; ?> type="radio" name="status" value="1" checked="checked"> Hiển thị
                        </label>
                        <label class='radio'>
                            <input <?php echo (isset($record->status) && $record->status == 0) ? 'checked="checked"' : ''; ?> type="radio" name="status" value="0"> Ẩn
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
