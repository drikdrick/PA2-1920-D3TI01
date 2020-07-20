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
            <?php $form = ActiveForm::begin();?>
                <div class="col-xs-9" >
                    <?= Html::dropDownList('selectedProdi','',$list_prodi,['class'=>'form-control','prompt' => 'Pilih Prodi'])?>
                </div>
                <div class="col-xs-3" style="margin-bottom:20px">
                    <?= Html::submitButton('Ganti Prodi',['class'=>['btn btn-primary','custom-btn']]);?>
                </div>
                <h2 style="color:#3c8dbc"><b><?= $selectedProdi ?></b></h2>
                
                <?php
                    $dataProvider = new ActiveDataProvider([
                        'query' => KrkmKuliah::find(),
                        'pagination' => [
                            'pageSize' => 10
                        ],

                    ]);

                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' =>[
                            [
                                'attribute' => 'nama_kul_ind',
                                'label' => 'Nama Mata Kuliah'
                            ],
                            'sks',
                            [
                                'attribute' => 'kode_mk',
                                'label' => 'Kode Mata Kuliah'
                            ],
                            // [
                            //     'attribute' => 'status',
                            //     'value' => function($data,$key,$index,$column){
                            //         if($data->status == -1){
                            //             return 'menunggu';
                            //         }
                            //         else if($data->status == 0){
                            //             return 'ditolak';
                            //         }
                            //         else if($data->status == 1){
                            //             return 'diterima';
                            //         }
                            //     },
                            // ],
                            // [
                                 return Html::a('<span class="btn btn-success btn-sm"><b class="">Approve</b></span>',['Approve', 'id' => $model['id_request']], ['title' => 'Approve', 'id_request' => 'modal-btn-view']);
                            // ],
                            // [
                            //     'attribute' => 'pengajar_id',
                            //     'label' => 'Dosen I',
                            //     'filter' => $form->field($model,'singkatan_prodi')->dropDownList($list_prodi)
                            // ],
                        ]
                    ]);
                    
                ?>

                <?= Html::a('Submit',['/user/penugasan-dosen'],['class'=>['col-xs-5','btn btn-success','custom-btn']])?>
            <?php $form = ActiveForm::end(); ?>
    </body>
</html>
