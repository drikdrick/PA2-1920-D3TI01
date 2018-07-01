<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\Dim;
use common\widgets\Typeahead;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarPa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-pengantar-proyek-form">

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

    <?= $form->field($model, 'alamat_tujuan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?= Typeahead::widget([
     'model' => $model,
     'attribute' => 'kuliah_id',
     'withSubmitButton' => true,
     'template' => "<p style='padding:8px'>{{data}} <i>({{thn_masuk}})</i></p>",
     'htmlOptions' => ['class' => 'typeahead', 'placeholder' => 'Mata Kuliah'],
     'options' => [
          'hint' => false,
          'highlight' => true,
          'minLength' => 1
     ], 
     'sourceApiBaseUrl' => Url::toRoute(['/baak/surat-lomba/add-kuliah']),
     'sourceName' => 'mhslulus1',
  ]) ?>

    <div class="form-group">
      <br>
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($model->isNewRecord ? 'Request' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
