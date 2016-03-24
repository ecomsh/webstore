<?php
use yii\helpers\Url;
use common\helpers\Tools;
use yii\helpers\Html;
?>

<tr>
    <td class="text-center order-col1">
        <label><?=$model['orderId']?></label>
    </td>
    <td class="order-col2">
        <ul class="proinfo">
        <?php foreach($model['orderLineList'] as $val){ ?>
            <?php if($val['itemType'] != 'package' || !isset($packageChildren[$val['itemId']]['children'])){ ?>
            <li class="proinfo-li">
                <span class="column2">
                    <div  class="column2">
                        <div class="product-information clearfix">
                            <img src="<?= Tools::qnImg(Html::encode($val['itemImageLink']),60,60);?>" onerror="javascript:this.src='<?=Url::base()?>/themes/ftzmallnew/src/images/notfound.jpg'" class="product-img">
                            <div class="product-inf">
                                <a class="product-name" title="<?=$val['itemDisplayText']?>" href="<?=Url::to(['product/view','id'=>$val['itemId']])?>">
                                    <?=  Tools::substr_mb($val['itemDisplayText'],30)?>
                                </a>
                            </div>
                        </div>
                    </div>
                </span>
                <span class="column3">￥<?=$val['unitPrice']?><br>x<?=$val['quantity']?></span>
            </li>
            <?php }else{ ?>
                <li class="proinfo-li">
                    <span class="column2">
                        <div class="column2">
                            <?php foreach($packageChildren[$val['itemId']]['children'] as $itemId => $child){ ?>
                            <div class="product-information clearfix">
                                <img src="<?= Tools::qnImg(Html::encode($child['itemImageLink']),60,60);?>" onerror="javascript:this.src='<?=Url::base()?>/themes/ftzmallnew/src/images/notfound.jpg'" class="product-img">
                                <div class="product-inf">
                                    <?php if(isset($child['parentCatentryId'])):?>
                                    <a class="product-name" title="<?=$child['itemDisplayText']?>" href="<?=Url::to(['product/view','id'=>$child['parentCatentryId']])?>">
                                    <?php else:?>
                                    <a class="product-name" title="<?=$child['itemDisplayText']?>" href="<?=Url::to(['product/view','id'=>$itemId])?>">
                                    <?php endif;?>
                                        <label class="font-color7"><?=$child['quantity']?>件 |  </label>
                                        <?=  Tools::substr_mb($child['itemDisplayText'],30)?>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </span>
                    <span class="column3">￥<?=$val['unitPrice']?><br>x<?=$val['quantity']?></span>
                </li>
            <?php } ?>
        <?php } ?>
        </ul>
    </td>
    <td class="text-center order-col3">
        <em>￥<?= $model['totalAmount']?></em>
        <?php if ($model['shippingAmount'] > 0): ?>
        <br>(含运费：￥<?=$model['shippingAmount']?>)
        <?php endif?>
        <?php if ($model['taxAmount'] > 50): ?>
        <br>(含税费：￥<?=$model['taxAmount']?>)
        <?php endif?>
    </td>
    <td class="text-center order-col4">
        <label class="order-color"><?= Tools::showDate('Y-m-d',$model['createTimestamp']); ?></label>
    </td>
    <td class="text-center order-col5">
        <label class="order-color"><?=$model['orderLineList'][0]['itemOwnerId']?></label>
    </td>
    <td class="text-center order-col6">
        <em><?=   isset(Yii::$app->params['sm']['order']['status'][$model['orderStatus']])?Yii::$app->params['sm']['order']['status'][$model['orderStatus']]:''?></em>
    </td>
    <td class="text-center order-col7">
        <label>
        <?php if(in_array($model['orderStatus'], $conditions['payment'])){ ?>
        <a href="<?=Url::to(['order/payment','orderIds' => $model['orderId']])?>" name="payment" target="_blank" class="paymoney_btn operate-btn" data-pjax="0">立即支付</a><BR>         
        <?php } ?>
        <?php if(in_array($model['orderStatus'], $conditions['confirmreceived'])){ 
            echo Html::a(Html::encode('确认收货'), ['order/confirmreceived', 'id' => $model['orderId']], ['data' => ['confirm' => '确定已收到货物?'] , 'data-pjax' => 0,'class' => 'paymoney_btn operate-btn']).'<BR>';
         } ?>
        <a href="<?= Url::to(['order/orderdetail', 'orderId'=>$model['orderId']])?>" data-pjax="0" class="font-blue operate-btn">查看订单</a><BR>
        <!--订单的取消-->
        <?php if(in_array($model['orderStatus'], $conditions['cancelorder']) && Yii::$app->params['sm']['order']['isShowButton']){ 
        echo Html::a(Html::encode('取消订单'), ['order/cancelorder', 'id' => $model['orderId']], ['data' => ['confirm' => '确定取消订单?'] , 'data-pjax' => 0,'class' => 'font-blue operate-btn']).'<BR>';
        } ?>
        <?php if(in_array($model['orderStatus'], $conditions['aftersales'])){ ?>
        <a href="<?= Url::to(['aftersales/add', 'orderId'=>$model['orderId']])?>" data-pjax="0" class="font-blue operate-btn">申请退货</a><BR>
        <?php } ?>
        </label>
    </td>
</tr>
