<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\LaporanPemakaianKendaraanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubux-laporan-pemakaian-kendaraan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'laporan_pemakaian_kendaraan_id') ?>

    <?= $form->field($model, 'tujuan') ?>

    <?= $form->field($model, 'desc') ?>

    <?= $form->field($model, 'jumlah_penumpang') ?>

    <?= $form->field($model, 'keperluan') ?>

    <?php // echo $form->field($model, 'waktu_keberangkatan') ?>

    <?php // echo $form->field($model, 'waktu_tiba') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'kendaraan_id') ?>

    <?php // echo $form->field($model, 'supir_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
