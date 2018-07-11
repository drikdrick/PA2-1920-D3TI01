<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratLomba */
/* @var $form yii\widgets\ActiveForm */
$datetime = new DateTime();
?>

<div class="surat-lomba-form">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Pemohon',
                'value' => $model->pemohon->nama,
            ],
            'nama_lomba',
            'alamat_tujuan',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin([
      'layout' => 'horizontal',
      'fieldConfig' => [
          'template' => "{label}\n{beginWrapper}\n{input}\n{error}\n{endWrapper}\n{hint}",
          'horizontalCssClasses' => [
              'label' => 'col-sm-3',
              'wrapper' => 'col-sm-6',
              'error' => '',
              'hint' => '',
          ],
      ],
    ]) ?>  

    <?= $form->field($model, 'waktu_pengambilan')->widget(DateTimePicker::className(), [
        'language' => 'en',
        'size' => 'ms',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'inline' => false,
        'clientOptions' => [
            'pickerPosition' => 'bottom-left',
            'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:00', 
            'startDate' => date($datetime->format("Y-m-d")),
        ]
    ]);?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-3">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Confirm', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
