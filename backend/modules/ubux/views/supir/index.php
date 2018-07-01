<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\base\Model;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\SupirSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Supir';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supir-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Supir', ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($model){
            if($model->status == 0)
                return ['class' => 'pasif'];
            else return ['class' => 'danger'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'supir_id',
//            'pegawai_id',
            [
                    'attribute' => 'Nama',
                'value' => 'pegawai.nama',
            ],
            'no_telepon_supir',
            [
                    'attribute' => 'Ketersediaan',
                'value' => function(Model $model){
                    if($model->status == 0) return 'Tersedia';
                    else return 'Terpakai';
                }
            ],
//            'deleted',
//            'deleted_at',
            // 'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            [
                'class' => 'common\components\ToolsColumn',
                'template' => '{view}{edit}{del}',
                'urlCreator' => function($action, $model, $key, $index){
                    if($action === 'view'){
                        return Url::toRoute(['view', 'id' => $key]);
                    }
                    if($action == 'edit'){
                        return Url::toRoute(['edit', 'id' => $key]);
                    }
                    if($action == 'del'){
                        return Url::toRoute(['del', 'id' => $key]);
                    }
                    else{
                        return Url::toRoute(['pop-up', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>

</div>
