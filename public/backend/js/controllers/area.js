$(function () {
    $("#frm").validate({
        rules: {
            name: 'required',
            national_id: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            national_id: 'Vui lòng chọn Quốc Gia',
        }
    });
});