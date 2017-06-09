$(function () {

    /*
     *  Load mien
     */
    $("select[name='national_id']").change(function () {
        var _this = $(this);

        load_area(_this.val());
    });

    /*
     *  Load Tinh/Thanh
     */
    $("select[name='area_id']").change(function () {
        var _this = $(this);

        load_province(_this.val());
    });


    /*
     *  Load Quan/Huyen
     */
    $("select[name='province_id']").change(function () {
        var _this = $(this);

        load_district(_this.val());
    });

    /*
     *  Load Phuong/Xa
     */
    $("select[name='district_id']").change(function () {
        var _this = $(this);

        load_ward(_this.val());
        
        load_geonear(_this.val());
        
        load_sight(_this.val());
    });

    $("#frm").validate({
        rules: {
            name: 'required',
            national_id: 'required',
            area_id: 'required',
            province_id: 'required',
            district_id: 'required',
            ward_id: 'required',
            img_name: 'required',
            address: 'required',
            star_value: 'required',
            type_id: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            national_id: 'Vui lòng chọn Quốc Gia',
            area_id: 'Vui lòng chọn Miền',
            province_id: 'Vui lòng chọn Tỉnh Thành',
            district_id: 'Vui lòng chọn Quận Huyện',
            ward_id: 'Vui lòng chọn Phường Xã',
            img_name: 'Vui lòng tải Hình đại diện',
            address: 'Vui lòng nhập Địa chỉ',
            star_value: 'Vui lòng chọn Sao',
            type_id: 'Vui lòng chọn Loại khách sạn',
        }
    });

    /*
     *  Upload image ajax
     */

    if ($("#singleupload_input").length)
    {
        $(".load_script").html('<script type="text/javascript" src="' + base_url + 'public/backend/js/single_upload_ajax/jquery.singleuploadimage.js"></script>');


        $('.uploadbox').singleupload({
            action: host_url + 'backend/api/upload_tmp?type=hotel', //action: 'do_upload.php'
            inputId: 'singleupload_input',
            onError: function (code, mesg) {
                console.debug('error code ' + code);
                console.debug('error mesg ' + mesg);
                alert(mesg);
            },
            onSuccess: function (url, data, img_name) {
                var review = ('<img src="' + url + '"/>');

                $(".image_loaded").html(review);

                $("#img_name").val(img_name);
            }
            /*,onProgress: function(loaded, total) {} */
        });
    }

    /*
     * Trigger upload list picture
     */
    $("#up_picture_trigger").click(function () {
        $("#photoimg").trigger('click');
    });

    /*
     * Upload list image ajax
     */
    $('.load_script').html('<script src="' + base_url + 'public/backend/js/uploadimage/js/jquery.min.js"></script>');
    $('.load_script').html('<script src="' + base_url + 'public/backend/js/uploadimage/js/jquery.wallform.js"></script>');

    $('#photoimg').live('change', function () {

        $("#imageform").ajaxForm({target: '#gallery',
            beforeSubmit: function () {

                console.log('beforeSubmit');
                $("#imageloadstatus").show();
                $("#imageloadbutton").hide();
            },
            success: function () {
                console.log('success');
                $("#imageloadstatus").hide();
                $("#imageloadbutton").show();

                /*
                 * An hinh tmp
                 */
                $(".del-gallery-pic-tmp").click(function () {
                    $(this).parent().parent().parent().remove();
                });

            },
            error: function () {
                console.log('error');
                $("#imageloadstatus").hide();
                $("#imageloadbutton").show();
            }}).submit();
    });

    /*
     *  Rating star
     */

    $('.load_script').html('<script src="' + base_url + 'public/backend/js/star-rating/jquery.rating.js" type="text/javascript" language="javascript"></script>');

    $('.load_script').html('<link href="' + base_url + 'public/backend/js/star-rating/jquery.rating.css" type="text/css" rel="stylesheet"/>');

    $('#frm :radio.star').rating({
        callback: function (value, link) {
            $("#star_value").val(value);
        }
    });

    /*
     * Delete picture hotel
     */
    $(".del-hotel-pic").click(function () {
        var _this = $(this);
        
        $.ajax({
            url: host_url + 'backend/api/delete_pic_hotel',
            data: {pic_id: $(this).attr('pic'), csrf_test_name: csrf_test_name},
            type: 'post',
            success: function (data)
            {
                if (data) {
                    _this.parent().parent().parent().remove();
                }
            }
        });
    });
    

});
