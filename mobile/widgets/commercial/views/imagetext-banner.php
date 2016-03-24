<!-- 页面中部非固定区域特卖专场2等分50%图片panel区域start-->

<?php $items = $advertisement->getItems(); ?>
<?php for ($i = 0; $i < count($items); $i++): ?>
    <a href="<?= $items[$i]->href ?>"><img src="<?= $items[$i]->imageUrl ?>" width="100%"/></a>
<?php endfor; ?>

<!-- 页面中部非固定区域特卖专场2等分50%图片panel区域end--> 
