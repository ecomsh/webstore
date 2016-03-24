function getmore(init)
{
    for(var i=0;i<20;i++)
    {
        (function(i){
            $('#getmore'+i).click(function(e){
            	$('.morefacets'+i).css('display','block');
                $('#getmore'+i).css('display','none');
                $('#hiddenmore'+i).css('display','block');
                console.log($('.morefacets'+i));
            });

            $('#hiddenmore'+i).click(function(e){
                $('.morefacets'+i).css('display','none');
                $('#getmore'+i).css('display','block');
                $('#hiddenmore'+i).css('display','none');
            });
        })(i);
    }
}

getmore(1);

// $('.show-detail').mouseover(function(e){
//     //$('this').children('.show').css('display','block');
//    // console.log($('this').children('.show'));
//    console.log(1);
 
// });

$('.show-detail').hover(
   function(){
        $(this).find(".show-msg").show();
    },
    function(){
        $(this).find(".show-msg").hide();
    }
);   


