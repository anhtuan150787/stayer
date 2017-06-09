$(function () {
    $("#frm").validate({
        rules: {
            name: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
        }
    });

    /*
     *  Upload image ajax
     */

    if ($("#singleupload_input").length)
    {
        $(".load_script").html('<script type="text/javascript" src="' + base_url + 'public/backend/js/single_upload_ajax/jquery.singleuploadimage.js"></script>');


        $('.uploadbox').singleupload({
            action: host_url + 'backend/api/upload_tmp?type=national', //action: 'do_upload.php'
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