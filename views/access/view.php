<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Access */
?>
<div class="access-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'profile_id',
            'module_id',
        ],
    ]) ?>

</div>
