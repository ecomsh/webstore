<?php
namespace cashier\models;

use Yii;
use yii\base\Model;

class Order extends Model
{


    public $input;

    public function rules()
    {
        return [

            ['input', 'required'],

        ];
    }




}
