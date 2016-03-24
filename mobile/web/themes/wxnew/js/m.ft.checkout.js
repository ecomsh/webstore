$("#address-sure").click(function(){
    var selectedObj = $(".address-item.selected");
    
    var state_code = selectedObj.attr('state');
    var city_code = selectedObj.attr('city');
    var district_code = selectedObj.attr('district');
    var postcode = selectedObj.attr('postcode');
    var currentAddressId = selectedObj.attr('addressId');
    var checkedAddressId = $("#orderForm #addressId").val();
    
    if(selectedObj.length == 0){
        message.alert("请选择地址！");
        return false;
    }
    
    $(".address-list-box").hide();

    if(currentAddressId == checkedAddressId){
        return false;
    }

    var inventorys = getInventory(state_code,city_code,itemInfo);

    if(inventorys == false){
        return false;
    }

    var address = {
        'country_code': 'CN',
        'district_code': district_code,
        'postcode': postcode,
        'city_code': city_code,
        'state_code': state_code,
    };
    var priceStatus = getPrice(address,cartlineIds,selectedCouponId);
    if(priceStatus){
        $("#orderForm #addressId").val(currentAddressId);
        $("#address-list").html($(".address-item.selected .address-info").html());
    }
});

$("#choose-send-sure").click(function(){
    $("#orderForm #shipinst").val($(".send-way.selected input").val());
    $("#order-time div").html($(".send-way.selected label").html());
})

$("#newAddress").click(function(){
    addressCount = $(this).attr('count');
    if(addressCount >= 10){
        message.alert("最多只能保存10条收货地址！");
        return false;
    }
})

//提交订单
$(".go-check-out").click(function(){
    var submitStatus = false;
    if(isCBT == '1' && isRealName == '1'){
        message.alert('请先进行实名认证');
        return false;
    }
    
    if(canSubmit != 1){
        message.alert("海关规定购买多件的总价不能超过￥"+ maxAmount+"请您分多次购买。");
        return false;
    }
    
    if(!checkInv()){
        return false;
    }
    
    var addressId = $("#orderForm #addressId").val();
    var shipinst = '1';     //貌似是快递
    var payType = $("input[name=payType]:checked").val();
    var invcategory =  $("#orderForm #invcategory").val();
    var invName = $("#orderForm #invName").val();
    
    if(!addressId){
        message.alert('请选择地址');
        return false;
    }
    if(!payType){
        message.alert('请选择支付方式');
        return false;
    }
    
    if($(this).attr("isSubmit") == 'F'){
        return false;
    }else{
        $(this).attr("isSubmit",'F');
    }
    
    
    var thisObj = $(this);
    
    $.ajax({
        url: submitUrl,
        data: {
            'cartlineId': cartlineIds,
            'itemInfo': itemIdsInfo,
            'couponId':[selectedCouponId],
            'addressId': addressId,
            'shipInst': shipinst,
            'payType': payType,
            'invCategory': invcategory,
            'invName': invName,
            'orderAmount': orderAmount,
            'channelId' : channelId,
            '_csrf' : _csrf,
        },
        type: 'post',
        async: false, 
        success: function (re) {
            if(re.status === true){
                orderId = re.orderId;
                if(payType == "AliPay"){
                    $("#webOrderId").val(re.orderId);
                    $("#payMethod").val(payType);
                    $("#subject").val(re.orderId);
                    $("#webPayForm").submit();
                }else{
                    $("#orderId").val(re.orderId);
                    $("#payForm").submit();
                }
                submitStatus = true;
            }else{
				if(re.indexOf("baokuanshangpin") > 0)
			    {
					var errorStr = re.replace("baokuanshangpin","");
					message.alert(errorStr);
			    }
			    else
			    {
				   message.alert("结算失败，请稍后再试");
			    }
                thisObj.attr("isSubmit",'T');
                submitStatus = false;
            }
        },
        error: function (e) {
                message.alert("提交失败，请之后再试");
                thisObj.attr("isSubmit",'T');
                submitStatus = false;
        }
    });
    return submitStatus;
});


function checkInv(){
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
        
        if(invcategory == ''){
            message.alert('请选择开票抬头');
            return false;
        }
        if(invName == ''){
            message.alert('请填写公司名称');
            return false;
        }

        if(invName.length >30){
            message.alert('公司名称长度不能大于30个字符，请修改后提交');
            return false;
        }
        
        $("#orderForm #invcategory").val(invType);
        $("#orderForm #invName").val(invName);
    }else{
        $("#orderForm #invcategory").val('');
        $("#orderForm #invName").val('');
    }
    return true;
}





