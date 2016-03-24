/*
	选择配送地begin
*/	
(function changeaddress() { //选择配送地（貌似这块的插件要重做？）
var clickCity = function (id, aa) {
	var _input_text = "<li><a class='{select}' code={id} href='#'>{name}</a></li>";
	var aaa = jQuery('#code_' + id).text();
	jQuery('#J_dqPostAgeCont').html(aaa);
	jQuery('#stateCode').val(id);
	var body = jQuery('#J_dqPostAgeCont_body') || '';
	var skuMapValue = jQuery("input[name='skuMapValue']").val();
	if (skuMapValue)
	{
		getInventory(skuMapValue);
	}
	else
		getInventory("<?= Html::encode($data['partNumber']) ?>");
	if (body)
		body.css('display', 'none');
	else
		return false;
};

jQuery('#J_dqPostAgeCont').click(function () {
	var local_area = jQuery(this).attr('code');
	var parent_area = jQuery(this).attr('parent');
	if (!local_area || !parent_area)
		return false;
	var body = jQuery('#J_dqPostAgeCont_body') || '';
	if (body)
		body.css('display', 'block');
	else
		return false;
					var list = jQuery('a',body) || [];
	if (list.length > 0) {
		list.each(function (i) {
									var p = jQuery(this);
			if (p.attr('code') == parent_area)
				p.addClass('select');
			p.unbind('click').on('click', function (e) {
				list.removeClass('select');
				p.addClass('select');
				clickCity(p.attr('code'));
				return false;
			});
		});
	}
	return false;
});

jQuery('#J_dqPostAgeCont_body .J_CitySelectorClose').click(function (e) {
	var body = jQuery('#J_dqPostAgeCont_body') || '';
	if (body)
		body.css('display', 'none');
	return false;
});
})();
/*
	选择配送地end
*/	

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
		jQuery('.Num').val(0);
		jQuery('#inventory').html(0);
		jQuery(".add-cart-btn").css("background-color","#999");  
		jQuery(".add-cart-btn").css("border","#666");    
		jQuery("#J_buy_btn").css("display","none");           
		jQuery("#addtocart").attr("disabled", true);
		return false;
	}     
	var stateCode = jQuery('#stateCode').val();      
	var inventory = ({ //获取库存
		"_csrf" : _csrf,
		"itemPartNumber" : itemPartNumber,
		"itemOrg" : "ftzmall",
		"shop" : "ftzmall",
		"country" : "CN",
		"stateCode" : stateCode,
			//"queryItemType" : "Product", //
	});    

	console.log(inventory);
	jQuery.ajax({
		type: 'post',
		url: tmp_url,
		data: inventory,
		success: function(res){    
			jQuery('#inventory').html(res); 
			console.log(res);
			if(res==0){
				jQuery('.Num').val(0);
			}
			else{
				jQuery('.Num').val(1);
			}
			var aaa =  jQuery('#inventory').html();
			if(aaa==0){                                          
				jQuery("#J_buy_btn").css("display","none");      
				jQuery(".add-cart-btn").css("background-color","#999");      
				jQuery(".add-cart-btn").css("border","#666");    
				jQuery("#addtocart").attr("disabled", true);
				return false;
			}                
			else{
				jQuery("#J_buy_btn").css("display","block");     
				jQuery("#addtocart").attr("disabled", false);
				jQuery(".add-cart-btn").css("background-color","#a4070f");      
				jQuery(".add-cart-btn").css("border","#a4070f");    
			}
		},                                                     

		error: function(){
			jQuery('#inventory').html(0);  //如果库存获取不到就传0
			jQuery('.Num').val(0);
			jQuery("#J_buy_btn").css("display","none");       
			jQuery("#addtocart").css("background-color","#999"); 
			jQuery(".add-cart-btn").css("border","#666");    
			jQuery("#addtocart").attr("disabled", true);
		},
	});  

}  
/*
	获取库存函数end
*/	

/*
	获取价格函数begin
	需要传参数 ：
		itemPartNumber = "0001043001";
		buyable = 1;   0为已下架，1为销售中
		tmp_url = "index.php?r=product/getinventory";
*/	

