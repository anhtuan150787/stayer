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
                <?php echo form_open('', array('class' => 'form-horizontal', 'autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?>
                <div class="span6">
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tên</label>

                        <div class="controls">
                            <input type="text" name="name" id="name" class="input-xlarge"
                                   value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Miền</label>

                        <div class="controls">
                            <?php
                            $area_id = array();
                            (isset($record->area)) ? $area_id = explode(',', $record->area) : '';
                            ?>
                            <select multiple="multiple" name="area[]" style="width: 83%;">
                                <?php foreach($area as $v) : ?>
                                    <option <?php echo (in_array($v->id, $area_id)) ? 'selected="selected"' : '';?> value="<?php echo $v->id;?>"><?php echo html_escape($v->name);?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Khách sạn cụ thể</label>

                        <div class="controls">
                            <textarea style="height: 100px" name="hotel" id="hotel" class="input-block-level"><?php echo (isset($record->hotel)) ? html_escape(trim($record->hotel, ',')) : ""; ?></textarea>
                        </div>
                    </div>



                    <div class="control-group">
                        <label class="control-label">Trạng thái</label>

                        <div class="controls">
                            <label class='radio'>
                                <input <?php echo (isset($record->status) && $record->status == 1) ? 'checked="checked"' : ''; ?>
                                    type="radio" name="status" value="1" checked="checked"> Hiển thị
                            </label>
                            <label class='radio'>
                                <input <?php echo (isset($record->status) && $record->status == 0) ? 'checked="checked"' : ''; ?>
                                    type="radio" name="status" value="0"> Ẩn
                            </label>
                        </div>
                    </div>
                </div>

                <div class="span6">
                    <div class="control-group">
                        <label for="textfield" class="control-label">Thời gian sử dụng</label>

                        <div class="controls">
                            <input type="text" name="use_date_from" placeholder="Từ ngày" id="use_date_from" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->use_date_from)) ? html_escape($record->use_date_from) : ""; ?>">
                            <input type="text" name="use_date_to" placeholder="Đến ngày" id="use_date_to" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->use_date_to)) ? html_escape($record->use_date_to) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Thời gian đặt phòng</label>

                        <div class="controls">
                            <input type="text" name="order_date_from" placeholder="Từ ngày" id="order_date_from" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->order_date_from)) ? html_escape($record->order_date_from) : ""; ?>">
                            <input type="text" name="order_date_to" placeholder="Đến ngày" id="order_date_to" class="input-medium datepick" data-date-format='yyyy-mm-dd' value="<?php echo (isset($record->order_date_to)) ? html_escape($record->order_date_to) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Số đêm ở</label>

                        <div class="controls">
                            <input type="text" name="night" id="night" class="input-xlarge"
                                   value="<?php echo (isset($record->night)) ? html_escape($record->night) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Số lần sử dụng mã</label>

                        <div class="controls">
                            <input type="text" name="use_time" id="use_time" class="input-xlarge"
                                   value="<?php echo (isset($record->use_time)) ? html_escape($record->use_time) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            Giảm giá (%)
                        </label>
                        <div class="controls">
                            <input type="text" name="discount" id="discount" class="input-xlarge" value="<?php echo (isset($record->discount)) ? html_escape($record->discount) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">
                            Giá giảm tối đa
                        </label>
                        <div class="controls">
                            <input type="text" name="discount_max_price" id="discount_max_price" class="input-xlarge" value="<?php echo (isset($record->discount_max_price)) ? show_price_bk(html_escape($record->discount_max_price)) : ""; ?>" onkeyup="this.value = (addCommas(this.value));">
                        </div>
                    </div>

                </div>


                <div class="span12">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
