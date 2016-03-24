<?php

namespace mobile\modules\act2016\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use \mobile\modules\act2016\models\ProductApi;

class SiteController extends Controller
{

    public $layout = '/mainnew';   //加/的时候代表app根目录下面的 也就是themems/xxx/layouts/mainnew.php   

    //public $layout = 'mainnew'; //不加/代表的是   

    public function actionIndex()
    {
        $mobile = Yii::$app->mobileUser->getMobile();
        $qr = Url::to(['/user/qrcode', 'mobile' => $mobile, 'size' => 8]);  //时刻注意多一/ 表示相对路径
        return $this->render('index', ['mobile' => $mobile, 'qr' => $qr]);
    }
    
    public function actionTest(){
        echo 2;exit;
    }
    
    public function actionAjaxProduct(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new ProductApi();
        $data = $model->getProductById('551');
        //只要data是数组，就可以返回成json
        return $data;
    }

}
