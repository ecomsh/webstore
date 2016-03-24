<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use mobile\assets\ftzmallmobilenew\UserAsset;
use mobile\assets\ftzmallmobilenew\CouponAsset;

UserAsset::register($this);
CouponAsset::register($this);
$this->title = '用户中心-优惠券';
$CouponStatus = Yii::$app->request->get('CouponStatus');
?>
<section class="ui-container">
    <div class="addcoupon-topbar">
        <a id="addcoupon-show">激活优惠码</a>
    </div>
    <div class="ui-dialog">
        <div class="ui-dialog-cnt">
            <header class="ui-dialog-hd">
                <h3>激活优惠码</h3>               
            </header>
            <form>
                <div class="ui-dialog-bd">                
                    <input type="text" id="coupon-code" placeholder="请输入优惠码">
                </div>
                <div class="ui-dialog-ft">
                    <button type="button" data-role="button" id="addcoupon-hidden">取消</button>
                    <button type="button" data-role="button" id="btn-activation">立即激活</button>
                </div>
            </form>
        </div>        
    </div>
</section>

<section class="tab">
    <ul class="ui-tab-nav"><!--由于考虑到应该是用LinkPager,所以不写tab切换了，有问题请联系caoqi-->
        <li class="<?php
        if ($CouponStatus == 1 || !isset($CouponStatus)) {
            echo 'current';
        }
        ?>"><a href="<?= Url::to(['coupon/index', 'CouponStatus' => '1']) ?>">可使用</a></li>
        <li class="<?= $CouponStatus == 2 ? 'current' : '' ?>"><a href="<?= Url::to(['coupon/index', 'CouponStatus' => '2']) ?>">已使用</a></li>
        <li class="<?= $CouponStatus == 3 ? 'current' : '' ?>"><a href="<?= Url::to(['coupon/index', 'CouponStatus' => '3']) ?>">已过期</a></li>
    </ul>

    <ul class="coupon-fullbox">

        <?php
        if ($count > 0):
            foreach ($data as $k => $v) {
                $startTime = isset($v['stime'])? strtotime($v['stime']):0;
                $startDate = date("Y.m.d", $startTime); // date() function returns a local time. for display
                $endTime = isset($v['etime'])? strtotime($v['etime']):0;
                $usedTime = isset($v['usedtime'])?strtotime($v['usedtime']):0;
                $validPeriod = isset($v['validperiod'])? $v['validperiod'] * 24 * 60 * 60:0; //TBD, assume the validperiodunit is Day.
                $validEndTime = $startTime + $validPeriod;
                if ($endTime) {
                    $actualEndTime = $validEndTime < $endTime ? $validEndTime : $endTime;
                } //选取最近的失效时间。
                else{
                    $actualEndTime = $validEndTime;
                }
                $actualEndDate = date("Y.m.d", $actualEndTime); //date() function returns a local time. for display
                $localTimeZone = date_default_timezone_get();//记录当前的timezone设置，为了恢复设置
                date_default_timezone_set("UTC");
                $currentTime = time(); //由于后端采用UTC时间，所以获得当前时间也需要用UTC。
                date_default_timezone_set($localTimeZone); //恢复为原来的timezone
                if ($actualEndTime > $currentTime) {
                    $diffTime = $actualEndTime - $currentTime;
                } else {
                    $diffTime = 0;
                }
                $diffDay = ceil($diffTime / (24 * 60 * 60));
                ?>
                <li class="coupon-bigbox">
                    <div class="<?php if ($CouponStatus == 1 || !isset($CouponStatus)) {
                    echo 'coupon-leftbox';
                } else {
                    echo 'coupon-leftbox2';
                } ?>"><!--灰色背景请把coupon-leftbox换成coupon-leftbox2-->
                        <span class="ab5"><?= isset($v['rulename'])?$v['rulename']:'' ?></span>  
                    </div>
                    <div class="coupon-rightbox">
                        <p><a><?= isset($v['desc'])?$v['desc']:'' ?></a></p>
                        <p><span class="<?php if ($CouponStatus == 1 || !isset($CouponStatus)) { echo'font-red';} else{echo 'font-gray';} ?>">
                                <?php if ($CouponStatus == 1 || !isset($CouponStatus)):?>
                                剩余<?= $diffDay ?>天过期
                                <?php elseif($CouponStatus == 2):
                                            if($usedTime){
                                                $usedTimeStr = date("Y.m.d H:i:s", $usedTime);
                                            }
                                            else{
                                                $usedTimeStr = '';
                                            }
                                ?>
                                使用时间：<?= $usedTimeStr?>
                                <?php else:?>
                                有效期：<?= $startDate ?>-<?= $actualEndDate ?>
                                <?php endif; ?>
                            </span></p>
                    </div>
                    <?php if ($CouponStatus == 1 || !isset($CouponStatus)) {?>
                    <a class="arrow-down" id="show<?php echo $k; ?>"></a>   
                    <?php }?>
                </li>

                <div class="coupon-bottombox" id="show-box<?php echo $k; ?>">
                    <p>有效期：<?= $startDate ?>-<?= $actualEndDate ?></p>
                    <p>适用范围: 普通优惠券</p>
                </div>  
        <?php
    }
else:
    ?>
            <div class="no-coupon">
                <img src="<?= Url::to('@web/themes/wxnew/images/no-icon.png', true) ?>">
                <p>您目前没有<?= $msg ?>的优惠券</p>        
            </div>
<?php endif; ?>
    </ul>
</section>
<script>
    var activateCouponUrl = "<?=Url::to(['coupon/activatecoupon']);?>";
    var _csrf = "<?= $_csrf ?>";
    var refreshUrl = "<?=Url::to(['coupon/index']);?>";
</script>

