<?php

use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\CartAsset;
CartAsset::register($this);
$this->title = '购物车_上海外高桥进口商品网';
?>
    <!--    这是购物车里有货时的页面-->
    <?= Html::beginForm(['cart/checkout'], 'post', ['id' =>"form-cart",'enctype' => 'multipart/form-data']) ?>
    <div class="m-page m-page2" style="min-height: 578px; background: rgb(238, 238, 238);">
        <div class="top-holder">
            <div class="fixed-top">
                <div class="m-header">
                    <div class="header-left-btn">
                        <span onclick="history.back()" class="icon-back"></span>
                    </div>
                    <h2>购物车</h2>
                    <div class="header-right-btn">
                        <a href="<?=Url::to(['user/index'])?>" class="icon-home"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="full-screen" id = 'cart' _csrf="<?= Html::encode($_csrf) ?>" updateURL="<?= Url::to(['cart/update/'],true) ?>" 
             priceURL="<?= Url::to(['cart/price/'],true) ?>" deleteURL="<?= Url::to(['cart/delete/'],true); ?>">
            <div class="full-padding cart-body">
                <div class="cart-pt">
                 <div style="background:#fff;height:40px;overflow:hidden;">

                       <label class="am-checkbox" style="margin:0px;margin-top:10px;margin-left:10px;">
                          <input type="checkbox" value="" checked=true id='selectAll' data-am-ucheck> 全选
                       </label> 

                 </div>              
                <?php if ($allItems & is_array($allItems)) {
                     foreach ($allItems as $type => $item):?>
                    <ul class="pt-list-notempty jinkoushangping">
                        <li class="pt-h-item c-fix cart-title">
                            <?= $storeName[$type]?>
                            <span id="additionalinstruction" style="font-size:12px;color:#ccc;">
                                <?php if ($type > 2): ?>
                                   <span style="color:#b60009;"> &nbsp;温馨提示：</span>本专区为跨境商品，每单关税低于50元（含）免税。
                                <?php endif?>
                            </span>
                        </li>
                        <?php foreach ($item as $k => $v):?>
                        <?php if(isset($v['buyAble']) && $v['buyAble']<1): ?>
                        <li style="background: #ECECEC; border:1px dashed #F00" class="pt-h-item c-fix" cartlineId=<?= $v['cartlineId'] ?> itemId=<?= $v['itemId'] ?> tariffno=<?=$v['tariffno'] ?> 
                            itemPartNumber=<?= $v['itemPartNumber'] ?> itemOwnerId=<?= $v['itemOwnerId'] ?> shopId=<?= $v['shopId'] ?>  store_id=<?= $v['itemSalestype'] ?>>
                        <label class="am-checkbox" style="float:left;width:5%;margin-top:0;">
                                
                                <input type="checkbox" disabled="true"  name="selectCartItem_disable" data-am-ucheck cartlineId=<?= $v['cartlineId'] ?> >
                        </label> 
                        
                        <div href="<?= Url::to(['product/view','id'=>$v['itemId']],true) ?>" class="pt-h-img">
                                <a href="<?= Url::to(['product/view','id'=>$v['itemId']],true) ?>">
                                    <img src="<?php echo json_decode($v['itemImageLink'],true)['img'];?>" alt= "<?= $v['itemDisplayText'] ?>">                                 
                                </a>
                        </div>
                        <div class="pt-h-info">
                            <div class="pt-h-supplier"><?= $v['shopDisplayText'] ?></div>
                            <div class="pt-h-name"><?= $v['itemDisplayText'] ?></div>
                            <div class="pt-h-other" style="display:none;"></div>
                            <div class="pt-num J-pt-num" >
                                    已下架
                            </div>
                        </div>
                        <div class="pt-h-bar c-fix">
                            <div class="pt-h-price">
                                <div class="col2">
                                    <div class="col price">￥<?= $v['itemOfferPrice'] ?></div>
                                </div>
                            </div>
                            <div class="pt-h-del">
                                    <a  class="btn gray J-remove">删除</a>
                            </div>
                            <div class="pre-price" style="color:#ccc;font-size:0.5rem;text-decoration:line-through">￥<?= $v['itemListPrice'] ?></div>
                            <div class="tax" id = 'tax_<?= $v['itemId'] ?>' style="display: none;font-size:0.5rem"><em ></em>/<?= $v['taxRate'] ?></div>
                        </div>
                    </li>
                    <?php else:?>
                    
                    <li class="pt-h-item c-fix" cartlineId=<?= $v['cartlineId'] ?> itemId=<?= $v['itemId'] ?> tariffno=<?=$v['tariffno'] ?> 
                            itemPartNumber=<?= $v['itemPartNumber'] ?> itemOwnerId=<?= $v['itemOwnerId'] ?> shopId=<?= $v['shopId'] ?>  store_id=<?= $v['itemSalestype'] ?>>
                        <label class="am-checkbox" style="float:left;width:5%;margin-top:0;">
                            <input type="checkbox" checked=true name="productsel[<?= $v['cartlineId'] ?>]" value=<?= $v['cartlineId'] ?> data-am-ucheck >
                        </label> 
                        <div href="<?= Url::to(['product/view','id'=>$v['itemId']],true) ?>" class="pt-h-img">
                                <a href="<?= Url::to(['product/view','id'=>$v['itemId']],true) ?>">
                                    <img src="<?php echo json_decode($v['itemImageLink'],true)['img'];?>" alt= "<?= $v['itemDisplayText'] ?>">                                 
                                </a>
                        </div>
                        <div class="pt-h-info">
                            <div class="pt-h-supplier"><?= $v['shopDisplayText'] ?></div>
                            <div class="pt-h-name"><?= $v['itemDisplayText'] ?></div>
                            <div class="pt-h-other" style="display:none;"></div>
                            <div class="pt-num J-pt-num" >
                                    <span class="minus btn gray">-</span>
                                    <div class="num">
                                        <input type="text" name="modify_quantity" value="<?= $v['cartlineQuantity'] ?>" class="num-ipt">
                                    </div>
                                    <span class="plus btn gray">+</span>
                            </div>
                             <?php if($nii && $nii['itemPartNumber'] == $v['itemPartNumber'] && $nii['itemOwnerId'] == $v['itemOwnerId']): ?>
                                        <div class="orange" style=" margin-top: 10px">库存不足(仅剩<?= $nii['remain'] ?>件)</div>
                             <?php endif?>
                        </div>
                        <div class="pt-h-bar c-fix">
                            <div class="pt-h-price">
                                <div class="col2">
                                    <div class="col price">￥<?= $v['itemOfferPrice'] ?></div>
                                </div>
                            </div>
                            <div class="pt-h-del">
                                    <a  class="btn gray J-remove">删除</a>
                            </div>
                            <div class="pre-price" style="color:#ccc;font-size:0.5rem;text-decoration:line-through">￥<?= $v['itemListPrice'] ?></div>
                            <div class="tax" id = 'tax_<?= $v['itemId'] ?>' style="display: none;font-size:0.5rem"><em ></em>/<?= $v['taxRate'] ?></div>
                        </div>
                    </li>
                    
                    <?php endif?>
                    
                    <?php endforeach;?>   
                        <li class="pt-h-item c-fix">
                           <ul style="margin-right:0;text-align:right;">
                               <li id="store_promotion_<?=$type?>">优惠金额：<span  class="price-common">￥0.00</span> <a id="store_promotion_detail_switch_<?=$type?>" >&nbsp;详情>></a></li>
                               <ul id="store_promotion_detail_<?=$type?>" style="display: none; color:#F00">
                                    </ul>
                               <li id="store_subtotal_tax_no<?=$type?>" style="display: none;"> <h class="orange">关税≤50，免征哦！&nbsp;</h> 行邮税：<span class="price-common">￥-0.00</span></li>
                               <li id="store_subtotal_tax_yes<?=$type?>" style="display: none;">行邮税：<span class="price-common">￥0.00</span></li>
                               
                               <li id="store_subtotal_tax_yes_info<?=$type?>" style="display: none;color: rgb(102, 102, 102);" class="nice-alert"><span class="price-common">温馨提示：</span>关税超过50元，分开下单把关税总额控制在50元以下可免税！</li>
                               <li>合计（不含运费）：<span id="store_total_price_<?=$type?>" class="price-common">￥0.00</span></li>
                               <li id="store_message_<?=$type?>" style="display: none;" class="nice-alert">啊哦，海关规定购买多件的总价不能超过￥1000大洋，请您分多次购买!</li>
                           </ul> 
                        </li>
                    </ul>
                <?php endforeach;
                         } ?>
                </div>
            </div>
            
            <div class="total" id="J_total" style="height: 93px;">
                <div class="fixed-bar">
                    <div class="total-inner">
                        
                        商品总价：<span id="cart-subtotal" style="color:#cb5157;padding-right:5px;">￥0.00,</span>优惠金额:<span id="cart-promotion_discount_price" style="color:#cb5157">￥0.00</span>
                    </div>
                    <div class="total-inner">
                        总金额:<span id="cart-promotion-subtotal" class="price">￥0.00</span>
                    </div>
                    
                
                        <button type="submit" id="btnjiesuan" class="checkout J_settlement red_btn" style="margin-top:10px"><span>去结算</span></button>
         
                </div>
            </div>
        </div>
    </div>
    <?= Html::endForm() ?>