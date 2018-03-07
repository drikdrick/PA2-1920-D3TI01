<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmKeasramaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="askm-keasramaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aktif_start')->textInput() ?>

    <?= $form->field($model, 'aktif_end')->textInput() ?>

    <?= $form->field($model, 'pegawai_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
