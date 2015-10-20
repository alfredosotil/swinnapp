<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Access;
use app\models\Module;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->registerJs(
        "$('.deletemodule').click(function(){
    alert('hola');
    var key = $(this).parent().parent().data('key');
    alert(key);
            $.ajax({
            type:'POST',
                    cache:false,
                    data: {'module_id':$('#module').val(), 'profile_id':$model->id},
                    url:'" . Url::toRoute("profile/addmodule") . "',
                    beforeSend: function () {

                    },
                    success:function(data) {
                    alert(data.message);
//                        $('.profile-form-accesses').html(data.gridmodules);
                            $.pjax.reload({container:'#pjax-modules'});
                    },
                    complete: function () {

                    },
                    error: function (xhr) {
                    alert(xhr);
                    }
            }); return false;
    }
    });"
);
?>
<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>



    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<?php if (!$model->isNewRecord): ?>
    <div class="profile-add-access">
        <div class="form-group">
            <?= Html::dropDownList("module", null, ArrayHelper::map(Module::find()->all(), 'id', 'label'), ["prompt" => "Select a module", "id" => "module", "class" => "form-control col-xs-4"]); ?>
        </div>
        <div class="form-group">
            <?=
            Html::a('Add Module', null, [
                'class' => 'form-control btn btn-success',
                'title' => Yii::t('yii', 'click to add'),
                'onclick' => "
                if($('#module').val() === ''){
                    alert('Please select a module to be added.');
                }else{
                    $.ajax({
                    type:'POST',
                    cache:false,
                    data: {'module_id':$('#module').val(),'profile_id':$model->id},
                    url:'" . Url::toRoute("profile/addmodule") . "',
                    beforeSend: function () {
                    
                    },
                    success:function(data) {
                        alert(data.message);
                        $('.profile-form-accesses').html(data.gridmodules);
                        reloadevents();
                    },
                    complete: function () {
                        
                    },
                    error: function (xhr) {
                       alert(xhr);
                    }                    
                    });return false;
                }                
            "]);
            ?>
        </div>
    </div>

    <div class="profile-form-accesses">
        <?=
        GridView::widget([
            'dataProvider' => $dataprovidermodule,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                ['attribute' => 'module', 'value' => 'module.label'],
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{deletemodule}',
                    'buttons' => ['deletemodule' => function ($url) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', null, [
                                        'data-confirm' => 'Are you sure you want to delete this item?',
                                        'class' => "deletemoduleajax",
                            ]);
                        }]]],
                    'options' => [ 'class' => '', 'id' => 'grid-accesses']]);
                ?>
            </div>
        <?php endif; ?>

        <script>
            function reloadevents() {
                $(".deletemoduleajax").off().on("click", function () {
                    var key = $(this).parent().parent().data('key');
                    $.ajax({
                        data: {'module_id': key},
                        url: "<?= Url::toRoute("profile/deletemodule") ?>",
                        type: 'POST',
                        cache: false,
                        success: function (data) {
                            alert(data.message);
                            $('.profile-form-accesses').html(data.gridmodules);
                            reloadevents();
                        },
                        error: function (xhr) {
                            alert(xhr.readyState);
                            alert(xhr.status);
                            alert(xhr.responseText);
                        }
                    });
                });
            }
            $(".deletemoduleajax").off().on("click", function () {
                var key = $(this).parent().parent().data('key');
                $.ajax({
                    data: {'module_id': key},
                    url: "<?= Url::toRoute("profile/deletemodule") ?>",
            type: 'POST',
            cache: false,
            success: function (data) {
                alert(data.message);
                $('.profile-form-accesses').html(data.gridmodules);
                reloadevents();
            },
            error: function (xhr) {
                alert(xhr.readyState);
                alert(xhr.status);
                alert(xhr.responseText);
            }
        });
    });

</script>

