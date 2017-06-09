$(function () {
    $("select[name=status]").change(function(){
        if ($(this).val() == 6)	//Thanh cong
        {
            $("#send_mail").show();
        }
        else
        {
            $("#send_mail").hide();
        }
    });

    if (document.getElementById('count_order_wait_process'))
    {

        setInterval(function(){

            $.ajax({
                url: host_url + 'backend/api/count_tour_order_wait_process',
                data: {csrf_test_name: csrf_test_name},
                type: 'post',
                success: function (data)
                {
                    $("#count_order_wait_process").html(data);
                }
            });

        }, 3000);
    }

    $("#paid_select").change(function(){
        if ($(this).val() == 2)
            $("#deposit_content").show();
        else
            $("#deposit_content").hide();
    });

});