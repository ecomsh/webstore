var isIe = (document.all) ? true : false;
function setSelectState(state)
{
    var objl = document.getElementsByTagName('select');
    for (var i = 0; i < objl.length; i++)
    {
        objl[i].style.visibility = state;
    }
}

function btnHover() {
    var bg1 = document.getElementById('paybtn');
    var bg2 = document.getElementById('payspan');
    var msOver = function() {
        bg1.style.backgroundPosition = '0px -50px';
        bg2.style.backgroundPosition = 'right -134px';

    }
    var msOut = function() {
        bg1.style.backgroundPosition = '0px -81px';
        bg2.style.backgroundPosition = 'right -165px';
    }
    bg1.onmouseover = msOver;
    bg2.onmouseover = msOver;
    bg1.onmouseout = msOut;
    bg2.onmouseout = msOut;
}

function closeGo() {
    window.location.href = closeGoUrl;
}

//关闭窗口
function closeWindow()
{
    if (document.getElementById('back') != null)
    {
        document.getElementById('back').parentNode.removeChild(document.getElementById('back'));
    }
    if (document.getElementById('mesWindow') != null)
    {
        document.getElementById('mesWindow').parentNode.removeChild(document.getElementById('mesWindow'));
    }
    if (isIe) {
        setSelectState('');
    }
    refres_h();
}
function refres_h() {
    window.location.href = window.location.href;
    //window.location.reload;
}
function testMessageBox(ev)
{
    $("#payModal").modal();
}
$(function () {
    $('#select_'+orderId).change(function() {
        var value = $(this).val();
        $('#payMethod_'+orderId).val(value);
    });
})