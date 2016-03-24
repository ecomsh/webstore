<script src="http://7xoo3k.com2.z0.glb.qiniucdn.com/m-shouye-TouchSlide.1.1.js"></script>
<div id="focus" class="focus">
    <div class="hd">
        <ul></ul>
    </div>
    <div class="bd">
        <ul>
        	<?php $imgs = $advertisement->getItems(); ?>
            <?php for($i=0; $i<count($imgs); $i++): ?>
                <li><a href="<?=$imgs[$i]->href?>"><img src="<?=$imgs[$i]->imageUrl?>"/></a></li>
            <?php endfor;?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    TouchSlide({ 
        slideCell:"#focus",
        titCell:".hd ul", 
        mainCell:".bd ul", 
        effect:"leftLoop", 
        autoPlay:true,
        autoPage:true 
    });
</script>