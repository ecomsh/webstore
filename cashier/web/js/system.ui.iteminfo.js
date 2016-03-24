$(document).ready(function(){
    $("#item").click(function(){
        var len = $('input[name=item]:checked').length;  
        if(len>0){
            $('#item-input').attr("disabled",false);
            $('#submit_btn').attr("disabled",false);
        }
    });
    $('.cancel').click(function(event) {   
            $('.cover').css('display', 'none');
        });
 
});
