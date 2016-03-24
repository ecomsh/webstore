<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
$this->title = '登录成功_上海外高桥进口商品网';
?>

   
                 <div class="m-page">
                    <div class="full-screen">
                        <div class="full-padding">
                            <div style="padding:0 15px;margin-top:40px;font-size:17px;">
                                <p style="text-align:center;color:#b0020b;">恭喜您已成功注册成为FTZMALL的会员！</p>
                                <p style="text-align:center;margin-top:20px;">长按下方图片关注<strong>"FTZMALL官方微信"</strong></p>
                                <div style="width:150;height:150;text-align:center;"><img src="<?= yii::$app->params['localimgUrl']?>two-dimension.png" width="150" height="150" text-align:center;></div>
                                <div style="margin-top:20px;"><a href="<?= Url::to(['user/index']) ?>">暂不关注。进入“个人中心”</a></div>
                            </div>

                        </div>
                    </div>
                </div>

            
