<?php
use yii\helpers\Url;
?>
<div>
    <div class="quick_link fl" id="loginBar" style="display: none;">
        <span>&nbsp;您好，欢迎来到上海外高桥进口商品网！</span>
        <a href="<?= Url::to(['login/'],true); ?>">登录</a>丨<a href="<?=Yii::$app->params['CAS']['regUrl'];?>">免费注册</a>
    </div>
    <div class="quick_link fl" id="logoutBar" style="display: none;">
        <span>您好！<span id="user_real_name"></span>欢迎光临上海外高桥进口商品网</span>
        <a href="<?= Url::to(['login/logout'],true); ?>">[退出]</a>
    </div>

    <script>
        
        var data ={};
        jQuery.get('<?= Url::to(['login/getcookie'],true) ?>', data , function (re) {
        if (re.userName ) {
            jQuery("#user_real_name").html(re.userName + ',');
            jQuery("#logoutBar").css('display', 'block');
            if (jQuery("#loginBar"))
                jQuery("#loginBar").css('display', 'none');
        }
        else {
            jQuery("#loginBar").css('display', 'block');
            if (jQuery("#logoutBar"))
                jQuery("#logoutBar").css('display', 'none');
        }
        });
        
    </script>
</div>

