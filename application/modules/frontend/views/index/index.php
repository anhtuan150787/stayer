<!-- Slide home-->
<div id="slide-home" class="carousel slide banner-slide" data-ride="carousel" data-interval="3000">
    <!-- Search -->
    <div class="carousel-search">
        <div class="container search-home">
            <div class="">
                <div class="row">
                    <form role="form" id="fr-search" action="<?php echo base_url() . 'ss/tim-kiem.html';?>" method="get" autocomplete="off">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Tìm nhanh khách sạn</label>
                                <input type="hidden" id="time_delay" value="0" />
                                <input id="keyword-search" name="keyword-search" class="form-control" type="text" placeholder="Nhập tên khách sạn hoặc địa điểm...">
                                <div id="list-name-search" class="list-name-search niceScroll"></div>
                            </div>
                        </div>                                
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <div class="form-group has-feedback">
                                <label class="hidden-md hidden-sm hidden-xs">Ngày nhận phòng</label>
                                <label class="hidden-lg">Nhận phòng</label>
                                <input type="text" id="date-from-search" name="df" class="form-control" value="<?php echo date('d/m/Y', strtotime('+1 day')); ?>">
                                <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <div class="form-group has-feedback">
                                <label class="hidden-md hidden-sm hidden-xs">Ngày trả phòng</label>
                                <label class="hidden-lg">Trả phòng</label>                                        
                                <input type="text" id="date-to-search" name="dt" class="form-control" value="<?php echo date('d/m/Y', strtotime('+2 day')); ?>">
                                <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="text-uppercase">&nbsp;</label>
                                <button id="search-btn" class="btn btn-orange btn-arrow pull-left btn-block" type="submit">
                                    <strong>TÌM KIẾM</strong><span class="arrow-r" aria-hidden="true"></span></button>
                            </div>                            
                        </div>

                        <input type="hidden" name="type" id="search-type" value="default" />
                        <input type="hidden" name="id" id="search-id" value="" />

                    </form>                     
                </div>
            </div>
        </div>
    </div>
    <!-- End Search -->

    <!-- Banner slide -->
    <div class="carousel slide carousel-inner" role="listbox" id="carousel-example-generic">

        <ol class="carousel-indicators">
            <?php $t_banner = 0; foreach($banner_home as $v) :?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $t_banner;?>" class="<?php echo ($t_banner == 0) ? 'active' : '';?>"></li>
                <?php $t_banner++; endforeach;?>
        </ol>

        <?php $i_banner = 1; foreach($banner_home as $v) :?>
        <div class="item <?php echo ($i_banner == 1) ? 'active' : 'next';?> left">
            <img src="<?php echo $this->config->item('pic_url') . 'displays/' . $v->picture; ?>" />
        </div>
        <?php $i_banner++; endforeach;?>


    </div>
    <!-- End Banner slide -->
</div>
<!-- End slide home-->

