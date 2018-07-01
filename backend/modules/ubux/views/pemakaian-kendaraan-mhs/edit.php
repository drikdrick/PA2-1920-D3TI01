<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraanMhs */

$this->title = 'Ubah Permohonan Pemakaian Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pemakaian_kendaraan_mhs_id, 'url' => ['view', 'id' => $model->pemakaian_kendaraan_mhs_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-baru-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
