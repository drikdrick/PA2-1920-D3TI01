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
            'nama_lomba',
        ],
    ]) ?>

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

    <?= $form->field($model, 'nomor_surat',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'perihal',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'banyak_lampiran',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_surat',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput() ?>

    <?= $form->field($model, 'status',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->dropdownlist(ArrayHelper::map(StatusPengajuan::find()->all(),'id_status','status')) ?>

    <?= $form->field($model, 'waktu_pengambilan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Tanggal Pengambilan'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ])
            ->label(false);
        ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
