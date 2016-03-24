<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '取回密码_上海外高桥进口商品网;'
?>

<div class="main w1200 clb">
    <div class="mt10">
        <div id="pass" class="register-wrap clearfix">
            <h4>取回密码第一步：验证账号</h4>
            <div class="form password-return">
                <form method="post" action="<?= Yii::$app->params['baseUrl'] ?>login-passportlost2.html" id="lostBar">
                    <div class="loginbox">
                        <!-- <h4>忘记密码？</h4> -->
                        <div class="intro"><div class="customMessages"></div></div>
                        <div>
                            <input name="forward" value="" type="hidden">
                            <ul>
                                <li class="clearfix">
                                    <label class="login-k">
                                        <i>*</i>用户名：              </label>
                                    <div class="login-v">
                                        <input autocomplete="off" class="x-input inputstyle" name="login" vtype="required" id="recover_login" type="text">                <input style="display:none;" type="text">
                                        <span id="reg_user_info"></span>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <label class="login-k">
                                        <i>*</i>验证码：              </label>
                                    <div class="login-v">
                                        <input autocomplete="off" class="x-input " vtype="required&amp;&amp;number" size="4" maxlength="4" name="verifycode" style="width:60px;padding:6px 0px 6px 14px;" id="iptlogin" tabindex="3" type="text">                <span class="verifyCodebox" style="display:none">
                                            <img id="membervocde" src="" tppabs="http://www.ftzmall.com.cn/passport-gen_vcode.html" align="absmiddle">
                                            <a href="javascript:changeimg('membervocde')">
                                                看不清楚?换个图片                  </a>
                                        </span>
                                    </div>
                                </li>
                                <li>
                                    <label class="login-k"></label>
                                    <div class="login-v">
                                        <button class="btn submit-btn" rel="_request" type="submit" data-ajax-config="{update:'pass'}"><span><span>下一步</span></span></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
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
                $(id).set('src', 'http://www.ftzmall.com.cn/passport-gen_vcode.html#' + (+new Date()));
            }
        </script>	
    </div>
</div>
