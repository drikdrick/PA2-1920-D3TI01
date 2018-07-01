<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraanMhs */

$this->title = 'Request Kendaraan Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Request Kendaraan Mahasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .garis{
        border: 1px solid black;
    }
    .tengah{
        text-align: center;
    }
    table, th, td{
        border-collapse: collapse;
    }
    .kolom{
        height: 1cm;
    }
</style>

<div class="ubux-transaksi-kendaraan-mahasiswa-view">

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
            <td class="kolom">NIM</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->mahasiswa->nim ?></td>
        </tr>
        <tr>
            <td class="kolom">Nama</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->mahasiswa->nama ?></td>
        </tr>
		<tr>
			<td class="kolom">Keperluan</td>
			<td>:</td>
			<td><?= $model->desc ?></td>
		</tr>
        <tr>
            <td class="kolom">Tujuan</td>
            <td>:</td>
            <td><?= $model->tujuan ?></td>
        </tr>
        <tr>
            <td class="kolom">Jumlah Penumpang</td>
            <td>:</td>
            <td><?= $model->jumlah_penumpang_kendaraan ?></td>
        </tr>
        <tr>
            <td class="kolom">Waktu Keberangkatan</td>
            <td>:</td>
            <td><?= $model->rencana_waktu_keberangkatan ?></td>
        </tr>
        <tr>
            <td class="kolom">Waktu Tiba</td>
            <td>:</td>
            <td><?= $model->rencana_waktu_kembali ?></td>
        </tr>
        <tr>
            <td class="kolom">Status</td>
            <td>:</td>
            <td><?= $model->statusRequestSekretarisRektorat->status ?></td>
        </tr>
        <tr>
            <td class="kolom">No Telepon</td>
            <td>:</td>
            <td><?= $model->no_telepon ?></td>
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
        <tr>
            <td class="kolom">No Hp Supir</td>
            <td>:</td>
            <td><?= $model->no_hp_supir ?></td>
        </tr>
	</table>

<!--
    <?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'transaksi_kendaraan_id',
//            'nama_perequest_kendaraan',
//            'desc',
//            'tujuan',
//            'jumlah_penumpang_kendaraan',
//            'rencana_waktu_keberangkatan',
//            'rencana_waktu_kembali',
//            'status_req_sekretaris_rektorat',
//            'status_request_kemahasiswaan',
//            'role',
//            'no_telepon',
//            'proposal',
//            'deleted',
//            'deleted_at',
//            'deleted_by',
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
//            'kendaraan_id',
//            [
//                'attribute' => 'Kendaraan',
//                'value' => $model->kendaraan->kendaraan,
//            ],
//            [
//                    'attribute' => 'Supir',
//                'value' => $model->supir->name_supir,
//            ],
//            'no_hp_supir',
//        ],
//    ]) ?>
	-->
	
    <br><br><br><br><br><br><br><br><br><br><br><br>
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
