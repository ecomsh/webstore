var message = {
	alert: function(msg){
		$("body").append("<div style='position:fixed; top:50%; left:15%; margin-top:-50px; z-index:9999999999; width:70%; height:100px; border:1px solid #ed145b;border-radius:5px 5px 5px 5px;background-color:#fff' class='errormessage_box' ><p style='width:98%;color:#fff;background-color:#ed145b;padding-left:2%;line-height:29px;height:29px;'>亲，出错了哦~</p><p style='padding-left:4%;padding-top:5px;color:#ed145b'>"+msg+"</p></div>");	
                var timeOutms=arguments[1]?arguments[1]:2000;  
                var SiteSplash = setTimeout('disappear_message()', timeOutms);
	},

	info: function(msg){
		$("body").append("<div style='position:fixed; top:50%; left:15%; margin-top:-50px; z-index:9999999999; width:70%; height:100px; border:1px solid #ed145b;border-radius:5px 5px 5px 5px;background-color:#fff' class='errormessage_box' ><p style='width:98%;color:#fff;background-color:#ed145b;padding-left:2%;line-height:29px;height:29px;'>操作成功</p><p style='padding-left:4%;padding-top:5px;color:#ed145b'>"+msg+"</p></div>");	
                var timeOutms=arguments[1]?arguments[1]:2000;  
                var SiteSplash = setTimeout('disappear_message()', timeOutms);
	}
}

function disappear_message()
{
	$('.errormessage_box').css('display','none');
}

/*最后决定用css居中*/
// function center(id) {
//     var oBox = document.getElementById(id);
//     var L1 = oBox.offsetWidth;
//     var H1 = oBox.offsetHeight;
//     var Left = (document.documentElement.clientWidth - L1) / 2;
//     var top = (document.documentElement.clientHeight - H1) / 2;
//     oBox.style.left = Left + 'px';
//     oBox.style.top = top + 'px';
// }
