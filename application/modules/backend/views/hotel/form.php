<!-- Maps marker-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXYmdhn6o880uuMJ5uo8hmfjJpFacpXmo&v=3.exp&sensor=false"></script>

<script>
    // The following example creates a marker in Stockholm, Sweden
    // using a DROP animation. Clicking on the marker will toggle
    // the animation between a BOUNCE animation and no animation.

    var latDefault = 10.813572407910886;
    var lngDefault = 106.65695795893555;
    var zoomDefault = 14;
    var geocoder;
    var map;
    var marker;
    function initialize() {
        getPosition();
        var vietnam = new google.maps.LatLng(lat, lng);
        var parliament = new google.maps.LatLng(lat, lng);


        var mapOptions = {
            zoom: zoom,
            center: vietnam
        };

        map = new google.maps.Map(document.getElementById('map'),
            mapOptions);

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: parliament
        });

        // Create a DIV to hold the control and call HomeControl()
        var homeControlDiv = document.createElement('div');
        var homeControl = new HomeControl(homeControlDiv, map);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);

        google.maps.event.addListener(marker, 'click', function (event) {
            toggleBounce();
        });
        google.maps.event.addListener(marker, 'dragend', function (event) {
            $("#lat").val(event.latLng.lat());
            $("#lng").val(event.latLng.lng());
            $("#zoom").val(map.getZoom());

        });

        google.maps.event.addDomListener(marker, 'zoom_changed', function (event) {
            $("#zoom").val(map.getZoom());
        });
    }

    function codeAddress() {
        geocoder = new google.maps.Geocoder();
        var address = document.getElementById('address_map').value;
        geocoder.geocode({'address': address}, function (results, status) {
            map.setCenter(results[0].geometry.location);
            marker.setMap(map);
            marker.setPosition(results[0].geometry.location);
            latLngOb = marker.getPosition();
            $("#lat").val(latLngOb.lat());
            $("#lng").val(latLngOb.lng());
            $("#zoom").val(map.getZoom());
        });
    }

    function toggleBounce() {
        if (marker.getAnimation() != null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    function getPosition() {
        var latInput = $("#lat").val();
        var lngInput = $("#lng").val();
        var zoomInput = $("#zoom").val();

        lat = latDefault;
        lng = lngDefault;
        zoom = zoomDefault;

        if (latInput != "") {
            lat = latInput;
        }
        if (lngInput != "") {
            lng = lngInput;
        }
        if (zoomInput != "") {
            zoom = parseInt(zoomInput);
        }
    }

    // Add a Home control that returns the user to London
    function HomeControl(controlDiv, map) {
        homePosition = new google.maps.LatLng(latDefault, lngDefault);
        controlDiv.style.padding = '5px';
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = 'yellow';
        controlUI.style.border = '1px solid';
        controlUI.style.cursor = 'pointer';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Set map to London';
        controlDiv.appendChild(controlUI);
        var controlText = document.createElement('div');
        controlText.style.fontFamily = 'Arial,sans-serif';
        controlText.style.fontSize = '12px';
        controlText.style.paddingLeft = '4px';
        controlText.style.paddingRight = '4px';
        controlText.innerHTML = '<b>Home<b>'
        controlUI.appendChild(controlText);

        // Setup click-event listener: simply set the map to London
        google.maps.event.addDomListener(controlUI, 'click', function () {
            map.setCenter(homePosition);
        });
    }
    $(function () {
        initialize();
    });
</script>

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

                <?php if ($action == 'edit') : ?>
                    <ul class="tabs">
                        <li class="active">
                            <a href="<?php echo base_url() . 'backend/hotel_info/edit/?hotel_id=' . $record->id; ?>">Thông
                                tin chung</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url() . 'backend/partner/edit/' . $record->partner_id; ?>">Đối
                                tác</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url() . 'backend/room_type/?hotel_id=' . $record->id; ?>">Quản lý
                                loại phòng</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo site_url(); ?>/backend/promotion/?hotel_id=<?php echo $record->id; ?>">Quản
                                lý khuyến mãi</a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="box-content nopadding">
                <?php echo form_open('', array('class' => 'form-horizontal form-column', 'autocomplete' => 'off', 'method' => 'post', 'id' => 'frm')); ?>
                <div class="span6">

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Tên <?php echo diffrence_str('name', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="name" id="name" class="input-xlarge"
                                   value="<?php echo (isset($record->name)) ? html_escape($record->name) : ""; ?>">


                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Địa
                            chỉ <?php echo diffrence_str('address', $difference); ?></label>

                        <div class="controls">
                            <input type="text" name="address" id="address" class="input-xlarge"
                                   value="<?php echo (isset($record->address)) ? html_escape($record->address) : ""; ?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Loại khách
                            sạn <?php echo diffrence_str('type_id', $difference); ?></label>

                        <div class="controls">
                            <select name="type_id">
                                <option value="">--- Chọn Loại khách sạn ---</option>
                                <?php $type_id = explode(',', $record->type_id); ?>
                                <?php foreach ($hotel_type as $v) : ?>
                                    <option <?php echo (isset($record->type_id) && in_array($v->id, $type_id)) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Số
                            Sao <?php echo diffrence_str('star', $difference); ?></label>

                        <div class="controls" style="padding-top: 5px;">
                            <div class="Clear">
                                <input <?php echo (isset($record->star) && $record->star == 1) ? 'checked="checked"' : ''; ?>
                                    class="star" type="radio" name="star" value="1"/>
                                <input <?php echo (isset($record->star) && $record->star == 2) ? 'checked="checked"' : ''; ?>
                                    class="star" type="radio" name="star" value="2"/>
                                <input <?php echo (isset($record->star) && $record->star == 3) ? 'checked="checked"' : ''; ?>
                                    class="star" type="radio" name="star" value="3"/>
                                <input <?php echo (isset($record->star) && $record->star == 4) ? 'checked="checked"' : ''; ?>
                                    class="star" type="radio" name="star" value="4"/>
                                <input <?php echo (isset($record->star) && $record->star == 5) ? 'checked="checked"' : ''; ?>
                                    class="star" type="radio" name="star" value="5"/>
                            </div>
                            <input type="text" style="width: 0px; height: 0px; border: none" name="star_value"
                                   id="star_value"
                                   value="<?php echo (isset($record->star) && $record->star != '') ? $record->star : ''; ?>"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Hình đại
                            diện <?php echo diffrence_str('picture', $difference); ?></label>

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
                        <label for="textarea" class="control-label">Ưu đãi cho thành
                            viên <?php echo diffrence_str('member_promotion::member_promotion_discount', $difference); ?></label>

                        <div class="controls">
                            <input <?php echo (isset($record->member_promotion) && $record->member_promotion == 1) ? 'checked="checked"' : ""; ?>
                                type="checkbox" name="member_promotion" value="1"/>
                            &nbsp;&nbsp;&nbsp;<input type="text" class="input-medium" name="member_promotion_discount"
                                                     value="<?php echo (isset($record->member_promotion_discount)) ? $record->member_promotion_discount : ""; ?>"
                                                     placeholder="Ưu đãi"/> %
                        </div>
                    </div>

                </div>
                <div class="span6">

                    <div class="control-group">
                        <label for="textfield" class="control-label">Quốc
                            gia <?php echo diffrence_str('national_id', $difference); ?></label>

                        <div class="controls">
                            <select name="national_id">
                                <option value="">--- Chọn Quốc Gia ---</option>
                                <?php foreach ($national as $v) : ?>
                                    <option <?php echo (isset($record->national_id) && $record->national_id == $v->id) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Miền <?php echo diffrence_str('area_id', $difference); ?></label>

                        <div class="controls">
                            <select name="area_id">
                                <option value="">--- Chọn Miền ---</option>
                                <?php if (isset($area) && !empty($area)) : ?>
                                    <?php foreach ($area as $v) : ?>
                                        <option <?php echo (isset($record->area_id) && $record->area_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Tỉnh/Thành <?php echo diffrence_str('province_id', $difference); ?></label>

                        <div class="controls">
                            <select name="province_id">
                                <option value="">--- Tỉnh/Thành ---</option>
                                <?php if (isset($province) && !empty($province)) : ?>
                                    <?php foreach ($province as $v) : ?>
                                        <option <?php echo (isset($record->province_id) && $record->province_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Quận/Huyện <?php echo diffrence_str('district_id', $difference); ?></label>

                        <div class="controls">
                            <select name="district_id">
                                <option value="">--- Quận/Huyện ---</option>
                                <?php if (isset($district) && !empty($district)) : ?>
                                    <?php foreach ($district as $v) : ?>
                                        <option <?php echo (isset($record->district_id) && $record->district_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield"
                               class="control-label">Phường/Xã <?php echo diffrence_str('ward_id', $difference); ?></label>

                        <div class="controls">
                            <select name="ward_id">
                                <option value="">--- Phường/Xã ---</option>
                                <?php if (isset($ward) && !empty($ward)) : ?>
                                    <?php foreach ($ward as $v) : ?>
                                        <option <?php echo (isset($record->ward_id) && $record->ward_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Khu
                            vực <?php echo diffrence_str('geonear_id', $difference); ?></label>

                        <div class="controls">
                            <select name="geonear_id">
                                <option value="">--- Khu vực ---</option>
                                <?php if (isset($geonear) && !empty($geonear)) : ?>
                                    <?php foreach ($geonear as $v) : ?>
                                        <option <?php echo (isset($record->geonear_id) && $record->geonear_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textfield" class="control-label">Địa
                            danh <?php echo diffrence_str('sight_id', $difference); ?></label>

                        <div class="controls">
                            <select name="sight_id">
                                <option value="">--- Địa danh ---</option>
                                <?php if (isset($sight) && !empty($sight)) : ?>
                                    <?php foreach ($sight as $v) : ?>
                                        <option <?php echo (isset($record->sight_id) && $record->sight_id == $v->id) ? 'selected="selected"' : ''; ?>
                                            value="<?php echo $v->id; ?>"><?php echo html_escape($v->name); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
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
                        <label for="textarea" class="control-label">Giới
                            thiệu <?php echo diffrence_str('description', $difference); ?></label>

                        <div class="controls">
                            <textarea name="description" id="description"
                                      class="input-block-level description"><?php echo (isset($record->description)) ? html_escape($record->description) : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textarea" class="control-label">Chính
                            sách <?php echo diffrence_str('policy', $difference); ?></label>

                        <div class="controls">
                            <textarea name="policy" id="policy"
                                      class="input-block-level description"><?php echo (isset($record->policy)) ? html_escape($record->policy) : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="textarea" class="control-label">Bản
                            đồ <?php echo diffrence_str('lat::lng::zoom', $difference); ?></label>

                        <div class="controls">
                            <p>
                                <input style="margin-bottom: 0; width: 500px" id="address_map" type="textbox" value="">
                                <span onclick="codeAddress()" class="btn btn-file">Tìm kiếm theo địa chỉ</span>

                            <div id="map" style="width:100%; height:400px;"></div>

                            <input type="hidden" id="lat" name="lat"
                                   value="<?php echo (isset($record->lat)) ? html_escape($record->lat) : '10.813572407910886'; ?>"/>
                            <input type="hidden" id="lng" name="lng"
                                   value="<?php echo (isset($record->lng)) ? html_escape($record->lng) : '106.65695795893555'; ?>"/>
                            <input type="hidden" id="zoom" name="zoom"
                                   value="<?php echo (isset($record->zoom)) ? html_escape($record->zoom) : '14'; ?>"/>
                            </p>
                        </div>
                    </div>

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
                                                                <img src="' . $this->config->item('pic_url') . 'hotels/' . html_escape($v->name) . '" alt="">
                                                        </a>
                                                        <div class="extras">
                                                                <div class="extras-inner">
                                                                        <a href="javascript:void(0)" class="del-hotel-pic" pic="' . $v->id . '"><i class="icon-trash"></i></a>
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

                    <div class="control-group">
                        <label for="textarea" class="control-label">Keyword</label>

                        <div class="controls">
                            <textarea name="keyword" id="keyword"
                                      class="input-block-level keyword"><?php echo (isset($record->keyword)) ? html_escape($record->keyword) : ''; ?></textarea>
                        </div>
                    </div>

                </div>

                <div class="span12">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><?php echo $action_name; ?></button>
                    </div>
                </div>
                </form>

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