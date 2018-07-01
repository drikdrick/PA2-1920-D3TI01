<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use common\helpers\ArrayHelper;
use backend\modules\ubux\models\Kendaraan;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraan */
/* @var $form yii\widgets\ActiveForm */
if(!$model->isNewRecord){
    $this->title = 'Ubah Permohonan Pemakaian';
    $this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian untuk Keperluan Dinas', 'url' => ['index-by-pegawai']];
    $this->params['breadcrumbs'][] = ['label' => $model->pemakaian_kendaraan_id, 'url' => ['view-by-pegawai', 'id' => $model->pemakaian_kendaraan_id]];
    $this->params['breadcrumbs'][] = $this->title;
}else{
    $this->title = 'Buat Permohonan Pemakaian';
    $this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian untuk Keperluan Dinas', 'url' => ['index-by-pegawai']];
    $this->params['breadcrumbs'][] = $this->title;
}
?>

<div class="ubux-transaksi-kendaraan-mahasiswa-form">

    <h1>Request Kendaraan by Pegawai</h1>

    <?php $form = ActiveForm::begin(['options' => [
        'enctype' => 'multipart/form-data'],
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

    <?= $form->field($model, 'desc')->textarea() ?>

    <?= $form->field($model, 'tujuan')->textarea() ?>

    <?= $form->field($model, 'jumlah_penumpang_kendaraan')->textInput() ?>

    <?= $form->field($model, 'rencana_waktu_keberangkatan')->widget(DateTimePicker::className(),[
        'inline' => false,
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'size' => 'ms',
        'clientOptions' => [
            'autoClose' => true,
            'format' => 'yyyy-mm-dd HH:ii:ss',
            'todayBtn' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'rencana_waktu_kembali')->widget(DateTimePicker::className(),[
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
    <?= $form->field($model, 'status_req_sekretaris_rektorat')->dropDownList([ 'Menunggu' => 'Menunggu', 'Diterima' => 'Diterima', 'Ditolak' => 'Ditolak', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status_request_kemahasiswaan')->dropDownList([ 'Menunggu' => 'Menunggu', 'Diterima' => 'Diterima', 'Ditolak' => 'Ditolak', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'jenis_keperluan_id')->dropDownList([ 'Mahasiswa' => 'Mahasiswa', 'Pegawai' => 'Pegawai', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'proposal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput(); ?>
-->
    <?= $form->field($model, 'no_telepon')->textInput(['maxlength' => true]) ?>
<!--
    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kendaraan_id')->dropDownList(
        ArrayHelper::map(Kendaraan::find()->select([
            'kendaraan_id', 'kendaraan'
        ])->all(), 'kendaraan_id', 'kendaraan'),
        ['prompt' => 'Pilih Kendaraan']
    ) ?>
-->
    <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
            <?= Html::submitButton($model->isNewRecord ? 'Buat' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
