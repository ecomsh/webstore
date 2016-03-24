<?php
$items = $advertisement->getItems();
?>
 <ul class="vacks-title">
    <?php for ($i = 0; $i < count($items); $i++): ?>
      <li class="newdeal_box">
                <span class="packs-tag">19元礼包</span>
                <!--<span class="va-mask"></span>-->
                <a class="packs-img" href="<?=$items[$i]->href?>"><img src="<?=$items[$i]->productImage?>" width="320" height="290" /></a>
                <p class="pa-title"><?=$items[$i]->title?></p>
                <div class="packs-pri">
                    <label>抢购价：￥<b><?=$items[$i]->price?></b></label>
                    <a class="fl-pri" href="<?=$items[$i]->href?>"><img src="http://img.ftzmall.com/themes/simple/images/12active/qg-tp.png" width="127" height="38" /></a>
                </div>
            </li>
    <?php endfor; ?>
</ul>