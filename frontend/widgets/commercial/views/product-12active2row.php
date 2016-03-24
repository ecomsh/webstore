<?php
$items = $advertisement->getItems();

?>
<ul class="makeups-title">
                
    <?php for ($i = 0; $i < count($items); $i++): ?>
    <li class="newdeal_box">
                   <span class="make-lj">立减<b>￥<?=$items[$i]->listPrice-$items[$i]->price?></b></span>
                   <a href="<?=$items[$i]->href?>" class="make-img"><img width="490" height="490" src="<?=$items[$i]->productImage?>"></a>
                   <p class="make-gg"><?=$items[$i]->title?></p>
                   <div class="make-price">
                       <div class="ref-price">
                           <label>国内参考价¥<b class="h"><?=$items[$i]->listPrice?></b></label>
                           <label>已省<em>￥<?=$items[$i]->listPrice-$items[$i]->price?></em></label>
                       </div>
                       <div class="ear-money"><label>抢购价¥<b><?=$items[$i]->price?></b></label></div>
                       <a href="<?=$items[$i]->href?>" class="fl-pri1 by-p"><img width="127" height="38" src="http://img.ftzmall.com/themes/simple/images/12active/qg-tp.png"></a>
                   </div>
                </li>
    <?php endfor; ?>
</ul>
