<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\ArticleAsset;
ArticleAsset::register($this);
/* @var $this yii\web\View */
$this->title = 'FTZMALL-上海外高桥进口商品网';
?>

<div class="container">
    <div class="mTB">
        <div class="ArtListWrap">
            <ul class="list atListModi">
                <li><a href="<?=  Url::to(['article/page','view'=>'fwbz']);?>">服务保证</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'aqbz']);?>">安全保证</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'wsjgb']);?>">完税价格表</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'yjyjy']);?>">意见与建议</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'fpzc']);?>">发票政策</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'gwlc']);?>">购物流程</a></li>
            </ul>
        </div>	
    </div>
</div>