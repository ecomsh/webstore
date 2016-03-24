<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use frontend\assets\UserAsset;

UserAsset::register($this);
/* @var $this yii\web\View */
$this->title = '实名认证_上海外高桥进口商品网';
?>
<style>
    .help-block-error {
        color: #FF0000;
        padding: 2px 185px;
    }
    select.m-wrap{margin-top: 8px;}
    body, button, input, select, textarea{font:12px/18px tahoma,arial,"Hiragino Sans GB","宋体","Microsoft YaHei",sans-serif;}
</style>
<div class="main w1200">
    <div class="mTB">
        <div class="recordinfo">
            <div class="container">
                <div class="container_name">
                    <div class="title_1">
                        <div class="h1cq">入境国际快件实名信息登记</div>
                        <div class="p_red" class="h5cq">--根据中国海关规定，为防止变相走私，证明包裹内物品确实为个人自用，个人包裹办理海关入境清关手续需要提交收件人身份证明。<br>
                            海关相关规定请参考《中华人民共和国海关对进出境快件监管办法》第二十二条，或致电海关咨询：12360<br>
                            国际速递承诺身份证图片自动添加合成用途说明水印、所有信息均进行加密存储，直接提交给海关清关时进行查验，绝不用做其他途径，
                            其他任何人均无法查看。</div>
                    </div>
                    <div class="title_2">
                        <div class="p_20 h2cq">海关清关入境包裹，请配合提交收件人身份证明</div>                    
                    </div>

                    <div class="container_box">
                        <?php
                        $options = [];
                        $options['enableClientValidation'] = true;
                        $options['fieldConfig'] = ['template' => "{label}{input}{error}", 'horizontalCssClasses' => ['label' => 'control-label']];
                        
                        $form = ActiveForm::begin($options);
                        ?> 
                        <?php
                        echo Alert::widget();
                        ?>
                        <script>
                            jQuery(function () {
                                jQuery("#w1-success-0").slideUp("slow");
                                console.log(111);
                            });

                        </script>
                        <div id="form_div" style="">
                            <a name="form"></a>
                            <div class="h3cq">请您输入收件人详细资料并进行确认！（只需花您一分钟时间）</div>
                            <div class="mig_2wm"></div>                                
                            <div class="control-group">
                                <input type="hidden" id="realnameapi-type" name="RealnameApi[type]" value="1"> <!--type必须有，hidden属性不知道如果用下面那重方式写的话会有样式问题，不知道怎么给单独的label添加样式-->                         
                                <?= '' /* $form->field($model, 'type')->hiddenInput(['value'=>1]) */ ?>
                                <?= $form->field($model, 'realName')->textInput([ 'class' => 'x-input m-wrap medium', 'size' => 30, 'placeholder' => '请输入收件人姓名']) ?>
                                <?= $form->field($model, 'mobile')->textInput([ 'class' => 'x-input m-wrap medium', 'size' => 30, 'placeholder' => '请输入收件人手机号码']) ?>
                                <?= $form->field($model, 'email')->textInput([ 'class' => 'x-input m-wrap medium', 'size' => 30, 'placeholder' => '请输入您的常用邮箱']) ?>
                                <?= $form->field($model, 'identityType')->dropDownList(['1' => '身份证'], ['prompt' => '请选择', 'class' => 'm-wrap medium x-input-select inputstyle']) ?>
                                <?= $form->field($model, 'identityNumber',['enableAjaxValidation'=>true])->textInput([ 'class' => 'x-input m-wrap medium', 'size' => 30, 'placeholder' => '请输入正确的证件号码']) ?>                                       
                            </div>        
                            <div class="control-group2">
                                <?= Html::submitButton('提 交', ['class' => 'btn red']) ?>                            
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php /* <script>
            function file_download1() {
                var ifm = new IFrame({src: 'http://www.ftzmall.com.cn/member-file_download-image_file1.html'});
                ifm.inject(document.body);
            }
            function file_download2() {
                var ifm = new IFrame({src: 'http://www.ftzmall.com.cn/member-file_download-image_file2.html'});
                ifm.inject(document.body);
            }
            function file_download3() {
                var ifm = new IFrame({src: 'http://www.ftzmall.com.cn/member-file_download-image_file3.html'});
                ifm.inject(document.body);
            }

            //下面用于图片上传预览功能
            function setImagePreview(obj) {
                var name = $(obj).get('name');
                console.log(name);
                var imgObjPreview = document.getElementById("preview_" + name);
                if (obj.files && obj.files[0])
                {
                    //火狐下，直接设img属性
                    //            imgObjPreview.style.width = '285px';
                    //            imgObjPreview.style.height = '176px';
                    //imgObjPreview.src = obj.files[0].getAsDataURL();

                    //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
                    imgObjPreview.src = window.URL.createObjectURL(obj.files[0]);
                }
                else
                {
                    //IE下，使用滤镜
                    obj.select();
                    var imgSrc = document.selection.createRange().text;
                    var localImagId = document.getElementById("localImag");
                    //必须设置初始大小
                    //            localImagId.style.width = "176px";
                    //            localImagId.style.height = "285px";
                    //图片异常的捕捉，防止用户修改后缀来伪造图片
                    try {
                        localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                        localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
                    }
                    catch (e)
                    {
                        alert("您上传的图片格式不正确，请重新选择!");
                        return false;
                    }
                    imgObjPreview.style.display = 'none';
                    document.selection.empty();
                }
                return true;
            }

        </script>*/?>
    </div>
</div>