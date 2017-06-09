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
            <form id="fr-search" action="<?php echo base_url() . 's/' . format_title($location_name) . '.html'; ?>" method="get" autocomplete="off">
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
                            <input type="hidden" name="type" id="search-type" value="<?php echo $search['key_type']; ?>" />
                            <input type="hidden" name="id" id="search-id" value="<?php echo $search['key_id']; ?>" />
                            <button class="btn btn-default booking-btn" type="submit">TÌM KIẾM & ĐẶT PHÒNG</button>
                        </div>
                    </div>
                </div>
                <!-- End Form search -->
            </form>

            <form id="fr-search-2" action="<?php echo base_url() . 's/' . format_title($location_name) . '.html'; ?>" method="get" autocomplete="off">

                <!-- Block box item -->
                <div class="col-lg-12 box">
                    <div class="subject-title">THEO MỨC GIÁ</div>
                    <div class='subject-content'>
                        <?php foreach ($price_range as $k => $v) : ?>
                            <p><input class="hotel-price-range" <?php echo (isset($search['price_range']) && in_array($k, $search['price_range'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="price_range[]" value="<?php echo $k; ?>"> <?php echo $v; ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- End Block box item -->

                <!-- Block box item -->
                <div class="col-lg-12 box">
                    <div class="subject-title">HẠNG KHÁCH SẠN</div>
                    <div class='subject-content'>
                        <?php foreach ($star as $v) : ?>
                            <div class="col-lg-12" style="padding: 0;">
                                <input class="hotel-star" <?php echo (isset($search['star']) && in_array($v, $search['star'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="star[]" value="<?php echo $v; ?>"> 
                                <ul class="star">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <li <?php echo ($v >= $i) ? 'class="active"' : ''; ?>></li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- End Block box item -->

                <!-- Block box item -->
                <div class="col-lg-12 box">
                    <div class="subject-title">TIỆN NGHI</div>
                    <div class='subject-content niceScroll' style="height: 400px">
                        <?php foreach ($hotel_facilities as $v) : ?>
                            <p><input class="hotel-facilities" <?php echo (isset($search['hotel_facilities']) && in_array($v->id, $search['hotel_facilities'])) ? 'checked="checked"' : ''; ?> type="checkbox" name="hotel_facilities[]" value="<?php echo $v->id; ?>"> <?php echo html_escape($v->name); ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- End Block box item -->

                <!-- Block box item -->
                <div class="col-lg-12 box">
                    <div class="subject-title">KHU VỰC</div>
                    <div class='subject-content niceScroll' style="height: 300px">
                        <?php foreach ($geonear as $v) : ?>
                            <p><input class="hotel-geonear" <?php echo (isset($search['geonear']) && $search['geonear'] == $v->id) ? 'checked="checked"' : ''; ?> type="radio" name="geonear" value="<?php echo $v->id; ?>"> <?php echo html_escape($v->name); ?></p>
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
                <?php endif;?>
                <!-- End Block box item -->

                <input type="hidden" name="sort-name" class="sort-name" value="<?php echo (isset($search['sort'])) ? key($search['sort']) : ''; ?>" />
                <input type="hidden" name="sort-value" class="sort-value" value="<?php echo (isset($search['sort'])) ? $search['sort'][key($search['sort'])] : ''; ?>" />
                <input id="date-from-search" type='hidden' name="df" value="<?php echo $search['df']; ?>" />
                <input id="date-to-search" type='hidden' name="dt" value="<?php echo $search['dt']; ?>" />
                <input type="hidden" name="type" id="search-type" value="<?php echo $search['key_type']; ?>" />
                <input type="hidden" name="id" id="search-id" value="<?php echo $search['key_id']; ?>" />
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

            <!-- Count-->
            <div class="count">
                Tìm thấy <label><?php echo (!empty($records)) ? $search['total'] : 0; ?></label> khách sạn có phòng <!--<label><?php echo $search['location_name']; ?>--></label>
            </div>
            <!-- End Count -->

            <!-- Sort -->
            <div class="sort">
                <div class="btn-group" role="group" aria-label="">
                    <button type="button" class="btn btn-default hotel-sort <?php echo (isset($search['sort']) && array_key_exists('hotel.id', $search['sort'])) ? 'active' : ''; ?>" data-value='desc' data-name='hotel.id'>Mới nhất</button>	
                    <?php if ($this->input->get('type') != 'prm'):?>
                    <button type="button" class="btn btn-default hotel-sort <?php echo (isset($search['sort']) && array_key_exists('promotion', $search['sort'])) ? 'active' : ''; ?>" data-value='desc' data-name='promotion'>Khuyến mãi</button>
                    <?php endif;?>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle <?php echo (isset($search['sort']) && array_key_exists('evaluation', $search['sort'])) ? 'active' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Đánh giá
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="hotel-sort" data-value='asc' data-name='evaluation'>Thấp đến cao</a></li>
                            <li><a href="#" class="hotel-sort" data-value='desc' data-name='evaluation'>Cao đến thấp</a></li>
                        </ul>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle <?php echo (isset($search['sort']) && array_key_exists('room_price.price', $search['sort'])) ? 'active' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Giá phòng
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="hotel-sort" data-value='asc' data-name='room_price.price'>Thấp đến cao</a></li>
                            <li><a href="#" class="hotel-sort" data-value='desc' data-name='room_price.price'>Cao đến thấp</a></li>
                        </ul>
                    </div>


                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default dropdown-toggle <?php echo (isset($search['sort']) && array_key_exists('hotel.star', $search['sort'])) ? 'active' : ''; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hạng khách sạn
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="hotel-sort" data-value='desc' data-name='hotel.star'>Hạng sao [5 - 1]</a></li>
                            <li><a href="#" class="hotel-sort" data-value='asc' data-name='hotel.star'>Hạng sao [1 - 5]</a></li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- End Sort -->

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
                                <p>
                                    <?php if ($v->point != 0) : ?>
                                    <label class="rate-name"><?php echo $v->bookmark; ?></label> |
                                    <?php endif;?>
                                    <label class="comment-count"><?php echo show_comment_total($v->id); ?> nhận xét</label></p>
                            </div>
                        </div>
                        <!-- End Item list -->
                    <?php endforeach; ?>
                <?php else: ?>
                    Không có khách sạn nào được tìm thấy
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