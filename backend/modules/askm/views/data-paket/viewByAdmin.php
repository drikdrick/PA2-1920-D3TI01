<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DataPaket */

$this->title = "Rincian";
$this->params['breadcrumbs'][] = ['label' => 'Data Paket', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-paket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['data-paket-edit', 'id' => $model->data_paket_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->data_paket_id], [
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
            //'data_paket_id',
            'penerima',
            'tanggal_kedatangan',
            'pengirim',
            'diambil_oleh',
            'tanggal_diambil',
            [
                'attribute'=>'pegawai_id',
                'value'=>$model->pegawai['nama'],
            ],
            'desc:ntext',
        ],
    ]) ?>

</div>
