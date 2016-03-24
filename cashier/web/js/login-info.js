$(document).ready(function(){
    $.ajax({
        type : 'get',
        url : statusUrl,
        data : {},
        success:function(re){  
            if (re != null && re != '' && re != "undefined"){
                $("span#login-user").html(re.userName);
                $("span#store-name").html(re.storeName);
            }
            else {
                $("div#login-welcome").css('display', 'none');
                $("#store-info").css('display', 'none');
                alert("暂时不能获得登录信息");
            }
        },
        error:function(){
            alert("登录失败，请稍后再试");
       }  
    });
 
});