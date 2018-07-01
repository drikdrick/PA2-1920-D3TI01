<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\LaporanPemakaianKendaraan */

$this->title = 'Ubah Laporan Pemakaian Kendaraan: ' . ' ' . $model->laporan_pemakaian_kendaraan_id;
$this->params['breadcrumbs'][] = ['label' => 'Laporan Pemakaian Kendaraans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->laporan_pemakaian_kendaraan_id, 'url' => ['view', 'id' => $model->laporan_pemakaian_kendaraan_id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ubux-laporan-pemakaian-kendaraan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
