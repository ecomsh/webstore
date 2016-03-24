
//支付宝点击radio的ui
$(".alipay-div label").click(function(){
	$(this).siblings().children(".radio-pay-bg").removeClass("radio-time-bg-checked");
	$(this).children(".radio-pay-bg").addClass("radio-time-bg-checked");
})

$(function(){
    //实名认证的原因弹出框触发
    $('.thereason').popover({
        trigger: 'hover',
        html:true
    });
})

$("#closeWin").click(function(){
    window.location.reload();
//    $('#myModal').modal('hide');
});