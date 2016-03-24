//定时器句柄
var intervalId;
var numIsverified = true;

//查询号码
function queryByUserPhone(userPhone) {
    $.ajax({
        url: URL.queryaddr,
        data: {'phone': userPhone},
        dataType: 'json',
        beforeSend: function () {
            $('#loader').show();
            $('#webpos-query-btn').attr('disabled', 'disabled');
        },
        complete: function () {
            $('#webpos-query-btn').removeAttr('disabled');
            $('#loader').hide();
        },
        success: function (data) {
            if (typeof (data.code) != "undefined") {
                alert(data.message);
                return;
            } else {
                $('input#orderUserId').val(data.uid);
                $('input#userid').val(data.uid);
                $('span#uname').text(data.uname);
                data = data.addrList;
                //put in to localStorage
                localStorage.setItem("addrList", JSON.stringify(data));
                $("#webpos-input").select();
            }

            var addrlist = $('div.addresslist');
            addrlist.find('.addr').remove();
            $('input#orderAddrId').val('');

            for (var i = 0; i < data.length; i++) {
                var addr = prepareAddrBlock();
                addr.attr('data-addrid', data[i].addressId);
                addr.find('.addr-state').text(data[i].stateName);
                addr.find('.addr-state').attr('data-statecode', data[i].stateCode);
                addr.find('.addr-city').text(data[i].cityName);
                addr.find('.addr-city').attr('data-citycode', data[i].cityCode);
                addr.find('.addr-district').text(data[i].districtName);
                addr.find('.addr-district').attr('data-districtcode', data[i].districtCode);

                addr.find('.addr-receiver').text(data[i].receiverName);
                addr.find('.addr-phone').text(data[i].receiverMobile);
                addr.find('.addr-addr').text(data[i].address);

                addrlist.prepend(addr);
                if (data[i]['isDefault']) {
                    addr.click();
                }
            }
            $('div.add_addr').show();
        },
        error: function () {
            alert('暂时无法查询地址');
        }
    });
}

