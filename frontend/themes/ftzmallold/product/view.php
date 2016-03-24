<?php

use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
use frontend\assets\ProductAsset;

ProductAsset::register($this);
?>
<style>
    .ald-03054 .ald-switchable-content li{margin:10px}
    .u-flyer{display: block;width: 50px;height: 50px;border-radius: 50px;position: fixed;z-index: 9999;}
    #goods-intro p{line-height:30px}
</style>
<div class="ppsc-product-detail">
    <div class="w1200">
        <div class="bread-cum">
        </div>    
        <div class="bread-cum">
        您当前的位置：  <span><a href="<?= Url::to(['index/']); ?>" alt="" title="">首页</a></span>
        <span> &gt; </span>
        <?php
            if ($cates & is_array($cates))
            {
            foreach ($cates as $k => $arr):
            ?>
                <span><a href="<?= Url::to(['search/index','facets'=>urlencode('category|'.$arr['name'])]);?>" alt="<?= Html::encode($arr['name']) ?>" title="<?= Html::encode($arr['name']) ?>"><?= Html::encode($arr['name']) ?></a></span>
                <span> &gt; </span>
            <?php endforeach;}?>
            <span class="now"><?= Html::encode($desc['name']) ?></span>
        </div>

        <div id="goods-viewer">
            <!--暂时针对于团购 开放立即购买功能时需修改-->   
            <div id="main-info" class="ec-spec-box">
                <form class="goods-action clearfix" target="_dialog_minicart">
                    <div class="goods-leftbox leftBoxModi">
                        <div class='goodspic sideborder' style=' width:400px;height:400px;'>
                            <p class="zoom-icon">
                                <a href="Javascript: void(0)" target="_blank" onclick='_open(this.href);
                                        return false;'> 
                                    <img src="<?= Url::base(); ?>/themes/ftzmallold/images/zoo_pic1.gif" title="点击查看大图" alt="查看大图" /> 
                                </a>
                            </p>
                            <div class="goods-detail-pic spec-pic" data-pic-type="middle" style=' margin:0 auto;display:table-cell;vertical-align:middle; width:400px;*font-size:350px;height:400px;' bigpicsrc="<?= Html::encode($desc['fullImage']) ?>">
                                <!--<a href="Javascript: void(0)" target="_blank" style='color:#fff; width:400px;height:400px;*font-size:350px;;font-family:Arial;display:table-cell; vertical-align:middle; text-align:center;'>-->
                                <img src="<?= Html::encode($desc['fullImage']) ?>"  alt=""  style='vertical-align:middle;'/> 
                                <!--                                </a>-->                            
                            </div>
                        </div>
                        <div class='picscroll clearfix'>
                            <div  class='scrollarrow to-left' title='向左'></div>
                            <div class="goods-detail-pic-thumbnail goods-detail-x pics" style="position:relative;width:330px">
                                <ul class="goods-detail-pic-thumbnail pics-content" style="position:absolute; left:0">
                                    <li class='current' img_id='32845c39a21cd5023ead8f14e0f02fa6'>
                                        <a href="Javascript: void(0)" target="_blank" imginfo="{small:'<?= Html::encode($desc['fullImage']) ?>',big:'<?= Html::encode($desc['fullImage']) ?>'}"> 
                                            <img src="<?= Html::encode($desc['thumbnail']) ?>" alt='' width='40' height='40'/> <!--这边的图这个接口只有一个，不知是不是fullImage跟thumbnail"-->
                                        </a>
                                    </li>
                                    <?php
                                    if ($goodspic & is_array($goodspic))
                                    {
                                        foreach ($goodspic as $k => $arr):
                                            ?>

                                            <li  img_id='1b64b8130b69449ae9e13dd65b8eede7'>
                                                <a imginfo="{small:'<?= Html::encode($arr['fullImage']) ?>',big:'<?= Html::encode($arr['fullImage']) ?>'}" href="Javascript: void(0)" target="_blank">
                                                    <img src="<?= Html::encode($arr['thumbnail']) ?>" width="50" height="50" />
                                                </a>
                                            </li>

                                            <?php
                                        endforeach;
                                    }
                                    ?>      
                                    <?php /* 要测试滚动效果的话，把注释去掉就可以<li  img_id='1b64b8130b69449ae9e13dd65b8eede7'>
                                      <a imginfo="{small:'//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h',big:'//ecomgq-images.oss.aliyuncs.com/74/75/7c/31694c07b285f5492fc7bfb77ee55f2d9b0.jpg?1430497616#h'}" href="Javascript: void(0)" target="_blank">
                                      <img src="//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h" width="60" height="60" />
                                      </a>
                                      </li>
                                      <li  img_id='1b64b8130b69449ae9e13dd65b8eede7'>
                                      <a imginfo="{small:'//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h',big:'//ecomgq-images.oss.aliyuncs.com/74/75/7c/31694c07b285f5492fc7bfb77ee55f2d9b0.jpg?1430497616#h'}" href="Javascript: void(0)" target="_blank">
                                      <img src="//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h" width="60" height="60" />
                                      </a>
                                      </li>
                                      <li  img_id='1b64b8130b69449ae9e13dd65b8eede7'>
                                      <a imginfo="{small:'//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h',big:'//ecomgq-images.oss.aliyuncs.com/74/75/7c/31694c07b285f5492fc7bfb77ee55f2d9b0.jpg?1430497616#h'}" href="Javascript: void(0)" target="_blank">
                                      <img src="//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h" width="60" height="60" />
                                      </a>
                                      </li>
                                      <li  img_id='1b64b8130b69449ae9e13dd65b8eede7'>
                                      <a imginfo="{small:'//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h',big:'//ecomgq-images.oss.aliyuncs.com/74/75/7c/31694c07b285f5492fc7bfb77ee55f2d9b0.jpg?1430497616#h'}" href="Javascript: void(0)" target="_blank">
                                      <img src="//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h" width="60" height="60" />
                                      </a>
                                      </li>      <li  img_id='1b64b8130b69449ae9e13dd65b8eede7'>
                                      <a imginfo="{small:'//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h',big:'//ecomgq-images.oss.aliyuncs.com/74/75/7c/31694c07b285f5492fc7bfb77ee55f2d9b0.jpg?1430497616#h'}" href="Javascript: void(0)" target="_blank">
                                      <img src="//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h" width="60" height="60" />
                                      </a>
                                      </li>
                                      <li  img_id='1b64b8130b69449ae9e13dd65b8eede7'>
                                      <a imginfo="{small:'//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h',big:'//ecomgq-images.oss.aliyuncs.com/74/75/7c/31694c07b285f5492fc7bfb77ee55f2d9b0.jpg?1430497616#h'}" href="Javascript: void(0)" target="_blank">
                                      <img src="//ecomgq-images.oss.aliyuncs.com/0c/5f/1b/96c940ffcedb99e6fee951d073531c0dd93.jpg?1430497616#h" width="60" height="60" />
                                      </a>
                                      </li> */ ?>       

                                </ul>
                            </div>
                            <div  class='scrollarrow to-right' title='向右'></div>
                        </div>
                        <script>
                            window.addEvent('domready', function () { //这一段是放大镜效果，我感觉挺完整的，稍微小改动了下滚动条，没必要改了
                                var picThumbnailItems = $$('#goods-viewer .goods-detail-pic-thumbnail li a');
                                var picThumbnail = $('goods-viewer').getElement('.goods-detail-pic-thumbnail li');
                                if (!picThumbnailItems.length)
                                    return;
                                var goodsPicPanel = $('goods-viewer').getElement('.goods-detail-pic');
                                var goodsDetailPic = $('goods-viewer').getElement('.goods-detail-pic img');
                                var picscroll = $('goods-viewer').getElement('.picscroll');
                                var scrollARROW = picscroll.getElements('.scrollarrow');
                                var picsContainer = picscroll.getElement('.pics-content').scrollTo(0, 0);
                                picsContainer.store('selected', picThumbnailItems[0]);
                                var picsMain = picsContainer.getParent('.pics'); //原来的css，width=426px；我改成330了，426太长了根本不可能出滚动条
                                var picTumWidth = picThumbnail.getSize().x + picThumbnail.getPatch('margin').x;
                                if (picsMain.getSize().x < picThumbnail.getSize().x * picThumbnailItems.length)
                                    scrollARROW.addClass('visible');
                                scrollARROW.setStyles('display:block'); //add by cq
                                var carousel = new Switchable(document.getElement('.picscroll'), {
                                    effect: 'scrollx',
                                    autoplay: false,
                                    steps: (picsMain.getSize().x / picTumWidth).toInt(),
                                    prev: '.to-left',
                                    next: '.to-right',
                                    hasTriggers: false,
                                    viewSize: [picsMain.getSize().x, 60],
                                    content: '.pics-content',
                                    panels: 'li[img_id]',
                                    circular: false,
                                    haslrbtn: true,
                                    disableCls: 'disable',
                                    lazyDataType: 'img'
                                });
                                picThumbnailItems.each(function (item) {
                                    /*预加载 中图*/
                                    var _img = new Image();
                                    var rs = JSON.decode(item.get('imginfo'));
                                    if (rs)
                                        _img.src = rs['small'];
                                });
                                picThumbnailItems.addEvents({
                                    'click': function (e) {
                                        e.stop();
                                        this.fireEvent('selected');
                                    },
                                    'mouseenter': function () {
                                        if (this.getParent('li').hasClass('current'))
                                            return;
                                        var imginfo = JSON.decode(this.get('imginfo'));
                                        goodsDetailPic.src = imginfo['small'];
                                    },
                                    'mouseleave': function () {
                                        if (this.getParent('li').hasClass('current'))
                                            return;
                                        picsContainer.retrieve('selected').fireEvent('selected', 'noclick');
                                    },
                                    'selected': function (noclick) {

                                        var _td = this.getParent('li');
                                        if (_td.hasClass('current') && !noclick)
                                            return;
                                        picsContainer.retrieve('selected').fireEvent('unselect');
                                        _td.addClass('current');
                                        var imginfo = JSON.decode(this.get('imginfo'));
                                        goodsDetailPic.src = imginfo['small'];
                                        goodsPicPanel.set('bigpicsrc', imginfo['big']);
                                        picsContainer.store('selected', this);
                                    },
                                    'unselect': function () {
                                        this.getParent('li').removeClass('current');
                                    }, 'focus': function () {
                                        this.blur();
                                    }
                                });
                                picThumbnailItems[0].fireEvent('selected');
                                var imageZoom = {
                                    viewSize: {
                                        width: 400,
                                        height: 300,
                                        margin: 20
                                    },
                                    init: function (img, panels) {
                                        this.image = $(img);
                                        this.panels = $(panels);
                                        this.bigImageSize = {width: 800, height: 800};
                                        this.imgRegion = this.image.getCoordinates();
                                        this.bindUI();
                                    },
                                    setEv: function (ev) {
                                        this._ev = ev;
                                    },
                                    bindUI: function () {
                                        this.image.addEvents({
                                            'mouseenter': function (e) {
                                                this.setEv(e);
                                                this.bigImageSrc = this.panels.get('bigpicsrc');
                                                $(document.body).addEvent('mousemove', this.setEv.bind(this));
                                                if (!this.viewer)
                                                    this.createElem();
                                                this.createViewer().show();
                                            }.bind(this),
                                            'mouseleave': function () {
                                                $(document.body).removeEvent('mousemove', this.setEv);
                                            }.bind(this)
                                        });
                                    },
                                    createElem: function () {
                                        var obj = {'viewer': 'goods-pic-magnifier-viewer', 'lens': 'goods-pic-magnifier', 'bigImage': this.bigImageSrc};
                                        for (var z in obj) {
                                            if ('bigImage' == z)
                                                this[z] = new Element('img', {'src': obj[z]}).inject(this['viewer']);
                                            else
                                                this[z] = new Element('div', {'class': obj[z]}).inject(document.body);
                                        }
                                    },
                                    createViewer: function () {
                                        this.setViewerRegion();
                                        new Asset.image(this.bigImageSrc, {onload: function (img) {
                                                this.bigImageSize = {width: 800, height: 800};
                                                this.bigImage.set('src', this.bigImageSrc).setStyles(this.bigImageSize);
                                                this.setViewerRegion();
                                                this.onMouseMove();
                                            }.bind(this)});
                                        return this;
                                    },
                                    setViewerRegion: function () {
                                        var region = this.imgRegion, left = region.left + region.width + this.viewSize.margin;
                                        this.lensSize = {}, viewSize = {};
                                        ['width', 'height'].each(function (v, i) {
                                            viewSize[v] = this.viewSize[v] || region[v];
                                            this.lensSize[v] = Math.min(Math.round(viewSize[v] * region[v] / this.bigImageSize[v]), region[v]);
                                        }, this);
                                        this.lens.setStyles(this.lensSize);
                                        this.viewer.setStyles({left: left, top: region.top, 'width': viewSize['width'], 'height': viewSize['height']});
                                    },
                                    onMouseMove: function () {
                                        var lens = this.lens, ev = this._ev, region = this.imgRegion,
                                                rl = region.left, rt = region.top, rw = region.width, rh = region.height,
                                                bigImageSize = this.bigImageSize, lensOffset, x = ev.page.x, y = ev.page.y;
                                        if (x > rl && x < rl + rw && y > rt && y < rt + rh) {
                                            lensOffset = this.getLensOffset();
                                            if (lens)
                                                lens.setStyles(lensOffset);
                                            this.bigImage.setStyles({'left': -Math.round((lensOffset.left - rl) * bigImageSize.width / rw),
                                                'top': -Math.round((lensOffset.top - rt) * bigImageSize.height / rh)
                                            });
                                        } else {
                                            this.hide();
                                        }
                                    },
                                    getLensOffset: function () {
                                        var region = this.imgRegion, ev = this._ev,
                                                lens = {'left': ev.page.x - this.lensSize.width / 2,
                                                    'top': ev.page.y - this.lensSize.height / 2},
                                        obj = {'left': 'width', 'top': 'height'};
                                        for (var z in obj) {
                                            if (lens[z] <= region[z]) {
                                                lens[z] = region[z];
                                            } else if (lens[z] >= region[obj[z]] + region[z] - this.lensSize[obj[z]]) {
                                                lens[z] = region[obj[z]] + region[z] - this.lensSize[obj[z]];
                                            }
                                        }
                                        return lens;
                                    },
                                    show: function () {
                                        $$(this.viewer, this.lens).setStyle('visibility', 'visible');
                                        this.onMouseMove();
                                        document.body.addEvent('mousemove', this.onMouseMove.bind(this));
                                    },
                                    hide: function () {
                                        $$(this.viewer, this.lens).setStyle('visibility', 'hidden');
                                        document.body.removeEvent('mousemove', this.onMouseMove);
                                    }
                                };
                                imageZoom.init(goodsPicPanel.getElement('img'), goodsPicPanel);
                                window.addEvent('resize', function () {
                                    imageZoom.init(goodsPicPanel.getElement('img'), goodsPicPanel);
                                });
                            });
                        </script>
                    </div>
                    <div class="goods-rightbox rightBoxModi" style="width: 770px;">
                        <!--商品基本信息区块-->
                        <h2 class="goodsname goodsnameModi" id="h5o-2" title="<?= Html::encode($desc['name']) ?>"><?= Html::encode($desc['name']) ?></h2><span class="viebuy viebuyModi"></span>
                        <li class="goods-brief" style="padding-left:10px;color: #999999;"><em><?= Html::encode($desc['shortDescription']) ?></em></li>
                        <div class="basic-info list clearfix">                          
                            <ul class="goods-info-list">
                                <?php if($data['salesType']!=1&&$data['salesType']!=2):?>
                                <li>
                                    <span class="tag-label" style="background-color:#336600;color:#fff; padding:3px;margin-right: -4px;">产地直销</span>
                                    <span class="tag-label" style="background-color:#ffbf00;color:#fff; padding: 3px 13px;">自贸</span>
                                </li>
                                <?php endif;?>
                                <?php /*<li style="background-color:#eee;padding: 5px;">
                                    <span class="tag-label" style="color:#000;">此产品为跨境贸易产地直销产品，如需购买按照中国标准生产的产品请选购产品试用生产标准国别为 “中国” 的产品</span>
                                </li>*/?>
                                <li><span>商品编号：</span><em class="infoModi"><?= Html::encode($data['id']) ?></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                    <span>商品货号：</span><em id="goodsBn" updatespec="text_bn" class="infoModi"><?= Html::encode($data['partNumber']) ?></em></li>                                    
                                <li class="list-item"><span>市 场 价：</span><del class="mktprice1"><em updatespec="mktprice" class="listprice">
                                            <?php
                                            if ($listprice & is_array($listprice) && $listprice[0])
                                            {
                                                foreach ($listprice as $k => $arr):
                                                    if ($arr['currency'] == '' || $arr['currency'] == 'CNY')
                                                        if ($arr['minPrice'] && $arr['maxPrice'] && $arr['minPrice'] != $arr['maxPrice']):
                                                            ?>
                                                            ￥<?= Html::encode($arr['minPrice']) ?> - <?= Html::encode($arr['maxPrice']) ?>
                                                        <?php elseif ($arr['price']): ?>
                                                            ￥<?= Html::encode($arr['price']) ?>                                      
        <?php  endif;
    endforeach;
}
?></em></del></li>
                                <li class="list-item"><span>价格：</span>
                                    <em class="goodsprice" updatespec="updateprice">
                                        <?php
                                        if ($offerprice & is_array($offerprice) && $offerprice[0])
                                        {
                                            foreach ($offerprice as $k => $arr):
                                                if ($arr['currency'] == '' || $arr['currency'] == 'CNY')
                                                    if ($arr['minPrice'] && $arr['maxPrice'] && $arr['minPrice'] != $arr['maxPrice']):
                                                        ?>
                                                        ￥<?= Html::encode($arr['minPrice']) ?> - <?= Html::encode($arr['maxPrice']) ?>
            <?php elseif ($arr['price']): ?>
                                                        ￥<?= Html::encode($arr['price']) ?>                                      
        <?php  endif;
    endforeach;
}
?>
                                    </em>     <!--   税率和税额 -->
                                    <input type="hidden" name="offergoodsprice" id="offergoodsprice" value="<?= Html::encode(isset($offerprice[0]['price'])?$offerprice[0]['price']:0);?> ">
                                    <input type="hidden" name="listgoodsprice" id="listgoodsprice" value="<?= Html::encode(isset($listprice[0]['price'])?$listprice[0]['price']:0); ?> ">
                                    <ul <?php if($data['salesType']==1||$data['salesType']==2):?>style="display:none"<?php endif;?>>
                                        <li><span>&nbsp;&nbsp;&nbsp;进口税:</span><span style="text-decoration: line-through;" id="tax"><?= Html::encode(isset($tax['taxRate']) ? $tax['taxRate'] * 100 : "0") ?>%</span><!--<span style="text-decoration: line-through;">￥25</span> 现在只有税率，先显示税率，等接口确认好再加-->
                                            | 进口税不超过50元免征
                                            <a href="<?= Url::to(['article/page', 'view' => 'sl']); ?>" target="_blank"><span style="color:#e5393c">（进口税细则）</span></a>
                                        </li>
                                    </ul>                 
                                </li><li class="list-item" style="margin-bottom:10px"><span>配送：</span>    <div class="tb-postAge">
                                        <div class="tb-postAge-add">
                                            <span id="J_deliveryAdd" class="tb-deliveryAdd deliveryAddModi">上海市</span>
                                            <span style="float:left">至</span>
                                            <a id="J_dqPostAgeCont" class="tb-postAgeCont deliveryAddModi" code="<?= Html::encode(isset($stateCode) ? $stateCode : "330000") ?>" parent="1" href="javascript:void(0);"><?= Html::encode(isset($stateName) ? $stateName : "上海") ?></a>
                                            <input type="hidden" name="code" id="stateCode" value="<?= Html::encode(isset($stateCode) ? $stateCode : "330000") ?>"/>
                                        </div>
                                    <?php /* 快递计算暂无<div id="J_PostageToggleCont" class="tb-postAge-info">
                                      <span>圆通快递：12</span>
                                      </div> */ ?>

                                    </div></li>   <?php /*  <li class="list-item"><span>月销量：</span><em class="mon_sell "><em class="color_3355aa evaluation"><?= Html::encode($data['salesVolumn']) ?></em>件</em>
<?php /* <div class="star-div goods-point clearfix" id="goods-point"><span class="flt font-black">评价：</span>
  <ul class="fl">
  <li class="star4"> </li>
  </ul>
  <em class="fl color_3355aa evaluation">0.00分(累计评价<a href="http://www.ftzmall.com.cn/product-1585.html#consult" onclick="new Fx.Scroll(document, {onComplete:function(){$$( & #39; li[data - tab - type = goodsdiscuss] & #39; )[0] & amp; & amp; $$( & #39; li[data - tab - type = goodsdiscuss] & #39; )[0].fireEvent( & #39; click & #39; ); }}).toElement( & #39; goodsDetailMain & #39; ); return false;">0</a>)</em>

  </div> 
                                </li>*/ ?>     
                            </ul>
                             <!--<script type="text/javascript"> //这块貌似是更多卖家的选择= =，但是全局搜没搜到这个id= =，先注释了，对页面占时没影响
                                //new AutoSize('.goods-info-list .list-item');
                                window.addEvent('domready', function() {
                                var obj = $E('#J_PromoBox .tb-arrow') || '';
                                        if (obj)
                                        obj.addEvents({
                                        mouseover: function() {
                                        var p_obj = $('J_MoreMjsSlider') || '';
                                                if (p_obj)
                                                p_obj.setStyle('display', 'block');
                                        },
                                                mouseleave: function() {
                                                var p_obj = $('J_MoreMjsSlider') || '';
                                                        if (p_obj)
                                                        p_obj.setStyle('display', 'none');
                                                }
                                        });
                                });
                            </script>-->
                            <!--商品基本信息区块结束-->

                            <!--商品促销-->
                            <!--商品促销结束-->
                        </div>

                        <!--================================== 购买区域 开始 ==============================-->
                        <div class="product_buy_left">
                            <div class="goods-buy-area">
                                <!--规格开始-->
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
                                                                    if ($arr['assignedValue'] == null) //后台没有传默认值的情况下，现在默认选中第一个
                                                                    {
                                                                        foreach ($arr['possibleValues'] as $k => $possiblearr)
                                                                        {
                                                                            if ($k == 0):
                                                                                ?>
                                                                                <li>                                                                    
                                                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?> selected"> 
                                                                                <?php if ($possiblearr['image'] != NULL) : ?>
                                                                                            <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($possiblearr['displayValue']) ?>" title="<?= Html::encode($possiblearr['displayValue']) ?>" width="30" height="30">  
                                                                                <?php else : ?> 
                                                                                            <span><?= Html::encode($possiblearr['displayValue']) ?></span>     
                                                                                <?php
                                                                                endif;
                                                                                ?>                                                          
                                                                                        <i title="点击取消选择">&nbsp;</i> </a>
                                                                                </li>
                                                                                <input type="hidden" name="<?= Html::encode($arr['key']) ?>" value="<?= Html::encode($possiblearr['key']) ?>" id="defining"><!--value为$arr['assignedValue']现在没有-->
                                                                                    <?php else: ?>
                                                                                <li>                                                                    
                                                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?>"> 
                                                                                <?php if ($possiblearr['image'] != NULL) : ?>
                                                                                            <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($possiblearr['displayValue']) ?>" title="<?= Html::encode($possiblearr['displayValue']) ?>" width="30" height="30">  
                                                                                <?php else : ?> 
                                                                                            <span><?= Html::encode($possiblearr['displayValue']) ?></span>     
                                                                                <?php
                                                                                endif;
                                                                                ?>                                                          
                                                                                        <i title="点击取消选择">&nbsp;</i> </a>
                                                                                </li>
                                                                                <?php
                                                                                endif;
                                                                            }
                                                                        }
            
                                                                    else
                                                                    {
                                                                        foreach ($arr['possibleValues'] as $k => $possiblearr)
                                                                        {                                                                          
                                                                            if ($arr['assignedValue']['key'] == $possiblearr['key']):
                                                                                ?>
                                                                                <li>                                                                    
                                                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?> selected"> 
                                                                                <?php if ($possiblearr['image'] != NULL) : ?>
                                                                                            <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($possiblearr['displayValue']) ?>" title="<?= Html::encode($possiblearr['displayValue']) ?>" width="30" height="30">  
                                                                                <?php else : ?> 
                                                                                            <span><?= Html::encode($possiblearr['displayValue']) ?></span>     
                                                                                <?php
                                                                                endif;
                                                                                ?>                                                          
                                                                                        <i title="点击取消选择">&nbsp;</i> </a>
                                                                                </li>
                                                                                <input type="hidden" name="<?= Html::encode($arr['key']) ?>" value="<?= Html::encode($possiblearr['key']) ?>" id="defining"><!--value为$arr['assignedValue']现在没有-->
                                                                                    <?php else: ?>
                                                                                <li>                                                                    
                                                                                    <a href="javascript:void(0);" id="<?= Html::encode($possiblearr['key']) ?>" class="<?= Html::encode($arr['key']) ?>"> 
                                                                                <?php if ($possiblearr['image'] != NULL) : ?>
                                                                                            <img src="<?= Html::encode($possiblearr['image']) ?>" style="margin-right:0px; margin-top:0px;" alt="<?= Html::encode($possiblearr['displayValue']) ?>" title="<?= Html::encode($possiblearr['displayValue']) ?>" width="30" height="30">  
                                                                                <?php else : ?> 
                                                                                            <span><?= Html::encode($possiblearr['displayValue']) ?></span>     
                                                                                <?php
                                                                                endif;
                                                                                ?>                                                          
                                                                                        <i title="点击取消选择">&nbsp;</i> </a>
                                                                                </li>
                                                                                <?php
                                                                                endif;
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </ul>                                                    
                                                        </div>
                                                    </div>
                                            <?php
                                                endforeach;
                                            }
                                            ?>                                                     
                                        </div>
                                        <input type="hidden" name="skuMapValue" value="" id="skuMapValue">
                                        <input type="hidden" name="skuMapId" value="" id="skuMapId">
                                        <input type="hidden" name="skuMapContent" value="" id="skuMapContent">
                                    </div>
                                </div>


                                <div class="buyinfo clearfix">
                                    <label>数量：</label>
                                    <ul style="float: left;">
                                        <li>
                                            <div class="Numinput numinputModi">
                                                <span class="substract"></span>
                                                <span class="plus"></span>
                                                <input type="text" value="1" size="5" name="goodsnum" min="0" class="Num" id="Num">
                                                <div style="display:none;" class="numadjust-arr"><span class="numadjust increase"></span> <span class="numadjust decrease"></span></div>
                                            </div>
                                        </li>
                                        <li></li>
                                        <li>
                                            <span style="display:block;">&nbsp;&nbsp;(剩余数量:        <span class="store" updatespec="text_store" id="inventory"></span> 件)
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <!--================================== 购买 按钮 ==============================-->   
                                <script>
                                    var keyCodeFix = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 8, 9, 46, 37, 39];
                                    /*购买数量调节*/
                                    var getStore = function () {
                                        return parseInt(jQuery('#goods-viewer .buyinfo .store').text());
                                    }; //三木符号后面的是获取剩余数量            

                                    /*目前不使用
                                     jQuery('#goods-viewer .buyinfo .numadjust').extend('click', function(e) {
                                     var countText = jQuery('#goods-viewer .buyinfo input[name^=goods[num]');                                      
                                     if (this.hasClass('increase')) {
                                     countText.attr('value', (countText.value.toInt() + 1).limit(1, getStore()));
                                     } else {
                                     countText.attr('value', (countText.value.toInt() - 1).limit(1, getStore()));
                                     }
                                     this.blur();
                                     }); 
                                     */
                                    var getMaxBuy = function(){
                                        var maxtotal= 1000;
                                        var price   = jQuery("input[name='offergoodsprice']").val();
                                        var maxbuy  = price>maxtotal?1:parseInt(maxtotal/price,10);
                                        return maxbuy;
                                    }
                                    
                                    jQuery('#goods-viewer .buyinfo input[name="goodsnum"]').on({
                                        'keydown': function (e) {                                         
                                            console.log(e.keyCode);
                                            return;
                                            //这里应该是判定这个按下的键合法不合法，不合法停止掉 return 下方为原来写法
                                            if (!keyCodeFix.contains(e.code)) {
                                                e.stop();
                                            }
                                        },
                                        "keyup": function () {
                                            if(!getStore()){
                                                this.value = 0;
                                                return;
                                            }
                                            this.value = parseInt(this.value);                                         
                                            if (getStore() < this.value)
                                                this.value = getStore();
                                            if (<?= Yii::$app->params['cart']['maxbuy'];?> < this.value)
                                                this.value = <?= Yii::$app->params['cart']['maxbuy'];?>;
                                                
                                            <?php if($data['salesType']!=1&&$data['salesType']!=2):?>                                        
                                            var maxbuy = getMaxBuy();
                                            if(maxbuy < this.value){
                                                jQuery('#goods-viewer .Num').attr('value', maxbuy);                                                
                                                Message.error('订单金额不能大于1000');
                                            }
                                            <?php endif;?>
                                            if (!this.value || this.value == 'NaN' || this.value < 1)
                                                this.value = 1;

                                        },
                                        'blur': function () {
                                            this.value = parseInt(this.value);
                                            if (!this.value || this.value == 'NaN' || this.value < 1)
                                                    this.attr('value') = 1;
                                        }
                                    });

                                    jQuery('#goods-viewer .substract').click(function (e) { //减
                                        var val = jQuery('#goods-viewer .Num').attr('value');
                                        if (val != 1 && val != 0)
                                        {
                                            var vals = parseInt(val) - 1;
                                            jQuery('#goods-viewer .Num').attr('value', vals);
                                        }
                                    });

                                    jQuery('#goods-viewer .plus').click(function (e) { //加，最多57
                                        var val = jQuery('#goods-viewer .Num').attr('value');
                                        var store = getStore();
                                        var freez = '0';
                                        var nostore_sell = '0';
                                        if (nostore_sell != 0) //没有定义store 的情况下，最多9999
                                        {
                                            if (val < <?= Yii::$app->params['cart']['maxbuy'];?>) {
                                                var vals = parseInt(val) + 1;
                                                jQuery('#goods-viewer .Num').attr('value', vals);
                                            }
                                        }
                                        else
                                        {
                                            var storeNum = store - freez;
                                            var vals = parseInt(val) + 1;
                                            if (val < storeNum && val < <?= Yii::$app->params['cart']['maxbuy'];?>)
                                            {
                                                jQuery('#goods-viewer .Num').attr('value', vals);
                                            }
                                        }
                                                                              
                                        <?php if($data['salesType']!=1&&$data['salesType']!=2):?>                                        
                                            var maxbuy = getMaxBuy();
                                            if(maxbuy < vals){
                                                jQuery('#goods-viewer .Num').attr('value', maxbuy);
                                                Message.error('订单金额不能大于1000');
                                            }
                                        <?php endif;?>
                                        
                                    });
                                </script>
                                <!--购买数量结束-->
                                <!--购买按钮-->
                                <div class="hightline">
                                    <input type="hidden" name="goods[goods_id]" value="1446">
                                    <input type="hidden" name="goods[pmt_id]" value="">
                                    <input type="hidden" name="goods[product_id]" value="">
                                    <div class="btnBar clearfix" style="position:relative;">
                                        <div class="flt btnwrap btnwrapModi">
                                            <!--页面按钮service形式 start -->
                                            <input class="actbtn btn-fastbuy" id="btn_lj" value="立即购买" type="button" title="" style="cursor: pointer;">
                                            <script>
                                                function createFormParam(PARAMS, temp, prename) {
                                                    for (var x in PARAMS) {
                                                        var nowname = prename ? prename + '[' + x + ']' : x;
                                                        if (typeof (PARAMS[x]) == 'object') {
                                                            temp = createFormParam(PARAMS[x], temp, nowname);
                                                        } else {
                                                            var opt = document.createElement("textarea");
                                                            opt.name = nowname;
                                                            opt.value = PARAMS[x];
                                                            temp.appendChild(opt);
                                                        }
                                                    }
                                                    return temp;
                                                }

                                                function post(URL, PARAMS) {
                                                    var temp = document.createElement("form");
                                                    temp.action = URL;
                                                    temp.method = "post";
                                                    temp.style.display = "none";
                                                    temp = createFormParam(PARAMS, temp, '');
                                                    document.body.appendChild(temp);
                                                    temp.submit();
                                                    return temp;
                                                }

                                                window.addEvent('domready', function () {
                                                    buyljBtn = $('btn_lj');
                                                    if (buyljBtn)
                                                        buyljBtn.store('tip:text', '');    //看不懂                                       
                                                    if (buyljBtn) //创建一个立即购买的按键？
                                                        new Tips(buyljBtn, {
                                                            showDelay: 0,
                                                            hideDelay: 0,
                                                            className: 'cantbuy',
                                                            onShow: function (tip) {
                                                                if (!tip.getElement('.tip-text') || !tip.getElement('.tip-text').get('text')) {
                                                                    buyljBtn.setStyle('cursor', 'pointer');
                                                                    return tip.setStyle('visibility', 'hidden');
                                                                } else {
                                                                    buyljBtn.setStyle('cursor', 'not-allowed');
                                                                }

                                                                tip.setStyle('visibility', 'visible');
                                                            }
                                                        });
                                                    if (buyljBtn) { //检查是否有漏选选项（规格？我没找到有选规格的product页）
                                                        buyljBtn.removeEvent('click');
                                                        buyljBtn.addEvent('click', function (e) {
                                                            var msg = '请选择规格：';
                                                            var specCheck = false;
                                                            if ($$('.spec-item.specItem')) {
                                                                $$('.spec-item.specItem').each(function (item, index) {
                                                                    var spec_label = item.getChildren('div.spec-label');
                                                                    label = spec_label[0].getChildren('span');
                                                                    //console.log(aa);
                                                                    var specName = label[0].firstChild.innerHTML;
                                                                    var spec_values = item.getChildren('div.spec-values');
                                                                    var specValue = spec_values[0].getChildren('ul');
                                                                    var specOne = false;
                                                                    specValue[0].getChildren('li').each(function (el) {
                                                                        if (el.getChildren('a.selected').length != 0) {
                                                                            specOne = true;
                                                                        }
                                                                    });
                                                                    if (!specOne) {
                                                                        if (msg == '请选择规格：') {
                                                                            msg = msg + specName;
                                                                        } else {
                                                                            msg = msg + ',' + specName;
                                                                        }
                                                                        specCheck = true;
                                                                    }

                                                                });
                                                            }
                                                            if (specCheck) { //如果check有问题，跳报错
                                                                Message.error(msg);
                                                            }
                                                            else
                                                            { //如果没有问题，把数据post到别的页面
                                                                msg = '';
                                                                e.stop();
                                                                this.blur();
                                                                if (this.retrieve('tip:text'))
                                                                    return false;
                                                                var form = buyljBtn.getParent('form');
                                                                var backup = form.action;
                                                                var sign = false;
                                                                var skuMapValue = jQuery("input[name='skuMapValue']").val(); //productid数量什么的也这样读
                                                                var skuMapId = jQuery("input[name='skuMapId']").val();
                                                                var offergoodsprice = jQuery("input[name='offergoodsprice']").val();
                                                                var listgoodsprice = jQuery("input[name='listgoodsprice']").val();
                                                                var userId = "<?= $userId; ?>";
                                                                if (!userId)
                                                                {
                                                                    window.location.href = '<?= Url::to(['login/index']); ?>';
                                                                    return false;
                                                                }
                                                                if (!skuMapValue)
                                                                {
                                                                    Message.error("加入购物车失败.<br /><ul><li>请选择规格参数</li></ul>");
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
                                                                            "channelType": <?= Yii::$app->params['platform'];?> , //购物车来源类型,app,pc,wechat等,required
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
                                                                            "isGift": "0",
                                                                            "cartlineId": null,
                                                                        },
                                                                    },
                                                                });
                                                                console.log(params);
                                                                post('<?= Url::to(['cart/checkout']); ?>', params);

                                                            }
                                                        });
                                                    }
                                                });</script>    

                                            <input id="cartBtn" class="actbtn btn-buy updateBtn" value="加入购物车" type="submit">

