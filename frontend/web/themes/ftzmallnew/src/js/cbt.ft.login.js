/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    $.ajax({
        type : 'get',
        url : statusUrl,
        data : {},
        success:function(re){  
            if (re.userName){
                $("a.topbar-username").html(re.userName);
                $("#logoutBar").css('display', 'block');
                if ($("#loginBar"))
                    $("#loginBar").css('display', 'none');
            }
            else {
                $("#loginBar").css('display', 'block');
                if ($("#logoutBar"))
                $("#logoutBar").css('display', 'none');
            }
        },
        error:function(){
            $("#loginBar").css('display', 'block');
            alert("登录失败，请稍后再试");
       }  
    });
 
});
