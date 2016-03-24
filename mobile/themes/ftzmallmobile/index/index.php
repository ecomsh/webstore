<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
use mobile\assets\ProductAsset;
ProductAsset::register($this);
$this->title = '商品详情页';
?>
    
                <div class="m-page">
                    <div class="top-holder">
                        <div class="fixed-top">
                            <div class="m-header">
                                <div class="header-left-btn">
                                    <span onclick="history.back()" class="icon-back"></span>
                                </div>
                                <h2>苏格兰 殿斯圆形奶油黄油饼干 160g</h2>
                                <div class="header-right-btn2">
                                    <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                                </div>
                                <div class="header-right-btn">
                                    <a href="javascript:void(0)" class="icon-share js_share"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="height:10px;"></div>
                    <!--       图片轮播1-->
                    <div class="page pt-pic">
                        <div data-am-widget="slider" class="am-slider am-slider-default swiper-container" data-am-slider='{&quot;directionNav&quot;:false}' data-am-flexslider="{playAfterPaused: 3000}">
                            <ul class="am-slides">
                                <li class="lazyload">
                                    <a href=""><img src="<?= yii::$app->params['localimgUrl']?>ad1.jpg"></a>
                                </li>
                                <li class="lazyload">
                                    <a href=""><img src="<?= yii::$app->params['localimgUrl']?>ad3.jpg"></a>
                                </li>
                                <li class="lazyload">
                                    <a href=""><img src="<?= yii::$app->params['localimgUrl']?>b46b66dc6cfda7440e52b0a019218b9d4f1.jpg"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="full-screen">
                        <form action="http://bbctest.ftzmall.com.cn/wap/cart-add-goods.html" method="post" id="buy_form" data-type="ajax">
                            <input type="hidden" name="btype" class="btype">
                            <!-- value="is_fastbuy" 立即购买提交的时候要带上这个值 -->
                            <input type="hidden" name="goods[goods_id]" value="227">
                            <input type="hidden" name="goods[num]" value="1">
                            <input type="hidden" id="product_id" name="goods[product_id]" value="686">
                            <input type="hidden" name="mini_cart" value="true">

                            <div class="product-wrap">
                                <div class="product-info">
                                    <!-- 商品标题 -->
                                    <div class="col2">
                                        <div class="col">
                                            <h1 class="pt-name">
                                    苏格兰 殿斯圆形奶油黄油饼干 160g                    
                                            </h1>
                                        </div>

                                    </div>
                                    <!-- 商品价格 -->
                                    <div class="col2 pt-price">
                                        <!-- 商品价格 -->
                                        <div class="col price">
                                            <b class="price">￥3200.00</b>
                                            <span>大陆参考价：￥3800.00</span>
                                        </div>
                                    </div>
                                    <!--购买按钮-->
                                    <div class="pt-btn">
                                        <!--购买按钮-->
                                        <a href="<?= Url::to(['cart/cartnotempty'])?>" class="btn add-cart" id="J_buy_btn">
                                            加入购物车
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-wrap">
                                <img class="product-img" src="<?= yii::$app->params['localimgUrl']?>product-cn.png">
                            </div>
                            <!-- 促销信息 -->
                            <div style="display:none">
                                <!-- 促销信息 -->
                                <div class="pt-promotions">
                                    <span class="icon red">
                                       促
                                    </span>
                                    <!-- 商品促销标签 -->

                                    <!-- 订单促销标签 -->
                                    <span class="arr right"></span>
                                </div>

                                <!-- 促销具体名称 -->
                                <div class="promotions-panel tab" style="display:none">
                                    <ul class="trigger-list">
                                        <li class="trigger act" data-target="0">商品促销</li>
                                        <li class="trigger" data-target="1">订单促销</li>
                                    </ul>
                                    <div class="panel act">
                                        <ul>
                                        </ul>
                                    </div>
                                    <div class="panel">
                                        <ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 商品规格 -->
                            <div class="pt-sku" style="display:none;">
                            </div>
                        </form>

                        <div class="pt-detail">
                            <div class="tab J-tab">
                                <ul class="trigger-list">
                                    <li class="trigger act">
                                        <span>商品信息</span>
                                    </li>
                                    <li class="trigger">
                                        <span>商品详情</span>
                                    </li>
                                </ul>
                                <!--对应列表-->
                                <ul class="panel-list">
                                    <!--商品信息-->
                                    <li class="panel act">
                                        <div class="d-line1">
                                            <span class="k">品牌：</span>
                                            <span class="v"><a href="">殿斯 </a></span>
                                        </div>
                                        <div class="d-line1">
                                            <span class="k">所属分类：</span>
                                            <span class="v">礼盒</span>
                                        </div>
                                        <div class="d-line1">
                                            <span class="k">商品属性：</span>
                                            <span class="v">礼盒</span>
                                        </div>
                                        <div class="d-line1">
                                            <span class="k">详细参数：</span>
                                            <span class="v">礼盒</span>
                                        </div>
                                        <br>
                                        <br>
                                    </li>
                                    <!--商品图片详情-->
                                    <li class="panel">
                                        <!-- 商品详情 -->
                                        <div class="d-line">
                                            <span class="v">
                                                <div style="text-align: center;">
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/6c/53/92/0f334846963912037ddf198fadcf912698f.jpg?1398049611#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/91/a2/08/21b35ef0b9c29ed6425da595be080c71027.jpg?1398049621#w" class="lazy"></div>
                        <div style="text-align: center;">
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/c2/b4/c4/d016966ac06d1ae5f39ba9a8ac1fd40258b.jpg?1398049948#w" class="lazy"></div>
                        <div style="text-align: center;">
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/7b/34/61/3073c685dd1c5ea7d1fb88fd73ff85fd263.jpg?1398049636#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/f3/9f/44/edc5136c757edbb3fa88552ca535854a6f8.jpg?1398049644#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/25/b8/e8/39f5f7562f6771dcf2f84f716070db497b0.jpg?1398049658#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/bc/8a/87/8ffc24dc4350edb5a367bb138a5b9d1c155.jpg?1398049712#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/eb/6d/a5/b155abe043b10972de452c1e68915b5b9ce.jpg?1398049724#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/1f/1d/4b/a20466f7003f378bca1963c9a3c27993453.jpg?1398049738#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/cd/22/6b/c85b4eefc40e6e0168ef90a00bdca3a06e1.jpg?1398049748#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/91/7b/dd/7f652df8aa9b2d0200b2d2f48e5dec896fb.jpg?1398049771#w" class="lazy"></div>
                        <div style="text-align: center;"> 
                        <img data-original="http://ecomgq-images.oss.aliyuncs.com/f2/2a/bc/3249dec221f5f96615ae5aeb3b0e87f24c8.jpg?1398049781#w" class="lazy"></div>
                                       </span>
                                        </div>
                                        <div style="height:60px;"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="share-wrap" style="height: 401px; bottom: -401px;">
                            <div class="share-wrap-bg">
                            </div>
                            <div class="share-wrap-main">
                                <ul>
                                    <li style="height: 256.5px;">
                                        <a href="http://www.jiathis.com/send/?webid=tsina&url=http://www.urlurl.com&title=%E5%A4%96%E9%AB%98%E6%A1%A5%E5%88%86%E4%BA%AB">
                                            <img src="<?= yii::$app->params['localimgUrl']?>share-icon-xl.png">
                                        </a>
                                    </li>
                                    <li style="height: 256.5px;">
                                        <a class="jiathis_button_weixin" title="分享到微信"><span class="jiathis_txt jiathis_separator jtico jtico_weixin"><img src="<?= yii::$app->params['localimgUrl']?>share-icon-wx.png"></span></a>
                                    </li>
                                    <li style="height: 256.5px;">
                                        <a class="jiathis_button_weixin" title="分享到微信"><span class="jiathis_txt jiathis_separator jtico jtico_weixin"><img src="<?= yii::$app->params['localimgUrl']?>share-icon-pyq.png"></span></a>
                                    </li>
                                </ul>
                                <a href="#" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis share-more">更多</a>
                                <a href="#" class="share-close"></a>
                            </div>
                        </div>

                        <div class="fixed-action">
                            <div class="fixed-action-bg">
                            </div>
                            <div class="fixed-action-main">
                                <div class="col-2">
                                    <a href="#" class="add-cart-icon"></a>
                                </div>
                                <div class="col-3">
                                    <span class="price">
                                       ￥3200.00                
                                    </span>
                                </div>
                                <div class="col-5">
                                    <a href="<?= Url::to(['cart/cartnotempty'])?>" class="add-cart-btn">
                                       加入购物车
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(function() {
                        //图片懒加载启动
                        $("img.lazy").lazyload();
                    })

                </script>
                
