<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\Dim;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-magang-form">

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

    <?= $form->field($model, 'nama_perusahaan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_perusahaan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textarea(['rows' => 3]) ?>    

    <?= $form->field($model, 'waktu_awal_magang',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->widget(DatePicker::className(),
        [
           'options' => ['class' => 'form-control','placeholder' => 'Waktu Awal Magang'],
           'dateFormat' => 'yyyy-MM-dd',
           'clientOptions'=>[
               'minDate' => '+2d',
               'changeMonth'=>'true',
               'changeYear'=>'true',
               'yearRange'=>"-10:+10",
               'format' => 'yyyy-mm-dd',
           ]
        ]);
    ?>

    <?= $form->field($model, 'waktu_akhir_magang',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->widget(DatePicker::className(),
        [
           'options' => ['class' => 'form-control','placeholder' => 'Waktu Akhir Magang'],

           'dateFormat' => 'yyyy-MM-dd',
           'clientOptions'=>[
               'minDate' => '+2d',
               'changeMonth'=>'true',
               'changeYear'=>'true',
               'yearRange'=>"-10:+10",
               'format' => 'yyyy-mm-dd',
           ]
        ]);
    ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
          <?= Html::submitButton($model->isNewRecord ? 'Request' : 'Request', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
