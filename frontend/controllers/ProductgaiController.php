<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ProductApigai;
use frontend\models\InventoryApi;
use frontend\models\AddressApi;
use frontend\models\RecommendApi;
use frontend\helpers\Sku;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\helpers\Tools;
use common\models\User;

/**
 * Site controller
 */
class ProductgaiController extends Controller {

    public $layout = "main";

    public function behaviors() {
        /**
         * 开启页面缓存功能
         */
        return [
                //  [
//                'class' => 'yii\filters\PageCache',
//                
//                //'only' => ['view'],
//                'duration' => 3600,
//                'variations' => [
//                    Yii::$app->language,
//                ],
                //'dependency' => [
                //'class' => 'yii\caching\DbDependency',
                //'sql' => 'SELECT COUNT(*) FROM post',
                //],
                //    ],
        ];
    }

    public function actionView($id = '') {        
        $id = Yii::$app->request->get('id');
        $stateCode = Null;
        //$userId = Yii::$app->user->getId();
        $userId =111111;
        $model = new ProductApigai($userId);
        $data = $model->getProductById($id);
        if ($userId != "") {
            $modelAddress = new AddressApi($userId);
            $defaultAddress = $modelAddress->getDefaultAddress($userId);
            if ($defaultAddress) {
                $stateCode = isset($defaultAddress['address']['stateCode']) ? $defaultAddress['address']['stateCode'] : Null;
            }
        }

        $_csrf = Yii::$app->request->getCsrfToken();
        return $this->render('/product/viewgai', [
            '_csrf' => $_csrf,  
            'product' => $data['product'],                       
            'stateCode' => $stateCode,
        ]);
    }

    public function actionGetproductprice($params = "" , $isJson = false) {
        if ($isJson == true) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        $userId = Yii::$app->user->getId();
        $model = new ProductApigai($userId);
        if($params == "")
        {
            $params = Yii::$app->request->post();
            $data = ArrayHelper::remove($params, '_csrf');
        }
        $params["priceList"] = [
            "0" => "list",
            "1" => "offer",
            "2" => "promotion",
        ];
        $data = $model->getProductPrices($params);
        var_dump($data);
        die();
        $key = key($data);
        $data = isset($data[$key]) ? $data[$key] : [];
        $price = array();
        $price2 = array();
        if (isset($data['offer']) && is_array($data['offer'])) {
            foreach ($data['offer'] as $key => $value) {
                $arr = explode(":", $key);
                if (isset($arr[1]) && $arr[1] != "") {
                    $price[$arr[1]]['offer'] = $value;
                    foreach ($price[$arr[1]]['offer'] as $a => $b) {
                        $price2[$arr[1]]['offer'][$b['currency']] = $b['value'];
                    }
                } else if (isset($arr[0]) && $arr[0] != "") {
                    $price[$arr[0]]['offer'] = $value;
                    foreach ($price[$arr[0]]['offer'] as $a => $b) {
                        $price2[$arr[0]]['offer'][$b['currency']] = $b['value'];
                    }
                } else {
                    return false;
                }
            }
        }

        if (isset($data['list']) && is_array($data['list'])) {
            foreach ($data['list'] as $key => $value) {
                $arr = explode(":", $key);
                if (isset($arr[1]) && $arr[1] != "") {
                    $price[$arr[1]]['list'] = $value;
                    foreach ($price[$arr[1]]['list'] as $a => $b) {
                        $price2[$arr[1]]['list'][$b['currency']] = $b['value'];
                    }
                } else if (isset($arr[0]) && $arr[0] != "") {
                    $price[$arr[0]]['list'] = $value;
                    foreach ($price[$arr[0]]['list'] as $a => $b) {
                        $price2[$arr[0]]['list'][$b['currency']] = $b['value'];
                    }
                } else {
                    return false;
                }
            }
        }

        if (isset($data['promotion']) && is_array($data['promotion'])) {
            foreach ($data['promotion'] as $key => $value) {
                $arr = explode(":", $key);
                if (isset($arr[1]) && $arr[1] != "") {
                    $price[$arr[1]]['promotion'] = $value;
                    foreach ($price[$arr[1]]['promotion'] as $a => $b) {
                        $price2[$arr[1]]['promotion'][$b['currency']] = $b['value'];
                    }
                } else if (isset($arr[0]) && $arr[0] != "") {
                    $price[$arr[0]]['promotion'] = $value;
                    foreach ($price[$arr[0]]['promotion'] as $a => $b) {
                        $price2[$arr[0]]['promotion'][$b['currency']] = $b['value'];
                    }
                } else {
                    return false;
                }
            }
        }

        return $price2;
    }

