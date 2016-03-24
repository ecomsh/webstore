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
 <!--栏目导航 end-->
    <!--在线商店 start-->
    <div class="wrapper bgf2">
        <div class="container">
            <!--二级导航 面包屑 未实现 start-->
            <div class="con-nav">
                <div class="con-link">
                    <a href="javascript:void(0)">首页</a><i class="iconfont icon-arrowright"></i>
                    <!-- <a href="/act/page.html?view=index">首页</a> -->
                    <a href="javascript:void(0)">在线商店</a><i class="iconfont icon-arrowright"></i>
                    <a href="javascript:void(0)" class="active">厨房</a>
                </div>
                <p>共 <?= Html::encode($totalcount); ?> 件商品首页</p>
            </div>
            <!--二级导航 end-->

            <!--高级搜索 start-->
            <ul class="search-criteria">
                <li>
                    <label>品牌：</label>
                    <?php foreach($facets['facets'] as $k=>$arr):?>
                    <?php if($arr['facetName']=="brand"):?>
                    <div class="search-ctl">
                        <!-- <a href="javascript:void(0)"><i class="iconfont icon-add"></i> 多选</a> -->
                        <a href="javascript:void(0)" class="brand-more">更多 <i class="iconfont icon-arrowdown"></i></a>
                    </div>
                    <dl style="height: 72px;">
                    <?php foreach ($arr["facetValues"] as $key => $value):?>
                        <dd>
                            <a href = "<?= Url::to(['search/index','facets'=>urlencode($arr['facetName'].'|'.$value),'search'=>isset($searchData['term'])?$searchData['term']:""]);?>">
                                <?= Html::encode(isset($value)?$value:""); ?>
                            </a>
                        </dd>
                    <?php endforeach ?>
                        <?php endif ?>
                    </dl>
                <?php endforeach ?>
                </li>
                <li>
                    <label>分类：</label>
                    <dl>
                    <?php foreach ($facets['categoryFacets'] as $key => $arr):?>
                        <dd>
                            <a title = "<?= Html::encode($arr['facetName']['displayText']); ?>" href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$arr['facetName']['id']),'search'=>isset($searchData['term'])?$searchData['term']:""]);?>">
                                <?= Html::encode($arr['facetName']['displayText']); ?>
                            </a>
                            <?php foreach ($arr['facetValues'] as $k => $v):?>
                                <dd>
                                    <a href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$v['id']),'search'=>isset($searchData['term'])?$searchData['term']:""]);?>">
                                        <?= Html::encode($v['displayText']); ?>
                                    </a>
                                </dd>
                            <?php endforeach;?>
                        </dd>
                    <?php endforeach ?>
                    </dl>
                </li>

                <li>
                    <label>价格：</label>
                    <dl>
                        <dd><a href="javascript:void(0)">300-2000</a></dd>
                        <dd><a href="javascript:void(0)">2001-5000</a></dd>
                        <dd><a href="javascript:void(0)">5001-10000</a></dd>
                        <dd><a href="javascript:void(0)">10001-100000</a></dd>
                        <dd><a href="javascript:void(0)">1000001以上</a></dd>
                    </dl>
                </li>
            </ul>
            <div class="search-more">
                <!-- <a href="javascript:void(0)">更多选项 <i class="iconfont icon-arrowdown"></i></a> -->
            </div>
            <!--高级搜索 end-->
            <div style="padding:20px 0;">
                <img src="http://static.tbh.dev/yingyuan/static/test/pinpaiAD.jpg" alt=""/>
            </div>
            <!--商品列表 start-->

            <div class="goods-content bgff">

                <!--条件筛选 start-->
                 <div class="select-criteria">
                    <div class="select-box">

                        <a title="维护中..."><span>综合 <i class="iconfont icon-arrowdown"></i></span></a>
                        <a title="维护中..."><span>人气 <i class="iconfont icon-arrowdown"></i></span></a>
                        <?php if(isset($searchData['orderby'])&&$searchData['orderby']==6):?>    
                            <a class="paixu sore-price" avalue="6" href="javascript:void(0);"><span>新品 <i class="iconfont icon-arrowdown"></i></span></a>
                        <?php else: ?>    
                            <a class="paixu" avalue="6" href="javascript:void(0);"><span>新品 <i class="iconfont icon-arrowdown"></i></span></a>
                        <?php endif;?>
                        <a title="维护中..."><span>销量 <i class="iconfont icon-arrowdown"></i></span></a>
                        <a title="维护中..."><span>折扣 <i class="iconfont icon-arrowdown"></i></span></a>
                        <?php if(isset($searchData['orderby'])&&$searchData['orderby']==4):?>
                            <a class="paixu sore-price" avalue="5" href="javascript:void(0);" title="点击后按价格从低到高"><span>价格 <i class="iconfont icon-updown"></i></span></a>
                        <?php elseif(isset($searchData['orderby'])&&$searchData['orderby']==5):?>
                            <a class="paixu sore-price" avalue="4" href="javascript:void(0);" title="点击后按价格从高到低"><span>价格 <i class="iconfont icon-updown"></i></span></a>
                        <?php else:?>
                            <a class="paixu" avalue="5" href="javascript:void(0);" title="点击后按价格从低到高"><span>价格 <i class="iconfont icon-updown"></i></span></a>
                        <?php endif;?> 
                        <span class="min-price">
                            <i class="iconfont icon-rmb"></i>
                            <input type="text"/>
                        </span>
                        <i class="select-bar">-</i>
                        <span class="max-price">
                            <i class="iconfont icon-rmb"></i>
                            <input type="text"/>
                        </span>   
                        <!-- ↓ -->
                    </div>
            
            
                    <div class="select-page">
                        <?= Html::beginForm(['search/index'], 'get', ['enctype' => 'multipart/form-data','id'=> "searchform"]) ?>
                        <input type="hidden" name="facets" value="<?= Html::encode(isset($searchData['facet'])?$searchData['facet']:"") ?>" />
                        <input type="hidden" name="search" value="<?= Html::encode(isset($searchData['term'])?$searchData['term']:"") ?>" />
                        <input type="hidden" name="page" value="<?= Html::encode(isset($pageinfo)?$pageinfo:"") ?>" >
                        <input type="hidden" name="orderby"value="<?= Html::encode(isset($searchData['orderby'])?$searchData['orderby']:"") ?>" >
                        <div class="pull-right sore-right">
                                           
                            <span id="pre-page" <?php if($pageinfo==1):?>style="display:none;"<?php endif;?>>
                                <a href="javascript:void(0)" class="disable"><i class="iconfont icon-arrowleft"></i></a>
                            </span>
                            <span>
                                <span class="font-color4"><?= Html::encode($pageinfo); ?></span> / <?= Html::encode($totalpage); ?>
                            </span> 
                            <span id="next-page" <?php if($pageinfo==$totalpage):?>style="display:none;"<?php endif;?>>
                                <a href="javascript:void(0)"><i class="iconfont icon-arrowright"></i></a>
                            </span>
                        </div>
                        <?= Html::endForm(); ?>
                    </div>
                </div>  
                 <!--条件筛选 end-->

                <!--商品数据 start-->
                    <ul class="goods-list column-5 clearfix">
                        <?php Pjax::begin(['options' => ['id' => 'gallery-grid-list']]); ?>
                        <?php     
                            echo ListView::widget([ //这个是不分跨境跟一般商品排序的
                                'dataProvider' => $product,
                                'itemView' => '_searchItem', //子视图
                                'itemOptions' => ['tag'=>'li','style' => 'float:left'],
                                'layout' => '{items}',
                                'viewParams' => [
                                    //'conditions' => $conditions,
                                ]
                            ]);
                        ?>        
                    </ul>
                    <div class="goods-page">
                         <?=
                            LinkPager::widget([
                                'pagination' => $dataProvider->getPagination(),
                                'nextPageLabel' => '下一页',
                                'prevPageLabel' => '上一页',

                            ]);
                            ?>
                    
                    <?php Pjax::end(); ?> 
                    </div> 
                <!--商品数据 end-->
            <!--商品列表 end-->
           
             <!--感兴趣的专场 start-->
            <div class="guess bgff clearfix">
                <h3>您可能感兴趣的专场</h3>
                <ul>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="http://static.tbh.dev/yingyuan/static/test/cai1.jpg" alt=""/>
                            <p><时尚环保>Orange家居收纳专场满500减100</p>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="http://static.tbh.dev/yingyuan/static/test/cai2.jpg" alt=""/>
                            <p><点亮激情>Zippo打火机专场3折起</p>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="http://static.tbh.dev/yingyuan/static/test/cai3.jpg" alt=""/>
                            <p><卓越工艺>精品笔具专场2.4折起</p>
                        </a>
                    </li>
                </ul>
            </div>
            <!--感兴趣的专场 end-->
            <!--最近浏览 start-->
            <div class="goods-tabs bgff clearfix">
                <ul class="goods-tabs-menu">
                    <li class="active"><a href="javascript:void(0)">最近浏览</a></li>
                    <li><a href="javascript:void(0)">畅销排行榜</a></li>
                </ul>
                <div class="goods-tabs-box">
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="http://static.tbh.dev/yingyuan/static/test/goods.jpg" alt=""/>
                                <p class="goods-name">INDEFINIE 无硅油精油香氛香氛系列洗护套装(洗发香波500ml+护发素500ml) 10种植物提取 COSME大赏洗护</p>
                                <div class="goods-price">
                                    <i class="iconfont icon-rmb"></i>
                                    <span class="now-price">98</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--最近浏览 end-->
        </div>
    </div>
    <!--在线商店 end-->


