<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PosisiPaket */

$this->title = 'Update Posisi Paket: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Posisi Paket', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['posisi-paket-view', 'id' => $model->posisi_paket_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posisi-paket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
