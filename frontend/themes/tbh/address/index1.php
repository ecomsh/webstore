<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;

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


<style>
    .address-label{width:240px;display:block;text-align:right;float:left;}
    .form-group{margin-bottom:5px}
    .submit-btn{background: #b30013;}
</style>    


<!-- right-->
<div class="member-main">
    <div>

        <div class="title title2" style="height:30px"><span style="float:left">收货地址<span class="disc">|</span> 
                <span id='add' class="disc add-icon" >
                    <?php
                    if ($model->isNewRecord)
                    {
                        ?>
                        <a href="#" id="add-address"><i id="add-address-addnew">添加新的</i><i id="add-address-giveup" style="display:none">放弃添加</i>收货地址</a>
                        <scirpt></scirpt>
                        <?php
                    } else
                    {
                        ?>
                        <?= Html::a('添加新的收货地址', ['address/index', 'action' => 'create']) //尽量用yii的url，后续可以用上路由规则   ?>
                    <?php } ?>
                </span>
            </span>
            <span style="float:right">最多可保存10个地址，已保存<?= count($data) ?>个</span>
            <input id="address-count" type="hidden" value="<?= count($data) ?>"/>
        </div>
        <?php
        echo Alert::widget(['alertTypes' => [
                'address_success' => 'alert-success',
                'address_error' => 'alert-danger',
                'danger' => 'alert-danger',
                'info' => 'alert-info',
                'warning' => 'alert-warning']]);
        $s = '';
        if ($model->isNewRecord)
        {
            $s = 'display:none';
        }
        if ($action == 'create')
        {
            $s = '';
        }
        if (empty($data))
        {
            $s = 'display:none';
        }
        ?>
        <script>
            jQuery(function () {
                jQuery('#add-address').click(function () {
                    var c = jQuery("#address-count").val();
                    if (c >= 10) {
                      alert('最多只能保存10条收货地址！');
                    }else{
                            jQuery('#addr-div').toggle();
                    jQuery('#addr-div-none').toggle();
                    jQuery('#add-address-addnew').toggle();
                    jQuery('#add-address-giveup').toggle();
                    }
                })
                jQuery("#w0-address_success-0").slideUp("slow");

            });

        </script>
        <?php if (empty($data))
        { ?>
            <div id="addr-div-none">暂无收货地址信息</div>
            <?php } ?>
        <div id='addr-div' style="<?= $s ?>">
            <?php
            $options = [];
            if ($id)
                $options['options'] = ['id' => $id];

            $options['enableClientValidation'] = true;
            $options['fieldConfig'] = ['labelOptions' => ['class' => 'address-label'], 'errorOptions' => ['style' => 'margin:0px;padding-left:240px;']];
            $form = ActiveForm::begin($options
//        'id' => 'Member_addr',  
                            //  'options' => ['class' => 'form-horizontal'],  
//        'fieldConfig' => [  
//            'template'=>"<tr><th>{label}：</th><td>{input}{error}</td></tr>"
//          //  'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",  
//           // 'labelOptions' => ['class' => 'col-lg-1 control-label'],  
//        ],  
            );

            if ($model->isDefault)
            {
                $model->isDefault = 'true';
            }
            ?> 
            <?= $form->field($model, 'isDefault')->checkbox(['label' => '设为默认地址', 'uncheck' => 'false', 'value' => 'true']) ?>    
            <?= $form->field($model, 'receiverName')->textInput([ 'class' => 'x-input inputstyle', 'size' => 30]) ?>
            <?= $form->field($model, 'stateCode')->dropDownList(['' => '请输入省份'], [ 'class' => 'inputstyle', 'data-level-index' => 0]) ?>
            <?= $form->field($model, 'cityCode')->dropDownList(['' => '请输入城市'], ['class' => 'inputstyle', 'data-level-index' => 0]) ?>
            <?= $form->field($model, 'districtCode')->dropDownList(['' => '请输入区县'], [ 'class' => 'inputstyle', 'data-level-index' => 0]) ?>
            <?= $form->field($model, 'stateName', ['labelOptions' => ['style' => 'display:none'], 'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'provice1']) //id指定后将不能自动描红?>
<?= $form->field($model, 'cityName', ['labelOptions' => ['style' => 'display:none'], 'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'city1']) ?>
<?= $form->field($model, 'districtName', ['labelOptions' => ['style' => 'display:none'], 'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'district1']) ?>
            <script>
                jQuery(function () {
                    preSelect("<?= $model->stateCode ?>", "<?= $model->cityCode; ?>", "<?= $model->districtCode; ?>",
                            '#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');//preselect("四川省","成都市","金牛区");//设置默认选项
                    initCountry('#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');
                    jQuery("#address_submit").click(function () {
                        jQuery(this).removeClass("disabled");
                    });
                });
                //Message.error("加入购物车失败.<br /><ul><li>可能库存不足.</li><li>或提交信息不完整.</li></ul>");
            </script>
            <?= $form->field($model, 'address')->textarea([ 'class' => 'inputstyle', 'rows' => 2, 'cols' => 30, 'style' => 'max-width:690px;max-height:340px']) ?>
            <?= $form->field($model, 'postcode')->textInput(['class' => 'x-input inputstyle', 'size' => 15]) ?>
<?= $form->field($model, 'receiverMobile')->textInput(['class' => 'x-input inputstyle', 'size' => 15]) ?>
                    <?= $form->field($model, 'receiverPhone')->textInput(['class' => 'x-input inputstyle', 'size' => 15]) ?>

            <div style="padding-left:235px;height:40px;padding-top:10px;"><span class="float-span" >
<?= Html::submitButton($model->isNewRecord ? '添加' : '更新', [ 'class' => $model->isNewRecord ? 'btn submit-btn' : 'btn btn-primary']) ?>
                    <script>

                    </script>
                    <!--                        <button class="btn btn submit-btn" type="submit" rel="_request"><span><span>保存</span></span></button>-->
                </span>
                <span class="float-span" style="float:left; margin-left:8px">
<?php echo $model->isNewRecord ? Html::resetButton('重置', [ 'class' => 'btn submit-btn']) : '' ?>
<!--                    <button id="unset" type="button" class="btn"><span><span>取消添加</span></span></button></span>-->
            </div>
            <!--  xxxxx -->
        <?php ActiveForm::end(); ?>
            <!--  ddddd -->
        </div>
        <?php
        if ($data)
        {
            ?>
            <table class="gridlist gridlist_member border-all mt10" width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
                <tr>
                    <th class="first" style="word-break: break-all; word-wrap:break-word;" width="40%">地址</th>
                    <th style="word-wrap:break-word;" width="15%">收货人</th>
                    <th>联系电话</th>
                    <th>默认</th>
                    <th>操作</th>
                </tr>

                <tbody>

                    <?php
                    if ($data & is_array($data))
                    {

                        foreach ($data as $k => $v):
                            ?>
                            <tr>
                                <td class="textwrap textleft" style="word-break: break-all; word-wrap:break-word;">
            <?= Html::encode($v['address']) ?>
                                </td>
                                <td class="textcenter" style="word-break: break-all; word-wrap:break-word;"><span class="font-blue"><?= Html::encode($v['receiverName']) ?></span></td>
                                <td class="textcenter"><?= Html::encode($v['receiverMobile']) ?></td>
                                <td class="textcenter">
            <?= $v['isDefault'] ? '默认地址' : Html::a('<span class="tacitly-add">设为默认</span>', ['address/default', 'id' => isset($v['addressId']) ? $v['addressId'] : 0]) ?>

                                </td>
                                <td align="center">
            <?= Html::a('<span>修改</span>', ['address/index', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['class' => 'btn-bj-hover operate-btn']) ?>
            <?= Html::a('<span>删除</span>', ['address/delete', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['data' => ['confirm' => '确定删除地址?'], 'class' => 'btn-bj-hover operate-btn']) ?>

                                </td>
                            </tr>

                            <?php
                        endforeach;
                    }
                    ?>
                        <!--                                <tr>
                        <td class="textwrap textleft" style="word-break: break-all; word-wrap:break-word;">天津-天津市-河东区sdfsdfds , 100013</td>
                        <td class="textcenter" style="word-break: break-all; word-wrap:break-word;"><span class="font-blue">何</span></td>
                        <td class="textcenter">18611855356</td>
                        <td class="textcenter">                        <span class="tacitly-add"><a href='http://www.ftzmall.com.cn/member-set_default-918-2.html' rel="_request">设为默认</a></span>
                                            </td>
                        <td align="center"><a href="###" class="btn-bj-hover operate-btn" onclick="edit('918');"><span>修改</span></a><a class="btn-bj-hover operate-btn" href="https://www.ftzmall.com.cn/member-del_rec-918.html" rel="_request"><span>删除</span></a></td>
                        </tr>
                                <tr>
                        <td class="textwrap textleft" style="word-break: break-all; word-wrap:break-word;">北京-北京市-朝阳区青年路罗马嘉园 , 100013</td>
                        <td class="textcenter" style="word-break: break-all; word-wrap:break-word;"><span class="font-blue">何</span></td>
                        <td class="textcenter">18611855356</td>
                        <td class="textcenter">                        <span class="tacitly-add"><a href='http://www.ftzmall.com.cn/member-set_default-919-2.html' rel="_request">设为默认</a></span>
                                            </td>
                        <td align="center"><a href="###" class="btn-bj-hover operate-btn" onclick="edit('919');"><span>修改</span></a><a class="btn-bj-hover operate-btn" href="https://www.ftzmall.com.cn/member-del_rec-919.html" rel="_request"><span>删除</span></a></td>
                        </tr>
                                <tr>
                        <td class="textwrap textleft" style="word-break: break-all; word-wrap:break-word;">上海-上海市-卢湾区sdfsdfds , 100013</td>
                        <td class="textcenter" style="word-break: break-all; word-wrap:break-word;"><span class="font-blue">何</span></td>
                        <td class="textcenter">18611855356</td>
                        <td class="textcenter">                        <span class="tacitly-add"><a href='http://www.ftzmall.com.cn/member-set_default-980-2.html' rel="_request">设为默认</a></span>
                                            </td>
                        <td align="center"><a href="###" class="btn-bj-hover operate-btn" onclick="edit('980');"><span>修改</span></a><a class="btn-bj-hover operate-btn" href="https://www.ftzmall.com.cn/member-del_rec-980.html" rel="_request"><span>删除</span></a></td>
                        </tr>
                                <tr>
                        <td class="textwrap textleft" style="word-break: break-all; word-wrap:break-word;">北京-北京市-东城区sdfsdfdsww , 100013</td>
                        <td class="textcenter" style="word-break: break-all; word-wrap:break-word;"><span class="font-blue">何</span></td>
                        <td class="textcenter">18611855356</td>
                        <td class="textcenter">                        <span class="tacitly-add"><a href='http://www.ftzmall.com.cn/member-set_default-1078-2.html' rel="_request">设为默认</a></span>
                                            </td>
                        <td align="center"><a href="###" class="btn-bj-hover operate-btn" onclick="edit('1078');"><span>修改</span></a><a class="btn-bj-hover operate-btn" href="https://www.ftzmall.com.cn/member-del_rec-1078.html" rel="_request"><span>删除</span></a></td>
                        </tr>
                                <tr>
                        <td class="textwrap textleft" style="word-break: break-all; word-wrap:break-word;">北京-北京市-海淀区北京市海淀区青年路钻石大厦 , 100024</td>
                        <td class="textcenter" style="word-break: break-all; word-wrap:break-word;"><span class="font-blue">小明</span></td>
                        <td class="textcenter">18611855356</td>
                        <td class="textcenter">                        <span class="tacitly-add"><a href='http://www.ftzmall.com.cn/member-set_default-1106-2.html' rel="_request">设为默认</a></span>
                                            </td>
                        <td align="center"><a href="###" class="btn-bj-hover operate-btn" onclick="edit('1106');"><span>修改</span></a><a class="btn-bj-hover operate-btn" href="https://www.ftzmall.com.cn/member-del_rec-1106.html" rel="_request"><span>删除</span></a></td>
                        </tr>-->
                </tbody>

            </table>
<?php } ?>
    </div>
</div>


<script>
//    function edit(addrid) {
//        new Request.HTML({
//            url: 'https://www.ftzmall.com.cn/member-edit_addr.html',
//            update: $('Member_addr'),
//            data: 'addrid=' + addrid,
//            method: 'post',
//            onComplete: function (rs) {
//                $('addr-div').setStyle('display', 'block');
//                $('Member_addr').action = 'https://www.ftzmall.com.cn/member-save_rec.html';
//            }
//        }).send();
//        selectArea = function (sels) {
//            var selected = [];
//            sels.each(function (s) {
//                if (s.getStyle('display') != 'none') {
//                    var text = s[s.selectedIndex].text.trim().clean();
//                    if (['北京', '天津', '上海', '重庆'].indexOf(text) > -1)
//                        return;
//                    selected.push(text);
//                }
//            });
//            var selectedV = selected.join('');
//            if ($('addr').value.indexOf(selectedV) > -1) {
//
//            } else {
//                $('addr').value = selectedV;
//            }
//        };
//        validatorMap['check_zipcode'] = ['请录入正确的邮编', function (element, v) {
//                var value = v.trim();
//                var _is_validate = true;
//                if (/^[1-9][0-9]{5}$/.test(value)) {
//                    _is_validate = true;
//                } else {
//                    _is_validate = false;
//                }
//                return _is_validate;
//            }];
//        validatorMap['check_phone'] = ['请输入正确的电话号码', function (element, v) {
//                var value = v.trim();
//                var _is_validate = true;
//                if (/^0?1[3458]\d{9}$|^(0\d{2,3}-?)?[23456789]\d{5,7}(-\d{1,5})?$/.test(value)) {
//                    _is_validate = true;
//                } else {
//                    _is_validate = false;
//                }
//                return _is_validate;
//            }];
//    }
    function a(url, options) {
        if (!url)
            return;
        options = Object.append({
            width: window.getSize().x * 0.8,
            height: window.getSize().y * 0.8
        }, options || {});
        var params = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width={width},height={height}';
        params = params.substitute(options);

        window.open(url, '_blank', params);
    }

</script>

<script>
//    (function () {
//
//        $$(".delete_addr").addEvent('click', function (e) {
//            if (!confirm('确定删除?'))
//                return false;
//        });
//        $("add").addEvent('click', function (e) {
//            if (1) {
//                $('addr-div').setStyle('display', 'inline');
//            } else {
//                return false;
//            }
//        });
//
//        selectArea = function (sels) {
//            var selected = [];
//            sels.each(function (s) {
//                if (s.getStyle('display') != 'none') {
//                    var text = s[s.selectedIndex].text.trim().clean();
//                    if (['北京', '天津', '上海', '重庆'].indexOf(text) > -1)
//                        return;
//                    selected.push(text);
//                }
//            });
//            var selectedV = selected.join('');
//            $('addr').value = selectedV;
//        };
//
//        validatorMap['mobile_or_phone'] = ['手机或电话必填其一！', function (element, v) {
//                var _contacts = $(element).getParent('td').getPrevious('td').getElements('input');
//
//                var _is_validate = false;
//                _contacts.each(function (el) {
//                    if (el.value)
//                        _is_validate = true || _is_validate;
//                });
//
//                return _is_validate;
//            }];
//
//        validatorMap['check_zipcode'] = ['请录入正确的邮编', function (element, v) {
//                var value = v.trim();
//                var _is_validate = true;
//                if (/^[1-9][0-9]{5}$/.test(value)) {
//                    _is_validate = true;
//                } else {
//                    _is_validate = false;
//                }
//                return _is_validate;
//            }];
//
//        $("unset").addEvent('click', function (e) {
//            $('addr-div').setStyle('display', 'none');
//        });
//    })();
</script> 

<!-- right-->

