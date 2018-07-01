<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;
use backend\modules\baak\models\Dim;
use common\widgets\Typeahead;

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

    <?= Typeahead::widget([
	   'model' => $dim,
	   'attribute' => 'dim_id',
	   'withSubmitButton' => true,
	   'template' => "<p style='padding:4px'>{{data}} <i>({{thn_masuk}})</i></p>",
	   'htmlOptions' => ['class' => 'typeahead', 'placeholder' => 'NIM atau Nama'],
	   'options' => [
	        'hint' => false,
	        'highlight' => true,
	        'minLength' => 1
	   ], 
	   'sourceApiBaseUrl' => Url::toRoute(['/baak/surat-lomba/add-mahasiswa']),
	   'sourceName' => 'mhslulus1',
	]) ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($dim->isNewRecord ? 'Add Student' : 'Update', ['class' => $dim->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
