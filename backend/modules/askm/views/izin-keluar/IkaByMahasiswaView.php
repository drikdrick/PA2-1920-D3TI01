<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use backend\modules\askm\models\Pegawai;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\IzinKeluar */

$this->title = "Detail Izin Keluar";
$this->params['breadcrumbs'][] = ['label' => 'Izin Keluar', 'url' => ['ika-by-mahasiswa-index']];
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="izin-keluar-view">

    <?php
        if ($model->status_request_dosen_wali == 1) {
    ?>

    <div class="pull-right">
        Pengaturan
        <?= $uiHelper->renderButtonSet([
                'template' => ['edit', 'cancel'],
                'buttons' => [
                    'edit' => ['url' => Url::toRoute(['ika-by-mahasiswa-edit', 'id' => $model->izin_keluar_id]), 'label'=> 'Edit', 'icon'=>'fa fa-pencil'], // id keasramaan diambil saat sudah login
                    'cancel' => ['url' => Url::toRoute(['ika-by-mahasiswa-cancel', 'id' => $model->izin_keluar_id]), 'label'=> 'Cancel', 'icon'=>'fa fa-times'],
                ],
                
            ]) ?>
    </div>

    <h1><?= $this->title ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Nama Mahasiswa', 'value' => $model->dim['nama']],
            ['label' => 'NIM Mahasiswa', 'value' => $model->dim['nim']],
            'desc:ntext',
            'rencana_berangkat',
            'rencana_kembali',
            [
                'attribute' => 'realisasi_berangkat',
                'label' => 'Realisasi Berangkat',
                'value' => function($model){
                    if (is_null($model->realisasi_berangkat)) {
                        return '-';
                    }else{
                        return $model->realisasi_berangkat;
                    }
                }
            ],
            [
                'attribute' => 'realisasi_kembali',
                'label' => 'Realisasi Kembali',
                'value' => function($model){
                    if (is_null($model->realisasi_kembali)) {
                        return '-';
                    }else{
                        return $model->realisasi_kembali;
                    }
                }
            ],
            [
                'attribute' => 'status_request_dosen_wali',
                'label' => 'Persetujuan Dosen',
                'value' => function($model){
                    if (is_null($model->statusRequestDosen->status_request)) {
                        return '-';
                    }else{
                        return $model->statusRequestDosen->status_request;
                    }
                }
            ],
            [
                'label' => 'Dosen Penyetuju', 
                'value' => function($model){
                    if (is_null($model->dosen['nama'])) {
                        return '-';
                    }else{
                        return $model->dosen['nama'];
                    }
                }
            ],
            [
                'attribute' => 'status_request_keasramaan',
                'label' => 'Persetujuan Keasramaan',
                'value' => function($model){
                    if (is_null($model->statusRequestKeasramaan->status_request)) {
                        return '-';
                    }else{
                        return $model->statusRequestKeasramaan->status_request;
                    }
                }
            ],
            [
                'label' => 'Keasramaan Penyetuju', 
                'value' => function($model){
                    if (is_null($model->keasramaan['nama'])) {
                        return '-';
                    }else{
                        return $model->keasramaan['nama'];
                    }
                }
            ],
            [
                'attribute' => 'status_request_baak',
                'label' => 'Persetujuan BAAK',
                'value' => function($model){
                    if (is_null($model->statusRequestBaak->status_request)) {
                        return '-';
                    }else{
                        return $model->statusRequestBaak->status_request;
                    }
                }
            ],
            [
                'label' => 'BAAK Penyetuju', 
                'value' => function($model){
                    if (is_null($model->baak['nama'])) {
                        return '-';
                    }else{
                        return $model->baak['nama'];
                    }
                }
            ],
            // ['attribute' => 'status_request_dosen_wali', 'value' => $model->status_request_dosen_wali['status_request']],
        ],
    ]);
    }else{ ?>

    <h1><?= $this->title ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Nama Mahasiswa', 'value' => $model->dim['nama']],
            ['label' => 'NIM Mahasiswa', 'value' => $model->dim['nim']],
            'desc:ntext',
            'rencana_berangkat',
            'rencana_kembali',
            [
                'attribute' => 'realisasi_berangkat',
                'label' => 'Realisasi Berangkat',
                'value' => function($model){
                    if (is_null($model->realisasi_berangkat)) {
                        return '-';
                    }else{
                        return $model->realisasi_berangkat;
                    }
                }
            ],
            [
                'attribute' => 'realisasi_kembali',
                'label' => 'Realisasi Kembali',
                'value' => function($model){
                    if (is_null($model->realisasi_kembali)) {
                        return '-';
                    }else{
                        return $model->realisasi_kembali;
                    }
                }
            ],
            [
                'attribute' => 'status_request_dosen_wali',
                'label' => 'Persetujuan Dosen',
                'value' => function($model){
                    if (is_null($model->statusRequestDosen->status_request)) {
                        return '-';
                    }else{
                        return $model->statusRequestDosen->status_request;
                    }
                }
            ],
            [
                'label' => 'Dosen Penyetuju', 
                'value' => function($model){
                    if (is_null($model->dosen['nama'])) {
                        return '-';
                    }else{
                        return $model->dosen['nama'];
                    }
                }
            ],
            [
                'attribute' => 'status_request_keasramaan',
                'label' => 'Persetujuan Keasramaan',
                'value' => function($model){
                    if (is_null($model->statusRequestKeasramaan->status_request)) {
                        return '-';
                    }else{
                        return $model->statusRequestKeasramaan->status_request;
                    }
                }
            ],
            [
                'label' => 'Keasramaan Penyetuju', 
                'value' => function($model){
                    if (is_null($model->keasramaan['nama'])) {
                        return '-';
                    }else{
                        return $model->keasramaan['nama'];
                    }
                }
            ],
            [
                'attribute' => 'status_request_baak',
                'label' => 'Persetujuan BAAK',
                'value' => function($model){
                    if (is_null($model->statusRequestBaak->status_request)) {
                        return '-';
                    }else{
                        return $model->statusRequestBaak->status_request;
                    }
                }
            ],
            [
                'label' => 'BAAK Penyetuju', 
                'value' => function($model){
                    if (is_null($model->baak['nama'])) {
                        return '-';
                    }else{
                        return $model->baak['nama'];
                    }
                }
            ],
            // ['attribute' => 'status_request_dosen_wali', 'value' => $model->status_request_dosen_wali['status_request']],
        ],
    ]);
    }?>

</div>
