$(function () {

    /*
     *  Load mien
     */
    $("select[name='national_id']").change(function () {
        var _this = $(this);

        load_area(_this.val());
    });

    /*
     *  Upload image ajax
     */
    
    if ($("#singleupload_input").length)
    {
        $(".load_script").html('<script type="text/javascript" src="' + base_url + 'public/backend/js/single_upload_ajax/jquery.singleuploadimage.js"></script>');
    
    
        $('.uploadbox').singleupload({
            action: host_url + 'backend/api/upload_tmp?type=province', //action: 'do_upload.php'
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
     *  Validate form
     */
    $("#frm").validate({
        rules: {
            name: 'required',
            type: 'required',
            national_id: 'required',
            area_id: 'required',
            img_name: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            type: 'Vui lòng chọn Loại',
            national_id: 'Vui lòng chọn Quốc Gia',
            area_id: 'Vui lòng chọn Miền',
            img_name: 'Vui lòng tải Hình ảnh',
        }
    });    

    //Change status common
    $(".img_common").click(function () {
        var _this = $(this);
        var data = jQuery.parseJSON(_this.attr('params'));
        var url = $("#frm").attr('action');

        $.ajax({
            url: url + '/change_status_common',
            data: data,
            type: 'get',
            success: function (result) {
                var data_response = jQuery.parseJSON(result);
                var img;

                if (data_response.result == 1)
                {
                    if (data_response.status == 1)
                        img = "tick-circle.png";
                    else
                        img = "disabled.png";

                    $(_this).attr('src', base_url + 'public/backend/img/' + img);
                }
            }
        });
    });
})

