<?php

namespace common\validators;

use yii\validators\Validator;

class PasswordBaseValidator extends Validator
{

    public $simplePattern = '/^(\d+)$|^([a-zA-Z]+)$|^([\W+_]+)$/';
    public $message = "密码由8-20位字母、数字和符号至少两种以上字符组成"; 

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        if (preg_match($this->simplePattern, $value))
        {
            $this->addError($model, $attribute, $this->message);
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {


        $message = json_encode($this->message);

        return <<<JS

    	var re = $this->simplePattern;
    	if(re.test(value)==true){
    		 messages.push($message);
    	}

JS;
    }

}

?>
