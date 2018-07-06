<?php

use yii\helpers\Html;

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;
use backend\modules\baak\models\Dim;
use common\widgets\Typeahead;

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

    <div class="row">      
      <label class="control-label col-sm-3">NIM atau Nama Mahasiswa</label>
      <div class="col-sm-8"><?= Typeahead::widget([
           'model' => $dim,
            'attribute' => 'dim_id',
           'template' => "<p style='padding:5px'>{{data}}</p>",
           'htmlOptions' => ['class' => 'form-control', 'required' => true, 'style' => 'width: 300px'],
           'options' => [
                'hint' => false,
                'highlight' => true,
                'minLength' => 1
           ], 
           'sourceApiBaseUrl' => Url::toRoute(['/baak/surat-magang/add-mahasiswa']),
           'sourceName' => 'mhslulus1',
        ]) ?>
      </div>
    </div> 

    <div class="form-group">
      <br>
      <div class="col-md-1 col-md-offset-3">
        <?= Html::submitButton($dim->isNewRecord ? 'Add Student' : 'Update', ['class' => $dim->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