//增加商品
function queryByGoodnum(goodNum) {
    var order_input = $('#webpos-input');
    var newId = true;
    var input = goodNum;
    var id = null;

    //judge whether id or url
    var Urlre = /\/p\/(\d{3,})\.html/;
    var Idre = /^\d{3,}$/;


    if (Urlre.test(input)) { //it is url
        id = Urlre.exec(input)[1];
    } else if (Idre.test(input)) { //it is id
        id = input;
    } else {
        $('#alert').text('输入有误，请检查 ' + input);
        order_input.val('');
        return false;
    }
    //remove alert
    $('#alert').text('');

    var eachItem = $('.item');
    eachItem.each(function () {
        if (id == $(this).find('.id').val()) {
            var num = $(this).find('.num').val();

            var quantityOnhand = parseInt($(this).attr('data-quantityOnhand'));
            if (parseInt(num) > quantityOnhand - 1) {
                order_input.val('');
                alert("该商品缺货");
                newId = false;
                return false;
            }

            $(this).find('.num').val(parseInt(num) + 1);
            $(this).find('.num').attr('data-value', parseInt(num) + 1);
            var price = parseFloat($(this).find('.price').val());
            var tax = parseFloat($(this).find('.tax').val());
            add_totalFee(price, tax);
            order_input.val('');
            newId = false;
            return false;
        }
    });

    if (newId) {
        var item = $(
                '<tr class="item" data-partNumber="">' +
                '<td class="item_num"><input name="id[]" class="id text" readonly="readonly" value=""></td>' +
                '<td><textarea name="name[]" class="name text" readonly="readonly"></textarea></td>' +
                '<td class="narrow"><input name="price[]" class="price text" readonly="readonly" value=""></td>' +
                '<td class="narrow"><input name="tax[]" class="tax text" readonly="readonly" value=""></td>' +
                '<td>' +
                '<input type="button" value="-"  class="del_num btn btn-danger">' +
                '<input style="display:inline-block;" name="num[]" class="num form-control input-xm" data-value="1" value="1">' +
                '<input type="button" value="+"  class=" add_num btn btn-success">' +
                '</td>' +
                '<td><button type="button" class="del btn btn-danger">删除</button></td>' +
                '</tr>'
                );
        item.find('.id').val(id);
        item.find('.num').change(function () {
            num_change(this);
        });
        item.find('.del').click(order_delItem);

        item.find('.del_num').click(function () {
            var item = $(this).parent().parent();
            var num = item.find('.num');
            if (num.val() == 1) {
                item.find('.del').click();
                return;
            }
            num.val(parseInt(item.find('.num').val()) - 1);
            num.change();
        });
        item.find('.add_num').click(function () {
            var item = $(this).parent().parent();
            var num = item.find('.num');
            var quantityOnhand = parseInt(item.attr('data-quantityOnhand'));
            var value = parseInt(item.find('.num').val());
            if (value < quantityOnhand) {
                num.val(parseInt(item.find('.num').val()) + 1);
                num.change();
            } else {
                alert('超过库存');
            }
        });

        $.ajax({
            url: URL.iteminfo,
            data: {'id': id},
            dataType: 'json',
            beforeSend: function () {
                $('#webpos-query-btn').attr('disabled', 'disabled');
                $('#loader').show();
            },
            complete: function () {
                $('#webpos-query-btn').removeAttr('disabled');
                order_input.focus();
                $('#loader').hide();
            },
            success: function (data) {
                if (typeof (data.code) == "undefined") {

                    if (data.quantityOnhand <= 0) {
                        order_input.val('');
                        alert(data.name + " 缺货");
                        return;
                    }

                    item.attr('data-partNumber', data.partNumber);
                    item.attr('data-quantityOnhand', data.quantityOnhand);
                    item.attr('data-minbuycount', data.minBuyCount);
                    item.attr('data-maxbuycount', data.maxBuyCount);
                    item.find('.name').text(data.name);
                    item.find('.price').val(data.price);
                    item.find('.tax').val(data.tax);
                    //如果是第一件商品，设置orderSalesType,如果不是，对比saleType
                    if ($('div.orderlist table tbody tr.item').length == 0) {
                        localStorage.setItem('orderSalesType', data.salesType);
                        localStorage.setItem('orderMemberId', data.memberId);
                    } else {
                        if (localStorage.getItem('orderSalesType') != data.salesType) {
                            alert("新加商品与订单内商品不属同一类商品，请分开下单");
                            return;
                        }
                        if (localStorage.getItem('orderMemberId') != data.memberId) {
                            alert("新加商品与订单内商品不在同一个store，请分开下单");
                            return;
                        }
                    }
                    $('form#orderForm tbody').prepend(item);
                    add_totalFee(data.price, data.tax);
                    //如果最小购买数量大于1
                    if (data.minBuyCount > 1) {
                        item.find('.num').val(data.minBuyCount).change();
                    }
                    order_input.val('');
                } else {
                    if (data.code == 12005) {
                        alert('不存在此商品号');
                        return;
                    }
                    alert(data.message);
                }
            },
            error: function () {
                alert('暂时无法连接到后端服务器');
            }
        });
    }
    return false;
}

//
////支付宝支付请求
//function doAlipay() {
////  var receiptData = JSON.parse(localStorage.getItem('receiptData'));
//  var orderId = $.cookie('orderId');
//  var actualPrice = receiptData.priceInfo.actualPrice;
//
//  jQueryOpenPostWindow(URL.alipay,{'orderId':orderId, 'itemSum': actualPrice},"a",null);
//  
//   // console.log(receiptData);
//
//}

