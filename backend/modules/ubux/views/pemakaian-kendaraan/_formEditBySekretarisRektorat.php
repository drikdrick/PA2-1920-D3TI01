<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helpers\ArrayHelper;
use backend\modules\ubux\models\Kendaraan;
use backend\modules\ubux\models\Supir;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraan */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Ubah Permohonan Pemakaian';
?>

<div class="ubux-transaksi-kendaraan-mahasiswa-form">

    <h1>Catatan :</h1>

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

    <?= $form->field($model, 'kendaraan_id')->dropDownList(
        ArrayHelper::map(Kendaraan::find()->select([
            'kendaraan_id', 'kendaraan', 'plat_nomor', 'status',
        ])->where(['deleted' => 0])->all(), 'kendaraan_id', 'KeteranganKendaraan'),
        ['prompt' => 'Pilih Kendaraan']
    ) ?>

    <?= $form->field($model, 'supir_id')->dropDownList(
        ArrayHelper::map(Supir::find()->select([
            'supir_id', 'pegawai_id', 'status',
        ])->where(['deleted' => 0])->all(), 'supir_id', 'NamaSupir'),
        ['prompt' => 'Pilih Supir']
    ) ?>
<!--
    <?= $form->field($model, 'no_hp_supir')->textInput() ?>
-->
    <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
            <?= Html::submitButton($model->isNewRecord ? 'Buat' : 'Tambah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
