<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Paket */

$this->title = $model->penerima."'s Paket";
$this->params['breadcrumbs'][] = ['label' => 'Pakets', 'url' => ['index-by-admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'data_paket_id',
            'penerima',
            'pengirim',
            'tanggal_kedatangan',
            'diambil_oleh',
            'tanggal_diambil',
            'posisi',
            'desc:ntext',
            //'deleted',
            //'deleted_at',
            //'deleted_by',
            'created_by',
            //'created_at',
            //'updated_at',
            //'updated_by',
        ],
    ]) ?>

</div>
