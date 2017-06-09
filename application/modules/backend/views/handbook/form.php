<link href="<?php echo base_url() . 'public/backend/js/tags-plugin/js/jquery.tagit.css';?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() . 'public/backend/js/tags-plugin/js/tagit.ui-zendesk.css';?>" rel="stylesheet" type="text/css">
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
            <div class="box-content nopadding">
                <?php echo form_open('', array('class' => 'form-horizontal form-column', 'autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?>
                
                <div class="span6">
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
                                      {  
                                        echo '<img src="' . $this->config->item('pic_url') . 'handbooks/' . html_escape($record->picture) . '"/>';
                                      }
                                      else
                                      {
                                        echo '<img src="' . base_url() . 'public/backend/img/no-image.png" />';
                                      }  
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="span6">
                
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
                                <?php endif; ?>    
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Tỉnh/Thành</label>
                        <div class="controls">
                            <select name="province_id">
                                <option value="">--- Chọn Tỉnh/Thành ---</option>
                                <?php if (isset($province) && !empty($province)) : ?>
                                    <?php foreach ($province as $v) : ?>
                                        <option <?php echo (isset($record->province_id) && $record->province_id == $v->id) ? 'selected="selected"' : ''; ?> value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>    
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Bãi biển đẹp</label>
                        <div class="controls">
                            <select name="beach_id">
                                <option value="">--- Chọn Bãi biển ---</option>
                                <?php if (isset($beach) && !empty($beach)) : ?>
                                    <?php foreach ($beach as $v) : ?>
                                        <option <?php echo (isset($record->beach_id) && $record->beach_id == $v->id) ? 'selected="selected"' : ''; ?> value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>    
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="select" class="control-label">Chuyên mục</label>
                        <div class="controls">
                            <select style="width: 220px" multiple="multiple" name="category_id[]" id="category_id" class='input-large'>
                                <?php
                                
                                $category_id = array();
                                (isset($record->category_id)) ? $category_id = explode(',', $record->category_id) : '';
                                
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
                                                echo (in_array($v['id'], $category_id)) ? 'selected="selected"' : '';
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
                    
                    
                </div>
                
                <div class="span12">
                    <div class="control-group">
                        <label for="textarea" class="control-label">Tags</label>
                        <div class="controls">
                            <ul style="margin-left: 0;" id="singleFieldTags"></ul>
                            <?php
                            $tag_str = '';
                            if (isset($tag) && !empty($tag))
                            {
                                foreach($tag as $v)
                                {
                                    $tag_str .= ',' . $v->name;
                                }
                            }
                            ?>
                            <input style="display: none" name="tags" id="mySingleField" value="<?php echo trim($tag_str, ',');?>">
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
                        <label for="textarea" class="control-label">Keyword</label>

                        <div class="controls">
                            <textarea name="keyword" id="keyword"
                                      class="input-block-level keyword"><?php echo (isset($record->keyword)) ? html_escape($record->keyword) : ''; ?></textarea>
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
                </div>  
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'public/backend/js/tags-plugin/js/jquery.min.js';?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url() . 'public/backend/js/tags-plugin/js/jquery-ui.min.js';?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url() . 'public/backend/js/tags-plugin/js/tag-it.js' ;?>"></script>
<script type="text/javascript">
  $.noConflict();
   jQuery(function(){

    jQuery('#singleFieldTags').tagit({
        // This will make Tag-it submit a single form value, as a comma-delimited field.
        singleField: true,
        allowSpaces: true,
        singleFieldNode: $('#mySingleField')
    });
}); 

</script>