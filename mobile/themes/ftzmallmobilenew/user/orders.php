<?php

use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\ftzmallmobilenew\UserAsset;

UserAsset::register($this);//为了将activeForm的js代码依赖于mainasset
/* @var $this yii\web\View */
$this->title = '会员中心_上海外高桥进口商品网';
?>

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
                    <ul class="am-tabs-nav am-cf">
                        <li class="am-active"><a href="[data-tab-panel-0]">待付款</a></li>
                        <li class=""><a href="[data-tab-panel-1]">配送中</a></li>
                        <li class=""><a href="[data-tab-panel-2]">已完成</a></li>
                        <li class=""><a href="[data-tab-panel-3]">退换货</a></li>
                    </ul>
                    <div class="am-tabs-bd">
                        <!--待付款-->
                        <div data-tab-panel-0 class="am-tab-panel am-active">
                            <ul class="mem-order-list">
                                <li class="mem-order-item">
                                    <div class="icon orange">
                                        待支付
                                    </div>
                                    <div class="gb">
                                        <div class="col2">
                                            <div class="col">
                                                <div>
                                                    <span class="l-k">订单号：</span>
                                                    <span class="l-v">2015070902320393</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">应付金额：</span>
                                                    <span class="price">￥0.00</span>
                                                </div>
                                                <div>
                                                    <span class="l-k">支付方式：</span>
                                                    <span class="l-v">
                                            支付宝 </span>
                                                </div>
                                                <div>
                                                    <span class="l-k">订单时间：</span>
                                                    <span class="l-v">
                                            2015-07-09 02:39 </span>
                                                </div>
                                            </div>


                                            <div class="col d-line">
                                                <div class="t-r">
                                                </div>
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
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-1223.html" title="1--方便面">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-1223.html" title="1--方便面">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-1223.html" title="1--方便面">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-1223.html" title="1--方便面">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                        <li class="mem-pt-item">
                                            <a href="http://bbctest.ftzmall.com.cn/wap/product-1223.html" title="1--方便面">
                                    <img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                                </a>
                                            <i class="num">1</i>
                                        </li>
                                    </ul>
                                    <div class="section pay-section">
                                        <div class="pay-list" id="J_pay_list">
                                            <!--<select type="select">-->
                                            <select data-am-selected="{btnWidth:'70%',maxHeight:'60',btnSize:'sm'}">
                                                <option value="a" selected>请选择支付方式</option>
                                                <option value="b">微信</option>
                                                <option value="a">支付宝</option>
                                                <option value="c">财付通</option>
                                                <option value="d">银行卡</option>
                                            </select>
                                            <div class="d-line c-fix clearfix">
                                                已选支付方式：<span style="color:#b60009;">&nbsp<span>支付宝</span></span>
                                                <span style="float:right;"><button style="height: 40px;line-height: 40px;margin: 0 auto;border-radius: 4px;background: #b0020b;border: none;font-size: 1.3rem;color:#fff;width:6rem;">去支付</button></span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!--配送中-->
                        <div data-tab-panel-1 class="am-tab-panel ">
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
                        <div data-tab-panel-2 class="am-tab-panel ">
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
                        <div data-tab-panel-3 class="am-tab-panel ">
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
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
