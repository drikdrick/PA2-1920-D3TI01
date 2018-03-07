<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinBermalam */

$this->title = $model->izin_bermalam_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Bermalams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-bermalam-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->izin_bermalam_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->izin_bermalam_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'izin_bermalam_id',
            'rencana_berangkat',
            'rencana_kembali',
            'realisasi_berangkat',
            'realisasi_kembali',
            'desc:ntext',
            'tujuan',
            'dim_id',
            'keasramaan_id',
            'status_request_id',
            'izin_laptop_id',
        ],
    ]) ?>

</div>
