<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mobile\models\ResetPasswordForm */

$this->title = '修改密码';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="m-page">
        <div class="m-header">
            <div class="header-left-btn">
                <span onclick="history.back()" class="icon-back"></span>
            </div>
            <h2>修改密码</h2>
            <div class="header-right-btn">
                <a href="#" class="icon-home"></a>
            </div>
        </div>
        <div class="full-screen">
            <div class="full-padding">
                <div class="" style="margin:20px 10px;">
                    <strong style="margin-top:20px;margin-bottom:20px;">请设置您的密码:</strong>
                    <div class="">
                        <?php $form = ActiveForm::begin(['id' => 'change-password-form']); ?>
                            <?= $form->field($model, 'oldPassword')->passwordInput() ?>
                                <?= $form->field($model, 'password')->passwordInput() ?>
                                    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
                                        <div class="form-group">
                                            <?= Html::submitButton('Change', ['class' => 'btn btn-primary red_btn']) ?>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
