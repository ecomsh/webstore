<?php

namespace mobile\controllers;

use yii\web\Controller;
/**
 * Site controller
 */
class SandboxController extends Controller 
{
    public function actions()
    {
        return [
            'page' => [
                'class' => 'mobile\action\MyViewAction',
                'layout' => 'article',
                'viewPrefix' => '/article/pages',
            ],
            'Histories' => [
                'class' => 'mobile\action\MyViewAction',
                'isHistories' => true,
            ],
        ];            
    }
}



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

