<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<div class = "index_m4_bottom_red_line"></div>
<div class = "ppsc-copyright">
    <script>
        function UrlDecode(zipStr) {
            var uzipStr = "";
            for (var i = 0;
                    i < zipStr.length;
                    i++) {
                var chr = zipStr.charAt(i);
                if (chr == "+") {
                    uzipStr += " ";
                } else if (chr == "%") {
                    var asc = zipStr.substring(i + 1, i + 3);
                    if (parseInt("0x" + asc) > 0x7f) {
                        uzipStr += decodeURI("%" + asc.toString() + zipStr.substring(i + 3, i + 9).toString());
                        i += 8;
                    } else {
                        uzipStr += AsciiToString(parseInt("0x" + asc));
                        i += 2;
                    }
                } else {
                    uzipStr += chr;
                }
            }

            return uzipStr;
        }

        function StringToAscii(str) {
            return str.charCodeAt(0).toString(16);
        }
        function AsciiToString(asccode) {
            return String.fromCharCode(asccode);
        }
        var uc_login_cookie = Cookie.read('uc_login_script');
        if (uc_login_cookie) {
            //		console.log(uc_login_cookie);
            //		console.log(UrlDecode(uc_login_cookie));
            uc_login_cookie = uc_login_cookie.replace(/\+/g, ' ');
            document.write(uc_login_cookie);
            Cookie.dispose('uc_login_script');
        }

        var uc_login_out_cookie = Cookie.read('uc_loginout_script');
        if (uc_login_out_cookie) {
            uc_login_out_cookie = uc_login_out_cookie.replace(/\+/g, ' ');
            document.write(uc_login_out_cookie);
            Cookie.dispose('uc_loginout_script');
        }
    </script>
    <script type="text/javascript">//延迟加载
        new DataLazyLoad({lazyDataType: 'img', img: 'lazyload'});
     </script>

    <script id="dropmenu-template" type="text/template">
        <div class="{body}">
        <div class="{content} clearfix">{main}</div>
        </div>
    </script>
    <script id="popup-template" type="text/template">
        <div class="{body}">
        <div class="{header} clearfix">
        <h2>{title}</h2>
        <span><button type="button" title="关闭" class="{close}" hidefocus>x</button></span>
        </div>
        <div class="{content} clearfix">{main}</div>
        </div>
    </script>
    <div align="center">
        <font color="#d4d4d4" style="line-height:20px;padding-top:20px;display:block">
            <a href="<?= Url::to(['article/page', 'view' => 'gywm']); ?>" type="url"><font color="#d4d4d4">关于我们</font></a>|
            <a href="<?= Url::to(['article/page', 'view' => 'pprz']); ?>" type="url"><font color="#d4d4d4">品牌入驻</font></a>|
            <a href="<?= Url::to(['article/page', 'view' => 'lxwm']); ?>" type="url"><font color="#d4d4d4">联系我们</font></a>|
            <a href="<?= Url::to(['article/page', 'view' => 'mzsm']); ?>" type="url"><font color="#d4d4d4">免责声明</font></a>|
            <a href="<?= Url::to(['article/page', 'view' => 'ystk']); ?>" type="url"><font color="#d4d4d4">隐私条款</font></a>|
            <a href="<?= Url::to(['article/page', 'view' => 'wsjgb']); ?>" type="url"><font color="#d4d4d4">完税价格表</font></a>|
            <a href="<?= Url::to(['article/page', 'view' => 'zpxx']); ?>" type="url"><font color="#d4d4d4">诚聘英才</font></a>|
            <a href="http://www.kuaidi100.com/" type="url" target="_blank"><font color="#d4d4d4">快递 100</font></a>
            <br>
            Copyright © 2006 - 2015 上海外高桥进口商品网版权所有&nbsp;&nbsp; 
            <a href="http://www.miibeian.gov.cn/" type="url" target="_blank"><font color="#d4d4d4">沪ICP备11030945号-3</font>&nbsp;</a>&nbsp;
            <a href="<?= Yii::$app->params['baseimgUrl'] ?>shgsj.jpg" type="url"><font color="#d4d4d4">增值电信业务经营许可证 沪B-20110100</font></a>
        </font>
            <br>
        <div style="text-align:center;">
            <a id="___szfw_logo___" href="https://credit.szfw.org/CX20140320003625003666.html" target="_blank"><img src="<?=Yii::$app->params['baseimgUrl']?>cert.png"></a>
            <a target="_blank" type="url" href="http://www.miibeian.gov.cn/state/outPortal/loginPortal.action;jsessionid=9gLvJpXhM6LQ2GqvylYrKdnnYcBp1ymyQXXYpLFsnr4cq9k1Yr8J%21822702665"><img src="<?=Yii::$app->params['baseimgUrl']?>ad9f55746d463a0239cab19573b62ed165f.png" height="39" width="110"></a>&nbsp;
<!--            <script src="<?=Yii::$app->params['baseimgUrl']?>h.js" type="text/javascript"></script>-->
            <span style="position:relative;top:-5px"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
            document.write(unescape("%3Cspan id='cnzz_stat_icon_1254944678'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1254944678' type='text/javascript'%3E%3C/script%3E"));</script></span>
        </div>
        <br>
    </div>    
</div>
