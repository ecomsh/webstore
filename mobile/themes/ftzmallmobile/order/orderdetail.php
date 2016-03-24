<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '订单详情_上海外高桥进口商品网';
?>

    <div class="m-page" style="min-height: 693px;">
        <div class="full-screen">
            <div class="top-holder">
                <div class="fixed-top">
                    <div class="m-header">
                        <div class="header-left-btn">
                            <span onclick="history.back()" class="icon-back"></span>
                        </div>
                        <h2>我的订单</h2>
                        <div class="header-right-btn">
                            <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 订单留言 -->

            <div class="section">
                <div class="c-fix" style="height:auto">
                   <div class="clearfix">
                    <span class="l-k">订单号：</span>
                    <span class="l-v"><?=$order['orderId']?></span>
                   </div>
                   <div class="clearfix">
                    <span class="l-k">总金额：</span>
                    <span class="l-v">￥<?=$order['totalAmount']?></span>
                   </div>
                   <div class="clearfix">
                    <span class="l-k">订单状态：</span>
                    <span class="l-v"><?=  Yii::$app->params['sm']['order']['status'][$order['orderStatus']]?></span>
                   </div>
                   <div class="clearfix">
                    <span class="l-k">下单日期：</span>
                    <span class="l-v"><?=  \common\helpers\Tools::showDate('Y-m-d H:i:s', $order['createTimestamp'])?></span>
                   </div>
                </div>
            </div>
            <div class="section">
                <div class="c-fix" style="height:auto">
                    <div class="clearfix">
                    <span class="l-k">收货地址：</span>
                    <span class="l-v"><?= $order['shippingAddress']?></span>
                    </div>
                    <div class="clearfix">
                    <span class="l-k">邮编：</span>
                    <span class="l-v"><?= $order['shippingPostcode']?>s</span>
                    </div>
                    <div class="clearfix">
                    <span class="l-k">姓名：</span>
                    <span class="l-v"><?= $order['shippingReceiverName']?></span>
                    </div>
                    <div class="clearfix">
                    <span class="l-k">联系电话：</span>
                    <span class="l-v"><?= $order['shippingReceiverMobile']?></span>
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="c-fix">
                    <span class="l-k">配送方式：</span>
                    <span class="col"><?=$order['shippingType']?></span>
                    <span class="l-v" style="float:right;">
                        <span class="col t-r">运费:<span class="f-red">￥<?=$order['shippingAmount']?></span>元</span>
                    </span>
                </div>
            </div>
            <?php if(!empty($paymentInfo) && $paymentInfo['state'] == 1){ ?>
            <div class="section">
                <div class="c-fix">
                   <div class="clearfix">
                    <span class="l-k">支付方式：</span>
                    <span class="l-v"><?=  Yii::$app->params['sm']['store']['payType'][$paymentInfo['paymentmethod']]?></span>
                   </div>
                   <div class="clearfix">
                    <span class="l-k">支付金额：</span>
                    <span class="l-v"><?=$paymentInfo['amount']?></span>
                    </div>
                    <div class="clearfix">
                    <span class="l-k">支付时间：</span>
                    <span class="l-v"><?=$paymentInfo['successTimestamp']?></span>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="section">
                <span class="k">商品清单：</span>
                <ul class="pt-list">
                    <?php foreach($order['orderLineList'] as $val){ ?>
                    <li class="pt-h-item c-fix">
                        <a href="<?= Url::to(['product/view','id'=>$val['itemId']]) ?>" class="pt-h-link">
                            <div class="pt-h-img"><img src="<?= json_decode($val['itemImageLink'],true)['img'] ?>">
                            </div>
                            <div class="pt-h-info">
                                <div class="pt-h-name">
                                    <?=$val['itemDisplayText']?>
                                </div>
                                <div class="pt-h-other">
                                </div>
                                <div class="col2">
                                    <div class="col price">
                                        ￥<?= Yii::$app->formatter->asDecimal($val['unitPrice'])?>
                                    </div>
                                    <div class="col t-r">
                                        数量：<?=$val['quantity']?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="section">
                <div>
                    <span class="l-k">订单留言：</span>
                    <div class="l-v" style="margin-left:2rem;color:#575252;font-size:0.9rem;">
                        请给我发好货！
                    </div>
                </div>
            </div>
            <div class="section">
                <div class="clearfix">
                    <span class="k l-k">
                        商品金额：
                    </span>
                    <span class="v price">
                        ￥<?=Yii::$app->formatter->asDecimal($order['total']+$adjustmentAmount)?>
                    </span>
                </div>
                <div class="clearfix">
                    <span class="k l-k">
                        运费：
                    </span>
                    <span class="v price">
                            ￥<?=$order['shippingAmount']?>                
                    </span>
                </div>
                <div class="clearfix">
                    <span class="k l-k">
                        优惠金额：
                    </span>
                    <span class="v price">
                        -￥<?=Yii::$app->formatter->asDecimal($adjustmentAmount)?>
                    </span>
                </div>
                <div class="total">
                    <span class="k">
                        总金额：
                    </span>
                    <span class="v price">
                        ￥<?=$order['totalAmount']?>
                    </span>
                </div>
            </div>
        </div>
    </div>