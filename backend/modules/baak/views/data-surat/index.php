<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\components\ToolsColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\baak\models\search\DataSuratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manajemen Data Surat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-surat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama_institut',
            'alamat:ntext',
            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {edit}',
                'header' => 'Action',
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view', 'id' => $key]);
                    } 
                    if ($action === 'edit') {
                        return Url::toRoute(['edit', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>
</div>
