
/*
    购买数量调节begin
    跟购物车页面的可共用，回头问问代成俊大哥
    需要传递的参数：
        _maxbuy=50;   //为定义的最大购买数量
        salstype = 1;  //1,2,3,4,5 未来config里配置
        _buynum_min = 2; //起订数量 必然存在 不存在则定为 1 
        _buynum_max = 20;//限购数量
*/

function getStore () {
    //return 30;//测试用 否则都是0
    return parseInt($('#inventory').html());
};

function getMaxBuy(){
    var maxtotal= 800;//跨境商品最大总价
    var price   = $("input[name='offergoodsprice']").val();
    while(isNaN(price.substr(0,1))) { //去除第一位数字前的所有字符
        price = price.substr(1);
    }
    var maxbuy  = price>maxtotal?1:parseInt(maxtotal/price,10);
    return maxbuy;
}

//num:数值 notice:是否有alert
function setNum(num,notice){
    num = parseInt(num,10);
    var text = '';
    if (!num || num == 'NaN')
        num = _buynum_min;
    //低于起订
    if(num < _buynum_min){
        num = _buynum_min;
    }
    //高于限购
    if(_buynum_max && num > _buynum_max){
        num = _buynum_max;
        text = '超出限购';
    }
    //高于库存
    var store = getStore();
    if(store == 0){
        num = 0;
        text = '';
    }else if(num > store){
        num = store;
        text = '超出库存';
    }
    //境外不超过1K
    var tmp = getMaxBuy();
    if(salestype != 1 && salestype != 2 && num > tmp){
        num = tmp;
        notice = true;//必然提示
        text = '跨境商品总金额不能超过800';
    }

    //定义的最大购买数量
    if(_maxbuy && num > _maxbuy){
        num = _maxbuy;
        text = '';
    }
    $('#goods-viewer .Num')[0].value = num;
    $('#goods-viewer .Num').attr('value', num);
    if(text && notice){
        message.alert(text);
    }
}

//init:表示初始化 会绑定事件
function changebuynum(init){
    if(getStore()){
        var _num_init = Math.max(_buynum_min,$('#goods-viewer .Num')[0].value);
    }else{
        var _num_init = 0;
    }
    setNum(_num_init,0);
    if(_buynum_min > 1){
        //message.alert('起订数量'+_buynum_min);//商品有起订数量，则数量文本框内默认为起订数量
    }
    if(_buynum_max){
        //在数量文本框后面显示提示信息“（限购××件）”
    }
    //这里还有TC051 052
    if(init) {
        $('#goods-viewer input[name="goodsnum"]').on({
            'keydown': function (e) {
                //console.log(e.keyCode);
                return;
            },

            "keyup": function () {
                setNum(this.value, 1);
            },

            'blur': function () {
                setNum(this.value, 1);
            }
        });

        $('#goods-viewer .substract').click(function (e) { //减
            var val = $('#goods-viewer .Num').attr('value');
            setNum(parseInt(val) - 1, 0);
        });
        $('#goods-viewer .plus').click(function (e) { //加
            var val = $('#goods-viewer .Num').attr('value');
            setNum(parseInt(val) + 1, 0);
        });
    }
}

/*
    获取库存函数begin
    需要传参数 ：
        itemPartNumber = "0001043001";
        buyable = 1;   0为已下架，1为销售中
        tmp_url = "index.php?r=product/getinventory";
*/  
 
