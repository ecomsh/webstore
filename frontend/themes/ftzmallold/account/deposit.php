<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = '预存款充值_上海外高桥进口商品网';
?>

<!--right-->
<div style = "width: 960px;" class = "member-main">
    <div>

        <div class = "title title2">充值到预存款</div>

        <?= Html::beginForm(['account/pay'], 'post', ['target'=>'_blank','enctype' => 'multipart/form-data']) ?>
        <!--<form action = "paycenter-dopayment-recharge.html" method = "post" id = "deposit" class = "section" extra = "subOrder">-->
            <p class = "admin-title admin-title2">您当前的预存款余额为：<span class = "point">¥<?= $remain ?></span></p>
            <div class = "FormWrap bn zffs">
                <div class = "p10">
                    <ul>
                        <li>
                            <label>输入充值金额：</label>
                            <input autocomplete = "off" class = "x-input inputstyle" name = "payment[money]" vtype = "positive&amp;&amp;required" id = "deposit" type = "text"> </li>
                                <li class = "fontbold">选择支付方式：</li>
                        <li>
                            <div id = "paymentlist"><div style = "height:auto; padding:5px 0;" id = "purchase_info_payment">
                                    <table id = "_normal_payment" cellpadding = "0" cellspacing = "0" width = "100%">
                                        <colgroup><col class = "span-5">
                                            <col class = "span-auto">
                                        </colgroup><tbody><tr class = "last">
                                                <th style = "text-align:left; width:280px">
                                                    <label>
                                                        <input class = "x-payMethod" name = "payment[pay_app_id]" paytype = "" value = "dig" checked = "checked" moneyamount = "" formatmoney = "" type = "radio">
                                                        DIG 网上支付</label>
                                                </th>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>

                                        </tbody></table>
                                </div></div>
                        </li>
                    </ul>
                    <div class="pl150 m10">
                    <button class="btn btn" type="submit" isdisabled="true"><span><span>去充值</span></span></button></div>
                </div>

            </div>

        <!--</form>-->
        <?= Html::endForm() ?>


    </div>
</div>
<!-- right-->
