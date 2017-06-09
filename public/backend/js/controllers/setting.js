$(function () {
    $("#frm").validate({
        rules: {
            value: 'required',
        },
        messages: {
            value: 'Vui lòng nhập giá trị',
        }
    });
});