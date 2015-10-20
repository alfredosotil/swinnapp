<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\helpers\Url;
use yii\web\AssetBundle;
use app\models\Profile;
use app\models\Access;
use app\models\Module;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
//        'css/menu_sideslide.css',
        'css/menu_elastic.css',
        'css/animate.css',
//        'css/normalize.css',
        'css/menu.css',
        'css/share.css',
        'css/component_loader.css',
        'fonts/font-awesome-4.2.0/css/font-awesome.min.css',
//        'fonts/vicons/vicons-font.css'
    ];
    public $js = [
        'js/snap.svg-min.js',
        'js/wow.min.js',
        'js/classie.js',
        'js/TweenMax.min.js',
        'js/menu.js',
        'js/share.js',
//        'js/main.js',
        'js/main3.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function createMenu() {
        $menu = "";
        if (!Yii::$app->user->isGuest) {
            $profile = Profile::findOne(Yii::$app->user->identity->profile_id);
            $menu .= "<h2><span class='label label-primary'>$profile->name</span></h2>";
//            $menu .= "<a href='" . Url::toRoute("site/index") . "'><i class='fa fa-fw fa-home'></i><span>Home</span></a>";
            $access = Access::find()
                    ->where(["profile_id" => Yii::$app->user->identity->profile_id,])
                    ->all();

            foreach ($access as $value) {
                $module = Module::find()
                        ->where(["id" => $value->module_id,])
                        ->one();
                $path = "$module->controller/index";
                $href = Url::toRoute($path);
                $link = "<a href='$href'><i class='fa fa-fw $module->iconfa'></i><span>$module->label</span></a>";
                $menu .= $link;
            }
        }
//        if (Yii::$app->user->isGuest) {
//            $menu .= "<a href='" . Url::toRoute('site/login') . "'><i class='fa fa-fw fa-sign-in'></i><span>Login</span></a>";
//        } else {
//            $menu .= "<a href='" . Url::toRoute('site/logout') . "' data-method='post'><i class='fa fa-fw fa-sign-out'></i><span>Logout (" . Yii::$app->user->identity->username . ")</span></a>";
//        }

        return $menu;
    }
    
    public function getAccess($controller){
        $allow = false;
        $accesses = Access::findAll(["profile_id" => Yii::$app->user->identity->profile_id]);
        foreach ($accesses as $accesses) {
            $module = Module::findOne(["id" => $accesses->module_id]);
            if($module->controller === $controller){
                $allow = true;
                break;
            }
        }        
        return $allow;
    }

}
