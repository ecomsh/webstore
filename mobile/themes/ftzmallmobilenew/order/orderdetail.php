<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Tools;
use mobile\assets\ftzmallmobilenew\OrderAsset;
OrderAsset::register($this);
/* @var $this yii\web\View */
$this->title = '订单详情';
Yii::$app->formatter->nullDisplay = '0.00';
?>
<section class="ui-container">
	<section class="order-item-group">
		<div class="item-title">订单编号：<?=$order['orderId']?></div>
		<div class="item-title">订单金额：￥<?=Yii::$app->formatter->asDecimal($order['totalAmount'])?></div>
		<div class="item-title">下单日期：<?=  \common\helpers\Tools::showDate('Y-m-d H:i:s', $order['createTimestamp'])?></div>
		<div class="order-item">订单状态：<?=  Yii::$app->params['sm']['order']['status'][$order['orderStatus']]?></div>
	</section>
	<section class="order-item-group">
		<?php foreach($order['orderLineList'] as $val){ ?>
			<div class="order-product-div">
	            <?php if($val['itemType'] != 'package' || !isset($packageChildren[$val['itemId']]['children'])){ ?>
	                <a href="<?= Url::to(['product/view','id'=>$val['itemId']]) ?>" class="ui-arrowlink">
	                    <div class="order-product-img"><img src="<?= Tools::qnImg(Html::encode($val['itemImageLink']),50,50);?>" onerror="javascript:this.src='<?=Url::base()?>/themes/wxnew/images/notfound.jpg'"></div>
	                    <div class="order-product-info">
	                            <div class="order-product-name ui-nowrap-multi">
	                                    <?=$val['itemDisplayText']?>
	                            </div>
	                            <span class="order-product-price">￥<?= Yii::$app->formatter->asDecimal($val['unitPrice'])?></span>
	                            <span class="order-product-num">X<?=$val['quantity']?></span>
	                    </div>
	                </a>
	            <?php }else{ ?>
		          
		                <?php foreach($packageChildren[$val['itemId']]['children'] as $childId => $child){ ?>
                                    <?php if(isset($child['parentCatentryId'])):?>
                                    <a href="<?= Url::to(['product/view','id'=>$child['parentCatentryId']]) ?>" class="ui-arrowlink">
                                    <?php else:?>
                                    <a href="<?= Url::to(['product/view','id'=>$childId]) ?>" class="ui-arrowlink">
                                    <?php endif;?>
		                        <div class="order-product-img"><img src="<?= Tools::qnImg(Html::encode($child['itemImageLink']),50,50);?>" onerror="javascript:this.src='<?=Url::base()?>/themes/wxnew/images/notfound.jpg'"></div>
		                        <div class="order-product-info">
		                                <div class="order-product-name ui-nowrap-multi">
		                                	<label class="zuhe-label">[组合]<?=$child['quantity']?>件 </label>
		                                    |  <?=$child['itemDisplayText']?>
		                                </div>
		                        </div>
		                    </a>
		                <?php } ?>
		                <div style="text-align:right;font-size:.75rem;">
		                	<div class="order-product-num">X<?=$val['quantity']?></div>
		                	组合价：<span style="color:#ed145b;">￥<?= Yii::$app->formatter->asDecimal($val['unitPrice'])?></span>
		                </div>
		           
	            <?php } ?>
	            
	        </div>
		<?php } ?>
	</section>
	<section class="order-item-group">
		<div class="item-title clear">
			<span class="fl"> <?= $order['shippingReceiverName']?></span>
			<span class="fr"><?= $order['shippingReceiverMobile']?></span>
		</div>
		<div class="order-item">
			<span class="order-item-span"><?= $order['shippingAddress']?></span>
			<span class="order-item-span"> 邮编：<?= $order['shippingPostcode']?><span>
		</div>
	</section>
	<!-- 支付信息start 这里嵌套多层是因为判断商品信息显示的问题 -->
	<?php if(!empty($paymentInfo)){ ?>
	<section>
		<?php
			foreach($paymentInfo as $val){
				if($val['state'] == 1){ 
		?>
		<section class="pay-item-group">
			<section class="pay-item">
				<div class="item-title clear">
					<span class="fl">支付方式：</span>
					<span class="fr"><?=  Yii::$app->params['sm']['store']['payType'][$val['paymentmethod']]?></span>
				</div>
				<div class="item-title clear">
					<span class="fl">支付金额：</span>
					<span class="fr"><?=Yii::$app->formatter->asDecimal($val['amount'])?></span>
				</div>
				<div class="item-title clear">
					<span class="fl">支付时间：</span>
					<span class="fr"><?=$val['successTimestamp']?></span>
				</div>
			</section>
		</section>
		<?php 
		}
		} 
		?>
	</section> 
	<?php } ?>
	<!-- 支付信息end -->
	<section class="order-item-group">
		<div class="item-title clear">
			<span class="fl">商品金额：</span>
			<span class="fr">￥<?=Yii::$app->formatter->asDecimal($order['total'])?></span>
		</div>
		<div class="item-title clear">
			<span class="fl">优惠金额：</span>
			<span class="fr">￥<?=Yii::$app->formatter->asDecimal(abs($order['adjustmentAmount']))?></span>
		</div>
		<div class="item-title clear">
			<span class="fl">运费：</span>
			<span class="fr">￥<?=Yii::$app->formatter->asDecimal($order['shippingAmount'])?></span>
		</div>
		<div class="item-title clear">
			<span class="fl">税费：</span>
			<span class="fr">￥<?=Yii::$app->formatter->asDecimal($order['taxAmount'])?></span>
		</div>
		<div class="order-item clear">
			<span class="fl">总金额：</span>
			<span class="fr">￥<?=Yii::$app->formatter->asDecimal($order['totalAmount'])?></span>
		</div>
	</section>
	<section class="order-item-group other-item">
		<div class="item-title clear">
			<span class="fl">配送方式：<?=$order['shippingType']?></span>
			<span class="fr">运费:￥<?=Yii::$app->formatter->asDecimal($order['shippingAmount'])?></span>
		</div>
		<!--<div class="order-item">订单留言：请给我发好货！</div>-->
	</section>
</section>