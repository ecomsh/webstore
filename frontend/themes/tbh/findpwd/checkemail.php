<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\FindpwdAsset;

FindpwdAsset::register($this);
?>
	<div class="forgotpw-container">
		<div class="forgotpw-progress">
			<h3 class="font-color4">找回密码</h3>
                        <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/progress-img2.png', true)?>">
		</div>
		<div class="forgotpw-div">
		
			<div class="forgotemail-item">您好，上海外高桥进口商品网已经向您的邮箱<span><?php echo $email ?></span>发送“找回密码”邮件，请查收！</div>
			<button type="button" id="btn-tomail" class="btn btn-tomail">登录邮箱查收</button>
			<div class="email-notice">
				<p>如果您没有收到邮件，建议您看看您的邮件垃圾箱，或者点击<a href="javascript:void(0);" onclick="resend()" class="font-color4">重新发送邮件</a></p>
				<p>如果您的邮箱已经停用，请联系客服 400-188-5179</p>
				
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
			<?php $domain = strstr($email, '@');
			$domain = 'http://mail.'. substr($domain, 1);
			?>

			var urlArray = {
					'domain': '<?=$domain?>',
					'email': '<?=$email?>',
					'getemaillink': '<?= Url::toRoute('findpwd/sendemail', true)?>',
					'checkidentity': '<?= Url::toRoute('findpwd/checkidentity', true)?>',
					'checkemail': '<?= Url::toRoute('findpwd/checkemail', true)?>'};
	
</script>

