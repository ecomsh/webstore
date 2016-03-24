<?php
use yii\helpers\Url;
?>
<div class="search">
    <div class="search_wrap">
        <form action="<?= Url::to(['search/index']); ?>" class="SearchBar  searchBar_3929" method="get">
            <input type="hidden" name="r" value="search/index">
            <div class="search_three dis_bl">
                <div class="search_box fl">
                    <input type="text" placeholder="搜商品" id="J_Fsk" name="search" value="<?=Yii::$app->request->get('search')?>" maxlength="255" class="search_keyword dis_bl" tabindex="0" autocomplete="off" style="width: 210px;">
                </div>
                <div class="search_button fl">
                    <input type="submit" class="btn_search"  value="搜索">
                </div>
            </div>
        </form>
    </div>
</div>