<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Tools;
use yii\bootstrap\ActiveForm;
use mobile\assets\ftzmallmobilenew\CompleteAddrAsset;

CompleteAddrAsset::register($this);
/* @var $this yii\web\View */
$this->title = '完善地址';
isset($fullAddrList)&&$fullAddrList? $msg = '更新订单地址成功，但地址列表已满，未保存地址，是否继续完善下一个订单地址？': $msg='保存成功，是否继续完善下一个订单地址？';

/**
 * 1.active form 当中的field不能自己定义id，否则会失去客户端验证效果
 * 2.必要时，可以先把enableClientValidation=false 来调节关闭客户端验证后的效果
 * 3.tools_min.js和submit有冲突，添加了额外的disable事件阻止提交
 * 
 */
?>

<section class="ui-container"  id="form">
        <div class="demo-item">
            <div class="demo-block store-k">
                <div class="ui-dialog <?= $alertEnable? 'show':'' ?>" id="nextorder-dialog">
                    <div class="ui-dialog-cnt pop-bg">
                        <header class="ui-dialog-hd title-h">
                            <!--<i class="ui-dialog-close" data-role="button" id="close-nextorder-dialog"></i>-->
                        </header>
                        <div class="ui-dialog-bd">
                            <div class="title-infor save-m"><img class="save-img" src="<?= Url::to('@web/themes/wxnew/images/success-tp.png', true) ?>"><span class="save-label"><?= $msg?></span></div>
                        </div>
                        <div class="ui-btn-wrap">
                           <div class="ui-footer ui-btn-group">
                                <button class="ui-form-btn ui-btn-lg ui-btn-danger" id="next-noaddr-order">
                                    继续
                                </button>
                                <button class="ui-btn-lg btn-color1" id="close-nextorder-dialog">
                                    关闭
                                </button>
                            </div>
                        </div>
                    </div>          
                </div>
                <section class="ui-container store-border clearfix order-backgroud" >
                    <p class="store-c">门店名称：<?= Yii::$app->params['o2ostore'][$orderInfo['channelId']];?></p>
                    <p class="store-c">订单时间：<?= Tools::showDate('Y-m-d H:i:s', $orderInfo['createTimestamp']); ?></p>
                    <p class="store-c">应付金额：<i>￥<?= $orderInfo['totalAmount'] ?></i></p>
                    <div class="pro-thumb">
                        <!--<a class="arrow-left" href=""><img src="" width="9" height="18"></a>-->
                        <ul>
                            <div class="scroll-bigbox">
                                <?php foreach($orderInfo['orderLineList'] as $v){?>
                                <li><span><?= $v['quantity']?></span><img src="<?= $v['itemImageLink']?>" width="116" height="140"></li>
                                <?php }?>
                            </div>
                        </ul>
                        <!--<a class="arrow-right" href=""><img src="" width="9" height="18"></a>-->
                    </div>
                </section>
                <!--<p class="demo-desc text-c">使用常用地址</p>-->
                <div class="address-thumb clearfix" style="<?= empty($commonAddr)? "display:none;": "display:block;"?>">
                    <p class="demo-desc text-c">使用常用地址</p>
                    <!--<a class="addarrow-left" href=""><img src="" width="9" height="18"></a>-->
                    <ul>
                        <div class="address-bigbox">
                            <?php foreach($commonAddr as $v){?>
                            <li><a href="javascript:void(0)"><span id="receiver-name"><?= $v['receiverName']?></span> <span id="receiver-mobile"><?= $v['receiverMobile']?></span><br> 
                                    <span id="address"><?= $v['address']?></span> 
                                    <span id="common-postcode" style="display:none;"><?= $v['postcode'] ?></span></a></li>
                            <?php }?>
                        </div>
                    </ul>
<!--                    <a class="addarrow-right" href=""><img src="../img/weixin/scroll-r.png" width="9" height="18"></a>-->
                </div>

