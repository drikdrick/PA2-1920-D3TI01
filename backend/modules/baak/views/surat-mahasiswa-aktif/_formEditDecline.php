<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratLomba */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-lomba-form">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Pemohon',
                'value' => $model->pemohon->nama,
            ],
            'tujuan',
        ],
    ]) ?>

    <?php $form = ActiveForm::begin(); ?>

       <?= $form->field($model, 'alasan_penolakan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textarea(['rows' => 3]) ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Confirm', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
