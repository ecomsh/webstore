<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mobile\assets\ftzmallmobilenew\CheckoutAsset;

CheckoutAsset::register($this);
/* @var $this yii\web\View */
$this->title = '确认订单';
?>
<section class="ui-container">
    <div class="order-wrapper">
        <form action="" method="post" autocomplete="off" target="_blank">
            <?php if($isCBT){ ?>
            <section class="order-item-group order-realname">
                <div class="item-title">
                    <img src="<?=Url::base()?>/themes/wxnew/images/realname.png" class="order-item-icon">
                    <span class="title">实名认证</span>
                </div>
                <?php if($isRealname === FALSE){ ?>
                <a href="javascript:;" class="order-item">
                    <div class="h2">
                        <span class="realname-label">姓名：</span><span class="real-name"><?=$realnameInfo['realName']?></span>
                    </div>
                    <div class="h2">
                        <span class="realname-label">手机：</span><span class="real-telephone"><?=$realnameInfo['mobile']?></span>
                    </div>
                    <div class="h2">
                        <span class="realname-label">邮箱：</span><span class="real-mail"><?=$realnameInfo['email']?></span>
                    </div>
                    <div class="h2">
                        <span class="realname-label">证件：</span><span class="real-card">身份证</span><span class="realcard-num"><?=$realnameInfo['identityNumber']?></span>
                    </div>
                </a>
                <?php } else { ?>
                <a href="<?=Url::to(['realname/index', 'returnUrl' => $returnUrl])?>" class="order-item ui-arrowlink">
                    您还没有进行实名认证，快去验证吧
                </a>
                <?php } ?>
            </section>
            <?php } ?>
            <section class="order-item-group order-address">
                <div class="item-title">
                    <img src="<?=Url::base()?>/themes/wxnew/images/address.png" class="order-item-icon">
                    <span class="title">收货信息</span>
                </div>
                
                <?php if (empty($addressData) === FALSE) { ?>
                    <?php if($isCBT && $addressData[0]['isDefault'] == 1) { ?>
                        <a href="javascript:;" id="address-list" class="order-item ui-arrowlink">
                            <div class="h2">
                                <span class="name"><?=$addressData[0]['receiverName']?></span>
                                <span class="telephone"><?=$addressData[0]['receiverMobile']?></span>
                            </div>
                            <div class="address"><?=$addressData[0]['address']?></div>
                        </a>
                    <?php }else{ ?>
                        <a href="javascript:;" id="address-list" class="order-item ui-arrowlink">
                            选择地址
                        </a>
                    <?php }?>
                <?php }else{ ?>
                    <a href="javascript:;" id="address-list" class="order-item ui-arrowlink">
                        添加地址
                    </a>
                <?php } ?>
                
                <!--<a href="javascript:;" id="order-time" class="order-item ui-arrowlink">
                    <div class="h2">收货时间不限</div>
                </a>-->
            </section>
            <section class="order-list order-item-group">
                <div class="item-title">
                    <img src="<?=Url::base()?>/themes/wxnew/images/order.png" class="order-item-icon">
                    <?php if(isset(Yii::$app->params['sm']['cart']['store'][substr($orderType, 0,2)])){ ?>
                    <span class="title"><?=  Yii::$app->params['sm']['cart']['store'][substr($orderType, 0,2)]?></span>
                    <?php } else {?>
                    <span class="title"><?=  substr($orderType,2)?></span>
                    <?php } ?>
                </div>
                <?php
                foreach ($CartLines as $val)
                {
                ?>
                    <div class="order-item clear">
                        <div class="product-left">
                            <?php if (isset($val['children']) === FALSE): ?>
                                <div class="product-item">
                                    <div class="product-title"><?=$val['itemDisplayText']?></div>
                                    <div class="product-weight">商品重量：<span><?=$val['itemWeight'].$val['itemWeightUOM']?></span></div>
                                </div>
                            <?php else : ?>
                                <?php foreach ($val['children'] as $child){ ?>
                                <div class="product-item">
                                    <div class="product-title"><span class="font-color7"><?=$child['quantity']?>件 | </span><?=$child['itemDisplayText']?></div>
                                    <div class="product-weight">商品重量：<span><?=$child['Sales-Weight'].$child['Sales-WeightUOM']?></span></div>
                                </div>
                                <?php } ?>
                            <?php endif; ?>
                        </div>
                        <div class="product-price">
                            <?php if (isset($price['itemDetail'][$val['itemId']]['newUnitPrice'])): ?>
                                ￥<?= Yii::$app->formatter->asDecimal(((float) $price['itemDetail'][$val['itemId']]['newTotalPrice'])) ?>
                                <span class="old-price">
                                    <?php $offerPrice = ($val['itemOfferPrice'] - $price['itemDetail'][$val['itemId']]['newUnitPrice']) * $val['cartlineQuantity'] ?>
                                    ￥<?= Yii::$app->formatter->asDecimal($offerPrice) ?>
                                </span>
                            <?php elseif(isset($price['itemDetail'][$val['itemId']]['unitPrice']) && $price['itemDetail'][$val['itemId']]['unitPrice'] >= $val['itemOfferPrice']): ?> 
                                ￥<?= Yii::$app->formatter->asDecimal(((float) $price['itemDetail'][$val['itemId']]['newTotalPrice'])) ?>
                            <?php else: ?> 
                                ￥<?= Yii::$app->formatter->asDecimal(((float) $price['itemDetail'][$val['itemId']]['unitPrice'] * $val['cartlineQuantity'])) ?>
                                <span class="old-price">
                                    <?php $newOfferPrice = ($val['itemOfferPrice'] - $price['itemDetail'][$val['itemId']]['unitPrice']) * $val['cartlineQuantity'] ?>
                                    ￥<?= Yii::$app->formatter->asDecimal($newOfferPrice) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="product-num">X<?= $val['cartlineQuantity'] ?></div>
                    </div>
                <?php
                }
                ?>
               <!-- 优惠券 -->

               <div class="order-coupon radio-div order-item clear">
               		<div class="h2 fl">
               			<span>不使用优惠券/优惠码</span>
               		</div>
               		<div class="check-box fr" id="no-order-coupon">
               			<input type="radio" name="coupon-radio" value="不使用">
               		</div>
               </div>
               <div class="order-coupon radio-div order-item clear">
               		<div class="h2 fl">
               			<span>使用优惠券</span>
               		</div>
               		<div class="check-box fr" id="order-coupon">
               			<input type="radio" name="coupon-radio" value="优惠券">
               		</div>
               </div>
               <div class="order-coupon radio-div order-item clear" >
               		<div class="h2 fl">
               			<span>激活优惠码</span>
               		</div>
               		<div class="check-box fr" id="order-coupon-code">
               			<input type="radio" name="coupon-radio" value="优惠码">
               		</div>
               </div>
            </section>
            <section class="order-money order-item-group">
                <div class="item-title">
                    <img src="<?=Url::base()?>/themes/wxnew/images/price.png" class="order-item-icon">
                    <span class="title">结算金额</span>
                </div>
                <div class="order-item clear">
                    <div class="product-label fl">商品总价</div>
                    <div class="product-value fr order-total">￥<?= $price['orderDetail']['originalPrice'] ?></div>
                </div>
                <div class="order-item clear">
                    <div class="product-label fl">优惠金额</div>
                    <div class="product-value fr">
                        <span class="font-color1 activity1">
                            <?php if(isset($price['orderDetail']['orderPromotionName'][0])){ ?>
                            【<?= $price['orderDetail']['orderPromotionName'][0]?>】
                            <?php } ?>
                        </span>
                        <span class='activity-span'>-￥<?= $price['orderDetail']['promotion'] ?></span>
                    </div>
                </div>
                <div class="order-item clear">
                    <div class="product-label fl">合计运费</div>
                    <div class="product-value fr">
                        <span class="font-color1 free-activity">
                            <?php if(isset($price['orderDetail']['orderFreeShipment'])){ ?>
                            【<?= $price['orderDetail']['orderFreeShipment']?>】
                            <?php } ?>
                        </span>
                        <span class="freight-span">￥<?= $price['orderDetail']['shipping'] ?></span>
                    </div>
                </div>
                <?php if($isCBT === TRUE){ ?>
                <div class="order-item clear">
                    <div class="product-label fl">关税</div>
                    <div class="product-value fr">
                        <span class="font-color1 tariffs-msg">
                        <?php if($price['orderDetail']['tax'] <= 50){ ?>
                            关税≤50，免征！
                        <?php } ?>
                        </span>
                        <span class="order-tariffs <?= $price['orderDetail']['tax'] <= 50 ? 'old-price-tax' : '' ?>">￥<?= $price['orderDetail']['tax'] ?></span>
                    </div>
                </div>
                <?php } ?>
                <!--<div class="order-item">
                    <div class="product-label fl">优惠券</div>
                    <div class="product-value fr">￥0</div>
                </div>-->
                <div class="order-item clear">
                    <div class="product-label fl">还需支付</div>
                    <div class="product-value fr">
                        <span class="font-color1 amount-payable">￥<?= $price['orderDetail']['actualPrice'] ?></span>
                    </div>
                </div>
            </section>
            <section class="order-item-group pay-type">
                <div class="item-title">
                    <img src="<?=Url::base()?>/themes/wxnew/images/card.png" class="order-item-icon">
                    <span>支付方式</span>
                </div>
                <?php
                    if (\Yii::$app->params['devicedetect']['isWeixin'])
                    {
                ?>
                <div class="payitem order-item clear selected">
                    <div class="h2 fl">
                        <span class="order-item-icon1 weixin"></span>
                        <span>微信支付</span>
                    </div>
                    <div class="check-box fr">
                        <input type="radio" checked="checked" name="payType" value="wechat"/>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                <div class="payitem order-item clear selected">
                    <div class="h2 fl">
                        <span class="order-item-icon1 zhifubao"></span>
                        <span>支付宝支付</span>
                    </div>
                    <div class="check-box fr">
                        <input type="radio" checked="checked" name="payType" value="AliPay"/>
                    </div>
                </div>
                <?php
                    }
                ?>
                <!--<div class="payitem order-item clear">
                    <div class="h2 fl">
                        <span class="order-item-icon1 caifutong"></span>
                        <span>财付通支付</span>
                    </div>
                    <div class="check-box fr">
                        <input type="radio" name="payType" value="TenPay"/>
                    </div>
                </div>-->
            </section>
            <?php if(!$isCBT){ ?>
            <section class="invoiceitem-type order-item-group">
                <div class="item-title">
                    <img src="<?=Url::base()?>/themes/wxnew/images/fapiao.png" class="order-item-icon">
                    <span>发票</span>
                </div>
                <div class="invoiceitem checkbox-div order-item clear">
                    <div class="h2 fl">
                        <span class="order-item-icon1"></span>
                        <span>发票</span>
                    </div>
                    <div class="check-box fr">
                        <input type="checkbox" id='invoice-switch' name="gatewayaaa" value=""/>
                    </div>
                </div>
                <div class="invoiceitem radio-div order-item clear">
                    <div class="h2 fl">
                        <span>开票方式：纸质发票</span>
                    </div>
                    <div class="check-box fr">
                        <input type="radio" name="gate" value="" disabled/>
                    </div>
                </div>
                <div class="order-item">
                    <div class="invoiceitem radio-div clear">
                        <div class="h2 fl">
                            <span>开票抬头：个人</span>
                        </div>
                        <div class="check-box fr">
                            <input type="radio" name="invoice-radio" value="个人" disabled/>
                        </div>
                    </div>
                    <div class="invoiceitem radio-div company clear">
                        <div class="h2 fl">
                            <span>　　　　　公司
                                <input type="text" class="company-name" id="invName" placeholder="请输入公司名称" value="" disabled/>
                            </span>
                        </div>
                        <div class="check-box fr">
                            <input type="radio" class="company-radio" name="invoice-radio" value="公司" disabled/>
                        </div>
                    </div>
                </div>
            </section>
            <?php } ?>
            <section class="order-item clear submit-btn-wrapper">
                <div class="cart-price fl">
                    <div class="total-price-txt">
                        <span>总额：</span>
                        <span class="total-price amount-payable">￥<?= $price['orderDetail']['actualPrice'] ?></span>
                    </div>
                </div>
                <a class="go-check-out fr" isSbumit = 'T'>
                    <input type="button" name="" value="提 交"/>
                </a>
            </section>
            <!--<section class="choose-send-way order-item-group">
                <div class="send-ways">
                    <div class="btn-bar order-item clear">
                        <a href="javascript:;" class="cancel fl" id="choose-send-cancel">取消</a>
                        <a href="javascript:;" class="sure fr" id="choose-send-sure">确定</a>
                    </div>
                    <div class="send-way order-item selected">
                        <input type="radio" name="shipping-time" value="3"/>
                        <label>收货时间不限</label>
                    </div>
                    <div class="send-way order-item">
                        <input type="radio" name="shipping-time" value="1"/>
                        <label>仅工作日送货</label>
                    </div>
                    <div class="send-way order-item">
                        <input type="radio" name="shipping-time" value="2"/>
                        <label>仅双休与节假日收货</label>
                    </div>
                </div>
            </section>-->
           <!--  优惠券弹层start -->
           <section class="ui-bg choose-order-coupon">
                <div class="ui-bottom-box order-coupon-list">
                    <div class="ui-bottom-title clear">
                        <a href="javascript:;" class="ui-bottom-cancel fl coupon-bar" id="choose-coupon-cancel">取消</a>
                        <a href="javascript:;" class="ui-bottom-sure fr coupon-bar" id="choose-coupon-sure">确定</a>
                    </div>
                    <ul class="ui-bottom-content" id='coupon_select_list'>
                        
                    </ul>        
                </div>
            </section> 
             <!--  优惠券弹层end -->
            <!--  激活优惠码弹层start -->
            <section class="ui-dialog" >
                <div class="ui-dialog-cnt">
                    <div class="ui-dialog-bd">
                        <h4>激活优惠码</h4>
                        <input type="text" class="input-coupons" id="input-coupon-code" name="" value="" placeholder="请输入优惠码"/>
                    </div>
                    <div class="ui-dialog-ft">
                        <button type="button" class="code-cancel">取消</button>
                        <button type="button" class="code-sure">立即激活</button>
                    </div>
                </div>
            </section>

            <!--  激活优惠码弹层end -->
        </form>
    </div>
    <section class="ui-bg address-list-box">
        <div class="ui-bottom-box address-list-box address-div">
            <div class="ui-bottom-title clear">
                <a class="ui-bottom-cancel fl" id="address-cancel">取消</a>
                <a class="ui-bottom-sure fr" id="address-sure">确定</a>
            </div>
            <div class="ui-bottom-content">
                <ul class="address-list-box">
                    <?php 
                    foreach ($addressData as $address)
                    {
                    ?>
                        <li class="address-item <?php if($isCBT && $address['isDefault'] == 1) { ?> selected <?php } ?>" addressId='<?= $address['addressId']?>' district="<?= $address['districtCode'] ?>" state="<?= $address['stateCode'] ?>" city="<?= $address['cityCode'] ?>" postcode="<?= $address['postcode'] ?>">
                            <div class="address-info">
                                <div class="h2">
                                    <span class="name"><?= $address['receiverName'] ?></span>
                                    <span class="telephone"><?= $address['receiverMobile'] ?></span>
                                </div>
                                <div class="address">
                                    <?= $address['address'] ?>
                                </div>
                            </div>
                            <div class="address-edit">		
                                <span><a href="<?=  Url::to(['address/update', 'id'=>$address['addressId'] , 'returnUrl' => $returnUrl])?>">编辑</a></span>
                            </div>
                        </li>
                    <?php
                    }
                    ?>	
                </ul>
                <a class="add-address-box" id="newAddress" count="<?=count($addressData)?>" href="<?=  Url::to(['address/create', 'returnUrl' => $returnUrl])?>">添加地址</a>
            </div>
        </div>
    </section>
