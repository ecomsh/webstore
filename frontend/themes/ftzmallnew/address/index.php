<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use frontend\assets\ftzmallnew\UserAsset;
use frontend\assets\ftzmallnew\AddressAsset;
use frontend\assets\ftzmallnew\AlertAsset;

UserAsset::register($this);
AddressAsset::register($this);
AlertAsset::register($this);

/* @var $this yii\web\View */
$this->title = '收货地址_上海外高桥进口商品网';


$id = isset($editData['addraaaessId']) ? $editData['addraaaessId'] : ''; //时刻警惕参数是否有可能未定义或者缺失
//$model->isExists($editData['addraaaessId']);
$stateCode = isset($editData['stateCode']) ? $editData['stateCode'] : '0';
$cityCode = isset($editData['cityCode']) ? $editData['cityCode'] : '0';
$districtCode = isset($editData['districtCode']) ? $editData['districtCode'] : '0';
$request = Yii::$app->request; //另外一种获取get参数的示意
$action = $request->get('action');

/**
 * 1.active form 当中的field不能自己定义id，否则会失去客户端验证效果
 * 2.必要时，可以先把enableClientValidation=false 来调节关闭客户端验证后的效果
 * 3.tools_min.js和submit有冲突，添加了额外的disable事件阻止提交
 * 
 */
?>
<input id="address-count" type="hidden" value="<?= count($data) ?>"/>
<div class="container user-color">
    <?=$this->render('../layouts/_user-nav-left')?>
    <div class="member-right-order">
        <div class="orderlist-warp">
            <h3>
                收货地址&nbsp;&nbsp; <span>|&nbsp;&nbsp;
                    <?php
                    if ($model->isNewRecord)
                    {
                        ?>
                        <a href="#" id="add-address"><i class="glyphicon glyphicon-plus" aria-hidden="true"></i><b id="add-address-addnew">添加新的</b><b id="add-address-giveup" style="display:none;color:red;">放弃添加</b>收货地址</a>
                        <scirpt></scirpt>
                        <?php
                    } else
                    {
                        ?>
                        &nbsp;<?= Html::a('添加新的收货地址', ['address/index', 'action' => 'create']) //尽量用yii的url，后续可以用上路由规则          ?>
                    <?php } ?>
<!--               <a href=""><i class="glyphicon glyphicon-plus" aria-hidden="true"></i>&nbsp;添加新的收货地址</a>-->

                </span>
                <label class="pull-right">最多可保存10个地址，已保存<?= count($data) ?>个</label>
            </h3>

            <?= Alert::widget(['alertTypes' => [
                    'address_success' => 'alert-success',
                    'address_error' => 'alert-danger',
                    'danger' => 'alert-danger',
                    'info' => 'alert-info',
                    'warning' => 'alert-warning'],'closeButton'=>false]);
            $s = '';
            if ($model->isNewRecord)
            {
                $s = 'display:none';
            }
            if ($action == 'create'||Yii::$app->request->isPost)
            {
                $s = '';
            }
            if (empty($data))
            {
                $s = 'display:none';
            }
            ?>

            <div id='addr-div' class="nav" style="<?= $s ?>">
                <?php
                $options = [];
                //if ($id)
                $options['options'] = ["class" => "form-horizontal"];

                $options['enableClientValidation'] = true;
                $options['fieldConfig'] = ['labelOptions' => ['class' => 'control-label verified-title'],
                        //   'template'=>"{input}\n<div class=\"ppp\">{error}</div>"
                        // 'labelOptions' => ['class' => 'ddd'],  
                ]; //'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']];
