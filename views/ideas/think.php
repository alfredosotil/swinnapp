<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\field\FieldRange;
use kartik\widgets\ActiveForm;

$this->title = 'Think Idea Area';
$this->params['breadcrumbs'][] = ['label' => 'Ideas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

$form = ActiveForm::begin([
            'id' => 'login-form-inline',
            'type' => ActiveForm::TYPE_INLINE,
//            'formConfig' => ['showErrors' => true]
                ]
);
echo FieldRange::widget([
    'form' => $form,
    'model' => $searchModel,
    'label' => 'Enter time range',
    'attribute1' => 'ideastart',
    'attribute2' => 'ideaend',
    'type' => FieldRange::INPUT_DATETIME,
]);
ActiveForm::end();
?>


