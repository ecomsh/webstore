<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '客户留言_上海外高桥进口商品网';
?>


<!-- right-->
<div style="width: 960px;" class="member-main">
    <div class="review-box">
        <h4 class="review-title">客户留言</h4>
        <div class="loginbox division" style="border:none">
            <form method="post" id="ordermsgForm" action="<?= Yii::$app->params['baseUrl'] ?>member-toadd_order_msg.html">
                <script>
                    var button_valiate = function(element_node) {
                        // el element id.
                        var _validate_return = element_node.getElements('[vtype]').every(function(el) {

                            return validate(el);
                        });

                        return _validate_return;
                    };

                    subOrderMsgForm = function(event, sign) {
                        var odr_form = $('ordermsgForm');

                        _formActionUrl = odr_form.get('action');
                        _return = button_valiate(odr_form);

                        if (_return)
                        {
                            new Request(
                                    {
                                        url: _formActionUrl,
                                        method: 'post',
                                        data: odr_form.toQueryString(),
                                        onComplete: function() {
                                            alert('提交成功');
                                            window.opener.location.reload();
                                            window.close();
                                        }
                                    }).send();
                        }
                    };
                </script>
                <ul>
                    <li>
                        <label class="login-k"><em style="color:red">*</em>标题：</label>
                        <div class="login-v"><input autocomplete="off" class="x-input inputstyle" vtype="required" style=" width:465px" size="50" name="msg[subject]" maxlength="20" id="dom_el_5f775e0" type="text"></div>
                    </li>
                    <li>
                        <label class="login-k"><em style="color:red">*</em>内容：</label>
                        <div class="login-v"><textarea type="textarea" vtype="required" rows="5" name="msg[message]" class="inputstyle" style="width:465px" id="dom_el_5f775e1"></textarea></div>
                    </li>
                    <li>
                        <label class="login-k">&nbsp;</label>
                        <div class="login-v"><button type="button" class="btn submit-btn" onclick="subOrderMsgForm(event, 2);"><span><span>提交留言</span></span></button></div>
                    </li>
                </ul>
                <input name="msg[orderid]" value="2015061214908516" type="hidden">
                <input name="msg[msgType]" value="0" type="hidden">
            </form>
        </div>
    </div>
</div>
<!-- right-->



