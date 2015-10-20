<?php

/* @var $this yii\web\View */
use \yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to <?= Html::encode(Yii::$app->params['enterprise']); ?>!</h1>

        <p class="lead"></p>

    </div>   
</div>
