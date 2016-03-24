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
                <?php
                    $options = [];                        
                    $options['enableClientValidation'] = true;   
                    $options['options'] = ['class' => 'addcomment'];
                    $options['fieldConfig'] = ['template' => "{label}{input}{error}",'horizontalCssClasses' => ['label' => 'control-label']];        
                    $form = ActiveForm::begin($options);                        
                ?>                
                    <div class = "review-box">
                        <h4 class = "review-title">评论宝贝</h4>
                        <div class = "division clearfix discuss_goods">
                            <?= $form->field($model, 'productId' ,['labelOptions' => ['style' => 'display:none']])->hiddenInput(['value'=> $data['productId']]) ?>
                            <?= $form->field($model, 'orderItemId' ,['labelOptions' => ['style' => 'display:none']])->hiddenInput(['value'=> $data['orderItemId']]) ?>
                     
                            <div class = "mall_com_pro_tit">
                                <a class = "mall_com_pro_tit_a" href = "product-1585.html" target = "_blank">
                                    <img src = "<?= Yii::$app->params['baseimgUrl'] ?>da0171d48dfce3e1f7b82c09986885d435a.jpg" width = "40" height = "40">
                                </a>
                                <span class = "mall_com_pro_tit_text">Emporio Armani 安普里奥·阿玛尼 男士短袖</span>
                                <span class = "cl_zhi"></span>
                            </div>

                            <div class = "mall_com_pro_comment_info">
                                <div class = "start-point">
                                    <ul class = "comm_point">
                                        <li>                                        
                                            <?= $form->field($model, 'point')->hiddenInput(['value' => '4']) ?>   
                                            <div id = "rate_0" class = "star-point-items span-auto">
                                                <div class = "b" style = "left:0px;">&nbsp;
                                                </div>
                                                <div class = "f">&nbsp;
                                                </div>
                                            </div>
                                            <div class = "span-auto font11px" id = "starpoint" style = "color:orange;">5</div>
                                        </li>
                                    </ul>
                                </div>

                                <div class = "mall_com_pro_comment_info_noname">
                                    <?= $form->field($model, 'anonymous')->checkbox(['uncheck'=>'false','value'=>'true']) ?>   
                                </div>
                                    <?= $form->field($model, 'content')->textarea(['label' => '', 'rows' => 5, 'cols' => 112 ,  'style'=>'max-width:960px;max-height:340px' , 'class' => 'x-input inputstyle font12px db mb5' , 'placeholder'=>'欢迎发表评论（最多1000字）']) ?>   
                                <div class = "cl_zhi"></div>
                            </div>                           
                        </div>
                    </div>
                    <div class = "mall_comment_submit_but">
                        <?= Html::submitButton('评论', ['class' => 'btn submit-btn']) ?>                      
                        <button class = "btn btn btn-quit" type = "button" onclick = ""><span><span>退出</span></span></button> 
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <script>     
            var objPoint = $$('.star-point-items') || [];
            if (objPoint)    
                objPoint.each(function(i) {
                    var _c = i.getNext();
                    var _b = i.getElement('.b');
                    var _f = i.getElement('.f');                    
                    var _ipt = document.getElementById('commentapi-point');
                    console.log(_f);
                    console.log(_ipt);
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
   
            
        </script>
    </div>
</div>