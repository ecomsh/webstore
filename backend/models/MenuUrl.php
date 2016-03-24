<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%menu_url}}".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string $url
 * @property integer $is_default
 * @property integer $stime
 * @property integer $etime
 */
class MenuUrl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_url}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'is_default', 'stime', 'etime'], 'required'],
            [['menu_id', 'is_default'], 'integer'],
            [['url'], 'string', 'max' => 250],
            [['cms_view'], 'string', 'max' => 250],
            ['etime', 'compare', 'compareAttribute' => 'stime', 'operator' => '>=','message'=> '结束时间不能小于开始时间'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Menu ID',
            'url' => 'Url',
            'is_default' => 'Is Default',
            'cms_view' => 'cms_view',
            'stime' => 'Stime',
            'etime' => 'Etime',
        ];
    }
    
    public function getMenuUrlList($menu_id = ''){
        $time = time();
        $query = $this->find();
        
        $query->andWhere(['<=', 'stime', $time]);
        $query->andWhere(['>=', 'etime', $time]);
        $query->orWhere(['is_default'=>'1']);
        
        $query->andFilterWhere(['menu_id' => $menu_id]);
        $row = $query->all();
        
        return $row;
    }
}
