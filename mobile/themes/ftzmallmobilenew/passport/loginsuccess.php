<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mobile\assets\ftzmallmobilenew\ChangePasswordAsset;
ChangePasswordAsset::register($this);
/* @var $this yii\web\View */
$this->title = '登录成功_上海外高桥进口商品网';
?>
   
<section class="ui-container login-success">
    <div class="full-screen">
        <p class="success-text">登陆成功</p>
        <p class="success-text1">长按下方图片关注<i>"FTZMALL</i>官方微信"</p>
        <section class="ui-container ui-center win-h"><img src="<?=Url::to('@web/mobile/images/wx.png', true)?>" class="img-w"></section>
        <div class="ui-flex ui-flex-align-center ui-flex-pack-center border-n"><a href="<?= Url::to(['user/index']) ?>">暂不关注。进入“<span>个人中心</span>”</a></div>     
    </div>
</section>

            
