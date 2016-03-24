<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use cashier\assets\CashierAsset;
CashierAsset::register($this);
$this->title = "系统收银";
?>



<body>

<!-- address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addressModalLabel">添加地址</h4>
      </div>
      <div class="modal-body">
        <!--cp from frontend-->
        <?php
        $form = ActiveForm::begin(['options'=>['id'=>'addressForm','class'=>'aaa']]);
        ?>
        <input type="hidden" id="userid" name="userid" value="123">
        <input type="hidden" id="addrid" name="addrid" >
        <!-- <? /*$form->field($addressModel, 'receiverName')->textInput([ 'class' => 'form-control', 'placeholder' => '收货人姓名']) */?>-->
        <div class="form-group field-addressapi-receivername">
            <label class="control-label" for="addressapi-receivername">收货人：</label>
            <input type="text" id="addressapi-receivername" class="form-control" name="AddressApi[receiverName]" style="max-width:690px;max-height:340px" placeholder="收件人姓名">
        </div>
        <?= $form->field($addressModel, 'receiverMobile')->textInput(['class' => 'form-control', 'placeholder' => '手机号码']) ?>
        <?= $form->field($addressModel, 'stateCode')->dropDownList(['' => '请选择'], [ 'class' => 'form-control', 'data-level-index' => 0]) ?>
        <?= $form->field($addressModel, 'cityCode')->dropDownList(['' => '请选择'], ['class' => 'form-control', 'data-level-index' => 0]) ?>
        <?= $form->field($addressModel, 'districtCode')->dropDownList(['' => '请选择'], [ 'class' => 'form-control', 'data-level-index' => 0]) ?>
        <?= $form->field($addressModel, 'stateName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'provice1']) //id指定后将不能自动描红?>
        <?= $form->field($addressModel, 'cityName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'city1']) ?>
        <?= $form->field($addressModel, 'districtName', ['labelOptions' => ['style' => 'display:none'],'errorOptions' => ['style' => 'display:none']])->textInput(['type' => 'hidden', 'id' => 'district1']) ?>

        <div class="form-group field-addressapi-address">
            <label class="control-label" for="addressapi-address">地址：</label>
            <input type="text" id="addressapi-address" class="form-control" name="AddressApi[address]" style="max-width:690px;max-height:340px" placeholder="详细地址">
        </div>
        <?php ActiveForm::end(); ?>
        <!--/cp from frontend-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="add_addr_btn" style="display:none;">增加</button>
        <button type="button" class="btn btn-primary" id="modify_addr_btn">保存修改</button>
      </div>
    </div>
  </div>
</div>
<!-- address Modal end -->

<form id="orderForm" method="post" action="<?=Url::to(['cashier/confirm']) ?>" onkeydown="if(event.keyCode==13)return false;">
  <input name="_csrf" value="<?=Yii::$app->request->getCsrfToken();?>" type="hidden">
  <input type="hidden" id="orderUserId" name="orderUserId">
  <input type="hidden" id="orderAddrId" name="orderAddrId">

  <input id="order_countryCode" name="countryCode" value="" type="hidden">
  <input id="order_stateCode" name="stateCode" value="" type="hidden">
  <input id="order_stateName" name="stateName" value="" type="hidden">
  <input id="order_districtCode" name="districtCode" value="" type="hidden">
  <input id="order_districtName" name="districtName" value="" type="hidden">
  <input id="order_cityCode" name="cityCode" value="" type="hidden">
  <input id="order_cityName" name="cityName" value="" type="hidden">
  <input id="order_postcode" name="postcode" value="" type="hidden">
  <input id="order_addressName" name="addressName" value="" type="hidden">
  <input id="order_address" name="address" value="" type="hidden">
  <input id="order_receiverName" name="receiverName" value="" type="hidden">
  <input id="order_receiverMobile" name="receiverMobile" value="" type="hidden">
  <input id="order_receiverPhone" name="receiverPhone" value="" type="hidden">
  
<!--  <header>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3">
        <h2>FTZMALL</h2>
      </div>
      <div class="col-sm-6">
        <div class=" col-xs-12 form-group" style="">
          <div class="phone-bg">
            <div class="form-inline text-center">
              <div class="form-group">
                <label for="inputPassword">输入信息：</label>
                <input type="text" class="form-control input-sm inpuw-w" id="webpos-input" onfocus="this.select()" onmouseover="this.focus()" placeholder="手机号/商品编号">
              </div>
              <button type="button" class="btn btn-sm btn-success" id="webpos-query-btn" onclick="onWebposQueryClick()">查询</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <h2>
          <a href="<?=Url::to(['login/logout']) ?>" class="btn btn-default btn-danger pull-right">退出</a>
        </h2>
      </div>
    </div>
  </div>
</header>-->

  <div class="row">
    <div class="col-xs-12">
      <h4 class="text-primary">
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        &nbsp;当前顾客：
        <span id="uname"></span>
      </h4>
      <div class="addresslist">

        <div class="add_addr" style="display:none;">
          <div class="inner">
            <button type="button" id="addr_modal_btn" class="btn btn-info add-btn" data-toggle="modal" data-target="#addressModal">添加地址</button>
          </div>
        </div>
        <button type="button" id="addr-hide-btn" class="btn btn-info">收起/显示</button>
      </div>
    </div>
  </div>

  <div id="loader"></div>


  <div class="row orderlist">
    <div class="col-xs-12">
      <table class="table table-hover table-bordered pro-list">
        <thead>
          <tr>
            <th class="item_num" width="15%">商品编号</th>
            <th width="40%">商品名称</th>
            <th width="15%">单价</th>
            <th width="10%">行邮税</th>
            <th width="10%">数量</th>
            <th width="10%">操作</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>

  <nav class="row navbar-fixed-bottom">
    <div class="col-xs-12">
      <div class="totalprice-bg">
      <!--
        <div class="form-horizontal col-xs-4 text-left">
         
          <div class="form-group">
            <label for="order-input" class="col-md-4 control-label" style="texte-align:right;">输入:</label>
            <div class="col-md-6">
              <input class="form-control input-sm" id="order-input" onfocus="this.select()" onmouseover="this.focus()" placeholder="商品货号">
            </div>
            <div class="col-md-2">
            </div>
          </div> 
        </div> -->

       <!--  <div class="col-xs-3">
            <p id="alert" class="pay-color"></p>
        </div> -->
        <div class="col-xs-7">
          <p class="col-xs-12">
            　商品总价：<span class="total-price">￥<span id="totalPrice">0</span></span>
          </p>
          <p class="col-xs-12">
           行邮税总价：<span class="total-price">￥<span id="totalTax">0</span></span>
          </p>
        </div>
        <div class="col-xs-5 text-right" >
          <button id="order_next" type="button" class="btn btn-info step-btn">下一步</button>
        </div>
      </div>
    </div>
  </nav>

</form>

<form id="confirmForm" method="post" action="<?=Url::to(['cashier/createorder']); ?>" onkeydown="if(event.keyCode==13)return false;">
  <input name="_csrf" value="<?=Yii::$app->request->getCsrfToken();?>" type="hidden">
  <input id="uid" name="uid" value="" type="hidden">
  <input id="addrid" name="addrid" value="" type="hidden">

  <input id="confirm_countryCode" name="countryCode" value="" type="hidden">
  <input id="confirm_stateCode" name="stateCode" value="" type="hidden">
  <input id="confirm_stateName" name="stateName" value="" type="hidden">
  <input id="confirm_districtCode" name="districtCode" value="" type="hidden">
  <input id="confirm_districtName" name="districtName" value="" type="hidden">
  <input id="confirm_cityCode" name="cityCode" value="" type="hidden">
  <input id="confirm_cityName" name="cityName" value="" type="hidden">
  <input id="confirm_postcode" name="postcode" value="" type="hidden">
  <input id="confirm_addressName" name="addressName" value="" type="hidden">
  <input id="confirm_address" name="address" value="" type="hidden">
  <input id="confirm_receiverName" name="receiverName" value="" type="hidden">
  <input id="confirm_receiverMobile" name="receiverMobile" value="" type="hidden">
  <input id="confirm_receiverPhone" name="receiverPhone" value="" type="hidden">

<!--  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
          <h2>FTZMALL</h2>
        </div>
      </div>
    </div>
  </header>-->

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
                <th class="">商品名称</th>
                <th class="narrow">单价</th>
                <th class="narrow">行邮税</th>
                <th class="narrow">数量</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <nav class="row navbar-fixed-bottom">
    <div class="col-xs-12">
      <div class="panel panel-default panel-m">
        <div class="panel-heading">
          <h3 class="panel-title">收货地址/支付信息</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-xs-4 text-right">
                  <p>收件人：</p>
                  <p>地址：</p>
                </div>
                <div class="col-xs-8 text-left">
                  <p>
                    <span id="addr_receiver_name"></span> (<span id="addr_receiver_mobile"></span>)
                  </p>
                  <p>
                    <span id="addr_state_name"></span>
                    <span id="addr_city_name"></span>
                    <span id="addr_district_name"></span>
                    <span id="addr_addr"></span>
                    <span id="addr_alert"></span>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-4 text-right">
                  <p>商品总价 :</p>
                  <p>优惠价格 :</p>
                  <p>行邮税 :</p>
                  <p>实际行邮税</p>
                  <p>运费 :</p>
                  <p>应支付总金额 :</p>
                </div>
                <div class="col-xs-8 text-left pay-color">
                  <p id="original_price"></p>
                  <p> <span id="promotion_price"></span> <span id="promotion_items"></span>  </p>
                  <p id="tax"></p>
                  <p id="real_tax"></p>
                  <p id="shipping"></p>
                  <p id="final_price"></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 text-right">
              <div class="col-xs-12 text-right price-p">
                <button id="confirm" type="button" class="btn btn-success step-btn"  >下单</button>
                <button id="confirm_pre" type="button" class="btn btn-danger step-btn" >上一步</button>
              </div>
            </div>
          </div>       
        </div>
      </div>
    </div>
  </nav>

</form>

<div id="payMethod" style="display:none; text-algin:center; padding:200px 0;max-width: 500px;margin: auto;" >
   <div class="row">
        <div class="col-xs-12">
            <a  id="wechatpay-btn" href="<?=Url::to(['cashier/wechat']) ?>" class="btn btn-success" style="display:block;margin:5px auto;" >微信支付</a>
        </div>
       <div class="col-xs-12">
            <a id="alipay-btn" href="<?=Url::to(['cashier/alipay']) ?>" class="btn btn-primary" style="display:block;margin:5px auto;" >支付宝支付</a>
        </div>
    </div>
</div> 


<!--<div  id="qrcode" style="display:none; text-algin:center; padding:200px 0;max-width: 500px;margin: auto;">
    <img style="display:block; height:264px; margin:5px auto;" src="">
    <h4 style="text-align:center;">请打开微信扫码支付</h4>
    <div class="row">
        <div class="col-xs-12">
            <a  href="<?=Url::to(['cashier/index']) ?>" class="btn btn-success" style="display:block;margin:5px auto;" >完成</a>
        </div>
        <div class="col-xs-12" style="display:none;">
            <button  class="btn btn-default btn-block" id="alipay-btn" >使用支付宝支付</button>
        </div>
        <div class="col-xs-12">
            <button id="printReceipt" class="btn btn-primary" style="width:100%;display:block;margin:5px auto;" >补打小票</button>
        </div>
    </div>
</div>-->


<iframe id="printer" style="display:none;"></iframe>
</body>

<script>
<?php $this->beginBlock('js_end') ?>
var URL = {
  queryaddr: '<?=Url::to(['cashier/queryaddr']) ?>',
  modifyaddr: '<?=Url::to(['cashier/modifyaddr']); ?>',
  iteminfo: '<?=Url::to(['cashier/iteminfo']); ?>',
  confirm: '<?=Url::to(['cashier/confirm']); ?>',
  createorder: '<?=Url::to(['cashier/createorder']); ?>',
  paymentstatus: '<?=Url::to(['cashier/paymentstatus']); ?>',
  queryrealname: '<?=Url::to(['cashier/queryrealname']); ?>'
};
var Isnext = "<?= isset($Isnext) ? $Isnext : false ?>";
<?php $this->endBlock() ?>
</script>

<?php $this->registerJs($this->blocks['js_end'], \yii\web\View::POS_END); ?>
