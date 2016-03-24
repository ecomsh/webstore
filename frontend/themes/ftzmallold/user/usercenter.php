<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '会员中心_上海外高桥进口商品网';
?>

<!-- right-->
<div class="sell_ri ri_zhi" style="width: 960px;">
    <!--     <div class="member_center_nav">当前位置：<a href="#">首页</a> > <a href="#" class="current">会员中心</a></div> -->
    <div class="sell_ri_top">
        <div class="sell_ri_top_le le_zhi">
            <span class="mall_buy_p_mob_span">账户安全：</span>
            <p class="mall_buy_safe_2"></p>
            <!-- 			<p class="mem_yanicon mem_yanicon_no"><a href="<?= Yii::$app->params['baseUrl'] ?>user-setting.html">手机未验证</a></p>
            -->
            <p class="mem_yanicon mem_yanicon_yes">邮箱已验证</p>
            <!--p class="mall_buy_p_mob_3">已设置支付密码</p-->
        </div>
        <div class="member_ri_top_ri ri_zhi" style="width: 695px;">
            <div class="order_info">
                <div class="order_info_le le_zhi">
                    <p class="tit_p">
                        <span>cbt_143399151492</span>，欢迎您！                           <font class="price-normal_1 price-normal">[品牌粉]</font>
                         <!--您目前经验值为0，再获得经验值12000可升级为<span class="price-normal">[品牌控]</span>-->
                    </p>
                    <ul>
                        <li>订单提醒：
                            <span>
                                待付款（0）
                            </span>
                            <span>
                                待确认（0）
                            </span>
                            <span>
                                待评价（0）
                            </span>

                            <span>
                                待晒单（0）
                            </span>
                        </li>

                        <li>
                            我的关注：
                            <span>
                                降价商品（0）
                            </span>
                            <span>
                                促销商品（0）
                            </span>
                        </li>

                        <li class="none">
                            我的消息：
                            <span>
                                我的通知（0）
                            </span>
                            <span class="red">
                                <a href="<?= Yii::$app->params['baseUrl'] ?>user-orders.html">我的提醒（1）</a>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="memberindex_money ri_zhi" style="width: 248px;">
                    <ul>
                        <li><b>账户余额：</b><span class="red">￥0.00</span></li>
                        <li><b>我的积分：</b>0分</li>
                        <li><b>优惠券：</b>0张</li>
                    </ul>
                </div>
                <div class="cl_zhi"></div>
            </div>
        </div>
        <div class="cl_zhi"></div>
    </div>
    <!--订单-待评价-待付款开始-->
    <div class="Plate" id="all_orders">
        <h4>
            <a href="javascript:void(0);" id="all" onclick="tosearch(this.id)" class="current">我的订单</a>
            <a href="javascript:void(0);" search_type="type" id="comment" onclick="tosearch(this.id)" class="">待评价的商品</a>
            <a href="javascript:void(0);" id="nopayed" onclick="tosearch(this.id)" class="">待付款</a>
            <a href="javascript:void(0);" id="confirm" onclick="tosearch(this.id)" class="">待确认收货</a>
            <a href="javascript:void(0);" id="notify" onclick="tosearch(this.id)" class="">到货通知</a>
        </h4>
        <!-- <form action="<?= Yii::$app->params['baseUrl'] ?>member.html" method="post" id="frm">
           <input autocomplete="off" class="x-input " type="hidden" name="type" value="" id="dom_el_088b8a0" />                   </form>-->
        <div class="Plate_info" id="my_order"><pre></pre></div>
    </div>
    <!--订单-待评价-待付款结束-->
    	 <!--关注的商品-->
               <div class="Plate">
			   <h4 class="dis_bl"><div class="p_tit"><span>您关注的商品</span></div></h4>
			    <div class="Drying_single Plate_info" id="Plate_info">
                                       <li style="visibility: visible;" class="none toleft">
                           <a class="clo_ds_le"></a>
                       </li>

                       <div class="picscroll_buy" style="float: left;width:888px;margin:0px;">
                          <div class="pics" style="width:888px;overflow:hidden;">
                                                         <div style="overflow:hidden;width:2220px;">
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1418.html">
                                       <img src="css/f9c1a6ad13484b61272de72e0645a821ca1.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1418.html">澳大利亚 美味坚果牌腰果（加拿大枫木味）150g</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥44.10</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1409.html">
                                       <img src="css/35b23f8e4d9801b2f98a49695d9eed2fbca.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1409.html">马来西亚 BIKA香脆鱿鱼酥 70g</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥5.50</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1416.html">
                                       <img src="css/6e5498aedfe62627890abe31bd3a039f35c.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1416.html">澳大利亚 美味坚果牌腰果（泰国甜椒味） 150g</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥44.10</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1366.html">
                                       <img src="css/be98ff96068f65419ed5a5e720b4f1124ff.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1366.html">东园 蜂蜜腰果 150克</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥27.90</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1434.html">
                                       <img src="css/59dd05b4bb376354f63afcd2e27c6d99f1a.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1434.html">泰国 虾味条（辣味） 110g</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥17.90</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1429.html">
                                       <img src="css/2e424205719b05ee911d1c75ec506dd2e74.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1429.html">马来西亚 杰克薯片原味 75g</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥8.70</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1444.html">
                                       <img src="css/25b7622fb9619899601a65af1a2132af3ac.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1444.html">中国台湾 金兰皇家松露低盐固态发酵酱油（酿造酱油） 500ml/瓶</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥88.00</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1445.html">
                                       <img src="css/f612124579c539de5b49101491a0e6aebe6.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1445.html">俄罗斯 美味鲷鱼刺身 150±10g/盒</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥28.00</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1446.html">
                                       <img src="css/4376ccb1c2e87c34f7e155d52d4985ff517.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1446.html">刺身优惠一 三文鱼组合 500±15g/3盒</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥128.00</span></div>
                                  </li>
                                                                 <li>
                                       <a href="<?= Yii::$app->params['baseUrl'] ?>product-1447.html">
                                       <img src="css/3d00e13fae1a7cdc7ffc632a8832241a750.jpg">
                                        </a>
                                     
                                      <p><a href="<?= Yii::$app->params['baseUrl'] ?>product-1447.html">加拿大 超大北极贝 100±5g/盒</a></p>
                                      <div class="price-wrap"><span class="font-red font14px fontbold">￥48.00</span></div>
                                  </li>
                                                              </div>
                           </div>
                       </div>

                        <li style="visibility: visible;" class="none toright">
                            <a class="clo_ds_ri"></a>
                        </li>
                       <div class="cl_zhi"></div>
                    </div>
             	</div>
			 <!--关注的商品-->		 
         
    <script>
        window.addEvent('domready', function() {
            var picscroll = $E('#Plate_info .picscroll_buy');
            var scrollARROW = $E('#Plate_info').getElements('.none');
            if ($E('.pics', picscroll)) {
                var picsContainer = $E('.pics', picscroll).scrollTo(0, 0);
                if (picsContainer.getSize().x < picsContainer.getScrollSize().x) {
                    scrollARROW.setStyle('visibility', 'visible').addEvent('click', function() {
                        var scrollArrow = this;
                        var to = eval("picsContainer.scrollLeft" + (scrollArrow.hasClass('toleft') ? "-" : "+") + "picsContainer.offsetWidth");
                        picsContainer.retrieve('fxscroll', new Fx.Scroll(picsContainer, {'link': 'cancel'})).start(to);
                    });

                }
                ;
            }
        })

        /*小图mouseenter效果*/
        window.addEvent('domready', function() {
            $('all').addClass('current');
            tosearch('all');
        });
        var sale = new Switchable('sale-active', {
            'autoplay': true,
            'effect': 'scrolly',
            'duration': 500,
            'interval': 4000,
            'hasTriggers': false
        })

        function cancel(order_id) {
            Ex_Dialog.confirm('确定要取消该订单吗？', function(e) {
                if (!e)
                    return;
                new Request.JSON({
                    url: "/busorder-docancel.html",
                    data: 'order_id=' + order_id,
                    method: 'POST',
                    onSuccess: function(rs) {

                        Ex_Dialog.alert(rs);

                        window.location.reload();
                    }
                }).send();
            });

        }

        function remind(order_id) {
            Ex_Dialog.confirm('卖家将会收到发货提醒，确定发送提醒吗？', function(e) {
                if (!e)
                    return;
                new Request.JSON({
                    url: "/busorder-remind.html",
                    data: 'order_id=' + order_id,
                    method: 'POST',
                    onSuccess: function(rs) {

                        Ex_Dialog.alert(rs);

                        window.location.reload();
                    }
                }).send();
            });

        }

        function tosearch(id) {
            $(id).addClass('current');

            if (id == 'all')
            {
                $('comment').removeClass('current');
                $('nopayed').removeClass('current');
                $('confirm').removeClass('current');
                $('notify').removeClass('current');
            }
            if (id == 'comment')
            {
                $('all').removeClass('current');
                $('nopayed').removeClass('current');
                $('confirm').removeClass('current');
                $('notify').removeClass('current');
            }
            if (id == 'nopayed')
            {
                $('all').removeClass('current');
                $('comment').removeClass('current');
                $('confirm').removeClass('current');
                $('notify').removeClass('current');
            }
            if (id == 'confirm')
            {
                $('all').removeClass('current');
                $('comment').removeClass('current');
                $('notify').removeClass('current');
                $('nopayed').removeClass('current');
            }
            if (id == 'notify')
            {
                $('all').removeClass('current');
                $('comment').removeClass('current');
                $('confirm').removeClass('current');
                $('nopayed').removeClass('current');
            }

            new Request.HTML({
                url: '<?= Yii::$app->params['baseUrl'] ?>member-orders_member.html',
                update: $('my_order'),
                method: 'POST',
                data: 'type=' + encodeURIComponent(id),
                onComplete: function(res) {
                    $('my_order').show();
                }
            }).send();
        }

    </script>
    <!-- right-->
</div>