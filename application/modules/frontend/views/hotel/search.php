&nbsp;
<!-- Content -->
<div class="container content">
    <div class="row search">
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
            <form id="fr-search" action="" method="get" autocomplete="off">
                <!-- Form search -->
                <div class='col-lg-12 search-form'>
                    <div class='subject-title'>TÌM KIẾM KHÁCH SẠN</div>
                    <div class='subject-content'>
                        <div class='col-lg-12 item'>
                            <p>ĐIỂM ĐẾN</p> <input type='text' id="keyword-search" name="keyword-search" value="<?php echo $search['keyword_search']; ?>" />
                            <div id="list-name-search" class="list-name-search niceScroll hotel-page"></div>
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 item'>
                            <p>NHẬN PHÒNG</p>
                            <input readonly="readonly" id="date-from-search" type='text' name="df" value="<?php echo $search['df']; ?>" />
                        </div>
                        <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6 item'>
                            <p>TRẢ PHÒNG</p>
                            <input readonly="readonly" id="date-to-search" type='text' name="dt" value="<?php echo $search['dt']; ?>" />
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
            <div class="col-lg-12 hotel-list">
                <?php if (!empty($records)) : ?>
                    <?php foreach ($records as $v) : ?>
                        <!-- Item list -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-hotel">
                            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12 picture'>
                                <a href="<?php echo $v->url; ?>"><img class="img-responsive" src='<?php echo $v->picture; ?>' /></a>
                            </div>
                            <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12 description'>
                                <p class='title'><a href="<?php echo $v->url; ?>"><?php echo $v->name; ?></a></p>
                                <p class='address'><?php echo $v->address; ?></p>
                                <ul class="star">
                                    <?php for ($i_star = 1; $i_star <= 5; $i_star++) : ?>
                                        <li <?php echo ($v->star >= $i_star) ? 'class="active"' : ''; ?>></li>
                                    <?php endfor; ?>
                                </ul>
                                <label class="map" data-hotel_id="<?php echo $v->id; ?>" data-toggle="modal" data-target=".map-modal-lg">
                                    <img src="<?php echo base_url(); ?>/public/frontend/images/map-icon.png" /> Xem bản đồ
                                </label>
                                <p class="icon">
                                    <?php
                                    $hotel_facilities = show_hotel_facilities($v->id);
                                    $i_hotel_facilities = 1;
                                    foreach ($hotel_facilities as $fa)
                                    {
                                        if ($i_hotel_facilities <= 5 && isset($fa->picture) && $fa->picture != '')
                                        {
                                            ?>
                                            <img title="<?php echo $fa->name; ?>" src="<?php echo base_url(); ?>/public/pictures/facilities/<?php echo $fa->picture; ?>" />
                                            <?php $i_hotel_facilities++;
                                        }
                                    } ?>
                                </p>
                                <?php if ($v->promotion_name != '') : ?>
                                    <p class="promotion">
                                        <img src="<?php echo base_url(); ?>/public/frontend/images/icon-promotion.png" />&nbsp;
                                        <?php echo $v->promotion_name;?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class='col-lg-2 col-md-2 col-sm-2 col-xs-12 evaluation'>
                                <p class="price">Giá 1 đêm từ <label><?php echo $v->price; ?></label></p>
                                <button type="button" class="rate btn btn-default"><?php echo $v->point; ?></button>
                                <p><label class="rate-name"><?php echo $v->bookmark; ?></label> | <label class="comment-count"><?php echo show_comment_total($v->id); ?> nhận xét</label></p>
                            </div>
                        </div>
                        <!-- End Item list -->
                    <?php endforeach; ?>
                <?php else: ?>
                    Không có kết quả nào được tìm thấy
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