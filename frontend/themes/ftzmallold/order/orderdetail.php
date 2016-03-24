<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Tools;
Yii::$app->formatter->nullDisplay = '0.00';
/* @var $this yii\web\View */
$this->title = '订单详情_上海外高桥进口商品网';
?>

<!--right-->
<div class = "member-main" style = "width: 960px;">
    <div style = "height:auto">
        <div class = "title title2">订单信息</div>
        <table border = "0" width = "100%" cellpadding = "0" cellspacing = "0" class = "order-info gridlist_member" style = "margin:10px 0 20px 0">
            <tbody><tr>
                    <!--order status -->
                    <td width = "40%" valign = "top"><ul>
                            <li>订单号：<span class = "price-normal"><?= $order['orderId']?></span></li>
                            <li>订单金额：<span class = "point">￥<?=Yii::$app->formatter->asDecimal($order['totalAmount'])?></span></li>
                            <li>订单状态：<span class = "siteparttitle-blue"><?=  Yii::$app->params['sm']['order']['status'][$order['orderStatus']]?></span><!--<span class = "siteparttitle-blue">已支付[未发货]</span>--></li>
                        </ul>
                    </td>
                    <!--order action -->
                    <td width = "40%" valign = "top">
                            <?php if(in_array($order['orderStatus'], $conditions['shippment'])){ ?>
                                <div class = "explan"> 
                                说明：店家已经收到您的付款，正在备货，稍后将会发货。
                                </div>
                            <?php }else if(in_array($order['orderStatus'], $conditions['confirmreceived'])){ ?>
                                <div class = "explan"> 
                                说明：店家已经发货，请您关注货物的物流状态。
                                </div>
                            <?php }else if(in_array($order['orderStatus'], $conditions['payment'])){?>
                                <div class = "explan"> 
                                说明： 请根据支付 方式说明进行付款，付款后可通过 网站信息联系我们。 
                                </div>
                            <?php }?>
                    </td>
                    <td width = "20%" valign = "top" align = "right" style = "padding-right:20px">
                        <?php if(in_array($order['orderStatus'], $conditions['payment'])){ ?>
                        <div id="order_detail_act_area">
                            <button type="button" class="btn submit-btn pay-bg btn_go_pay" name="pay-btn" id="pay-btn" rel="_payorder">
                                <span><span>去付款</span></span>
                            </button>
                        </div>
                        <?= Html::beginForm(['order/payment'], 'get', ['enctype' => 'multipart/form-data', 'id' => 'frm_pay', 'target' => '_blank']) ?>
                        <?=Html::hiddenInput('orderIds',$order['orderId'])?>
                        <?= Html::endForm()?>
                        <?php
                        $js = "jQuery(\"#pay-btn\").click(function(){
                            jQuery('#frm_pay').submit();
                            });";
                        $this->registerJs($js);
                        ?>
                        <?php  } else { ?>
                        <!--<div class = "lave-word"><a href = "javascript:void(0);" id = "odr_msg" class = "btn-w" title = "order_msg" data-uri = "{url:'<?= Yii::$app->params['baseUrl'] ?>msg-add.html',target:'_blank'}" rel = "_payorder">我要留言</a></div>-->
                        <?php } ?>
                    </td>
                </tr>
            </tbody></table>
        <!--common order info -->
        <div class = "order-track" style = "border:none">
            <div id = "order_des" class = "switch">
                <ul class = "switchable-triggerBox tab_member clearfix">
                    <li class = "active"><a href = "javascript:void(0);">订单追踪</a></li>
                    <!--<li><a href="javascript:void(0);">付款信息</a></li>-->
                </ul>
                <div class = "switchable-content switchable-content2">
                    <div class = "switchable-panel">
                        <div class = "box">
                            <div class = "flow">
                                <table cellspacing = "0" cellpadding = "0" border = "0" width = "100%">
                                    <tbody><tr>
                                            <?php
                                                $status = [
                                                    'CREATED' => '提交订单',
                                                    'SCHEDULED' => '等待确认',
                                                    'RELEASED' => '捡配货物',
                                                    'INCLUDED_IN_SHIPPMENT' => '店家发货',
                                                    ];
                                                $i = 0;
                                                $bgClass = 'bg4';
                                                foreach($status as $key=>$val){
                                                    $i++;
                                                    if($order['orderStatus'] == $key){
                                                        $bgClass = 'bg'.$i;
                                                        $val = '<span class = "point">'.$val.'</span>';
                                                    }
                                            ?>
                                                <td class = "box-td"><?=$val?></td>
                                            <?php
                                                }
                                            ?>
                                        </tr>
                                        <tr>
                                            <td colspan = "5" class = "flow-bg"><div class = "flow-bg <?=$bgClass?>"></div><!--<div class = "flow-bg bg3"></div>--></td>
                                        </tr>
                                    </tbody></table>
                            </div>
                            
                            <?php foreach($log as $val){?>
                            <p><?= Tools::showDate('Y-m-d H:i:s', $val['processTime']) ?>&nbsp;&nbsp;<?=$val['processInfo']?></p>
                            <?php } ?>
                            <!--cq交易完结<p>
	2015-07-06 12:52&nbsp;&nbsp;订单<a href="javascript:void(0)" onclick="show_delivery_item(this,&quot;120150706628509991&quot;,[{&quot;number&quot;:&quot;1.00&quot;,&quot;name&quot;:&quot;Emporio Armani \u5b89\u666e\u91cc\u5965\u00b7\u963f\u739b\u5c3c \u7537\u58eb\u77ed\u8896&quot;},{&quot;number&quot;:&quot;1.00&quot;,&quot;name&quot;:&quot;Emporio Armani \u5b89\u666e\u91cc\u5965\u00b7\u963f\u739b\u5c3c \u7537\u58eb\u77ed\u8896&quot;}])" title="点击查看详细" style="color: rgb(0, 51, 102); font-weight: bolder; text-decoration: underline;">全部商品</a>发货完成，物流公司：<a class="lnk" target="_blank" title="圆通速递" href="http://www.yto.net.cn/">圆通速递</a>（可点击进入物流公司网站跟踪配送）		，物流单号：<a href="http://www.ftzmall.com.cn/logistic-pull-120150706628509991.html" class="classless-delivery-id" deliveryid="120150706628509991">200174293293</a>
	</p><div id="120150706628509991" class="note" style="overflow: hidden; height: 100%; width: 96%; display: none;"><div style="clear: left;"><div class="span-9">购买的商品：Emporio Armani 安普里奥·阿玛尼 男士短袖</div><div class="span-9">数量：1.00</div><div class="span-9">购买的商品：Emporio Armani 安普里奥·阿玛尼 男士短袖</div><div class="span-9">数量：1.00</div></div></div>-->
                           
                            <script>

                                $$('.classless-delivery-id').addEvent('click', function(e) {
                                    var target = e.target, href = target.get('href'), deliveryid = target.get('deliveryid'), p = target.getParent('p');
                                    var logisticdomid = 'logistic-' + deliveryid, logisticdom = $(logisticdomid);
                                    e.stop(); // prevent jump
                                    if (!logisticdom) { //
                                        logisticdom = {destroy: function() {
                                            }};
                                        new Request({
                                            url: href, noCache: true, async: false,
                                            onSuccess: function(responseText, responseXML) {
                                                var newdom = new Element('div', {html: responseText, 'class': 'logistic-info', id: logisticdomid});
                                                newdom.inject(p, 'after');
                                            }
                                        }).get();
                                    } else {
                                        logisticdom.destroy();
                                    }
                                });

                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 物流单查询相关css 应放到css文件中 -->


            <script>
                (function() {
                    Ex_Event_Group['_payorder'] = {
                        fn: function(el, e) {
                            e.stop();
                            el = $(el.target) || $(el);
                            if (el.get('data-uri')) {
                                var data = JSON.decode(el.get('data-uri'));
                                if (data.target == '_blank') {
                                    _open(data.url, data.params || {});
                                }
                                else {
                                    location.href = data.url;
                                }
                            }
                        }
                    };
                })();

                var tabs = new Switchable('order_des', {autoplay: false});

            </script>

            <div class="cart-wrap ">
                <div class="FormWrap gift-bag order-trace">
                    <!-- <h4>商品</h4> -->
                    <table width="100%" cellspacing="0" cellpadding="3" class="gridlist gridlist_member">
                        <colgroup><col class="span-auto">
                            <col class="span-2">
                            <!-- <col class="span-2"> -->
                            <col class="span-3">
                        </colgroup><tbody><tr>
                                <th class="bln">商品</th>
                                <th>数量</th>
                                <th>金额小计</th>
                            </tr>
                        </tbody><tbody>
                            <?php foreach($order['orderLineList'] as $val){ ?>
                            <tr>
                                <td>
                                    <div class="clearfix horizontal-m">

                                        <div class="product-list-img goodpic" isrc="<?=$val['itemImageLink']?>" ghref="<?=$val['itemLink']?>" style="width:50px;height:50px; margin:0 5px">
                                            <a href="<?= Url::to(['product/view','id'=>$val['itemId']]) ?>" target="_blank" style="border: 0px;">
                                                <img src="<?= json_decode($val['itemImageLink'],true)['img'] ?>" width="50" height="50" style="cursor: pointer;">
                                            </a>
                                        </div>
                                        <div class="goods-main">
                                            <div class="goodinfo fl">
                                                <h3>
                                                    <a target="_blank" class="font-blue" href="<?= Url::to(['product/view','id'=>$val['itemId']]) ?>">
                                                        <?=$val['itemDisplayText']?>
                                                    </a>
                                                </h3>
                                            </div>
                                            <div class="good-wrap order-goodpirce fr">
                                                <ul>
                                                    <li class="price-normal">￥<?= Yii::$app->formatter->asDecimal($val['unitPrice'])?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="textcenter vm"><?=$val['quantity']?></td>
                                <td class="textcenter vm font-orange">￥<?= Yii::$app->formatter->asDecimal($val['quantity']*$val['unitPrice'])?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <h4>收货信息</h4>
                    <table width="100%" cellspacing="0" cellpadding="0" class="takegoods">
                        <tbody>
                            <tr>
                                <th>配送地区：</th>
                                <td><?=$order['shippingStateName'].$order['shippingCityName'].$order['shippingDistrictName']?></td>
                            </tr>
                            <tr>
                                <th>收货地址：</th>
                                <td><?=$order['shippingAddress']?></td>
                            </tr>
                            <tr>
                                <th>收货人邮编：</th>
                                <td><?=$order['shippingPostcode']?></td>
                            </tr>
                            <tr>
                                <th>收货人姓名：</th>
                                <td><?=$order['shippingReceiverName']?></td>
                            </tr>
                            <tr>
                                <th>联系电话：</th>
                                <td><?=$order['shippingReceiverMobile']?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>配送方式</h4>
                    <table cellspacing="0" cellpadding="0" border="0" width="100%" class="takegoods">
                        <tbody><tr>
                                <th>配送方式：</th><td><?=$order['shippingType']?></td></tr>
                            <tr><th>配送费用：</th><td><span class="point">￥<?=Yii::$app->formatter->asDecimal($order['shippingAmount'])?></span></td>
                            </tr>
                        </tbody></table>
                    <?php if(!empty($paymentInfo)){ ?>
                    <h4>支付信息</h4>
                    <table cellspacing="0" cellpadding="0" border="0" width="100%" class="takegoods">
                        <tbody>
                            <?php
                            foreach($paymentInfo as $val){ 
                                if($val['state'] == '1'){
                            ?>
                            <tr>
                                <th>支付方式:</th>
                                <td><?=  Yii::$app->params['sm']['store']['payType'][$val['paymentmethod']]?></td>
                            </tr>
                            <tr>
                                <th>支付金额:</th>
                                <td><?=$val['amount']?></td>
                            </tr>
                            <tr>
                                <th>支付时间:</th>
                                <td><?=$val['successTimestamp']?></td>
                            </tr>
                            <?php 
                                }
                            }
                            ?>
                        </tbody></table>
                    <?php } ?>
                    
                    <h4>结算信息</h4>
                    <table border="0" cellspacing="0" cellpadding="0" class="liststyle data" style="border:none" width="100%">
                        <colgroup><col width="88%">
                            <col width="12%">
                        </colgroup><tbody><tr>
                                <th>商品总金额:</th>
                                <td class="font14px font-orange">￥<?=Yii::$app->formatter->asDecimal($order['total']+$adjustmentAmount)?></td>
                            </tr>
                            <tr>
                                <th>优惠费用:</th>
                                <td class="font14px">-￥<?=Yii::$app->formatter->asDecimal($adjustmentAmount)?></td>
                            </tr>
                            <tr>
                                <th>配送费用:</th>
                                <td class="font14px">￥<?=Yii::$app->formatter->asDecimal($order['shippingAmount'])?></td>
                            </tr>
                            <tr>
                                <th>商品进口税金:</th>
                                <td class="font14px">￥<?=Yii::$app->formatter->asDecimal($order['taxAmount'])?></td>
                            </tr>
                            <tr>
                                <th>订单总金额:</th>
                                <td class="font16px font-orange fontbold">￥<?=Yii::$app->formatter->asDecimal($order['totalAmount'])?></td>
                            </tr>
                                                        <!--<tr>
                                                                        <th>已付金额:</th>
                                                                        <td class="font14px">￥262.00</td>
                                                                </tr>-->
                        </tbody></table>
<!--                    <h4>订单留言</h4>
                    <ul>
                        <li class="p5 pl20 pr20 clearfix"><p class="flt w500"><span class="fontbold">标题：</span>麻烦店家了</p><span class="frt"><span class="fontbold">留言人：</span>hezll</span></li>
                        <li class="p5 pl20 pr20 clearfix"><p class="w500 flt"><span class="fontbold">内容：</span>麻烦店家了</p><span class="frt">2015-07-03 11:44</span></li>
                    </ul>-->
                    <!-- order info end -->

                </div></div></div></div></div>
<script>
    function show_delivery_item(cur_obj, key, item_info) {
        if ($(cur_obj).getParent().getNext("div[id=" + key + "]")) {
            var obj = $(cur_obj).getParent().getNext("div[id=" + key + "]");
            if (obj.style.display == 'none') {
                obj.style.display = '';
            } else {
                obj.style.display = 'none';
            }
        } else {
            var div1 = new Element("div", {
                'id': key,
                'style': 'overflow:hidden;height:100%;width:96%',
                'class': 'note'
            }).inject($(cur_obj).getParent(), 'after');
            var div2 = new Element('div', {
                'style': 'clear:left'
            }).inject(div1);

            item_info.each(function(item) {
                new Element('div', {'class': 'span-9'}).set('text', '购买的商品：' + item['name']).inject(div2);
                new Element('div', {'class': 'span-9'}).set('text', '数量：' + item['number']).inject(div2);
            });
        }
    }

    /*小图mouseenter效果*/
    window.addEvent('domready', function() {

        var cart_product_img_viewer = new Element('div', {styles: {'position': 'absolute', 'zIndex': 500, 'opacity': 0, 'border': '1px #666 solid'}}).inject(document.body);

        var cpiv_show = function(img, event) {

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

        $$('.FormWrap .product-list-img').each(function(i) {

            new Asset.image(i.get('isrc'), {onload: function(img) {
                    if (!img)
                        return;
                    var _img = img.zoomImg(50, 50);
                    if (!_img)
                        return;
                    _img.setStyle('cursor', 'pointer').addEvents({
                        'mouseenter': function(e) {
                            cpiv_show(_img, e);
                        },
                        'mouseleave': function(e) {
                            cart_product_img_viewer.fade(0);
                        }
                    });
                    i.empty().adopt(new Element('a', {href: i.get('ghref'), target: '_blank', styles: {border: 0}}).adopt(_img));
                }, onerror: function() {
                    i.empty();

                }});

        });

    });

</script>
<!-- right-->
