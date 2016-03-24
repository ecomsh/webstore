<?php

namespace  mobile\controllers;

use Yii;
use yii\helpers\Url;
use mobile\models\RealnameApi;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use mobile\models\MobileUser;
use yii\filters\AccessControl;
use mobile\models\mobile\models;
use mobile\models\OrderApi;

/**
 * Site controller
 */
class RealnameController extends Controller
{

    //创建一条记录
    const CREATE = 'create';
    //获取所有列表
    const INDEX = 'index';
    public $layout= "mainnew";
    
    public function behaviors()
    {
        return [
            'access' => Yii::$app->params['pageAccess']['realname']
        ];
    }

    /**
     * 昨晚邮件里给了你一批新的测试id 

      3:25:59 AM: 6471120861615882072
      2888760349360512009
      1071972004169623239
      6296070117947500081
      4692625984968512990
      6828204151415112094
      9158401335075261813
      6482436603782325490
      8582210074373543566
     * @param type $id
     * @return type
     * @throws BadRequestHttpException
     * 
     */
    public function actionIndex()
    {
  //现阶段用户模块并没有完成，但是将来用下面的方法获取用户id
        //Yii::$app->mobileUser->getId() = 'e468a389-19c1-11e5-bba0-00ffaa3562cc';
        $userId = Yii::$app->mobileUser->getId();
        $getData = Yii::$app->request->get();
        //初始化api

        $model = new RealnameApi($userId);
        //预定义当前场景状态  
        $model->scenario = self::INDEX;
        //判断当前model中的记录是否是全新记录，一般情况下，url中有id就代表旧的数据 
        $postData = Yii::$app->request->post();

        if ($postData)
        {
            $model->scenario = self::CREATE;
        }

//TODO::防止重复提交       
//        if(isset($postData['_csrf'])&&Yii::$app->getRequest()->validateCsrfToken($postData['_csrf'])){
//             var_dump($postData['_csrf'],Yii::$app->getRequest()->getCsrfToken());exit;
//             //异常情况处理，记录错误日志，抛出异常
//            Yii::error('操作过于频繁，请稍后...');
//            throw new BadRequestHttpException('操作过于频繁，请稍后...');
//        }
        /**
         * 注意此处为ajax验证，需要在html中的$form->field($model, 'identityNumber',['enableAjaxValidation'=>true])...
         * 多用于验证规则复杂或者需要调用后端接口的时候
         */
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load($postData) && $model->validate())
        {

            if ($model->scenario == self::CREATE)
            {
                $info = $model->createRealname($postData['RealnameApi']);
            }
            if ($info && is_array($info))
            {
                Yii::$app->session->setFlash('realname_success', '操作成功');
            } else
            {
                //用户操作错误处理，将错误放置于错误flash中，同时记录log日志
                Yii::$app->session->setFlash('realname_error', '系统异常，请稍后重试');
                Yii::error($model->scenario . '系统异常，请稍后重试');
            }
            Yii::info('post');
            if (isset($postData['returnUrl']) && !empty($postData['returnUrl']))
            {
                return $this->redirect($postData['returnUrl']);
            } else
            {
                return $this->refresh();
            }
        } else
        {
            $d = $model->setErrors('raw');
            Yii::$app->session->setFlash('realname_error', $d['errorMsg']);
            $data = $model->getById();
            if ($data)
            {
                $model->load($data, 'realname');
            }
            return $this->render('index', [
                        'model' => $model,
            ]);
        }
    }


        /**
     * 实名认证
     * 
     * @return \yii\web\Response|string
     */
    public function actionCertify() {

    
// 1. CBT订单，支付成功后，如果用户尚未完成实名认证，会发短信给用户，短信中附带用户可完成实名认证的移动页面链接，用户可点击此链接进入到页面完成实名认证。短信模板以罗慧慧最后整理的短信模板为准。
// 2. 短信中的页面链接应该用短域名服务（方军华确认：使用百度的短域名服务）
// 3. 用户点击此页面要做到尽量安全的情况下免登录。为了做到这一点：
// 1） 实名认证基础URL是http://m.soupian.me/realname.html?userId=<user_id> （注：m.soupian.me是测试网址，正式上线网址待定，可配置）。另外还会加一个参数time=<current_timestamp>，还有一个token参数，这个token参数的值是基于http://m.soupian.me/realname.html?userId=<user_id>&time=<current_timestamp>&appKey=<app_key>的MD5加密后的值。这里app_key是在EC后台配置的一个不暴露的key。
// 4. 用户进入实名认证页面的实际URL是http://m.soupian.me/realname.html?userId=<user_id>&time=<current_timestamp>&token=<md5_sign>
// 5. Store端要提供一个专门用于这种场景的实名认证页面，在进入这个页面前，首先要看时间是否过期（默认1小时有效），如果已过期，则redirect至登录页面；
        // 如果未过期，对URL做签名验证，如果验证不通过，redirect至登录页面；如果验证通过，判断这个用户是否已经做过实名认证，如果已经做过，直接提示客户已经做过了
        // （注：不显示已有的实名认证信息）；还没做过，才进入这个页面，初始页面里的内容肯定是空的。（注：这里的原则是怎么着也没暴露用户已有的信息）  

        $request = Yii::$app->request;
        $session = Yii::$app->session;
        
        if ($session['login'] !== true) {
                $url = $request->url;
                $hostInfo = $request->hostInfo;
                $request->get();

                $userId =   $request->get('userId');
                $token = $request->get('token');
                $time = $request->get('time'); // format 'yyyyMMddHHmmss'
                $orderId = $request->get('orderId');
                
                $session['orderId'] = $orderId ;
                $session['userId'] = $userId;
                
                $appkey = Yii::$app->params['sm']['realname']['appkey']; //hard code, the same with backend appkey.
                $pos = strrpos($url, '&orderId');
                $unSignedUrl = substr($url, 0, $pos);
                
                $unSignedUrl = $hostInfo . $unSignedUrl . '&appKey=' . $appkey;
                
               	$md5url = md5($unSignedUrl);
	        if (time() - strtotime($time) >36000*12 || $md5url !==    strtolower($token)) {//超过一小时过期或者token错误，需要用户重新登录
	             return $this->redirect( ['/passport/login4webpos'] );
 	        }
         
        }else{
        	 $userId = Yii::$app->mobileUser->getId();
        	 $session['userId'] = $userId;
                 $orderId = $request->get('orderId');
                 $session['orderId'] = $orderId ;
        }
        
        $model = new RealnameApi($userId);
        
        //预定义当前场景状态
        $model->scenario = self::INDEX;

        $usrInfo = $model->getById();
        
        //如果已经实名认证，直接返回到
        if (isset($usrInfo['realname']['realName']) && isset($usrInfo['realname']['identityNumber'])) {
                $setwhencert = $session->get('whencertify');
        	if (empty($setwhencert)) {//如果第一次进入，设置值
        		$session->set('whencertify', 'before');
        	}
        	
            return $this->redirect( ['address/completeaddress',
                    'userId' =>   $session['userId'],
                    'orderId' =>  $session['orderId']
            ]);
        }

        // 判断当前model中的记录是否是全新记录，一般情况下，url中有id就代表旧的数据
        $postData = $request->post ();
        $model->load ( $postData);
        if ($postData) {
            $model->scenario = self::CREATE;
        }

        if ($request->isAjax && $request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate ( $model );
        }else if($request->isPost && $model->validate ()) {
        	$info = $model->createRealname($postData['RealnameApi']);
        	//实名认证成功后，
        	if (!empty($info['realname']['realName']) && !empty($info['realname']['identityNumber'])) {
        		//如果第一次进入，设置值
                    $setwhencert = $session->get('whencertify');
        		if (empty($setwhencert)) {//如果第一次进入，设置值
        			$session->set('whencertify', 'thistime');
        		}
        		return $this->redirect( ['address/completeaddress',
        				'userId' =>   $session['userId'],
        				'orderId' =>  $session['orderId']
        		]);
        	}
        	
        } else{//Get 
            return $this->render ( 'index', [ 'model' => $model ] );
        }
    }

    
    /**
     * 处理错误异常信息
     * @param type $model
     */
    private function _setErrors($model)
    {
        $e = $model->getErrors();
        $msg = '';
        if ($e & is_array($e))
        {
            foreach ($e as $k => $v)
            {
                if (is_array($v))
                {
                    foreach ($v as $sv)
                    {
                        $msg .= $model->getAttributeLabel($k) . "" . $sv . '</br>';
                    }
                } else
                {
                    $msg .= $model->getAttributeLabel($k) . "" . $v . '</br>';
                }
            }
            Yii::$app->session->setFlash('error', $msg);
        }
    }
}