//           
                $form = ActiveForm::begin($options
//        'id' => 'Member_addr',  
                                // [ 'options' => ['class' => 'form-horizontal']]  
//        'fieldConfig' => [  
//            'template'=>"<tr><th>{label}：</th><td>{input}{error}</td></tr>"
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",  
//           // 'labelOptions' => ['class' => 'col-lg-1 control-label'],  
//        ],  
                );

                if ($model->isDefault)
                {
                    $model->isDefault = 'true';
                }
                ?> 
                <?php /* 注意真正的fieldConfig 在\yii\widgets\ActiveField 中，需要熟悉 */ ?>
                <?=
                        $form->field($model, 'isDefault', ['checkboxTemplate' => "<div class=\"check-middle\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>"])
                        ->checkbox(['label' => '设为默认地址', 'uncheck' => 'false', 'value' => 'true'])
                ?>    
                <?= $form->field($model, 'receiverName')->textInput([ 'class' => 'form-control pw-input', 'size' => 30]) ?>
                <?= $form->field($model, 'stateCode')->dropDownList(['' => '请输入省份'], [ 'class' => 'form-control pw-input verified-select']) ?>
                <?= $form->field($model, 'cityCode')->dropDownList(['' => '请输入城市'], ['class' => 'form-control pw-input verified-select']) ?>
                <?= $form->field($model, 'districtCode')->dropDownList(['' => '请输入区县'], [ 'class' => 'form-control pw-input verified-select']) ?>
                <?= $form->field($model, 'stateName', ['labelOptions' => ['style' => 'display:none'], 'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'provice1']) //id指定后将不能自动描红?>
                <?= $form->field($model, 'cityName', ['labelOptions' => ['style' => 'display:none'], 'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'city1']) ?>
                <?= $form->field($model, 'districtName', ['labelOptions' => ['style' => 'display:none'], 'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'district1']) ?>
                <?= $form->field($model, 'address')->textarea([ 'class' => 'form-control pw-input']) ?>
                <?= $form->field($model, 'postcode')->textInput(['class' => 'form-control pw-input', 'size' => 15]) ?>
                <?= $form->field($model, 'receiverMobile')->textInput(['class' => 'form-control pw-input', 'size' => 15]) ?>
                <?= $form->field($model, 'receiverPhone')->textInput(['class' => 'form-control pw-input', 'size' => 15]) ?>
                <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', [ 'class' => $model->isNewRecord ? 'btn btn-success verified-btn' : 'btn btn-success verified-btn']) ?>
                </div>
                    <?php ActiveForm::end(); ?>
            </div>

            <?php
            if ($data)
            {
                ?>
                <div class="order-table-warp">
                    <table class="table table-bordered order-table">
                        <thead>
                            <tr>
                                <th class="text-center">地址</th>
                                <th class="text-center">收货人</th>
                                <th class="text-center">联系电话</th>
                                <th class="text-center">默认</th>
                                <th class="text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($data & is_array($data))
                            {

                                foreach ($data as $k => $v):
                                    ?>
                                    <tr>
                                        <td class="text-center"> <?= Html::encode($v['address']) ?></td>
                                        <td class="text-center"><?= Html::encode($v['receiverName']) ?></td>
                                        <td class="text-center"><?= Html::encode($v['receiverMobile']) ?></td>
                                        <td class="text-center">
                                            <?php $defaultUrl = Url::to(['address/default', 'id' => $v['addressId'], true]); ?>
                                            <?php /* 注意此处的button添加跳转链接的方法 */ ?>
            <?= $v['isDefault'] ? '默认地址' : Html::button('设为默认', ['class' => 'btn btn-default btn-xs', 'onclick' => 'location=(\'' . $defaultUrl . '\')']) ?>
                                        </td>
                                        <td class="text-center">
                                            <?= Html::a('修改', ['address/index', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['class' => 'btn-bj-hover operate-btn']) ?>
                                            &nbsp;&nbsp;
            <?= Html::a('删除', ['address/delete', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['data' => ['confirm' => '确定删除地址?']]) ?>




                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
<?php } ?>
        </div>
    </div>
</div>


<script>
    var addr = {'stateCode': '<?= $model->stateCode ?>', 'cityCode': '<?= $model->cityCode; ?>', 'districtCode': '<?= $model->districtCode; ?>'};
</script>