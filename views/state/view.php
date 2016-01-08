<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\State */
?>
<div class="state-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'state',
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
