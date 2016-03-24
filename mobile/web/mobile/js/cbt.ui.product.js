	/*
		购买数量调节begin
		跟购物车页面的可共用，回头问问代成俊大哥
		需要传递的参数：
			_maxbuy=50；    //为定义的最大购买数量
			salstype = 1;  //1,2,3,4,5 未来config里配置
	*/

	function changebuynum(_maxbuy,salestype){

		var getStore = function () {
			return parseInt(jQuery('#inventory').html());
		}; //三木符号后面的是获取剩余数量            
		/*目前不使用
		jQuery('#goods-viewer .buyinfo .numadjust').extend('click', function(e) {
		var countText = jQuery('#goods-viewer .buyinfo input[name^=goods[num]');                                      
		if (this.hasClass('increase')) {
		countText.attr('value', (countText.value.toInt() + 1).limit(1, getStore()));
		} else {
		countText.attr('value', (countText.value.toInt() - 1).limit(1, getStore()));
		}
		this.blur();
		}); 
		*/                
		var getMaxBuy = function(){
			var maxtotal= 1000;
			var price   = jQuery("input[name='offergoodsprice']").val();
			var maxbuy  = price>maxtotal?1:parseInt(maxtotal/price,10);
			return maxbuy;
		}
		
		jQuery('#goods-viewer .buyinfo input[name="goodsnum"]').on({
			'keydown': function (e) {                                         
				console.log(e.keyCode);
				return;	
				//这里应该是判定这个按下的键合法不合法，不合法停止掉 return 下方为原来写法
				if (!keyCodeFix.contains(e.code)) {
					e.stop();
				}
			},
			"keyup": function () {
				if(!getStore()){
					this.value = 0;
					return;
				}
				this.value = parseInt(this.value);                                         
				if (getStore() < this.value)
					this.value = getStore();
				if (_maxbuy < this.value)
					this.value = _maxbuy;
					
				if(salestype != 1 && salestype != 2){
					var maxbuy = getMaxBuy();
					if(maxbuy < this.value){
						jQuery('#goods-viewer .Num').attr('value', maxbuy);                                                
						Message.error('订单金额不能大于1000');
					}				
				}
				if (!this.value || this.value == 'NaN' || this.value < 1)
					this.value = 1;

			},
			'blur': function () {
				this.value = parseInt(this.value);
				if (!this.value || this.value == 'NaN' || this.value < 1)
						this.attr('value') = 1;
			}
		});

		jQuery('#goods-viewer .substract').click(function (e) { //减
			var val = jQuery('#goods-viewer .Num').attr('value');
			if (val != 1 && val != 0)
			{
				var vals = parseInt(val) - 1;
				jQuery('#goods-viewer .Num').attr('value', vals);
			}
		});

		jQuery('#goods-viewer .pluscq').click(function (e) { //加，最多57
			var val = jQuery('#goods-viewer .Num').attr('value');
			var store = getStore();
			var freez = '0';
			var nostore_sell = '0';
			if (nostore_sell != 0) //没有定义store 的情况下，最多9999
			{
				if (val < _maxbuy) {
					var vals = parseInt(val) + 1;
					jQuery('#goods-viewer .Num').attr('value', vals);
				}
			}
			else
			{
				var storeNum = store - freez;
				var vals = parseInt(val) + 1;
				if (val < storeNum && val < _maxbuy)
				{
					jQuery('#goods-viewer .Num').attr('value', vals);
				}
			}  
			if(salestype != 1 && salestype != 2){                                
				var maxbuy = getMaxBuy();
				if(maxbuy < vals){
					jQuery('#goods-viewer .Num').attr('value', maxbuy);
					alert('订单金额不能大于1000');
				}
			}			
			
		});
	}
	/*
		购买数量调节end
		_maxbuy为定义的最大购买数量
		salstype = 1; //1,2,3,4,5 未来config里配置
	*/


	/* 商品页tab的切换，纯js实现，回头需要的话可以改造下放common.js里并改成onclick触发或者onmouseover触发等 */
	function setTab(name, cursel, n) {
        for (i = 1; i < n; i++) {
            var menu = document.getElementById(name + i);
            var con = document.getElementById("con_" + name + "_" + i);
            menu.className = i == cursel ? "act trigger" : "trigger";
            con.style.display = i == cursel ? "block" : "none";
        }
    }