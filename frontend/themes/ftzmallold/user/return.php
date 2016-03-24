<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = '退款退货管理_上海外高桥进口商品网';
?>

<div style = "width: 960px;" class = "member-main">
    <div class = "title title2">退款退货管理</div>
    <div id = "tab-dlycorp" class = "section switch">
        <ul class = "switchable-triggerBox tab_member clearfix">
            <li class = "active"><a href = "#">我发起的退款</a></li>
        </ul>



        <table class = "gridlist border-all gridlist_member border-top-0" cellpadding = "3" cellspacing = "0" width = "100%">

            <thead>
                <tr>
                    <th class = "first">订单号</th>
                    <th>申请人</th>
                    <th>申请时间</th>
                    <th>处理状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150602142895.html" class = "font-blue">2015052214592662</a></td>
                    <td class = "textcenter">testyx01</td>
                    <td class = "textcenter">2015-06-02 14:41:24</td>
                    <td class = "textcenter">
                        退款协议等待卖家确认 </td>
                    <td class = "textcenter">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150602142895.html" class = "font-blue">查看</a>
                    </td>
                </tr>
                <tr>
                    <td><a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150602111832.html" class = "font-blue">2015060211683945</a></td>
                    <td class = "textcenter">testyx01</td>
                    <td class = "textcenter">2015-06-02 11:54:16</td>
                    <td class = "textcenter">
                        退款协议等待卖家确认 </td>
                    <td class = "textcenter">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150602111832.html" class = "font-blue">查看</a>
                    </td>
                </tr>
                <tr>
                    <td><a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150602115219.html" class = "font-blue">2015052214061338</a></td>
                    <td class = "textcenter">testyx01</td>
                    <td class = "textcenter">2015-06-02 11:48:02</td>
                    <td class = "textcenter">
                        退款协议等待卖家确认 </td>
                    <td class = "textcenter">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150602115219.html" class = "font-blue">查看</a>
                    </td>
                </tr>
                <tr>
                    <td><a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150521162022.html" class = "font-blue">2015052116801866</a></td>
                    <td class = "textcenter">testyx01</td>
                    <td class = "textcenter">2015-05-21 16:57:07</td>
                    <td class = "textcenter">
                        退款协议等待卖家确认 </td>
                    <td class = "textcenter">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150521162022.html" class = "font-blue">查看</a>
                    </td>
                </tr>
                <tr>
                    <td><a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150521168342.html" class = "font-blue">2015052116801866</a></td>
                    <td class = "textcenter">testyx01</td>
                    <td class = "textcenter">2015-05-21 16:56:34</td>
                    <td class = "textcenter">
                        退款协议等待卖家确认 </td>
                    <td class = "textcenter">
                        <a href = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_details-20150521168342.html" class = "font-blue">查看</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