function getInventory(_csrf,itemPartNumber,buyable,tmp_url)
{                             
    if(buyable == 0)
    {    
        $('#addtocart_box').css('display','none');
        $('#buynow_box').css('display','none');
        $('#addunabled_box').css('display','none');
        $('#xiajia2').css('display','block');
    }     

    else
    {
        $('#xiajia2').css('display','none');        
        var stateCode = $('#stateCode').val();
        //console.log(stateCode);
        var inventory = ({ //获取库存
            "_csrf" : _csrf,
            "itemPartNumber" : itemPartNumber,
            "itemOrg" : "ftzmall",
            "shop" : "ftzmall",
            "country" : "CN",
            "stateCode" : stateCode,
            //"queryItemType" : "Product", //
        });   
        //console.log(inventory);
        $.ajax({
            type: 'post',
            url: tmp_url,
            data: inventory,
            success: function(res){    
                $('#inventory').html(res); 
                changebuynum();
                var aaa =  $('#inventory').html(); 
                if(aaa==0)
                {
                    $('#addtocart_box').css('display','none'); 
                    $('#buynow_box').css('display','none');
                    $('#addunabled_box').css('display','block');
                    $('#adding_box').css('display','none');  
                    //$('.search-none').css('display','block');
                    $('.kcjz').css('display','none');
                    return false;
                }
                else if(aaa>0&&aaa<11)
                {                
                    $('#addunabled_box').css('display','none');
                    $('#addtocart').css('background-color','#ed145b');
                    $('#buynow').css('background-color','#ed145b');
                    //$('.search-none').css('display','none');
                    $('.kcjz').css('display','inline-block');
                }
                else{
                    $('#addunabled_box').css('display','none');             
                    $('#addtocart').css('background-color','#ed145b');
                    $('#buynow').css('background-color','#ed145b');
                    //$('.search-none').css('display','none');
                    $('.kcjz').css('display','none');
                }
                            
            },                                                     

            error: function(){                
                //console.log(res);
                $('#inventory').html(0); 
                changebuynum();
                $('#addtocart_box').css('display','none'); 
                $('#buynow_box').css('display','none');
                $('#addunabled_box').css('display','block');
                $('#adding_box').css('display','none');
                //$('.search-none').css('display','block');
                $('.kcjz').css('display','none');
                addtocart(_csrf,userId,loginurl,addtocarturl);
            },
        }); 
    } 

}  

/*
    获取库存函数end
*/  

/*
    获取价格函数begin
    需要传参数 ：
        itemPartNumber = "0001043001";        
        type = "product"; 或者package,有的话返回所有价格，包括sku产品的
*/  

function getProductprice(_csrf,itemPartNumber,shop,tmp_url,type)
{   
    var params = ({
        "_csrf" : _csrf,       
        "itemPartnumber" : itemPartNumber, //这个现在是父级商品的itempartnumber
        "itemOrg" : "ftzmall",
        "shop" : shop,
        "queryItemType" : type,     
    });  

    $.ajax({
        type: 'post',
        url: tmp_url,
        data: params,
        success: function(res){            
            pricelist = res;
            /* 防止pricelist传回来为空或者错误数据的情况下税率不对，所以先基于search返回的数据做一次getTax */
            var offergoodsprice = $("#offergoodsprice").val();
            getskuMapValue(_csrf, skuMap, itemId, itemPartNumber, buyable, shop, priceposturl, inventoryposturl,taxRate,goodstype);
            addtowishlist(_csrf,userId,loginurl,addtowishlisturl);     
            addtocart(_csrf,userId,loginurl,addtocarturl);           
             //由于需要读取pricelist的数据，必须等pricelist返回，所以第一次调用在这里...
        },                                          
        error: function(){
            getskuMapValue(_csrf, skuMap, itemId, itemPartNumber, buyable, shop, priceposturl, inventoryposturl,taxRate,goodstype); //由于需要读取pricelist的数据，必须等pricelist返回，所以第一次调用在这里...
            addtowishlist(_csrf,userId,loginurl,addtowishlisturl);
            addtocart(_csrf,userId,loginurl,addtocarturl);
            message.alert("获取价格失败！"); //这块以后会返回别的error message，错误时候返回
        },
    });             
}