<div class="ui-form ui-border-t">

	<?php
	$options = [];
	$options['enableClientValidation'] = true;
	$options['fieldConfig'] = [
	'template' => "<li class='address-info'> <div class='item-name'>{label}</div> {input}{error} </li>", 
	'labelOptions' => ['class' => 'address-label'], 
	'errorOptions' => ['style' => ''],
	];
	$form = ActiveForm::begin($options);

	if ($model->isDefault) {
	$model->isDefault = 'true';
	}
	?>
	<div class="address-infos">
		<?= $form->field($model, 'stateCode')->dropDownList(['' => '请输入省份'], [ 'class'=> 'province item-option add-static', 'disabled' => 'true','data-level-index' => 0, ]) ?>
		<?= $form->field($model, 'cityCode')->dropDownList(['' => '请输入城市'], [ 'class'=> 'province item-option add-static', 'disabled' => 'true', 'data-level-index' => 0, 'id'=>'addressapi-citycode']) ?>
		<?= $form->field($model, 'districtCode')->dropDownList(['' => '请输入区县'], [ 'class'=> 'province item-option add-static', 'disabled' => 'true', 'data-level-index' => 0,]) ?>
		<div class="form-group field-addressapi-statename" style="display:none">
			<li class="address-info">
				<div class="item-name">
					<label class="address-label" style="display:none" for="provice1"></label>
				</div> 
				<input type="hidden" id="provice1" class="form-control" name="AddressApi[stateName]" value="北京市">
				<p class="help-block help-block-error" style="display:none"></p>
			</li>
		</div>
		<div class="form-group field-addressapi-cityname"  style="display:none">
			<li class="address-info">
				<div class="item-name" style="display:none">
					<label class="address-label" style="display:none" for="city1"></label>
				</div>
				<input type="hidden" id="city1" class="form-control" name="AddressApi[cityName]">
				<p class="help-block help-block-error" style="display:none"></p>
			</li>
		</div>
		<div class="form-group field-addressapi-districtname"  style="display:none">
			<li class="address-info">
				<div class="item-name">
					<label class="address-label" style="display:none" for="district1"></label>
				</div>
				<input type="hidden" id="district1" class="form-control" name="AddressApi[districtName]">
				<p class="help-block help-block-error" style="display:none"></p>
			</li>
		</div>

		<?= $form->field($model, 'address')->textInput([ 'class' => 'text']) ?>
		<?= $form->field($model, 'postcode')->textInput(['class' =>'text', 'size' => 15]) ?>                               
		<?= $form->field($model, 'receiverName')->textInput([ 'class' => 'text', 'size' => 15]) ?>
		<?= $form->field($model, 'receiverMobile')->textInput(['class' => 'text', 'size' => 15]) ?>                                
		<?= $form->field($model, 'receiverPhone')->textInput(['class' => 'text', 'size' => 15]) ?>
		<?= $form->field($model, 'isDefault')->checkbox(['label' => '设为默认地址', 'checked' => 'checked', 'value' => 'true', 'template' => '<li class="checkbox-info selected"><div class="check-box">{input}</div>{label}'])?>
                <?= $form->field($model, 'isSave')->checkbox(['label' => '设为常用地址', 'checked' => 'checked', 'value' => 'true', 'template' => '<li class="checkbox-info selected"><div class="check-box">{input}</div>{label}'])?>
            </div>     
	<div class="btn-div">
		<?= Html::submitButton('保存地址', [ 'class' => 'new-address']); ?>
	</div>
	<?php ActiveForm::end(); ?>
    </div>
</div>
</div>
</section>
<script>
    var addr = {'stateCode': '<?= $model->stateCode ?>', 'cityCode': '<?= $model->cityCode; ?>', 'districtCode': '<?= $model->districtCode; ?>'};
    var completeUrl = "<?=Url::to(['address/completeaddress', 'userId'=> $orderInfo['buyerId'], 'orderId' => $nextOrderId]) ?>";
</script>
                    
                  