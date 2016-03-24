<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '购物类-上海外高桥进口商品网';
?>

<div class="main w1200">
    <div class="mTB">
        <div class="ArtListWrap">
            <ul class="list atListModi">
                <li><a href="<?=  Url::to(['article/page','view'=>'cmhstz']);?>">尺码换算--童装</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cmhsnvz']);?>">尺码换算--女装</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cmhsnz']);?>">尺码换算--男装</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cmhsjz']);?>">尺码换算--戒指</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cscmdzb']);?>">衬衫尺码对照表</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'xzcmdzb']);?>">鞋子尺码对照表</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'kzcmdzb']);?>">裤子尺码对照表</a></li>
            </ul>
        </div>	
    </div>
</div>