<style>
  .itemList{
    width:100%;
    border-top: 1px dashed #000;
    border-bottom: 1px dashed #000;
  }

  .item-name{
    text-align:center;
  }

  .footer{
    text-align:center;
  }

</style>
<div class="printer-container">
  <div class="row header">
    <div class="col-xs-12">
      <p class="title">FTZMall O2O <span id="receipt-storeName"><?=$data['storeName']?></span></p>
      <p> <span id="receipt-time"><?=$data['time']?></span></p>
      <p>订单号:<span id="receipt-orderId" ><?=$data['orderId']?></span></p>
    </div>
  </div>
  <table class="itemList">
    <thead>
      <tr>
        <th>商品名称</th>
        <th>货号</th>
        <th>数量</th>
        <th>税费</th>
        <th>金额</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['items'] as $item): ?> 
        <tr>
          <td class="item-name"><?=$item['name']?></td>
          <td class="id" style="text-align:center;max-width:20%;word-break:break-all;"><?=$item['id']?></td>
          <td class="num" style="text-align:center"><?=$item['num']?></td>
          <td class="tax" style="text-align:center"><?=$item['tax']?></td>
          <td class="price" style="text-align:center"><?=$item['price']?></td>
        </tr>
      <?php endforeach; ?> 
    </tbody>
  </table>
  <div class="sum">
    <p>共计<span id="receipt-totalNum"><?=$data['totalNum']?></span>件商品</p>
    <p>商品原始价：<span id="receipt-originalPrice" ><?=$data['originalPrice']?></span></p>
    <p>行邮税原始价：<span id="receipt-tax" ><?=$data['tax']?></span></p>
    <p>优惠后行邮税：<span id="receipt-realTax" ><?=$data['realTax']?></span></p>
    <p>运费：<span id="receipt-shipping" ><?=$data['shipping']?></span></p>
    <p>优惠：<span id="receipt-promotion" ><?=$data['promotion']?></span></p>
    <p>支付总价：<span id="receipt-finalPrice" ><?=$data['finalPrice']?></span></p>
    <?php /*<p>支付方式：微信</p>*/ ?>
    <p>收银员：<span id="receipt-cashier" ><?=$data['cashier']?></span></p> 
  </div>  
  <div class="footer">
    <p>*****谢谢光临，请妥善保管收银条*****</p>
  </div>
</div>



<script type="text/javascript">
window.print();
</script>