<!-- Home content 1-->
<div class="container home-content-1">
    <div class="row">
        <!-- Left -->
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 left">
            <div class='subject-name'>
                KHÁCH SẠN ĐƯỢC XEM NHIỀU NHẤT
            </div>
            <div class='subject-content niceScroll'>
                <?php foreach ($hotel_most_view as $v) : ?>
                    <!-- Item list -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-hotel">
                        <div class='col-lg-3 col-md-2 col-sm-2 col-xs-4 picture'>
                            <a href="<?php echo $v->url; ?>"><img class="img-responsive" src='<?php echo $v->picture; ?>' /></a>
                        </div>
                        <div class='col-lg-6 col-md-7 col-sm-7 col-xs-8 description'>
                            <p class='title'><a href="<?php echo $v->url; ?>"><?php echo $v->name; ?></a></p>
                            <p class='address'><?php echo $v->address; ?></p>
                            <ul class="star">
                                <?php for ($i_star = 1; $i_star <= 5; $i_star++) : ?>
                                    <li <?php echo ($v->star >= $i_star) ? 'class="active"' : ''; ?>></li>
                                <?php endfor; ?>    
                            </ul>
                            <p class="price">Giá 1 đêm từ <label><?php echo $v->price; ?></label></p>
                        </div>
                        <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12 evaluation'>
                                <button type="button" class="rate btn btn-default"><?php echo $v->point; ?></button>
                                <p>
                                <?php if ($v->point != 0) : ?>
                                <label class="rate-name"><?php echo $v->bookmark; ?></label> |
                                <?php endif;?>
                                    <label class="comment-count"><?php echo $v->comment_total; ?> nhận xét</label></p>
                        </div>
                    </div>
                    <!-- End Item list -->
                <?php endforeach; ?>


            </div>
        </div>
        <!-- End Left -->

        <!-- Right -->
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 right">
            <!-- Adv -->
            <ul class='bxslider-adv'>

                <?php foreach ($adv as $v) : ?>
                    <li>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 adv">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subject-name">
                                <a href="<?php echo ($v->url != '') ? html_escape($v->url) : '#'; ?>">
                                    <?php echo html_escape($v->name); ?>
                                </a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subject-content">
                                <a href="<?php echo ($v->url != '') ? html_escape($v->url) : '#'; ?>">
                                    <img class="img-responsive" src="<?php echo show_picture(html_escape($v->picture), 481, 170, 'display'); ?>" />
                                </a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>


            <!-- End Adv -->

            <!-- Khach san theo khu vuc -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hotel-province-1">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subject-name">KHÁCH SẠN THEO KHU VỰC</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 subject-content niceScroll">
                    <?php foreach ($province as $v) : ?>
                        <!--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 item-province"><a class="active" href=""><?php echo html_escape($v->name); ?></a></div>-->
                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6 item-province home-province-show-hotel-ajax" data-name="<?php echo html_escape($v->name); ?>" data-id="<?php echo $v->id; ?>"><a href="javascript:void(0)" <?php echo ($v->id == 98) ? 'class="active"' : ''; ?> href=""><?php echo html_escape($v->name); ?></a></div>
                    <?php endforeach; ?>    
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 total" id="home-province-show-hotel-ajax-total"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hotel-list" id="home-province-show-hotel-ajax-result"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 view-more">Xem tất cả khách sạn tại <label id="home-province-show-hotel-ajax-show-all"></label></div>
            </div>


            <!-- End Khach san theo khu vuc -->
        </div>
        <!-- End Right -->
    </div>
</div>
<!-- End Home content 1-->

<!-- Home content 2-->
<div class="container home-content-2 hidden-sm hidden-xs">
    <div class="row">
        <div class="col-lg-12">
            <div class="subject-name">
                KHÁCH SẠN ĐƯỢC ĐẶT NHIỀU NHẤT 
                <span class="next_btn"></span>
                <span class="prev_btn"></span> 
            </div>					
            <div class="subject-content">
                <ul class="col-lg-12 bxslider">


                    <?php
                    $i_hotel_most_order = 1;
                    $total_hotel_most_order = count($hotel_most_order) - 1;
                    ?>

                    <?php foreach ($hotel_most_order as $v) : ?>
                        <?php
                        if ($i_hotel_most_order == 1)
                            echo '<li>';
                        ?>            
                        <!-- Item book hot -->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="book-hot">
                                <p class="picture"><a href="<?php echo $v->url; ?>"><img class="img-responsive" src="<?php echo $v->picture; ?>" /></a></p>
                                <p class="title"><a href="<?php echo $v->url; ?>"><?php echo $v->name; ?></a></p>
                                <!--<p class="book-count">Đã đặt (520)</p>-->
                                <p class="address"><?php echo $v->address; ?></p>
                                <ul class="star">
                                    <?php for ($i_star = 1; $i_star <= 5; $i_star++) : ?>
                                        <li <?php echo ($v->star >= $i_star) ? 'class="active"' : ''; ?>></li>
                                    <?php endfor; ?>
                                </ul>
                                <p class="price">Giá 1 đêm từ <label><?php echo $v->price; ?></label></p>
                                <div class="col-lg-2 booking-button">
                                    <div onclick='location.href = "<?php echo $v->url; ?>#check-price"' class='col-lg-10 col-md-10 col-sm-10 col-xs-10 text'>ĐẶT NGAY</div>
                                    <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 icon'>&nbsp;</div>
                                </div>
                            </div>  
                        </div>
                        <!-- End Item book hot -->
                        <?php
                        if ($i_hotel_most_order == 4 || $i_hotel_most_order == 0)
                        {
                            echo '</li>';
                            $i_hotel_most_order = 0;
                        }
                        ?>
                        <?php
                        $i_hotel_most_order++;
                        $total_hotel_most_order--;
                        ?>
                    <?php endforeach; ?>

                    </li>

                </ul>

            </div>

        </div>
    </div>
