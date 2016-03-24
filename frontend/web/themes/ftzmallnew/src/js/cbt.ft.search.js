function submitform()
{
    $('.paixu').click(function(){
    	var order_by = $(this).attr("avalue");    	    	
    	$("input[name='orderby']").val(order_by);
    	$('#searchform').submit();
    });

    $('#pre-page').click(function(){
    	var pageinfo = Number($("input[name='page']").val())-1;
    	$("input[name='page']").val(pageinfo);
    	$('#searchform').submit();
    });

    $('#next-page').click(function(){
    	var pageinfo = Number($("input[name='page']").val())+1;
    	$("input[name='page']").val(pageinfo);
    	$('#searchform').submit();
    });
}

submitform();