/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//author:dcj
//date:2015.10.22
//

//
//该js主要是购物车页面的控制逻辑

/**
 * 该函数在去结算的时候调用，检查库存,  起订数量和限购数量
 * 如果出错，则不提交
 * @param {type} form
 * @returns {Boolean.canCheckOut|Boolean}
 */
    function canCheckOut(form)
    {    
        var storeId = $(form).find('div.goods').attr('storeId');
        
        $('#go_to_checkout_' + storeId).addClass('disabled');
        $('#go_to_checkout_' + storeId).attr('disabled',true);
        $('#go_to_checkout_'+storeId).val('正在结算...');
        
        var select_Ids = getSelectedProduct(storeId);
        var canCheckOut = false;
        if(select_Ids == ""){                      //没选择任何商品
            message.alert("没有可以去结算的商品，请检查购物车中的商品");
            return false;
        }
        var _body = { '_csrf' : _csrf,
                      'cartlineIds':select_Ids,};
        $.ajax({
            url: cancheckOutUrl,
            data: _body,
            type: 'post',
            async: false,
            success: function (re) {   
               if(re.canCheckOut){
                   canCheckOut = true;
               }
               else if (re.errorCode ==1){
                   message.alert("商品库存不足，请您修改商品数量后再结算");
               }
               else if (re.errorCode ==2 || re.errorCode ==3){
                   message.alert("商品不符合购买数量要求，请您修改商品数量后再结算");
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
               }
            },
            error: function (e) {
                message.alert("啊哦，好像出错了，请稍后再试");
            }
        });
        if(!canCheckOut){
            $('#go_to_checkout_'+storeId).val('去结算');
//            $('#go_to_checkout_' + storeId).removeClass('disabled');
//            $('#go_to_checkout_' + storeId).attr('disabled',false);
        }   
        return canCheckOut;
    };
  /**
   * 统计选中的商品cartlineID 
   * @param {type} storeId 拆单的key 用来区分每一单
   * @returns {String|getSelectedProduct.str}
   */  
    function getSelectedProduct (storeId){ 
        var str = "";
        $('input.ftzbox_'+storeId).each(function(){
            if (this.checked){
                str +=  $(this).parents('div.cart-table1-con').attr('cartlineId') + ',';
            }
        });
        //去掉最后一个被添加的逗号
        if (str.indexOf(',')> -1){
            return str.substr(0,str.length-1);
        }
            return str;
    };
   
   
   
    /**
     * 更改购物车数量，更新价格,真正的更新操作
     * @param {type} storeId 拆单的key
     * @param {type} data    用于更新的数据
     * @param {type} el      当前的dom元素
     * @param {type} quantity     更新数量
     * @param {type} originalQuantity  原始数量，如果更新不成功，则恢复原始数量
     * @returns {undefined}
     */
    function doUpdate(storeId, data,el,quantity,originalQuantity){
        $.ajax({
            url: updateUrl,
            data: data,
            type: 'post',
            success: function (re) {   
                if(re.errorCode){
                    el.val(originalQuantity); //如果修改失败，那维持原来的值
                    if(re.errorCode == 'c400'){
                        el.parents('div.cart-table1-con').find('.not-enough').html('暂时缺货');
                        el.parents('div.cart-table1-con').find('.not-enough').show();
                        el.parents('div.cart-table1-con').addClass("product-soldout");
                        el.parents('div.cart-table1-con').find('.checkbox-label').remove();
                    }else if(re.errorCode == 'c401'){
                        el.parents('div.cart-table1-con').find('.not-enough').html(re.errorMsg);
                        el.parents('div.cart-table1-con').find('.not-enough').show();
                    }
                    else if(re.errorCode == 'c500'){
                        message.alert(re.errorMsg);
                    }
                    return;
                }
                //刷新每个商品的小计
                updateFinalUnitPrice(re,el,quantity);
                //如果该商品没有被选中，则不更新价格
                if(!el.parents('div.cart-table1-con').find('input:checkbox').prop('checked')) return;
                updatePriceByStore (storeId,data.itemId);       //刷新价格
            },
            error: function (e) {
                el.val(originalQuantity); //如果修改失败，那维持原来的值
                message.alert("修改失败，请稍后再试!");
            }
        });
    }
    
    function doSlienceUpdate(storeId, data,el,quantity,originalQuantity){
        $.ajax({
            url: updateUrl,
            data: data,
            type: 'post',
            success: function (re) {   
                if(re.errorCode){
                    el.val(originalQuantity); //如果修改失败，那维持原来的值
                    return;
                }
                //刷新每个商品的小计
                updateFinalUnitPrice(re,el,quantity);
                //如果该商品没有被选中，则不更新价格
                if(!el.parents('div.cart-table1-con').find('input:checkbox').prop('checked')) return;
                //updatePriceByStore (storeId,data.itemId);       //刷新价格
            },
            error: function (e) {
                el.val(originalQuantity); //如果修改失败，那维持原来的值
            }
        });
    }
    /**
     * 刷新商品小计
     * @param {type} re 更新结果
     * @param {type} el 当前dom元素
     * @param {type} quantity 更新数量
     * @returns {undefined}
     */
    function updateFinalUnitPrice (re,el,quantity) {
        el.parents('div.cart-table1-con').find('.not-enough').hide();
        el.parents('div.cart-table1-con').find('input.product-quantity').attr('originalValue',quantity);
        el.parents('div.cart-table1-con').find('span.new-total-price').html(re.newTotalPrice);
        //如果算出来之后 显示不省钱 则不显示
        if(Number(re.savePrice)>0)
            el.parents('div.cart-table1-con').find('span.save-price').html('省 '+re.savePrice);
        else
            el.parents('div.cart-table1-con').find('span.save-price').html('');
    };
    
    /**
     * 更新每一单的价格显示，以及各种信息的显示
     * @param {type} storeId 拆单的key
     * @param {type} itemId  商品ID  如果删除操作，传 -1； 如果是全选 传 null
     * @returns {undefined}
     */
    function updatePriceByStore (storeId,itemId) {
        var select_Ids = getSelectedProduct(storeId);
        //没选择任何商品
        if(select_Ids == ""){   
            updateNselectStatus(storeId,null);
            $("div[storeid="+storeId+"]").find('.settlement-column2').html('￥ 0.00');
            $('#go_to_checkout_' + storeId).addClass('disabled');
            $('#go_to_checkout_' + storeId).attr('disabled',true);
            $('#order_promotion_tip_' + storeId).hide();
            $('#order_promotion_tip_popover_' + storeId).hide();
            $('#pay_tip_' + storeId).hide();
            $('#tax_no_tip_' + storeId).hide();
            $('#tax_yes_tip_' + storeId).hide();
            return;
        }
         var _body = { '_csrf' : _csrf,
                      'cartlineIds':select_Ids,
                      "price": true,
                      "promotion": true,
                      "shipping": false,
                      "tax": true
                    };
        $.ajax({
            url: priceUrl,
            data: _body,
            type: 'post',
            success: function (_success_res) {     
                if(!_success_res.itemDetail ||!_success_res.orderDetail ||!_success_res.total)
                {
                    message.alert("计算接口异常，请稍后再试");
                    return;
                }
                updateNselectStatus(storeId,itemId);
                var itemDetail = _success_res.itemDetail;
                var sp = updateItemKindsPrice(itemDetail,itemId);
                var orderDetail = _success_res.orderDetail;
                $('#original_Price_' + storeId).html( '￥ '+(Number(orderDetail[storeId].originalPrice)+ Number(sp)).toFixed(2));//原价
                $('#promotion_Price_' + storeId).html('-￥ '+(Number(orderDetail[storeId].promotion)+Number(sp)).toFixed(2));   //优惠钱数   
                
                $('#final_Price_' + storeId).html( '￥ '+orderDetail[storeId].actualPrice);     //最终价格
                if(Number(orderDetail[storeId].canSubmit) < 1){                                 //跨境订单，超过1000 不能提交
                    $('#pay_tip_' + storeId).show();
                    $('#go_to_checkout_' + storeId).addClass('disabled');
                    $('#go_to_checkout_' + storeId).attr('disabled',true);
                }else{
                    $('#pay_tip_' + storeId).hide();
                    $('#go_to_checkout_' + storeId).removeClass('disabled');
                    $('#go_to_checkout_' + storeId).attr('disabled',false);
                }
                if(orderDetail[storeId].orderPromotionName){
                    if(orderDetail[storeId].orderPromotionName.length<=1){
                        $('#order_promotion_tip_' + storeId).html('您参加了【'+orderDetail[storeId].orderPromotionName[0]+'】的活动');
                        $('#order_promotion_tip_' + storeId).css("display","inline-block");
                        $('#order_promotion_tip_popover_' + storeId).css("display","none");
                    }else{
                        var pd = "<div>";
                        
                        $.each(orderDetail[storeId].orderPromotionName,function(){
                            pd = pd + this +'<br/>';
                        });
                        pd = pd + "</div>";
                        $('#order_promotion_tip_' + storeId).css("display","none");
                        $('#order_promotion_tip_popover_' + storeId).attr('data-content',pd);
                        $('#order_promotion_tip_popover_' + storeId).html("你一共参加了[ <U><B>" + orderDetail[storeId].orderPromotionName.length+ "</B></U> ]种促销");
                        $('#order_promotion_tip_popover_' + storeId).css("display","block");
                        $('#order_promotion_tip_popover_' + storeId).popover({
				trigger:'hover',
				html:true
			})
                    }
                    
                }else{
                    $('#order_promotion_tip_' + storeId).css("display","none");
                }
                if($('#tax_' + storeId).length >0){
                    $('#tax_' + storeId).html( '￥ '+orderDetail[storeId].tax);
                    if(Number(orderDetail[storeId].realTax)>50 && Number(orderDetail[storeId].itemNum)>1){//税超过50
                        $('#tax_no_tip_' + storeId).hide();
                        $('#tax_yes_tip_' + storeId).show();
                    }else if(Number(orderDetail[storeId].realTax)<=50){
                        $('#tax_yes_tip_' + storeId).hide();
                        $('#tax_no_tip_' + storeId).show();
                    }else{
                        $('#tax_yes_tip_' + storeId).hide();
                        $('#tax_no_tip_' + storeId).hide();
                    }
                }
            },
            error: function (e) {
                $('#go_to_checkout_' + storeId).addClass('disabled');
                $('#go_to_checkout_' + storeId).attr('disabled',true);
                message.alert("购物车商品参数有误，请删除之后再试");
                }
            });
    };
     
     
     // itemId 如果是null 则全部刷新 
     // 如果是-1 表示删除
     // 否则是真实 itemID
    function updateItemKindsPrice(itemDetail,itemId)
    {
        var sp = 0;
        $.each(itemDetail,function(key,value){
            //if(itemId && itemId != key) return true;  
            //if(itemId && itemId == -1)  return false; //删除操作
            
            var el = $('div.cart-table1-con[itemId ='+key+']').find('label.direct-cut'); //直降标签
            var quantity = $('div.cart-table1-con[itemId ='+key+']').find('.product-quantity').val();
            var new_unit_price = $('div.cart-table1-con[itemId ='+key+']').find('span.new-unit-price');
            var old_price = $('div.cart-table1-con[itemId ='+key+']').find('span.old-price');
            var new_total_price = $('div.cart-table1-con[itemId ='+key+']').find('span.new-total-price');
            var save_price = $('div.cart-table1-con[itemId ='+key+']').find('span.save-price');
            
            //有直降的促销
            if(value.directCutName){
                    el.html('【直降】');
                    new_unit_price.html(value.newUnitPrice);
                    old_price.html(old_price.attr('op'));
                    new_total_price.html(value.newTotalPrice);
                    save_price.html('省 '+getSavePrice(old_price.attr('op'), value.newUnitPrice, quantity ));
                    if(Number(value.unitPrice) < Number(old_price.attr('op'))){
                        sp = sp + Number(getSavePrice(old_price.attr('op'), value.unitPrice, quantity ));
                    }
            }
            //没有直降的促销，但是可能有活动价
            else{
                //有活动价
                if(Number(value.unitPrice) < Number(old_price.attr('op'))){
                    new_unit_price.html(value.unitPrice);
                    old_price.html(old_price.attr('op'));
                    new_total_price.html(value.newTotalPrice);
                    save_price.html('省 '+getSavePrice(old_price.attr('op'), value.unitPrice, quantity ));
                    sp = sp + Number(getSavePrice(old_price.attr('op'), value.unitPrice, quantity ));
                }
                else{
                   el.html('');
                   new_unit_price.html(value.unitPrice);
                   old_price.html("");
                   new_total_price.html(value.newTotalPrice);
                   save_price.html('');
                }
            }
        });
        return sp;
    }
    
    
    function updateNselectStatus(storeId,itemId){
        if(itemId != null ){
            var nselect = $("div.cart-table1-con[itemId="+itemId+"]").parents('div.cartn-con');
            updateNSelectStatusCore(nselect);
            return;
        }
        $("div.goods[storeid="+storeId+"]").find('div.cartn-con').each(function(){
            updateNSelectStatusCore($(this));
        });
    }
    function updateNSelectStatusCore (nselect){ 
        
        //var nselect = el.parents('div.cartn-con');
        //不是N选
        if(nselect.length <1) return;
        var typeCode = nselect.attr('typeCode');
        var numOfGoods = nselect.attr('numOfGoods');
        var fixedPrice = nselect.attr('fixedPrice');
        
        var itemCategoryNum =0;
        var itemNum = 0;
        var str = "";
        var isNull = true;
        nselect.find('div.cart-table1-con').each(function(){
            isNull = false;
            var isChecked = $(this).find('input:checkbox').prop('checked');
            if (isChecked){
                var itemQuantity = Number($(this).find('input:text').val());
                itemCategoryNum = Number(itemCategoryNum) +1;
                itemNum = itemNum + itemQuantity;
            }
        });
        if(isNull){
            nselect.remove();
            return;
        }
        
        //待后面做复杂判断的时候再使用这个吧
        //$itemCategoryNum, $itemNum, $typeCode, $numOfGoods, $fixedPrice
//        var data = {
//            'itemCategoryNum':itemCategoryNum,
//            'itemNum':itemNum,
//            'typeCode':typeCode,
//            'numOfGoods':numOfGoods,
//            'fixedPrice':fixedPrice,
//        }
//        $.ajax({
//            url: nSelectUrl,
//            data: data,
//            type: 'get',
//            success: function (re) {   
//                nselect.find('span.nselect-msg').html(re.Msg);
//            },
//            error: function (e) {
//            }
//        });
        var msg = getNSelectStatus(nselect, itemCategoryNum, itemNum, typeCode, numOfGoods, fixedPrice);
        nselect.find('span.nselect-msg').html(msg);

        
    };
    
    
    function getNSelectStatus(nselect,itemCategoryNum, itemNum, typeCode, numOfGoods, fixedPrice){
        if(typeCode.substr(2,3) == '600'){//N 选 M 件
            if(itemNum >= numOfGoods){
                nselect.find(".tablen").removeClass("font-color4");
                nselect.find(".tablen").css("background","#e81a62");
                nselect.find(".tablen").css("color","#fff");
                return '已满足<span class="font-color4">【'+fixedPrice+'元任选'+numOfGoods+'件】</span>';
                
            }else{
                nselect.find(".tablen").addClass("font-color4");
                nselect.find(".tablen").css("background","#fff");
                nselect.find(".tablen").css("color","#e81a62");
                return '再购<span class="font-color4">'+Number(numOfGoods-itemNum) +' </span>件 立享<span class="font-color1">【'+fixedPrice+'元任选'+numOfGoods+'件】</span>';
            }
        }
    }
    
    // 计算省多少钱
    function getSavePrice(oldPrice, newPrice, quantity ){  
        
        return Number((oldPrice - newPrice) * quantity).toFixed(2);
    }
    
     // 判断是否是正整数
    function isPositiveInt( data ){  
        var re = /^[0-9]*[1-9][0-9]*$/;
        return re.test(data);
    }
    
    function forbidOprateAll()
    {
        $('input:checkbox').attr("disabled","disabled");
    }
    var updateTimer;//修改购物车的定时器
    var checkAllTimer;//更新购物车的定时器

