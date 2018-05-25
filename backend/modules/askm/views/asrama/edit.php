<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Asrama */

$this->title = 'Edit Asrama: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Asramas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->asrama_id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="asrama-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
