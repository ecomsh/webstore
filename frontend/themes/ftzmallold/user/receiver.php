<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '收货地址_上海外高桥进口商品网';
?>

<!-- right-->
<div class="member-main" style="width: 960px;">
    <div>
        <div class="title title2"><span style="float:left">收货地址<span class="disc">|</span> <span id="add" class="disc add-icon"><a href="javascript:void(0);">添加新的收货地址</a></span></span></div>
        <div id="addr_div" style="display: inline;">
            <form method="post" action="<?= Yii::$app->params['baseUrl'] ?>member-insert_rec.html" id="Member_addr">
                <div class="division" style="border:none; border-bottom:1px dashed #ddd">
                    <table cellpadding="0" class="forform" cellspacing="0" border="0">
                        <tbody><tr>
                                <th>收货人：</th><td><input autocomplete="off" class="x-input inputstyle" name="name" type="text" required="true" id="name" size="30" vtype="required" value=""></td></tr>
                            <tr><th>地区：</th><td><span id="checkout-select-area"><span class="region" vtype="area" id="reg_dom_el_5b2cb90">
                                            <input name="area" package="mainland" id="dom_el_5b2cb90" type="hidden" value="">
                                            <select data-level-index="0" class="inputstyle"><option value="_NULL_">请选择</option><option value="1" data-level-index="0">北京</option><option value="21" data-level-index="1">上海</option><option value="42" data-level-index="2">天津</option><option value="62" data-level-index="3">重庆</option><option value="104" data-level-index="4">安徽</option><option value="227" data-level-index="5">福建</option><option value="322" data-level-index="6">甘肃</option><option value="423" data-level-index="7">广东</option><option value="566" data-level-index="8">广西</option><option value="690" data-level-index="9">贵州</option><option value="788" data-level-index="10">海南</option><option value="814" data-level-index="11">河北</option><option value="998" data-level-index="12">河南</option><option value="1176" data-level-index="13">黑龙江</option><option value="1320" data-level-index="14">湖北</option><option value="1436" data-level-index="15">湖南</option><option value="1573" data-level-index="16">吉林</option><option value="1643" data-level-index="17">江苏</option><option value="1763" data-level-index="18">江西</option><option value="1874" data-level-index="19">辽宁</option><option value="1989" data-level-index="20">内蒙古</option><option value="2103" data-level-index="21">宁夏</option><option value="2130" data-level-index="22">青海</option><option value="2182" data-level-index="23">山东</option><option value="2340" data-level-index="24">山西</option><option value="2471" data-level-index="25">陕西</option><option value="2589" data-level-index="26">四川</option><option value="2792" data-level-index="27">西藏</option><option value="2873" data-level-index="28">新疆</option><option value="2987" data-level-index="29">云南</option><option value="3133" data-level-index="30">浙江</option><option value="3235" data-level-index="31">香港</option><option value="3239" data-level-index="32">澳门</option><option value="3242" data-level-index="33">台湾</option><option value="3286" data-level-index="34">海外</option></select>
                                            <select data-level-index="1" class="inputstyle" style="display:none"></select>
                                            <select data-level-index="2" class="inputstyle" style="display:none"></select>
                                        </span>

                                        <script>
                                            //var isDebug = 'js_mini/',
                                            var path = '/app/ectools/statics/js/';
                                            var callback = '';
                                            if ("selectArea") {
                                                callback = "selectArea";
                                            }
                                            var validate_area;
                                            try {
                                                $LAB.setOptions({BasePath: path}).script('region_data.js').wait(function() {
                                                    $LAB.setOptions({BasePath: path}).script('region.js').wait(function() {

                                                        region_sel.init(callback, "reg_dom_el_5b2cb90");
                                                        var str = $$('#reg_dom_el_5b2cb90 input')[0].value;
                                                        if (str) {
                                                            str = str.split(':')[1].split('/');
                                                            str.each(function(s, i) {
                                                                var sel = $$('#reg_dom_el_5b2cb90 select[data-level-index]')[i];
                                                                var opt = sel.getChildren().filter(function(el) {
                                                                    return el.get('text') == s;
                                                                });
                                                                region_sel.changeResponse(sel, {opt: opt});
                                                            });

                                                        }
                                                    });
                                                });
                                                validate_area = LANG_formplus['validate']['area'];
                                            }
                                            catch (e) {
                                                Ex_Loader(path + "region_data.js", function() {
                                                    Ex_Loader(path + "region.js", function() {
                                                        /*region_sel.init(callback);
                                                         var str = $$('.region input')[0].value;
                                                         if(str) {
                                                         str = str.split(':')[1].split('/');
                                                         str.each(function(s,i){
                                                         var sel = $$('select[data-level-index]')[i];
                                                         var opt = sel.getChildren().filter(function(el){return el.get('text')==s;});
                                                         region_sel.changeResponse(sel,{opt:opt});
                                                         });
                                                         }*/
                                                        region_sel.init(callback, "reg_dom_el_5b2cb90");
                                                        var str = $$('#reg_dom_el_5b2cb90 input')[0].value;
                                                        if (str) {
                                                            str = str.split(':')[1].split('/');
                                                            str.each(function(s, i) {
                                                                var sel = $$('#reg_dom_el_5b2cb90 select[data-level-index]')[i];
                                                                var opt = sel.getChildren().filter(function(el) {
                                                                    return el.get('text') == s;
                                                                });
                                                                region_sel.changeResponse(sel, {opt: opt});
                                                            });

                                                        }
                                                    });
                                                });

                                                validate_area = LANG_Validate['area'];
                                            }
                                            validatorMap['area'] = [validate_area, function(element, v) {
                                                    return  element.getElements('select').every(function(sel) {
                                                        if (sel.getStyle('display') != "none") {
                                                            var selValue = sel.get('value');
                                                            sel.focus();
                                                            return selValue != '' && selValue != '_NULL_';
                                                        }
                                                        return true;
                                                    });
                                                }];

                                        </script>
                                    </span></td></tr>
                            <tr><th>地址：</th><td><textarea class="inputstyle" type="textarea" name="addr" id="addr" rows="2" cols="30"></textarea></td></tr>
                        <tr><th>邮编：</th><td><input autocomplete="off" class="x-input inputstyle" name="zipcode" size="15" required="true" vtype="required&amp;&amp;number&amp;&amp;check_zipcode" id="dom_el_5b2cb91" type="text"></td></tr>
                        <tr><th>手机：</th><td><input autocomplete="off" class="x-input inputstyle" name="phone[mobile]" vtype="number&amp;&amp;mobile" id="mobile" size="15" value="" type="text">&nbsp;<span class="infotips">其中联系电话和联系手机必须填写一项</span></td>
                            <td style="padding:8px 0 0 0"><input type="hidden" vtype="mobile_or_phone"></td>
                        </tr>
						<tr><th>固定电话：&nbsp;</th><td><input autocomplete="off" class="x-input inputstyle" vtype="phone" name="phone[telephone]" type="text" size="15" id="dom_el_5b2cb92"></td></tr>
                    </tbody></table>
                </div>
                <div style="padding-left:142px; "><span class="float-span">
                        <button class="btn btn submit-btn" type="submit" rel="_request"><span><span>保存</span></span></button></span>
                    <span class="float-span" style="float:left; margin-left:8px">
                        <button id="unset" type="button" class="btn"><span><span>取消添加</span></span></button></span>
                </div>
            </form>
        </div>
                <table class="gridlist gridlist_member border-all mt10" width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
            <tbody><tr>
                <th class="first" style="word-break: break-all; word-wrap:break-word;" width="40%">地址</th>
                <th style="word-wrap:break-word;" width="15%">收货人</th>
                <th>联系电话</th>
                <th>默认</th>
                <th>操作</th>
            </tr>

            </tbody><tbody>
                                <tr>
                    <td class="textwrap textleft" style="word-break: break-all; word-wrap:break-word;">上海-上海市-杨浦区上海市杨浦区铁岭路50弄30号202 , 200092</td>
                    <td class="textcenter" style="word-break: break-all; word-wrap:break-word;"><span class="font-blue">曹琦</span></td>
                    <td class="textcenter">13918894594</td>
                    <td class="textcenter">                        <span class="tacitly-add"><a href="<?= Yii::$app->params['baseUrl'] ?>member-set_default-977-2.html" rel="_request">设为默认</a></span>
                                            </td>
                    <td align="center"><a href="<?= Yii::$app->params['baseUrl'] ?>member-receiver.html###" class="btn-bj-hover operate-btn" onclick="edit( & #39; 977 & #39; );"><span>修改</span></a><a class="btn-bj-hover operate-btn" href="<?= Yii::$app->params['baseUrl'] ?>member-del_rec-977.html" rel="_request"><span>删除</span></a></td>
                </tr>
                            </tbody>

        </table>
        
    </div>