<!--<input class="btn-hui btnhuiModi activityIcon" updatespec="notify" value="已售罄" type="button" style="display:none;">                                          
<input id="notice" class="actbtn btn-notify" updatespec="notify" value="缺货登记" type="submit" data-tip="您当前要购买的商品暂时缺货,点击进入缺货登记页." style="display: none;">
<script>
    (function() { //缺货登记跳转product-gnotify页,估计还是会用activeform传回productId就行了
    var url = "<?= Yii::$app->params['baseUrl'] ?>product-gnotify.html",
        notifyBtn = $('goods-viewer').getElement('.btn-notify');
        if (!notifyBtn)
        return;
        notifyBtn.addEvent('click', function(e) {
        var _tmpFormAction = this.form.action;
            e.stop();
            this.blur();
            this.form.action = url;
            this.form.submit();
            this.form.action = _tmpFormAction;
        });
    })();
</script>
                                            <!--页面按钮service形式 end -->
                                        </div>
                                        <div id="mini-cart-dialog" class="popup-container mini-cart-dialog goodstc1" style="display: none; top:64px;position:absolute;">
                                            <div class="popup-body">
                                                <div class="popup-header clearfix">
                                                    <h2>成功加入购物车</h2>
                                                    <span><button type="button" title="关闭" class="popup-btn-close" hidefocus="">x</button></span>
                                                </div>
                                                <div class="popup-content clearfix"><div class="CartInfoItems textcenter clearfix">
                                                        <p class="p10">目前选购商品共 <span class="font-red" id="type_num">1</span> 种 <span class="font-red" id="product_num">1</span> 件&nbsp;&nbsp;合计: <span class="font-red" id="price">￥99.00</span></p>
                                                        <div class="btnBar clearfix min-btn">
                                                            <a class="popup-btn-close btn-a"><span>继续购物</span></a>
                                                                                                                            <a class="rela_addcart buy-select hasSpec min-mal fr" href="<?= Url::to(['cart/']); ?>"><!--<i class="has-icon"> <img src='/app/b2c/statics/bundle/shop_icon.gif' /></i>-->进入购物车</a>
                                                        </div>
                                                    </div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!--购买按钮结束-->
                            </div>
                            <!-- class="CartNav-icon1 " -->

                            <?php /* <!--商城积分-->
                              <ul class="tb-meta metaModi">
                              <li>
                              <ul class="tb-meta tb-serUnified tm-clear">
                              <li>
                              <span class="tb-metatit">
                              <a target="_blank" href="javascript:void(0);">商城积分</a>
                              </span>送
                              <em id="J_EmPoint" class="tb-serIntegral">0</em>
                              </li>
                              </ul>
                              </li>
                              </ul>
                              <ul class="cart-coll-ul">
                              <li class="star-off btn-bj-hover" title="<?= Html::encode($desc['name']) ?>">
                              <a href="<?= Yii::$app->params['baseUrl'] ?>passport-login.html" class="btn-fav collect-cart no-unl">
                              <span><div class="fav">收藏</div><div class="nofav">已收藏</div></span>
                              </a>
                              </li>
                              </ul>
                              <!--商城积分--> */ ?>

                            <!--分享开始-->
                            <div class="share" style="display:none;"></div>
                            <!--                             JiaThis Button BEGIN 
                                                        <div id="ckepop"> <span class="jiathis_txt">分享到：</span>
                                                            <a class="jiathis_button_douban" title="分享到豆瓣"><span class="jiathis_txt jtico jtico_douban"></span></a>
                                                            <a class="jiathis_button_renren" title="分享到人人网"><span class="jiathis_txt jtico jtico_renren"></span></a>
                                                            <a class="jiathis_button_tqq" title="分享到腾讯微博"><span class="jiathis_txt jtico jtico_tqq"></span></a>
                                                            <a class="jiathis_button_tsina" title="分享到新浪微博"><span class="jiathis_txt jtico jtico_tsina"></span></a>
                                                            <a class="jiathis_button_kaixin001" title="分享到开心网"><span class="jiathis_txt jtico jtico_kaixin001"></span></a>
                                                            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank">更多</a> <a class="jiathis_counter_style"><span class="jiathis_button_expanded jiathis_counter jiathis_bubble_style" id="jiathis_counter_31" title="累计分享1次">1</span></a>
                                                        </div>-->
                        </div>
