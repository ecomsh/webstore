<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '实名认证_上海外高桥进口商品网';
?>

<div class="member-main" style="width: 960px;">
    <div class="title title2">实名认证<span class="disc">|提示信息： 因涉及国家监管部门规定，需要对购买人信息实名备案，遇优购网站不会保留相关个人隐私信息，请放心填写。 。</span></div>
    <form method="post" action="<?= Yii::$app->params['baseUrl'] ?>member-save_recordinfo.html" id="form_saveMember" class="section" enctype="multipart/form-data" encoding="multipart/form-data">
        <div class="FormWrap" style="background:none; border:none; padding:0; margin:0;">
            <div class="division" style="border:none;margin-bottom:0">
                <table class="forform" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                            <th><em>*</em> 真实姓名：</th>
                            <td>
                                <input autocomplete="off" class="x-input " type="text" name="real_name" vtype="required&amp;&amp;real_name" id="dom_el_1c6e7a0">            </td>
                        </tr>
                        <tr>
                            <th><em>*</em> 证件类型：</th>
                            <td>
                                <select type="select" name="type" vtype="required&amp;&amp;type" id="dom_el_1c6e7a1" class=" x-input-select inputstyle"><option></option><option value="0">身份证</option></select>            </td>
                        </tr>
                        <tr>
                            <th><em>*</em> 证件号码：</th>
                            <td>
                                <input autocomplete="off" class="x-input " type="text" name="type_number" vtype="required&amp;&amp;type_number" id="dom_el_1c6e7a2">            </td>
                        </tr>
                        <tr>
                            <th><em>*</em> E-mail：</th>
                            <td>
                                <input autocomplete="off" class="x-input " type="text" name="email" vtype="required&amp;&amp;email" id="dom_el_1c6e7a3">            </td>
                        </tr>
                        <!--添加手机号码--add by hzy start-->
                        <tr>
                            <th><em>*</em> 手机号码：</th>
                            <td>
                                <input autocomplete="off" class="x-input " type="text" name="mobile" vtype="required" id="dom_el_1c6e7a4">   
                            </td>
                        </tr>

                        <tr>
                            <th><em>*</em> 身份证照片（正面）：</th>
                            <td>
                                <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
                                <input type="file" class="x-input x-inputs" name="file1" id="fileField1">

                            </td>
                        </tr>
                        <tr>
                            <th><em>*</em> 身份证照片（反面）：</th>
                            <td>
                                <input type="file" class="x-input x-inputs" name="file2" id="fileField1">

                            </td>
                        </tr>
                        <tr>
                        </tr></tbody></table>
            </div>
            <div style="padding-left:142px"><button class="btn submit-btn" type="submit"><span><span>保存</span></span></button></div>

        </div>
    </form>
</div>

<script>
    function file_download1() {
        var ifm = new IFrame({src: '<?= Yii::$app->params['baseUrl'] ?>member-file_download-image_file1.html'});
        ifm.inject(document.body);
    }
    function file_download2() {
        var ifm = new IFrame({src: '<?= Yii::$app->params['baseUrl'] ?>member-file_download-image_file2.html'});
        ifm.inject(document.body);
    }
</script>
