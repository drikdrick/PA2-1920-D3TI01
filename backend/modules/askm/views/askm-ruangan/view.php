<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmRuangan */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Askm Ruangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-ruangan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ruangan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ruangan_id], [
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
            'ruangan_id',
            'name',
            'izin_tambahan_jam_kolaboratif_id',
        ],
    ]) ?>

</div>
