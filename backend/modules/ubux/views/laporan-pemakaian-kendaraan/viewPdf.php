<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\LaporanPemakaianKendaraan */

$this->title = 'Laporan Pemakaian Kendaraan';
$this->params['breadcrumbs'][] = ['label' => 'Laporan Pemakaian Kendaraans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .garis{
        border: 1px solid black;
    }
    .tengah{
        text-align: center;
    }
    .kanan{
        text-align: right;
    }
    table, th, td{
        border-collapse: collapse;
    }
    .kolom{
        height: 1cm;
    }
</style>

<div class="ubux-laporan-pemakaian-kendaraan-view">

    <table>
        <tr>
            <td rowspan="2"><img src="gambar/itdel.jpg" style="width: 100px; width: 100px;"></td>
            <td style="width: 600px;"  class="tengah"><h1><?= Html::encode($this->title) ?></h1></td>
        </tr>
        <tr>
            <td class="tengah"><h2>Institut Teknologi Del</h2></td>
        </tr>
    </table>

    <hr>

    <table style="margin-left: 100px; margin-top: 25px;">
        <tr>
            <td class="kolom">Tujuan</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->tujuan ?></td>
        </tr>
        <tr>
            <td class="kolom">Deskripsi Penumpang</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->desc ?></td>
        </tr>
        <tr>
            <td class="kolom">Jumlah Penumpang</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->jumlah_penumpang ?></td>
        </tr>
        <tr>
            <td class="kolom">Keperluan</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->keperluan ?></td>
        </tr>
        <tr>
            <td class="kolom">Waktu Keberangkatan</td>
            <td>:</td>
            <td><?= $model->waktu_keberangkatan ?></td>
        </tr>
        <tr>
            <td class="kolom">Waktu Tiba</td>
            <td>:</td>
            <td><?= $model->waktu_tiba ?></td>
        </tr>
        <tr>
            <td class="kolom">Kendaraan</td>
            <td>:</td>
            <td><?= $model->kendaraan->kendaraan ?></td>
        </tr>
        <tr>
            <td class="kolom">Supir</td>
            <td>:</td>
            <td><?= $model->supir->pegawai->nama ?></td>
        </tr>
    </table>


<!--    <?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'laporan_pemakaian_kendaraan_id',
//            'tujuan',
//            'desc',
//            'jumlah_penumpang',
//            'keperluan',
//            'waktu_keberangkatan',
//            'waktu_tiba',
//            'deleted',
//            'deleted_at',
//            'deleted_by',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
//            'kendaraan_id',
//            [
//                    'attribute' => 'Kendaraan',
//                'value' => $model->kendaraan->kendaraan
//            ],
//            'supir_id',
//            [
//                    'attribute' => 'Supir',
//                'value' => $model->supir->name_supir,
//            ],
//        ],
//    ]) ?>
-->

    <br><br><br><br><br><br><br>
    <table style="margin-left: 13cm; width: 7cm">
        <tr class="kolom">
            <td class="tengah">Dibuat Oleh,</td>
        </tr>
        <tr class="kolom">
            <td style="height: 3cm" class="tengah"></td>
        </tr>
        <tr class="kolom">
            <td class="tengah">Cori Lumban Gaol</td>
        </tr>
        <tr class="kolom">
            <td class="tengah">Staf Sekretariat</td>
        </tr>
    </table>

    <br><br><br><br><br>
    <hr>
    <table>
        <tr>
            <td>Institut Teknologi Del</td>
        </tr>
        <tr>
            <td>Jl. Sisingamangaraja, Sitoluama</td>
        </tr>
        <tr>
            <td>Laguboti 22381, Toba Samosir</td>
        </tr>
        <tr>
            <td>Sumatera Utara</td>
        </tr>
        <tr>
            <td>Telp : +62 632 - 331234, Fax : +62 632 - 331116</td>
        </tr>
        <tr>
            <td>www.del.ac.id</td>
        </tr>
    </table>
    
</div>
