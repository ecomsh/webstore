<h1>hello test test!</h1>
<p>title : <?= $advertisement->title?> </p>

<p>id : <?= $advertisement->id?> </p>



<p>


    <?php foreach($advertisement->getItems() as $item): ?>

        <p><?=$item->price?>====<?=$item->name?></p>

    <?php endforeach;?>

</p>