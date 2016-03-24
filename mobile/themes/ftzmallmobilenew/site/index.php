<!-- 页面中部非固定区域1-幻灯片切换区域start-->
<section class="ui-container" style="margin-bottom: auto;margin-top: auto;">
<? /* 
    <div class="demo-item">
        <div class="demo-block">
            <ul class="ui-tab-content" style="width:100%">
                <li>
                     <?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ImagetextAdvertisement', "adId" => 180101, 'tpl' => 'focusfigure']) ?>
                </li>
            </ul>
        </div>
    </div>
*/ ?>
</section>
<!-- 页面中部非固定区域1-幻灯片切换区域end-->

<!-- 页面中部非固定区域2-商品图片panel区域start-->
<section class="ui-panel border-bottom56"> 

<?php /*
    <!-- 页面中部-灰色细边4等分宣传无链接图片panel区域start-->
    <div class="gray-bg-box hg-86">
        <div class="mig-fourpic">
            <div class="ui-grid-four-img four-mig1"> <span style="background-image:url(../img/images/mig-1.png);"></span> </div>
            <div class="ui-grid-four-img four-mig1"> <span style="background-image:url(../img/images/mig-2.png);"></span> </div>
            <div class="ui-grid-four-img four-mig1"> <span style="background-image:url(../img/images/mig-3.png);"></span> </div>
            <div class="ui-grid-four-img four-mig1"> <span style="background-image:url(../img/images/mig-4.png);"></span> </div>
        </div>
    </div>
    <!-- 页面中部-灰色细边4等分宣传无链接图片panel区域end--> 
*/ ?>

    <?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 180102, 'tpl' => 'newpro']) ?>
    
    <?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 180104, 'tpl' => 'mustbuy']) ?>
    
    <?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 180105, 'tpl' => 'globalpro']) ?>

<?php /*
    <!-- 页面中部非固定区域2等分纯商品图片panel区域start-->
    <ul class="ui-grid-halve">
        <li>
            <div class="ui-border-t1">
                <div class="ui-grid-halve-img"> <span style="background-image:url(../img/images/0-1-2.png)"></span> </div>
            </div>
        </li>
        <li>
            <div class="ui-border-t1">
                <div class="ui-grid-halve-img"> <span style="background-image:url(../img/images/0-1-2.png)"></span> </div>
            </div>
        </li>
        <li>
            <div class="ui-border-t1">
                <div class="ui-grid-halve-img"> <span style="background-image:url(../img/images/0-1-2.png)"></span> </div>
            </div>
        </li>
        <li>
            <div class="ui-border-t1">
                <div class="ui-grid-halve-img"> <span style="background-image:url(../img/images/0-1-2.png)"></span> </div>
            </div>
        </li>
        <li>
            <div class="ui-border-t1">
                <div class="ui-grid-halve-img"> <span style="background-image:url(../img/images/0-1-2.png)"></span> </div>
            </div>
        </li>
        <li>
            <div class="ui-border-t1">
                <div class="ui-grid-halve-img"> <span style="background-image:url(../img/images/0-1-2.png)"></span> </div>
            </div>
        </li>
    </ul>
    <!-- 页面中部非固定区域2等分新品推荐-纯商品图片panel区域end-->
*/ ?>

</section>
<!-- 页面中部非固定区域2-商品图片panel区域end-->

<script>
    $('.ui-header .ui-btn').click(function(){
        location.href= 'index.html';
    });
</script>
<script class="demo-script">
<? /* 
(function (){
        var slider = new fz.Scroll('.ui-slider', {
            role: 'slider',
            indicator: true,
            autoplay: true,
            interval: 3000
        });
    })();
*/ ?>
    
</script> 