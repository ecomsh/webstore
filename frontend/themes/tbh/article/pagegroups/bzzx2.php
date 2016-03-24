<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\ArticleAsset;
ArticleAsset::register($this);
/* @var $this yii\web\View */
$this->title = '帮助中心2-上海外高桥进口商品网';
?>

<div class="main w1200">
    <div class="container">
        <div class="mTB">
            <div class="ArtListWrap">
                <ul class="list atListModi">
                    <li><a href="<?=  Url::to(['article/page','view'=>'sl']);?>">税率</a></li>
                    <li><a href="<?=  Url::to(['article/page','view'=>'ystk']);?>">隐私条款</a></li>
                    <li><a href="<?=  Url::to(['article/page','view'=>'mzsm']);?>">免责声明</a></li>
                    <li><a href="<?=  Url::to(['article/page','view'=>'fwxy']);?>">服务协议</a></li>
                </ul>
            </div>	
        </div>
    </div>
</div>