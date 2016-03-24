<?php

use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\ftzmallmobilenew\UserAsset;

UserAsset::register($this);//为了将activeForm的js代码依赖于mainasset
/* @var $this yii\web\View */
$this->title = '确认收货_上海外高桥进口商品网';
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
                            <a href="http://bbctest.ftzmall.com.cn/wap/" class="icon-home"></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 订单留言 -->
            <div class="section">
                <div class="d-line c-fix" style="height:auto">
                    <span class="l-k">订单号：</span>
                    <span class="l-v">2015070902320393</span>

                    <span class="l-k">总金额：</span>
                    <span class="l-v">￥0.00</span>

                    <span class="l-k">订单状态：</span>
                    <span class="l-v">已完成</span>

                    <span class="l-k">下单日期：</span>
                    <span class="l-v">2015-07-09 02:39:39</span>
                </div>
            </div>
            <div class="section">
                <div class="d-line c-fix" style="height:auto">
                    <span class="l-k">收货地址：</span>
                    <span class="l-v">北京市海淀区上地中关村软件园,100194,breakfast,13810001000</span>
                </div>
            </div>
            <div class="section">
                <div class="d-line c-fix">
                    <span class="l-k">配送方式：</span>
                    <span class="l-v">
                        <div class="col2">
                             <div class="col">2</div>
                             <div class="col t-r">运费<span class="f-red">￥0.00</span>元</div>
                        </div>
                    </span>
                </div>
                <div class="d-line c-fix">
                    <span class="l-k">支付方式：</span>
                    <span class="l-v">支付宝</span>
                </div>
            </div>

    <div class="section">
        <div class="d-line">
            <span class="k">商品清单：</span>
        </div>
        <div class="pre ob">
            <div class="d-line c-fix" id="J_sel_pre">
                优惠：
                <span class="pre-list">
                        </span>
                <i class="arr down"></i>
            </div>
            <div class="pre-info hide" id="J_pre_info">
            </div>
        </div>

        <!-- 商品 -->
        <ul class="pt-list">
            <li class="pt-h-item c-fix">
                <a href="http://bbctest.ftzmall.com.cn/wap/product-1223.html" class="pt-h-link">
                    <div class="pt-h-img"><img src="<?= yii::$app->params['localimgUrl']?>8507269ad271ee7c96792d0ed189b8029d3.jpg">
                    </div>
                    <div class="pt-h-info">
                        <div class="pt-h-name">方便面</div>
                        <div class="pt-h-other"></div>
                        <div class="col2">
                            <div class="col price">
                                ￥0.00 </div>
                            <div class="col t-r">
                                数量：1 </div>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="section">
        <div>
            <span class="l-k">订单留言：</span>
            <div class="l-v" style="margin-left:2rem;color:#575252;font-size:0.9rem;">
                无
            </div>
        </div>
    </div>
    <div class="section">
        <div class="d-line">
            <span class="k">
                商品金额：
            </span>
            <span class="v">
                <div class="price">
                    ￥0.00                </div>
            </span>
        </div>
        <div class="d-line">
            <span class="k">
                运费：
            </span>
            <span class="v">
                <div class="price">
                    ￥0.00                </div>
            </span>
        </div>
        <div class="d-line">
            <span class="k">
                优惠金额：
            </span>
            <span class="v">
                <div class="price">
                    -￥0.00                </div>
            </span>
        </div>
        <div class="d-line total">
            <span class="k">
                总金额：
            </span>
            <span class="v">
                <div class="price">
                    ￥0.00                </div>
            </span>
        </div>
        <div class="d-line">
            <form action="http://bbctest.ftzmall.com.cn/wap/member-gofinish.html" method="post">
                <input type="hidden" name="order_id" value="2015070902320393">
                <button class="btn" type="submit">确认收货</button>
            </form>
        </div>
    </div>
    </div>
    <script>
        (function() {
            $('#J_sel_pre').bind('click', function(e) {
                $('#J_pre_info').toggleClass('hide');
                $(this).find('.pre-list').toggleClass('hide');
            });
        })();
    </script>
    </div>