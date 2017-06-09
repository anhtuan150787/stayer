<!-- Content -->
<div class="container content">
    <div class="row hotel-detail">
        <!-- Breadcrumbs -->
        <div class="col-lg-12 breadcrumbs">
            <ol class="breadcrumb">
                <?php foreach($breadcrumbs as $k => $v):?>
                <li><a href="<?php echo $v;?>"><?php echo $k;?></a></li>
                <?php endforeach;?>
            </ol>
        </div>
        <!-- End Breadcrumbs -->

        <!-- Left col -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 left">
            <!-- Search -->
            <div class="search">
                <div class="title" id="show-form-search">
                    <span class="glyphicon glyphicon-search"></span>
                    TÌM KHÁCH SẠN	
                </div>
                <div class="content" id="target-show-form-search">
                    <form id="fr-search" action="<?php echo base_url() . 'ss/tim-kiem.html';?>" method="get" autocomplete="off">
                        <!-- Form search -->
                        <div class='col-lg-12 search-form'>
                            <div class='subject-title'>TÌM KIẾM KHÁCH SẠN</div>
                            <div class='subject-content'>
                                <div class='col-lg-12 item'>
                                    <p>ĐIỂM ĐẾN</p> <input type='text' value="" id="keyword-search" name="keyword-search" />
                                    <div id="list-name-search" class="list-name-search niceScroll hotel-page"></div>
                                </div>
                                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 item'>
                                    <p>NHẬN PHÒNG</p>
                                    <input readonly="readonly" id="date-from-search" type='text' name="df" value="" />
                                </div>
                                <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 item'>
                                    <p>TRẢ PHÒNG</p>
                                    <input readonly="readonly" id="date-to-search" type='text' name="dt" value="" />
                                </div>
                                <div class="col-lg-12">
                                    <input type="hidden" name="type" id="search-type" value="" />
                                    <input type="hidden" name="id" id="search-id" value="" />
                                    <button class="btn btn-default booking-btn" type="submit">TÌM KIẾM & ĐẶT PHÒNG</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Form search -->
                    </form>
                </div>
            </div>
            <!-- End Search -->

            <!-- Map -->
            <div class="col-lg-12 map">

                <div id="map" style="width:100%; height:400px;"></div>
                <input type="hidden" id="lat" name="lat" value="<?php echo (isset($record->lat)) ? html_escape($record->lat) : '10.813572407910886'; ?>" />
                <input type="hidden" id="lng" name="lng" value="<?php echo (isset($record->lng)) ? html_escape($record->lng) : '106.65695795893555'; ?>" />
                <input type="hidden" id="zoom" name="zoom" value="<?php echo (isset($record->zoom)) ? html_escape($record->zoom) : '14'; ?>" />

                <div class="open-more map" data-hotel_id="<?php echo $record->id; ?>" data-toggle="modal" data-target=".map-modal-lg">
                    <span class="glyphicon glyphicon-zoom-in"></span> Mở rộng bản đồ
                </div>
            </div>
            <!-- End Map -->

            <!-- Block box item -->
            <div class="col-lg-12 box">
                <div class="subject-title">ĐỊA DANH LÂN CẬN KHÁCH SẠN</div>
                <div class='subject-content'>
                    <?php foreach ($sight as $v) : ?>
                        <!-- List sight item-->
                        <div class="col-lg-12 list-sight">
                            <div class="col-lg-4 picture">
                                <a href="<?php echo show_link($v->id, $v->name, 'sight'); ?>">
                                    <img src="<?php echo show_picture(html_escape($v->picture), 73, 56, 'sight'); ?>">
                                </a>
                            </div>
                            <div class="col-lg-8 description">
                                <a href="<?php echo show_link($v->id, $v->name, 'sight'); ?>">
                                    <?php echo html_escape($v->name); ?>
                                </a>
                            </div>
                        </div>
                        <!-- End List sight item-->
                    <?php endforeach; ?>    

                </div>
            </div>
            <!-- End Block box item -->

            <!-- Block box item -->
            <div class="col-lg-12 box">
                <div class="subject-title">KHÁCH SẠN <?php echo $record->star; ?> SAO Ở GẦN</div>
                <div class='subject-content'>
                    <?php foreach ($hotel_other as $v): ?>
                        <!-- List hotel same item-->
                        <div class="col-lg-12 list-hotel-same">
                            <div class="col-lg-5 picture">
                                <a href="<?php echo $v->url; ?>">
                                    <img class="img-responsive" src='<?php echo $v->picture; ?>' />
                                    <div class="evaluation"><?php echo $v->point; ?></div>
                                </a>
                            </div>
                            <div class="col-lg-7 description">
                                <p class="title"><a href="<?php echo $v->url; ?>"><?php echo $v->name; ?></a></p>
                                <ul class="star">
                                    <?php for ($i_star = 1; $i_star <= 5; $i_star++) : ?>
                                        <li <?php echo ($v->star >= $i_star) ? 'class="active"' : ''; ?>></li>
                                    <?php endfor; ?>
                                </ul>
                                <p class="price">Giá 1 đêm từ <label><?php echo $v->price; ?></label></p>
                            </div>
                        </div>
                        <!-- End List hotel same item-->
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End Block box item -->

            <!-- Block box item -->
            <?php if (!empty($hotel_order_near_city)):?>
            <div class="col-lg-12 box">
                <div class="subject-title">ĐẶT PHÒNG GẦN ĐÂY Ở <?php echo mb_strtoupper($province_name);?></div>
                <div class='subject-content' style="padding-left: 0; padding-right: 0;">
                    <?php foreach($hotel_order_near_city as $v):?>
                    <!-- Item -->
                    <div class="col-lg-12 item">
                        <div class="item-content">
                            <p class="title"><a href="<?php echo $v->url; ?>"><?php echo $v->name;?></a></p>
                            <p class="address"><?php echo $v->address;?></p>
                            <ul class="star">
                                <?php for ($i_star = 1; $i_star <= 5; $i_star++) : ?>
                                    <li <?php echo ($v->star >= $i_star) ? 'class="active"' : ''; ?>></li>
                                <?php endfor; ?>
                            </ul>
                            <div class="col-lg-12 sight">
                                <p><?php echo html_escape($v->room->name);?></p>
                                <p>Được đặt cách đây <label><?php echo getNameTime($v->create_time);?></label></p>
                            </div>
                        </div>
                    </div>
                    <!-- End Item -->
                    <?php endforeach;?>
                </div>
            </div>
            <!-- End Block box item -->
            <?php endif;?>
        </div>
        <!-- End Left col -->

        <!-- Right col -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 right">
            <!-- Header -->
            <div class="col-lg-12 header">
                <!-- Left -->
                <div class="col-lg-9 left">
                    <p class="title"><?php echo html_escape($record->name); ?></p>
                    <ul class="star">
                        <?php for ($i_star = 1; $i_star <= 5; $i_star++) : ?>
                            <li <?php echo ($record->star >= $i_star) ? 'class="active"' : ''; ?>></li>
                        <?php endfor; ?>
                    </ul>
                    <p class="address"><?php echo html_escape($record->address); ?></p>
                    <!--
                    <label class="map" data-hotel_id="<?php echo $record->id; ?>" data-toggle="modal" data-target=".map-modal-lg">
                        <img src="<?php echo base_url(); ?>/public/frontend/images/map-icon.png" /> Xem bản đồ
                    </label>
                    -->

                    <?php echo show_button_like_face(array(
                        'url' => show_link($record->id, html_escape($record->name)),
                        'title' => html_escape($record->name),
                        'description' => html_escape($record->description),
                        'picture' => show_picture(html_escape($picture[0]->name), 200),
                    ));?>

                </div>
                <!-- End left -->

                <!-- Right -->
                <div class="col-lg-3 right evaluation">
                    <div class="col-lg-4">
                        <?php $point = show_point_detail($record->id); ?>
                        <button type="button" class="rate btn btn-default"><?php echo show_point($point); ?></button>
                    </div>
                    <div class="col-lg-8">
                        <p><?php echo show_bookmark(show_point($point)); ?></p><label>từ tổng <u onclick="location.href='#hotel-comment'"><?php echo show_comment_total($record->id); ?> nhận xét</u></label>
                    </div>
                    <button onclick="location.href='#check-price'" type="button" class="booking btn btn-default">ĐẶT PHÒNG NGAY BÂY GIỜ</button>
                    <?php if (check_promotion($record->id)) : ?>
                        <p class="promotion">
                            <img src="<?php echo base_url();?>public/frontend/images/icon-promotion.png">&nbsp;
                            Đang có khuyến mãi						
                        </p>
                    <?php endif; ?>
                </div>
                <!-- End Right -->
            </div>
            <!-- End header -->

            <!-- Sort -->
            <div class="col-lg-12 sort">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default" onclick="location.href = '#hotel-description'">GIỚI THIỆU</button>	
                    <button type="button" class="btn btn-default" onclick="location.href = '#hotel-facilities'">TIỆN NGHI KHÁCH SẠN</button>
                    <button type="button" class="btn btn-default" onclick="location.href = '#hotel-policy'">CHÍNH SÁCH KHÁCH SẠN</button>	
                    <button type="button" class="btn btn-default" onclick="location.href = '#hotel-comment'">ĐÁNH GIÁ KHÁCH SẠN</button>
                </div>
            </div>
            <!-- End Sort -->

            <!-- Start photosgallery-captions -->
            <div class="sliderkit photosgallery-captions">
                <div class="sliderkit-nav">

                    <div class="sliderkit-nav-clip">
                        <ul>
                            <?php foreach ($picture as $v): ?>
                                <li><a href="#" rel="nofollow"><img class="img-responsive" src="<?php echo show_picture(html_escape($v->name), 75, 50); ?>" /></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="sliderkit-btn sliderkit-go-btn sliderkit-go-prev"><a rel="nofollow" href="#" title="Previous photo"><span>Previous photo</span></a></div>
                    <div class="sliderkit-btn sliderkit-go-btn sliderkit-go-next"><a rel="nofollow" href="#" title="Next photo"><span>Next photo</span></a></div>
                </div>
                <div class="sliderkit-panels">
                    <?php foreach ($picture as $v): ?>
                        <div class="sliderkit-panel">
                            <img src="<?php echo show_picture(html_escape($v->name), 856, 424); ?>" />
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- // end of photosgallery-captions -->

            <!-- Search room-->

            <div class="col-lg-12 box" id='check-price'>
                <form method="post" action="<?php echo show_link('', 'Đặt phòng', 'booking');?>">
                    <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash();?>" />
                    <div class="subject-title">KIỂM TRA GIÁ & PHÒNG TRỐNG</div>
                    <div class='subject-content' style="padding-left: 0; padding-right: 0;">
    
                        <!-- Search price -->
                        <div class="col-lg-12 search-price">
                            <div class="col-lg-3">
                                <div class="form-group has-feedback">
                                    <label>Ngày nhận phòng</label>
                                    <input type="text" id="room-date-from-search" name="room-date-from-search" class="form-control" value="<?php echo $search['df']; ?>">
                                    <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group has-feedback">
                                    <label>Ngày trả phòng</label>
                                    <input type="text" id="room-date-to-search" name="room-date-to-search" class="form-control" value="<?php echo $search['dt']; ?>">
                                    <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group has-feedback">
                                    <label>Số đêm</label>
                                    <input type="text" id="room-night-search" name="room-night-search" class="form-control" value="<?php echo $search['night']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group has-feedback">
                                    <label>Số phòng</label>
                                    <input type="text" id="room-num-search" name="room-num-search" class="form-control" value="<?php echo $search['room_num'];?>">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group has-feedback">
                                    <label>Người lớn</label>
                                    <input type="text" id="room-persion-search" name="room-persion-search" class="form-control" value="<?php echo $search['room_person'];?>">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="text-uppercase">&nbsp;</label>
                                    <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $record->id;?>" />
                                    <input type="hidden" name="url_current" id="url_current" value="<?php echo current_url();?>" />                                    
                                    <button id="search-btn-room" class="btn btn-orange btn-arrow pull-left btn-block" type="button">
                                        <strong>KIỂM TRA GIÁ</strong><span class="arrow-r" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                        <!-- End Search price -->
    
                        <!-- Note -->
                        <div class="col-lg-12 note">
                            Giá phòng đã bao gồm 10% thuế GTGT, 5% phí dịch vụ<br>
                            Ghi chú: Vui lòng chọn ngày và kiểm tra để cập nhật giá và phòng trống
                        </div>
                        <!-- End Note -->
    
                        <!-- Search result -->
                        <div class="col-lg-12 search-result" id="search-result-detail">
                            
                        </div>
                        <!-- End Search result -->
                    </div>
                </form>
            </div>
            <!-- End Search room-->

            <!-- Facilities -->
            <div class="col-lg-12 box" id="hotel-facilities">
                <div class="subject-title">TIỆN NGHI KHÁCH SẠN</div>
                <div class='subject-content'>
                    <div class="facilities">
                        <?php
                        $i_facilities = 1;
                        foreach ($facilities as $v) :
                            ?>
                            <div class="col-lg-3 item-hotel-facilities" <?php echo ($i_facilities > 12) ? 'style="display: none"' : ''; ?>>
                                <span class="glyphicon glyphicon-ok"></span> <?php echo $v->name; ?> 
                            </div>
                            <?php
                            $i_facilities++;
                        endforeach;
                        ?>

                        <?php if ($i_facilities > 13) : ?>
                            <div class="col-lg-12">
                                <button id="show-more-facilities-hotel-detail" class="btn btn-orange btn-arrow pull-left btn-block view-more-facilities">XEM TẤT CẢ <span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- End Facilities -->

            <!-- Box item -->
            <div class="col-lg-12 box" id="hotel-description">
                <div class="subject-title">GIỚI THIỆU CHI TIẾT</div>
                <div class='subject-content discription'>
                    <?php echo $record->description; ?>
                </div>
            </div>	
            <!-- End Box item -->

            <!-- Box item -->
            <div class="col-lg-12 box" id="hotel-policy">
                <div class="subject-title">CHÍNH SÁCH KHÁCH SẠN</div>
                <div class='subject-content discription'>
                    <?php echo $record->policy; ?>
                </div>
            </div>	
            <!-- End Box item -->

            <!-- Box item -->
            <div class="col-lg-12 box" id="hotel-comment">
                <div class="subject-title">ĐÁNH GIÁ KHÁCH SẠN</div>
                <div class='col-lg-12 subject-content comment'>
                    <div class="col-lg-4 evaluation">
                        <div class="col-lg-4">
                            <button type="button" class="rate btn btn-default"><?php echo show_point($point); ?></button>
                        </div>
                        <div class="col-lg-7">
                            <p><?php echo show_bookmark(show_point($point)); ?></p><label>từ tổng <u><?php echo show_comment_total($record->id); ?> nhận xét</u></label>
                        </div>
                    </div>
                    <?php if (isset($comment_allow) && $comment_allow == true):?>
                    <div class="col-lg-2 col-lg-offset-6 write-comment">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target=".comment-modal-lg">Viết đánh giá</button>
                    </div>
                    <?php endif;?>
                    <!-- List comment -->
                    <div class="col-lg-12 list-comment" id="list-comment">
                        <p class="title">Tất cả nhận xét</p>
                        <div class="col-lg-12 content" id="content-list-comment">
                            <?php if (!empty($comment)):?>
                            <?php foreach ($comment as $v) : ?>
                                <!-- Item -->
                                <div class="col-lg-12 item">
                                    <div class="col-lg-2 picture">
                                        <p class="name"><?php echo $v->user_fullname; ?></p>
                                        <?php if (!isset($v->picture) || $v->picture == '') : ?>
                                            <img class="img-thumbnail img-responsive" src="<?php echo base_url(); ?>public/frontend/images/logo.png">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-9 description">
                                        <?php if (isset($v->title) && $v->title != '') : ?>
                                            <p class="title"><?php echo html_escape($v->title); ?> <time><?php echo html_escape($v->create_time); ?></time></p>
                                        <?php endif; ?>
                                        <p class="content">
                                            <?php echo html_escape($v->content); ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-1 rate">
                                        <button class="btn btn-orange btn-arrow pull-left btn-block" type="submit"><?php echo show_point($v->evaluation); ?></button>
                                    </div>
                                </div>
                                <!-- End Item -->                    
                            <?php endforeach; ?>
                            <?php endif;?>
                        </div>
                    </div>
                    <!-- End list comment -->

                    <div class="col-lg-12" style="text-align: center;">
                        <?php
                        $page_comment = ceil($comment_total / 10);
                        ?>
                        <ul class="pagination">
                            <?php for ($i_comment = 1; $i_comment <= $page_comment; $i_comment++): ?>
                                <li><a href="#list-comment" data-page="<?php echo $i_comment; ?>" date-hotel_id="<?php echo $record->id; ?>" class="page-comment"><?php echo $i_comment; ?></a></li>
                            <?php endfor; ?>   
                        </ul>
                    </div>
                </div>


            </div>	
            <!-- End Box item -->

        </div>
        <!-- End Right col -->
    </div>
