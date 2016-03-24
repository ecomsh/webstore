var vcodeId = "#" + params.vcodeId;
var mobileInput = "input#" + params.formId + "-mobile";
var mobileField = ".field-" + params.formId + "-mobile";
var verifyCodeInput = "input#" + params.formId + "-verifycode";
var verifyCodeField = ".field-" + params.formId + "-verifycode";
var form = params.form;
var smsType = params.smsType;
var checkmobileurl = params.checkmobileurl;
var getsmscodeurl = params.getsmscodeurl;
//判断是否检查验证码的标志
var checkCaptcha = params.checkCaptcha ? params.checkCaptcha : false;

//Begin: zhi jun添加的passport中补全地址的js，可能需要迁移到别的js
var result = $('#addressapi-isdefault').attr("checked");

$('#addressapi-isdefault').bind("click", function () {

    if (result == 'checked') {

        $(this).attr("checked", result);
    }
    else {
        $(this).attr("checked", !result);
    }
    ;

    if (!result) {
        $(this).attr("value", 1);
    } else {
        $(this).attr("value", 0);
    }

    result = !result;

});
//End: zhi jun添加的passport中补全地址的js，可能需要迁移到别的js, 

$(document).ready(function () {

    // 获取验证码的倒计时
    var count;
    $(vcodeId).click(function () {
        var phoneNumber = $(mobileInput).val();
        var verifyCode = $(verifyCodeInput).val();
        if (phoneNumber === null || phoneNumber === '' || verifyCode === null || verifyCode === '') {
            $(mobileInput).focus();
            $(mobileInput).blur();
            $(verifyCodeInput).focus();
            $(verifyCodeInput).blur();
            return false;
        }
            var _data = {};
            _data[form] = {
                'mobile': phoneNumber,
                'verifyCode': verifyCode  //ajax方式验证captcha
            };

        $.ajax({
            url: checkmobileurl,
            type: 'post',
            data: _data,
            dataType: 'json',
            success: function (data) {
                var obj = eval(data);
                var mobile = obj.mobile;
                var verifyCode = obj.verifyCode;
                if (mobile === undefined && verifyCode === undefined) {
                    clickVCode();
                    count = 59;
                    getNumber();
                }
                else {
                    if(mobile !== undefined){
                    $(mobileInput).focus();
                    $(mobileField + " .help-block-error").html(mobile);
                    $(mobileField).addClass('has-error');
                    $(mobileField).removeClass('has-success');
                    }
                    
                    if(verifyCode !== undefined){
                    $(verifyCodeInput).focus();
                    $(verifyCodeField + " .help-block-error").html(verifyCode);
                    $(verifyCodeField).addClass('has-error');
                    $(verifyCodeField).removeClass('has-success');
                    }
                    return false;
                }
            },
            error: function (data) {
                alert("检测手机是否注册时出错，稍后再试~~");
            }

        });
    });

    function getNumber() {
        $(vcodeId).attr("disabled", "disabled");
        $(vcodeId).html(count + "秒后重获");
        count--;
        if (count > -1) {
            setTimeout(getNumber, 1000);
        } else {
            $(vcodeId).html("重新获取");
            $(vcodeId).attr("disabled", false);
        }
    }


    //获取手机短信验证码
    function clickVCode() {

        var phoneNumber = $(mobileInput).val();
        var fixcode = getFixCode();
        var _data = {};
        _data[form] = {
            'mobile': phoneNumber,
            'type': smsType,
            'fixcode': fixcode
        };
        $.ajax({
            url: getsmscodeurl,
            type: 'post',
            data: _data,
            dataType: 'json',
            success: function (data) {
                
            },
            error: function (data) {
//            	Yii::error('');
//                alert("获取验证验证码出错了。稍后再试~");
            }
        });
    }
    
    function getFixCode(){
   	 return $.md5("HlI0O0XSUICIXYSB"); 
    }
    
    
//    $("#w0").submit(function(){
//        if($("#regSubmitBtn").attr("isSubmit") == 'F'){
//            return false;
//        }else{
//            $("#regSubmitBtn").attr("isSubmit",'F');
//        }
//    });
});