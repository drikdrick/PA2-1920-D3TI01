<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinTambahanJamKolaboratif */

$this->title = 'Update Askm Izin Tambahan Jam Kolaboratif: ' . $model->izin_tambahan_jam_kolaboratif_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Tambahan Jam Kolaboratifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->izin_tambahan_jam_kolaboratif_id, 'url' => ['view', 'id' => $model->izin_tambahan_jam_kolaboratif_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-izin-tambahan-jam-kolaboratif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
