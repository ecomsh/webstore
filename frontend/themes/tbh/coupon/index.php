<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use frontend\assets\ftzmallnew\CouponAsset;

CouponAsset::register($this);

/* @var $this yii\web\View */
$this->title = '优惠券_上海外高桥进口商品网';
$CouponStatus = Yii::$app->request->get('CouponStatus');
?>
<div class="container user-color">
    <?= $this->render('../layouts/_user-nav-left') ?>
    <div class="member-right-order">
        <div class="orderlist-warp">
            <h3>我的优惠券</h3>
            <form class="form-inline text-center cou-p">
                <div class="form-group">
                    <label class="font18">激活优惠码：</label>
                    <input class="form-control input-cou" id="coupon-code" placeholder="请输入优惠码">
                </div>
                <button type="button" class="btn btn-cou" id="btn-activation">立即激活</button>
            </form>
        </div>
        <div class="coupon-bottom">
            <ul class="nav nav-tabs ">
                <li class="<?php if($CouponStatus == 1 || !isset($CouponStatus)) {echo 'active';}?>">
                    <a href="<?= Url::to(['coupon/index', 'CouponStatus' => '1']) ?>">可使用的优惠券</a>
                </li>
                <li class="<?= $CouponStatus == 2 ? 'active' : '' ?>">
                    <a href="<?= Url::to(['coupon/index', 'CouponStatus' => '2']) ?>">已使用的优惠券</a>
                </li>
                <li class="<?= $CouponStatus == 3 ? 'active' : '' ?>">
                    <a href="<?= Url::to(['coupon/index', 'CouponStatus' => '3']) ?>">已过期的优惠券</a>
                </li>
            </ul>
            <?php if($count == 0): ?>
                <div class="coupon-no">
                    <h4>您目前没有<?= $msg?>的优惠券！</h4>
                </div>
            <?php else: ?>
                <div id="myTabContent" class="tab-content">
                    <ul class="clearfix tab-pane fade in active" id="<?php if($CouponStatus == 1 || !isset($CouponStatus)) {echo 'canuse';} elseif($CouponStatus == 2){echo 'couused';} else{echo 'expired';}?>">
                        <p class="coupon-title">
                            <span class="conumn1">名称</span>
                            <span class="conumn2">适用范围</span>
                            <span class="conumn3">有效期</span>
                        </p>
                        <?php
                        foreach ($data as $k => $v) {
                        $startTime = isset($v['stime'])? strtotime($v['stime']):0;
                        $startDate = date("Y-m-d H:i:s", $startTime); // TBD, this is UTC time, need to convert to local time. for display
                        $endTime = isset($v['etime'])? strtotime($v['etime']):0;
                        $endDate = date("Y-m-d H:i:s", $endTime); //TBD, this is UTC time, need to convert to local time.  for display
                        $validPeriod =isset($v['validperiod'])? $v['validperiod'] * 24 * 60 * 60:0; //TBD, assume the validperiodunit is Day.
                        $validEndTime = $startTime + $validPeriod;
                        if ($endTime) {
                        $actualEndTime = $validEndTime < $endTime ? $validEndTime : $endTime;
                        } //选取最近的失效时间。
                        else{
                        $actualEndTime = $validEndTime;
                        }
                        $actualEndDate = date("Y-m-d H:i:s", $actualEndTime);
                        ?>
                        <li class="coupon-con">
                            <span class="conumn1 font-wc padding-12 <?php if($CouponStatus == 1 || !isset($CouponStatus)) {echo 'con-use';} else{echo 'con-used';}?>" ><?= isset($v['rulename'])? $v['rulename']:'' ?></span>
                            <span class="conumn2">普通优惠券</span>
                            <span class="conumn3"><?= $startDate?> ~ <?= $actualEndDate?></span>
                        </li>
                       <?php } ?> 
                   </ul>
                </div>
            <?php endif; ?>
        </div>
        <div class="cou-infor">
            <h4>优惠券说明</h4>
            <p>
                优惠券仅限购买实物类的商品使用，同时极少数特殊商品无法使用，请以商品页为准<br>
                优惠券仅限在有效期内使用，过期则无法使用。请珍惜您的每张优惠券哦<br>
                每笔订单仅限使用一张优惠券，优惠券不可合并<br>
                如有待支付订单，则限首次下单使用的优惠券将暂时不能使用；如已成功支付，则限首次下单使用的优惠券将自动失效<br>
                若使用优惠券的订单发生退货行为，如果是直接抵扣类现金券，则根据商品金额比例退还相应的现金券，如果是满额扣减类优惠券，则优惠券不予返还<br>
            </p>
        </div>
    </div>
</div>
<script>
    var activateCouponUrl = "<?=Url::to(['coupon/activatecoupon']);?>";
    var _csrf = "<?= $_csrf ?>";
    var refreshUrl = "<?=Url::to(['coupon/index']);?>";
</script>