<script>
    /*
     $('catalog_main').addEvents({
     mouseenter:function(){
     this.addClass('active');
     },mouseleave:function(){
     this.removeClass('active');
     }
     });
     */

    $$('.tool_arrow_t').addEvents({mouseover: function() {
            $$('.tool_arrow_t .tool_arrow_dis').setStyle('display', 'block');
        }, mouseout: function() {
            $$('.tool_arrow_t .tool_arrow_dis').setStyle('display', 'none');
        }
    });
    </script>