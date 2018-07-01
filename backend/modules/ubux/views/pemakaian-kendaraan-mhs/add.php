<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraanMhs */

$this->title = 'Buat Permohonan Pemakaian Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Pemakaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-transaksi-kendaraan-mahasiswa-baru-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
