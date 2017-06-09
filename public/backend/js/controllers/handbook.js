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
     *  Load bai bien
     */
    $("select[name='province_id']").change(function () {
        var _this = $(this);

        load_beach(_this.val());
    });

    
    $("#frm").validate({
        rules: {
            name: 'required',
            img_name: 'required',
            national_id: 'required',
            area_id: 'required',
            province_id: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tiêu đề',
            img_name: 'Vui lòng tải Hình ảnh',
            national_id: 'Vui lòng chọn Quốc Gia',
            area_id: 'Vui lòng chọn Miền',
        }
    });
    
    /*
     *  Upload image ajax
     */
    
    if ($("#singleupload_input").length)
    {
        $(".load_script").html('<script type="text/javascript" src="' + base_url + 'public/backend/js/single_upload_ajax/jquery.singleuploadimage.js"></script>');
    
    
        jQuery('.uploadbox').singleupload({
            action: host_url + 'backend/api/upload_tmp?type=handbook', //action: 'do_upload.php'
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
});









