<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use common\helpers\Tools;
use frontend\assets\ftzmallnew\PaymentAsset;

PaymentAsset::register($this);

/* @var $this yii\web\View */
$this->title = '支付订单_上海外高桥进口商品网';
?>
<div class="container checkout-container">
    <div class="orders-success">
            <h4>订单提交成功，现在只差最后一步了！</h4>
            <p>请尽快完成付款，活动结束或者商品售罄后您的订单将被取消！</p>
            <?php foreach($orderInfos['orderLineList'] as $val){?>
            <span><?=$val['itemDisplayText']?></span>
            <?php } ?>
            <span>收货信息：<?=$orderInfos['shippingAddress']?> ，收货人：<?=$orderInfos['shippingReceiverName']?>，手机：<?=$orderInfos['shippingReceiverMobile']?></span>
            <label class="pull-right"><a href="<?=Url::to(['order/index'])?>">我的订单></a></label>
    </div>
    <div class="pay-price">
            <h4 class="pay-money">支付金额：<i>￥<?=$orderInfos['totalAmount']?></i>
                <label class="pull-right">
                    <span href="#"  class="thereason" data-toogle="popover" data-placement="bottom" data-content="上海外高桥进口商品网商品需清关后入境，根据海关需求，需要您填写您的身份证进行个人物品入境申报。<br/>因为海关会对您的身份信息进行验证，请确保填写正确，否则商品可能无法正常通关。<br/>身份证信息将加密保管，绝不对外泄漏。">关于实名认证？
                    </span>
                </label>
            </h4>
            <div class="alipay-div">
                    <label class="radio-inline alipay1">
                            <span class="radio-pay-bg radio-time-bg-checked">
                                    <input type="radio" name="pay-method" id="pay-method1" class="radio-pay" value="AliPay">
                            </span>
                    </label><br>
                    <label class="radio-inline alipay2">
                            <span class="radio-pay-bg">
                                    <input type="radio" name="pay-method" id="pay-method2" class="radio-pay" value="TenPay">
                            </span>
                    </label>
            </div>
            <?= Html::beginForm(['order/pay'], 'post', ['id' => 'payForm', 'enctype' => 'multipart/form-data', 'target' => '_blank', 'isSubmit' => 'T']) ?>
                <input type="hidden" class="check_id" id='orderId' name="orderId" value="<?=$orderInfos['orderId']?>" >
                <input type="hidden" id="payMethod" name="payMethod" value="AliPay" >
                <input type="hidden" id='subject' name="subject" value="<?=$orderInfos['orderId']?>" >
                <input type="hidden" name="itemSum" value=4 >
                <input type="hidden" name="return_url_pay" value="<?= Url::to(['order/index'], true) ?>" >
                <?php if(in_array($orderInfos['orderStatus'], Yii::$app->params['sm']['store']['showButton']['payment'])){ ?>
                <button type="submit" class="btn btn-pay" id="payBtn"  data-toggle="modal" data-target="#myModal" >用支付宝去支付</button>
                <?php } else{ ?>
                <a href="<?=Url::to(['order/index'])?>"><button type="button" class="btn btn-pay" >我的订单</button></a>
                <?php } ?>
            <?= Html::endForm() ?>
    </div>
    <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
            <div class="modal-dialog" role="document">
                    <div class="modal-content pay-modal">
                            <div class="modal-header pay-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p class="add-title pay-color">提示</p>
                            </div>
                            <div class="modal-body modal-p">
                                    <h4 class="pay-title">请在第三方支付页面完成付款<br>付款完成前请不要关闭此窗口</h4>
                                    <div class="pay-btn">
                                        <a href="<?=Url::to(['order/index'])?>"><button type="button" class="btn btn-paysucc">我已付款成功</button></a>
                                        <button type="button" id="closeWin" class="btn btn-default btn-payfail" aria-hidden="true">付款遇到问题，重新支付</button>
                                    </div>
                            </div>
                    </div>
            </div>
    </div>
</div>