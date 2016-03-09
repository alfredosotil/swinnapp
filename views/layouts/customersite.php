<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?= Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
        <!-- Animate Core CSS -->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>        
    </head>
    <body>            
        <div class="app container-menu">            
            <div class="menu-wrap">
                <nav class="menu">
                    <div class="icon-list">
                        <?php
                        echo AppAsset::createMenu();
                        ?>
                    </div>
                </nav>
                <button class="close-button" id="close-button">Close Menu</button>
                <div class="morph-shape" id="morph-shape" data-morph-open="M-1,0h101c0,0,0-1,0,395c0,404,0,405,0,405H-1V0z">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 100 800" preserveAspectRatio="none">
                    <path d="M-1,0h101c0,0-97.833,153.603-97.833,396.167C2.167,627.579,100,800,100,800H-1V0z"/>
                    </svg>
                </div>
            </div>
            <!--<button class="menu-button" id="open-button">Open Menu</button>-->

            <div class="content-wrap">
                <div class="la-anim-1"></div>
                <div class="content-elastic">
                    <div class="container"> 
                        <?php $this->beginBody() ?>
                        <div class="row" style="">
                            <img src="<?= Yii::$app->request->baseUrl; ?>/img/logo.png" class="img-responsive wow pulse pull-left" data-wow-iteration="infinite" data-wow-duration="3000ms" alt="Belleza en tu naturaleza">
                            <!--<div id="#logoMagicMud" class="col-lg-1 wow pulse pull-left" data-wow-iteration="infinite" data-wow-duration="1000ms"></div>-->
                            <div id="title-app" class="page-header pull-left wow fadeIn" data-wow-duration="1000ms" data-wow-delay="" ><h1><span><?= Html::encode(Yii::$app->params['productname']); ?></span></h1></div>
                            <div class="col-lg-2 pull-right">
                                <div class="main-menu">
                                    <div class="menu-wrapper">
                                        <ul class="menu-items">
                                            <?php if (!Yii::$app->user->isGuest): ?>
                                                <li class="menu-item">
                                                    <button id="open-button" class="menu-item-button" title="user menu operations">
                                                        <i class="menu-item-icon fa fa-bars"></i>
                                                    </button>
                                                    <div class="menu-item-bounce"></div>
                                                </li>
                                            <?php endif; ?> 
                                            <li class="menu-item">
                                                <button onclick="location.href = '<?= Url::toRoute("site/index") ?>';" class="menu-item-button" title="home">
                                                    <i class="menu-item-icon fa fa-home"></i>
                                                </button>
                                                <div class="menu-item-bounce"></div>
                                            </li>
                                            <li class="menu-item">
                                                <?php if (Yii::$app->user->isGuest): ?>
                                                    <button onclick="location.href = '<?= Url::toRoute("site/login") ?>';" class="menu-item-button" title="login">
                                                        <i class="menu-item-icon fa fa-sign-in"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button onclick="location.href = '<?= Url::toRoute("site/logout") ?>';" class="menu-item-button" title="logout">
                                                        <i class="menu-item-icon fa fa-sign-out"></i>
                                                    </button>
                                                <?php endif; ?>                                                
                                                <div class="menu-item-bounce"></div>
                                            </li>
                                        </ul>
                                        <button class="menu-toggle-button" title="user menu">
                                            <i class="fa fa-plus menu-toggle-icon"></i>
                                        </button>
                                    </div>

                                </div>
                                <div id="user-logued" class="wow fadeIn" data-wow-duration="1000ms" data-wow-delay="" >
                                    <i class='fa fa-fw fa-user fa-2x'></i><span><?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : "" ?></span>
                                </div>
                            </div>
                            <!--<div class="row">-->

                            <!--</div>-->
                        </div>
                        <div class="row">
                            <?=
                            Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]);
                            ?>
                        </div>
                        <div class="row"><?= $content ?></div>
                        <div class="row">
                            <div id="footer" class="pull-right footer-elastic">
                                <div class="share">
                                    <button class="share-toggle-button">
                                        <i class="share-icon fa fa-share-alt"></i>
                                    </button>
                                    <ul class="share-items">
                                        <li class="share-item">
                                            <a href="#" class="share-button">
                                                <i class="share-icon fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="share-item">
                                            <a href="#" class="share-button">
                                                <i class="share-icon fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="share-item">
                                            <a href="#" class="share-button">
                                                <i class="share-icon fa fa-pinterest"></i>
                                            </a>
                                        </li>
                                        <li class="share-item">
                                            <a href="#" class="share-button">
                                                <i class="share-icon fa fa-tumblr"></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="pull-right">Copyright &copy;  <?= date('Y') . " by " . Html::encode(Yii::$app->params['enterprise']); ?>.<br/>
                                        All Rights Reserved.<br/>
                                    </p>
                                    <div id="swinnsolution" class="pull-right" data-wow-iteration="infinite" data-wow-duration="1000ms">
                                    </div>
                                </div>                                
                            </div>
                        </div>                    
                        <?php $this->endBody() ?>
                    </div>   
                </div>
            </div>
        </div>
    </body>    
</html>
<?php $this->endPage() ?>
