<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $index
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'index', 'platform'], 'required'],
            [['index'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '栏目名',
            'index' => '排序索引',
        ];
    }
    
    public function getMenuList($platform){
        $query = $this->find();
        $query->where(['platform'=>$platform]);
        $query->orderBy('index');
        $row = $query->all();
        return $row;
    }
}
