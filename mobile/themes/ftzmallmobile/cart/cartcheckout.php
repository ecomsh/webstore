<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = '购物车_上海外高桥进口商品网';
//var_dump($data);
?>



    <div class="m-page" style="min-height: 425px; background: rgb(238, 238, 238);overflow:hidden;">
        <div class="top-holder">
            <div class="fixed-top">
                <div class="m-header">
                    <div class="header-left-btn">
                        <span onclick="history.back()" class="icon-back"></span>
                    </div>
                    <h2>结算</h2>
                    <div class="header-right-btn">
                        <a href="<?=Url::to(['order/index'])?>" class="icon-home"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="full-screen checkout-body">
            <form action="http://bbctest.ftzmall.com.cn/wap/order-create.html" method="post" class="form" data-type="ajax">
                <!--
                <input type="hidden" name="md5_cart_info" value="c12d160e347f2dbe81c897305b4b8b1e">
                <input type="hidden" name="extends_args" id="extends_args" value="{&quot;get&quot;:[],&quot;post&quot;:{&quot;obj_type&quot;:&quot;goods&quot;,&quot;goods_ident&quot;:&quot;goods_227_686&quot;,&quot;goods_id&quot;:&quot;227&quot;,&quot;min&quot;:&quot;1&quot;,&quot;max&quot;:&quot;40&quot;,&quot;stock&quot;:&quot;40&quot;,&quot;modify_quantity&quot;:{&quot;goods_1223_1717&quot;:{&quot;quantity&quot;:&quot;1&quot;},&quot;goods_227_686&quot;:{&quot;quantity&quot;:&quot;1&quot;}}}}">
                <input type="hidden" name="point[rate]" value="0.02">
                <input type="hidden" name="point[score]">