function changeProductprice(itemPartNumber, taxRate)
{   
    $('#jiangjia-yuanjia').css('display','none');
    for (var k in pricelist)
    {       
        if(k == fatheritemPartNumber) //先显示父类价格，再做子类覆盖
        {
            var fatherpricelist = pricelist[k]; //缓存这个是为了复写子类的offerprice
            try{
                if(pricelist[k]['offer'].CNY)               
                {                             
                    if( salestype !=1 && salestype!=2)
                    {
                        if((pricelist[k]['offer'].CNY>800 || taxRate >50 || taxRate==50)&& is_cart == 0)
                        {                   
                            $('#addtocart_box').css('display','none');
                            $('#buynow_box').css('display','block');                 
                        }

                        else
                        {   
                            $('#buynow_box').css('display','none');  
                            $('#addtocart_box').css('display','block');
                        }
                    }

                    else
                    {                               
                        $('#buynow_box').css('display','none');  
                        $('#addtocart_box').css('display','block');
                    }

                    $('.goodsprice').html('￥'+pricelist[k]['offer'].CNY); 
                    $('.offerprice-g').html('￥'+pricelist[k]['offer'].CNY); 
                    $("input[id='offergoodsprice']").val(pricelist[k]['offer'].CNY);
                    getTax(pricelist[k]['offer'].CNY,taxRate);
                }
            }catch(e){};

            try{  
                if(pricelist[k]['list'].CNY)
                {                
                    $('.listprice-g').html("￥"+pricelist[k]['list'].CNY); 
                    $("input[id='listgoodsprice']").val(pricelist[k]['list'].CNY);               
                }
            }catch(e){};

            try{
                if (pricelist[k]['promotion'].CNY)
                {
                    if( salestype !=1 && salestype!=2)
                    {
                        if((pricelist[k]['promotion'].CNY>800 || taxRate >50 || taxRate==50) && is_cart == 0)
                        {                   
                            $('#addtocart_box').css('display','none');
                            $('#buynow_box').css('display','block');                 
                        }

                        else
                        {   
                            $('#buynow_box').css('display','none');  
                            $('#addtocart_box').css('display','block');
                        }
                    }

                    else
                    {                               
                        $('#buynow_box').css('display','none');  
                        $('#addtocart_box').css('display','block');
                    }

                    $('.goodsprice').html('￥'+pricelist[k]['promotion'].CNY);
                    $("input[id='offergoodsprice']").val(pricelist[k]['promotion'].CNY);
                    getTax(pricelist[k]['promotion'].CNY,taxRate);
                    $('#jiangjia-yuanjia').css('display','inline-block');
                }
            }catch(e){};
        }  
    }

    for (var k in pricelist)
    {           
        if(k == itemPartNumber) //再做子类覆盖
        {        
            try{
                if(pricelist[k]['offer'].CNY)               
                {
                   if( salestype !=1 && salestype!=2)
                    {
                        if((pricelist[k]['offer'].CNY>800 || taxRate >50 || taxRate==50) && is_cart == 0)
                        {                   
                            $('#addtocart_box').css('display','none');
                            $('#buynow_box').css('display','block');                 
                        }

                        else
                        {   
                            $('#buynow_box').css('display','none');  
                            $('#addtocart_box').css('display','block');
                        }
                    }

                    else
                    {                               
                        $('#buynow_box').css('display','none');  
                        $('#addtocart_box').css('display','block');
                    }

                    $('.goodsprice').html('￥'+pricelist[k]['offer'].CNY); 
                    $('.offerprice-g').html('￥'+pricelist[k]['offer'].CNY); 
                    $("input[id='offergoodsprice']").val(pricelist[k]['offer'].CNY);
                    getTax(pricelist[k]['offer'].CNY,taxRate);
                }
            }catch(e){};

            try{  
                if(pricelist[k]['list'].CNY)
                {                
                    $('.listprice-g').html("￥"+pricelist[k]['list'].CNY); 
                    $("input[id='listgoodsprice']").val(pricelist[k]['list'].CNY);               
                }
            }catch(e){}; 

            try{
                if (fatherpricelist['promotion'].CNY)
                {   
                    if( salestype !=1 && salestype!=2)
                    {
                        if((fatherpricelist['promotion'].CNY>800 || taxRate >50 || taxRate==50) && is_cart == 0)
                        {                   
                            $('#addtocart_box').css('display','none');
                            $('#buynow_box').css('display','block');                 
                        }

                        else
                        {   
                            $('#buynow_box').css('display','none');  
                            $('#addtocart_box').css('display','block');
                        }
                    }

                    else
                    {                               
                        $('#buynow_box').css('display','none');  
                        $('#addtocart_box').css('display','block');
                    }

                    $('.goodsprice').html('￥'+fatherpricelist['promotion'].CNY);
                    $("input[id='offergoodsprice']").val('￥'+fatherpricelist['promotion'].CNY);
                    getTax(fatherpricelist['promotion'].CNY,taxRate);
                    $('#jiangjia-yuanjia').css('display','inline-block');
                }
            }catch(e){}; 

            try{
                if (pricelist[k]['promotion'].CNY)
                {
                    if( salestype !=1 && salestype!=2)
                    {
                        if((pricelist[k]['promotion'].CNY>800 || taxRate >50 || taxRate==50) && is_cart == 0)
                        {                   
                            $('#addtocart_box').css('display','none');
                            $('#buynow_box').css('display','block');                 
                        }

                        else
                        {   
                            $('#buynow_box').css('display','none');  
                            $('#addtocart_box').css('display','block');
                        }
                    }

                    else
                    {                               
                        $('#buynow_box').css('display','none');  
                        $('#addtocart_box').css('display','block');
                    }
                    
                    $('.goodsprice').html('￥'+pricelist[k]['promotion'].CNY);
                    $("input[id='offergoodsprice']").val('￥'+pricelist[k]['promotion'].CNY);
                    getTax(pricelist[k]['promotion'].CNY,taxRate);
                    $('#jiangjia-yuanjia').css('display','inline-block');
                }
            }catch(e){};
        }
    }    
}

