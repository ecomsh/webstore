<?php

use yii\helpers\Html;
?>

<div >
    <div></div>
    <div>
        <p><?= $display? nl2br(Html::encode($name)) : '' ?></p>
        <p><?= nl2br(Html::encode($message)) ?></p>
        <p><a href = "<?php if(isset($returnUrl)){ echo $returnUrl;} else{ ?> javascript:history.back() <?php } ?>">5秒后系统会自动跳转，也可点击本处直接跳转</a></p>  
    </div>
    <script>
        $(document).ready(function () {
            var jumpUrl = "<?= isset($returnUrl)? $returnUrl: '' ?>";
            var t = 5;
            var inter = setInterval(timecount, 1000);
            function timecount()
            {
                t--;
                if (t <= 0)
                {
                    if(!jumpUrl || jumpUrl.length == 0){
                        history.back();
                    }
                    else{
                        location.href = jumpUrl;
                    }
                    clearInterval(inter);
                }

            }
        });
    </script>
</div>




