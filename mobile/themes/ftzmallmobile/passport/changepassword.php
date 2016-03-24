<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mobile\models\ResetPasswordForm */

$this->title = '修改密码_上海外高桥进口商品网';
$this->params['breadcrumbs'][] = $this->title;
?>



    <div class="m-page" style="">
        <div class="m-header">
            <div class="header-left-btn">
                <span onclick="history.back()" class="icon-back"></span>
            </div>
            <h2>修改密码</h2>
            <div class="header-right-btn">
                <a href="<?= Url::to(['user/index'])?>" class="icon-home"></a>
            </div>
        </div>
        <div class="full-screen">
            <div class="full-padding">

                <?php 
                            $options = [];
                            $options['enableClientValidation'] = true;
                            //,['enableAjaxValidation'=>true]
                          $options['fieldConfig'] = ['template' => " <div class='c-g' > {label} <div class='x1'>  {input}  <div class='input-common'></div> </div><div style='clear:both;'></div>{error} </div>", 'labelOptions' => ['class' => 'c-l']];
                            $options['options'] = ['method' => 'post',  'class'=> 'form'];
                             $form = ActiveForm::begin( $options); ?>
                    <div class="login-box">
                        <?= $form->field($model, 'oldPassword')->textInput([ 'class' => 'text', 'placeholder' => '请输入旧密码']) ?>

                            <div class="notice" style="height:10px;"></div>

                            <?= $form->field($model, 'password')->textInput([ 'class'=> 'text', 'type'=>'password', 'placeholder'=>"请输入新密码", 'data-caution'=>"密码栏不能为空"]) ?>
                                <div class="notice" style="height:10px;"></div>
                                <?= $form->field($model, 'confirmPassword')->textInput([ 'class'=> 'text', 'type'=>'password', 'placeholder'=>"请确认新密码", 'data-caution'=>"密码栏不能为空"]) ?>
                                    <div class="notice" style="height:10px;"></div>
                                    <div class="form-group">
                                        <?= Html::submitButton('提交', ['class' => 'btn red_btn']) ?>
                                    </div>
     <?php ActiveForm::end(); ?>
                    </div>


            </div>
        </div>
    </div>
