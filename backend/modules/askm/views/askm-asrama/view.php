<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmAsrama */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Askm Asramas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-asrama-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->asrama_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->asrama_id], [
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
            'asrama_id',
            'name',
            'lokasi',
            'jumlah_mahasiswa',
            'kapasitas',
        ],
    ]) ?>

</div>
