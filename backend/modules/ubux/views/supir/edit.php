<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\Supir */

$this->title = 'Ubah Supir : ' . ' ' . $model->pegawai->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Supir', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pegawai->nama, 'url' => ['view', 'id' => $model->supir_id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="supir-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
