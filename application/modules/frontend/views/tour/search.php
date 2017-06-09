<br>
<!-- Content -->
<div class="container content">
    <div class="row search">
        <!-- Breadcrumbs -->
        <div class="col-lg-12 breadcrumbs">
            <ol class="breadcrumb">
                <?php foreach ($breadcrumbs as $k => $v): ?>
                    <li><a href="<?php echo $v; ?>"><?php echo $k; ?></a></li>
                <?php endforeach; ?>
            </ol>
        </div>
        <!-- End Breadcrumbs -->

        <!-- Left col -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 left">
            <form id="fr-search" action="<?php echo base_url() . 'tour/' . format_title($location_name) . '.html'; ?>"
                  method="get" autocomplete="off">
                <!-- Form search -->
                <div class='col-lg-12 search-form'>
                    <div class='subject-title'>TÌM TOUR</div>
                    <div class='subject-content'>
                        <div class='col-lg-12 item'>
                            <p>ĐIỂM ĐẾN</p> <input type='text' id="tour-keyword-search" name="keyword-search"
                                                   value="<?php echo $search['keyword_search']; ?>"/>

                            <div id="list-name-search" class="list-name-search niceScroll hotel-page"></div>
                        </div>
                        <div class='col-lg-12 item'>
                            <p>ĐIỂM KHỞI HÀNH</p>
                            <select class="form-control" name="start-from-search" id="start-from-search">
                                <option value="0"></option>
                                <?php foreach ($province as $v) : ?>
                                    <option <?php echo ($search['start_from_search'] == $v->id) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                                <?php endforeach; ?>
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
                            <input type="hidden" name="type" id="search-type"
                                   value="<?php echo $search['key_type']; ?>"/>
                            <input type="hidden" name="id" id="search-id" value="<?php echo $search['key_id']; ?>"/>
                            <button class="btn btn-default booking-btn" type="submit">TÌM KIẾM & ĐẶT TOUR</button>
                        </div>
                    </div>
                </div>
                <!-- End Form search -->
            </form>

            <form id="fr-search-2" action="<?php echo base_url() . 'tour/' . format_title($location_name) . '.html'; ?>"
                  method="get" autocomplete="off">

                <!-- Block box item -->
                <div class="col-lg-12 box">
                    <div class="subject-title">THEO MỨC GIÁ</div>
                    <div class='subject-content'>
                        <?php foreach ($price_range as $k => $v) : ?>
                            <p><input
                                    class="tour-price-range" <?php echo (isset($search['price_range']) && in_array($k, $search['price_range'])) ? 'checked="checked"' : ''; ?>
                                    type="checkbox" name="price_range[]" value="<?php echo $k; ?>"> <?php echo $v; ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- End Block box item -->

                <!-- Block box item -->
                <div class="col-lg-12 box">
                    <div class="subject-title">DỊCH VỤ ĐI KÈM</div>
                    <div class='subject-content niceScroll' style="height: 200px">
                        <?php foreach ($service as $v) : ?>
                            <p><input
                                    class="tour-service" <?php echo (isset($search['tour_service']) && $search['tour_service'] != null && in_array($v->id, $search['tour_service'])) ? 'checked="checked"' : ''; ?>
                                    type="checkbox" name="tour_service[]"
                                    value="<?php echo $v->id; ?>"> <?php echo html_escape($v->name); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- End Block box item -->

                <!-- Block box item -->
                <div class="col-lg-12 box">
                    <div class="subject-title">TOUR THEO CHỦ ĐỀ</div>
                    <div class='subject-content niceScroll' style="height: 300px">
                        <?php foreach ($topic as $v) : ?>
                            <p><input
                                    class="tour-topic" <?php echo (isset($search['tour_topic']) && $search['tour_topic'] != null && in_array($v->id, $search['tour_topic'])) ? 'checked="checked"' : ''; ?>
                                    type="checkbox" name="tour_topic[]"
                                    value="<?php echo $v->id; ?>"> <?php echo html_escape($v->name); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- End Block box item -->


                <input type="hidden" name="sort-name" class="sort-name"
                       value="<?php echo (isset($search['sort'])) ? key($search['sort']) : ''; ?>"/>
                <input type="hidden" name="sort-value" class="sort-value"
                       value="<?php echo (isset($search['sort'])) ? $search['sort'][key($search['sort'])] : ''; ?>"/>
                <input id="date-from-search" type='hidden' name="df" value="<?php echo $search['df']; ?>"/>
                <input id="date-to-search" type='hidden' name="dt" value="<?php echo $search['dt']; ?>"/>
                <input type="hidden" name="type" id="search-type" value="<?php echo $search['key_type']; ?>"/>
                <input type="hidden" name="id" id="search-id" value="<?php echo $search['key_id']; ?>"/>
                <input type="hidden" name="start-from-search" id="start-from-search"
                       value="<?php echo $search['start_from_search']; ?>"/>
            </form>
        </div>
        <!-- End Left col -->

        <!-- Right col -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 right">
            <!-- Header -->
            <div class="header">
                <p class="title">
                    <?php echo $location_name; ?><!--<label><img src="images/map-icon.png" /> Xem bản đồ</label>--></p>
            </div>
            <!-- End Header -->

            <!-- Count-->
            <div class="count">
                Tìm thấy <label><?php echo (!empty($records)) ? $search['total'] : 0; ?></label> tour khởi hành theo
                ngày đã chọn</label>
            </div>
            <!-- End Count -->

            <!-- Sort -->
            <div class="sort">
                <div class="btn-group" role="group" aria-label="">
                    <button type="button"
                            class="btn btn-default tour-sort <?php echo (isset($search['sort']) && array_key_exists('tour.id', $search['sort'])) ? 'active' : ''; ?>"
                            data-value='desc' data-name='tour.id'>Mới nhất
                    </button>

                    <div class="btn-group" role="group">
                        <button type="button"
                                class="btn btn-default dropdown-toggle <?php echo (isset($search['sort']) && array_key_exists('evaluation', $search['sort'])) ? 'active' : ''; ?>"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Đánh giá
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="tour-sort" data-value='asc' data-name='evaluation'>Thấp đến cao</a>
                            </li>
                            <li><a href="#" class="tour-sort" data-value='desc' data-name='evaluation'>Cao đến thấp</a>
                            </li>
                        </ul>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="button"
                                class="btn btn-default dropdown-toggle <?php echo (isset($search['sort']) && array_key_exists('price', $search['sort'])) ? 'active' : ''; ?>"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Giá tour
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="tour-sort" data-value='asc' data-name='price'>Thấp đến
                                    cao</a></li>
                            <li><a href="#" class="tour-sort" data-value='desc' data-name='price'>Cao đến
                                    thấp</a></li>
                        </ul>
                    </div>


                </div>
            </div>
            <!-- End Sort -->

            <!-- List hotel -->
            <div class="col-lg-12 tour-list">
                <?php if (!empty($records)) : ?>
                    <?php foreach ($records as $v) : ?>
                        <!-- Item list -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-tour">
                            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12 picture'>
                                <a href="<?php echo $v->url; ?>"><img class="img-responsive"
                                                                      src='<?php echo $v->picture; ?>'/></a>
                            </div>
                            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12 description'>
                                <p class='title'><a href="<?php echo $v->url; ?>"><?php echo $v->name; ?></a></p>

                                <p><strong>Ngày khởi hành:</strong>
                                    <?php if ($v->start_date != 1) :?>
                                    <?php $start_date_arr = explode(';', $v->start_date); ?>
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

                                </p>

                                <p><strong>Thời gian:</strong> <?php echo $v->time; ?></p>

                                <p><strong>Điểm khởi
                                        hành:</strong> <?php echo $v->from_province . ' - ' . $v->from_national; ?></p>

                                <p><strong>Điểm đến:</strong> <?php echo $v->to_province . ' - ' . $v->to_national; ?>
                                </p>

                                <p><strong>Phương tiện:</strong> <?php echo $v->transportation; ?></p>
                            </div>
                            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12 evaluation'>
                                <button type="button" class="rate btn btn-default"><?php echo $v->point; ?></button>
                                <p>
                                    <?php if ($v->point != 0) : ?>
                                        <label class="rate-name"><?php echo $v->bookmark; ?></label> |
                                    <?php endif; ?>
                                    <label class="comment-count"><?php echo show_tour_comment_total($v->id); ?> nhận
                                        xét</label></p>

                                <p class="price">Giá tour</p>

                                <p class="price"><label><?php echo $v->price; ?></label></p>

                                <p>
                                    <button
                                        onclick="location.href='<?php echo show_link($v->id, html_escape($v->name), 'tour_detail'); ?>'"
                                        class="btn btn-default view_tour">XEM TOUR
                                    </button>
                                </p>
                            </div>
                        </div>
                        <!-- End Item list -->
                    <?php endforeach; ?>
                <?php else: ?>
                    Không có Tour nào được tìm thấy
                <?php endif; ?>
                <!-- Paging -->
                <?php if ($this->pagination->create_links() != '') : ?>
                    <div class="col-lg-12 page">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                <?php endif; ?>
                <!-- End Paging -->
            </div>
            <!-- End List hotel -->

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