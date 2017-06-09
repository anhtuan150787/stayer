<link rel="stylesheet" href="<?php echo base_url();?>public/backend/css/plugins/datepicker/datepicker.css">
<script src="<?php echo base_url();?>public/backend/js/plugins/datepicker/bootstrap-datepicker.js"></script>

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
                        <label for="textfield" class="control-label">Khách sạn</label>
                        <div class="controls" style="padding-top: 5px;">
                            <strong><?php echo html_escape($hotel->name); ?></strong>
                        </div>
                    </div>
                        
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên <?php echo diffrence_str('name', $difference);?></label>
                        <div class="controls">
                            <input type="text" name="name" id="name" class="input-xlarge" value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            Giảm giá (%) <?php echo diffrence_str('discount', $difference);?>
                        </label>
                        <div class="controls">
                            <input type="text" name="discount" id="discount" class="input-xlarge" value="<?php echo (isset($record->discount)) ? html_escape($record->discount) : ""; ?>">
                        </div>
                    </div>
                    
                    
                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            Loại phòng áp dụng <?php echo diffrence_str('room_id', $difference);?>
                        </label>
                        <div class="controls">
                            <?php 
                            $room_id = array();
                            (isset($record->room_id)) ? $room_id = explode(',', $record->room_id) : '';
                            ?>
                            <select multiple="multiple" name="room_id[]" style="width: 83%;">
                                <?php foreach($rooms as $v) : ?>
                                <option <?php echo (in_array($v->id, $room_id)) ? 'selected="selected"' : '';?> value="<?php echo $v->id;?>"><?php echo html_escape($v->name);?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    
                </div>  
                
                <div class="span6">
                
                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            
                        </label>
                        <div class="controls">
                            <strong>Điều kiện áp dụng khuyến mãi</strong>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            Ngày áp dụng
                        </label>
                        <div class="controls">
                            <input type="text" name="date_apply_from" placeholder="Từ ngày" id="date_apply_from" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->date_apply_from)) ? html_escape($record->date_apply_from) : ""; ?>">
                            <input type="text" name="date_apply_to" placeholder="Đến ngày" id="date_apply_to" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->date_apply_to)) ? html_escape($record->date_apply_to) : ""; ?>">
                            <div class="span6" style="padding-top: 5px; min-height: 0"><?php echo diffrence_str('date_apply_from', $difference);?></div>
                            <div class="span6" style="padding-top: 5px; padding-left: 5px; min-height: 0"><?php echo diffrence_str('date_apply_to', $difference);?></div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            Ngày đặt
                        </label>
                        <div class="controls">
                            <input type="text" placeholder="Từ ngày" name="book_day_from" id="book_day_from" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->book_day_from)) ? html_escape($record->book_day_from) : ""; ?>">
                            <input type="text" placeholder="Đến ngày" name="book_day_to" id="book_day_to" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->book_day_to)) ? html_escape($record->book_day_to) : ""; ?>">
                            <div class="span6" style="padding-top: 5px; min-height: 0"><?php echo diffrence_str('book_day_from', $difference);?></div>
                            <div class="span6" style="padding-top: 5px; padding-left: 5px; min-height: 0"><?php echo diffrence_str('book_day_to', $difference);?></div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            Ngày ở
                        </label>
                        <div class="controls">
                            <input type="text" placeholder="Từ ngày" name="stay_day_from" id="stay_day_from" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->stay_day_from)) ? html_escape($record->stay_day_from) : ""; ?>">
                            <input type="text" placeholder="Đến ngày" name="stay_day_to" id="stay_day_to" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->stay_day_to)) ? html_escape($record->stay_day_to) : ""; ?>">
                            <div class="span6" style="padding-top: 5px; min-height: 0"><?php echo diffrence_str('stay_day_from', $difference);?></div>
                            <div class="span6" style="padding-top: 5px; padding-left: 5px; min-height: 0"><?php echo diffrence_str('stay_day_to', $difference);?></div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            Số đêm tối thiểu <?php echo diffrence_str('night', $difference);?>
                        </label>
                        <div class="controls">
                            <input style="width: 93%;" type="text" name="night" id="night" class="input-xlarge" value="<?php echo (isset($record->night)) ? html_escape($record->night) : ""; ?>">
                        </div>
                    </div>
                </div>
                
                <div class="span12">
                
                    <div class="control-group">
                        <label for="textarea" class="control-label">Chính sách hủy <?php echo diffrence_str('policy', $difference);?></label>
                        <div class="controls">
                            <textarea rows="5" name="policy" id="policy" class="input-block-level description"><?php echo (isset($record->policy)) ? html_escape($record->policy) : ''; ?></textarea>
                        </div>
                    </div>

                    <?php if (isset($record->update_by)):?>
                    <div class="control-group">
                        <label for="textfield" class="control-label">Thời gian cập nhật</label>
                        <div class="controls" style="padding-top: 5px;">
                            <?php echo $record->update_time; ?> bởi <strong><?php echo $record->update_by; ?></strong>
                        </div>
                    </div>
                    <?php endif;?>
                    
                    <div class="control-group">
                        <label class="control-label">Trạng thái</label>
                        <div class="controls">
                            <?php 
                            //Sale
                            if ($admin['group_id'] != 2) {?>
                                <?php foreach($status as $k => $v) {?>
                                <label class='radio'>
                                    <input <?php echo (isset($record->status) && $record->status == $k) ? 'checked="checked"' : ''; ?> type="radio" name="status" value="<?php echo $k;?>"> <?php echo $v;?>
                                </label>    
                                <?php }?>
                            <?php } else { //Sale?>
                                 <label class='radio'>
                                    <input checked="checked" type="radio" name="status" value="<?php echo (isset($record->status) && $record->status != 2) ? 3 : 2;?>"> <?php echo (isset($record->status) && $record->status != 2) ? $status[3] : $status[2];?>
                                </label>    
                            <?php }?>
                        </div>
                    </div>

                </div>
                
                <div class="span12">
                    <div class="form-actions">
                        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>" />
                        <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