<!--                        <script type="text/javascript" >
                                    var jiathis_config = {
                                    data_track_clickback:true,
                                            summary:"",
                                            shortUrl:false,
                                            hideMore:false
                                    }
                        </script>
                        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1824661" charset="utf-8"></script>-->

                        <!-- JiaThis Button END --> 
                        <!--分享结束-->



                        <!--================================== 配件 开始===============================-->                        
                    </div>
                </form>

<?php if ($associationProducts & is_array($associationProducts)): ?>           
                    <div id="ald-skuRight" class="ald-skuRight seeModi" style="width:1190px;margin-top: 10px;">
                        <div class="ald ald-03054">
                            <div class="ald-inner">
                                <div class="ald-hd">
                                    <span>推荐产品</span>
                                </div>
                                <div class="ald-carousel">
                                    <div class="wrapCon" style="position: relative;">
                                        <ul class="ald-switchable-content" style="position:absolute;width:1100px;margin:0"><!--这个貌似是竖着滚的，不知道为什么长度给了2000-->
    <?php
    if ($associationProducts & is_array($associationProducts))
    {
        foreach ($associationProducts as $k => $arr):
            ?>
                                                    <li class="ks-switchable-panel-internal963" img_id="" style="display: block;">
                                                        <div class="shadow">
                                                            <a href="<?= Url::to(['product/view', 'id' => $arr["catentryId"]]); ?>" class="ald-03054-act" target="_blank">
                                                                <img style="height:112px;width:112px" src="<?= Html::encode($arr['desc']['fullImage']) ?>">
                                                            </a>
                                                            <p class="look_name"><?= Html::encode($arr['desc']['name']) ?></p>

                                                            <p class="look_price"><?php
                                                    if ($arr['priceInfo'] & is_array($arr['priceInfo']))
                                                    {
                                                        foreach ($arr['priceInfo'] as $k => $pricearr):
                                                            if ($pricearr['currency'] == '' || $pricearr['currency'] == 'CNY')
                                                                if ($pricearr['minPrice'] && $pricearr['maxPrice'] && $pricearr['minPrice'] != $pricearr['maxPrice']):
                                                                    ?>
                                                                                ￥<?= Html::encode($pricearr['minPrice']) ?> - <?= Html::encode($pricearr['maxPrice']) ?>
                        <?php elseif ($pricearr['price']): ?>
                                                                                ￥<?= Html::encode($pricearr['price']) ?>                                      
                    <?php  endif;
                endforeach;
            }
            ?></p>
                                                        </div>
                                                    </li>
        <?php endforeach;
    } ?>
                                            <?php /*测试的时候请打开<li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1450.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/c2/89/e0/709387b38a75ad5bd4dc109e9102fe76abc.jpg?1430497648#h">
                                              </a>
                                              <p class="look_name">刺身优惠二 海鲜组合 450±20g/4盒</p>
                                              
                                              <p class="look_price">￥138.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1449.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/4c/5d/ac/5420a29b0bedc56c4acd2480d92501b38bd.jpg?1430497468#h">
                                              </a>
                                              <p class="look_name">俄罗斯 北极小甜虾 20尾/盒</p>
                                              
                                              <p class="look_price">￥32.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1448.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/03/2a/b8/87a6eedfd7e039d74a99d8a85dadf17dd3e.jpg?1430497432#h">
                                              </a>
                                              <p class="look_name">俄罗斯 特大牡丹虾 大于100g/对</p>
                                              
                                              <p class="look_price">￥88.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1447.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/5e/60/27/3d00e13fae1a7cdc7ffc632a8832241a750.jpg?1430497393#h">
                                              </a>
                                              <p class="look_name">加拿大 超大北极贝 100±5g/盒</p>
                                              
                                              <p class="look_price">￥48.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1445.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/cc/43/19/f612124579c539de5b49101491a0e6aebe6.jpg?1430497364#h">
                                              </a>
                                              <p class="look_name">俄罗斯 美味鲷鱼刺身 150±10g/盒</p>
                                              
                                              <p class="look_price">￥28.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1444.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/46/83/95/25b7622fb9619899601a65af1a2132af3ac.jpg?1430497579#h">
                                              </a>
                                              <p class="look_name">中国台湾 金兰皇家松露低盐固态发酵酱油（酿造酱油） 500ml/瓶</p>
                                              
                                              <p class="look_price">￥88.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" img_id="" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1443.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/51/66/84/67a8e535e6c54e064ad38465e7cca42e2f9.jpg?1430497325#h">
                                              </a>
                                              <p class="look_name">法罗群岛 优选金枪鱼刺身 100±5g/盒</p>
                                              
                                              <p class="look_price">￥48.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1442.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/83/6d/e8/41030675a658aa196e58e4ba444e8e9373a.jpg?1430497283#h">
                                              </a>
                                              <p class="look_name">法罗群岛 优选三文鱼鱼腩 100±5g/盒</p>             
                                              
                                              <p class="look_price">￥48.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1440.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/3d/41/01/671ea574a532a28fe2729140795eaba6279.jpg?1430497246#h">
                                              </a>
                                              <p class="look_name">法罗群岛 精选三文鱼刺身 200±5g/盒</p>
                                              
                                              <p class="look_price">￥68.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1439.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/2a/da/99/9c39c7477b3327bc2bb1ef49c096fbcbb38.jpg?1430497544#h">
                                              </a>
                                              <p class="look_name">日本 带子刺身 100±5克/盒</p>
                                              
                                              <p class="look_price">￥32.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1438.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/8d/23/84/bceceb88a40fbf891374c4241bc940e9d3d.jpg?1430497506#h">
                                              </a>
                                              <p class="look_name">俄罗斯 北极大甜虾 100±5g/盒</p>
                                              
                                              <p class="look_price">￥32.00</p>
                                              </div>
                                            </li>
                                            <li class="ks-switchable-panel-internal963" style="display: block;">
                                                <div class="shadow">
                                              <a href="http://www.ftzmall.com.cn/product-1438.html" class="ald-03054-act" target="_blank">
                                                <img style="height:112px;width:112px" src="//ecomgq-images.oss.aliyuncs.com/8d/23/84/bceceb88a40fbf891374c4241bc940e9d3d.jpg?1430497506#h">
                                              </a>
                                              <p class="look_name">俄罗斯 北极大甜虾 100±5g/盒</p>
                                              
                                              <p class="look_price">￥32.00</p>
                                              </div>
                                            </li>*/?>
                                        </ul>
                                    </div>
                                    <ul class="ald-switchable-trigger" style="display:block;left:-20px;top:75px">
                                        <li class="scrollarrow ald-switchable-prev-btn visible" style="display:none">上一个</li>
                                        <li class="scrollarrow ald-switchable-next-btn visible" style="position:absolute;left:1110px;display:none">下一个</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        window.addEvent('domready', function () {//应该是推荐产品的滚动效果，但是这个效果= =线上也没看到...
                            var picThumbnailItems = $$('#ald-skuRight .ald-switchable-content li a');
                            var picThumbnail = $('ald-skuRight').getElement('.ald-switchable-content li');
                            if (!picThumbnailItems.length)
                                // console.log(picThumbnailItems.length);
                                //是否有li= =，有几个li         
                                return;
                            var picscroll = $('ald-skuRight').getElement('.ald-switchable-trigger');
                            var scrollARROW = picscroll.getElements('.scrollarrow');
                            var picsContainer = $E('#ald-skuRight .ald-switchable-content').scrollTo(0, 0);
                            picsContainer.store('selected', picThumbnailItems[0]);
                            var picsMain = picsContainer.getParent('.wrapCon');
                            if (picThumbnailItems.length > 7)
                                    //这个语句貌似有点问题...看不懂他的逻辑       
                                    {
                                        scrollARROW.addClass('visible');
                                        scrollARROW.setStyle('display', 'block');
                                    }
                            var carousel = new Switchable(document.getElement('.ald-carousel'), {
                                effect: 'scrolly',
                                autoplay: false,
                                //steps: (picsContainer.getSize().y/picThumbnail.getSize().y).toInt(),
                                prev: '.ald-switchable-prev-btn',
                                next: '.ald-switchable-next-btn',
                                hasTriggers: false,
                                viewSize: [picsMain.getSize().y, 200],
                                content: '.ald-switchable-content',
                                panels: 'li[img_id]',
                                circular: false,
                                haslrbtn: true,
                                disableCls: 'disable',
                            });
                        });</script>
