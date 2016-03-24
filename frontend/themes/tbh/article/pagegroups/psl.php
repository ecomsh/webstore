<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\ArticleAsset;
ArticleAsset::register($this);
/* @var $this yii\web\View */
$this->title = '配送类-上海外高桥进口商品网';
?>

<div class="main w1200">
	<div class="container">
	    <div class="mTB">
	        <div class="ArtListWrap">
	            <ul class="list atListModi">
	                <li><a href="<?=  Url::to(['article/page','view'=>'wxcmdzb']);?>">文胸尺码对照表</a></li>
	            </ul>
	        </div>	
	    </div>
    </div>
</div>