<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\CommentAsset;
CommentAsset::register($this);
/* @var $this yii\web\View */
$this->title = '添加评论_上海外高桥进口商品网';
?>
<script>
    window.loadedPart = [1, 0, (new Date).getTime()];
    BREADCRUMBS = '0:0';
    MODALPANEL = {
        createModalPanel: function() {
            var mp = new Element('div', {'id': 'MODALPANEL'});
            var mpStyles = {
                'position': 'fixed',
                'background': '#333333',
                'width': '100%',
                'display': 'none',
                'height': window.getScrollSize().y,
                'top': 0,
                'left': 0,
                'zIndex': 65500,
                'opacity': .4
            };
            this.element = mp.setStyles(mpStyles).inject(document.body);
            return this.element;
        },
        show: function() {
            var panel = this.element = this.element || this.createModalPanel();
            panel.setStyles({
                'width': '100%',
                'height': window.getScrollSize().y
            }).show();
        }, hide: function() {
            if (this.element)
                this.element.hide();
        }
    };
    Xtip = new Tips({tip: 'tip_Xtip', fixed: true, offset: {x: 24, y: -15}, onBound: function(bound) {
            if (bound.x2) {
                this.tip.getElement('.tip-top').addClass('tip-top-right');
                this.tip.getElement('.tip-bottom').addClass('tip-bottom-right');
            } else {
                this.tip.getElement('.tip-top').removeClass('tip-top-right');
                this.tip.getElement('.tip-bottom').removeClass('tip-bottom-right');
            }
        }});
    var LAYOUT = {
        container: $('container'),
        side: $('side'),
        workground: $('workground'),
        content_main: $('main'),
        content_head: $E('#workground .content-head'),
        content_foot: $E('#workground .content-foot'),
        side_r: $('side-r'),
        side_r_content: $('side-r-content')
    };
</script>

