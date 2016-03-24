<?php

use yii\helpers\Url;
use frontend\assets\ftzmallnew\FindpwdCompleteAsset;

FindpwdCompleteAsset::register($this);
?>
<div class="forgotpw-container">
    <div class="forgotpw-progress">
        <h3 class="font-color4">找回密码</h3>
        <img src="<?=Url::to('@web/themes/ftzmallnew/src/images/progress-img4.png', true)?>">
    </div>
    <div class="success-div">
        <p class="success-item1">您的新密码已设置成功。请牢记新密码！</p>
        <p class="success-item2">
            <a class="font-color4" href=<?= Url::to(['login/index'])?>>点击此处</a>,立即返回之前的网页
        </p>
        <p class="success-item2"><span class="font-color4" id="timeid"><?= $time?></span>秒后，自动返回</p>
    </div>
</div>

<script type="text/javascript">

var urlArray = { 'home': '<?= Url::to(['login/index'])?>', 'time': <?= $time?>};

</script>
