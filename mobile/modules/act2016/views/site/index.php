<?php
use yii\helpers\Url;
use yii\helpers\Html;
use mobile\modules\act2016\assets\ActAsset;
ActAsset::register($this);

?>
<section class="ui-container">
	<div class="mem-info">
		<div class="member-bg ui-container ui-center">
			<ul class="ui-list ui-border-tb border-n b-n">
				<li class="ui-border-t">
					<div class="wx-p">
						<img src="<?=$qr ?>">
					</div>
					<div class="ui-list-info ui-i-r">
						<h2 class="ui-nowrap text-r text-m">
							<img src="<?=Url::base()?>/themes/wxnew/images/logo1.png">
						</h2>
						<h3 class="ui-nowrap dl-c text-r"><?= $mobile ?></h3>
					</div>

				</li>
			</ul> 
		</div>
		<div class="member-list">
			<a href="<?=Url::to(['site/ajax-product'])?>" class="order-item ui-arrowlink">我的json</a>
			<a href="<?=Url::to(['/cart/index'])?>" class="order-item ui-arrowlink">我的购物车</a>
			<a href="<?=Url::to(['/address/index'])?>" class="order-item ui-arrowlink">地址管理</a></li>
			<a href="<?=Url::to(['/passport/changepassword'])?>" class="order-item ui-arrowlink">修改密码</a>
			<a href="<?=Url::to(['/realname/index'])?>" class="order-item ui-arrowlink">实名认证</a>
                        <a href="javascript:void(0);" class="order-item ui-arrowlink tel">致电客服</a>
                </div>
	</div>		
	<section class="ui-actionsheet">
		<div class="ui-actionsheet-cnt">
			<a href="tel:4008-888-888" class="ui-actionsheet-tel">4008-888-888</a>
			<button class="ui-actionsheet-cancel">取消</button>
		</div>
            <div class="act-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
        <img src="<?=Url::to('@web/themes/wxnew/images/user-bg.png', true)?>">
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p
	</section>
</section>
>
</div>
