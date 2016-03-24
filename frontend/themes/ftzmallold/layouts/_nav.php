<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\widgets\MenuNew;
/* @var $this yii\web\View */
?>
<div class="header-wrap">
    <div class="menu ppsc-main-menu clb">
        <div class="w1200 clearfix">
            <!--  <div class="span-auto catalog-main  active" id="catalog_main"> -->
            <div class="span-auto catalog-main" id="catalog_main"></div>
            <div class="span-auto nav_main"> 
                <?php
                    echo MenuNew::widget(Yii::$app->params['navMenu']);
                ?>          
            </div>



            <div class="dzul">
            <div class="shopdiv" onclick="javascript:window.location.href='<?= Url::to(['cart/']); ?>'" style="cursor:pointer;"><div class="spic"><img src="<?= Yii::$app->params['baseimgUrl'] ?>index_m4_13.png" width="20" height="20"></div>
                            <div class="stext">购物车</div>
                            <div class="sshow">
                                <a href="<?= Url::to(['cart/']); ?>" class="cart-wrap">
                                    <span class="icon"></span>（
                                    <script>

                                        var cookietotalnum = 0;
                                        var _prefix_number = "";
                                        var _subfix_number = "</span>";
                                        _prefix_number = '<span id="cart_num" class="red">';

                                        if ('<?= Yii::$app->user->getId() ?>' != '')
                                        {
                                            cookietotalnum = jQuery.cookie('carttotalNum' + '<?= Yii::$app->user->getId() ?>');
                                            if (!cookietotalnum)
                                            {

                                                jQuery.ajax({
                                                    type: 'get',
                                                    url: '<?= Url::to(['cart/getcarttotalnum']) ?>',
                                                    success: function (carttotalnum) {
                                                        cookietotalnum = carttotalnum;
                                                        jQuery("#cart_num").html(carttotalnum);
                                                    }
                                                })
                                            }
                                        }
                                        document.write(typeof (cookietotalnum) == 'undefined' ? (_prefix_number + '0' + _subfix_number) : _prefix_number + (cookietotalnum ? cookietotalnum : '0') + _subfix_number);


                                    </script>                                    
                                    ）    
                                </a>&gt;</div>
                        </div>
                    </div>



            
            <div class="fr bottom"></div>
        </div>
    </div>
</div>
<!--  -->