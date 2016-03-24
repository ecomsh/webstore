<?php use yii\helpers\Url;?>
<div class="tool_link fr">
                    <ul>
                        <!-- /business.html -->    
<?php /* ?>                        <li style="text-align:center"><a href="<?=  Url::to(['user/favorite']);?>">收藏夹</a><span style="float:right">丨</span></li><?php */ ?>
                        <li class="tool_arrow"><a href="<?=  Url::to(['order/index']);?>">会员中心<i></i></a></li>
        <?php /* ?>                   <li class="tool_arrow_t">网站微信<i></i>丨
                            <div style="display: none;" class="tool_arrow_dis">
                                <div class="head_weixin"></div>
                                <div class="head_weibo"></div>
                            </div>
                        </li>  
        <?php  * 
         */   ?>
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