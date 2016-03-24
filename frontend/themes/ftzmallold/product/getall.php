<?php

use yii\widgets\ListView;
use frontend\assets\MainAsset;
use frontend\assets\WebAsset;
MainAsset::register($this);
WebAsset::register($this);
?>

<div style="">
    <ul>
<?php
                echo ListView::widget([
                    'dataProvider' => $getall,
                    'itemView' => '_proItem',//子视图
                  //  'layout' => '{items}'
                ]);
?>
        </ul>
</div>
