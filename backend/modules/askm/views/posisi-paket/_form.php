<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\PosisiPaket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posisi-paket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_posisi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
