<?php

namespace mobile\controllers;

use Yii;
use yii\web\Controller;
/**
 * Site controller
 */
class ArticleController extends Controller 
{
    public function actions()
    {
        return [
            'page' => [
                'class' => 'yii\web\ViewAction',
                'layout' => 'main',
                'viewPrefix' => '/article/pages',      
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

