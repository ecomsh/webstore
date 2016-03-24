<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '邮件订阅_上海外高桥进口商品网';
?>

<div style = "width: 960px;" class = "member-main">
    <div class = "orderlist-warp">
        <div class = "title title2">邮件订阅</div>
    </div>
    <form action = "<?= Yii::$app->params['baseUrl'] ?>member-saveEmail.html" method = "post">
        <div class = "return_box">
            <div class = "mall_seller_emall_h3">
                <h3> 购物提醒邮件：</h3>
            </div>
            <div>
                <div class = "mall_seller_emall_div">
                    <ul class = "mall_seller_emall">
                    </ul>
                </div>
            </div>
        </div>
        <div class = "mall_seller_emall_but  pl150 m10">
            <button class = "btn" type = "submit">
                <span>
                    <span>确定</span>
                </span>
            </button>
        </div>
    </form>
</div>