$(document).ready(function () {
    //查询框回车键或Tab键查询
    $(document.body).keydown(function (event) {
        var isInputFocus = $("#webpos-input").is(":focus");
        if (isInputFocus && $('#orderForm').css('display') == 'block') {
            if (event.keyCode == 13 || event.keyCode == 9) {
                $('#webpos-query-btn').click();
            }
        }
        else {
            if (event.keyCode == 13) {
                if ($('#orderForm').css('display') == 'block') {
                    numIsverified = true;
                    $('button#order_next').focus(); //In order to check ite_num(call function num_change) first
                    if (numIsverified) {
                        $('button#order_next').click();
                    }
                } else if ($('#confirmForm').css('display') == 'block') {
                    $('button#confirm').click();
                }
            }
        }

    });
    $('#webpos-query-btn').click(function () {
        var inputContent = $.trim($('#webpos-input').val());
        if (!inputContent || inputContent.length == 0) {
            $('#alert').text('输入为空，请检查 ');
            return false;
        }
        //判断inputContent是手机号还是订单号
        var phonePattern = /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
        if (phonePattern.test(inputContent)) {
            queryByUserPhone(inputContent);
        } else {
            queryByGoodnum(inputContent);
        }
    });

    //address

    $('.addr-toolbar').click(function () {
        var modal = $('#addressModal');
        var addr = $(this).parents('.inner');
        modal.find('.modal-title').text('修改地址');
        modal.find('#add_addr_btn').hide();
        modal.find('#modify_addr_btn').show();

        modal.find('#addressapi-receivername').val(addr.find('.addr-receiver').text());
        modal.find('#addressapi-receivermobile').val(addr.find('.addr-phone').text());
        modal.find('#addressapi-statecode').val(addr.find('.addr-state').attr('data-statecode'));
        modal.find('#addressapi-statecode').change();
        modal.find('#addressapi-citycode').val(addr.find('.addr-city').attr('data-citycode'));
        modal.find('#addressapi-citycode').change();
        modal.find('#addressapi-districtcode').val(addr.find('.addr-district').attr('data-districtcode'));
        modal.find('#addressapi-districtcode').change();
        modal.find('#addressapi-address').val(addr.find('.addr-addr').text());
    });



    $('#addr_modal_btn').click(function () {
        var modal = $('#addressModal');

        modal.find('.modal-title').text('新增地址');
        modal.find('#modify_addr_btn').hide();
        modal.find('#add_addr_btn').show();

        modal.find('#addressapi-receivername').val("");
        modal.find('#addressapi-receivermobile').val("");
        modal.find('#addressapi-statecode').val("310000");
        modal.find('#addressapi-statecode').change();
        modal.find('#addressapi-citycode').val("310100");
        modal.find('#addressapi-citycode').change();
        modal.find('#addressapi-districtcode').val("310101");
        modal.find('#addressapi-districtcode').change();

    });


    //address select

    preSelect("310000", "310100", "310101",
            '#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');//preselect("四川省","成都市","金牛区");//设置默认选项
    initCountry('#addressapi-statecode', '#addressapi-citycode', '#addressapi-districtcode', '#addressapi-address');
    $("#address_submit").click(function () {
        $(this).removeClass("disabled");
    });


    //address action


    //add address
    $('#add_addr_btn').click(function () {

        var modal = $('#addressModal');

        modal.find('.form-control').each(function () {
            $(this).focus();
        });

        modal.find('button').each(function () {
            $(this).focus();
        });


        if (modal.find('.form-group').hasClass('has-error')) {
            return false;
        }


        // < store to localStorage
        var addrList = JSON.parse(localStorage.getItem('addrList'));

        var modelData = modal.find('#addressForm').serializeArray();
        var addrItem = {};

        for (var i = 0; i < modelData.length; i++) {
            var key = modelData[i].name;
            var value = modelData[i].value;

            if (key.indexOf('AddressApi[') == 0) {
                key = key.substring(11, key.length - 1);
            }
            addrItem[key] = value;

        }
        //adjust to comply the same format
        addrItem.addressId = 'tempAddr_' + addrList.length;
        addrItem.userId = addrItem.userid;

        addrItem.addrid = undefined;
        addrItem.userid = undefined;

        if ($.trim(addrItem.address) == $.trim(addrItem.stateName + addrItem.cityName + addrItem.districtName)) {
            addrItem.address = '';
        }

        addrList.push(addrItem);

        localStorage.setItem('addrList', JSON.stringify(addrList));

        // />store to localStorage


        var addr = prepareAddrBlock();
        addr.find('.addr-toolbar').text('临时地址修改').attr('data-toggle', 'modal');

        addr.attr('data-addrid', addrItem.addressId);
        addr.find('.addr-state').text(addrItem.stateName);
        addr.find('.addr-state').attr('data-statecode', addrItem.stateCode);
        addr.find('.addr-city').text(addrItem.cityName);
        addr.find('.addr-city').attr('data-citycode', addrItem.cityCode);
        addr.find('.addr-district').text(addrItem.districtName);
        addr.find('.addr-district').attr('data-districtcode', addrItem.districtCode);

        addr.find('.addr-receiver').text(addrItem.receiverName);
        addr.find('.addr-phone').text(addrItem.receiverMobile);
        addr.find('.addr-addr').text(addrItem.address);



        var addrlist = $('div.addresslist')

        addrlist.find('div.add_addr').before(addr);

        //if(addrlist.find('div.addr').size() >= 10){
        //    $('div.add_addr').hide();
        //}


        $('#addressModal').modal('toggle');

    });




    //Collapsing btn
    var addr_hide = false;
    $('#addr-hide-btn').click(function () {
        var addrlist = $('div.addresslist');
        if (!addr_hide) {
            addrlist.css("height", "106px");
            addr_hide = true;
        } else {
            addrlist.css("height", "auto");
            addr_hide = false;
        }
    });

    //modify address
    $('#modify_addr_btn').click(function () {

        var addr = $('.addr.active');
        var modal = $('#addressModal');

        modal.find('input#addrid').val(addr.attr('data-addrid'));

        modal.find('.form-control').each(function () {
            $(this).focus();
        });

        modal.find('button').each(function () {
            $(this).focus();
        });

        if (modal.find('.form-group').hasClass('has-error')) {
            return false;
        }
        if (addr.attr('data-addrid').indexOf("tempAddr") != -1) {
            var newAddrInfo = modal.find('#addressForm').serializeArray();
            var addrid = addr.attr('data-addrid');
            modifyTempAddr(addrid, newAddrInfo);
            return;
        }

        $.ajax({
            url: URL.modifyaddr,
            type: 'post',
            data: modal.find('#addressForm').serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('button#modify_addr_btn').attr('disabled', 'disabled');
            },
            complete: function () {
                $('button#modify_addr_btn').removeAttr('disabled');
            },
            success: function (data) {
                if (typeof (data.code) != "undefined") {
                    //没有测过
                    alert(data.message);
                    return;
                }
                addr.find('.addr-state').text(data.stateName);
                addr.find('.addr-state').attr('data-statecode', data.stateCode);
                addr.find('.addr-city').text(data.cityName);
                addr.find('.addr-city').attr('data-citycode', data.cityCode);
                addr.find('.addr-district').text(data.districtName);
                addr.find('.addr-district').attr('data-districtcode', data.districtCode);

                addr.find('.addr-receiver').text(data.receiverName);
                addr.find('.addr-phone').text(data.receiverMobile);
                addr.find('.addr-addr').text(data.address);

                $('#addressModal').modal('toggle');
            },
            error: function () {
                alert('暂时无法连接到服务器');
            }

        });


    });



//    $('#alipay-btn').click(doAlipay);

    $('button#order_next').click(function () {

        var orderForm = $('form#orderForm');


        if ($('input#orderAddrId').val() == '') {
            alert('请选择一个地址');
            return false;
        }

        if (orderForm.find('.item').size() == 0) {
            alert('请至少输入一个商品');
            return false;
        }

        //if it is temp Addr
        //pop addr data to form
        if ($('input#orderAddrId').val().indexOf('tempAddr_') != -1) {
            var addrList = JSON.parse(localStorage.getItem('addrList'));
            var addrItem = null;
            for (var i = 0; i < addrList.length; i++) {
                if (addrList[i].addressId == $('input#orderAddrId').val()) {
                    addrItem = addrList[i];
                    break;
                }
            }


            orderForm.find('input#order_countryCode').val('CN');
            orderForm.find('input#order_stateCode').val(getValue(addrItem.stateCode));
            orderForm.find('input#order_stateName').val(getValue(addrItem.stateName));
            orderForm.find('input#order_districtCode').val(getValue(addrItem.districtCode));
            orderForm.find('input#order_districtName').val(getValue(addrItem.districtName));
            orderForm.find('input#order_cityCode').val(getValue(addrItem.cityCode));
            orderForm.find('input#order_cityName').val(getValue(addrItem.cityName));
            orderForm.find('input#order_addressName').val(getValue(addrItem.addressName));
            orderForm.find('input#order_postcode').val(getValue(addrItem.postcode));
            orderForm.find('input#order_address').val(getValue(addrItem.address));
            orderForm.find('input#order_receiverName').val(getValue(addrItem.receiverName));
            orderForm.find('input#order_receiverMobile').val(getValue(addrItem.receiverMobile));
            orderForm.find('input#order_receiverPhone').val(getValue(addrItem.receiverPhone));
        }


        $.ajax({
            url: URL.confirm,
            type: 'post',
            data: orderForm.serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#loader').show();
                $('button#order_next').attr('disabled', 'disabled');
            },
            complete: function () {
                $('button#order_next').removeAttr('disabled');
                $('#loader').hide();
            },
            success: function (data) {
                if (typeof (data.code) != "undefined") {
                    //没有测试
                    alert(data.message);
                    return;
                }

                data = data.data;
                prepareConfirmOrder(data);
                //准备小票数据
//                prepareReceipt(data, 1);
                orderForm.hide();
                $('form#confirmForm').show();
                $('#input-div-block').css('display', 'none');
                $('#alert').css('display', 'none');

            },
            error: function () {
                alert('暂时无法连接到服务器');
            }

        });

    });


    $('button#confirm_pre').click(function () {
        $('form#confirmForm').hide();
        $('form#orderForm').show();
        $('#input-div-block').css('display', 'block');
    });


    $('button#confirm').click(function () {

        var confirmForm = $('form#confirmForm');


        //if it is temp Addr
        //pop addr data to form
        //*******need modify!!!!!!******
        if ($('input#orderAddrId').val().indexOf('tempAddr_') != -1) {
            var addrList = JSON.parse(localStorage.getItem('addrList'));
            var addrItem = null;
            for (var i = 0; i < addrList.length; i++) {
                if (addrList[i].addressId == $('input#orderAddrId').val()) {
                    addrItem = addrList[i];
                    break;
                }
            }


            confirmForm.find('input#confirm_countryCode').val('CN');
            confirmForm.find('input#confirm_stateCode').val(getValue(addrItem.stateCode));
            confirmForm.find('input#confirm_stateName').val(getValue(addrItem.stateName));
            confirmForm.find('input#confirm_districtCode').val(getValue(addrItem.districtCode));
            confirmForm.find('input#confirm_districtName').val(getValue(addrItem.districtName));
            confirmForm.find('input#confirm_cityCode').val(getValue(addrItem.cityCode));
            confirmForm.find('input#confirm_cityName').val(getValue(addrItem.cityName));
            confirmForm.find('input#confirm_addressName').val(getValue(addrItem.addressName));
            confirmForm.find('input#confirm_postcode').val(getValue(addrItem.postcode));
            confirmForm.find('input#confirm_address').val(getValue(addrItem.address));
            confirmForm.find('input#confirm_receiverName').val(getValue(addrItem.receiverName));
            confirmForm.find('input#confirm_receiverMobile').val(getValue(addrItem.receiverMobile));
            confirmForm.find('input#confirm_receiverPhone').val(getValue(addrItem.receiverPhone));
        }



        $.ajax({
            url: URL.createorder,
            type: 'post',
            data: confirmForm.serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#loader').show();
                $('button#confirm').attr('disabled', 'disabled');
            },
            complete: function () {
                $('button#confirm').removeAttr('disabled');
                $('#loader').hide();
            },
            success: function (data) {
                if (typeof (data.code) != "undefined") {

                    // if out of stock
                    if (data.code == 7003) {
                        var partNumber = data.message.split(':')[1].split(',')[0];

                        var eachItem = $('item');
                        $('.item').each(function () {
                            if (partNumber == $(this).attr('data-partNumber')) {
                                $(this).find('input.id').after('<span class="label label-danger" style="position:absolute; left:20%; margin-top:5px;">缺货</span>');
                                confirmForm.hide();
                                $('form#orderForm').show();
                                alert('商品 ' + $(this).find('textarea.name').text() + ' 缺货, 请从订单中删除');
                                return false;
                            }
                        });

                        return;
                    }

                    alert(data.message);
                    return;
                }
                confirmForm.hide();
                $('div#payMethod').show();

            },
            error: function () {
                alert('暂时无法连接到服务器');
            }

        });

    });

    if (Isnext) {
        var uid = $.cookie('buyerId');
        var preaddid = $.cookie('preAddrid');
        $('input#orderUserId').val(uid);
        $('input#userid').val(uid);
        $.ajax({
            type: 'get',
            url: URL.queryrealname,
            data: {"uid": uid},
            success: function (re) {
                if (re != null && re != '' && re != "undefined") {
                    $('span#uname').text(re);
                }
                else {
                    alert("暂时不能获得用户实名认证信息");
                }
                //TBD yyjia
                var addrlist = $('div.addresslist');
                addrlist.find('.addr').remove();
                $('input#orderAddrId').val('');

                var data = JSON.parse(localStorage.getItem('addrList'));

                for (var i = data.length - 1; i >= 0; i--) {
                    var addr = prepareAddrBlock();
                    addr.attr('data-addrid', data[i].addressId);
                    if (data[i].addressId.indexOf('tempAddr_') !== -1) {
                        addr.find('.addr-toolbar').text('临时地址修改').attr('data-toggle', 'modal');
                    }
                    addr.find('.addr-state').text(data[i].stateName);
                    addr.find('.addr-state').attr('data-statecode', data[i].stateCode);
                    addr.find('.addr-city').text(data[i].cityName);
                    addr.find('.addr-city').attr('data-citycode', data[i].cityCode);
                    addr.find('.addr-district').text(data[i].districtName);
                    addr.find('.addr-district').attr('data-districtcode', data[i].districtCode);

                    addr.find('.addr-receiver').text(data[i].receiverName);
                    addr.find('.addr-phone').text(data[i].receiverMobile);
                    addr.find('.addr-addr').text(data[i].address);

                    addrlist.prepend(addr);
                   if (preaddid != "undefined" && preaddid != null && preaddid != '' && preaddid == data[i].addressId) {
                        addr.click();
                    }
                }
                $('div.add_addr').show();
            },
            error: function () {
                alert("不能获得用户信息，请手动输入");
            }
        });
    }

});


