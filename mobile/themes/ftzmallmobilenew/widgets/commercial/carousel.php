<!-- 轮播start -->
<div class="ui-slider ui-pt31 top45">
    <ul class="ui-slider-content" style="width: 100%">
    	<?php $imgs = $advertisement->getItems(); ?>
        <?php for($i=0; $i<count($imgs); $i++): ?>
            <li><span style="background-image:url(<?=$imgs[$i]->imageUrl?>); height:<?= $advertisement->height?>px !important;"></span></li>
        <?php endfor;?>
    </ul>
</div>
<!-- 轮播end -->