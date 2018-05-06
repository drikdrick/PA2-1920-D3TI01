<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Posisi */

$this->title = 'Update Posisi: ' . ' ' . $model->posisi_id;
$this->params['breadcrumbs'][] = ['label' => 'Posisis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->posisi_id, 'url' => ['view', 'id' => $model->posisi_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="posisi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
