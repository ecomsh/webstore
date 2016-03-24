$(function () {
    $('.new-address').click(function () {
        var c = $("#address-count").val();
        if (c >= 10) {
            alert('最多只能保存10条收货地址！');
            return false;
        }
    })
});


$(function () {
    preSelect(addr.stateCode, addr.cityCode, addr.districtCode,
            '#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');//preselect("四川省","成都市","金牛区");//设置默认选项
    initCountry('#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');
    $("#address_submit").click(function () {
        $(this).removeClass("disabled");
    });
});
$(function(){
    var che=$(".check-box").children("input");
    for(var k=0;k<che.length;k++){
        if(che[k].checked==true){
            $(che[k]).parents(".checkbox-info").addClass("selected");
        }
        if(che[k].checked==false){
            $(che[k]).parents(".checkbox-info").removeClass("selected");
        }
    }
    $(".check-box").click(function(){
        for(var k=0;k<che.length;k++){
            if(che[k].checked==true){
                $(che[k]).parents(".checkbox-info").addClass("selected");
            }
            if(che[k].checked==false){
                $(che[k]).parents(".checkbox-info").removeClass("selected");
            }
        }
    })

})
