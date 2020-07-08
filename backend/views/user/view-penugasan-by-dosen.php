<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;
    use yii\data\ActiveDataProvider;
    use app\models\KrkmKuliah;
    use yii\widgets\Pjax;
    use yii\db\Query;
    //use yii\console\widgets\Table;
    //$table = new Table();
?>
<html>
    <head>
        <title>Pengajuan RPP</title>
        <style>
            th{
                height: 40px;
                text-align: center;
                color: #3c8dbc;
                padding: 5px;
            }
            td{
                padding: 10px;
                text-align: center;
            }
            table{
                border: 1px solid #d2d6de;
            }
            select{
                border: 1px solid #d2d6de;
            }
        </style>
    </head>
    <body>
        <h2 style="color: #3c8dbc;"><b>Detail Penugasan Dosen</b></h2>
        <?php $form = ActiveForm::begin(); ?>
            <table style="width:100%;" border="1">
                <tr style="background : #f0f0f0">
                    <th rowspan="2">Kode Mata Kuliah</th>
                    <th rowspan="2">Nama Mata Kuliah</th>
                    <th colspan="3">SKS</th>
                    <th colspan="3">Kelas</th>
                    <th colspan="2">Dosen</th>
                    <th colspan="2">TA</th>
                </tr>
                <tr style="background : #f0f0f0">
                    <th>Teori</th>
                    <th>Praktikum</th>
                    <th>Total</th>
                    <th>Riil</th>
                    <th>Tatap Muka</th>
                    <th>Praktikum</th>
                    <th>Dosen</th>
                    <th>Beban</th>
                    <th>TA</th>
                    <th>Beban</th>
                </tr>
                <?php 
                    $i = 0; 
                    foreach($list_matkul as $matkul){
                        if($i % 2 == 0){
                            $warna = '#f9f9f9';
                        }
                        else{
                            $warna = '#ffffff';
                        }
                    ?>
                <tr style="background: <?= $warna ?>">
                    <td><?= $matkul['kode_mk'] ?></td>
                    <td><?= $matkul['nama_kul_ind'] ?></td>
                    <td><?= $matkul['sks_teori'] ?></td>
                    <td><?= $matkul['sks_praktikum'] ?></td>
                    <td><?= $matkul['sks'] ?></td>
                    <td><?= $matkul['kelas_riil'] ?></td>
                    <td><?= $matkul['kelas_tatap_muka'] ?></td>
                    <td><?= $matkul['kelas_praktikum'] ?></td>
                    <td><?= 'LMG' ?></td>
                    <td><?= '50%' ?></td>
                    <td><?= 'RDS' ?></td>
                    <td><?= '100%' ?></td>
                </tr>
                <?php ++$i; }?>
            </table>
            <br>
        <?php $form = ActiveForm::end(); ?>
    </body>
</html>