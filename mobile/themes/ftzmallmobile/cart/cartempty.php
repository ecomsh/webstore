<?php

use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = '购物车_上海外高桥进口商品网';
//var_dump($data);
?>


    <!--   这是购物车中无货时的页面-->
    <div class="m-page m-page1" style="min-height: 578px;">
        <div class="top-holder">
            <div class="fixed-top">
                <div class="m-header">
                    <div class="header-left-btn">
                        <span onclick="history.back()" class="icon-back"></span>
                    </div>
                    <h2>购物车</h2>
                    <div class="header-right-btn">
                        <a href="<?=Url::to(['user/index'])?>" class="icon-home"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="full-screen">
            <div class="full-padding cart-body" style="border: none;">
                <div class="cart-pt">
                    <div class="cart-empty">
                        <h3>购物车空空如也<a href="javascript:void(0)" class="reload" onclick=" window.location.reload();"></a></h3>
                        <a href="上海外高桥进口商品网.html" class="buy-go">马上扫码抢购</a>
                    </div>
                </div>
            </div>
        </div>
    </div>