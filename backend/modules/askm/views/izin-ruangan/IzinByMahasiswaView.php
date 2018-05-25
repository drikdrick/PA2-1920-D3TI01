<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\IzinTambahanJamKolaboratif */

$this->title = 'Detail Izin';
$this->params['breadcrumbs'][] = ['label' => 'Izin Penggunaan Ruangan', 'url' => ['index-mahasiswa']];
$this->params['breadcrumbs'][] = ['label' => 'Daftar Izin', 'url' => ['izin-by-mahasiswa-index']];
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="izin-ruangan-view">

    <?php
        if ($model->status_request_id == 1) {
    ?>

    <div class="pull-right">
        Pengaturan
        <?= $uiHelper->renderButtonSet([
                'template' => ['edit', 'cancel'],
                'buttons' => [
                    'edit' => ['url' => Url::toRoute(['izin-by-mahasiswa-edit', 'id' => $model->izin_ruangan_id]), 'label'=> 'Edit Request', 'icon'=>'fa fa-pencil'], // id keasramaan diambil saat sudah login
                    'cancel' => ['url' => Url::toRoute(['cancel-by-mahasiswa', 'id' => $model->izin_ruangan_id]), 'label'=> 'Cancel Request', 'icon'=>'fa fa-times'],
                ],
                
            ]) ?>
    </div>
    <h1><?= $this->title ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'izin_ruangan_id',
            [
                'label' => 'Nama Pengaju',
                'value' => $model->dim->nama,
            ],
            'rencana_mulai',
            'rencana_berakhir',
            [
                'label' => 'Keterangan',
                'value' => $model->desc,
            ],
            // 'baak_id',
            'statusRequest.status_request',
        ],
    ]); ?>

    <?php }else { ?>

    <h1><?= $this->title ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'izin_ruangan_id',
            [
                'label' => 'Nama Pengaju',
                'value' => $model->dim->nama,
            ],
            'rencana_mulai',
            'rencana_berakhir',
            [
                'label' => 'Keterangan',
                'value' => $model->desc,
            ],
            'statusRequest.status_request',
            // 'baak_id',
        ],
    ]); } ?>

</div>