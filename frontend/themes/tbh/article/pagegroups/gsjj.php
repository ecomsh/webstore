<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\ArticleAsset;
ArticleAsset::register($this);
/* @var $this yii\web\View */
$this->title = '公司简介-上海外高桥进口商品网';
?>

<div class="main w1200">
    <div class="container">
        <div class="mTB">
            <div class="ArtListWrap">
                <ul class="list atListModi">
                    <li><a href="<?=  Url::to(['article/page','view'=>'pprz']);?>">品牌入驻</a></li>
                    <li><a href="<?=  Url::to(['article/page','view'=>'zpxx']);?>">招聘信息</a></li>
                    <li><a href="<?=  Url::to(['article/page','view'=>'lxwm']);?>">联系我们</a></li>
                    <li><a href="<?=  Url::to(['article/page','view'=>'gywm']);?>">关于我们</a></li>
                </ul>
            </div>	
        </div>
    </div>
</div>
