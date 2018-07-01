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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'backend\modules\baak\assets\SerialColumn'],

            'ukuran',
            'stok',

            ['class' => 'common\components\ToolsColumn',
                'template' => '{view}',
                'header' => 'Action',
                'urlCreator' => function ($action, $model, $key, $index){
                    if ($action === 'view') {
                        return Url::toRoute(['view', 'id' => $key]);
                    }
                }
            ],
        ],
    ]); ?>

</div>
