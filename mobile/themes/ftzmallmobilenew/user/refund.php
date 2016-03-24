<?php
use yii\helpers\Url;
use yii\helpers\Html;
use mobile\assets\ftzmallmobilenew\UserAsset;

UserAsset::register($this);//为了将activeForm的js代码依赖于mainasset
/* @var $this yii\web\View */
$this->title = '退款申请_上海外高桥进口商品网';
?>
<div class = "member-main" style = "width: 960px;">
    <h1 class = "title title2">申请退款</h1>
    <form action = "<?= Yii::$app->params['baseUrl'] ?>aftersales-return_save_mai.html" enctype = "multipart/form-data" encoding = "multipart/form-data" method = "post" name = "return_save" id = "x-return-form">
        <div class = "FormWrap">
            <div class = "division">
                <h4 class = "fontnormal">退款金额：15.900</h4>
                <input type = "hidden" name = "gorefund_price" value = "15.900">
                <input type = "hidden" name = "product_item_nums[1870]" value = "1">
                <input type = "hidden" name = "products[0]" value = "1870">
                <input type = "hidden" name = "product_bn[1870]" value = "0008411001">
                <input type = "hidden" name = "product_nums[1870]" value = "1">
                <input type = "hidden" name = "product_name[1870]" value = "美国 地扪玉米粒 432g">
                <input type = "hidden" name = "product_item_nums[1926]" value = "1">
                <input type = "hidden" name = "products[1]" value = "1926">
                <input type = "hidden" name = "product_bn[1926]" value = "0014017001">
                <input type = "hidden" name = "product_nums[1926]" value = "1">
                <input type = "hidden" name = "product_name[1926]" value = "菲律宾 SEAHARVEST盐水浸金枪鱼罐头 185g">
            </div>
            <div class = "division">
                <h4 class = "fontnormal">退款原因：</h4>
                <select id = "J_DelayDays" class = "delay-days" name = "comment">
                    <option value = "">请选择退款原因</option>
                    <option value = "协商一致退款">协商一致退款</option>
                    <option value = "未按约定时间发货">未按约定时间发货</option>
                    <option value = "虚假发货">虚假发货</option>
                    <option value = "其他">其他</option>
                </select>
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
        <input type = "hidden" name = "order_id" value = "2015052213351751">
        <input type = "hidden" name = "member_id" value = "4654">
        <input type = "hidden" name = "type" value = "1">

    </form>
</div>
<script>
    $('x-return-form').getElement('button[type=submit]').addEvent('click', function(e) {

        var reason = $('J_DelayDays').value;

        if (reason == '') {
            Message.error('请选择退款原因！');
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