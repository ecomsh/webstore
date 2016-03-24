<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\ArticleAsset;
ArticleAsset::register($this);
/* @var $this yii\web\View */
$this->title = '自贸区直购-上海外高桥进口商品网';
?>
<div class="main w1200">
    <div class="container">
        <div class="mTB">
            <div class="ArtListWrap">
                <div class="ArtListWrap">
                    <ul class="list atListModi">
                        <li><a href="<?=  Url::to(['article/page','view'=>'zmqzgtksm']);?>">自贸区直购退款说明</a></li>
                        <li><a href="<?=  Url::to(['article/page','view'=>'zmqzgthhlc']);?>">自贸区直购退换货流程</a></li>
                        <li><a href="<?=  Url::to(['article/page','view'=>'hgtgjgs']);?>">海关通关及关税</a></li>
                        <li><a href="<?=  Url::to(['article/page','view'=>'zmqzggwlc']);?>">自贸区直购购物流程</a></li>
                        <li><a href="<?=  Url::to(['article/page','view'=>'zmqzgthhzc']);?>">自贸区直购退换货政策</a></li>
                        <li><a href="<?=  Url::to(['article/page','view'=>'xfzgzs']);?>">消费者告知书</a></li>
                    </ul>
                </div>	
            </div>
        </div>
    </div>
</div>