</section>

<?php //Html::beginForm(['order/pay'], 'post', ['id' => 'payForm', 'enctype' => 'multipart/form-data']) ?>
<!--    <input type="hidden" class="check_id" id='orderId' name="orderId" value="" >
    <input type="hidden" id="payMethod" name="payMethod" value="" >
    <input type="hidden" id='subject' name="subject" value="" >
    <input type="hidden" name="itemSum" value=4 >
    <input type="hidden" name="return_url_pay" value="<?= Url::to(['order/index'], true) ?>" >-->
<?php //Html::endForm() ?>
    
<?= Html::beginForm(['pay/wx'], 'get', ['id' => 'payForm', 'enctype' => 'multipart/form-data']) ?>
    <input type="hidden" class="check_id" id='orderId' name="orderId" value="" >
<?= Html::endForm() ?>
    
<?= Html::beginForm(['order/pay'], 'post', ['id' => 'webPayForm', 'enctype' => 'multipart/form-data']) ?>
    <input type="hidden" class="check_id" id='webOrderId' name="orderId" value="" >
    <input type="hidden" id="payMethod" name="payMethod" value="" >
    <input type="hidden" id='subject' name="subject" value="" >
    <input type="hidden" name="itemSum" value=4 >
    <input type="hidden" name="return_url_pay" value="<?= Url::to(['order/index'], true) ?>" >
