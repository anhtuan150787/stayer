$(function(){
    /*
     *  Reload captcha
     */
    $(".reload_captcha").click(function(){

        var _this = $(this);

        $.ajax({
            url: host_url + 'partner/request/reload_captcha',
            data: {csrf_test_name: csrf_test_name},
            type: 'post',
            async: true,
            success: function (data)
            {
                if (data) {
                    $('.load_captcha').html(data);
                }
            }
        });
    });

    $("#frmLogin").validate({
        rules: {
            u_n: 'required',
            p_w: 'required',
            captcha: 'required',
        },
        messages: {
            u_n: 'Vui lòng nhập thông tin Tài khoản',
            p_w: 'Vui lòng nhập thông tin Mật khẩu',
            captcha: 'Vui lòng nhập thông tin Mã xác thực',
        },
    });
});