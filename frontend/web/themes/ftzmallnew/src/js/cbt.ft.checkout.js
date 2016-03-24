function closeGo(){
    window.location.href = orderListUrl;
}

function closeWindow(){
    window.location.href = paymentUrl + orderId;
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
                var orderTotal = (parseFloat(re.orderDetail[orderType].originalPrice)+parseFloat(newOfferPrice));
                var activityPrice = (parseFloat(re.orderDetail[orderType].promotion)+parseFloat(newOfferPrice));
                
                $("span.order-total").html('￥' + orderTotal.toFixed(2));
                $("span.activity-span").html('-￥' + activityPrice.toFixed(2));
                $("span.freight-span").html('￥' + re.orderDetail[orderType].shipping);
                $("span.order-tariffs").html('￥' + re.orderDetail[orderType].tax);
                $("span.amount-payable").html('￥' + re.orderDetail[orderType].actualPrice);
                $("#actualPrice").html('￥' + re.orderDetail[orderType].actualPrice);
                $("#oldActualPrice").html('￥' + re.orderDetail[orderType].actualPrice);
                if(re.orderDetail[orderType].orderPromotionName){
                    if(re.orderDetail[orderType].orderPromotionName.length > 1){
                        $(".promotion-message").html("您参加了"+ re.orderDetail[orderType].orderPromotionName.length +"种活动");
                        $(".promotion-message").attr('data-content',re.orderDetail[orderType].orderPromotionName.join("<BR>"));
                        $(".promotion-message").siblings().hide();
                        $(".promotion-message").show();
                    }else{
                        $(".promotion-message").siblings().html("您参加了 【" + re.orderDetail[orderType].orderPromotionName[0] + "】 的活动");
                        $(".promotion-message").siblings().show();
                        $(".promotion-message").hide();
                        
                    }
                }else{
                    $(".promotion-message").html("");
                    $(".promotion-message").hide();
                    $(".promotion-message").siblings().hide();
                }
                if(Number(re.orderDetail[orderType].tax)<50){
                    $(".tax-message").html("关税≤50，免征！");
                    $("span.order-tariffs").addClass('price-line');
                }else{
                    $(".tax-message").html("");
                    $("span.order-tariffs").removeClass('price-line');
                }
                if(re.orderDetail[orderType].orderFreeShipment){
                    $(".free-activity").html("【" + re.orderDetail[orderType].orderFreeShipment + "】");
                }else{
                    $(".free-activity").html("");
                }
                
                $('.promotion-message').popover({
                    trigger: 'hover',
                    html:true,
                    template:'<div class="popover popover-promotion" role="tooltip"><div class="arrow" style="left: 50%;"></div><div class="popover-content"></div></div>'
                });
                
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

function getPromotionContent(){
    console.log($(".promotion-message").attr("promotion-content"));
    return $(".promotion-message").attr("promotion-content");
}

function realnameSuccess(json){
    var json_obj = eval(json);
    if(!json_obj.code && json_obj.code != 0){
        if(json_obj.status){
            $("#realnameInfo").show();
            $("#realnameForm").hide();
            $("#realname-name").html(json_obj.info.realName);
            $("#realname-phone").html(json_obj.info.mobile);
            $("#realname-email").html(json_obj.info.email);
            $("#realname-card").html(json_obj.info.identityNumber);
            isCBT = '0';
            isRealName = '0';
        }else{
            message.alert(json_obj.message.split("</br>")[0]);
        }
    }else{
        message.alert(json_obj.message.split("</br>")[0]);
    }
}

function addressEditSuccess(json){
    var json_obj = eval(json);
    if(!json_obj.code && json_obj.code != 0){
        if(json_obj.status){
            var inputObj = $("input[value="+json_obj.info.addressId+"]");
            inputObj.attr('district',json_obj.info.districtCode);
            inputObj.attr('state',json_obj.info.stateCode);
            inputObj.attr('city',json_obj.info.cityCode);
            inputObj.attr('postcode',json_obj.info.postcode);
            inputObj.parents(".address-tr").find(".default-tel").html(json_obj.info.receiverMobile);
            inputObj.parents(".address-tr").find(".receiverName").html(json_obj.info.receiverName);
            inputObj.parents(".address-tr").find(".default-add-detail").html(json_obj.info.address);
            $("#myModal2").modal('hide');
        }else{
            message.alert(json_obj.message.split("</br>")[0]);
        }
    }else{
        message.alert(json_obj.message.split("</br>")[0]);
    }
}

function addressCreateSuccess(json){
    var json_obj = eval(json);
    if(!json_obj.code && json_obj.code != 0){
        if(json_obj.status){
            $(".address-tr").find(".radio-address-bg").removeClass("radio-time-bg-checked");
            $(".address-tr").removeClass("checked-address");
            $(".address-tr").find(".default-head").html("");
            
            var html = "\
                <tr class=\"address-tr\" style=\"z-index:0\">\n\
                    <td class=\"default-head\"></td>\n\
                    <td class=\"default-name\">\n\
                        <label>\n\
                            <span class=\"radio-address-bg\">\n\
                                <input type=\"radio\" name=\"address\" id=\"shipping-time1\" class=\"radio-time\" autocomplete=\"off\" value=\""+json_obj.info.addressId+"\" district=\""+json_obj.info.districtCode+"\" state=\""+json_obj.info.stateCode+"\" city=\""+json_obj.info.cityCode+"\" postcode=\""+json_obj.info.postcode+"\">\n\
                            <\/span>\n\
                            "+json_obj.info.receiverName+"\n\
                        <\/label>\n\
                    <\/td>\n\
                    <td class=\"default-tel\">"+json_obj.info.receiverMobile+"<\/td>\n\
                    <td class=\"default-add-detail\">"+json_obj.info.address+"<\/td>\n\
                    <td class=\"shipping-operation\">\n\
                        <a class=\"operation1 setDefault\">设为默认地址<\/a>\n\
                        <a name=\"editAddress\" class=\"operation2\" modalHref=\""+addressEditUrl+json_obj.info.addressId+"\">修改本地址<\/a>\n\
                        <a class=\"operation3\">删除<\/a>\n\
                    <\/td>\n\
                <\/tr>\n\
            ";
            $("#addressList tbody").append(html);
            $('#myModal').modal('hide');
            bindAddressUiEvent();
            bindAddressEvent();
            addressObj = $("input[name=address][value="+json_obj.info.addressId+"]").parents(".address-tr");
            switchAddress(addressObj);
            //判断添加地址form表单是否显示，如显示，则隐藏，并显示列表与按钮
            if($("#addAddressForm").is(":visible") == true){
                $(".btn-newaddress").show();
                $("#addressList").show();
                $("#addAddressForm").hide();
            }
        }else{
            message.alert(json_obj.message.split("</br>")[0]);
            $("#w1").attr('isSubmit','T');
        }
    }else{
        message.alert(json_obj.message.split("</br>")[0]);
        $("#w1").attr('isSubmit','T');
    }
}

function switchAddress(obj){
    var state_code = obj.find(".radio-time").attr('state');
    var city_code = obj.find(".radio-time").attr('city');
    var district_code = obj.find(".radio-time").attr('district');
    var postcode = obj.find(".radio-time").attr('postcode');
    var currentAddressId = obj.find(".radio-time").val();

    if(currentAddressId == checkedAddressId){
        return false;
    }
    
    $(".btn-sure").addClass("disabled");
    $(".btn-sure").attr("disabled",true);

    var inventorys = getInventory(state_code,city_code,itemInfo);

    if(inventorys == false){
        $(".btn-sure").removeClass("disabled");
        $(".btn-sure").attr("disabled",false);
        return false;
    }

    var address = {
        'country_code': 'CN',
        'district_code': district_code,
        'postcode': postcode,
        'city_code': city_code,
        'state_code': state_code,
    };
    var price = getPrice(address,cartlineIds,selectedCouponId);
    if(price == false){
        $(".btn-sure").removeClass("disabled");
        $(".btn-sure").attr("disabled",false);
        return false;
    }else{
        switchAddressUi(obj);
//        $("input[name=address][value="+currentAddressId+"]").attr("checked",true);
        checkedAddressId = currentAddressId;
    }
    
    $(".btn-sure").removeClass("disabled");
    $(".btn-sure").attr("disabled",false);
}

//提交订单
$("#payForm").submit(function(){
    var submitStatus = false;
    if(isCBT == '1' && isRealName == '1'){
        message.alert('请先进行实名认证');
        return false;
    }
    
    if(canSubmit != 1){
        message.alert("海关规定购买多件的总价不能超过￥" +maxAmount+ "请您分多次购买。");
        return false;
    }
    
    if(checkedAddressId == ""){
        checkedAddressId = $("input[name=address]:checked").val();
    }
    var shipinst = '1';
    var invcategory =  $(".save-invoice span").eq(1).attr('invType');
    var invName = $(".save-invoice span").eq(2).html();
    
    if(!checkedAddressId){
        message.alert('请选择地址');
        return false;
    }
    
    if($("#invoice-switch").is(":checked")){
        if(invcategory == '' || invName == ''){
            message.alert('请先保存发票信息');
            return false;
        }
    }else{
        //如果复选框没有被选中，则把发票信息设置为空
        invcategory = '';
        invName = '';
    }
    
    if($(this).attr("isSubmit") == 'F'){
        return false;
    }else{
        $(this).attr("isSubmit",'F');
        $(this).find("button").css('background','#333');
        $(this).find("button").html('正在提交...');
    }
    
    var thisObj = $(this);
    
    $.ajax({
        url: submitUrl,
        data: {
            'cartlineId': cartlineIds,
            'itemInfo': itemIdsInfo,
            'couponId':[selectedCouponId],
            'addressId': checkedAddressId,
            'shipInst': shipinst,
            'invCategory': invcategory,
            'invName': invName,
            'orderAmount': orderAmount,
            '_csrf' : _csrf,
        },
        type: 'post',
        async: false, 
        success: function (re) {
            if(re.status === true){
                orderId = re.orderId;
                $("#orderId").val(re.orderId);
                thisObj.find("button").css('background','#e81a62');
                thisObj.find("button").html('提交成功');
                submitStatus = true;
            }else{
                message.alert(re.message);
                thisObj.attr("isSubmit",'T');
                thisObj.find("button").css('background','#e81a62');
                thisObj.find("button").html('确认交易');
                submitStatus = false;
            }
			
			if(re.indexOf("baokuanshangpin") > 0)
		   {
				var errorStr = re.replace("baokuanshangpin","");
				message.alert(errorStr);
		   }
        },
        error: function (e) {
                message.alert("提交失败，请之后再试");
                thisObj.attr("isSubmit",'T');
                thisObj.find("button").css('background','#e81a62');
                thisObj.find("button").html('确认交易');
                submitStatus = false;
        }
    });
    return submitStatus;
});

function bindAddressEvent(){
    //点击选择地址后的获取库存和计算价格
    //$(".default-name label").click(function(){
    $(".address-tr").click(function(){
        switchAddress($(this));
        return false;
    });
    
    $(".default-name label").click(function(){
        switchAddress($(this).parents(".address-tr"));
        return false;
    });

    //删除地址
    $(".operation3").click(function(){
        var addressId = $(this).parents(".address-tr").find(".radio-time").val();
        var thisObj = $(this);
        $.ajax({
            url: addressDeleteUrl,
            data: {
                '_csrf': _csrf,
                'addressId': addressId,
            },
            type: 'post',
            success: function (re) {
                if(re.status)
                {
                    thisObj.parents(".address-tr").remove();
                    return false;
                }else{
                    message.alert(re.message);
                    return false;
                }
            },
            error: function (e) {
                    message.alert("删除失败，请之后再试");
                    return false;
            }
        });
    });

    //设置默认地址
    $(".setDefault").click(function(){
        if($(this).attr("disabled")){
            return false;
        }
        $(this).attr("disabled","ture");
        var addressId = $(this).parents(".address-tr").find(".radio-time").val();
        var thisObj = $(this);
        $.ajax({
            url: addressSetDefaultUrl,
            data: {
                '_csrf': _csrf,
                'addressId': addressId,
            },
            type: 'post',
            async: false, 
            success: function (re) {
                if(re.status)
                {
                    $(".address-tr").find(".shipping-operation .unsetDefault").after("<a class=\"operation1 setDefault\">设为默认地址</a>");
                    $(".address-tr").find(".shipping-operation .unsetDefault").remove();
                    $(".address-tr").find(".shipping-operation span").remove();
                    thisObj.parents(".address-tr").find(".shipping-operation").prepend("<span>默认地址</span><a class=\"operation1 unsetDefault\">取消默认地址</a>");
                    thisObj.parents(".address-tr").find(".setDefault").remove();
                    bindAddressEvent();
                    return false;
                }else{
                    $(this).removeAttr("disabled");
                    message.alert(re.message);
                    return false;
                }
            },
            error: function (e) {
                    $(this).removeAttr("disabled");
                    message.alert("设置失败，请之后再试");
                    return false;
            }
        });
        return false;
    });

    //取消默认地址
    $(".unsetDefault").click(function(){
        if($(this).attr("disabled")){
            return false;
        }
        $(this).attr("disabled","ture");
        var addressId = $(this).parents(".address-tr").find(".radio-time").val();
        $.ajax({
            url: addressUnSetDefaultUrl,
            data: {
                '_csrf': _csrf,
                'addressId': addressId,
            },
            type: 'post',
            async: false, 
            success: function (re) {
                if(re.status)
                {
                    $(".unsetDefault").parents(".address-tr").find(".shipping-operation").prepend("<a class=\"operation1 setDefault\">设为默认地址</a>");
                    $(".unsetDefault").parents(".address-tr").find(".shipping-operation .unsetDefault").remove();
                    $(".setDefault").parents(".address-tr").find(".shipping-operation span").remove();
                    bindAddressEvent();
                    return false;
                }else{
                    $(this).removeAttr("disabled");
                    message.alert(re.message);
                    return false;
                }
            },
            error: function (e) {
                    $(this).removeAttr("disabled");
                    message.alert("取消失败，请之后再试");
                    return false;
            }
        });
    });
    
    //点击修改地址后的弹窗
    $("a[name=editAddress]").click(function(){
        $("#myModal2").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
        });
        var href = $(this).attr('modalHref');
        $("#myModal2").modal({
            remote: href
        });
        return false;
    });
}


