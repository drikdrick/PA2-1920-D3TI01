<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;
use yii\widgets\DetailView;
use common\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarTa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-pengantar-ta-form">


     <?php
        if($model->nomor_surat == NULL){?>      
    <?= DetailView::widget([
        'model' => $model_nomor_surat,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'attributes' => [
          'nomor_surat',
        ],
    ]) ?>
    <?php
        }
    ?>

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

    <?php
        if($model->nomor_surat == NULL)
        {
    ?>
        <?= $form->field($model, 'nomor_surat',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?php
        }
        else{
        ?>
        <?= $form->field($model, 'nomor_surat',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['readonly'=>true,'maxlength' => true]) ?>        
        <?php      
        }
    ?>
    
    <?= $form->field($model, 'perihal',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'banyak_lampiran',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lomba',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_tujuan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'salam_pembuka',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->widget(Redactor::className(), ['options' => [
           'minHeight' => 100,
        ],]) 
    ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Print', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
