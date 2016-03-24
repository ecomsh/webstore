<script type="text/javascript" src="http://7xoo3k.com2.z0.glb.qiniucdn.com/pc-uh-van-jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://7xoo3k.com2.z0.glb.qiniucdn.com/pc-uh-lunbotu.js"></script>
<!-- 轮播start -->
<div class="box">
    <div class="fadeCover"></div>
    <ul class="imgList">
    	<?php $imgs = $advertisement->getItems();?>
		<?php for($i=0; $i<count($imgs); $i++): ?>
            <li style="<?php if($i==0):?>display:block;<?php endif;?> background-image:url(<?=$imgs[$i]->imageUrl?>);">
                <a href="<?=$imgs[$i]->href?>" target="_blank"></a>
            </li>
        <?php endfor;?>
    </ul>
    <ol class="btnList">
    </ol>
    <div class="leftBtn"></div>
    <div class="rightBtn"></div>
</div>
<!-- 轮播end -->