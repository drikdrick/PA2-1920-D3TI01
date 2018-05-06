<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DataTamu */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Data Tamus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-tamu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['tamu-del', 'id' => $model->data_tamu_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nik',
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
