<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Type;
use app\models\State;
use app\models\Profile;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'names')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surnames')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastupdate')->textInput() ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(Type::find()->where(["category" => "user"])->all(), 'id', 'type')) ?>

    <?= $form->field($model, 'state_id')->dropDownList(ArrayHelper::map(State::find()->where(["category" => "user"])->all(), 'id', 'state')) ?>
    
    <?= $form->field($model, 'sex')->radioList(['M' => 'Male', 'F' => 'Female']) ?>

    <?= $form->field($model, 'profile_id')->dropDownList(ArrayHelper::map(Profile::find()->where(["category" => "app"])->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'active')->checkbox() ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
