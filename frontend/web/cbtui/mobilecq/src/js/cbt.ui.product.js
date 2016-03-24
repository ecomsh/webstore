/*
	购买数量调节begin
	跟购物车页面的可共用，回头问问代成俊大哥
	需要传递的参数：
		_maxbuy=50;   //为定义的最大购买数量
		salstype = 1;  //1,2,3,4,5 未来config里配置
*/

function changebuynum(_maxbuy,salestype){

    var getStore = function () {
        return parseInt($('#inventory').html());
    }; 

    var getMaxBuy = function(){
        var maxtotal= 1000;
        var price   = $("input[name='offergoodsprice']").val();
        var maxbuy  = price>maxtotal?1:parseInt(maxtotal/price,10);
        return maxbuy;
    }

    $('#goods-viewer input[name="goodsnum"]').on({
        'keydown': function(e){                                         
            //console.log(e.keyCode);
            return;
        },

        "keyup": function(){
            /*if(!getStore()){
                    this.value = 0;
                    return;
            }*/
            this.value = parseInt(this.value);
            /*if (getStore() < this.value)
                    this.value = getStore();*/
            if (_maxbuy < this.value)
                    this.value = _maxbuy;

            if(salestype != 1 && salestype != 2){
                    var maxbuy = getMaxBuy();
                    if(maxbuy < this.value){
                            $(this).attr('value', maxbuy);    
                            Message.error('订单金额不能大于1000');
                    }				
            }
            if (!this.value || this.value == 'NaN' || this.value < 1)
                    this.value = 1;
            $(this).attr('value',this.value);
        },

        'blur': function(){
            this.value = parseInt(this.value);				
            if (!this.value || this.value == 'NaN' || this.value < 1)
                this.attr('value', 1);
            $(this).attr('value',this.value);
        }
    });

    $('#goods-viewer .substract').click(function(e){ //减
        var val = $('#goods-viewer .Num').attr('value');
        if (val != 1 && val != 0)
        {
            var vals = parseInt(val) - 1;
            $('#goods-viewer .Num')[0].value = vals;
            $('#goods-viewer .Num').attr('value', vals);
        }
    });

    $('#goods-viewer .plus').click(function (e){ //加
        var val = $('#goods-viewer .Num').attr('value');
        //var store = getStore(); 获取数量hardcode
        var store = 1000;
        var freez = '0';
        var nostore_sell = '0';
        if (nostore_sell != 0) //没有定义store 的情况下，最多9999
        {
            if (val < _maxbuy) {
                var vals = parseInt(val) + 1;
                $('#goods-viewer .Num')[0].value = vals;
                $('#goods-viewer .Num').attr('value', vals);
            }
        }
        else
        {
            var storeNum = store - freez;
            var vals = parseInt(val) + 1;
            if (val < storeNum && val < _maxbuy)
            {
                $('#goods-viewer .Num')[0].value = vals;
                $('#goods-viewer .Num').attr('value', vals);
            }
        }  
        if(salestype != 1 && salestype != 2){                                
            var maxbuy = getMaxBuy();
            if(maxbuy < vals){
                $('#goods-viewer .Num')[0].value = maxbuy;
                $('#goods-viewer .Num').attr('value', maxbuy);
                alert('订单金额不能大于1000');
            }
        }

    });
}

/*
    购买数量调节end
*/

window.onload = function() {	
    changebuynum(50,1);
        
    (function (){
        var tab = new fz.Scroll('.ui-tab', {
            role: 'tab',
            autoplay: false,                   
        });
        /* 滑动开始前 */
        tab.on('beforeScrollStart', function(fromIndex, toIndex) {
            console.log(fromIndex,toIndex);// from 为当前页，to 为下一页
        })
    })();

    (function (){           
        $("#show-skumapbox").click(function(){
            $(".ui-dialog").dialog("show");
        })
    })();
    
    (function (){
        var slider = new fz.Scroll('.ui-slider', {
            role: 'slider',
            indicator: true,
            autoplay: true,
            interval: 3000
        });

        slider.on('beforeScrollStart', function(fromIndex, toIndex) {
            console.log(fromIndex,toIndex)
        });

        slider.on('scrollEnd', function(cruPage) {
            console.log(cruPage)
        });
    })();      
}
	
	