<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta google for login -->
    <meta name="google-signin-client_id"
          content="682396166746-j7p20e6iak6r8t1cn4q2vgt3thp999q5.apps.googleusercontent.com">

    <title><?php echo $main_title;?></title>
    <meta name="keywords" content="<?php echo $main_keyword;?>"/>
    <meta name="description" content="<?php echo $main_description;?>"/>

    <!-- Minify CSS -->
<!--    <link href="--><?php //echo base_url(); ?><!--/public/frontend/assets/styles.min.css" rel="stylesheet" type="text/css">-->


    <link href="<?php echo base_url(); ?>/public/frontend/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/style_mobile.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/style_tablet.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/datepicker3.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/photo-galleries/sliderkit-core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/photo-galleries/sliderkit-demos.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/star-rating/jquery.rating.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>/public/frontend/css/style.css" rel="stylesheet" type="text/css">


    <script>
        var host_url = '<?php echo site_url(); ?>';
        var base_url = '<?php echo base_url(); ?>';
        var csrf_test_name = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>


    <script src="<?php echo base_url(); ?>/public/frontend/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/frontend/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/frontend/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>/public/frontend/js/jquery.bxslider.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/frontend/js/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/frontend/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>/public/frontend/js/star-rating/jquery.rating.js"></script>
