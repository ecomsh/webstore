<?php

namespace common\validators;

use yii\validators\Validator;

class IdcardValidator extends Validator
{

    public $idPattern = '/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/';
    public $message = "身份证格式错误";

    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        if (!preg_match($this->idPattern, $value)||!$this->isCreditNo($value))
        {
            $this->addError($model, $attribute, $this->message);
        }
    }

    function isCreditNo($vStr)
    {
        $vCity = array(
            '11', '12', '13', '14', '15', '21', '22',
            '23', '31', '32', '33', '34', '35', '36',
            '37', '41', '42', '43', '44', '45', '46',
            '50', '51', '52', '53', '54', '61', '62',
            '63', '64', '65', '71', '81', '82', '91'
        );

        if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr))
            return false;

        if (!in_array(substr($vStr, 0, 2), $vCity))
            return false;

        $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
        $vLength = strlen($vStr);

        if ($vLength == 18)
        {
            $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
        } else
        {
            $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
        }

        if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday)
            return false;
        if ($vLength == 18)
        {
            $vSum = 0;

            for ($i = 17; $i >= 0; $i--)
            {
                $vSubStr = substr($vStr, 17 - $i, 1);
                $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
            }

            if ($vSum % 11 != 1)
                return false;
        }

        return true;
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {


        $message = json_encode($this->message);

        return <<<JS

    	var re = $this->idPattern;
    	if(re.test(value)==false){
    		 messages.push($message);
    	}

JS;
    }

}

?>
