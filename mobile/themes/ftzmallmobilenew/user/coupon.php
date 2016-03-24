<?php

use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\ftzmallmobilenew\UserAsset;
use mobile\assets\ftzmallmobilenew\CouponAsset;
UserAsset::register($this);
CouponAsset::register($this);
$this->title = '用户中心-优惠券';
?>
<section class="ui-container">
    <div class="addcoupon-topbar">
        <a id="addcoupon-show">激活优惠券</a>
    </div>
    <div class="ui-dialog">
        <div class="ui-dialog-cnt">
            <header class="ui-dialog-hd">
                <h3>激活优惠券</h3>               
            </header>
            <form>
                <div class="ui-dialog-bd">                
                    <input type="text" placeholder="请输入优惠券">
                </div>
                <div class="ui-dialog-ft">
                    <button type="button" data-role="button" id="addcoupon-hidden">取消</button>
                    <button type="button" data-role="button">立即激活</button>
                </div>
            </form>
        </div>        
    </div>
</section>

<section class="tab">
    <ul class="ui-tab-nav"><!--由于考虑到应该是用LinkPager,所以不写tab切换了，有问题请联系caoqi-->
        <li class="current"><a href="#">可使用</a></li>
        <li><a href="#">已使用</a></li>
        <li><a href="#">已过期</a></li>
    </ul>

    <ul class="coupon-fullbox">
        
        <?php
        for ($i=0; $i<10; $i++) {          
        ?>
        <li class="coupon-bigbox">
            <div class="coupon-leftbox2"><!--灰色背景请把coupon-leftbox换成coupon-leftbox2-->
                <span class="ab1">￥</span>
                <span class="ab2">30</span>
                <?php if($i%2==0):?><!-- 自己判断是否金额>99,如果大于用第一个样式，else用第二种样式，我只考虑了2位数跟3位数，不考虑个位数或者4位数以及小数，有问题让他们改设计稿 -->
                <span class="ab3">满<span>399</span>元</span>  
                <span class="ab4">使&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;用</span>
                <?php else:?>
                <span class="ab3">满<span>39</span>元</span>  
                <span class="ab4">使&nbsp;&nbsp;&nbsp;&nbsp;用</span>
                <?php endif;?>
            </div>
            <div class="coupon-rightbox">
                <p><a>感恩有你|20元优惠券</a></p>
                <p><span class="font-red">剩余3天过期</span></p>
            </div>
            <a class="arrow-down" id="show<?php echo $i;?>"></a>          
        </li>

        <div class="coupon-bottombox" id="show-box<?php echo $i;?>">
            <p>有效期：2015.11.26-2015.12.03</p>
            <p>适用范围: 全场商品通用</p>
        </div>  
        <?php 
         }
        ?>
       
    </ul>
</section>