-->
                <!--地址区域-->
                <div class="section addr-section pay-section">
                    <div class="d-line c-fix">
                        <!-- <span class="l-k">收货地址：</span> -->
                        <?php if(!empty($defaultAddress)){ ?>
                        <span class="l-v" id="J_sel_address">
                              姓名：<?=$defaultAddress['receiverName']?><br>
                              电话：<?=$defaultAddress['receiverMobile']?>  <br>
                              地址：<?=$defaultAddress['address']?>  <br>
                              邮编：<?=$defaultAddress['postcode']?>
                              
                              <span class="other-attr">其他地址<i class="arr down"></i></span>
                        </span>
                        
                        <?php } ?>
                        <input type="hidden" id="shipAddressId" name="address" addressId="<?=isset($defaultAddress['addressId']) ? $defaultAddress['addressId'] : '' ?>">
                    </div>
                    <ul class="address-list hide" id="J_address_list">
                        <!-- 收货信息 -->
                        <?php foreach($addressData as $key => $val){ ?>
                        <li class="address-item gb act" addressId="<?=$val['addressId']?>" country_code = "CN" state_code = "<?=$val['stateCode']?>">
                            姓名：<?=$val['receiverName']?>
                            <br> 电话：<?=$val['receiverMobile']?>
                            <br> 地址：<?=$val['address']?>
                            <br> 邮编：<?=$val['postcode']?>
                        </li>
                        <?php } ?>
                    </ul>
                    <a href="<?=Url::to(['address/create'])?>" class="btn address-btn">
                        添加收货地址
                    </a>
                </div>

                <div class="d-title">
                    <span class="k"><h3>配送时间</h3></span>
                </div>
                <div class="section" style=" margin-left: 0.5rem;margin-right: 0.5rem;">
                    <div style="margin:0 auto;">
                        <select id="shipInst" data-am-selected="{btnWidth:'70%',maxHeight:60,btnSize:'sm'}">
                            <option value="3" selected>周六日和节假日均可送货</option>
                            <option value="1">周一到周五工作日送货</option>
                            <option value="2">周一至周日送货</option>
                        </select>
                    </div>
                </div>

                <div class="d-title">
                    <span class="k"><h3>商品清单</h3></span>
                </div>
                <div class="section" style="  margin-left: 0.5rem;margin-right: 0.5rem;">
                    <?php foreach($CartLines as $type => $item){ ?>
                    <div id="store_89" class="store-box">
                        <div class="shop-info">
                            <span><?=Yii::$app->params['sm']['store']['display'][$type]?></span>
                        </div>
                        <ul class="pt-list" style="border: solid 1px #eee;">
                            <?php foreach($item as $v){ ?>
                            <li class="pt-h-item c-fix">
                                <a href="#" class="pt-h-link">
                                    <div class="pt-h-img"><img src="<?php echo json_decode($v['itemImageLink'],true)['img'];?>"></div>
                                    <div class="pt-h-info">
                                        <div class="pt-h-name">
                                            <?= $v['itemDisplayText']; ?> </div>
                                        <div class="pt-h-other">
                                        </div>
                                        <div class="col" id="<?=$v['itemPartNumber']?>">
                                            数量：<?= $itemInventory[$v['itemPartNumber']]?>
                                        </div>
                                        <div class="col2">
                                        </div>

                                    </div>
                                    <div class="pt-h-bar c-fix">
                                        <div class="col price">
                                            ￥<?= Yii::$app->formatter->asDecimal((float)$v['itemOfferPrice']); ?> </div>
                                    </div>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <div class="section">
                            <ul class="shipping-list hide" id="J_shipping_list"> </ul>
                            
                        </div>
                        <div class="col t-r">
                            <div class="shop-total">
                                <strong></strong>运费：<span class="shipping-total">￥<?=Yii::$app->formatter->asDecimal((float)$price['storePrice'][$type]['shipping']);?></span>
                            </div>
                            <div class="shop-total">
                                <strong></strong>行邮税：<span class="shipping-total">￥<?=Yii::$app->formatter->asDecimal((float)$price['storePrice'][$type]['tax']);?></span>
                            </div>
                            <div class="shop-total">
                                <strong></strong>优惠金额：<span class="shipping-total">-￥<?=$price['storePrice'][$type]['promotion']?></span>
                            </div>
                            <div class="shop-total">
                                <strong></strong>合计：<span class="shipping-total">￥<?=Yii::$app->formatter->asDecimal((float)$price['storePrice'][$type]['final']);?></span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>



                    <!--<div id="store_77" class="store-box">
                        <div class="shop-info">
                            <span>店铺：<span>FTZMALL</span></span>
                        </div>

                        <ul class="pt-list" style="border: solid 1px #eee;">
                            <li class="pt-h-item c-fix">
                                <a href="http://bbctest.ftzmall.com.cn/wap/product-227.html" class="pt-h-link">
                                    <div class="pt-h-img"><img src="c7fb39aa4137aaea8f5edbfbbcad996e15d.jpg"></div>
                                    <div class="pt-h-info">
                                        <div class="pt-h-name">
                                            苏格兰 殿斯圆形奶油黄油饼干 160g </div>
                                        <div class="pt-h-other">
                                        </div>
                                        <div class="col">
                                            数量：1
                                        </div>
                                        <div class="col2">

                                        </div>
                                    </div>
                                    <div class="pt-h-bar c-fix">
                                        <div class="col price">
                                            ￥3200.00 </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="section">
                            <ul class="shipping-list hide" id="J_shipping_list"> </ul>
                            <input type="text" name="memo_89" placeholder="订单留言" class="text cart-text" style="height:2rem;">
                        </div>
                        <div class="col t-r">
                            <div class="shop-total">
                                <strong>FTZMALL</strong>店铺合计：<span class="shipping-total">￥3200.00</span>
                            </div>
                        </div>
                    </div>-->
                </div>


                <div class="d-title">
                    <span class="k"><h3>费用详情</h3></span>
                </div>
                <div class="section checkout_total" style="margin-left:0.5rem;margin-right:0.5rem">
                    <div id="checkout_total">
                        <div class="total-body">
                            <div class="d-line">
                                <span class="k">
                                    商品金额：
                                </span>
                                <span class="v">
                                    <div class="price">
                                        ￥<?=Yii::$app->formatter->asDecimal((float)$price['totalPrice']['originalPrice'])?>
                                    </div>
                                </span>
                            </div>
                            <div class="d-line">
                                <span class="k">
                                        运费：
                                </span>
                                <span class="v">
                                    <div class="price">
                                        ￥<?=Yii::$app->formatter->asDecimal((float)$price['totalPrice']['shipping'])?>
                                    </div>
                                </span>
                            </div>
                            <div class="d-line">
                                <span class="k">
                                    税费：
                                </span>
                                <span class="v">
                                    <div class="price">
                                      ￥<?=Yii::$app->formatter->asDecimal((float)$price['totalPrice']['tax'])?>
                                    </div>
                                </span>
                            </div>
                            <div class="d-line">
                                <span class="k">
                                    优惠金额：
                                </span>
                                <span class="v">
                                    <div class="price">
                                      -￥<?= $price['totalPrice']['promotion'] ?>
                                    </div>
                                </span>
                            </div>
                            <div class="total-price">
                                <span class="v">
                                    总金额：
                                    <span class="price">
                                        ￥<?=Yii::$app->formatter->asDecimal((float)$price['totalPrice']['final'])?>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="d-title">
                    <span class="k"><h3>发票信息</h3></span>
                </div>
                <div class="section invoice-section" style="margin-left:0.5rem;margin-right:0.5rem;">
                    <div class="l-v">
                        <div id="order_invoice" class="order-section order-invoice">
                            <ul>
                                <li>
                                    <input type="radio" name="payment[tax_type]" id="action_invoice_false" value="false" checked="checked" value="不需要发票">
                                    <label for="action_invoice_false">不需要发票</label>
                                </li>
                                <li>
                                    <input type="radio" name="payment[tax_type]" id="action_invoice_personal" value="personal" value="个人发票">
                                    <label for="action_invoice_personal">个人发票 (税率5%)</label>
                                </li>
                                <li>
                                    <input type="radio" name="payment[tax_type]" id="action_invoice_company" value="company" value="公司发票">
                                    <label for="action_invoice_company">公司发票 (税率6%)</label>
                                </li>
                            </ul>
                            <div class="fapiaotaitou" style="margin-left:2rem;display:none;">
                                <span>发票抬头：</span>
                                <input type="text" id="invName" placeholder="发票抬头" value="">
                            </div>
                            <script>
                                $("#order_invoice ul li input[type='radio']").click(function() {
                                    var id = $(this).attr("id");
                                    if (id == "action_invoice_company") {
                                        $("#invName").val('');
                                        $("#invCategory").val('公司');
                                        $(".fapiaotaitou").css("display", "block");
                                    } else {
                                        if(id == "action_invoice_personal"){
                                            $("#invName").val('个人');
                                            $("#invCategory").val('个人');
                                        }else{
                                            $("#invName").val('');
                                            $("#invCategory").val('');
                                        }
                                        $(".fapiaotaitou").css("display", "none");
                                    }
                                });

                            </script>
                        </div>
                    </div>
                </div>

                <div class="section submit-section" style="margin-left:0.5rem;margin-right:0.5rem;">
                    <div class="order-btn-bar">
                        <input type="hidden" id="submitState" value="<?=$submitState?>" />
                        <input type="hidden" id="cartlineId" value="<?=$CartLinesIds?>" />
                        <input type="hidden" id="cartlineDTOList" value='<?=$cartlineDTOList?>' />
                        <input type="hidden" id="isRealname" value="<?=$isRealname?>" />
                        <input type="hidden" id="invCategory" value="" />
                        <button id="submitButton" type="button" class="btn red" rel="_request">提交订单</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function(document) {
            $('.m-page').css('background', '#eee');
            
            $('#J_address_list .address-item').on('click', function() {
                $('.address-btn').hide();
            });

           

            /*function shipping(el, value, sellerId) {
                $.post('/wap/cart-seller_shipping.html', 'seller_id=' + sellerId + '&shipping_id=' + value, function(re) {
                    re = JSON.parse(re);
                    var storeBox = el.parents('.store-box')
                    storeBox.find('.shipping-price').html(re.shipping_price);
                    storeBox.find('.shipping-total').html(re.seller_total);
                });

            }*/

            function shipping_confirm(data) {
                $.post('/wap/cart-shipping_confirm.html', data, function(re) {});
            }

            function payment_confirm(data) {
                $.post('/wap/cart-payment_confirm.html', data, function(re) {});
            }
            
            
            var step1 = {
                open: function() {
                    this.saved = false;
                    step2.saved = false;
                    step2.close();
                    $('#J_address_list').removeClass('hide');
                    $('#J_sel_address').addClass('hide').html('');
                },
                save: function(address_text, address_value, _country_code, _state_code) {
                    // $('#J_sel_address').html(address_text+'<i class="arr down"></i>');
                    // $('#J_sel_address input[name="address"]').val(address_value);
                    $("#shipAddressId").val(address_value);
                    $('#J_sel_address').html(address_text + '<span class="other-attr">其他地址<i class="arr down"></i></span>');
//                    shipping_confirm('address=' + $('#J_sel_address input').val());
                    
                    this.getInventory(_country_code,_state_code);
                    this.close();
                    this.saved = true;
//                    step2.open('/wap/cart-payment_change.html', '');
                },
                close: function() {
                    $('#J_address_list').addClass('hide');
                    $('#J_sel_address').removeClass('hide');
                },
                getInventory: function(country_code,state_code){
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
                            step1.show(data);
                        },
                        dataType: 'json',
                    });
                },
                show: function(data){
                    for(var ipn in data){
                        if(data[ipn] <= 0){
                            $("#".ipn).set('html', '<span>无货</span>');
                            $("#submitState").val('1');
                        }
                    }
                },
                saved: false
            }
            var step2 = {
                open: function(url, data) {
                    if (step1.saved) {
                        if (url) {
                            this.url = url;
                        } else {
                            url = this.url;
                        }
                        var self = this;
                        this.saved = false;
                        $.post(url, data, function(re) {
                            $('#J_pay_list').html(re).removeClass('hide');
                            $('#J_sel_pay').addClass('hide').html('');
                            $('#J_pay_list .pay-item').on('click', function(e) {
                                var value = $(this).html();
                                self.save(value, $(this).attr('value'));
                            });
                            $('#J_pay_list .pay-item').eq(0).trigger('click');
                        });
                    } else {
                        alert('请选择配送方式');
                    }
                },
                save: function(pay_text, pay_value) {
                    var pay_input = '<input type="hidden" name="payment[pay_app_id]" value=' + pay_value + ' />';
                    var lastSel = JSON.parse($('input[name=address]').val()).area;
                    var payment = JSON.parse(pay_value).pay_app_id;
                    $('#J_sel_pay').html(pay_text + pay_input + '<i class="arr down"></i>');


                    this.close();
                    this.saved = true;

                    $('.bbc-shipping').each(function(index, item) {
                        var sellerId = $(this).attr('data-id');
                        var data = {
                            seller_id: sellerId,
                            area: lastSel,
                            payment: payment
                        };
//                        $.post('/wap/cart-shipping.html', data, function(re) {
//                            $(item).html(re);
//                        });
                    });
                },
                close: function() {
                    $('#J_pay_list').addClass('hide');
                    $('#J_sel_pay').removeClass('hide');
                },
                saved: false,
                url: ''
            }
            
            var orderSubmit = {
                open: function(){
                    this.isRealname = $("#isRealname").val();
                    this.cartlineDTOList = $("#cartlineDTOList").val();
                    this.cartlineId = $("#cartlineId").val();
                    this.shipInst = $("#shipInst").val();
                    this.invName = $("#invName").val();
                    this.invCategory = $("#invCategory").val();
                    this.shipAddressId = $("#shipAddressId").attr('addressId');
                    var invoice = $("#order_invoice ul li input[type='radio']:checked").attr('id');
                    //alert(this.cartlineDTOList);return false;
                    if(invoice == "action_invoice_company" && this.invName == ''){
                        alert('请输入发票抬头');
                        return false;
                    }else if($("#submitState").val() != 0){
                        alert("选择的商品无货，请返回购物车修改");
                        return false;
                    }else if(this.shipAddressId == "") {
                        alert("请先添加收货信息");
                        return false;
                    }else{
                        this.submit();
                    }
                },
                submit: function(){
                    $.ajax({
                        type: 'POST',
                        url: '<?=Url::to(['order/create'])?>' ,
                        data: {
                            cartlineDTOList: this.cartlineDTOList,
                            cartlineId: this.cartlineId,
                            shipInst: this.shipInst,
                            invName: this.invName,
                            invCategory: this.invCategory,
                            shipAddressId: this.shipAddressId,
                            _csrf : '<?=$_csrf?>',
                        },
                        success: function(data) {
                            var data = eval(data);
                            if(data.status == true){
                                var _isRealname = $("#isRealname").val();
                                if(_isRealname == 'false'){
                                    var url = "<?= Url::to(['order/index'])?>";
                                }else{
                                    <?php
                                        $returnUrl = Url::to(['order/index'], true);
                                        $url = Url::to(['realname/index', 'returnUrl' => $returnUrl]);
                                    ?>
                                    var url = "<?=$url?>";
                                }
                                location.href = url;
                            }else{
                                alert(data.message);
                            }
                        },
                        error: function(data){
                            alert('订单提交失败，请稍后再试');
                        },
                        dataType: 'json',
                    });
                },
                error: function(){
                    
                },
                success: function(){
                    
                },
                isRealname: '',
                cartlineDTOList: '',
                cartlineId: '',
                shipInst: '',
                invName: '',
                invCategory: '',
                shipAddressId: '',
            }

