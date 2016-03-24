<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<script type="text/javascript" src="http://static.tbh.dev/yingyuan/static/common/jQuery/jquery-1.11.3.min.js"></script>

<div class="pull-right">
	<form id="searchshop" action=" " method="get">
		<div class="input-group search-group">		
			<input type="hidden" name="r" value="search/index">
			<input type="text" class="form-control header-search" placeholder="搜索关键字" name="search" value="<?= Html::encode(Yii::$app->request->get('search'))?>"/>
			<span class="input-group-btn">
				<input class="btn btn-search" type="submit" value="搜本店">
                                <input class="btn btn-search-all" value="搜全站" type="submit">
			</span>		
		</div>
	</form>
    <script>
        $(document).ready(function(){
        	// var action = $(".pull-right form").attr('action');
        	var shop = "<?= Url::to(['shop/index']); ?>";
        	var search = "<?= Url::to(['search/index']); ?>" ;

	        $('.pull-right form .btn-search').click(function(){
	        	
	        	$(this).parents('#searchshop').attr("action",shop);
	        })

	        $('.pull-right form .btn-search-all').click(function(){
	        	$(this).parents('#searchshop').attr("action",search);
	        })
	        // console.log(shop);
	        // console.log(search);
	        // console.log(action);
        	
        });
    </script>
	<?= $this->render('_nav-search-keyword') ?>	
</div>	
