<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;

/* @var $this yii\web\View */
?>
<div class="w1200 clearfix">
    <ul class="footul center_section">
        <li><div class="footul_left_01">
                <img align="absmiddle" src="<?=Yii::$app->params['baseimgUrl']?>index_m4_21.png" width="43" height="44">
                <p class="p1">在线免税店</p>
                <p class="p2">专场免税 底价海淘</p>
            </div>
        </li>
        <li>
            <div class="footul_left_02">
                <img align="absmiddle" src="<?=Yii::$app->params['baseimgUrl']?>index_m4_23.png" width="44" height="44">
                <p class="p1">正品保障</p>
                <p class="p2">100%正品 购物无忧</p>
            </div>
        </li>
        <li>
            <div class="footul_left_03">
                <img align="absmiddle" src="<?=Yii::$app->params['baseimgUrl']?>index_m4_25.png" width="43" height="44">
                <p class="p1">原装进口</p>
                <p class="p2">境外一站通 100%原装进口</p>
            </div>
        </li>
        <li>
            <div class="footul_left_04">
                <img align="absmiddle" src="<?=Yii::$app->params['baseimgUrl']?>index_m4_27.png" width="43" height="44">
                <p class="p1">海关监管</p>
                <p class="p2">合法途径 安全无忧</p>
            </div>
        </li>
        <li>
            <div class="footul_left_05">
                <img align="absmiddle" src="<?=Yii::$app->params['baseimgUrl']?>index_m4_30.png" width="42" height="44">
                <p class="p1">税费透明</p>
                <p class="p2">100%透明税率</p>
            </div>
        </li>
        <li>
            <div class="footul_right_01">
                <img align="absmiddle" src="<?=Yii::$app->params['baseimgUrl']?>index_m4_33.png" width="44" height="44">
                <p class="p1">快捷到货</p>
                <p class="p2">政策扶持 快速通关</p>
            </div>
        </li>
    </ul>
    <div class="clearfix"></div>
    <div class="index_m4_bottom_line2 center_section"></div>
    <div class="clb">
        <div class="f_help">
            <div class="f_help_list fl">

                <?php
                echo Menu::widget(Yii::$app->params['mapMenu1']);
                
                echo Menu::widget(Yii::$app->params['mapMenu2']);
                
                echo Menu::widget(Yii::$app->params['mapMenu3']);
                
                echo Menu::widget(Yii::$app->params['mapMenu4']);
                
                echo Menu::widget(Yii::$app->params['mapMenu5']);
                
                ?>
                <dl id = "weixinandtelphone" class = "">
                    <div id = "show_weixin">
                        <p>FTZMALL 微信</p>
                        <img src="<?=Yii::$app->params['baseimgUrl']?>index_footer_03.jpg" width = "80" height = "80">
                    </div>
                    <div id = "show_telphone">
                        <div id = "telphone_icon">
                            <img src="<?=Yii::$app->params['baseimgUrl']?>index_footer_07.png" width = "39" height = "35">
                        </div>
                        <div id = "swx_phone">400-188-5179</div>
                        <div id = "swx_datetime">周一至周五 9:00-17:00</div>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>