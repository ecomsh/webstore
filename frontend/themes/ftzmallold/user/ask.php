<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '我的咨询_上海外高桥进口商品网';
?>

<div style = "width: 960px;" class = "member-main">
    <div class = "title title2">我的咨询</div>
    <div id = "tab-discus" class = "section switch">
        <ul class = "switchable-triggerBox tab_member clearfix">
            <li class = "active"><a href = "#">我的咨询</a></li>
        </ul>
        <div class = "switchable-content switchable-content2">
            <table class = "gridlist gridlist_member" style = "line-height:20px" border = "0" cellpadding = "0" cellspacing = "0" width = "100%">
                <tbody><tr>
                        <th class = "blrn" width = "40%">咨询商品</th>
                        <th width = "46%">咨询内容</th>
                        <th width = "14%">回复内容</th>
                    </tr>

                    <tr>

                        <td>
                            <a href = "<?= Yii::$app->params['baseUrl'] ?>product-1486.html" target = "_blank" style = "width:90px; height:90px;overflow:hidden;float:left; padding-top:20px">
                                <img style = "width:60px; height:70px;overflow:hidden;" src="<?= Yii::$app->params['baseimgUrl'] ?>2b2a9469839a51be65103ebc924993432e4.jpg">
                            </a>
                            <a href = "<?= Yii::$app->params['baseUrl'] ?>product-1486.html" style = " width:250px; overflow:hidden; float:left; padding-left:10px; padding-top:33px; text-align:left">美国 CeraVe补水保湿滋润洗面奶237ml</a>
                        </td>

                        <td>
                            <span style = " float:left; width:300px;overflow:hidden; text-align:left;">
                                如何能包邮？ </span>
                            <span style = " float:left; width:120px">15-05-22 14:53</span>
                        </td>

                        <td>
                            <a style = "cursor:pointer;margin-left:40px" id = "dis_1218" onclick = "dis(1218, '<?= Yii::$app->params['baseUrl'] ?>member-set_read-1218-ask.html');" class = "btn-a flt"><span>回复(1) </span>
                            </a><a style = "cursor:pointer;margin-left:40px;display:none" id = "none_1218" onclick = "none(1218, '<?= Yii::$app->params['baseUrl'] ?>member-set_read-1218-ask.html');" class = "btn-a flt"><span>
                                    收起回复</span>
                            </a>
                        </td>

                    </tr>

                    <tr>

                        <td colspan = "3" style = "padding:0;display:none" id = "reply_1218">
                            <table bgcolor = "#f9f9f9" width = "988">

                                <tbody><tr>
                                        <td width = "20%">
                                            <span style = " color:red">管理员回复：</span>
                                        </td>

                                        <td width = "66%">
                                            <span style = " float:left; width:508px; text-align:left">抱歉，暂时不支持包邮。</span>
                                            <span style = " float:left; width:100px">15-05-22 14:53</span>
                                        </td>

                                        <td width = "14%"></td>
                                    </tr>


                                </tbody></table>
                        </td>

                    </tr>

                </tbody></table>
        </div>
    </div>
</div>
<script>
    function dis(comment_id) {
        $('reply_' + comment_id).setStyle('display', 'block');
        $('dis_' + comment_id).setStyle('display', 'none');
        $('none_' + comment_id).setStyle('display', 'block');
    }

    function none(comment_id) {
        $('reply_' + comment_id).setStyle('display', 'none');
        $('dis_' + comment_id).setStyle('display', 'block');
        $('none_' + comment_id).setStyle('display', 'none');
    }

</script>