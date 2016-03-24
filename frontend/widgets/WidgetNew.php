<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;


class WidgetNew extends Widget
{
    public $liArray;
    protected $templateFile;
    public $limit = 0;           //每行item个数
    public $frontClass;      //每行最后一个item之前的item的classname
    public $lastOneClass;    //每行最后一个item的classname
    private $options = Array();


    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->renderItems();
    }

    public function renderItems(){
        $html = '';
        $i = 0;
        foreach($this->liArray as $item){
            $i++;
            if($this->limit != 0 && $i%$this->limit == 0){
                $item['class'] = $this->lastOneClass;
            }else{
                $item['class'] = $this->frontClass;
            }
            $item['date'] = isset($item['date']) ? $item['date'] : '';
            $isShow = $this->validationDate($item['date']);
            if($isShow === TRUE) {
                $html .= $this->renderItem($item);
            }
        }
        return $html;
    }

    public function renderItem($item){
        $template =  $this->renderFile($this->templateFile);
        $this->getOptions($item);
        return strtr($template, $this->options);
    }
    
    /**
     * 将模板中的{参数}替换为实际的值
     * @param type $item
     */
    public function getOptions($item){
        foreach($item as $key => $val){
            if(!is_array($val)){
                $this->options['{'.$key.'}'] = Html::encode($val);
            }
        }
    }

    public function validationDate($dates){
        if(empty($dates) || !is_array($dates)) {
            return true;
        }

        foreach($dates as $val) {
            //if(time() >= $val[0] && time() <= $val[1]) {   //如果传入的参数为时间戳则用此if条件
            if(time() >= strtotime($val[0]) && time() <= strtotime($val[1])) {
                return true;
            }
        }

        return false;
    }
}