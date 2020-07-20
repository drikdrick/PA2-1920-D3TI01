<?php
/* @var $this yii\web\View */
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\grid\GridView;

    defined('YII_ENV') or define('YII_ENV', 'dev');
?>
<html>
    <head>
        <title>Detail Matkul Dosen</title>
        <style>
            td,th{
                text-align: center;
            }
            table{
                border: 1px solid #d2d6de;
            }
        </style>
    </head>
    <body>
        <h2>Detail Matkul Dosen</h2>
        <table style="width:100%;" border="1">
            <tr style="background : #f0f0f0">
                <th rowspan="2">Kode Mata Kuliah</th>
                <th rowspan="2">Nama Mata Kuliah</th>
                <th colspan="3">SKS</th>
                <th colspan="3">Kelas</th>
            </tr>
            <tr style="background : #f0f0f0">
                <th>Teori</th>
                <th>Praktikum</th>
                <th>Total</th>
                <th>Riil</th>
                <th>Tatap Muka</th>
                <th>Praktikum</th>
            </tr>
            <?php 
                $i = 0; 
                $ctr = 0;
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
            </tr>
            <?php ++$i; }?>
        </table>
        <h2>Koordinator</h2>
        
        <?php
            // echo  GridView::widget([
            //             'dataProvider' => $dataProvider,
            //             'columns' =>[
            //           [
            //               'attribute' => 'kode_mk',
            //               'label' => 'Kode Mata Kuliah'
            //           ],
            //           [
            //               'attribute' => 'nama_kul_ind',
            //               'label' => 'Nama Mata Kuliah'
            //           ],
            //           'sks',
            //           [   
            //               'class' => 'yii\grid\ActionColumn',
            //               'template' => '{Approve}  {Decline}',
            //               'buttons' => 
            //                     [
            //                         'Approve' => function($url, $model) {
            //                         return Html::a('<span class="btn btn-success btn-sm"><b class="">Isi Request</b></span>',
            //                                     ['/user/detail-matkul' , 'kode_mk' => $model['kode_mk']], 
            //                                     ['title' => 'Approve', 
            //                                     'kode_mk' => 'modal-btn-view']);
            //                         },
            //                     ]
            //           ],
            //       ]
            //     ]);
            ?>
            <br>

    </body>
</html>

