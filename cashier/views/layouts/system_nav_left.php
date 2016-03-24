<?php

use yii\helpers\Url;
use yii\widgets\Menu;

?>
<div class="left">
    <?php
        echo Menu::widget(Yii::$app->params['system_navmenu']);
    ?>   
</div>


