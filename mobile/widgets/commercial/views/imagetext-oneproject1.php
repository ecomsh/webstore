<?php $items = $advertisement->getItems();?>
<?php for($i=0; $i<count($items); $i++): ?>
<a href="<?=$items[$i]->href?>">
	<img class="one_ban" src="<?=$items[$i]->imageUrl?>">
</a>
<?php endfor;?>