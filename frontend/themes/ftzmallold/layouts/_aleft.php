<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;

/* @var $this yii\web\View */
?>
<div class = "art_lf">
    <div class = "art_lf_list fl">
        <?php
            echo Menu::widget(Yii::$app->params['aleftMenu1']);
            echo Menu::widget(Yii::$app->params['aleftMenu2']);
            echo Menu::widget(Yii::$app->params['aleftMenu3']);
            echo Menu::widget(Yii::$app->params['aleftMenu4']);
            echo Menu::widget(Yii::$app->params['aleftMenu5']);
        ?>      
        <dl class = "art_lf_list_6"></dl>
    </div>
</div>