<?php use common\helpers\Tools; ?>

<!-- 专场广告位 -->
<div class="zhuanabc">
	<?php $items=$advertisement->getItems();?>
	<?php for($i=0;$i<count($items);$i++):?>
    <a href="<?=$items[$i]->href?>" target="_blank"><img src="<?=Tools::qnImg($items[$i]->imageUrl, 536, 214)?>"></a>
	<?php endfor;?>
</div>
<!-- 专场广告位 end -->