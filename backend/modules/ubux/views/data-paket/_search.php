<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\search\DataPaketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-paket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index-by-admin'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dim_nama')->label('Nama Mahasiswa') ?>

    <?= $form->field($model, 'pegawai_nama')->label('Nama Pegawai')?>

    <?php // echo $form->field($model, 'tanggal_kedatangan') ?>

    <?php // echo $form->field($model, 'diambil_oleh') ?>

    <?php // echo $form->field($model, 'tanggal_diambil') ?>

    <?php // echo $form->field($model, 'posisi_paket_id') ?>

    <?php // echo $form->field($model, 'status_paket_id') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
