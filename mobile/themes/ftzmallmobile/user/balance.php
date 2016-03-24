<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '优惠券_上海外高桥进口商品网';
?>

<!--right-->
<div style = "width: 960px;" class = "member-main">
    <div>
        <div class = "errorMsg">
            <ul>
            </ul>
        </div>
        <form action = "<?= Yii::$app->params['baseUrl'] ?>member-download_ddvanceLog.html" method = "post" target = "_blank">
            <div class = "title title2">我的预存款</div>
        </form>
        <p class = "admin-title admin-title2">您当前的预存款余额为：<span class = "point pr5">¥149.10</span>|<a href = "<?= Yii::$app->params['baseUrl'] ?>user-deposit.html" class = "font-blue pl5">预存款充值 &gt;
                &gt;
            </a></p>
        <form action = "<?= Yii::$app->params['baseUrl'] ?>member-download_ddvanceLog.html" method = "post" target = "_blank" id = "downloadform">
            <div class = "title-bg admin-title2"><div><span style = "float:left">预存款交易记录：</span><span class = "icon3"><a href = "javascript:void(0);" onclick = "$('downloadform').submit();" style = "color:#367EC1" class = "btn-bj-hover operate-btn"><i class = "has-icon"> <img src="<?= Yii::$app->params['baseimgUrl'] ?>down-icon.gif"></i><span>下载交易记录</span></a></span></div></div>
        </form>
        <table class = "gridlist border-all gridlist_member" cellpadding = "3" cellspacing = "0" width = "100%">
            <thead>
                <tr>
                    <th class = "first">时间</th>
                    <th>事件</th>
                    <th>存入金额</th>
                    <th>支出金额</th>
                    <th>当前余额</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align = "center">2015-05-21 16:34</td>
                    <td align = "center">
                        admin管理员代充值 </td>
                    <td class = "textcenter font-orange">¥1000.00</td>
                    <td class = "textcenter">-</td>
                    <td class = "fontbold textcenter font-red">¥1000.00</td>
                </tr>
                <tr>
                    <td align = "center">2015-05-21 16:46</td>
                    <td align = "center">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015052116801866.html">预存款支付订单</a>
                    </td>
                    <td class = "textcenter font-orange">-</td>
                    <td class = "textcenter">¥449.00</td>
                    <td class = "fontbold textcenter font-red">¥551.00</td>
                </tr>
                <tr>
                    <td align = "center">2015-05-22 13:25</td>
                    <td align = "center">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015052213351751.html">预存款支付订单</a>
                    </td>
                    <td class = "textcenter font-orange">-</td>
                    <td class = "textcenter">¥15.90</td>
                    <td class = "fontbold textcenter font-red">¥535.10</td>
                </tr>
                <tr>
                    <td align = "center">2015-05-22 14:18</td>
                    <td align = "center">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015052214592662.html">预存款支付订单</a>
                    </td>
                    <td class = "textcenter font-orange">-</td>
                    <td class = "textcenter">¥13.00</td>
                    <td class = "fontbold textcenter font-red">¥522.10</td>
                </tr>
                <tr>
                    <td align = "center">2015-05-22 14:37</td>
                    <td align = "center">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015052214061338.html">预存款支付订单</a>
                    </td>
                    <td class = "textcenter font-orange">-</td>
                    <td class = "textcenter">¥53.00</td>
                    <td class = "fontbold textcenter font-red">¥469.10</td>
                </tr>
                <tr>
                    <td align = "center">2015-06-02 11:49</td>
                    <td align = "center">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015060211683945.html">预存款支付订单</a>
                    </td>
                    <td class = "textcenter font-orange">-</td>
                    <td class = "textcenter">¥320.00</td>
                    <td class = "fontbold textcenter font-red">¥149.10</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!--right-->

