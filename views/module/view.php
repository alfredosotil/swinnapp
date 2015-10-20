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
            'active',
            'type_id',
        ],
    ]) ?>

</div>
