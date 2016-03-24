<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '店铺收藏_上海外高桥进口商品网';
?>
<!--right-->
<div class = "member-main" style = "width: 960px;">
    <div class = "title title2">店铺收藏</div>

    <div id = "tab-favorite" class = "section switch">
        <ul class = "switchable-triggerBox tab_member clearfix">
            <li class = "active"><a href = "<?= Yii::$app->params['baseUrl'] ?>favorite-sfavorite.html#">店铺收藏</a></li>
        </ul>

        <div class = "noinfo">暂无收藏</div>
        <!--<script type = "text/javascript" src = "/app/b2c/statics/js/storescupcake.js?static"></script>-->
        <script>
            var ajax_del_fav = function(el, e) {
                var sid = el.get('sid');
                Ex_Dialog.confirm('确定删除?', function(e) {
                    if (!e)
                        return false;
                    new Request({
                        url: '/favorite-ajax_fav_store.html',
                        method: 'post',
                        data: 't=' + (+new Date()) + '&gid=' + sid + '&act_type=del',
                        onComplete: function(res) {
                            res = JSON.decode(res);
                            if (res.error) {
                                Message.error(res.error);
                            } else {
                                if (!res.data && res.reload != null) {
                                    location.href = res.reload;
                                } else {
                                    $('b2c-member-fav-list').innerHTML = res.data;
                                }
                            }
                        }
                    }).send();
                    $('store_' + sid).setOpacity(.5);
                    var MEMBER = Cookie.read('S[MEMBER]');
                    var FAVCOOKIE = new Cookie('S[SFAV][' + MEMBER + ']', {duration: 365});
                    FAVCOOKIE.write(Array.from((FAVCOOKIE.read('S[SFAV]') || '').split(',')).erase(sid).join(','));
                    return false;
                });
            };

            var removeSel = function() {
                var reqs = $$('input[name^=chk]:checked').length;
                if (reqs == 0) {
                    Ex_Dialog.alert('请选择要删除的选项！');
                } else {
                    Ex_Dialog.confirm('确定要删除所选项吗？', function(e) {
                        if (!e)
                            return;
                        var sids = [];
                        $$('input[name^=chk]:checked').each(function(v, index) {
                            sids[index] = v.value;
                            var MEMBER = Cookie.read('S[MEMBER]');
                            var FAVCOOKIE = new Cookie('S[SFAV][' + MEMBER + ']', {duration: 365});
                            FAVCOOKIE.write(Array.from((FAVCOOKIE.read('S[SFAV]') || '').split(',')).erase(v.value).join(','));
                        });
                        //$('return-form').submit();
                        new Request({
                            url: '/favorite-ajax_fav_store.html',
                            method: 'post',
                            data: 't=' + (+new Date()) + '&gid=' + sids + '&act_type=del',
                            onComplete: function(res) {
                                res = JSON.decode(res);
                                if (res.error) {
                                    Message.error(res.error);
                                } else {
                                    if (!res.data && res.reload != null) {
                                        location.href = res.reload;
                                    } else {
                                        $('b2c-member-fav-list').innerHTML = res.data;
                                    }
                                }
                            }
                        }).send();
                    });
                }
            }

            window.addEvent('domready', function() {
                var obj = $('all') || '';
                if (obj)
                    $('all').addEvent('click', function() {
                        $$('input[name^=chk]').each(function(item) {
                            if ($('all').checked == true) {
                                item.checked = true;
                            } else {
                                item.checked = false;
                            }
                        });
                    })
            });
        </script>

    </div>
</div>
<!-- right-->