<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use frontend\assets\ftzmallnew\MainAsset;
use frontend\assets\ftzmallnew\UserAsset;
use frontend\assets\ftzmallnew\SettingAsset;

MainAsset::register($this);
UserAsset::register($this);
SettingAsset::register($this);



/* @var $this yii\web\View */
$this->title = '账户信息_上海外高桥进口商品网';
?>

<div class="container user-color">
    <?= $this->render('../layouts/_user-nav-left') ?>
    <div class="member-right-order">
        <div class="orderlist-warp">
            <h3>个人信息&nbsp;&nbsp;<span>|&nbsp;&nbsp;请尽量完整填写您的个人信息，方便店家与您联系。</span></h3>
            <div class="col-lg-8">

                <?php if ($model->mobile) { ?>
                    <form class="form-horizontal">
                        <div class="form-group field-bindmobileform-mobile required has-success">
                            <label class="control-label pw-title" for="bindmobileform-mobile">手机号: </label>
                            <input type="text" id="bindmobileform-mobile" class="form-control pw-input" name="BindMobileForm[mobile]" value="<?= $model->mobile ?>" placeholder="手机号" readonly="true">
                        </div> 
                    </form>
                    <?php
                } else {
                    $options = [];
                    $options['options'] = ["class" => "form-horizontal", 'action' => Url::to(["user/setting"])];
                    $options['enableClientValidation'] = true;
                    $options['enableAjaxValidation'] = true;

                    $options['fieldConfig'] = [
                        'errorOptions' => ['class' => 'help-block help-block-error pw-prompt'],
                        'labelOptions' => ['class' => 'control-label pw-title']
                    ];
                    $form = ActiveForm::begin($options);
                    ?>
                    <?= $form->field($model, 'mobile')->textInput([ 'class' => 'form-control pw-input', 'placeholder' => '手机号']) ?>
                    <?=
                    $form->field($model, 'smsCode', ['enableAjaxValidation' => true, 'template' => '{label}{input}&nbsp;&nbsp;
                        <input type="button" class="getValiCode" value="获取验证码"> {error}', 'options' => ['class' => 'form-group has-success success-shadow']])->textInput([
                        'class' => 'form-control pw-input', 'placeholder' => "短信验证码", 'data-caution' => "验证码不能为空"])
                    ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger pw-btn">绑定手机</button>
                    </div>
                    <?= Alert::widget(); ?>
                    <?php
                    ActiveForm::end();
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    var valmobileurl = '<?= Url::to(["user/valmobile"]) ?>';
    var getsmscodeurl = '<?= Url::to(["user/getsmscode"]) ?>';
</script>

