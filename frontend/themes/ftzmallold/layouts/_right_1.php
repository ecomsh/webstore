<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="right_bar">
    <ul class="right_bar_ul1">
        <li class="rbli"></li>
        <li id="right_bar_show_account" class="rbli1" onmousemove="rightAction(this, 'rbli1_over', 'rbli1', '<?=Yii::$app->params['baseimgUrl']?>index_left_03.png')" onmouseout="rightAction(this, 'rbli1', 'rbli1_over', '<?=Yii::$app->params['baseimgUrl']?>index_left2_03.png')">
            <img id="ac" src="<?=Yii::$app->params['baseimgUrl']?>index_left2_03.png" height="18" width="19">
            <p class="right_bar_p">账号</p>

        </li>
        <li class="rbli"></li>
        <li class="rbli1" onmousemove="rightAction(this, 'rbli1_over', 'rbli1', '<?=Yii::$app->params['baseimgUrl']?>index_left_07.png')" onmouseout="rightAction(this, 'rbli1', 'rbli1_over', '<?=Yii::$app->params['baseimgUrl']?>index_left2_06.png')">
            <img src="<?=Yii::$app->params['baseimgUrl']?>index_left2_06.png" height="16" width="21">
            <p class="right_bar_p">券</p>
            <div style="display:none;">
            </div>
        </li>
        <li class="rbli"></li>
        <li class="rbli1" onmousemove="rightAction(this, 'rbli1_over', 'rbli1', '<?=Yii::$app->params['baseimgUrl']?>index_left_11.png')" onmouseout="rightAction(this, 'rbli1', 'rbli1_over', '<?=Yii::$app->params['baseimgUrl']?>index_left2_09.png')">
            <img src="<?=Yii::$app->params['baseimgUrl']?>index_left2_09.png" height="17" width="21">
            <p class="right_bar_p">商品</p>
            <div style="display:none;">
            </div>
        </li>
        <li class="rbli"></li>
        <li id="right_bar_show_cart" class="rbli2" onmousemove="rightAction(this, 'rbli2_over', 'rbli2', '<?=Yii::$app->params['baseimgUrl']?>index_left_14.png');" onmouseout="rightAction(this, 'rbli2', 'rbli2_over', '<?=Yii::$app->params['baseimgUrl']?>index_left2_15.png')">    
            <img id="right_bar_show_cart_bottom_img" src="<?=Yii::$app->params['baseimgUrl']?>index_left2_15.png" height="20" width="19">
            <p class="right_bar_p">购<br>物<br>车</p>

            <div id="right_cart_number_divid" class="circle_cart_box">       
			<script>
                var _prefix_number = ""; //获取购物车里物品的数量（貌似存在cookie里的！）
                var _subfix_number = "</span>";
                _prefix_number = '<span id="cart_num2" >';
                document.write(typeof (Cookie) == 'undefined' ? (_prefix_number + '0' + _subfix_number) : _prefix_number + (Cookie.read('S[CART_NUMBER]') ? Cookie.read('S[CART_NUMBER]') : '0') + _subfix_number);
                </script>
            </div>

        </li>
        <li class="rbli"></li>
        <li id="right_bar_show_weixin" class="rbli1" onmousemove="rightAction(this, 'rbli1_over', 'rbli1', '<?=Yii::$app->params['baseimgUrl']?>right_bar_over_weixin_pic.png')" onmouseout="rightAction(this, 'rbli1', 'rbli1_over', '<?=Yii::$app->params['baseimgUrl']?>right_bar_over_weixin.png')">
            <img src="<?=Yii::$app->params['baseimgUrl']?>right_bar_over_weixin.png" height="25" width="24">
            <div id="right_bar_show_weixin_all" style="display:none;">
                <table bgcolor="#CCCCCC" border="0" cellpadding="0" cellspacing="1" height="220" width="190">
                    <!--
                    <tr>
                        <td height="25" align="right"><a href="javascript:$('right_bar_show_weixin_all').setStyle('display','none')"><font color="red" size="5">&times;</font></a></td>
                        
                    </tr>
                    -->
                    <tbody><tr bgcolor="#FFFFFF">
                            <td>
                                <img src="<?=Yii::$app->params['baseimgUrl']?>index_footer_03.jpg" height="120" width="120">
                                <p>扫一扫 关注我们</p>
                            </td>
                        </tr>
                    </tbody></table>
            </div>
        </li>
    </ul>
    <div id="right_cart_detail_id" class="right_cart_detail" style="display:none"></div>
    <div id="right_bar_user_info" style="display:none"></div>
</div>

