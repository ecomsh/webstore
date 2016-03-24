<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '我的评论_上海外高桥进口商品网';
?>
<div style = "width: 960px;" class = "member-main">
    <div class = "title title2">我的评论</div>
    <script>
        function dis(comment_id, url) {
            $$('.reply_' + comment_id).setStyle('display', 'block');
            $('dis_' + comment_id).setStyle('display', 'none');
            $('none_' + comment_id).setStyle('display', 'block');
            new Request({url: url, method: 'post'}).send();
        }

        function none(comment_id) {
            $$('.reply_' + comment_id).setStyle('display', 'none');
            $('dis_' + comment_id).setStyle('display', 'block');
            $('none_' + comment_id).setStyle('display', 'none');
        }

    </script>
    <div id="tab-discus" class="section switch">
        <ul class="switchable-triggerBox tab_member clearfix">
            <li class="active"><a href="#">我的评论</a></li>
        </ul>
        <div class="switchable-content switchable-content2">
            <div class="switchable-panel">
                <table class="gridlist gridlist_member" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr>
                            <th class="blrn" width="30%">评论商品</th>
                            <th width="12%">评论星级</th>
                            <th width="44%">评论内容</th>
                            <th width="14%">回复内容</th>
                        </tr>
                        <tr>
                            <td style="width:240px;">
                                <dl>
                                    <dt><a href="<?= Yii::$app->params['baseUrl'] ?>product-1487.html" target="_blank" style="width:90px; height:90px;overflow:hidden;"><img style="width:60px; height:60px;overflow:hidden;" src="<?= Yii::$app->params['baseimgUrl'] ?>50dbe183f4613c2c93e64fe2f9a0b661a6b.jpg"> </a>
                                    </dt>
                                    <dd class="width_150h" style="padding-left:10px;"><a href="<?= Yii::$app->params['baseUrl'] ?>product-1487.html">美国 CeraVe 补水保湿滋润洗面奶  87ml</a></dd>
                                </dl></td>
                            <td class="star-div"><ul><li class="star5"></li></ul></td>
                            <td>
                                <ul class="plgl">
                                    <li><span style="width:230px; overflow:hidden; float:left">评论：测试收货后评价</span><span style="float:right; color:#999; width:90px;">15-05-25 10:43</span></li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li class="clearfix" style=" margin:20px auto;">
                                        <div id="dis_1220" class="clearfix">
                                            <a style="cursor:pointer;margin-left:15px" onclick="dis(1220, '<?= Yii::$app->params['baseUrl'] ?>member-set_read-1220-discuss.html');" class="btn-a flt"><span>回复</span></a>
                                            <span class="db p5 flt font-orange">1</span>
                                        </div>
                                        <div id="none_1220" style="float:left; padding:0 15px 0 0;display:none;" class="upstore">
                                            <a style="cursor:pointer" onclick="none(1220);" class="btn-a"><span>收起回复</span></a>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr style="display:none" id="reply_1221" class="reply_1220">
                            <td colspan="4" style="padding:0">
                                <table bgcolor="#f9f9f9" width="988">
                                    <tbody><tr>

                                            <td class="textleft color1" width="12%">管理员回复：</td>
                                            <td class="textleft" width="61%">
                                                谢谢亲的光顾（test）
                                            </td>
                                            <td class="textcenter"><span style="color:#999">15-05-25 10:44</span></td>
                                            <td class="textleft" width="12%"></td>
                                        </tr>
                                    </tbody></table>
                            </td>

                        </tr>
                    </tbody></table>
            </div>
        </div>
    </div>
</div>
