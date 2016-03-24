/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//author:dcj
//date:2015.11.10
//

//
function jsApiCall(){
    
    WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			jsApiParameters,
			function(res){
                            WeixinJSBridge.log(res.err_msg);  
                            if(res.err_msg != "get_brand_wcpay_request:ok"){
//                                $("#go-to-pay").attr('clicked',false);
//                                alert('支付失败，请稍后再试');
//                                $("#go-to-pay").html('立即支付');
                            }
                            window.location.href = _return_url;
			}
		);
	}

function callpay()
{
//        var clicked = $("#go-to-pay").attr('clicked');
//        if(clicked) return;
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
//            $("#go-to-pay").attr('clicked',true);
//            $("#go-to-pay").html('正在支付...');
            jsApiCall();
        }
}
//获取共享地址
function editAddress()
{
        WeixinJSBridge.invoke(
                'editAddress',
                _editAddress,
                function(res){
//                        var value1 = res.proviceFirstStageName;
//                        var value2 = res.addressCitySecondStageName;
//                        var value3 = res.addressCountiesThirdStageName;
//                        var value4 = res.addressDetailInfo;
//                        var tel = res.telNumber;
//
//                        alert(value1 + value2 + value3 + value4 + ":" + tel);
                }
        );
}
	
window.onload = function(){
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', editAddress, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', editAddress); 
                document.attachEvent('onWeixinJSBridgeReady', editAddress);
            }
        }else{
                editAddress();
        }
};
