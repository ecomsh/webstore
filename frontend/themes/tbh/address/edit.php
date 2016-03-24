<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\ftzmallnew\CheckoutAsset;
use frontend\widgets\AjaxSubmitButton;

CheckoutAsset::register($this);
$this->title = '订单';
?>


<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <p class="add-title font-color4">修改地址</p>
</div>
<div class="modal-body">
<?php
$options = [];
$options['options'] = ['class' => 'form-horizontal'];
$options['fieldConfig'] = [
            'template' => "{label}\n<div class=\"col-sm-10\">{input}</div>",
            'labelOptions' => ['class' => 'col-sm-2'],
            'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']
];
$form = ActiveForm::begin($options);
?>
<?= $form->field($model, 'receiverName')->textInput(['placeholder' => '请填写收货人姓名', 'class' => 'form-control recipients-name', 'id' => 'recipients-name']) ?>

<?= $form->field($model, 'stateCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => "{label}\n{input}"])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address' , 'id' => 'address_statecode']) ?>
<?= $form->field($model, 'cityCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => '{input}'])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address' , 'id' => 'address_citycode']) ?>
<?= $form->field($model, 'districtCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => '{input}'])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address' , 'id' => 'address_districtcode']) ?>

<?= $form->field($model, 'address')->textInput(['placeholder' => '请填写详细地址', 'class'=> 'form-control recipients-address-detail' , 'id' => 'address_address']) ?>
<?= $form->field($model, 'receiverMobile', ['options' => ['style' => 'display:inline-table;margin-right:20px;', 'class' => 'form-group'], 'template' => "{label}\n<div class=\"col-sm-8\" style=\"box-sizing:content-box;margin-right:-13px;padding-right:17px\">{input}<span class=\"recipients-tel-width1\" style=\"margin-left:14px;line-height:34px;\">或固定电话</span></div>",])->textInput(['placeholder' => '请填写手机号码', 'class' => 'form-control col-sm-2 recipients-tel']) ?>
<?= $form->field($model, 'receiverPhone', ['options' => ['style' => 'display:inline-table;', 'class' => 'form-group'], 'template' => "{input}"])->textInput(['placeholder' => '请填写固定电话']) ?>
<?= $form->field($model, 'stateName', ['options' => ['class' => ''], 'template' => '{input}'])->hiddenInput(['id' => 'provice1']) //id指定后将不能自动描红?>
<?= $form->field($model, 'cityName', ['options' => ['class' => ''], 'template' => '{input}'])->hiddenInput(['id' => 'city1']) ?>
<?= $form->field($model, 'districtName', ['options' => ['class' => ''], 'template' => '{input}'])->hiddenInput(['id' => 'district1']) ?>

<div class="form-group">
    <label for="realname-btngroup" class="col-sm-2"></label>
    <div class="btn-group" role="group" id="realname-btngroup">
        <?php
        AjaxSubmitButton::begin([
            'label' => '确定',
            'ajaxOptions' => [
                'type' => 'POST',
                'url' => Url::to(['address/edit','addressId' => $addressId]),
                'success' => new \yii\web\JsExpression('function(json){
                                addressEditSuccess(json);
                            }'),
            ],
            'options' => ['class' => 'btn btn-ensure', 'type' => 'button', 'id' => 'ajaxEditAddress'],
        ]);
        AjaxSubmitButton::end();
        ?>
<?= Html::button('清空', ['class' => 'btn btn-empty', 'type' => 'button', 'id' => 'clearButton']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
</div>

<script>
jQuery(function () {
    <?=$model->addressId?>
    var stateCodeEdit = "<?= $model->stateCode ?>";
    var cityCodeEdit = "<?= $model->cityCode ?>";
    var districtCodeEdit = "<?= $model->districtCode ?>";
    preSelect(stateCodeEdit,cityCodeEdit,districtCodeEdit,
                            '#address_statecode', '#address_citycode', '#address_districtcode', '#address_address');//preselect("四川省","成都市","金牛区");//设置默认选项
    initCountry('#address_statecode', '#address_citycode', '#address_districtcode', '#address_address');

    jQuery('#ajaxEditAddress').click(function() {
        var AddressApi = {
            'receiverName': $("#recipients-name").val(),
            'stateCode': $("#address_statecode").val(),
            'cityCode': $("#address_citycode").val(),
            'districtCode': $("#address_districtcode").val(),
            'receiverMobile': $("#addressapi-receivermobile").val(),
            'receiverPhone': $("#addressapi-receiverphone").val(),
            'cityName': $("#provice1").val(),
            'stateName': $("#city1").val(),
            'districtName': $("#district1").val(),
            'address': $("#address_address").val(),
        };
        var _csrf = $(this).parents("form").find("input[name=_csrf]").val();
        var addressId = "<?=$addressId?>";
        
        jQuery.ajax({
            "type":"POST",
            "url":"<?=Url::to(['address/edit'])?>",
            "success":function(json){
                addressEditSuccess(json);
            },
            "data":{
                '_csrf' : _csrf,
                'AddressApi' : AddressApi,
                'addressId' : addressId,
            }
        });
        return false;
    });
    
    jQuery('#clearButton').click(function(){
        jQuery(".form-control").val('');
    })
})
</script>