//优惠券部分

function checkCoupons()
{
    var _params = {
        'cartlineIds':_cartlineIds,
        'address': _address,
        'couponIds': [],
        'price': true,
        'promotion': true,
        'shipping': true,
        'tax': true,
        '_csrf' : _csrf,
    }
    $.ajax({
        url: getPriceUrl,
        data: _params,
        type: 'post',
        success: function (re) {
            if(!re.itemDetail ||!re.orderDetail ||!re.total)
            {
                message.alert("计算接口异常，请稍后再试");
                return;
            }else{
                $("span .order-total").html('￥' + re.orderDetail[orderType].originalPrice);
                $("span .activity-span").html('-￥' + re.orderDetail[orderType].promotion);
                $("span .freight-span").html('￥' + re.orderDetail[orderType].shipping);
                $("span .order-tariffs").html(re.orderDetail[orderType].realTax);
                $("span .amount-payable").html('￥' + re.orderDetail[orderType].actualPrice);
                $("#actualPrice").html('￥' + re.orderDetail[orderType].actualPrice);
                $("#oldActualPrice").html('￥' + re.orderDetail[orderType].actualPrice);
                canSubmit = re.orderDetail[orderType].canSubmit;
            }
        },
        error: function (e) {
                message.alert("计算价格失败，请之后再试");
                status = false;
        }
    });
}

