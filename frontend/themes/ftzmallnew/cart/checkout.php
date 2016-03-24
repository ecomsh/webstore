<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helpers\Tools;
use frontend\assets\ftzmallnew\CheckoutAsset;
use frontend\widgets\AjaxSubmitButton;

CheckoutAsset::register($this);
$this->title = '订单';
$index = 0;
$newOfferPrice = 0;
$offerPriceTotal = 0;
?>
<div class="container checkout-container">
    <!-- 库存不足模态框start -->

    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labeledby="myModalLabel">
        <div class="modal-dialog understock" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    您购买的<span class="font-color4">库存不足</span>，请返回购物车修改
                    <a href="<?= Url::to(['cart/index']) ?>" class="btn btn-returncart">返回购物车修改</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labeledby="myModalLabel" data-backdrop="false">
        <div class="modal-dialog-pay" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="add-title font-color4">支付</p>
                </div>
                <div class="modal-body">
                    <div>
                        <p class="lightgray">请您在新打开的网上银行页面进行支付，支付完成后选择:</p>
                        <ul>
                            <li>
                                <span class="success glyphicon glyphicon-ok"></span>
                                <span class="text">付款成功</span>
                                <span class="lightgray"> ｜您可以选择：</span>
                                <a class="ftbl ml10" href="javascript:;" onclick="closeGo();">查看订单</a>
                            </li>
                            <li>
                                <span class="error_m glyphicon glyphicon-remove"></span>
                                <span class="text">付款失败</span>
                                <span class="lightgray"> ｜建议您选择：</span>
                                <a class="ftbl ml10" href="javascript:;" onclick="closeWindow();">选择其他支付方式</a>
                            </li>
                        </ul>
                        <p>若支付遇到问题，请致电400-188-5179</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 库存不足模态框end -->

    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="add-title font-color4">使用新地址</p>
                </div>
                <div class="modal-body">
                    <?php
                    $options = [];
                    $options['options'] = ['class' => 'form-horizontal', 'id' => 'modalAddAddressFrom'];
                    $options['fieldConfig'] = [
                        'template' => "{label}\n<div class=\"col-sm-10\">{input}</div>",
                        'labelOptions' => ['class' => 'col-sm-2'],
                        'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']
                    ];
                    $form = ActiveForm::begin($options);
                    ?>
                    <?= $form->field($model, 'receiverName')->textInput(['placeholder' => '请填写收货人姓名', 'class' => 'form-control recipients-name', 'id' => 'recipients-name']) ?>

                    <?= $form->field($model, 'stateCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => "{label}\n{input}"])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address']) ?>
                    <?= $form->field($model, 'cityCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => '{input}'])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address']) ?>
                    <?= $form->field($model, 'districtCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => '{input}'])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address']) ?>

                    <?= $form->field($model, 'address')->textInput(['placeholder' => '请填写详细地址']) ?>
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
                                    'url' => Url::to(['address/ajaxcreate']),
                                    'success' => new \yii\web\JsExpression('function(json){
                                                    addressCreateSuccess(json);
                                                }'),
                                ],
                                'options' => ['class' => 'btn btn-ensure', 'type' => 'button'],
                                'checkDoubleClick' => true,
                            ]);
                            AjaxSubmitButton::end();
                            ?>
                            <?= Html::button('清空', ['class' => 'btn btn-empty', 'type' => 'reset']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <p class="timing-clock">请在下单后 <span class="font-color4">30 分钟 00 秒 </span>内完成支付</p>
    <div class="checkout-order">
        <?php if ($isCBT === TRUE)
        {
            ?>
            <div class="real-name">
                <p class="realname-title"><?= ++$index ?>、实名认证</p>
                <p class="warm-prompt">温馨提示：请使用和身份证号对应的真实姓名，否则您购买的商品将无法通过海关检查！<span class="thereason font-color4" data-toogle="popover" data-placement="bottom" data-content="上海外高桥进口商品网商品需清关后入境，根据海关需求，需要您填写您的身份证进行个人物品入境申报。<br/>因为海关会对您的身份信息进行验证，请确保填写正确，否则商品可能无法正常通关。<br/>身份证信息将加密保管，绝不对外泄漏。">为什么要实名认证</span></p>

                <div id="realnameInfo" <?php if ($isRealname)
        {
            ?>style="display:none" <?php } ?>>
                    <div class="realusername">
                        姓名：<span id="realname-name"><?= isset($realnameInfo['realName']) ? $realnameInfo['realName'] : '' ?></span>
                    </div>
                    <div class="realtelephone">
                        手机：<span id="realname-phone" class="font-color4"><?= isset($realnameInfo['mobile']) ? $realnameInfo['mobile'] : '' ?></span>
                    </div>
                    <div class="realemail">
                        邮箱：<span id="realname-email"><?= isset($realnameInfo['email']) ? $realnameInfo['email'] : '' ?></span>
                    </div>
                    <div class="realcard">
                        证件：身份证 <span id="realname-card"><?= isset($realnameInfo['identityNumber']) ? $realnameInfo['identityNumber'] : '' ?></span>
                    </div>
                </div>
                <?php if ($isRealname)
                {
                    ?>
                    <?php
                    $options = [];
                    $options['options'] = ['class' => 'form-horizontal', 'id' => 'realnameForm'];
                    $options['fieldConfig'] = [
                        'template' => "{label}\n<div class=\"col-sm-10\">{input}</div>",
                        'labelOptions' => ['class' => 'col-sm-2'],
                        'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']
                    ];
                    $form = ActiveForm::begin($options);
                    ?>
                    <?= $form->field($realnameModel, 'realName')->textInput(['placeholder' => '请填写真实姓名']) ?>
                    <?= $form->field($realnameModel, 'mobile')->textInput(['placeholder' => '请填写手机号码']) ?>
                    <?= $form->field($realnameModel, 'email')->textInput(['placeholder' => '请填写常用邮箱']) ?>
        <?= $form->field($realnameModel, 'identityType', ['template' => "{label}\n<div class=\"col-sm-8\">{input}</div>", 'options' => ['style' => 'display:inline-block;margin-top:10px;']])->listBox(['1' => '身份证'], ['class' => '', 'size' => '']) ?>
        <?= $form->field($realnameModel, 'identityNumber', ['labelOptions' => ['style' => 'display:none;'], 'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>", 'options' => ['style' => 'display:inline-block;']])->textInput(['placeholder' => '请填写证件号码']) ?>
                            <?= $form->field($realnameModel, 'type')->hiddenInput(['value' => '1']) ?>
                    <div class="form-group">
                        <label for="realname-btngroup" class="col-sm-2"></label>
                        <div class="btn-group" role="group" id="realname-btngroup">
                            <?php
                            AjaxSubmitButton::begin([
                                'label' => '确定',
                                'ajaxOptions' => [
                                    'type' => 'POST',
                                    'url' => Url::to(['realname/ajaxcreate']),
                                    'success' => new \yii\web\JsExpression('function(json){
                                                    realnameSuccess(json);
                                                }'),
                                ],
                                'options' => ['class' => 'btn btn-ensure', 'type' => 'button'],
                            ]);
                            AjaxSubmitButton::end();
                            ?>
                    <?= Html::button('清空', ['class' => 'btn btn-empty', 'type' => 'reset']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
    <?php } ?>
            </div>
            <?php } ?>

        <div class="shipping-address">
                <!-- <p class="add-title font-color4">2、修改地址</p> -->
            <?php
            if (empty($addressData) === FALSE)
            {
                $formStyle = 'display:none;';
                $listStyle = '';
            } else
            {
                $listStyle = 'style = "display:none;"';
                $formStyle = '';
            }
            ?>
            <p class="add-title"><?= ++$index ?>、地址选择</p>
            <table id="addressList" class="table" <?= $listStyle ?>>
                <tbody>
                            <?php foreach ($addressData as $address)
                            {
                                ?>
                        <tr class="address-tr <?= $address['isDefault'] == 1 && $isCBT ? 'checked-address' : '' ?>" style="z-index:0">
                            <td class="default-head">
    <?= $address['isDefault'] == 1 && $isCBT ? '寄送至' : '' ?>
                            </td>
                            <td class="default-name">
                                <label>
                                    <span class="radio-address-bg <?= $address['isDefault'] == 1 && $isCBT ? 'radio-time-bg-checked' : '' ?>">
                                        <input type="radio" name="address" id="shipping-time1" <?= $address['isDefault'] == 1 && $isCBT ? "checked='true'" : '' ?> class="radio-time" autocomplete="off" value="<?= $address['addressId'] ?>" district="<?= $address['districtCode'] ?>" state="<?= $address['stateCode'] ?>" city="<?= $address['cityCode'] ?>" postcode="<?= $address['postcode'] ?>"/>
                                    </span>
                                    <span class="receiverName"><?= Tools::substr_mb($address['receiverName'],4) ?></span>
                                </label>
                            </td>
                            <td class="default-tel"><?= $address['receiverMobile'] ?></td>
                            <td class="default-add-detail"><?= Tools::substr_mb($address['address']); ?></td>
                            <td class="shipping-operation" style="z-index:1">
                                <?php if ($address['isDefault'] == 1)
                                {
                                    ?>
                                    <span>默认地址</span>
                                    <a class="operation1 unsetDefault">取消默认地址</a>
    <?php } else
    {
        ?>
                                    <a class="operation1 setDefault">设为默认地址</a>
    <?php } ?>
                                <a name="editAddress" class="operation2" modalHref="<?= Url::to(['address/edit', 'addressId' => $address['addressId']]) ?>">修改本地址</a>
                                <a class="operation3">删除</a>
                            </td>
                        </tr>
            <?php } ?>
                </tbody>
            </table>
            <button class="btn btn-newaddress" <?= $listStyle ?> data-toggle="modal" data-target="#myModal"><span class="addbg">+</span>使用新地址</button>

            <?php
            $options = [];
            $options['options'] = ['class' => 'form-horizontal', 'style' => $formStyle, 'id' => 'addAddressForm'];
            $options['fieldConfig'] = [
                'template' => "{label}\n<div class=\"col-sm-10\">{input}</div>",
                'labelOptions' => ['class' => 'col-sm-2'],
                'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']
            ];
            $form = ActiveForm::begin($options);
            ?>
                <?= $form->field($model, 'receiverName')->textInput(['placeholder' => '请填写收货人姓名', 'class' => 'form-control recipients-name', 'id' => 'recipients-name']) ?>

                <?= $form->field($model, 'stateCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => "{label}\n{input}"])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address', 'id' => 'addressapi_statecode']) ?>
                <?= $form->field($model, 'cityCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => '{input}'])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address', 'id' => 'addressapi_citycode']) ?>
                <?= $form->field($model, 'districtCode', ['options' => ['style' => 'display:inline-block;', 'class' => 'form-group'], 'template' => '{input}'])->dropDownList(['' => '请选择'], ['class' => 'form-control col-sm-2 recipients-address', 'id' => 'addressapi_districtcode']) ?>

                <?= $form->field($model, 'address')->textInput(['placeholder' => '请填写详细地址', 'class' => 'form-control recipients-address-detail', 'id' => 'addressapi_address']) ?>
                <?= $form->field($model, 'receiverMobile', ['options' => ['style' => 'display:inline-table;margin-right:20px;', 'class' => 'form-group'], 'template' => "{label}\n<div class=\"col-sm-8\" style=\"box-sizing:content-box;margin-right:-13px;padding-right:17px\">{input}<span class=\"recipients-tel-width1\" style=\"margin-left:14px;line-height:34px;\">或固定电话</span></div>",])->textInput(['placeholder' => '请填写手机号码', 'class' => 'form-control col-sm-2 recipients-tel']) ?>
                <?= $form->field($model, 'receiverPhone', ['options' => ['style' => 'display:inline-table;', 'class' => 'form-group'], 'template' => "{input}"])->textInput(['placeholder' => '请填写固定电话']) ?>
                        
                <?= $form->field($model, 'stateName', ['options' => ['class' => ''], 'template' => '{input}'])->hiddenInput(['id' => 'provice2']) //id指定后将不能自动描红?>
                <?= $form->field($model, 'cityName', ['options' => ['class' => ''], 'template' => '{input}'])->hiddenInput(['id' => 'city2']) ?>
                <?= $form->field($model, 'districtName', ['options' => ['class' => ''], 'template' => '{input}'])->hiddenInput(['id' => 'district2']) ?>

            <div class="form-group">
                <label for="realname-btngroup" class="col-sm-2"></label>
                <div class="btn-group" role="group" id="realname-btngroup">
                    <?php
                    AjaxSubmitButton::begin([
                        'label' => '确定',
                        'ajaxOptions' => [
                            'type' => 'POST',
                            'url' => Url::to(['address/ajaxcreate']),
                            'success' => new \yii\web\JsExpression('function(json){
                                                    addressCreateSuccess(json);
                                                }'),
                        ],
                        'options' => ['class' => 'btn btn-ensure', 'type' => 'button'],
                    ]);
                    AjaxSubmitButton::end();
                    ?>
