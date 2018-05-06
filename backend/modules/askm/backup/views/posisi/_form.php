<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Posisi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posisi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_posisi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted')->textInput()->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'deleted_at')->textInput()->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'created_at')->textInput()->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'updated_at')->textInput()->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true])->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
