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

function switchAddressUi(obj){
    obj.siblings().find(".radio-address-bg").removeClass("radio-time-bg-checked");
    obj.find(".radio-address-bg").addClass("radio-time-bg-checked");
    obj.siblings().removeClass("checked-address");
    obj.addClass("checked-address");
    obj.siblings().find(".default-head").html("");
    obj.find(".default-head").html("寄送至");
}

function bindAddressUiEvent(){
    //地址选择radio的ui
//    $(".address-tr").click(function(){
//        switchAddressUi($(this));
//        return false;
//    })
//    
//    $(".default-name label").click(function(){
//        switchAddressUi($(this).parents(".address-tr"));
//        return false;
//    });
    
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
}

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
                        $(".btn-invoice").removeAttr('disabled');
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
//保存发票信息按钮点击事件
$(".btn-invoice").click(function(){
    var invcategory = '';
    var invName = '';
    var invType = '';
    if($("#invoice-switch").is(":checked")){
        if($("input[name=invoice-radio]:checked").val() == '个人'){
            invcategory = $("input[name=invoice-radio]:checked").val();
            invName = $("input[name=invoice-radio]:checked").val();
            invType = '1';
        }else if($("input[name=invoice-radio]:checked").val() == '公司'){
            invcategory = $("input[name=invoice-radio]:checked").val();
            invName = $("#invName").val();
            invType = '2';
        }
    }
    
    if(invcategory == ''){
        alert('请选择开票抬头');
        return false;
    }
    if(invName == ''){
        alert('请填写公司名称');
        return false;
    }
    
    if(invName.length >30){
        alert('公司名称长度不能大于30个字符，请修改后提交');
        return false;
    }
    
    $(".save-invoice span").eq(1).html(invcategory);
    $(".save-invoice span").eq(1).attr('invType',invType);
    $(".save-invoice span").eq(2).html(invName);
    $(".save-invoice").show();
    $(".save-invoice").siblings().hide();
    
});
//修改发票信息按钮点击效果
$("#editInvoice").click(function(){
    $(".save-invoice span").eq(1).html("");
    $(".save-invoice span").eq(2).html("");
    
    $(".save-invoice").hide();
    $(".save-invoice").siblings().show();
});

$(function(){
	//实名认证的原因弹出框触发
	$('.thereason').popover({
		trigger: 'hover',
		html:true
	});
        
        $('.promotion-message').popover({
                trigger: 'hover',
		html:true,
                template:'<div class="popover popover-promotion" role="tooltip"><div class="arrow" style="left: 50%;"></div><div class="popover-content"></div></div>'
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
