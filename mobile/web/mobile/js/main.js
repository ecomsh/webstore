//'use strict';
$(document).ready(function () {
    //  初始设置
    //    var $fullText = $('.admin-fullText');
    //    $('#admin-fullscreen').on('click', function () {
    //        $.AMUI.fullscreen.toggle();
    //    });
    //    $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function () {
    //        $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
    //    });
    
    
    //获取验证码的倒计时
//    $(".getValiCode").click(function () {
//        GetNumber();
//    });
//    var count = 5;
//    function GetNumber() {
//        $(".getValiCode").attr("disabled", "disabled");
//        $(".getValiCode").val(count + "秒之后点击获取");
//        count--;
//        if (count > 0) {
//            setTimeout(GetNumber, 1000);
//        } else {
//            $(".getValiCode").val("点击获取验证码");
//            $(".getValiCode").attr("disabled", "");
//        }
//    }

    
//    验证码输完后不离开焦点实时验证
//    $("#mobileregistrationform-smscode").blur(function () {
//      var valicode = $("#mobileregistrationform-smscode").val();
//      $.post("checkvalicode.php", {verify, velicode}, function (data) {
//              if (data == "1") {
//                  alert("验证码正确")；
//              } else {
//                  alert("验证码错误");
//              }
//          }
//      )
//  });
//    
    
//    php端的代码
//   $verify = $_POST["verify"];
//   if ($verify = $_SESSION["verify"]) {
//       echo "1";
//   } else {
//       echo "0";
//   }

    
    


    //商品列表页筛选
//    var priceSeq = 'price desc';
//    var salesSeq = 'buy_w_count desc';
//    var url = 'http://bbctest.ftzmall.com.cn/wap/gallery-ajax_get_goods.html';
//    var page = '1';
//    var cat_id = '91';
//    var filter_dialog;
//
//    function filterGoods(t, e) {
//        var filter = '',
//            sear = '',
//            p = '',
//            search = location.search;
//        if (e && $('.trigger-list .act').hasClass('price-seq')) filter = '&orderBy=' + priceSeq;
//        if (e && $('.trigger-list .act').hasClass('sales-seq')) filter = '&orderBy=' + salesSeq;
//        if (t.hasClass('price-seq')) {
//            filter = '&orderBy=' + priceSeq;
//            if (priceSeq == 'price desc') {
//                priceSeq = 'price asc';
//                t.find('i')[0].className = 'arr down';
//            } else {
//                priceSeq = 'price desc';
//                t.find('i')[0].className = 'arr top';
//            }
//        }
//        if (t.hasClass('sales-seq')) {
//            filter = '&orderBy=' + salesSeq;
//            salesSeq = salesSeq == 'buy_w_count desc' ? 'buy_w_count asc' : 'buy_w_count desc';
//        }
//        if (e && e.num) {
//            p = '&page=' + e.num;
//            page = e.num;
//        }
//        if (search) sear = search.substr(1);
//        $.post(url, 'cat_id=' + cat_id + filter + p + '&showtype=list&' + sear + '&' + $('#J_filter form').serialize(), function (re) {
//            $($('.J-tab .panel')[t.index()]).html(re);
//        });
//    }
//
//    $('.J-tab .trigger').on('click', function () {
//        filterGoods($(this));
//    });
//
//    $('.filter-handle').on('click', function () {
//        filter_dialog = new Dialog('#filter_container', {
//            'type': 'confirm'
//        });
//    });
//
//    $('.panel-list').on('click', function (e) {
//        var t = $(e.target);
//        if (t.hasClass('flip')) {
//            t.num = parseInt(t.attr('page'));
//            if (t.hasClass('next')) t.num = parseInt(page) + 1;
//            if (t.hasClass('prev')) t.num = parseInt(page) - 1;
//            filterGoods($('.trigger-list .act'), t);
//            return false;
//        }
//    }).on('change', 'select', function () {
//        var t = $(this.options[this.selectedIndex]);
//        if (t.hasClass('flip')) {
//            t.num = parseInt(t.attr('page'));
//            filterGoods($('.trigger-list .act'), t);
//        }
//    });

    



    //广告点击事件，点击关闭
    $('.login-close-btn').on('click', function () {
        $(this).parent().remove();
    });

    //输入框清空和呈密码状
    var click_i = 0;
    $('.input-clean').on('click', function () {
        $(this).siblings().val('');
    });
    $('.input-eyes').on('click', function () {
        if (click_i == 0) {
            $(this).siblings().prop('type', 'text');
            click_i = 1;
        } else {
            $(this).siblings().prop('type', 'password');
            click_i = 0;
        };
    });
    //广告点击关闭事件
    $('.login-close-btn').on('click', function () {
        $('.login-bg').hide();
    });

    //会员中心致电客服控制
    $('.js_tel').on('click', function () {
        $('.tel-fixed').animate({
            'bottom': '0px'
        });
    });
    $('.tel-close').on('click', function () {
        $('.tel-fixed').animate({
            'bottom': '-6.6rem'
        });
    })




//    $('.pt-promotions').bind('click', function () {
//        new Dialog('.promotions-panel', {
//            title: '促销活动'
//        })
//    });
//    $('.promotions-panel .trigger').bind('click', function () {
//        if ($(this).hasClass('act')) return;
//        var n = $(this).addClass('act').siblings().removeClass('act').attr('data-target'),
//            par = $(this).parent().siblings().removeClass('act');
//        !!n ? (par.eq(n - 1).addClass('act')) : (par.eq(n + 1).addClass('act'));
//    });




    //tab组件
    $('.J-tab .trigger').bind('click', function (e) {
        if ($(this).attr('data-url') && $(this).attr('data-url') != 'true') {
            $.get($(this).attr('data-url'), function (re) {
                $($('.J-tab .panel')[$(this).index()]).append(re);
            }.bind(this));
            $(this).attr('data-url', 'true');
        }
        $(this).add($('.J-tab .panel')[$(this).index()]).addClass('act').siblings('.act').removeClass('act');
    });





    // 分享
    var main_height = 0;

    function share_size() {
        var li_width = $('.share-wrap-main ul li img').width();
        $('.share-wrap-main ul li').height(li_width * 1.5);
        main_height = $('.share-wrap-main').height();
        $('.share-wrap').height(main_height);
        $('.share-wrap').css('bottom', -main_height);
    };
    share_size();
    $(window).on('resize', function () {
        share_size();
    });
    $('.js_share').on('click', function () {
        $('.share-wrap').animate({
            'bottom': '0px'
        });
    });
    $('.share-close').on('click', function () {
        $('.share-wrap').animate({
            'bottom': -main_height
        });
    });


    // 全局 m-page撑满屏
    function page_full() {
        var window_height = $(window).height(),
            heider_height = $('.m-header').height(),
            footer_height = $('footer').height(),
            page_height = window_height - heider_height - footer_height;
        $('.m-page').css('min-height', page_height);
    };
    page_full();
    // 监听视口
    $(window).on('resize', function () {
        page_full();
    });

    // 顶部导航
    $('.m-nav li').on('click', function () {
        $(this).find('a').addClass('active').parent().siblings().find('a').removeClass('active');
    });






    // 购物车相关js
    var empty_len = $('.cart-empty h3').length;
    if (empty_len == 0) {
        //        $('.m-page').css('background', '#eee');
    };
    $('#J_total').css('height', total_height);
    var total_height = $('.fixed-bar').height();

    $('.J-pre').bind('click', function (e) {
        $(this).toggleClass('act');
        $(this).parents('.pt-h-item').find('.pre-info').toggleClass('hide');
    });

    $('#order_promotion .d-line').bind('click', function () {
        $('#J_pre_info').toggleClass('hide');
        $(this).find('.pre-list').toggleClass('hide');
    });
    
    
   

});
