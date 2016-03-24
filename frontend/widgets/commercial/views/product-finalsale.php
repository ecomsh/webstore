<!-- 最后疯抢广告位 -->
<p class="finalsale-title" id="final-sale">最后疯抢　|　<span class="eng">ON FINAL SALE</span></p>
<ul class="row clearfix">
    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <li class="final-product pull-left">
        <a href="<?=$items[$i]->href?>" target="_blank">
            <img src="<?=$items[$i]->productImage?>" class="finalpro-img">
            <p class="final-end" id="finalsale-countdown-<?=$i?>" >最后：08小时18分18秒</p>
            <p class="final-text pull-left"><?=$items[$i]->title?></p>
            <span class="final-price pull-right">￥<?=$items[$i]->price?></span>
        </a>
    </li>
    <?php endfor;?>
</ul>

<script>
    function fs_CountDown(dom,endTime){
        this.endTime = new Date(endTime);
        this.dom = dom;
        this.interval;

        this.init(this);
    }
    fs_CountDown.prototype.getRtime = function(){
        var nowTime = new Date();
        var t =this.endTime.getTime() - nowTime.getTime();
        return{
            d: Math.floor(t/1000/60/60/24),
            h: Math.floor(t/1000/60/60%24),
            m: Math.floor(t/1000/60%60),
            s: Math.floor(t/1000%60)
        }
    }

    fs_CountDown.prototype.tick = function(){   
        var time = this.getRtime();
        this.dom.innerHTML = '最后： '+time.d+':'+time.h+':'+time.m+':'+time.s;
    }

    fs_CountDown.prototype.init = function(){
        var this_= this;
        this_.tick();
        this.interval = setInterval(function(){this_.tick();}, 1000);
    }

    <?php for($i=0; $i<count($items); $i++): ?>
    new fs_CountDown( document.getElementById("finalsale-countdown-<?=$i?>"),'<?=$items[$i]->endTime?>');
    <?php endfor;?>
</script>

<!-- 最后疯抢广告位 end -->