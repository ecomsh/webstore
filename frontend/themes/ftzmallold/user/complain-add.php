<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\ComplainAsset;
ComplainAsset::register($this);
/* @var $this yii\web\View */
$this->title = '添加投诉_上海外高桥进口商品网';
?>

<div style = "width: 960px;" class = "member-main">
    <div class = "title title2">投诉管理</div>
    <div class = "progress-bar at-step-0">
        <ol class = "four-steps three-step">
            <li class = "step-item step-0">
                <strong>1</strong>
                <h2 style = "width:255px;">申请投诉</h2>
            </li>
            <li class = "step-item step-1">
                <strong>2</strong>
                <h2 style = "width:255px;">平台介入处理</h2>
            </li>
            <li class = "step-item step-2 step-3">
                <strong>3</strong>
                <h2 style = "width:255px;">投诉完成</h2>
            </li>
        </ol>
    </div> <div class = "FormWrap" style = "background-color:#FFFFFF;border:0 none;padding:0;">
        <div class = "col-main">
            <div class = "main-wrap">
                <form class = "boxbase J_BoxTab form-edit J_FormEdit" action = "/bcomplain-addSave.html" method = "POST" enctype = "multipart/form-data">
                    <input name = "source" value = "buyer" type = "hidden">
                    <input name = "from_member_id" value = "4654" type = "hidden">
                    <input name = "to_member_id" value = "20" type = "hidden">
                    <input name = "store_id" value = "77" type = "hidden">
                    <input name = "order_id" value = "2015070111431265" type = "hidden">
                    <input name = "from_uname" value = "testyx01" type = "hidden">
                    <input name = "to_uname" value = "dig" type = "hidden">
                    <input name = "store_name" value = "进口商品直销中心" type = "hidden">
                    <div class = "box-bd">
                        <div class = "row-item first-row-item">
                            <div class = "ctitle">
                                <b>*</b><label>投诉类型：</label>
                            </div>
                            <div class = "info J_ReasonBox">
                                <label style = "margin-right: 10px;"><input value = "after" checked = "checked" class = "J_ReasonId" name = "reason" type = "radio">售后问题</label>
                                <label style = "margin-right: 10px;"><input value = "action" class = "J_ReasonId" name = "reason" type = "radio">行为违规</label>
                            </div>
                        </div>
                        <div class = "row-item first-row-item">
                            <div class = "ctitle">
                                <label>手机：</label>
                            </div>
                            <div class = "info J_ReasonBox">
                                <input style = "height: 20px;" name = "mobile" class = "J_Phone">
                            </div>

                        </div>
                        <div class = "row-item first-row-item clear-fix">
                            <div class = "ctitle">
                                <b>*</b><label>补充留言：</label>
                            </div>
                            <div class = "info">
                                <textarea class = "introduction J_FormVerify_Textarea J_FormVerify" name = "memo" placeholder = "补充留言不能为空！"></textarea>
                                <div style = "padding-left:236px;" class = "help-msg">
                                    <strong style = "padding-left:115px;" class = "text-count J_TextCount">300</strong>/300字
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "box-bd">
                        <div class = "row-item first-row-item clear-fix">
                            <div class = "ctitle">
                                <b>*</b><label>上传凭证：</label>
                            </div>
                            <div class = "info" id = "J_WaitItems">

                            </div>
                            <div class = "info upload-image-wrap J_UploadWrap">
                                <a id = "J_SelectFileLabel" class = "select-file-label ">选择要上传的凭证</a>
                                <div id = "J_FileInputBox" maxindex = "1" class = "select-file-wrap ">
                                    <input size = "1" findex = "1" class = "select-file J_SelectFile1" name = "image[]" accept = "image/gif,image/jpeg,image/jpg,image/bmp,image/png" type = "file">
                                </div>
                            </div>
                            <div class = "row-item help-msg-wrap">
                                <div class = "info">
                                    <div class = "J_VadioHelpMsg help-msg  hidden">图片、音频文件不超过5M，图片支持GIF，JPG，JPEG，PNG，BMP格式；音频文件支持WAV，AMR，AIFF，WMA，M4R格式；凭证数量最多3张</div>
                                    <div class = "J_ImgHelpMsg help-msg">每张图片不超过5M，最多3张，支持GIF，JPG，JPEG，PNG，BMP格式</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "box-bd">
                        <div class = "row-item first-row-item clear-fix">
                            <div class = "info">
                                <button id = "J_Submit" type = "button" class = "btn">提交</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class = "col-sub">
            <div id = "J_BabyDetail" class = "boxbase baby-detail J_BabyDetail">
                <div class = "box-hd">
                    <i class = "hd-icon"></i>
                    <h4>
                        <span>宝贝信息</span>
                    </h4>
                </div>
                <div class = "box-bd">
                    <div class = "row-item first-row-item">
                        <div class = "ctitle">
                            <a alt = "img" href = "<?= Yii::$app->params['baseUrl'] ?>product-1333.html">
                                <img src="<?= Yii::$app->params['baseimgUrl'] ?>c95a3bfce40b6b0e4a0b8234f5d98ac5234.jpg" class = "goods-img" alt = "菲律宾 FIESTA嘉年华热带椰子水330ML">
                            </a>
                            <label class = ""></label>
                        </div>
                        <div class = "info">
                            <a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>product-1333.html" class = "text-link">菲律宾 FIESTA嘉年华热带椰子水330ML</a>
                            <br> </div>
                    </div>
                    <div class = "row-item">
                        <div class = "ctitle"><label>卖家：</label></div>
                        <div class = "info">
                            <a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>shop-view-77.html">进口商品直销中心</a>
                            <span>
                                <!---->
                            </span>
                        </div>
                    </div>
                    <div class = "row-item">
                        <div class = "ctitle"><label>单价：</label></div>
                        <div class = "info"><span><span class = "price-thin">¥9.90</span>元</span>
                        </div>
                    </div>
                    <div class = "row-item">
                        <div class = "ctitle"><label>数量：</label></div>
                        <div class = "info">1</div>
                    </div>
                    <!--<div class = "row-item">
                    <div class = "ctitle"><label>优惠：</label></div>
                    <div class = "info"><ul>无优惠</ul></div>
                    </div> -->
                    <div class = "row-item">
                        <div class = "ctitle"><label>小计：</label></div>
                        <div class = "info"><span><span class = "price-bold">¥9.90</span>元</span></div>
                    </div>

                    <div class = "row-item last-row-item">
                        <a hidefocus = "" href = "javascript:;" id = "J_MoreBabyTrigger" class = "more ">查看订单信息<s class = "spt-icon"></s></a>
                    </div>

                </div>
                <div id = "J_MoreBabyBox" class = "box-bd  hidden">
                    <div class = "row-item first-row-item">
                        <div class = "ctitle"><label>订单编号：</label></div>
                        <div class = "info">
                            <a target = "_blank" href = "<?= Yii::$app->params['baseUrl'] ?>member-orderdetail-2015070111431265.html" class = "text-link">2015070111431265</a>
                        </div>
                    </div>
                    <div class = "row-item">
                        <div class = "ctitle"><label>运费：</label></div>
                        <div class = "info"><span><span class = "price-bold">¥13.00</span>元</span></div>
                    </div>
                    <div class = "row-item">
                        <div class = "ctitle"><label>总优惠：</label></div>
                        <div class = "info">¥0.00元</div>
                    </div>
                    <div class = "row-item">
                        <div class = "ctitle"><label>总计：</label></div>
                        <div class = "info"><span><span class = "price-bold">¥22.90</span>元</span></div>
                    </div>
                    <div class = "row-item">
                        <div class = "ctitle"><label>成交时间：</label></div>
                        <div class = "info">2015-07-01 11:20</div>
                    </div>
                </div>
            </div>
            <script>
                (function() {
                    if ($('J_MoreBabyTrigger')) {
                        $('J_MoreBabyTrigger').addEvent('click', function(e) {
                            e.stop();
                            this.toggleClass('close');
                            $('J_MoreBabyBox').toggleClass('hidden');
                        });
                    }
                    if (document.getElement('.J_MoreDescTrigger')) {
                        document.getElement('.J_MoreDescTrigger').addEvent('click', function(e) {
                            e.stop();
                            this.toggleClass('shrink');
                            document.getElement('.J_TextDesc').toggleClass('height-auto');
                        });
                    }
                })();
            </script>        </div>
    </div>
