<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

echo GridView::widget([
    'dataProvider' => $dataProvider,

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        
        [
            'attribute' => 'nama', 
            'label' => 'Nama Dosen'
        ],
        [
            'attribute' => 'alias', 
            'label' => 'Kode Dosen'
        ],
        [
            "attribute" => "kode_mk",
            'label' => 'Kode Matkul'
        ],
        [
            "attribute" => "nama_kul_ind",
            'label' => 'Nama Matkul'
        ],
        [
            'attribute' => 'status_request', 
            'value' =>  function($model){
                if($model['status_request']==1){
                    return 'Disetujui';
                }else if($model['status_request']==-1){
                    return 'Menunggu';
                }else{
                    return 'Ditolak';
                }
              },
        ],            
            

]
]);