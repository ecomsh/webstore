(function(win, doc){
	//获取左侧漂浮的四个元素到浏览器顶部的距离
	//不建议写try catch，既不是封装东西，也不是程序抛出来必须要接的异常处理，写个try，折磨浏览器的感觉 by lijing
	if($("#mustbuy").length>0){
		var mustbuy=doc.getElementById("mustbuy").offsetTop
	}
	if($("#global-selection").length>0){
		var globalselection=doc.getElementById("global-selection").offsetTop
	}
	if($("#brandbeal").length>0){
		var brandbeal=doc.getElementById("brand-beal").offsetTop
	}
	if($("#hot-brand").length>0){
		var hotbrand=doc.getElementById("hot-brand").offsetTop
	}

	//变量
	var compatMode=doc.compatMode,
	isChrome=win.navigator.userAgent.indexOf("Chrome")===-1?false:true,
	scrollEle=compatMode==="BackCompat"||isChrome?doc.body:doc.documentElement,
	clientEle = compatMode === "BackCompat" ? doc.body : doc.documentElement;
	//判断页面加载时，是否显示左侧
	if($("#left-fix").length>0){
		var lefttop=doc.getElementById("left-fix").offsetTop
	}
	
	if(lefttop>clientEle.clientHeight){
		$(".left-fix").css("display","block");
	}else{
		$(".left-fix").css("display","none");
	}
	//点击返回顶部图标后的响应动作
	if($("#to-index").length>0){
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
		if((poptop > globalselection-10) ){//&&(poptop <= brandbeal-10)){
			$(".left-global").siblings().removeClass("left-fix-hover");
			$(".left-global").addClass("left-fix-hover");
		}
		// if((poptop > brandbeal-10)&&(poptop <= hotbrand-10)){
		// 	$(".left-brand").siblings().removeClass("left-fix-hover");
		// 	$(".left-brand").addClass("left-fix-hover");
		// }
		// if(poptop > hotbrand-10){
		// 	$(".left-hotbrand").siblings().removeClass("left-fix-hover");
		// 	$(".left-hotbrand").addClass("left-fix-hover");
		// }
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