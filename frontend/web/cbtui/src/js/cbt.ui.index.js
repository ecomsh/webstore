(function(win, doc){
	//获取左侧漂浮的四个元素到浏览器顶部的距离
	var mustbuy=doc.getElementById("mustbuy").offsetTop,
	globalselection=doc.getElementById("global-selection").offsetTop,
	finalsale=doc.getElementById("final-sale").offsetTop,
	brandbeal=doc.getElementById("brand-beal").offsetTop,
	//变量
	compatMode=doc.compatMode,
	isChrome=win.navigator.userAgent.indexOf("Chrome")===-1?false:true,
	scrollEle=compatMode==="BackCompat"||isChrome?doc.body:doc.documentElement,
	clientEle = compatMode === "BackCompat" ? doc.body : doc.documentElement;
	//判断页面加载时，是否显示左侧
	var lefttop=doc.getElementById("left-fix").offsetTop;
	if(lefttop>clientEle.clientHeight){
		$(".left-fix").css("display","block");
	}else{
		$(".left-fix").css("display","none");
	}
	//点击返回顶部图标后的响应动作
	var toindex=doc.getElementById("to-index"),
	rate=0.6,
	timeGap=10;
	toindex.onclick=function(){
		var moveInterval=setInterval(moveScroll,timeGap);
		function moveScroll(){
			if(scrollEle.scrollTop===0){
				clearInterval(moveInterval);
				return;
			}
			scrollEle.scrollTop=scrollEle.scrollTop*rate;
		}
	}
	win.onscroll = function(){	
		var poptop=scrollEle.scrollTop||win.pageYOffset;
		//判断页面滚动时，是否显示回到顶部的按钮
		if(scrollEle.scrollTop>clientEle.clientHeight){
			$(".left-fix").css("display","block");
		}else{
			$(".left-fix").css("display","none");
		}

		//alert(poptop);//滚动条滚动的高度,减去10是因为左边的锚点有一点响应的问题
		if((poptop > mustbuy-10)&&(poptop <= globalselection-10)){
			$(".left-buy").siblings().removeClass("left-fix-hover");
			$(".left-buy").addClass("left-fix-hover");
		}
		if((poptop > globalselection-10)&&(poptop <= finalsale-10)){
			$(".left-global").siblings().removeClass("left-fix-hover");
			$(".left-global").addClass("left-fix-hover");
		}
		if((poptop > finalsale-10)&&(poptop <= brandbeal-10)){
			$(".left-final").siblings().removeClass("left-fix-hover");
			$(".left-final").addClass("left-fix-hover");
		}
		if(poptop > brandbeal-10){
			$(".left-brand").siblings().removeClass("left-fix-hover");
			$(".left-brand").addClass("left-fix-hover");
		}
	};
})(window, document);

$(".global-product").hover(
	function(){
		$(this).children(".global-img-p").show();
	},
	function(){
		$(this).children(".global-img-p").hide();
	}
)
$(".left-fix li").click(function(){
	$(this).siblings().removeClass("left-fix-hover");
	$(this).removeClass("left-buy-hover");
	$(this).removeClass("left-global-hover");
	$(this).removeClass("left-final-hover");
	$(this).removeClass("left-brand-hover");
	$(this).addClass("left-fix-hover");
})

$(".left-buy").hover(
	function(){
		if($(this).hasClass("left-fix-hover")){
			return;
		}else{
			$(this).addClass("left-buy-hover");
		}
	},
	function(){
		$(this).removeClass("left-buy-hover");
	}
)
$(".left-global").hover(
	function(){
		if($(this).hasClass("left-fix-hover")){
			return;
		}else{
			$(this).addClass("left-global-hover");
		}
	},
	function(){
		$(this).removeClass("left-global-hover");
	}
)

$(".left-final").hover(
	function(){
		if($(this).hasClass("left-fix-hover")){
			return;
		}else{
			$(this).addClass("left-final-hover");
		}
	},
	function(){
		$(this).removeClass("left-final-hover");
	}
)


$(".left-brand").hover(
	function(){
		if($(this).hasClass("left-fix-hover")){
			return;
		}else{
			$(this).addClass("left-brand-hover");
		}
	},
	function(){
		$(this).removeClass("left-brand-hover");
	}
)



$("#right-account").click(function(){
	$(".right-fix li").removeAttr("class");
	$(this).addClass("right-account-hover");
})
$("#right-vouchers").click(function(){
	$(".right-fix li").removeAttr("class");
	$(this).addClass("right-vouchers-hover");
})
$("#right-collection").click(function(){
	$(".right-fix li").removeAttr("class");
	$(this).addClass("right-collection-hover");
})
$("#right-car").click(function(){
	$(".right-fix li").removeAttr("class");
	$(this).addClass("right-car-hover");
})
$("#right-saoma").click(function(){
	$(".right-fix li").removeAttr("class");
	$(this).addClass("right-saoma-hover");
})
$("#right-kefu").click(function(){
	$(".right-fix li").removeAttr("class");
	$(this).addClass("right-kefu-hover");
})
$("#right-top").click(function(){
	$(".right-fix li").removeAttr("class");
	$(this).addClass("right-top-hover");
})