</div>


<script>
    function edit(addrid) {
        new Request.HTML({
            url: '<?= Yii::$app->params['baseUrl'] ?>member-edit_addr.html',
            update: $('Member_addr'),
            data: 'addrid=' + addrid,
            method: 'post',
            onComplete: function(rs) {
                $('addr_div').setStyle('display', 'block');
                $('Member_addr').action = '<?= Yii::$app->params['baseUrl'] ?>member-save_rec.html';
            }
        }).send();
        selectArea = function(sels) {
            var selected = [];
            sels.each(function(s) {
                if (s.getStyle('display') != 'none') {
                    var text = s[s.selectedIndex].text.trim().clean();
                    if (['北京', '天津', '上海', '重庆'].indexOf(text) > -1)
                        return;
                    selected.push(text);
                }
            });
            var selectedV = selected.join('');
            if ($('addr').value.indexOf(selectedV) > -1) {

            } else {
                $('addr').value = selectedV;
            }
        };
        validatorMap['check_zipcode'] = ['请录入正确的邮编', function(element, v) {
                var value = v.trim();
                var _is_validate = true;
                if (/^[1-9][0-9]{5}$/.test(value)) {
                    _is_validate = true;
                } else {
                    _is_validate = false;
                }
                return _is_validate;
            }];
        validatorMap['check_phone'] = ['请输入正确的电话号码', function(element, v) {
                var value = v.trim();
                var _is_validate = true;
                if (/^0?1[3458]\d{9}$|^(0\d{2,3}-?)?[23456789]\d{5,7}(-\d{1,5})?$/.test(value)) {
                    _is_validate = true;
                } else {
                    _is_validate = false;
                }
                return _is_validate;
            }];
    }
    function a(url, options) {
        if (!url)
            return;
        options = Object.append({
            width: window.getSize().x * 0.8,
            height: window.getSize().y * 0.8
        }, options || {});
        var params = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width={width},height={height}';
        params = params.substitute(options);

        window.open(url, '_blank', params);
    }

                </script>

