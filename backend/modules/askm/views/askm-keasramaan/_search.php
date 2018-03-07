<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmKeasramaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="askm-keasramaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'keasramaan_id') ?>

    <?= $form->field($model, 'aktif_start') ?>

    <?= $form->field($model, 'aktif_end') ?>

    <?= $form->field($model, 'pegawai_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
