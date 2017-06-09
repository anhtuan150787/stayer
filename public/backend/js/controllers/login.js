$().ready(function () {
    $("#frmLogin").validate({
        rules: {
            username: 'required',
            password: 'required',
            captcha: 'required',
        },
        messages: {
            username: 'Vui lòng nhập thông tin Tài khoản',
            password: 'Vui lòng nhập thông tin Mật khẩu',
            captcha: 'Vui lòng nhập thông tin Mã xác thực',
        },
    });
    
    /*
     *  Reload captcha
     */
    $(".reload_captcha").click(function(){
        
        var _this = $(this);
        
        $.ajax({
            url: host_url + 'backend/api/reload_captcha',
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
});