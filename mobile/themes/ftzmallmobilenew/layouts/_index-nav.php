<?php

use yii\helpers\Url;
use yii\helpers\Html;
use mobile\widgets\MenuNew;
use common\helpers\Tools;
?>
<header class="ui-header ui-h90 ui-header-positive ui-border-b">
    <div class="logo-head"><i class="float-left" onclick=""></i><i class="float-right" onclick=""></i></div>
    <div class="ui-tab-sc">
        <!--   icon-g-2wm  icon-g-find2    <ul class="ui-tab-nav ui-border-b fontclass-tab" style="width:120%">
                    <li class="current">首页</li>
                    <li>美妆个护</li>
                    <li>母婴益智</li>
                    <li>食品保健</li>
                    <li>国际轻奢</li>
                    <li>特卖专区</li>
                </ul>-->
    <?php echo MenuNew::widget(Tools::getNavMenu(2)); ?>
    </div>
</header> 