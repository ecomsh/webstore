<?php
use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\UserAsset;
use yii\bootstrap\ActiveForm;
//use mobile\widgets\Alert;
/* @var $this \yii\web\View */
/* @var $content string */
UserAsset::register($this);
$this->title = '实名认证_上海外高桥进口商品网';
?>
    <?php $this->beginPage() ?>
        <!DOCTYPE html>
        <html lang="<?= Yii::$app->language ?>" class="am-touch js cssanimations">

        <head>
            <meta charset="<?= Yii::$app->charset ?>">
            <?= Html::csrfMetaTags() ?>
                <title>
                    <?= Html::encode($this->title) ?>
                </title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="renderer" content="webkit">
                <meta name="generator" content="ecos.b2c">
                <meta http-equiv="Cache-Control" content="no-siteapp" />
                <meta name="keywords" content=" ">
                <meta name="description" content=" ">
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
                <?php $this->head() ?>
        </head>

        <body>
            <?php $this->beginBody() ?>
                <div class="m-page" style="">
                    <div class="m-header">
                        <div class="header-left-btn">
                            <span onclick="history.back()" class="icon-back"></span>
                        </div>
                        <h2>实名认证</h2>
                        <div class="header-right-btn">
                            <a href="index.html" class="icon-home"></a>
                        </div>
                    </div>
                    <div class="full-screen">
                        <div class="full-padding">
                            <div style="margin-top:20px;">提示信息： 因涉及国家监管部门规定，需要对购买人信息实名备案，遇优购网站不会保留相关个人隐私信息，请放心填写。</div>
                            <form action="http://bbctest.ftzmall.com.cn/wap/passport-create.html" method="post" class="form" data-type="ajax">
                                <input type="hidden" id="realnameapi-type" name="RealnameApi[type]" value="1">
                                <div class="login-box">
                                    <div class="c-g">
                                        <?= $form->field($model, 'realName')->textInput([ 'class' => 'text', 'size' => 30, 'placeholder' => '请输入收件人姓名']) ?>
                                        <!--<label for="" class="c-l">
                                            收件人姓名
                                        </label>
                                        <div class="x1">
                                            <input type="text" name="pam_account[login_name]" class="text" placeholder="请填写手机号" required="required" autofocus="" data-caution="用户名不能为空">
                                        </div>-->
                                    </div>
                                    <div class="c-g">
                                        <label for="" class="c-l">
                                            手机号
                                        </label>
                                        <div class="x1">
                                            <input type="text" name="pam_account[login_name]" class="text" placeholder="请填写手机号" required="required" autofocus="" data-caution="用户名不能为空">
                                        </div>
                                    </div>
                                    <div class="c-g">
                                        <label for="" class="c-l">
                                            证件类型
                                        </label>
                                        <select style="  width: 7rem;height: 2rem;">
                                            <option value="a" selected>请选择</option>
                                            <option value="b">身份证</option>
                                            <option value="o">护照</option>
                                            <option value="m">其他</option>
                                        </select>
                                    </div>
                                    <div class="c-g">
                                        <label for="" class="c-l">
                                            证件号码
                                        </label>
                                        <div class="x">
                                            <input type="password" name="pam_account[login_password]" maxlength="20" placeholder="" required="required" pattern=".{6,20}" class="text" data-caution="密码不能为空">
                                        </div>
                                    </div>

                                    <div class="btn-bar mt20">
                                        <button type="submit" class="btn red_btn" rel="_request">提交认证</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php $this->endBody() ?>
                    <!--         <script>jQuery.noConflict();</script> -->
        </body>

        </html>
        <?php $this->endPage() ?>