function getPrice(_address,_cartlineIds, couponIds){
    var priceStatus = false;
    var _params = {
        //'address': _address,
        //'couponIds': [],
        'price': true,
        'promotion': true,
        'shipping': false,
        'tax': true,
        '_csrf' : _csrf,
    }
    if(couponIds != null){
        _params['couponIds'] = [couponIds];
    }
    if(_address != null){
        _params['address'] = _address;
        _params['shipping'] = true;
    }
    if(itemIdsInfo != ''){
        _params['dtoItemsInfo'] = itemIdsInfo;
    }else{
        _params['cartlineIds'] = _cartlineIds;
    }
    
    $.ajax({
        url: getPriceUrl,
        data: _params,
        type: 'post',
        async:false, //同步；
        success: function (re) {
            if(!re.itemDetail ||!re.orderDetail ||!re.total)
            {
                message.alert("计算接口异常，请稍后再试");
                priceStatus = false;
            }else{
                $("div.order-total").html('￥' + re.orderDetail[orderType].originalPrice);
                $("span.activity-span").html('-￥' + re.orderDetail[orderType].promotion);
                $("span.freight-span").html('￥' + re.orderDetail[orderType].shipping);
                $("span.order-tariffs").html('￥' + re.orderDetail[orderType].tax);
                $("span.amount-payable").html('￥' + re.orderDetail[orderType].actualPrice);
                if(Number(re.orderDetail[orderType].tax) <= 50){
                    $(".tariffs-msg").html("关税≤50，免征！");
                    $(".order-tariffs").addClass("old-price-tax");
                }else{
                    $(".tariffs-msg").html("");
                    $(".order-tariffs").removeClass("old-price-tax");
                }
             
                if(re.orderDetail[orderType].orderPromotionName){
                    $(".activity1").html("【" + re.orderDetail[orderType].orderPromotionName[0] + "】");
                }else{
                    $(".activity1").html("");
                }
                if(re.orderDetail[orderType].orderFreeShipment){
                    $(".free-activity").html("【" + re.orderDetail[orderType].orderFreeShipment + "】");
                }else{
                     $(".free-activity").html("");
                }
                
                var flag = true;
                $.each(re.itemDetail,function(key,val){
                    if(!val.itemFreeShipment){
                        flag = false;
                        return false;
                    }
                });
                if(flag){
                    $(".free-activity").html("【商品享受包邮活动】");
                }
                canSubmit = re.orderDetail[orderType].canSubmit;
                orderAmount = re.orderDetail[orderType].originalPrice-re.orderDetail[orderType].promotion;
                priceStatus = true;
            }
        },
        error: function (e) {
                message.alert("计算价格失败，请之后再试");
                priceStatus = false;
        }
    });
    return priceStatus;
}

function getInventory(state_code,city_code,itemInfo){
    var status = true;
    $.ajax({
        url: getInventoryUrl,
        async:false, //同步；
        data: {
            '_csrf': _csrf,
            'postData': {
                'itemInfo' : itemInfo,
                'shop' : 'ftzmall',//一期只支持ftzmall
                'country' : 'CN', //一期只支持CN
                'stateCode' : state_code,
                'city' : city_code,
            },
        },
        type: 'post',
        success: function (re) {
            for(var key in re){
                if(re[key] <= 0){
                    status = false;
                    message.alert('订单里包含不支持配送到该地区的商品，请您重新选择收货地址或删除订单里不能配送到该地区的商品');
                    break;
                }
            }
        },
        error: function (e) {
                message.alert("检查库存失败，请之后再试");
                status = false;
        }
    });
    
    return status;
}

//获取当前地址
function getCurrentAddress(){
    
    var addressId = $("#orderForm #addressId").val();
    if(!addressId){
        return null;
    }
    var selectedObj = $('li[addressId ='+ addressId +']');
    var state_code = selectedObj.attr('state');
    var city_code = selectedObj.attr('city');
    var district_code = selectedObj.attr('district');
    var postcode = selectedObj.attr('postcode');
    
    var address = {
        'country_code': 'CN',
        'district_code': district_code,
        'postcode': postcode,
        'city_code': city_code,
        'state_code': state_code,
    };
    return address;
}


