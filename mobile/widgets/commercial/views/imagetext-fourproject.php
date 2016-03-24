<!-- 页面中部非固定区域特卖专场2等分50%图片panel区域start-->
<div class="gray-bg-box2">
    <div class="mig-fourpic2">
        <?php $items = $advertisement->getItems();var_dump($items); die;?>
        <?php for($i=0; $i<count($items); $i++): ?>
    	<div class="ui-grid-four-img2 four-mig2">
            <span style="background-image:url(<?=$items[$i]->imageUrl?>);"></span>
        </div>
        <?php endfor;?>
    </div>
</div>
<!-- 页面中部非固定区域特卖专场2等分50%图片panel区域end--> 
