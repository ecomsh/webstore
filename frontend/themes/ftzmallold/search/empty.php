<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use yii\widgets\Pjax;
use frontend\assets\SearchAsset;
SearchAsset::register($this);
/* @var $this yii\web\View */
$this->title = '搜索结果-上海外高桥进口商品网';
?>

<div class = "conter w1200 clb">
    <div class="feed-back m30" >
        <h1 class="error" style="">非常抱歉，没有找到相关商品</h1>
        <p style="margin:15px 1em;">
        <strong>建议：</strong>
        <br />
        适当缩短您的关键词或更改关键词后重新搜索。        </p>
        <div class="w200 ma">
            <a href="javascript:history.back(1)" class="btn-a">
                <span>返回上一页</span>
            </a>
            <a href="<?= Url::to(["act/page"])?>" class="btn-a ml10">
                <span>返回首页</span>
            </a>
        </div>
    </div>
</div>