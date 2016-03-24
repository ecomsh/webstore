<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use mobile\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
$this->title = '实名认证_上海外高桥进口商品网';
?>
    
                <div class="m-page" style="">
                    <div class="m-header">
                        <div class="header-left-btn">
                            <span onclick="history.back()" class="icon-back"></span>
                        </div>
                        <h2>实名认证</h2>
                        <div class="header-right-btn">
                            <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
                        </div>
                    </div>
                    <div class="full-screen">
                        <div class="full-padding">
                            <div style="margin-top:20px;">提示信息： 因涉及国家监管部门规定，需要对购买人信息实名备案，本网站不会保留相关个人隐私信息，请放心填写。</div>
                            <?php
                                $options = [];
                                $options['enableClientValidation'] = true;
                                $options['fieldConfig'] = ['template' => "{label}<div class='x1'>{input}</div>{error}"];
                                $form = ActiveForm::begin($options);
                            ?> 
                            <?php
                                //echo Alert::widget();
                            ?>
                                <input type="hidden" id="realnameapi-type" name="RealnameApi[type]" value="1">
                                <div class="login-box">
                                     <div class="c-g">
                                    <?= $form->field($model, 'realName',['labelOptions' => ['class' => 'c-l']])->textInput([ 'class' => 'text', 'size' => 30, 'placeholder' => '请输入收件人姓名']) ?>
                                    </div>
                                    <div class="c-g">
                                        <?= $form->field($model, 'mobile',['labelOptions' => ['class' => 'c-l']])->textInput([ 'class' => 'text', 'size' => 30, 'placeholder' => '请输入收件人手机号码']) ?>
                                    </div>
                                    <div class="c-g">
                                        <?= $form->field($model, 'email',['labelOptions' => ['class' => 'c-l']])->textInput([ 'class' => 'text', 'size' => 30, 'placeholder' => '请输入常用Email']) ?>
                                    </div>
                                    <div class="c-g">
                                        <?= $form->field($model, 'identityType',['labelOptions' => ['class' => 'c-l']])->dropDownList(['1' => '身份证'], ['prompt' => '请选择', 'style' => 'width: 7rem;height: 2rem;']) ?>
                                    </div>
                                    <div class="c-g">
                                        <?= $form->field($model, 'identityNumber',['enableAjaxValidation'=>true ,'labelOptions' => ['class' => 'c-l']])->textInput([ 'class' => 'text', 'size' => 30, 'placeholder' => '请输入正确的证件号码']) ?>       
                                    </div>

                                    <div class="btn-bar mt20">
                                        <?= Html::submitButton('提交认证', ['class' => 'btn red_btn']) ?>                                             
                                    </div>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>

                <script>    
                    $('input#realnameapi-mobile').parent().parent().parent().css('display', 'none');
                </script>
