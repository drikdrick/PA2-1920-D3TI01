<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinKeluar */

$this->title = 'Update Askm Izin Keluar: ' . $model->izin_keluar_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Keluars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->izin_keluar_id, 'url' => ['view', 'id' => $model->izin_keluar_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-izin-keluar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
