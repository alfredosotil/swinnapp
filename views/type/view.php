<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Type */
?>
<div class="type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'category',
            [
                'label' => 'Active',
                'type' => 'html',
                'format' => 'raw',
                'value' => ($model->active == 1)?'<span class="label label-success">Yes</span>':'<span class="label label-danger">No</span>',
            ],
        ],
    ]) ?>

</div>
