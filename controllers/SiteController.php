<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function createMenu() {
        $menu = "";
        if (isset(Yii::app()->session['userapp'])) {
            $profile = PROFILE::model()->findByPk(Yii::app()->session['userapp']->profile_id);
            $menu .= "<h2><span class='label label-primary'>$profile->name</span></h2>";
            $menu .= "<a href='" . CController::createUrl("site/index") . "'><i class='fa fa-fw fa-home'></i><span>Home</span></a>";
            $access = ACCESS::model()->findAllByAttributes(array(
                "profile_id" => Yii::app()->session['userapp']->profile_id,
            ));
            foreach ($access as $value) {
                $controller = CONTROLLERAPP::model()->findByAttributes(array(
                    "id" => $value->controllerapp_id,
                ));
                $path = "$controller->name/index";
                $href = CController::createUrl($path);
                $link = "<a href='$href'><i class='fa fa-fw $controller->iconfa'></i><span>$controller->label</span></a>";
                $menu .= $link;
            }
        }
//        $menu = "<a href='#'><i class='fa fa-fw fa-star-o'></i><span>Favorites</span></a>
//                        <a href='#'><i class='fa fa-fw fa-bell-o'></i><span>Alerts</span></a>
//                        <a href='#'><i class='fa fa-fw fa-envelope-o'></i><span>Messages</span></a>
//                        <a href='#'><i class='fa fa-fw fa-comment-o'></i><span>Comments</span></a>
//                        <a href='#'><i class='fa fa-fw fa-bar-chart-o'></i><span>Analytics</span></a>
//                        <a href='#'><i class='fa fa-fw fa-newspaper-o'></i><span>Reading List</span></a>";
        if (Yii::app()->user->isGuest === true) {
            $menu .= "<a href='" . CController::createUrl('site/login') . "'><i class='fa fa-fw fa-sign-in'></i><span>Login</span></a>";
        } else {
            $menu .= "<a href='" . CController::createUrl('site/logout') . "'><i class='fa fa-fw fa-sign-out'></i><span>Logout (" . Yii::app()->user->name . ")</span></a>";
        }

        return $menu;
    }

}