<?php endif ?>

                <!--货品列表-->
                <div style="clear:both"></div>
                <!--================================== 购买区域 结束 ==============================-->
                <!--页面body page start -->
            </div>

            <div class="ri_zhi w960" style="float:left;">
                <div class="goods-info-wrap clearfix info_modify">
                    <div style="clear:both"></div>
                    <div class="le_zhi lezhiModi">
                        <div class="goods-detail-infos" style="display:none;">
                            <div class="clearfix goods-detail-tab"><div style="float:right;"></div><ul></ul></div>
                            <div id="app_area" class="app-area goodsDetailContent">
                                <!--
                                    <div class="section pdtdetail" data-sync-type="goodspromotion" tab="促销信息 (<em>0</em>)" data-order="0">
                                      <h3 class="hd-font">促销信息</h3>
                                    </div>
                                -->
                            </div>
                        </div>

                        <div id="goodsDetailMain" class="goods-detail-infos">
                            <a id="consult"></a>
                            <div class="clearfix goods-detail-tab detailtabModi">
                                <ul>
                                    <li data-tab-type="goodsdescription" class="goodsDetailTab active" id="goods1" onclick="setTab('goods', 1, 4)"><a>详情描述</a></li>
                                            <?php /* <li data-tab-type="goodsdiscuss" class="goodsDetailTab" id="goods2" onclick="setTab('goods', 2, 4)"><a>商品评价 </a></li>
                                              <li data-tab-type="goodsconsult" class="goodsDetailTab" id="goods3" onclick="setTab('goods', 3, 4)"><a>咨询 </a></li> */ ?>
                                </ul>
                            </div>
                            <!--原捆绑商品-->
                            <div class="goodsDetailContent ">
                                <div class="pdtdetail desc1" data-sync-type="goodsdescription" tab="详情描述" data-order="1" id="con_goods_1">
                                    <div class="goodsdetails">  

                                        <ul class="goods-intro-list clearfix">
                                            <li title="">编号：<?= Html::encode($data['id']) ?></li>
                                            <li title="">货号：<?= Html::encode($data['partNumber']) ?></li>
