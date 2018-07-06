<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\ubux\models\DataTamu */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Data Tamu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-tamu-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'nik',                
                'value'=>function($model){
                    if($model->nik==NULL){
                        return '-';
                    }
                    else{
                       return $model->nik;
                    }
                }
            ],
            'nama',
            [
                'attribute'=>'waktu_kedatangan',
                'format' => ['date', 'php:d M Y H:i:s'],
              ],
            
            
            [
                'attribute'=>'desc',
                'label'=>'Deskripsi',
                'value'=>$model->desc,
            ],
            
            [
                'attribute'=>'waktu_kembali',
                'label' => 'Waktu Kembali',
                'format'=> 'raw',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'value'=>function($model){
                    if($model->waktu_kembali==NULL){
                        return '-';
                    }
                    else{
                        return Yii::$app->formatter->asDateTime($model->waktu_kembali, 'php:d M Y H:i:s');
                    }
                }
            ],
        ],
    ]) ?>

</div>
