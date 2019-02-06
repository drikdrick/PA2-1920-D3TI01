<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\search\PermohonanIzinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permohonan-izin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'permohonan_izin_id') ?>

    <?= $form->field($model, 'waktu_pelaksanaan') ?>

    <?= $form->field($model, 'alasan_izin') ?>

    <?= $form->field($model, 'pengalihan_tugas') ?>

    <?= $form->field($model, 'kategori_id') ?>

    <?php // echo $form->field($model, 'lama_izin') ?>

    <?php // echo $form->field($model, 'file_surat') ?>

    <?php // echo $form->field($model, 'status_by_hrd') ?>

    <?php // echo $form->field($model, 'hrd_id') ?>

    <?php // echo $form->field($model, 'status_by_atasan') ?>

    <?php // echo $form->field($model, 'atasan_id') ?>

    <?php // echo $form->field($model, 'status_by_wr2') ?>

    <?php // echo $form->field($model, 'wr2_id') ?>

    <?php // echo $form->field($model, 'pegawai_id') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
