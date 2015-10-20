<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
?>
<div class="users-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'names',
            'surnames',
            'email:email',
            'username',
            'password',
            [
                'label' => 'Active',
                'type' => 'html',
                'format' => 'raw',
                'value' => ($model->active == 1)?'<span class="label label-success">Yes</span>':'<span class="label label-danger">No</span>',
            ],
            'lastupdate',
            'type_id',
            'state_id',
            'sex',
            'profile_id',
            'authKey',
            'accessToken',
        ],
    ])
    ?>

</div>
