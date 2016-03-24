<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\CartAsset; //todo by caoqi
use yii\bootstrap\ActiveForm;
use frontend\widgets\AjaxSubmitButton;

Yii::$app->formatter->nullDisplay = '0.00';

CartAsset::register($this);

/* @var $this yii\web\View */
$this->title = '提交订单_上海外高桥进口商品网';
?>
<style type="text/css">
    .inputstyle, .x-input{padding:3px 5px 3px 14px;}
    .error-message-body{height:auto;padding:20px;}
    .error-message{height:auto;}
    .other_addr_detail p{display:inline-block;}
    .other_addr_detail{display:table;}


</style>
<script>
var switchAddress = function (){

    var input = this.getChildren('input');
    var span = this.getChildren('span');

    input_addrId = input[0];
    //如果点击的是当先选中的地址，则返回。

    if (input_addrId.value == $('orderapi-shipaddressid').value) {
        return;
    }
    if (!confirm('更换地址后，您需要重新确认订单信息')) {
        return;
    }
    this.getChildren("p input").set('checked',true);
    $('orderapi-shipaddressid').value = input_addrId.value;
    //updateNewAddr(input_addrId.value, '');
    //$$('.selected').removeClass('selected');
    //this.addClass('selected');
    $('newAddr').setStyle('display', 'none');
    $('userNewAdd').setStyle('display', '');
    $('addrArea_id').value = input[0].value;
    //alert(input[1].value);
    //setUpShipping(input[1].value);

    var _country_code = input[1].value;
    var _district_code = input[2].value;
    var _postcode = input[3].value;
    var _city_code = input[4].value;
    var _state_code = input[5].value;
    var _cartlineIds = $('cartlineIds').value;
    var _address = {
        'country_code': _country_code,
        'district_code': _district_code,
        'postcode': _postcode,
        'city_code': _city_code,
        'state_code': _state_code,
    };

    getInventory(_country_code,_state_code);
    
    //更改地址后，重新计算价格
    var url;
    url = '<?= Url::to(['cart/price']) ?>';

    new Request({
        url: url,
        method: 'post',
        data: {
            cartlineIds: _cartlineIds,
            address: _address,
            couponIds: null,
            price: true,
            promotion: true,
            shipping: true,
            tax: true,
            _csrf : '<?=$_csrf?>',
        },
        onSuccess: function (res) {
            var _success_res = JSON.decode(res);
            var storePrice = _success_res.storePrice;
            var totalPrice = _success_res.totalPrice;
            for(var sp in storePrice)
            {
                $('subtotal_slip_' + sp).set('html', '￥'+storePrice[sp].final);
                $('discount_' + sp).set('html', '￥ -'+storePrice[sp].promotion);
                $('shipping_' + sp).set('html', '￥'+storePrice[sp].shipping);
            }

            $('totalPrice_final').set('html','￥'+ totalPrice.originalPrice);
            $('totalPrice_shipping').set('html', '￥'+totalPrice.shipping);
            $('total_promotion').set('html', '￥ -'+totalPrice.promotion);
            $('paymentPrice').set('html','￥'+ totalPrice.final);
        }.bind(this),
    }).send();

    var shipping_addrinfo_street = this.getElement('span.addrinfo-street').get('html');
    $('shipping_addrinfo_street').set('html', shipping_addrinfo_street);
    var shipping_addrinfo_name = this.getElement('span.addrinfo-name').get('html');
    $('shipping_addrinfo_name').set('html', shipping_addrinfo_name);
    
    var receiverName = this.getElement('span.addrinfo-name').get('html');
    $('receiverName').set('html', receiverName);
    var receiverMobile = this.getElement('span.addrinfo-tel').get('html');
    $('receiverMobile').set('html', receiverMobile);
    var receiverAddress = this.getElement('span.addrinfo-street').get('html');
    $('receiverAddress').set('html', receiverAddress);
}
</script>
<div class="main w1200">
    <div class="mTB">
        <div class="cart-wrap bai1200 dis_bl clb" id="log" style="width: 1200px;">
            <div class="dis_bl">
                <div class="share_site">当前位置：<a href="<?= Yii::$app->params['baseUrl'] ?>">首页</a> &gt; <a class="red" href="<?= Yii::$app->params['baseUrl'] ?>cart-checkout.html#">购物车</a></div>
            </div>
            <div class="cart-nav stepbj2 dis_bl clb"></div>
            
            <?php
            $options = [];
            $options['action'] = ['order/create'];
            $options['fieldConfig'] = ['labelOptions' => ['style' => 'display:none;'],'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']];
            $form = ActiveForm::begin($options)
            ?>
            <?= $form->field($orderModel, 'shipAddressId')->hiddenInput(['value' => isset($defaultAddress['addressId']) ? $defaultAddress['addressId'] : '']) ?>
            <?= $form->field($orderModel, 'invCategory')->hiddenInput() ?>
            <?= $form->field($orderModel, 'invName')->hiddenInput() ?>
            <?= $form->field($orderModel, 'shipInst')->hiddenInput(['value' => '1']) ?>
            <?= $form->field($orderModel, 'cartlineId')->hiddenInput(['value' => $CartLinesIds, 'id' => 'cartlineIds']) ?>
            <?= $form->field($orderModel, 'cartlineDTOList')->hiddenInput(['value' => $cartlineDTOList]) ?>
            <?= Html::hiddenInput('isRealname', $isRealname) ?>
            <?php ActiveForm::end(); ?>
            <input type ="hidden" id='submitState' value='<?=$submitState?>'>
            <div class="clearboth">

                <div class="section">
                    <div class="form-title receiver_addr">

                        <div class="cart_order_m4"><span class="cart_order_text1">确认订单信息 |</span> <span class="cart_order_text2">请在<span class="cart_order_time"><span class="cart_order_min1" id="cart_order_min1">15</span>分<span class="cart_order_sec1" id="cart_order_sec1">42</span>秒 内提交订单，下单后你另有30分钟的支付时间。</span></span></div>

                        <div class="cart_order_m4_get">收货信息</div>

                        <div id="def_addr_info" class="hid_item cancel_receiver_info receiver_addr">
                            <ul id="address-list">
                                <?php 
                                    if(!empty($defaultAddress)){
                                        $display = 'block';
                                    }else{
                                        $display = 'none';
                                    }
                                ?>
                                <li class="J_Addr J_MakePoint selected" id="defaultAddress" style="display:<?=$display?>">
                                    <input type="hidden" value="977">
                                    <input type="hidden" id="default_addr" value="31">

                                    <table width="100%" height="166" border="0" cellspacing="0" cellpadding="10" class="order_addr_list">

                                        <tbody><tr>
                                                <td width="15%" height="30" align="right"></td>
                                                <td width="60%" id="receiverName"><?= isset($defaultAddress['receiverName']) ? $defaultAddress['receiverName'] : ''?></td>
                                                <td width="25%" class="order_addr_default" align="right">当前地址</td>
                                            </tr>
                                            <tr>
                                                <td height="30" align="right"></td>
                                                <td id="receiverMobile"><?= isset($defaultAddress['receiverMobile']) ? $defaultAddress['receiverMobile'] : '' ?></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="30" align="right" valign="top"></td>
                                                <td valign="top" id="receiverAddress" colspan="2">
                                                <?= 
                                                isset($defaultAddress['cityName']) ? $defaultAddress['cityName'] : ''.
                                                isset($defaultAddress['districtName']) ? $defaultAddress['districtName'] : ''.
                                                isset($defaultAddress['address']) ? $defaultAddress['address'] : ''
                                                ?>
                                                </td>

                                            </tr>

                                        </tbody></table>

                                </li>
                                
                                <li class="J_Addr J_MakePoint" style="width:auto;">
                                    <a onclick="this.hide();$('newAddr').show();" id="userNewAdd" style="display:'';">
                                            <img src="<?= Yii::$app->params['baseimgUrl'] ?>order_submit_13.png" width="302" height="167" border="0">
                                    </a>
<?php
        $options = [];
        $options['enableClientValidation'] = true;
        $options['fieldConfig'] = ['labelOptions' => ['style' => 'display:none;'],'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']];
        $form = ActiveForm::begin($options);
