<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;
use yii\captcha\CaptchaAction;

class CaptchaCustomizeAction extends CaptchaAction
{
     public $letters = 'bcdfghjklmnpqrstvwxyz';
     public $vowels = 'aeiou';
     
     /**
     * Generates a new verification code.
     * @return string the generated verification code
     */
    protected function generateVerifyCode()
    {
        if ($this->minLength > $this->maxLength) {
            $this->maxLength = $this->minLength;
        }
        if ($this->minLength < 3) {
            $this->minLength = 3;
        }
        if ($this->maxLength > 20) {
            $this->maxLength = 20;
        }
        $length = mt_rand($this->minLength, $this->maxLength);

        $code = '';
        for ($i = 0; $i < $length; ++$i) {
            if ($i % 2 && mt_rand(0, 10) > 2 || !($i % 2) && mt_rand(0, 10) > 9) {
                $code .= $this->vowels[mt_rand(0, 4)];
            } else {
                $code .= $this->letters[mt_rand(0, 20)];
            }
        }

        return $code;
    }
    
}