<!--    <script src="--><?php //echo base_url(); ?><!--/public/frontend/js/photp-galleries/lib/js/external/_oldies/jquery-1.3.min.js"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--/public/frontend/js/photp-galleries/lib/js/external/jquery.easing.1.3.min.js"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--/public/frontend/js/photp-galleries/lib/js/external/jquery.mousewheel.min.js"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--/public/frontend/js/photp-galleries/lib/js/sliderkit/jquery.sliderkit.1.9.2.pack.js"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--/public/frontend/js/photp-galleries/lib/js/sliderkit/addons/sliderkit.delaycaptions.1.1.pack.js"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--/public/frontend/js/photp-galleries/lib/js/sliderkit/addons/sliderkit.counter.1.0.pack.js"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--/public/frontend/js/photp-galleries/lib/js/sliderkit/addons/sliderkit.timer.1.0.pack.js"></script>-->
<!--    <script src="--><?php //echo base_url(); ?><!--/public/frontend/js/photp-galleries/lib/js/sliderkit/addons/sliderkit.imagefx.1.0.pack.js"></script>-->
    <script src="<?php echo base_url(); ?>/public/frontend/js/script.js"></script>


    <!-- Facebook login-->
    <?php if ($controller == 'login' || $controller == 'registration') : ?>
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '173802336475309',
                    xfbml: true,
                    version: 'v2.9'
                });
            };

            // Load the SDK asynchronously
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            function callBackLoginFacebook() {
                FB.api('/me?fields=name,email,picture', function (response) {
                    $.ajax({
                        url: base_url + 'request/check_login_outsite',
                        data: {
                            type: 'facebook',
                            email: response.email,
                            user_app_id: response.id,
                            name: response.name,
                            csrf_test_name: csrf_test_name
                        },
                        type: 'post',
                        success: function (result) {
                            if (result == true)
                                location.href = base_url;
                        },
                        async: false
                    });
                    //document.getElementById('status').innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
                });
            }

            $(function () {
                $("#login_face").click(function () {
                    FB.login(function (response) {
                        if (response.authResponse) {
                            callBackLoginFacebook();
                        }
                    }, {scope: 'email,public_profile', return_scopes: true});
                })
            });

        </script>
        <!-- End facebook login -->

        <!-- Google login -->
        <meta name="google-signin-client_id" content="74904780284-p9bvq3uoivu94lnv0q5kp6psb2t2uf88.apps.googleusercontent.com">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <script src="https://apis.google.com/js/api:client.js"></script>
        <script>
            var googleUser = {};
            var startApp = function () {
                gapi.load('auth2', function () {
                    // Retrieve the singleton for the GoogleAuth library and set up the client.
                    auth2 = gapi.auth2.init({
                        client_id: '74904780284-p9bvq3uoivu94lnv0q5kp6psb2t2uf88.apps.googleusercontent.com',
                        cookiepolicy: 'single_host_origin',
                        // Request scopes in addition to 'profile' and 'email'
                        //scope: 'additional_scope'
                    });
                    attachSignin(document.getElementById('customBtn'));
                });
            };

            function attachSignin(element) {
                console.log(element.id);
                auth2.attachClickHandler(element, {},
                    function (googleUser) {
                        $.ajax({
                            url: base_url + 'request/check_login_outsite',
                            data: {
                                type: 'google',
                                email: googleUser.getBasicProfile().getEmail(),
                                user_app_id: googleUser.getBasicProfile().getId(),
                                name: googleUser.getBasicProfile().getName(),
                                csrf_test_name: csrf_test_name
                            },
                            type: 'post',
                            success: function (result) {
                                if (result == true)
                                    location.href = base_url;
                            },
                            async: false
                        });
                    }, function (error) {
                        alert(JSON.stringify(error, undefined, 2));
                    });
            }
        </script>


        <script>startApp();</script>
        <!-- End Google login -->
    <?php endif; ?>

    <?php if (($controller == 'hotel' && $action == 'detail') || ($controller == 'handbook' && $action == 'detail') || ($controller == 'tour' && $action == 'detail')) {?>
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '173802336475309',
                    xfbml: true,
                    version: 'v2.9'
                });
            };

            // Load the SDK asynchronously
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    <?php }?>

    <?php if (($controller == 'hotel' && $action == 'detail') || ($controller == 'tour' && $action == 'detail')) : ?>

        <!-- Maps marker-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXYmdhn6o880uuMJ5uo8hmfjJpFacpXmo&v=3.exp&sensor=false"></script>

        <script>
            // The following example creates a marker in Stockholm, Sweden
            // using a DROP animation. Clicking on the marker will toggle
            // the animation between a BOUNCE animation and no animation.
            $(document).ready(function () {
                var latDefault = 10.813572407910886;
                var lngDefault = 106.65695795893555;
                var zoomDefault = 14;
                var geocoder;
                var map;
                var marker;

                getPosition();
                var vietnam = new google.maps.LatLng(lat, lng);
                var parliament = new google.maps.LatLng(lat, lng);


                var mapOptions = {
                    zoom: zoom,
                    center: vietnam
                };

                map = new google.maps.Map(document.getElementById('map'),
                    mapOptions);

                marker = new google.maps.Marker({
                    map: map,
                    position: parliament
                });

                function getPosition() {
                    var latInput = $("#lat").val();
                    var lngInput = $("#lng").val();
                    var zoomInput = $("#zoom").val();

                    lat = latDefault;
                    lng = lngDefault;
                    zoom = zoomDefault;

                    if (latInput != "") {
                        lat = latInput;
                    }
                    if (lngInput != "") {
                        lng = lngInput;
                    }
                    if (zoomInput != "") {
                        zoom = parseInt(zoomInput);
                    }
                }
            });
        </script>

        <!-- Photo galleries -->
        <script src="<?php echo base_url(); ?>/public/frontend/js/photp-galleries/lib/js/external/_oldies/jquery-1.3.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/frontend/js/photp-galleries/lib/js/external/jquery.easing.1.3.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/frontend/js/photp-galleries/lib/js/external/jquery.mousewheel.min.js"></script>
        <script src="<?php echo base_url(); ?>/public/frontend/js/photp-galleries/lib/js/sliderkit/jquery.sliderkit.1.9.2.pack.js"></script>
        <script src="<?php echo base_url(); ?>/public/frontend/js/photp-galleries/lib/js/sliderkit/addons/sliderkit.delaycaptions.1.1.pack.js"></script>
        <script src="<?php echo base_url(); ?>/public/frontend/js/photp-galleries/lib/js/sliderkit/addons/sliderkit.counter.1.0.pack.js"></script>
        <script src="<?php echo base_url(); ?>/public/frontend/js/photp-galleries/lib/js/sliderkit/addons/sliderkit.timer.1.0.pack.js"></script>
        <script src="<?php echo base_url(); ?>/public/frontend/js/photp-galleries/lib/js/sliderkit/addons/sliderkit.imagefx.1.0.pack.js"></script>

        <script type="text/javascript">
            $.noConflict();
            jQuery(document).ready(function () {
                // Photo gallery > Minimalistic
                jQuery(".photosgallery-captions").sliderkit({
                    mousewheel: false,
                    keyboard: true,
                    shownavitems: 12,
                    auto: true,
                    delaycaptions: true
                });
            });
        </script>
        <!-- End Photo galleries -->
    <?php endif; ?>

