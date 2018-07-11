<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Konfirmasi Waktu Pengambilan';
$this->params['breadcrumbs'][] = ['label' => 'Surat Kompetisi', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat', 'url' => ['view-admin', 'id' => $model->surat_lomba_id]];
$this->params['breadcrumbs'][] = 'Ready to Take';
?>
<div class="surat-magang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEditReady', [
        'model' => $model,
    ]) ?>

</div>
