
<!-- 页面中部每日必BUY区域-纯商品图片panel区域start-->
<h2 style="margin: 15px -5px 3px 0 !important;">
    <div class="black-rounder">
        <i class="icon-g-buy2 i-size1"></i>&nbsp;&nbsp;每日必BUY
    </div>
    <i class="icon-ellipsis-horizontal i-size12b"></i>
    <i class="icon-ellipsis-horizontal i-size12b"></i>
    <i class="icon-level-down i-size20b"></i>
</h2>

<ul class="ui-col-dp">

    <?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标red--panel start-->
    <li class="margin-bot10">
        <a href="<?=$items[$i]->href?>">
            <div class="ui-border">
                <div class="ui-grid-img">
                    <div class="ui-halve-title-1-2"> <i class="icon-shopping-cart i-size2"></i> </div>
                    <div class="ui-halve-title-2">
                        <div class="row-3"><?=$items[$i]->title?></div>
                        <div class="row-1">
                            <div class="price-highlight"> <i>¥</i><?=$items[$i]->price?></div>
                            <em class="price-h">国内参考价 ¥<?=$items[$i]->listPrice?></em></div>
                    </div>
                    <span style="background-image:url(<?=$items[$i]->productImage?>)"></span> </div>
            </div>
        </a>
    </li>
    <!-- 页面中部非固定区域新品推荐-商品图片加文字图标组合-横栏整体商品图上带文字及购物车图标red--panel end-->
    <?php endfor;?>
</ul>

<?php /* 
<!-- 栏目间隔灰条-->
<div class="gray-b15"></div>

<div class="ui-panel gray-tb">
    <div class="gray-line-s"></div>
    
    <h2 style="margin: 0 -5px 15px 0 !important;">
        <div class="black-rounder"><i class="icon-g-time i-size1"></i>&nbsp;&nbsp;今日 22:00 即将开抢</div>
    </h2>
    <div class="ui-col-95 hg-160">
        <span style="background-image:url(../img/images/sl-0002_02.png)"></span>
    </div>

    <h2 style="margin: 15px -5px 15px 0 !important;">
        <div class="black-rounder"><i class="icon-g-time i-size1"></i>&nbsp;&nbsp;明日 10:00 即将开抢</div>
    </h2>
    <div class="ui-col-95 hg-160">
        <span style="background-image:url(../img/images/sl-0002_03.png)"></span>
    </div>
</div>
*/?>
<!-- 页面中部每日必BUY区域-纯商品图片panel区域end-->
