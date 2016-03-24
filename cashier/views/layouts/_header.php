<?php

use yii\helpers\Html;
use yii\helpers\Url;
use cashier\assets\HeaderAsset;
HeaderAsset::register($this);
?>

<header>
    <div class="top" id="login-welcome">
        <span id="login-user"></span>,欢迎您的登录！
    </div>
    <div class="inheader">
        <div class="hd_left">
            <h1 id="store-info">FTZMALL · <span id="store-name"></span></h1>
            <div class="sousuo" id="input-div-block" <?php if($this->title == "管理后台"){ ?> style="display: none" <?php } ?>>
                输入信息 : <input type="text" id="webpos-input" onfocus="this.select()" onmouseover="this.focus()" placeholder= <?= $this->title == "系统收银"? "手机号／商品编号" : "手机号"; ?>>
                <button id="webpos-query-btn">搜索</button>
            </div>
            <p id="alert" class="pay-color"></p>
        </div>
        <ul class="list">
            <li <?php if($this->title == "系统收银"){ ?>class="current" <?php } ?>>
                <a href="<?=Url::to(['cashier/index'])?>"><img src="<?=Url::to('@web/images/header_icon1.png', true)?>"><p>系统收银</p></a>
            </li>
            <li <?php if($this->title == "补打小票"){ ?>class="current" <?php } ?>>
<!--                <img src="images/header_icon2.png">
                <p>补打小票</p>-->
                <a href="<?=Url::to(['printer/index'])?>"><img src="<?=Url::to('@web/images/header_icon2.png', true)?>"><p>补打小票</p></a>
            </li>
            <li <?php if($this->title == "管理后台"){ ?>class="current" <?php } ?>>
<!--                <img src="images/header_icon3.png" alt="">
                <p>管理后台</p>-->
                <a href="<?=Url::to(['system/index'])?>"><img src="<?=Url::to('@web/images/header_icon3.png', true)?>"><p>管理后台</p></a>
            </li>
            <li>
<!--                <img src="images/header_icon4.png" alt="">
                <p>退出</p>-->
                <a href="<?=Url::to(['login/logout'])?>"><img src="<?=Url::to('@web/images/header_icon4.png', true)?>"><p>退出</p></a>
            </li>
        </ul>
    </div>
</header>
<script>
    var statusUrl = '<?= Url::to(['/login/getcookie']) ?>';
</script>

