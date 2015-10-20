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
            'active',
        ],
    ]) ?>

</div>
