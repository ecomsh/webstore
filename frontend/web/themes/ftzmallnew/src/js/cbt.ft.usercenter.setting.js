jQuery(document).ready(function () {

        // 获取验证码的倒计时
        var count;
        jQuery(".getValiCode").click(function () {
            var phoneNumber = jQuery("input#bindmobileform-mobile").val();
            if(phoneNumber==null || phoneNumber==''){
                jQuery("input#bindmobileform-mobile").focus();
                jQuery("input#bindmobileform-mobile").blur();
                return false;
            }
            var url = valmobileurl;
            jQuery.ajax({
                url: url,
                type: 'get',
                data: {
                    'BindMobileForm': {
                        'mobile': phoneNumber
                    }
                },
                dataType: 'json',
                success: function (data) {
                    var obj = eval(data);
                    var mobile = obj.mobile;
                    
                    if (mobile === undefined) {
                        clickVCode();
                        count = 59;
                        getNumber();
                    }
                    else {
                        jQuery("input#bindmobileform-mobile").focus();
                        jQuery(".field-bindmobileform-mobile .help-block-error").html(mobile);
                        jQuery(".field-bindmobileform-mobile").addClass('has-error');
                        jQuery(".field-bindmobileform-mobile").removeClass('has-success');
                        return false;
                    }
                },
                error: function (data) {
                    alert("服务器发生错误: " + data);
                }

            });
        });

        function getNumber() {
            jQuery(".getValiCode").attr("disabled", "disabled");
            jQuery(".getValiCode").val(count + "秒后重获");
            count--;
            if (count > -1) {
                setTimeout(getNumber, 1000);
            } else {
                jQuery(".getValiCode").val("重新获取");
                jQuery(".getValiCode").attr("disabled", false);
            }
        }


        //获取手机短信验证码
        function clickVCode() {

            var phoneNumber = jQuery("input#bindmobileform-mobile").val();
            var url = getsmscodeurl;
            jQuery.ajax({
                url: url,
                type: 'get',
                data: {
                    'mobile': phoneNumber,
                    'type': ''
                },
                dataType: 'json',
                success: function (data) {
                    mobileStub = data.identity.validationStub
                },
                error: function (data) {
                    alert("服务器发生错误: " + data);
                }
            });
        }
    });