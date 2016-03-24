<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<div class="footer-bottom">
    <p class="footer-bottom-p1"><a href="<?= Url::to(['article/page', 'view' => 'gywm']); ?>">关于我们</a>|<a href="<?=  Url::to(['article/page','view'=>'pprz']);?>">品牌入驻</a>|<a href="<?= Url::to(['article/page', 'view' => 'lxwm']); ?>">联系我们</a>|<a href="<?= Url::to(['article/page', 'view' => 'zpxx']); ?>">招聘信息</a></p>
    <p class="footer-bottom-p2">Copyright © 2006 - 2015上海外高桥进口商品网版权所有　沪ICP备11030945号-3   增值电信业务经营许可证　沪B-20110100</p>
    <p class="footer-bottom-p2">上海欣港科技有限公司 电话：021-58662100 </p>
    <p>
        <a id="___szfw_logo___" target="_blank" href="https://search.szfw.org/cert/l/CX20140320003625003666">
            <img src="https://search.szfw.org/cert.png?l=CX20140320003625003666">
        </a>
        <a href="http://www.miibeian.gov.cn/state/outPortal/loginPortal.action;jsessionid=9gLvJpXhM6LQ2GqvylYrKdnnYcBp1ymyQXXYpLFsnr4cq9k1Yr8J%21822702665" type="url" target="_blank">
            <img width="110" height="39" src="http://ecomgq-images.oss.aliyuncs.com/72/3d/9e/ad9f55746d463a0239cab19573b62ed165f.png?1416198278#w">
        </a>
        <a href="https://www.sgs.gov.cn/lz/licenseLink.do?method=licenceView&entyId=dov73ne26zbqpyzyxwp7wpx1o9iq1glq1f">
            <img width="39" border="0" src="//ecomgq-images.oss.aliyuncs.com/fe/e3/44/652a72e6a3639f26a5ff45b1dbec36e9236.jpg">
        </a>
    </p>
    <p class="footer-bottom-p2">
        <?= $this->render('_baidu-tongji') ?>
        <?php //$this->render('_google-tongji') ?>
    </p>
</div>