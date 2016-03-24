/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(
		function(){
                // 获取验证码的倒计时
             var count;
             $("#dynamic-vcode").click(function () {
                         clickVCode();
                         count = 59;
                         getNumber();

             });
                

            
             function getNumber() {
             	$("#dynamic-vcode").attr("disabled", "disabled");
             	$("#dynamic-vcode").html(count + "秒后重获");
                 count--;
                 if (count > -1) {
                     setTimeout(getNumber, 1000);
                 } else {
                 	$("#dynamic-vcode").html("重新获取");
                 	$("#dynamic-vcode").attr("disabled", false);
                 }
             } 


             //获取手机短信验证码
             function clickVCode(e) {

                 var phoneNumber = $("input#findpwdform-mobile").val();
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
             
            
             //邮箱找回密码
             $("#btn-tomail").click(function () {
            	 location.href = urlArray.domain;
             });
             
             //邮箱找回密码
             $("#dynamic-vcode-email").click(function () {

                 var email = $("input#findpwdform-email").val();
                 var url = urlArray.getemaillink;
                 $.ajax({
                     url: url,
                     method: 'post',
                     data: {
                    	 'baseUrl': urlArray.checkidentity,
                         'email': email,
                         'type': 'RegSMSVerificationCode'
                     },
                     dataType: 'json',
                     success: function(data) {
                    	 window.location.replace(urlArray.checkemail);
                     },
                     error: function(data) {
                         alert("发生错误: " + eval(data));
                     }
                 });
                 
             
             });
             
            $('#back').click(function(){
            	 window.location.href = urlArray.back;
            	
            });
            
            
	     });

function resend(){
	
	var m = $("meta[name=csrf-param]");   
	var n = $("meta[name=csrf-token]");   
	var _csrf = n.attr("content");
	  var url = urlArray.getemaillink;
    $.ajax({
        url: url,
        method: 'post',
        data: {
        	'_csrf' : _csrf,
       	 	'baseUrl': urlArray.checkidentity,
            'email': urlArray.email,
            'type': 'RegSMSVerificationCode'
        },
        dataType: 'json',
        success: function(data) {
        	alert("重置密码连接已经发送至您的"+ urlArray.email + "邮箱");
        		//window.location.replace(urlArray.checkemail);
        },
        error: function(data) {
            alert("发生错误: " + data);
        }
    });
	
}
