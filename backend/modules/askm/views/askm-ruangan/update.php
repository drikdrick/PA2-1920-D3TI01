<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmRuangan */

$this->title = 'Update Askm Ruangan: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Askm Ruangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->ruangan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="askm-ruangan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
