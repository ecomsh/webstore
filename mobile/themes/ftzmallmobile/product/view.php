<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
use mobile\assets\ProductAsset;
ProductAsset::register($this);
?>

<div class="m-page">
    <div class="top-holder">
        <div class="fixed-top">
            <div class="m-header"> 
               <div class="header-left-btn">
                    <span onclick="history.back()" class="icon-back"></span>
                </div>               
                <h2><?= Html::encode($desc['name']) ?></h2>
<!--
                <div class="header-right-btn2">
                    <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                </div>
                <div class="header-right-btn">
                    <a href="javascript:void(0)" class="icon-share js_share"></a>
                </div>
-->
                <div class="header-right-btn">
                    <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                </div>
            </div>
        </div>
    </div>

    <div style="height:10px;"></div>
    <!--       图片轮播1-->
    <?php /*<div class="page pt-pic">
        <div data-am-widget="slider" class="am-slider am-slider-default swiper-container">
            <ul class="am-slides">
                <li class="lazyload">
                   <img src="<?= Html::encode($desc['fullImage']) ?>" style="width:290px;height:290px">
                </li>
            </ul>
        </div>
    </div>*/ //不要轮播了?>

    <div class="lunbo-cq">
        <img src="<?= Html::encode($desc['fullImage']) ?>" style="width:290px;height:290px">               
    </div>

