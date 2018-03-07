<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinPenggunaanRuangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="askm-izin-penggunaan-ruangan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rencana_mulai')->textInput() ?>

    <?= $form->field($model, 'rencana_berakhir')->textInput() ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dim_id')->textInput() ?>

    <?= $form->field($model, 'staf_id')->textInput() ?>

    <?= $form->field($model, 'status_request_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
