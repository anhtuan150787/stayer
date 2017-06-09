<br>
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
                <!--
                <div class="title" id="show-form-search">
                    <span class="glyphicon glyphicon-search"></span>
                    TÌM KHÁCH SẠN
                </div>
                -->
                <div id="target-show-form-search">
                    <form id="fr-search" action="" method="get" autocomplete="off">
                        <!-- Form search -->
                        <div class='col-lg-12 search-form'>
                            <div class='subject-title'>TÌM KIẾM KHÁCH SẠN</div>
                            <div class='subject-content'>
                                <div class='col-lg-12 item'>
                                    <p>ĐIỂM ĐẾN</p> <input type='text' value="" id="tour-keyword-search" name="tour-keyword-search" />
                                    <div id="list-name-search" class="list-name-search niceScroll hotel-page"></div>
                                </div>
                                <div class='col-lg-12 item'>
                                    <p>ĐIỂM KHỞI HÀNH</p>
                                    <select class="form-control" name="start-from-search" id="start-from-search">
                                        <?php foreach($province as $v) :?>
                                            <option <?php echo ($search['start_from_search'] == $v->id) ? 'selected="selected"' : '';?> value="<?php echo $v->id;?>"><?php echo $v->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 item'>
                                    <p>KHOẢNG THỜI GIAN KHỞI HÀNH</p>

                                    <div class="col-md-6" style="padding-left: 0; padding-right: 5px">
                                        <input readonly="readonly" id="date-from-search" type='text'
                                               name="df" value="<?php echo $search['df']; ?>"/>
                                    </div>
                                    <div class="col-md-6" style="padding-left: 0; padding-right: 5px">
                                        <input readonly="readonly" id="date-to-search" type='text'
                                               name="dt" value="<?php echo $search['dt']; ?>"/>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="hidden" name="type" id="search-type" value="" />
                                    <input type="hidden" name="id" id="search-id" value="" />
                                    <button class="btn btn-default booking-btn" type="submit">TÌM KIẾM & ĐẶT TOUR</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Form search -->
                    </form>
                </div>
            </div>
            <!-- End Search -->

            <!-- Block box item -->
            <div class="col-lg-12 box">
                <div class="subject-title">TOUR LIÊN QUAN</div>
                <div class='subject-content'>
                    <?php foreach ($tour_other as $v): ?>
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
                                <p class="price">Giá chỉ <label><?php echo $v->price; ?></label></p>
                            </div>
                        </div>
                        <!-- End List hotel same item-->
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End Block box item -->

            <!-- Block box item -->
            <div class="col-lg-12 box">
                <div class="subject-title">ĐIỂM ĐẾN</div>
                <div class='subject-content' style="padding: 0;">
                    <div class="category">TOUR TRONG NƯỚC</div>
                    <ul class="category-item">
                        <?php foreach ($province_vn_common as $v) : ?>
                        <li>
                            <label onclick="location.href='<?php echo show_link($v->id, $v->name, 'tour_province'); ?>'"><input class="hotel-price-range" type="checkbox" name="price_range[]" value="1"> &nbsp;<?php echo html_escape($v->name); ?> (<?php echo show_tour_total($v->id); ?>)</label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="category">TOUR QUỐC TẾ</div>
                    <ul class="category-item">
                        <?php foreach ($province_vn_common as $v) : ?>
                            <li>
                                <label onclick="location.href='<?php echo show_link($v->id, $v->name, 'tour_province'); ?>'"><input class="hotel-price-range" type="checkbox" name="price_range[]" value="1"> &nbsp;<?php echo html_escape($v->name); ?> (<?php echo show_tour_total($v->id); ?>)</label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!-- End Block box item -->

        </div>
        <!-- End Left col -->

        <!-- Right col -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 right">
            <!-- Header -->
            <div class="col-lg-12 header">
                <!-- Left -->
                <div class="col-lg-9 left">
                    <p class="title"><?php echo html_escape($record->name); ?></p>

                    <?php echo show_button_like_face(array(
                        'url' => show_link($record->id, html_escape($record->name), 'tour_province'),
                        'title' => html_escape($record->name),
                        'description' => html_escape($record->name),
                        'picture' => show_picture(html_escape($record->picture), 200, '', 'tour'),
                    ));?>

                    <!--
                    <label class="map" data-hotel_id="<?php echo $record->id; ?>" data-toggle="modal" data-target=".map-modal-lg">
                        <img src="<?php echo base_url(); ?>/public/frontend/images/map-icon.png" /> Xem bản đồ
                    </label>
                    -->
                    <!--
                    <p class="social">facebook</p>
                    -->
                </div>
                <!-- End left -->

                <!-- Right -->
                <div class="col-lg-3 right evaluation">
                    <div class="col-lg-4">
                        <?php $point = show_point_tour_detail($record->id); ?>
                        <button type="button" class="rate btn btn-default"><?php echo show_point($point); ?></button>
                    </div>
                    <div class="col-lg-8">
                        <p><?php echo show_bookmark(show_point($point)); ?></p><label>từ tổng <u onclick="location.href='#hotel-comment'"><?php echo show_tour_comment_total($record->id); ?> nhận xét</u></label>
                    </div>
                </div>
                <!-- End Right -->
            </div>
            <!-- End header -->

            <!-- Start photosgallery-captions -->
            <div class="sliderkit photosgallery-captions">
                <div class="sliderkit-nav">

                    <div class="sliderkit-nav-clip">
                        <ul>
                            <?php foreach ($picture as $v): ?>
                                <li><a href="#" rel="nofollow"><img class="img-responsive" src="<?php echo show_picture(html_escape($v->name), 75, 50, 'tour'); ?>" /></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="sliderkit-btn sliderkit-go-btn sliderkit-go-prev"><a rel="nofollow" href="#" title="Previous photo"><span>Previous photo</span></a></div>
                    <div class="sliderkit-btn sliderkit-go-btn sliderkit-go-next"><a rel="nofollow" href="#" title="Next photo"><span>Next photo</span></a></div>
                </div>
                <div class="sliderkit-panels">
                    <?php foreach ($picture as $v): ?>
                        <div class="sliderkit-panel">
                            <img src="<?php echo show_picture(html_escape($v->name), 856, 424, 'tour'); ?>" />
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- // end of photosgallery-captions -->

            <!-- Box item -->
            <div class="col-lg-12 box" id="hotel-description">
                <div class='subject-content discription'>
                    <div class="col-md-10" style="padding-left: 0;">
                        <dl class="dl-horizontal">
                            <dt>Ngày khởi hành:</dt>
                            <dd>
                                <?php if ($record->start_date != 1) :?>
                                    <?php $start_date_arr = explode(';', $record->start_date); ?>
                                    <?php
                                    $str_start_date = '';
                                    foreach ($start_date_arr as $vv) {
                                        if (trim($vv) != '')
                                            $str_start_date .= format_date('d/m/Y', $vv) . '; ';
                                    }
                                    echo trim($str_start_date, '; ');
                                    ?>
                                <?php else :?>
                                    <?php echo 'Hằng ngày';?>
                                <?php endif;?>
                            </dd>

                            <dt>Thời gian:</dt>
                            <dd><?php echo $record->time; ?></dd>

                            <dt>Điểm khởi hành:</dt>
                            <dd><?php echo ((isset($province_data[$record->from_province_id])) ? $province_data[$record->from_province_id]->name : '') . ' - ' . ((isset($national_data[$record->from_national_id])) ? $national_data[$record->from_national_id]->name : ''); ?></dd>

                            <dt>Điểm đến:</dt>
                            <dd><?php echo ((isset($province_data[$record->to_province_id])) ? $province_data[$record->to_province_id]->name : '') . ' - ' . ((isset($national_data[$record->to_national_id])) ? $national_data[$record->to_national_id]->name : ''); ?></dd>

                            <dt>Phương tiện:</dt>
                            <dd><?php echo $record->transportation; ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-2 booking-area">
                        <form action="<?php echo base_url() . 'booking-tour';?>" method="post">
                            <p class="price">1.200.000đ</p>
                            <p><button onclick="location.href=''" class="btn btn-default book_tour">ĐẶT TOUR</button></p>
                            <input type="hidden" name="book_tour_id" value="<?php echo $record->id;?>">
                            <input type="hidden" name="csrf_test_name" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Box item -->

            <!-- Box item -->
            <?php if ($record->hide_provider != 1) :?>
            <div class="col-lg-12 box" id="hotel-description">
                <div class='subject-content discription'>
                    <dl class="dl-horizontal">
                        <dt>Tên nhà cung cấp:</dt>
                        <dd><?php echo $partner_tour->name;?></dd>

                        <dt>Địa chỉ:</dt>
                        <dd><?php echo $partner_tour->address;?></dd>

                        <dt>Số điện thoại liên hệ:</dt>
                        <dd><?php echo $partner_tour->phone;?></dd>
                    </dl>
                </div>
            </div>
            <?php endif;?>
            <!-- End Box item -->

            <!-- Box item -->
            <div class="col-lg-12 box" id="hotel-description">
                <div class="subject-title">GIÁ BAO GỒM</div>
                <div class='subject-content discription'>
                    <?php echo $record->price_description; ?>
                </div>
            </div>
            <!-- End Box item -->

            <!-- Box item -->
            <div class="col-lg-12 box" id="hotel-description">
                <div class="subject-title">LỊCH TRÌNH</div>
                <div class='subject-content discription'>
                    <?php echo $record->description; ?>
                </div>
            </div>
            <!-- End Box item -->

            <!-- Box item -->
            <div class="col-lg-12 box" id="hotel-policy">
                <div class="subject-title">CHÍNH SÁCH TOUR</div>
                <div class='subject-content discription'>
                    <?php echo $record->policy; ?>
                </div>
            </div>
            <!-- End Box item -->

            <!-- Box item -->
            <div class="col-lg-12 box" id="hotel-comment">
                <div class="subject-title">ĐÁNH GIÁ TOUR</div>
                <div class='col-lg-12 subject-content comment'>
                    <div class="col-lg-4 evaluation">
                        <div class="col-lg-4">
                            <button type="button" class="rate btn btn-default"><?php echo show_point($point); ?></button>
                        </div>
                        <div class="col-lg-7">
                            <p><?php echo show_bookmark(show_point($point)); ?></p><label>từ tổng <u><?php echo show_tour_comment_total($record->id); ?> nhận xét</u></label>
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
                    <input type="hidden" id="comment_tour_id" value="<?php echo $record->id;?>" />
                    <button type="submit" class="btn btn-success" id="write_comment_tour">Gửi đánh giá</button>
                </div>
                <div id="result-comment" style="display: none;">
                </div>
            </div>
        </div>
    </div>
</div>