$(document).ready(function () {
    /**
     * 购物车的加减操作
     */
    $('.quantity-subtract').bind('click', function () {
        if(! $(this).parents('div.cart-table1-con').hasClass("product-soldout")){
            setQuantity($(this), 1);
        }else{ return; }
    });
    $('.quantity-add').bind('click', function () {
        if(! $(this).parents('div.cart-table1-con').hasClass("product-soldout")){
            setQuantity($(this), 2);
        }else{ return; }
    });
    $('.product-quantity').bind('change', function () {
        if(! $(this).parents('div.cart-table1-con').hasClass("product-soldout")){
            setQuantity($(this), 3);
        }else{ return; }
    });
    /**
     * 异步检查库存 对于大于50的item 会写cookie
     * 对于超过库存的 商品 会自动修改商品的数量
     * @returns {undefined}
     * 
     */
    function checkInventory()
    {
        var itemInfo = {}, postData = {},params = {};
        $('.cart-table1-con').each( function(){
            if(! $(this).hasClass("product-soldout")){
                itemInfo[($(this).attr('itempartnumber'))] = $(this).attr('itemOwnerId');
            }
        });
        postData['itemInfo'] = itemInfo;
        postData['shop'] = 'ftzmall';
        params['_csrf'] = _csrf;
        params['postData'] = postData;
         $.ajax({
            url: inventoryUrl,
            data: params,
            type: 'post',
            async: false,
            success: function (re) {
              
               $.each(re,function(key,val){ 
                    var cartlineQuantity = $('div.cart-table1-con[itemPartNumber='+key+']').find('input.product-quantity').val();
                    //if(Number(val)<cartlineQuantity){
                        //这个地方要找需求确认,如果直接修改成库存，那万一小于起订数量又该如何显示
                        modifyQuantity($('div.cart-table1-con[itemPartNumber='+key+']').find('input.product-quantity'),Number(val),Number(cartlineQuantity));
                    //}
                    if(Number(val)>200){
                       $.cookie('inv_'+key,val,{ path: '/' });
                    }  
                });         
            },
            error: function (e) {
                //alert("库存查询失败，稍后再试");
            }
        });
    };
    /**
     * 检查库存以后调用 如果库存不足 但是大于起订数量，帮用户自动修改为库存数 如果库存小于起订数量 则提示缺货 
     * 如果有库存大于限购数量 则修改为限购数量
     * 这个真的不省心
     * @param {type} el
     * @param {type} quantity
     * @returns {undefined}
     */
    function modifyQuantity(el, inventory, needQuantity) {

        var itemId = el.parents('div.cart-table1-con').attr('itemId');
        var originalQuantity = el.attr('originalValue');
        var storeId = el.parents('div.goods').attr('storeId');
        var isNeedCheckInv = 0;
        var quantity = getRightQuantity(el, inventory, needQuantity);
        if(!quantity) return;
        if(quantity == -1){
            el.parents('div.cart-table1-con').find('.not-enough').html('暂时缺货');
            el.parents('div.cart-table1-con').find('.not-enough').show();
            el.parents('div.cart-table1-con').addClass("product-soldout");
            el.parents('div.cart-table1-con').find('.checkbox-label').remove();
            return;
        }
        if(quantity == 0){
            el.parents('div.cart-table1-con').find('.not-enough').html('库存不足');
            el.parents('div.cart-table1-con').find('.not-enough').show();
            return;
        }
        
        var data = {
            '_csrf': _csrf,
            'cartlineId': el.parents('div.cart-table1-con').attr('cartlineId'),
            'itemId': itemId,
            'quantity': quantity,
            'tariffno': el.parents('div.cart-table1-con').attr('tariffno'),
            'newUnitPrice': Number(el.parents('div.cart-table1-con').find('span.new-unit-price').html()),
            'itemOfferPrice': Number(el.parents('div.cart-table1-con').find('span.old-price').attr('op')),
            'isNeedCheckInv' : isNeedCheckInv,
        };
        el.val(quantity);
        
        doSlienceUpdate(storeId, data,el,quantity,originalQuantity);
    };
    
    function getRightQuantity(el, inventory, cartlineQuantity){
        var inv = Number(inventory);
        var quantity = Number(cartlineQuantity);
        var itemId = el.parents('div.cart-table1-con').attr('itemId');
        var minBuyCount = $.cookie('minBuyCount_'+itemId);
        var maxBuyCount = $.cookie('maxBuyCount_'+itemId);
        minBuyCount = typeof(minBuyCount) != "undefined"? Number(minBuyCount):1;
        maxBuyCount = typeof(maxBuyCount) != "undefined"? Number(maxBuyCount):200;
        if(quantity < minBuyCount) quantity = minBuyCount;
        if(quantity > maxBuyCount) quantity = maxBuyCount;
        
        if(inv < 1){
                return -1;
        }
        if(inv < quantity){
            if(inv < minBuyCount) return 0;
            if(inv >= minBuyCount && inv <= maxBuyCount){
                quantity = inv;  
//                el.parents('li').find('.not-enough').html('仅剩'+ inv +'件');
//                el.parents('li').find('.not-enough').show();
            }
            
        }
        if(quantity == Number(cartlineQuantity)){
            return null;
        }else{
            return quantity;
        }
    };
      
    //查找平台包邮规则
    function checkShippingRule(attrname, value, storeId)
    {
        var data = {
            'attrname':attrname,
            'value':value,
        }
        $.ajax({
            url: shippingRuleUrl,
            data: data,
            type: 'get',
            success: function (re) {   
                if(re.name){
                    $('p[storeId='+storeId+']').html('<span>包邮</span>'+re.name);
                }
                else{
                    $('p[storeId='+storeId+']').hide();
                }
            },
            error: function (e) {
            }
        });
    }
    // 修改商品数量
    function setQuantity(el, flag) {
        var ipt = el.parent().find('.product-quantity');
        var quantity = Number(ipt.val());
        var originalQuantity = Number(el.parents('div.cart-table1-con').find('input.product-quantity').attr('originalValue'));
        if( !isPositiveInt(quantity)){
            ipt.val(originalQuantity);
            return;
        }else{
            quantity  = parseInt(quantity);
        }
        var itempartnumber = el.parents('div.cart-table1-con').attr('itempartnumber');
        var itemId = el.parents('div.cart-table1-con').attr('itemId');
        var storeId = el.parents('div.goods').attr('storeId');
        var inv = $.cookie('inv_'+itempartnumber);
        var minBuyCount = $.cookie('minBuyCount_'+itemId);
        var maxBuyCount = $.cookie('maxBuyCount_'+itemId);
        var isNeedCheckInv = 0;
        
        switch (flag) {
            case 1:                         //减少数量
                if(quantity ==1 ) return;
                quantity = quantity - 1;
                break;
            case 2:                         //增加数量           
                quantity = quantity + 1;
                break;
            case 3:                         //直接修改数量
                quantity = parseInt(ipt.val());
                break;
        }
        if((typeof(minBuyCount) != "undefined" &&quantity < Number(minBuyCount))
            || (typeof(maxBuyCount) != "undefined" &&quantity > Number(maxBuyCount))){
                if(flag==3){
                   ipt.val(originalQuantity); 
                }
                return;
        }
        if(typeof(inv) != "undefined"){
            if(quantity > Number(inv)){
                if(flag==3){
                   ipt.val(originalQuantity); 
                }
                return;
            }
            isNeedCheckInv = 0;
        }else {
            isNeedCheckInv = 1;
        }
        
        var data = {
            '_csrf': _csrf,
            'cartlineId': el.parents('div.cart-table1-con').attr('cartlineId'),
            'itemId': itemId,
            'quantity': quantity,
            'tariffno': el.parents('div.cart-table1-con').attr('tariffno'),
            'itemPartNumber':el.parents('div.cart-table1-con').attr('itemPartNumber'),//查询库存用
            'itemOrg':el.parents('div.cart-table1-con').attr('itemOwnerId'),
            'shop':el.parents('div.cart-table1-con').attr('shopId'),
            'newUnitPrice': Number(el.parents('div.cart-table1-con').find('span.new-unit-price').html()),
            'itemOfferPrice': Number(el.parents('div.cart-table1-con').find('span.old-price').attr('op')),
            'isNeedCheckInv' : isNeedCheckInv,
        };
        ipt.val(quantity);
        
        //这个地方是为了防止用户在那不停的点击，1秒内的操作都会被合并执行
        
        if(updateTimer){
             window.clearTimeout(updateTimer);
        }
        updateTimer =  window.setTimeout(function (){doUpdate(storeId, data,ipt,quantity,originalQuantity)},500);
    };
    
    // 删除购物车商品
    $('.delete-operation').bind('click', function (e) {
        //if (!confirm('确认移除商品“' + $(this).parents('li').find('.pt-h-name').html().trim() + '”？')) return false;
        var oo = $(e.target);
        var data = {
            '_csrf': _csrf,
            'cartlineId': $(this).parents('div.cart-table1-con').attr("cartlineId"),
            'itemSalestype': $(this).parents('div.goods').attr('storeId'),
        };
        $.ajax({
            url: deleteUrl,
            data: data,
            type: 'post',
            success: function (re) {
                var storeId = oo.parents('div.goods').attr('storeId');
                var itempartnumber = oo.parents('div.cart-table1-con').attr('itempartnumber');
                var itemId = oo.parents('div.cart-table1-con').attr('itemId')
                if(re.errorCode){
                    message.alert(re.errorMsg);
                    return;
                }
                $.cookie('inv_'+itempartnumber, null,{ path: '/' }); 
                $.cookie('minBuyCount_'+itemId, null,{ path: '/' }); 
                $.cookie('maxBuyCount_'+itemId, null,{ path: '/' });
                
                if (re.isTotalEmpty) return location.reload();//购物车全空
                else if (re.isEmpty){                           //这一单空了
                    oo.parents('div.goods').remove();
                    $('p[storeId='+storeId+']').hide();
                }
                else {        
                    
                    oo.parents('div.cart-table1-con').remove();
                    updatePriceByStore(storeId, null);
                }
            },
            error: function (e) {
                    message.alert("删除失败，请之后再试");
                }
            });
        return true;
    });

    //复选框单击
    $("input:checkbox").click(function () {
        var _this = $(this);   
        var storeId = _this.parents('div.goods').attr('storeId');
        var itemId = null;
        if (_this.hasClass("checkall")) {
            _this.parents(".goods").find("input:checkbox").prop("checked", _this.prop("checked")); 
        }else{
            var all = _this.parents(".goods").find("input:checkbox:not(.checkall)").length == _this.parents(".goods").find("input:checked:not(.checkall)").length;
            _this.parents(".goods").find(".checkall").prop("checked", all);
//            if(_this.prop('checked')){
//                itemId = $(this).parents('div.cart-table1-con').attr('itemId');
//            }else{
//                itemId =-1;
//            }
        }
        //防止重复点击全选 复选框
        if(checkAllTimer){
            window.clearTimeout(checkAllTimer);
        }
        checkAllTimer =  window.setTimeout(function (){updatePriceByStore(storeId,itemId);},500);
    })
    //全选 按钮 非全选框
    $(".all-checkbox").click(function () {
        if($(this).parents("div.settlement-left").find("input:checkbox").prop("checked") == true)  return;
        $(this).parents(".goods").find("input:checkbox").prop("checked", true);
        $(this).parents(".goods").find("input:checkbox").parent().addClass("check-checked-bg");
        var storeId = $(this).parents('div.goods').attr('storeId');
        updatePriceByStore(storeId,null);
    });
    
    //清除选中商品
    $(".clear-product").click(function () {
        
        $(this).parents(".goods").find("input:checkbox").prop("checked", false);
        $(this).parents(".goods").find("input:checkbox").parent().removeClass("check-checked-bg");
        updatePriceByStore($(this).parents('div.goods').attr('storeId'),null);
    });
    
    checkInventory();
    //检查是否有平台包邮规则
    $('p.cart-prompt').each(function(){
        //checkShippingRule('tags', $(this).attr('storeId'));
        checkShippingRule('tags', '10039', $(this).attr('storeId'));
    });
    //进购物车的时候 全选中
    window.setTimeout( "$('.all-checkbox').click()",800); 
//    var interval = setInterval(function(){
//        if(SLIENCE_NUM <= 0){
//            clearInterval(interval);
//            $('.all-checkbox').click();
//        }
//    }, 1000);
    
});