<?= Html::endForm() ?>

<?= Html::beginForm('','',['id' => 'orderForm']) ?>
    <?php if($isCBT && isset($addressData[0]) && $addressData[0]['isDefault'] == 1) { ?>
        <input type="hidden" id='addressId' value="<?= $addressData[0]['addressId'] ?>" >
    <?php }else{ ?>
        <input type="hidden" id='addressId' value="" >
    <?php } ?>
    <input type="hidden" id="shipinst" value="3" >
    <input type="hidden" id='invcategory' value='' >
    <input type="hidden" id='invName' value="" >
<?= Html::endForm() ?>

<script>
    var getInventoryUrl = "<?= Url::to(['inventory/check-inventorys']); ?>";
    var getPriceUrl = "<?= Url::to(['cart/price']); ?>";
    var submitUrl = "<?= Url::to(['order/create']); ?>";

    var _csrf = "<?= $_csrf ?>";
    var itemInfo = {<?php foreach ($CartLines as $val){echo "'" . $val['itemPartNumber'] . "':'" . $val['itemOwnerId'] . "',";} ?>};
    var cartlineIds = "<?= $CartLinesIds ?>";
    var orderType = "<?= $orderType ?>";
    var canSubmit = "<?= $price['orderDetail']['canSubmit'] ?>";
    var itemIdsInfo = '<?= $itemIdsInfo ?>';
    var orderId = '';
    var maxAmount = <?= Yii::$app->params['sm']['store']['maxAmount'] ?>;
    var orderAmount = <?= $price['orderDetail']['originalPrice'] - $price['orderDetail']['promotion']?>;
    var channelId = "<?= isset($channelId) ? $channelId : 'ftzmall' ?>";
    
    var isRealName = '<?=$isRealname?>';
    var isCBT = '<?=$isCBT?>';
    
    var listCouponUrl = "<?=Url::to(['cart/list-valid-coupons']);?>";
    var activeCouponUrl = "<?=Url::to(['cart/active-coupon']);?>";
    var selectedCouponId = null;
    
</script>