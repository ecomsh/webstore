<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = '实名认证_上海外高桥进口商品网';
?>

    
                <div class="m-page" style="">
                    <div class="m-header">
                        <div class="header-left-btn">
                            <span onclick="history.back()" class="icon-back"></span>
                        </div>
                        <h2>立即实名认证</h2>
                        <div class="header-right-btn">
                            <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                        </div>
                    </div>
                    <div class="full-screen">
                        <div class="full-padding">
                            <!-- 商家广告展示的图片轮播-->
                            <div class="page pt-pic" style="position:relative;z-index:0;">
                                <div class="login-close-btn"></div>
                                <div data-am-widget="slider" class="am-slider am-slider-default swiper-container" data-am-slider='{&quot;directionNav&quot;:false}' data-am-flexslider="{playAfterPaused: 3000}">
                                    <ul class="am-slides">
                                        <li>
                                            <a href=""><img src="<?= yii::$app->params['localimgUrl']?>ad1.jpg"></a>
                                        </li>
                                        <li>
                                            <a href=""><img src="<?= yii::$app->params['localimgUrl']?>ad3.jpg"></a>
                                        </li>
                                        <li>
                                            <a href=""><img src="<?= yii::$app->params['localimgUrl']?>b46b66dc6cfda7440e52b0a019218b9d4f1.jpg"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div style="margin-top:20px;">提示信息： 因涉及国家监管部门规定，需要对购买人信息实名备案，本网站不会保留相关个人隐私信息，请您放心填写。</div>

                            <div class="btn-bar mt20">
                                <a href="<?=Url::to(['realname/index'])?>">
                                    <button type="submit" class="btn red_btn" >立即实行认证</button>
                                </a>
                            </div>
                            <div class="btn-bar mt20">
                                <a href="<?=Url::to(['index/index'])?>">
                                    <button type="submit" class="btn red_btn">先去购物</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
