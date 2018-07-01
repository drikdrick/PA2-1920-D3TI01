<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\PemakaianKendaraan */

$this->title = 'Permintaan Kendaraan Pribadi';
$this->params['breadcrumbs'][] = ['label' => 'Permintaan Kendaraan Pribadi', 'url' => ['index-by-pribadi']];
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
            <td class="kolom">Nama</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->pegawai->nama ?></td>
        </tr>
        <tr>
            <td class="kolom">Keperluan</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->desc ?></td>
        </tr>
        <tr>
            <td class="kolom">Tujuan</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->tujuan ?></td>
        </tr>
        <tr>
            <td class="kolom">Jumlah Penumpang</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->jumlah_penumpang_kendaraan ?></td>
        </tr>
        <tr>
            <td class="kolom">Waktu Keberangkatan</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->rencana_waktu_keberangkatan ?></td>
        </tr>
        <tr>
            <td class="kolom">Waktu Tiba</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->rencana_waktu_kembali ?></td>
        </tr>
        <tr>
            <td class="kolom">No Telepon</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->no_telepon ?></td>
        </tr>
        <tr>
            <td class="kolom">Mobil</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->kendaraan->kendaraan ?></td>
        </tr>
        <tr>
            <td class="kolom">Status Request Seketaris Rektorat</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->statusRequestSekretarisRektorat->status ?></td>
        </tr>
        <tr>
            <td class="kolom">Status Request Kabiro KSD</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->statusRequestKabiroKSD->status ?></td>
        </tr>
        <tr>
            <td class="kolom">Status Request HRD</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->statusRequestHRD->status ?></td>
        </tr>
        <tr>
            <td class="kolom">Status Request Keuangan</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->statusRequestKeuangan->status ?></td>
        </tr>
        <tr>
            <td class="kolom">Status Request WR2</td>
            <td class="kolom">:</td>
            <td class="kolom"><?= $model->statusRequestWr2->status ?></td>
        </tr>
    </table>


    <br><br><br><br><br><br><br><br><br><br>
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

</div>