/* 与税率有关
    goodspirce = promotionpirce 或者 offerpirce
    taxRate 为税率
*/

function getTax(goodsprice,taxRate)
{
    var tax = Number(goodsprice)*Number(taxRate)/100;
    tax = tax.toFixed(2);                
    $(".tax").html("￥"+tax);
    $(".tax").css("text-decoration",(tax<50||tax==50?"line-through":""));   
    if(goodstype=="package")
    {}
    else if(tax > 50)
    {                    
        $(".tax-free").html("税");
    } 
    else if (0 < tax <= 50) 
    {
        $(".tax-free").html("免");
    };
}

/*
    获取价格函数end       
*/  


/*
    获取skuMapValue函数start
    需要传参数：
        skuMap = <?=json_encode($skumap)?>;
        itemId = 551;   
        itemPartNumber = "0001043001";
        buyable = 1;    0为已下架，1为销售中

*/
    
function getskuMapValue(_csrf, skuMap, itemId, itemPartNumber, buyable, shop, priceposturl, inventoryposturl, taxRate, goodstype){
    if(skuMap == "" || goodstype=="package")
    {
        var skuMapValue = itemPartNumber;       
        var skuMapId = itemId;
        $("input[id='skuMapValue']").val(skuMapValue);
        $("input[id='skuMapId']").val(skuMapId);        
        changeProductprice(skuMapValue, taxRate);
        getInventory(_csrf, skuMapValue, buyable, inventoryposturl);       
    }

    else
    {
        var tmp =""; 
        $("input[id='defining']").each(function(){tmp += $(this).val()+'_'});        
        tmp = tmp.substring(0,tmp.length-1); //tmp就等于skuMap里的key，类似10005_10007_10009      
        //return false;
        if(skuMap[tmp])
        {
            var skuMapValue = skuMap[tmp].partNumber; //skuMapValue就等于skuMap里的value，类似partnumber-1-18  
            var skuMapId = skuMap[tmp].value;
            var skuMapContent = skuMap[tmp].content;
            $("input[id='skuMapValue']").val(skuMapValue);
            $("input[id='skuMapId']").val(skuMapId);
            $("input[id='skuMapContent']").val(skuMapContent);
            if(!skuMapValue)
            {
                message.alert("获取库存跟价格失败...skuMapValue没有赋值");
            }                                            
        }

        else
        {
            var skuMapValue = "";
            $('#addtocart_box').css('display','none'); 
            $('#buynow_box').css('display','none');
            $('#addunabled_box').css('display','block');
            $('#adding_box').css('display','none');
        }

        if(skuMapValue)                                            
        {
            $('#addunabled_box').css('display','none');
            changeProductprice(skuMapValue, taxRate);
            getProductById(skuMapId);
        }                                  
    }
}