//            if ('Array') {
//                var step1_item = $('#J_address_list .act');
//                step1.save(step1_item.html(), step1_item.attr('value'));
//            }

            $('#submitButton').bind('click', function(e){
                orderSubmit.open();
            });
            
            $('#J_address_list .address-item').bind('click', function(e) {
                step1.save($(this).html(), $(this).attr('addressId'), $(this).attr('country_code'), $(this).attr('state_code'));
            });
            
            $('#J_sel_address').bind('click', function(e) {
                step1.open();
                $('.address-btn').css('display', 'block');
            });
            /*$('#J_sel_pay').bind('click', function(e) {
//                step2.open('/wap/cart-payment_change.html', 'shipping=' + encodeURIComponent($('#J_sel_shipping input[name="shipping"]').val()));
            });
            $('#J_sel_pre').bind('click', function(e) {
                $('#J_pre_info').toggleClass('hide');
                $(this).find('.pre-list').toggleClass('hide');
            });
            $(document).bind('change', function(e) {
                var el = $(e.target);
                var value = el.val();
                var sellerId = el.parents('.bbc-shipping').attr('data-id');
                shipping(el, value, sellerId);
            });
*/
            

            
            
            $('.J_point_dis').bind('click', function(e) {
                new Dialog('#point_dis', {
                    title: '积分抵扣'
                });
            });
            $('.J_coupon').bind('click', function(e) {
                new Dialog('#usecoupon', {
                    title: '使用优惠券'
                })
            });
           
           
           
          
            //发票信息
            var fold = $('.fold').clone();
            $('.fold').remove();
            $('input[name="payment[tax_type]"]').bind('change', function(e) {
                need = $('input[name="payment[is_tax]"]');
                if ($(this).val() == 'false') {
                    var ul = $(this).parents('ul');
                    $(ul[0]).siblings('.fold').remove();
                } else {
                    need.val('true');
                    var ul = $(this).parents('ul');
                    $(ul[0]).after(fold.show());
                }
               
            });

            $('a[rel="_request"]').on('click', function() {
                $('button[rel=_request]')[0].click();
                return false;
            });

        })(document);

    </script>
