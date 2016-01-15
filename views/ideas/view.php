<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ideas */
?>
<div class="ideas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ideadescription',
            'ideaorder',
            'ideaparent',
            'ideacreate',
            'ideastart',
            'ideaend',
            'iconfa',
            'active',
        ],
    ]) ?>

</div>
