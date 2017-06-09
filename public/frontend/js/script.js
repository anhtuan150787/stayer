$(document).ready(function () {
    /*
     * Search Hotel
     */
    var fr_search_hotel_field_name = $("#keyword-search");
    var fr_search_hotel_field_stay_date = $("#date-from-search");
    var fr_search_hotel_field_out_date = $("#date-from-search");

    $("#search-btn").click(function () {
        if (fr_search_hotel_field_name.val() == '') {
            alert('Vui lòng nhập Tên khách sạn hoặc Địa điểm.');
            fr_search_hotel_field_name.focus();
            return false;
        }
        if (fr_search_hotel_field_stay_date.val() == '') {
            alert('Vui lòng chọn Ngày nhận phòng.');
            return false;
        }
        if (fr_search_hotel_field_out_date.val() == '') {
            alert('Vui lòng chọn Ngày trả phòng.');
            return false;
        }
    });

    /*

     * Goi y tim kiem

     */

    $("#keyword-search").bind('keyup focus', function () {


        if ($("#keyword-search").val() != '' && $("#keyword-search").val().length > 1) {

            $.ajax({

                url: base_url + 'request/search',

                data: {keyword: $("#keyword-search").val(), csrf_test_name: csrf_test_name},

                type: 'post',

                success: function (data) {

                    if (data.length > 0) {

                        $("#list-name-search").show().html(data);

                        $("#list-name-search").getNiceScroll().show();

                    }

                    $(".list-name-search-item").click(function () {

                        $("#keyword-search").val($(this).attr('val'));

                        $("#list-name-search").html('');


                        key_id = $(this).attr('val_id');

                        key_type = $(this).attr('type');

                        name_seo = $(this).attr('val_title_seo');


                        url_fr_action = base_url + 's/';


                        type = '';


                        switch (key_type) {

                            case 'province':


                                url_fr_action += name_seo + '.html';


                                type = 'p';


                                break;


                            case 'district':


                                url_fr_action += name_seo + '.html';


                                type = 'd';


                                break;


                            case 'ward':


                                url_fr_action += name_seo + '.html';


                                type = 'w';


                                break;


                            case 'geonear':


                                url_fr_action += name_seo + '.html';


                                type = 'ge';


                                break;


                            case 'sight':


                                url_fr_action += name_seo + '.html';


                                type = 'si';


                                break;


                            case 'hotel':


                                url_fr_action = base_url + 'h/' + name_seo + '-' + key_id + '.html';


                                type = 'h';


                                break;

                        }


                        $("#search-id").val(key_id);


                        $("#search-type").val(type);


                        $("#fr-search").attr("action", url_fr_action);

                    });

                },

                async: true

            });

            $(document.body).click(function () {

                $('#list-name-search').hide();

            });

        } else {

            $("#list-name-search").html('');

        }

    });


    /*
     * Datepicker
     */
    var dateFDefaut = $("#date-from-search").val();
    var dateTDefaut = $("#date-to-search").val();
    var night_stay = 1;
    if (document.getElementById('date-from-search')) {
        $("#date-from-search").datepicker({
            defaultDate: "+1w",
            numberOfMonths: 2,
            minDate: 0,
            onSelect: function (selectedDate) {
                $("#date-to-search").datepicker("option", "minDate", selectedDate);
                var DateF = $("#date-from-search").val();
                var DateFArr = DateF.split('/');
                var dtF = new Date(parseInt(DateFArr[1]) + '/' + parseInt(DateFArr[0]) + '/' + DateFArr[2]);
                dtF.setDate(dtF.getDate() + night_stay);
                var day = dtF.getDate();
                var month = dtF.getMonth() + 1;
                var year = dtF.getFullYear();
                month = ((month <= 9) ? "0" : "") + month;
                day = ((day <= 9) ? "0" : "") + day;
                $("#date-to-search").val(day + '/' + month + '/' + year);
            }
        });
    }

    if (document.getElementById('date-to-search')) {
        $("#date-to-search").datepicker({
            defaultDate: "+1w",
            numberOfMonths: 2,
            minDate: '+2d',
            onSelect: function (selectedDate) {
                var DateT = $("#date-to-search").val();
                var DateTArr = DateT.split('/');
                var dtT = new Date(parseInt(DateTArr[1]) + '/' + parseInt(DateTArr[0]) + '/' + DateTArr[2]);
                var DateF = $("#date-from-search").val();
                var DateFArr = DateF.split('/');
                var dtF = new Date(parseInt(DateFArr[1]) + '/' + parseInt(DateFArr[0]) + '/' + DateFArr[2]);
                var numDay = parseInt((dtT - dtF) / (24 * 3600 * 1000));
                if (numDay <= 0) {
                    alert('Ngày trả phòng phải sau ngày nhận phòng.');
                    $("#date-to-search").val(dateTDefaut);
                    return;
                } else if (numDay > 30) {
                    alert('Khoảng thời gian lưu lại đặt phòng là 30 đêm.');
                    $("#date-to-search").val(dateTDefaut);
                    return;
                }
                night_stay = numDay;
                dateTDefaut = DateT;
            }
        });
    }

    /*
     *  Hien thi khach san theo khu vuc ajax - trang chu
     */
    if (document.getElementById('home-province-show-hotel-ajax-result'))
        home_show_province_hotel(98);


    $(".home-province-show-hotel-ajax").click(function () {

        home_show_province_hotel($(this).attr('data-id'));

    });

    function home_show_province_hotel(province_id) {
        var _this = $(".home-province-show-hotel-ajax[data-id=" + province_id + "]");

        $(".home-province-show-hotel-ajax").find('a').removeClass('active');

        $(".home-province-show-hotel-ajax[data-id=" + province_id + "]").find('a').addClass('active');

        $.ajax({
            url: base_url + 'request/home_hotel_province',
            data: {province_id: province_id, csrf_test_name: csrf_test_name},
            type: 'post',
            success: function (data) {

                var json_data = jQuery.parseJSON(data);

                $("#home-province-show-hotel-ajax-result").html(json_data.data);

                $("#home-province-show-hotel-ajax-total").html(json_data.total);

                $("#home-province-show-hotel-ajax-show-all").html('<a href="' + json_data.url_province + '">' + _this.attr('data-name') + '</a>');

            }
        });
    }

    /*
     *  Submit search
     */
    $(".hotel-price-range, .hotel-star, .hotel-facilities").click(function () {
        $("#fr-search-2").submit();
    });

    $(".hotel-geonear").click(function () {
        $("#fr-search-2 #search-type").val('ge');
        $("#fr-search-2 #search-id").val($(this).val());
        $("#fr-search-2").submit();
    });

    /*
     *  Sort search
     */
    $(".hotel-sort").click(function () {
        $('.sort-name').val($(this).attr('data-name'));

        $('.sort-value').val($(this).attr('data-value'));

        $("#fr-search-2").submit();
    });

    /*
     *  Submit search TOUR
     */
    $(".tour-price-range, .tour-topic, .tour-service").click(function () {
        $("#fr-search-2").submit();
    });

    $(".hotel-geonear").click(function () {
        $("#fr-search-2 #search-type").val('ge');
        $("#fr-search-2 #search-id").val($(this).val());
        $("#fr-search-2").submit();
    });

    /*
     *  Sort search
     */
    $(".tour-sort").click(function () {
        $('.sort-name').val($(this).attr('data-name'));

        $('.sort-value').val($(this).attr('data-value'));

        $("#fr-search-2").submit();
    });

    /*
     *  Modal
     */
    $('.map-modal-lg').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)

        var hotel_id = button.data('hotel_id') // Extract info from data-* attributes

        var modal = $(this);

        modal.find(".modal-content").html('<iframe src="' + base_url + 'request/show_map/?hotel_id=' + hotel_id + '"></iframe>');
    });

    /*
     *  Open form search
     */
    $("#show-form-search").click(function () {
        $('#target-show-form-search').toggle();
    })

    /*
     *  Datepicker search room hotel detail
     */
    /*
     * Datepicker
     */
    var dateFDefaut = $("#room-date-from-search").val();
    var dateTDefaut = $("#room-date-to-search").val();
    var night_stay = 1;

    if (document.getElementById('room-date-from-search')) {
        $("#room-date-from-search").datepicker({
            defaultDate: "+1w",
            numberOfMonths: 2,
            minDate: 0,
            onSelect: function (selectedDate) {
                $("#room-date-to-search").datepicker("option", "minDate", selectedDate);
                var DateF = $("#room-date-from-search").val();
                var DateFArr = DateF.split('/');
                var dtF = new Date(parseInt(DateFArr[1]) + '/' + parseInt(DateFArr[0]) + '/' + DateFArr[2]);
                dtF.setDate(dtF.getDate() + night_stay);
                var day = dtF.getDate();
                var month = dtF.getMonth() + 1;
                var year = dtF.getFullYear();
                month = ((month <= 9) ? "0" : "") + month;
                day = ((day <= 9) ? "0" : "") + day;
                $("#room-date-to-search").val(day + '/' + month + '/' + year);
            }
        });
    }

    if (document.getElementById('room-date-to-search')) {
        $("#room-date-to-search").datepicker({
            defaultDate: "+1w",
            numberOfMonths: 2,
            minDate: '+2d',
            onSelect: function (selectedDate) {
                var DateT = $("#room-date-to-search").val();
                var DateTArr = DateT.split('/');
                var dtT = new Date(parseInt(DateTArr[1]) + '/' + parseInt(DateTArr[0]) + '/' + DateTArr[2]);
                var DateF = $("#room-date-from-search").val();
                var DateFArr = DateF.split('/');
                var dtF = new Date(parseInt(DateFArr[1]) + '/' + parseInt(DateFArr[0]) + '/' + DateFArr[2]);
                var numDay = parseInt((dtT - dtF) / (24 * 3600 * 1000));
                if (numDay <= 0) {
                    alert('Ngày trả phòng phải sau ngày nhận phòng.');
                    $("#room-date-to-search").val(dateTDefaut);
                    return;
                } else if (numDay > 30) {
                    alert('Khoảng thời gian lưu lại đặt phòng là 30 đêm.');
                    $("#room-date-to-search").val(dateTDefaut);
                    return;
                }
                night_stay = numDay;
                $("#room-night-search").val(night_stay);
                dateTDefaut = DateT;
            }
        });
    }

    if (document.getElementById('room-night-search')) {
        $("#room-night-search").keyup(function () {
            var vlThis = $(this).val();
            if (vlThis != '') {
                if (vlThis <= 0) {
                    alert('Ngày trả phòng phải sau ngày nhận phòng.');
                    $("#room-night-search").val('');
                    return;
                } else if (vlThis > 30) {
                    alert('Khoảng thời gian lưu lại đặt phòng là 30 đêm.');
                    $("#room-night-search").val('');
                    return;
                }
                var DateF = $("#room-date-from-search").val();
                var DateFArr = DateF.split('/');
                var dtF = new Date(parseInt(DateFArr[1]) + '/' + parseInt(DateFArr[0]) + '/' + DateFArr[2]);
                dtF.setDate(dtF.getDate() + parseInt(vlThis));
                var day = dtF.getDate();
                var month = dtF.getMonth() + 1;
                var year = dtF.getFullYear();
                month = ((month <= 9) ? "0" : "") + month;
                day = ((day <= 9) ? "0" : "") + day;
                $("#room-date-to-search").val(day + '/' + month + '/' + year);
            }
        });
    }

    /*
     * show more facilities hotel detail
     */
    $("#show-more-facilities-hotel-detail").click(function () {
        $(".item-hotel-facilities").show();
        $(this).remove();
    });

    /*
     * Comment paging hotel detail
     */
    $(".page-comment").click(function () {
        var page_comment = $(this).attr('data-page');
        var hotel_id_comment = $(this).attr('date-hotel_id');

        $.ajax({
            url: base_url + 'request/comment_paging',
            data: {page_comment: page_comment, hotel_id: hotel_id_comment, csrf_test_name: csrf_test_name},
            type: 'post',
            success: function (data) {
                $("#content-list-comment").html(data);
            }
        });
    });

    /*
     * Search room hotel detail
     */
    if (document.getElementById('search-result-detail'))
        search_room_hotel_detail();

    $("#search-btn-room").click(function () {
        search_room_hotel_detail();
    });

    function search_room_hotel_detail() {
        var _this = $('#search-btn-room');
        var room_date_from_search = $("#room-date-from-search").val();
        var room_date_to_search = $("#room-date-to-search").val();
        var room_night_search = $("#room-night-search").val();
        var room_num_search = $("#room-num-search").val();
        var room_persion_search = $("#room-persion-search").val();
        var hotel_id = $("#hotel_id").val();

        _this.attr('disabled', 'disabled');

        $("#search-result-detail").html('<div class="col-lg-12" style="text-align: center; padding: 20px;"><img src="' + base_url + 'public/frontend/images/loading-icon.gif" /></div>');

        $.ajax({
            url: base_url + 'request/search_room',
            data: {
                hotel_id: hotel_id,
                room_date_from_search: room_date_from_search,
                room_date_to_search: room_date_to_search,
                room_night_search: room_night_search,
                room_num_search: room_num_search,
                room_persion_search: room_persion_search,
                csrf_test_name: csrf_test_name
            },
            type: 'post',
            sync: false,
            success: function (data) {
                _this.removeAttr('disabled');

                $("#search-result-detail").html(data);

                /*
                 * Tooltip hotel detail
                 */
                $('[data-toggle="tooltip"]').tooltip();

                /*
                 *  Show description room
                 */
                $(".show-description").click(function () {
                    $("#description-room-" + $(this).attr('data-id')).toggle();
                    $("#bedmore-room-" + $(this).attr('data-id')).hide();
                    $("#promotion-room-" + $(this).attr('data-id')).hide();
                });

                /*
                 *  Show bedmore room
                 */
                $(".show-bedmore").click(function () {
                    $("#bedmore-room-" + $(this).attr('data-id')).toggle();
                    $("#description-room-" + $(this).attr('data-id')).hide();
                    $("#promotion-room-" + $(this).attr('data-id')).hide();
                });

                /*
                 *  Show promotion room
                 */
                $(".show-promotion").click(function () {
                    $("#promotion-room-" + $(this).attr('data-id')).toggle();
                    $("#bedmore-room-" + $(this).attr('data-id')).hide();
                    $("#description-room-" + $(this).attr('data-id')).hide();
                });

                /*
                 *  Chon so phong
                 */
                $("select[name*=num-room]").change(function () {
                    if ($(this).val() != 0) {
                        $(this).parent().next().find('button').removeAttr("disabled");
                    }
                    else {
                        $(this).parent().next().find('button').attr("disabled", "disabled");
                    }
                });
            }
        });
    }

    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    /*
     *  Email customer
     */
    $("#btn_email_customer").click(function () {

        var _this = $(this);

        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        var email_customer = $("#email_customer");

        var email_customer_val = email_customer.val();

        if (email_customer_val == '') {
            email_customer.parent().css('border', '1px solid #ff4f20');

            email_customer.focus();

            return;
        }
        else if (!pattern.test(email_customer_val)) {
            email_customer.parent().css('border', '1px solid #ff4f20');

            return;
        }
        else {
            email_customer.parent().removeAttr('style');

            email_customer.val('');

            _this.attr('disabled', 'disabled');

            email_customer.attr('placeholder', 'Loading...');

            $.ajax({
                url: base_url + 'request/email_customer',
                data: {email: email_customer_val, csrf_test_name: csrf_test_name},
                type: 'post',
                success: function (data) {

                    email_customer.attr('placeholder', 'Đã gửi');

                    _this.removeAttr('disabled');
                }
            });
        }
    });

    /*
     *  Login
     */
    $("#btn-login").click(function () {

        var u_n = $("#u_n");

        var p_w = $("#p_w");

        var is_error = false;

        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        $('label[for=u_n]').hide();

        $('label[for=p_w]').hide();

        if (u_n.val() == '') {
            $('label[for=u_n]').show().html('Vui lòng nhập Email');

            is_error = true;
        }
        else if (!pattern.test(u_n.val())) {
            $('label[for=u_n]').show().html('Email không hợp lệ');

            is_error = true;
        }

        if (p_w.val() == '') {
            $('label[for=p_w]').show().html('Vui lòng nhập Mật khẩu');

            is_error = true;
        }

        if (is_error == true)
            return false;
        else
            $("#fr-login").submit();
    });

    /*
     *  Registration
     */
    $("#btn-registration").click(function () {

        var name = $("#name");

        var email = $("#email");

        var password = $("#password");

        var re_password = $("#re_password");

        var confirm = $("#confirm");

        var captcha = $("#captcha");

        var is_error = false;

        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        $('label[for=name]').hide();

        $('label[for=email]').hide();

        $('label[for=password]').hide();

        $('label[for=re_password]').hide();

        $('label[for=captcha]').hide();

        $('label[for=confirm]').hide();

        if (name.val() == '') {
            $('label[for=name]').show().html('Vui lòng nhập Họ tên');

            is_error = true;
        }

        if (email.val() == '') {
            $('label[for=email]').show().html('Vui lòng nhập Email');

            is_error = true;
        }
        else if (!pattern.test(email.val())) {
            $('label[for=email]').show().html('Email không hợp lệ');

            is_error = true;
        }
        else if (exist_email(email.val())) {
            $('label[for=email]').show().html('Email này đã tồn tại. Vui lòng nhập Email khác');

            is_error = true;
        }

        if (password.val() == '') {
            $('label[for=password]').show().html('Vui lòng nhập Mật khẩu');

            is_error = true;
        }

        if (re_password.val() == '') {
            $('label[for=re_password]').show().html('Vui lòng nhập lại Mật khẩu');

            is_error = true;
        }
        else if (password.val() != re_password.val()) {
            $('label[for=re_password]').show().html('Nhập lại mật khẩu không đúng');

            is_error = true;
        }

        if (captcha.val() == '') {
            $('label[for=captcha]').show().html('Vui lòng nhập Mã xác thực');

            is_error = true;
        }

        if (confirm.is(":checked") == false) {
            $('label[for=confirm]').show().html('Vui lòng xác nhận điều khoản');

            is_error = true;
        }

        if (is_error == true)
            return false;
        else
            $("#fr-registration").submit();
    });

    /*
     *  Forget password form
     */
    $("#btn-forget-pass").click(function () {

        var email = $("#email");

        var captcha = $("#captcha");

        var is_error = false;

        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        $('label[for=email]').hide();

        $('label[for=captcha]').hide();

        if (email.val() == '') {
            $('label[for=email]').show().html('Vui lòng nhập Email');

            is_error = true;
        }
        else if (!pattern.test(email.val())) {
            $('label[for=email]').show().html('Email không hợp lệ');

            is_error = true;
        }

        if (captcha.val() == '') {
            $('label[for=captcha]').show().html('Vui lòng nhập Mã xác thực');

            is_error = true;
        }

        if (is_error == true) {
            return false;
        }
        else {
            $("#btn-forget-pass").attr("disabled", "disabled");

            $("#fr-forget-pass").submit();
        }
    });

    /*
     *  Update password forget
     */
    $("#btn-forget-update-pass").click(function () {

        var mxt = $("#mxt");

        var password = $("#password");

        var re_password = $("#re_password");

        var is_error = false;

        $('label[for=mxt]').hide();

        $('label[for=password]').hide();

        $('label[for=re_password]').hide();

        if (mxt.val() == '') {
            $('label[for=mxt]').show().html('Vui lòng nhập Mã xác thực');

            is_error = true;
        }

        if (password.val() == '') {
            $('label[for=password]').show().html('Vui lòng nhập Mật khẩu');

            is_error = true;
        }

        if (re_password.val() == '') {
            $('label[for=re_password]').show().html('Vui lòng nhập lại Mật khẩu');

            is_error = true;
        }
        else if (password.val() != re_password.val()) {
            $('label[for=re_password]').show().html('Nhập lại mật khẩu không đúng');

            is_error = true;
        }

        if (is_error == true) {
            return false;
        }
        else {
            $("#btn-forget-update-pass").attr('disabled', 'disabled');

            $("#fr-forget-update-pass").submit();
        }
    });


    /*
     *  Reload captcha
     */
    $(".reload_captcha").click(function () {

        var _this = $(this);

        $.ajax({
            url: base_url + 'request/reload_captcha',
            data: {csrf_test_name: csrf_test_name},
            type: 'post',
            async: true,
            success: function (data) {
                if (data) {
                    $('.load_captcha').html(data);
                }
            }
        });
    });

    $("#btn-fr-booking-1").click(function () {

        var name = $("#name");

        var email = $("#email");

        var address = $("#address");

        var phone = $("#phone");

        var province = $("#province");

        var payment_type = $("input[name=payment_type]");

        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        var is_error = false;

        $('label[for=name], label[for=email], label[for=address], label[for=phone], label[for=payment_type], label[for=province]').hide();

        if (name.val() == '') {
            $('label[for=name]').show().html('Vui lòng nhập Họ tên');

            is_error = true;
        }

        if (phone.val() == '') {
            $('label[for=phone]').show().html('Vui lòng nhập Số điện thoại');

            is_error = true;
        }
        else if (isNaN(phone.val())) {
            $('label[for=phone]').show().html('Số điện thoại không hợp lệ');

            is_error = true;
        }

        if (email.val() == '') {
            $('label[for=email]').show().html('Vui lòng nhập Email');

            is_error = true;
        }
        else if (!pattern.test(email.val())) {
            $('label[for=email]').show().html('Email không hợp lệ');

            is_error = true;
        }

        if (address.val() == '') {
            $('label[for=address]').show().html('Vui lòng nhập Địa chỉ');

            is_error = true;
        }

        if (province.val() == '') {
            $('label[for=province]').show().html('Vui lòng chọn Tỉnh Thành');

            is_error = true;
        }

        if (payment_type.is(":checked") == false) {
            $('label[for=payment_type]').show().html('Vui lòng chọn Phương thức thanh toán');

            is_error = true;
        }

        if (is_error == true) {
            return false;
        } else {
            $("#btn-fr-booking-1").attr('disabled', 'disabled');

            $("#fr-booking-1").submit();
        }

    });

    $('#btn-coupon').click(function(){

        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        if ($("#email").val() == '') {
            alert('Vui lòng nhập Email');
            $("#email").focus();
            return;

        } else if (!pattern.test($("#email").val())) {
            alert('Email không hợp lệ');
            $("#email").focus();
            return;
        }

        if ($("#phone").val() == '') {
            alert('Vui lòng nhập Số điện thoại');
            $("#phone").focus();
            return;
        }

        if ($('#coupon').val() != '') {
            $.ajax({
                url: base_url + 'request/check_ajax_coupon',
                data: {
                    csrf_test_name: csrf_test_name,
                    coupon: $('#coupon').val(),
                    area_id: $('#area').val(),
                    hotel_id: $('#hotel_id').val(),
                    night: $('#night').val(),
                    price_total: $('#price_total').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                },
                type: 'post',
                async: true,
                success: function (result) {

                    var data = jQuery.parseJSON(result);

                    if (data.ReturnCode == false) {

                        $("#btn-fr-booking-1").removeAttr('disabled');
                        $('#coupon_wrap').hide();
                        $('#coupon_price').html('');
                        $('#price_payment').html(addCommas($('#price_total').val()) + 'đ');
                        alert(data.Error);

                        return;

                    } else {

                        $('#price_payment').html(data.Price_payment);
                        $('#coupon_wrap').show();
                        $('#coupon_price').html('- ' + data.Price_coupon);

                        alert('Mã giảm giá được áp dụng cho đơn hàng này');

                        return;
                    }

                }
            });
        }
    });

    $("#person_get_room").click(function () {
        if ($("#form_person_get_room").is(':visible')) {
            $("#form_person_get_room").hide();
        } else {
            $("#form_person_get_room").show();
        }
    });


    $("#btn-fr-booking-tour").click(function () {
        var name = $("#name");

        var email = $("#email");

        var address = $("#address");

        var phone = $("#phone");

        var province = $("#province");

        var payment_type = $("input[name=payment_type]");

        var start_date = $("#start_date");

        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        var is_error = false;

        $('label[for=name], label[for=email], label[for=address], label[for=phone], label[for=payment_type], label[for=province], label[for=start_date]').hide();

        if (name.val() == '') {
            $('label[for=name]').show().html('Vui lòng nhập Họ tên');

            is_error = true;
        }

        if (phone.val() == '') {
            $('label[for=phone]').show().html('Vui lòng nhập Số điện thoại');

            is_error = true;
        }
        else if (isNaN(phone.val())) {
            $('label[for=phone]').show().html('Số điện thoại không hợp lệ');

            is_error = true;
        }

        if (email.val() == '') {
            $('label[for=email]').show().html('Vui lòng nhập Email');

            is_error = true;
        }
        else if (!pattern.test(email.val())) {
            $('label[for=email]').show().html('Email không hợp lệ');

            is_error = true;
        }

        if (address.val() == '') {
            $('label[for=address]').show().html('Vui lòng nhập Địa chỉ');

            is_error = true;
        }

        if (province.val() == '') {
            $('label[for=province]').show().html('Vui lòng chọn Tỉnh Thành');

            is_error = true;
        }

        if (payment_type.is(":checked") == false) {
            $('label[for=payment_type]').show().html('Vui lòng chọn Phương thức thanh toán');

            is_error = true;
        }

        if (start_date.val() == '') {
            $('label[for=start_date]').show().html('Vui lòng chọn Ngày khởi hành');

            is_error = true;
        }

        if (is_error == true) {
            return false;
        }
        else {
            $("#btn-fr-booking-tour").attr('disabled', 'disabled');

            $("#fr-booking-tour").submit();
        }

    });

    $("#copy_order_contact").click(function () {
        $("#name_stay").val($("#name").val());
        $("#email_stay").val($("#email").val());
        $("#address_stay").val($("#address").val());
        $("#province_stay").val($("#province").val());
        $("#phone_stay").val($("#phone").val());
    });

    /*
     *  Modal login
     */
    $('.login-modal-lg').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)

        var hotel_id = button.data('hotel_id') // Extract info from data-* attributes

        var url_current = $("#url_current").val();

        var df = $("#room-date-from-search").val();

        var dt = $("#room-date-to-search").val();

        var room_num = $("#room-num-search").val();

        var room_person = $("#room-persion-search").val();

        var modal = $(this);

        url_current = url_current + '&df=' + df + '&dt=' + dt + '&room_num=' + room_num + '&room_person=' + room_person;

        modal.find(".modal-body").html('<iframe style="max-height: 470px" src="' + base_url + 'request/login/?url_current=' + encodeURI(url_current) + '"></iframe>');
    });

    /*
     *  Write comment
     */
    $('.comment-modal-lg').on('show.bs.modal', function (event) {
        $("#form-comment").show();
        $("#result-comment").hide();
        $("#form-comment").find('textarea').val("");
        $(".rating-cancel").trigger('click');
    });


    $("#write_comment").click(function () {
        var comment_body = $("#comment_body");

        var hotel_id = $("#comment_hotel_id");

        var rating = $("input.comment_star:checked");

        var is_error = false;

        $('label[for=comment_body], label[for=comment_rating]').hide();

        if (comment_body.val() == '') {
            $('label[for=comment_body]').show().html('Vui lòng nhập nội dung');

            is_error = true;
        }

        if ($("input.comment_star").is(":checked") == false) {
            $('label[for=comment_rating]').show().html('Vui lòng chọn đánh giá');

            is_error = true;
        }

        if (is_error == true) {
            return false;
        }
        else {
            $.ajax({
                url: base_url + 'request/comment',
                data: {
                    csrf_test_name: csrf_test_name,
                    comment_body: comment_body.val(),
                    hotel_id: hotel_id.val(),
                    rating: rating.val()
                },
                type: 'post',
                async: true,
                success: function (result) {
                    $("#form-comment").hide();
                    if (result == true) {
                        $('#result-comment').show().html('<p class="text-success">Cám ơn bạn đã đánh giá</p>');
                    } else {
                        $('#result-comment').show().html('<p class="text-danger">Có lỗi. Không thể gửi đánh giá</p>');
                    }
                }
            });
        }
    });


    $("#write_comment_tour").click(function () {
        var comment_body = $("#comment_body");

        var tour_id = $("#comment_tour_id");

        var rating = $("input.comment_star:checked");

        var is_error = false;

        $('label[for=comment_body], label[for=comment_rating]').hide();

        if (comment_body.val() == '') {
            $('label[for=comment_body]').show().html('Vui lòng nhập nội dung');

            is_error = true;
        }

        if ($("input.comment_star").is(":checked") == false) {
            $('label[for=comment_rating]').show().html('Vui lòng chọn đánh giá');

            is_error = true;
        }

        if (is_error == true) {
            return false;
        }
        else {
            $.ajax({
                url: base_url + 'request/write_comment_tour',
                data: {
                    csrf_test_name: csrf_test_name,
                    comment_body: comment_body.val(),
                    tour_id: tour_id.val(),
                    rating: rating.val()
                },
                type: 'post',
                async: true,
                success: function (result) {
                    $("#form-comment").hide();
                    if (result == true) {
                        $('#result-comment').show().html('<p class="text-success">Cám ơn bạn đã đánh giá</p>');
                    } else {
                        $('#result-comment').show().html('<p class="text-danger">Có lỗi. Không thể gửi đánh giá</p>');
                    }
                }
            });
        }
    });

    /*
     *  Scroll
     */
    if ($(".niceScroll").length > 0) {
        $(".niceScroll").niceScroll({cursorborder: "", cursorcolor: "#4db6f6", boxzoom: true});
    }

    /*
     * Slider
     */
    if ($('.bxslider').length > 0) {
        $('.bxslider').bxSlider({
            pager: false,
            nextSelector: '.next_btn',
            prevSelector: '.prev_btn',
            prevText: '<span class="glyphicon glyphicon-menu-left"></span>',
            nextText: '<span class="glyphicon glyphicon-menu-right"></span>',
            speed: 1000,
            responsive: true,
            //auto: true,
        });

        $('.bxslider-adv').bxSlider({
            pager: false,
            controls: false,
            auto: true,
            speed: 1000,
        });

        $('.bxslider-comment').bxSlider({
            pager: false,
            controls: false,
            auto: true,
            speed: 1000,
            mode: 'fade',
        });
    }

    /*
     *  Star rating
     */
    if ($('.comment_star').length > 0) {
        $('.comment_star').rating({
            callback: function (value, link) {
                $("#star_value").val(value);
            }
        });
    }

    /*
     * Goi y tim kiem tour
     */
    $("#tour-keyword-search").bind('keyup focus', function () {

            if ($("#tour-keyword-search").val() != '' && $("#tour-keyword-search").val().length > 1) {
                $.ajax({
                    url: base_url + 'request/search_tour',
                    data: {keyword: $("#tour-keyword-search").val(), csrf_test_name: csrf_test_name},
                    type: 'post',
                    success: function (data) {
                        if (data.length > 0) {
                            $("#list-name-search").show().html(data);
                            $("#list-name-search").getNiceScroll().show();
                        }

                        $(".list-name-search-item").click(function () {
                            $("#tour-keyword-search").val($(this).attr('val'));
                            $("#list-name-search").html('');

                            key_id = $(this).attr('val_id');
                            key_type = $(this).attr('type');
                            name_seo = $(this).attr('val_title_seo');

                            url_fr_action = base_url + 'tour/';

                            type = '';

                            switch (key_type) {

                                case 'national':

                                    url_fr_action += name_seo + '.html';

                                    type = 'na';

                                    break;

                                case 'province':

                                    url_fr_action += name_seo + '.html';

                                    type = 'p';

                                    break;

                                case 'tour':

                                    url_fr_action = base_url + 'tour/' + name_seo + '-' + key_id + '.html';

                                    type = 'h';

                                    break;
                            }

                            $("#search-id").val(key_id);

                            $("#search-type").val(type);

                            $("#fr-search").attr("action", url_fr_action);
                        });
                    },
                    async: true
                });

                $(document.body).click(function () {
                    $('#list-name-search').hide();
                });
            } else {
                $("#list-name-search").html('');
            }


    });

    $("#slot_tour_booking").change(function () {
        var price_tour = $("#price_tour").val();
        var total_money = $(this).val() * price_tour;

        $(".total_money").html(addCommas(total_money) + 'đ');
    });

    if ($("#start_date").length) {
        $("#start_date").datepicker();
    }

});

function exist_email(email) {
    var data_exist_email;

    $.ajax({
        url: base_url + 'request/exist_email',
        data: {email: email, csrf_test_name: csrf_test_name},
        type: 'post',
        async: false,
        success: function (data) {
            data_exist_email = data;
        }
    });
    return data_exist_email;
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;

}