<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarTa */
/* @var $form yii\widgets\ActiveForm */

$datetime = new DateTime();
?>

<div class="surat-pengantar-ta-form">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Pemohon',
                'value' => $model->pemohon->nama,
            ],
            'alamat_tujuan',
            'kuliah.nama_kul_ind',
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
            'format' => 'yyyy-mm-dd hh:ii', 
            'startDate' => date($datetime->format("Y-m-d")),
        ]
    ]);?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-3">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
