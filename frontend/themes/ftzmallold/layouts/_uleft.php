<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;

/* @var $this yii\web\View */
?>

<div style = "width: 210px;" class = "member-sidebar">
    <div class = "member-menu">
        <h2 class = "left_top">会员中心</h2>
        <ul class = "body">
            <input value = "" type = "hidden">
<!--            <li class = "member-menu-list">
                <div class = "list-title-bg noborder">
                    <h2 class = "list-title-icon m-0">我的收藏夹</h2></div>
                <?php
               // echo Menu::widget(Yii::$app->params['ufavoriteMenu']);
                ?>
            </li>-->
            <input value="1" type="hidden">
<!--            <li class="member-menu-list">
                <div class="list-title-bg">
                    <h2 class="list-title-icon m-0">我的咨询</h2></div>
                <?php
             //   echo Menu::widget(Yii::$app->params['uaskMenu']);
                ?>
            </li>-->
            <input value="2" type="hidden">
<!--            <li class="member-menu-list">
                <div class="list-title-bg">
                    <h2 class="list-title-icon m-0">我的购买</h2></div>
                <?php
               // echo Menu::widget(Yii::$app->params['ubuyMenu']);
                ?>               
            </li>-->
            <input value="3" type="hidden">
            <li class="member-menu-list">
                <div class="list-title-bg">
                    <div class="list-title-icon m-0" style="color:#b30013;font-family:Microsoft YaHei;font-weight:bold">交易管理</div>
                </div>
                <?php
                echo Menu::widget(Yii::$app->params['utransactionMenu']);
                ?>   
            </li>
            <input value="4" type="hidden">
            <li class="member-menu-list">
                <div class="list-title-bg">
                    <div  class="list-title-icon m-0" style="color:#b30013;font-family:Microsoft YaHei;font-weight:bold">账户中心</div>                        
                </div>
                <?php
                echo Menu::widget(Yii::$app->params['ucenterMenu']);
                ?>                     
            </li>
            <input value="5" type="hidden">
<!--            <li class="member-menu-list">
                <div class="list-title-bg">
                    <h2 class="list-title-icon m-0">维权管理</h2></div>
                <?php
           //     echo Menu::widget(Yii::$app->params['upowerMenu']);
                ?>   
            </li>-->
        </ul>
    </div>
</div>
