<?php
$items = $advertisement->getItems();
?>

<ul>
    <?php for ($i = 0; $i < count($items); $i++): ?>

        <li class="<?= ($i % 2) ? 'right' : 'left'; ?>">
            <div class="label"><span class="title"><?= $items[$i]->title ?></span><span class="price">￥<?= $items[$i]->price ?></span></div>
            <a href="<?= $items[$i]->href ?>"><img width="200" height="200" src="<?= $items[$i]->productImage ?>"></a></li>

    <?php endfor; ?>
</ul> 