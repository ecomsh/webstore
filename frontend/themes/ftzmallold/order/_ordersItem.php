<?php
use yii\helpers\Url;
use common\helpers\Tools;
use yii\helpers\Html;
?>
<tr>
    <td class="vt">
        <a href="<?= Url::to(['order/orderdetail', 'orderId'=>$model['orderId']])?>" class="operate-btn" data-pjax="0">
            <?=$model['orderId']?>
        </a>
    </td>
    <td class="horizontal-m">
        <?php foreach($model['orderLineList'] as $val){ ?>
        <div class="clearfix">
            <div class="product-list-img member-gift-pic goodpic" isrc="<?=$val['itemImageLink']?>" ghref="<?=$val['shopLink']?>">
                <a href="<?=Url::to(['product/view','id'=>$val['itemId']])?>" target="_blank" style="border: 0px;" data-pjax="0">
                    <img src = "<?php echo json_decode($val['itemImageLink'],true)['img'];?>" width="70" height="70" style="cursor: pointer;">;
                </a>
            </div>
            <div class="goods-main clearfix">
                <div class="goodinfo">
                    <h3>
                        <a target="_blank" class="font-blue" href="<?= Url::to(['product/view','id'=>$val['itemId']]) ?>" data-pjax="0">
                            <?=$val['itemDisplayText']?>
                        </a>
                    </h3>
                </div>
                <div class="member-gift-price price-wrap clearfix">
                    <ul>
                        <li>￥<?=$val['unitPrice']?></li>
                        <li>×<?=$val['quantity']?></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- gift -->

        <!-- extends -->
    </td>
    <!--<td  class="textwrap"></td> -->
    <td class="point textcenter"><ul>
            <li>￥<?= $model['totalAmount']?></li>
                                    <?php if ($model['shippingAmount'] > 0): ?>
                                    <li>(含运费：￥<?=$model['shippingAmount']?>)</li>
                                    <?php endif?>
                                    <?php if ($model['taxAmount'] > 50): ?>
                                    <li>(含税费：￥<?=$model['taxAmount']?>)</li>
                                    <?php endif?>

        </ul>
    </td>
    <td><?= Tools::showDate('Y-m-d',$model['createTimestamp']); ?></td>
    <td><?= $model['orderLineList'][0]['itemOwnerId']?><br>
    </td>
    <td class="textcenter">
        <div style="width:100px;display:block;margin:0 auto;">
            <?=   isset(Yii::$app->params['sm']['order']['status'][$model['orderStatus']])?Yii::$app->params['sm']['order']['status'][$model['orderStatus']]:''?>
        </div>
    </td>
    <td>
        <?php if(in_array($model['orderStatus'], $conditions['payment'])){ ?>
            <a href="javascript:void(0);" name="payment" orderId ="<?=$model['orderId']?>" class="paymoney_btn operate-btn" data-pjax="0">立即支付</a>         
        <?php } ?>
        <?php if(in_array($model['orderStatus'], $conditions['confirmreceived'])){ 
            echo Html::a(Html::encode('确认收货'), ['order/confirmreceived', 'id' => $model['orderId']], ['data' => ['confirm' => '确定已收到货物?'] , 'data-pjax' => 0,'class' => 'paymoney_btn operate-btn']);
         } ?>
        <a href="<?= Url::to(['order/orderdetail', 'orderId'=>$model['orderId']])?>" data-pjax="0" class="font-blue operate-btn">查看订单</a>
        <!--订单的取消-->
        <?php if(in_array($model['orderStatus'], $conditions['cancelorder'])){ 
        echo Html::a(Html::encode('取消订单'), ['order/cancelorder', 'id' => $model['orderId']], ['data' => ['confirm' => '确定取消订单?'] , 'data-pjax' => 0,'class' => 'font-blue operate-btn']);
        } ?>
        <?php if(in_array($model['orderStatus'], $conditions['aftersales'])){ ?>
        <a href="<?= Url::to(['aftersales/add', 'orderId'=>$model['orderId']])?>" data-pjax="0" class="font-blue operate-btn">申请退货</a>
        <?php } ?>
        <!--<a href="<?= Yii::$app->params['baseUrl'] ?>complain-add.html" class="font-blue operate-btn">投诉卖家</a>-->
    </td>
</tr>