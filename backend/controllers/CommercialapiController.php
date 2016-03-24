<?php


namespace backend\controllers;

use Yii;
use yii\web\Controller;

use yii\web\JsonParser;


class CommercialapiController extends Controller{

    public $layout = false;

    public function beforeACtion($action){

        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    //provide validation service for tools
    public function actionValidation(){




        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        if($request->isPost){


            //get parser
            $parser = new JsonParser;
            $data = $parser->parse($request->rawBody,'application/json');
            //TODO map type to real class
            $instance = new $data['classname'];
            unset($data['classname']);
            $instance->load($data['data']);

            $output = [];
            $output['result']=true;
            $output['ad'] = [];
            $output['items'] = [];

            //validate advertisment
            $result = $instance->validate();

            //if has errors
            if(!$result){
                $output['result'] = $result;
                $output['ad']['errors'] = $instance->errors;
            }


            //validate items
            $items = $instance->getItems();
            for($i=0;$i<count($items);$i++){

                $result = $items[$i]->validate();
                if(!$result){
                    $output['result'] = $result;
                    $item = [];
                    $item['index'] = $i;
                    $item['errors'] = $items[$i]->errors;
                    $output['items'][] = $item;
                }
            }

            return $output;
        }
    }




}