<?php if (isset($brand['name'])) : ?>
                                                <li title="">品牌：<?= Html::encode($brand['name']) ?></li>
<?php endif ?>
                                            <li title="">价格区间：
                                                <?php
                                                if ($offerprice & is_array($offerprice))
                                                {
                                                    foreach ($offerprice as $k => $arr):
                                                        if ($arr['currency'] == '' || $arr['currency'] == 'CNY')
                                                            if ($arr['minPrice'] && $arr['maxPrice'] && $arr['minPrice'] != $arr['maxPrice']):
                                                                ?>
                                                                ￥<?= Html::encode($arr['minPrice']) ?> - <?= Html::encode($arr['maxPrice']) ?>
                                                            <?php elseif ($arr['price']): ?>
                                                                ￥<?= Html::encode($arr['price']) ?>                                      
                                                        <?php  endif;
                                                    endforeach;
                                                }
                                                ?>
                                            </li>
                                        </ul>

                                        <div class="" data-sync-type="goodsparams" tab="规格参数" data-order="1">
                                            <?php if($desc['shortDescription']!=""):?><p class="goodsIntro">商品简介：<?= Html::encode($desc['shortDescription']) ?></p><?php endif;?>
<?php
if ($descriptive & is_array($descriptive)):
?>
    <h3>规格参数</h3><ul class="goodsStandard">
