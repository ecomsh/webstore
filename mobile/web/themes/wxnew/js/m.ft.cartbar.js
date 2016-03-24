/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
        
        if (userId != '')
        {
            var cookieCartNum = $.cookie('ccn_' + userId);
            //if (typeof(cookieCartNum) == "undefined")
            if(true)// 暂时先不用cookie 如果要用  加入购物车，修改 删除 都要修改这个cookie
            {
                $.ajax({
                    type: 'get',
                    url: cartNumUrl,
                    data:{},
                    success: function (carttotalnum) {
                        $("div.car-count").html(carttotalnum);
                    }
                })
            }else{
                $("div.car-count").html(cookieCartNum);
            }      
        }else{
            $("div.car-count").html('0');
        }
       
});
