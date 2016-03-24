/*
	购买数量调节begin
	跟购物车页面的可共用，回头问问代成俊大哥
	需要传递的参数：
		_maxbuy=50;   //为定义的最大购买数量
		salstype = 1;  //1,2,3,4,5 未来config里配置
*/

function changebuynum(_maxbuy,salestype){

	var getStore = function () {
		return parseInt(jQuery('#inventory').html());
	}; 
	 
	var getMaxBuy = function(){
		var maxtotal= 1000;
		var price   = jQuery("input[name='offergoodsprice']").val();
		var maxbuy  = price>maxtotal?1:parseInt(maxtotal/price,10);
		return maxbuy;
	}
	
	jQuery('#goods-viewer input[name="goodsnum"]').on({

		'keydown': function (e) {                                         
			//console.log(e.keyCode);
			return;
		},

		"keyup": function () {
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
					jQuery(this).attr('value', maxbuy);    
					Message.error('订单金额不能大于1000');
				}				
			}
			if (!this.value || this.value == 'NaN' || this.value < 1)
				this.value = 1;
			jQuery(this).attr('value',this.value);
		},

		'blur': function () {
			this.value = parseInt(this.value);				
			if (!this.value || this.value == 'NaN' || this.value < 1)
					this.attr('value',1);
			jQuery(this).attr('value',this.value);
		}
	});

	jQuery('#goods-viewer .substract').click(function (e) { //减
		var val = jQuery('#goods-viewer .Num').attr('value');
		if (val != 1 && val != 0)
		{
			var vals = parseInt(val) - 1;
			jQuery('#goods-viewer .Num')[0].value = vals;
			jQuery('#goods-viewer .Num').attr('value', vals);
		}
	});

	jQuery('#goods-viewer .plus').click(function (e) { //加
		var val = jQuery('#goods-viewer .Num').attr('value');
		//var store = getStore(); 获取数量hardcode
		var store = 1000;
		var freez = '0';
		var nostore_sell = '0';
		if (nostore_sell != 0) //没有定义store 的情况下，最多9999
		{
			if (val < _maxbuy) {
				var vals = parseInt(val) + 1;
				jQuery('#goods-viewer .Num')[0].value = vals;
				jQuery('#goods-viewer .Num').attr('value', vals);
			}
		}
		else
		{
			var storeNum = store - freez;
			var vals = parseInt(val) + 1;
			if (val < storeNum && val < _maxbuy)
			{
				jQuery('#goods-viewer .Num')[0].value = vals;
				jQuery('#goods-viewer .Num').attr('value', vals);
			}
		}  
		if(salestype != 1 && salestype != 2){                                
			var maxbuy = getMaxBuy();
			if(maxbuy < vals){
				jQuery('#goods-viewer .Num')[0].value = maxbuy;
				jQuery('#goods-viewer .Num').attr('value', maxbuy);
				alert('订单金额不能大于1000');
			}
		}
		
	});
}

/*
	购买数量调节end
*/

/* 商品页tab的切换，纯js实现，回头需要的话可以改造下放common.js里并改成onclick触发或者onmouseover触发等 */
/*function setTab(name, n) {
	for (i = 1; i < n; i++) {
		var menu = document.getElementById(name + i);
		console.log(menu);
		//var con = document.getElementById("con_" + name + "_" + i);
		jQuery("#" + name + i).click(function (e) {
			console.log( )
			alert(i);
			menu.className = i ? "active" : "";
			con.style.display = i ? "block" : "none";
		});
	}
}*/

/*
	获取页顶高度,longdescripition的顶部nav效果
*/

$(window).scroll(function ()
{		
	//var scrolltop = document.body.scrollTop;
	var compatMode=document.compatMode;
	var isChrome=window.navigator.userAgent.indexOf("Chrome")===-1?false:true;
	var scrollEle=compatMode==="BackCompat"||isChrome?document.body:document.documentElement;
	var scrolltop=scrollEle.scrollTop||window.pageYOffset;


	var con = document.getElementById('navtop');
	var navtop = document.getElementById('longdescription-bigbox').offsetTop;
	var endtop = document.getElementById('longdescription-bigboxend').offsetTop;    
    /* 现在事比较多，回头没事的时候再想想怎么用循环写 */
    var gmxztop = document.getElementById('gmxz').offsetTop;
    var spxxtop = document.getElementById('spxx').offsetTop;
    var spxqtop = document.getElementById('spxq').offsetTop;
    var spzstop = document.getElementById('spzs').offsetTop;
    var aboutustop = document.getElementById('aboutus').offsetTop;    

    if(scrolltop > gmxztop  && scrolltop < spxxtop)
    {
        var activetab = document.getElementById('li_gmxz');
        $('#product_tag li').removeClass("active");
        activetab.className = "active";
        con.className = "longdescription-tab navbar-fixed-top";
    }

    else if(scrolltop > spxxtop  && scrolltop < spxqtop)
    {
        var activetab = document.getElementById('li_spxx');
        $('#product_tag li').removeClass("active");
        activetab.className = "active";
        con.className = "longdescription-tab navbar-fixed-top";
    }

    else if(scrolltop > spxqtop  && scrolltop < spzstop)
    {
        var activetab = document.getElementById('li_spxq');
        $('#product_tag li').removeClass("active");
        activetab.className = "active";
        con.className = "longdescription-tab navbar-fixed-top";
    }

    else if(scrolltop > spzstop  && scrolltop < aboutustop)
    {
        var activetab = document.getElementById('li_spzs');
        $('#product_tag li').removeClass("active");
        activetab.className = "active";
        con.className = "longdescription-tab navbar-fixed-top";
    }

    else if(scrolltop > aboutustop  && scrolltop < endtop)
    {
        var activetab = document.getElementById('li_aboutus');
        $('#product_tag li').removeClass("active");
        activetab.className = "active";
        con.className = "longdescription-tab navbar-fixed-top";
    }

    else if (scrolltop > endtop || scrolltop <navtop)    
    {
        con.className = "longdescription-tab";
    }
  

    /*if (scrolltop > navtop && scrolltop < endtop)
	{
		con.className = "longdescription-tab navbar-fixed-top";
	}

	else if (scrolltop < navtop || scrolltop > endtop)
	{
		con.className = "longdescription-tab";
	}*/
	
});


