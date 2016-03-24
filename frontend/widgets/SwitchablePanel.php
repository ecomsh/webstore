<?php

namespace frontend\widgets;

use yii\helpers\Html;

class SwitchablePanel extends WidgetNew
{
    public $template;

    public function init()
    {
        parent::init();
        //$this->view->registerCssFile('@web/themes/ftzmallold/css/mend_15_4_15.css');
    }

    public function run()
    {
        if($this->template == 'big'){
            $this->templateFile = '@app/views/site/switchablePanelBig.php';
        }else if($this->template == 'small'){
            $this->templateFile = '@app/views/site/switchablePanelSmall.php';
        }else{
            $this->templateFile = '@app/views/site/switchablePanelBig.php';
        }
        
        $items = $this->renderItems();
        
        foreach($this->liArray as $item){
            $triggerBox[] = Html::tag('li','',['class' => '']);
        }
        $html = '';
        $html .= Html::tag('ol' ,$items , ['class'=>'switchable-content clearfix']);
        $html .= Html::tag('ul',implode("\n", $triggerBox), ['class'=>'switchable-triggerBox slide-trigger']);
        return $html;
    }
}