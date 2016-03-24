<?php
namespace mobile\controllers;

use Yii;
use yii\web\Controller;
use common\models\cps\BaseCps;
use yii\helpers\Url;
use common\models\cps\CpsBaseApi;

/**
 * 广告营销landingpage , 以及接口查询
 */
class CpsController extends Controller {

    /**
     * 多麦-入口
     * http://www.ftzmall.com/cps/dm.html?union_id=duomai&euid=10026_235_0_dGVzdA%3D%3D_0&mid=10026&to=http%3a%2f%2fwww.ftzmall.com%2fcps%2fgetdata.html
     */
    public function actionDm() {
        $request = Yii::$app->request;

        if($request->get('union_id') == 'duomai'){
            $data = [
                'unionId' => 'duomai',
                'unionPublisherId' => $request->get('euid'),
                'unionCampaignId' => $request->get('mid'),
                'unionReferer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
                'unionClickTimestamp' => time(),
            ];
            $baseCps = new BaseCps();
            $baseCps->load($data,'');
            if($baseCps->validate()){
                $cpsBaseApi = new CpsBaseApi();

                $params = [
                    'unionId' => $data['unionId'],
                    'refererUrl' => $data['unionReferer'],
                    'hostUrl' => Yii::$app->request->hostInfo,
                    "clientIp" => Yii::$app->request->userIP,
                    ];
                $cpsBaseApi->updateUnionAccessLog($params);



                $baseCps->setDataToCookie();
                $to = $request->get('to',Url::to(['/index']));
                $this->redirect($to);
                return;
            }
        }
        $this->redirect(Url::to(['/index']));
    }

    /**
     * 多麦-按时间查询
     * http://www.ftzmall.com/cps/dm-query-time.html?union_id=duomai&stime=1373414581&etime=1373415181
     */
    public function actionDmQueryTime() {
        $request = Yii::$app->request;
        if($request->get('union_id') == 'duomai'){
            $cpsBaseApi = new CpsBaseApi();
            $params = [
                'startTime' => date('Y-m-d H:i:s', $request->get('stime')),
                'endTime' => date('Y-m-d H:i:s', $request->get('etime')),
            ];

            $data = $cpsBaseApi->getDMOrdersByTime($params);
            $data = $data[key($data)];
            return json_encode($data);
        }        
    }

    /**
     * 多麦-按订单号查询
     * http://www.ftzmall.com.cn/cps/dm-query-id.html?union_id=duomai&sn=2015081915742624
     */
    public function actionDmQueryId() {
        $request = Yii::$app->request;
        if($request->get('union_id') == 'duomai'){
            $cpsBaseApi = new CpsBaseApi();

            $data = $cpsBaseApi->getOrderbyId($request->get('sn'));
            $data = $data[key($data)];
            return json_encode($data);
            
        } 
    }

     /**
     * 成果网-入口
     * http://www.ftzmall.com/cps/chanet.html?id=15875125443&source=chanet&url=http%3a%2f%2fwww.ftzmall.com%2fcps%2fgetdata.html
     */
    public function actionChanet() {
        $request = Yii::$app->request;

        if($request->get('source') == 'chanet'){
            $data = [
                'unionId' => 'chanet',
                'unionPublisherId' => $request->get('id'),
                'unionReferer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
                'unionClickTimestamp' => time(),
            ];
            $baseCps = new BaseCps();
            $baseCps->load($data,'');
            if($baseCps->validate()){
                $cpsBaseApi = new CpsBaseApi();

                $params = [
                    'unionId' => $data['unionId'],
                    'refererUrl' => $data['unionReferer'],
                    'hostUrl' => Yii::$app->request->hostInfo,
                    "clientIp" => Yii::$app->request->userIP,
                    ];
                $cpsBaseApi->updateUnionAccessLog($params);

                $baseCps->setDataToCookie();
                $to = $request->get('url',Url::to(['/index']));
                $this->redirect($to);
                return;
            }
        }
        $this->redirect(Url::to(['/index']));
    }

    /**
     * 成果网-查询
     * http://www.ftzmall.com/cps/chanet-query.html?user=chanet&start=20150101000000&end=20161231235959&page=1&orderid=1&orderstatus=1&unixtime=1449711625&sig=ab6ef107c1fda10929e632463c952124
     */

    public function actionChanetQuery() {
        $queryString = $_SERVER['QUERY_STRING'];
        $sigString = md5(substr($queryString,0,strpos ($queryString, '&sig=')).'&key='.Yii::$app->params['cps']['chanet']['key']);;
        
        $request = Yii::$app->request;
        //var_dump($sigString);
        //var_dump($request->get('sig'));

        if($request->get('user') == 'chanet' && 
                $sigString == $request->get('sig') &&
                abs(time() - $request->get('unixtime') < 600)){
            $cpsBaseApi = new CpsBaseApi();
            $params = [
                'startTime' => date('Y-m-d H:i:s', strtotime($request->get('start'))),
                'endTime' => date('Y-m-d H:i:s', strtotime($request->get('end'))),
                'page' => $request->get('page', 1),
            ];

            $data = $cpsBaseApi->getChanetOrders($params);
            $data = $data[key($data)];
            return json_encode($data);
        }        
    }



    public function actionGetdata() {
        $baseCps = new BaseCps();
        $getData = $baseCps->getDataFromCookie();
        var_dump($getData);
    }

    public function actionXxx()
    {
        
    }

    public function actionOoo()
    {
        
    }

    public function actionDmOrder()
    {
        
    }

    public function actionXxxOrder()
    {
        
    }

}