<script>
    /*
     $('catalog_main').addEvents({
     mouseenter:function(){
     this.addClass('active');
     },mouseleave:function(){
     this.removeClass('active');
     }
     });
     */

    $$('.tool_arrow_t').addEvents({mouseover: function() {
            $$('.tool_arrow_t .tool_arrow_dis').setStyle('display', 'block');
        }, mouseout: function() {
            $$('.tool_arrow_t .tool_arrow_dis').setStyle('display', 'none');
        }
    });
    //right_bar_show_weixin_all 显示微信
    $('right_bar_show_weixin').addEvents({click: function() {
            if ($('right_bar_show_weixin_all').getStyle('display') == 'block')
                $('right_bar_show_weixin_all').setStyle('display', 'none');
            else
                $('right_bar_show_weixin_all').setStyle('display', 'block');
        },
    });
    //右边栏鼠标放上去效果
    function rightAction(o, newClass, oldClass, newImg)
    {
        o.removeClass(oldClass);
        o.addClass(newClass);
        o.getElements('img')[0].setProperty('src', newImg);
        if (newClass == 'rbli2')
        {
            $('right_cart_number_divid').removeClass('circle_cart_box_over');
            $('right_cart_number_divid').addClass('circle_cart_box');
            //$('right_cart_detail_id').setStyle('display','none');

        }
        else if (newClass == 'rbli2_over')
        {
            $('right_cart_number_divid').removeClass('circle_cart_box');
            $('right_cart_number_divid').addClass('circle_cart_box_over');
            //$('right_cart_detail_id').setStyle('display','block');

        }

    }

    $('right_bar_show_cart').addEvent('click', function(e) {
        if ($('right_cart_detail_id').getStyle('display') == 'none')
            $('right_cart_detail_id').setStyle('display', 'inline');
        else
            $('right_cart_detail_id').setStyle('display', 'none');
			var req = new Request({url: "<?=Yii::$app->params['baseimgUrl']?>cart-showAjaxMiniCart.html", //获取购物车内容,这个页面没js，我也不知道怎么调用的...
			method: 'get',
            evalScripts: true,
            onSuccess: function(responseText) {
                $('right_cart_detail_id').set('HTML', responseText);
            },
            //Our request will most likely succeed, but just in case, we'll add an
            //onFailure method which will let the user know what happened.
            onFailure: function() {
                $('right_cart_detail_id').set('text', 'The request failed.');
            }
        }).send();
    });
    $('right_bar_show_account').addEvent('click', function(e) {
        if ($('right_bar_user_info').getStyle('display') == 'none')
            $('right_bar_user_info').setStyle('display', 'inline');
        else
            $('right_bar_user_info').setStyle('display', 'none');
        var e = Cookie.read('UNAME') ? Cookie.read('UNAME') : '';
        if (!e) //登录前的状态
        {
            $('right_bar_user_info').setHTML(' <div class="right_cart_show_box_close" onclick="$(\'right_bar_user_info\').setStyle(\'display\',\'none\')">&times;</div><img src="<?=Yii::$app->params['baseUrl']?>themes/ftzmallold/images/right_bar_account_03.jpg" width="67" height="65" /><p class="userp">您好！ 请 <a href="<?=Yii::$app->params['baseUrl']?>login.html"><span style="color:#ff4b00">登录</span></a> | <a href="<?=Yii::$app->params['baseUrl']?>/register.html"><span style="color:#ff4b00">注册</span></a> </p><ul><li class="right_bar_account_order"><a href="member-orders.html"><img src="<?=Yii::$app->params['baseUrl']?>themes/ftzmallold/images/right_bar_account_11.png" width="23" height="30" /></a><p><a href="<?=Yii::$app->params['baseUrl']?>user-orders.html">我的订单</a></p></li><li class="right_bar_account_separator"><div class="right_bar_account_line"></div></li><li class="right_bar_account_mail"><div class="right_bar_mail_number" style="display:none"><p></p></div><a href="<?=Yii::$app->params['baseUrl']?>msg.html"><img style="margin:25px 0 0 0;" src="<?=Yii::$app->params['baseUrl']?>themes/ftzmallold/images/right_bar_account_14.png" width="29" height="21" /></a><p><a href="<?=Yii::$app->params['baseUrl']?>msg.html">我的消息</a></p></li></ul>');
            return;
        }
        var req = new Request({url: "<?=Yii::$app->params['baseimgUrl']?>member-getRightBarAccountInfo.html", //获取的登录后的状态
            method: 'get',
            evalScripts: true,
            onSuccess: function(responseText) {
                $('right_bar_user_info').set('HTML', responseText);
            },
            //Our request will most likely succeed, but just in case, we'll add an
            //onFailure method which will let the user know what happened.
            onFailure: function() {
                $('right_bar_user_info').set('text', 'Failure');
            }
        }).send();
    });
</script>