function getProductprice(_csrf,itemPartNumber,shop,tmp_url)
{					
	var params = ({//http://localhost:8080/calculation-web/rest/v1/price/pricelist/{价格列表名字}/item/{SKU编号}/itemOrganization/{组织名字}/shop/{商店名字}
		"_csrf" : _csrf,
		"priceList" : "offer",
		"itemPartnumber" : itemPartNumber, //这个应该是SKU编号 以后改成skuMapValue;
		"itemOrg" : "ftzmall",
		"shop" : shop,
		//"queryItemType" : "Product", //
	});                                                                          
	jQuery.ajax({
		type: 'post',
		url: tmp_url,
		data: params,
		success: function(res){     
			console.log(res);
			/*jQuery.each(res,function(n,value) {  
			   if(value.currency == 'CNY')  
							jQuery('.goodsprice').html('￥'+value.value); //人民币优先？
			});      */                                                  

			if(res.CNY)
			{
			   jQuery('.goodsprice').html('￥'+res.CNY); 
			   jQuery("input[id='offergoodsprice']").val(res.CNY); 
			}
			else
			   console.log(res);
		},                                                     
		error: function(){
			Message.error("获取价格失败.<br />提交信息不完整.</li></ul>"); //这块以后会返回别的error message，错误时候返回
		},
	});				
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
		buyable = 1;	0为已下架，1为销售中

*/
	
function getskuMapValue(_csrf, skuMap, id, itemPartNumber, buyable, shop, priceposturl, inventoryposturl){
	if(skuMap == "")
	{
		var skuMapValue = itemPartNumber;       
		var skuMapId = itemId;
		jQuery("input[id='skuMapValue']").val(skuMapValue);
		jQuery("input[id='skuMapId']").val(skuMapId);   		
		getProductprice(_csrf, itemPartNumber, shop, priceposturl);
		getInventory(_csrf, itemPartNumber, buyable, inventoryposturl);       
	}
	else{
		var tmp =""; 
		jQuery("input[id='defining']").each(function(){tmp += jQuery(this).val()+'_'});
		tmp = tmp.substring(0,tmp.length-1); //tmp就等于skuMap里的key，类似10005_10007_10009      
		console.log(tmp);
		//return false;
		if(skuMap[tmp])
		{
			var skuMapValue = skuMap[tmp].partNumber; //skuMapValue就等于skuMap里的value，类似partnumber-1-18  
			var skuMapId = skuMap[tmp].value;
			var skuMapContent = skuMap[tmp].content;
			jQuery("input[id='skuMapValue']").val(skuMapValue);
			jQuery("input[id='skuMapId']").val(skuMapId);
			jQuery("input[id='skuMapContent']").val(skuMapContent);
			if(!skuMapValue)
			{
				alert("获取库存跟价格失败。skuMapValue没有赋值");
			}                                                
		}
		if(skuMapValue)                                            
		{
			getProductprice(_csrf, itemPartNumber, shop, priceposturl);
			getInventory(_csrf, itemPartNumber, buyable, inventoryposturl);      
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
	var skuMapValue = jQuery("input[name='skuMapValue']").val(); //productid数量什么的也这样读    
	var skuMapId = jQuery("input[name='skuMapId']").val();
	var skuMapContent = jQuery("input[name='skuMapContent']").val();
	var offergoodsprice = jQuery("input[name='offergoodsprice']").val(); 
	var inventory = jQuery('#inventory').html();        
	jQuery('#addtocart').click(function (e) { 
		if(!userId)
		{   
			window.location.href = loginurl;
			return false;
		}
		if (!skuMapValue)
		{
			alert("加入购物车失败。请选择规格参数");
			return false;
		}
		var num =  jQuery("#Num").val();            
		var offset = jQuery("#cart_num").offset();                         
		var params = ({//数组，这个数组，北京写model的姐姐说都要的，但是她貌似也不是很清楚每个参数是干嘛的
			"_csrf": _csrf,                   
			"userId": userId, //买家id required                                     
			"itemId": skuMapId, //skuMapValue 购物车项商品全局唯一Id required
			"itemLink": window.location.href, //购物车项商品的链接 required   
			"extensionData": {//购物车项的扩展数据                    
				"empty": "boolean"
			},                   
			"cartlineQuantity": num, //买的商品个数                 
			"itemPartNumber": skuMapValue, //partNumber                   
		});
		
		console.log(params);
		jQuery.ajax({
			type: 'post',
			url: tmp_url,
			data: params,
			success: function(res){                  
				console.log(res);
				var cartlineId = res.cart.cartlineId;
				if(isNaN(cartlineId))
				{
					alert('加入购物车失败!');
					return false;
				}
				else
				{
					alert('加入购物车成功!');
				}
				/*var cartlineId = res.cart.cartlineId;                   
				var dataPrice = {
					"_csrf" : "<?= Html::encode($_csrf) ?>",
					'cartlineIds'   : cartlineId,
					'price'         : true,
					'promotion'     : false,
					'shipping'      : false,
					'tax'           : false,
				};                
				if(userId != '')
				{   
					cookietotalnum = jQuery.cookie('carttotalNum'+ userId);
					if(!cookietotalnum)
					{
						jQuery.ajax({
								type:'get',
								url:'<?= Url::to(['cart/getcarttotalnum']) ?>',
								success:function(carttotalnum){                                                        
									 jQuery("#cart_num").html(carttotalnum);
									}
									})
					}
					else{
					carttotalnum = Number(cookietotalnum) + Number(num);
					jQuery("#cart_num").html(carttotalnum);
					jQuery.cookie('carttotalNum'+ userId , carttotalnum, {path:'/'});

					}
				}else{
				jQuery("#cart_num").html('0');
				}

				jQuery.ajax({
					type:'post',
					url:'<?= Url::to(['cart/priceandnum']); ?>',
					data:dataPrice,
					success:function(res2){  
						console.log(res2);
						var type_num = res2.type; //以后读取返回的数字
						var product_num = res2.num;
						var price = res2.originalPrice;                    
						jQuery('#mini-cart-dialog').find('h2').html('成功加入购物车');//返回加入购物车成功的提示内容
						jQuery('#mini-cart-dialog #type_num').html(type_num);
						jQuery('#mini-cart-dialog #product_num').html(product_num);
						jQuery('#mini-cart-dialog #price').html(price);
						jQuery('#mini-cart-dialog').css('display','block');

						//购物车飞入效果start lijing
						var addcar = jQuery(".btn-buy");
						var a=document.getElementById("cartBtn");  
						var img = addcar.parents('.goods-rightbox').siblings().find('.spec-pic').children(img).attr('src');
						var flyer = jQuery('<img class="u-flyer" src="'+img+'">');
						var compatMode = window.compatMode,
						isChrome = window.navigator.userAgent.indexOf("Chrome") === -1 ? false : true,
						scrollEle = compatMode === "BackCompat" || isChrome ? document.body : document.documentElement,
						clientEle = compatMode === "BackCompat" ? document.body : document.documentElement;
						var eletop=a.offsetTop-scrollEle.scrollTop;
						var cartop=document.getElementById("cart_num").offsetTop;

						flyer.fly({
							start: {
								left: a.getBoundingClientRect().left,
								top: eletop
							},
							end: {
								left: offset.left+10,
								top: cartop+10-scrollEle.scrollTop,
								width: 0,
								height: 0
							},
							onEnd: function(){
								this.destory();
							}
						});


				   //购物车飞入效果end

					},
					error: function(){
						var type_num = res.cart.cartlineType; //以后读取返回的数字
						var product_num = res.cart.cartlineQuantity;
						var price = '未计算';                 
						jQuery('#mini-cart-dialog').find('h2').html('成功加入购物车');//返回加入购物车成功的提示内容
						jQuery('#mini-cart-dialog #type_num').html(type_num);
						jQuery('#mini-cart-dialog #product_num').html(product_num);
						jQuery('#mini-cart-dialog #price').html(price);
						jQuery('#mini-cart-dialog').css('display','block');
						// Message.error("加入购物车失败.<br /><ul><li>计算购物车价格失败</li></ul>"); //这块以后会返回别的error message，错误时候返回

					},
				})*/ //不需要计算价格以及购物车数量了，全部干掉

			},
			error: function(res){
				console.log(res);
				alert("加入购物车失败，没有成功加入购物车"); //这块以后会返回别的error message，错误时候返回

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
		} else {
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