$(".coupon-bar").click(function(){
	$(".choose-order-coupon").hide();
        var _address = getCurrentAddress();
        var couponId = $('#coupon_select_list').find('li.selected').attr('couponId');
        if(typeof(couponId) == 'undefinded'){
            selectedCouponId = null;
            getPrice(_address,cartlineIds, selectedCouponId);
        }else{
            selectedCouponId = couponId;
            getPrice(_address,cartlineIds, selectedCouponId);
        } 
})

$('#no-order-coupon').click(function() {
        var _address = getCurrentAddress();
        selectedCouponId = null;
        //$('#coupon_select').val('-1');
        $('#coupon_select_list').find('li.selected').removeClass('selected');
        //$('#coupon_select_list').find('li:first').addClass('selected');
        $('#input-coupon-code').val('');
        getPrice(_address,cartlineIds, selectedCouponId);
    });


function listActiveCoupons(){
    
    var _params = {
        'price': true,
        'promotion': true,
        'shipping': false,
        'tax': true,
        '_csrf' : _csrf,
    }
    var _address = getCurrentAddress();
    if(_address != null){
        _params['address'] = _address;
        _params['shipping'] = true;
    }
    if(itemIdsInfo != ''){
        _params['dtoItemsInfo'] = itemIdsInfo;
    }else{
        _params['cartlineIds'] = cartlineIds;
    }
    $.ajax({
            url: listCouponUrl,
            data: _params,
            type: 'post',
            success: function (re) {   
                if(re.success){
                    var el = $('#coupon_select_list');
                    el.html('');
                    if(re.coupons.length <1){
                        el.append('<li class="coupon-item order-item" couponId="-1">'+ '<label>'+ '没有可用的优惠券' +'</label></li>');
                        return;
                    }
                    //el.append('<li class="coupon-item order-item selected" couponId="-1"> <label>不使用优惠券</label></li>'); 
                    $.each(re.coupons,function(key,value){
                        el.append('<li class="coupon-item order-item" couponId='+ value.couponid +'>'+ '<label>'+ value.rulename +'</label></li>');   
                    });
                    $(".coupon-item").click(function(){
                        $(this).siblings(".coupon-item").removeClass("selected");
                        $(this).addClass("selected");
                    });
                }
            },
            error: function (e) {
                //message.alert("获取优惠券失败，请之后再试");
                var el = $('#coupon_select_list');
                el.html('');
                el.append('<li class="coupon-item order-item" couponId="-1">'+ '<label>'+ '没有可用的优惠券' +'</label></li>');
                return;
            }
        });
}

$("button.code-cancel").click(function(){
    $(".ui-dialog").removeClass("show");
});

$("button.code-sure").click(function(){
    $(".ui-dialog").removeClass("show");
    var couponCode = $(this).parents('div').find(".input-coupons").val();
    if($.trim(couponCode).length<1){
        message.alert('请输入优惠码');//萌妹纸
        return;
    }
    
    var _params = {
        //'address': _address,
        'couponCode': couponCode,
        'price': true,
        'promotion': true,
        'shipping': false,
        'tax': true,
        '_csrf' : _csrf,
    }
    var _address = getCurrentAddress();
    if(_address != null){
        _params['address'] = _address;
        _params['shipping'] = true;
    }
    if(itemIdsInfo != ''){
        _params['dtoItemsInfo'] = itemIdsInfo;
    }else{
        _params['cartlineIds'] = cartlineIds;
    }
    
    $.ajax({
        url: activeCouponUrl,
        data: _params,
        type: 'post',
        success: function (re) {   
            if(re.status == 'p200'){
                selectedCouponId = re.couponId;
                var el = $('#coupon_select_list');
                el.append('<li id="new-coupon-item" class="coupon-item order-item" couponId='+ re.couponid +'>'+ '<label>'+ re.ruleName +'</label></li>');   
                $("#new-coupon-item").click(function(){
                        $(this).siblings(".coupon-item").removeClass("selected");
                        $(this).addClass("selected");
                    });   
                getPrice(_address,cartlineIds, selectedCouponId);
            }
            if(re.errorCode){
                message.alert(re.errorMsg);
            }
        },
        error: function (e) {
            message.alert("激活优惠码失败，请之后再试");
        }
    });
        
})

jQuery(function () {
    listActiveCoupons();
});