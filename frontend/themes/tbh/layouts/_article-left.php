<?php

use frontend\assets\ftzmallnew\ArticleAsset;
use yii\widgets\Menu;
    ArticleAsset::register($this);
?>
<div class="left-box">
    <ul>
        <p>FTZMALL</p>
        <?php
            echo Menu::widget(Yii::$app->params['mapMenu1']);     
        ?>
    </ul>
    <ul>
        <p>配送服务</p>
        <?php
            echo Menu::widget(Yii::$app->params['mapMenu2']);     
        ?>
    </ul>
    <ul>
        <p>支付方式</p>
        <?php
            echo Menu::widget(Yii::$app->params['mapMenu3']);     
        ?>
    </ul>
    <ul>
        <p>售后服务</p>
        <?php
            echo Menu::widget(Yii::$app->params['mapMenu4']);     
        ?>
    </ul>
    <ul>
        <p>自贸区直购</p>
        <?php
            echo Menu::widget(Yii::$app->params['mapMenu5']);     
        ?>
    </ul>
</div>