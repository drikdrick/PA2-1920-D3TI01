<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use backend\modules\baak\models\Dim;
    use backend\modules\baak\models\Prodi;
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

        $getMonth = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');        

        $month = $getMonth[date('n', strtotime($tanggal_surat))-1];

        $tgl_surat .=  date('d', strtotime($model->tanggal_surat)) .' '.$month .' '.date('Y', strtotime($model->tanggal_surat));
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
                    <p>JL. Sisingamangaraja, Laguboti 22381<br>
                        Toba Samosir, Sumatera Utara , Laguboti,22381<br>
                        Telp.: (0632) 331234, Fax.: (0632) 331116<br>
                        <u>info@del.ac.id,</u><u> www.del.ac.id</u>
                    </p>
                </td>
            </tr>
        </table>
        <hr> 
        <p style="text-align:right">
            Laguboti, <?=$tgl_surat?>
        </p>
        <table border='0'>
            <tr>
                <td>No</td>
                <td>:</td>
                <td><?=$model->nomor_surat_lengkap?></td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td><?=$model->perihal?></td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td><?=$model->banyak_lampiran?> berkas</td>
            </tr>
        </table>
        <p style="text-align: justify;">
            Yang Terhormat<br>
            Panitia Kompetisi <?=$model->nama_lomba?><br>
            <?=$model->alamat_tujuan?>
        </p>
        <p style="text-align: justify;">
            Dengan Hormat,<br>
            <?=$model->salam_pembuka?>
        </p>
        <table border="1" align="center">
            <tr>
                <b>
                    <td>No</td>
                    <td>NIM</td>
                    <td>Nama</td>
                    <td>Prodi</td>
                </b>
            </tr>
            <?php foreach ($query as $data){
                $mhs = Dim::find()->where(['dim_id' => $data->dim_id])->one();
                $prodi = Prodi::find()->where(['ref_kbk_id' => $mhs->ref_kbk_id])->one();
                echo (" <tr style='text-align: left;'>
                            <td>". $idx ."</td>
                            <td>" . $mhs->nim . "</td>
                            <td>" . $mhs->nama . "</td>
                            <td>" . $prodi->kbk_ind . "</td>
                        </tr>");
                $idx++;
            }?>
        </table>
        <p style="text-align: justify;">
            Adalah benar mahasiswa yang masih aktif pada Semester Genap, Tahun Akademik 2017/2018 di Institut Teknologi Del, Sitoluama, Laguboti, Toba Samosir, Sumatera Utara yang akan mewakili Institut Teknologi Del dalam kompetisi <?=$model->nama_lomba?> tersebut.
        </p>
        <p style="text-align: justify;">
            Demikian Surat pengantar  ini dibuat untuk dipergunakan sebagaimana semestinya.
        </p>
        <p>Institut Teknologi Del<br>
            Direktur Pendidikan<br><br><br><br>
            Mariana Simanjuntak, M.Sc.
        </p>

</div>
</body>