<script>
    (function() {

        $$(".delete_addr").addEvent('click', function(e) {
            if (!confirm('确定删除?'))
                return false;
        });
        $("add").addEvent('click', function(e) {
            if (1) {
                $('addr_div').setStyle('display', 'inline');
            } else {
                return false;
            }
        });

        selectArea = function(sels) {
            var selected = [];
            sels.each(function(s) {
                if (s.getStyle('display') != 'none') {
                    var text = s[s.selectedIndex].text.trim().clean();
                    if (['北京', '天津', '上海', '重庆'].indexOf(text) > -1)
                        return;
                    selected.push(text);
                }
            });
            var selectedV = selected.join('');
            $('addr').value = selectedV;
        };

        validatorMap['mobile_or_phone'] = ['手机或电话必填其一！', function(element, v) {
                var _contacts = $(element).getParent('td').getPrevious('td').getElements('input');

                var _is_validate = false;
                _contacts.each(function(el) {
                    if (el.value)
                        _is_validate = true || _is_validate;
                });

                return _is_validate;
            }];

        validatorMap['check_zipcode'] = ['请录入正确的邮编', function(element, v) {
                var value = v.trim();
                var _is_validate = true;
                if (/^[1-9][0-9]{5}$/.test(value)) {
                    _is_validate = true;
                } else {
                    _is_validate = false;
                }
                return _is_validate;
            }];

        $("unset").addEvent('click', function(e) {
            $('addr_div').setStyle('display', 'none');
        });
    })();
                </script>

<!-- right-->
