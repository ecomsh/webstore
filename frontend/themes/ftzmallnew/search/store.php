<?php
    use frontend\assets\ftzmallnew\SearchAsset;
    use yii\bootstrap\ActiveForm;
    use yii\widgets\ListView;
    use frontend\widgets\LinkPager;
    use yii\widgets\Pjax;
    use yii\helpers\Html;
    use yii\helpers\Url;    
    SearchAsset::register($this);
    $this -> title = '搜索结果';
?>
<div class="container">
    <p class="search-totalnum">搜索<span class="font-color1"><?=Html::encode(isset($productsfacets)?$productsfacets." ":"");?><?=Html::encode(Yii::$app->request->get('search'))?></span>商品共<?= Html::encode($totalcount); ?>个</p>
    <div class="search-criteria">
        <?php foreach($facets['facets'] as $k=>$arr):?>
        <div class="search-brand clearfix">
            <span class="criteria-title pull-left"><?= Html::encode(isset($arr['facetName'])?($arr['facetName']=="brand"?"品牌":$arr['facetName']):""); ?>：</span>
            <ul class="pull-left">
                <?php foreach ($arr["facetValues"] as $key => $value){
                    if($key < 13):?>
                <li class="pull-left">
                    <a href = "<?= Url::to(['search/index','facets'=>urlencode($arr['facetName'].'|'.$value),'search'=>isset($searchData['term'])?$searchData['term']:""]);?>">
                        <?= Html::encode(isset($value)?$value:""); ?>
                    </a>
                </li>
                <?php else: ?>
                <li class="pull-left morefacets<?= $k?>" style="display:none">
                    <a href = "<?= Url::to(['search/index','facets'=>urlencode($arr['facetName'].'|'.$value),'search'=>isset($searchData['term'])?$searchData['term']:""]);?>">
                        <?= Html::encode(isset($value)?$value:""); ?>
                    </a>
                </li>
                <?php endif;}?>                
            </ul>
            <?php if($key > 13):?>
                <a class="brand-more pull-right" id="getmore<?= $k ?>">更多</a>
                <a class="hidden-more pull-right" id="hiddenmore<?= $k ?>" style="display:none">更多</a>
            <?php endif;?>
        </div>
        <?php endforeach;?>
        <?php foreach ($facets['categoryFacets'] as $key => $arr):?>        
        <div class="search-brand1 clearfix">
            <a title = "<?= Html::encode($arr['facetName']['displayText']); ?>" href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$arr['facetName']['id']),'search'=>isset($searchData['term'])?$searchData['term']:""]);?>" class="criteria-title pull-left">
                <?= Html::encode($arr['facetName']['displayText']); ?>
            </a>
            <ul class="pull-left">
                <?php foreach ($arr['facetValues'] as $k => $v):?>
                <li class="pull-left">
                    <a href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$v['id']),'search'=>isset($searchData['term'])?$searchData['term']:""]);?>">
                        <?= Html::encode($v['displayText']); ?>
                    </a>
                </li>
                <?php endforeach;?>                
            </ul>
        </div>
        <?php endforeach;?>
        
        <div class="search-sore clearfix">
            <span class="criteria-title pull-left">排序：</span>
            <div class="pull-left sore-left">
                <?php if(!isset($searchData['orderby'])||isset($searchData['orderby'])&&$searchData['orderby']==1):?>
                    <a class="paixu sore-price" avalue="1" href="javascript:void(0);">默认</a>
                <?php else: ?>
                    <a class="paixu" avalue="1" href="javascript:void(0);">默认</a>
                <?php endif;?>
                <?php if(isset($searchData['orderby'])&&$searchData['orderby']==6):?>    
                    <a class="paixu sore-price" avalue="6" href="javascript:void(0);">新品↓</a>
                <?php else: ?>    
                    <a class="paixu" avalue="6" href="javascript:void(0);">新品↓</a>
                <?php endif;?>
                <?php if(isset($searchData['orderby'])&&$searchData['orderby']==4):?>
                    <a class="paixu sore-price" avalue="5" href="javascript:void(0);" title="点击后按价格从低到高">价格↓</a>
                <?php elseif(isset($searchData['orderby'])&&$searchData['orderby']==5):?>
                    <a class="paixu sore-price" avalue="4" href="javascript:void(0);" title="点击后按价格从高到低">价格↑</a>
                <?php else:?>
                    <a class="paixu" avalue="5" href="javascript:void(0);" title="点击后按价格从低到高">价格↑</a>
                <?php endif;?>    
                <!-- ↓ -->
            </div>
            <?= Html::beginForm(['search/index'], 'get', ['enctype' => 'multipart/form-data','id'=> "searchform"]) ?>
            <input type="hidden" name="facets" value="<?= Html::encode(isset($searchData['facet'])?$searchData['facet']:"") ?>" />
            <input type="hidden" name="search" value="<?= Html::encode(isset($searchData['term'])?$searchData['term']:"") ?>" />
            <input type="hidden" name="page" value="<?= Html::encode(isset($pageinfo)?$pageinfo:"") ?>" >
            <input type="hidden" name="orderby"value="<?= Html::encode(isset($searchData['orderby'])?$searchData['orderby']:"") ?>" >
            <div class="pull-right sore-right">
                <span>共<?= Html::encode($totalcount); ?>个商品</span>
                <span><span class="font-color4"><?= Html::encode($pageinfo); ?></span>/<?= Html::encode($totalpage); ?>页</span>                
                <span id="pre-page" <?php if($pageinfo==1):?>style="display:none;"<?php endif;?>><上一页</span>
                <span id="next-page" <?php if($pageinfo==$totalpage):?>style="display:none;"<?php endif;?>>下一页></span>
            </div>
            <?= Html::endForm(); ?>
        </div>  
    </div>
