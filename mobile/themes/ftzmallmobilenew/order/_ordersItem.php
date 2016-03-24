<?php
use yii\helpers\Url;
use common\helpers\Tools;
use yii\helpers\Html;
?>

<li class="mem-order-item">
    <div class="icon orange">
        <?=   isset(Yii::$app->params['sm']['order']['status'][$model['orderStatus']])?Yii::$app->params['sm']['order']['status'][$model['orderStatus']]:''?>
    </div>
    <div onclick="window.location.href='<?=Url::to(['order/orderdetail','orderId' => $model['orderId']])?>'" class="ui-arrowlink order-info">
        <div class="col2">
            <div class="col">
                <div class="order-item">
                    订单编号：<?=$model['orderId']?>
                </div>
                 <div class="order-item">
                    订单时间：<?= Tools::showDate('Y-m-d H:i:s',$model['createTimestamp']); ?>
                </div>
                <div class="order-item">
                  应付金额：<span class="price">￥<?= $model['totalAmount']?></span>    
                </div>
               
            </div>
        </div>
   

	    <ul class="mem-order-pt clear">
	        <?php foreach($model['orderLineList'] as $val){ ?>
                <?php if($val['itemType'] != 'package' || !isset($packageChildren[$val['itemId']]['children'])){ ?>
                    <li class="mem-pt-item fl">
                        <a href="<?=Url::to(['product/view','id'=>$val['itemId']])?>" title="<?=$val['quantity']?>--<?=$val['itemDisplayText']?>">
                            <img src="<?= Tools::qnImg(Html::encode($val['itemImageLink']),50,50);?>" onerror="javascript:this.src='<?=Url::base()?>/themes/wxnew/images/notfound.jpg'">
                        </a>
                        <i class="num"><?=$val['quantity']?></i>
                    </li>
                <?php }else{ ?>
                    <?php foreach($packageChildren[$val['itemId']]['children'] as $itemId => $child){ ?>
                    <li class="mem-pt-item fl">
                        <?php if(isset($child['parentCatentryId'])):?>
                        <a href="<?=Url::to(['product/view','id'=>$child['parentCatentryId']])?>" title="<?=$child['quantity']?>--<?=$child['itemDisplayText']?>">
                        <?php else:?>
                        <a href="<?=Url::to(['product/view','id'=>$itemId])?>" title="<?=$child['quantity']?>--<?=$child['itemDisplayText']?>">
                        <?php endif;?>
                            <img src="<?= Tools::qnImg(Html::encode($child['itemImageLink']),50,50);?>" onerror="javascript:this.src='<?=Url::base()?>/themes/wxnew/images/notfound.jpg'">
                        </a>
                        <i class="num"><?=$child['quantity']?></i>
                    </li>
                    <?php } ?>
                <?php } ?>
	        <?php } ?>
	    </ul>
    </div>

        <div class="pay-list clear" id="J_pay_list">
            <!--<select type="select">-->
            <?php if(in_array($model['orderStatus'], $conditions['payment'])){ ?>
            <select class="fl">
<!--                <option value="a" selected>请选择支付方式</option>-->
                <?php
                    if (\Yii::$app->params['devicedetect']['isWeixin']){
                ?>
                <option value="b">微信</option>
                <?php }else{ ?>
                <option value="AliPay">支付宝</option>
                <?php } ?>
            </select>
            <?php } ?>
            <div class="fr">
                <?php if(in_array($model['orderStatus'], $conditions['payment'])){ ?> <!-- <span style="float:left;display:inline-block;" class="clearfix">已选支付方式：<span style="color:#b60009;">微信支付</span></span> --> <?php } ?>
                <span class="clear">
                    
                    <?php if(in_array($model['orderStatus'], $conditions['payment'])){ ?>
                        <?php
                            if (\Yii::$app->params['devicedetect']['isWeixin']){
                        ?>
                            <a href="<?= Url::to(['pay/wx','orderId'=> $model['orderId']])?>" class="fl">去支付</a>
                        <?php } else{?>
                            <a href="javascript:void(0)" orderId="<?=$model['orderId']?>" class="fl payBtn">去支付</a>
                        <?php } ?>
                    <?php } ?>
                    <?php if(in_array($model['orderStatus'], $conditions['confirmreceived'])){ 
                        echo Html::a(Html::encode('确认收货'), ['order/confirmreceived', 'id' => $model['orderId']], ['data' => ['confirm' => '确定已收到货物?'] , 'data-pjax' => 0,'class' => 'fl']);
                     } ?>
                    <!--订单的取消-->
                    <?php if(in_array($model['orderStatus'], $conditions['cancelorder']) && Yii::$app->params['sm']['order']['isShowButton']){ 
                    echo Html::a(Html::encode('取消订单'), ['order/cancelorder', 'id' => $model['orderId']], ['data' => ['confirm' => '确定取消订单?'] , 'data-pjax' => 0,'class' => 'fl']);
                    } ?>
                </span>
            </div>
        </div>
</li>