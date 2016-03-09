<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use app\models\Ideas;
use app\models\IdeasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\filters\AccessControl;

/**
 * Description of CustomersiteController
 *
 * @author asotilp
 */
class CustomersiteController extends Controller{
    //put your code here
    /**
     * @inheritdoc
     */
    
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ["index", "", ""],
                'rules' => [
                    [
                        'actions' => ["index", "", ""],
//                        'allow' => AppAsset::getAccess("customersite"),
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }
    
    public function actionIndex(){  
        $this->layout = "customersite";
        return $this->render('index', [
//                    'searchModel' => $searchModel,
        ]);
    }
}
