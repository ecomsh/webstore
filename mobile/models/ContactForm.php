<?php

namespace mobile\models;

use Yii;
use common\models\ContactBaseForm;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends ContactBaseForm
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return parent::rules();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return parent::attributeLabels();
    }

}
