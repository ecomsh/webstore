<?php

namespace mobile\validators;

use yii\validators\Validator;

class PostcodeValidator extends Validator
{

    public $postcodePattern = '/^[0-8][0-9]{5}$/'; //http://www.youbianku.com/， postcode starting from 9 is an international code, as CBT doesn't support international address, so 9 is not allowed as the starting number.
    public $message = "请输入正确的邮编（6位数字）";

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        if (!preg_match($this->postcodePattern, $value))
        {
            $this->addError($model, $attribute, $this->message);
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {


        $message = json_encode($this->message);

        return <<<JS

    	var re = $this->postcodePattern;
    	if(re.test(value)==false){
    		 messages.push($message);
    	}

JS;
    }

}

?>
