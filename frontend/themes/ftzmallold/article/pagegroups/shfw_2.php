<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '售后服务-上海外高桥进口商品网';
?>
<div class="main w1200">
    <div class="mTB">
        <div class="ArtListWrap">
            <ul class="list atListModi">
                <li><a href="<?=  Url::to(['article/page','view'=>'thhlc']);?>">退换货流程</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'thhzc']);?>">退换货政策</a></li>
            </ul>
            <div class="pager"><a href="<?=  Url::to(['article/pagegroup','view'=>'shfw_1']);?>" class="prev" title="上一页">«上一页</a> 
                <a class="pagernum" href="<?=  Url::to(['article/pagegroup','view'=>'shfw_1']);?>">1</a>   <strong class="pagecurrent">2</strong> <span title="已经是最后一页" class="unnext">已经是最后一页</span>
            </div>    
        </div>	
    </div>
</div>