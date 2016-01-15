<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ideas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ideas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'ideadescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ideaorder')->textInput() ?>

    <?= $form->field($model, 'ideaparent')->textInput() ?>

    <?= $form->field($model, 'ideacreate')->textInput() ?>

    <?= $form->field($model, 'ideastart')->textInput() ?>

    <?= $form->field($model, 'ideaend')->textInput() ?>

    <?= $form->field($model, 'iconfa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
