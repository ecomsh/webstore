$(document).ready(function () {
    $("#next-noaddr-order").click(function () {
        window.location.href = completeUrl;
    });

    $("#close-nextorder-dialog").click(function () {
        //关闭弹窗
        $('#nextorder-dialog').hide();
        //将地址表格和提交按钮disable掉
        $('button.new-address').attr("disabled", "disabled");
        $('input#addressapi-address').attr("readonly", "readonly");
        $('input#addressapi-postcode').attr("readonly", "readonly");
        $('input#addressapi-receivername').attr("readonly", "readonly");
        $('input#addressapi-receivermobile').attr("readonly", "readonly");
        $('input#addressapi-receiverphone').attr("readonly", "readonly");
        $('input#addressapi-isdefault').attr("disabled", "disabled");
        $('input#addressapi-issave').attr("disabled", "disabled");
    });

    $('.address-bigbox').on('click', 'li', function () {

        if ($('button.new-address').attr("disabled") !== "disabled") {
            $name = $(this).find("span#receiver-name").html();
            $('input#addressapi-receivername').val($name);
            $mobile = $(this).find("span#receiver-mobile").html();
            $('input#addressapi-receivermobile').val($mobile);
            $addr = $(this).find("span#address").html();
            $('input#addressapi-address').val($addr);
            $postcode = $(this).find("span#common-postcode").html();
            $('input#addressapi-postcode').val($postcode); 
            return true;
        }
        else{
            return false;
        }
    });

});