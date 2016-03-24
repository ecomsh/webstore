<!--<br><br><br><br><br>
<div class="act-default-index" align="center">
    <form action="/act2016/site/coupon.html" method="post">
    	请输入领取的优惠券：<input type="text" id="coupons" name="coupons" style="background:#CCC"/>
        <input type="submit" value="提交" />
    </form>
</div>-->


<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use conquer\codemirror\CodemirrorWidget;
?>
<br><br><br><br><br>
<div class="cms-form" align="center">
    <?php $form = ActiveForm::begin();?>
    请输入优惠券：<input type="text" id="coupon" name="coupon" style="background:#CCC" />
    <br><br>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','确定'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
