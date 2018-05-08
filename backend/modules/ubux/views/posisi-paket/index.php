<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\ToolsColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\ubux\models\search\PosisiPaketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posisi Paket';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posisi-paket-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Posisi Paket', ['posisi-paket-add'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'posisi_paket_id',
            'name',
            //'deleted',
            //'deleted_at',
            //'deleted_by',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            ['class' => 'common\components\ToolsColumn',
             'template' => '{update} {delete}',
             'buttons' => [
                 'update' => function ($url, $model){
                     $url = 'posisi-paket-edit?id='.$model->posisi_paket_id;
                     return ToolsColumn::renderCustomButton($url, $model, 'Edit', 'fa fa-pencil');
                 },
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
                     return Url::toRoute(['posisi-paket/posisi-paket-del', 'id' => $key]);
                 }
                 if ($action === 'update') {
                     return Url::toRoute(['posisi-paket/posisi-paket-edit', 'id' => $key]);
                 }
             }
        ],
        ],
    ]); ?>

</div>
