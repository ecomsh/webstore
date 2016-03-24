<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '举报管理_上海外高桥进口商品网';
?>

<div style = "width: 960px;" class = "member-main">
    <div class = "title title2">举报管理</div>
    <div class = "FormWrap" style = "background-color:#FFFFFF;">
        <form action = "/breports-reports_main.html" method = "POST">
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
                        <td style = "text-align:right;padding:8px 0;">商品名称：</td>
                        <td style = "text-align:left;padding-left:10px;"><input vtype = "text" id = "search_goods_name" size = "20" name = "goods_id" class = "x-input " autocomplete = "off" type = "text"> </td>
                        <td style = "text-align:right;">举报编号：</td>
                        <td style = "text-align:left;padding-left:10px;"><input vtype = "text" id = "search_reports_id" size = "20" name = "reports_id" class = "x-input " autocomplete = "off" type = "text"> </td>
                        <td style = "text-align:right;">举报原因：</td>
                        <td style = "text-align:left;padding-left:10px;">
                            <select name = "cat_id" type = "select" id = "dom_el_03502c0" class = " x-input-select inputstyle"><option selected = "selected"></option><option value = "1">虚假信息</option></select> </td>
                    </tr>
                    <tr>
                        <td style = "text-align:right;">举报状态：</td>
                        <td style = "text-align:left;padding-left:10px;">
                            <select class = " x-input-select inputstyle" required = "1" name = "status" id = "ot" type = "select">
                                <option selected = "selected" value = "all">请选择</option>
                                <option value = "intervene">平台已经介入</option>
                                <option value = "success">举报成立</option>
                                <option value = "error">举报不成立</option>
                                <option value = "cancel">举报撤销</option>
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
                <table class="switchable gridlist gridlist_member" border="0" cellpadding="0" cellspacing="0" width="100%">
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
                            <th class="comment first">举报编号</th>
                            <th class="ratee">商品名称</th>
                            <th class="things">被举报方</th>
                            <th class="things">举报原因</th>
                            <th class="things">举报状态</th>
                            <th class="things">申请时间</th>
                            <th class="operate">操作</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>