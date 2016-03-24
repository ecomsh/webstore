/*选择效果，最后看下能不能全局合并*/
$('.radio label').click(function(){
    $('.radio label').removeClass('checked');
    $(this).addClass('checked');
})

$('.checkbox label').click(function(){
    if($(this).children('input').prop('checked')==true)
        $(this).removeClass('checked');
    else
        $(this).addClass('checked');
})
/*选择效果，最后看下能不能全局合并*/

/*选择登录方式*/
function getloginfunction()
{
    $('#mobile-login').click(function(){
        $('#common-login-box').css('display','none');     
        $('#mobile-login-box').css('display','block');     
      
    })
    
    $('#common-login').click(function(){
       $('#mobile-login-box').css('display','none');     
       $('#common-login-box').css('display','block');        
    })
}

/* 倒计时 
 * 使用的时候请修改_buttom的值,为点击标签的id
 * _maxtime 为最大倒计时时间 
 * _endtime 为倒计时时间 
 * 刚开始赋值时请保持一致，现为60秒，由于两个函数均使用，请设置为全局变量
 */
var _endtime = 60;
var _maxtime = 60;
var aaa;
var _buttom = 'btn-vcode'; 

function getVcode(_buttom , _maxtime) //倒计时，使用的时候请修改_buttom的值,为点击标签的id
{
    $('#'+_buttom).click(function()
    {        
        if(_endtime==0||_endtime==_maxtime)
        {       
            console.log('请在这边加入发验证码的js或者手机动态密码的js');
            aaa = setInterval('endtime()',1000);  
        }
    })  
}

function endtime()
{
    if(_endtime==0)
    {       
        $(this).attr('disabled', false);
        $('#'+_buttom).text('发送验证码');   
        _endtime = _maxtime;
        clearInterval(aaa);
    }
    else
    {
        _endtime --;
        $('#'+_buttom).text(_endtime+'秒后重试');   
        $('#'+_buttom).unbind();
    }
}

function moreregister()  //聚美优品的样式比较复杂，问过设计说现在没有那么多的登录方式，我目测更多都未必显示，先写个简单的效果凑合用
{  
    $('#arrow-down').click(function(){  
        if($('.icon-p').css('display')=='none')
        {
            $('.icon-p').css('display','block');
            $('.iconAccout span i').css('background-position','-274px 0px');
        }
        else
        {
            $('.icon-p').css('display','none');
            $('.iconAccout span i').css('background-position','-274px -23px');
        }
    })
}

$(function(){
	$('input, textarea').placeholder({customClass:'my-placeholder'});
});

window.onload = function()
{
    getloginfunction();
    moreregister();
    getVcode(_buttom , _maxtime);
	
}