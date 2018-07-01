<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\Kendaraan */

$this->title = $model->kendaraan;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Kendaraan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubux-kendaraan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['edit', 'id' => $model->kendaraan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['del', 'id' => $model->kendaraan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah anda yakin ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'kendaraan_id',
            'kendaraan',
            'plat_nomor',
            'daya_tampung_kendaraan',
            [
                'attribute' => 'Ketersediaan',
                'value' => function(Model $model){
                    if($model->status == 0) return 'Tersedia';
                    else return 'Terpakai';
                }
            ],
//            'deleted',
//            'deleted_at',
//            'deleted_by',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
        ],
    ]) ?>

</div>
