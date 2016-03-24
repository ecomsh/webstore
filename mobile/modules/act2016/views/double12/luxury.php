<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>双12轻奢分会场</title>
        <script type="text/javascript" src="http://tajs.qq.com/stats?sId=37342703" charset="UTF-8"></script>
        <link rel="stylesheet" href="http://img.ftzmall.com/wap_themes/default/images/mobile/css/frozen.css">
        <link rel="stylesheet" href="http://img.ftzmall.com/wap_themes/default/images/mobile/demo/demo.css">
        <link rel="stylesheet" href="http://img.ftzmall.com/wap_themes/default/images/mobile/demo/common.css">
        <script src="http://img.ftzmall.com/wap_themes/default/images/mobile/lib/zepto.min.js"></script>
        <script src="http://img.ftzmall.com/wap_themes/default/images/mobile/js/frozen.js"></script>
    </head>
    
    <body ontouchstart="" class="sp-bg qs-bg">
        <section class="ui-container">
            <section id="grid">
                <div class="demo-block">
                    <section class="ui-placehold-img img-p6">
                        <span id="luxury"></span>
                    </section>
                    <section class="ui-placehold-img img-p4">
                        <span class="wave-bk"><img src="http://img.ftzmall.com/wap_themes/default/images/mobile/img/shake/qs-dhtp2.png"></span>
                    </section>
                   <?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 8086201, 'tpl' => '12active2row']) ?>
                    <section class="ui-placehold-img img-p4">
                        <span class="wave-bk"><img src="http://img.ftzmall.com/wap_themes/default/images/mobile/img/shake/qs-dhtp3.png"></span>
                    </section>
                    <?= mobile\widgets\commercial\CommercialWidget::widget(["adClass" => '\common\models\commercial\ProductAdvertisement', "adId" => 8086202, 'tpl' => '12active2row']) ?>
                </div>
            </section>
            <a href="/"><div class="ui-col-100 hg-65 margin-bot4"> <span style="background-image:url(http://img.ftzmall.com/wap_themes/default/images/mobile/img/zhc1-img/zhc-25.jpg)"></span> </div></a>
            <a href="/act2016/double12/makeups.html"><div class="ui-col-100 hg-65 margin-bot4"> <span style="background-image:url(http://img.ftzmall.com/wap_themes/default/images/mobile/img/zhc1-img/zhc-16.png)"></span> </div></a>
     <a href="/act2016/double12/food.html"><div class="ui-col-100 hg-65 margin-bot4"> <span style="background-image:url(http://img.ftzmall.com/wap_themes/default/images/mobile/img/zhc1-img/zhc-18.png)"></span> </div></a>
     <a href="/act2016/double12/baby.html"><div class="ui-col-100 hg-65 margin-bot4"> <span style="background-image:url(http://img.ftzmall.com/wap_themes/default/images/mobile/img/zhc1-img/zhc-20.png)"></span> </div></a>
     <a href="/act2016/double12/health.html"><div class="ui-col-100 hg-65 margin-bot4"> <span style="background-image:url(http://img.ftzmall.com/wap_themes/default/images/mobile/img/zhc1-img/zhc-22.png)"></span> </div></a>

        </section><!-- /.ui-container-->
        <script>
        $('.ui-list li,.ui-tiled li').click(function(){
            if($(this).data('href')){
                location.href= $(this).data('href');
            }
        });
        $('.ui-header .ui-btn').click(function(){
            location.href= 'index.html';
        });
           $(function () {
                $('ul.ui-grid-halve').first().find('.full-cut').hide();
                $('ul.ui-grid-halve').last().find('.full-cut').html('满699减100');
            });
        </script>
 <script src="http://7xoo3k.com2.z0.glb.qiniucdn.com/wap-ad1212-footer.js"></script>   
</body></html>