<!-- 店铺列表 -->
<ul class="seach-shop">
    <li>
        <a href="#" class="left">
            <img src="<?= Yii::$app->params['staticUrl'] ?>images/test-imgc.jpg">
        </a>
        <div class="left">
            <p>维生素店</p>
            <p>主营品牌：维生素a 维生素b 维生素c 维生素d、、、</p>
            <p>主营产品：维生素a 维生素b 维生素c 维生素d、、、</p>
        </div>
        <div class="right">
            <a href="#">进入店铺　　>> </a>
            <p>共<span>56</span>件相关商品</p>
        </div>
    </li>
    <li>
        <a href="#" class="left">
            <img src="<?= Yii::$app->params['staticUrl'] ?>images/test-imgc.jpg">
        </a>
        <div class="left">
            <p>维生素店<span>自营店</span></p>
            <p>主营品牌：维生素a 维生素b 维生素c 维生素d、、、</p>
            <p>主营产品：维生素a 维生素b 维生素c 维生素d、、、</p>
        </div>
        <div class="right">
            <a href="#">进入店铺　　>> </a>
            <p>共<span>56</span>件相关商品</p>
        </div>
    </li>
    <li>
        <a href="#" class="left">
            <img src="<?= Yii::$app->params['staticUrl'] ?>images/test-imgc.jpg">
        </a>
        <div class="left">
            <p>维生素店<span>自营店</span></p>
            <p>主营品牌：维生素a 维生素b 维生素c 维生素d、、、</p>
            <p>主营产品：维生素a 维生素b 维生素c 维生素d、、、</p>
        </div>
        <div class="right">
            <a href="#">进入店铺　　>> </a>
            <p>共<span>56</span>件相关商品</p>
        </div>
    </li>
</ul>
<!-- 店铺列表 -->
    
    <?php /*<div class="guess-like">
        <h4 class="guesslike-title">
            猜你喜欢<span>根据你的浏览记录推荐的商品</span>
            <a href="javascript:;" class="refresh pull-right">换一批</a>
        </h4>
        <ul class="row clearfix">
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
        </ul>
        <h4 class="guesslike-title">
            大家都在买<span>全网最热门的商品推荐</span>
        </h4>
        <ul class="row clearfix">
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">3件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
            <li class="guess-pro pull-left">
                <img src="../src/images/guess-like.png">
                <div class="guess-text">
                    <a href="">
                        <span class="font-color1">2件组合装</span>|Merries花王妙而舒花王妙而舒
                    </a>
                    <p class="font-color1">直降价，立省10元</p>
                </div>
                <div class="iteminfo">
                    <p>
                        <span class="price">￥176</span> <span class="price-line font-color2">￥539</span>
                    </p>
                    <a href="" class="comment">593 人已评价</a>
                </div>
            </li>
        </ul>
    </div>*/?>
</div>
