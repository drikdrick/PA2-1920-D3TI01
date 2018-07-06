<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\DataSurat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-surat-form">

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

    <?= $form->field($model, 'nama_institut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->widget(Redactor::className(), ['options' => [
           'minHeight' => 100,
        ],]) 
    ?>

    <?= $form->field($model, 'nomor_telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_web')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
