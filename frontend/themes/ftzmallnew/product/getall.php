<?php

use yii\widgets\ListView;
use frontend\assets\ftzmallnew\MainAsset;

MainAsset::register($this);

?>

<div class="container">
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
