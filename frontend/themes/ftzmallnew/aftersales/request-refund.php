<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

use frontend\assets\ftzmallnew\UserAsset;
use frontend\assets\UploadAsset;


UserAsset::register($this);
UploadAsset::register($this);

/* @var $this yii\web\View */
$this->title = '退货维权_上海外高桥进口商品网';
?>



<div class="container user-color">
 <?= $this->render('../layouts/_user-nav-left') ?>
    <div class="member-right-order">
        <div class="member-main">
            <h1 class="title title2">售后维权</h1>
            <form action="<?=Url::to(['aftersales/add']); ?>" enctype="multipart/form-data" encoding="multipart/form-data" method="post" name="return_form" id="return_form">
                <div class="FormWrap">
                    <div class="division">
                        <h4 class="fontnormal">售后服务类型：</h4>
                        <select id="service_type" type="select" name="service_type"  class=" x-input-select inputstyle">
                            <option selected="selected" value="0">请选择</option>
                            <?php if(  $order['orderLineList'][0]['itemSalesType'] < 3 ): ?>
                            <option value="NO_CHARGE">七天无理由退货</option>
                            <?php endif; ?>
                            <option value="ITEM_BROKEN">收到商品破损</option>
                            <option value="ITEM_INCORRECT">商品错发</option>
                            <option value="ITEM_MISMATCH">收到商品不符</option>
                            <option value="QUALITY_ISSUE">商品质量问题</option>
                            <option value="ACCEPT_REJECT">物流拒收</option>
                            <option value="OTHERS">其他</option>
                        </select>
                    </div>


                    <div class="division" id="x-return-item-list-div" style="display: block;">
                        <h4 class="fontnormal">请勾选需要售后服务的商品及数量</h4>

                        <div id="return_item_list">
                            <table class="gridlist border-all gridlist_member" cellpadding="3" cellspacing="0" width="100%">
                                <colgroup>
                                    <col class="span-1">
                                    <col class="span-2">
                                    <col class="span-5">
                                    <col class="span-2">
                                    <col class="span-1">
                                </colgroup>

                                <thead>
                                <tr>
                                    <th class="first" style="text-align: left; padding-left:5px " ><input id="return_all" name="return_all" type="checkbox">整单退货</th>
                                    <th>货号</th>
                                    <th>商品名称</th>
                                    <th>单价</th>
                                    <th>数量</th>
                                </tr>
                                </thead>

                                <tbody>

        <!--                        <tr>
                                    <td><input class="x-pdt-chk-2102" value="2102" type="checkbox"></td>
                                    <td class="x-pdt-bn">102laF12C830002</td>
                                    <td class="x-pdt-name textcenter">(颜色:黑色 尺码:L )</td>
                                    <td class="textcenter price-normal">￥125.00</td>
                                    <td class="x-pdt-num textcenter">1</td>
                                    <input id="product_info_2102_price" value="125.000" type="hidden">
                                    <input id="product_info_2102_num" value="1" type="hidden">
                                </tr>

                                <tr>
                                    <td><input class="x-pdt-chk-2103" value="2103" type="checkbox"></td>
                                    <td class="x-pdt-bn">102laF12C830005</td>
                                    <td class="x-pdt-name textcenter">Emporio Armani 安普里奥·阿玛尼 男士短袖(颜色:白色 尺码:L )</td>
                                    <td class="textcenter price-normal">￥125.00</td>
                                    <td class="x-pdt-num textcenter">1</td>
                                    <input id="product_info_2103_price" value="125.000" type="hidden">
                                    <input id="product_info_2103_num" value="1" type="hidden">
                                </tr>
        -->


                                <?php foreach($order['orderLineList'] as $item ): ?>

                                <tr>
                                    <td><input  value="<?= $item['omsOrderLineId'] ;?>" type="checkbox"></td>

                                    <td class="x-pdt-bn"><?= $item['orderLineId'] ;?></td>
                                    <td class="x-pdt-name textcenter"><?= $item['itemDisplayText'] ;?></td>
                                    <td class="textcenter price-normal">￥<?= $item['unitPrice'] ;?></td>
                                    <td class="x-pdt-num textcenter"><?= $item['quantity'] ;?></td>

                                    <input id="product_info_<?= $item['omsOrderLineId'] ;?>_quantity"  value="<?= $item['quantity'] ;?>" type="hidden">
        <!--                            <input id="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_quantity" name="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_quantity" value="<?/*= $item['quantity'] ;*/?>" type="hidden">
                                    <input id="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_uom" name="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_uom" value="<?/*= $item['uom'] ;*/?>" type="hidden">
                                    <input id="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_itemid" name="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_itemid" value="<?/*= $item['itemId'] ;*/?>" type="hidden">
                                    <input id="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_itemdisplaytext" name="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_itemdisplaytext" value="<?/*= $item['itemDisplayText'] ;*/?>" type="hidden">
                                    <input id="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_itemlink" name="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_itemlink" value="<?/*= $item['itemLink'] ;*/?>" type="hidden">
                                    <input id="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_itemimagelink" name="product_info_<?/*= $item['omsOrderLineId'] ;*/?>_itemimagelink" value="<?/*= $item['itemImageLink'] ;*/?>" type="hidden">
        -->
                                </tr>

                                <?php endforeach;?>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <input vtype="product_nums_required" type="hidden">
                        </div>

                        <div class="p5">
                            <ul id="return_item_ul" class="return-list">
        <!--                        <li class="p5 clearfix" id="return_item_2102"><span class="flt item-num">1.&nbsp;</span><span class="fl" style="width:300px">Emporio Armani 安普里奥·阿玛尼 男士短袖(颜色:黑色 尺码:L )<input name="products[]" value="2102" type="hidden">&nbsp;&nbsp;x&nbsp;&nbsp;</span><span class="fl"><input autocomplete="off" class="x-input x-product-nums" product_nums="1" id="product_info[2102]" name="product_nums[2102]" value="1" size="2" onchange="changenum(this, 2102);" vtype="text" type="text"></span> <span class="fl">&nbsp;&nbsp;件</span><span class="fl forforma-btn"><button type="button" class="btn"><span><span>删除</span></span></button></span><span class="fl">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;退款金额<input name="products_refund[2102]" id="products_refund[2102]" size="2" onchange="changeRefundPrice(this, 2102);" value="0" type="test">元(维修换货请填0)</span><input name="product_name[2102]" value="Emporio Armani 安普里奥·阿玛尼 男士短袖(颜色:黑色 尺码:L )" type="hidden"><input name="product_bn[2102]" value="102laF12C830002" type="hidden"><input vtype="rtn_digits&amp;&amp;nominus&amp;&amp;product_nums" type="hidden"><input id="error[2102]" class="error" value="0" type="hidden"><span id="error_info[2102]" style="color:red"></span></li>
                                <li class="p5 clearfix" id="return_item_2103"><span class="flt item-num">2.&nbsp;</span><span class="fl" style="width:300px">Emporio Armani 安普里奥·阿玛尼 男士短袖(颜色:白色 尺码:L )<input name="products[]" value="2103" type="hidden">&nbsp;&nbsp;x&nbsp;&nbsp;</span><span class="fl"><input autocomplete="off" class="x-input x-product-nums" product_nums="1" id="product_info[2103]" name="product_nums[2103]" value="1" size="2" onchange="changenum(this, 2103);" vtype="text" type="text"></span> <span class="fl">&nbsp;&nbsp;件</span><span class="fl forforma-btn"><button type="button" class="btn"><span><span>删除</span></span></button></span><span class="fl">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;退款金额<input name="products_refund[2103]" id="products_refund[2103]" size="2" onchange="changeRefundPrice(this, 2103);" value="0" type="test">元(维修换货请填0)</span><input name="product_name[2103]" value="Emporio Armani 安普里奥·阿玛尼 男士短袖(颜色:白色 尺码:L )" type="hidden"><input name="product_bn[2103]" value="102laF12C830005" type="hidden"><input vtype="rtn_digits&amp;&amp;nominus&amp;&amp;product_nums" type="hidden"><input id="error[2103]" class="error" value="0" type="hidden"><span id="error_info[2103]" style="color:red"></span></li>
                  -->          </ul>
                        </div>

                    </div>

                    <div class="division">
                        <h4 class="fontnormal">如果您有相关图片，可以在此提交，格式:jpg,gif,jpeg,png，文件不超过2M，否则会上传失败</h4>
                        <div id="upload_container">
                            <a class="btn-a" id="upload_img"><span>上传图片</span></a>
                            <div id="loader">
                            </div>
                            <div id="image_display">

                            </div>
                        </div>
                    </div>

                    <div class="division" style="border-top:none">
                        <h4 class="fontnormal">申请售后的详细原因描述</h4>
                        <textarea type="textarea" id="return-content" name="content" class="x-inputs x-input" cols="80" rows="5" style="width:98%"></textarea>            <input vtype="return_content_required&amp;&amp;return_content_weight" type="hidden">
                    </div>
                    <div class="textcenter p10 division">
                        <button  id="submit" class="btn order-btn" type="submit"><span><span>提交申请</span></span></button>
                    </div>
                </div>

                <div id="image_files">

                </div>

                <input name="oms_order_id" value="<?=$order['omsOrderId'] ;?>" type="hidden">
                <input name="currency" value="<?=$order['currency'] ;?>" type="hidden">
                <input name="_csrf" value="<?=Yii::$app->request->getCsrfToken();?>" type="hidden">
            </form>
        </div>
    </div>
