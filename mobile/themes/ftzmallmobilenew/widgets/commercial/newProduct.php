<!-- 页面中部非固定区域新品推荐-纯商品图片panel区域start-->
<h2 style="margin-left: -5px !important;">
    <i class="icon-g-day i-size24"></i>&nbsp;&nbsp;新品推荐&nbsp;&nbsp;<i class="i-size10">New Product</i>
</h2>

<?php /*
<div class="ui-col-95 hg-160">
    <span style="background-image:url(../img/images/g-1.png)"></span>
</div>
*/?>

<!-- 页面中部非固定区域新品推荐-纯商品图片panel区域end-->

<!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合panel区域start-->
<ul class="ui-col-dp">

    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标red--panel start-->
    <li class="margin-bot10">
        <div class="ui-border">
            <div class="ui-grid-img">
                <div class="ui-rec-tag top-0"> TOP </div>
                <div class="ui-halve-title-1-2"> <i class="icon-shopping-cart i-size2"></i> </div>
                <div class="ui-halve-title-2">
                    <div class="row-3"><?=$items[$i]->title?></div>
                    <div class="row-1">
                        <div class="price-highlight"> <i>¥</i><?=$items[$i]->price?></div>
                        <em class="price-h">原价 <?=$items[$i]->originPrice?></em></div>
                </div>
                <span style="background-image:url(<?=$items[$i]->productImage?>)"></span> </div>
        </div>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标red--panel end-->
    <?php endfor;?>


<?php /*
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标red--panel start-->
    <li class="margin-bot10">
        <div class="ui-border">
            <div class="ui-grid-img">
                <div class="ui-rec-tag top-0"> TOP </div>
                <div class="ui-halve-title-1-2"> <i class="icon-shopping-cart i-size2"></i> </div>
                <div class="ui-halve-title-2">
                    <div class="row-3">MeadJohnson 美赞臣 金樽婴儿配方奶粉 2段 1080克 9-18个月</div>
                    <div class="row-1">
                        <div class="price-highlight"> <i>¥</i>39.90 </div>
                        <em class="price-h">大陆参考价 99.00</em></div>
                </div>
                <span style="background-image:url(../img/images/g-1.png)"></span> </div>
        </div>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标red--panel end-->
*/?>

<?php /* 
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及已抢完图标--panel start-->
    <li class="margin-bot10">
        <div class="ui-border">
            <div class="ui-grid-img">
                <div class="ui-rec-tag top-0"> TOP </div>
                <div class="ui-halve-title-1-2"> <i class="icon-shopping-cart i-size2"></i> </div>
                <div class="ui-halve-title-2">
                    <div class="row-3">MeadJohnson 美赞臣 金樽婴儿配方奶粉 2段 1080克 9-18个月</div>
                    <div class="row-1">
                        <div class="price-highlight"> <i>¥</i>39.90 </div>
                        <em class="price-h">大陆参考价 99.00</em></div>
                </div>
                <span style="background-image:url(../img/images/g-1.png)"></span> </div>
        </div>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标red--panel end-->
*/?>

<?php /* 
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及已抢完图标--panel start-->
    <li class="margin-bot10">
        <div class="ui-border">
            <div class="ui-grid-img">
                <div class="ui-rec-tag top-0"> TOP </div>
                <div class="ui-halve-title-1-3 ui-i-padding">已抢光</div>
                <div class="ui-halve-title-2">
                    <div class="row-3">MeadJohnson 美赞臣 金樽婴儿配方奶粉 2段 1080克 9-18个月</div>
                    <div class="row-1">
                        <div class="price-highlight"> <i>¥</i>39.90 </div>
                        <em class="price-h">大陆参考价 99.00</em></div>
                </div>
                <span style="background-image:url(../img/images/g-1.png)"></span> </div>
        </div>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及已抢完图标--panel--panel end-->
*/?>

<?php /*
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标green--panel start-->
    <li class="margin-bot10">
        <div class="ui-border-1">
            <div class="ui-grid-img">
                <div class="ui-rec-tag top-3"> New </div>
                <div class="ui-halve-title-1"> <i class="icon-shopping-cart i-size2"></i> </div>
                <div class="ui-halve-title-3">
                    <div class="row-title-2"><span style="background-image:url(../img/gm.png)"></span>
                        <div class="row-title-2-s">德国直供 上海发货</div>
                    </div>
                    <span class="row2-title-2">美国顶级防晒品牌 水宝宝水嫩防晒乳SPF30+</span>
                    <div class="row-2">
                        <div class="price-highlight"> <i>¥</i>39.90 </div>
                        <em class="price-h">大陆参考价 99.00</em></div>
                </div>
                <span style="width: 50%; background-image:url(../img/images/g-2.png)"></span> </div>
        </div>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标green--panel end-->
*/?>

<?php /*
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及文字圆形图标red--panel strat-->
    <li class="margin-bot10">
        <div class="ui-border">
            <div class="ui-grid-img">
                <div class="ui-rec-tag top-0"> TOP </div>
                <div class="ui-halve-title-1-2"> 马上<br />抢购 </div>
                <div class="ui-halve-title-2">
                    <div class="row-3">MeadJohnson 美赞臣 金樽婴儿配方奶粉 2段 1080克 9-18个月</div>
                    <div class="row-1">
                        <div class="price-highlight"> <i>¥</i>39.90 </div>
                        <em class="price-h">大陆参考价 99.00</em></div>
                </div>
                <span style="background-image:url(../img/images/g-1.png)"></span> </div>
        </div>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及文字圆形图标red--panel end-->
*/?>

<?php /*
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及文字圆形图标green--panel strat-->
    <li class="margin-bot10">
        <div class="ui-border-1">
            <div class="ui-grid-img">
                <div class="ui-rec-tag top-3"> New </div>
                <div class="ui-halve-title-1"> 马上<br />抢购 </div>
                <div class="ui-halve-title-3">
                    <div class="row-title-2"><span style="background-image:url(../img/gm.png)"></span>
                        <div class="row-title-2-s">德国直供 上海发货</div>
                    </div>
                    <span class="row2-title-2">美国顶级防晒品牌 水宝宝水嫩防晒乳SPF30+</span>
                    <div class="row-2">
                        <div class="price-highlight"> <i>¥</i>39.90 </div>
                        <em class="price-h">大陆参考价 99.00</em></div>
                </div>
                <span style="width: 50%; background-image:url(../img/images/g-2.png)"></span> </div>
        </div>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及文字圆形图标green--panel end-->
*/?>

<?php /*
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及文字圆形图标已抢光--panel strat-->
    <li class="margin-bot10">
        <div class="ui-border-1">
            <div class="ui-grid-img">
                <div class="ui-rec-tag top-3"> New </div>
                <div class="ui-halve-title-1-3 ui-i-padding">已抢光</div>
                <div class="ui-halve-title-3">
                    <div class="row-title-2"><span style="background-image:url(../img/gm.png)"></span>
                        <div class="row-title-2-s">德国直供 上海发货</div>
                    </div>
                    <span class="row2-title-2">美国顶级防晒品牌 水宝宝水嫩防晒乳SPF30+</span>
                    <div class="row-2">
                        <div class="price-highlight"> <i>¥</i>39.90 </div>
                        <em class="price-h">大陆参考价 99.00</em></div>
                </div>
                <span style="width: 50%; background-image:url(../img/images/g-2.png)"></span> </div>
        </div>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及文字圆形图标已抢光--panel end-->
*/?>
</ul>
<!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合panel区域end-->
