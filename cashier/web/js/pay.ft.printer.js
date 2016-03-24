$(document).ready(function () {
    
    $('button#printReceipt').attr('disabled', 'disabled');
    $('div#input-div-block').css('display', 'none');
    intervalId = setInterval(autoPrint, 4000);

    function autoPrint() {
        var orderId = $.cookie('orderId');
        $.ajax({
            url: paymentUrl,
            type: 'get',
            data: {'orderId': orderId},
            dataType: 'json',
            success: function (data) {

                if (data.isPaied == true) {
                    $('button#printReceipt').removeAttr('disabled');
                    clearInterval(intervalId);
                    if(!ispaied){ //如果上来就是已支付状态，不需要自动打印小票
                        window.location.href = printorderUrl + '?orderId=' + orderId;
                    }
                }
            }
        });

    }

    $('button#printReceipt').click(function () {
        //check is paid
//    var receiptData = JSON.parse(localStorage.getItem('receiptData'));
        var orderId = $.cookie('orderId');
        $.ajax({
            url: paymentUrl,
            type: 'get',
            data: {'orderId': orderId},
            dataType: 'json',
            beforeSend: function () {
                $('button#printReceipt').attr('disabled', 'disabled');
                $('button#printReceipt').val('查询中');
            },
            complete: function () {
                $('button#printReceipt').val('补打小票');
                $('button#printReceipt').removeAttr('disabled');
            },
            success: function (data) {

                if (data.isPaied == true) {
                    clearInterval(intervalId);
                    window.location.href = printorderUrl + '?orderId=' + orderId;
                } else {
                    alert("客户未付款");
                }

            },
            error: function () {
                alert('暂时无法连接到服务器');
            }

        });

    });



});
