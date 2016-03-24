<div class="mjinpin">
	<?php $items = $advertisement->getItems(); ?>
    <?php for($i=0; $i<count($items); $i++): ?>
    <a href="<?=$items[$i]->href?>" target="_blank">
        <img src="<?=$items[$i]->imageUrl?>">
    </a>
    <?php endfor;?>
</div>