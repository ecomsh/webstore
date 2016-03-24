jQuery(function () {
    jQuery('#add-address').click(function () {
        var c = jQuery("#address-count").val();
        if (c >= 10) {
            alert('最多只能保存10条收货地址！');
        } else {
            jQuery('#addr-div').toggle();
            jQuery('#addr-div-none').toggle();
            jQuery('#add-address-addnew').toggle();
            jQuery('#add-address-giveup').toggle();
        }
    })
});


jQuery(function () {
    preSelect(addr.stateCode, addr.cityCode, addr.districtCode,
            '#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');//preselect("四川省","成都市","金牛区");//设置默认选项
    initCountry('#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');
    jQuery("#address_submit").click(function () {
        jQuery(this).removeClass("disabled");
    });
});