</head>
<body>

<!-- Header -->
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="<?php echo base_url(); ?>"><img
                    src="<?php echo base_url(); ?>/public/frontend/images/logo.jpg"/></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php echo (($controller == 'index' || $controller == 'hotel') && $this->input->get('type') != 'prm') ? 'class="active"' : ''; ?>>
                    <a href="<?php echo base_url(); ?>">Khách sạn</a></li>
                <li <?php echo ($controller == 'tour') ? 'class="active"' : ''; ?>><a
                        href="<?php echo show_link('', 'Tour', 'tour'); ?>">Tour</a></li>
                <li <?php echo ($this->input->get('type') == 'prm') ? 'class="active"' : ''; ?>><a
                        href="<?php echo show_link('', 'khách sạn khuyến mãi', 'prm'); ?>">Khuyến mãi</a></li>
                <li <?php echo ($controller == 'handbook') ? 'class="active"' : ''; ?>><a
                        href="<?php echo show_link('', 'Cẩm nang du lịch', 'handbook'); ?>">Cẩm nang du lịch</a></li>
                <li <?php echo ($controller == 'page') ? 'class="active"' : ''; ?>><a
                        href="<?php echo show_link(8, 'Giới thiệu', 'page'); ?>">Thông tin</a></li>
            </ul>

            <!--
            <div class="nav navbar-nav navbar-right hidden-md hidden-xs hidden-sm call_support">
                <p>Tư vấn đặt phòng</p>
                <span>Gọi 1800 1101</span>
            </div>
            -->
            <div class="nav navbar-nav navbar-right hidden-md hidden-xs hidden-sm login_box">
                <ul>
                    <?php if (isset($user) && $user->email != ''): ?>
                        <li>
                            <a href=""><span
                                    class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; <?php echo html_escape($user->email); ?>
                            </a>
                            <ul class="dropdown-menu login-menu-child">
                                <li><a href="<?php echo show_link('', 'Thoát', 'logout'); ?>"><span
                                            class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp; Thoát</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo show_link('', 'Đăng nhập', 'login'); ?><?php echo (isset($back_url)) ? '/?back_url=' . $back_url : ''; ?>"><span
                                    class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; ĐĂNG NHẬP</a></li>
                        <li style="padding: 0">|</li>
                        <li>
                            <a href="<?php echo show_link('', 'Đăng ký', 'registration'); ?><?php echo (isset($back_url)) ? '/?back_url=' . $back_url : ''; ?>">ĐĂNG KÝ</a></li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
    <div class="line-blue"></div>
</nav>
<!-- End Header -->

<?php echo $content; ?>

