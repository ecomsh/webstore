//因组合结构写的不一样，无法封装成同一个
//送货时间点击radio的ui、边框的ui
$(".shipping-time label").click(function(){
	$(this).siblings().children(".radio-time-bg").removeClass("radio-time-bg-checked");
	$(this).siblings().removeClass("radio-time-border");
	$(this).children(".radio-time-bg").addClass("radio-time-bg-checked");
	$(this).addClass("radio-time-border");
})
//支付宝点击radio的ui
$(".alipay-div label").click(function(){
	$(this).siblings().children(".radio-pay-bg").removeClass("radio-time-bg-checked");
	$(this).children(".radio-pay-bg").addClass("radio-time-bg-checked");
})
//优惠券点击radio的ui、点击控制优惠券/优惠码的启用/禁用
$(".coupons label").click(function(){
	$(this).parent().siblings().find(".radio-coupons-bg").removeClass("radio-time-bg-checked");
	$(this).parent().siblings().children("label").siblings().attr("disabled","disabled");
	$(this).children(".radio-coupons-bg").addClass("radio-time-bg-checked");
	$(this).siblings().removeAttr("disabled");
})
//地址选择radio的ui
$(".default-name label").click(function(){
	$(this).parents(".address-tr").siblings().find(".radio-address-bg").removeClass("radio-time-bg-checked");
	$(this).children(".radio-address-bg").addClass("radio-time-bg-checked");
})
//发票部分radio的ui
$(".other-invoice .form-group label").click(function(){
	$(this).siblings().children(".radio-invoice-bg").removeClass("radio-time-bg-checked");
	$(this).children(".radio-invoice-bg").addClass("radio-time-bg-checked");
})
//发票部分点击各个按钮，其他是否可用
$(".check-invoice-bg").click(function(){
	var che=$(".check-invoice-bg").children("input");
	for(var k=0;k<che.length;k++){
		if(che[k].checked==true){
			$(che[k]).parent().addClass("check-invoice-checked");
			$(".other-invoice").find("label").find("input").removeAttr("disabled");
		}
		if(che[k].checked==false){
			$(che[k]).parent().removeClass("check-invoice-checked");
			$(".other-invoice").find(".radio-invoice-bg").children("input").attr("disabled","disabled");
			$(".invoice-inf").find(".radio-invoice-bg").removeClass("radio-time-bg-checked");
			$(".company-name").attr("disabled","disabled");
			$(".company-name").val("");
		}
	}
})
//开票抬头公司部分的控制
$(".radio-invoice-bg").click(function(){
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
//收货地址鼠标滑过的效果
$(".address-tr").hover(
	function(){	
		$(this).addClass("address-tr-hover");
		$(this).find(".shipping-operation span").hide();
		$(this).find(".shipping-operation a").show();
	},
	function(){
		$(this).removeClass("address-tr-hover");
		$(this).find(".shipping-operation a").hide();
		$(this).find(".shipping-operation span").show();
	}
)

$(function(){
	//实名认证的原因弹出框触发
	$('.thereason').popover({
		trigger: 'hover',
		html:true
	});
	//页面加载时，给选中的radio加ui的美化效果
	var radio2=$("input[type=radio]");
	for(var i=0;i<radio2.length;i++){
		if(radio2[i].checked){
			$(radio2[i]).parent().addClass("radio-time-bg-checked");
		}
	}
	//页面加载时，给选中的checkout加ui的美化效果
	var checkbox=$("input[type=checkbox]");
	for(var j=0;j<checkbox.length;j++){
		if(checkbox[j].checked==true){
			$(checkbox[j]).parent().addClass("check-invoice-checked");
		}
	}

	// 判断关联商品，加边框
	var carttableli=$(".cart-table1-con");
	for(var k=0;k<carttableli.length;k++){
		if($(carttableli[k]).height()>70){
			$(carttableli[k]).find(".product-cell").css("border-bottom","1px solid #e1e1e1");
			$(carttableli[k]).find(".product-price").css({
				"border-right":"1px solid #e1e1e1",
				"border-bottom":"1px solid #e1e1e1"
			});
			
		}
	}
	
})