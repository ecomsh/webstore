$(".payBtn").click(function(){
    var orderId = $(this).attr('orderId');
    $("#subject").val(orderId);
    $("#orderId").val(orderId);
    $("#payForm").submit();
})