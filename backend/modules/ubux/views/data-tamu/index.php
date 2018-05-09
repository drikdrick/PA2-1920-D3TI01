<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\ToolsColumn;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\search\DataTamuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Tamu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-tamu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nik',
            'nama',
            [
                'attribute'=>'waktu_kedatangan',
                'format' => ['date', 'php:d M Y H:i:s'],
              ],
            
            
            [
                'attribute'=>'desc',
                'label'=>'Deskripsi',
                'value'=>'desc',
            ],
            
            [
                'attribute'=>'waktu_kembali',
                'label' => 'Waktu Kembali',
                'format'=> 'raw',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'value'=>function($model,$index,$key){
                    if($model->waktu_kembali==NULL){
                        return '-';
                    }
                    else{
                        return Yii::$app->formatter->asDateTime($model->waktu_kembali, 'php:d M Y H:i:s');
                    }
                }
            ],
            // 'deleted',
            // 'deleted_at',
            // 'deleted_by',
            // 'created_by',
            // 'created_at',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'common\components\ToolsColumn',
             'template' => '{view} {delete}',
             'buttons' => [
                 'delete' => function ($url, $model){
                         return "<li>".Html::a('<span class="fa fa-trash"></span> Delete', $url, [
                             'title' => Yii::t('yii', 'Hapus'),
                             'data-confirm' => Yii::t('yii', 'Are you sure to delete the data ?'),
                             'data-method' => 'post',
                              'data-pjax' => '0',
                         ])."</li>";
                 },
             ],
             'urlCreator' => function ($action, $model, $key, $index){
                if ($action === 'delete') {
                    return Url::toRoute(['tamu-del', 'id' => $key]);
                }
                if($action === 'view'){
                    return Url::toRoute(['tamu-view','id'=>$key]);
                }
            }
            ],
        ],
    ]); ?>

</div>