<div class="full-screen">    
    <div class="product-wrap">
        <div class="product-info">
        <!-- 商品标题 -->
            <div class="col2">
                <div class="col">
                    <h1 class="pt-name"><?= Html::encode($desc['name']) ?></h1>
                </div>
            </div>
            <!-- 商品价格 -->
            <div class="col2 pt-price">
            <!-- 商品价格 -->
                <div class="col price">
                    <b class="price">
                        <?php  if ($offerprice & is_array($offerprice))
                        {                                                    
                        foreach ($offerprice as $k => $arr):                              
                            if($arr['currency']==''||$arr['currency']=='CNY')
                               if($arr['minPrice']&&$arr['maxPrice']&&$arr['minPrice']!=$arr['maxPrice']):?>
                            ￥<?= Html::encode($arr['minPrice']) ?> - <?= Html::encode($arr['maxPrice']) ?>
                        <?php  elseif ($arr['price']):?>
                            ￥<?= Html::encode($arr['price']) ?>                                      
                        <?php endif; 
                        endforeach;}?>
                    </b>
                    <?php  if ($listprice & is_array($listprice))
                    {                                                    
                    foreach ($listprice as $k => $arr):                              
                        if($arr['currency']==''||$arr['currency']=='CNY')
                                 if($arr['minPrice']&&$arr['maxPrice']&&$arr['minPrice']!=$arr['maxPrice']):?>
                    <span>大陆参考价：￥<?= Html::encode($arr['minPrice']) ?> - <?= Html::encode($arr['maxPrice']) ?></span>
                    <?php  elseif ($arr['price']):?>
                        <span>大陆参考价：￥<?= Html::encode($arr['price']) ?></span>                                     
                    <?php endif; 
                    endforeach;}?>     
                </div>
            </div>                                   
        </div>
    </div>

    <div class="product-wrap">
        <div class="product-info">
                <!-- 商品标题 -->
            <div class="col2">
                <div id="spec_area" data-sync-type="goodsspec">
                    <div class="goods-spec goods-spec-1585-249324001436154198">
                        <div class="speci">
                            <?php
                                if ($defining & is_array($defining))
                                {
                                    foreach ($defining as $k => $arr):
                            ?>
                            <div class="spec-item specItem clearfix">
                                <div class="spec-label"><span><em class="check"><?= Html::encode($arr['name']) ?></em>：</span></div>
                                <div class="spec-values">
                                    <ul class="clearfix">
                                        <?php
                                            if ($arr['possibleValues'] & is_array($arr['possibleValues']))
                                            {           
                                                foreach ($arr['possibleValues'] as $k => $possiblearr):                                                                 
                                        ?>
                                                <li>
                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?>"> 
                                                    <?php if($possiblearr['image']!=NULL) :?>
                                                       <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;"  width="30" height="30">  
                                                    <?php else :?> 
                                                       <span><?= Html::encode($possiblearr['displayValue']) ?></span>     
                                                    <?php
                                                            endif;                        
                                                    ?>     
                                                    <i title="点击取消选择">&nbsp;</i>
                                                    </a>
                                                </li>
                                        <?php
                                            endforeach;                       
                                        }
                                        ?>
                                    </ul>                                                    
                                </div>
                            </div>
                            <input type="hidden" name="<?= Html::encode($arr['key']) ?>" value="" id="defining"><!--value为$arr['assignedValue']现在没有-->
                            <?php
                                endforeach; }   
                            ?>                                                     
                        </div>
                        <input type="hidden" name="offergoodsprice" id="offergoodsprice" value="<?= Html::encode($offerprice[0]['price']) ?> ">
                        <input type="hidden" name="listgoodsprice" id="listgoodsprice" value="<?= Html::encode($listprice[0]['price']) ?> ">
                        <input type="hidden" name="skuMapValue" value="" id="skuMapValue">
                        <input type="hidden" name="skuMapId" value="" id="skuMapId">
                        <input type="hidden" name="skuMapContent" value="" id="skuMapContent">
                    </div>                                             
                </div>
            </div>
                            <!-- 商品价格 -->
            <div class="col2 pt-price buyinfo" style="display: block; height:100px;">
                <div style="width:70%">
                    <li class="list-item"><span>配送：</span>    
                        <div class="tb-postAge" style="display:inline-block;">
                            <div class="tb-postAge-add">
                                <span id="J_deliveryAdd" class="tb-deliveryAdd deliveryAddModi">上海市</span>
                                <span >至</span>
                                <a id="J_dqPostAgeCont" class="tb-postAgeCont deliveryAddModi" code="<?= Html::encode(isset($stateCode) ? $stateCode : "330000") ?>" parent="1" href="javascript:void(0);" ><?= Html::encode(isset($stateName) ? $stateName : "上海") ?></a>
                                <input type="hidden" name="code" id="stateCode" value="<?= Html::encode(isset($stateCode) ? $stateCode : "330000") ?>"/>
                            </div>
                        <?php /* 快递计算暂无<div id="J_PostageToggleCont" class="tb-postAge-info">
                        <span>圆通快递：12</span>
                        </div> */ ?>
                        </div>
                    </li>
                </div>
                <div style="clear:both;width:70%;display:block">
                    <label style="float: left;">数量：</label>
                    <ul style="float: left;">
                        <li style="width :100px;">
                            <div class="Numinput numinputModi" id="goods-viewer">
                                <span class="substract"></span>
                                <span class="pluscq"></span>
                                <input type="text" value="1" size="5" name="goodsnum" min="0" class="Num" id="Num">
                                <div style="display:none;" class="numadjust-arr"><span class="numadjust increase"></span> <span class="numadjust decrease"></span></div>
                            </div>
                        </li>                                            
                        <li>
                            <span style="display:none;">&nbsp;&nbsp;(剩余数量:        <span class="store" updatespec="text_store" id="inventory" style="color:red"></span> 件)
                            </span>
                        </li>                    
                    </ul>
                </div>
            </div>
                            <!--购买按钮-->
            <div class="pt-btn">
                <!--购买按钮-->
                <a href="javascript:void(0);" class="btn add-cart" id="J_buy_btn" style="width:60px;height:60px;display:block;top:20px;" onclick="cartcheckout();">
                    加入购物车
                </a>
            </div>
        </div>
    </div>                            

    <div class="product-wrap">
        <img class="product-img" src="<?= yii::$app->params['localimgUrl']?>product-cn.png">
    </div>
    <!-- 促销信息 -->
    <div style="display:none">
        <!-- 促销信息 -->
        <div class="pt-promotions">
            <span class="icon red">
               促
            </span>
            <!-- 商品促销标签 -->

            <!-- 订单促销标签 -->
            <span class="arr right"></span>
        </div>

        <!-- 促销具体名称 -->
        <div class="promotions-panel tab" style="display:none">
            <ul class="trigger-list">
                <li class="trigger act" data-target="0">商品促销</li>
                <li class="trigger" data-target="1">订单促销</li>
            </ul>
            <div class="panel act">
                <ul>
                </ul>
            </div>
            <div class="panel">
                <ul>
                </ul>
            </div>
        </div>
    </div>

    <!-- 商品规格 -->
    <div class="pt-sku" style="display:none;">
    </div>
        <div class="pt-detail">
            <div class="tab J-tab">
                <ul class="trigger-list">                    
                    <li class="trigger act" id="productmessage1" onclick="setTab('productmessage', 1 ,3);">
                        <span>商品信息</span>
                    </li>
                    <li class="trigger" id="productmessage2" onclick="setTab('productmessage', 2 ,3);">
                        <span>商品详情</span>
                    </li>
                </ul>
                <!--对应列表-->
                <ul class="panel-list">
                    <!--商品信息-->
                    <li class="panel act" id="con_productmessage_1">
                         <?php
                            if ($descriptive & is_array($descriptive))
                            {
                                foreach ($descriptive as $k => $arr):
                            ?>                                                
                            <div class="d-line1">
                                <span class="k"><?= Html::encode($arr['name']) ?>：</span>
                                <span class="v"><?= Html::encode($arr['value']) ?>  </span>
                            </div>
                            <?php
                                endforeach;                        
                            }
                        ?>              
                        <br>
                        <br>
                    </li>
                    <!--商品图片详情-->
                    <li class="panel" id="con_productmessage_2">
                        <!-- 商品详情 -->
                        <div class="d-line">
                            <span class="v">
                                <?= $desc['longDescription'] ?>
                            </span>
                        </div>
                        <div style="height:60px;"></div>
                    </li>
                </ul>
            </div>
        </div>

        <!--这个分享没找到也没看到在哪里，先干掉了<div class="share-wrap" style="height: 401px; bottom: -401px;">
                <div class="share-wrap-bg">
                </div>
                <div class="share-wrap-main">
                        <ul>
                                <li style="height: 256.5px;">
                                        <a href="http://www.jiathis.com/send/?webid=tsina&url=http://www.urlurl.com&title=%E5%A4%96%E9%AB%98%E6%A1%A5%E5%88%86%E4%BA%AB">
                                                <img src="<?= yii::$app->params['localimgUrl']?>share-icon-xl.png">
                                        </a>
                                </li>
                                <li style="height: 256.5px;">
                                        <a class="jiathis_button_weixin" title="分享到微信"><span class="jiathis_txt jiathis_separator jtico jtico_weixin"><img src="<?= yii::$app->params['localimgUrl']?>share-icon-wx.png"></span></a>
                                </li>
                                <li style="height: 256.5px;">
                                        <a class="jiathis_button_weixin" title="分享到微信"><span class="jiathis_txt jiathis_separator jtico jtico_weixin"><img src="<?= yii::$app->params['localimgUrl']?>share-icon-pyq.png"></span></a>
                                </li>
                        </ul>
                        <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis share-more">更多</a>
                        <a href="http://bbctest.ftzmall.com.cn/wap/product-227.html#" class="share-close"></a>
                </div>
        </div>-->

        <div class="fixed-action">
                <div class="fixed-action-bg">
                </div>
                <div class="fixed-action-main">
                    <div class="col-2">
                        <a href="<?= Url::to(['cart/index'])?>" class="add-cart-icon"></a>
                    </div>
                    <div class="col-3">
                        <span class="price">
                            &nbsp;       
                        </span>
                    </div>
                    <div class="col-5">
                        <button href="javascript:void(0)" class="add-cart-btn" id="addtocart">加入购物车</button>                           
                        </a>
                    </div>
                </div>
		</div>
    </div>
