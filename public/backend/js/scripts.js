$(function () {
    //Check all  
    $(".checkbox-all").change(function () {
        var chec = false;
        if ($(this).is(":checked"))
        {
            chec = true;
        }
        $(".checkbox-item").prop('checked', chec);
    });

    //Change status
    $(".img_status").click(function () {
        var _this = $(this);
        var data = jQuery.parseJSON(_this.attr('params'));
        var url = $("#frm").attr('action');

        $.ajax({
            url: url + '/change_status',
            data: data,
            type: 'get',
            success: function (result) {
                var data_response = jQuery.parseJSON(result);
                var img;

                if (data_response.result == 1)
                {
                    if (data_response.status == 1)
                        img = "tick-circle.png";
                    else
                        img = "disabled.png";

                    $(_this).attr('src', base_url + 'public/backend/img/' + img);
                }
            }
        });
    });
    
    /*
     *  Tinymce
     */
    $(".load_script").html('<script type="text/javascript" src="' + base_url + 'public/backend/js/tinymce/tinymce.min.js"></script>');
     
    if ($(".description").length)
    {
        tinymce.init({
            selector: "textarea.description", theme: "modern", height: 200,
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        });
    }
    
    if ($(".content").length)
    {
        tinymce.init({
            selector: "textarea.content", theme: "modern", height: 200,
            font_size_style_values: ["6px,7px,8px,9px,10px,11px,12px,13px,14px,15px,16px,17px,18px,19px,20px,21px,22px,23px,24px,25px,26px,27px,28px,29px,30px,31px,32px,36px,38px,40px"],
            //document_base_url: "http://localhost/tour_nhan/",
            relative_urls: false,
             plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code",
             "textcolor"
             ],
             
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | fontsizeselect",
            image_advtab: true,
            external_filemanager_path: tinymce_filemanager_path,
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": tinymce_filemanager_path + "plugin.min.js"}
        });
    }
});

/*
 *  Confirm delete
 */
function confirm_delete()
{
    if (confirm('Bạn có chắc muốn xóa?'))
    {
        return true;
    }
    return false;
}

/*
 *  Confirm action
 */
function confirm_action()
{
    var list_action_value = $("#list_action").val();
    var url = $("#frm").attr('action');

    if (list_action_value == '')
    {
        alert('Vui lòng chọn thao tác để thực hiện.')
        return false;
    }
    else if (list_action_value == 'delete')
    {
        if ($(".checkbox-item:checked").length == 0)
        {
            alert('Vui lòng chọn đối tượng cần xóa.');
            return false;
        }
    }

    $("#frm").attr('action', url + '/delete');
    return true;
}

/**
 * Ajax load province
 */
function load_province(area_id) {
    $("select[name='province_id']").attr("disabled", "disabled");

    $.ajax({
        url: host_url + 'backend/api/load_province',
        data: {area_id : area_id, csrf_test_name : csrf_test_name},
        type: 'post',
        success: function (data)
        {
            if (data != '')
            {
                $("select[name='province_id']").removeAttr("disabled");

                $("select[name='province_id']").html(data);
            }

        }
    });
}

/**
 * Ajax load area
 */
function load_area(national_id) {
    $("select[name='area_id']").attr("disabled", "disabled");

    $.ajax({
        url: host_url + 'backend/api/load_area',
        data: {national_id: national_id, csrf_test_name: csrf_test_name},
        type: 'post',
        success: function (data)
        {
            if (data != '')
            {
                $("select[name='area_id']").removeAttr("disabled");

                $("select[name='area_id']").html(data);
            }

        }
    });
}

/**
 * Ajax load district
 */
function load_district(province_id) {
    $("select[name='district_id']").attr("disabled", "disabled");

    $.ajax({
        url: host_url + 'backend/api/load_district',
        data: {province_id : province_id, csrf_test_name : csrf_test_name},
        type: 'post',
        success: function (data)
        {
            if (data != '')
            {
                $("select[name='district_id']").removeAttr("disabled");

                $("select[name='district_id']").html(data);
            }

        }
    });
}

/**
 * Ajax load ward
 */
function load_ward(district_id) {
    $("select[name='ward_id']").attr("disabled", "disabled");

    $.ajax({
        url: host_url + 'backend/api/load_ward',
        data: {district_id : district_id, csrf_test_name : csrf_test_name},
        type: 'post',
        success: function (data)
        {
            if (data != '')
            {
                $("select[name='ward_id']").removeAttr("disabled");

                $("select[name='ward_id']").html(data);
            }

        }
    });
}

/**
 * Ajax load geonear
 */
function load_geonear(district_id) {
    $("select[name='geonear_id']").attr("disabled", "disabled");

    $.ajax({
        url: host_url + 'backend/api/load_geonear',
        data: {district_id : district_id, csrf_test_name : csrf_test_name},
        type: 'post',
        success: function (data)
        {
            if (data != '')
            {
                $("select[name='geonear_id']").removeAttr("disabled");

                $("select[name='geonear_id']").html(data);
            }

        }
    });
}

/**
 * Ajax load sight
 */
function load_sight(district_id) {
    $("select[name='sight_id']").attr("disabled", "disabled");

    $.ajax({
        url: host_url + 'backend/api/load_sight',
        data: {district_id : district_id, csrf_test_name : csrf_test_name},
        type: 'post',
        success: function (data)
        {
            if (data != '')
            {
                $("select[name='sight_id']").removeAttr("disabled");

                $("select[name='sight_id']").html(data);
            }

        }
    });
}

/**
 * Ajax load beach
 */
function load_beach(province_id) {
    $("select[name='beach_id']").attr("disabled", "disabled");

    $.ajax({
        url: host_url + 'backend/api/load_beach',
        data: {province_id : province_id, csrf_test_name : csrf_test_name},
        type: 'post',
        success: function (data)
        {
            if (data != '')
            {
                $("select[name='beach_id']").removeAttr("disabled");

                $("select[name='beach_id']").html(data);
            }

        }
    });
}

function addCommas(str)
{
	str = str.trim();
	str = str.replace(/\./g, '');
	if (str.length > 12)
		str = str.substring(0, 12);
	//str = Left(str,12);
	//alert(str);
	var ret = '';
	var i = str.length;
	while (i > 3) {
		ret = '.' + str.substr(i - 3, i) + ret;
		str = str.substr(0, i - 3);
		i = str.length;

	}
	if (i > 0)
		ret = '.' + str + ret;
	//echo $str;
	return ret.substr(1);

}

function removeCommas(str)
{
	return str.replace(/\./g, '');
}