</div>






<script>


String.extend({
    format: function() {
        if (arguments.length === 0)
            return this;
        var reg = /{(\d+)?}/g;
        var args = arguments;
        var string = this;
        var result = this.replace(reg, function($0, $1) {
            return  args[$1.toInt()] || "";
        });
        return result;
    }    });


jQuery(document).ready(function(){



    jQuery('input[type="checkbox"]').prop('checked',false);

    jQuery('div#return_item_list tbody input[type="checkbox"]').change(function(e){

        var checkbox = jQuery(this);
        var parent = checkbox.parents('tr');
        var ol = jQuery('#return_item_ul');
        var str = '<span class="fl" style="width:300px">{0}<input type="hidden" name="products[]" value="{1}">&nbsp;&nbsp;x&nbsp;&nbsp;</span><span class="fl"><input  class="x-input x-product-nums" type="text" class="x-product-nums" id="product_{1}_num" name="product_{1}_num" value="{2}" size="2"  style="display:none;" /></span> <span class="fl">{2}&nbsp;件</span><span class="fl forforma-btn"><button type="button" class="btn"><span><span>删除</span></span></button></span><input type="hidden" id="error_{1}" class="error" value="0"/><span id="error_info_{1}" style="color:red"></span>';
        var el = jQuery('#return_item_'+ checkbox.val());

        if(checkbox.is(':checked')){

            var li = jQuery('<li></li>');
            li.attr('id','return_item_'+checkbox.val());
            li.addClass('p5 clearfix');
            li.html(str.format(parent.find('.x-pdt-name').html(),checkbox.val(),parent.find('.x-pdt-num').html()));
            ol.append(li);

            li.find('button').click(function(e) {
                del_return_item(jQuery(this), checkbox);
                refresh_item_order(ol);
            });

            li.find('input.x-product-nums').change(function(e) {
                var parts = li.attr('id').split('_');

                change_num(parts[parts.length-1]);
            });


        }else{
            if(el!=null){
                el.remove();
            }
        }

        refresh_item_order(ol);

    });




    jQuery('input#return_all').change(function(){

        var checkbox = jQuery(this);

        jQuery('#return_item_ul').empty();

        if(checkbox.is(':checked')){
            jQuery('div#return_item_list tbody input[type="checkbox"]').prop('checked',false);
            jQuery('div#return_item_list tbody input[type="checkbox"]').click();
            jQuery('div#return_item_list tbody input[type="checkbox"]').attr('disabled','disabled');
            jQuery('#return_item_ul').find('input').attr('readonly',true);
            jQuery('#return_item_ul').find('button').remove();

        }else{
            jQuery('div#return_item_list tbody input[type="checkbox"]').removeAttr('disabled');
            jQuery('div#return_item_list tbody input[type="checkbox"]').prop('checked',false);
        }


    });




    jQuery('form').submit(function(event){

        event.preventDefault();

        //type check


        if(jQuery(this).find('span.errorTip').size()!=0){
            jQuery(this).find('span.errorTip').remove();
        }


        if(jQuery(this).find('select#service_type').val()==0){
            jQuery(this).find('select#service_type').after('<span class="errorTip" style="color:red;">选择一个类型</span>');
            jQuery(this).find('select#service_type').focus();
            return false;
        }


        if(jQuery(this).find('textarea#return-content').val().length>80){
            jQuery(this).find('textarea#return-content').prev().append('<span class="errorTip" style="color:red;">原因不能超过80个字</span>');
            jQuery(this).find('textarea#return-content').focus();
            return false;
        }


        //item check
        var signal=false;

        if(jQuery(this).find('div#x-return-item-list-div h4>span.errorTip').size()!=0){
            jQuery(this).find('div#x-return-item-list-div h4>span.errorTip').remove();
        }

        jQuery(this).find('div#return_item_list input[type="checkbox"]').each(function(){

            if(jQuery(this).is(':checked')){
                signal = true;
            }

        });

        if(!signal){
            jQuery(this).find('div#x-return-item-list-div h4').append('<span class="errorTip" style="color:red;">请选择要退的商品</span>');
            jQuery(this).find('div#return_item_list input[type="checkbox"]:first').focus();
            return false;
        }

        //num check

        signal=false;

        jQuery('input.error').each(function(){
            if(jQuery(this).val()==1){
                jQuery(this).siblings('span.fl').children('.x-product-nums').focus();
                signal=true;
            }
        });

        if(signal){
            return false;
        }

        //detail check

        if(jQuery(this).find('textarea#return-content').siblings('h4').children('span.errorTip').size()!=0){
            jQuery(this).find('textarea#return-content').siblings('h4').children('span.errorTip').remove();
        }

        if(jQuery.trim(jQuery(this).find('textarea#return-content').val())==""){
            jQuery(this).find('textarea#return-content').siblings('h4').append('<span class="errorTip" style="color:red;">请填写详细原因</span>');
            jQuery(this).find('textarea#return-content').focus();
            return false;
        }



        jQuery.ajax({

            url:'<?=Url::to(['aftersales/add']); ?>',
            type:'POST',
            data:jQuery(this).serialize(),
            dataType:'json',
            beforeSend:function(){

                jQuery('button#submit').attr('disabled','disabled').text('正在提交');

            },
            complete:function(){
                jQuery('button#submit').removeAttr('disabled').text('提交');

            },
            success:function(data){


                if(typeof(data.code) != "undefined"){
                    //没有测过
                    if(data.message.indexOf('Not Enough Quantity')!=-1){
                        alert("无法提交退单,退单列表中包含已经退过的商品");
                        return;
                    }

                    //alert(data.message);
                    alert("请稍后重试");
                    return;

                }else{
                    location.href = data.url;
                }


            },
            error:function(jqXhr){

                if(jqXhr.status == 400){
                    alert('您选择的商品中包含已经退过的商品，请重新选择');
                }else{
                    alert('无法连接到服务器');
                }

            }

        });



    });


    //img uploader

    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',    //上传模式,依次退化
        browse_button: 'upload_img',       //上传选择的点选按钮，**必需**
        uptoken_url: '<?=Url::to(['image-upload/uptoken']); ?>',
        //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
        //uptoken : 'WPLxAsjniSNOQiDerV-FZjLcBJ9149y7yteNV4Aw:q-oCBuK9j9bYz7Tq40HeaUCzCGk=:eyJzY29wZSI6Imppbmd4aSIsImRlYWRsaW5lIjoxNDM4NzYyMzkxfQ==',
        //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
        unique_names: false,
        // 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
        save_key: false,
        // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
        domain: '<?= Yii::$app->params['sm']['qiniu']['baseUrl'] ?>',
        //bucket 域名，下载资源时用到，**必需**
        container: 'upload_container',           //上传区域DOM ID，默认是browser_button的父元素，
        max_file_size: '2mb',           //最大文件体积限制
        flash_swf_url: 'Moxie.swf',  //引入flash,相对路径
        max_retries: 3,                   //上传失败最大重试次数
        dragdrop: false,                   //开启可拖曳上传
        drop_element: 'upload_container',        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
        chunk_size: '1mb',                //分块上传时，每片的体积
        auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
        init: {
            'FilesAdded': function(up, files) {
                plupload.each(files, function(file) {
                    // 文件添加进队列后,处理相关的事情
                });
            },
            'BeforeUpload': function(up, file) {
                // 每个文件上传前,处理相关的事情

                //格式验证

                if(file.type.indexOf('image')<0){
                    alert("只能上传图片文件");
                    return false;
                }

                //只能上传5张
                if(jQuery('div#image_files').children('input').size()>4){
                    alert("最多只能上传5个图片");
                    return false;
                }

                //give tip
                jQuery('#loader').show();

            },
            'UploadProgress': function(up, file) {
                // 每个文件上传时,处理相关的事情
            },
            'FileUploaded': function(up, file, info) {
                // 每个文件上传成功后,处理相关的事情
                // 其中 info 是文件上传成功后，服务端返回的json，形式如
                // {
                //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                //    "key": "gogopher.jpg"
                //  }
                // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
                // var domain = up.getOption('domain');
                // var res = parseJSON(info);
                info = jQuery.parseJSON(info);
                info['_csrf'] = jQuery('meta[name="csrf-token"]').attr("content");

                jQuery.ajax({
                    type:'post',
                    url:'<?=Url::to(['image-upload/preview']);?>',
                    data:info,
                    dataType:'json',
                    success:function(data){
                        //add to form
                        var str = '<input name="images[]" value="'+data.url+'">';
                        jQuery('div#image_files').append(str);

                        //show image
                        str ='<span class="image"><img src="'+data.url+'"  ><b>x</b></span>';
                        var ele = jQuery(str);
                        ele.find('b').click(function(){
                            del_image(jQuery(this).parents('span.image'));
                        });

                        jQuery('div#image_display').append(ele);

                        //remove tip
                        jQuery('#loader').hide();

                    },
                    error:function(){
                        alert('上传失败，请重试');
                    }
                });

            },
            'Error': function(up, err, errTip) {
                //上传出错时,处理相关的事情
                alert(errTip);
            },
            'UploadComplete': function() {
                //队列文件处理完毕后,处理相关的事情

            },
            'Key': function(up, file) {
                // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                // 该配置必须要在 unique_names: false , save_key: false 时才生效
                var now = new Date();
                var year = now.getFullYear();
                var month = now.getMonth();
                var day = now.getDay();


                var key = year+'/'+month+'/'+day+'/'+now.getTime()+'_img';
                // do something with key here
                return key;
            }
        }
    });



});


function refresh_item_order(ol){

    ol.children('li.clearfix').each(function(index, item) {

        index = parseInt(index);
        item = jQuery(item);

        var num = item.children('.item-num');
        if (num.length) {
            num.html((index + 1) + '.&nbsp;');
        } else {
            item.prepend('<span class="flt item-num">'+(index + 1)+'.&nbsp;</span>');
        }
    });

}

function del_return_item(item,checkbox){

     item.parents('li').remove();

     checkbox.prop("checked",false);

}


function change_num(id) {
    var p_nums = jQuery('input#product_'+id+'_num' ).val();
    var p_real_num = jQuery('input#product_info_'+id+'_quantity').val();
    if (p_nums > p_real_num || p_nums < 0 ) {
        jQuery('#error_' + id ).val(1);
        str = '所填数量有误，请修改！';
        jQuery('#error_info_' + id).html(str);
    } else {
        jQuery('#error_' + id ).val(0);
        str = '';
        jQuery('#error_info_' + id ).html(str);
    }
}


function del_image(ele){

    jQuery('div#image_files').children('input').each(function(){
        if(jQuery(this).val()==ele.find('img').attr('src')){
            jQuery(this).remove();
        }
    });

    ele.remove();
}





</script>