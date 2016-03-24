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
                <li><a href="<?=  Url::to(['article/page','view'=>'cmhstz']);?>">尺码换算--童装</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cmhsnvz']);?>">尺码换算--女装</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cmhsnz']);?>">尺码换算--男装</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cmhsjz']);?>">尺码换算--戒指</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cscmdzb']);?>">衬衫尺码对照表</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'wxcmdzb']);?>">文胸尺码对照表</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'xzcmdzb']);?>">鞋子尺码对照表</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'kzcmdzb']);?>">裤子尺码对照表</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'cjwt']);?>">常见问题</a></li>
                <li><a href="<?=  Url::to(['article/page','view'=>'tksm']);?>">退款说明</a></li>
            </ul>
            <div class="pager"><span title="已经是第一页" class="unprev">已经是第一页</span> <strong class="pagecurrent">1</strong>   
                <a class="pagernum" href="<?=  Url::to(['article/pagegroup','view'=>'shfw_2']);?>">2</a> <a href="<?=  Url::to(['article/pagegroup','view'=>'shfw_2']);?>" class="next last" title="下一页">下一页»</a>
            </div>    
        </div>	
    </div>
</div>