<?= Html::button('清空', ['class' => 'btn btn-empty']) ?>
                </div>
            </div>
<?php ActiveForm::end(); ?>

        </div>
        <!-- 收货地址end -->
        <!-- 送货时间start -->
        <!--<div class="shipping-time">
            <p class="time-title"><? //++$index ?>、送货时间</p>
            <form action="" method="post" class="form-horizontal">
                <label class="radio-inline">
                    <span class="radio-time-bg"><input type="radio" name="shipinst" id="shipping-time1" class="radio-time" autocomplete="off" value="1"/></span>仅工作日送货
                </label>
                <label class="radio-inline">
                    <span class="radio-time-bg"><input type="radio" name="shipinst" id="shipping-time2" class="radio-time" autocomplete="off" value="2"/></span>仅周末送货
                </label>
                <label class="radio-inline radio-time-border">
                    <span class="radio-time-bg"><input type="radio" name="shipinst" id="shipping-time3" class="radio-time" autocomplete="off" checked="checked" value="3"/></span>工作日/周末/节假日均可
                </label>
            </form>
        </div>-->
        <!-- 送货时间end -->
        <!-- 商品清单start -->
        <div class="product-listing">
            <p class="listing-title"><?= ++$index ?>、商品清单</p>
            <?php if(isset(Yii::$app->params['sm']['cart']['store'][substr($orderType, 0,2)])){ ?>
            <p class="listing-table-title"><?=  Yii::$app->params['sm']['cart']['store'][substr($orderType, 0,2)]?></p>
            <?php } else {?>
            <p class="listing-table-title"><?=  substr($orderType,2)?></p>
            <?php } ?>
            <ul>
                <li class="checkout-table-header">
                    <span class="th1">商品</span>
                    <span class="th2">店铺</span>
                    <span class="th2">重量</span>
                    <span class="th3">单价（元）</span>
                    <span class="th4">数量</span>
                    <span class="th5">小计（元）</span>
                </li>
                <?php foreach ($CartLines as $val){ ?>
                <li class="cart-table1-con">
                    <span class="th1">
                    <?php if (isset($val['children']) === FALSE){ ?>
                        <div class="product-cell">
                            <p class="product-name" title="<?= $val['itemDisplayText'] ?>"><?= Tools::substr_mb($val['itemDisplayText']) ?></p>
                        </div>
                    <?php } else {
                        foreach ($val['children'] as $child)
                        {
                    ?>
                            <div class="product-cell">
                                <p class="product-name"><span class="font-color8" title="<?= $child['itemDisplayText'] ?>"><?= $child['quantity'] ?>件 | </span><?= Tools::substr_mb($child['itemDisplayText']) ?></p>
                            </div>
                    <?php
                        }
                    }?>
                    </span>
                    <span class="th2">
                        <p class="product-price">阿尼们店铺</p>
                    </span>
                    <span class="th2">
                    <?php if (isset($val['children']) === FALSE){ ?>
                            <p class="product-price"><?=$val['itemWeight'].$val['itemWeightUOM']?></p>
                    <?php
                    } else {
                        foreach ($val['children'] as $child)
                        {
                    ?>
                            <p class="product-price"><?= $child['Sales-Weight'] . $child['Sales-WeightUOM'] ?></p>
                    <?php
                        }
                    }
                    ?>
                    </span>
                    <span class="th3 text-middle">
                        <?php if (isset($price['itemDetail'][$val['itemId']]['newUnitPrice'])): ?>
                            <p><?= Yii::$app->formatter->asDecimal((float) $price['itemDetail'][$val['itemId']]['newUnitPrice']) ?></p>
                            <p class="price-line"><?= Yii::$app->formatter->asDecimal((float) $val['itemOfferPrice']) ?></p>
                        <?php else: ?> 
                            <?php if($price['itemDetail'][$val['itemId']]['unitPrice'] < $val['itemOfferPrice']): ?> 
                                <p><?= Yii::$app->formatter->asDecimal((float) $price['itemDetail'][$val['itemId']]['unitPrice']) ?></p>
                                <p class="price-line"><?= Yii::$app->formatter->asDecimal((float) $val['itemOfferPrice']) ?></p>
                            <?php else: ?>
                                <p><?= Yii::$app->formatter->asDecimal((float) $price['itemDetail'][$val['itemId']]['unitPrice']) ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </span>
                    <span class="th4 text-middle text-middle"><?= $val['cartlineQuantity'] ?></span>
                    <span class="th5 text-middle">
                        <?php if (isset($price['itemDetail'][$val['itemId']]['newUnitPrice'])): ?>
                            <?= Yii::$app->formatter->asDecimal(((float) $price['itemDetail'][$val['itemId']]['newTotalPrice'])) ?>
                            <p class="price-line">
                                <?php $offerPrice = ($val['itemOfferPrice'] - $price['itemDetail'][$val['itemId']]['newUnitPrice']) * $val['cartlineQuantity'] ?>
                                省<?= Yii::$app->formatter->asDecimal($offerPrice) ?>
                            </p>
                            <?php 
                            if($price['itemDetail'][$val['itemId']]['unitPrice'] < $val['itemOfferPrice']){ 
                                $newOfferPrice = ($val['itemOfferPrice'] - $price['itemDetail'][$val['itemId']]['unitPrice']) * $val['cartlineQuantity'];
                                //累加
                                $offerPriceTotal += $newOfferPrice;
                            }
                            ?>
                        <?php else: ?>
                            <?php if($price['itemDetail'][$val['itemId']]['unitPrice'] < $val['itemOfferPrice']): ?> 
                                <?= Yii::$app->formatter->asDecimal(((float) $price['itemDetail'][$val['itemId']]['unitPrice'] * $val['cartlineQuantity'])) ?>
                                <p class="price-line">
                                    <?php $newOfferPrice = ($val['itemOfferPrice'] - $price['itemDetail'][$val['itemId']]['unitPrice']) * $val['cartlineQuantity'] ?>
                                    省<?= Yii::$app->formatter->asDecimal($newOfferPrice) ?>
                                </p>
                                <?php
                                    //累加
                                    $offerPriceTotal += $newOfferPrice;
                                ?>
                            <?php else: ?> 
                                <?= Yii::$app->formatter->asDecimal(((float) $price['itemDetail'][$val['itemId']]['newTotalPrice'])) ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </span>
                </li>
                <?php } ?>
                <li class="listing-explain clearfix">
                    <div class="coupons pull-left">
                        <div >
                            <label>
                                <span class="radio-coupons-bg"><input type="radio" checked="checked" name="coupons-radio" id="coupons3" class="coupons-radio" autocomplete="off" value=""/></span>不使用优惠券/优惠码
                            </label>
                        </div>
                        <div class="activation">
                            <label>
                                <span class="radio-coupons-bg"><input type="radio" name="coupons-radio" id="coupons1" class="coupons-radio" autocomplete="off" value=""/></span>使用优惠券：
                            </label>
                            <select  id="coupon_select" disabled="disabled" autocomplete="off" placeholder="aaaaaaa">
                                <option value="-1" disabled selected>请选择你想使用的优惠券</option>
                            </select>
                        </div>
                        <div class="activation">
                            <label>
                                <span class="radio-coupons-bg"><input type="radio" name="coupons-radio" id="coupons2" class="coupons-radio" autocomplete="off" value=""/></span>激活优惠码：
                            </label>
                            <input id= 'coupon_code' type="text" name="" value="" class="input-coupons" autocomplete="off" placeholder="请输入优惠码" disabled="disabled"/>
                            <button class="btn btn-activation" autocomplete="off" disabled="disabled">立即激活</button>	
                        </div>
                        
                    </div>
                    <div class="listing-total pull-right">
                        <div>商品总计：<span class="order-total">￥<?= $price['orderDetail']['originalPrice']+$offerPriceTotal ?></span></div>
                        <div>
                            <span class="activity1">
                                <?php if(isset($price['orderDetail']['orderPromotionName']) && count($price['orderDetail']['orderPromotionName']) > 1 ){ ?>
                                <span class="promotion-message font-color4" data-toogle="popover" data-container="body" data-placement="bottom" data-content="<?=implode('<BR>', $price['orderDetail']['orderPromotionName'])?>">
                                    <?php if(isset($price['orderDetail']['orderPromotionName'])){ ?>
                                    您参加了<?=count($price['orderDetail']['orderPromotionName'])?>种活动
                                    <?php } ?>
                                </span>
                                <span style="display:none"></span>
                                <?php }elseif(isset($price['orderDetail']['orderPromotionName'])){ ?>
                                <span class="promotion-message font-color4" data-toogle="popover" data-container="body" data-placement="bottom" data-content="" style="display:none"></span>
                                <span>您参加了 【<?= $price['orderDetail']['orderPromotionName'][0]?>】 的活动</span>
                                <?php }else{ ?>
                                <span class="promotion-message font-color4" data-toogle="popover" data-container="body" data-placement="bottom" data-content="" style="display:none"></span>
                                <span style="display:none"></span>
                                <?php } ?>
                            </span>
                            活动优惠：<span class="activity-span">-￥<?= number_format($price['orderDetail']['promotion']+$offerPriceTotal,2,'.','') ?></span>
                        </div>
                        <div>
                            <span class="free-activity">
                                <?php if(isset($price['orderDetail']['orderFreeShipment'])){ ?>
                                【<?= $price['orderDetail']['orderFreeShipment']?>】
                                <?php } ?>
                            </span>
                            运费：　　<span class="freight-span">￥<?= $price['orderDetail']['shipping'] ?></span>
                        </div>
                        <?php if($isCBT === TRUE){ ?>
                        <div>
                            <span class="activity1 tax-message">
                                <?php if($price['orderDetail']['tax'] <= 50){ ?>
                                关税≤50，免征！
                                <?php } ?>
                            </span>
                            订单关税：<span class="order-tariffs <?= $price['orderDetail']['tax'] <= 50 ? 'price-line' : '' ?>">￥<?= $price['orderDetail']['tax'] ?></span>
                        </div>
                        <?php } ?>
                        <div>应付金额：<span class="amount-payable">￥<?= $price['orderDetail']['actualPrice'] ?></span></div>
                    </div>

                </li>
            </ul>		

        </div>
        <!-- 商品清单end -->
        <!-- 支付方式start -->
        
        <!-- 其他start -->
        <div class="other-invoice">
            <?php if(!$isCBT) { ?>
            <p class="invoice-title"><?= ++$index ?>、其他</p>
            <div class="form-group">
                <label class="checkbox-label"><span class="check-invoice-bg"><input id="invoice-switch" <?= $isCBT ? 'disabled=true' : '' ?> type="checkbox" autocomplete="off" name="" value=""/></span></label>发票
            </div>

            <div class="form-group invoice-inf" style="display:none;">
                <p class="invoice-p">
                    开票方式：
                    <label><span class="radio-invoice-bg"><input type="radio" name="" value="" autocomplete="off" disabled="disabled"/></span></label>纸质发票
                </p>
                <p class="invoice-p">
                    开票抬头： 
                    <label><span class="radio-invoice-bg"><input type="radio" name="invoice-radio" value="个人" autocomplete="off" disabled="disabled"/></span></label>个人　　　
                    <label><span class="radio-invoice-bg"><input type="radio" name="invoice-radio" class="company-radio" value="公司" autocomplete="off" disabled="disabled"/></span></label>公司
                    <input type="text" class="company-name" id="invName" name="" value="" placeholder="公司名称" autocomplete="off" disabled="disabled"/>
                </p>
                <button class="btn btn-invoice" disabled="disabled">保存发票信息</button>
                <p class="save-invoice" style="display:none;">
                    <span class="showInvoiceInfo">纸质发票</span><span invType="" class="showInvoiceInfo"></span><span class="showInvoiceInfo"></span>
                    <span><a href="javascript:void()" id="editInvoice">修改</a></span>
                </p>
            </div>
            <?php } ?>
            <div class="checkout-btn clearfix">
                <?php if(!empty($CartLinesIds)){ ?>
                <a href="<?= Url::to(['cart/index']) ?>" class="btn btn-returncart pull-left">返回购物车修改</a>
                <?php } ?>
                <span class="total-text pull-left">
                    <!--<span class="font-size1 font-color1">【支付宝活动减5元】</span>-->
                    应付总额：<span id='actualPrice' class="font-color6">￥<?= $price['orderDetail']['actualPrice'] ?></span>
                    <!--<span id='oldActualPrice' class="font-color7">￥<?= $price['orderDetail']['actualPrice'] ?></span>-->
                </span>
                <?= Html::beginForm(['order/payment'], 'get', ['id' => 'payForm', 'enctype' => 'multipart/form-data', 'isSubmit' => 'T']) ?>
                    <input type="hidden" class="check_id" id='orderId' name="orderIds" value="" >
                    <button class="btn btn-sure pull-right " >确认交易</button>
                <?= Html::endForm() ?>
            </div>
        </div>

        <!-- 其他end -->
    </div>
    <p class="timing-clock timing-right">请在下单后 <span class="font-color4">30 分钟 00 秒 </span>内完成支付</p>



