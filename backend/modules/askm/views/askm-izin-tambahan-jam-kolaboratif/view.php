<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmIzinTambahanJamKolaboratif */

$this->title = $model->izin_tambahan_jam_kolaboratif_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Izin Tambahan Jam Kolaboratifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-izin-tambahan-jam-kolaboratif-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->izin_tambahan_jam_kolaboratif_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->izin_tambahan_jam_kolaboratif_id], [
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
            'izin_tambahan_jam_kolaboratif_id',
            'rencana_mulai',
            'rencana_berakhir',
            'decs:ntext',
            'dim_id',
            'status_request_id',
            'staf_id',
        ],
    ]) ?>

</div>
