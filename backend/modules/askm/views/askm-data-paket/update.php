<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmDataPaket */

$this->title = 'Update Askm Data Paket: ' . $model->data_paket_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Data Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->data_paket_id, 'url' => ['view', 'id' => $model->data_paket_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-data-paket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
