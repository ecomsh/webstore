<!-- 页面中部全球精选区域-纯商品图片panel区域start-->
<h2 style="margin: 15px -5px 15px 0 !important;">
    <i class="icon-g-global i-size24"></i>&nbsp;&nbsp;全球精选&nbsp;&nbsp;<i class="i-size10">Global Select</i>
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

<!-- 页面中部全球精选区域-纯商品图片panel区域end--> 