/*
	bootstrap的tab切换洗了锚点的功能，手动添加锚点功能
*/

$(function() {
	$('#navtop a').click(function (e) {
		var hash = $(e.target).attr("id");
		var tab = hash.split("_");
		window.location.hash = tab[1];
	});
});

/*
	滚动效果
		params
		id_box 盒子ID string 默认 'scroll-box'
		id_list 列表ID string 默认 'scroll'
		id_up 向上箭头ID string 默认 'arrow-top'
		id_down 向下箭头ID string 默认 'arrow-down'
		type 滚动类型 string 默认 1  1为竖向滚动 目前只有竖
		speed 滚动速度 int 默认 5
*/

function myScroll(id_box,id_list,id_up,id_down,type,speed){
	var _ = this;
	_.id_box	= isset(id_box)?id_box:'scroll-box';
	_.id_list	= isset(id_list)?id_list:'scroll';
	_.id_up		= isset(id_up)?id_up:'arrow-top';
	_.id_down	= isset(id_down)?id_down:'arrow-down';
	_.type		= isset(type)?type:1; // 1:竖滚 2:横滚
	_.speed		= isset(speed)?speed:5;//初始速度

	_.delay		= 20;//定时器时间间隔 先写死
	_.length	= 0;//list里元素个数
	_.dis_width	= 0;//元素之间的横向距离
	_.dis_height= 0;//元素之间的纵向距离
	_.num_w		= 0;//list里一行的元素个数
	_.num_h		= 0;//list里一列的元素个数
	_.page		= 1;//总共页数
	_.cur		= 1;//当前页数
	_.target	= 1;//这次滚动跑向的页数
	_.box_size	= 0;//盒子滚动方向的大小
}

myScroll.prototype = {
	//初始化
	'init':function(){
		var _ = this;
		_.dom_box	= jQuery('#'+ _.id_box);
		_.dom_list	= jQuery('#'+ _.id_list);
		var children = _.dom_list.children();
		_.length = children.length;
		if(_.length <= 1)
			return;
		if(_.type == 1) {
			//计算元素纵向距离 及纵向个数
			for (var i = 1; i < _.length; i++) {
				var tmp = Math.abs(children[i].offsetTop - children[0].offsetTop);
				if (tmp > 0) {
					_.dis_height= tmp;
					_.num_w		= i;
					break;
				}
			}
			_.box_size = _.dom_box[0].offsetHeight;
			_.page = Math.ceil(_.length/((_.box_size/ _.dis_height) * _.num_w));//计算一共几页
		}
		_.btnstate();
		$('#'+ _.id_up).click(function (e) {_.scroll(-1);});
		$('#'+ _.id_down).click(function (e) {_.scroll(1);});
	},

	//开始滚动
	'scroll':function(dir){
		var _ = this;
		if(_.cur != _.target)
			return;
		if(dir == 1 && (_.target+1 <= _.page)){
			_.target += 1;
		}
		if(dir == -1 && (_.target-1 >= 1)){
			_.target -= 1;
		}
		_.btnstate();
		clearInterval(_.timer);
		_.timer = setInterval(function(){_.run()},_.delay);
	},

	//实际定时器滚动
	'run':function(){
		var _ = this;
		var target	= (_.target - 1) * _.box_size;
		var dis		= _.dom_box.scrollTop() - target;
		if(Math.abs(dis) < _.speed){
			_.dom_box.scrollTop(target);
			_.cur = _.target;
			clearInterval(_.timer);
			return;
		}
		_.dom_box.scrollTop(_.dom_box.scrollTop()+((dis>0)?-1:1) * _.speed);
	},

	//修改按钮状态
	'btnstate':function(){
		var _ = this;
		if(_.target == 1){
			$("#arrow-top-img").attr("src","../src/images/arrow-top-disable.png");
			$("#arrow-top-img").attr("disabled","true");
		}else{
			$("#arrow-top-img").attr("src","../src/images/arrow-top.png");
			$("#arrow-top-img").attr("disabled","true");
		}
		if(_.target == _.page){
			$("#arrow-down-img").attr("src","../src/images/arrow-down-disable.png");
			$("#arrow-down-img").attr("disabled","true");
		}else{
			$("#arrow-down-img").attr("src","../src/images/arrow-down.png");
			$("#arrow-down-img").attr("disabled","false");
		}
	}
}

function isset(variable) {
	return typeof(variable)=='undefined' ? false : true;
}
window.onload = function() {
	var _myscroll = new myScroll();
	_myscroll.init();
    changebuynum(50,1);
    $("img").lazyload({effect: "fadeIn"});
    $('#scroll li a').click(function(){ //轮播页选中图片加框
        $('#scroll li img').css('border','solid 1px #d1d1d1');
        $(this).children('img').css('border','solid 1px #ed145b');
        console.log( $(this).children('img'));
    });
}
	
	