?>
                                    <div class="usenewaddr_display_form" style="display:none;" id="newAddr">
                                        <table class="address">
                                            <tbody><tr>

                                                    <td>
                                                        <div style="float:left;margin-bottom:5px;">
                                                            <?= $form->field($model, 'receiverName')->textInput([ 'class' => 'x-input inputstyle', 'size' => 20, 'placeholder' => '收货人姓名']) ?>            </div>
                                                        <div id="usernewaddr_error_addrname" class="addr_error_text"></div>
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td>
                                                        <div style="float:left;margin-bottom:5px;">
                                                            <?= $form->field($model, 'receiverMobile')->textInput(['class' => 'x-input inputstyle', 'size' => 20, 'placeholder' => '手机号码']) ?>
                                                        </div>
                                                        <div id="usernewaddr_error_addrmobile" class="addr_error_text"></div>
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td><?= $form->field($model, 'receiverPhone')->textInput(['class' => 'x-input inputstyle', 'size' => 20, 'placeholder' => '备用联系电话(固话/手机)', 'style' => 'float:left;']) ?>            
                                                        * 可选填，为确保及时收货，请尽量填写备用电话(固话或手机)
                                                    </td>
                                                </tr>	
                                                <tr>

                                                    <td>
                                                        <div style="float:left;width:500px;margin:5px 0;">
                                                            <span id="selectArea">
                                                                <?= $form->field($model, 'stateCode')->dropDownList(['' => '请选择'], [ 'class' => 'inputstyle', 'data-level-index' => 0, 'style' => 'float:left;margin-right:5px;']) ?>
        <?= $form->field($model, 'cityCode')->dropDownList(['' => '请选择'], ['class' => 'inputstyle', 'data-level-index' => 0, 'style' => 'float:left;margin-right:5px;']) ?>
        <?= $form->field($model, 'districtCode')->dropDownList(['' => '请选择'], [ 'class' => 'inputstyle', 'data-level-index' => 0, 'style' => 'float:left;']) ?>
        <?= $form->field($model, 'stateName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'provice1']) //id指定后将不能自动描红?>
        <?= $form->field($model, 'cityName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'city1']) ?>
        <?= $form->field($model, 'districtName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'district1']) ?>
        <script>
            jQuery(function () {
                preSelect("<?= $model->stateCode ?>", "<?= $model->cityCode; ?>", "<?= $model->districtCode; ?>",
                        '#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');//preselect("四川省","成都市","金牛区");//设置默认选项
                initCountry('#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');
                jQuery("#address_submit").click(function () {
                    console.log(111);
                    jQuery(this).removeClass("disabled");
                });
            });
            //Message.error("加入购物车失败.<br /><ul><li>可能库存不足.</li><li>或提交信息不完整.</li></ul>");
        </script>
                                                            </span>
                                                            <input type="hidden" id="selected-area" value="上海市杨浦区" name="delivery[ship_addr_area]">
                                                            <input type="hidden" id="area_id" value="31">
                                                        </div>
                                                        <div id="usernewaddr_error_addrregin" class="addr_error_text"></div>
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td>
                                                        <div style="float:left;margin-bottom:5px;">
                                                            <span id="selected-area-show"></span>
                                                            <?= $form->field($model, 'address')->textInput([ 'class' => 'inputstyle', 'size' => 40 ,  'style'=>'max-width:690px;max-height:340px', 'placeholder' => '详细地址']) ?>
                                                            <input type="hidden" name="delivery[ship_addr]" id="ship_addr" value="上海市杨浦区铁岭路50弄30号202">
                                                        </div>
                                                        <div id="usernewaddr_error_addrmail" class="addr_error_text"></div>
                                                    </td>
                                                </tr>

                                                <tr style="display:none">
                                                    <td><input autocomplete="off" class="x-input width_200" type="text" id="addrZip" name="delivery[ship_zip]" value="200092" vtype="text"></td>
                                                </tr>



                                                <tr>

                                                    <td>
                                                        <?php AjaxSubmitButton::begin([
                                                            'label' => '保存',
                                                            'ajaxOptions' => [
                                                                'type'=>'POST',
                                                                'url'=>  Url::to(['address/ajaxcreate']),
                                                                /*'cache' => false,*/
                                                                'success' => new \yii\web\JsExpression('function(json){
                                                                    var json_obj = eval(json);
                                                                    if(!json_obj.code && json_obj.code != 0){
                                                                        if(json_obj.status){
                                                                            //填入默认地址
                                                                            jQuery("#receiverName").html(json_obj.info.receiverName);
                                                                            jQuery("#receiverMobile").html(json_obj.info.receiverMobile);
                                                                            jQuery("#receiverAddress").html(json_obj.info.address);
                                                                            setAddress(json_obj.info);
                                                                            
                                                                            //填入收货人信息
                                                                            jQuery("#shipping_addrinfo_street").html(json_obj.info.address);
                                                                            jQuery("#shipping_addrinfo_name").html(json_obj.info.receiverName);
                                                                            //填入submit表单
                                                                            jQuery("#orderapi-shipaddressid").val(json_obj.info.addressId);
                                                                            jQuery("#userNewAdd").show();
                                                                            jQuery("#newAddr").hide();
                                                                            jQuery("#defaultAddress").show();
                                                                            Message.error("保存成功");
                                                                            getInventory("CN",json_obj.info.stateCode);
                                                                        }else{
                                                                            Message.error(json_obj.message.split("</br>")[0]);
                                                                        }
                                                                    }else{
                                                                        Message.error(json_obj.message.split("</br>")[0]);
                                                                    }
                                                                }'),
                                                            ],
                                                            'options' => ['class' => 'cart_anniu1', 'type' => 'button'],
                                                            ]);
                                                            AjaxSubmitButton::end();
                                                        ?>
                                                        <input type="button" onclick="useNewCancle()" value="取消" class="cart_anniu1" style="margin-left:20px">
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                    </div>
<?php ActiveForm::end(); ?>
                                </li>
                            </ul>
                            <ul class="other_addr">
                                <?php if(!empty($defaultAddress)){ ?>
                                <li class="other_addr_detail">
                                    <input type="hidden" value="<?= $defaultAddress['addressId']?>">
                                    <input type="hidden" id="country_code" value="CN">
                                    <input type="hidden" id="district_code" value="">
                                    <input type="hidden" id="postcode" value="">
                                    <input type="hidden" id="city_code" value="">
                                    <input type="hidden" id="state_code" value="<?=$defaultAddress['stateCode']?>">

                                    <p>
                                        <input type="radio" checked="checked" value="<?= $defaultAddress['addressId']?>" id="ad_li_1" name="ad_li_other">
                                        <label>
                                            <span class="addrinfo-province"></span>
                                            <span title="城市" class="addrinfo-city"><?= $defaultAddress['cityName']?></span>
                                            <span class="addrinfo-dist"><?= $defaultAddress['districtName'] ?></span>
                                            <span title="收货地区" class="addrinfo-street"><?= $defaultAddress['address'] ?></span>
                                            (<span title="收货人" class="addrinfo-name"><?= $defaultAddress['receiverName'] ?></span> 收)
                                            <span class="addrinfo-tel"><?= $defaultAddress['receiverMobile'] ?> </span>
                                        </label>
                                    </p>
                                </li>
                                <?php } ?>
                                <?php 
                                if($addressData && is_array($addressData)){
                                    foreach($addressData as $k=>$v){
                                ?>
                                <li class="other_addr_detail">

                                    <input type="hidden" value="<?= $v['addressId']?>">
                                    <input type="hidden" id="country_code" value="CN">
                                    <input type="hidden" id="district_code" value="">
                                    <input type="hidden" id="postcode" value="">
                                    <input type="hidden" id="city_code" value="">
                                    <input type="hidden" id="state_code" value="<?=$v['stateCode']?>">

                                    <p>
                                        <input type="radio" value="<?= $v['addressId']?>" id="ad_li_1" name="ad_li_other">
                                        <label>
                                            <span class="addrinfo-province"></span>
                                            <span title="城市" class="addrinfo-city"><?= $v['cityName']?></span>
                                            <span class="addrinfo-dist"><?= $v['districtName'] ?></span>
                                            <span title="收货地区" class="addrinfo-street"><?= $v['address'] ?></span>
                                            (<span title="收货人" class="addrinfo-name"><?= $v['receiverName'] ?></span> 收)
                                            <span class="addrinfo-tel"><?= $v['receiverMobile'] ?> </span>
                                        </label>
                                    </p>

                                </li>
                                <?php
                                    }
                                }
                                ?>
                                <div style="display:none;" id="other_addr_detail_template">
                                    <li class="other_addr_detail" >
                                        <input type="hidden" value="">
                                        <input type="hidden" id="country_code" value="CN">
                                        <input type="hidden" id="district_code" value="">
                                        <input type="hidden" id="postcode" value="">
                                        <input type="hidden" id="city_code" value="">
                                        <input type="hidden" id="state_code" value="">
                                        <p>
                                            <input type="radio" value="" id="ad_li_1" name="ad_li_other">
                                            <label>
                                                <span class="addrinfo-province"></span>
                                                <span title="城市" class="addrinfo-city"></span>
                                                <span class="addrinfo-dist"></span>
                                                <span title="收货地区" class="addrinfo-street"></span>
                                                (<span title="收货人" class="addrinfo-name"></span> 收)
                                                <span class="addrinfo-tel"></span>
                                            </label>
                                        </p>
                                    </li>
                                </div>
                                <script>
                                    window.addEvent('domready', function () {
                                        
                                        $$('.other_addr_detail').each(function (item) {
                                            item.addEvent('click',switchAddress);

                                            item.addEvent('mouseenter', function () {
                                                //this.addClass('selected');
                                            });

                                            item.addEvent('mouseenter', function () {
                                                //this.removeClass('selected');
                                            });
                                        });
                                    });
                                    function setAddress(info){
                                        jQuery("#other_addr_detail_template input:eq(0)").val(info.addressId);
                                        jQuery("#other_addr_detail_template input:eq(5)").val(info.stateCode);
                                        jQuery("#other_addr_detail_template input:eq(6)").val(info.addressId);
                                        jQuery("#other_addr_detail_template input:eq(6)").attr('checked','checked');
                                        
                                        jQuery("#other_addr_detail_template span:eq(1)").html(info.cityName);
                                        jQuery("#other_addr_detail_template span:eq(2)").html(info.districtName);
                                        jQuery("#other_addr_detail_template span:eq(3)").html(info.address);
                                        jQuery("#other_addr_detail_template span:eq(4)").html(info.receiverName);
                                        jQuery("#other_addr_detail_template span:eq(5)").html(info.receiverMobile);
                                        jQuery(".other_addr").prepend(jQuery("#other_addr_detail_template").html());
                                        $$('.other_addr_detail').each(function (item) {
                                            item.addEvent('click',switchAddress);
                                        });
                                    }
                                </script> </ul>
                            <!--
                           <div class="mt_20"><input type="button" value="使用新地址" class="cart_anniu1"></div>

                           <div class="mt_20" style="display:''"><input type="button" value="返回购物车修改" class="cart_anniu2"  id="back_cart" /></div>
                           <div class="mt_20 management_addr"><a href="<?= Yii::$app->params['baseUrl'] ?>member-receiver.html" target="_blank">管理收货地址</a></div>
                            -->
                            <input type="hidden" value="" id="addrArea_id">
                            <script>

                                //使用新的配送地址。不在列表中选择。
                                //	$('userNewAdd').addEvent('click',function(e){
                                //    if(!confirm('更换地址后，您需要重新确认订单信息')){
                                //        return;
                                //    }
                                //	var addr_id = $('addr_id').value;
                                //	updateNewAddr(addr_id,'new');
                                //		
                                //	});
                                function updateNewAddr(addr_id, type) {
                                    new Request.HTML({
                                        url: "<?= Yii::$app->params['baseUrl'] ?>cart-useNewAddr.html",
                                        update: 'newAddr',
                                        method: 'post',
                                        data: {'addr_id': addr_id},
                                        onRequest: function () {
                                            $('newAddr').set('html', '<div class="font-green">loading...</div>');
                                        },
                                        onComplete: function () {
                                            if (type == "new") {
                                                $('newAddr').setStyle('display', '');
                                                $('addrMail').set('text', '');
                                            }
                                        }}).send();
                                }

                                function setUpShipping(value) {
                                    $('addrArea_id').value = value;
                                    Order.setShippingFromArea($('addrArea_id'));
                                }
                                
                                function useNewCancle() {
                                    $('newAddr').setStyle('display', 'none');
                                    $('userNewAdd').setStyle('display', 'block');
                                    // $('newAddr').setStyle('visibility','hidden');
                                    // new Fx.Style('newAddr', 'height', {onComplete: function(){$('newAddr').setStyle('visibility','hidden');$('newAddr').setStyle('display','none');}}).start(219,0);
                                }

                                function addrShowErrorText(errorDiv, text) //新建错误信息提示框
                                {

                                    var str = '<div class="error_text_tips_left"></div>' +
                                            '<div class="error_text_tips_middle">' + text + '</div>' +
                                            '<div class="error_text_tips_right"></div>';

                                    $(errorDiv).set('html', str);
                                    alert(errorDiv);
                                    $(errorDiv).setStyle('display', 'block');

                                }
                            </script>

                            <script>
                                window.addEvent('domready', function () {
                                    selectArea1 = function (sels) {
                                        var selected = [];
                                        sels.each(function (s) {
                                            if (s.getStyle('display') != 'none') {
                                                var text = s[s.selectedIndex].text.trim().clean();
                                                if (['北京', '天津', '上海', '重庆'].indexOf(text) > -1)
                                                    return;
                                                selected.push(text);
                                            }
                                        });
                                        var selectedV = selected.join('');
                                        $('selected-area').set('value', selectedV);
                                        $('selected-area-show').setText(selectedV);
                                    }

                                });
                            </script>
                        </div>
                    </div>
                </div>
                <!-- 收货时间-->
                <div class="section">
                    <div class="cart_order_m4_get">收货时间</div> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:20px 0 20px 85px;">
                        <tbody><tr>
                                <td width="30" height="30"><input type="radio" checked="checked" name="receivedate" id="receivedate1" value="1"></td>
                                <td style="font-family:&#39;微软雅黑&#39;; font-size:12px; "><label for="receivedate1">周一至周五</label></td>
                                <td style="font-family:&#39;微软雅黑&#39;; font-size:12px; color:#999;">收货地址为公司/学校，以及周末无人收货时，推荐选择。</td>
                            </tr>
                            <tr>
                                <td height="30"><input type="radio" name="receivedate" id="receivedate2" value="2"></td>
                                <td style="font-family:&#39;微软雅黑&#39;; font-size:12px; "><label for="receivedate2">周一至周日均可</label></td>
                                <td style="font-family:&#39;微软雅黑&#39;; font-size:12px; color:#999;">我们会尽快送达。若错过送货，请与快递小哥另约快递时间</td>
                            </tr>
                            <tr>
                                <td height="30"><input type="radio" name="receivedate" id="receivedate3" value="3"></td>
                                <td style="font-family:&#39;微软雅黑&#39;; font-size:12px; "><label for="receivedate3">周六日、节假日</label></td>
                                <td style="font-family:&#39;微软雅黑&#39;; font-size:12px; color:#999;">收货地址为家庭地址时，推荐选择。</td>
                            </tr>
                        </tbody></table>



                </div>

            </div>
                <!-- 购物车页面结构开始 -->
                <!-- <div class="mtb_20 price_all_cart">商品总价（不含运费）：<span>2619.00</span>元 <input type="button"  value="结算"/></div> -->
                <div id="goodsbody">
                    <div class="section">
                        <div class="form-title">
                            <div class="cart_order_m4_get">
                                订单商品信息 
                                <div class="fr">
                                    <?php if(empty($cartlineDTOList)){ ?>
                                    <a href="<?=Url::to(['cart/index']);?>">&lt;&lt; 返回购物车修改商品</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-body">

                        </div>
                    </div>

<?php foreach($CartLines as $type => $item){ ?>
                    <table class="pro_list_checkout_xu section ddqr_info" border="0" cellspacing="0" cellpadding="0" store_id="77" slip_id="800" id="storeid_77_800">
                        <colgroup>
                            <col style="width:40%">
                            <col style="width:20%">
                            <col style="width:20%">
                            <col style="width:20%">

                        </colgroup>
                        <thead>
                            <tr>
                                <th class="bl_none first">
                                    <p class="goods_shop_info">
                                        <span class="cjm_logo"></span>
                                        <span class="pl_10 pr_10"><span class="orange"><?=Yii::$app->params['sm']['store']['display'][$type]?></span></span>
                                    </p>
                                </th>
                                <th class="c_969696" width="166"></th>
                                <th class="c_969696" width="98">单价</th>
                                <th class="c_969696" width="140">数量</th>
                            </tr>
                        </thead>
                        <tbody>
<?php foreach($item as $v){ ?>
                            <tr chlid_id="del-1791" urlupdate="<?= Yii::$app->params['baseUrl'] ?>cart-update-goods.html" urlremove="<?= Yii::$app->params['baseUrl'] ?>cart-remove-goods.html" number="19" g_name="马来西亚 妈咪牌泰式东阴功风味杯面 72g" floatstore="0" buy_price="9.50" buy_store="2" buy_store_id="77">
                                <td class="first">
                                    <div class="spmc_r">
                                        <a target="_blank" class="item_title" href="<?= $v['itemLink'] ?>"><?= $v['itemDisplayText']; ?></a>
                                    </div>
                                </td>
                                <td class="goods_price textcenter">
                                    <span></span>
                                </td>
                                <td class="goods_price textcenter">
                                    <p class="now_price">￥<?= Yii::$app->formatter->asDecimal((float)$v['itemOfferPrice']); ?></p>
                                </td>
                                <td class="textcenter">
                                    <span id="<?=$v['itemPartNumber']?>" quantity="<?=$v['cartlineQuantity']?>" class="<?=$itemInventoryClass[$v['itemPartNumber']]?>"><?= $itemInventory[$v['itemPartNumber']]?></span>
                                </td>
                            </tr>
<?php } ?>
                        </tbody>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_checkout_order section">
                        <tbody>
                            <!--如果是最后一张订单-->
                            <tr class="goods_bj">
                                <td id="store_77">
                                    运费：
                                    <em class="red1" style="width:100px;" id="shipping_<?=$type?>">
                                        ￥<?=Yii::$app->formatter->asDecimal((float)$price['storePrice'][$type]['shipping']);?>
                                    </em>
                                    
                                    <?php 
                                    $taxClass = '';
                                    if($price['storePrice'][$type]['tax'] > 0.00){
                                        if($price['storePrice'][$type]['tax'] <= 50){
                                            $taxClass = 'del_price';
                                        }
                                    ?>
                                    行邮税：
                                    <em class="red1 <?=$taxClass?>" style="width:100px;">
                                        ￥<?=Yii::$app->formatter->asDecimal((float)$price['storePrice'][$type]['tax']);?>
                                    </em>
                                    <?php } ?>
                                    优惠金额：<em class="red1" style="width:100px;" id="discount_<?=$type?>">-￥<?=$price['storePrice'][$type]['promotion']?></em>
                                    本订单金额：<em class="font_16 red1" style="width:100px;" id="subtotal_slip_<?=$type?>">￥<?=Yii::$app->formatter->asDecimal((float)$price['storePrice'][$type]['final']);?></em>

                                </td>
                            </tr>
                        </tbody>
                    </table>
<?php } ?>
                </div>
                <!-- 购物车页面结构结束 -->
                <div class=" clearfix">

                    <div class="liststyle data price-list">
                        <div class="cart_under clearfix">
                            <div class="fl">
                                <div class="addinfo">
                                    <?php
                                    if(!empty($defaultAddress)){
                                        $address = $defaultAddress['cityName'].$defaultAddress['districtName'].$defaultAddress['address'];
                                    }else{
                                        $address = '';
                                    }
                                        ?>
                                    <p>收货信息：<span id="shipping_addrinfo_street"><?= $address?></span></p>
                                    <p>收货人：<span id="shipping_addrinfo_name"><?= isset($defaultAddress['receiverName']) ? $defaultAddress['receiverName'] : ''?></span></p>
                                </div>
                                <div class="tax">                                    
                                    <div class="tax-checkbox"><p>其他信息：<input type="checkbox" value="" id="is_need_invoice"> 发票</p><em class="question"></em></div>
                                    <div id="tax-content" style="display:none;">开票方式：纸质发票 发票抬头：<span id="invoice_name"></span></div>
                                    <div class="invoice" id="invoice_div" style="display: none; left: 492px;">
                                        <ul>
                                            <li>
                                                <h4 class="inline-block-item invoice-item-title">开票方式：</h4>
                                                <input id="J_invoice_paper" type="radio" value="paper" name="invoice_method" checked="checked">
                                                <label class="radio-text" for="J_invoice_paper">纸质发票</label>
                                            </li>
                                            <li>
                                                <h4 class="inline-block-item invoice-item-title">开票抬头：</h4>
                                                <input type="radio" value="person" name="invoice_type" checked="checked">
                                                <label class="radio-text" for="person">个人</label>
                                                <input type="radio" value="company" name="invoice_type">
                                                <label class="radio-text" for="company">公司</label>
                                                <input class="x-input inputstyle" name="invoice_company" id="invoice_company" type="text" placeholder="公司名称">
                                            </li>
                                            <li>
                                                <input type="button" id="save_invoice" value="保存发票信息" class="btn" style="box-sizing:content-box;">
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="fr" id="amountInfo">
                                <ul class="review-price-list">
                                    <li class="review-price-item J_sum_items">
                                        <h4 class="review-price-item-title">商品金额：</h4>
                                        <span class="m-price" id="totalPrice_final">
                                            ￥<?=Yii::$app->formatter->asDecimal((float)$price['totalPrice']['originalPrice'])?>
                                        </span>
                                    </li>
                                    <li class="review-price-item J_sum_items">
                                        <h4 class="review-price-item-title">运费：</h4>
                                        <span class="m-price" id="totalPrice_shipping">
                                            ￥<?=Yii::$app->formatter->asDecimal((float)$price['totalPrice']['shipping'])?>
                                        </span>
                                    </li>
                                    <?php 
                                    $taxClass = '';
                                    if($price['storePrice'][$type]['tax'] > 0.00){
                                        if($price['storePrice'][$type]['tax'] <= 50){
                                            $taxClass = 'del_price';
                                        }
                                    ?>
                                    <li class="review-price-item J_sum_items">
                                        <h4 class="review-price-item-title">税费：</h4>
                                        <span class="m-price <?=$taxClass?>">
                                            ￥<?=Yii::$app->formatter->asDecimal((float)$price['totalPrice']['tax'])?>
                                        </span>
                                    </li>
                                    <?php } ?>
                                    <li class="review-price-item J_sum_items">
                                        <h4 class="review-price-item-title">优惠金额：</h4>
                                        <span class="m-price" id="total_promotion">-￥<?= $price['totalPrice']['promotion'] ?></span>
                                    </li>
                                </ul>
                                <div class="review-total-price J_sum_items">
                                    <strong class="m-price">
                                        <span class="u-price J_pay_amount orange" id="paymentPrice">
                                            ￥<?=Yii::$app->formatter->asDecimal((float)$price['totalPrice']['final'])?>
                                        </span>
                                    </strong>
                                    <h4 class="review-total-price-title">待支付：</h4>
                                </div>
                                <button type="button" class="btn cart_settlement" id="orderSubmit" rel="_request"><span><span>提交订单</span></span></button><script>
                                    if ($('is_tax')) {
                                        $('is_tax').addEvent('click', function () {
                                            if ($('tax_company')) {
                                                $('tax_company').setStyle('display', this.checked ? '' : 'none');
                                            }
                                        }).fireEvent('click');
                                    }
                                </script>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="CartBtn clearfix">
                    <input type="hidden" name="fromCart" value="true">
                </div>
            
        </div>
        <script>
            function getInventory(country_code,state_code){
                var _itemPartNumber = '<?=$itemPartNumber?>';
                var itemPartNumbers = _itemPartNumber.split(',');
                var partNumbers = new Array();
                for(var ipn in itemPartNumbers){
                    partNumbers[ipn] = {
                        'itemPartNumber' : itemPartNumbers[ipn],
                        'itemOrg' : 'ftzmall',
                        'shop' : 'ftzmall',
                        'country' : country_code,
                        'stateCode' : state_code,
                    };
                }
                jQuery.ajax({
                    type: 'POST',
                    url: '<?=Url::to(['product/getinventory'])?>' ,
                    data: {
                        itemPartNumber: partNumbers,
                        _csrf : '<?=$_csrf?>',
                    },
                    success: function(data) {
                        for(var ipn in data){
                            var currentQuantity = jQuery("#"+ipn).attr("quantity");
                            if(data[ipn] <= 0){
                                jQuery("#"+ipn).html("无货");
                                jQuery("#"+ipn).addClass("orange");
                                jQuery("#submitState").val("1");
                            }else if(data[ipn] < currentQuantity){
                                jQuery("#"+ipn).html("库存不足");
                                jQuery("#"+ipn).addClass("orange");
                                jQuery("#submitState").val("1");
                            }else{
                                jQuery("#"+ipn).html(currentQuantity);
                                jQuery("#"+ipn).removeClass("orange");
                                jQuery("#submitState").val("0");
                            }
                        }
                    },
                    dataType: 'json',
                });
            }
            jQuery("#orderSubmit").click(function(){
                if(jQuery("#newAddr").css("display") == 'block'){
                    var confirmData = confirm("添加地址未保存，确定放弃添加？");
                    if(confirmData == false){
                        return false;
                    }
                }
                
                if(jQuery("#submitState").val() != 0){
                    Message.error("选择的商品无货，请返回购物车修改");
                    return false;
                }

                if(jQuery("#orderapi-shipaddressid").val() == "") {
                    Message.error("请先添加收货信息");
                    return false;
                }

                if(jQuery("#is_need_invoice").prop("checked")){
                    if(jQuery("#orderapi-invname").val() == "" || jQuery("#orderapi-invcategory").val() == "" || $('invoice_div').getStyle('display') == "block"){
                        Message.error("请保存发票信息");
                        return false;
                    }
                }
                jQuery("#w0").submit();
            });
            $$('input[name=receivedate]').addEvent('click', function () {
                var value = this.get('value');
                $$('input[id^=orderapi-shipinst]').each(function (input) {
                    input.set('value', value);
                });
            });

            $('is_need_invoice').addEvent('click', function () {
                var checked = this.get('checked');
                $('invoice_div').setStyle('display', checked ? '' : 'none');
                $('tax-content').setStyle('display', 'none');
                $$('input[id^=is_tax_]').each(function (input) {
                    input.set('checked', checked);
                });
            });
            $('save_invoice').addEvent('click', function () {
                var invoice_name = '';
                $$('input[name=invoice_type]').each(function (input) {
                    if (input.get('checked')) {
                        invoice_name = input.get('value') === 'person' ? '个人' : '公司';
                    }
                });
                if (invoice_name === '公司') {
                    invoice_name = $('invoice_company').get('value');
                    if(invoice_name == ""){
                        Message.error("请输入发票抬头");
                        return false;
                    }
                    if(invoice_name.length > 45){
                        Message.error("发票抬头最大长度为45个字符");
                        return false;
                    }
                    $$('input[id^=orderapi-invname]').each(function (input) {
                        input.set('value', invoice_name);
                    });
                    $$('input[id^=orderapi-invcategory]').each(function (input) {
                        input.set('value', '公司');
                    });
                }
                else {
                    $$('input[id^=orderapi-invname]').each(function (input) {
                        input.set('value', '个人');
                    });
                    $$('input[id^=orderapi-invcategory]').each(function (input) {
                        input.set('value', '个人');
                    });
                }
                $('tax-content').setStyle('display', '');
                $('invoice_div').setStyle('display', 'none');
                $('invoice_name').set('text', invoice_name);
                return false;
            });



            function changeimg(id) {
                $(id).set('src', '<?= Yii::$app->params['baseUrl'] ?>cart-gen_vcode.html#' + (+new Date()));
            }
            /*下单*/

            (function () {
                

                button_valiate = {
                    is_validate: function (e) {
                        // el element id.
                        var section = e.getParent('div').getPrevious('.hid_item') || e.getParent('div.hid_item');
                        var _validate_return = true;

                        return section.getElements('[vtype]').every(function (el) {
                            return validate(el);
                        });
                    },
                    fold: function (e, act) {
                        var section = e.getParent('.section');
                        if (!section.getElement('.cart-confirm-btn'))
                            return this;
                        section.getElement('.cart-confirm-btn')[act == 'fold' ? 'removeClass' : 'addClass']('unfold');
                        return this;
                    },
                    removeCaution: function (e) {
                        var section = e.getParent('.section');
                        if (!section.getElement('.cart-confirm-btn'))
                            return this;
                        var _caution = section.getElement('.cart-confirm-btn').getNext('.caution');
                        if (_caution && _caution.hasClass('error'))
                            _caution.destroy();
                    },
                    init: function () {
                        validatorMap['need_confirmed'] = ['配送方式没有确认！', function (element, v) {
                                if ($(element).hasClass('unfold')) {
                                    new Fx.Scroll(window).toElement($(element.getParent('.section')));
                                    return false;
                                }
                                else
                                    return true;
                            }];

                        validatorMap['mobile_or_phone'] = ['手机或电话必填其一！', function (element, v) {
                                var _mobile = $(element).getParent('tr').getPrevious('tr').getElement('input');
                                var _phone = $(element).getPrevious('input');

                                return (_mobile.value != '') || (_phone.value != '');
                            }];
                    }
                }
                button_valiate.init();

                Order = {
                    init: function () {
                        var _this = this;

                        $ES('.storeShipping').each(function (item) {
                            item.addEvent('change', function (e) {
                                var target = $(e.target || e);

                                switch (target.get('type')) {
                                    case 'radio'://配送方式
                                        target.checked = true;
                                        target.disabled = true;
                                        _this.shippingChange(target);
                                        break;
                                    case 'checkbox':
                                        var shipping = target.getParent('tr').getElement('input[type=radio]');
                                        var id = target.id;
                                        shipping_id = id.substring(12);
                                        var store_id = target.getParent('td').id.substring(9);
                                        _this.shippingMerge(store_id, shipping_id);
                                        break;
                                    case 'select-one':
                                        var id = item.id;
                                        var store_id = id.substring(9);
                                        var shipping = item.getChildren('select');
                                        shipping = shipping[0];
                                        var shipping_id = shipping.options[shipping.options.selectedIndex].value;
                                        _this.updateStore(store_id, shipping_id);
                                        _this.updateTotal();
                                        _this.resetChecked(store_id, shipping_id);
                                        //target.disabled = true;
                                        //_this.shippingChange(target);
                                        break;
                                    default :
                                        break;
                                }
                            });
                        });


                        //				$('payment').addEvent('click', function (e) {
                        //					if ($(e.target).hasClass('x-payMethod')) {
                        //						$(e.target).disabled = true;
                        //						_this.updateTotal();
                        //						/** 暂时保存支付方式 **/
                        //						_this.save_payment(e.target);
                        //					}
                        //				});

                        $$('.link_update a').addEvent('click', function (e) {
                            var el = e.target || e;
                            _this.isEdit($(el));
                        });

                        // if (!$('payment-cur'))return;

                        // $('payment-cur').addEvent('change',function(){
                        //     //   _this.setCurrency().updateTotal();
                        // });

                        // if (!!(document.getElement('input[name^=purchase[member_id]').get('value')))
                        //     $('payment-cur').fireEvent('change'); //会员还是需要调用

                        /**
                         * 添加全局变量，判断地址是否需要加入容错的“.”
                         */
                        // $('receiver').store('b2c-cart-checkout-ship-addr', 'true');
                    },
                    resetChecked: function (store_id, shipping) {
                        $$('.chk_protect_' + store_id).each(function (item) {
                            item.checked = false;
                            item.getParent('div').setStyle('display', 'none');
                        });
                        var is_protect_checkbox = $('use_protect_' + shipping);
                        if (is_protect_checkbox) {
                            is_protect_checkbox.getParent('div').setStyle('display', '');
                        }
                    },
                    updateStore: function (store_id, shipping_id) {
                        var fastbuy = "";
                        var url = "<?= Yii::$app->params['baseUrl'] ?>cart-updateStoreTotal.html";
                        if (fastbuy) {
                            url = "/fastbuy-updateStoreTotal.html";
                        }
                        var updateStoreTotalUrl = "";
                        if (updateStoreTotalUrl != '') {
                            url = updateStoreTotalUrl;
                        }
                        var is_protect_checkbox = $('use_protect_' + shipping_id);
                        var is_protect;
                        if (is_protect_checkbox) {
                            is_protect = $('use_protect_' + shipping_id).checked;
                        } else {
                            is_protect = false;
                        }
                        var area_id = $('area_id').value;
                        new Request.HTML({
                            url: url,
                            update: $('store_' + store_id),
                            async: false,
                            method: 'post',
                            data: {
                                'store_id': store_id,
                                'shipping_id': shipping_id,
                                'is_protect': is_protect,
                                'area_id': area_id
                            }
                        }).send();
                    },
                    updateAllStore: function () {
                        $$('.storeShipping').each(function (item) {
                            var id = item.id;
                            var store_id = id.substring(9);
                            var shipping = item.getChildren('select');
                            shipping = shipping[0];
                            var shipping_id;
                            if (shipping) {
                                shipping_id = shipping.options[shipping.options.selectedIndex].value;
                            }
                            Order.updateStore(store_id, shipping_id);
                        });
                    },
                    isEdit: function (el) {
                        el = el.getParent('a') || el;
                        var section = el.getParent('.section'), item = section.getElements('.hid_item'), el_id = el.id;

                        item.hide();
                        $$('#order-create .' + el_id).show();

                        // add or remove unfold class
                        if (el.get('class').indexOf('cancel_') > -1) {
                            button_valiate.fold(el, 'unfold');
                        }

                        if (el_id.indexOf('cancel_') > -1) {
                            // 还原收货地址。
                            deliverying.generateShippings(document.getElement('.receiver_radio_addr_id[checked]'), -1);
                            button_valiate.fold(el, 'fold');
                            button_valiate.removeCaution(el);
                        }
                    },
                    //更新收货地址后的操作。
                    setShippingFromArea: function () {
                        var _country_code = $('country_code').value;
                        var _district_code = $('district_code').value;
                        var _postcode = $('postcode').value;
                        var _city_code = $('city_code').value;
                        var _state_code = $('state_code').value;
                        var _cartlineIds = $('cartlineIds').value;
                        var _address = {
                            'country_code': _country_code,
                            'district_code': _district_code,
                            'postcode': _postcode,
                            'city_code': _city_code,
                            'state_code': _state_code,
                          };
                        
                        var url;
                        url = '<?= Url::to(['cart/price']) ?>';

                        new Request.HTML({
                            url: url,
                            update: 'goodsbody',
                            method: 'post',
                            data: {
                                cartlineIds: _cartlineIds,
                                address: _address,
                                couponIds: null,
                                price: true,
                                promotion: true,
                                shipping: true,
                                tax: true,
                                _csrf : '<?=$_csrf?>',
                            },
                            onRequest: function () {
                                //$('goodsbody').set('html', '<div class="font-green">loading...</div>');
                                //$('amountInfo').set('html', '<div class="font-green">loading...</div>');
                            },
                            onComplete: function (res) {
                                var obj = eval(res);
                                alert(obj);
                            }
                        }).send();
                    },
                    setCurrency: function () {
                        var _this = this;
                        new Request.HTML({
                            url: Shop.url.payment,
                            update: $('payment'),
                            method: 'post',
                            data: {
                                'cur': 'CNY',
                                'payment': $('payment').getElement('th input:checked') ? $('payment').getElement('th input:checked').value : null,
                                // 'd_pay':$('shipping').getElement('th input:checked')?$('shipping').getElement('th input:checked').get('has_cod'):null,
                                'def_payment': document.getElement('input[name^=purchase[pay_app_id]]') ? document.getElement('input[name^=purchase[pay_app_id]]').value : null,
                                'extends_args': $('order-create').getElement('input[name^=extends_args]') ? $('order-create').getElement('input[name^=extends_args]').value : null
                            },
                            onComplete: function () {
                                _this.updatePayment.call(_this);
                            }
                        }).send();
                        return this;
                    },
                    updatePayment: function () {
                        var _this = this;
                        if (!this.synTotalHash)
                            return;

                        if (this.synTotalHash.d_pay && this.synTotalHash.d_pay == 'true') {
                            if ($('_normal_payment'))
                                $('_normal_payment').hide();

                            if ($('_pay_cod'))
                                $('_pay_cod').show().getElement('input[type=radio]').checked = true;
                        } else {
                            if ($('_normal_payment'))
                                $('_normal_payment').show();

                            if ($('_pay_cod'))
                                $('_pay_cod').hide().getElement('input[type=radio]').checked = false;

                            if (!document.getElement('.x-payMethod:checked]') && $('_normal_payment')) {
                                $('_normal_payment').getElement('input[type=radio]').checked = true;
                            }
                        }
                    },
                    save_payment: function (target) {
                        new Request({
                            url: Shop.url.purchase_payment,
                            method: 'post',
                            data: {
                                'pay_app_id': $(target).get('value'),
                                'extends_args': $('order-create').getElement('input[name^=extends_args]') ? $('order-create').getElement('input[name^=extends_args]').value : null
                            },
                            onComplete: function (res) {
                            }
                        }).send();
                    },
                    shippingChange: function (target) {
                        this.clearProtect(target);
                        this.updateTotal();
                        this.save_shipping(target);
                    },
                    shippingChangeSplit: function (target, store_id, slip_id) {
                        $('orderSubmit').disabled = true;
                        $$('.J_project_' + store_id + '_' + slip_id).each(function (el) {
                            el.getElement('input').checked = false;
                            el.getElement('em').setStyle('color', '#717070');
                            el.setStyle('display', 'none');
                        });
                        var shipping = [];
                        var _is_protect = [];
                        $$('.shippingSel').each(function (el) {
                            if (el.get('store_id') == store_id) {
                                shipping.push(el.value);
                                if ($('use_protect_' + el.value)) {
                                    if ($('use_protect_' + el.value).checked == true) {
                                        _is_protect.push(el.value);
                                    }
                                }
                            }
                        });

                        var _area = document.getElement('input[name^=delivery[ship_area]') ? document.getElement('input[name^=delivery[ship_area]').get('value') : null;

                        var _shipping_id = $(target).value;
                        var lastSel = document.getElement('input[name^=purchase[def_area]]');
                        var _split_order = $('order-create').getElement('input[name^=split_order]') ? $('order-create').getElement('input[name^=split_order]').value : null;
                        var fastbuy = "";
                        var url;
                        if (fastbuy) {
                            url = '/fastbuy-shippingChangeSplit.html';
                        } else {
                            url = '<?= Yii::$app->params['baseUrl'] ?>cart-shippingChangeSplit.html';
                        }
                        new Request({
                            url: url,
                            method: 'post',
                            data: {
                                area: _area,
                                is_protect: _is_protect,
                                store_shipping: shipping,
                                shipping_id: _shipping_id,
                                store_id: store_id,
                                slip_id: slip_id,
                                split_order: _split_order
                            },
                            onRequest: function () {

                            },
                            onComplete: function (res) {
                                if (res == '') {
                                    Message.error('购物车商品发生变化，重新结算。');
                                    window.location.href = '<?= Yii::$app->params['baseUrl'] ?>cart.html';
                                    return;
                                }
                                var aDel = JSON.decode(res);
                                $('subtotal_slip_' + store_id).set('html', aDel.store_subtotal);
                                $('discount_' + store_id).set('html', aDel.discount);
                                var is_protect = aDel.shipping.slips[slip_id][_shipping_id].project;
                                var shipping_money = aDel.shipping.slips[slip_id][_shipping_id].money;
                                $('shipping_money_' + slip_id + '_' + store_id).set('html', shipping_money);

                                if (is_protect == 'true') {
                                    if ($('protect_' + _shipping_id)) {
                                        $('protect_' + _shipping_id).setStyle('display', '');
                                    }
                                }
                                Order.updateSplitTotal();
                            }
                        }).send();
                    },
                    couponChange: function (target, store_id) {
                        var shipping = [];
                        var _is_protect = [];
                        $$('.shippingSel').each(function (el) {
                            if (el.get('store_id') == store_id) {
                                shipping.push(el.value);
                                if ($('use_protect_' + el.value)) {
                                    if ($('use_protect_' + el.value).checked == true) {
                                        _is_protect.push(el.value);
                                    }
                                }
                            }
                        });
                        var _area = document.getElement('input[name^=delivery[ship_area]') ? document.getElement('input[name^=delivery[ship_area]').get('value') : null;

                        var _split_order = $('order-create').getElement('input[name^=split_order]') ? $('order-create').getElement('input[name^=split_order]').value : null;
                        var fastbuy = "";
                        var url;
                        if (fastbuy) {
                            url = '/fastbuy-shippingChangeSplit.html';
                        } else {
                            url = '<?= Yii::$app->params['baseUrl'] ?>cart-shippingChangeSplit.html';
                        }
                        new Request({
                            url: url,
                            method: 'post',
                            data: {
                                area: _area,
                                is_protect: _is_protect,
                                store_shipping: shipping,
                                store_id: store_id,
                                split_order: _split_order
                            },
                            onRequest: function () {

                            },
                            onComplete: function (res) {
                                if (res == '') {
                                    Message.error('购物车商品发生变化，重新结算。');
                                    window.location.href = '<?= Yii::$app->params['baseUrl'] ?>cart.html';
                                    return;
                                }
                                var aDel = JSON.decode(res);

                                $('subtotal_slip_' + store_id).set('html', aDel.store_subtotal);
                                $('discount_' + store_id).set('html', aDel.discount);
                                Order.updateSplitTotal();
                                $('orderSubmit').disabled = false;
                            }
                        }).send();
                    },
                    protectChange: function (target, store_id, slip_id, dt_id) {
                        var shipping = [];
                        var _is_protect = [];
                        $$('.shippingSel').each(function (el) {
                            if (el.get('store_id') == store_id) {
                                shipping.push(el.value);
                                if ($('use_protect_' + el.value)) {
                                    if ($('use_protect_' + el.value).checked == true) {
                                        _is_protect.push(el.value);
                                    }
                                }
                            }
                        });

                        var _shipping_id = dt_id;
                        var _area = document.getElement('input[name^=delivery[ship_area]') ? document.getElement('input[name^=delivery[ship_area]').get('value') : null;

                        var _split_order = $('order-create').getElement('input[name^=split_order]') ? $('order-create').getElement('input[name^=split_order]').value : null;
                        var fastbuy = "";
                        var url;
                        if (fastbuy) {
                            url = '/fastbuy-shippingChangeSplit.html';
                        } else {
                            url = '<?= Yii::$app->params['baseUrl'] ?>cart-shippingChangeSplit.html';
                        }
                        new Request({
                            url: url,
                            method: 'post',
                            data: {
                                area: _area,
                                is_protect: _is_protect,
                                store_shipping: shipping,
                                shipping_id: _shipping_id,
                                store_id: store_id,
                                slip_id: slip_id,
                                split_order: _split_order
                            },
                            onRequest: function () {

                            },
                            onComplete: function (res) {
                                if (res == '') {
                                    Message.error('购物车商品发生变化，重新结算。');
                                    window.location.href = '<?= Yii::$app->params['baseUrl'] ?>cart.html';
                                    return;
                                }
                                if ($('use_protect_' + dt_id) && $('protect_money_' + dt_id)) {
                                    if ($('use_protect_' + dt_id).checked == true) {
                                        $('protect_money_' + dt_id).setStyle('color', '#E40303');
                                    } else {
                                        $('protect_money_' + dt_id).setStyle('color', '#717070');
                                    }
                                }
                                var aDel = JSON.decode(res);

                                $('subtotal_slip_' + store_id).set('html', aDel.store_subtotal);
                                $('discount_' + store_id).set('html', aDel.discount);
                                Order.updateSplitTotal();
                                $('orderSubmit').disabled = false;
                            }
                        }).send();
                    },
                    TaxChange: function (target, store_id, slip_id, dt_id) {

                        var shipping = [];
                        var _is_protect = [];
                        $$('.shippingSel').each(function (el) {
                            if (el.get('store_id') == store_id) {
                                shipping.push(el.value);
                                if ($('use_protect_' + el.value)) {
                                    if ($('use_protect_' + el.value).checked == true) {
                                        _is_protect.push(el.value);
                                    }
                                }
                            }
                        });

                        var _shipping_id = dt_id;
                        var _is_tax = $('is_tax_' + store_id + '_' + slip_id).value;

                        var _tax_type = target.value;
                        var _object = [];
                        var new_store_id = [];

                        _object[0] = _is_tax;
                        _object[1] = _tax_type;
                        _object[3] = store_id;


                        var _new_tax_List = document.getElements('tr #tax_List');
                        _new_tax_List.each(function (el) {
                            var check_new = el.getElement('input[type="checkbox"]').value;
                            var radio_new = el.getElement('input[type="radio"]:checked');

                            if (check_new == 'true') {
                                var new_array = [];
                                if (radio_new) {
                                    new_array.push(radio_new.value);
                                }
                                new_array.push(el.get('store_id'));
                                new_store_id.push(new_array);

                            }
                        });

                        _object[4] = new_store_id;

                        var _area = document.getElement('input[name^=delivery[ship_area]') ? document.getElement('input[name^=delivery[ship_area]').get('value') : null;

                        var _split_order = $('order-create').getElement('input[name^=split_order]') ? $('order-create').getElement('input[name^=split_order]').value : null;

                        var fastbuy = "";
                        var url;
                        if (fastbuy) {
                            url = '/fastbuy-TaxChangeSplit.html';
                        } else {
                            url = '<?= Yii::$app->params['baseUrl'] ?>cart-TaxChangeSplit.html';
                        }
                        new Request({
                            url: url,
                            method: 'post',
                            data: {
                                area: _area,
                                is_protect: _is_protect,
                                store_shipping: shipping,
                                shipping_id: _shipping_id,
                                is_tax: _is_tax,
                                tax_type: _tax_type,
                                store_id: store_id,
                                slip_id: slip_id,
                                split_order: _split_order
                            },
                            onRequest: function () {

                            },
                            onComplete: function (res) {
                                if (res == '') {
                                    Message.error('购物车商品发生变化，重新结算。');
                                    window.location.href = '<?= Yii::$app->params['baseUrl'] ?>cart.html';
                                    return;
                                }

                                var aDel = JSON.decode(res);

                                $('subtotal_slip_' + store_id).set('html', aDel.store_subtotal);
                                $('text_' + store_id + '_' + slip_id).set('html', aDel.tax_personal);
                                Order.updateSplitTotal(_object);
                                $('orderSubmit').disabled = false;
                            }
                        }).send();
                    },
                    clearProtect: function (target) {
                        if (tmpEl = $('shipping').retrieve('tmp_protect')) {
                            if (tmpEl != target) {
                                tmpEl.removeProperty('protect');
                                tmpEl.getParent('tr').getElement('input[name^=delivery[is_protect]').checked = false;
                            }
                        }
                        if (tmpEl != target && target.get('protect')) {
                            $('shipping').store('tmp_protect', target);
                        }
                    },
                    save_shipping: function (target) {
                        /** 暂时记住保存配送方式 **/
                        var _chk_protect = $(target).getParent('td').getElement('input[type=checkbox]:checked');
                        new Request({
                            url: Shop.url.purchase_shipping,
                            method: 'post',
                            data: {
                                'shipping_id': $(target).get('value'),
                                'is_protect': _chk_protect ? 'true' : 'false',
                                'extends_args': $('order-create').getElement('input[name^=extends_args]') ? $('order-create').getElement('input[name^=extends_args]').value : null
                            },
                            onComplete: function (rs) {
                                // if(rs) {
                                //     var s = $('shipping_change').getElement('input[name="delivery[shipping_id]"]:checked').getParent('td');
                                //     var name = s.getElement('label').get('text').trim();
                                //     s = name + s.getElement('.shipping-information').get('html');
                                //     $('shipping_list').set('html','<tr><td>' + s + '</td></tr>');
                                //     $('cancel_shipping_info').fireEvent('click',$('cancel_shipping_info'));
                                // }
                            }
                        }).send();
                    },
                    shippingMerge: function (store_id, shipping_id) {
                        this.updateTotal();
                        this.updateStore(store_id, shipping_id);
                    },
                    updateSplitTotal: function (options) {

                        options = options || {};
                        this.synTotalHash = (this.synTotalHash || {});

                        var _shipping = $$('.shippingSel'),
                                _coin = $('payment-cur'),
                                _tax = options[0] ? options[0] : '',
                                _tax_company = options[1] ? options[1] : '',
                                _store_id = options[3] ? options[3] : '',
                                _store_id_LIST = options[4] ? options[4] : '',
                                _dis_point = document.getElement('input[name^=payment[dis_point]');
                        var _shipping_id = new Array();
                        var _is_protect = new Array();
                        _shipping.each(function (item) {
                            _shipping_id.push(item.value);
                            if ($('use_protect_' + item.value)) {
                                if ($('use_protect_' + item.value).checked == true) {
                                    _is_protect.push(item.value);
                                }
                            }
                        });

                        //分单信息。
                        var _split_order = $('order-create').getElement('input[name^=split_order]') ? $('order-create').getElement('input[name^=split_order]').value : null;
                        Object.append(this.synTotalHash, {
                            split_order: _split_order
                        });
                        //				var _payment = $('payment').getElement('tr input[type=radio]:checked');
                        //				if (_payment) {
                        //				var _payment =	Object.append(this.synTotalHash, {
                        //						payment: _payment.value
                        //					});
                        //				}

                        if ($('order-create').getElement('input[name=isfastbuy]')) {
                            Object.append(this.synTotalHash, {isfastbuy: 1});
                        }
                        // if(_coin == null){
                        //      _coin='CNY';
                        // }
                        Object.append(this.synTotalHash, {
                            cur: 'CNY',
                            shipping_id: _shipping_id,
                            is_protect: _is_protect,
                            is_tax: _tax,
                            store_id: _store_id,
                            store_id_list: _store_id_LIST,
                            area: document.getElement('input[name^=delivery[ship_area]') ? document.getElement('input[name^=delivery[ship_area]').get('value') : null,
                            tax_company: _tax_company,
                            extends_args: $('order-create').getElement('input[name^=extends_args]') ? $('order-create').getElement('input[name^=extends_args]').value : null
                        });
                        var cart_coupon_list_modal;
                        var fastbuy = "";
                        var url;
                        if (fastbuy) {
                            url = '/fastbuy-split_total.html';
                        } else {
                            url = '<?= Yii::$app->params['baseUrl'] ?>cart-split_total.html';
                        }

                        new Request.HTML(Object.append({
                            url: url,
                            update: $('amountInfo'),
                            onRequest: function () {
                                $$('#cart-coupon-list .delItem').setStyle('visibility', 'hidden');
                            },
                            onSuccess: function () {
                                $$('#cart-coupon-list .delItem').fade(1);
                                $$('#payment .x-payMethod').set('disabled', false);
                                $$('#shipping .shipping_radio_shipping_id').set('disabled', false);
                                $$('#shipping input[name^=delivery[is_protect]]').set('disabled', false);
                            }
                        }, options)).post(this.synTotalHash);

                    },
                    updateTotal: function (options) {
                        this.updateSplitTotal(options);
                    }
                };
                Order.init();
            })();


            /*购物车小图mouseenter效果*/
            function thumb_pic() {
                if (!$('goodsbody'))
                    return;
                var cart_product_img_viewer = new Element('div', {
                    styles: {
                        'position': 'absolute',
                        'zIndex': 500,
                        'opacity': 0,
                        'border': '1px #666 solid'
                    }
                }).inject(document.body);
                var cpiv_show = function (img, event) {

                    if (!img)
                        return;
                    cart_product_img_viewer.empty().adopt($(img).clone().removeProperties('width', 'height').setStyle('border', '1px #fff solid')).fade(1);

                    var size = window.getSize(), scroll = window.getScroll();
                    var tip = {x: cart_product_img_viewer.offsetWidth, y: cart_product_img_viewer.offsetHeight};
                    var props = {x: 'left', y: 'top'};
                    for (var z in props) {
                        var pos = event.page[z] + 10;
                        if ((pos + tip[z] - scroll[z]) > size[z])
                            pos = event.page[z] - 10 - tip[z];
                        cart_product_img_viewer.setStyle(props[z], pos);
                    }

                };

                $$('.cart-product-img').each(function (i) {
                    new Asset.image(i.get('isrc'), {
                        onload: function (img) {
                            if (!img)
                                return;
                            var _img = img.zoomImg(50, 50);
                            if (!_img)
                                return;
                            _img.setStyle('cursor', 'pointer').addEvents({
                                'mouseenter': function (e) {
                                    cpiv_show(_img, e);
                                },
                                'mouseleave': function (e) {
                                    cart_product_img_viewer.fade(0);
                                }
                            });
                            i.empty().adopt(new Element('a', {
                                href: i.get('ghref'),
                                target: '_blank',
                                styles: {border: 0}
                            }).adopt(_img));
                        }, onerror: function () {
                            i.empty();
                        }
                    });
                });

            }
            ;

            window.addEvent('domready', function () {
                thumb_pic();
            });
            /*
             * 使用优惠券
             */
            function userCoupons(obj, store_id) {
                var fastbuy = "";
                var coupon_value = obj.options[obj.options.selectedIndex].value;
                var url = '<?= Yii::$app->params['baseUrl'] ?>cart-add-coupon.html';
                if (fastbuy) {
                    url = '/fastbuy-add-coupon.html';
                    if (coupon_value == 'no') {
                        url = '/fastbuy-remove_store_coupon-coupon.html';
                    }
                } else {
                    if (coupon_value == 'no') {
                        url = '<?= Yii::$app->params['baseUrl'] ?>cart-remove_store_coupon-coupon.html';
                    }
                }
                var shipping = [];
                var _is_protect = [];
                $$('.shippingSel').each(function (el) {
                    if (el.get('store_id') == store_id) {
                        shipping.push(el.value);
                        if ($('use_protect_' + el.value)) {
                            if ($('use_protect_' + el.value).checked == true) {
                                _is_protect.push(el.value);
                            }
                        }
                    }
                });
                var _split_order = $('order-create').getElement('input[name^=split_order]') ? $('order-create').getElement('input[name^=split_order]').value : null;
                $rdata = {
                    shipping: shipping,
                    is_protect: _is_protect,
                    split_order: _split_order,
                    coupon: coupon_value,
                    response_type: 'true',
                    store_id: store_id
                };
                new Request({
                    url: url,
                    method: 'post',
                    data: $rdata, //'coupon='+coupon_value+"&response_type=true&store_id="+store_id,
                    onSuccess: function (res) {
                        var re = JSON.decode(res);
                        if (!re) {
                            Message.error('优惠券删除成功');
                        } else {
                            if (!re.success) {
                                Message.error('' + re.msg + '');
                            } else {
                                var con = re.data;
                                if (con[0].used == true) {
                                } else {
                                    Message.error('优惠券不适用');
                                }
                            }
                        }
                        Order.couponChange(obj, store_id);
                    }
                }).send();
            }
        </script>
    </div>
</div>
<!--<div id="realname" class="popup-container" data-single="false" style="display: block; position: absolute; left: 651px; top: 1190px; opacity: 1; visibility: visible;">
    <div class="popup-body" style="width: 600px;">
        <div class="popup-header clearfix">
            <h2>请确认</h2>
            <span><button type="button" title="关闭" class="popup-btn-close" hidefocus="" style="display: none;">x</button></span>
        </div>
        <div class="popup-content clearfix">
            <div class="recordinfo">
                <div class="tt_1">
                    <h1 class="red1">温馨提示</h1>
                </div>
                <div class="tt_2">
                    <h3>您购买的商品为跨境保税商品，根据中国海关规定，为防止变相走私，证明包裹内物品确实为个人自用，个人包裹办理海关入境清关手续需要提交收件人身份证明。谢谢您的支持！</h3>
                </div>
                <div class="control-group3">
                    <button type="button" class="btn red" onclick="javascript:window.location.href='http://www.ftzmall.com.cn/member-recordinfo.html?is_kjt=1&amp;is_zy=&amp;callback=http%3A%2F%2Fwww.ftzmall.com.cn%2Fmember-all_orderPayments---MjAxNTA5MDUyMjU1MzYyNnwyMDE1MDkwNTIyMDgzMjcwfDIwMTUwOTA1MjI4Mzc4NTc%3D.html'">立即提交</button>
                </div>
                <h3 class="p_red">
                    --根据中国海关规定，为防止变相走私，证明包裹内物品确实为个人自用，个人包裹办理海关入境清关手续需要提交收件人身份证明。<br>
                    海关相关规定请参考《中华人民共和国海关对进出境快件监管办法》第二十二条，或致电海关咨询：12360
                </h3>
            </div>
        </div>
    </div>
</div>-->
<!-- <div class="sidebar-right">
    <a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
    <a href="javascript:void(0)" class="sidebar-backtop"></a>
    <a href="javascript:void(0)" class="sidebar-close"></a>
</div> -->
<script>
    (function () {
        $$('.sidebar-backtop').addEvent('click', function () {
            $(window).scrollTo(0, 0)
        });
        $$('.sidebar-close').addEvent('click', function () {
            $$('.sidebar-right').setStyle('display', 'none')
        })
    })();
</script>

