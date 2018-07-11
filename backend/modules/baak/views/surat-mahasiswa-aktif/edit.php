<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMahasiswaAktif */

$this->title = 'Update Surat Mahasiswa Aktif';
$this->params['breadcrumbs'][] = ['label' => 'Surat Mahasiswa Aktif', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat', 'url' => ['view', 'id' => $model->surat_mahasiswa_aktif_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-mahasiswa-aktif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEdit', [
        'model' => $model,
    ]) ?>

</div>
