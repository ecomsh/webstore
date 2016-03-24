$(function(){
	var orderitem=$(".order-item");
	for(var i=0;i<orderitem.length;i++){
		if($(orderitem[i]).find(".product-item").length>1){
			$(orderitem[i]).find(".product-item").css({
				"border-right":"1px solid #e1e1e1",
				"border-bottom":"1px solid #e1e1e1"
			});
		}
			
	}
})

$("#address-list").click(function(){
	$(".address-list-box").show();
})

$("#address-cancel").click(function(){
    $(".address-list-box").hide();
});
$(".address-item").click(function(){
	$(this).siblings(".address-item").removeClass("selected");
	$(this).addClass("selected");
})
$("#order-time").click(function(){
	$(".choose-send-way").show();
	$(".send-ways").addClass("send-ways-show");
})
$("#choose-send-sure").click(function(){
	$(".send-ways").removeClass("send-ways-show");
	$(".choose-send-way").hide();
})

$("#choose-send-cancel").click(function(){
    $(".send-ways").removeClass("send-ways-show");
    $(".choose-send-way").hide();
})

$(".send-way").click(function(){
	$(this).siblings(".send-way").removeClass("selected");
	$(this).addClass("selected");
})
$(".check-box").click(function(){
	$(this).parents(".payitem").siblings().removeClass("selected");
	$(this).parents(".payitem").addClass("selected");
	
})
$(".radio-div .check-box").click(function(){
	$(this).parents(".radio-div").siblings(".radio-div").removeClass("selected");
	$(this).parents(".radio-div").addClass("selected");
})
$("#order-coupon").click(function(){
	$(".choose-order-coupon").show();
})

$("#order-coupon-code").click(function(){
	$(".ui-dialog").addClass("show");
});




$(".checkbox-div .check-box").click(function(){
	var che=$(".checkbox-div .check-box").children("input");
	for(var k=0;k<che.length;k++){
		if(che[k].checked==true){
			$(che[k]).parents(".checkbox-div").addClass("selected");
			$(".radio-div").find(".check-box").find("input").removeAttr("disabled");
		}
		if(che[k].checked==false){
			$(che[k]).parents(".checkbox-div").removeClass("selected");
			$(".radio-div").find(".check-box").children("input").attr("disabled","disabled");
			$(".radio-div").removeClass("selected");
			$(".company-name").attr("disabled","disabled");
			$(".company-name").val("");
		}
	}
})

$(".radio-div .check-box").click(function(){
	var comradio=$(".company-radio");
	for(var k=0;k<comradio.length;k++){
		if(comradio[k].checked==true){
			$(".company-name").removeAttr("disabled");
		}
		if(comradio[k].checked==false){
			$(".company-name").attr("disabled","disabled");
			$(".company-name").val("");
		}
	}
})