<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraanMhs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubux-transaksi-kendaraan-mahasiswa-baru-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>
<!--
    <?= $form->field($model, 'dim_id')->textInput() ?>
-->
    <?= $form->field($model, 'desc')->textarea() ?>

    <?= $form->field($model, 'tujuan')->textarea() ?>

    <?= $form->field($model, 'jumlah_penumpang_kendaraan')->textInput() ?>

    <?= $form->field($model, 'rencana_waktu_keberangkatan')->widget(DateTimePicker::className(),[
        'inline' => false,
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'size' => 'ms',
        'clientOptions' => [
            'autoClose' => true,
            'format' => 'yyyy-mm-dd HH:ii:ss',
            'todayBtn' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'rencana_waktu_kembali')->widget(DateTimePicker::className(),[
        'inline' => false,
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'size' => 'ms',
        'clientOptions' => [
            'autoClose' => true,
            'format' => 'yyyy-mm-dd HH:ii:ss',
            'todayBtn' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'file')->fileInput()->hint('File Type : PDF / DOC/ DOCX') ?>

    <?= $form->field($model, 'no_telepon')->textInput(['maxlength' => true]) ?>
<!--
    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kendaraan_id')->textInput() ?>

    <?= $form->field($model, 'supir_id')->textInput() ?>

    <?= $form->field($model, 'no_hp_supir')->textInput(['maxlength' => true]) ?>
-->
    <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
            <?= Html::submitButton($model->isNewRecord ? 'Buat' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
