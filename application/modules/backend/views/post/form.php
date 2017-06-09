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
                    <label for="textfield" class="control-label">Tiêu đề</label>
                    <div class="controls">
                        <input type="text" name="name" id="name" class="input-xlarge" value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="textfield" class="control-label">Hình đại diện</label>
                    <div class="controls">
                        <input type="file" class="uploadbox" id="singleupload_input" name="img" value=""/>
                        <input style="width: 0px; height: 0px; border: none" type="text" name="img_name" id="img_name" value="<?php echo (isset($record->picture) && $record->picture != '') ? html_escape($record->picture) : '';?>" />
                        <div class="image_loaded">
                            <?php if (isset($record->picture) && $record->picture != '')
                                    echo '<img src="' . $this->config->item('pic_url') . 'news/' . html_escape($record->picture) . '"/>'
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="select" class="control-label">Danh mục</label>
                    <div class="controls">
                        <select name="category_id" id="category_id" class='input-large'>
                            <option value="">Không</option>
                            <?php
                            $show = true;
                            $level = 0;
                            foreach ($category as $v):
                                ?>
                                <?php ($v['level'] == 0 || $v['level'] == $level) ? $show = true : ''; ?>
                                <?php if ($v['id'] != $record->id)
                                {
                                    ?>
                                    <?php if ($show == true): ?>
                                        <option
                                        <?php
                                        if (isset($record->category_id))
                                        {
                                            echo ($record->category_id == $v['id']) ? 'selected="selected"' : '';
                                        }
                                        ?>
                                            value="<?php echo $v['id']; ?>"><?php echo html_escape(str_repeat('___', $v['level']) . ' ' . $v['name']); ?>
                                        </option>
                                    <?php endif; ?>
                                    <?php
                                }
                                else
                                {
                                    $show = false;
                                    $level = $v['level'];
                                };
                                ?>

<?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="textarea" class="control-label">Mô tả tóm tắt</label>
                    <div class="controls">
                        <textarea rows="3" name="description" id="description" class="input-block-level"><?php echo (isset($record->description)) ? html_escape($record->description) : '';?></textarea>
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="textarea" class="control-label">Nội dung</label>
                    <div class="controls">
                        <textarea name="content" id="content" class="input-block-level content"><?php echo (isset($record->content)) ? html_escape($record->content) : '';?></textarea>
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
