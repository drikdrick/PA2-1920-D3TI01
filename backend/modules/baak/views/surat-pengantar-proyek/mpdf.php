<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use backend\modules\baak\models\Dim;
    use backend\modules\baak\models\JenisKelamin;
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
                    <img src="<?=Yii::$app->getRequest()->getHostInfo().'/img/logo.jpg'?>" style="width: 100px; width: 100px;">
                </td>
                <td style="width: 600px;" class="tengah">
                    <h2><?=strtoupper($header->nama_institut) ?></h2>
                </td>
            </tr>
            <tr>
                <td class="tengah">
                    <p><?=$header->alamat ?>
                        Telp.: <?=$header->nomor_telepon ?>, Fax.: <?=$header->nomor_fax ?><br>
                        <u><?=$header->email ?></u>, <u><?=$header->alamat_web ?></u>
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
                <td><?=$model->perihal_surat?></td>
            </tr>
        </table>
        <p>Yang Terhormat<br>
        <b>Bapak/Ibu Pemilik <?=$model->alamat_tujuan?></b><br>
        di Tempat</p>
        <p style="text-align:justify;">Dengan Hormat,</p>
        <p style="text-align:justify;">Sesuai dengan kurikulum yang saat ini berlaku di Institut Teknologi Del (IT Del) mahasiswa IT Del  Program Studi <?=$prodi->kbk_ind?> wajib mengikuti mata kuliah ”<?=$kuliah->nama_kul_ind?>”
           yang menghasilkan karya nyata, yaitu produk Teknologi Informasi yang dibangun dengan 
           menerapkan ilmu yang sudah mereka pelajari di IT Del. </p>

        <p style="text-align:justify;">Untuk melaksanakan <?=$kuliah->nama_kul_ind?> tersebut, mahasiswa memerlukan narasumber yang dapat memberikan informasi sebagai dasar untuk merumuskan kajian yang akan mereka tangani.</p>

         <p style="text-align:justify;">Sehubungan dengan hal tersebut, terdapat kelompok mahasiswa yang ingin melakukan survey ke <?=$model->alamat_tujuan?>.Berikut nama-nama mahasiswa tersebut:</p>
        <table border="1" align="center" style="width: 100%">
            <tr>
                <b>
                    <td>No</td>
                    <td>NIM</td>
                    <td>Nama</td>
                    <td>Jenis Kelamin</td>
                </b>
            </tr>
            <?php foreach ($query as $data){
                $mhs = Dim::find()->where(['dim_id' => $data->dim_id])->one();
                $jk = JenisKelamin::find()->where(['jenis_kelamin_id' => $mhs->jenis_kelamin_id])->one();
                if($jk->nama != null){
                    $jenis = $jk->nama;
                }
                else{
                    $jenis = $mhs->jenis_kelamin;
                }
                echo (" <tr style='text-align: left;'>
                            <td>". $idx ."</td>
                            <td>" . $mhs->nim . "</td>
                            <td>" . $mhs->nama . "</td>
                            <td>" . $jenis . "</td>
                        </tr>");
                $idx++;
            }?>
        </table>
        <p style="text-align:justify;">Demikian kami sampaikan permohonan ini, atas perhatian dan tanggapan baik Bapak/Ibu kami sampaikan terimakasih.</p>
        <p>Sitoluama, <?=$tgl_surat?></p>

        <p>Institut Teknologi Del<br>
            Direktur Pendidikan<br><br><br><br>
            Mariana Simanjuntak, M.Sc.
        </p>

</div>
</body>