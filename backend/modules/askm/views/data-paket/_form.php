<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DataPaket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-paket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_paket_id')->textInput()->hiddenInput()->label(false) ?>


    <!-- <?= $form->field($model, 'tanggal_kedatangan')->textInput() ?> -->

    <?= $form->field($model, 'tanggal_kedatangan')->widget(DateTimePicker::className(), [
        'language' => 'en',
        'size' => 'ms',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'pickerPosition' => 'bottom-left',
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00', // if inline = false
            'todayBtn' => true
        ]
    ]);?>
    

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'penerima')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengirim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diambil_oleh')->textInput(['maxlength' => true]) ?>

     <!-- <?= $form->field($model, 'tanggal_diambil')->textInput() ?> -->
     <?= $form->field($model, 'tanggal_diambil')->widget(DateTimePicker::className(), [
        'language' => 'en',
        'size' => 'ms',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'pickerPosition' => 'bottom-left',
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00', // if inline = false
            'todayBtn' => true
        ]
    ]);?>

    <?= $form->field($model, 'pegawai_id')->textInput()->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
