<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '关于我们-上海外高桥进口商品网';
?>
<div class="container">
	<?= $this->render('../../layouts/_article-left') ?>
	<div class="right-box">
		<div class="bread-cum">
		    您当前的位置：  <span><a href="<?= Url::to(['article/pagegroup', 'view' => 'gsjj']); ?>" alt="" title="">公司简介</a></span>
		    <span> &gt; </span>
		    <span class="now">关于我们</span>
		</div>
		<div class="mTB" style="border:1px solid #d4d4d4;margin:0 0 10px;">

		    <div class="ArticleDetailsWrap">

		        <h2 class="textcenter">关于我们</h2>

		        <!-- <div class=" textcenter fontnormal font-gray pubdate">发布日期：2014-09-12 13:31</div> -->
				<div style="margin-left: 10px">
		        <p><br>上海外高桥进口商品网（以下简称“进口网”）专营进口商品，依托上海市外高桥国际贸易营运中心有限公司（以下简称“营运中心”）多年来与众多国外厂商及其 在华总代理直接建立密切的合作关系，最大限度减少进口商品流通环节，从而将节省下来的流通成本让利于消费者，让消费者实实在在得实惠，在海关、商检等政府 职能部门的严格监管下，商品的品质和安全更加有保证。<br><br>进口网销售的涵盖进口食品、饮料、牛奶、酒水、生鲜、美容化妆、个人护理、服饰鞋靴、厨卫清洁、母婴用品、家居家纺、保健用品、箱包珠宝、钟表、运动用品及礼品卡等商品。<br><br>同时我们还有上海外高桥进口商品直销中心（以下简称“直销中心”）实体超市及体验店，希望为您提供优质的购物体验，欢迎您的光临。<br><br></p>
				</div>
		    </div>
		</div>
	</div>
</div>
