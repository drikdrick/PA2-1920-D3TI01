<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Posisi */

$this->title = $model->nama_posisi;
$this->params['breadcrumbs'][] = ['label' => 'Posisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posisi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['posisi-edit', 'id' => $model->posisi_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['posisi-del', 'id' => $model->posisi_id], [
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
            //'posisi_id',
            'nama_posisi',
            //'deleted',
            //'deleted_at',
            //'deleted_by',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
        ],
    ]) ?>

</div>
