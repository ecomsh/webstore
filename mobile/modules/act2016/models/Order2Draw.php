<?php

namespace mobile\modules\act2016\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Order2Draw extends ActiveRecord
{

  /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_game_order2draw';
    }
}