<!-- Footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 province">
                <div class="subject-name">KHÁCH SẠN THEO TỈNH THÀNH</div>
                <div class="col-lg-12 subject-content">
                    <?php foreach ($provincetn as $v) : ?>
                        <div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
                            <a href="<?php echo show_link($v->id, $v->name, 'province'); ?>">
                                <span class="glyphicon glyphicon-triangle-right"></span>
                                <?php echo html_escape($v->name); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($provincenn as $v) : ?>
                        <div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
                            <a href="<?php echo show_link($v->id, $v->name, 'province'); ?>">
                                <span class="glyphicon glyphicon-triangle-right"></span>
                                <?php echo html_escape($v->name); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container footer-body">
        <div class="row">
            <div class="col-lg-12 line"></div>
            <div class="col-lg-12">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 logo subject-item"><img
                        src="<?php echo base_url(); ?>/public/frontend/images/logo-footer.png"/></div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 subject-item">
                    <div class="subject-name">VỀ CHÚNG TÔI</div>
                    <div class="subject-content">
                        <?php if (checkShowPage(8)){?><p><a href="<?php echo show_link(8, 'Giới thiệu', 'page'); ?>">Giới thiệu</a></p><?php }?>

                        <?php if (checkShowPage(14)){?><p><a href="<?php echo show_link(14, 'Liên hệ', 'page'); ?>">Liên hệ</a></p><?php }?>

                        <?php if (checkShowPage(9)){?><p><a href="<?php echo show_link(9, 'Tuyển dụng', 'page'); ?>">Tuyển dụng</a></p><?php }?>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 subject-item">
                    <div class="subject-name">THÔNG TIN CẦN BIẾT</div>
                    <div class="subject-content">

                        <?php if (checkShowPage(10)){?><p><a href="<?php echo show_link(10, 'Điều kiện & điều khoản', 'page'); ?>">Điều kiện & điều
                                khoản</a></p><?php }?>

                        <?php if (checkShowPage(11)){?><p><a href="<?php echo show_link(11, 'Chính sách riêng tư', 'page'); ?>">Chính sách riêng tư</a>
                        </p><?php }?>

                        <?php if (checkShowPage(12)){?><p><a href="<?php echo show_link(12, 'Chính sách bảo mật', 'page'); ?>">Chính sách bảo mật</a>
                        </p><?php }?>

                        <?php if (checkShowPage(13)){?><p><a href="<?php echo show_link(13, 'Hỗ trợ', 'page'); ?>">Hỗ trợ</a></p><?php }?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 subject-item">
                    <div class="subject-name">ĐĂNG KÝ NHẬN ƯU ĐÃI</div>
                    <div class="subject-content">
                        <p>
                            Hãy đăng ký email của bạn để chúng tôi
                            gửi <br>những thông tin cập nhật mới nhất
                        </p>

                        <div class="email">
                            <input type="text" value="" id="email_customer">
                            <span id="btn_email_customer" class="glyphicon glyphicon-chevron-right"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 subject-item">
                    <div class="subject-name">CHIA SẼ THÔNG TIN</div>
                    <div class="subject-content">
                        <p>
                            <span class="icon"><img
                                    src="<?php echo base_url(); ?>/public/frontend/images/icon-facebook.png"/></span>
                            <span class="icon"><img
                                    src="<?php echo base_url(); ?>/public/frontend/images/icon-google+.png"/></span>
                            <span class="icon"><img
                                    src="<?php echo base_url(); ?>/public/frontend/images/icon-twitter.png"/></span>
                            <span class="icon"><img
                                    src="<?php echo base_url(); ?>/public/frontend/images/icon-youtube.png"/></span>
                        </p>

                        <p class="authe">Chứng nhận SGD TMĐT</p>

                        <div class="regis">
                            <p class="a">ĐÃ ĐĂNG KÝ

                            <p>

                            <p class="b">với Bộ Công Thương</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer bottom -->
    <div class="container-fluid footer-bottom">
        <div class="row">
            <div class="container">
                <span class="glyphicon glyphicon-copyright-mark"></span> 2015 AZY.VN. Công ty AZY Việt Nam. VPĐD Tầng 8,
                Tòa nhà HDTC, Số 6 Bùi Thị Xuân, Q.1, TP.HCM
            </div>
        </div>
    </div>
    <!-- End Footer bottom -->
</div>
<!-- End Footer -->




</body>
</html>