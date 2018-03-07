<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\askm\models\AskmRStatusRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Askm Rstatus Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-rstatus-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Askm Rstatus Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'status_request_id',
            'status_request',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
