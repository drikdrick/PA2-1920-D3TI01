<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinBermalam */

$this->title = 'Update Askm Izin Bermalam: ' . $model->izin_bermalam_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Bermalams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->izin_bermalam_id, 'url' => ['view', 'id' => $model->izin_bermalam_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-izin-bermalam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
