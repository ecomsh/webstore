<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\ArticleAsset;
ArticleAsset::register($this);
/* @var $this yii\web\View */
$this->title = '配送服务-上海外高桥进口商品网';
?>
<div class="main w1200">
	<div class="container">
	    <div class="mTB">
	        <div class="ArtListWrap">
	            <ul class="list atListModi">
	                <li><a href="<?=  Url::to(['article/page','view'=>'psfwjyf']);?>">配送范围及运费</a></li>
	                <li><a href="<?=  Url::to(['article/page','view'=>'psfw']);?>">配送服务</a></li>
	                <li><a href="<?=  Url::to(['article/page','view'=>'yhyqs']);?>">验货与签收</a></li>
	            </ul>
	        </div>	
	    </div>
    </div>
</div>