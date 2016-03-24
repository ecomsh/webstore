<?php

namespace mobile\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ActController extends Controller
{
    /*
     * TODO zjp 20150901 配置CMS页面使用httpcache
      public function behaviors()
      {
      return [
      [
      'class' => 'yii\filters\HttpCache',
      'only' => ['page'],
      'lastModified' => function ($action, $params) {
      return 2;
      },
      ],
      ];
      }
     */

    public function actions()
    {
        return [
            'page' => [
                'class' => 'mobile\action\MyViewAction',
                'layout' => 'article',
                'viewPrefix' => '/act',
                'defaultView'=>'index',
            ],
            'pagegroup' => [
                'class' => 'yii\web\ViewAction',
                //'layout' => 'articlegroup',
                'layout' => 'main',
                'viewPrefix' => '/article/pagegroups',
            ],
        ];
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

