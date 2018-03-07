<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinLaptop */

$this->title = 'Update Askm Izin Laptop: ' . $model->izin_laptop_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Laptops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->izin_laptop_id, 'url' => ['view', 'id' => $model->izin_laptop_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-izin-laptop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
