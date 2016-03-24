<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '投诉管理_上海外高桥进口商品网';
?>

<div style = "width: 960px;" class = "member-main">
    <div class = "title title2">投诉管理</div>
    <div class = "FormWrap" style = "background-color:#FFFFFF;">
        <form action = "/bcomplain-main.html" method = "POST">
            <table>
                <colgroup>
                    <col style = "width:88px;">
                    <col style = "width:170px;">
                    <col style = "width:88px;">
                    <col style = "width:240px;">
                    <col style = "width:88px;">
                    <col style = "width:170px;">
                </colgroup>
                <tbody>
                    <tr>
                        <td style = "text-align:right;padding:8px 0;">订单号：</td>
                        <td style = "text-align:left;padding-left:10px;"><input vtype = "text" id = "search_order_id" size = "20" name = "order_id" class = "x-input " autocomplete = "off" type = "text"> </td>
                        <td style = "text-align:right;">投诉编号：</td>
                        <td style = "text-align:left;padding-left:10px;"><input vtype = "text" id = "search_goods_name" size = "20" name = "complain_id" class = "x-input " autocomplete = "off" type = "text"> </td>
                        <td style = "text-align:right;">投诉原因：</td>
                        <td style = "text-align:left;padding-left:10px;">
                            <select class = " x-input-select inputstyle" required = "1" name = "reason" id = "ot" type = "select">
                                <option selected = "selected" value = "all">请选择</option>
                                <option value = "after">售后问题</option>
                                <option value = "action">行为违规</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style = "text-align:right;">投诉状态：</td>
                        <td style = "text-align:left;padding-left:10px;">
                            <select class = " x-input-select inputstyle" required = "1" name = "status" id = "ot" type = "select">
                                <option selected = "selected" value = "all">请选择</option>
                                <option value = "intervene">平台已经介入</option>
                                <option value = "success">投诉成立</option>
                                <option value = "error">投诉不成立</option>
                                <option value = "cancel">投诉撤销</option>
                            </select>
                        </td>
                        <td style = "text-align:right;">申请时间：</td>
                        <td style = "text-align:left;padding-left:10px;">
                            <input name = "_DTYPE_DATE[]" value = "applyTime[start]" type = "hidden"><input class = "cal cal" size = "10" maxlength = "10" autocomplete = "off" name = "applyTime[start]" id = "applyTime_start" style = "margin-right:0;padding-left:10px;width:80px;" vtype = "date" type = "text"><script>try {
                                    Ex_Loader("picker", function() {
                                        new DatePickers([$("applyTime_start")]);
                                    });
                                } catch (e) {
                                    $("applyTime_start").makeCalable();
                                }</script>     到
                            <input name="_DTYPE_DATE[]" value="applyTime[end]" type="hidden"><input class="cal cal" size="10" maxlength="10" autocomplete="off" name="applyTime[end]" id="applyTime_end" style="margin-right:0;padding-left:10px;width:80px;" vtype="date" type="text"><script>try {
                                    Ex_Loader("picker", function() {
                                        new DatePickers([$("applyTime_end")]);
                                    });
                                } catch (e) {
                                    $("applyTime_end").makeCalable();
                                }</script>     </td>
                        <td colspan="2" style="padding-left:30px;">
                            <button id="btnsearch" class="btn search1"><span><span>搜索</span></span></button>	
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div id="tab-sdiscus" class="section switch">
        <!--<ul class="switchable-triggerBox tab_member clearfix">
                    <li class="active"><a href="#">我发起的投诉</a></li>
                    <li><a href="#">我收到的投诉</a></li>
                    
                    
        </ul>-->
        <div class="switchable-content">
            <div class="switchable-panel">
                <table class="switchable gridlist gridlist_member" border="0" cellpadding="0" cellspacing="0">
                    <colgroup>
                        <col width="190px">
                        <col width="190px">
                        <col width="150px">
                        <col width="100px">
                        <col width="100px">
                        <col width="150px">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="comment first">投诉编号</th>
                            <th class="ratee">订单编号</th>
                            <th class="things">被投诉方</th>
                            <th class="things">投诉原因</th>
                            <th class="things">投诉状态</th>
                            <th class="things">申请时间</th>
                            <th class="operate">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                    <input value="1" name="complain_id" type="hidden">
                    <td valign="middle">
                        42015060211567491                      </td>
                    <td valign="middle">
                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015060211683945.html" style="color:#0579C6">2015060211683945</a>
                    </td><td valign="middle">
                        自贸区直购商城                      </td>
                    <td valign="middle">
                        售后问题                      </td>
                    <td valign="middle">
                        投诉撤销
                    </td>
                    <td valign="middle">
                        2015-06-02 11:41                      </td>
                    <td valign="middle">
                        <a class="btn-bj-hover operate-btn" href="<?= Yii::$app->params['baseUrl'] ?>bcomplain-show_comment-42015060211567491.html">查看详情</a>
                    </td>
                    </tr>   
                    <tr>
                    <input value="1" name="complain_id" type="hidden">
                    <td valign="middle">
                        42015052116229890                      </td>
                    <td valign="middle">
                        <a href="<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015052116801866.html" style="color:#0579C6">2015052116801866</a>
                    </td><td valign="middle">
                        自贸区直购商城                      </td>
                    <td valign="middle">
                        售后问题                      </td>
                    <td valign="middle">
                        投诉成立
                    </td>
                    <td valign="middle">
                        2015-05-21 16:53                      </td>
                    <td valign="middle">
                        <a class="btn-bj-hover operate-btn" href="<?= Yii::$app->params['baseUrl'] ?>bcomplain-show_comment-42015052116229890.html">查看详情</a>
                    </td>
                    </tr>   

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

