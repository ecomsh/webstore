<?php

use yii\helpers\Url;
?>
<ul>

    <?php foreach ($qr as $k => $v): ?>
        <img src="<?= Url::to(['test/qrcode', 'url'=>$v['url'],'size' => $v['size']]) ?>" /><br>

        <?php endforeach; ?>
</ul>