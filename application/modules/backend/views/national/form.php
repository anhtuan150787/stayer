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
                    <label for="textfield" class="control-label">Hình ảnh</label>
                    <div class="controls">
                        <input type="file" class="uploadbox" id="singleupload_input" name="img" value=""/>
                        <input style="width: 0px; height: 0px; border: none" type="text" name="img_name" id="img_name" value="<?php echo (isset($record->picture) && $record->picture != '') ? html_escape($record->picture) : ''; ?>" />
                        <div class="image_loaded">
                            <?php
                            if (isset($record->picture) && $record->picture != '')
                            {
                                echo '<img src="' . $this->config->item('pic_url') . 'nationals/' . html_escape($record->picture) . '"/>';
                            } else
                            {
                                echo '<img src="' . base_url() . 'public/backend/img/no-image.png" />';
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <label for="textarea" class="control-label">Mô tả</label>
                    <div class="controls">
                        <textarea rows="5" name="description" id="description" class="input-block-level description"><?php echo (isset($record->description)) ? html_escape($record->description) : '';?></textarea>
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
