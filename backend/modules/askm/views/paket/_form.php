<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use common\behaviors\TimestampBehavior; 

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Paket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'penerima')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengirim')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'tanggal_kedatangan')->textInput() ?>-->

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


    <?php // $form->field($model, 'diambil_oleh')->textInput(['maxlength' => true]) ?>

    <!--
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
            -->
        <?php echo $form->field($model, 'posisi')->dropDownList(
			['POS' => 'POS', 'Bagian Umum' => 'Bagian Umum']
			); ?>

    <?php // $form->field($model, 'posisi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

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
