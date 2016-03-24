<?php

namespace frontend\controllers;

use Yii;

use yii\web\Controller;

use Qiniu\Auth;
use Qiniu\Processing\Operation;
use Qiniu\Storage\UploadManager;

/**
 * Site controller
 */
class ImageUploadController extends Controller {



    public function actionUptoken()
    {

        $request = Yii::$app->request;

        if($request->isGet){

            //$accessKey = 'rTbRiE3VMffT9KEvuAeUza6BnfUeKJ9O0Wrq0zZf';
            $accessKey = Yii::$app->params['sm']['qiniu']['accessKey'];
            //$secretKey = 'HoURiHtAcXtbRf7RRTW1x2_ESi0w93TVQPPszK6B';
            $secretKey = Yii::$app->params['sm']['qiniu']['secretKey'];
            //$bucket = 'testspace';
            $bucket = Yii::$app->params['sm']['qiniu']['bucket'];

            $auth = new Auth($accessKey, $secretKey);
            $token = $auth->uploadToken($bucket);

            $arr= array('uptoken'=>$token);

            return json_encode($arr);

        }


    }


    public function actionPreview(){

        $request = Yii::$app->request;


        $key = $request->post('key');

        //$domain= '7xjjel.com1.z0.glb.clouddn.com';
        $domain = Yii::$app->params['sm']['qiniu']['domain'];

        $op = new Operation($domain);

        $ops = 'imageView2/5/w/70/h/70';

        $url = $op->buildUrl($key, $ops);

        $arr= array('url'=>$url);

        return json_encode($arr);


    }



    public function actionTransfer(){


        $request = Yii::$app->request;

        if($request->isPost){

            //qiniu config
/*            $accessKey = Yii::$app->params['sm']['qiniu']['accessKey'];
            $secretKey = Yii::$app->params['sm']['qiniu']['secretKey'];
            $bucket = Yii::$app->params['sm']['qiniu']['bucket'];

            $auth = new Auth($accessKey, $secretKey);
            $token = $auth->uploadToken($bucket);
            $uploadMgr = new UploadManager();


            //get html data
            $html = $request->post('html');
            $media = [];

            //extract aliyun link
            preg_match_all("/[src|lazyload]=[\"|'](http://[^?]*)/i", $html, $media);*/





        }

    }





    public function actionDelete(){



    }
}