function prepareAddrBlock() {

    var addr = '<div class="addr">' +
            '<div class="inner">' +
            '<div class="addr-head">' +
            '<span class="addr-state" data-statecode="" ></span> <span class="addr-city" data-citycode="" ></span> <span class="addr-district" data-districtcode="" ></span> (<span class="addr-receiver" ></span>)  收' +
            '</div>' +
            '<div class="addr-body">' +
            '<span class="addr-addr" ></span> (<span class="addr-phone"></span>)' +
            '</div>' +
            '<div class="addr-toolbar" data-toggle="modal" data-target="#addressModal" >' +
            '修改' +
            '</div>' +
            '</div>' +
            '</div>';
    addr = $(addr);

    //bind action
    addr.click(function () {
        addrBlockClick(this);
    });

    addr.find('.addr-toolbar').click(function () {
        modifyAddrClick(this);
    });

    return addr;
}




function addrBlockClick(ele) {
    $('div.addr').removeClass('active');
    $(ele).addClass('active');

    var form = $('form#orderForm');

    form.find('input#orderAddrId').val($(ele).attr('data-addrid'));

}



function modifyAddrClick(ele) {
    var modal = $('#addressModal');
    var addr = $(ele).parents('.inner');
    modal.find('.modal-title').text('修改地址');
    modal.find('#add_addr_btn').hide();
    modal.find('#modify_addr_btn').show();

    modal.find('#addressapi-receivername').val(addr.find('.addr-receiver').text());
    modal.find('#addressapi-receivermobile').val(addr.find('.addr-phone').text());
    modal.find('#addressapi-statecode').val(addr.find('.addr-state').attr('data-statecode'));
    modal.find('#addressapi-statecode').change();
    modal.find('#addressapi-citycode').val(addr.find('.addr-city').attr('data-citycode'));
    modal.find('#addressapi-citycode').change();
    modal.find('#addressapi-districtcode').val(addr.find('.addr-district').attr('data-districtcode'));
    modal.find('#addressapi-districtcode').change();
    modal.find('#addressapi-address').val(addr.find('.addr-addr').text());
}


