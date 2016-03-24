<?php
$items = $advertisement->getItems();
?>
    
<ul class="today_new_ul">
    <?php for ($i = 0; $i < count($items); $i++): ?>
     <li class="newdeal_box">
                <span class="full-cut">满199减100</span>
                <!--<span class="mask"></span>-->
                <a class="fold-img" href="<?=$items[$i]->href?>"><img src="<?=$items[$i]->productImage?>" width="240" height="240" /></a>
                <div class="food-pri">
                    <p>
                        <label><?=$items[$i]->title?></label>
                        <i>狂欢价：￥<b><?=$items[$i]->price?></b></i>
                    </p>
                    <a class="join-c" href="<?=$items[$i]->href?>"><img src="http://img.ftzmall.com/themes/simple/images/12active/join-cart.png" width="79" height="54" /></a>
                </div>
            </li>
    <?php endfor; ?>
</ul> 