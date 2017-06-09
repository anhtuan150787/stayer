<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                padding: 0;
                margin: 0;
            }           
        </style>
        <!-- Minify CSS -->
        <link href="<?php echo base_url(); ?>/public/frontend/assets/styles.min.css" rel="stylesheet" type="text/css">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url(); ?>/public/frontend/assets/jquery-1.11.3.min.js"></script>

        <!-- Maps marker-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXYmdhn6o880uuMJ5uo8hmfjJpFacpXmo&v=3.exp&sensor=false"></script>

        <script type="text/javascript">
            // check DOM Ready
            $(document).ready(function() {
                //$("#googleMap").css('height', $(window).height());
                // execute
                (function() {
                    var LatIndex = <?php echo $hotel->lat;?>;
                    var LngIndex = <?php echo $hotel->lng;?>;
                    var strBodyIndex = $("#strBodyIndex").html();

                    var infowindow = new google.maps.InfoWindow;

                    var marker;

                    var markers = [];

                    // map options
                    var options = {
                        zoom: 13,
                        center: new google.maps.LatLng(LatIndex, LngIndex),
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: true
                    };

                    // init map
                    var map = new google.maps.Map(document.getElementById('googleMap'), options);


                    var fr = document.createElement('div');
                    var html=('<div class="map_boxstar">');
                    var max_star = 5;
                    for(i = 1; i<= max_star; i++){
                        html+=('<div class="col-lg-12">');
                        html+=('<input style="float: left; margin-right: 5px;" type="checkbox" id="star_' + i + '" class="filterstarmap" value="' + i + '" onclick="checksearch();"' + (i == <?php echo $hotel->star;?> ? ' checked' : '') + '>');
                        html+=('<ul class="star">');
                        for(ii = 1; ii<= max_star; ii++) {
                            html += ('<li ' + ((i >= ii) ? 'class="active"' : '') + '></li>');
                        }
                        html+=('</ul>');
                        html+=('</div>');
                    }
                    html+='</div>';

                    $(fr).append(html);
                    map.controls[google.maps.ControlPosition.RIGHT_TOP].push(fr);


                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(LatIndex, LngIndex),
                        map: map,
                        icon: '<?php echo base_url();?>/public/frontend/images/icon_blue_H_s.png'
                    });

                    (function(marker) {
                        infowindow.setContent(strBodyIndex);
                        infowindow.open(map, marker);
                        // add click event
                        google.maps.event.addListener(marker, 'mouseover', function() {
                            infowindow.setContent(strBodyIndex);
                            infowindow.open(map, marker);
                        });

                    })(marker);


                    var locations = [
                            <?php foreach ($hotel_other as $v) {
                            ?>
                            <?php
                                $str_li_star = '';
                                for($i_star = 1; $i_star <= 5; $i_star++) {
                                    $str_li_star .= '<li ' . (($v->star >= $i_star) ? 'class="active"' : '') . '></li>';
                                }
                            ?>
                            ['<?php echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-hotel"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 picture"><a href="' . $v->url . '" target="_blank"><img class="img-responsive" src="' . $v->picture . '" /></a></div><div class="col-lg-9 col-md-9 col-sm-9 col-xs-8 description"><p class="title"><a href="' . $v->url . '" target="_blank">' . $v->name . '</a></p><p class="address">' . $v->address . '</p><ul class="star">' . $str_li_star . '</ul><p class="price">Giá 1 đêm từ <label>' . $v->price . '</label></p></div></div>'; ?>',
                                <?php echo $v->lat; ?>,
                                <?php echo $v->lng; ?>, 13],
                            <?php } ?>
                    ];


                    // set multiple marker
                    for (var i = 0; i < <?php echo count($hotel_other); ?>; i++) {
                        // init markers
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map,
                            icon: '<?php echo base_url();?>/public/frontend/images/icon_red_H.png'
                        });
                        markers.push(marker);

                        // process multiple info windows
                        (function(marker, i) {
                            // add click event
                            google.maps.event.addListener(marker, 'mouseover', function() {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                            });

                        })(marker, i);
                    }

                    checksearch = function(){

                        for (var i = 0; i < markers.length; i++) {
                            markers[i].setMap(null);
                        }
                        markers = [];

                        var checkedStar = new Array();
                        $(".filterstarmap:checked").each(function(){
                            checkedStar.push($(this).val());
                        });

                        $.ajax({
                            url:  '<?php echo site_url();?>request/map_show_hotel_order',
                            data: {stars:checkedStar, cur_hotel: <?php echo $hotel->id;?>},
                            type: 'GET',
                            async: true,
                            success: function(result)
                            {
                                var data = jQuery.parseJSON(result);

                                eval(data.script);

                                // set multiple marker
                                for (var i = 0; i < data.total_data; i++) {
                                    // init markers
                                    marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                        map: map,
                                        icon: '<?php echo base_url();?>/public/frontend/images/icon_red_H.png'
                                    });
                                    markers.push(marker);

                                    // process multiple info windows
                                    (function(marker, i) {
                                        // add click event
                                        google.maps.event.addListener(marker, 'mouseover', function() {
                                            infowindow.setContent(locations[i][0]);
                                            infowindow.open(map, marker);
                                        });

                                    })(marker, i);
                                }
                            }
                        })

                    }

                })();
            });
        </script>
    </head>

    <body>
        <div class="col-lg-12 item-map-show" id="strBodyIndex" style="display: none;">
            <!-- Item list -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 list-hotel">
                    <div class='col-lg-3 col-md-3 col-sm-3 col-xs-4 picture'>
                        <img class="img-responsive" src='<?php echo show_picture(html_escape($hotel->picture), 111, 94);?>' />
                    </div>
                    <div class='col-lg-9 col-md-9 col-sm-9 col-xs-8 description'>
                        <p class='title'><?php echo html_escape($hotel->name);?></p>
                        <p class='address'><?php echo html_escape($hotel->address);?></p>
                        <ul class="star">
                        <?php for($i_star = 1; $i_star <= 5; $i_star++) :?>
                            <li <?php echo ($hotel->star >= $i_star) ? 'class="active"' : '';?>></li>
                        <?php endfor;?>    
                        </ul>
                        <p class="price">Giá 1 đêm từ <label><?php echo show_price_low($hotel->id); ?></label></p>
                    </div>
                </div>
                <!-- End Item list -->                      	
        </div>
        <div id="googleMap" style="width:100%; height:500px;"></div>
    </body>
</html>
