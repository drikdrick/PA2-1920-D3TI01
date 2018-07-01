<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use backend\modules\ubux\models\Kendaraan;
use backend\modules\ubux\models\Supir;
use yii\bootstrap\ActiveForm;
use backend\modules\ubux\models\PemakaianKendaraan;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\LaporanPemakaianKendaraan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubux-laporan-pemakaian-kendaraan-form">

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

    <?= $form->field($model, 'tujuan')->textarea() ?>

    <?= $form->field($model, 'desc')->textarea() ?>

    <?= $form->field($model, 'jumlah_penumpang')->textInput() ?>

    <?= $form->field($model, 'keperluan')->textarea() ?>

    <?= $form->field($model, 'waktu_keberangkatan')->widget(DateTimePicker::className(),[
        'inline' => false,
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'size' => 'ms',
        'clientOptions' => [
            'autoClose' => true,
            'format' => 'yyyy-mm-dd HH:ii:ss',
            'todayBtn' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'waktu_tiba')->widget(DateTimePicker::className(),[
        'inline' => false,
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'size' => 'ms',
        'clientOptions' => [
            'autoClose' => true,
            'format' => 'yyyy-mm-dd HH:ii:ss',
            'todayBtn' => true,
        ]
    ]); ?>
<!--
    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
-->
    <?= $form->field($model, 'kendaraan_id')->dropDownList(
        ArrayHelper::map(Kendaraan::find()->select([
            'kendaraan_id', 'kendaraan', 'plat_nomor', 'status',
        ])->where(['deleted' => 0])->all(), 'kendaraan_id', 'KeteranganKendaraan'),
        ['prompt' => 'Pilih Kendaraan']
    ) ?>

    <?= $form->field($model, 'supir_id')->dropDownList(
        ArrayHelper::map(Supir::find()->select([
            'ubux_supir.supir_id', 'ubux_supir.pegawai_id',
        ])->where('ubux_supir.deleted!=1')->joinWith([
                'pegawai' => function($query){
                    $query->where('hrdx_pegawai.deleted!=1')->orderBy(['hrdx_pegawai.nama' => SORT_ASC]);
                }
            ])->all(), 'supir_id', 'NamaSupir'),
        ['prompt' => 'Pilih Supir']
    ) ?>

    <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
            <?= Html::submitButton($model->isNewRecord ? 'Buat' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div></div>

    <?php ActiveForm::end(); ?>

</div>
