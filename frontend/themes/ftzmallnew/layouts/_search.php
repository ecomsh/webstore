<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>

<div class="pull-right">
	<form action="<?= Url::to(['search/index']); ?>
		" method="get">
		<div class="input-group search-group">
			<input type="hidden" name="r" value="search/index">
			<input type="text" class="form-control header-search" placeholder="搜索关键字" name="search" value="<?= Html::encode(Yii::$app->
			request->get('search'))?>"/>
			<span class="input-group-btn">
				<input class="btn btn-search" type="submit" value="搜索">
				<!--搜索框下拉字符 start-->
				<div style="height: auto; display: none;" class="bdsug">
					<ul>
						<a id="search-store" href="javascript:void(0)">
							<li>
								<img src="http://static.tbh.dev/ftzmall/frontend/images/test-imgd.png" />
								找“
								<span class="store"></span>
								”相关店铺
							</li>
						</a>
					</ul>
				</div>
				<script>
            		var storeUrl = "<?= Url::to(['search/store']); ?>" + '?r=search/store&search=';
            	</script>
				<!--搜索框下拉字符 end-->
			</span>
		</div>
	</form>
	<?= $this->render('_nav-search-keyword') ?></div>