<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarPaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-pengantar-proyek-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'surat_pengantar_proyek_id') ?>

    <?= $form->field($model, 'nomor_surat') ?>

    <?= $form->field($model, 'perihal_surat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
