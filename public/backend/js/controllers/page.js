$(function () {
    $("#frm").validate({
        rules: {
            name: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tiêu đề',
        }
    });
});