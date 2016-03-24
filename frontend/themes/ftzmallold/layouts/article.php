<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\MainAsset;
MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="toolbar clb">
            <div class="w1200 clearfix">
                <?= \frontend\widgets\LoginWidget::widget();?>
                <div class="tool_link fr">
                    <ul>
                        <!-- /business.html -->                           
                        <li class="tool_arrow"><a href="<?=  Url::to(['order/index']);?>">会员中心<i></i></a></li>
                            <div style="display: none;" class="tool_arrow_dis">
                                <div class="head_weixin"></div>
                                <div class="head_weibo"></div>
                            </div>
                        </li>
                        <li style="margin-right: -90px;" id="banner_menu_last">
                            <div id="wcenter"></div>
                            <script>
                                var e = Cookie.read('UNAME') ? Cookie.read('UNAME') : '';
                                var seller = Cookie.read('SELLER') ? Cookie.read('SELLER') : '';

                                if (seller)
                                {
                                    //$('banner_menu_last').setStyle('margin-right',90);
                                    $('wcenter').setHTML('<a href="business.html">卖家中心</a> 丨');
                                }
                                else if (e)
                                {
                                    //$('banner_menu_last').setStyle('margin-right',90);
                                    $('wcenter').setHTML('<a href="<?=  Url::to(['user/']);?>">买家中心</a> 丨');
                                }
                                else
                                    $('banner_menu_last').setStyle('margin-right', -90);

                            </script>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
        <div class="header clb">

            <div class="w1200 clearfix">
                <div class="logo fl"><a href="<?= Url::to(['act/page']); ?>"><img alt="FTZMALL" src="<?= Yii::$app->params['baseimgUrl'] ?>c50e5fbf3bef1b333a7cc1b6abd4013b92c.png" border="0"></a></div>

                <ul class="dzul">
                    <!-- <li class="li4"><img src="<?= Yii::$app->params['baseimgUrl'] ?>index_m4_03.jpg" width="90" height="33" alt="全场免税"></li>
                    <li class="li4"><img src="<?= Yii::$app->params['baseimgUrl'] ?>index_m4_05.jpg" width="95" height="33" alt="原装进口"></li>
                    <li class="li4"><img src="<?= Yii::$app->params['baseimgUrl'] ?>index_m4_07.jpg" width="94" height="33" alt="海关监管"></li>
                    <li class="li4"><img src="<?= Yii::$app->params['baseimgUrl'] ?>index_m4_09.jpg" width="94" height="33" alt="快捷到货"></li> -->
                    <!-- <li class="li5">
                        <div class="shopdiv"><div class="spic"><img src="<?= Yii::$app->params['baseimgUrl'] ?>index_m4_13.png" width="20" height="20"></div>
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
                    </li> -->
                </ul>
               <?= $this->render('_search_box') ?> 
            </div>

            <?= $this->render('_right') ?> 
            <?= $this->render('_nav') ?> 
            <!--  -->
            <div class="main w1200 clb">
                 <?= $this->render('_aleft') ?> 
                <div class="art_rg">
                <?= $content ?>
                </div>
            </div>
            <script>
                (function() {
                    $$('.sidebar-backtop').addEvent('click', function() {
                        $(window).scrollTo(0, 0)
                    });
                    $$('.sidebar-close').addEvent('click', function() {
                        $$('.sidebar-right').setStyle('display', 'none')
                    })
                })();
            </script>

       
            <?= $this->render('_map') ?> 
            <?= $this->render('_footer') ?> 

        </div>
    <?php $this->endBody() ?>
         <script>jQuery.noConflict();</script> 
    </body>
</html>
<?php $this->endPage() ?>
