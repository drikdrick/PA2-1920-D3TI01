<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\LaporanPemakaianKendaraan */

$this->title = 'Tambah Laporan Pemakaian Kendaraan';
$this->params['breadcrumbs'][] = ['label' => 'Laporan Pemakaian Kendaraan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-laporan-pemakaian-kendaraan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
