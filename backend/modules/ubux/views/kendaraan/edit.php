<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\Kendaraan */

$this->title = 'Ubah Kendaraan : ' . ' ' . $model->kendaraan;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Kendaraan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kendaraan, 'url' => ['view', 'id' => $model->kendaraan_id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ubux-kendaraan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
