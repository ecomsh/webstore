<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = '最近购买_上海外高桥进口商品网';
?>

<!--right-->
<div style = "width: 960px;" class = "member-main">
    <div>

        <div class = "title title2">充值到预存款</div>

        <form action = "<?= Yii::$app->params['baseUrl'] ?>paycenter-dopayment-recharge.html" method = "post" id = "deposit" class = "section" extra = "subOrder">
            <input name = "payment[member_id]" value = "4654" type = "hidden">
            <input name = "payment[return_url]" value = "<?= Yii::$app->params['baseUrl'] ?>member-balance.html" type = "hidden">
            <div style = "display:none"><input autocomplete = "off" class = "x-input " id = "dom_el_eaafd00" vtype = "checkForm" type = "text"></div>
            <p class = "admin-title admin-title2">您当前的预存款余额为：<span class = "point">¥149.10</span></p>
            <div class = "FormWrap bn zffs">
                <div class = "p10">
                    <ul>
                        <li>
                            <label>输入充值金额：</label>
                            <input autocomplete = "off" class = "x-input inputstyle" name = "payment[money]" vtype = "positive&amp;&amp;required" id = "deposit" type = "text"> </li>
                            <!--<tr>
                            <th>选择支付币别：</th>
                            <td>人民币</td>
                            </tr>
                        --> <li class = "fontbold">选择支付方式：</li>
                        <li>
                            <div id = "paymentlist"><div style = "height:auto; padding:5px 0;" id = "purchase_info_payment">
                                    <table id = "_pay_cod" style = "display:none" cellpadding = "0" cellspacing = "0" width = "100%">
                                        <colgroup><col class = "span-5">
                                            <col class = "span-auto">
                                        </colgroup><tbody>
                                            <tr>
                                                <th style = "text-align:left; "><input name = "payment[pay_app_id]" value = "-1" paytype = "offline" id = "payment_bank" class = "x-payMethod" type = "radio"><strong>货到付款</strong></th>
                                                <td>由我们的快递人员在将货物送到时收取货款。</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                                    <script>

                                        if ((_checked = $$('#_normal_payment th input[checked]')[0])) {
                                            _checked.fireEvent('click');
                                        }
                                    </script></div></div>
                        </li>
                    </ul>
                    <div class="pl150 m10">
                    <button class="btn btn" type="submit" isdisabled="true"><span><span>去充值</span></span></button><!-- <input class="btnstyle pay-btn" type="submit" value="点击立刻付款" /> --></div>
                </div>

            </div>

        </form>


    </div>
</div>
<!-- right-->