function modifyTempAddr(addid, addinfo) {
    var addrList = JSON.parse(localStorage.getItem('addrList'));
    var addrItem = {};

    for (var i = 0; i < addinfo.length; i++) {
        var key = addinfo[i].name;
        var value = addinfo[i].value;

        if (key.indexOf('AddressApi[') == 0) {
            key = key.substring(11, key.length - 1);
        }
        addrItem[key] = value;
    }
    addrItem.addressId = addid;
    addrItem.userId = addrItem.userid;

    addrItem.addrid = undefined;
    addrItem.userid = undefined;

    if ($.trim(addrItem.address) == $.trim(addrItem.stateName + addrItem.cityName + addrItem.districtName)) {
        addrItem.address = '';
    }
    //modify the related addrItem in addlist
    var isFound = false;
    for (var i = 0; i < addrList.length; i++) {
        if (addrList[i].addressId == addid) {
            addrList[i] = addrItem;
            isFound = true;
            break;
        }
    }
    if (!isFound) {
        alert("修改临时地址出错，请稍后再试");
        return false;
    }
    localStorage.setItem('addrList', JSON.stringify(addrList));

    //modify the display addr
    var addr = $('.addr.active');
    addr.find('.addr-state').text(addrItem.stateName);
    addr.find('.addr-state').attr('data-statecode', addrItem.stateCode);
    addr.find('.addr-city').text(addrItem.cityName);
    addr.find('.addr-city').attr('data-citycode', addrItem.cityCode);
    addr.find('.addr-district').text(addrItem.districtName);
    addr.find('.addr-district').attr('data-districtcode', addrItem.districtCode);

    addr.find('.addr-receiver').text(addrItem.receiverName);
    addr.find('.addr-phone').text(addrItem.receiverMobile);
    addr.find('.addr-addr').text(addrItem.address);

    $('#addressModal').modal('toggle');
}




