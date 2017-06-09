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
    
    $("#frm").validate({
        rules: {
            name: 'required',
            national_id: 'required',
            area_id: 'required',
            province_id: 'required',
            district_id: 'required',
            img_name: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            national_id: 'Vui lòng chọn Quốc Gia',
            area_id: 'Vui lòng chọn Miền',
            province_id: 'Vui lòng chọn Tỉnh Thành',
            district_id: 'Vui lòng chọn Quận Huyện',
            img_name: 'Vui lòng tải Hình ảnh',
        }
    });
    
    /*
     *  Upload image ajax
     */
    
    if ($("#singleupload_input").length)
    {
        $(".load_script").html('<script type="text/javascript" src="' + base_url + 'public/backend/js/single_upload_ajax/jquery.singleuploadimage.js"></script>');
    
    
        $('.uploadbox').singleupload({
            action: host_url + 'backend/api/upload_tmp?type=sight', //action: 'do_upload.php'
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
