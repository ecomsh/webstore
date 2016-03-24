<?php

/**
 * 中文验证，并不完善，没有后端验证
 */

namespace mobile\validators;

use yii\validators\Validator;

class RealnameValidator extends Validator
{

    //  public $realnamePattern = '/^*$/';
    //  public $realnamePattern = '/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/';
    public $realnameJsPattern = '/^[\u4e00-\u9fa5]{2,4}/';
    public $message = "请填写您的真实中文姓名";

    public function validateAttribute($model, $attribute)
    {
//        $value = $model->$attribute;
//
//        if (!preg_match($this->realnamePattern, $value))
//        {
//            $this->addError($model, $attribute, $this->message);
//        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {


        $message = json_encode($this->message);

        return <<<JS

    	var re = $this->realnameJsPattern;
    	if(re.test(value)==false){
    		 messages.push($message);
    	}

JS;
    }

}

?>
