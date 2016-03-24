<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\LinkPager;
use frontend\assets\ProductAsset;
use frontend\widgets\Alert;
ProductAsset::register($this);


/* @var $this yii\web\View */
$this->title = '我的评论_上海外高桥进口商品网';
?>
<style>
    .pager a{display:block;}
</style>
<div style = "width: 960px;" class = "member-main">
    <div class = "title title2">我的评论</div>
    <script>
        function dis(comment_id, url) {
            $$('.reply_' + comment_id).setStyle('display', '');
            $('dis_' + comment_id).setStyle('display', 'none');
            $('none_' + comment_id).setStyle('display', '');
            new Request({url: url, method: 'post'}).send();
        }

        function none(comment_id) {
            $$('.reply_' + comment_id).setStyle('display', 'none');
            $('dis_' + comment_id).setStyle('display', '');
            $('none_' + comment_id).setStyle('display', 'none');
        }
    </script>
    
    <div id="tab-discus" class="section switch">
        <ul class="switchable-triggerBox tab_member clearfix">
            <li class="active"><a href="#">我的评论</a></li>
        </ul>
        <?php
            echo Alert::widget();
        ?>
        <div class="switchable-content switchable-content2">
            <div class="switchable-panel">
                <table class="gridlist gridlist_member" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                        <tr>
                            <th class="blrn" width="30%">评论商品</th>
                            <th width="12%">评论星级</th>
                            <th width="44%">评论内容</th>
                            <th width="14%">回复内容</th>
                        </tr>
                        <?php
                        if ($data & is_array($data))
                        {
                            foreach ($data as $k => $v):
                                ?>
                        <tr>
                            <td style="width:240px;">
                                <dl>
                                    <dt><a href="<?= Yii::$app->params['baseUrl'] ?>product-<?= Html::encode($v['productId']) ?>.html" target="_blank" style="width:90px; height:90px;overflow:hidden;"><img style="width:60px; height:60px;overflow:hidden;" src="<?= Yii::$app->params['baseimgUrl'] ?>50dbe183f4613c2c93e64fe2f9a0b661a6b.jpg"> </a>
                                    </dt>
                                    <dd class="width_150h" style="padding-left:10px;"><a href="<?= Yii::$app->params['baseUrl'] ?>product-<?= Html::encode($v['productId']) ?>.html">美国 CeraVe 补水保湿滋润洗面奶  87ml</a></dd>
                                </dl></td>
                            <td class="star-div"><ul class="fl"><li class="star<?= Html::encode($v['point']) ?>"></li></ul></td>
                            <td>
                                <ul class="plgl">
                                    <li><span style="width:230px; overflow:hidden; float:left">评论：<?= Html::encode($v['content']) ?></span><span style="float:right; color:#999; width:90px;"><?= Html::encode($v['createTime']) ?></span></li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li class="clearfix" style=" margin:20px auto;">
                                        <div id="dis_<?= Html::encode($v['id']) ?>" class="clearfix">
                                            <a style="cursor:pointer;margin-left:15px" onclick="dis('<?= Html::encode($v['id']) ?>', '');" class="btn-a flt"><span>查看回复</span></a>                                            
                                        </div>
                                        <div id="none_<?= Html::encode($v['id']) ?>" style="float:left; padding:0 15px 0 0;display:none;" class="upstore">
                                            <a style="cursor:pointer" onclick="none('<?= Html::encode($v['id']) ?>');" class="btn-a"><span>收起回复</span></a>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr style="display:none" id="reply_<?= Html::encode($v['id']) ?>" class="reply_<?= Html::encode($v['id']) ?>">
                            <td colspan="4" style="padding:0">
                                <table bgcolor="#f9f9f9" width="960">
                                    <tbody>
                                        <tr>
                                            <td class="textleft color1" style="width:267px">管理员回复：</td>
                                            <td class="textleft" width="85%">
                                                <?= Html::encode(isset($v['responseContent'])?$v['responseContent']:'管理员暂时没有回复') ?>
                                            </td>                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
    
                        </tr>
                    <?php
                        endforeach;                        
                    }
                    ?>
                    </tbody>
                </table>               
            </div>            
        </div>
    </div>   
    <div class="pager">
    <?php
        echo LinkPager::widget([
                'pagination' => $pages,       
                'linkOptions' => [],
                'prevPageLabel' => '上一页',
                'nextPageLabel' => '下一页',
                'prevPageCssClass' => 'prev',
                'internalPageCssClass' => 'pagernum',
                'activePageCssClass' =>'pagecurrent', 
                'nextPageCssClass' => 'unnext',
            ]);
    ?>    
    </div>
</div>
