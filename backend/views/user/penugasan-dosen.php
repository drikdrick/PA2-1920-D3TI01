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
        <div class="col-xs-12">
            <h2>Semester 2</h2>
            
        </div>
        <div class="col-xs-9">
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model,'singkatan_prodi')->dropDownList($list_prodi)?>
                
                <table style="width:100%;" border="1">
                    <tr style="background : #f9f9f9">
                        <th>Nama Mata Kuliah</th>
                        <th>Jumlah SKS</th>
                        <th>Kode MK</th>
                        <th>Dosen I</th>
                        <th>Dosen II</th>
                    </tr>
                    <?php 
                        $i = 0; 
                        foreach($krkm_kuliah as $matkul){
                            if($i % 2 == 0){
                                $warna = '#f9f9f9';
                            }
                            else{
                                $warna = '#ffffff';
                            }
                        ?>
                    <tr style="background: <?= $warna ?>">
                        <td><?= $matkul->nama_kul_ind ?></td>
                        <td><?= $matkul->sks ?></td>
                        <td><?= $matkul->kode_mk ?></td>
                        <td>
                            <select name="dosen1" class="form-control">
                                <option>Pilih Dosen</option>
                                <?php foreach($list_pengajar as $pegawai){?>
                                    <option><?= $pegawai->pengajar_id ?></option>
                                <?php }?>
                            </select>
                        </td>
                        <td>
                            <select name="dosen2" class="form-control">
                                <option>Pilih Dosen</option>
                                <?php foreach($list_pengajar as $pegawai){?>
                                    <option><?= $pegawai->pengajar_id ?></option>
                                <?php }?>
                            </select>
                        </td>
                        </td>
                    </tr>
                    <?php ++$i; }?>
                </table>
            <?php $form = ActiveForm::end(); ?>
        </div>
        <div clas="col-xs-3">
            <h3>Load Dosen</h3>
            <table border="1">
                <tr>
                    <th >Kode Dosen</th>
                    <th width="2%">NIP</th>
                    <th >Load</th>
                </tr>
                <?php foreach($pegawai_pengajar as $pp){?>
                    <tr>
                        <td><?= $pp['pengajar_id'] ?></td>
                        <td><?= $pp['nip'] ?></td>
                        <td>4</td>
                    </tr>
                <?php } ?>
            </table>
            
        </div>
    </body>
</html>
<?php
                    // $dataProvider = new ActiveDataProvider([
                    //     'query' => KrkmKuliah::find(),
                    //     'pagination' => [
                    //         'pageSize' => 10
                    //     ],

                    // ]);

                    // echo GridView::widget([
                    //     'dataProvider' => $dataProvider,
                    //     'columns' =>[
                    //         [
                    //             'attribute' => 'nama_kul_ind',
                    //             'label' => 'Nama Mata Kuliah'
                    //         ],
                    //         'sks',
                    //         [
                    //             'attribute' => 'kode_mk',
                    //             'label' => 'Kode Mata Kuliah'
                    //         ],
                    //         // [
                    //         //     'attribute' => 'status',
                    //         //     'value' => function($data,$key,$index,$column){
                    //         //         if($data->status == -1){
                    //         //             return 'menunggu';
                    //         //         }
                    //         //         else if($data->status == 0){
                    //         //             return 'ditolak';
                    //         //         }
                    //         //         else if($data->status == 1){
                    //         //             return 'diterima';
                    //         //         }
                    //         //     },
                    //         // ],
                    //         // [
                                
                    //         // ],
                    //         // [
                    //         //     'attribute' => 'pengajar_id',
                    //         //     'label' => 'Dosen I',
                    //         //     'filter' => $form->field($model,'singkatan_prodi')->dropDownList($list_prodi)
                    //         // ],
                    //     ]
                    // ]);
                    
                ?>