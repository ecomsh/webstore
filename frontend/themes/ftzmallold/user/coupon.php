<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '优惠券_上海外高桥进口商品网';
?>

<!--right-->
<div style = "width: 960px;" class = "member-main">
    <div>
        <div class = "title title2"><span style = "float:left">我的优惠券<span class = "disc">|</span> <span id = "add" class = "disc add-icon">
                    <a href = "javascript:void(0);">
                        激活优惠券</a></span></span>
            <span class = "noticebox">在此激活您的优惠券以便使用。</span></div>


        <div id = "addr_div" style = "display: inline;">

            <div class = "division " style = "border:none; border-bottom:1px dashed #ddd">
                <table class = "forform" border = "0" cellpadding = "0" cellspacing = "0">
                    <tbody><tr>
                            <th>优惠券号码：</th>

                            <td>
                                <input autocomplete = "off" class = "x-input inputstyle" name = "name" id = "active_cop" size = "30" vtype = "required" type = "text"></td>
                        </tr>
                    </tbody></table>
            </div>
            <div style = "padding-left:142px; "><span class = "float-span">
                    <button onclick = "to_activate();" id = "btn_activate" class = "btn btn submit-btn" type = "button"><span><span>激活</span></span></button></span>
                <span class = "float-span" style = "float:left; margin-left:8px">
                    <button id = "unset" type = "button" class = "btn"><span><span>取消</span></span></button></span>
            </div>

        </div>
        <table class = "gridlist border-all gridlist_member" cellpadding = "3" cellspacing = "0" width = "100%">
            <colgroup><col class = "span-2 ">
                <col>
                <col class = "span-6">
                <col class = "span-2">
                <col class = "span-2">

            </colgroup><thead>
                <tr>
                    <th class = "first">优惠券号码</th>
                    <th>名称</th>
                    <th>有效期</th>
                    <th>状态</th>
                    <th>操作</th>
                    <!--<th>限用商品</th> -->
                </tr>
            </thead>
            <tbody><tr>
                    <td>B201505201233953F50005L</td>
                    <td class = "textcenter font-black">test店铺优惠券<br>
                    </td>

                    <td>15-05-20 00:00 ~ 15-06-03 00:00</td>
                    <td align = "center"><span class = "green"><!--不可用状态时候样式应用为"gray" -->还未开始或已过期</span></td>

                    <td align = "center">
                    </td>

                </tr>
                <!--<tr>
                <td class = " textleft"><span style = "color:#666;"></span></td>
                </tr> -->

                <tr>
                    <td>B201505201233C55930002T</td>
                    <td class = "textcenter font-black">test店铺优惠券<br>
                    </td>

                    <td>15-05-20 00:00 ~ 15-06-03 00:00</td>
                    <td align = "center"><span class = "green"><!--不可用状态时候样式应用为"gray" -->还未开始或已过期</span></td>

                    <td align = "center">
                    </td>

                </tr>
                <!--<tr>
                <td class = " textleft"><span style = "color:#666;"></span></td>
                </tr> -->

                <tr>
                    <td>B201505201233E0BB500047</td>
                    <td class = "textcenter font-black">test店铺优惠券<br>
                    </td>

                    <td>15-05-20 00:00 ~ 15-06-03 00:00</td>
                    <td align = "center"><span class = "green"><!--不可用状态时候样式应用为"gray" -->还未开始或已过期</span></td>

                    <td align = "center">
                    </td>

                </tr>
                <!--<tr>
                <td class = " textleft"><span style = "color:#666;"></span></td>
                </tr> -->

            </tbody>
        </table>

    </div>
</div>
<!--right-->
<script>
    $("add").addEvent('click', function(e) {
        $('addr_div').setStyle('display', 'inline');
    });

    $("unset").addEvent('click', function(e) {
        $('addr_div').setStyle('display', 'none');
    });

    function to_activate() {
        var code = $('active_cop').value.trim();
        activecoupon(code);
    }

    function activecoupon(code) {

        code = code.trim();
        var btn = $('btn_activate');
        var rex = /[^a-zA-Z0-9]/g;
        if (code == '') {
            return false;
        } else {
            if (rex.test(code)) {
                Message.error('优惠券编号格式不正确');
                return false;
            } else {
                btn.disabled = true;
//top.location.href="<?= Yii::$app->params['baseUrl'] ?>member-active_mycoupons-"+code+".html";


                new Request.JSON({
                    url: '<?= Yii::$app->params['baseUrl'] ?>member-active_mycoupons.html',
                    method: 'post',
                    data: 'code=' + code,
                    onComplete: function(re) {

                        if (re == null)
                            return;

                        if (re.status == 'success') {
                            Message.success(re.msg);

                        } else {
                            Message.error(re.msg);

                        }
                        btn.disabled = false
                        top.location.href = "<?= Yii::$app->params['baseUrl'] ?>member-coupon.html"
                    }
                }).send();

            }
        }
    }


</script>