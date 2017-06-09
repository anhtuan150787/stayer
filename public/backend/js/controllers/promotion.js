$(function () {
    $("#frm").validate({
        rules: {
            name: 'required',
            date_apply_from: 'required',
            date_apply_to: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            date_apply_from: 'Vui lòng nhập Ngày áp dụng',
            date_apply_to: 'Vui lòng nhập Ngày áp dụng',
        }
    });
});


