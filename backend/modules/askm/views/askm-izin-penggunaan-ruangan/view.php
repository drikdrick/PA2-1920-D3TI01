<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinPenggunaanRuangan */

$this->title = $model->izin_penggunaan_ruangan_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Penggunaan Ruangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-penggunaan-ruangan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->izin_penggunaan_ruangan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->izin_penggunaan_ruangan_id], [
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
            'izin_penggunaan_ruangan_id',
            'rencana_mulai',
            'rencana_berakhir',
            'desc:ntext',
            'dim_id',
            'staf_id',
            'status_request_id',
        ],
    ]) ?>

</div>
