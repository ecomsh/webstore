 
<?php
$cookies = Yii::$app->request->cookies;

// get the "language" cookie value. If the cookie does not exist, return "en" as the default value.
//        $language = $cookies->getValue('_rn', 'xxoo');
//        return $language;
        Yii::$app->getSession()->set('__returnUrl', Yii::$app->getRequest()->getUrl());
        
        return $this->render('loginwidget');