/*
    获取skuMapValue函数end
*/      

/*
    加入购物车函数start
    需要传参数:
    userId = "<?= Yii::$app->mobileUser->getId();?>";
    login_url = "index.php?r=passport/login";
    tmp_url = "index.php?r=cart/ajaxcreate";

*/  

function addtocart(_csrf, userId, loginurl, tmp_url){
    
    $('#addtocart').click(function (e)
    { 
        $('#addtocart_box').css('display','none');
        $('#adding_box').css('display','block');
        var skuMapValue = $("input[name='skuMapValue']").val(); //productid数量什么的也这样读    
        var skuMapId = $("input[name='skuMapId']").val();        
        var inventory = $('#inventory').html(); 
        if(!userId)
        {   
            window.location.href = loginurl;
            return false;
        }
        if (!skuMapValue)
        {
            message.alert("加入购物车失败。请选择规格参数");
            return false;
        }
        var num =  $("#Num").val();
        var offset = $("#cart_num").offset();                  
        var params = ({//数组，这个数组，北京写model的姐姐说都要的，但是她貌似也不是很清楚每个参数是干嘛的
            "_csrf": _csrf,                   
            "userId": userId, //买家id required                                     
            "itemId": skuMapId, //skuMapValue 购物车项商品全局唯一Id required
            "itemLink": window.location.href, //购物车项商品的链接 required   
            "extensionData": {//购物车项的扩展数据                    
                "empty": "boolean"
            },                   
            "salestype": salestype, //子类没有这个值会导致加入购物车失败，用父类的
            "cartlineQuantity": num, //买的商品个数                 
            "itemPartNumber": skuMapValue, //partNumber  
            "channelId": channelId,
            'inventory':Number(inventory),
        });        
        //console.log(params);
        $.ajax({
            type: 'post',
            url: tmp_url,
            data: params,
            success: function(res){                  
                //console.log(res);
                $('#addtocart_box').css('display','block');
                $('#adding_box').css('display','none');
                if(res.errorCode){
                    message.alert(res.errorMsg);
                    return;
                }  
                var cartlineId = res.cart.cartlineId;
                try{
                    var cartlineId = res.cart.cartlineId;
                }catch(e){
                    var cartlineId = "abcd"; //强制给一个不是数字的值
                }
                if(isNaN(cartlineId))
                {
                    message.alert('加入购物车失败!');
                    return false;
                }
                else
                {
                    // add by dcj 11.12. In order to refresh the cart number in nav, don't delete.                
                    var newCartNum = Number($("span.car-count").html()) + Number(num);
                    $("span.car-count").html(newCartNum);
                    message.info('加入购物车成功!');
                    $(".ui-dialog").removeClass('show');
                }               
            },
            error: function(res){
                $('#addtocart_box').css('display','block');
                $('#adding_box').css('display','none');
                //console.log(res);
				
				if(res.responseText.indexOf("baokuanshangpin") > 0)
				{
					strs = res.responseText.split(":");
					var errorStr = strs[1].replace("baokuanshangpin","");
					message.alert(errorStr);
				}
				else
				{
                	message.alert("加入购物车失败，没有成功加入购物车"); //这块以后会返回别的error message，错误时候返回
				}
                //message.alert("加入购物车失败，没有成功加入购物车"); //这块以后会返回别的error message，错误时候返回
            },
        });
    });

	$('#addtocart_app').click(function (e)
    { 
        $('#addtocart_box').css('display','none');
        $('#adding_box').css('display','block');
        var skuMapValue = $("input[name='skuMapValue']").val(); //productid数量什么的也这样读    
        var skuMapId = $("input[name='skuMapId']").val();        
        var inventory = $('#inventory').html(); 
        if(!userId)
        {   
            window.location.href = loginurl;
            return false;
        }
        if (!skuMapValue)
        {
            message.alert("加入购物车失败。请选择规格参数");
            return false;
        }
        var num =  $("#Num").val();
        var offset = $("#cart_num").offset();                  
        var params = ({//数组，这个数组，北京写model的姐姐说都要的，但是她貌似也不是很清楚每个参数是干嘛的
            "_csrf": _csrf,                   
            "userId": userId, //买家id required                                     
            "itemId": skuMapId, //skuMapValue 购物车项商品全局唯一Id required
            "itemLink": window.location.href, //购物车项商品的链接 required   
            "extensionData": {//购物车项的扩展数据                    
                "empty": "boolean"
            },                   
            "salestype": salestype, //子类没有这个值会导致加入购物车失败，用父类的
            "cartlineQuantity": num, //买的商品个数                 
            "itemPartNumber": skuMapValue, //partNumber  
            "channelId": channelId,
            'inventory':Number(inventory),
        });        
        //console.log(params);
        $.ajax({
            type: 'post',
            url: tmp_url,
            data: params,
            success: function(res){                  
                //console.log(res);
                $('#addtocart_box').css('display','block');
                $('#adding_box').css('display','none');
                if(res.errorCode){
                    message.alert(res.errorMsg);
                    return;
                }  
                var cartlineId = res.cart.cartlineId;
                try{
                    var cartlineId = res.cart.cartlineId;
                }catch(e){
                    var cartlineId = "abcd"; //强制给一个不是数字的值
                }
                if(isNaN(cartlineId))
                {
                    message.alert('加入购物车失败!');
                    return false;
                }
                else
                {
                    // add by dcj 11.12. In order to refresh the cart number in nav, don't delete.                
                    var newCartNum = Number($("span.car-count").html()) + Number(num);
                    $("span.car-count").html(newCartNum);
                    message.info('加入购物车成功!');
                    $(".ui-dialog").removeClass('show');
                }               
            },
            error: function(res){
                $('#addtocart_box').css('display','block');
                $('#adding_box').css('display','none');
                //console.log(res);
				
				if(res.responseText.indexOf("baokuanshangpin") > 0)
				{
					strs = res.responseText.split(":");
					var errorStr = strs[1].replace("baokuanshangpin","");
					message.alert(errorStr);
				}
				else
				{
                	message.alert("加入购物车失败，没有成功加入购物车"); //这块以后会返回别的error message，错误时候返回
				}
                //message.alert("加入购物车失败，没有成功加入购物车"); //这块以后会返回别的error message，错误时候返回
            },
        });
    });
};       
   