//获取当前地址
function getCurrentAddress(){
    
    if(checkedAddressId == ""){
        checkedAddressId = $("input[name=address]:checked").val();
    }
    if(checkedAddressId == "" || typeof(checkedAddressId) == 'undefined'){
        return null;
    }
    var addressObj = $("input[name=address][value="+checkedAddressId+"]");
    var state_code = addressObj.attr('state');
    var city_code = addressObj.attr('city');
    var district_code = addressObj.attr('district');
    var postcode = addressObj.attr('postcode');  
    var _address = {
        'country_code': 'CN',
        'district_code': district_code,
        'postcode': postcode,
        'city_code': city_code,
        'state_code': state_code,
    };
    return _address;
}

// 展示改订单可用的优惠券
function listActiveCoupons(){
    
    var _params = {
        //'address': _address,
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
                    var el = $('.coupons').find('select');
                    $.each(re.coupons,function(key,value){
                        el.append('<option '+ ' value = '+ value.couponid +'>'+value.rulename+'</option>');   
                    });
                }
                //$('#coupon_select').val('-1');
            },
            error: function (e) {
                //message.alert("获取优惠券失败，请之后再试");
            }
        });
}
$('#coupons3').click(function() {
        var _address = getCurrentAddress();
        selectedCouponId = null;
        $('#coupon_select').val('-1');
        $('#coupon_code').val('');
        getPrice(_address,cartlineIds, selectedCouponId);
    });

