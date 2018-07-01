<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMahasiswaAktif */

$this->title = 'Request Surat Mahasiswa Aktif';
$this->params['breadcrumbs'][] = ['label' => 'Surat Mahasiswa Aktif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-mahasiswa-aktif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formAdd', [
        'model' => $model,
    ]) ?>

</div>
