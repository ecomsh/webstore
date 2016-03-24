<?php use yii\helpers\Url; ?>

<!-- 每日必买广告位 -->
<p class="mustbuy-title" id="mustbuy">每日必Buy　|　<span class="eng">MUST CHECK OUT</span></p>
<ul class="clearfix">
    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <li class="buy-product" id="buy-product-<?=$i?>">
        <div class="buypro-left pull-left">
        <a href="<?=$items[$i]->href?>">
            <img src="<?=Url::base().'/themes/ftzmallnew/src/images/baoshui.png'?>" class="baoshui-btn">
            <img src="<?=$items[$i]->productImage?>" class="buypro-img">
        </a>      
        </div>
        <div class="buypro-right pull-left">
            <span class="end-time" id="buy-product-cd-<?=$i?>">距特卖结束</span>
            <!-- 每日必bug商品名称点击后链接到广告内容指定的链接 -->
            <a href="<?=$items[$i]->href?>" class="buypro-name"><?=$items[$i]->title?></a>
            <p class="buypro-text"><span class="font-color1">官方授权 </span> <?=$items[$i]->description?></p>
            <span class="buypro-price">￥<?=$items[$i]->price?></span>
            <span class="buypro-chinaprice">
                 <?php /*原价<span class="price-line">￥<?=$items[$i]->offerPrice?></span>*/ ?>
                国内参考价<span>￥<?=$items[$i]->listPrice?></span>
            </span>
            <?php /* <span class="baoyou-btn">包邮</span> */ ?>限时限量抢购
            <a href="<?=$items[$i]->href?>" class="go" target="_blank">去看看</a>
        </div>
    </li>
    <?php endfor;?>
</ul>
<script>
    function CountDown(li,dom,endTime){
        this.endTime = new Date(endTime);
        this.dom = dom;
        this.li = li;
        this.interval;

        this.init(this);
    }
    CountDown.prototype.getRtime = function(){
        var nowTime = new Date();
        var t = this.endTime.getTime() - nowTime.getTime();

        return t >= 0 ? {
            d: Math.floor(t/1000/60/60/24),
            h: Math.floor(t/1000/60/60%24),
            m: Math.floor(t/1000/60%60),
            s: Math.floor(t/1000%60)
        } : false;
    }

    CountDown.prototype.tick = function(){   
        var time = this.getRtime();
        if(!time){
            clearInterval(this.interval);
            this.li.parentNode.removeChild(this.li);
        }else{
            this.dom.innerHTML = '距特卖结束 '+time.d+'天 '+time.h+'时'+time.m+'分'+time.s+'秒';
        }
    }

    CountDown.prototype.init = function(){
        var this_= this;
        this_.interval = setInterval(function(){this_.tick();}, 1000);
        this_.tick();
        
    }

    <?php for($i=0; $i<count($items); $i++): ?>
    new CountDown( 
        document.getElementById("buy-product-<?=$i?>"),
        document.getElementById("buy-product-cd-<?=$i?>"),
        <?=strtotime($items[$i]->endTime)?>000);
    <?php endfor;?>
</script>
<style type="text/css">
    .buy-product:hover{box-shadow: 0px 2px 17px rgba(0,0,0,.3)}
</style>
<!-- 每日必买广告位 end -->