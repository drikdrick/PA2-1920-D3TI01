<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DataPaketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-paket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'data_paket_id') ?>

    <?php //echo $form->field($model, 'tanggal_kedatangan') ?>

    <?php //echo $form->field($model, 'desc') ?>

    <?php echo $form->field($model, 'penerima') ?>

    <?php //echo $form->field($model, 'pengirim') ?>

    <?php // echo $form->field($model, 'diambil_oleh') ?>

    <?php // echo $form->field($model, 'tanggal_diambil') ?>

    <?php // echo $form->field($model, 'pegawai_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Hapus', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
