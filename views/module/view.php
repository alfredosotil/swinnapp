<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Module */
?>
<div class="module-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'iconfa',
            'label',
            'description',
            'controller',
            [
                'label' => 'Active',
                'type' => 'html',
                'format' => 'raw',
                'value' => ($model->active == 1)?'<span class="label label-success">Yes</span>':'<span class="label label-danger">No</span>',
            ],
            'type_id',
        ],
    ]) ?>

</div>
