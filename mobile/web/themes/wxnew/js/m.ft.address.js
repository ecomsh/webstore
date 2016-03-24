   var result =  $('#addressapi-isdefault').attr("checked");
   
   $('#addressapi-isdefault').bind("click", function () {
   
    if (result == 'checked') { 
       
         $(this).attr("checked", result);
    }
    else{
        $(this).attr("checked", !result);
    };
    
    if (!result) {
         $(this).attr("value", 1);
    }else{
         $(this).attr("value", 0);
    }
   
     result = !result;
      
    });
   

//   $('input#realnameapi-mobile').parent().parent().parent().css('display', 'none');