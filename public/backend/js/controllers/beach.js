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
     *  Validate form
     */
     $("#frm").validate({
        rules: {
            name: 'required',
            type: 'required',
            national_id: 'required',
            area_id: 'required',
            province_id: 'required',
        },
        messages: {
            name: 'Vui lòng nhập thông tin Tên',
            type: 'Vui lòng chọn Loại',
            national_id: 'Vui lòng chọn Quốc Gia',
            area_id: 'Vui lòng chọn Miền',
            province_id: 'Vui lòng chọn Tỉnh Thành',
        }
    });
})


