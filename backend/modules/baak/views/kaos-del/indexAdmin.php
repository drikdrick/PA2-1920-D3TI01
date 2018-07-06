<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\components\ToolsColumn;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\baak\models\KaosDelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kaos Del';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kaos-del-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode_ukuran',
            'ukuran',
            [
                'attribute' => 'stok',
                'value' => function($model,$key,$index)
                {
                    if($model->stok ==NULL)
                    {
                        return '-';
                    }
                    return $model->stok;
                }
            ],

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view} {edit}',
                'header' => 'Action',
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view-admin', 'id' => $key]);
                    } 
                    if ($action === 'edit') {
                        return Url::toRoute(['edit', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>

</div>