/* 添加购物车函数end */

/* 模拟创建一个form表单post begin，这边主要用来直接提交立即购买的 */
function createFormParam(PARAMS, temp, prename) {
    for (var x in PARAMS) {
        var nowname = prename ? prename + '[' + x + ']' : x;
        if (typeof (PARAMS[x]) == 'object') {
            temp = createFormParam(PARAMS[x], temp, nowname);
        } 
        else 
        {
            var opt = document.createElement("textarea");
            opt.name = nowname;
            opt.value = PARAMS[x];
            temp.appendChild(opt);
        }
    }
    return temp;
}

function post(URL, PARAMS) {
    var temp = document.createElement("form");
    temp.action = URL;
    temp.method = "post";
    temp.style.display = "none";
    temp = createFormParam(PARAMS, temp, '');
    document.body.appendChild(temp);
    temp.submit();
    return temp;
}
/* 模拟创建一个form表单post end */

/* 直接购买参考加入购物车，只是多了个模拟form表单提交 */
/* 直接购买参考加入购物车，只是多了个模拟form表单提交 */
function cartcheckout(_csrf, userId, loginurl, checkurl, tmp_url){
    var skuMapValue = $("input[name='skuMapValue']").val(); //productid数量什么的也这样读
    var skuMapId = $("input[name='skuMapId']").val();
    var offergoodsprice = $("input[name='offergoodsprice']").val();
    var listgoodsprice = $("input[name='listgoodsprice']").val();       
    if (!userId)
    {
        window.location.href = loginurl;
        return false;
    }
    if (!skuMapValue)
    {
        message.alert("直接购买失败，请选择规格参数");
        return false;
    }

    var check = ({
        "_csrf": _csrf,
        'itemPartnumber':skuMapValue,
    }); 
    $.ajax({
        type: 'post',
        url: checkurl,
        data: check,
        success: function(res){
            if(res['no_buy'])
            {
                message.alert("抱歉，您今天已经购买了爆款商品！");
                $(".ui-dialog").removeClass('show');
                return false;
            }
            else
            {
                var num = $("#Num").val();
                var params = ({
                    "_csrf": _csrf,
                    'itemId':skuMapId,
                    "cartlineQuantity": num,
                    "channelId":channelId,
                }); 
                post(tmp_url, params);
            }
        },

        error: function(res){
            message.alert("购买爆款校验失败！");
        }
    });
    // var num = $("#Num").val();
    // var params = ({
    //     "_csrf": _csrf,
    //     'itemId':skuMapId,
    //     "cartlineQuantity": num,
    // }); 
    // post(tmp_url, params);
}
/* 直接购买参考加入购物车，只是多了个模拟form表单提交 */

