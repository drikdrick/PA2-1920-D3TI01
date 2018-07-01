<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\modules\ubux\models\Pegawai;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\Supir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supir-form">

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
    ]); ?>

    <?= $form->field($model, 'pegawai_id')->dropDownList(
        ArrayHelper::map(Pegawai::find()->select([
            'pegawai_id', 'nama',
        ])->where('deleted != 1')->andWhere(['in', 'status_aktif_pegawai_id', [1,2]])->orderBy(['nama' => SORT_ASC])->all(), 'pegawai_id', 'nama'),
        ['prompt' => 'Pilih Pegawai']
    ) ?>
<!--
    <?= $form->field($model, 'no_telepon_supir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
-->
    <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
            <?= Html::submitButton($model->isNewRecord ? 'Buat' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
