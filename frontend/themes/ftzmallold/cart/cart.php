<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\CartAsset;
CartAsset::register($this);
/* @var $this yii\web\View */
$this->title = '购物车_上海外高桥进口商品网';
?>
<div class="main w1200">
    <div class="mTB">
        <div class="cart-wrap bai1200" id="cart-index" style="width: 1200px;">
            <div class="cart-nav stepbj1 dis_bl clb"></div>

            <?= Html::beginForm(['cart/checkout'], 'post', ['id' =>"form-cart",'enctype' => 'multipart/form-data']) ?>
                <div class="section" id="cart-items">
                    <!-- 购物车页面结构开始 -->
                  <!-- <div class="mtb_20 price_all_cart">商品总价（不含运费）：<span>2619.00</span>元 <input type="button"  value="结算"/></div> -->
                    <div id="goodsbody">
                        <div class="cart_title">购物车 </div>
                        <table class="pro_list_cart_xu list_title" width="100%" border="0" cellspacing="0" cellpadding="0" style="width: 1200px;">
                            <thead>
                                <tr urlupdate="<?= Yii::$app->params['baseUrl'] ?>cart-update-goods.html}&gt;" floatstore="0" number="1">
                                    <th width="50"><input type="checkbox" name="checkall" id="checkall" value="1" checked="checked" onclick="productCheckAll(this)"></th>
                                    <th width="360">商品信息</th>
                                    <th class="c_969696" width="150">单价</th>
                                    <th class="c_969696" width="200">数量</th>
                                    <th class="c_969696" width="150">金额（元）</th>
                                    <!-- <th>积分</th> -->
                                    <th class="c_969696" width="100">操作</th>        </tr>
                            </thead>
                        </table>
                <?php
                   if ($allItems & is_array($allItems)) {
                     foreach ($allItems as $type => $item):?>
                        
                        <table class="pro_list_cart_xu" width="100%" border="0" cellspacing="0" cellpadding="0" id="store_<?=$type?>" style="width: 1200px;">
                            <tbody>
                                <tr class="cart_activity">
                                    <td></td><td colspan="4"> <span class="orange"><?= $storeName[$type]?></span>
                                       
                                        <span class="pl_10 pr_10">
                                            <?php if ($type > 2): ?>
                                            &nbsp;温馨提示：本专区为跨境商品，每单关税低于50元（含）免税。
                                            <?php endif?>
                                            
                                        </span> 
                                    </td>
                                    <td></td>
                                </tr>
                        <?php foreach ($item as $k => $v):?>
                                <?php if(isset($v['buyAble']) && $v['buyAble']<1): ?>
                                <tr  style="background: #ECECEC; border:1px dashed #F00" cartlineId=<?= $v['cartlineId'] ?> itemId=<?= $v['itemId'] ?> tariffno=<?=$v['tariffno'] ?> itemOwnerId=<?= $v['itemOwnerId'] ?> shopId=<?= $v['shopId'] ?> number="60" lastClickTime=-1 floatstore="1" buy_price=<?= $v['itemOfferPrice'] ?> buy_store="1" buy_store_id=<?= $v['itemSalestype'] ?>>
                                    <td width="50"><input  disabled="true" type="checkbox" id="productselbox_disable" name="productsel[<?= $v['cartlineId'] ?>]" value="999"  >
                                    </td>
                                    <td width="360">
                                        <div class="goodpic spmc_l"><a href="<?= Url::to(['product/view','id'=>$v['itemId']],true) ?>"><img src="<?php echo json_decode($v['itemImageLink'],true)['img'];?>"></a></div>
                                            <div class="spmc_r">
                                            <a target="_blank" class="item_title" href="<?= Url::to(['product/view','id'=>$v['itemId']],true) ?>"><?= $v['itemDisplayText'] ?></a><br>
                                            <span><?= $v['extensionData'] ? $v['extensionData'] : '无' ?></span>
                                        </div>
                                    </td>
                                    <td class="goods_price textcenter" align="center" valign="middle" width="150">
                                            <p class="now_price">￥<?= $v['itemOfferPrice'] ?></p> 
                                            <p class="del_price">￥<?= $v['itemListPrice'] ?></p>
                                    </td>
                                    <td class="textcenter" width="200">
                                        <div class="orange">
                                            <input  type="text" min="0" numtype="int" id="modify_quantity" size="3" 
                                                    value="<?= $v['cartlineQuantity'] ?>" style="display:none">
                                            已下架
                                        </div>
                                    </td>
                                    <td class="goods_price textcenter buy_price deep_orange" width="150">￥<?= $v['itemOfferPrice']*$v['cartlineQuantity'] ?></td>
                                    <td class="textcenter" width="100">
                                        <a class="red"><img class="delItem" src="<?= Yii::$app->params['baseimgUrl'] ?>n_select_19.png"></a>
                                    </td>
                                </tr>
                                <?php else:?>
                                <tr cartlineId=<?= $v['cartlineId'] ?> itemId=<?= $v['itemId'] ?> tariffno=<?=$v['tariffno'] ?> itemOwnerId=<?= $v['itemOwnerId'] ?> shopId=<?= $v['shopId'] ?> number="60" lastClickTime=-1 floatstore="1" buy_price=<?= $v['itemOfferPrice'] ?> buy_store="1" buy_store_id=<?= $v['itemSalestype'] ?>>
                                    <td width="50"><input  checked=true type="checkbox" id="productselbox" name="productsel[<?= $v['cartlineId'] ?>]" value="999"  onclick="if (Cart) Cart.ItemNumUpdate(this, this.checked ? 1:0, event);">
                                       
                                    </td>
                                    <td width="360">
                                        <div class="goodpic spmc_l"><a href="<?= Url::to(['product/view','id'=>$v['itemId']],true) ?>"><img src="<?php echo json_decode($v['itemImageLink'],true)['img'];?>"></a></div>
                                            <div class="spmc_r">
                                            <a target="_blank" class="item_title" href="<?= Url::to(['product/view','id'=>$v['itemId']],true) ?>"><?= $v['itemDisplayText'] ?></a><br>
                                            <span><?= $v['extensionData'] ? $v['extensionData'] : '无' ?></span>
                                        </div>
                                    </td>
                                    <td class="goods_price textcenter" align="center" valign="middle" width="150">
                                            <p class="now_price">￥<?= $v['itemOfferPrice'] ?></p> 
                                            <p class="del_price">￥<?= $v['itemListPrice'] ?></p>
                                            <p class="now_price" id = 'tax_<?= $v['itemId'] ?>' style="display: none;"><em id = 'tax_value_<?= $v['itemId'] ?>'></em>/<em><?= $v['taxRate'] ?></em></p> 
                                    </td>
                                    <td class="textcenter" width="200">
                                        <div class="Numinput ma numadjust-arr">
                                            <span class="numadjust decrease"></span>
                                            <input  type="text" min="0" numtype="int" id="modify_quantity" size="3" 
                                                   value="<?= $v['cartlineQuantity'] ?>" onchange="if (Cart) Cart.ItemNumUpdate(this, this.value, event);">
                                            <span  class="numadjust increase"></span>
                                        </div>
                                        <?php if($nii && $nii['itemPartNumber'] == $v['itemPartNumber'] && $nii['itemOwnerId'] == $v['itemOwnerId']): ?>
                                        <div class="orange" style=" margin-top: 10px">库存不足(仅剩<?= $nii['remain'] ?>件)</div>
                                        <?php endif?>
                                        
                                    </td>
                                    <td class="goods_price textcenter buy_price deep_orange" width="150">￥<?= $v['itemOfferPrice']*$v['cartlineQuantity'] ?></td>
                                    <td class="textcenter" width="100">
                                        <a class="red"><img class="delItem" src="<?= Yii::$app->params['baseimgUrl'] ?>n_select_19.png"></a>
                                    </td>
                                </tr>
                                <?php endif?>
                                
                        <?php endforeach;?>
                                <tr class="goods_bj" >
                                    <td colspan="2"> <!--div class="shipLable"></div-->  </td>
                                    <td colspan="3" id="store_85">
                                    
                                        <p id="store_promotion_<?=$type?>">优惠金额：<em class="orange font_16">-￥ 0.00</em><a id="store_promotion_detail_switch_<?=$type?>" class="orange">&nbsp;详情>></a></p>
                                        <ul id="store_promotion_detail_<?=$type?>" style="display:none; color:#F00">
                                    </ul>
                                    <p id="store_subtotal_tax_no<?=$type?>" style="display: none;"> <h class="orange">关税≤50，免征哦！&nbsp;</h> 行邮税：<em class="del_price font_16" >￥ 0.00</em></p>
                                    <p id="store_subtotal_tax_yes<?=$type?>" style="display: none;">行邮税：<em class=" font_16" >￥ 0.00</em></p>
                                    <p id="store_subtotal_tax_yes_info<?=$type?>" style="display: none;" class="orange">订单关税超过50元，建议分开下单，您可以重新选择商品把关税总额控制在50元以下，即可免税!</p>
                                    
                                    <p>合计（不含运费）：<em class="store_total_price" id="store_total_price_<?=$type?>">￥ 0.00</em></p>
                                    <p id="store_message_<?=$type?>" style="display: none;"><em class="orange">啊哦，海关规定购买多件的总价不能超过￥1000大洋，请您分多次购买!</em></p>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                <?php endforeach;
                         }
                        ?> 
                    </div>
                    <!-- 购物车页面结构结束 -->
                    <div id="cart-ajax-update">
                        <div class="clearfix">
                            <div class="cart-pricelist pro_list_cart_xu clearfix" style="width: 1200px;">
                                <!-- 优惠券 -->
                                <!-- 订单总计 -->
                                <div>
                                    <ul class="pricelist">
                                        <li><label>商品总价：</label><span id="cart-subtotal" class="price-normal">￥ 0.00</span> </li>
                                        <li><label>优惠金额 ：</label><span id="cart-promotion_discount_price">-￥0.00</span></li>
                                        <li><label>总金额（不含运费）：</label><span id="cart-promotion-subtotal" class="totalprice price1">￥ 0.00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div id="cart-return-btn" class="return-cart">
                                <div class="return_settlement" style="width: 1200px;">
                                    <div class="fl">
                                        <a href="<?= Url::home() ?>" class="cart_return">&lt;&lt; 继续购买</a>
                                    </div>
                                    <div class="fr"><button type="submit" id="btnjiesuan" class="btn cart_settlement" tyle="margin-top:10px"><span><span>去结算</span></span></button></div>
                                </div>
                            </div>
                            <div class="crl"></div>
                            <!-- end -->

                            <!-- 马上要生效，但是没有生效的优惠规则 -->
                            <div class="le_zhi" style="display:none">
                            </div>
                            <!-- end -->
                            <div class="cl_zhi"></div>
                        </div>
                    </div>
                </div>

            <?= Html::endForm() ?>
        </div>

        <script>
            //wzy 15-4-3 全选购物车的商品
            function productCheckAll(o) {
                var productId = $$('input[id="productselbox"]');
                if (productId.length<1) return;
                var store_id = productId[0].getParent('tr').get('buy_store_id');
                for (var i = 0; i < productId.length; i++)
                {
                    if (o.checked)
                    {
                        if (i == 0 || productId[i].getParent('tr').get('buy_store_id') != store_id)
                        { 
                            store_id = productId[i].getParent('tr').get('buy_store_id');
                            productId[i].checked = false;
                            productId[i].click();
                        }
                        else
                        {
                           productId[i].checked = true;
                        }
                      
                        $('btnjiesuan').removeProperty('disabled');
                        $('btnjiesuan').removeClass('disabled');
                    }
                    else
                    {
                        if (i == 0 || productId[i].getParent('tr').get('buy_store_id') != store_id)
                        { 
                            store_id = productId[i].getParent('tr').get('buy_store_id');
                            productId[i].checked = true;
                            productId[i].click();
                        }
                        else 
                        {
                           productId[i].checked = false;
                        }
                        $('btnjiesuan').setProperty('disabled', true);
                         $('btnjiesuan').setStyles({'background': '#CCCCCC'});
                    }
                }
            }

            /*购物车小图mouseenter效果*/
            /*由于没有图片拥有class cart-product-img 所以没有该效果*/
            function thumb_pic() {
                if (!$('goodsbody'))
                    return;
                var cart_product_img_viewer = new Element('div', {styles: {'position': 'absolute', 'zIndex': 500, 'opacity': 0, 'border': '1px #666 solid'}}).inject(document.body);
                var cpiv_show = function (img, event) {

                    if (!img)
                        return;
                    cart_product_img_viewer.empty().adopt($(img).clone().removeProperties('width', 'height').setStyle('border', '1px #fff solid')).fade(1);

                    var size = window.getSize(), scroll = window.getScroll();
                    var tip = {x: cart_product_img_viewer.offsetWidth, y: cart_product_img_viewer.offsetHeight};
                    var props = {x: 'left', y: 'top'};
                    for (var z in props) {
                        var pos = event.page[z] + 10;
                        if ((pos + tip[z] - scroll[z]) > size[z])
                            pos = event.page[z] - 10 - tip[z];
                        cart_product_img_viewer.setStyle(props[z], pos);
                    }

                };

                $$('#cart-index .cart-product-img').each(function (i) {
                    new Asset.image(i.get('isrc'), {onload: function (img) {
                            if (!img)
                                return;
                            var _img = img.zoomImg(50, 50);
                            if (!_img)
                                return;
                            _img.setStyle('cursor', 'pointer').addEvents({
                                'mouseenter': function (e) {
                                    cpiv_show(_img, e);
                                },
                                'mouseleave': function (e) {
                                    cart_product_img_viewer.fade(0);
                                }
                            });
                            i.empty().adopt(new Element('a', {href: i.get('ghref'), target: '_blank', styles: {border: 0}}).adopt(_img));
                        }, onerror: function () {
                            i.empty();

                        }});

                });


            };
            window.addEvent('domready', function () {
                thumb_pic();
            });

            /*购物车处理*/
            void function () {
                var cartTotalPanel = $('cartitems');
                Cart = {};
                Cart.utility = {
                    keyCodeFix: [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 8, 9, 46, 37, 39],
                    /*数字完全相加，防止小数点后N位被省去*/
                };

                Object.append(Cart, {
                    removeItem: function (handle) {
                        Ex_Dialog.confirm('确认删除？', function (e) {
                            if (!e) return;
                            var item = $(handle).getParent('tr');
                            var remoteURL = "<?= Url::to(['cart/delete/'],true); ?>";
                            var storeID = item.get('buy_store_id');
                            var quantity = item.getElementById('modify_quantity').value;
                            //** 处理删除的购物车object数据
                            //item.getElements('input').set('disabled',true);
                            //var _data = item.getElement('div.Numinput').toQueryString();
                            var _data = {   '_csrf' : '<?= Html::encode($_csrf) ?>',
                                            'cartlineId': item.get('cartlineId'),
                                            'itemSalestype':item.get('buy_store_id')};
                            if (item.hasClass('havechild')) {
                                var chlid_id = item.get('chlid_id');
                                if ((group = item.getParent('table').getElements('.' + chlid_id)))
                                    group.each(function (ell) {
                                        ell.getElements('input').set('disabled', true);
                                    });
                            }

                            var _this = this;
                            this.updateTotal(remoteURL, {
                                data: Object.toQueryString(_data),
                                onRequest: function () {
                                    if (!Browser.ie6) {
                                        item.getFirst().set('html', '正在删除...');
                                        item.setStyles({'background': '#FBE3E4', 'opacity': 1})
                                    }
                                },
                                onComplete: function (res) {
                                    var _success_res = JSON.decode(res);
                                    if (_success_res.is_total_empty)
                                    { 
                                        Cookie.dispose('carttotalNum'+'<?= Yii::$app->user->getId()?>');
                                        var _empty_html = '<div class="cart-empty" id="goodsbody"><div class="w400 ma clearfix"><img src="<?=\yii\helpers\Url::base();?>/themes/ftzmallold/images/empty_pic.gif" class="flt m5"/>     <p class="pt10">您的购物车里还没有商品,您可以：<br />去看看&nbsp;<a href="./" class="font-orange">首页>></a></p></div></div>';
                                        $('cart-index').set('html', _empty_html);
                                        $('cart_num').set('html',0);
                                       
                                    }
                                    else if (_success_res.is_empty) {
                                        //var _empty_html = '<div class="cart-empty" id="goodsbody"><div class="w400 ma clearfix"><img src="/app/b2c/statics/bundle/empty_pic.gif" class="flt m5"/>     <p class="pt10">您的购物车里还没有商品,您可以：<br />将收藏夹中的商品添加进来<br />或者去看看&nbsp;<a href="./" class="font-orange">首页>></a></p></div></div>';
                                        _this.updatePrice(false,0,0);
                                        $('store_'+item.get('buy_store_id')).set('html', '');
                                        
                                    } else {
                                        if (_success_res.error) {
                                            MessageBox.error(_success_res.error);
                                        } else {
                                            //删除配件
                                            if (item.hasClass('havechild')) {
                                                var chlid_id = item.get('chlid_id');
                                                if ((group = item.getParent('table').getElements('.' + chlid_id)))
                                                    group.each(function (ell) {
                                                        ell.destroy();
                                                    });
                                            }

                                            // 删除店铺信息
                                            if ((group2 = item.getParent('table').getElements('tr'))) {
                                                var flag = true;
                                                group2.each(function (ell) {
                                                    if (ell.get('buy_store_id') == storeID && ell != item) {
                                                        flag = false;
                                                    }
                                                });
                                                if (flag) {
                                                    $$('#storeid_' + storeID).destroy();
                                                }
                                            }

                                            if (!flag) {
                                                item.destroy();
                                            }

                                            var rule_id = $$('.order_rule_id'),
                                                    order_id = $$('tr[order_rule_id]');
                                            if (!!order_id.length) {
                                                order_id.each(function (tr) {
                                                    if (!rule_id.length)
                                                        return tr.destroy();
                                                    var _tr_destory = rule_id.some(function (el, i) {
                                                        if (tr.get('order_rule_id').split(',').contains(el.value))
                                                            return true;
                                                    });
                                                    if (!_tr_destory)
                                                        tr.destroy();
                                                });
                                            }
                                            //** 更新区域
                                            //_this.updateStorePrice(null, null, item, null);
                                            _this.updatePrice(false,item.get('buy_store_id'),item.get('itemId'));
                                            _this.updateCartNum(-quantity);
                                            //_this.updateWillGetPromotion(_success_res.unuse_rule);
                                            //_this.updatePromotion(_success_res.promotion);
                                        }

                                        // if(item.getPrevious('tr').get('buy_store_id') != storeID && item.getNext('tr').get('buy_store_id') != storeID){
                                        // }
                                    }

                                    if ($('goodsbody').getElement('tbody') && $('goodsbody').getElement('tbody').get('html').trim() == '') {
                                        $('goodsbody').destroy();
                                    }
                                    //** 更新购物车商品数量
                                    
                                }
                            });
                        }.bind(this));
                    },
                    ItemNumUpdate: function (numInput, num, evt, abort) {
                        if (!numInput)
                            return;
                      
                                num = num || numInput.value;
                        var _float_store = numInput.getParent('tr').get('floatstore').toInt();
                        var type = ['toInt', 'toFloat'];

                        var forUpNum = numInput.value[type[_float_store]]();

                        if (evt && new Event(evt).target != numInput) {
                            forUpNum = (isNaN(forUpNum) ? 1 : forUpNum) + num;
                        }

                        if (forUpNum[type[_float_store]]() <= 0)
                            forUpNum = 1;

                        numInput.value = forUpNum.limit(0, Number.MAX_VALUE);


                        var _goods_number = numInput.getParent('tr').getAttribute('number')[type[_float_store]]();
                        
                        this.updateItem(numInput, numInput.getParent('tr'), abort);
                        
                        this.__forUpNum = forUpNum;
                        this.__goods_number = _goods_number;
                    },
                    
                    getSelectedProduct: function (storeId)
                    {
                        if(storeId){ 
                            var temp = $('store_'+ storeId);
                            var productId = temp.getElements('input[id="productselbox"]');
                        }
                        else 
                        {
                            var productId = $$('input[id="productselbox"]');
                        }
                        var str = "";
                        var isAll = true;
                        for (var i = 0; i < productId.length; i++)
                        {
                            if (productId[i].checked)
                            {
                                str +=  productId[i].getParents('tr').get('cartlineId') + ',';
                                
                            }
                            else
                            {
                                isAll =false;
                                $('checkall').checked = false;
                            }
                        }

                        if (isAll)//如果有一项选中，那么去掉提交按钮的不可用属性，去掉disabled类。
                        {
                            //$('btnjiesuan').removeProperty('disabled');
                            //$('btnjiesuan').removeClass('disabled');
                           $('checkall').checked = true;
                        }
                        if (str.indexOf(',')> -1)
                        {
                            return str.substr(0,str.length-1);}
                        else{
                            return str;
                        }
                    },
                    updateItem: function (input, item, abort) {

                        if (input.value == 'NaN') {
                            input.value = 1;
                            return false;
                        }
                        item.retrieve('request', {cancel: function () {
                            }}).cancel();
                        if (abort)
                            return;
                        var _data = {'_csrf' : '<?= Html::encode($_csrf) ?>',
                                        'cartlineId': item.get('cartlineId'),
                                        'quantity': item.getElementById('modify_quantity').value,
                                        'tariffno': item.get('tariffno'),
                                        'itemOwnerId' : item.get('itemOwnerId'),
                                        'shopId' : item.get('shopId'),
                                        'country' : 'CN',
                                        'stateCode' : '310000'
                                    };
                        item.store('request', new Request({
                            url: "<?= Url::to(['cart/update/'],true); ?>",
                            data: Object.toQueryString(_data),
                            link: 'cancel',
                            method: 'post',
                            onSuccess: function (res) {
                                var _success_res = JSON.decode(res);
                                if (_success_res && _success_res.success) {
                                    
                                    this.updatePrice(false,item.get('buy_store_id'),0);
                                    this.updateCartNum();
                                    this.updateNum(input, _success_res.price, _success_res.error_msg);
                                    //this.updateWidgetsCartNum(_success_res.number);
                                } else {
                                    input.value = _success_res.remainInventory;
                                    this.updateItem(input, item, abort);
                                    Message.error(_success_res.error);
                                }
                            }.bind(this),
                            onFailure: function (xhr) {
                                input.focus();  
                                    Message.error("亲，慢一点，不要着急哟:-D");
                            }.bind(this)
                        }).send());
                    },
                    updateStorePrice: function (sp, storePrice) {
                        $('store_total_price_' + sp).set('html', '￥ '+storePrice.final);
                        $('store_promotion_' + sp).getElements('em').set('html', '￥ -'+storePrice.promotion);
                        var detail = '';
                        for(var i=0; i< storePrice.promotionDetail.length; i++){
                            //if(Number(storePrice.promotionDetail[i].amount) > 0.0 ){
                                detail = detail + '<li>' +storePrice.promotionDetail[i].name + ' 优惠：￥'+ storePrice.promotionDetail[i].amount+'</li>';
                           // }
                        }
                        $('store_promotion_detail_' + sp).set('html',detail);
                        
                        
                        
                        if(sp>2){
                            if(storePrice.tax > 50){
                                $('store_subtotal_tax_yes' +sp).setStyle('display', 'block');
                                if(storePrice.itemNum > 1){
                                    $('store_subtotal_tax_yes_info' +sp).setStyle('display', 'block');
                                }
                                else if($('store_subtotal_tax_yes_info' +sp))
                                {
                                    $('store_subtotal_tax_yes_info' +sp).setStyle('display', 'none');
                                }
                                if($('store_subtotal_tax_no' +sp)){
                                    $('store_subtotal_tax_no' +sp).setStyle('display', 'none');
                                }
                                $('store_subtotal_tax_yes' +sp).getElements('em').set('html', '￥ '+storePrice.tax);
                            }
                            else {
                                $('store_subtotal_tax_no' +sp).setStyle('display', 'block');
                                if($('store_subtotal_tax_yes' +sp)){
                                    $('store_subtotal_tax_yes' +sp).setStyle('display', 'none');
                                    if($('store_subtotal_tax_yes_info' +sp)){
                                    $('store_subtotal_tax_yes_info' +sp).setStyle('display', 'none');
                                }
                                }
                                $('store_subtotal_tax_no' +sp).getElements('em').set('html', '￥ '+storePrice.tax);
                            }
                            if(storePrice.notSubmit>0){
                                $('store_message_' +sp).setStyle('display', 'block');
                            }else{
                                $('store_message_' +sp).setStyle('display', 'none');
                            }
                        }
                    },
                    updatePrice: function (refreshAll, typeId, itemId) {
                        
                        if(refreshAll){
                            $$('.store_total_price').each(function (o) {
                                    o.set('html', '￥ 0.00');
                                });
                            $$('.font_16').each(function (o) {
                                    o.set('html', '￥ 0.00');
                                });
                        }
                        
                        var select_Ids = this.getSelectedProduct(null);
                        if(select_Ids == "")
                        {
                            $$('.store_total_price').each(function (o) {
                                    o.set('html', '￥ 0.00');
                                });
                            $$('.font_16').each(function (o) {
                                    o.set('html', '￥ 0.00');
                                });
                            $$('p[id^="store_subtotal_tax_"]').each(function(o){
                                o.setStyle('display', 'none');
                            });
                            
                            $('cart-subtotal').set('html','￥0.00');
                            $('cart-promotion_discount_price').set('html', '-￥0.00');
                            $('cart-promotion-subtotal').set('html','￥0.00');
                            $('btnjiesuan').setProperty('disabled', true);
                            $('btnjiesuan').setStyles({'background': '#CCCCCC'});
                            return;
                        }
                        
                        var _body = {'_csrf' : '<?= Html::encode($_csrf) ?>',
                                    'cartlineIds':select_Ids,
                                    "price": true,
                                    "promotion": true,
                                    "shipping": false,
                                    "tax": true
                                };
                        new Request({
                            url: "<?= Url::to(['cart/price/'],true); ?>",
                            data: Object.toQueryString(_body),
                            link: 'cancel',
                            method: 'post',
                            onSuccess: function (res) {                            
                                var _success_res = JSON.decode(res);
                                if(!_success_res.detail)
                                {
                                    Message.error("计算接口异常，请稍后再试");
                                    return;
                                }
                                var detail = _success_res.detail;
                                var storePrice = _success_res.storePrice;
                                var totalPrice = _success_res.totalPrice;
                                var notSubmit = _success_res.notSubmit;
                                
                                for(var d in detail)
                                {
                                    if(detail[d].type>2)
                                    {
                                        if (itemId ){
                                            if(itemId == d){
                                                $('tax_' +d).setStyle('display', 'block');
                                                $('tax_' +d).getElement('em').set('html', '税： '+detail[d].itemTax);
                                                break;
                                            }
                                        }
                                        else{
                                            $('tax_' +d).setStyle('display', 'block');
                                            $('tax_' +d).getElement('em').set('html', '税： '+detail[d].itemTax);
                                        }
                                    }
                                }
                                
                                var isNull = true;
                                for(var sp in storePrice)
                                {
                                    if (typeId ){
                                        if(typeId == sp){
                                            isNull = false;
                                            this.updateStorePrice(sp, storePrice[sp]);
                                            break;
                                        }
                                    }
                                    else{
                                        this.updateStorePrice(sp, storePrice[sp]);
                                    }
                                }
                                if(typeId && isNull){
                                        $('store_total_price_' + typeId).set('html', '￥ 0.00');
                                        $('store_promotion_' + typeId).getElement('em').set('html','￥ 0.00');
                                        if($('store_subtotal_tax_no' +typeId)){
                                            $('store_subtotal_tax_no' +typeId).setStyle('display', 'none');
                                        }
                                        if($('store_subtotal_tax_yes' +typeId)){
                                            $('store_subtotal_tax_yes' +typeId).setStyle('display', 'none');
                                            if($('store_subtotal_tax_yes_info' +typeId)){
                                            $('store_subtotal_tax_yes_info' +typeId).setStyle('display', 'none');
                                        }
                                        }
                                    }
                                if(notSubmit<1){
                                    $('btnjiesuan').removeProperty('disabled');
                                    $('btnjiesuan').removeClass('disabled');
                                    $('btnjiesuan').setStyles({'background': '#FF0000'});
                                }else{                               
                                    $('btnjiesuan').setProperty('disabled', true);
                                    $('btnjiesuan').setStyles({'background': '#CCCCCC'});
                                    
                                }
                                $('cart-subtotal').set('html','￥ '+ totalPrice.originalPrice);
                                $('cart-promotion_discount_price').set('html','￥ -'+ totalPrice.promotion);
                                $('cart-promotion-subtotal').set('html','￥ '+ totalPrice.final);
                            }.bind(this),
                            onFailure: function (xhr) {
                                $('btnjiesuan').setProperty('disabled', true);
                                $('btnjiesuan').setStyles({'background': '#CCCCCC'});
                                Message.error("购物车商品参数有误，请删除之后再试");
                                
                            }.bind(this)
                        }).send();

                    },
                    updateCartNum: function (num) {
                    var carttotalnum = Cookie.read('carttotalNum'+'<?= Yii::$app->user->getId()?>');
                    if(carttotalnum && num)
                    {
                        $('cart_num').set('html',Number(carttotalnum) + Number(num));
                        Cookie.write('carttotalNum'+'<?= Yii::$app->user->getId()?>', Number(carttotalnum) + Number(num), {path:'/'});
                    }
                    else {
                        new Request({
                                url: "<?= Url::to(['cart/getcarttotalnum']); ?>",
                                method: 'get',
                                link: 'cancel',
                                onSuccess: function (carttotalnum) {
                                    $('cart_num').set('html',carttotalnum);
                                    Cookie.write('carttotalNum'+'<?= Yii::$app->user->getId()?>', carttotalnum, {path:'/'});
                                }.bind(this),
                                onFailure: function (xhr) {
                                    Message.error("请稍后再试");
                                }.bind(this)
                            }).send();

                        }
                    },
                    
                    updateWidgetsCartNum: function (cart_number) {
                        
                    },
                    updateWillGetPromotion: function (unuse_rule) {
                        if (unuse_rule) {
                            var _cart_will_getsalespromotion = $('cart-will-get-sales-promotion');

                            var _unuse_rule_html = "";
                            var _tr = "";

                            unuse_rule.each(function (item, index) {
                                _tr += "<tr><td class=\"span-2\">" + item.name + "</td>" + "<td class=\"span-6\" style=\"text-align:left\">" + item.desc + "</td>" + "<td class=\"span-6\" style=\"text-align:left\">" + item.solution + "</td></tr>";
                            });
                            var _html = ' <h4>赶快行动得促销优惠</h4><table width="100%" cellpadding="3" cellspacing="0">{_unuse_rule_html}</table>';
                            _html = _html.substitute({'_unuse_rule_html': _tr});
                            if (!_cart_will_getsalespromotion) {
                                _cart_will_getsalespromotion = new Element('div', {"id": "cart-will-get-sales-promotion", "class": "sales-promotion clearfix", "html": _html});
                                _cart_will_getsalespromotion.inject($('cart-return-btn'), 'after');
                            } else {
                                _cart_will_getsalespromotion.set('html', _html);
                            }
                        } else {
                            var _cart_will_getsalespromotion = $('cart-will-get-sales-promotion');
                            if (_cart_will_getsalespromotion)
                                _cart_will_getsalespromotion.destroy();
                        }
                    },
                    updatePromotion: function (promotion) {
                        
                    },
                    updateNum: function (input, data, error_msg) {
                        //data = JSON.decode(data);

                        var item = input.getParent('tr'), _node_error = input.getElements('.t');
                        _node_error.set('html', error_msg);
                        item.set('buy_store', input.value);

                        ['buy_price'].each(function (str, i) {
                            //['buy_price','consume_score'].each(function(str,i){
                            var el = item.getElement('.' + str);
                            el.set('text', '￥'+data);
                        });
                        var table = item.getParent('table');
                        var buy_price = table.getElements('.buy_price');
                        var total_price = 0;
                        buy_price.each(function (data) {
                            var price = parseInt(data.get('html').replace('¥', '') * 100);
                            total_price += price;
                        });
                        var arr = (total_price + '').split('');
                        var new_total_price = '';
                        for (var i = 0; i < arr.length; i++) {
                            if (i === arr.length - 2) {
                                new_total_price += ('.' + arr[i]);
                            }
                            else {
                                new_total_price += arr[i];
                            }

                        }
                        //            table.getElement('.store_total_price').set('text','¥'+new_total_price);
                    },
                    updateTotal: function (remoteURL, options) {
                        options = options || {};
                        new Request(Object.append({'method': 'post', url: remoteURL}, options)).send();
                        if ($$('.cart-money-total'))
                            $$('.cart-money-total').set('text', Cookie.read('S[CART_TOTAL_PRICE]') || 0);
                    },
                    empty: function (remoteURL) {
                        var _this = this;

                        Ex_Dialog.confirm('确认清空购物车？', function (e) {
                            if (!e)
                                return;
                            new Request({
                                url: remoteURL,
                                data: 'response_type=true',
                                onComplete: function (res) {
                                    var _success_res = JSON.decode(res);
                                    if (_success_res && _success_res.error) {
                                        Message.error(_success_res.error);
                                    } else {
                                        Message.success('清空购物车成功！', function () {
                                            //location.reload();
                                            var _empty_html = '<div class="cart-empty" id="goodsbody"><div class="w400 ma clearfix"><img src="/app/b2c/statics/bundle/empty_pic.gif" class="flt m5"/>     <p class="pt10">您的购物车里还没有商品,您可以：<br />将收藏夹中的商品添加进来<br />或者去看看&nbsp;<a href="./" class="font-orange">首页>></a></p></div></div>';
                                            $('cart-index').set('html', _empty_html);

                                            //** 更新购物车商品数量
                                            _this.updateWidgetsCartNum(_success_res.number);
                                            $$('.cart-number').set('text', Cookie.read('S[CART_COUNT]') || 0);
                                            if ($$('.cart-money-total'))
                                                $$('.cart-money-total').set('text', Cookie.read('S[CART_TOTAL_PRICE]') || 0);
                                        });
                                    }
                                }
                            }).post();
                        });
                    }
                });

                if ($('cart-items'))
                    $('form-cart').getLast('div').addEvents({
                        'mousedown': function (e) {
                            var target = $(e.target);
                            if (target.hasClass('numadjust'))
                                target.addClass('active');
                            else if (target.hasClass('order-btn') || target.getParent('.order-btn')) {
                                var ipt = $$('input[name^=modify_quantity[]:focus')[0];
                                if (ipt) {
                                    ipt.removeEvents('change').addEvent('change', function (e) {
                                        Cart.ItemNumUpdate(this, this.value, e, true);
                                    });
                                }
                            }
                        },
                        'mouseup': function (e) {
                            var target = $(e.target);
                            if (target.hasClass('numadjust'))
                                target.removeClass('active')
                        },
                        'keydown': function (e) {
                            var target = $(e.target);
                            if (target.hasClass('textcenter')) {
                                if (target.getParent('tr').getAttribute('floatstore').toInt() == 1) {
                                    if (e.code == 110 || e.code == 190)
                                        e.code = 48; //小数
                                }
                                if (!Cart.utility.keyCodeFix.contains(e.code)) {
                                    e.stop();
                                }
                            }
                        },
                        'click': function (e) {
                            var target = $(e.target);
                            if (target.hasClass('numadjust')) {
                                var num = target.hasClass('increase') ? 1 : -1;
                                var ipt = target.getParent('.numadjust-arr').getElement('input');
                                if (num == -1 && ipt.value < 1)
                                    return;
                                return Cart.ItemNumUpdate(ipt, num, e);
                            }
                            if (target.hasClass('delItem')) {
                                Cart.removeItem(target);
                                //同事删除赠品add by ql
                                var child_id = e.target.getParent('tr').get('chlid_id');
                                if (child_id && $ES("." + child_id)) {
                                    $ES("." + child_id).destroy();
                                }
                            }
                        }
                    });

            }();

            /*
             * 使用优惠券
             */
            function userCoupons(obj, store_id) {
                var fastbuy = "";
                var coupon_value = obj.options[obj.options.selectedIndex].value;
                var url = '<?= Yii::$app->params['baseUrl'] ?>cart-add-coupon.html';
                if (fastbuy) {
                    url = '/fastbuy-add-coupon.html';
                    if (coupon_value == 'no') {
                        url = '/fastbuy-remove_store_coupon-coupon.html';
                    }
                } else {
                    if (coupon_value == 'no') {
                        url = '<?= Yii::$app->params['baseUrl'] ?>cart-remove_store_coupon-coupon.html';
                    }
                }

                new Request({
                    url: url,
                    method: 'post',
                    data: 'coupon=' + coupon_value + "&response_type=true&store_id=" + store_id,
                    onSuccess: function (res) {
                        var re = JSON.decode(res);

                        if (!re) {
                            Message.error('优惠券删除成功');
                        } else {
                            if (!re.success) {
                                Message.error('' + re.msg + '');
                            } else {
                                var con = re.data;
                                if (con[0].used == true) {
                                } else {
                                    Message.error('优惠券不适用');
                                }
                            }
                        }
                        //				var item = $('shipping_' + store_id);
                        //				var shipping = item.getChildren('select');
                        //				shipping = shipping[0];
                        //				var shipping_id = shipping.options[shipping.options.selectedIndex].value;
                        //				Order.updateStore(store_id, shipping_id);
                        var input = $$('input[name^=modify_quantity]').shift();
                        Cart.ItemNumUpdate(input, input.getAttribute('value'), null);
                    }
                }).send();
            }
            $$('.btn_coupon').addEvent('click', function (data) {
                var style = $$('.coupon_body_dv').shift().getAttribute('style') ? "" : 'display:none';
                $$('.coupon_body_dv').shift().setAttribute('style', style)

            });
        </script>
    </div>
</div>
<!-- <div class="sidebar-right">
    <a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
    <a href="javascript:void(0)" class="sidebar-backtop"></a>
    <a href="javascript:void(0)" class="sidebar-close"></a>
</div> -->
<script>
    (function () {
        $$('.sidebar-backtop').addEvent('click', function () {
            $(window).scrollTo(0, 0)
        });
        $$('.sidebar-close').addEvent('click', function () {
            $$('.sidebar-right').setStyle('display', 'none')
        });
        jQuery("a[id^='store_promotion_detail_switch_']").each(function()
        {
           jQuery(this).click(function(){ 
                jQuery(this).parents('tr').find('ul').slideToggle(); 
                if(jQuery(this).html() =='&nbsp;详情&gt;&gt;')
                    jQuery(this).html('&nbsp;隐藏<<');
                else
                    jQuery(this).html('&nbsp;详情&gt;&gt;');
                }); 
        });

        if(Cart)
        {
            Cart.updatePrice(true,0,0);
        }

    })();
</script>