<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Konfirmasi Data Surat';
$this->params['breadcrumbs'][] = ['label' => 'Surat Mahasiswa Aktif', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-magang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEditPdf', [
        'model' => $model,
        'nomor_surat' => $nomor_surat,
    ]) ?>

</div>
