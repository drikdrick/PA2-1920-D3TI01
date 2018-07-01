<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraan */

$this->title = 'Ubah Permohonan Pemakaian';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kendaraan->kendaraan, 'url' => ['view', 'id' => $model->pemakaian_kendaraan_id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
