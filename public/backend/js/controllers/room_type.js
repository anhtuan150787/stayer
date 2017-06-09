$(function () {

    /*
     *  Validate
     */
    $("#frm").validate({
        rules: {
            name: 'required',
            img_name: 'required',
            type: 'required',
            size: 'required',
            bed: 'required',
            slot: 'required',
            room_number: 'required',
            price_type: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            img_name: 'Vui lòng tải Hình ảnh',
            type: 'Vui lòng nhập thông tin Kiểu phòng',
            size: 'Vui lòng nhập thông tin Diện tích',
            bed: 'Vui lòng nhập thông tin Giường',
            slot: 'Vui lòng nhập thông tin Số người',
            room_number: 'Vui lòng nhập thông tin Số phòng',
            price_type: 'Vui lòng chọn thông tin Loại giá',
        }
    });

    /*
     *  Upload image ajax
     */

    if ($("#singleupload_input").length) {
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
     * Add more price stage
     */
    var stt_price_stage = $("#price_stage_stt").val();

    $("#get_more_price").click(function () {
        var wrap_price_stage;

        stt_price_stage++;

        wrap_price_stage = '<div class="controls"><input style="margin-bottom: 5px;" type="text" class="input-medium datepick valid" data-date-format="yyyy-mm-dd" name="datefrom_price_stage[' + stt_price_stage + ']" value="" placeholder="Từ ngày"/> <input style="margin-bottom: 5px;" type="text" class="input-medium datepick valid" data-date-format="yyyy-mm-dd" name="dateto_price_stage[' + stt_price_stage + ']" value="" placeholder="Đến ngày"/> <input type="text" class="input-medium" name="price_stage_origin[' + stt_price_stage + ']" value=""placeholder="Giá gốc" onkeyup="this.value = (addCommas(this.value));"/> <input type="text" class="input-medium" name="price_stage[' + stt_price_stage + ']" value=""placeholder="Giá bán" onkeyup="this.value = (addCommas(this.value));"/> <label style="float: right"><a class="remove_price" href="javascript:void(0)">Xóa</a></label><hr></div>';

        $(".item_price_stage").append(wrap_price_stage);

        $('input[class="input-medium datepick valid"]').datepicker();

        $(".remove_price").click(function () {
            $(this).parent().parent().remove();
        });
    });

    $(".remove_price").click(function () {
        $(this).parent().parent().remove();
    });
});

