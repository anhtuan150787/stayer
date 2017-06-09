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
                        <label for="textfield" class="control-label">Hình đại diện</label>

                        <div class="controls">
                            <input type="file" class="uploadbox" id="singleupload_input" name="img" value=""/>
                            <input style="width: 0px; height: 0px; border: none" type="text" name="img_name"
                                   id="img_name"
                                   value="<?php echo (isset($record->picture) && $record->picture != '') ? html_escape($record->picture) : ''; ?>"/>

                            <div class="image_loaded">
                                <?php
                                if (isset($record->picture) && $record->picture != '') {
                                    echo '<img src="' . $this->config->item('pic_url') . 'tours/' . html_escape($record->picture) . '"/>';
                                } else {
                                    echo '<img src="' . base_url() . 'public/backend/img/no-image.png" />';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Tour</label>

                        <div class="controls">
                            <input type="text" name="name" id="name" class="input-xlarge"
                                   value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Nhà cung cấp</label>

                        <div class="controls">
                            <select name="partner_tour_id" class="input-xlarge">
                                <option value="">--- Chọn ---</option>
                                <?php foreach ($partner_tour as $v) : ?>
                                    <option <?php echo (isset($record->partner_tour_id) && $record->partner_tour_id == $v->id) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Thời gian</label>

                        <div class="controls">
                            <input type="text" name="time" id="time" class="input-xlarge"
                                   value="<?php echo (isset($record->time)) ? html_escape($record->time) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Phương tiện</label>

                        <div class="controls">
                            <input type="text" name="transportation" id="transportation" class="input-xlarge"
                                   value="<?php echo (isset($record->transportation)) ? html_escape($record->transportation) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Giá</label>

                        <div class="controls">
                            <input onkeyup="this.value = (addCommas(this.value));" type="text" name="price" id="price"
                                   class="input-xlarge"
                                   value="<?php echo (isset($record->price)) ? show_price_bk(html_escape($record->price)) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Ngày khởi hành</label>

                        <div class="controls">
                            <input <?php echo (isset($record->start_date) && $record->start_date == 1) ? 'checked="checked"' : ""; ?>
                                type="checkbox" name="daily" value="1"> Hằng ngày<br><br>

                            <input type="text" id="start_date" class="input-medium datepick"
                                      data-date-format='yyyy-mm-dd'
                                      value="">
                            <a id="get_more_start_date" href="javascript:void(0)">Thêm</a>
                            <textarea id="start_date_wrap" name="start_date" style="margin-top: 10px; height: 100px"><?php echo (isset($record->start_date) && $record->start_date != 1) ? html_escape($record->start_date) : ""; ?></textarea>

                        </div>
                    </div>

                </div>
                <div class="span6">

                    <div class="control-group" style="margin-bottom: 0;">
                        <label for="textfield" class="control-label" style="text-align: right; font-weight: bold">Điểm
                            khởi hành</label>

                        <div class="controls" style="padding-bottom: 10px"></div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Quốc gia</label>

                        <div class="controls">
                            <select name="from_national_id">
                                <option value="">--- Chọn Quốc Gia ---</option>
                                <?php foreach ($from_national as $v) : ?>
                                    <option <?php echo (isset($record->from_national_id) && $record->from_national_id == $v->id) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Miền</label>

                        <div class="controls">
                            <select name="from_area_id">
                                <option value="">--- Chọn Miền ---</option>
                                <?php if (isset($from_area) && !empty($from_area)) : ?>
                                    <?php foreach ($from_area as $v) : ?>
                                        <option <?php echo (isset($record->from_area_id) && $record->from_area_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Tỉnh/Thành</label>

                        <div class="controls">
                            <select name="from_province_id">
                                <option value="">--- Tỉnh/Thành ---</option>
                                <?php if (isset($from_province) && !empty($from_province)) : ?>
                                    <?php foreach ($from_province as $v) : ?>
                                        <option <?php echo (isset($record->from_province_id) && $record->from_province_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>


                    <div class="control-group" style="margin-bottom: 0;">
                        <label for="textfield" class="control-label" style="text-align: right; font-weight: bold">Điểm
                            đến</label>

                        <div class="controls" style="padding-bottom: 10px"></div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Quốc gia</label>

                        <div class="controls">
                            <select name="to_national_id">
                                <option value="">--- Chọn Quốc Gia ---</option>
                                <?php foreach ($to_national as $v) : ?>
                                    <option <?php echo (isset($record->to_national_id) && $record->to_national_id == $v->id) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Miền</label>

                        <div class="controls">
                            <select name="to_area_id">
                                <option value="">--- Chọn Miền ---</option>
                                <?php if (isset($to_area) && !empty($to_area)) : ?>
                                    <?php foreach ($to_area as $v) : ?>
                                        <option <?php echo (isset($record->to_area_id) && $record->to_area_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Tỉnh/Thành</label>

                        <div class="controls">
                            <select name="to_province_id">
                                <option value="">--- Tỉnh/Thành ---</option>
                                <?php if (isset($to_province) && !empty($to_province)) : ?>
                                    <?php foreach ($to_province as $v) : ?>
                                        <option <?php echo (isset($record->to_province_id) && $record->to_province_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textarea" class="control-label">Chủ đề</label>

                        <div class="controls">
                            <select multiple name="topic_id[]">
                                <?php
                                $tour_topic = explode(',', $record->topic_id);
                                ?>
                                <?php foreach ($topic as $v): ?>
                                    <option <?php echo (in_array($v->id, $tour_topic)) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textarea" class="control-label">Ẩn nhà cung cấp</label>

                        <div class="controls">
                            <input <?php echo (isset($record->hide_provider) && $record->hide_provider == 1) ? "checked='checked'" : ""; ?>
                                type="checkbox" value="1" name="hide_provider"/>
                        </div>
                    </div>

                </div>

                <div class="span12">
                    <div class="control-group">
                        <label for="textfield" class="control-label">Dịch vụ</label>

                        <div class="controls">
                            <div class="facilities">
                                <?php
                                if (isset($record->service_id))
                                    $tour_service = explode(',', $record->service_id);
                                ?>

                                <?php foreach ($service as $v) : ?>
                                    <div class="span3">
                                        <input type="checkbox" name="service_id[]"
                                               value="<?php echo $v->id; ?>" <?php echo (isset($record->service_id) && in_array($v->id, $tour_service)) ? 'checked="checked"' : ''; ?>
                                               id="service_<?php echo $v->id; ?>"/> <label
                                            for="service_<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span12">
                    <div class="control-group">
                        <label for="textarea" class="control-label">Giá bao gồm</label>

                        <div class="controls">
                            <textarea name="price_description" id="price_description"
                                      class="input-block-level description"><?php echo (isset($record->price_description)) ? html_escape($record->price_description) : ''; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="span12">
                    <div class="control-group">
                        <label for="textarea" class="control-label">Chính sách</label>

                        <div class="controls">
                            <textarea name="policy" id="policy"
                                      class="input-block-level description"><?php echo (isset($record->policy)) ? html_escape($record->policy) : ''; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="span12">
                    <div class="control-group">
                        <label for="textarea" class="control-label">Lịch trình</label>

                        <div class="controls">
                            <textarea name="description" id="description"
                                      class="input-block-level content"><?php echo (isset($record->description)) ? html_escape($record->description) : ''; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="span12">
                    <div class="control-group">
                        <label for="textarea" class="control-label">Hình ảnh</label>

                        <div class="controls">

                            <div class="btn-group">
                                <a id="up_picture_trigger" href="javascript:void(0);" class="btn btn-danger"><i
                                        class="icon-cloud-upload"></i> Upload</a>
                            </div>

                            <div id='imageloadstatus' style='display:none'><img
                                    src="<?php echo base_url(); ?>public/backend/js/uploadimage/loading.gif"
                                    alt="Uploading...."/></div>
                            <ul id="gallery" class="gallery">
                                <?php
                                if (!empty($pictures)) {
                                    $gallery = '';

                                    foreach ($pictures as $v) {
                                        $gallery .= '<li>
                                                        <a href="#">
                                                                <img src="' . $this->config->item('pic_url') . 'tours/' . html_escape($v->name) . '" alt="">
                                                        </a>
                                                        <div class="extras">
                                                                <div class="extras-inner">
                                                                        <a href="javascript:void(0)" class="del-tour-pic" pic="' . $v->id . '"><i class="icon-trash"></i></a>
                                                                </div>
                                                        </div>
                                                    </li>';
                                    }

                                    echo $gallery;
                                }
                                ?>
                            </ul>

                        </div>
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
                    <label for="textarea" class="control-label">Description</label>

                    <div class="controls">
                            <textarea name="description_meta" id="description_meta"
                                      class="input-block-level"><?php echo (isset($record->description_meta)) ? html_escape($record->description_meta) : ''; ?></textarea>
                    </div>
                </div>

                <div class="span12">
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

<div>
    <form id="imageform" method="post" enctype="multipart/form-data"
          action='<?php echo base_url(); ?>backend/api/upload_list_image' style="clear:both">
        <div id='imageloadbutton'>
            <input type="file" name="photos[]" id="photoimg" multiple="true" style="display: none"/>
        </div>
    </form>
</div>