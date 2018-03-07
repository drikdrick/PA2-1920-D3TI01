<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmAsrama */

$this->title = 'Update Askm Asrama: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Askm Asramas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->asrama_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-asrama-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