<?php    foreach ($descriptive as $k => $arr):
        ?>                                                
                                                        <li>
                                            <?= Html::encode($arr['name']) ?>：<?= Html::encode($arr['value']) ?>                                                       
                                                        </li>
                                            <?php
                                        endforeach;                                  
                                    ?>
                                            </ul>
    <?php   endif; ?>
                                        </div>
                                    </div> 
                                    <div id="goods-intro" class="p10">
                                        <div>
                                            <div align="center">       
                                    <?= $desc['longDescription'] ?>                                            
                                            </div>
                                        </div>
                                    </div>

                                    <?php /* <div class="goods-intro-shop">
                                      <div style=" background:#fff; padding:10px 0">
                                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tbody>
                                      <tr>
                                      <th class="goods-introbtn" width="35%"> 现价：<span class="fontcolorRed font20px fontbold price1">￥128.00</span></th>
                                      <td width="65%" align="left">
                                      <div class="flt">
                                      <input class="actbtn btn-buy" value="加入购物车" type="submit">
                                      </div>
                                      <div class="flt" style="margin:12px 0 0 5px">
                                      <ul class="button">
                                      <li class="star-off" star="" title=""> <a href="javascript:void(0);" onclick="return false;" class="btn-a listact" rel="nofollow"><i class="has-icon"> <!-- <img src='/app/b2c/statics/bundle/collect_icon.gif' /> --></i><span>
                                      <div class="fav">收藏此商品</div>
                                      <div class="nofav">已收藏</div>
                                      </span></a>
                                      </li>
                                      </ul>
                                      </div></td>
                                      </tr>
                                      </tbody></table>
                                      </div>
                                      </div>
                                      <div class="referbox"> </div> */ ?>
                                </div>
                                <?php /* <div class="pdtdetail" data-sync-type="goodsdiscuss" tab="商品评价 " data-order="1" style="display:none" id="con_goods_2">
                                  <h3 class="hd-font">商品评论</h3>
                                  <div class="referbox">
                                  <div class="rate-toolbar" id="discuss_toolbar">
                                  <span class="rate-filter">
                                  <strong>宝贝评价</strong>
                                  <input id="discuss_hasaddition" class="rate-list-append" type="checkbox" name="append">
                                  <label for="discuss_hasaddition">查看追加 (0)</label>
                                  <input id="discuss_hascontent" type="checkbox" checked="" name="content">
                                  <label for="discuss_hascontent">有内容评价</label>
                                  </span>
                                  <span class="rate-sort">
                                  <a class="active" data-value="1" href="javascript:void(0);" title="按评价时间从近到远进行排序">
                                  <span class="rate-arrow">按时间</span></a>
                                  </span>
                                  <input type="hidden" name="orderb">
                                  </div>
                                  <div class="evalubox clearfix">
                                  <div class="evalubox-left">
                                  <div class="scores-wrap">
                                  <ul class="out">
                                  <li class="flt">商品评分</li>
                                  <li><strong>5.00</strong></li>
                                  <li>
                                  <div class="star-div flt " style="padding-top:2px;padding-top:0\9"><!--咨询页面这个地方class可调用用"star-no"-->
                                  <ul>
                                  <li class="star5"></li>
                                  </ul>
                                  </div>
                                  <span class="scores_size"></span>
                                  </li>
                                  <li style="clear:both">(共<span class="value-color">2</span>人评分)</li>
                                  </ul>
                                  </div>
                                  </div>
                                  <div class="evalubox-right">
                                  <div class="rightbox"><!--<h4>评价说明</h4>--><p></p>
                                  </div>

                                  </div>
                                  </div>
                                  <a name="discuss_all_info"></a>
                                  <div class="goods-discus-title bulelink"> 共<span id="product_discusscount" class="value-color">1</span>个用户评价&nbsp;&nbsp;<span class="all_link" style="display:none;"><a href="javascript:void(0);discuss_all_info" class="allnum">查看所有评论</a></span> </div>
                                  <div class="consult-content">
                                  <div class="consult-panel rate-grid" id="discuss_content">   <table>
                                  <tbody>
                                  <tr>
                                  <td class="col-master">
                                  <div class="rate-content">
                                  <div class="rate-fulltxt">确认晚了，周二就收到三文鱼了，供应商亲自送货，还送了酱油和芥末，服务很贴心。<br>
                                  三文鱼量很足，很大一块，下次再买。</div>
                                  </div>
                                  <div class="rate-date">15-02-05 13:21</div>
                                  </td>
                                  <td class="col-meta">
                                  <div class="rate-sku">
                                  </div>
                                  </td>
                                  <td class="col-author">
                                  <div class="rate-user-info">
                                  <span class="font-blue">moccazhang </span>&nbsp;<span></span>
                                  </div>
                                  </td>
                                  </tr>
                                  </tbody>
                                  </table>
                                  <div class="page-discuss">
                                  </div>

                                  </div>
                                  </div>

                                  </div><div id="comment_html" class="repay-box discussfloat" style="display:none;">
                                  <div class="lt"></div>
                                  <div class="rt"></div>
                                  <div class="lb"></div>
                                  <div class="rb"></div>
                                  <div class="arrw"></div>
                                  <form method="post" onsubmit="checkFormReqs(event);">
                                  <div class="review-textarea">
                                  <ul>
                                  <li class="message-login" id="repay_textarea">
                                  <p>请<a href="<?= Yii::$app->params['baseUrl'] ?>passport-login.html">登陆</a>后再留言<br>如果您不是会员请<a href="<?= Yii::$app->params['baseUrl'] ?>passport-signup.html">注册</a>!</p>
                                  <textarea type="textarea" class="x-input inputstyle font12px db mb5" disabled="true" vtype="sendcomments&amp;&amp;required" rows="5" name="comment" style="display:block;width:98%;" id="dom_el_3e0e180"></textarea>          <div class="infotips" align="right"><span class="price1">0</span>/1000</div>
                                  </li>
                                  <li>联系方式:<input autocomplete="off" class="x-input " type="text" disabled="true" required="true" size="20" name="contact" id="dom_el_3e0e181" vtype="text"><span class="infotips">(可以是电话、email、qq等)</span>
                                  </li>
                                  <li style="padding-left:0">

                                  <button class="btn" rel="_request" disabled=""> <span><span> 提 交</span></span> </button>

                                  <span style="cursor:pointer" class="link-blue" onclick="cancle();">取消回复</span>
                                  </li>
                                  </ul>
                                  </div>
                                  </form>
                                  </div></div>
                                  <div class="pdtdetail" data-sync-type="goodsconsult" tab="咨询 " data-order="1" style="display:none" id="con_goods_3">
                                  <h3 class="hd-font">商品咨询</h3>
                                  <div class="referbox">
                                  <h4 class="dis-cons-title">商品咨询</h4>
                                  <div class="goods-discus-title">
                                  <p class="flt consult-tips">对商品有什么问题，请在这里咨询吧</p><a href="javascript:void(0);write_ask" class="orangebtn allnum consult-ask"><!--<i class="has-icon"> <img  style="margin:0"src='/app/b2c/statics/bundle/pencil.gif' /></i>--><span>我要咨询</span></a>
                                  </div>
                                  <div class="consult">
                                  <ul class="consult-list clearfix">
                                  <li class="active active_type">全部咨询<span>(<em>1</em>条)</span>
                                  </li><li class="active_type">商品咨询<span>(<em>0</em>条)</span>
                                  <input type="hidden" value="1">
                                  </li>
                                  <li class="active_type">配送咨询<span>(<em>1</em>条)</span>
                                  <input type="hidden" value="2">
                                  </li>
                                  <li class="active_type">售后咨询<span>(<em>0</em>条)</span>
                                  <input type="hidden" value="3">
                                  </li>
                                  </ul>
                                  <div class="goods-discus-title bulelink"> 共<span id="product_askcount" class="value-color">1</span>人咨询&nbsp;&nbsp;<span class="all_link"><a href="javascript:void(0);ask_all_info" class="allnum ">查看所有咨询</a> </span></div>
                                  <div class="consult-content">
                                  <a name="ask_all_info"></a>
                                  <div class="consult-panel" id="consult_content"><dl>
                                  <dt class="bcolor-f8">
                                  <div class="q-icon"></div>
                                  <div class="star-no" style="float:left; padding-top:6px">
                                  <ul>
                                  <li class="star"></li>
                                  </ul>
                                  </div>
                                  <div class="flt "><span class="font-blue">匿名 </span>&nbsp;<span></span></div>
                                  <div class="floatright" style="color:#999">15-05-06 13:31</div>
                                  </dt>
                                  <dd class="bcolor-f8 pl40" style="padding-left:40px">请问是冷链配送？上海市区是否当日发货，当日送达？
                                  </dd>

                                  <dd style="padding:0" class="consult-wrap">
                                  <!-- 添加回复 end-->
                                  </dd>
                                  </dl>
                                  <div class="page-consult">
                                  </div>

                                  </div>
                                  </div>
                                  </div>
                                  <div style="display:none" class="displaydiv">
                                  <a name="write_ask"></a>
                                  <div class="review-box">
                                  <form class="addcomment" method="post" action="<?= Yii::$app->params['baseUrl'] ?>comment-toComment-1446-ask.html" onsubmit="return checkFormReqs(event);">
                                  <h4 class="review-title">发表咨询</h4>
                                  <div class="consult-cont">
                                  <div class="division clearfix">
                                  <div class="leftbox askfloat message-login">
                                  <ul>
                                  <li>咨询类型 : 商品咨询<input type="radio" checked="checked" value="1" name="gask_type">
                                  配送咨询<input type="radio" value="2" name="gask_type">
                                  售后咨询<input type="radio" value="3" name="gask_type">
                                  </li>
                                  <li class="ask_float message-login">
                                  <p>请<a href="<?= Yii::$app->params['baseUrl'] ?>passport-login.html">登陆</a>后再留言<br>如果您不是会员请<a href="<?= Yii::$app->params['baseUrl'] ?>passport-signup.html">注册</a>!</p>
                                  <textarea type="textarea" class="inputstyle font12px db mb5" disabled="true" vtype="sendcomments" rows="5" name="comment" style="width:96%" id="send_comment"></textarea>              <div class="infotips textright"><span class="font-orange" id="num">0</span>/1000</div>

                                  </li>
                                  <li>
                                  联系方式：<input autocomplete="off" class="x-input inputstyle" type="text" vtype="required" disabled="true" size="20" name="contact" id="dom_el_3e0e180"><span class="infotips">(可以是电话、email、qq等)</span>
                                  </li>

                                  <li>
                                  <button class="btn" type="button" disabled=""><span><span>提交咨询</span></span></button>


                                  </li>
                                  </ul>
                                  </div>
                                  <div class="rightbox"><p></p>
                                  </div></div>
                                  <div class="clear"></div>
                                  </div>
                                  </form></div>

                                  </div>

                                  </div>
                                  <div id="ask_html" class="repay-box discussfloat message-login" style="display:none;">
                                  <div class="lt"></div>
                                  <div class="rt"></div>
                                  <div class="lb"></div>
                                  <div class="rb"></div>
                                  <div class="arrw"></div>
                                  <form method="post" onsubmit="checkFormReqs(event);">
                                  <div class="review-textarea">
                                  <ul>
                                  <li class="message-login" id="repay_textarea">
                                  <p>请<a href="<?= Yii::$app->params['baseUrl'] ?>passport-login.html">登陆</a>后再留言<br>如果您不是会员请<a href="<?= Yii::$app->params['baseUrl'] ?>passport-signup.html">注册</a>!</p>
                                  <textarea type="textarea" class="inputstyle font12px db mb5" disabled="true" vtype="sendcomments" rows="5" name="comment" style="width:98%" id="dom_el_3e0e181"></textarea>          <div class="infotips" align="right"><span class="price1">0</span>/1000</div>
                                  </li>
                                  <li>联系方式:<input autocomplete="off" class="x-input inputstyle" type="text" required="true" size="20" name="contact" id="dom_el_3e0e182" vtype="text"><span class="infotips">(可以是电话、email、qq等)</span>
                                  </li>
                                  <li style="padding-left:0">
                                  <button class="btn" type="button" disabled=""><span><span> 提 交</span></span> </button>
                                  <span style="cursor:pointer" class="link-blue" onclick="cancle();">取消回复</span>
                                  </li>
                                  </ul>
                                  </div>
                                  </form>
                                  </div></div>
                                  <!-- add by cam begin -->
                                  <!--
                                  <div class="section pdtdetail" data-sync-type="goodssee" style="display:none" tab="看了又看" data-order="1">
                                  <h3 class="hd-font">看了又看</h3>
                                  </div>-->
                                  <!-- add by cam end -->

                                  </div>
                                  <div id="intro_basic_info" style="display:none;">
                                  <li title="">编号：0021449</li>
                                  <li title="">货号：0021449</li>
                                  <li title="">品牌：</li>
                                  <li title="">价格区间：
                                  ￥184.00                </li>
                                  </div> */ ?>
                                <!--页面body page end -->
                            </div>
                        </div>
                    </div>
                </div>

                <div id="J_dqPostAgeCont_body" class="ks-overlay" style="display:none; width: 418px; visibility: visible; z-index: 8; left: 550px; top: 170px;">
                    <div class="citySelector clearfix">
                        <a href="javascript:void(0);"><b class="J_CitySelectorClose">关闭</b></a>
                        <ul class="J_ZxCity cityList clearfix">
                            <li><a class="" id="code_110000" code="110000" href="javascript:void(0);" value="北京">北京</a></li>
                            <li><a class="" id="code_310000" code="310000" href="javascript:void(0);" value="上海">上海</a></li>
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
                    window.addEvent('domready', function () { //选择配送地（貌似这块的插件要重做？）
                        var clickCity = function (id, aa) {
                            var _input_text = "<li><a class='{select}' code={id} href='#'>{name}</a></li>";
                            var aaa = jQuery('#code_' + id).text();
                            jQuery('#J_dqPostAgeCont').html(aaa);
                            jQuery('#stateCode').val(id);
                            var body = $('J_dqPostAgeCont_body') || '';
                            var skuMapValue = jQuery("input[name='skuMapValue']").val();
                            if (skuMapValue)
                            {
                                getInventory(skuMapValue);
                            }
                            else
                                getInventory("<?= Html::encode($data['partNumber']) ?>");
                            if (body)
                                body.setStyle('display', 'none');
                            else
                                return false;

                        };
                        var obj = $('J_dqPostAgeCont') || '';
                        if (obj)
                            obj.removeEvents('click').addEvent('click', function (e) {
                                var local_area = this.get('code');
                                var parent_area = this.get('parent');
                                if (!local_area || !parent_area)
                                    return false;
                                var body = $('J_dqPostAgeCont_body') || '';
                                if (body)
                                    body.setStyle('display', 'block');
                                else
                                    return false;
                                var list = body.getElements('a') || [];
                                if (list.length > 0) {
                                    list.each(function (p) {
                                        if (p.get('code') == parent_area)
                                            p.addClass('select');
                                        p.removeEvents('click').addEvent('click', function (e) {
                                            list.removeClass('select');
                                            p.addClass('select');
                                            clickCity(p.get('code'));
                                            return false;
                                        })
                                    });
                                }
                                return false;
                            });
                        var obj = $E('#J_dqPostAgeCont_body .J_CitySelectorClose') || '';
                        if (obj)
                            obj.removeEvents('click').addEvent('click', function (e) {
                                var body = $('J_dqPostAgeCont_body') || '';
                                if (body)
                                    body.setStyle('display', 'none');
                                return false;
                            });
                    });
                </script>

                <!--tab切换 start -->
                <script>
                    function setTab(name, cursel, n) {
                        for (i = 1; i < n; i++) {
                            var menu = document.getElementById(name + i);
                            var con = document.getElementById("con_" + name + "_" + i);
                            menu.className = i == cursel ? "active" : "";
                            con.style.display = i == cursel ? "block" : "none";
                        }
                    }
                </script>
                <!--tab切换 end -->


            </div>
        </div>
        <!-- <div class="sidebar-right">
            <a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
            <a href="javascript:void(0)" class="sidebar-backtop"></a>
            <a href="javascript:void(0)" class="sidebar-close"></a>
        </div> -->
    </div>

    <!-- 跳至顶部 start-->
    <script>
        (function () {
            $$('.sidebar-backtop').addEvent('click', function () {
                $(window).scrollTo(0, 0)
            });
            $$('.sidebar-close').addEvent('click', function () {
                $$('.sidebar-right').setStyle('display', 'none')
            })
        })();
    </script> 
    <!-- 跳至顶部 end-->