function num_change(ele) {

    var item = $(ele).parents('tr.item');
    var oldVal = $(ele).attr('data-value');
    var newVal = $(ele).val();
    var minBuyCount = parseInt(item.attr('data-minBuyCount'));
    var maxBuyCount = parseInt(item.attr('data-maxBuyCount'));
    var quantityOnhand = parseInt(item.attr('data-quantityOnhand'));
    var re = /^\d{1,}$/;


    if (!re.test(newVal)) {
        $(ele).val(oldVal);
        numIsverified = false;
        alert("输入了非数字 " + newVal);
        return;
    }

    newVal = parseInt(newVal);

    if (newVal == 0) {
        item.remove();
    }

    if (newVal > quantityOnhand) {
        $(ele).val(oldVal);
        numIsverified = false;
        alert("只剩 " + quantityOnhand + "件");
        return;
    }

    if (newVal < minBuyCount) {
        $(ele).val(oldVal);
        numIsverified = false;
        alert("最小购买数量为" + minBuyCount + "件");
        return;
    }

    if (newVal > maxBuyCount) {
        $(ele).val(oldVal);
        numIsverified = false;
        alert("最大购买数量为" + maxBuyCount + "件");
        return;
    }

    $(ele).attr('data-value', newVal);
    var price = parseFloat(item.find('.price').val());
    var tax = parseFloat(item.find('.tax').val());

    var diff = newVal - oldVal;

    add_totalFee(price * diff, tax * diff);
}





