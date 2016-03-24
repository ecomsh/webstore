/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(
		function(){
                // 获取验证码的倒计时
             var count;
             $(".getValiCode").click(function () {
                 var phoneNumber = $("input#registeruserform-mobile").val();

                 var url = urlArray.valregmobile ;
                 $.ajax({
                 url: url,
                 method: 'get',
                 data: {
                       'RegisterUserForm':{
                         'mobile': phoneNumber 
                         }
                 },
                 dataType: 'json',
                 success: function(data) {
                	 //
                     var obj = eval(data);
                     var mobile = obj.mobile;
                     if(mobile === undefined){
                         //
                         clickVCode();
                         count = 59;
                         getNumber();
                     }
                     else{
//                    	 
                     	$("input#registeruserform-mobile").focus();
                     	$(".field-registeruserform-mobile .help-block-error").html(mobile);
                         return false;
                     }
                     //
                 },
                 error: function(data) {
                     alert("服务器发生错误: " + eval(data));
                 }

             });
                
                 });

            $("input#registeruserform-password").bind('input onchange', function() {
            	var password = $("input#registeruserform-password").val();

            	var iComplex = computeComplex(password);
            	if(iComplex >= 17){
            		 $("div#passwordpower3").show();
            		 //.css('display','none'); 
            		 $("div#passwordpower1").hide(); 
            		 $("div#passwordpower2").hide(); 
            		 $("div#passwordpower0").hide()
            	}else if(iComplex > 12){
            		 $("div#passwordpower3").hide()
            		 //.css('display','none'); 
            		 $("div#passwordpower1").hide()
            		 $("div#passwordpower2").show()
            		 $("div#passwordpower0").hide()
            	}else if(iComplex > 0){
	           		 $("div#passwordpower3").hide()
	           		 //.css('display','none'); 
	           		 $("div#passwordpower1").show()
	           		 $("div#passwordpower2").hide()
	           		 $("div#passwordpower0").hide()
            	}else{
            		$("div#passwordpower0").show()
            		 $("div#passwordpower2").hide()
	           		 $("div#passwordpower1").hide()
	           		  $("div#passwordpower3").hide()
            	}
            	
            });
            
             function getNumber() {
             	$(".getValiCode").attr("disabled", "disabled");
             	$(".getValiCode").val(count + "秒后重获");
                 count--;
                 if (count > -1) {
                     setTimeout(getNumber, 1000);
                 } else {
                 	$(".getValiCode").val("重新获取");
                 	$(".getValiCode").attr("disabled", false);
                 }
             } 


             //获取手机短信验证码
             function clickVCode(e) {

//              	$("button#btn-vcode").removeAttr('onclick');
                 var phoneNumber = $("input#registeruserform-mobile").val();
                 var url = urlArray.getsmscode;
                 $.ajax({
                     url: url,
                     method: 'get',
                     data: {
                         'mobile': phoneNumber,
                         'type': 'RegSMSVerificationCode'
                     },
                     dataType: 'json',
                     success: function(data) {
                         mobileStub = data.identity.validationStub
                     },
                     error: function(data) {
                         alert("发生错误: " + eval(data));
                     }
                 });
                 
             }

             // 复杂度 1 ~ 7 为弱
             //6 ~ 12 为中
             //12 以上为强
             function computeComplex(password) {

            	    var complex = 0;
            	    var length = password.length;
            	    var pre = '';
            	    var preType = 0;
            	    for (var i = 0; i < length; i++) {
            	        var cur = password.charAt(i);
            	        var curType = getType(cur);//getType(password, i);
            	        if (preType != curType || !isRegular(cur, pre, curType)) {
            	            complex += curType + getComplex(curType, preType);
            	        }
            	        pre = cur;
            	        preType = curType;
            	    }
            	    return complex;
            	}
             //字符类型
            	function getType(str) {
            		//数字
            		if (str.charCodeAt(0) >= 48 && str.charCodeAt(0) <= 57) {  return 1; }
            		//小写字符
            	    else if(str.charCodeAt(0) >= 97 && str.charCodeAt(0) <= 122) {return 2; }
            		//大写字母
            	    else if(str.charCodeAt(0) >= 65 && str.charCodeAt(0) <= 90) {return 3;}
            		//特殊字母
            	    return 4;
            	}
            	 
            	function isRegular(cur, pre, type) {
            		
            		var curCode = cur.charCodeAt(0);var preCode = pre.charCodeAt(0);
            		if(curCode - preCode == 0){return true; }//相邻字母相同算做一个
            		//相邻字母按一个字母
            	    if(type != 4 && (curCode - preCode == 1 || curCode - preCode == -1)){ 
            	    	return true;}
            	    return false;
            	}
            	 
            	function getComplex(curType, preType){
            	    if(preType == 0 || curType == preType){ return 0;}else if(curType == 4 || preType == 4){return 2;}else{return 1;}
            	}

});
