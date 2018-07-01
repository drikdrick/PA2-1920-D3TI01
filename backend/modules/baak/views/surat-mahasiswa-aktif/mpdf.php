<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use backend\modules\baak\models\Dim;
    use backend\modules\baak\models\Prodi;
    use backend\modules\baak\models\JenisKelamin;
    use backend\modules\baak\models\Pekerjaan;
?>
<head>
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
    <?= $tanggal_surat = $model->tanggal_surat;
        $tanggal_lahir = $dim->tgl_lahir;

        $getMonth = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');        

        $month = $getMonth[date('n', strtotime($tanggal_surat))-1];
        $monthLahir = $getMonth[date('n', strtotime($tanggal_lahir))-1];

        $tgl_surat .=  date('d', strtotime($model->tanggal_surat)) .' '.$month .' '.date('Y', strtotime($model->tanggal_surat));
        $tgl_lahir .=  date('d', strtotime($dim->tgl_lahir)) .' '.$monthLahir .' '.date('Y', strtotime($dim->tgl_lahir));

        $jk = JenisKelamin::find()->where(['jenis_kelamin_id' => $dim->jenis_kelamin_id])->one();
        if($jk->nama != null){
            $jenis = $jk->nama;
        }
        else{
            $jenis = $dim->jenis_kelamin;
        }

        $pekerjaan_ayah = Pekerjaan::find()->where(['pekerjaan_id' => $dim->pekerjaan_ayah_id])->one();
        if($pekerjaan_ayah != null){
            $kerja_ayah = $pekerjaan_ayah->nama;
        }
        else{
            $kerja_ayah = $dim->pekerjaan_ayah;
        }

        $pekerjaan_ibu = Pekerjaan::find()->where(['pekerjaan_id' => $dim->pekerjaan_ibu_id])->one();
        if($pekerjaan_ibu != null){
            $kerja_ibu = $pekerjaan_ibu->nama;
        }
        else{
            $kerja_ibu = $dim->pekerjaan_ibu;
        }
    ?>
</head>
<body>
    <div class="surat-lomba">
        <table>
            <tr>
                <td rowspan="2">
                    <img src="E:\xampp\htdocs\cis-lite\backend\modules\baak\views\surat-lomba\gambar\logo.jpg" style="width: 100px; width: 100px;">
                </td>
                <td style="width: 600px;" class="tengah">
                    <h2>INSTITUT TEKNOLOGI DEL</h2>
                </td>
            </tr>
            <tr>
                <td class="tengah">
                    <p>Jl. Sisingamangaraja, Laguboti 22381<br>
                        Toba Samosir, Sumatera Utara , Laguboti,22381<br>
                        Telp.: (0632) 331234, Fax.: (0632) 331116<br>
                        <u>info@del.ac.id,</u><u> www.del.ac.id</u>
                    </p>
                </td>
            </tr>
        </table><p style="text-align: center">
            <b><u>SURAT KETERANGAN</u><br>
            Mahasiswa Aktif Institut Teknologi Del<br>
            No. <?=$model->nomor_surat_lengkap?><b>
        </p>
        <br>
        <p>Direktur Pendidikan Institut Teknologi Del dengan ini menerangkan, bahwa mahasiswa yang tersebut di bawah ini : </p>
        <table border='0'>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?=$dim->nama?></td> 
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><?=$dim->nim?></td> 
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td><?=$prodi->kbk_ind?></td> 
            </tr><tr>
                <td>Fakultas</td>
                <td>:</td>
                <td></td> 
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td><?=$dim->tempat_lahir?>/<?=$tgl_lahir?></td> 
            </tr><tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?=$jenis?></td> 
            </tr><tr>
                <td>Tahun Masuk</td>
                <td>:</td>
                <td><?=$dim->thn_masuk?></td> 
            </tr><tr>
                <td>Nama Ayah</td>
                <td>:</td>
                <td><?=$dim->nama_ayah?></td> 
            </tr><tr>
                <td>Pekerjaan Ayah</td>
                <td>:</td>
                <td><?=$kerja_ayah?></td> 
            </tr><tr>
                <td>Nama Ibu</td>
                <td>:</td>
                <td><?=$dim->nama_ibu?></td> 
            </tr><tr>
                <td>Pekerjaan Ibu</td>
                <td>:</td>
                <td><?=$kerja_ibu?></td> 
            </tr><tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?=$dim->alamat?></td> 
            </tr>
        </table>

        <p>adalah benar mahasiswa yang masih aktif pada Semester Genap, Tahun Akademik <?=$new_date = date('Y', strtotime($tgl_surat))?>/2019 di Institut Teknologi Del, Sitoluama, Laguboti, Toba Samosir, Sumatera Utara.</p>

        <p>Mahasiswa Institut Teknologi Del diwajibkan untuk tinggal di dalam asrama mahasiswa selama menjalani masa perkuliahannya.</p>

        <p>Demikian Surat Keterangan ini dibuat untuk digunakan dalam <b><?=$model->tujuan?></b>.</p>

        <p>Sitoluama, <?=$tgl_surat?></p>
        <p>Institut Teknologi Del<br>Direktur Pendidikan<br><br><br><br>Mariana Simanjuntak, M.Sc.</p>

</div>
</body>