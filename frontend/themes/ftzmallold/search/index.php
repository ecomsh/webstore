<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use yii\widgets\Pjax;
use frontend\assets\SearchAsset;
SearchAsset::register($this);
/* @var $this yii\web\View */
$this->title = '搜索结果-上海外高桥进口商品网';
?>

<div class = "conter w1200 clb">
    <div class = "ppsc-gallery-default clearfix">
        <div class = "bread-cum" style="margin-bottom:28px"><!--您当前的位置： <span class = "now">全部</span>
            <!--您当前的位置： 首页 ><a type = "url" href = "<?= Yii::$app->params['baseUrl'] ?>gallery-index---1--1--grid-g.html?scontent=n,DFGYT">海鲜水产、酒</a>|<a type = "url" href = "<?= Yii::$app->params['baseUrl'] ?>gallery-index---1--1--grid-g.html?scontent=n,%E8%B7%A8%E5%A2%83%E9%80%9A">跨境通专区</a> --></div>
        <div class = "gallery-main-contaienr fl">
            <div class = "clear"></div>
            <div class = "GoodsSearchWrap">                                
                    <div class = "attrs">
                        <?php foreach($facets['facets'] as $key=>$arr):?>                                            
                        <div class = "brandAttr">
                            <input type = "hidden" name = "brand_id" value = "">
                            <div class = "j_Brand attr j_TmpTag">
                                <div class = "attrKey" id="getKey"><?= Html::encode(isset($arr['facetName'])?($arr['facetName']=="brand"?"品牌":$arr['facetName']):""); ?></div>
                                <div class = "attrValues">
                                    <!--<div class = "j_BrandSearch av-search clearfix" style = "display: none;">
                                        <input type = "text" id = "txt_brandSearch" placeholder = "搜索 品牌名称" value = "" style = "color: rgb(191, 191, 191);">
                                    </div>-->
                                    <ul class = "av-collapse" id = "J_brandList">
                                        <?php foreach ($arr["facetValues"] as $key => $value):?>
                                        <li bname = "<?= $value ?>" brand_id = "<?= $value ?>">                                            
                                            <a href = "<?= Url::to(['search/index','facets'=>urlencode($arr['facetName'].'|'.$value)]);?>"><?= Html::encode(isset($value)?$value:""); ?></a>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                    <div class = "av-options">
                                        <a href = "javascript:;" class = "j_Multiple avo-multiple">多选<i></i></a>
                                        <a href = "javascript:;" class = "j_More avo-more ui-more-drop-l" style = "visibility: visible; display: inline;">
                                            更多
                                            <i class = "ui-more-drop-l-arrow"></i>
                                        </a>
                                    </div>
                                    <div class = "av-btns" style = "display: none;">
                                        <a class = "j_SubmitBtn ui-btn-s-primary ui-btn-disable">确定</a>
                                        <a class = "j_CancelBtn ui-btn-s">取消</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <div class = "cateAttrs" id = "J_cateAttrs">
                            <?php foreach ($facets['categoryFacets'] as $key => $arr){
                                 if(Yii::$app->params['searchmoredisplay']==1&&Yii::$app->params['searchmore']>$key):                                                            
                            ?>        
                            <div class = "j_Prop attr ">
                                <div class = "attrKey">
                                    <a title = "<?= Html::encode($arr['facetName']['displayText']); ?>" href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$arr['facetName']['id'])]);?>"><?= Html::encode($arr['facetName']['displayText']); ?></a>
                                </div>
                                <div class = "attrValues">
                                    <ul class = "av-expand">
                                        <?php foreach ($arr['facetValues'] as $k => $v):?>
                                        <li style = "width:auto;">
                                            <a style = "padding-right:0px;margin-right:20px;" href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$v['id'])]);?>"><?= Html::encode($v['displayText']); ?></a>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                    <div class = "av-options">
                                        <a href = "javascript:;" class = "j_More avo-more ui-more-drop-l" style = "visibility: visible;">
                                            更多
                                            <i class = "ui-more-drop-l-arrow"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php elseif(Yii::$app->params['searchmoredisplay']==1&&Yii::$app->params['searchmore']<=$key):?>     
                            <div class = "j_Prop attr cat_more" style="display:none;" drop='true'>
                                <div class = "attrKey">
                                    <a title = "<?= Html::encode($arr['facetName']['displayText']); ?>"  href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$arr['facetName']['id'])]);?>"><?= Html::encode($arr['facetName']['displayText']); ?></a>
                                </div>
                                <div class = "attrValues">
                                    <ul class = "av-expand">
                                        <?php foreach ($arr['facetValues'] as $k => $v):?>
                                        <li style = "width:auto;">
                                            <a style = "padding-right:0px;margin-right:20px;" href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$v['id'])]);?>"><?= Html::encode($v['displayText']); ?></a>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                    <div class = "av-options">
                                        <a href = "javascript:;" class = "j_More avo-more ui-more-drop-l" style = "visibility: visible;">
                                            更多
                                            <i class = "ui-more-drop-l-arrow"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php else:?>
                                <div class = "j_Prop attr ">
                                <div class = "attrKey">
                                    <a title = "<?= Html::encode($arr['facetName']['displayText']); ?>" href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$arr['facetName']['id'])]);?>"><?= Html::encode($arr['facetName']['displayText']); ?></a>
                                </div>
                                <div class = "attrValues">
                                    <ul class = "av-expand">
                                        <?php foreach ($arr['facetValues'] as $k => $v):?>
                                        <li style = "width:auto;">
                                            <a style = "padding-right:0px;margin-right:20px;" href = "<?= Url::to(['search/index','facets'=>urlencode('category|'.$v['id'])]);?>"><?= Html::encode($v['displayText']); ?></a>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                    <div class = "av-options">
                                        <a href = "javascript:;" class = "j_More avo-more ui-more-drop-l" style = "visibility: visible;">
                                            更多
                                            <i class = "ui-more-drop-l-arrow"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endif;}?>
                            <?php if(Yii::$app->params['searchmoredisplay']==1&&Yii::$app->params['searchmore']<count($facets['categoryFacets'])):?>    
                            <div class = "attrExtra" style = "border-top:1px solid #D1CCC7">
                                <div class = "attrExtra-border"></div>
                                <a id = "JP_catmore" class = "attrExtra-more j_MoreAttrs"><i></i>更多选项</a>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <script>
                        (function() {
                            var isNotSupportHtml5 = this.isNotSupportHtml5 = !('placeholder' in new Element('input'));
                    //更多选项
                            if ($('JP_more')) {
                                $('JP_more').addEvent('click', function(e) {
                                    e.stop();
                                    $(this).toggleClass('attrExtra-more-drop');
                                    if ($(this).hasClass('attrExtra-more-drop')) {
                                        $(this).set('html', '精简选项<i></i>');
                                    } else {
                                        $(this).set('html', '更多选项<i></i>');
                                    }
                                    $('J_propAttrs').getElements('.j_Prop').each(function(el) {
                                        if (el.get('drop')) {
                                            if (el.getStyle('display') == 'none') {
                                                el.setStyle('display', '');
                                            } else {
                                                el.setStyle('display', 'none');
                                            }
                                        }
                                    });
                                });
                            }
                            if ($('JP_catmore')) {
                                $('JP_catmore').addEvent('click', function(e) {
                                    e.stop();
                                    $(this).toggleClass('attrExtra-more-drop');
                                    if ($(this).hasClass('attrExtra-more-drop')) {
                                        $(this).set('html', '精简选项<i></i>');
                                    } else {
                                        $(this).set('html', '更多选项<i></i>');
                                    }
                                    $('J_cateAttrs').getElements('.cat_more').each(function(el) {
                                        if (el.getStyle('display') == 'none') {
                                            el.setStyle('display', '');
                                        } else {
                                            el.setStyle('display', 'none');
                                        }
                                    });
                                });
                            }

                            var cateAttrs = document.getElements('.cateAttrs .j_More');
                            cateAttrs.each(function(j_more, index, obj) {
                                j_more.addEvent('click', function(e) {
                                    e.stop();
                                    $(this).toggleClass('ui-more-expand-l');
                                    $(this).toggleClass('ui-more-drop-l');
                                    if ($(this).hasClass('ui-more-expand-l')) {
                                        $(this).set('html', '收起<i class="ui-more-expand-l-arrow"></i>');
                                    } else {
                                        $(this).set('html', '更多<i class="ui-more-drop-l-arrow"></i>');
                                    }
                                    $(this).getParent('div .attrValues').getElement('ul').toggleClass('av-expand');
                                    $(this).getParent('div .attrValues').getElement('ul').toggleClass('av-collapse');
                                });
                            });
                            var prop = document.getElements('.propAttrs .j_Prop');
                            prop.each(function(j_prop, index, obj) {
                                var j_Multiple = j_prop.getElement('.j_Multiple');
                                var j_CancelBtn = j_prop.getElement('.j_CancelBtn');
                                var j_SubmitBtn = j_prop.getElement('.j_SubmitBtn');
                                var j_More = j_prop.getElement('.j_More');
                                if (j_Multiple && j_Multiple.getStyle('display') != 'none') {
                                    var pula = j_prop.getElements('ul a');
                                    pula.each(function(li) {
                                        li.addEvent('click', function(e) {
                                            var ul = $(this).getParent('ul');
                                            if (ul.getParent('.j_Prop').hasClass('forMultiple')) {
                                                e.stop();
                                                $(this).getParent('li').toggleClass('av-selected');
                                                if (!!!$(this).getElement('i')) {
                                                    $(this).set('html', $(this).get('html') + "<i></i>");
                                                }
                                                var j_s = ul.getParent('.j_Prop').getElement('.j_SubmitBtn');
                                                if (ul.getElement('.av-selected')) {
                                                    j_s.removeClass('ui-btn-disable');
                                                } else {
                                                    j_s.addClass('ui-btn-disable');
                                                }
                                            }
                                        });
                                    });
                                    /* 多选按钮 */
                                    j_Multiple.addEvent('click', function(e) {
                                        e.stop();
                                        prop.map(function(j_prop) {
                                            j_prop.removeClass('forMultiple');
                                        });
                                        prop.getElements('li').map(function(li) {
                                            li.removeClass('av-selected');
                                        });

                                        prop.getElements('.av-options').map(function(li) {
                                            li.setStyle('display', 'block');
                                        });
                                        prop.getElements('.av-btns').map(function(li) {
                                            li.setStyle('display', 'none');
                                        });
                                        prop.getElements('ul').map(function(li) {
                                            if (li.hasClass('av-expand')) {
                                                li.removeClass('av-expand');
                                                li.removeClass('av-scroll');
                                                li.addClass('av-collapse');
                                            }
                                        });
                                        prop.getElements('.j_More').map(function(li) {
                                            if (li.hasClass('ui-more-expand-l')) {
                                                li.set('html', '更多<i class="ui-more-drop-l-arrow"></i>');
                                                li.addClass('ui-more-drop-l');
                                                li.removeClass('ui-more-expand-l');
                                            }
                                        });
                                        prop.getElements('.j_SubmitBtn').map(function(li) {
                                            li.addClass('ui-btn-disable');
                                        });
                                        $(this).getPrevious('input[type="hidden"]').value = '';
                                        $(this).toggleClass('forMultiple');
                                        var av_btns = $(this).getElement('.av-btns');
                                        if ($(this).hasClass('forMultiple')) {
                                            av_btns.setStyle('display', 'block');
                                        } else {
                                            av_btns.setStyle('display', 'none');
                                        }
                                        var j_m = $(this).getElement('.av-options');
                                        j_m.setStyle('display', 'none');
                                        $(this).getElement('ul').toggleClass('av-expand');
                                        $(this).getElement('ul').toggleClass('av-collapse');


                                    }.bind(j_prop));
                                    j_CancelBtn.addEvent('click', function(e) {
                                        var ul = $(this).getElement('ul');
                                        ul.toggleClass('av-expand');
                                        ul.toggleClass('av-collapse');
                                        ul.getElements('li').map(function(li) {
                                            li.removeClass('av-selected');
                                        });
                                        $(this).getElement('.av-btns').setStyle('display', 'none');
                                        $(this).getElement('.av-options').setStyle('display', 'block');
                                        $(this).toggleClass('forMultiple');
                                        $(this).getElement('.j_SubmitBtn').addClass('ui-btn-disable');
                                    }.bind(j_prop));
                                    j_SubmitBtn.addEvent('click', function(e) {
                                        var j_s = $(this).getElement('.j_SubmitBtn');
                                        if (j_s.hasClass('ui-btn-disable')) {
                                            return;
                                        }
                                        var ul = $(this).getElement('ul');
                                        var li = ul.getChildren('.av-selected');
                                        var option_id = li.map(function(el) {
                                            return el.get('option_id');
                                        });
                                        var p = $(this).getPrevious('input[type="hidden"]');
                                        p.value = ul.get('goods_p') + ',' + option_id.join(',');
                                        $(this).getParent('form').submit();

                                    }.bind(j_prop));
                                }
                                if (j_More) {
                                    j_More.addEvent('click', function(e) {
                                        var j_m = $(this).getElement('.j_More')
                                        j_m.toggleClass('ui-more-expand-l');
                                        j_m.toggleClass('ui-more-drop-l');
                                        if (j_m.hasClass('ui-more-expand-l')) {
                                            j_m.set('html', '收起<i class="ui-more-expand-l-arrow"></i>');
                                        } else {
                                            j_m.set('html', '更多<i class="ui-more-drop-l-arrow"></i>');
                                        }

                                        $(this).getElement('ul').toggleClass('av-expand');
                                        $(this).getElement('ul').toggleClass('av-collapse');
                    // 
                                    }.bind(j_prop));
                                }
                            });
                            var All_Brand = document.getElements('.j_Brand');
                            var j_BrandSearch = document.getElement('.j_BrandSearch');

                            var txt_brandSearch = $('txt_brandSearch');

                            if (txt_brandSearch) {
                                txt_brandSearch.value = '';
                                if (isNotSupportHtml5) {
                                    if (txt_brandSearch.value == '') {
                                        txt_brandSearch.value = txt_brandSearch.get('placeholder');
                                    }
                                }
                                txt_brandSearch.addEvents({
                                    focus: function(e) {
                                        if ($(this).value == $(this).get('placeholder')) {
                                            $(this).value = '';
                                        }
                                    },
                                    blur: function(e) {
                                        if ($(this).value == '') {
                                            $(this).value = $(this).get('placeholder');
                                        }
                                    },
                                    keyup: function(e) {
                                        var lis = $('J_brandList').getElements('li');
                                        lis.map(function(el, index, obj) {
                                            el.removeClass('av-selected');
                                            if (txt_brandSearch.value == '') {
                                                el.setStyle('display', 'block');
                                            } else {
                                                var text = el.get('bname');
                                                if (text.test(txt_brandSearch.value, 'i')) {
                                                    el.setStyle('display', 'block');
                                                } else {
                                                    el.setStyle('display', 'none');
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                            //if (j_Brand) {
                            All_Brand.each(function(j_Brand, index, obj) {
                                var j_Multiple = j_Brand.getElement('.j_Multiple');
                                var j_CancelBtn = j_Brand.getElement('.j_CancelBtn');
                                var j_SubmitBtn = j_Brand.getElement('.j_SubmitBtn');

                                var j_More = j_Brand.getElement('.j_More');
                                var pula = j_Brand.getElements('ul a');
                                pula.each(function(li) {
                                    li.addEvent('click', function(e) {
                                        var ul = $(this).getParent('ul');
                                        if (j_Brand.hasClass('forMultiple')) {
                                            e.stop();
                                            $(this).getParent('li').toggleClass('av-selected');
                                            if (!!!$(this).getElement('i')) {
                                                $(this).set('html', $(this).get('html') + "<i></i>");
                                            }
                                            var j_s = ul.getParent('.j_Brand').getElement('.j_SubmitBtn');
                                            if (ul.getElement('.av-selected')) {
                                                j_s.removeClass('ui-btn-disable');
                                            } else {
                                                j_s.addClass('ui-btn-disable');
                                            }
                                        }
                                    });
                                });
                                j_Multiple.addEvent('click', function(e) {
                                    e.stop();
                                    $(this).getPrevious('input[type="hidden"]').value = '';
                                    $(this).toggleClass('forMultiple');
                                    var av_btns = $(this).getElement('.av-btns');
                                    if ($(this).hasClass('forMultiple')) {
                                        av_btns.setStyle('display', 'block');
                                        $(this).getElement('ul').addClass('av-scroll');
                                        $(this).getElement('ul').addClass('av-expand');
                                        $(this).getElement('ul').removeClass('av-collapse');
                                    } else {
                                        av_btns.setStyle('display', 'none');
                                        $(this).getElement('ul').removeClass('av-scroll');
                                        $(this).getElement('ul').removeClass('av-expand');
                                        $(this).getElement('ul').addClass('av-collapse');
                                    }
                                    var j_m = $(this).getElement('.av-options');
                                    j_m.setStyle('display', 'none');
                                    $(this).getElement('.j_More').set('html', '更多<i class="ui-more-drop-l-arrow"></i>');
                                    $(this).getElement('.j_More').addClass('ui-more-drop-l');
                                    $(this).getElement('.j_More').removeClass('ui-more-expand-l');
                                    //j_BrandSearch.setStyle('display', 'block');
                                }.bind(j_Brand));

                                j_More.addEvent('click', function(e) {
                    //
                                    $(this).toggleClass('ui-more-expand-l');
                                    $(this).toggleClass('ui-more-drop-l');
                                    var ul = j_Brand.getElement('ul');
                                    if ($(this).hasClass('ui-more-expand-l')) {
                                        $(this).set('html', '收起<i class="ui-more-expand-l-arrow"></i>');
                                        ul.addClass('av-scroll');
                                        ul.addClass('av-expand');
                                        ul.removeClass('av-collapse');
                                        //j_BrandSearch.setStyle('display', 'block');
                                    } else {
                                        $(this).set('html', '更多<i class="ui-more-drop-l-arrow"></i>');
                                        ul.removeClass('av-scroll');
                                        ul.removeClass('av-expand');
                                        ul.addClass('av-collapse');
                                        //j_BrandSearch.setStyle('display', 'none');
                                        //j_BrandSearch.getElement('input').value = '';
                                        ul.getElements('li').map(function(li) {
                                            li.setStyle('display', 'block')
                                        });
                                    }

                                });

                                j_CancelBtn.addEvent('click', function(e) {
                                    var ul = $(this).getElement('ul');
                                    ul.toggleClass('av-expand');
                                    ul.toggleClass('av-collapse');
                                    ul.removeClass('av-scroll');
                                    ul.getElements('li').map(function(li) {
                                        li.removeClass('av-selected');
                                        li.setStyle('display', 'block')
                                    });
                                    $(this).getElement('.av-btns').setStyle('display', 'none');
                                    $(this).getElement('.av-options').setStyle('display', 'block');
                                    $(this).toggleClass('forMultiple');
                                    $(this).getElement('.j_SubmitBtn').addClass('ui-btn-disable');
                                    //j_BrandSearch.setStyle('display', 'none');
                                    //j_BrandSearch.getElement('input').value = '';
                                }.bind(j_Brand));
                                j_SubmitBtn.addEvent('click', function(e) {
                                    var j_s = $(this).getElement('.j_SubmitBtn');
                                    if (j_s.hasClass('ui-btn-disable')) {
                                        return;
                                    }
                                    var li = $(this).getElements('.av-selected');
                                    var option_id = li.map(function(el) {
                                        return el.get('brand_id');
                                    });
                                    var p = $(this).getPrevious('input[type="hidden"]');
                                    p.value = option_id.join(',');
                                    console.log(p.value);      
                                    var getKey = j_Brand.getElement('#getKey').get('text') ;
                                    if(getKey == "品牌")
                                    {
                                        getKey = "brand";
                                    }
                                    getKey = encodeURIComponent(getKey);                                                  
                                    var tourl = "<?= Url::to(['search/index','facets'=>urlencode('brand|ceshi')]);?>";
                                    p.value = encodeURIComponent(p.value);
                                    console.log(p.value);
                                    tourl = tourl.replace(/ceshi/,p.value); 
                                    tourl = tourl.replace(/brand/,getKey);
                                    console.log(tourl);
                                    window.location.href = tourl;
                                    //$(this).getParent('form').submit();

                                }.bind(j_Brand));
                            })
                        })();
                        
                     
                    </script>  
               
                <fieldset class="gallery-bar-box">
                    <legend>商品排序</legend>
                    <div class="clearfix filter" id='gallerybar' >
                    <?= Html::beginForm(['search/index'], 'get', ['enctype' => 'multipart/form-data','id'=> "J_FForm"]) ?>        
                    <div id="J_fRange" class="fRange">
                        <?php if(isset($searchData['orderby'])&&$searchData['orderby']==4):?>        
                        <b class="fR-cur">                            
                            <i class="fRl-ico-pd"></i>价格从高到低
                        </b>
                        <?php else :?>
                        <b class="fR-cur">                            
                            <i class="fRl-ico-pu"></i>价格从低到高
                        </b>
                        <?php endif; ?>
                            <i class="f-ico-triangle-rb"></i>
                            <ul class="fR-list" style="display:none"> 
                                <li>
                                    <a action="orderby" avalue="4" href=""><i class="fRl-ico-pd"></i>价格从高到低</a>
                                </li>
                                <li>
                                    <a action="orderby" avalue="5" href=""><i class="fRl-ico-pu"></i>价格从低到高</a>
                                </li>                   
                                <li>
                                    <a action="orderby" avalue="1" href="">恢复默认排序</a>
                                </li>
                            </ul> 
                    </div> 
                    <?php if(isset($searchData['orderby'])&&$searchData['orderby']==4):?>
                        <a action="orderby" avalue="5"  title="点击后按价格从低到高" href="" class="fSort fSort-cur">
                            价格<i class="f-ico-triangle-mb f-ico-triangle-mb-slctd"></i><i class="f-ico-triangle-mt " ></i>
                        </a>
                    <?php else:?>
                        <a action="orderby" avalue="4"  title="点击后按价格从高到低" href="" class="fSort fSort-cur">
                            价格<i class="f-ico-triangle-mt f-ico-triangle-mt-slctd  "></i><i class="f-ico-triangle-mb " ></i>
                        </a>
                    <?php endif;?>
                    <div id="J_FPrice" class="fPrice">
                        <div class="fP-box">
                        <b class="fPb-item">
                        <i class="ui-price-plain">¥</i>                     
                        <input type="text" class="j_FPInput" maxlength="8" autocomplete="off" name="price[0]" value="<?= Html::encode(isset($searchData['rangeFrom'])?$searchData['rangeFrom']:"") ?>">
                        </b>
                        <i class="fPb-split"></i>
                        <b class="fPb-item">
                        <i class="ui-price-plain">¥</i>              
                        <input type="text" class="j_FPInput" maxlength="8"  autocomplete="off" name="price[1]" value="<?= Html::encode(isset($searchData['rangeTo'])?$searchData['rangeTo']:"") ?>">
                        </b>
                        </div>
                        <div class="fP-expand">
                        <a id="J_FPCancel" class="ui-btn-s">清空</a>
                        <a atpanel=",,,,shop-fprice,20,fprice," id="J_FPEnter" class="ui-btn-s-primary">确定</a>
                        </div>
                     </div>         
                       <input type="hidden" name="facets" value="<?= Html::encode(isset($searchData['facet'])?$searchData['facet']:"") ?>" />
                       <input type="hidden" name="search" value="<?= Html::encode(isset($searchData['term'])?$searchData['term']:"") ?>" />
                       <input type="hidden" name="orderby"value="" >
                       <?= Html::endForm() ?>
                       <!--<p class="ui-page-s"><b class="ui-page-s-len">2/25</b><a href="http://www.ftzmall.com.cn/gallery-index---5-0-1--grid-g.html" class="ui-page-s-prev" title=上一页>&lt;</a><a href="http://www.ftzmall.com.cn/gallery-index---5-0-3--grid-g.html" class="ui-page-s-next" title=下一页>&gt;</a></p>-->
                    </div>
                </fieldset>

                <div class="grid clearfix" id="gallery-grid-list">                   
                    <?php Pjax::begin(['options' => ['id' => 'gallery-grid-list']]); ?>
                    <?php                    
                    /*
                        echo ListView::widget([
                            'dataProvider' => $product,
                            'itemView' => '_searchItem', //子视图
                            'itemOptions' => ['style' => 'float:left'],
                            'layout' => '{items}',
                            'viewParams' => [
                                //'conditions' => $conditions,
                            ]
                        ]);
                    */
                        echo ListView::widget([ //这个是不分跨境跟一般商品排序的
                            'dataProvider' => $product,
                            'itemView' => '_searchItem2', //子视图
                            'itemOptions' => ['style' => 'float:left'],
                            'layout' => '{items}',
                            'viewParams' => [
                                //'conditions' => $conditions,
                            ]
                        ]);
                    ?>                
                </div>               
                <div class="pager">
                     <?=
                        LinkPager::widget([
                            'pagination' => $dataProvider->getPagination(),
                            'options' => ['style' => 'margin:0', 'class' => 'pagination'],
                            'linkOptions' => ['onclick'=>'scroll();'],
                            'activePageCssClass' => 'pagecurrent',
                            'internalPageCssClass' => 'pagernum',
                            'prevPageCssClass' => 'prevOrder',
                            'nextPageCssClass' => 'nextOrder',
                            'disabledPageCssClass' => '',
                        ]);
                    ?>
                </div>  
                <?php Pjax::end(); ?> 
            </div>          
        </div>        
    </div>
</div>


<div class="index_m4_bottom_line"></div>

<!-- <div class="sidebar-right">
    <a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
    <a href="javascript:void(0)" class="sidebar-backtop"></a>
    <a href="javascript:void(0)" class="sidebar-close"></a>
</div> -->
<script>
    (function() {
        $$('.sidebar-backtop').addEvent('click', function() {
            $(window).scrollTo(0, 0)
        });
        $$('.sidebar-close').addEvent('click', function() {
            $$('.sidebar-right').setStyle('display', 'none')
        })
    })();
</script>

<script>
    window.addEvent('domready', function() {
        $('J_fRange').addEvents({
            mouseover: function() {
                $(this).getElement('ul').setStyle('display', 'block');
            },
            mouseleave: function() {
                $(this).getElement('ul').setStyle('display', 'none');
            }
        });
        if ($('J_FOriginArea')) {
            $('J_FOriginArea').addEvents({
                mouseover: function() {
                    $(this).getElement('.fA-list').setStyle('display', 'block');
                },
                mouseleave: function() {
                    $(this).getElement('.fA-list').setStyle('display', 'none');
                },
                click: function(e) {
                    var el = e.target;
                    if (el.get('tag') == 'a') {
                        e.stop();
                        var input = $('J_FOAInput');
                        var data_val = el.get('data-val');
                        if (data_val) {
                            input.value = data_val == 'ALL' ? '' : data_val;
                        } else {
                            input.value = el.get('html');
                        }
                        input.getParent('.fAl-custom').submit();
                    }
                }
            });
        }
        if ($('J_FMenu')) {
            var j_FMcExpand = $('J_FMenu').getElement('.j_FMcExpand');
            if (j_FMcExpand) {
                j_FMcExpand.addEvent('click', function(e) {
                    e.stop();
                    var div = $(this).getParent('.fMenu');
                    div.toggleClass('fMenu-expand');
                    $(this).toggleClass('ui-more-expand-l');
                    $(this).toggleClass('ui-more-drop-l');
                    if (div.hasClass('fMenu-expand')) {
                        $(this).set('html', '收起<i class="ui-more-expand-l-arrow"></i>');
                    } else {
                        $(this).set('html', '更多<i class="ui-more-drop-l-arrow"></i>');
                    }
                });
            }
            $('J_FMenu').getElements('input[type=checkbox]').addEvent('click', function(e) {
                $('J_FForm').submit();
            });
        }
        var jprice = $('J_FPrice');
        jprice.getElements('input').each(function(el) {
            el.addEvents({
                focus: function() {
                    jprice.addClass('fPrice-hover');
                },
                blur: function() {
                    //jprice.removeClass('fPrice-hover');
                }
            });
        });
        //jprice.addEvent('mouseleave',function(){jprice.removeClass('fPrice-hover');});
        document.body.addEvent('click', function(e) {
            var el = e.target;
            if (el.getParent('.fPrice')) {
                return;
            }
            jprice.removeClass('fPrice-hover');
        });
        $('J_FForm').addEvent('click', function(e) {
            var el = e.target;
            if (el.get('tag') == 'a') {
                e.stop();
                if (el.get('action')) {
                    $('J_FForm').getElement('input[name="' + el.get('action') + '"]').value = el.get('avalue');
                    $('J_FForm').submit();
                }
                if (el.get('id') == 'J_FPCancel') {
                    jprice.getElements('input').map(function(el, index, arr) {
                        el.value = '';
                        arr[0].focus()
                    });
                    $('J_FForm').submit();
                }
                if (el.get('id') == 'J_FPEnter') {
                    $('J_FForm').submit();
                }

            }

        });
        new DataLazyLoad({lazyDataType: 'img', img: 'lazyload'});
        try {
            /*关键字高亮*/
            (function(replace_str) {
                var replace = replace_str.split("+");
                if (replace.length) {
                    $$('.entry-title, .productShop-name, .shop-header-title').each(function(r) {
                        for (i = 0; i < replace.length; i++) {
                            if (replace[i]) {
                                var reg = new RegExp("(" + replace[i].escapeRegExp() + ")", "gi");
                                r.set('text', r.get('text').replace(reg, function() {
                                    return "{0}" + arguments[1] + "{1}";
                                }));
                            }
                        }
                        r.set('html', r.get('text').substitute({0: "<font color=red>", 1: "</font>"})); //原来的增加样式有问题
                    });
                }
            })('');
        } catch (e) {
        }







        //Gallery bar 滚动定位 -- by Tyler Chao
        
    });
        
    /*
     *商品标签定位
     */
    /*window.addEvent('domready', function() {
        var tips = $$('.goods-tip');
        //var opacity = tips.getElement('img').get('op')[0];
        //tips.getElement('img').setStyle('opacity',opacity);
        if (tips.length > 0) {
            var parSize = {
                x: tips.getParent('.goodpic')[0].getSize().x,
                y: tips.getParent('.goodpic')[0].getSize().y
            };
            var GoodsTipPos = {
                tl: {
                    left: 0,
                    top: 0
                },
                tc: {
                    left: (parSize.x) / 2 - 25,
                    top: 0
                },
                tr: {
                    top: 0,
                    right: 0
                },
                ml: {
                    left: 0,
                    top: (parSize.y) / 2 - 25
                },
                mc: {
                    left: (parSize.x) / 2 - 25,
                    top: (parSize.y) / 2 - 25
                },
                mr: {
                    top: (parSize.y) / 2 - 25,
                    right: 0
                },
                bl: {
                    bottom: 0,
                    left: 0
                },
                bc: {
                    bottom: 0,
                    left: (parSize.x) / 2 - 25
                },
                br: {
                    bottom: 0,
                    right: 0
                }
            };
            tips.each(function(v) {
                v.getElement('img').addEvent('load', function() {
                    this.zoomImg(30, 30);
                });
                var ImgSrc = v.getElement('img').get('src');
                if (Browser.ie6)
                    v.getElement('img').setStyle('filter', "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + ImgSrc + "')");
                var proPos = v.getElement('img').get('pos');
                var Pos = GoodsTipPos[proPos];
                v.setStyles({
                    'top': Pos.top,
                    'left': Pos.left,
                    'right': Pos.right,
                    'bottom': Pos.bottom
                });
            });
        }
    });*/
</script>

<script>
    function scroll(){
        jQuery("html, body").animate({scrollTop: 420}, 2000);
    }
</script>
