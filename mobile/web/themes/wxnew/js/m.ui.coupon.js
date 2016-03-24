function showmore(init)
{
    for(var i=0;i<10;i++) //i为一页显示的优惠券个数
    {
        (function(i){
            $('#show'+i).click(function(e){
            	if($('#show'+i).hasClass('arrow-up'))
            	{
            		$('#show-box'+i).css('display','none');
                	$('#show'+i).removeClass('arrow-up');
                	$('#show'+i).addClass('arrow-down');
            	}
            	else
            	{
	                $('#show-box'+i).css('display','block');
	                $('#show'+i).removeClass('arrow-down');
	                $('#show'+i).addClass('arrow-up');
	            }
        	});           
        })(i);
    }
}

showmore(1);

$('#addcoupon-show').click(function(){
    $(".ui-dialog").addClass("show");
});
$('#addcoupon-hidden').click(function(){
    $(".ui-dialog").removeClass("show");
});