<?php /* <div id="xtips-container" class="xtips-container"><i class="xtips-arr">◆</i><i class="xtips-arr2">◆</i><div id="xtips-content"></div></div><div class="FormWrap goods-compare" id="goods-compare" style="display: none; position: fixed;">
  <div class="title clearfix"><h3 class="flt">商品对比</h3><span class="close-gc del-bj frt" onclick="gcompare.hide();">关闭</span></div>
  <form action="http://www.ftzmall.com.cn/product-diff.html" method="post" target="_compare_goods">
  <ul class="compare-box">
  <li class="division clearfix tpl">
  <div class="goods-name">
  <a href="http://www.ftzmall.com.cn/%7Burl%7D" gid="{gid}" title="{gname}">{gname}</a>
  </div>
  <a class="btn-delete" onclick="gcompare.erase( & quot; {gid} & quot; , this);">删除</a>
  </li>
  </ul>
  <div class="compare-bar">
  <button name="comareing" type="button" onclick="gcompare.submit()" class="btn btn-compare submit-btn"><span><span>对比</span></span></button>
  <button class="btn btn-compare" type="button" onclick="gcompare.empty()"><span><span>清空</span></span></button>
  </div>
  </form>
  </div> //商品对比模块，占时没有 */ ?> 

    <script>
        jQuery('.popup-btn-close').click(function (e)   //cartBtn重写
        {
            jQuery('#mini-cart-dialog').css('display', 'none');
        });
    </script>

    <!--规格结束-->
    <script>
        function getInventory(itemPartNumber)
        {

            var buyable = <?= Html::encode($data['buyable']) ?>;
            if (buyable == 0)
            {
                $('goods-viewer').getElement('.Num').set('value', 0);
                jQuery('#inventory').html(0);
                jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").css("background-color", "#999999");
                jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").attr("disabled", true);
                jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").css("cursor", "default");
                jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").val("已下架");
                jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").css("background-color", "#999999");
                jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").attr("disabled", true);
                jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").css("display", "none");
                return false;

            }
            var stateCode = jQuery('#stateCode').val();
            var inventory = ({//获取库存
                "_csrf": "<?= Html::encode($_csrf) ?>",
                "itemPartNumber": itemPartNumber,
                "itemOrg": "ftzmall",
                "shop": "ftzmall",
                "country": "CN",
                "stateCode": stateCode,
                //"queryItemType" : "Product", //
            });

            jQuery.ajax({
                type: 'post',
                url: '<?= Url::to(['product/getinventory']); ?>',
                data: inventory,
                success: function (res) {
                    jQuery('#inventory').html(res);
                    if (res == 0) {
                        $('goods-viewer').getElement('.Num').set('value', 0);
                    }
                    else {
                        $('goods-viewer').getElement('.Num').set('value', 1);
                    }
                    var aaa = jQuery('#inventory').html();
                    if (aaa == 0) {
                        jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").css("background-color", "#999999");
                        jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").attr("disabled", true);
                        jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").css("cursor", "default");
                        jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").css("background-color", "#999999");
                        jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").attr("disabled", true);
                        jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").css("cursor", "default");
                    }
                    else {
                        jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").css("background-color", "#c40000");
                        jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").attr("disabled", false);
                        jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").css("cursor", "pointer");
                        jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").css("background-color", "#f27f41");
                        jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").attr("disabled", false);
                        jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").css("cursor", "pointer");
                    }
                },
                error: function () {
                    console.log(res);//todo 异常处理 for 20150901                        
                    jQuery('#inventory').html(0);  //如果库存获取不到就传0
                    $('goods-viewer').getElement('.Num').set('value', 0);
                    jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").css("background-color", "#999999");
                    jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").attr("disabled", true);
                    jQuery(".ppsc-product-detail .btnwrapModi #cartBtn").css("cursor", "default");
                    jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").css("background-color", "#999999");
                    jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").attr("disabled", true);
                    jQuery(".ppsc-product-detail .btnwrapModi #btn_lj").css("cursor", "default");

                },
            });

        }

        function getProductprice(itemPartNumber)
        {
            var params = ({//http://localhost:8080/calculation-web/rest/v1/price/pricelist/{价格列表名字}/item/{SKU编号}/itemOrganization/{组织名字}/shop/{商店名字}
                "_csrf": "<?= Html::encode($_csrf) ?>",
                "priceList": "offer",
                "itemPartnumber": itemPartNumber, //这个应该是SKU编号 以后改成skuMapValue;
                "itemOrg": "ftzmall",
                "shop": "<?= Html::encode($data['memberId']) ?>",
                //"queryItemType" : "Product", //
            });
            jQuery.ajax({
                type: 'post',
                url: '<?= Url::to(['product/getproductprice']); ?>',
                data: params,
                success: function (res) {
                    if (res.CNY)
                    {
                        jQuery('.goodsprice').html('￥' + res.CNY);
                        jQuery("input[id='offergoodsprice']").val(res.CNY);        
                        var taxRate = "<?= Html::encode(isset($tax['taxRate']) ? $tax['taxRate'] * 100 : "0") ?>";
                        var tax = Number(res.CNY)*Number(taxRate)/100;
						tax = tax.toFixed(2);
                        jQuery("#tax").html("￥"+tax);
                        jQuery("#tax").css("text-decoration",(tax<50?"line-through":""));
                    }
                    else{
                        console.log(res);//todo 异常处理 for 20150901
                        Message.error("获取价格失败.<br />提交信息不完整.</li></ul>");//比如
                    }
                },
                error: function () {
                    Message.error("获取价格失败.<br />提交信息不完整.</li></ul>"); //这块以后会返回别的error message，错误时候返回
                },
            });
            
            var params = ({//http://localhost:8080/calculation-web/rest/v1/price/pricelist/{价格列表名字}/item/{SKU编号}/itemOrganization/{组织名字}/shop/{商店名字}
            "_csrf": "<?= Html::encode($_csrf) ?>",
            "priceList": "list",
            "itemPartnumber": itemPartNumber, //这个应该是SKU编号 以后改成skuMapValue;
            "itemOrg": "ftzmall",
            "shop": "<?= Html::encode($data['memberId']) ?>",
                //"queryItemType" : "Product", //
            });
            jQuery.ajax({
                type: 'post',
                url: '<?= Url::to(['product/getproductprice']); ?>',
                data: params,
                success: function (res) {
                    if (res.CNY)
                    {
                        jQuery('.listprice').html('￥' + res.CNY);
                        jQuery("input[id='listgoodsprice']").val(res.CNY);                                    
                    }
                    else{
                        console.log(res);//todo 异常处理 for 20150901
                        Message.error("获取价格失败.<br />提交信息不完整.</li></ul>");//比如
                    }
                },
                error: function () {
                    Message.error("获取价格失败.<br />提交信息不完整.</li></ul>"); //这块以后会返回别的error message，错误时候返回
                },   
                
            });

        }


        var skuMap = <?= json_encode($skumap) ?>;
        if (skuMap == "")
        {
            var skuMapValue = "<?= Html::encode($data['partNumber']) ?>";
            var skuMapId = "<?= Html::encode($data['id']) ?>";
            jQuery("input[id='skuMapValue']").val(skuMapValue);
            jQuery("input[id='skuMapId']").val(skuMapId);
            var buyable = <?= Html::encode($data['buyable']); ?>;
            getProductprice(skuMapValue);
            getInventory("<?= Html::encode($data['partNumber']) ?>");


        }
        else {
            var tmp = "";
            jQuery("input[id='defining']").each(function () {
                tmp += jQuery(this).val() + '_'
            });
            tmp = tmp.substring(0, tmp.length - 1); //tmp就等于skuMap里的key，类似10005_10007_10009      
            console.log(tmp);
            //return false;
            if (skuMap[tmp])
            {
                var skuMapValue = skuMap[tmp].partNumber; //skuMapValue就等于skuMap里的value，类似partnumber-1-18  
                var skuMapId = skuMap[tmp].value;
                var skuMapContent = skuMap[tmp].content;
                jQuery("input[id='skuMapValue']").val(skuMapValue);
                jQuery("input[id='skuMapId']").val(skuMapId);
                jQuery("input[id='skuMapContent']").val(skuMapContent);
                if (!skuMapValue)
                {
                    Message.error("获取库存跟价格失败.<br /><ul><li>skuvalue没有赋值</li></ul>");
                    //return false;
                }
            }
            if (skuMapValue)
            {
                getInventory(skuMapValue);
                getProductprice(skuMapValue);
            }
        }

