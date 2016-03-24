<?php

namespace cashier\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class LoginForm extends Model {

//    public $store;
    public $username;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'password'], 'required'],
	    [['username'], 'trim'],
//             ['username', 'checkAvailable'],
//            ['store', 'checkStoreExist'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
//            'store' => '门店',
            'username' => '用户名',
            'password' => '密码',
        ];
    }

    /**
     * 只有在这里的属性，才会在对应的场景中可以用
     * @return type
     */
    public function scenarios() {
        return [
            'index' => ['username', 'password'],
//             'ajaxUsername' => ['username'],
        ];
    }

//     public function checkUser($attribute) {
//         $userId = Yii::$app->mobileUser->getId();
//         $IdApi = new IdentityApi($userId);
//         $params = [
//             'identity' => $this->username,
//             'type' => 'mobile'
//         ];

//         $result = $IdApi->checkIdentity($params);

//         if ($result['identity']['result'] === true) {
//             $this->addError($attribute, '手机号已经被绑定');
//         }
//     }
    
//    public function checkStoreExist($attribute){
//        $storeInfo = Yii::$app->params['accounts'];
//        $key = $this->store;
//        if (! array_key_exists($key, $storeInfo)){
//             $this->addError($attribute, '店铺名不存在，请检查输入');
//        }
//    }

}
