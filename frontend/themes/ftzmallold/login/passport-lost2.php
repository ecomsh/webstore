<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '取回密码_上海外高桥进口商品网;'
?>

<div class="main w1200 clb">
    <div class="mt10">
        <div id="pass" class="register-wrap clearfix"><div class="register-wrap clearfix">
                <h4>取回密码第二步：验证身份</h4>
                <!--p class="intro">
                  说明：当你填写邮箱并提交后，密码会自动发到您注册的邮箱里面，请及时收邮件，取回密码！  </p-->
                <div class="form password-return">
                    <form id="recoverForm" name="FORM_TPL_FORGETQUESTION" method="post" action="<?= Yii::$app->params['baseUrl'] ?>passport-sendPSW.html">
                        <ul>
                            <li>
                                <label>请选择验证身份方式：</label>
                                <select id="verify_way" name="verify_way" vtype="required" onchange="getVerifyWay(this);">
                                    <option selected="selected" value="email">
                                        邮箱              </option>
                                </select>
                            </li>
                            <li>
                                <label>用户名：</label>
                                c**************2<input name="uname" value="cbt_143399151492" type="hidden">
                            </li>
                            <div id="verify_email" style="">
                                <li>
                                    <label>邮箱：</label>
                                    5*******1@qq.com            <input name="contact[email]" value="584238961@qq.com" type="hidden">
                                </li>
                            </div>
                            <div id="verify_mobile" style="display:none">
                                <li>
                                    <label>已验证手机：</label>
                                    <input id="reg_mobile" name="contact[phone][mobile]" value="" type="hidden">
                                </li>
                                <li id="mobileCode">
                                    <label class="login-k"><i>*</i>短信验证码：</label>
                                    <input autocomplete="off" class="x-input " vtype="number&amp;&amp;required" size="6" maxlength="6" style="width:60px;padding:6px 0px 6px 14px;" name="mobileverifycode" id="mobileverifycode" type="text">            <div class="getmobilecode">
                                        <button class="sendMobileCode" type="button" onclick="getRecoverMobileCode();">获取短信验证码</button>
                                        <div id="mobile_success">
                                            <span id="cut_time" style="display: none;">剩余时间<span class="second_red">58</span>秒</span>
                                        </div>
                                    </div>
                                </li>
                            </div>
                            <li id="button-li" class="button-li"><button id="submit_btn" type="submit" class="btn common-btn"><span><span>发送验证邮件</span></span></button></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $$('#lostBar input').addEvent('focus', function() {
                if ($(this.form).retrieve('showvcode', false))
                    return;
                changeimg('membervocde');
                $$('.verifyCodebox').setStyle('display', '');
                $(this.form).store('showvcode', true);
            });

            function changeimg(id) {
                $(id).set('src', '<?= Yii::$app->params['baseUrl'] ?>passport-gen_vcode.html#' + (+new Date()));
            }
        </script>	
    </div>
</div>