<?php
namespace frontend\models;


use common\models\ChangePasswordBaseForm;

/**
 * Password reset form
 */
class ChangePasswordForm extends ChangePasswordBaseForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return parent::rules();
    }
    public function attributeLabels()
    {
        return parent::attributeLabels();
    }
    
}
