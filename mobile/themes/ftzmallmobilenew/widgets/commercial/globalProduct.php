<!-- 页面中部全球精选区域-纯商品图片panel区域start-->
<h2 style="margin: 15px -5px 15px 0 !important;">
    <i class="icon-g-global i-size24"></i>&nbsp;&nbsp;全球精选&nbsp;&nbsp;<i class="i-size10">Global Select</i>
</h2>

<?php $items = $advertisement->getItems(); ?>
<?php for($i=0; $i<count($items); $i++): ?>
<div class="ui-col-95 hg-160">
    <span style="background-image:url(<?=$items[$i]->productImage?>)"></span>
</div>
<?php endfor;?>

<!-- 页面中部全球精选区域-纯商品图片panel区域end--> 
