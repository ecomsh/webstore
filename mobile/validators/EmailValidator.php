<?php

namespace mobile\validators;

use yii\validators\Validator;

class EmailValidator extends Validator
{

    public $emailPattern = '/^[a-zA-Z0-9_\\-]{1,}@[a-zA-Z0-9_\\-]{1,}\\.[a-zA-Z0-9_\\-.]{1,}$/';
    public $message = "Email格式错误";

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        if (!preg_match($this->emailPattern, $value))
        {
            $this->addError($model, $attribute, $this->message);
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {


        $message = json_encode($this->message);

        return <<<JS

    	var re = $this->emailPattern;
    	if(re.test(value)==false){
    		 messages.push($message);
    	}

JS;
    }

}

?>
