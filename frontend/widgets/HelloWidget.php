<?php
namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class HelloWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
    }

    public function run()
    {
        $html = "<div id=".$this->getId().">您好我是一段代码</div>";
        return $html.Html::encode($this->message);
    }
}