<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\LoginBarAsset;
LoginBarAsset::register($this);
/* @var $this yii\web\View */
?>


 <!--顶部通栏 start-->
    <div class="topbar">
        <div class="container">
            <h3>欢迎来到英国之家！</h3>
            <ul>
                <li><a href="<?= Url::to(['cart/'],true) ?>">购物车<span class="cart-num"><i>1</i></span></a>|</li>
                <li><a href="javascript:void(0)">联系客服</a>|</li>
                <li class="login-register" style="display: none;"><a href="<?= Url::to(['login/'],true) ?>">登录</a>|</li>
                <li class="login-register" style="display: none;"><a href="<?= Url::to(['register/'],true) ?>">注册</a></li>
                <li class="wel-quit" style="display: none;"><a href="<?= Url::to(['order/'],true) ?>"></a>|</li>
                <li class="wel-quit" style="display: none;"><a href="<?= Url::to(['login/logout/'],true) ?>">退出</a></li>
           </ul>
        </div>
    </div>

    <script text="javascript">
        var statusUrl ="/login/getcookie.html";
        $.get(statusUrl, function(data){
            if($.type(data)=='object'){
                $('.wel-quit').css('display','block').eq(0).children().html(data.userName);
            }else{
                $('.login-register').css('display','block');
            };
        });
    </script>

    <!--顶部通栏 end-->
    

