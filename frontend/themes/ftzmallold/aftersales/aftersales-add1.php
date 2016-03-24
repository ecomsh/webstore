<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '退货维权_上海外高桥进口商品网';
?>

<div class = "member-main" style = "width: 960px;">
    <h1 class = "title title2">申请退款</h1>
    <form action = "http://www.ftzmall.com.cn/aftersales-return_save.html" enctype = "multipart/form-data" encoding = "multipart/form-data" method = "post" name = "return_save" id = "x-return-form">
        <div class = "FormWrap">
            <div class = "division">
                <h4 class = "fontnormal">售后服务类型：</h4>
                <select id = "type" type = "select" name = "type" class = " x-input-select inputstyle"><option></option><option value = "5">未收到货</option></select> </div>
            <div class = "division" id = "require">
                <h4 class = "fontnormal">售后要求：</h4>
                <select id = "required" type = "select" name = "required" class = " x-input-select inputstyle"><option></option><option value = "6">要求退款</option></select> </div>
            <div class = "division">
                <h4 class = "fontnormal">退款金额：</h4>
                <input autocomplete = "off" class = "x-input " type = "text" id = "gorefund_price" name = "gorefund_price" style = "width:20%" vtype = "text">(最多262.000)
                <input type = "hidden" id = "gorefund_price_big" value = "262.000">
            </div>
            <div class = "division">
                <h4 class = "fontnormal">退款说明：</h4>
                <textarea type = "textarea" id = "x-return-content" name = "content" class = "x-inputs x-input" cols = "80" rows = "5" style = "width:98%"></textarea> </div>
            <div class = "division">
                <h4 class = "fontnormal">上传凭证：</h4>
                <input type = "hidden" name = "MAX_FILE_SIZE" value = "2097152">
                <input type = "file" class = "x-input x-inputs" name = "file" id = "fileField">
                <input type = "file" class = "x-input x-inputs" name = "file1" id = "fileField1">
                <input type = "file" class = "x-input x-inputs" name = "file2" id = "fileField2">
            </div>
            <div class = "textcenter p10 division">
                <button class = "btn order-btn" type = "submit"><span><span>提交申请</span></span></button> </div>
        </div>
        <input type = "hidden" name = "order_id" value = "2015070310969894">
        <input type = "hidden" name = "member_id" value = "4839">
    </form>
</div>

<script>
    $('x-return-form').getElement('button[type=submit]').addEvent('click', function(e) {
        var gorefund_price_big = $('gorefund_price_big').value;
        var gorefund_price = $('gorefund_price').value;
        if (parseFloat(gorefund_price_big) < parseFloat(gorefund_price)) {
            Message.error('所填退款金额大于可退款金额，请修改！');
            return false;
        }
        if (parseFloat(gorefund_price) < 0 || parseFloat(gorefund_price) == 0 || gorefund_price == '') {
            Message.error('所填退款金额必须大于0，请修改！');
            return false;
        }
        var type = $('type').value;
        if (type == '') {
            Message.error('请选择售后服务类型！');
            return false;
        }
        var required = $('required').value;
        if (required == '') {
            Message.error('请选择售后要求！');
            return false;
        }
    });

    $('fileField').addEvent('change', function(e) {
        var ext = this.value.substring(this.value.lastIndexOf(".") + 1).toUpperCase();
        if (!(/jpg|gif|png/i).test(ext)) {
            Ex_Dialog.alert('只能上传gif,jpg,png格式的文件');
            this.value = '';
            return false;
        }

        if (this.files) {
            var file = this.files[0];
            if (file.fileSize > 2 * 1024 * 1024) {
                Ex_Dialog.alert('文件上传大小超过限制');
                this.value = '';
                return false;
            }
        } else if (Browser.ie) {
            var src = this.value.replace(/\\/g, "/");
            src = "file:///" + src;

            var img = new Image();
            img.onload = function() {
                if (img.fileSize > 2 * 1024 * 1024) {
                    Ex_Dialog.alert('文件上传大小超过限制');
                    this.value = '';
                    return false;
                }
            };
            img.src = src;
        } else {
        }
    });

    $('fileField1').addEvent('change', function(e) {
        var ext = this.value.substring(this.value.lastIndexOf(".") + 1).toUpperCase();
        if (!(/jpg|gif|png/i).test(ext)) {
            Ex_Dialog.alert('只能上传gif,jpg,png格式的文件');
            this.value = '';
            return false;
        }

        if (this.files) {
            var file = this.files[0];
            if (file.fileSize > 2 * 1024 * 1024) {
                Ex_Dialog.alert('文件上传大小超过限制');
                this.value = '';
                return false;
            }
        } else if (Browser.ie) {
            var src = this.value.replace(/\\/g, "/");
            src = "file:///" + src;

            var img = new Image();
            img.onload = function() {
                if (img.fileSize > 2 * 1024 * 1024) {
                    Ex_Dialog.alert('文件上传大小超过限制');
                    this.value = '';
                    return false;
                }
            };
            img.src = src;
        } else {
        }
    });

    $('fileField2').addEvent('change', function(e) {
        var ext = this.value.substring(this.value.lastIndexOf(".") + 1).toUpperCase();
        if (!(/jpg|gif|png/i).test(ext)) {
            Ex_Dialog.alert('只能上传gif,jpg,png格式的文件');
            this.value = '';
            return false;
        }

        if (this.files) {
            var file = this.files[0];
            if (file.fileSize > 2 * 1024 * 1024) {
                Ex_Dialog.alert('文件上传大小超过限制');
                this.value = '';
                return false;
            }
        } else if (Browser.ie) {
            var src = this.value.replace(/\\/g, "/");
            src = "file:///" + src;

            var img = new Image();
            img.onload = function() {
                if (img.fileSize > 2 * 1024 * 1024) {
                    Ex_Dialog.alert('文件上传大小超过限制');
                    this.value = '';
                    return false;
                }
            };
            img.src = src;
        } else {
        }
    });
</script>

