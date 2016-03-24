<?php

use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\ftzmallmobilenew\UserAsset;

UserAsset::register($this);//为了将activeForm的js代码依赖于mainasset
/* @var $this yii\web\View */
$this->title = '我的积分_上海外高桥进口商品网';
?>

<div style="width: 960px;" class="member-main">
    <div>
        <div class="title title2">我的积分</div>

        <div>
            <p class="admin-title textright">
                <span class="flt">积分使用记
                    录：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    您当前的有效积分：<em class="font-orange fontbold font14px">1000</em>&nbsp;
                    分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    使用的冻结积分：<span class="point">0分</span>&nbsp;&nbsp;
                    可获得冻结积分：<span class="point">0</span><!--&nbsp;累积积分：<span class="point" >0</span>-->&nbsp;分</span>
            </p>
            <table class="gridlist border-all gridlist_member" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody><tr>
                        <th class="first">来源/用途</th>
                        <th>日期</th>
                        <th>获得的积分</th>
                        <th>使用的积分</th>
                        <th>剩余的积分</th>
                        <th>积分有效期</th>
                        <th>备注</th>
                    </tr>
                </tbody><tbody>
                    <tr>
                        <td>0</td>
                        <td>2015-05-21 16:34:34</td>
                        <td style="color:#F60" align="center">1000</td>
                        <td align="center">0</td>
                        <td align="center">1000</td>
                        <td align="center">无过期</td>
                        <td align="center">管理员改变积分.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="admin-title textright">温馨提示：

            1:订单状态变为“交易成功”后系统自动将积分发放到账户。
            2:查看《<a href="javascript:void(0);" onclick=" if ($('point_use_rules').style.display == 'none') {
            $('point_use_rules').style.display = 'block';
        } else if ($('point_use_rules').style.display == 'block') {
            $('point_use_rules').style.display = 'none';
        }"><font color="blue">积分规则及使用方法</font></a>》
        </p>
        <span id="point_use_rules" style="display:none">
            <h5>平台积分规则：</h5>
            <p><strong>1.</strong> 积分专属平台商城，仅限平台商城内使用。</p>

            <p><strong>2. </strong>100积分=1元现金。</p>

            <p><strong>3. </strong>买家在付款时，在完成该笔交易后（支付系统显示该交易状态为“交易成功”），才能得到此次交易的相应积分。</p>

            <p><strong>4. </strong>商家派送的积分由商家自行决定，但不能超过其拥有的全部积分。</p>

            <p><strong>5.</strong> B2B2C平台卖家出售商品自愿选择是否可用积分抵部分现金，消费者最高消耗积分不能高于商品的10%售价；卖家得到消费者所用的积分（对于技术开发需求，平台管理可以根据发展需求，可调整这个最高值）。</p>
            <p><strong>6. </strong>消费者的积分不能兑现，不可转让。</p>
            <p><strong>7. </strong>积分有效期即从获得开始至次年年底（12月31日），逾期自动作废。以公历的年、北京时间为准，如若交易在使用的积分有效期之外发生退款，该部分积分不予退还</p>
        </span>
    </div>
</div>

<!-- right-->
