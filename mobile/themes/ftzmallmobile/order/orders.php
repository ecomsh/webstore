<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = '会员中心_上海外高桥进口商品网';
$getData = Yii::$app->request->get('orderSearch');
?>
<style type="text/css">
    .am-pagination>li>a, .am-pagination>li>span{padding:0.3rem 0.6rem;}
    .tabsnav{background: #eee;}
    .tabsnav li{height:42px;}
    .tabsnav a{color:#222;line-height: 42px;}
    .tabsnav > .am-active { position: relative;background-color: #fcfcfc;border-bottom: 2px solid #0e90d2;}
    .tabsnav > .am-active a{color:#0e90d2;line-height: 40px;}
    .tabsnav > .am-active::after{ position: absolute;width: 0;height: 0;bottom: 0px;left: 50%;margin-left: -5px;border: 6px rgba(0, 0, 0, 0) solid;content: "";z-index: 1;border-bottom-color: #0e90d2;}
    [data-am-widget="tabs"] .tabsnav{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;list-style: outside none none;margin: 0;padding: 0;text-align:center;width: 100%;}
    [data-am-widget="tabs"] .tabsnav li{-webkit-box-flex:1;box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;}
    [data-am-widget="tabs"] .tabsnav a{display: block;overflow: hidden;text-overflow:ellipsis;white-space: nowrap;word-wrap:normal;}
</style>
    <div class="m-page" style="min-height: 693px;">
        <div class="full-screen">
            <div class="top-holder">
                <div class="fixed-top">
                    <div class="m-header">
                        <div class="header-left-btn">
                            <span onclick="history.back()" class="icon-back"></span>
                        </div>
                        <h2>我的订单</h2>
                        <div class="header-right-btn">
                            <a href="<?=Url::to(['user/index'])?>" class="icon-home"></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--            <div class="full-padding">-->
            <div>
                <div data-am-widget="tabs" class="am-tabs am-tabs-d2">
                    <ul class="tabsnav am-cf">
                        <li class="<?php if($getData['orderStatus'] == 1 || !isset($getData['orderStatus'])){ echo 'am-active'; }?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '1'])?>">待付款</a></li>
                        <li class="<?= $getData['orderStatus'] == 2 ? 'am-active' : ''?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '2'])?>">配送中</a></li>
                        <li class="<?= $getData['orderStatus'] == 3 ? 'am-active' : ''?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '3'])?>">已完成</a></li>
                        <li class="<?= $getData['orderStatus'] == 4 ? 'am-active' : ''?>"><a href="<?=  Url::to(['order/index','orderSearch[orderStatus]' => '4'],true)?>">退换货</a></li>
                    </ul>
                    <div class="am-tabs-bd">
                        <!--待付款-->
                        <?php Pjax::begin(['options' => ['id' => 'order_list']]); ?>
                        <div data-tab-panel-0 class="am-tab-panel am-active" id="order_list">
                            <ul class="mem-order-list">
                                <?php
                                echo ListView::widget([
                                    'dataProvider' => $dataProvider,
                                    'itemView' => '_ordersItem', //子视图
                                    'layout' => '{items}',
                                    'viewParams' => [
                                        'conditions' => $conditions,
                                    ],
                                    'emptyText' => '暂无订单',
                                ]);
                                ?>
                            </ul>
                        </div>
                        <?=
                        LinkPager::widget([
                            'pagination' => $dataProvider->getPagination(),
                            'options' => ['style' => 'margin:0 auto;text-align:center;', 'class' => 'am-pagination'],
                            'activePageCssClass' => 'am-active',
                            'internalPageCssClass' => 'am-pagination',
                            'prevPageCssClass' => 'prevOrder',
                            'nextPageCssClass' => 'nextOrder',
                            'disabledPageCssClass' => '',
                            'maxButtonCount'=>5,
                        ]);
                        ?>
                        <?php Pjax::end(); ?> 
                        <!--配送中-->
                        <!--<div data-tab-panel-1 class="am-tab-panel ">
                            <ul class="mem-order-list">
                                <li class="mem-order-item">
                                    <div class="icon orange">
                                        配送中 </div>
                                    <div class="gb">
                                        <div class="col2">
                                            <div class="col">
                                                <div>
                                                    <span class="l-k">订单号：</span>
                                                    <span class="l-v">2015070901884709</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">应付金额：</span>
                                                    <span class="price">￥3195.00</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">支付方式：</span>
                                                    <span class="l-v">
                                            支付宝 </span>
                                                </div>
                                                <div>
                                                    <span class="l-k">订单时间：</span>
                                                    <span class="l-v">
                                            2015-07-09 01:26 </span>
                                                </div>
                                            </div>
                                            <div class="col d-line">
                                                <div class="t-r">
                                                    <a href="<?=Url::to(['user/orderdetail'])?>">
								            查看订单
								            <i class="arr right"></i>
								        </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="mem-order-pt c-fix">
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-227.html" title="1--苏格兰 殿斯圆形奶油黄油饼干 160g">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </div>

                        <!--已完成-->
                        <!--<div data-tab-panel-2 class="am-tab-panel ">
                            <ul class="mem-order-list">
                                <li class="mem-order-item">
                                    <div class="icon orange">
                                        已完成 </div>
                                    <div class="gb">
                                        <div class="col2">
                                            <div class="col">
                                                <div>
                                                    <span class="l-k">订单号：</span>
                                                    <span class="l-v">2015070901884709</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">应付金额：</span>
                                                    <span class="price">￥3195.00</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">支付方式：</span>
                                                    <span class="l-v">
                                            支付宝 </span>
                                                </div>
                                                <div>
                                                    <span class="l-k">订单时间：</span>
                                                    <span class="l-v">
                                            2015-07-09 01:26 </span>
                                                </div>
                                            </div>
                                            <div class="col d-line">
                                                <div class="t-r">
                                                    <a href="<?=Url::to(['user/orderdetail'])?>">
								            查看订单
								            <i class="arr right"></i>
								        </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="mem-order-pt c-fix">
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-227.html" title="1--苏格兰 殿斯圆形奶油黄油饼干 160g">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                    </ul>
                                </li>

                                <li class="mem-order-item">
                                    <div class="icon orange">
                                        已作废
                                    </div>
                                    <div class="gb">
                                        <div class="col2">
                                            <div class="col">
                                                <div>
                                                    <span class="l-k">订单号：</span>
                                                    <span class="l-v">2015070901810669</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">应付金额：</span>
                                                    <span class="price">￥35.50</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">支付方式：</span>
                                                    <span class="l-v">
                                            支付宝 </span>
                                                </div>
                                                <div>
                                                    <span class="l-k">订单时间：</span>
                                                    <span class="l-v">
                                            2015-07-09 01:26 </span>
                                                </div>
                                            </div>
                                            <div class="col d-line">
                                                <div class="t-r">
                                                </div>
                                                <div class="t-r">
                                                    <a href="http://bbctest.ftzmall.com.cn/wap/member-orderdetail-2015070901810669.html">
								            查看订单
								            <i class="arr right"></i>
								        </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="mem-order-pt c-fix">
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-784.html" title="1--意大利 格里斯牛奶华夫饼干 175g ">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <!--退换货-->
                        <!--<div data-tab-panel-3 class="am-tab-panel ">
                            <ul class="mem-order-list">
                                <li class="mem-order-item">
                                    <div class="icon orange">
                                        退换货 </div>
                                    <div class="gb">
                                        <div class="col2">
                                            <div class="col">
                                                <div>
                                                    <span class="l-k">订单号：</span>
                                                    <span class="l-v">2015070901884709</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">应付金额：</span>
                                                    <span class="price">￥3195.00</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">支付方式：</span>
                                                    <span class="l-v">
                                            支付宝 </span>
                                                </div>
                                                <div>
                                                    <span class="l-k">订单时间：</span>
                                                    <span class="l-v">
                                            2015-07-09 01:26 </span>
                                                </div>
                                            </div>
                                            <div class="col d-line">
                                                <div class="t-r">
                                                    <a href="<?=Url::to(['user/orderdetail'])?>">
								            查看订单
								            <i class="arr right"></i>
								        </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="mem-order-pt c-fix">
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-227.html" title="1--苏格兰 殿斯圆形奶油黄油饼干 160g">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                    </ul>
                                </li>

                                <li class="mem-order-item">
                                    <div class="icon orange">
                                        退换货
                                    </div>
                                    <div class="gb">
                                        <div class="col2">
                                            <div class="col">
                                                <div>
                                                    <span class="l-k">订单号：</span>
                                                    <span class="l-v">2015070901810669</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">应付金额：</span>
                                                    <span class="price">￥35.50</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">支付方式：</span>
                                                    <span class="l-v">
                                            支付宝 </span>
                                                </div>
                                                <div>
                                                    <span class="l-k">订单时间：</span>
                                                    <span class="l-v">
                                            2015-07-09 01:26 </span>
                                                </div>
                                            </div>
                                            <div class="col d-line">
                                                <div class="t-r">
                                                </div>
                                                <div class="t-r">
                                                    <a href="http://bbctest.ftzmall.com.cn/wap/member-orderdetail-2015070901810669.html">
								            查看订单
								            <i class="arr right"></i>
								        </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="mem-order-pt c-fix">
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-784.html" title="1--意大利 格里斯牛奶华夫饼干 175g ">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>-->
                    </div>
                </div>


            </div>
        </div>
    </div>
