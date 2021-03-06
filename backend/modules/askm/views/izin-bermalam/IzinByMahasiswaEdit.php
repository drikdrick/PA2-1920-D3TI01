<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\IzinBermalam */

$this->title = 'Edit Data Izin Bermalam';
$this->params['breadcrumbs'][] = ['label' => 'Izin Bermalam', 'url' => ['index-mahasiswa']];
$this->params['breadcrumbs'][] = ['label' => 'List Izin Bermalam', 'url' => ['izin-by-mahasiswa-index']];
$this->params['breadcrumbs'][] = ['label' => 'Data Izin Bermalam', 'url' => ['izin-by-mahasiswa-view', 'id' => $model->izin_bermalam_id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="izin-bermalam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formByMahasiswa', [
        'model' => $model,
    ]) ?>

</div>
