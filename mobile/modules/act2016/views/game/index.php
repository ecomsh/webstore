<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta http-equiv="pragma" content="no-cache">  
        <meta http-equiv="cache-control" content="no-cache">  
        <meta http-equiv="expires" content="0">
        <title>微信摇一摇</title>
        <script type="text/javascript" src="http://tajs.qq.com/stats?sId=37342703" charset="UTF-8"></script>
        <link rel="stylesheet" href="http://img.ftzmall.com/shake/css/frozen.css">
        <link rel="stylesheet" href="http://img.ftzmall.com/shake/demo/demo.css">
        <link rel="stylesheet" href="http://img.ftzmall.com/shake/demo/common.css">
        <script src="http://img.ftzmall.com/shake/lib/zepto.min.js"></script>
        <script src="http://img.ftzmall.com/shake/js/frozen.js"></script>
    </head>

    <body ontouchstart="" class="make-bg">
        <section class="ui-container">
            <section id="grid" class="con-p">
                <div class="demo-block">
                    <section class="ui-placehold-img">
                        <span class="wave-tp"><img src="http://img.ftzmall.com/shake/img/wave/yyy.png" style="height:auto;"/></span>
                    </section>
                    <section class="ui-placehold-img">
                        <span class="wave-y"><img src="http://img.ftzmall.com/shake/img/wave/sjy.png" style="height:auto;"/></span>
                    </section>
                    <div class="ui-flex ui-flex-pack-center ui-flex-align-center wav-p boder-n">
                        <div class="wav-no">您还可以摇<i>0</i>次</div>
                    </div>
                    <section class="ui-input-wrap ser-win">
                        <div class="ui-input ui-border-radius input-bg">
                            <input class="input-color" type="text" name="order_id" value="" placeholder="输入有效订单号获摇奖资格">
                        </div>
                        <button class="ui-btn btn-bg boder-n action-order">提交</button>
                    </section>
                    <p class="wav-opp">再有<i>0</i>个好友注册，就可再获1次摇奖机会哦！</p>
                    <div class="ui-flex ui-flex-pack-center ui-flex-align-center boder-n btn-h">
                        <button class="ui-btn ui-btn-danger btn-bg1 share">
                            立即分享
                        </button>
                    </div>
                    <div class="receive-bg">
                        <p class="wav-opp">您有<span>0</span>个中奖商品尚未领取，点击 </p>
                        <div class="ui-flex ui-flex-pack-center ui-flex-align-center boder-n btn-h">
                            <button class="ui-btn ui-btn-danger btn-bg1 action-address">
                                立即领取
                            </button>
                        </div>
                    </div>
                    <h4 class="dire-tittle">摇一摇活动说明</h4>
                    <p class="dire-con">
                        1、每位用户可无条件参与3次摇奖，未注册用户需快速注册方可获得微信红包或者领取奖品。<br>
                        2、由于实物奖品均属于海关监管的保税商品，点击领取后请立刻维护收货地址便于海关申报放行通关。<br>
                        3、3次摇奖机会使用完后，可通过输入12月3日-12日之间在ftzmall.com购买成功的订单号获得1次摇奖机会。<br>
                        4、分享推荐3位好友注册即可获得1次摇奖机会。<br>
                        5、本次活动最终解释权归上海外高桥进口商品网所有。
                    </p>
                </div>
            </section>
        </section><!-- /.ui-container-->

        <div class="ui-dialog hidden">
            <div class="ui-dialog-cnt pop-bg hidden" id="lose">
                <header class="ui-dialog-hd title-h">
                    <i class="ui-dialog-close" data-role="button"></i>
                </header>
                <div class="ui-dialog-bd">
                    <h4 class="title-color"></h4>
                    <div class="wv-tp"><img src="http://img.ftzmall.com/shake/img/wave/pop-tp1.png"></div>
                    <div class="title-infor"></div>
                </div>
                <div class="ui-btn-wrap">
                    <button class="ui-btn-lg ui-btn-danger btn-color action-close">确定</button>
                </div>
            </div>        

            <div class="ui-dialog-cnt pop-bg" id="login">
                <div class="ui-dialog-cnt pop-bg">
                    <header class="ui-dialog-hd title-h">
                        <i class="ui-dialog-close" data-role="button"></i>
                    </header>
                    <div class="ui-dialog-bd">
                        <div class="wv-tp"><img src="http://img.ftzmall.com/shake/img/ftzmall_logo_new.png"></div>
                        <h4 class="title-color">请先登录，再摇一摇！<br/>6秒后自动跳转</h4>
                    </div>

                </div>  
            </div>



            <div class="ui-dialog-cnt pop-bg" id="win">
                <header class="ui-dialog-hd title-h">
                    <i class="ui-dialog-close" data-role="button"></i>
                </header>
                <div class="ui-dialog-bd">
                    <h4 class="title-color title-hb">恭喜你！<br>获得iphone6s一个</h4>
                    <div class="wv-tp"><img src="http://img.ftzmall.com/shake/img/wave/tp.png"></div>
                </div>
                <div class="ui-btn-wrap">
                    <button class="ui-btn-lg ui-btn-danger btn-color share">炫耀好友，一起参与吧！</button>
                </div>
            </div>

            <div class="ui-dialog-cnt pop-bg demo-block" id="address">
                <div class="demo-item">
                    <p class="demo-desc">填写收货信息</p>
                    <div class="demo-block form-m">
                        <div class="form-bg">
                            <form action="#">
                                <div class="ui-form-item ui-form-item-show form-h">
                                    <label for="#">姓&nbsp;名：</label>
                                    <input class="form-input shake-input" name="add_name" type="text" style="padding-left:5px;"/>
                                </div>
                                <div class="ui-form-item ui-form-item-show form-h">
                                    <label for="#">电&nbsp;话：</label>
                                    <input class="form-input shake-input" name="add_phone" type="text" style="padding-left:5px;"/>
                                </div>
                                <div class="ui-form-item ui-form-item-show form-h">
                                    <label for="#">地&nbsp;址：</label>
                                    <input class="form-input shake-input" name="add_address" type="text" style="padding-left:5px;"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="ui-btn-wrap">
                    <div class="ui-footer ui-btn-group">
                        <button class="ui-btn-lg ui-btn-danger btn-color action-address-save">
                            立即领取
                        </button>
                        <button class="ui-btn-lg btn-color1 action-close">
                            再摇一次
                        </button>
                    </div>
                </div>
            </div>
            <div class="ui-dialog-cnt pro-bg" id="toshare">
                <span class="pro-btn"><button class="ui-btn btn-bg boder-n action-close">确定</button><span>
                    </span></span></div>
        </div>


        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script>
            var is_shake_ready = false; //摇一摇是否准备就绪
            var init_url = '/act2016/game/initialize.html';
            var shake_url = '/act2016/game/userdraw.html';
            var order_url = '/act2016/game/order.html';
            var user_id = '<?php echo $userId; ?>';
            var refer_openid = '<?php echo $referOpenId; ?>';
            var invate_url = '/act2016/game/invitefriend.html?refer_openid=' + refer_openid;
            var login_url = "/passport/login.html";
            var address_init_url = "/act2016/game/address.html";
            var address_save_url = "/act2016/game/addressup.html";
            var open_id = '<?php echo $openId; ?>';
            var logo_url = "http://img.ftzmall.com/shake/img/ftzmall_logo_new.png";
            var share_title1 = '我在FTZMALL上摇到'
            var share_title2 = '，你也来试试吧！';
            var award_name = '一台iphone6s';



            $('.ui-list li,.ui-tiled li').click(function () {
                if ($(this).data('href')) {
                    location.href = $(this).data('href');
                }
            });

            $('.ui-header .ui-btn').click(function () {
                location.href = 'index.html';
            });

            var SHAKE_THRESHOLD = 3000;
            var last_update = 0;
            var x = y = z = last_x = last_y = last_z = 0;

            function init() {
                if (!user_id) {
                    dialog('login');

                    setTimeout(function () {
                        window.location.href = login_url;
                    }, 6000);

                    return;
                }
                if (window.DeviceMotionEvent) {
                    window.addEventListener('devicemotion', deviceMotionHandler, false);
                } else {
                    is_shake_ready = false;
                    alert('设备部支持摇一摇！换一个吧！');
                    return false;
                }
                call_init_api();
                is_shake_ready = true;
                if (refer_openid) {
                    $.get(invate_url, {t: Math.round(new Date().getTime() / 1000)}, function (ret) {
                    });
                }

                wxinit();
            }

            function call_init_api() {
                $.get(init_url, {t: Math.round(new Date().getTime() / 1000)}, function (ret) {
                    if (ret) {
                        $('.wav-no i').html(ret.draw_count);
                        $('p.wav-opp i').html(ret.again_invite);

                        if (ret.no_receive) {
                            $('p.wav-opp span').html(ret.no_receive);
                        }
                        else {
                            $('button.action-address').attr('disabled', 'disabled');
                        }
//                        open_id = ret.open_id;

                    }
                }, 'json');
            }

            function deviceMotionHandler(eventData) {
                var acceleration = eventData.accelerationIncludingGravity;
                var curTime = new Date().getTime();
                if ((curTime - last_update) > 100) {
                    var diffTime = curTime - last_update;
                    last_update = curTime;
                    x = acceleration.x;
                    y = acceleration.y;
                    z = acceleration.z;
                    var speed = Math.abs(x + y + z - last_x - last_y - last_z) / diffTime * 10000;

                    if (speed > SHAKE_THRESHOLD) {
                        if (is_shake_ready) {
                            shake();
                        }
                    }
                    last_x = x;
                    last_y = y;
                    last_z = z;
                }
            }

            function shake() {
                is_shake_ready = false;
                $.get(shake_url, {t: Math.round(new Date().getTime() / 1000)}, function (ret) {
                    if (ret) {
                        if (ret.is_winning === 'error') {
                            dialog('lose');
                            $('div.ui-dialog .title-infor').html('赶紧试试输入订单号或分享3个好友注册获得摇奖机会吧');
                            $('div.ui-dialog .title-color').html('您的摇奖机会已用完！');
                        }
                        else if (ret.is_winning === 1) {
                            dialog('win');
                            $('div.ui-dialog div#win img').attr('src', ret.award_data.award_pic_url_s).show();
                            $('div.ui-dialog div#win h4.title-hb').html('恭喜你！<br>获得' + ret.award_data.award_name + '一个');
                            award_name = ret.award_data.award_name;
                            wxinit();
                            call_init_api();
                        }
                        else if (ret.is_winning === 0) {
                            dialog('lose');
                            $('div.ui-dialog .title-infor').html('');
                            $('div.ui-dialog .title-color').html('很遗憾，再摇一次吧！');
                        }
                        $('.wav-no i').html(ret.draw_count);
                    }
                    else {
                        alert('出错了！');
                    }
                    
                }, 'json');
            }

            function dialog(id) {
                $('div.ui-dialog').addClass('show').removeClass('hidden');
                $('div.ui-dialog div#lose').hide();
                $('div.ui-dialog div#win').hide();
                $('div.ui-dialog div#address').hide();
                $('div.ui-dialog div#toshare').hide();
                $('div.ui-dialog div#login').hide();
                $('div.ui-dialog div#' + id).show();
            }

            function close_dialog() {
                is_shake_ready = true;
                $('div.ui-dialog').addClass('hidden').removeClass('show');
            }

            function close_div(id)
            {
                $(id).hide();
            }


            $('.wav-no i').click(function () {
                shake();
            });

            $('div.ui-dialog .action-close').click(function () {
                close_dialog();
            });

            $('button.action-address-save').click(function () {
                var add_name = $('input[name=add_name]').val();
                var add_phone = $('input[name=add_phone]').val();
                var add_address = $('input[name=add_address]').val();

                //手机号验证
                if (!add_phone.match(/1\d{10}$/)) {
                    alert('请填写正确的手机号');
                    return false;
                }

                var address_data = {add_name: add_name, add_phone: add_phone, add_address: add_address};
                $.post(address_save_url, address_data, function (ret) {
                    alert(ret.msg);
                    close_dialog();
                    call_init_api();
                }, 'json');
            });

            $('button.share').click(function () {
                dialog('toshare');
            });

            $('button.action-address').click(function () {
                if ($('p.wav-opp span').html() === '0') {
                    alert('您暂时没有奖品可领取，赶快摇一摇吧！');
                    return;
                }
                dialog('address');
                $.get(address_init_url, function (ret) {
                    if (ret) {
                        $('input[name=add_name]').val(ret.add_name);
                        $('input[name=add_phone]').val(ret.add_phone);
                        $('input[name=add_address]').val(ret.add_address);
                        $('button.action-address-save').html('修改信息');
                    }
                }, 'json');
            });

            $('button.action-order').click(function () {
                var self = $(this);
                var order_id = $('input[name=order_id]').val();
                if (order_id) {
                    self.attr('disabled', 'disabled');
                    $.get(order_url, {orderId: order_id}, function (ret) {
                        dialog('win');
                        $('div.ui-dialog div#win img').hide();
                        $('div.ui-dialog div#win h4.title-hb').html(ret.msg?ret.msg:'订单不存在');
                        if (ret.draw_count) {
                            $('.wav-no i').html(ret.draw_count);
                            if ('成功领取' === ret.msg) {
                                $('input[name=order_id]').val('');                                
                            }
                        }
                        self.removeAttr('disabled');
                    }, 'json');
                }

            });

            $('.ui-dialog-close').click(function () {
                close_dialog();
            });

            init();

            wx.config({
                debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                appId: '<?php echo $appId; ?>', // 必填，公众号的唯一标识
                timestamp: '<?php echo $timestamp; ?>', // 必填，生成签名的时间戳
                nonceStr: '<?php echo $nonceStr; ?>', // 必填，生成签名的随机串
                signature: '<?php echo $signature; ?>', // 必填，签名，见附录1
                jsApiList: ['onMenuShareTimeline'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            });

            function wxinit() {
                wx.ready(function () {
                    wx.onMenuShareTimeline({
                        title: share_title1 + award_name + share_title2, // 分享标题
                        link: '<?php echo $surl; ?>' + '?open_id=' + open_id, // 分享链接
                        imgUrl: '', // 分享图标
                        success: function () {
//                        $.get( '/member-share_analysis-1.html');
                            // 用户确认分享后执行的回调函数
                        },
                        cancel: function () {
//                        $.get('/member-share_analysis-2.html');
                            // 用户取消分享后执行的回调函数
                        }
                    });
                });
            }



        </script>




    </body></html>