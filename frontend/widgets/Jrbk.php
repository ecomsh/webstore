<?php

namespace frontend\widgets;

class Jrbk extends WidgetNew
{
    public function init()
    {
        parent::init();
        //$this->view->registerCssFile('@web/themes/ftzmallold/css/mend_15_4_15.css');
    }

    public function run()
    {
        $this->templateFile = '@app/views/site/jrbk.php';
        return $this->renderItems();
    }
}