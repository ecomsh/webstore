<img class="meiri_by" src="http://7xoo3k.com2.z0.glb.qiniucdn.com/m-shouye-meiri_by.jpg">
<?php $items = $advertisement->getItems();?>
<?php for($i=0; $i<count($items); $i++): ?>
<a class="goods_pd" href="<?=$items[$i]->href?>">
    <img src="<?=$items[$i]->productImage?>"  width="415" height="230">
    <div class="goods_text">
        <p class="f_text"><?=$items[$i]->title?></p>
        <p class="goods_text_p">
            <span>【官方授权】</span>
            <?=$items[$i]->description?>
        </p>
		<p class="jiage">
			<span class="goods_price"><span>￥</span><?=$items[$i]->price?></span>
		</p>
        <p class="yuanjia" >国内参考价:￥<?=$items[$i]->listPrice?></p>
        <button class="goods_see">去看看</button>
    </div>
</a>
<?php endfor;?>