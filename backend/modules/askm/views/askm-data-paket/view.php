<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmDataPaket */

$this->title = $model->data_paket_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Data Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-data-paket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->data_paket_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->data_paket_id], [
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
            'data_paket_id',
            'tanggal_kedatangan',
            'desc:ntext',
            'penerima',
            'pengirim',
            'diambil_oleh',
            'tanggal_diambil',
            'pegawai_id',
        ],
    ]) ?>

</div>