</div>
<div id="J_dqPostAgeCont_body" class="ks-overlay" style="display:none; width: 80%; visibility: visible; z-index: 8; ">
    <div class="citySelector clearfix">
        <a href="javascript:void(0);"><b class="J_CitySelectorClose">关闭</b></a>
        <ul class="J_ZxCity cityList clearfix" style="margin-top:20px;">
            <li><a class="" id="code_110000" code="110000" href="javascript:void(0);">北京</a></li>
            <li><a class="" id="code_310000" code="310000" href="javascript:void(0);">上海</a></li>
            <li><a class="" id="code_120000" code="120000" href="javascript:void(0);">天津</a></li>
            <li><a class="" id="code_500000" code="500000" href="javascript:void(0);">重庆</a></li>
            <li><a class="" id="code_340000" code="340000" href="javascript:void(0);">安徽</a></li>
            <li><a class="" id="code_350000" code="350000" href="javascript:void(0);">福建</a></li>
            <li><a class="" id="code_620000" code="620000" href="javascript:void(0);">甘肃</a></li>
            <li><a class="" id="code_440000" code="440000" href="javascript:void(0);">广东</a></li>
            <li><a class="" id="code_450000" code="450000" href="javascript:void(0);">广西</a></li>
            <li><a class="" id="code_520000" code="520000" href="javascript:void(0);">贵州</a></li>
            <li><a class="" id="code_460000" code="460000" href="javascript:void(0);">海南</a></li>
            <li><a class="" id="code_130000" code="130000" href="javascript:void(0);">河北</a></li>
            <li><a class="" id="code_410000" code="410000" href="javascript:void(0);">河南</a></li>
            <li><a class="" id="code_230000" code="230000" href="javascript:void(0);">黑龙江</a></li>
            <li><a class="" id="code_420000" code="420000" href="javascript:void(0);">湖北</a></li>
            <li><a class="" id="code_430000" code="430000" href="javascript:void(0);">湖南</a></li>
            <li><a class="" id="code_220000" code="220000" href="javascript:void(0);">吉林</a></li>
            <li><a class="" id="code_320000" code="320000" href="javascript:void(0);">江苏</a></li>
            <li><a class="" id="code_360000" code="360000" href="javascript:void(0);">江西</a></li>
            <li><a class="" id="code_210000" code="210000" href="javascript:void(0);">辽宁</a></li>
            <li><a class="" id="code_150000" code="150000" href="javascript:void(0);">内蒙古</a></li>
            <li><a class="" id="code_640000" code="640000" href="javascript:void(0);">宁夏</a></li>
            <li><a class="" id="code_630000" code="630000" href="javascript:void(0);">青海</a></li>
            <li><a class="" id="code_370000" code="370000" href="javascript:void(0);">山东</a></li>
            <li><a class="" id="code_140000" code="140000" href="javascript:void(0);">山西</a></li>
            <li><a class="" id="code_610000" code="610000" href="javascript:void(0);">陕西</a></li>
            <li><a class="" id="code_510000" code="510000" href="javascript:void(0);">四川</a></li>
            <li><a class="" id="code_540000" code="540000" href="javascript:void(0);">西藏</a></li>
            <li><a class="" id="code_650000" code="650000" href="javascript:void(0);">新疆</a></li>
            <li><a class="" id="code_530000" code="530000" href="javascript:void(0);">云南</a></li>
            <li><a class="" id="code_330000" code="330000" href="javascript:void(0);">浙江</a></li>
            <li><a class="" id="code_810000" code="810000" href="javascript:void(0);">香港</a></li>
            <li><a class="" id="code_820000" code="820000" href="javascript:void(0);">澳门</a></li>
            <li><a class="" id="code_710000" code="710000" href="javascript:void(0);">台湾</a></li>
            <li><a class="" id="code_000000" code="000000" href="javascript:void(0);">海外</a></li><!--海外编码没有，先用000000代替了-->
        </ul>
        <ul class="J_Area cityList clearfix"></ul>
    </div>
