<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Konfirmasi Data Surat';
$this->params['breadcrumbs'][] = ['label' => 'Surat Pengantar Proyek', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat', 'url' => ['view-admin', 'id' => $model->surat_pengantar_proyek_id]];
$this->params['breadcrumbs'][] = 'Print';
?>
<div class="surat-magang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEditPdf', [
        'model' => $model,       
        'model_nomor_surat' => $model_nomor_surat,
    ]) ?>

</div>
