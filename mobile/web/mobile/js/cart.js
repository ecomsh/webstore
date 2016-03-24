/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//'use strict';
$(document).ready(function () {
    
    var csrf = $('#cart').attr('_csrf');
    var priceUrl = $('#cart').attr('priceURL');
    var updateUrl = $('#cart').attr('updateURL');
    var deleteUrl = $('#cart').attr('deleteURL');

$("a[id^='store_promotion_detail_switch_']").each(function()
        {
           $(this).click(function(){ 
                $(this).parents('ul').find('ul').find('ul').slideToggle(); 
                if($(this).html() =='&nbsp;详情&gt;&gt;')
                    $(this).html('&nbsp;隐藏<<');
                else
                    $(this).html('&nbsp;详情&gt;&gt;');
                }); 
        });
    updatePrice(csrf,priceUrl,true,0,0);
    // 设置商品数量
    function setQuantity(el, flag) {
        var ipt = el.parent().find('.num-ipt'),
            max = el.parents('.pt-h-item').find('.max-num').val(),
            min = el.parents('.pt-h-item').find('.min-num').val(),
            val = parseInt(ipt.val());

        var quantity = val;
        switch (flag) {
            case 1:
                if(quantity ==1 ) return;
                quantity = quantity - 1;
                break;
            case 2:
                quantity = quantity + 1;
                break;
            case 3:
                quantity = ipt.val();
                if(parseInt(quantity)>0 && parseInt(quantity)<100000000)
                    quantity = parseInt(quantity);
                else quantity =1;
                break;
        }
        var data = {
            '_csrf': csrf,
            'cartlineId': el.parents('li').attr('cartlineId'),
            'quantity': quantity,
            'tariffno': el.parents('li').attr('tariffno'),
        };
        $.ajax({
            url: updateUrl,
            data: data,
            type: 'post',
            success: function (re) {     
                ipt.val(quantity);
                updatePrice(csrf,priceUrl,false,el.parents('li').attr('store_id'),el.parents('li').attr('itemId'));
                },
                error: function (e) {
                    alert("修改失败，请之后再试");
                }
            });
    };

    $('.minus').bind('click', function () {
        setQuantity($(this), 1);
    });
    $('.plus').bind('click', function () {
        setQuantity($(this), 2);
    });
    $('.num-ipt').bind('change', function () {
        setQuantity($(this), 3);
    });
    
    $('input[name^="productsel"]').bind('click', function () {
        updatePrice(csrf,priceUrl,false,$(this).parents('li').attr('store_id'),0);
    });

    $('#selectAll').bind('click', function () {
        productCheckAll($(this));
    });

    function productCheckAll(o) {
        var productId = $('input[name^="productsel"]');
        if (productId.length<1) return;
        productId.each(function(){
            if (o.prop('checked')){              
                $(this).prop('checked',true);
            }
            else{
                $(this).prop('checked',false);
            }
            });
            updatePrice(csrf,priceUrl,true,0,0);
        };
            
    // 移除商品

    $('.J-remove').bind('click', function (e) {
        if (!confirm('确认移除商品“' + $(this).parents('li').find('.pt-h-name').html().trim() + '”？')) return false;
        var oo = $(e.target);
        var data = {
            '_csrf': csrf,
            'cartlineId': $(this).parents('li').attr("cartlineId"),
            'itemSalestype': $(this).parents('li').attr('store_id'),
        };
        
        $.ajax({
            url: deleteUrl,
            data: data,
            type: 'post',
            success: function (re) {
                var store_id = $(this).parents('li').attr('store_id');
                if (re.error) return alert(re.error);
                if (re.is_total_empty) return location.reload();
                else if (re.is_empty)
                    oo.parents('ul').remove();
                else oo.parents('.pt-h-item').remove();
                updatePrice(csrf,priceUrl,false,store_id,0);
                },
                error: function (e) {
                    alert("删除失败，请之后再试");
                }
            });
        return true;
    });

    function getSelectedProduct (){
        var str = "";
        var isAll =true;
        $('input[name^="productsel"]').each(function(){
            if (this.checked){
                str +=  $(this).parents('li').attr('cartlineId') + ',';
            }
            else{
                isAll = false;
                $('#selectAll').prop('checked',false);
            }
        });
        if (isAll)
        {
            $('#selectAll').prop('checked',true);
        }
        if (str.indexOf(',')> -1){
            return str.substr(0,str.length-1);
        }
        else{
            return str;
        }
    };

    function updateStorePrice  (sp, storePrice) {
        $('#store_total_price_' + sp).html( '￥ '+storePrice.final);
        $('#store_promotion_' + sp).find('span').html('￥ -'+storePrice.promotion);
        
        var detail = '';
        for(var i=0; i< storePrice.promotionDetail.length; i++){
            detail = detail + '<li>' +storePrice.promotionDetail[i].name + ' 优惠：￥'+ storePrice.promotionDetail[i].amount+'</li>';
        }
        $('#store_promotion_detail_' + sp).html(detail);
                        
        if(sp>2){
            if(storePrice.tax > 50){
                $('#store_subtotal_tax_yes' +sp).css('display', 'block');
                if(storePrice.itemNum > 1){
                    $('#store_subtotal_tax_yes_info' +sp).css('display', 'block');
                }
                else if($('#store_subtotal_tax_yes_info' +sp)){
                    $('store_subtotal_tax_yes_info' +sp).css('display', 'none');
                }
                if($('#store_subtotal_tax_no' +sp)){
                    $('#store_subtotal_tax_no' +sp).css('display', 'none');
                }
                $('#store_subtotal_tax_yes' +sp).find('span').html('￥ '+storePrice.tax);
            }
            else {
                $('#store_subtotal_tax_no' +sp).css('display', 'block');
                if($('#store_subtotal_tax_yes' +sp)){
                    $('#store_subtotal_tax_yes' +sp).css('display', 'none');
                    if($('#store_subtotal_tax_yes_info' +sp)){
                        $('#store_subtotal_tax_yes_info' +sp).css('display', 'none');
                    }
                }
                $('#store_subtotal_tax_no' +sp).find('span').html('￥ '+storePrice.tax);
            }
            if(storePrice.notSubmit>0){
                $('#store_message_' +sp).css('display', 'block');
            }else{
                $('#store_message_' +sp).css('display', 'none');
            }
        }
    };
    
    function updatePrice (csrf,priceUrl, refreshAll, typeId, itemId) {
        if(refreshAll){
            $('.store_total_price').each(function () {
                $(this).html( '￥ 0.00');
            });
            $('.font_16').each(function () {
                $(this).html( '￥ 0.00');
            });
        }            
        var select_Ids = getSelectedProduct();
        if(select_Ids == ""){
            $("[id ^= 'store_total_price_']").each(function () {
                $(this).html( '￥ 0.00');
            });
            $("[id ^= 'store_promotion_']").each(function () {
                $(this).html( '￥ 0.00');
            });
            $('#cart-subtotal').html('￥0.00');
            $('#cart-promotion_discount_price').html( '-￥0.00');
            $('#cart-promotion-subtotal').html('￥0.00');
            $('#btnjiesuan').prop('disabled', true);
            $('#btnjiesuan').css({'background': '#CCCCCC'});
            return;
        }
                        
        var _body = { '_csrf' : csrf,
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
                if(!_success_res.detail)
                {
                    alert("计算接口异常，请稍后再试");
                    return;
                }
                var detail = _success_res.detail;
                var storePrice = _success_res.storePrice;
                var totalPrice = _success_res.totalPrice;
                var notSubmit = _success_res.notSubmit;
                                
                for(var d in detail){
                    if(detail[d].type>2){
                        if (itemId ){
                            if(itemId == d){
                                $('#tax_' +d).css('display', 'block');
                                $('#tax_' +d).find('em').html( '税： '+detail[d].itemTax);
                                break;
                            }
                        }
                        else{
                            $('#tax_' +d).css('display', 'block');
                            $('#tax_' +d).find('em').html( '税： '+detail[d].itemTax);
                        }
                    }
                }        
                var isNull = true;
                for(var sp in storePrice){
                    if (typeId ){
                        if(typeId == sp){
                            isNull = false;
                            updateStorePrice(sp, storePrice[sp]);break;
                        }
                    }
                    else{
                        updateStorePrice(sp, storePrice[sp]);
                    }
                }
                if(typeId && isNull){
                    $('#store_total_price_' + typeId).html( '￥ 0.00');
                    $('#store_promotion_' + typeId).find('span').html( '￥ 0.00');
                    if($('#store_subtotal_tax_no' + typeId)){
                        $('#store_subtotal_tax_no' + typeId).css('display', 'none');
                    }
                    if($('#store_subtotal_tax_yes' +typeId)){
                        $('#store_subtotal_tax_yes' +typeId).css('display', 'none');
                        if($('#store_subtotal_tax_yes_info' +typeId)){
                            $('#store_subtotal_tax_yes_info' +typeId).css('display', 'none');
                        }
                    }
                }
                if(notSubmit<1){
                    $('#btnjiesuan').removeProp('disabled');
                    $('#btnjiesuan').removeClass('disabled');
                    $('#btnjiesuan').css({'background': '#FF0000'});
                }else{                               
                    $('#btnjiesuan').prop('disabled', true);
                    $('#btnjiesuan').css({'background': '#CCCCCC'});                   
                }
                $('#cart-subtotal').html('￥ '+ totalPrice.originalPrice);
                $('#cart-promotion_discount_price').html('￥ -'+ totalPrice.promotion);
                $('#cart-promotion-subtotal').html('￥ '+ totalPrice.final);
                },
                error: function (e) {
                    $('#btnjiesuan').prop('disabled', true);
                    $('#btnjiesuan').css({'background': '#CCCCCC'});
                        alert("购物车商品参数有误，请删除之后再试");
                }
            });
    };

});