</div>
<script>
    var stateCode = "<?= $model->stateCode ?>";
    var cityCode = "<?= $model->cityCode ?>";
    var districtCode = "<?= $model->districtCode ?>";

    var addressDeleteUrl = "<?= Url::to(['address/ajaxdelete']); ?>";
    var addressSetDefaultUrl = "<?= Url::to(['address/ajax-set-default']); ?>";
    var addressUnSetDefaultUrl = "<?= Url::to(['address/ajax-unset-default']); ?>";
    var addressEditUrl = "<?= Url::to(['address/edit', 'addressId' => '']) ?>";
    var getInventoryUrl = "<?= Url::to(['inventory/check-inventorys']); ?>";
    var getPriceUrl = "<?= Url::to(['cart/price']); ?>";
    var submitUrl = "<?= Url::to(['order/create']); ?>";
    var orderListUrl = "<?=Url::to(['order/index'],TRUE)?>";
    var paymentUrl = "<?=Url::to(['order/payment','orderIds' => ''],TRUE)?>";
    var listCouponUrl = "<?=Url::to(['cart/list-valid-coupons']);?>";
    var activeCouponUrl = "<?=Url::to(['cart/active-coupon']);?>";
    var selectedCouponId = null;
    var _csrf = "<?= $_csrf ?>";
    var itemInfo = {<?php foreach ($CartLines as $val){echo "'" . $val['itemPartNumber'] . "':'" . $val['itemOwnerId'] . "',";} ?>};
    var cartlineIds = "<?= $CartLinesIds ?>";
    var orderType = "<?= $orderType ?>";
    var canSubmit = "<?= $price['orderDetail']['canSubmit'] ?>";
    var itemIdsInfo = '<?= $itemIdsInfo ?>';
    var orderId = '';
    var checkedAddressId = '';
    var orderAmount = <?= $price['orderDetail']['originalPrice'] - $price['orderDetail']['promotion']?>;
    var maxAmount = <?= Yii::$app->params['sm']['store']['maxAmount'] ?>;
    var newOfferPrice_old = <?= $offerPriceTotal ?>;
    var newOfferPrice = newOfferPrice_old.toFixed(2);
    
    var isRealName = '<?=$isRealname?>';
    var isCBT = '<?=$isCBT?>';
</script>