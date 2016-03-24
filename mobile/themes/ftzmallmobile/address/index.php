<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mobile\widgets\Alert;
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

   
                <div class="m-page" style="min-height: 605px;">
                    <div class="full-screen">
                        <div class="top-holder">
                            <div class="fixed-top">
                                <div class="m-header">
                                    <div class="header-left-btn">
                                        <span onclick="history.back()" class="icon-back"></span>
                                    </div>
                                    <h2>地址管理</h2>
                                    <div class="header-right-btn">
                                        <a href="<?=Url::to(['user/index'])?>" class="icon-home"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="address">

                <?php
                    if ($data & is_array($data))
                    {
                        foreach ($data as $k => $v):
                            ?>
                                <div class="item item-multi">
                                    <p>
                                        地区：
                                        <?= Html::encode($v['address']) ?>
                                            <br> 邮编：
                                            <?= Html::encode($v['postcode']) ?>
                                                <br> 姓名：
                                                <?= Html::encode($v['receiverName']) ?>
                                                    <br> 电话：
                                                    <?= Html::encode($v['receiverMobile']) ?>
                                                        <br> &nbsp;
                                    </p>
                                    <!--<a href="Url::to(['address/index'])">编辑地址</a>-->
                                    <?= Html::a('编辑地址', ['address/update', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['class' => '']) ?>
                                        
                                    <?= $v['isDefault'] ? Html::a('已为默认',['javascript:void(0);'] ,['class'=>'isDefault']) : Html::a('设为默认', ['address/default', 'id' => isset($v['addressId']) ? $v['addressId'] : 0 ] ,['class'=>'isDefault']) ?>
                                    
                                        <!--<a href="http://bbctest.ftzmall.com.cn/wap/member-del_rec-1436.html" class="del">删除</a>-->
                                        <?= Html::a('删除', ['address/delete', 'id' => isset($v['addressId']) ? $v['addressId'] : 0], ['class' => 'del']) ?>
                                            <i class="arr right"></i>
                                            <span class="moren" style="display:none;">默认</span>
                                </div>
                            <?php
                        endforeach;
                    }
                    ?>


                        </div>
                        <div class="a-right" style="font-size:1.2rem;background-color:#970b12;color:#000;width:60%;padding:0.5rem;margin:1rem auto;text-align:center">
                            <span style="color:#EEE" class="red-btn"><?= Html::a('添加收货地址', ['address/create'] ,['style'=>'color:#fff']) ?>
<!--                            <a href="<?=Url::to(['address/index'])?>" style="color:#EEE">添加收货地址</a>-->
                            </span>
                        </div>
                    </div>
                   
                    <script>
//                        var sdSon=$(".address .item-multi");
//                        for(var i=0;i<sdSon.length;i++){
//                            if($(this).find('a:eq(1)').html() == "已为默认"){
//                                $(this).siblings(".moren").css("dislay", "block");
//                            } 
//                        }
                        var btns = new Array(); 
                        $(".item-multi .isDefault").each(function(key,value){       
                            btns[key] = $(this).html();
                             if(btns[key]=="已为默认"){                                 
                                $(this).siblings(".moren").css("display", "block");
                             }else{
                                $(this).siblings(".moren").css("display", "none");
                             }
                        })

                    </script>
                    <!--
                    <script type="text/javascript">
                        $('.del').bind('click', function() {
                            if (confirm('确定删除该地址？'))
                                $.post(this.href, function(re) {
                                    var o = JSON.parse(re);
                                    if (o.success) {
                                        new Dialog('#success', {
                                            'title': '删除成功'
                                        });
                                        setTimeout(function() {
                                            location.reload(true)
                                        }, 2000);
                                    } else {
                                        return alert(o.error);
                                    }
                                });
                            return false;
                        });

                    </script>
-->
                </div>

 