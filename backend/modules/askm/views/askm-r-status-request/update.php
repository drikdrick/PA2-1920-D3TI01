<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmRStatusRequest */

$this->title = 'Update Askm Rstatus Request: ' . $model->status_request_id;
$this->params['breadcrumbs'][] = ['label' => 'Askm Rstatus Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->status_request_id, 'url' => ['view', 'id' => $model->status_request_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-rstatus-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
