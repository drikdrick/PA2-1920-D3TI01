<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratLomba */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-lomba-form">

    <?php $form = ActiveForm::begin([
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
    ]) ?>

    <?= $form->field($model, 'nama_lomba',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_tujuan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textarea(['rows' => 3]) ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
