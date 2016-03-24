$(function(){
	$(".check-box input").click(function(){
		var _this=$(this);
		if(_this.hasClass("checkall")){
			_this.parents(".cart-list").find(".check-box").children("input").prop("checked",_this.prop("checked"));
			return;
		}
		var all=_this.parents(".cart-list").find(".check-box").children("input").not(".checkall").length == _this.parents(".cart-list").find(".check-box").children("input:checked").not(".checkall").length;
		_this.parents(".cart-list").find(".checkall").prop("checked",all);
	});

	var orderitem=$(".order-item");
	for(var i=0;i<orderitem.length;i++){
		if($(orderitem[i]).find(".product-img").length>1){
			$(orderitem[i]).find(".product-img").css({
				"border-bottom":"1px solid #e1e1e1"
			});
			$(orderitem[i]).find(".product-info").css({
				"border-bottom":"1px solid #e1e1e1"
			});
		}
			
	}
	for(var j=0;j<orderitem.length;j++){
		if($(orderitem[j]).hasClass("product-soldout")){
			$(orderitem[j]).find(".check-box").remove();
			$(orderitem[j]).prepend("<div class='dis-check'>无效</div>");
		}
	}

})
$(".check-box").click(function(){
	var che=$(".check-box").children("input");
	for(var i=0;i<che.length;i++){
		if(che[i].checked==true){
			$(che[i]).parent().addClass("selected");
		}
		if(che[i].checked==false){
			$(che[i]).parent().removeClass("selected");
		}
	}
})


$(".goto-check").click(function(){
	$(".more-information").show();
})
$(".more-information .btn-bar-right").click(function(){
	$(".more-information").hide();
})


$(".edit").click(function(){
	$(".item-center").hide();
	$(".edit").hide();
	$(".product-item .product-price").css("width","8rem");
	$(".over").show();
	$(".product-num").show();
	$(".product-del").show();
})
$(".over").click(function(){
	$(".product-num").hide();
	$(".product-del").hide();
	$(".over").hide();
	$(".product-item .product-price").css("width","auto");
	$(".edit").show();
	$(".item-center").show();
})