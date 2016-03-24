$(function(){
	$("input:checkbox").click(function(){
		var _this=$(this);
		if(_this.hasClass("checkall")){
			_this.parents(".goods").find("input:checkbox").prop("checked",_this.prop("checked"));
			return;
		}
		var all=_this.parents(".goods").find("input:checkbox:not(.checkall)").length == _this.parents(".goods").find("input:checked:not(.checkall)").length;
		_this.parents(".goods").find(".checkall").prop("checked",all);
	});
	$(".all-checkbox").click(function(){
		$(this).parents(".goods").find("input:checkbox").prop("checked",true);
		$(this).parents(".goods").find("input:checkbox").parent().addClass("check-checked-bg");
	});
	$(".clear-product").click(function(){
		$(this).parents(".goods").find("input:checkbox").prop("checked",false);
		$(this).parents(".goods").find("input:checkbox").parent().removeClass("check-checked-bg");
	})


	//税率弹出框触发
	$('.product-rate').popover({
		trigger: 'hover',
		html:true
	});

	// 判断关联商品，加边框
	var carttableli=$(".cart-table1-con");
	for(var k=0;k<carttableli.length;k++){
		if($(carttableli[k]).height()>100){
			$(carttableli[k]).find(".product-information").css({
				"border-right":"1px dashed #dcdcdc",
				"border-bottom":"1px dashed #dcdcdc"
			});	
		}
	}
	//判断N选最后一个商品是否是关联商品，决定左边线的高度
	var carttablenli=$(".cart-tablen .cart-tablen-con");
	var tablenliHeight=$(carttablenli[carttablenli.length-1]).height();
	if($(carttablenli[carttablenli.length-1]).height()>100){
		var vlineBottom=tablenliHeight/2+7;
		$(".vline").css({
			"bottom":vlineBottom+'px'
		})
	}
	for(var j=0;j<carttablenli.length;j++){
		if($(carttablenli[j]).height()>100){
			$(carttablenli[j]).find(".product-information").addClass("tablen-br");
		}
	}
	$(".cart-table1-con").has("ul").css('border-bottom', 'none');
	// 判断大于或小于50元，后台需要加事件触发
	var tariffshtml=$(".tariffs-num").html();
	var tariffsnum=tariffshtml.substring(1);
	if(tariffsnum>=50){
		$(".tariffs-notice-arrow").hide();
		$(".tariffs-notice-arrow1").show();
	}else{
		$(".tariffs-notice-arrow1").hide();
		$(".tariffs-notice-arrow").show();
	}
	// 判断下架商品，去掉checkbox
	var cartcon=$(".cart-table1-con");
	for(var j=0;j<cartcon.length;j++){
		if($(cartcon[j]).hasClass("product-soldout")){
			$(cartcon[j]).find(".checkbox-label").remove();
		}
	}	
})

$(".check-bg").click(function(){
	var che=$(".check-bg").children("input");
	for(var i=0;i<che.length;i++){
		if(che[i].checked==true){
			$(che[i]).parent().addClass("check-checked-bg");
		}
		if(che[i].checked==false){
			$(che[i]).parent().removeClass("check-checked-bg");
		}
	}
})