$('#coupon_select').change(function() {
    
        var _address = getCurrentAddress();
        var couponId = $(this).val();
        if(couponId == '-1'){
            selectedCouponId = null;
            getPrice(_address,cartlineIds, selectedCouponId);
        }else{
            selectedCouponId = couponId;
            getPrice(_address,cartlineIds, selectedCouponId);
        } 
});
//$('#coupon_code').keyup(function(){
//    $(this).val($(this).val().toUpperCase());
//});
$('.btn-activation').click(function()
{
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
                var el = $('.coupons').find('select');
                el.append('<option '+ ' value = '+ re.couponId +'>'+re.ruleName+'</option>');   
                getPrice(_address,cartlineIds, selectedCouponId);
                //message.info("成功应用促销: " + re.ruleName);
            }
            if(re.errorCode){
                message.alert(re.errorMsg);
            }
        },
        error: function (e) {
            message.alert("激活优惠码失败，请之后再试");
        }
    });
   
});

$("#invoice-switch").click(function(){
    $(".invoice-inf").toggle();
});

jQuery(function () {

bindAddressEvent();
bindAddressUiEvent();

preSelect(stateCode,cityCode,districtCode,
                        '#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');//preselect("四川省","成都市","金牛区");//设置默认选项
initCountry('#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');

preSelect(stateCode,cityCode,districtCode,
                        '#addressapi_statecode', '#addressapi_citycode', '#addressapi_districtcode', '#addressapi_address');//preselect("四川省","成都市","金牛区");//设置默认选项
initCountry('#addressapi_statecode', '#addressapi_citycode', '#addressapi_districtcode', '#addressapi_address');

$('#myModal').on('show.bs.modal', function (e) {
    $("#realname-btngroup button").eq(0).attr('isSubmit','T');
    $("#modalAddAddressFrom")[0].reset();
})
listActiveCoupons();
})