<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Tolak Pengajuan Kartu Tanda Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Kartu Tanda Mahasiswa', 'url' => ['index-admin']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-magang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEditDecline', [
        'model' => $model,
    ]) ?>

</div>
