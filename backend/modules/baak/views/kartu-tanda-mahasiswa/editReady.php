<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Konfirmasi Pengambilan Kartu Tanda Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Surat Magang', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-magang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEditReady', [
        'model' => $model,
    ]) ?>

</div>