function getProductById(id)
{
    $.ajax({
        type: 'get',
        url: '../product/getproductbyid.html?id='+id,
        //url: 'index.php?r=product/getproductbyid&id='+id,        //本地调试用
        success: function(res){   
            try{
                if(res['desc']['name']!="")
                    $('.product-title-g').html(res['desc']['name']);
            } catch(e){};   
            try{
                buyable = res['buyable']; 
                skuMapValue = $("input[id='skuMapValue']").val();
                getInventory(_csrf, skuMapValue , buyable, inventoryposturl); //由于有不同的buyable，所以只能在这边做了，回头把库存查询跟buyalbe判断上架下架拆开做       
            } catch(e){};
            try{  
                if(res['desc']['shortDescription']!="")
                    $('.shortdescription-g').html(res['desc']['shortDescription']);
            } catch(e){};
            try{
                if(res['brand']['name']!="")
                    $('.brand-g').html(res['brand']['name']);
            } catch(e){};
            try{
                if(res['partNumber']!="")
                    $('.partnumber-g').html(res['partNumber']);
            } catch(e){};
            try{
                if(res['minBuyCount'] > 1)
                {
                    $('#minbuy').html(res['minBuyCount']+"件起售");
                    $('.minbuy-g').css('display','inline-block');
                    _buynum_min = res['minBuyCount'];
                }
                else
                {
                    $('.minbuy-g').css('display','none');
                    _buynum_min = 1;
                }
                changebuynum();
            } catch(e){};
            try{
                if(res['maxBuyCount'] > 0)
                {
                    $('#maxbuy').html("限购"+res['maxBuyCount']+"件");
                    $('.maxbuy-g').css('display','inline-block');     
                    _buynum_max = res['maxBuyCount'];
                }
                else
                {
                    $('.maxbuy-g').css('display','none'); 
                    _buynum_max = 50;
                }
                changebuynum();
            } catch(e){};
                /* tag start 由于tag sku暂时没有传回先干掉
                var tag = res['tag'];          
                var tagstr = '';
                for(var k in tag)
                {
                    if (tag[k][id]=="BR") 
                    {              
                        tagstr = tagstr + '<span>' +tag[k]['name']+ '</span>';
                    };
                }
                $('.tag-g').html(tagstr);
                /* tag end */
                
                /* cloud_zoom start */
            try{ //修改轮播
                var zoomstr = '';
                var zoomnum = '';
                var goodspic = res['goodspic'];
                zoomstr = zoomstr + '<li><span style="background-image:url('+ res['desc']['bigImage'] +')"></span></li>';
                var zoomnum = '<li>1</li>';
                var wd = 1;
                for(var k in goodspic)
                {
                    zoomstr = zoomstr + '<li><span style="background-image:url('+ goodspic[k]['bigImage'] +')"></span></li>';
                    wd ++;
                    zoomnum = zoomnum + '<li>'+wd+'</li>';
                }               
                $('#picscroll').html(zoomstr);     
                $('#picscroll').css('width',wd+'00%');     
                $('.ui-slider-indicators').html(zoomnum);        

                slider.destroy(); //解除绑定一开始的轮播，然后等图片加载完后，重新绑定
                clearTimeout(slider.options.flag);
                slider = null;
                slider = new fz.Scroll('.ui-slider', {
                    role: 'slider',
                    indicator: true,
                    autoplay: true,
                    interval: 3000
                });

                slider.on('beforeScrollStart', function(fromIndex, toIndex) {
                    //console.log(fromIndex,toIndex)
                });

                slider.on('scrollEnd', function(cruPage) {
                    //console.log(cruPage)
                });
            } catch(e){};
                /* cloud_zoom end */                        
               
        },                                                     

        error: function(res){
            //console.log(res);          
        },
    });  
}

