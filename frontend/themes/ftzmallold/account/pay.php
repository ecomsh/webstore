<?php
use yii\helpers\Url;
?>
<div class="main w1200">
    
    <?= $payPage ?>
    <script>
    //jQuery("[name='alipaysubmit']").prop("target","_blank");
        //jQuery("[name='return_url']").val("<?= Url::to(['account/index']); ?>");
        document.getElementsByName('paysubmit')[0].submit();
    </script>
</div>