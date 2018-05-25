<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\KeasramaanPegawai */

$this->title = 'Update Keasramaan Pegawai: ' . ' ' . $model->keasramaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Keasramaan Pegawai', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->keasramaan_id, 'url' => ['view', 'id' => $model->keasramaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="keasramaan-pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