    public function actionGetinventory($postData = "", $isJson = false) {
        if($isJson == true) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }
        $userId = Yii::$app->user->getId();       #todo 此处为指甲获取库存，可以不用添加\
        if($postData == "")
        {
            $postData = Yii::$app->request->post();
            if (!$postData || !is_array($postData)) {
                throw new BadRequestHttpException("非法请求");
            }
        }

        $InventoryModel = new InventoryApi();
        if (is_array($postData['itempartNumber'])) {
            foreach ($postData['itempartNumber'] as $val) {
                $itempartNumber[] = $val['itempartNumber'];
                $itemOrg[] = $val['itemOrg'];
            }
            $params = [
                'itempartNumber' => $itempartNumber,
                'itemOrg' => $itemOrg,
                'shop' => $postData['itempartNumber'][0]['shop'],
                'country' => $postData['itempartNumber'][0]['country'],
                'stateCode' => $postData['itempartNumber'][0]['stateCode']
            ];
            $inventory = $InventoryModel->getInventorys($params);
            foreach ($inventory['inventory'] as $val) {
                if (isset($val['quantityOnhand'])) {
                    $quantityOnhand[$val['itempartNumber']] = $val['quantityOnhand'];
                }
            }
        } else {
            $data = ArrayHelper::remove($postData, '_csrf');
            $data = $InventoryModel->getInventory($postData);
            $key = key($data);
            $data = isset($data[$key]) ? $data[$key] : [];
            $quantityOnhand = $data["quantityOnhand"];
        }

        return $quantityOnhand;
    }

    public function actionGetproductbyid($id = 551, $isJson = false) {
        if ($isJson == true) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }        
        //$id = Yii::$app->request->get('id');
        $model = new ProductApigai();
        $data = $model->getProductById($id);
        $assets = ArrayHelper::getColumn($data, 'assets'); //缩略图,但我觉得不太对,待确定
        $key = key($assets);
        $assets = isset($assets[$key]) ? $assets[$key] : [];
        $key = key($data);
        $data = isset($data[$key]) ? $data[$key] : [];
        $goodspic = Array();
        foreach ($assets as $k => $v) {
            if ($v['usage'] == "原图") {
                if ($v['path'] != $data['desc']['fullImage']) {
                    $goodspic[$k] = $v; //好像yii没有类似的arrayhelper函数，手动写了，小图的处理方式待定
                    $goodspic[$k]['thumbnail'] = Tools::qnImg($v['path'], 56, 56); //thumbnail这个值已然没用，都用fullImage这个值转大小
                    $goodspic[$k]['bigImage'] = Tools::qnImg($v['path'], 354, 354);
                    $goodspic[$k]['fullImage'] = Tools::qnImg($v['path'], 800, 800);
                }
            }
        }
        $data['goodspic'] = $goodspic;
        $data['desc']['thumbnail'] = Tools::qnImg($data['desc']['fullImage'], 56, 56); //thumbnail这个值已然没用，都用fullImage这个值转大小
        $data['desc']['bigImage'] = Tools::qnImg($data['desc']['fullImage'], 354, 354);
        $data['desc']['fullImage'] = Tools::qnImg($data['desc']['fullImage'], 800, 800);
        return $data;
    }

    public function actionChecknobuy() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params = Yii::$app->request->post();
        $data = ArrayHelper::remove($params, '_csrf');
        $userId = Yii::$app->mobileUser->getId(); //获取用户默认地址    
        $buylimitsClass = new Buylimits();
        $result = $buylimitsClass->isBuyItem($userId,$params['itempartNumber']);
        return $result;
    }

    public function actionGetprealtime() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userId = Yii::$app->user->getId();
        $params = Yii::$app->request->post();
        $data = ArrayHelper::remove($params, '_csrf');
        if(isset($params) && is_array($params)) {
            $model = new ProductApigai($userId);
            $data = $model-> getPrealtime($params);        
            return $data['product'];
        }
        else {
            $msg = YII_DEBUG ? '----|input param is' . json_encode($params) . '|----' : '';
            return Tools::error('99008', 'actionGetprealtime input param error' . $msg);
        }
    }
}
