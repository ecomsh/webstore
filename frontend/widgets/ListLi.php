<?php

namespace frontend\widgets;

use yii\helpers\Html;


class ListLi extends WidgetNew
{
    public function init()
    {
        parent::init();
//        $this->view->registerCssFile('@web/themes/ftzmallold/css/mend_15_4_15.css');
    }

    public function run()
    {
        $this->templateFile = '@app/views/site/list.php';
        $html = $this->renderItems();
        return Html::tag('ul', $html, ['class'=>'center_section']);
    }
}