</div>

<script>
	var _csrf ="<?= Html::encode($_csrf) ?>";
	var itemPartNumber = "<?= Html::encode($data['partNumber']) ?>";
	var itemId = "<?= Html::encode($data['id']) ?>";
	var buyable = "<?= Html::encode($data['buyable']) ?>";
	var shop ="<?= Html::encode($data['memberId']) ?>";
	var inventoryposturl = "<?= Url::to(['product/getinventory']); ?>";
	var priceposturl = "<?= Url::to(['product/getproductprice']); ?>";
	var _maxbuy = "<?= Yii::$app->params['cart']['maxbuy'];?>";
	var salestype = "<?= Html::encode($data['salesType']) ?>";
	var userId = "<?= Yii::$app->mobileUser->getId();?>";
	var loginurl = "<?= Url::to(['passport/login']); ?>";
	var addtocarturl = "<?= Url::to(['cart/ajaxcreate']); ?>";
	var skuMap = <?=json_encode($skumap)?>;
</script>


<script>
	getskuMapValue(_csrf, skuMap, itemId, itemPartNumber, buyable, shop, priceposturl, inventoryposturl);
	changebuynum(_maxbuy,salestype);
	addtocart(_csrf,userId,loginurl,addtocarturl);
</script>

<script>
	function cartcheckout(){    //checkout函数由于赵吉朋同学改动较多，占时不作出修改
		var skuMapValue = jQuery("input[name='skuMapValue']").val(); //productid数量什么的也这样读
		var skuMapId = jQuery("input[name='skuMapId']").val();
		var offergoodsprice = jQuery("input[name='offergoodsprice']").val();
		var listgoodsprice = jQuery("input[name='listgoodsprice']").val();
		var userId = "<?= Yii::$app->mobileUser->getId();?>";   
		if (!userId)
		{
			window.location.href = '<?= Url::to(['passport/login']); ?>';
			return false;
		}
		if (!skuMapValue)
		{
			alert("加入购物车失败。请选择规格参数");
			return false;
		}
		var num = jQuery("#Num").val();
		var params = ({//数组，这个数组，北京写model的姐姐说都要的，但是她貌似也不是很清楚每个参数是干嘛的
			"_csrf": "<?= Html::encode($_csrf) ?>",
			"cartlineDTOList": {
				"0": {
					"itemPriceListId": "offer", //购物车项商品的采用的价格列表 required
					"cartlineType": 1, //买家类型，游客0，登录用户1 , required
					"itemDisplayText": "<?= Html::encode($desc['name']) ?>",
					"shopDisplayText": "自贸区直购专场", //购物车项商品所属店铺显示的文本,自营情况下可以为空，或者默认 required
					"userId": userId, //买家id required
					"shopContactId": "1111", //...听完了也没懂，跟店小二有关？
					"itemListPrice": listgoodsprice, //购物车项商品的标价，显示用 required
					"channelType": 3, //购物车来源类型,app,pc,wechat等,required
					"channelId": "ftzmall", //购物车来源Id , required
					"itemId": skuMapId, //skuMapId 购物车项商品全局唯一Id required
					"itemOwnerId": "ftzmall", //购物车项商品的货主Id required
					"itemLink": window.location.href, //购物车项商品的链接 required
					"itemImageLink": "{\"img\":\"<?= Html::encode($desc['thumbnail']) ?>\",\"img_large\":\"<?= Html::encode($desc['fullImage']) ?>\"}",
					"itemSalestype": "<?= Html::encode($data['salesType']) ?>", //商品销售来源,一般贸易（DIG，供应商直送），跨境贸易（自营，分销），海外直邮 required
					"shopId": "<?= Html::encode($data['memberId']) ?>", //购物车项商品所属店铺的Id,自营情况下可以为空，或者默认,required
					"shopLink": "http://www.ftzmall.com.cn", //required
					"extensionData": {//购物车项的扩展数据
						"empty": "boolean"
					},
					"itemMfname": "<?= Html::encode($data['manufactureName']) ?>", //供应商 required   manufactureName
					"itemWeight": 12, //商品重量 required
					"itemVolumn": 0, //商品体积 required
					"cartlineQuantity": num, //买的商品个数
					"cartlineComment": "", //买家留言
					"itemPartNumber": skuMapValue, //partNumber
					"itemOfferPrice": offergoodsprice, //购物车项商品的售价，显示用(没懂，自己算？)
					"tariffno": "<?= Html::encode(isset($tax['taxSerialNumber']) ? $tax['taxSerialNumber'] : '0') ?>", //税则号，一定要，tax里的
					"isGift": 0,
					"cartlineId": null,
				},
			},
		});
		console.log(params);
		post('<?= Url::to(['cart/checkout']); ?>', params);
	};

</script>