</div>
<!-- End Content -->

<div class="modal fade map-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>

<!-- Modal login -->
<div class="modal fade login-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Đăng nhập</h4>
        </div>
        <div class="modal-body"></div>
    </div>
  </div>
</div>

<!-- Modal comment-->
<div class="modal fade comment-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Đánh giá</h4>
            </div>
            <div class="modal-body" id="modal-body-comment">
                <div id="form-comment">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung</label>
                        <textarea class="form-control" rows="3" id="comment_body" name="comment_body"></textarea>
                        <label class="error-login" for="comment_body"></label>
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Đánh giá</label>
						<div class="Clear">
							<input class="comment_star" type="radio" name="star" value="1"/>
							<input class="comment_star" type="radio" name="star" value="2"/>
							<input class="comment_star" type="radio" name="star" value="3"/>
							<input class="comment_star" type="radio" name="star" value="4"/>
							<input class="comment_star" type="radio" name="star" value="5"/>
							<input class="comment_star" type="radio" name="star" value="6"/>
							<input class="comment_star" type="radio" name="star" value="7"/>
							<input class="comment_star" type="radio" name="star" value="8"/>
							<input class="comment_star" type="radio" name="star" value="9"/>
							<input class="comment_star" type="radio" name="star" value="10"/>
						</div>
						<input type="text" style="width: 0px; height: 0px; border: none" name="star_value" id="star_value" value=""/>
                        <br>
                        <label class="error-login" for="comment_rating"></label>
                    </div>
                    <input type="hidden" id="comment_hotel_id" value="<?php echo $record->id;?>" />
                    <button type="submit" class="btn btn-success" id="write_comment">Gửi đánh giá</button>
                </div>
                <div id="result-comment" style="display: none;">
                </div>
            </div>
        </div>
    </div>
</div>

<meta property="og:url"           content="http://www.your-domain.com/your-page.html" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Your Website Title" />
<meta property="og:description"   content="Your description" />
<meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>