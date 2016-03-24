<?php

namespace mobile\controllers;

use Yii;
use mobile\models\BindMobileForm;
use mobile\models\IdentityApi;
use yii\web\Controller;
use common\helpers\Wechatjssdk;
use yii\helpers\Url;


//use common\sdk\jswx\Wechatjssdk;

/**
 * Site controller
 */
class UserController extends Controller
{

   public function behaviors()
    {
            return [
                'access' => Yii::$app->params['pageAccess']['user']
            ];
    }

    public $layout = "mainnew";
    public function actionIndex()
    {
//        $jssdk = new Wechatjssdk("wx77be89a71184009b", "12cf3d2cbd1ba9696bde81a724c95376");
//        $signPackage = $jssdk->GetSignPackage();
//        $this->layout = "user_main";
//        return $this->render('/user/usercenter', ['signPackage' => $signPackage]);

    	$mobile = Yii::$app->mobileUser->getMobile(); //若有绑定的手机号，登录时就可以记录这个手机号
        //若没有绑定手机，绑定手机之后login的session中并没有记录手机号，需要重新checkidentity取手机号。
        if(empty($mobile)){
            $useridentities = Yii::$app->mobileUser->getUserIdentities();
            if(!empty($useridentities)){
            $type = $useridentities[0]['type'];
            $id = $useridentities[0]['identity']; 
            $params = ['type'=>$type, 'identity'=>$id];
            $userId = Yii::$app->mobileUser->getId();
            $IdApi = new IdentityApi($userId);
            $result = $IdApi->checkIdentity($params);
            if($result['identity']['result'] == true){
               $mobile = $result['identity']['mobile'];
            }
            }
        }
        $qr = Url::to(['user/qrcode', 'mobile'=>$mobile,'size' =>8]);
        return $this->render('/user/usercenter', ['mobile' => $mobile, 'qr' => $qr]);
    }

    public function actionFavorite()
    {
//        $this->layout = "user_main";
        return $this->render('/user/favorite');
    }

//    public function actionSfavorite() {
//        $this->layout = "user_main";
//        return $this->render('/user/sfavorite');
//    }
//    public function actionAsk() {
//        $this->layout = "user_main";
//        return $this->render('/user/ask');
//    }

    public function actionHistory()
    {
//        $this->layout = "user_main";
        return $this->render('/user/history');
    }

    public function actionBuy()
    {
//        $this->layout = "user_main";
        return $this->render('/user/buy');
    }

    public function actionCoupon()
    {
//        $this->layout = "user_main";
        return $this->render('/user/coupon');
    }

    public function actionRealname()
    {
//        $this->layout = "user_main";
        return $this->renderPartial('/user/realname');
    }

    public function actionBalance()
    {
//        $this->layout = "user_main";
        return $this->render('/user/balance');
    }

    public function actionDeposit()
    {
//        $this->layout = "user_main";
        return $this->render('/user/deposit');
    }

    public function actionEmails()
    {
//        $this->layout = "user_main";
        return $this->render('/user/emails');
    }

//    public function actionSetting()
//    {
//    	$model = new	BindMobileForm();
//       $this->layout = "main-user";
//       $userId = Yii::$app->mobileUser->getId();
//       $request = Yii::$app->request;
//       $session = Yii::$app->session;
//       
//       $postData = $request->post();
//       
//    	$model->scenario = 'index';
//			//是ajax 进行验证码 验证
//		$model->load($postData);
//		if ($request->getIsAjax() ) {
//				if( isset($postData['BindMobileForm']['smsCode'])){
//					$model->scenario = 'ajaxsmsCode';
//				}else{
//					$model->scenario = 'ajaxMobile';
//				}
//				Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//				return \yii\widgets\ActiveForm::validate ( $model );
//			
//		}
//            
//       if ($request->isPost && isset($userId)) {
//       		$postData['BindMobileForm']['stub'] = $session['stubCode'];
//       		$api = new IdentityApi($userId);
//       		
//       		$params['identityType'] = 'mobile';
//       		$params['identityCode'] = $postData['BindMobileForm']['mobile'] ;
//       		$params['userId'] = $userId;
//       		$api->bindUser($params);
//       }
//       
//    	if ($userId)
//        {
//            //TBD 不支持用userId checkidentity，这一段代码一定有问题！！！
//        	$api = new IdentityApi($userId);
//        	$params = [
//        			'identity'=> $userId,
//        			'type' => 'userId'
//        	];
//        	
//        	$result = $api->checkIdentity($params); 
//        	
//        	$mobile = $this->getIdentifyByType($result['identity']['identities'], 'mobile');
//        	if(isset($mobile)){
//        		$model->mobile = $mobile;
//        	}
//        	return $this->render('/user/setting', ['model' => $model]);
//           
//        }else{
//        	return $this->goHome();
//        }
//    }
    
    private function getIdentifyByType($userIdentities, $type){
    
    	//     	echo var_dump($this->userIdentities);
    	$count_json = count($userIdentities);
    	for ($i = 0; $i < $count_json; $i++){
    		if ($userIdentities[$i]['type'] == $type) {
    			return $userIdentities[$i]['identity'];
    		}
    	}
    	return null;
    }
    

    public function actionSecurity()
    {
//        $this->layout = "user_main";
        return $this->render('/user/security');
    }

    public function actionReceiver()
    {
//        $this->layout = "user_main";
        return $this->render('/user/receiver');
    }

    public function actionAddress()
    {
//       $this->layout = "user_main";
        return $this->renderPartial('/address/addresscharge');
    }

    public function actionPoint()
    {
//        $this->layout = "user_main";
        return $this->render('/user/point');
    }

//    public function actionViewhistory() {
//        $this->layout = "user_main";
//        return $this->render('/user/viewhistory');
//    }

    public function actionComplain()
    {
//        $this->layout = "user_main";
        return $this->render('/user/complain');
    }

//    public function actionReports() {
//        $this->layout = "user_main";
//        return $this->render('/user/reports');
//    }

    public function actionOrdermsg()
    {
//        $this->layout = "user_main";
        return $this->render('/user/ordermsg');
    }

    public function actionRefund()
    {
//        $this->layout = "user_main";
        return $this->render('/user/refund');
    }

    public function actionDofinish()
    {
//        $this->layout = "user_main";
        return $this->render('/user/dofinish');
    }
    
        public function actionQrcode($mobile = '', $size = 3, $margin = 2)
    {
        return \dosamigos\qrcode\QrCode::png($mobile, false, 1, $size, $margin);
    }
    
}
