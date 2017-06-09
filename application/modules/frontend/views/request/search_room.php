<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Loại phòng</th>
                <th class="text-center">Tối đa</th>
                <th class="text-center">Giá / Đêm</th>
                <th class="text-center">Số phòng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($room_type) > 0) : ?>
                <?php foreach ($room_type as $v) : ?>
                    <!-- Item result search -->
                    <tr>
                        <td class="room-type">
                            <p class="name"><?php echo $v->name; ?></p>
                            <p class="picture">
                                <img src="<?php echo show_picture(html_escape($v->picture), 179, 132); ?>" />
                            </p>
                            <div class="col-lg-6" style="padding: 0;">
                                <span class="show-description" data-id="<?php echo $v->id;?>"><img src="<?php echo base_url(); ?>/public/frontend/images/icon-them-phong.png" /> Thông tin phòng</span>
                            </div>
                            <?php if ($v->bed_more && $v->hide_price == false):?>
                            <div class="col-lg-6" style="padding: 0;">
                                <span class="show-bedmore" data-id="<?php echo $v->id;?>"><img src="<?php echo base_url(); ?>/public/frontend/images/icon-them-phong.png" /> Thêm giường</span>
                            </div>
                            <?php endif;?>
                        </td>
                        <td class="person">
                            <?php echo str_repeat('<img src="' . base_url() . '/public/frontend/images/icon-person.png" />&nbsp;', $v->slot); ?>                                            
                        </td>
                        <td class="price">
                            <?php if ($v->hide_price == false):?>
                                <p class="old"><s><?php echo (isset($v->price_promotion)) ? show_price($v->price_promotion) : ''; ?></s></p>
                                <p class="new"><?php echo show_price($v->price); ?></p>
                                <p data-html="true" class="policy" id='policy-show' data-toggle="tooltip"  title="<?php echo ($v->promotion != FALSE) ? strip_tags($v->promotion->policy) : strip_tags($v->policy);?>">
                                    <span class="glyphicon glyphicon-question-sign"></span> Chính sách hủy
                                </p>
                                <?php if ($v->promotion != FALSE):?>
                                <p class="promotion">
                                    <span class="show-promotion" data-id="<?php echo $v->id;?>">
                                        <img src="<?php echo base_url(); ?>/public/frontend/images/icon-promotion.png" />&nbsp; 
                                        <?php echo $v->promotion->name;?>
                                    </span>
                                </p>
                                <?php endif;?>
                            <?php else:?>
                                <?php echo '<p class="new">' . show_price($v->price) . '</p>';?>
                            <?php endif;?>
                            </td>
                            <td class="num-room">
                            <?php if ($v->hide_price == false):?>
                                <select name="num-room[<?php echo $v->id;?>]">
                                    <?php for($i_r = 0; $i_r <= $v->room_number; $i_r++):?>
                                    <option value="<?php echo $i_r;?>"><?php echo $i_r;?></option>
                                    <?php endfor;?>
                                </select>
                             <?php endif;?>   
                            </td>	
                            <td class="booking">
                                <?php if ($v->hide_price == false):?>
                                <?php if (!isset($user) && $v->member_promotion == 1):?>
                                    <p class="member_promotion"><a href="javascript:void(0)" data-toggle="modal" data-target=".login-modal-lg">Đăng nhập để được giá ưu đãi</a></p>
                                <?php endif;?>
                                <button disabled="disabled" class="btn btn-orange btn-arrow pull-left btn-block" type="submit">ĐẶT PHÒNG NGAY</button>
                                <?php endif;?>
                            </td>			        				      
                </tr>
                <tr id="description-room-<?php echo $v->id;?>" class="description-room">
                    <td colspan="5">
                        <div class="col-lg-6">
                            <p><strong>Kiểu phòng: </strong><?php echo $v->type;?></p>
                            <p><strong>Diện tích: </strong><?php echo $v->size;?></p>
                            <p><strong>Giường: </strong><?php echo $v->bed;?></p>
                            <p><strong>Kiểu phòng: </strong><?php echo $v->type;?></p>
                            <p><strong>Chi tiết: </strong></p>
                            <?php echo $v->description;?>
                            <p><strong>Chính sách hủy phòng: </strong></p>
                            <?php echo ($v->promotion != FALSE) ? $v->promotion->policy : $v->policy;?>
                        </div>
                        <div class="col-lg-6">
                            <p><strong>Tiện nghi phòng:</strong></p>
                            <ul>
                            <?php
                            $room_facilities = show_facilities_room(trim($v->facilities_id, ','));
                            foreach($room_facilities as $v_r_f)
                            {
                                echo '<li>' . $v_r_f->name . '</li>';
                            }
                            ?>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php if ($v->bed_more):?>
                <tr id="bedmore-room-<?php echo $v->id;?>" class="bedmore-room">
                    <td colspan="5">
                        <input type="checkbox" name="bedmore-room[<?php echo $v->id;?>]" value="1" /> &nbsp;Thêm giường (+<?php echo show_price($v->bed_more_price);?>)
                    </td>
                </tr>
                <?php endif;?>

                <?php if ($v->promotion != FALSE):?>
                <tr id="promotion-room-<?php echo $v->id;?>" class="promotion-room">
                    <td colspan="5">
                        <div class="col-lg-12">
                            <dl>
                                <dt>Thông tin khuyến mãi</dt>
                                <dd>- Thời gian áp dụng: <?php echo format_date('d/m/Y', $v->promotion->date_apply_from) . ' - ' . format_date('d/m/Y', $v->promotion->date_apply_to);?></dd>
                                <dd>- Thời gian đặt: <?php echo format_date('d/m/Y', $v->promotion->book_day_from) . ' - ' . format_date('d/m/Y', $v->promotion->book_day_to);?></dd>
                                <dd>- Thời gian ở: <?php echo format_date('d/m/Y', $v->promotion->stay_day_from) . ' - ' . format_date('d/m/Y', $v->promotion->stay_day_to);?></dd>    
                                <dd>- Ở tối thiểu: <?php echo $v->promotion->night;?></dd>
                            </dl>                                                 
                            <dl>
                                <dt>Chính sách hủy</dt>
                                <dd><?php echo $v->promotion->policy;?></dd>
                            </dl>
                            
                        </div>
                    </td>
                </tr>
                <?php endif;?>

                <!-- End Item result search -->
            <?php endforeach; ?>
        <?php else: ?>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Hiện tại không còn phòng trống</td>
                </tr>
                </tbody>
            </table>
        <?php endif;?>

        </tbody>
    </table>
</div>