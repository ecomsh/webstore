<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\CommentAsset;
CommentAsset::register($this);
/* @var $this yii\web\View */
$this->title = '添加评论_上海外高桥进口商品网';
?>
<div class = "main w1200" style="width:1000px">
    <div class = "mTB">
        <div class = "memberwrap mall_comment_width">
            <div class = "clearfix">
                <div>
                    <?php
                    $options = [];                        
                    $options['enableClientValidation'] = true;   
                    $options['options'] = ['class' => 'addcomment'];
                    $options['fieldConfig'] = ['template' => "{label}{input}{error}",'horizontalCssClasses' => ['label' => 'control-label']];        
                    $form = ActiveForm::begin($options);                        
                    ?> 
                        <div class = "review-box">
                            <h4 class = "review-title">评论宝贝</h4>
                            <div class = "division clearfix">
                                <ul>      
                                    <li>
                                        <div class = "mall_com_pro_tit">
                                            <a class = "mall_com_pro_tit_a" href = "<?= Yii::$app->params['baseUrl'] ?>product-1487.html" target = "_blank">
                                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>87984c1b1e71ac8f8f3e8a6bc853a16df4c.jpg" width = "40" height = "40">
                                            </a>
                                            <span class = "mall_com_pro_tit_text">美国 CeraVe 补水保湿滋润洗面奶 87ml</span>
                                            <span class = "cl_zhi"></span>
                                        </div>
                                        <div class = "mall_com_pro_comment_info">
                                            <div class = "mall_comment_user"><?= Html::encode($data['content']) ?>&nbsp;
                                                <span>[<?= Html::encode($data['createTime']) ?>]</span></div>
                                            <div class = "mall_com_pro_comment_info_noname">
                                                <?= $form->field($model, 'commentId' ,['labelOptions' => ['style' => 'display:none']])->hiddenInput(['value'=> $data['id']]) ?>                                         
                                            </div>
                                                <?= $form->field($model, 'content')->textarea(['label' => '', 'rows' => 5, 'cols' => 112 ,  'style'=>'max-width:960px;max-height:340px' , 'class' => 'x-input inputstyle font12px db mb5' , 'placeholder'=>'欢迎发表评论（最多1000字）']) ?>
                                            <div class = "cl_zhi"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class = "mall_comment_submit_but">                           
                            <?= Html::submitButton('追加评论', ['class' => 'btn submit-btn']) ?> 
                            <button class = "btn btn btn-quit" type = "button" onclick = ""><span><span>退出</span></span></button> </div>
                    <?php ActiveForm::end(); ?>
                </div>
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
                var objPoint = $$('.star-point-items') || [];
                if (objPoint)
                    objPoint.each(function(i) {
                        var _c = i.getNext();
                        var _b = i.getElement('.b');
                        var _f = i.getElement('.f');
                        var _ipt = i.getNext('input');
                        _ipt.value = 5;
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
                                _c.set('text', _ipt.value = count);
                            },
                            'mouseenter': function(e) {
                                this.fireEvent('mousemove', e);
                            },
                            'mouseout': function(e) {
                                if (_b.getStyle('left') === '-92px') {
                                    _b.setStyle('left', '0');
                                    _c.set('text', 5);
                                }
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