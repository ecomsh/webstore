<?php

namespace mobile\controllers;

use Yii;
use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class StaticizeController extends Controller {

    public function actionIndex() {

        $file = Yii::$app->params['staticize'];
        foreach ($file as $k => $f) {
            if(file_exists("../../testpages/" . $f . ".html"))
            {
                unlink("../../testpages/" . $f . ".html");
            }
            $this -> layout = 'main';
            $str = explode('-', $f);
            $controller = 'mobile\\controllers\\'.ucfirst($str[0]) . 'Controller';
            if($str[0]=="product"&&is_numeric($str[1])) //product页面改写
            {
                $str[2] = $str[1];
                $str[1] =  "view";
            }
            $str[1] = isset($str[1])?$str[1]:'index';     
            $action = 'action' . ucfirst($str[1]);   
            $id = isset($str[2])?$str[2]:'';        
            ob_start();
            echo $controller::$action($id);           
            $content = ob_get_contents();         
            $fp = fopen("../../testpages/" . $f . ".html", "wb");
            fwrite($fp, $content);
            fclose($fp);
            ob_get_clean();
            echo $f.".html已缓存</br>";
        }       
    }

    /*private function getFromCurl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        return curl_exec($ch);
    }*/
}
