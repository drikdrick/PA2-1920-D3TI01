<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmRStatusRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="askm-rstatus-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_request_id')->textInput() ?>

    <?= $form->field($model, 'status_request')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
