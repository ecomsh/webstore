<?php

use yii\helpers\Url;
use yii\helpers\Html;
//use frontend\assets\LoginAsset;
//LoginAsset::register($this);
/* @var $this yii\web\View */
$this->title = '会员登录_上海外高桥进口商品网;'
?>
<div class="main w1200">
    <div class="clearfix">
        <div class="span-16 mt10" style="width: 630px;"></div> 
        <div class="fr">
            <div class="RegisterWrap">
                <div class="loginbox_left">
                    <div class="tableform">
                        <form action="<?= Yii::$app->params['baseUrl'] ?>" method="post" id="loginBar">
                            <div class="loginbox login_body"> 
                                <div class="frt ppsc-login-panel">
                                    <h2>登录</h2>
                                    <ul class="login_ul">
                                        <li>
                                        <label class="login-k"><!--<i>*</i>-->邮箱/用户名/手机：</label>
                                            <div class="login-v aling_left">
                                                <input autocomplete="off" class="x-input inputstyle user_name" name="uname" vtype="required" placeholder="用户名/邮箱/已验证手机" id="uname" tabindex="1" value="" style="border: 2px solid #999; outline: none" onfocus="style.borderColor = '#e60019 ';// regnameFocus(this);" onblur="style.borderColor = '#999 '; //checkUname(this);" type="text">        <!-- <a href="<?= Yii::$app->params['baseUrl'] ?>passport-signup.html">立即注册</a> -->
                                                <div class="crl_sz">
                                                    <span id="remind_uname"></span>
                                                    <span id="mobile_info" style="display: none;"></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                        <label class="login-k"><!--<i>*</i>-->密码：</label>
                                            <div class="login-v"><input autocomplete="off" class="x-input inputstyle password" style="border:solid 2px #999;outline:none" onblur="style.borderColor = '#999 '" onfocus="style.borderColor = '#e60019 '" name="password" type="password" vtype="required" id="password" tabindex="2" placeholder="填写密码"></div>
                                        </li>
                                        <li id="pictureCode">
                                  <label class="login-k"><!--<i>*</i>-->验证码：</label>
                                            <div class="login-v"><input autocomplete="off" class="x-input mobileverifycode" vtype="required&amp;&amp;number" size="4" maxlength="4" name="verifycode" id="iptlogin" style="width:80px;padding:6px 0px 6px 14px; border:solid 2px #999;outline:none" tabindex="3" onblur="style.borderColor = '#999 '" onfocus="style.borderColor = '#e60019'" placeholder="填写验证码" type="text"> <span class="verifyCodebox" style="display:none"><img align="absmiddle" id="membervocde" src="http://www.ftzmall.com.cn/passport-gen_vcode.html"> <a href="javascript:changeimg('membervocde')">看不清楚?换个图片</a></span></div>
                                        </li>
                                        <!-- 	  <li class="zidong_for">
                                                  <!-- <input type="checkbox" /><a href="#">自动登录</a><a href="<?= Yii::$app->params['baseUrl'] ?>passport-lost.html" >忘记密码？</a>
                                            </li> -->
                                        <li>
                                            <div class="login-v">
                                                <button class="btn btn-login common-btn login_button" type="submit" tabindex="4" rel="_request"><span><span>登录</span></span></button>        <input type="hidden" name="forward" value="">
                                            </div>
                                        </li>
                                        <li class="reg">
                                            <span>还不是会员?</span><a href="<?= Yii::$app->params['baseUrl'] ?>register.html">立即免费注册</a>
                                            <a href="<?= Yii::$app->params['baseUrl'] ?>login-passportlost.html">忘记密码？</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="crl"></div>
                                <a class="oauth-btn ob-kuajingtong fw" href="http://www.kuajingtong.com/api.php?appId=gqgj&back_url=https%3A%2F%2Fwww.ftzmall.com.cn%2Fopenapi%2Fkuajingtong_oauth_callback%2Fcheck_login%2F&client_state=aHR0cDovL3d3dy53ZWJzdG9yZWNxLmNvbTo4MDAxL2luZGV4LnBocD9yPWRvY2dyb3VwJTJGcGFnZSZ2aWV3PXNoZndfMQ%3D%3D&method=sso.checkLogin&need_login=0&nonce=123456&timestamp=20150611105624&version=1.0&sign=2199b70670697d28161ed626aa536be1"><span>跨境通信任登录</span></a><a class="oauth-btn ob-sina fw" href="https://api.weibo.com/oauth2/authorize?response_type=code&client_id=3740136130&redirect_uri=<?= Yii::$app->params['baseUrl'] ?>openapi/sina_oauth_callback/login/&state=aHR0cDovL3d3dy53ZWJzdG9yZWNxLmNvbTo4MDAxL2luZGV4LnBocD9yPWRvY2dyb3VwJTJGcGFnZSZ2aWV3PXNoZndfMQ==&forcelogin=true"><span>新浪信任登录</span></a>  </div>
                        </form>
                        <script>
                                    $$('#loginBar input').addEvent('focus', function(){
                            if ($(this.form).retrieve('showvcode', false))return;
                                    changeimg('membervocde');
                                    $$('.verifyCodebox').setStyle('display', '');
                                    $(this.form).store('showvcode', true);
                            });
                                    function changeimg(id){
                                    $(id).set('src', 'http://www.ftzmall.com.cn/passport-gen_vcode.html#' + ( + new Date()));
                                    }
                        </script>

                        <script>
                            function checkUname(input){
                            new Request({
                            url:'<?= Yii::$app->params['baseUrl'] ?>passport-checkuname.html',
                                    onComplete:function(response){
                                    if (response == 1){
                                    $('remind_uname').set('html', '');
                                    } else{
                                    $('remind_uname').set('html', response);
                                    }
                                    },
                                    method:'post',
                                    data:'login_name=' + encodeURIComponent(input.value.trim())
                            }).send();
                            }
                        </script>
                    </div>
                </div>




            </div>
            <div class="clear">
            <!-- <a class='oauth-btn ob-kuajingtong fw' href='http://www.kuajingtong.com/api.php?appId=gqgj&back_url=https%3A%2F%2Fwww.ftzmall.com.cn%2Fopenapi%2Fkuajingtong_oauth_callback%2Fcheck_login%2F&client_state=aHR0cDovL3d3dy53ZWJzdG9yZWNxLmNvbTo4MDAxL2luZGV4LnBocD9yPWRvY2dyb3VwJTJGcGFnZSZ2aWV3PXNoZndfMQ%3D%3D&method=sso.checkLogin&need_login=0&nonce=123456&timestamp=20150611105624&version=1.0&sign=2199b70670697d28161ed626aa536be1'><span>跨境通信任登录</span></a><a class='oauth-btn ob-sina fw' href='https://api.weibo.com/oauth2/authorize?response_type=code&client_id=3740136130&redirect_uri=<?= Yii::$app->params['baseUrl'] ?>openapi/sina_oauth_callback/login/&state=aHR0cDovL3d3dy53ZWJzdG9yZWNxLmNvbTo4MDAxL2luZGV4LnBocD9yPWRvY2dyb3VwJTJGcGFnZSZ2aWV3PXNoZndfMQ==&forcelogin=true' ><span>新浪信任登录</span></a><a class='oauth-btn ob-kuajingtong fw' href='http://www.kuajingtong.com/api.php?appId=gqgj&back_url=https%3A%2F%2Fwww.ftzmall.com.cn%2Fopenapi%2Fkuajingtong_oauth_callback%2Fcheck_login%2F&client_state=aHR0cDovL3d3dy53ZWJzdG9yZWNxLmNvbTo4MDAxL2luZGV4LnBocD9yPWRvY2dyb3VwJTJGcGFnZSZ2aWV3PXNoZndfMQ%3D%3D&method=sso.checkLogin&need_login=0&nonce=123456&timestamp=20150611105624&version=1.0&sign=2199b70670697d28161ed626aa536be1'><span>跨境通信任登录</span></a><a class='oauth-btn ob-sina fw' href='https://api.weibo.com/oauth2/authorize?response_type=code&client_id=3740136130&redirect_uri=<?= Yii::$app->params['baseUrl'] ?>openapi/sina_oauth_callback/login/&state=aHR0cDovL3d3dy53ZWJzdG9yZWNxLmNvbTo4MDAxL2luZGV4LnBocD9yPWRvY2dyb3VwJTJGcGFnZSZ2aWV3PXNoZndfMQ==&forcelogin=true' ><span>新浪信任登录</span></a> -->
            </div>
            <!--解决UTF8-->
            <div class="oauth">

            </div>
        </div>
    </div>
</div>
<!-- <div class="sidebar-right">
    <a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
    <a href="javascript:void(0)" class="sidebar-backtop"></a>
    <a href="javascript:void(0)" class="sidebar-close"></a>
</div> -->
<script>
    (function(){
    $$('.sidebar-backtop').addEvent('click', function(){
    $(window).scrollTo(0, 0)
    });
            $$('.sidebar-close').addEvent('click', function(){
    $$('.sidebar-right').setStyle('display', 'none')
    })
    })();
</script>

