$(function () {
    $("#frm").validate({
        rules: {
            num: 'required',
            group: 'required',

        },
        messages: {
            num: 'Vui lòng nhập số lượng mã',
            group: 'Vui lòng chọn Nhóm mã',
        }
    });
});