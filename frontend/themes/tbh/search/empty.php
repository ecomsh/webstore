<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ftzmallnew\SearchAsset;
SearchAsset::register($this);
$this -> title = '搜索结果';
/* @var $this yii\web\View */
?>

<div class="container search-empty">
	<div class="empty-div">
		<span class="empty-bg">
			<p class="font-size2">抱歉，没有找到相关的产品</p>
			<p>建议您：</p>
			<p>1、看看输入的文字是否有误</p>
			<p>2、拆分要搜索的关键词，分成几个词语再次搜索</p>
			<form action="<?= Url::to(['search/index']); ?>" method="get">
				<span class="research-text">重新搜索</span>			
				<div class="input-group research-group">
					<input type="hidden" name="r" value="search/index">
					<input type="text" class="form-control research-input" placeholder="搜索关键字" name="search" value="<?=Yii::$app->request->get('search')?>"/>
					<span class="input-group-btn">
						<button class="btn btn-research" type="submit"></button>
					</span>
				</div>
			</form>
		</span>
	</div>			
</div>	