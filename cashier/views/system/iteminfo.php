

<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use frontend\widgets\LinkPager;
use cashier\assets\IteminfoAsset;

IteminfoAsset::register($this);

$iteminfo = Yii::$app->request->get('iteminfo');
$item = Yii::$app->request->get('item');

$this->title = "管理后台";
?>
<style type="text/css">
    .container-fluid{height: 100%;}
    .main{margin-left: -15px;height: 100%;}

</style>
<div class="main">
    <?= $this->render('../layouts/system_nav_left') ?>
    <div class="system-right">
        <h3><span></span> 商品查询</h3><br>
        <?= Html::beginForm(['system/iteminfo'], 'get', ['enctype' => 'multipart/form-data', 'id' => 'frm']) ?>
        <div id="item">
            <label><input <?php if(isset($item) && $item == 'itemid'):?> checked="checked" <?php endif;?>type="radio" name="item" id="item-id" value="itemid"/>商品编号</label>
            <label><input <?php if(isset($item) && $item == 'itemname'):?> checked="checked" <?php endif;?>type="radio" name="item" id="item-name" value="itemname"/>商品名称</label><br>
        </div>
        <div>
            输入信息 : <input type="text" <?php if(!isset($iteminfo)):?>disabled="disabled"<?php endif;?> <?php if(!empty($iteminfo)):?> value="<?= $iteminfo?>" <?php endif;?>name= "iteminfo" id="item-input" onfocus="this.select()" onmouseover="this.focus()" placeholder= "商品信息">
            <button id ="submit_btn" type="submit" <?php if(empty($item) || empty($iteminfo)):?>disabled="disabled" <?php endif;?>>搜索</button>
        </div>
        <?php if(isset($errormsg)):?>
        <div class="tips">
            <span><?= $errormsg?> </span>
        </div>
        <?php endif;?>
        <?= Html::endForm() ?>
        <div class="inright">
            <?php if (isset($showEmpty) && $showEmpty): ?>
                <div >
                    <span class="emptyinfo">未查到符合条件的商品数据，请更改查询条件</span>
                </div>
            <?php elseif (!empty($iteminfo) && isset($displayInfo)): ?>
                <table border="1" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>商品编号</th>
                            <th>商品名称</th>
                            <th>商品品牌</th>
                            <th>原价</th>
                            <th>销售价</th>
                            <th>活动价</th>
                            <th>当前可用库存</th>
                        </tr>
                    </thead>
                    <tbody>
                    <div class="list-view">
                        <div>
                            <tr>
                                <th><?= $displayInfo['id'] ?></th>
                                <th><?= $displayInfo['name'] ?></th>
                                <th><?= $displayInfo['brand'] ?></th>
                                <th><?= $displayInfo['listprice'] ?></th>
                                <th><?= $displayInfo['offerprice'] ?></th>
                                <th><?= $displayInfo['promotprice'] ?></th>
                                <th><?= $displayInfo['itemInv'] ?></th> 
                            </tr>
                        </div>
                    </div>
                    </tbody>
                </table>
            <?php else: endif; ?>
        </div> 
        <!-- 弹层 开始 -->
        <div class="cover" style="<?= isset($count) ? 'display:block;' : 'display:none;' ?>">
            <div class="cover-bg"></div>
            <div class="cover-list">
                <p class="title">关键词“<?= $iteminfo ?>”查找到如下商品</p>
                <?php if (isset($count)): ?>
                    <ul>
                        <?php foreach ($searchList as $v) { ?>
                            <li><a href="<?= Url::to(['system/iteminfo', 'item' => 'itemid', 'iteminfo' => $v['id']], true) ?>"><?= $v['name'] ?></a></li>
                        <?php } ?>
                    </ul>
                <?php endif; ?>
                <div class="my-btn">
                    <button class="cancel">取消</button>
                </div>
            </div>
        </div>
        <!-- 弹层 结束 -->
    </div>
</div>

