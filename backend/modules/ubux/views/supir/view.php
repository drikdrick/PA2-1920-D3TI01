<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\Supir */

$this->title = $model->pegawai->nama;
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Supir', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supir-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['edit', 'id' => $model->supir_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['del', 'id' => $model->supir_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakan anda yakin ingin menghapus ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'supir_id',
//            'pegawai_id',
            [
                    'attribute' => 'Nama',
                'value' => $model->pegawai->nama,
            ],
            'no_telepon_supir',
            [
                'attribute' => 'Ketersediaan',
                'value' => function(Model $model){
                    if($model->status == 0) return 'On';
                    else return 'Off';
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