<?php
if ($defining & is_array($defining))
{
    foreach ($defining as $k => $arr):
        ?>


                jQuery('.clearfix .<?= Html::encode($arr['key']) ?>').click(function (e)   //format_1这个class只是为了获取，可以替换成变量
                {
                    var aaa = jQuery('.clearfix .<?= Html::encode($arr['key']) ?>');
                    aaa.removeClass('selected');
                    this.addClass('selected');
                    var formatid = jQuery(this).attr("id"); //获取当前选择器的id
                    jQuery("input[name='<?= Html::encode($arr['key']) ?>']").val(formatid); //赋值到hidden的input中  
                    var tmp = "";
                    jQuery("input[id='defining']").each(function () {
                        tmp += jQuery(this).val() + '_'
                    });
                    tmp = tmp.substring(0, tmp.length - 1); //tmp就等于skuMap里的key，类似10005_10007_10009
                    if (skuMap[tmp])
                    {
                        var skuMapValue = skuMap[tmp].partNumber; //skuMapValue就等于skuMap里的value，类似partnumber-1-18  
                        var skuMapId = skuMap[tmp].value;
                        var skuMapContent = skuMap[tmp].content;
                        if (!skuMapValue)
                        {
                            Message.error("获取库存跟价格失败.<br /><ul><li>skuvalue没有赋值</li></ul>");
                            return false;
                        }
                    }

                    if (skuMapValue)
                    {
                        var stateCode = jQuery('#stateCode').val();
                        jQuery("input[id='skuMapValue']").val(skuMapValue);
                        jQuery("input[id='skuMapId']").val(skuMapId);
                        jQuery("input[id='skuMapContent']").val(skuMapContent);
                        getProductprice(skuMapValue);
                        getInventory(skuMapValue);

                    }

                    //jQuery('goods-viewer').getElement('.Num').set('value', vals);    
                });
        <?php
    endforeach;
}
?>
    </script>                                
    <!--购买数量-->
    <script>
        miniCart = {
            'show': function (target) {
                target = $(target);
                if (!target)
                    return;
                if (this.dialog) {
                    this.hide();
                }

                var setSize = this.setSize = function () {
                    if (!_this.dialog.isDisplay())
                        return;
                    $(_this.dialog).setStyles({
                        top: target.getPosition().y + target.getSize().y,
                        left: target.getPosition().x.limit(0, window.getSize().x - _this.dialog.getSize().x) + window.getScroll().x
                    });
                }
                setSize();
                window.addEvent('resize', setSize);
            },
            'hide': function () {
                try {
                    this.dialog.destroy();
                    window.removeEvent('resize', this.setSize);
                } catch (e) {
                }
                try {
                    document.getElement('.dialog-specbox').getParent('[data-single]').retrieve('instance').hide();
                } catch (e) {
                }
            },
            'load': function () {
                var skuMapValue = jQuery("input[name='skuMapValue']").val(); //productid数量什么的也这样读    
                var skuMapId = jQuery("input[name='skuMapId']").val();
                var skuMapContent = jQuery("input[name='skuMapContent']").val();
                var offergoodsprice = jQuery("input[name='offergoodsprice']").val();
                var listgoodsprice = jQuery("input[name='listgoodsprice']").val();
                var inventory = jQuery('#inventory').html();
                var userId = "<?= $userId; ?>";
                if (!userId)
                {
                    window.location.href = '<?= Url::to(['login/index']); ?>';
                    return false;
                }
                if (!skuMapValue)
                {
                    Message.error("加入购物车失败.<br /><ul><li>请选择规格参数</li></ul>");
                    return false;
                }
                var num = jQuery("#Num").val();
                //var remoteURL = '<?= Yii::$app->params['baseUrl'] ?>/cart/m-create.html';

                var offset = jQuery("#cart_num").offset();
                var remoteURL = '<?= Url::to(['cart/ajaxcreate']); ?>';
                var params = ({//数组，这个数组，北京写model的姐姐说都要的，但是她貌似也不是很清楚每个参数是干嘛的
                    "_csrf": "<?= Html::encode($_csrf) ?>",
                    "itemPriceListId": "offer", //购物车项商品的采用的价格列表 required
                    "cartlineType": 1, //买家类型，游客0，登录用户1 , required
                    "itemDisplayText": "<?= Html::encode($desc['name']) ?>",
                    "shopDisplayText": "自贸区直购专场", //购物车项商品所属店铺显示的文本,自营情况下可以为空，或者默认 required
                    "userId": userId, //买家id required
                    "shopContactId": "1111", //...听完了也没懂，跟店小二有关？
                    "itemListPrice": listgoodsprice, //购物车项商品的标价，显示用 required
                    "channelType": <?= Yii::$app->params['platform'];?>, //购物车来源类型,app,pc,wechat等,required
                    "channelId": "ftzmall", //购物车来源Id , required
                    "itemId": skuMapId, //skuMapValue 购物车项商品全局唯一Id required
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
					"isGift": "0",
                });
                console.log(params);
                jQuery.ajax({
                    type: 'post',
                    url: remoteURL,
                    data: params,
                    success: function (res) {
                        console.log(res);
                        var cartlineId = res.cart.cartlineId;
                        if(isNaN(cartlineId))
                        {
                            Message.error("加入购物车失败.<br /><ul><li>没有成功加入购物车</li></ul>"); 
                            return false;
                        }
                        var dataPrice = {
                            "_csrf": "<?= Html::encode($_csrf) ?>",
                            'cartlineIds': cartlineId,
                            'price': true,
                            'promotion': false,
                            'shipping': false,
                            'tax': false,
                        };
                        if ('<?= $userId ?>' != '')
                        {
                            cookietotalnum = jQuery.cookie('carttotalNum' + '<?= $userId ?>');
                            if (!cookietotalnum)
                            {
                                jQuery.ajax({
                                    type: 'get',
                                    url: '<?= Url::to(['cart/getcarttotalnum']) ?>',
                                    success: function (carttotalnum) {
                                        jQuery("#cart_num").html(carttotalnum);
                                    }
                                })
                            }
                            else {
                                carttotalnum = Number(cookietotalnum) + Number(num);
                                jQuery("#cart_num").html(carttotalnum);
                                jQuery.cookie('carttotalNum' + '<?= $userId ?>', carttotalnum, {path: '/'});

                            }
                        } else {
                            jQuery("#cart_num").html('0');
                        }

                        jQuery.ajax({
                            type: 'post',
                            url: '<?= Url::to(['cart/priceandnum']); ?>',
                            data: dataPrice,
                            success: function (res2) {                                
                                console.log(res2);
                                var type_num = res2.type; //以后读取返回的数字
                                if(isNaN(type_num))
                                    type_num = res.cart.cartlineType;                            
                                var product_num = res2.num;
                                if(isNaN(product_num))
                                    product_num = res.cart.cartlineQuantity;                               
                                var price = res2.originalPrice;
                                 if(isNaN(price))
                                     price = '未计算';
                                jQuery('#mini-cart-dialog').find('h2').html('成功加入购物车');//返回加入购物车成功的提示内容
                                jQuery('#mini-cart-dialog #type_num').html(type_num);
                                jQuery('#mini-cart-dialog #product_num').html(product_num);
                                jQuery('#mini-cart-dialog #price').html(price);
                                jQuery('#mini-cart-dialog').css('display', 'block');

                                //购物车飞入效果start lijing
                                var addcar = jQuery(".btn-buy");
                                var a = document.getElementById("cartBtn");
                                var img = addcar.parents('.goods-rightbox').siblings().find('.spec-pic').children(img).attr('src');
                                var flyer = jQuery('<img class="u-flyer" src="' + img + '">');
                                var compatMode = window.compatMode,
                                        isChrome = window.navigator.userAgent.indexOf("Chrome") === -1 ? false : true,
                                        scrollEle = compatMode === "BackCompat" || isChrome ? document.body : document.documentElement,
                                        clientEle = compatMode === "BackCompat" ? document.body : document.documentElement;
                                var eletop = a.offsetTop - scrollEle.scrollTop;
                                //var cartop = document.getElementById("cart_num").offsetTop;

                                flyer.fly({
                                    start: {
                                        left: a.getBoundingClientRect().left,
                                        top: eletop
                                    },
                                    end: {
                                        left: offset.left + 10,
                                        top: offset.top + 10 - scrollEle.scrollTop,
                                        width: 0,
                                        height: 0
                                    },
                                    onEnd: function () {
                                        this.destory();
                                    }
                                });


                                //购物车飞入效果end

                            },
                            error: function () {
                                var type_num = res.cart.cartlineType; //以后读取返回的数字
                                var product_num = res.cart.cartlineQuantity;
                                var price = '未计算';
                                jQuery('#mini-cart-dialog').find('h2').html('成功加入购物车');//返回加入购物车成功的提示内容
                                jQuery('#mini-cart-dialog #type_num').html(type_num);
                                jQuery('#mini-cart-dialog #product_num').html(product_num);
                                jQuery('#mini-cart-dialog #price').html(price);
                                jQuery('#mini-cart-dialog').css('display', 'block');
                                // Message.error("加入购物车失败.<br /><ul><li>计算购物车价格失败</li></ul>"); //这块以后会返回别的error message，错误时候返回

                            },
                        })

                    },
                    error: function () {
                        Message.error("加入购物车失败.<br /><ul><li>没有成功加入购物车</li></ul>"); //这块以后会返回别的error message，错误时候返回

                    },
                });
                //var opts = params = Object.append({
                //url:params.remoteURL,
                //method:'post',
                //console.log(params.remoteURL);
                /*onRequest:function(){
                 //this.dialog.getElement('.title').set('html','正在加入购物车');
                 }.bind(this),
                 onSuccess:function(re){
                 var rs;
                 try{
                 rs = JSON.decode(re);
                 } catch (e){}
             
                 if (rs && rs.url) {
                 if (Browser.ie && Browser.version < 9) {
                 var link_tmp = document.createElement("a");
                 link_tmp.href = rs.url;
                 document.body.appendChild(link_tmp);
                 link_tmp.click();
                 link_tmp.destroy();
                 }
                 else {
                 location.href = rs.url;
                 }
                 } else if (rs && rs.error) {
                 $(this.dialog).destroy();
                 Message.error(rs.error);
                 } 
                 else {
             
                 this.dialog.getElement('h2').set('html', '成功加入购物车');
                 this.dialog.getElement('.popup-content').innerHTML = re;
                 this.dialog.getElements('.popup-btn-close').addEvent('click', this.hide.bind(this));
                 if ($$('.cart-number')) $$('.cart-number').set('text', Cookie.read('S[CART_NUMBER]') || 0);
                 if ($$('.cart-count')) $$('.cart-count').set('text', Cookie.read('S[CART_COUNT]') || 0);
                 if ($$('.cart-money-total')) $$('.cart-money-total').set('text', Cookie.read('S[CART_TOTAL_PRICE]') || 0);
                 if ($('cart_num')){//更新mini购物车数据 by ql （导航栏处）
                 $('cart_num').set('text', Cookie.read('S[CART_NUMBER]') || 0);
                 }
             
                 if ($('cart_count')){
                 $('cart_count').set('text', Cookie.read('S[CART_COUNT]') || 0);
                 }
             
                 if ($('MyCart')){//todo
                 $('MyCart').retrieve('fn:refresh', function(){})();
                 }
             
                 if (document.getElement('.minicart_box') && document.getElement('.minicart_box').get('show_gallery')){
                 document.getElement('.minicart_box').fireEvent('_show'); //迷你购物车
                 }
             
             
                 }
                 }.bind(this),
                 onFailure:function(xhr){
                 this.dialog.destroy();
                 Message.error("加入购物车失败.<br /><ul><li>可能库存不足.</li><li>或提交信息不完整.</li></ul>");
                 }.bind(this)
                 }, params.options || {});
                 if (!params.url)return false;
                 miniCart.show(opts.target);
                 new Request(opts).send();*/
            },
            init: function () {
                var _clickBubblesCount = 4;
                $(document.body).addEvent('click', function (e) {
                    var clickT = e.target;
                    var matchEl = null;
                    for (var i = 0; i < _clickBubblesCount; i++) {

                        if (clickT && clickT.match && clickT.match("a[target=_dialog_minicart]")) {
                            matchEl = clickT;
                            break;
                        }
                        if (!!!clickT) {
                            return;
                        }
                        clickT = $(clickT.parentNode);
                    }

                    if (matchEl && !matchEl.hasClass('hasSpec')) {
                        e.stop();
                        miniCart.load([{url: matchEl.href, data: matchEl.getParent('tr'), target: matchEl}]);
                    }
                });

            }
        };
        formToCart = function (container) {
            container = $(container) || document.body;
            var formtocart;
            if (formtocart = container.getElement('form[target=_dialog_minicart]') || container.getFirst().getParent('form[target=_dialog_minicart]')) {
                formtocart.addEvent('submit', function (e) {
                    e.stop();
                    this.getElement('[type=submit]') && this.getElement('[type=submit]').removeClass('disabled');
                    miniCart.load([{
                            url: this.action,
                            method: this.method,
                            data: this,
                            target: this.getElement('input[value=加入购物车]') || null
                        }]);
                });
            }
            ;
        }

        window.addEvent('domready', function () {
            miniCart.init();
            formToCart();
        });</script>