function addtowishlist(_csrf, userId, loginurl, tmp_url)
{ 
    var skuMapId = $("input[name='skuMapId']").val();    
    $('#collect').click(function (e)
    { 
        if(!userId)
        {   
            window.location.href = loginurl;
            return false;
        }                                  
        var params = ({
            "_csrf": _csrf,                   
            "userId": userId, //买家id required                                     
            "itemId": skuMapId, //skuMapValue 购物车项商品全局唯一Id required                              
        });

        $.ajax({
            type: 'post',
            url: tmp_url,
            data: params,
            success: function(res){                  
                //console.log(res);                
                message.info("加入收藏夹成功！");
            },
            error: function(res){
                //console.log(res);
                message.alert("加入收藏夹失败，没有成功加入收藏夹"); //这块以后会返回别的error message，错误时候返回
            },
        });
    });               
}

$('.skumap-bigbox a').click(function ()
{
    var thisclass = $(this).prop('className');
    if(thisclass.indexOf('active') == -1) {
        $('.' + thisclass).removeClass('active');
        $(this).addClass('active');
        var thisvalue = $(this).prop('id');
        $("input[name='" + thisclass + "']").val(thisvalue);
        getskuMapValue(_csrf, skuMap, itemId, itemPartNumber, buyable, shop, priceposturl, inventoryposturl, taxRate);
    }
});

getProductprice(_csrf,itemPartNumber,shop,priceposturl,goodstype);

$('#buynow').click(function(e){ 
    cartcheckout(_csrf, userId, loginurl, checkurl, cartcheckouturl);
});

$('#buynow_app').click(function(e){ 
    cartcheckout(_csrf, userId, loginurl, checkurl, cartcheckouturl);
});

$(function () {
    preSelect(stateCode,cityCode,districtCode,'#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');//preselect("四川省","成都市","金牛区");//设置默认选项
    initCountry('#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');
});

$('#addressapi-statecode').change(function(){
   stateCode =  $('#addressapi-statecode').val();
   $('#stateCode').val(stateCode);
   getInventory(_csrf, itemPartNumber, buyable, inventoryposturl);    
});