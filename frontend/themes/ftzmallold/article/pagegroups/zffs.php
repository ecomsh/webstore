<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '支付方式-上海外高桥进口商品网';
?>
<div class = "main w1200">
    <div class = "mTB">
        <div class = "ArtListWrap">
            <ul class = "list atListModi">
                <li><a href = "<?=  Url::to(['article/page','view'=>'zhzf']);?>">组合支付</a></li>
                <li><a href = "<?=  Url::to(['article/page','view'=>'digkzf']);?>">DIG卡支付</a></li>
                <li><a href = "<?=  Url::to(['article/page','view'=>'zxzf']);?>">在线支付</a></li>
            </ul>
        </div> 
    </div>
</div>