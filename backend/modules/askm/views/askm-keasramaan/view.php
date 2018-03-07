<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmKeasramaan */

$this->title = $model->keasramaan_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Keasramaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-keasramaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->keasramaan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->keasramaan_id], [
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
            'keasramaan_id',
            'aktif_start',
            'aktif_end',
            'pegawai_id',
        ],
    ]) ?>

</div>
