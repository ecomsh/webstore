<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use frontend\assets\ftzmallnew\UserAsset;
use frontend\assets\ftzmallnew\AlertAsset;

UserAsset::register($this);
AlertAsset::register($this);

$this->title = '实名认证_上海外高桥进口商品网';
?>
<div class="container user-color">
    <div class="order-verified">
        <h4>入境国际快件实名信息登记</h4>
        <h5>
            --根据中国海关规定，为防止变相走私，证明包裹内物品确实为个人自用，个人包裹办理海关入境清关手续需要提交收件人身份证明。
            海关相关规定请参考《中华人民共和国海关对进出境快件监管办法》第二十二条，或致电海关咨询：12360
            国际速递承诺身份证图片自动添加合成用途说明水印、所有信息均进行加密存储，直接提交给海关清关时进行查验，绝不用做其他途径， 其他任何人均无法查看。
        </h5>
        <h6>海关清关入境包裹，请配合提交收件人身份证明</h6>
        <div class="confirm-infor">
            <div class="confirm-infor-title">请您输入收件人详细资料并进行确认！（只需花您一分钟时间）</div>
            <div class="col-lg-8">
                <?php
                $options = [];
                $options['options'] = ["class" => "form-horizontal"];
                $options['enableClientValidation'] = true;
                $options['fieldConfig'] = ['labelOptions' => ['class' => 'control-label verified-title'],
                        //   'template'=>"{input}\n<div class=\"ppp\">{error}</div>"
                        // 'labelOptions' => ['class' => 'ddd'],  
                ]; //'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']];

                $form = ActiveForm::begin($options);
                ?> 
                <?=
                Alert::widget(['alertTypes' => [
                        'realname_success' => 'alert-success',
                        'realname_error' => 'alert-danger',
                        'realname_danger' => 'alert-danger',
                        'realname_info' => 'alert-info',
                        'realname_warning' => 'alert-warning'],
                    'closeButton' => false]);
                ?>

                <?= $form->field($model, 'type')->hiddenInput(['value' => 1]) ?>
                <?= $form->field($model, 'realName')->textInput([ 'class' => 'form-control pw-input', 'placeholder' => '请输入收件人姓名']) ?>
                <?= $form->field($model, 'mobile')->textInput([ 'class' => 'form-control pw-input', 'placeholder' => '请输入收件人手机号码']) ?>
                <?= $form->field($model, 'email')->textInput([ 'class' => 'form-control pw-input', 'placeholder' => '请输入您的常用邮箱']) ?>
                    <?= $form->field($model, 'identityType')->dropDownList(['1' => '身份证'], ['prompt' => '请选择', 'class' => 'form-control pw-input verified-select']) ?>
                    <?= $form->field($model, 'identityNumber', ['enableAjaxValidation' => true])->textInput([ 'class' => 'form-control pw-input', 'placeholder' => '请输入正确的证件号码']) ?>                                       
                <div class="form-group">
                     <?php $defaultUrl = Url::to(['order/index']); ?>
                <?= Html::submitButton('提 交', ['class' => 'btn btn-success verified-btn']) ?> 
                <?= Html::button('返 回', ['class' => 'btn btn-danger verified-btn','onclick' => 'location=(\'' . $defaultUrl . '\')']) ?>    
                </div> 
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>