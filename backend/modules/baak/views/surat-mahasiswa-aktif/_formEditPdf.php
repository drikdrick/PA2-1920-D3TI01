<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\baak\models\StatusPengajuan;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarTa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-pengantar-ta-form">

    <?php if($model->nomor_surat == null){ ?>
      <?= DetailView::widget([
          'model' => $nomor_surat,
          'formatter' => [
              'class' => 'yii\i18n\Formatter',
              'nullDisplay' => '-',
          ],
          'attributes' => [
            'nomor_surat',
          ],
      ]) ?>
    <?php } ?>

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

    <?php if($model->nomor_surat == null){?>
      <?= $form->field($model, 'nomor_surat',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>
    <?php }  

    else {?>
        <?= $form->field($model, 'nomor_surat',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['readonly' => true, 'maxlength' => true]) ?>
    <?php }?>

    <?= $form->field($model, 'tujuan',['horizontalCssClasses' => ['wrapper' => 'col-sm-8']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
      <div class="col-md-1 col-md-offset-2">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Print', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></div>

    <?php ActiveForm::end(); ?>

</div>
