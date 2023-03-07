<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\select2;
use app\models\TblCategorias;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;


/** @var yii\web\View $this */
/** @var app\models\TblProductos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline" style="padding:15px;">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <form role="form">
                <div class="box-body">
    
                    <?= $form->field($model, 'id_categoria')->widget(select2::classname(), [
                        'data' => ArrayHelper::map(TblCategorias::find()->all(), 'id_categoria', 'nombre'),
                        'language' => 'en',
                        'options' => ['placeholder' => 'seleccione una categoria...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ]); ?>

                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'precio')->textInput() ?>

                    <?= $form->field($model, 'imagen')->widget(
                        FileInput::class,
                        ['options' => ['accept' => 'image/*'],]
                    ); ?>

                    
                    <?= $form->field($model, 'fecha_ing')->textInput() ?>

                    <?= $form->field($model, 'fecha_mod')->textInput() ?>

                    <?php
                        echo $form->field($model, 'estado')->widget(SwitchInput::class, [
                            'pluginOptions' => [
                                'handleWidth' => 80,
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => '<i class="fa fa-check"></i> Activo',
                                'offText' => '<i class="fa fa-ban"></i> Inactivo'
                            ]
                        ]);
                    ?>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Save' : '<i class="fa fa-save"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <?php echo Html::a('<i class="fa fa-undo"></i> Regresar', ['index'], ['class' => 'btn btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Regresar']) ?>
                </div>
            </form>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
