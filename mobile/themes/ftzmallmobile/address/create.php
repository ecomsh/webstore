<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mobile\assets\AddressAsset;
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
AddressAsset::register($this);
?>



         <style>
        .c-l{float: left;padding-right: 5px;  font-size: 1rem;text-align: left;border: none;padding: 0;width: 30%;}
        .c-g{min-height: 60px;height:auto; line-height: 55px; width: 96%; margin: 0 auto; border: none; border-bottom: solid 1px #dedede;}
        .c-g-cq{height: 60px;width: 96%; margin: 0 auto; border: none;}
        .x1{float: left;  width:70%;}
        .text{border: none;  width: 100%;  height: 26px;}
        .help-block-error{color:#FF0000;word-break:keep-all;position:relative;top:0.5rem;margin-bottom:0.5rem;margin-left:30%;line-height: 20px;width:70%;}
        </style>



        <div class="m-page" style="min-height: 605px;">
            <div class="full-screen">
                <div class="top-holder">
                    <div class="fixed-top">
                        <div class="m-header">
                            <div class="header-left-btn">
                                <span onclick="history.back()" class="icon-back"></span>
                            </div>
                            <h2>编辑收货地址</h2>
                            <div class="header-right-btn">
                                <a href="<?=Url::to(['user/index'])?>" class="icon-home"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="address-form">
                    <div class="form-box">
                        <?php
                        $options = [];
                        if ($id)
                            $options['options'] = ['id' => $id];
                            $options['enableClientValidation'] = true;
                            $options['fieldConfig'] = ['template' => "{label}<div class='x1'>{input}</div><div style='clear:both;'></div>{error}",'labelOptions' => ['class' => 'address-label'], 'errorOptions' => ['style' => '']];
                            $form = ActiveForm::begin($options
//        'id' => 'Member_addr',  
                                        //  'options' => ['class' => 'form-horizontal'],  
//        'fieldConfig' => [  
//            'template'=>"<tr><th>{label}：</th><td>{input}{error}</td></tr>"
//          //  'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",  
//           // 'labelOptions' => ['class' => 'col-lg-1 control-label'],  
//        ],  
                            );

                        if ($model->isDefault) {
                            $model->isDefault = 'true';
                        }
                        ?>               
<!--                        <form action="http://bbctest.ftzmall.com.cn/wap/member-save_rec.html" class="form" method="post" data-type="ajax">-->
<!--                                    <input type="hidden" name="shouHuoXinXi[addr_id]" value="1399">-->

                                                      
                             
                                    <div class="c-g-cq">
<!--                                        省：<select id="cmbProvince"></select>-->
                                        <?= $form->field($model, 'stateCode',['labelOptions' => ['class' => 'c-l']])->dropDownList(['' => '请输入省份'], [ 'style' => 'width:80%;height: 2rem;', 'data-level-index' => 0, ]) ?>
                                    </div>
                                    <div class="c-g-cq">
<!--                                    市：<select id="cmbCity"></select>-->
                                        <?= $form->field($model, 'cityCode',['labelOptions' => ['class' => 'c-l']])->dropDownList(['' => '请输入城市'], ['style' => 'width: 80%;height: 2rem;', 'data-level-index' => 0, 'id'=>'addressapi-citycode']) ?>
                                    </div>
                                    <div class="c-g-cq">
<!--                                    区：<select id="cmbArea"></select>-->
                                        <?= $form->field($model, 'districtCode',['labelOptions' => ['class' => 'c-l']])->dropDownList(['' => '请输入区县'], [ 'style' => 'width: 80%;height: 2rem;', 'data-level-index' => 0,]) ?>
                                    </div>
                               

                            <div class="c-g">
<!--                                <label class="c-l">收货地址</label>-->
                                <span class="c1">
<!--                                    <input type="text" class="text" name="shouHuoXinXi[addr]" value="" placeholder="请输入收货地址" required="required" data-caution="收获地址不能为空">-->
            <?= $form->field($model, 'stateName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'provice1']) ?>
            <?= $form->field($model, 'cityName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'city1']) ?>
            <?= $form->field($model, 'districtName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'district1']) ?>
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
                        <?= $form->field($model, 'address',['labelOptions' => ['class' => 'c-l','style' =>'line-height:26px']])->textarea([ 'class' => 'text', 'rows' => 2, 'cols' => 30 ,  'style'=>'max-width:690px;height:52px;line-height:26px;max-height:340px']) ?>
                                </span>
                            </div>
                            <div class="c-g">
                                <!--<label class="c-l">邮编</label>-->                               
                                    <!--<input type="text" class="text" name="shouHuoXinXi[zip]" value="" placeholder="请输入邮编">-->
                                    <?= $form->field($model, 'postcode',['labelOptions' => ['class' => 'c-l']])->textInput(['class' =>'text', 'size' => 15]) ?>                               
                            </div>
                            <div class="c-g">                         
                                <!--<input type="text" class="text" name="shouHuoXinXi[name]" value="" placeholder="请输入姓名" required="required" data-caution="收货人姓名不能为空">-->
                                    <?= $form->field($model, 'receiverName',['labelOptions' => ['class' => 'c-l']])->textInput([ 'class' => 'text', 'size' => 15]) ?>
                            </div>
                            <div class="c-g">                          
                               <!--                                    <input type="text" class="text" name="shouHuoXinXi[mobile]" value="" placeholder="请输入手机号" required="required" data-caution="手机不能为空">-->
                               <?= $form->field($model, 'receiverMobile',['labelOptions' => ['class' => 'c-l']])->textInput(['class' => 'text', 'size' => 15]) ?>                                
                            </div>
                            <div class="c-g">       
                                    <!--<input type="text" class="text" name="shouHuoXinXi[tel]" value="" placeholder="请输入固定电话">-->
                                    <?= $form->field($model, 'receiverPhone',['labelOptions' => ['class' => 'c-l']])->textInput(['class' => 'text', 'size' => 15]) ?> </span>
                            </div>
                            <div class="c-g-c">
                                <!--<input type="checkbox" name="shouHuoXinXi[def_addr]" value="1" id="def_addr_check">-->
                                <!--<label for="def_addr_check">设为默认收货地址</label>-->
                                <?= $form->field($model, 'isDefault',['labelOptions' => ['class' => 'c-l']])->checkbox(['label' => '设为默认地址', 'uncheck' => 'false', 'value' => 'true']) ?>    

                            </div>
                            <div class="btn-bar">
                                <!--<button type="submit" class="red_btn" rel="_request">保存地址</button>-->
                                <?= Html::submitButton('保存地址', [ 'class' => 'red_btn']); ?>
                            </div>
<!--                        </form>-->
                        <?php ActiveForm::end(); ?>                        
                    </div>
                </div>
            </div>
        </div> 
   

