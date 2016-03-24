

<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use cashier\assets\LoginAsset;
LoginAsset::register($this);

?>


        <header>
            <div class="container-fluid">
                <h2 class="log-m text-center"><img src="<?=Url::to('@web/images/webpos-logo.png', true)?>" width="486" height="60"></h2>
            </div>
        </header>
        <div class="wrap">
            <div class="container login-container">
                <div class="row clearfix">
                    <div class="col-md-7 pull-left">
                        <a class="webpos-tp" href="#"><img src="<?=Url::to('@web/images/login-ad.png', true)?>" width="514" height="321"></a>
                    </div>
                    <div class="col-md-5 pull-right">
                        <div class="webpos-login">
                            <h4 class="log-title">门店登录</h4>
                                <?php
                                    $options = [];
                                        $options['options'] = ['class' => 'form-horizontal'];
                                        $options['enableClientValidation'] = true;
                                        $options['fieldConfig'] = ['template' => "{label}{input}{error} ",
                                        'errorOptions' => ['class' => 'help-block help-block-error']];
                                        $form = ActiveForm::begin($options);
                                ?>
                                <div class="form-group web-m">
                                    <label class="control-label web-title">用户名：</label>
                                    <span class="web-input">
                                    <?= $form->field($model, 'username', ['options' => ['class' =>' webpos-input store-name']])->textInput(['placeholder' => '请输入用户名'])->label(false);  ?>
                                    </span>
                                    
                                </div>  
                                <div class="form-group web-m">
                                    <label class="control-label web-title">密码：</label>
                                    <span class="web-input">
                                        <?= $form->field($model, 'password', ['options' => ['class' =>' webpos-input store-pd']])->passwordInput(['placeholder' => '请输入密码'])->label(false);     ?>
                                    </span>
                                </div>
                                
 <?php

    if(Yii::$app->session->hasFlash('error')){


        echo '<p style="text-align:center;color:red;">'.Yii::$app->session->getFlash('error').'</p>';

    }

    ?>
                                


<!--                                 <div class="form-group web-m">
                                    <label class="pull-left font16"><input type="checkbox">&nbsp;自动登录</label>
                                    <span class="pull-right font16 for-pd"><a href="#">忘记密码？</a></span>
                                </div> -->
                                <div class="form-group">
                                    <?= Html::submitButton('立即登录', [ 'class' => 'btn-primary btn-lg btn-block web-btn']); ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>