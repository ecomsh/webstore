<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\CartAsset;
CartAsset::register($this);
/* @var $this yii\web\View */
$this->title = '支付订单_上海外高桥进口商品网';
?>

<div class="main w1200">
    <div class="mTB">
        <div class="orderpay" style="width: 1200px;">
                <table class="gridlist table-goods-list gridlist_member " style="border-bottom:none" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                            <th class="first">订单号</th>
                            <th>订单商品</th>
                            <th>单价（元）</th>
                            <th>数量</th>
                            <th>运费</th>
                            <th>实付款（元）</th>
                            <th>支付方式</th>
                            <th>操作</th>
                        </tr>
                    </tbody>
                    <?php  foreach ($orderInfos as $key => $detailInfo):?>
                    <tbody>
                        <tbody>
                        
                        <?= Html::beginForm(['order/pay'], 'post', ['target'=>'_blank','enctype' => 'multipart/form-data']) ?>
                            <input type="hidden" class="check_id" name="orderId" value="<?= $detailInfo['orderId'] ?>" >
                            <input type="hidden" id="payMethod_<?= $detailInfo['orderId'] ?>" name="payMethod" value="AliPay" >
                            <input type="hidden" name="subject" value="<?= $detailInfo['orderId'] ?>" >
                            <input type="hidden" name="itemSum" value=4 >
                            <input type="hidden" name="return_url_pay" value="<?= Url::to(['order/index'],true) ?>" >
                        <tr>
                            <td class="vt">
                                <a href="<?= Url::to(['order/orderdetail', 'orderId'=>$detailInfo['orderId']])?>" class="operate-btn">
                                <?=$detailInfo['orderId']?>
                                </a>
                            </td>
                            <td class="horizontal-m">
                                <?php foreach($detailInfo['orderLineList'] as $val){ ?>
                                <div class="clearfix">
                                    <div class="product-list-img member-gift-pic goodpic">
                                        <a href="<?=$val['itemLink']?>"><img src="<?php echo json_decode($val['itemImageLink'],true)['img'];?>"></a>
                                    </div>
                                    <div class="goods-main clearfix">
                                        <div class="goodinfo">
                                            <h3><a target="_blank" class="font-blue" href="<?=$val['itemLink']?>"><?=$val['itemDisplayText']?></a></h3>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- gift -->
                            </td>
                            <td class="horizontal-m">
                                <?php foreach($detailInfo['orderLineList'] as $val){ ?>
                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul><li>￥<?=$val['unitPrice']?></li></ul>
                                    </div>
                                </div>
                                 <?php } ?>
                            </td>
                            <td class="horizontal-m">
                                <?php foreach($detailInfo['orderLineList'] as $val){ ?>
                                <div class="clearfix">
                                    <div class="goodinfo" style="width:72px;height:72px;">
                                        <ul><li><?=$val['quantity']?></li></ul>
                                    </div>
                                </div>
                                <?php } ?>
                            </td>
                            <td class="point textcenter">
                                <ui><li>￥<?=$detailInfo['shippingAmount']?></li></ui>
                            </td>
                            <td class="point textcenter">
                                <ui>
                                    <li>￥<?=$detailInfo['totalAmount']?></li>
                                    <?php if ($detailInfo['shippingAmount'] > 0): ?>
                                    <li>(含运费：￥<?=$detailInfo['shippingAmount']?>)</li>
                                    <?php endif?>
                                    <?php if ($detailInfo['taxAmount'] > 50): ?>
                                    <li>(含跨境税费：￥<?=$detailInfo['taxAmount']?>)</li>
                                    <?php  elseif($detailInfo['orderLineList'][0]['itemSalesType'] >2): ?>
                                    <li>(税金不足50元减免关税)</li>
                                    <?php endif?>
                                </ui>
                            </td>

                            <td>
                                <ul>
                                    <li>
                                        <select name="paytype" id="select_<?=$detailInfo['orderId']?>">
                                            <?php foreach($type[$detailInfo['orderLineList'][0]['itemSalesType']] as $key=>$val){ ?>  
                                            <?php if ($key == 'AliPay'){?>
                                            <option value="AliPay" selected="selected"><?=$val?></option>
                                            <?php } else {?>
                                            <option value='<?=$key?>'><?=$val?></option>
                                            
                                            <?php }} ?>
                                            <!--option value="AliPay" selected="selected">支付宝即时支付</option-->   
                                        </select>
                                    </li>
                                </ul>
                            </td>
                            <script>
                            (function() {
                                $('select_<?=$detailInfo['orderId']?>').addEvent('change', function(e) {
                                var value = this.value;
                                $('payMethod_<?=$detailInfo['orderId']?>').set('value', value);
                                });
                            })();
                            </script>
                            <td class="point textcenter">
                                <?php if(in_array($detailInfo['orderStatus'], ['CREATED','CREATING'])){ ?> 
                                    <button type="submit" onclick="testMessageBox();" class="btn order-btn lijizhifu btn-has-icon btn-has-icon">
                                        <span><span><!--<i class="btn-icon"><img src="<?= Yii::$app->params['baseimgUrl'] ?>set-arrow.gif"></i>-->立刻支付</span></span>
                                    </button> 
                                <?php } else{?>
                                    <a href="<?= Url::to(['order/orderdetail', 'orderId'=>$detailInfo['orderId']])?>" data-pjax="0" class="font-blue operate-btn">查看订单</a>
                                <?php } ?>
                            </td>
                    </tr>
                    <?= Html::endForm() ?>
                    </tbody>
                    <?php endforeach;?>
                </table>
                <ul>
                    <li class="deposit_action_jiang" style="display:none;">
                        <input type="hidden" name="payment[combination_pay]" value="false">
                        <span class="form-act">预存款余额：
                            <b class="price">￥0.00</b>  
                            <em>您需要为
                                <a href="<?= Yii::$app->params['baseUrl'] ?>member-deposit.html" target="_blank" class="lnklike action-recharge">预存款充值</a>，充值完成后请<a href="css/lizf会员中心_上海外高桥进口商品网.html" class="lnklike">刷新此页面</a>
                            </em>
                        </span>
                    </li>
                </ul>        
                  
                <script>
                    // $$('.order-btn lijizhifu btn-has-icon').addEvent('click',function(e){

                    <!-- 弹出层效果开始 -->
                    //window.onload = function() {
                    //    document.getElementById('preson').onclick = function() {
                    //        document.getElementById('r9001000').checked = 'true';
                    //        document.getElementById('bank_type').value = "92"
                    //    }
                    //    document.getElementById('credit').onclick = function() {
                    //        document.getElementById('r9001002').checked = 'true';
                    //        document.getElementById('bank_type').value = "92"
                    //    }
                    //}
                    var isIe = (document.all) ? true : false;
                    function setSelectState(state)
                    {
                        var objl = document.getElementsByTagName('select');
                        for (var i = 0; i < objl.length; i++)
                        {
                            objl[i].style.visibility = state;
                        }
                    }

                    function btnHover() {
                        var bg1 = document.getElementById('paybtn');
                        var bg2 = document.getElementById('payspan');
                        var msOver = function() {
                            bg1.style.backgroundPosition = '0px -50px';
                            bg2.style.backgroundPosition = 'right -134px';

                        }
                        var msOut = function() {
                            bg1.style.backgroundPosition = '0px -81px';
                            bg2.style.backgroundPosition = 'right -165px';
                        }
                        bg1.onmouseover = msOver;
                        bg2.onmouseover = msOver;
                        bg1.onmouseout = msOut;
                        bg2.onmouseout = msOut;
                    }

                    function showMessageBox(wTitle, content, wHeight, wWidth)
                    {

                        var bWidth = parseInt(document.documentElement.scrollWidth);
                        var bHeight = parseInt(document.documentElement.scrollHeight);
                        if (isIe) {
                            setSelectState('hidden');
                        }
                        var back = document.createElement("div");
                        back.id = "back";
                        var styleStr = "top:0px;left:0px;position:absolute;background:#666;width:" + bWidth + "px;height:" + bHeight + "px;";

                        back.style.cssText = styleStr;
                        document.body.appendChild(back);

                        var mesW = document.createElement("div");
                        mesW.id = "mesWindow";
                        mesW.className = "mesWindow";
                        mesW.innerHTML = "<div class='mesWindowTop'><table width='100%' height='100%'><tr style='height:40px;'><td>" + wTitle + "</td><td style='width:1px;'><input type='button' onclick='closeGo();' title='关闭窗口' class='close' value='' /></td></tr></table></div><div class='mesWindowContent' id='mesWindowContent'>" + content + "</div><div class='mesWindowBottom'></div>";

                                styleStr = "left:50%;top:200px;margin-left:" + ( - (wWidth / 2)) + "px;position:fixed;width:" + wWidth + "px;";
                                        mesW.style.cssText = styleStr;
                                document.body.appendChild(mesW);


                            }
                            function closeGo() {
                                window.location.href = "<?= Url::to(['order/index'],true); ?>";
                            }

                //关闭窗口
                            function closeWindow()
                            {
                                if (document.getElementById('back') != null)
                                {
                                    document.getElementById('back').parentNode.removeChild(document.getElementById('back'));
                                }
                                if (document.getElementById('mesWindow') != null)
                                {
                                    document.getElementById('mesWindow').parentNode.removeChild(document.getElementById('mesWindow'));
                                }
                                if (isIe) {
                                    setSelectState('');
                                }
                                refres_h();
                            }
                            function refres_h() {
                                window.location.href = window.location.href;
                                //window.location.reload;
                            }
                            function testMessageBox(ev)
                            {
                                messHead = '支付';
                                messContent = '<div><p class="lightgray">请您在新打开的网上银行页面进行支付，支付完成后选择:</p><ul><li><span class="success">&nbsp;</span><span class="text">付款成功</span><span class="lightgray"> ｜您可以选择：</span><a class="ftbl ml10" href="javascript:;" onclick="closeGo();" >查看订单</a></li><li><span class="error_m">&nbsp;</span><span class="text">付款失败</span><span class="lightgray"> ｜建议您选择：</span><a class="ftbl ml10" href="javascript:;" onclick="closeWindow();" >选择其他支付方式</a></li></ul><p>若支付遇到问题，请致电400-188-5179</p></div>';
                                showMessageBox(messHead,messContent,250,616);
                                btnHover();
                            }
                </script>
            
        </div>
    </div>
    <!-- <div class="sidebar-right">
        <a rel="nofllow" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODAwNTIxMF8xNjMxNTlfNDAwMTg4NTE3OV8yXw;" target="_blank" class="qtalk"></a>
        <a href="javascript:void(0)" class="sidebar-backtop"></a>
        <a href="javascript:void(0)" class="sidebar-close"></a>
    </div> -->
    <script>
        (function(){
        $$('.sidebar-backtop').addEvent('click', function(){
        $(window).scrollTo(0, 0)
        });
                $$('.sidebar-close').addEvent('click', function(){
        $$('.sidebar-right').setStyle('display', 'none')
        })
//        var cookietotalnum = jQuery.cookie('carttotalNum'+'<?= Yii::$app->user->getId()?>');   
//        jQuery("#cart_num").html(carttotalnum);
//        Cookie.dispose('carttotalNum'+'<?= Yii::$app->user->getId()?>');
        })();
    </script>
</div>