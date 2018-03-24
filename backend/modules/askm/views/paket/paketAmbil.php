<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Paket */

$this->title = 'Edit Paket: ' . ' ' . $model->penerima." paket's";
$this->params['breadcrumbs'][] = ['label' => 'Paket', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penerima, 'url' => ['view', 'id' => $model->data_paket_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formAmbil', [
        'model' => $model,
    ]) ?>

</div>
