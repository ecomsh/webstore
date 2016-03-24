<?php

use yii\helpers\Url;

?>



<form method="post" action="<?=Url::to(['cashier/createorder']); ?>" onkeydown="if(event.keyCode==13)return false;">
    <input name="_csrf" value="<?=Yii::$app->request->getCsrfToken();?>" type="hidden">
    <input name="uid" value="<?=$uid?>" type="hidden">
    <input name="addrid" value="<?=$address['addressId']?>" type="hidden">



    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">商品清单</h3>
                </div>
                <div class="panel-body orderlist">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>商品编号</th>
                            <th>商品名称</th>
                            <th class="narrow">单价</th>
                            <th class="narrow">行邮税</th>
                            <th class="narrow">数量</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach( $items as $item ) :?>

                        <tr class="item">
                            <td><input name="id[]" class="id text" readonly="readonly" value="<?=$item['id']?>"></td>
                            <td><textarea name="name[]" class="name text" readonly="readonly"><?=$item['name']?></textarea></td>
                            <td class="narrow"><input name="price[]" class="price text" readonly="readonly" value="<?=$item['price']?>"></td>
                            <td class="narrow"><input name="tax[]" class="tax text" readonly="readonly" value="<?=$item['tax']?>"></td>
                            <td><input name="num[]" class="num text"  value="<?=$item['num']?>"></input></td>
                        </tr>

                        <?php endforeach; ?>


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">收货地址</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-1" style="text-align:right;">
                            <p>收件人:</p>
                            <p>地址:</p>
                        </div>

                        <div class="col-xs-10" style="text-align:left;">
                            <p><?= $address['receiverName']?> (<?= $address['receiverMobile'] ?>)</p>
                            <p><?= $address['stateName'] ?> <?= $address['cityName'] ?> <?= $address['districtName'] ?> <?= $address['address'] ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">支付信息</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-2" style="text-align:right;">
                            <p>商品总价 :</p>
                            <p>行邮税 :</p>
                            <p>运费 :</p>
                            <p>应支付总金额 :</p>
                            <p>支付方式 :</p>
                        </div>
                        <div class="col-xs-2" style="text-align:left;">
                            <p><?=$priceInfo['originalPrice']?></p>
                            <p><?=$priceInfo['tax']?></p>
                            <p><?=$priceInfo['shipping']?></p>
                            <p><?=$priceInfo['final']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div calss="row">
        <div class="col-xs-12">
            <button class="btn btn-success">下单</button>
        </div>
    </div>

</form>