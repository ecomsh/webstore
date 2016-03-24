<?php

namespace common\validators;

use yii\validators\Validator;

class ItemQtyValidator extends Validator
{

	public $message = "购买数量不符合限制";
    public $msg = "本商品未上架";

	public function validateAttribute($model, $attribute)
	{
        $value = $model->$attribute;
        $min = $model->minBuyCount; //Hard code, get from Cartmodel and Ordermodel
        $max = $model->maxBuyCount; //Hard code, get from Cartmodel and Ordermodel
        $buyable = $model->buyable; //Hard code, get from Cartmodel and Ordermodel

        if ($buyable) {
            if($min || $max){
                if(($value > $max) || ($value < $min)){
                    $this->addError($model, $attribute, $this->message);
                }
            }

        }
        else{
            $this->addError($model, $attribute, $this->msg);
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
