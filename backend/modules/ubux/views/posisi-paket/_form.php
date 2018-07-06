<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PosisiPaket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posisi-paket-form">

    <?php
        $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]) 
        ?>
        <?= $form->field($model, 'name')->textInput() ?>

        <div class="form-group">
            <div class="col-md-1 col-md-offset-2">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
