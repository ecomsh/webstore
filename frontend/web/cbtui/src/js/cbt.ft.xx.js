function getajax(p1) {
    $.ajax({
        type: 'get',
        url: 'http://www.baidu.com',
        success: function (res2) {
            alert('success');
        },
        error: function () {
            alert('error!');
        }
    });
}


