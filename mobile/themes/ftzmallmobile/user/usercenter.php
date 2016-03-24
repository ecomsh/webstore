<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Menu;

/* @var $this yii\web\View */
$this->title = '会员中心_上海外高桥进口商品网';
?>

    <?php
//require_once "../../common/helpers/Wechatjssdk.php";
//$jssdk = new JSSDK("wx77be89a71184009b", "12cf3d2cbd1ba9696bde81a724c95376");
//$signPackage = $jssdk->GetSignPackage(); 
?>

        <div class="m-page" style="min-height: 545px;">
            <div class="top-holder">
                <div class="fixed-top">
                    <div class="m-header">
                        <div class="header-left-btn">
                            <span onclick="history.back()" class="icon-back"></span>
                        </div>
                        <h2>会员中心</h2>
                        <div class="header-right-btn">
                            <a href="<?=Url::to(['user/index'])?>" class="icon-home"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="full-screen">
                <div class="mem-info c-fix">
                    <div class="mem-base c-fix">
                        <div class="fix-f">
                            <!-- <div class="d-line c-fix">
                                <div class="mem-name">
                                    <?= $mobile ?>
                                </div>
                            </div> -->
                            <div class="card">点击查看我的二维码(背景图会设计)</div>
                            <!-- <div class="mem-level" style="">
                                <span class="member-point">
                                积分&nbsp;:&nbsp;0                       
                        </span>
                                <span class="user-lv">金牌会员</span>
                            </div> -->
                            <!-- <span>点击图片查看二维码</span> -->
                            <div class="two-dimension-code" id="two-dimension-code" style="display:none;">
                                <!--二维码-->
                                <img src="<?= yii::$app->params['localimgUrl']?>two-dimension.png">
                            </div>
                        </div>
                        <!-- <div class="member-nav">
                            <a href="#">
                        <img src="<?= yii::$app->params['localimgUrl']?>icon-member-nav1.png">
                    </a>
                            <a href="#">
                        <img src="<?= yii::$app->params['localimgUrl']?>icon-member-nav2.png">
                    </a>
                            <a href="#">
                        <img src="<?= yii::$app->params['localimgUrl']?>icon-member-nav3.png">
                    </a>
                        </div> -->
                    </div>



                    <ul class="member-list">
                        <li><a href="<?=Url::to(['order/index'])?>">我的订单</a></li>
                        <li><a href="<?=Url::to(['cart/index'])?>">我的购物车</a></li>
<!--                        <li id="scanQRCode0"><a href="javascript:void(0);">扫一扫</a></li>-->
                        <li><a href="<?=Url::to(['address/index'])?>">地址管理</a></li>
                        <li><a href="<?=Url::to(['passport/changepassword'])?>">修改密码</a></li>
                        <li><a href="<?=Url::to(['realname/index'])?>">实名认证</a></li>
                        <li class="js_tel"><a href="javascript:void(0);">致电客服</a></li>
                    </ul>




                    <?php
//                        echo Menu::widget(Yii::$app->params['userMenu']);
                    ?>
                </div>
            </div>
            <div class="tel-wrap">
                <div class="tel-fixed">
                    <ul class="tel-list">
                        <li>
                            <a href="tel:4008-888-888">4008-888-888</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" class="tel-close">取消</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?= Yii::$app->request->baseUrl ?>/mobile/js/alert.js"></script>
        <script type="text/javascript">
            $(function(){
                $(".card").click(function(){
                    showDiv("two-dimension-code");
                })
            })
        </script>
       <?php /*
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script>
            // 完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
            wx.config({
                debug: false,
                appId: '<?php echo $signPackage["appId"];?>',
                timestamp: <?php echo $signPackage["timestamp"];?>,
                nonceStr: '<?php echo $signPackage["nonceStr"];?>',
                signature: '<?php echo $signPackage["signature"];?>',
                jsApiList: [
                    // 所有要调用的 API 都要加到这个列表中
                    'checkJsApi',
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'chooseWXPay',
                    'scanQRCode'
                ]
            });
            wx.ready(function() {
                // 在这里调用 API
                // 9 微信原生接口
                // 9.1.1 扫描二维码并返回结果
                document.querySelector('#scanQRCode0').onclick = function() {
                    wx.scanQRCode({
                        desc: 'scanQRCode desc'
                    });
                };
                // 9.1.2 扫描二维码并返回结果
                                document.querySelector('#scanQRCode0').onclick = function() {
                                    wx.scanQRCode({
                                        needResult: 1,
                                        desc: 'scanQRCode desc',
                                        success: function(res) {
                                            alert(JSON.stringify(res));
                                        }
                                    });
                                };
                // 10 微信支付接口
                // 10.1 发起一个支付请求
                document.querySelector('#chooseWXPay').onclick = function() {
                    wx.chooseWXPay({
                        timestamp: <?php echo $signPackage["timestamp"];?>,
                        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
                        package: 'addition=action_id%3dgaby1234%26limit_pay%3d&bank_type=WX&body=innertest&fee_type=1&input_charset=GBK&notify_url=http%3A%2F%2F120.204.206.246%2Fcgi-bin%2Fmmsupport-bin%2Fnotifypay&out_trade_no=1414723227818375338&partner=1900000109&spbill_create_ip=127.0.0.1&total_fee=1&sign=432B647FE95C7BF73BCD177CEECBEF8D',
                        paySign: '<?php echo $signPackage["signature"];?>',
                        success: function(res) {
                            alert("成功");
                        }
                    });
                };
                
            });
        </script>
*/  ?>