<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mobile\assets\ftzmallmobilenew\LoginAsset;

LoginAsset::register($this);
/* @var $this yii\web\View */
$this->title = '手机绑定成功_上海外高桥进口商品网';
?>

   
                 <div class="m-page">
                    <div class="full-screen">
                        <div class="full-padding">
  							<div style="padding:0 15px;margin-top:40px;font-size:17px;margin-top:100px">
                        	<p style="text-align:center;color:#b0020b;">手机号成功绑定到您的FTZMALL会员账号，下次可以用手机号登陆哦！</p>
                                <p style="text-align:center;margin-top:20px;">长按下方图片关注<strong>"FTZMALL官方微信"</strong></p>
                                <div style="width:150;height:150;text-align:center;"><img src="<?=Url::to('@web/mobile/images/two-dimension.png', true)?>" width="150" height="150" text-align:center;></div>
                                <div style="margin-top:20px;"><a href="<?= Url::to(['user/index']) ?>">暂不关注。进入“个人中心”</a></div>
                            </div>

                        </div>
                    </div>
                </div>


<script>
    var params = {'checkmobileurl': '<?= Url::to(['passport/valmobile']) ?>', 'getsmscodeurl': '<?= Url::to(['passport/getsmscode']) ?>', 'vcodeId':'bind-vcode', 'formId': 'bindmobileform', 'form': 'BindMobileForm', 'smsType': ''};
</script>
