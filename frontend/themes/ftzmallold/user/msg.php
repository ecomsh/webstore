<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '站内信_上海外高桥进口商品网';
?>

<!-- right-->
<div style="width: 960px;" class="member-main">
    <script>
        var prediv = '';
        function showMsg(obj, msgid, url) {
            var currdiv = $('view_msg_pro_' + msgid);

            if (!obj.parentNode.id) {
                if (typeof prediv == "object") {
                    prediv.style.display = 'none'
                }
                ;
                currdiv.style.display = '';
                if ($('view_msg_' + msgid))
                    new Request({
                        url: url,
                        method: 'post',
                        data: '',
                        onComplete: function(res) {
                            new Element('div', {'html': res, 'style': '*zoom:1'}).inject($('view_msg_' + msgid));
                        }
                    }).send();

                obj.parentNode.id = 'span_' + msgid;
                if (prediv) {
                    var link = $('span_' + prediv.id.substr(13)).getElementsByTagName('a')[0];
                    link.className = 'viewmsgoff';
                    toggleBg(link, false);
                }
                prediv = $('view_msg_pro_' + msgid);
                obj.className = 'viewmsg';
                toggleBg(obj, true);
            } else {
                if (currdiv.style.display == 'none') {
                    currdiv.style.display = '';
                    obj.className = 'viewmsg';
                    toggleBg(obj, true);
                    if (prediv) {
                        prediv.style.display = 'none';
                        var link = $('span_' + prediv.id.substr(13)).getElementsByTagName('a')[0];
                        link.className = 'viewmsgoff';
                        toggleBg(link, false);
                    }
                    prediv = currdiv;
                } else {
                    currdiv.style.display = 'none';
                    obj.className = 'viewmsgoff';
                    toggleBg(obj, false);
                    prediv = '';
                }
            }
        }

        function toggleBg(el, state) {
            while (el.tagName != 'TR') {
                el = el.parentNode;
            }
            if (!state)
                $(el).removeClass('msgon');
            else
                $(el).addClass('msgon');
        }

        function checkAll(obj, box) {
            var tag = obj.getElementsByTagName('input');
            for (var i = 0; i < tag.length; i++) {
                tag[i].checked = box.checked;
            }
        }
    </script>
    <div class="title title2">站内信</div>
    <div>
        <div id="tab-discus" class="section switch">
            <ul class="switchable-triggerBox tab_member clearfix">
                <li class="active"><a href="javascript:void(0);">站内信</a></li>
            </ul>
            <div class="switchable-content switchable-content2" style="width:960px">
                <div class="switchable-panel">
                    <div id="message-tab" class="switch" style="padding-top:0">
                        <div class="site-mail">
                            <ul class="switchable-triggerBox2 clearfix">
                                <li class="active"><a href="<?= Yii::$app->params['baseUrl'] ?>msg-my_msg.html">全部(1)</a></li>
                                <li><a href="<?= Yii::$app->params['baseUrl'] ?>msg-my_msg-1.html">未读(0)</a></li>
                                <li><a href="<?= Yii::$app->params['baseUrl'] ?>msg-my_msg-2.html">已读(1)</a><span></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <form action="/msg-del_in_box_msg.html" method="post" id="form_id">
                    <!--table width="100%" cellspacing="0" cellpadding="0" class="liststyle-option">
                                                    <col class="span-1 textcenter"></col>
                                                    <col class=" textleft"></col>
                        <tr>
                            <th class="textcenter"><input type="checkbox" onclick="checkAll(this.form,this)" name="chkall" id="chkall" title="全选"></th>
                            <td class="textleft">
                                <button type="submit" name="pmsend" rel="_request" class="btn"><span><span>删除</span></span></button>                                </td>
                            <td style="padding-right:10px; text-align:right">共有短消息:&nbsp;<em id="pmtotalnum" class="siteparttitle-orage">1</em></td>
                        </tr>
                    </table-->
                    <table summary="收件箱" class="gridlist   gborder-top gridlist_member2" cellpadding="0" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="first">&nbsp;</th>
                                <th width="75%">标题</th>
                                <th>时间</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td class="selector textcenter"><input value="1610" name="delete[]" type="checkbox"></td>
                                <td class="textleft">
                                    <span id="span_1610"><a href="javascript:void(0);" onclick="showMsg(this, 1610, '<?= Yii::$app->params['baseUrl'] ?>member-view_msg-1610.html');
                                                            return false;" class="viewmsgoff"><font color="blue">上海外高桥进口商品网</font></a></span></td>
                                <td align="center">15-06-11 10:58</td>

                            </tr>
                            <tr id="view_msg_pro_1610" style="white-space: normal; display: none;">
                                <td class="memberviewinfo" colspan="6"><p id="view_msg_1610" class="pt10 pb10 pl10 pr10"><div style="">欢
                                        迎加入我们 
                                        ，这里聚集着各种精品商品，在接下来相处的日子里，我们将会向您提供优质的服务和商品，在节日或者特殊的日子里我们也会向您提供各种资讯以及精美礼品，再
                                        次感谢您的加入，希望您能在这里购物愉快、分享快乐。您的用户名：cbt_143399151492，密
                                        码：xy2b890913，Email：584238961@qq.com。</div></p></td>
                            </tr>
                            <tr><td colspan="6" style="border:none; background:none; overflow:hidden">
                                    <div id="reply_1610" style="display:none;">
                                    </div>
                                </td></tr>
                        </tbody>

                    </table>
                    <table class="liststyle-option" cellpadding="0" cellspacing="0" width="100%">
                        <colgroup><col class="span-1 textcenter">
                            <col class=" textleft">

                        </colgroup><tbody><tr>
                                <th class="textcenter"><input onclick="checkAll(this.form, this)" name="chkall" id="chkall" title="全选" type="checkbox"></th>
                                <td class="textleft">
                                    <button type="submit" name="pmsend" rel="_request" class="btn"><span><span>删除</span></span></button></td>
                                <td style="padding-right:10px; text-align:right">共有短消息:&nbsp;<em id="pmtotalnum" class="siteparttitle-orage">1</em></td>
                            </tr>

                        </tbody></table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- right-->
