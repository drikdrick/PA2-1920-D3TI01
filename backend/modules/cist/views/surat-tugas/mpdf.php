<?php
use yii\helpers\Html;
?>
<!doctype html>
<html>
    <head>
        <title></title>
    </head>
<?php 
    $id = $_GET['id'];
	list($tanggalBerangkat, $pukulBerangkat) = explode(' ', $model->tanggal_berangkat);
	list($tanggalKembali, $pukulKembali) = explode(' ', $model->tanggal_kembali);
?>
    <body>
        <table 	style ="width:100%">
            <tr>
                <th>
					<?= Html::img(Yii::getAlias('@web').'/images/logo.png', ['style' => 'width:90px;']) ?>
				</th>
                <td style="text-align: center">
                	<div >
                		<h3>INSTITUT TEKNOLOGI DEL</h3>
                		<p>JL. Sisingamangaraja, Laguboti 22381<br>
                		Toba Samosir, Sumatera Utara, Laguboti, 22381<br>
                		Telp.: (0632) 331234, Fax.: (0632) 331116<br>
                		<u>info@del.ac.id, www.del.ac.id</u>
                		</p>
                	</div>
                </td>
            </tr>
        </table>
        <hr>
        <p style="text-align: center;">
        	<b>Surat Tugas Perjalanan Dinas</b><br>
        	No: <?= $model->no_surat ?>
        </p>
        <p style="text-align: justify">
            Wakil Rektor Bidang Perencanaan, Keuangan, dan Sumber Daya Institut Teknologi Del(IT Del) dengan ini memberikan tugas kepada:
        </p>
        <table border="1" style="width: 100%">
            <tr >
            	<th style="text-align: left;">No</th>
            	<th style="text-align: left;">Nama</th>
            	<th style="text-align: left;">Jabatan</th>
            	<th style="text-align: left;">NIP/NIDN</th>
            </tr>
			<?php
				$idx = 1;
				foreach($pesertas as $peserta){
					echo ("	<tr style='text-align: left;'>
								<td>". $idx ."</td>
								<td>" . $peserta->nama . "</td>
								<td>". $peserta->posisi ."</td>
								<td>" . $peserta->nip . "</td>
							</tr>");
					$idx++;
				}
			?>
            
        </table>

        <p style="text-align: justify;">Untuk mengikuti pelaksanaan , pada:</p>
        <br>
        <table style="margin-left: 60px;">
        	<tr>
        		<td>Tanggal</td>
        		<td>:</td>
        		<td><?= date('d M Y', strtotime($tanggalBerangkat)) . " - " . date('d M Y', strtotime($tanggalKembali)) ?></td>
        	</tr>
        	<tr>
        		<td>Pukul</td>
        		<td>:</td>
        		<td><?= $pukulBerangkat . " Wib - selesai" ?></td>
        	</tr>
        	<tr>
        		<td>Alamat</td>
        		<td>:</td>
        		<td><?= $model->tempat ?></td>
        	</tr>
        	<tr>
        		<td>Agenda</td>
        		<td>:</td>
        		<td><?= $model->agenda ?></td>
        	</tr>
        </table>

        <p style="text-align: justify;">Untuk persiapan dan pelaksanaan, nama yang tersebut dalam surat tugas berangkat dari IT Del ke <?= $row['tempat'] ?>, pada tanggal <?= date('d M Y', strtotime($tanggalBerangkat)) ?> pukul: <?= $pukulBerangkat ?> Wib. Kembali ke IT Del pada tanggal <?= date('d M Y', strtotime($tanggalKembali)) ?> pukul: <?= $pukulKembali ?>Wib.
        <br><br>
        Saudara/i yang tersebut dalam surat tugas, diminta melakukan pengalihan tugas kepada rekan kerja selama dinas luar, dan kembali aktif bekerja pada tanggal <?= date('d M Y', strtotime($tanggalKembali)) ?>. Dan melaporkan hasil pelaksanaan tugas, paling lambat 2(dua) hari setelah penugasan.
        <br><br>
        Berkaitan dengan penugasan ini, biaya perjalanan dinas yang ditanggung adalah :
        </p>

        <table border="1">
			<?php
				$datediff = strtotime($model->tanggal_kembali) - strtotime($model->tanggal_berangkat);
				$penginapan = round($datediff / (60 * 60 * 24)) - 1;
				$allowance = $penginapan + 1;
			?>
			<tr>
        		<td>1</td>
        		<td>Transportasi</td>
				<td><?= $model->transportasi ?></td>
        	</tr>
			<tr>
				
        		<td>2</td>
        		<td>Penginapan</td>
				<td><?= $penginapan ?> hari</td>
        	</tr>
        	<tr>
        		<td>3</td>
        		<td>Allowance</td>
        		<td><?= $allowance ?> hari</td>
        	</tr>
        </table>

        <p>Catatan : <?= $model->catatan ?><br>
		<?php $today = time(); ?>
		Sitoluama, <?= date('d M Y'); ?>
		<br>
		Plh Wakil Rektor Bidang Perencanaan, Keuangan, dan Sumber Daya
		<br><br><br><br><br><br>
		Christoper JS. Sinaga, ST., MAB 
</body>
</html>