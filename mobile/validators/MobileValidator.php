<?php

namespace mobile\validators;

use yii\validators\Validator;

class MobileValidator extends Validator
{

	public $phonePattern = '/^(0|86|17951)?(13[0-9]|15[012356789]|17[05678]|18[0-9]|14[57])[0-9]{8}$/';

	public $message = "手机格式错误";

	public function validateAttribute($model, $attribute)
	{
		$value = $model->$attribute;

		if (!preg_match($this->phonePattern, $value)) {
            $this->addError($model, $attribute, $this->message);
        }

	}




    public function clientValidateAttribute($model, $attribute, $view)
    {


    	$message=json_encode($this->message);

    	return <<<JS

    	var re = $this->phonePattern;
    	if(re.test(value)==false){
    		 messages.push($message);
    	}

JS;

    }



}


?>
