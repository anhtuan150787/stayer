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
                <h3><i class="icon-list"></i> <?php echo $action_name; ?></h3>
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
                        <label for="textfield" class="control-label">Tên loại
                            phòng <?php echo diffrence_str('name', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="name" id="name" class="input-xlarge"
                                   value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Hình
                            ảnh <?php echo diffrence_str('picture', $difference); ?></label>

                        <div class="controls">
                            <input type="file" class="uploadbox" id="singleupload_input" name="img" value=""/>
                            <input style="width: 0px; height: 0px; border: none" type="text" name="img_name"
                                   id="img_name"
                                   value="<?php echo (isset($record->picture) && $record->picture != '') ? html_escape($record->picture) : ''; ?>"/>

                            <div class="image_loaded">
                                <?php
                                if (isset($record->picture) && $record->picture != '') {
                                    echo '<img src="' . $this->config->item('pic_url') . 'hotels/' . html_escape($record->picture) . '"/>';
                                } else {
                                    echo '<img src="' . base_url() . 'public/backend/img/no-image.png" />';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Số lượng
                            phòng <?php echo diffrence_str('room_number', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="room_number" id="room_number" class="input-xlarge"
                                   value="<?php echo (isset($record->room_number)) ? html_escape($record->room_number) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Kiểu
                            phòng <?php echo diffrence_str('type', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="type" id="type" class="input-xlarge"
                                   value="<?php echo (isset($record->type)) ? html_escape($record->type) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Diện
                            tích <?php echo diffrence_str('size', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="size" id="size" class="input-xlarge"
                                   value="<?php echo (isset($record->size)) ? html_escape($record->size) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Giường <?php echo diffrence_str('bed', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="bed" id="bed" class="input-xlarge"
                                   value="<?php echo (isset($record->bed)) ? html_escape($record->bed) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Người
                            lớn <?php echo diffrence_str('slot', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="slot" id="slot" class="input-xlarge"
                                   value="<?php echo (isset($record->slot)) ? html_escape($record->slot) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Trẻ
                            em <?php echo diffrence_str('slot_child', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="slot_child" id="slot_child" class="input-xlarge"
                                   value="<?php echo (isset($record->slot_child)) ? html_escape($record->slot_child) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Ẩn giá
                            bán <?php echo diffrence_str('hide_price', $difference); ?></label>

                        <div class="controls">
                            <input <?php echo (isset($record->hide_price) && $record->hide_price == 1) ? 'checked="checked"' : ""; ?>
                                type="checkbox" name="hide_price" value="1"/>
                        </div>
                    </div>

                </div>

                <div class="span6">
                    <div class="control-group" style="margin-bottom: 0;">
                        <label for="textarea" class="control-label">Loại
                            giá <?php echo diffrence_str('price_type', $difference); ?></label>

                        <div class="controls">
                            <label for="price_type_vnd" style="display: inline;">
                                <input <?php echo (isset($record->price_type) && $record->price_type == 'vnd') ? 'checked="checked"' : ""; ?>
                                    type="radio" name="price_type" id="price_type_vnd" value="vnd" required/> VND
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label for="price_type_usd" style="display: inline;">
                                <input <?php echo (isset($record->price_type) && $record->price_type == 'usd') ? 'checked="checked"' : ""; ?>
                                    type="radio" name="price_type" id="price_type_usd" value="usd" required/> USD
                            </label>
                            <label for="price_type" class="error"></label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="textarea" class="control-label"></label>

                        <div class="controls">
                            <div class="span6"><strong>Giá gốc</strong></div>
                            <div class="span6"><strong>Giá bán</strong></div>
                        </div>
                    </div>
                    <?php for ($i = 1; $i <= 7; $i++) : ?>
                        <div class="control-group">
                            <label for="textarea" class="control-label"><?php echo 'Giá thứ ' . day_name($i); ?></label>

                            <div class="controls">
                                <input type="text" class="input-medium" name="price_origin[<?php echo $i; ?>]"
                                       value="<?php echo (isset($price[$i]->price_origin)) ? show_price_bk(html_escape($price[$i]->price_origin)) : ""; ?>"
                                       placeholder="Giá gốc" onkeyup="this.value = (addCommas(this.value));"/>
                                <input type="text" class="input-medium" name="price[<?php echo $i; ?>]"
                                       value="<?php echo (isset($price[$i]->price)) ? show_price_bk(html_escape($price[$i]->price)) : ""; ?>"
                                       placeholder="Giá bán" onkeyup="this.value = (addCommas(this.value));"/>

                                <div class="span6"
                                     style="padding-top: 5px; min-height: 0"><?php echo diffrence_str($i, $difference_price_origin); ?></div>
                                <div class="span6"
                                     style="padding-top: 5px; padding-left: 5px; min-height: 0"><?php echo diffrence_str($i, $difference_price); ?></div>
                            </div>
                        </div>
                    <?php endfor; ?>
                    <div class="control-group">
                        <label for="textarea" class="control-label">Giá ngày
                            lễ <?php echo diffrence_str('8', $difference_price); ?></label>

                        <div class="controls">
                            <input type="text" class="input-medium" name="price_origin[8]"
                                   value="<?php echo (isset($price[8]->price)) ? show_price_bk(html_escape($price[8]->price_origin)) : ""; ?>"
                                   placeholder="Giá gốc" onkeyup="this.value = (addCommas(this.value));"/>
                            <input type="text" class="input-medium" name="price[8]"
                                   value="<?php echo (isset($price[8]->price)) ? show_price_bk(html_escape($price[8]->price)) : ""; ?>"
                                   placeholder="Giá bán" onkeyup="this.value = (addCommas(this.value));"/>

                            <div class="span6"
                                 style="padding-top: 5px; min-height: 0"><?php echo diffrence_str($i, $difference_price_origin); ?></div>
                            <div class="span6"
                                 style="padding-top: 5px; padding-left: 5px; min-height: 0"><?php echo diffrence_str($i, $difference_price); ?></div>
                            <select style="margin-top: 5px; width: 97%" multiple="multiple" name="holiday[]">
                                <?php $record_holiday = explode(',', $record->holiday); ?>
                                <?php foreach ($holiday as $v) : ?>
                                    <option <?php echo (isset($record->holiday) && in_array($v->date, $record_holiday)) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->date; ?>"><?php echo $v->name . ' - ' . $v->date; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div class="span6"
                                 style="padding-top: 5px; min-height: 0"><?php echo diffrence_str('holiday', $difference); ?></div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textarea" class="control-label">Giá theo giai đoạn</label>
                        <?php $price_stage_stt = 1; ?>
                        <?php if (!isset($record)) : ?>
                            <div class="item_price_stage">
                                <div class="controls">
                                    <input style="margin-bottom: 5px;" type="text" class="input-medium datepick valid"
                                           data-date-format="yyyy-mm-dd"
                                           name="datefrom_price_stage[<?php echo $price_stage_stt; ?>]" value=""
                                           placeholder="Từ ngày"/>
                                    <input style="margin-bottom: 5px;" type="text" class="input-medium datepick valid"
                                           data-date-format="yyyy-mm-dd"
                                           name="dateto_price_stage[<?php echo $price_stage_stt; ?>]" value=""
                                           placeholder="Đến ngày"/>
                                    <input type="text" class="input-medium"
                                           name="price_stage_origin[<?php echo $price_stage_stt; ?>]" value=""
                                           placeholder="Giá gốc" onkeyup="this.value = (addCommas(this.value));"/>
                                    <input type="text" class="input-medium"
                                           name="price_stage[<?php echo $price_stage_stt; ?>]" value=""
                                           placeholder="Giá bán" onkeyup="this.value = (addCommas(this.value));"/>
                                    <hr>
                                </div>
                            </div>
                        <?php else: ?>

                            <div class="item_price_stage">
                                <?php if (!empty($room_price_stage)) {?>
                                <?php foreach ($room_price_stage as $v): ?>
                                    <div class="controls">
                                        <input style="margin-bottom: 5px;" type="text"
                                               class="input-medium datepick valid"
                                               data-date-format="yyyy-mm-dd"
                                               name="datefrom_price_stage[<?php echo $price_stage_stt; ?>]"
                                               value="<?php echo $v->date_from; ?>"
                                               placeholder="Từ ngày"/>
                                        <input style="margin-bottom: 5px;" type="text"
                                               class="input-medium datepick valid"
                                               data-date-format="yyyy-mm-dd"
                                               name="dateto_price_stage[<?php echo $price_stage_stt; ?>]"
                                               value="<?php echo $v->date_to; ?>"
                                               placeholder="Đến ngày"/>
                                        <input type="text" class="input-medium"
                                               name="price_stage_origin[<?php echo $price_stage_stt; ?>]"
                                               value="<?php echo $v->price_origin; ?>"
                                               placeholder="Giá gốc" onkeyup="this.value = (addCommas(this.value));"/>
                                        <input type="text" class="input-medium"
                                               name="price_stage[<?php echo $price_stage_stt; ?>]"
                                               value="<?php echo $v->price; ?>"
                                               placeholder="Giá bán" onkeyup="this.value = (addCommas(this.value));"/>
                                        <label style="float: right"><a class="remove_price"
                                                                       href="javascript:void(0)">Xóa</a></label>
                                        <hr>
                                    </div>
                                <?php endforeach; ?>
                                <?php }?>
                            </div>
                        <?php endif; ?>

                        <div class="controls" style="float: right"><a id="get_more_price" href="javascript:void(0);">Thêm</a>
                            <input type="hidden" id="price_stage_stt" name="price_stage_stt"
                                   value="<?php echo $price_stage_stt; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textarea" class="control-label">Thêm giường (nếu
                            có) <?php echo diffrence_str('bed_more::bed_more_price', $difference); ?></label>

                        <div class="controls">
                            <input <?php echo (isset($record->bed_more) && $record->bed_more == 1) ? 'checked="checked"' : ""; ?>
                                type="checkbox" name="bed_more" value="1"/>
                            &nbsp;&nbsp;&nbsp;<input type="text" class="input-medium" name="bed_more_price"
                                                     value="<?php echo (isset($record->bed_more_price)) ? html_escape(show_price_bk($record->bed_more_price)) : ""; ?>"
                                                     placeholder="giá thêm giường"
                                                     onkeyup="this.value = (addCommas(this.value));"/>
                        </div>
                    </div>
                </div>


                <div class="span12">
                    <div class="control-group">
                        <label for="textfield" class="control-label">Tiện
                            ích <?php echo diffrence_str('facilities_id', $difference); ?></label>

                        <div class="controls">
                            <div class="facilities">
                                <?php
                                if (isset($record->facilities_id))
                                    $facilities_record = explode(',', $record->facilities_id);
                                ?>

                                <?php foreach ($facilities as $v) : ?>
                                    <div class="span3">
                                        <input type="checkbox" name="facilities[]"
                                               value="<?php echo $v->id; ?>" <?php echo (isset($record->facilities_id) && in_array($v->id, $facilities_record)) ? 'checked="checked"' : ''; ?>
                                               id="facilities_<?php echo $v->id; ?>"/> <label
                                            for="facilities_<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>


                    <div class="control-group">
                        <label for="textarea" class="control-label">Thông
                            tin <?php echo diffrence_str('description', $difference); ?></label>

                        <div class="controls">
                            <textarea name="description" id="description"
                                      class="input-block-level description"><?php echo (isset($record->description)) ? html_escape($record->description) : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textarea" class="control-label">Chính sách
                            hủy <?php echo diffrence_str('policy', $difference); ?></label>

                        <div class="controls">
                            <textarea name="policy" id="policy"
                                      class="input-block-level description"><?php echo (isset($record->policy)) ? html_escape($record->policy) : ''; ?></textarea>
                        </div>
                    </div>

                    <?php if (isset($record)): ?>
                        <div class="control-group">
                            <label for="textfield" class="control-label">Thời gian cập nhật</label>

                            <div class="controls" style="padding-top: 5px;">
                                <?php echo $record->update_time; ?> bởi
                                <strong><?php echo $record->update_by; ?></strong>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="control-group">
                        <label class="control-label">Trạng thái</label>

                        <div class="controls">
                            <?php
                            //Sale
                            if ($admin['group_id'] != 2) { ?>
                                <?php foreach ($status as $k => $v) { ?>
                                    <label class='radio'>
                                        <input <?php echo (isset($record->status) && $record->status == $k) ? 'checked="checked"' : ''; ?>
                                            type="radio" name="status" value="<?php echo $k; ?>"> <?php echo $v; ?>
                                    </label>
                                <?php } ?>
                            <?php } else { //Sale?>
                                <label class='radio'>
                                    <input checked="checked" type="radio" name="status"
                                           value="<?php echo (isset($record->status) && $record->status != 2) ? 3 : 2; ?>"> <?php echo (isset($record->status) && $record->status != 2) ? $status[3] : $status[2]; ?>
                                </label>
                            <?php } ?>
                        </div>
                    </div>

                </div>

                <div class="span12">
                    <div class="form-actions">
                        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>"/>
                        <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
