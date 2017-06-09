<!-- Slide home-->
<div id="slide-home" class="carousel slide banner-slide-tour" data-ride="carousel" data-interval="3000">
    <!-- Search -->
    <div class="carousel-search">
        <div class="container search-home-tour">
            <div class="">
                <div class="row">
                    <form role="form" id="fr-search" action="<?php echo base_url() . 'tour-search/tim-kiem.html';?>" method="get" autocomplete="off">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Bạn muốn đi du lịch ở đâu?</label>
                                <input id="tour-keyword-search" name="keyword-search" class="form-control" type="text" placeholder="Nhập tên địa danh, khu vực...">
                                <div id="list-name-search" class="list-name-search niceScroll" style="top: 70px"></div>
                            </div>
                        </div>
                        <div class="col-lg-offset-4 col-md-offset-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <button id="search-btn" class="btn btn-orange btn-arrow pull-left btn-block" type="submit">
                                    <strong>TÌM TOUR</strong><span class="arrow-r" aria-hidden="true"></span></button>
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
    <div class="carousel-inner" role="listbox">
        <?php $i_banner = 1; foreach($banner_home as $v) :?>
            <div class="item <?php echo ($i_banner == 1) ? 'active' : 'next';?> left">
                <img src="<?php echo $this->config->item('pic_url') . 'displays/' . $v->picture; ?>" />
            </div>
            <?php $i_banner++; endforeach;?>
    </div>
    <!-- End Banner slide -->
</div>
<!-- End slide home-->

<!-- Home content tour-->
<div class="container home-content-tour">
    <div class="row">
        <div class="col-lg-12">
            <div class="subject-name">TOUR TRONG NƯỚC</div>

            <!-- Subject content-->
            <div class="col-lg-12 subject-content">
                <?php foreach ($province_vn_common as $v) : ?>
                        <!-- Item -->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="location-hot">
                                <a href="<?php echo show_link($v->id, $v->name, 'tour_province'); ?>">
                                    <img class="picture" class="img-responsive" src="<?php echo show_picture(html_escape($v->picture), 365, 220, 'province'); ?>" />
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 info">
                                        <p class="title"><?php echo html_escape($v->name); ?></p>
                                        <p class="count"><?php echo show_tour_total($v->id); ?> tour</p>
                                        <img src='<?php echo base_url(); ?>/public/frontend/images/icon_dat_nhieu.png' />
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End Item -->
                <?php endforeach; ?>
            </div>
            <!-- End Subject content-->
        </div>
    </div>
</div>
<!-- End Home content tour-->

<!-- Home content tour-->
<div class="container home-content-tour">
    <div class="row">
        <div class="col-lg-12">
            <div class="subject-name">TOUR QUỐC TẾ</div>

            <!-- Subject content-->
            <div class="col-lg-12 subject-content">
                <?php foreach ($national_nn_common as $v) : ?>
                    <!-- Item -->
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="location-hot">
                            <a href="<?php echo show_link($v->id, $v->name, 'tour_national'); ?>">
                                <img class="picture" class="img-responsive" src="<?php echo show_picture(html_escape($v->picture), 365, 220, 'national'); ?>" />
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 info">
                                    <p class="title"><?php echo html_escape($v->name); ?></p>
                                    <p class="count"><?php echo show_tour_total_by_national($v->id); ?> tour</p>
                                    <img src='<?php echo base_url(); ?>/public/frontend/images/icon_dat_nhieu.png' />
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- End Item -->
                <?php endforeach; ?>
            </div>
            <!-- End Subject content-->
        </div>
    </div>
</div>
<!-- End Home content tour-->