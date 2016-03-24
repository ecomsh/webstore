//支付宝点击radio的ui
$(".alipay-div input").click(function(){
    var payType = $(this).val();
    $("#payMethod").val(payType);
    if(payType == 'AliPay'){
        $("#payBtn").html("用支付宝去支付");
    }else if(payType == 'TenPay'){
        $("#payBtn").html("用财付通去支付");
    }
})
