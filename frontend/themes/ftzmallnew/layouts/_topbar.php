<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\LoginBarAsset;
LoginBarAsset::register($this);
/* @var $this yii\web\View */
?>

<div class="topbar">
	<div class="container">
		<div class="pull-left topbar-left">
            <div id="loginBar" style="display: none;">
				欢迎来到上海外高桥进口商品网！
				<a class="login-href" href="<?= Url::to(['login/'],true); ?>">请登录</a>|<a class="registe-href" href="<?= Url::to(['register/'],true); ?>">快速注册</a>
			</div>
			<div id="logoutBar" style="display: none;">
				<!-- username显示的优先级：用户名>手机>邮箱,点击在新窗口打开用户中心页面 -->
				欢迎您，<a href="<?= Url::to(['order/'],true); ?>" target="_blank" class="topbar-username"></a> | <a href="<?= Url::to(['login/logout'],true); ?>" class="quit">退出</a>
			</div>
            <script>
                var statusUrl = '<?= Url::to(['/login/getcookie']) ?>';
            </script>
		</div>
		<div class="pull-right topbar-right">
			<ul class="nav">	
                <!--dcj 这个需求文档上要加，但是格式没调好，先凑合用，@lijing有空帮改下 -->
                <li class="pull-left current">正品保证&nbsp;&nbsp;|&nbsp;&nbsp;</li>
				<li class="pull-left "><a href="<?=Url::to(['order/index'])?>">订单查询&nbsp;&nbsp;|&nbsp;&nbsp;</a></li>
                <li class="pull-left"><a href="<?=Url::to(['user/setting'])?>">个人中心&nbsp;&nbsp;|&nbsp;&nbsp;</a></li>
                <li class="pull-left">客户服务&nbsp;&nbsp;</li>
                            
			</ul>
		</div>
	</div>
</div>