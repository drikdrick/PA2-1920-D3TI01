<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinPenggunaanRuangan */

$this->title = 'Update Askm Izin Penggunaan Ruangan: ' . $model->izin_penggunaan_ruangan_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Penggunaan Ruangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->izin_penggunaan_ruangan_id, 'url' => ['view', 'id' => $model->izin_penggunaan_ruangan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-izin-penggunaan-ruangan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
