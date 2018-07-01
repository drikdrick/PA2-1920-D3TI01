<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use backend\modules\baak\models\Dim;
    use backend\modules\baak\models\JenisKelamin;
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
        $awal = $model->waktu_awal_magang;
        $akhir = $model->waktu_akhir_magang;

        $getMonth = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');        

        $month = $getMonth[date('n', strtotime($tanggal_surat))-1];
        $monthAwal = $getMonth[date('n', strtotime($awal))-1];
        $monthAkhir = $getMonth[date('n', strtotime($akhir))-1];

        $tgl_surat .=  date('d', strtotime($model->tanggal_surat)) .' '.$month .' '.date('Y', strtotime($model->tanggal_surat));
        $tgl_awal .=  date('d', strtotime($model->waktu_awal_magang)) .' '.$monthAwal .' '.date('Y', strtotime($model->waktu_awal_magang));
        $tgl_akhir .=  date('d', strtotime($model->waktu_akhir_magang)) .' '.$monthAkhir .' '.date('Y', strtotime($model->waktu_akhir_magang));
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
        <p style="text-align: justify;">
            Kepada Yth,<br>Bapak/Ibu<br>
            <?=$model->nama_perusahaan?><br><?=$model->alamat_perusahaan?>
        </p>
        <p style="text-align: justify;">Dengan Hormat,<br>
            Institut Teknologi Del (IT Del) yang beralamat di Sitoluama Toba Samosir Sumatera Utara menyelenggarakan program pendidikan, terdiri dari 3 (tiga) Fakultas dengan 8 (delapan Program Studi), yakni: </p>
        <table border='0'>
            <tr>
                <td><b>I.</td>
                <td><b>Fakultas Teknik Informatika & Elektro [FTIE], Program Studi:</td>
                
            </tr>
            <tr>
                <td></td>
                <td>1)  Teknik Informatika (S1)</td>
            <tr> 
            <tr>
                <td></td>
                <td>2)  Teknik Elektro (S1)</td>
            <tr>            <tr>
                <td></td>
                <td>3)  Sistem Informasi (S1)</td>
            <tr>
            <tr>
                <td></td>
                <td>4)  Teknik Informatika (DIV)</td>
            <tr>
            <tr>
                <td></td>
                <td>5)  Teknik Informatika (D3)</td>
            <tr>
            <tr>
                <td></td>
                <td>6)  Teknik Komputer (D3)</td>
            <tr>
            <tr>
                <td><b>II.</td>
                <td><b>Fakultas Teknologi Industri [FTI], Program Studi: </td>
            </tr>
            <tr>
                <td></td>
                <td>1)  Manajemen Rekayasa (S1)</td>
            <tr>
            <tr>
                <td><b>III.</td>
                <td><b>Fakultas Bioteknologi [FB], Program Studi: </td>
            </tr>
            <tr>
                <td></td>
                <td>1)  Teknik Bioproses (S1)</td>
            <tr>
        </table>

        <p style="text-align: justify;">Sesuai kalender akademik IT Del, mahasiswa pada program studi tersebut melaksanakan libur akhir tahun akademik semester genap
            Pada masa libur mahasiswa atas inisiasi sendiri dapat melaksanakan magang sebagai bagian dari proses belajar menggunakan masa libur untuk menambah pengalaman dan pengetahuan.</p>

        <p style="text-align: justify;">Terkait dengan hal tersebut terdapat mahasiswa IT Del yaitu:</p>
        <table border="1" align="center">
            <tr>
                <b>
                    <td>No</td>
                    <td>NIM</td>
                    <td>Nama Mahasiswa</td>
                    <td>Jenis Kelamin</td>
                </b>
            </tr>
            <?php foreach ($query as $data){
                $mhs = Dim::find()->where(['dim_id' => $data->dim_id])->one();
                $prodi = Prodi::find()->where(['ref_kbk_id' => $mhs->ref_kbk_id])->one();
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
        <p style="text-align: justify;">bermaksud mengajukan permohonan untuk dapat melaksanakan program magang di <?=$model->nama_perusahaan?> dengan perkiraan waktu magang pada <?=$tgl_awal?> - <?=$tgl_akhir?>.</p>
        <p style="text-align: justify;">Besar harapan kami, Bapak/ Ibu dapat mengabulkan permohonan mahasiswa kami.</p>

       <p style="text-align: justify;">Atas perhatian dan tanggapan Bapak/ Ibu, kami sampaikan terimakasih dan penghargaan kami.</p>

        <p>Institut Teknologi Del<br>
            Direktur Pendidikan<br><br><br><br>
            Mariana Simanjuntak, M.Sc.
        </p>

</div>
</body>