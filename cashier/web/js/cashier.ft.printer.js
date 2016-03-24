$(document).ready(function(){
    $(document.body).keydown(function (event) {
        if (event.keyCode == 13) {
            $('#webpos-query-btn').click();
        }
    });
    
    $('#webpos-query-btn').click(function () {
        var inputContent = $.trim($('#webpos-input').val());
        if (!inputContent || inputContent.length == 0) {
            $('#alert').text('输入为空，请检查 ');
            return false;
        }
        //判断inputContent是手机号还是订单号
        var phonePattern = /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
        if (phonePattern.test(inputContent)) {
            queryUserByPhone(inputContent);
        } else {
            $('#alert').text('格式错误，请输入会员手机号 ');
        }
    });
 
});

function queryUserByPhone(userPhone) {
    $.ajax({
        url: URL.queryUser,
        data: {'phone': userPhone},
        dataType: 'json',
        beforeSend: function () {
            $('#loader').show();
            $('#webpos-query-btn').attr('disabled', 'disabled');
        },
        complete: function () {
            $('#webpos-query-btn').removeAttr('disabled');
            $('#loader').hide();
        },
        success: function (data) {
            if (data.code != "200") {
                alert(data.message);
                return;
            } else {
                window.location.href= URL.orderUrl;
            }

        },
        error: function () {
            alert('暂时无法查询用户信息');
        }
    });
}