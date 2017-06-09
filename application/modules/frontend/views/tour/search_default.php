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
            <form id="fr-search" action=""
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
                            <input type="hidden" name="type" id="search-type"
                                   value=""/>
                            <input type="hidden" name="id" id="search-id" value=""/>
                            <button class="btn btn-default booking-btn" type="submit">TÌM KIẾM & ĐẶT TOUR</button>
                        </div>
                    </div>
                </div>
                <!-- End Form search -->
            </form>
        </div>
        <!-- End Left col -->

        <!-- Right col -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 right">
            <!-- Header -->
            <div class="header">
                <p class="title"><?php echo $location_name; ?><!--<label><img src="images/map-icon.png" /> Xem bản đồ</label>--></p>
                <p class="description">
                    <?php echo (isset($location_description) && $location_description != '') ? $location_description : ''; ?>
                </p>
            </div>
            <!-- End Header -->

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

                                <p><strong>Điểm khởi hành:</strong> <?php echo $v->from_province . ' - ' . $v->from_national; ?></p>

                                <p><strong>Điểm đến:</strong> <?php echo $v->to_province . ' - ' . $v->to_national; ?></p>

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
                                <p><button onclick="location.href='<?php echo show_link($v->id, html_escape($v->name), 'tour_detail');?>'" class="btn btn-default view_tour">XEM TOUR</button></p>
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