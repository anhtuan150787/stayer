$(function () {

    /*
     *  Load mien
     */
    $("select[name='from_national_id']").change(function () {
        var _this = $(this);

        $("select[name='from_area_id']").attr("disabled", "disabled");

        $.ajax({
            url: host_url + 'backend/api/load_area',
            data: {national_id: _this.val(), csrf_test_name: csrf_test_name},
            type: 'post',
            success: function (data)
            {
                if (data != '')
                {
                    $("select[name='from_area_id']").removeAttr("disabled");

                    $("select[name='from_area_id']").html(data);
                }

            }
        });
    });

    /*
     *  Load Tinh/Thanh
     */
    $("select[name='from_area_id']").change(function () {
        var _this = $(this);

        $("select[name='from_province_id']").attr("disabled", "disabled");

        $.ajax({
            url: host_url + 'backend/api/load_province',
            data: {area_id : _this.val(), csrf_test_name : csrf_test_name},
            type: 'post',
            success: function (data)
            {
                if (data != '')
                {
                    $("select[name='from_province_id']").removeAttr("disabled");

                    $("select[name='from_province_id']").html(data);
                }

            }
        });
    });

    /*
     *  Load mien
     */
    $("select[name='to_national_id']").change(function () {
        var _this = $(this);

        $("select[name='to_area_id']").attr("disabled", "disabled");

        $.ajax({
            url: host_url + 'backend/api/load_area',
            data: {national_id: _this.val(), csrf_test_name: csrf_test_name},
            type: 'post',
            success: function (data)
            {
                if (data != '')
                {
                    $("select[name='to_area_id']").removeAttr("disabled");

                    $("select[name='to_area_id']").html(data);
                }

            }
        });
    });

    /*
     *  Load Tinh/Thanh
     */
    $("select[name='to_area_id']").change(function () {
        var _this = $(this);

        $("select[name='to_province_id']").attr("disabled", "disabled");

        $.ajax({
            url: host_url + 'backend/api/load_province',
            data: {area_id : _this.val(), csrf_test_name : csrf_test_name},
            type: 'post',
            success: function (data)
            {
                if (data != '')
                {
                    $("select[name='to_province_id']").removeAttr("disabled");

                    $("select[name='to_province_id']").html(data);
                }

            }
        });
    });


    $("#frm").validate({
        rules: {
            name: 'required',
            partner_tour_id: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            partner_tour_id: 'Vui lòng chọn Nhà cung cấp',
        }
    });

    /*
     *  Upload image ajax
     */

    if ($("#singleupload_input").length)
    {
        $(".load_script").html('<script type="text/javascript" src="' + base_url + 'public/backend/js/single_upload_ajax/jquery.singleuploadimage.js"></script>');

        $('.uploadbox').singleupload({
            action: host_url + 'backend/api/upload_tmp?type=tour', //action: 'do_upload.php'
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
     * Delete picture hotel
     */
    $(".del-tour-pic").click(function () {
        var _this = $(this);

        $.ajax({
            url: host_url + 'backend/api/delete_pic_tour',
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


    $("#get_more_start_date").click(function(){
        var html_start_date;

        if ($("#start_date").val() != '' && $("#start_date").val() != undefined) {
            html_start_date = $("#start_date").val();
            $("#start_date_wrap").val($("#start_date_wrap").val() + html_start_date + '; ');
        }



        $("#start_date").val('');
    })
});