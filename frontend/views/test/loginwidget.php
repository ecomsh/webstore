<?php
use yii\helpers\Url;

?>
<div>
    <?php if(!$name){ ?>

    <div class="quick_link fl" id="loginBar" style="display: block;">
        <span>&nbsp;您好，欢迎来到上海外高桥进口商品网！</span>
        <a href="<?= Url::to(['login/'],true); ?>">登录</a>丨<a href="https://passport.xxoo.pics/passport-reg">免费注册</a>
    </div>
    <?php }else{  ?>
    <div class="quick_link fl" id="logoutBar" style="display: block;">
        <span>您好！<span id="user_real_name"><?php  echo $name; ?></span>欢迎光临上海外高桥进口商品网</span>
        <a href="<?= Url::to(['login/logout'],true); ?>">[退出]</a>
    </div>
    <?php  }  ?>
<?php var_dump($cookies);?>
    <script>
        var data ={};
        console.log('ddd');
        jQuery.get('<?= Url::to(['login/getcookie'],true) ?>', data , function (re) {
            
            console.log(re);
            if (re.realName ) {
            jQuery("#user_real_name").html(re.realName + ',');
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

