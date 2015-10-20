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
            'active',
        ],
    ]) ?>

</div>
