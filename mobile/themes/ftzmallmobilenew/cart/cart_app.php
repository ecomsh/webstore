<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use mobile\assets\ftzmallmobilenew\CartAsset;
	use common\helpers\Tools;
	CartAsset::register($this);
	$this -> title = '购物车';
?>

<link href="/mobileapp/css/app.common.css" rel="stylesheet">

<header class="ui-header ui-header-positive ui-border-b">
	<div class="topbar-bigbox">
		<a href="<?= Yii::$app->request->referrer?>"><i class="ui-icon-return fl"></i></a>
		<div class="topbar-fontbox">购物车(<span id="total_cart_num" class="cart-num"><?=$totalCartNum?></span>)</div>
		<div class="fr edit">编辑</div>
		<div class="fr over">完成</div>
	</div>
</header>

<section class="ui-container">
	<p class="timing-clock">请在下单后 <span class="font-color4">30分钟</span>内完成支付</p>
		
	<div class="order-wrapper">
	<?php if ($allItems & is_array($allItems)) {
		foreach ($allItems as $type => $item):?>
		<?= Html::beginForm(['cart/checkoutapp'], 'post', ['id' =>"form-cart",'enctype' => 'multipart/form-data' , 'onsubmit'=>'return canCheckOut(this)']) ?>
		<p class="cart-prompt" storeid="<?=$type?>" style="display:none;"></p>
		<section class="order-item-group cart-list items-container" storeid="<?=$type?>">
            <div class="item-title clear">
                <div class="check-box fl selected">
                    <input type="checkbox" class="checkall">
                    <a href="javascript:;" class="all-checkbox"></a>
                </div>
                <?php if(isset($storeName[substr($type, 0,2)])):?>
                <span class="title"><?= $storeName[substr($type, 0,2)]?></span>
                <?php else:?>
                <span class="title"><?= substr($type, 2);?></span>
                <?php endif;?>          
            </div>
            
            <?php foreach ($item as $k => $v):?>

                        <?php if(isset($v['N-start'])) :?>
                        <div class="order-itemn" typeCode=<?= $v['N-metaData']['typecode'] ?> 
                         numOfGoods=<?= $v['N-metaData']['numOfGoods'] ?>  fixedPrice=<?= $v['N-metaData']['fixedPrice'] ?>>
                            <div class="itemn-title clear">
				<span class="tablen fl">N元任选</span>
				<div class="rule fl">
                                    <?php if(isset($v['N-status'])) :?>
                                    <span class="nselect-msg">
										<?=$v['N-status']['Msg'];?>
                                    </span>
                                    <?php endif;?>
                                    <?php if(isset($v['N-metaData']['mlandingpage'])) :?>
                                        <a target="_Blank" href="<?=$v['N-metaData']['mlandingpage'];?>" class="goto">再去看看 ></a>
                                    <?php endif;?>    
                                    
                                </div>
                            </div>
                        <?php endif;?>
                
                
				<div <?php if(isset($v['buyable']) && $v['buyable']>0):?> class="order-item clear single-item" <?php else:?> class="order-item clear single-item product-soldout" <?php endif;?>
						cartlineId=<?= $v['cartlineId'] ?> itemId=<?= $v['itemId'] ?> 
						<?php if(isset($v['tariffno'])):?> tariffno=<?=$v['tariffno'] ?> <?php else:?> tariffno="0"<?php endif;?>
						itemPartNumber=<?= $v['itemPartNumber'] ?> itemOwnerId=<?= $v['itemOwnerId'] ?>  shopId=<?= $v['shopId'] ?> >
					<div class="check-box dis-check">
						<input type="checkbox" class="ftzbox_<?= $type ?>" name="productsel[]" value="<?= $v['cartlineId'] ?>"/>
					</div>
					<div class="product-item">
						
					<?php if(isset($v['children'])):?>
						<div class="item-left">
						    <?php foreach($v['children'] as $cid => $cdetail):?>
                            	<?php if($mobileSystem=='ios'):?>
									<?php if(isset($cdetail['parentCatentryId'])):?>
                                    <a target="_blank" href="/product/app.html?id=<?=$cdetail['parentCatentryId']?>">
                                    <?php else:?>
                                    <a target="_blank" href="/product/app.html?id=<?=$cid?>">
                                    <?php endif;?>    
                                        <div class="product-img">
                                            <img src="<?=Tools::qnImg(Html::encode($cdetail['itemImageLink']), 72, 72);?>" onerror="javascript:this.src='<?= Url::base()?>/themes/wxnew/images/notfound.jpg'">
                                        </div>
                                    </a>
                                <?php else:?>
                                	<div class="product-img">
                                        <img src="<?=Tools::qnImg(Html::encode($cdetail['itemImageLink']), 72, 72);?>" onerror="javascript:this.src='<?= Url::base()?>/themes/wxnew/images/notfound.jpg'">
                                    </div>
                                <?php endif;?>
                                
					        <?php endforeach;?>
						</div>
						<div class="item-center">
							<?php foreach($v['children'] as $cid => $cdetail):?>
							<div class="product-info">
								<div class="product-title ui-nowrap-multi">
									<?php if($mobileSystem=='ios'):?>
                                        <?php if(isset($cdetail['parentCatentryId'])):?>
                                        <a target="_blank" href="/product/app.html?id=<?=$cdetail['parentCatentryId']?>" >
                                        <?php else:?>
                                        <a target="_blank" href="/product/app.html?id=<?=$cid?>" >
                                        <?php endif;?>
                                            <label class="font-color7"><?=$cdetail['quantity'];?>件 |</label> <?=$cdetail['itemDisplayText'];?>
                                        </a>
                                    <?php else:?>
                                    	<label class="font-color7"><?=$cdetail['quantity'];?>件 |</label> <?=$cdetail['itemDisplayText'];?>
                                    <?php endif;?>
                                </div>
								<?php if(isset($cdetail['itemTaxRate'])):?>
								<div class="product-rate">适用税率：<span><?= $cdetail['itemTaxRate'] ?></span></div>
								<?php endif;?>
							</div>
							<?php endforeach;?>
						</div>
					<?php else:?> 
						<div class="item-left">
							<div class="product-img">
                            	<?php if($mobileSystem=='ios'):?>
									<?php if(isset($v['parebtsItemId'])):?>
                                    <a target="_blank" href="/product/app.html?id=<?=$v['parebtsItemId']?>">
                                    <?php else:?>
                                    <a target="_blank" href="/product/app.html?id=<?=$v['itemId']?>">
                                    <?php endif;?>
                                    <img src="<?= Tools::qnImg(Html::encode($v['itemImageLink']), 72, 72);?>" onerror="javascript:this.src='<?= Url::base()?>/themes/wxnew/images/notfound.jpg'">
                                    </a>
                                <?php else:?>
                                	<img src="<?= Tools::qnImg(Html::encode($v['itemImageLink']), 72, 72);?>" onerror="javascript:this.src='<?= Url::base()?>/themes/wxnew/images/notfound.jpg'">
                                <?php endif;?>
							</div>
						</div>
						<div class="item-center">
							<div class="product-info">
								<div class="product-title ui-nowrap-multi">
                                	<?php if($mobileSystem=='ios'):?>
										<?php if(isset($v['parebtsItemId'])):?>
                                        <a target="_blank" href="/product/app.html?id=<?=$v['parebtsItemId']?>">
                                        <?php else:?>
                                        <a target="_blank" href="/product/app.html?id=<?=$v['itemId']?>">
                                        <?php endif;?>
                                            <?=$v['itemDisplayText']?>
                                        </a>
                                    <?php else:?>
                                    	<?=$v['itemDisplayText']?>
                                    <?php endif;?>
								</div>
								<?php if(in_array($v['itemSalestype'],Yii::$app->params['sm']['store']['isCBT'])):?>
								<div class="product-rate">适用税率：<span><?= $v['taxRate'] ?></span></div>
								<?php endif;?>
							</div>
						</div>
					<?php endif;?>
						<div class="product-num" style="display:none;">
							<div class="num-clear clear">
								<a href="javascript:;" class="quantity-subtract fl">-</a>
								<input type="text" class="product-quantity fl" name="" originalValue ="<?= $v['cartlineQuantity'] ?>" value="<?= $v['cartlineQuantity'] ?>"/>
								<a href="javascript:;" class="quantity-add fl">+</a>
							</div>
							<?php if(isset($v['maxBuyCount'])):?>
							<div class="limit-number limnum">限购<?= $v['maxBuyCount']?>件</div>
							<?php endif;?>
							<?php if(isset($v['minBuyCount'])):?>
							<div class="limit-number">起订<?= $v['minBuyCount'] ?>件</div>
							<?php endif;?>
							<div class="not-enough">库存不足</div>
						</div>
						<div class="ui-icon-delete product-del" style="display:none;"></div>
						<div class="product-price clear">	
							<div class="original-price"><?= number_format(trim($v['itemOfferPrice']),2,'.','') ?></div>
							<div class="old-price" op ='<?= number_format(trim($v['itemOfferPrice']),2,'.','') ?>'></div>
							<div class="pro-num">X<span ><?= $v['cartlineQuantity'] ?></span></div>
							<?php if(isset($v['children'])):?>
								<div class="clear">
                                    <div class="down-label fr">组合</div>
                                </div>
                            <?php endif;?>
							<div id="direct_cut_label_<?= $v['itemId'] ?>" class="just_for_ctrl"></div>                       
						</div>
					</div>
				</div>
                    <?php if(isset($v['N-end'])) :?>
                        </div>
                    <?php endif;?>   
			<?php endforeach;?>    
    	</section>
        
		<section id="settlement_<?= $type ?>" class="order-item-group cart-item clear" storeId=<?= $type ?>>
			<div class="cart-inf-left">
				已选择商品<span id="item_num_<?= $type ?>">0</span>件
			</div>
			<div class="cart-inf-right">
				<div id='original_Price_<?= $type ?>'>商品总计：<span>￥0.00</span></div>
				<div id='promotion_Price_<?= $type ?>'>活动优惠：<span>-￥0.00</span></div>
				<?php if(in_array(Tools::getSalesType($type),Yii::$app->params['sm']['store']['isCBT'])):?>
				<div id='tax_<?= $type ?>'>订单关税：<span>￥0.00</span></div>
				<?php endif;?>
				<div id='final_Price_<?= $type ?>' class="right4">应付金额（不含运费）：<span>￥0.00</span></div>
				<button id='go_to_checkout_<?= $type ?>' class="goto-check notto-check" type="button" disabled="true">去结算</button>
			</div>
				<p id='pay_tip_<?= $type ?>' class="notice">温馨提醒：海关规定购买多件的总价（不含税）不能超过￥<?= Yii::$app->params['sm']['store']['maxAmount'] ?>，请您分多次购买。</p>
		</section>
		<section id="confirm_settlement_<?= $type ?>" class="more-information order-item-group">
			<div class="cart-information cart-information-show">
				<div class="btn-bar order-item clear">
					<a href="javascript:;" class="btn-bar-left fl">商品金额：<span id='confirm_settlement_original_Price_<?= $type ?>'>￥0.00</span></a>
					<a href="javascript:;" class="btn-bar-right fr"></a>
				</div>
				
				<div id="promotion_tip_<?= $type ?>" class="information order-item preferential" style="display:none">
					活动优惠：您已享受以下优惠
					<div id="order_promotion_tip_<?= $type ?>" style="display:none"><span>【满减】</span>您参加了满100减10元活动</div>
					<div id="item_promotion_tip_<?= $type ?>" style="display:none"><span>【直降】</span>您选中的商品已优惠10元</div>
					<!--div><span>【组合】</span>您选中的组合商品已优惠10元</div-->
				</div>
				<?php if(in_array(Tools::getSalesType($type),Yii::$app->params['sm']['store']['isCBT'])):?>
				<div class="information order-item order-tariffs">
					关税：
					<div class="tariffs-div">
                                                <span id='tax_no_tip_<?= $type ?>'class="span1">关税≤50，免征！</span>
                                                <span id='confirm_settlement_tax_<?= $type ?>' class="span2">￥0.00</span>
					</div>
					<div class="tariffs-notice">海关免征限额为50元，关税总额控制在50元以内即可免税</div>
				</div>
				<?php endif;?>
				<div class="information order-item clear">
					应付金额（不含运费）：<span id='confirm_settlement_final_Price_<?= $type ?>' class="amount-span fr">￥0.00</span>
				</div>
				<input type="submit" id ="confirm_go_to_checkout_<?= $type ?>" class="surepay-btn" value="确认结算"></input>
			</div>
		</section>
		<?= Html::endForm() ?>
		<?php endforeach; }?>
    </div>
	<script>
        var _csrf="<?= Html::encode($_csrf) ?>";
        var updateUrl="<?= Url::to(['cart/update/'],true) ?>";
        var priceUrl="<?= Url::to(['cart/price/'],true) ?>";
        var deleteUrl="<?= Url::to(['cart/delete/'],true) ?>";
        var cancheckOutUrl="<?= Url::to(['cart/can-checkout/'],true) ?>";
        var inventoryUrl = "<?= Url::to(['inventory/check-inventorys/'],true) ?>";
        var shippingRuleUrl="<?= Url::to(['cart/get-shipping-rule/'],true) ?>";
        var channelId = "<?= isset($channelId) ? $channelId : 'ftzmall' ?>";
    </script>
</section>