</div>

<script>
    (function() {

        FileUpload = new Object();
        Object.append(FileUpload, {
            init: function() {
                $('J_SelectFileLabel').addEvent('click', function(e) {
                    e.stop();
                    var arr_file = this.getFileInput();
                    var last = arr_file.getLast();
                    if (!last.retrieve('add:change')) {
                        last.addEvent('change', this.fileChange.bind(this));
                        last.store('add:change', true);
                    }
                    last.click();
                }.bind(this));

                if (document.getElement('.J_FormVerify_Textarea')) {
                    document.getElement('.J_FormVerify_Textarea').addEvent('keyup', function(e) {
                        var length = 300 - this.value.length;
                        document.getElement('.J_TextCount').set('html', length);
                    });
                }
                $('J_Submit').addEvent('click', function(e) {
                    e.stop();
                    var form = e.target.getParent('form');
                    var J_FormVerify_Textarea = form.getElement('.J_FormVerify_Textarea');
                    if (J_FormVerify_Textarea.value.trim() == '') {
                        J_FormVerify_Textarea.focus();
                        Message.error('请输入补充留言！');
                        return;
                    } else {
                        if (J_FormVerify_Textarea.value.trim().length > 300) {
                            Message.error('留言字数不能大于300个！');
                            return;
                        }
                    }

                    var items = $('J_WaitItems').getElements('.J_WaitItem');
                    if (items.length <= 0) {
                        Message.error('请最少上传一张凭证！');
                        return;
                    }
                    var inputFiles = $('J_FileInputBox').getElements('.select-file');
                    inputFiles.each(function(el) {
                        if (el.value.trim() == '') {
                            el.destroy();
                        }
                    });
                    form.submit();

                }.bind(this));
            },
            getFileInput: function() {
                return $('J_FileInputBox').getElements('.select-file');
            },
            fileChange: function(e) {
                var obj = e.target;
                var v = obj.value;
                var $arr = ['JPG', 'JPEG', 'GIF', 'PNG', 'BMP'];
                if (v) {
                    var ext = v.split('.').getLast();
                    if ($arr.contains(ext.toUpperCase()) == false) {
                        obj.value = '';
                        Message.error('只能上传GIF，JPG，JPEG，PNG，BMP格式');
                        return;
                    }
                }
                $(obj).setStyle('display', 'none');
                var item = this.newWaitItem(obj);
                item.inject($('J_WaitItems'));
                var hasfile = $('J_WaitItems').getElements('.J_WaitItem');
                if (hasfile.length >= 3) {
                    $('J_SelectFileLabel').hide();
                    return;
                }

                this.newFileInput();
            },
            newFileInput: function() {
                var maxIndex = $('J_FileInputBox').get('maxIndex').toInt();
                maxIndex++;
                $('J_FileInputBox').set('maxIndex', maxIndex);
                var inputFile = new Element('input');
                inputFile.set('type', 'file').set('findex', maxIndex);
                inputFile.addClass('select-file');
                inputFile.addClass('J_SelectFile' + maxIndex);
                inputFile.set('name', 'image[]');
                inputFile.set('size', '1');
                inputFile.set('accept', 'image/gif,image/jpeg,image/jpg,image/bmp,image/png');
                inputFile.addEvent('change', this.fileChange.bind(this));
                inputFile.store('add:change', true);
                inputFile.inject($('J_FileInputBox'));
            },
            newWaitItem: function(obj) {
                var el = new Element('div');
                el.set('findex', $(obj).get('findex'));
                el.addClass('J_WaitItem');
                el.set('html', '<span class="file-name">' + $(obj).value + '</span><span> <a class="J_Delete delete" href="#" onclick="FileUpload.deleteWaitItem(new Event(event));"  data-file-idx="1">删除</a></span>');
                return el;
            },
            deleteWaitItem: function(e) {
                e.stop();
                var obj = e.target;
                var waitItem = $(obj).getParent('.J_WaitItem');
                var findex = waitItem.get('findex');
                var items = $('J_WaitItems').getElements('.J_WaitItem');
                var ifiles = FileUpload.getFileInput();
                var inputFile = $('J_FileInputBox').getElement('.J_SelectFile' + findex);
                inputFile.destroy();
                waitItem.destroy();
                if (ifiles.length <= items.length) {
                    this.newFileInput();
                }
                $('J_SelectFileLabel').show();
            }


        });
        FileUpload.init();

    })();
</script>


