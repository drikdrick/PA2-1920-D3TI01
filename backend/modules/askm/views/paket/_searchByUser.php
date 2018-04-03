<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\base\BaseObject;
/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\search\PaketSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paket-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index-by-user'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'data_paket_id') ?>

    <?= $form->field($model, 'penerima') ?>
    <?= $form->field($model,'tanggal_kedatangan')->widget(\yii\jui\DatePicker::className(),[
        'options' => ['class' => 'form-control',],
        'dateFormat'=>'yyyy-MM-dd'
    ]) ?>
    <?php // $form->field($model, 'pengirim') ?>

    <?php // $form->field($model, 'tanggal_kedatangan') ?>

    <?php // $form->field($model, 'diambil_oleh') ?>

    <?php // echo $form->field($model, 'tanggal_diambil') ?>

    <?php // echo $form->field($model, 'pegawai_id') ?>

    <?php // echo $form->field($model, 'posisi') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset',['/askm/paket/index-by-user'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
