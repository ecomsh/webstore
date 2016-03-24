<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '自贸区直购购物流程-上海外高桥进口商品网';
?>
<div class="container">
  <?= $this->render('../../layouts/_article-left') ?>
  <div class="right-box">
    <div class="bread-cum">
        您当前的位置：  <span><a href="<?=  Url::to(['article/pagegroup','view'=>'zmqzg']);?>" alt="" title="">自贸区直购购物流程</a></span>
        <span> &gt; </span>
        <span class="now">自贸区直购购物流程</span>
    </div>
    <div class="mTB" style="border:1px solid #d4d4d4;margin:0 0 10px;">

        <div class="ArticleDetailsWrap">

          <h2 class="textcenter">购物流程</h2>
          <div style="margin-left: 10px;margin-top: 10px">
            <img src="http://ecomgq-images.oss.aliyuncs.com/aa/2d/f0/dd4c8e0f7f9299307deb4815cfc339b5621.jpg?1427096940#w">
            <br>1. 会员注册——新客户填写个人信息，同意协议，提交完成注册。<br>2. 账号登陆——点击进口网首页顶部“登录”，输入账号名，密码进行登录，完成登录后就可以在进口网上购物了。<br>3. 查找商品——在进口网首页按分类或者直接搜索自己喜欢的商品，选择你挑中的商品并点击“加入购物车”。<br>4. 下单支付——拍下商品填写姓名电话地址提交订单后，页面会跳转到东方支付网站，按东方支付网站提示实名制注册并支付款项。<br>5. 客服确认——顾客下单并成功支付后，进口网客服人员会在12小时内对您所订购的商品收货地址，款项支付等信息进行审核，审核通过后会提交给海关进行订单申报，若订单有任何变动，客服人员会在第一时间和您取得联系。<br>6. 自贸区发货——自贸区发货一般在5-7个工作日发出，遇到节假日及法定假日将延后发出，给您带来不便敬请谅解。<br>7. 收货评价——货物送达至顾客处，请当面开箱验货，无疑问后签收，签收完毕可对商品进行评价。<br>8. 订单完成——最终完成整个订单交易。<br><font color="#ff0000">贴心助手：</font><br>上海外高桥保税区逢周末及国家规定的法定节假日是不予审核订单的，您购买的商品会在工作日内出货。<br><strong>关税说明：</strong><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 在进口网上，消费者是通过委托进口网代缴的形式来缴纳关税的。消费者在订单提交时根据订单内商品的金额和对应的税率缴纳相应的关税，和订单商品金额运费等一并付给进口网，无需自己再到相应的海关部门单独缴纳，进口网将会根据顾客的订单统一向海关缴纳关税，消费者可在30天内向东方支付平台索要电子税单。<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 根据海关总署规定，购买跨境平台商品，以电子订单的实际销售价格作为完税价格（征税基数），参照行邮税税率计征进口税税款，应征税额在人民币：50元（含50元）以下的，海关予以免征，超过50元税额，全额征缴。比如一包纸尿裤销售价格130元，进口税税率10%，那么税额就是13元，低于50元，不用缴税；但如果一次购买4包，税额52元，需要缴纳52元进口税。<br><br><br></font>
          </div>
        </div>
    </div>
  </div>
</div>