<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
use frontend\assets\ProductAsset;
ProductAsset::register($this);
$this->title = '缺货登记-上海外高桥进口商品网';
?>

<div class = "main w1200">
    <div class = "mTB">
        <div class = "goods-info-wrap width_1200">
            <table width = "100%" cellspacing = "0" cellpadding = "0">
                <tbody><tr>
                        <td width = "1"><div class = "goodspic"><a href = "<?= Yii::$app->params['baseUrl'] ?>product-gnotify.html#" target = "_blank"><img src = "" alt = "" id = "product_image" style = "display:none"></a></div></td>
                        <td valign = "top"><h1 class = "goodsname"><span><a class = "font-blue" href = "<?= Yii::$app->params['baseUrl'] ?>product-1561.html">加拿大 BROOKSIDE 蓝莓黑巧克力 850g</a></span></h1>
                            <ul class = "goodsprops clearfix">
                                <li><span>货号：</span><span>124200000008</span></li>
                                <li><span>商品重量：</span><span>935.000 克(g)</span></li>
                                <li><span>销售价：</span><span class = "font-red fontbold">￥114.00</span></li>
                            </ul>
                            <a class = "btn-a" href = "<?=Yii::$app->params['baseUrl']?>product-1561.html"><span>查看详细</span></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class = "FormWrap">
                <h4>缺货登记</h4>
                <p style = "padding:5px 0">该货品暂时缺货，请在下面输入您的E-mail地址，当我们有现货供应时，我们会发送邮件通知您！</p>
                <div class = "division">

                    <form method = "POST" action = "<?=Yii::$app->params['baseUrl']?>product-toNotify.html">
                        <input type = "hidden" name = "item[0][goods_id]" value = "1561">
                        <input type = "hidden" name = "item[0][product_id]" value = "2076">
                        <table border = "0" cellspacing = "0" cellpadding = "0" class = "forform">
                            <tbody><tr>
                                    <th>您的邮箱:</th>
                                    <td><input autocomplete = "off" class = "x-input _x_ipt x-input inputstyle" type = "text" vtype = "email" name = "email" size = "30" id = "dom_el_af4bd00"></td>
                                    <td style = "padding-top:3px">
                                    </td><th>手机号:</th>
                                    <td><input autocomplete = "off" class = "x-input _x_ipt x-input inputstyle" type = "text" vtype = "number" name = "cellphone" size = "30" id = "dom_el_0721c31"></td>
                                    <td style = "padding-top:3px">
                                        <button type = "submit" rel = "_request" class = "btn"><span><span>提交</span></span></button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>