</div>	
<!-- End Home content 2-->

<!-- Home content 3-->
<div class="container home-content-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="subject-name">ĐIỂM ĐẾN PHỔ BIẾN</div>					

            <!-- Subject content-->
            <div class="col-lg-12 subject-content">
                <?php $i_province_common = 1; ?>
                <?php foreach ($province_common as $v) : ?>
                    <?php if ($i_province_common <= 3) : ?>
                        <!-- Item -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="location-hot">
                                <a href="<?php echo show_link($v->id, $v->name, 'province'); ?>">
                                    <img class="picture" class="img-responsive" src="<?php echo show_picture(html_escape($v->picture), 365, 220, 'province'); ?>" />
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 info">
                                        <p class="title"><?php echo html_escape($v->name); ?></p>
                                        <p class="count"><?php echo show_hotel_total($v->id); ?> khách sạn</p>
                                        <img src='<?php echo base_url(); ?>/public/frontend/images/icon_dat_nhieu.png' />
                                    </div>
                                </a>
                            </div>
                        </div>	
                        <!-- End Item -->
                    <?php endif; ?>
                    <?php $i_province_common++; ?>
                <?php endforeach; ?>
            </div>
            <!-- End Subject content-->

            <!-- Subject content-->
            <div class="col-lg-12 subject-content">
                <?php $i_province_common = 1; ?>
                <?php foreach ($province_common as $v) : ?>
                    <?php if ($i_province_common > 3 && $i_province_common <= 6) : ?>
                        <!-- Item -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="location-hot">
                                <a href="<?php echo show_link($v->id, $v->name, 'province'); ?>">
                                    <img class="picture" class="img-responsive" src="<?php echo show_picture(html_escape($v->picture), 365, 220, 'province'); ?>" />
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 info">
                                        <p class="title"><?php echo html_escape($v->name); ?></p>
                                        <p class="count"><?php echo show_hotel_total($v->id); ?> khách sạn</p>
                                        <img src='<?php echo base_url(); ?>/public/frontend/images/icon_dat_nhieu.png' />
                                    </div>
                                </a>
                            </div>
                        </div>	
                        <!-- End Item -->
                    <?php endif; ?>
                    <?php $i_province_common++; ?>
                <?php endforeach; ?>
            </div>
            <!-- End Subject content-->
        </div>
    </div>
</div>		
<!-- End Home content 3-->

<!-- Home content 4-->
<div class="container home-content-4">
    <div class="row">
        <!-- Left -->
        <div class="col-lg-7 col-md-6 col-sm-7 col-xs-12 left">
            <div class="subject-name">BẠN NÊN CHỌN AZY.VN</div>
            <img class="img-responsive" src="<?php echo base_url(); ?>/public/frontend/images/why-choice_03.jpg" />
        </div>
        <!-- End Left -->

        <!-- Right -->
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 right">
            <div class="subject-name">CẢM NHẬN CỦA KHÁCH HÀNG</div>

            <ul class='bxslider-comment' style="padding-left: 0">
                <?php foreach($comment_customer as $v) :?>
                <li style="min-height: 251px">
                    <div class="comment">
                        <img class="comment-icon" src="<?php echo base_url(); ?>/public/frontend/images/comment-icon.png" />
                        <?php echo $v->content;?>
                        <div class="triangle-topright"></div>
                    </div>
                    <div class="picture">

                        <img class="img-responsive" src="<?php echo show_picture(html_escape($v->picture), 90, 90, 'display');?>" />
                        <span><?php echo $v->name;?></span>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>


        </div>
        <!-- End Right -->
    </div>
</div>		
<!-- End Home content 4-->
