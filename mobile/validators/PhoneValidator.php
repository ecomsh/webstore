<?php

namespace mobile\validators;

use yii\validators\Validator;

class PhoneValidator extends Validator
{

    public $phonePattern = '/^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$/';
    public $message = "座机格式错误（xxx-xxxxxxxx）";

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        if (!empty($value)&&!preg_match($this->phonePattern, $value))
        {
            $this->addError($model, $attribute, $this->message);
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {


        $message = json_encode($this->message);

        return <<<JS

    	var re = $this->phonePattern;
    	if(value!==''&&re.test(value)==false){
    		 messages.push($message);
    	}

JS;
    }

}

?>
