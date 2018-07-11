<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Tambah Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Surat Pengantar Proyek', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat', 'url' => ['view', 'id' => $model->surat_pengantar_proyek_id]];
$this->params['breadcrumbs'][] = ['label' => 'Tambah Mahasiswa'];
?>
<div class="surat-magang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEditDim', [
        'model' => $model,
        'dim' => $dim,
    ]) ?>

</div>
