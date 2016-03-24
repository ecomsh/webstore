$(document).ready(function(){
    $(document.body).keydown(function (event) {
        if (event.keyCode == 13) {
            $('#queryOrder').click();
        }
    });
    
    $('#queryOrder').click(function () {
        var startDate = $("#startdate").val();
        var endDate = $("#enddate").val();
        alert(startDate);
        alert(endDate);
//        var orderSearch
//        $.ajax({
//        url: URL.queryUser,
//        data: {'phone': userPhone},
//        dataType: 'json',
//        beforeSend: function () {
//            $('#loader').show();
//            $('#webpos-query-btn').attr('disabled', 'disabled');
//        },
//        complete: function () {
//            $('#webpos-query-btn').removeAttr('disabled');
//            $('#loader').hide();
//        },
//        success: function (data) {
//            if (data.code != "200") {
//                alert(data.message);
//                return;
//            } else {
//                window.location.href= URL.orderUrl;
//            }
//
//        },
//        error: function () {
//            alert('暂时无法查询用户信息');
//        }
//    });
        
    });
 
});
