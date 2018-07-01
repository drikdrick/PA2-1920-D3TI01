<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-magang-form">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_perusahaan',
            'alamat_perusahaan',
            'waktu_awal_magang',
            'waktu_akhir_magang',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'waktu_pengambilan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Tanggal Pengambilan Surat'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd h:i',
            ]
        ])
        ->label(false);
    ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Confirm', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
