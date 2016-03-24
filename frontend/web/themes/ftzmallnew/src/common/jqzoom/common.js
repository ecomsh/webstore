$(function() {
    //商品详情页放大镜
    var options = {
        zoomWidth: 450, //放大镜的宽度
        zoomHeight: 540, //放大镜的高度
        zoomType: 'reverse',
        title: false,
        xOffset: 0,
        yOffset: -1
    };
    try {
        $(".jqzoom").jqzoom(options);
        //点击缩略图
        $('.thumb img').click(function() {
            $(this).parent().addClass('on').siblings().removeClass('on');
            var src = $(this).attr('src');
            $('.jqzoom').attr('href', src);
            $('.jqzoom img').attr('src', src);
        });
    } catch (e) {

    }
})