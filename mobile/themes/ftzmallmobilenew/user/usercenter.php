<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Menu;
use mobile\assets\ftzmallmobilenew\UserAsset;

UserAsset::register($this);//为了将activeForm的js代码依赖于mainasset
/* @var $this yii\web\View */
$this->title = '会员中心';
?>
<section class="ui-container">
	<div class="mem-info">
		<div class="member-bg ui-container ui-center">
			<ul class="ui-list ui-border-tb border-n b-n">
				<li class="ui-border-t">
					<div class="wx-p">
						<img src="<?=$qr ?>" class="img-wei">
					</div>
					<div class="ui-list-info ui-i-r">
						<h2 class="ui-nowrap text-r text-m">
							<img src="<?=Url::base()?>/themes/wxnew/images/logo1.png" class="wx-logo">
						</h2>
						<h3 class="ui-nowrap dl-c text-r"><?= $mobile ?></h3>
					</div>

				</li>
			</ul> 
		</div>
		<div class="member-list">
			<a href="<?=Url::to(['order/index'])?>" class="order-item ui-arrowlink">我的订单</a>
			<a href="<?=Url::to(['cart/index'])?>" class="order-item ui-arrowlink">我的购物车</a>
                        <a href="<?=Url::to(['account/index'])?>" class="order-item ui-arrowlink">我的预存款</a>
                        <a href="<?=Url::to(['coupon/index'])?>" class="order-item ui-arrowlink">我的优惠券</a>
			<a href="<?=Url::to(['address/index'])?>" class="order-item ui-arrowlink">地址管理</a></li>
			<a href="<?=Url::to(['passport/changepassword'])?>" class="order-item ui-arrowlink">修改密码</a>
			<a href="<?=Url::to(['realname/index'])?>" class="order-item ui-arrowlink">实名认证</a>
			<a href="javascript:void(0);" class="order-item ui-arrowlink tel">致电客服</a>
		</div>
	</div>		
	<section class="ui-actionsheet">
		<div class="ui-actionsheet-cnt">
			<a href="tel:4001-885-179" class="ui-actionsheet-tel">4001-885-179</a>
			<button class="ui-actionsheet-cancel">取消</button>
		</div>
	</section>
</section>