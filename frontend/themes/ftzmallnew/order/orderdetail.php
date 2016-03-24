<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Tools;
use frontend\assets\ftzmallnew\UserAsset;

Yii::$app->formatter->nullDisplay = '0.00';

UserAsset::register($this);


/* @var $this yii\web\View */
$this->title = '订单详情_上海外高桥进口商品网';
?>
<div class="container user-color">
    <?= $this->render('../layouts/_user-nav-left') ?>
    <div class="member-right-order">
        <div class="member-main">
            <div class="order-detail">
                <div class="title title2">订单信息</div>
                <table border="0" cellpadding="0" cellspacing="0" class="order-info gridlist_member">
                    <tbody>
                        <tr>
                            <td width="38%">
                                <ul>
                                    <li>订单号：<span class="price-normal"><?= $order['orderId']?></span></li>
                                    <li>订单金额：<span class="point">￥<?=Yii::$app->formatter->asDecimal($order['totalAmount'])?></span></li>
                                    <li>订单状态：<span class="siteparttitle-blue"><?=  Yii::$app->params['sm']['order']['status'][$order['orderStatus']]?></span></li>
                                </ul>
                            </td>
                            <td width="42%" >
                                <?php if(in_array($order['orderStatus'], $conditions['shippment'])){ ?> 
                                    <div class="alert alert-warning">
                                    说明：店家已经收到您的付款，正在备货，稍后将会发货。
                                    </div>
                                <?php }else if(in_array($order['orderStatus'], $conditions['confirmreceived'])){ ?>
                                    <div class="alert alert-warning">
                                    说明：店家已经发货，请您关注货物的物流状态。
                                    </div>
                                <?php }else if(in_array($order['orderStatus'], $conditions['payment'])){?>
                                    <div class="alert alert-warning">
                                    说明： 请根据支付 方式说明进行付款，付款后可通过 网站信息联系我们。
                                    </div>
                                <?php }?>
                            </td>
                            <td width="20%">
                                <!--<div class = "lave-word"><a href = "javascript:void(0);" id = "odr_msg" class = "btn-w" title = "order_msg" data-uri = "{url:'http://www.ftzmall.com/msg-add.html',target:'_blank'}" rel = "_payorder">我要留言</a></div>-->
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="order-track" style="border:none">
                    <div id="order_des" class="switch">
                        <ul class="switchable-triggerBox tab-member clearfix">
                            <li>
                                <a class="active" href="javascript:void(0);">订单追踪</a>
                            </li>
                        </ul>
                        <div class="switchable-content switchable-content2">
                            <div class="switchable-panel">
                                <div class="box">
                                    <div class="flow">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tbody>
                                                <tr>
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
                                                    <td colspan="5" class="flow-bg">
                                                        <div class="flow-bg <?=$bgClass?>"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <?php foreach($log as $val){?>
                                    <p><?= Tools::showDate('Y-m-d H:i:s', $val['processTime']) ?>&nbsp;&nbsp;<?=$val['processInfo']?></p>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cart-wrap ">
                        <div class="FormWrap gift-bag order-trace">
                            <table cellspacing="0" cellpadding="3" class="gridlist gridlist_member good-line">
                                <colgroup>
                                    <col class="span-auto">
                                    <col class="span-2">
                                    <col class="span-3">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th class="bln">商品</th>
                                        <th>数量</th>
                                        <th>金额小计</th>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <?php foreach($order['orderLineList'] as $val){ ?>
                                    <tr>
                                        <td class="good-left">
                                            <ul class="proinfo1">
                                                <li class="proinfo-li1">
                                                    <span class="pro-column1">
                                                        <div class="proinfo-list1">
                                                            <?php if($val['itemType'] != 'package' || !isset($packageChildren[$val['itemId']]['children'])){ ?>
                                                                <div class="product-information1 clearfix">
                                                                    <img src="<?= Tools::qnImg(Html::encode($val['itemImageLink']),50,50);?>" onerror="javascript:this.src='<?=Url::base()?>/themes/ftzmallnew/src/images/notfound.jpg'" class="product-img1">
                                                                    <div class="product-inf1">
                                                                        <a class="product-name1" href="<?= Url::to(['product/view','id'=>$val['itemId']]) ?>" target="_blank"><?=$val['itemDisplayText']?></a>
                                                                    </div>
                                                                </div>
                                                            <?php }else{ ?>
                                                                <?php foreach($packageChildren[$val['itemId']]['children'] as $childId => $child){ ?>
                                                                    <div class="product-information1 clearfix">
                                                                        <img src="<?= Tools::qnImg(Html::encode($child['itemImageLink']),50,50);?>" onerror="javascript:this.src='<?=Url::base()?>/themes/ftzmallnew/src/images/notfound.jpg'" class="product-img1">
                                                                        <div class="product-inf1">
                                                                            <?php if(isset($child['parentCatentryId'])):?>
                                                                            <a class="product-name1" href="<?= Url::to(['product/view','id'=>$child['parentCatentryId']]) ?>">
                                                                            <?php else:?>
                                                                            <a class="product-name1" href="<?= Url::to(['product/view','id'=>$childId]) ?>">
                                                                             <?php endif;?>
                                                                                <span class="font-color7"><?=$child['quantity']?>件 |  </span>
                                                                                <?=$child['itemDisplayText']?>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </span>
                                                    <span class="pro-column2 font-orange">￥<?= Yii::$app->formatter->asDecimal($val['unitPrice'])?></span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="text-center vm"><?=$val['quantity']?></td>
                                        <td class="text-center vm font-orange">￥<?= Yii::$app->formatter->asDecimal($val['quantity']*$val['unitPrice'])?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <h4>收货信息</h4>
                            <table cellspacing="0" cellpadding="0" class="takegoods">
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
                            <table cellspacing="0" cellpadding="0" class="takegoods">
                                <tbody>
                                    <tr>
                                        <th>配送方式：</th><td><?=$order['shippingType']?></td>
                                    </tr>
                                    <tr>
                                        <th>配送费用：</th>
                                        <td><span class="point">￥<?=Yii::$app->formatter->asDecimal($order['shippingAmount'])?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php if(empty($paymentInfo) === FALSE){ ?>
                            <h4>支付信息</h4>
                            <table cellspacing="0" cellpadding="0" border="0" class="takegoods">
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
                                </tbody>
                            </table>     
                            <?php } ?>
                            <h4>结算信息</h4>
                            <table border="0" cellspacing="0" cellpadding="0" class="liststyle data">
                                <colgroup>
                                    <col width="88%">
                                    <col width="12%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>商品总金额：</th>
                                        <td class="font-orange">￥<?=Yii::$app->formatter->asDecimal($order['total'])?></td>
                                    </tr>
                                    <tr>
                                        <th>优惠费用：</th>
                                        <td>-￥<?=Yii::$app->formatter->asDecimal(abs($order['adjustmentAmount']))?></td>
                                    </tr>
                                    <tr>
                                        <th>配送费用：</th>
                                        <td>￥<?=Yii::$app->formatter->asDecimal($order['shippingAmount'])?></td>
                                    </tr>
                                    <tr>
                                        <th>商品进口税金：</th>
                                        <td>￥<?=Yii::$app->formatter->asDecimal($order['taxAmount'])?></td>
                                    </tr>
                                    <tr>
                                        <th>订单总金额：</th>
                                        <td class="font16px font-orange fontbold">￥<?=Yii::$app->formatter->asDecimal($order['totalAmount'])?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