<div class = "main w1200">
    <div class = "mTB">
        <div class = "memberwrap mall_comment_width">
            <div class = "clearfix">
                <form class = "addcomment" method = "post" action = "<?= Yii::$app->params['baseUrl'] ?>bcomment-toComment-discuss-2015070310969894.html">
                    <div class = "review-box">
                        <h4 class = "review-title">评论宝贝</h4>
                        <div class = "division clearfix discuss_goods">
                            <input type = "hidden" name = "order_id[]" value = "2015070310969894">
                            <input type = "hidden" name = "goods_id[2015070310969894][]" value = "1585">
                            <div class = "mall_com_pro_tit">

                                <a class = "mall_com_pro_tit_a" href = "<?= Yii::$app->params['baseUrl'] ?>product-1585.html" target = "_blank">
                                    <img src = "<?= Yii::$app->params['baseimgUrl'] ?>da0171d48dfce3e1f7b82c09986885d435a.jpg" width = "40" height = "40">
                                </a>
                                <span class = "mall_com_pro_tit_text">Emporio Armani 安普里奥·阿玛尼 男士短袖</span>
                                <span class = "cl_zhi"></span>
                            </div>

                            <div class = "mall_com_pro_comment_info">

                                <div class = "start-point">
                                    <ul class = "comm_point">
                                        <li>
                                            <div class = "span-2 textright"><label>商品评分:</label></div>
                                            <div id = "rate_0" class = "star-point-items span-auto">
                                                <div class = "b" style = "left:0px;">&nbsp;
                                                </div>
                                                <div class = "f">&nbsp;
                                                </div>
                                            </div>
                                            <div class = " span-auto font11px" style = "color:orange;">5</div>
                                            <input type = "hidden" name = "goods_point[2015070310969894][goods][1585][0]" value = "5">
                                        </li>
                                    </ul>
                                </div>

                                <div class = "mall_com_pro_comment_info_noname">
                                    <label for = "publish_1585">匿名发表:</label>
                                    <input type = "checkbox" id = "publish_1585" name = "hidden_name[2015070310969894][1585]" value = "YES">
                                </div>

                                <textarea type = "textarea" class = "x-input inputstyle font12px db mb5" placeholder = "欢迎发表评论（最多1000字）" vtype = "sendcomments" rows = "5" name = "comment[2015070310969894][1585]" style = "width:700px" id = "dom_el_1351be0"></textarea>
                                <div class = "cl_zhi"></div>
                            </div>
                            <ul class = "comm_point">
                                <li>
                                    <div class = "span-2 textright"><label>描述相符:</label></div>
                                    <div id = "rate_1" class = "star-point-items span-auto">
                                        <div class = "b" style = "left:0px;">&nbsp;
                                        </div>
                                        <div class = "f">&nbsp;
                                        </div>
                                    </div>
                                    <div class = "mall_span-auto span-auto font11px" style = "color:orange;">5</div>
                                    <div class = "span-auto">质量非常好，与卖家描述的完全一致，非常满意</div>
                                    <input type = "hidden" name = "point_type[2015070310969894][store][1]" value = "5">
                                </li>
                                <li>
                                    <div class = "span-2 textright"><label>服务态度:</label></div>
                                    <div id = "rate_2" class = "star-point-items span-auto">
                                        <div class = "b" style = "left:0px;">&nbsp;
                                        </div>
                                        <div class = "f">&nbsp;
                                        </div>
                                    </div>
                                    <div class = "mall_span-auto span-auto font11px" style = "color:orange;">5</div>
                                    <div class = "span-auto">卖家的服务太棒了，考虑非常周到，完全超出期望值</div>
                                    <input type = "hidden" name = "point_type[2015070310969894][store][2]" value = "5">
                                </li>
                                <li>
                                    <div class = "span-2 textright"><label>发货速度:</label></div>
                                    <div id = "rate_3" class = "star-point-items span-auto">
                                        <div class = "b" style = "left:0px;">&nbsp;
                                        </div>
                                        <div class = "f">&nbsp;
                                        </div>
                                    </div>
                                    <div class = "mall_span-auto span-auto font11px" style = "color:orange;">5</div>
                                    <div class = "span-auto">卖家发货速度非常快，包装非常仔细、严实</div>
                                    <input type = "hidden" name = "point_type[2015070310969894][store][3]" value = "5">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class = "mall_comment_submit_but">
                        <button class = "btn submit-btn" type = "submit"><span><span>评论</span></span></button><button class = "btn btn btn-quit" type = "button" onclick = ""><span><span>退出</span></span></button> </div>
                </form>
            </div>
        </div>
        <script>
            var dataInfo = [Array];
            if (!dataInfo.length)
                history.back();
            window.addEvent('domready', function() {
                validatorMap['sendcomments'] = ['字数应该在1-1000个字之内', function(element, v) {
                        if ($(element).get('value') == '' || $(element).get('value').length < 1 || $(element).get('value').length > 1000) {
                            return false;
                        }
                        else
                            return true;
                    }];
                var objVcode = $$('.showdisaskvcode') || [];
                if (objVcode) {
                    objVcode.addEvent('focus', function() {
                        if (this.retrieve('showdisaskvcode', false))
                            return;
                        var vcodeImg = this.getNext('img');
                        vcodeImg.src = vcodeImg.get('codesrc') + '?' + (+new Date());
                        vcodeImg.show();
                        this.store('showdisaskvcode', true);
                    });
                    objVcode.fireEvent('focus');
                }
                var comment_des = new Hash({"1": {"5": "\u8d28\u91cf\u975e\u5e38\u597d\uff0c\u4e0e\u5356\u5bb6\u63cf\u8ff0\u7684\u5b8c\u5168\u4e00\u81f4\uff0c\u975e\u5e38\u6ee1\u610f", "4": "\u8d28\u91cf\u4e0d\u9519\uff0c\u4e0e\u5356\u5bb6\u63cf\u8ff0\u7684\u57fa\u672c\u4e00\u81f4\uff0c\u8fd8\u662f\u633a\u6ee1\u610f\u7684", "3": "\u8d28\u91cf\u4e00\u822c\uff0c\u6ca1\u6709\u5356\u5bb6\u63cf\u8ff0\u7684\u90a3\u4e48\u597d", "2": "\u90e8\u5206\u6709\u7834\u635f\uff0c\u4e0e\u5356\u5bb6\u63cf\u8ff0\u7684\u4e0d\u7b26\uff0c\u4e0d\u6ee1\u610f", "1": "\u5dee\u7684\u592a\u79bb\u8c31\uff0c\u4e0e\u5356\u5bb6\u63cf\u8ff0\u7684\u4e25\u91cd\u4e0d\u7b26\uff0c\u975e\u5e38\u4e0d\u6ee1"}, "2": {"5": "\u5356\u5bb6\u7684\u670d\u52a1\u592a\u68d2\u4e86\uff0c\u8003\u8651\u975e\u5e38\u5468\u5230\uff0c\u5b8c\u5168\u8d85\u51fa\u671f\u671b\u503c", "4": "\u5356\u5bb6\u670d\u52a1\u633a\u597d\u7684\uff0c\u6c9f\u901a\u633a\u987a\u7545\u7684\uff0c\u603b\u4f53\u6ee1\u610f", "3": "\u5356\u5bb6\u56de\u590d\u5f88\u6162\uff0c\u6001\u5ea6\u4e00\u822c\uff0c\u8c08\u4e0d\u4e0a\u6c9f\u901a\u987a\u7545", "2": "\u5356\u5bb6\u6709\u70b9\u4e0d\u8010\u70e6\uff0c\u627f\u8bfa\u7684\u670d\u52a1\u4e5f\u5151\u73b0\u4e0d\u4e86", "1": "\u5356\u5bb6\u6001\u5ea6\u5f88\u5dee\uff0c\u8fd8\u9a82\u4eba\u3001\u8bf4\u810f\u8bdd\uff0c\u7b80\u76f4\u4e0d\u628a\u987e\u5ba2\u5f53\u56de\u4e8b"}, "3": {"5": "\u5356\u5bb6\u53d1\u8d27\u901f\u5ea6\u975e\u5e38\u5feb\uff0c\u5305\u88c5\u975e\u5e38\u4ed4\u7ec6\u3001\u4e25\u5b9e", "4": "\u5356\u5bb6\u53d1\u8d27\u633a\u53ca\u65f6\u7684\uff0c\u8fd0\u8d39\u6536\u53d6\u5f88\u5408\u7406", "3": "\u5356\u5bb6\u53d1\u8d27\u901f\u5ea6\u4e00\u822c\uff0c\u63d0\u9192\u540e\u624d\u53d1\u8d27\u7684", "2": "\u5356\u5bb6\u53d1\u8d27\u6709\u70b9\u6162\u7684\uff0c\u50ac\u4e86\u51e0\u6b21\u7ec8\u4e8e\u53d1\u8d27\u4e86", "1": "\u518d\u4e09\u63d0\u9192\u4e0b\uff0c\u5356\u5bb6\u624d\u53d1\u8d27\uff0c\u803d\u8bef\u6211\u7684\u65f6\u95f4\uff0c\u5305\u88c5\u4e5f\u5f88\u9a6c\u864e"}});
                var objPoint = $$('.star-point-items') || [];
                if (objPoint)
                    objPoint.each(function(i) {
                        var _c = i.getNext();
                        var _b = i.getElement('.b');
                        var _f = i.getElement('.f');
                        var _ipt = i.getNext('input');
                        var fenshu = _ipt.value = 5;
                        var type = parseInt(i.get('id').substring(5));
                        var _t = i.getNext().getNext();
                        if (type)
                            _t.set('text', (_ipt.value == 0 ? '' : comment_des[type][_ipt.value]));
                        i.addEvents({
                            'mousemove': function(e) {
                                var offset = (e.page.x - i.getPosition([document.body]).x);
                                var _left = (offset - i.offsetWidth).limit(0 - i.offsetWidth, 0);
                                var count = (5 * ((i.offsetWidth + _left) / (i.offsetWidth)));
                                if (count < 0.3) {
                                    count = 0
                                } else {
                                    count = Math.ceil(count);
                                }
                                _b.setStyle('left', i.offsetWidth * (count / 5) - i.offsetWidth);
                                _c.set('text', count);
                                fenshu = count;
                                if (type)
                                    _t.set('text', (fenshu == 0 ? '' : comment_des[type][fenshu]));
                            },
                            'mouseenter': function(e) {
                                this.fireEvent('mousemove', e);
                            },
                            'mouseout': function(e) {
                                fenshu = _ipt.value ? _ipt.value : 5;
                                _b.setStyle('left', i.offsetWidth * (fenshu / 5) - i.offsetWidth);
                                _c.set('text', fenshu);
                                if (type)
                                    _t.set('text', (fenshu == 0 ? '' : comment_des[type][fenshu]));
                            },
                            'click': function(e) {
                                _ipt.value = fenshu;
                                if (type)
                                    _t.set('text', (_ipt.value == 0 ? '' : comment_des[type][_ipt.value]));
                            }
                        });
                        /* fix png */
                        if (Browser.ie6) {
                            _f.setStyles({
                                'filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=image, src=' + _f.getStyle('background-image').match(/url\(([^\)]*)/)[1] + ')',
                                'background': 'none'
                            });
                        }
                    });
                var quit = $E('.btn-quit') || '';
                if (quit)
                    quit.removeEvents('click').addEvent('click', function(e) {
                        Ex_Dialog.confirm('确定退出', function(e) {
                            if (!e)
                                return false;
                            window.location = '<?= Yii::$app->params['baseUrl'] ?>member-comment.html';
                        });
                    });
            });
            function changeimg(id, type) {
                if (type == 'discuss') {
                    $(id).set('src', '<?= Yii::$app->params['baseUrl'] ?>comment-gen_dissvcode.html#' + (+new Date()));
                }
                else {
                    $(id).set('src', '<?= Yii::$app->params['baseUrl'] ?>comment-gen_askvcode.html#' + (+new Date()));
                }
            }
        </script>
    </div>
</div>