function order_delItem(event) {
    var $item = $(event.target).parents('tr.item');
    var num = parseInt($item.find('.num').val());
    var price = parseFloat($item.find('.price').val());
    var tax = parseFloat($item.find('.tax').val());
    add_totalFee(0 - price * num, 0 - tax * num);
    $item.remove();

    if ($('div.orderlist table tbody tr.item').length == 0) {
        localStorage.removeItem('orderSalesType');
    }
}

function add_totalFee(price, tax) {

    checkBuyableAlert(price, tax);

    var tot_price = $('#totalPrice');
    var tot_tax = $('#totalTax');
    tot_price.text((parseFloat(tot_price.text()) + parseFloat(price)).toFixed(2));
    tot_tax.text((parseFloat(tot_tax.text()) + parseFloat(tax)).toFixed(2));
}


function prepareConfirmOrder(data) {

    var confirmForm = $('form#confirmForm');

    confirmForm.find('input#uid').val(data.uid);
    confirmForm.find('input#addrid').val(data.address.addressId);

    //填充订单地址
    confirmForm.find('span#addr_receiver_name').text(data.address.receiverName);
    confirmForm.find('span#addr_receiver_mobile').text(data.address.receiverMobile);
    confirmForm.find('span#addr_state_name').text(data.address.stateName);
    confirmForm.find('span#addr_city_name').text(data.address.cityName);
    confirmForm.find('span#addr_district_name').text(data.address.districtName);
    confirmForm.find('span#addr_addr').text(data.address.address);
    if (data.address.address == null || data.address.address == undefined || data.address.address == '')
    {
        var alertHtml = '';
        alertHtml += '<span class="label label-danger" > ' + '地址详情待补全' + '</span>';
        confirmForm.find('span#addr_alert').html(alertHtml);
    }
    //填充订单价格
    confirmForm.find('p#original_price').text(data.priceInfo.originalPrice);
    confirmForm.find('p#tax').text(data.priceInfo.tax);
    confirmForm.find('p#real_tax').text(data.priceInfo.realTax);
    confirmForm.find('span#promotion_price').text(data.priceInfo.promotion);
    confirmForm.find('p#shipping').text(parseFloat(data.priceInfo.shipping).toFixed(2));
    confirmForm.find('p#final_price').text(data.priceInfo.actualPrice);

    //获取订单级促销条目
    var promotionDetail = data.priceInfo.promotionDetail;
    var promotionHtml = '';
    for (var i in promotionDetail) {
        promotionHtml += '<span class="label label-danger" > ' + promotionDetail[i].name + '</span>';
    }
    confirmForm.find('span#promotion_items').html(promotionHtml);
    //- 获取订单级促销条目

    confirmForm.find('tbody').empty();
    var items = data.items;

    //填充商品价格
    for (var i = 0; i < items.length; i++) {

        var ele = '<tr class="item">' +
                '<td><input name="id[]" class="id text" readonly="readonly" value=""></td>' +
                '<td><textarea name="name[]" class="name text" readonly="readonly"></textarea></td>' +
                '<td class="narrow"><input name="price[]" class="price text" readonly="readonly" value=""></td>' +
                '<td class="narrow"><input name="tax[]" class="tax text" readonly="readonly" value=""></td>' +
                '<td><input name="num[]" class="num text" readonly="readonly" value=""></input></td>' +
                '</tr>';

        ele = $(ele);
        ele.find('.id').val(items[i].id);
        ele.find('.name').text(items[i].name);
        ele.find('.price').val(items[i].price);
        ele.find('.tax').val(items[i].tax);
        ele.find('.num').val(items[i].num);

        //获取商品级促销条目
        if (data.itemDiscount[items[i].id] != undefined) {
            var promotionDetail = data.itemDiscount[items[i].id];
            var promotionHtml = '';
            for (var j in promotionDetail) {
                promotionHtml += '<span class="label label-danger" > ' + promotionDetail[j].name + '</span>';
            }
            ele.find('.id').after(promotionHtml);
        }
        //-获取商品级促销条目


        confirmForm.find('tbody').prepend(ele);

    }


}



function checkBuyableAlert(increasePrice, increaseTax) {

    var tot_price = parseInt($('#totalPrice').text());
    var tot_tax = parseInt($('#totalTax').text());

    if (tot_price + increasePrice > 800) {
        if ($('div.orderlist table tbody tr.item').length == 1 && $($('div.orderlist table tbody tr.item')[0]).find('input.num').val() == 1) {

        } else {
            alert("警告：商品总价可能超过800元");
        }
    }

    if (tot_tax + increaseTax > 50) {
        alert("提醒：商品总税费可能超过50元");
    }

}


function getValue(attr) {
    return attr == undefined ? '' : attr;
}

