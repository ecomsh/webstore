$(document).ready(function () {
    $('#btn-activation').click(function()
    {
        var couponCode = $("input#coupon-code").val();
        if($.trim(couponCode).length<1){
            message.alert('请先输入优惠码');
            return;
        }


        var _params = {
             '_csrf': _csrf,
            'couponCode': couponCode,
        }

        $.ajax({
            url: activateCouponUrl,
            data: _params,
            type: 'post',
            success: function (re) {   
                if(re.result == true){
                    message.info("成功激活优惠码");
                    window.location.href = refreshUrl;
                }
                else{
                    message.alert(re.errmsg);
                }
            },
            error: function (e) {
                message.alert("激活优惠码失败，请稍后再试");
            }
        });

    });
});