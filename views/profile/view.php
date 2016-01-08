<?php

use yii\widgets\DetailView;
use app\models\Access;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
?>
<div class="profile-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'category',
            [
                'label' => 'Active',
                'type' => 'html',
                'format' => 'raw',
                'value' => ($model->active == 1)?'<span class="label label-success">Yes</span>':'<span class="label label-danger">No</span>',
            ],
        ],
    ])
    ?>

</div>

<div class="profile-view-accesses">
    <?php
//    $dataProvider = new ActiveDataProvider([
//        'query' => Access::find()->where(["profile_id" => $model->id,])
//                ->orderBy('id DESC'),
//        'pagination' => [
//            'pageSize' => 20,
//        ],
//    ]);
    echo GridView::widget([
        'dataProvider' => $dataprovidermodule,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            ['attribute' => 'module', 'value' => 'module.label'],
        ],
        'options' => ['class' => 'grid-view'],
    ]);
    ?>
</div>
