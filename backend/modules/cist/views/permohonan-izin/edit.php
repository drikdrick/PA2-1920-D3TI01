<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\PermohonanIzin */

$this->title = 'Update Permohonan Izin: ' . ' ' . $model->permohonan_izin_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_izin_id, 'url' => ['view', 'id' => $model->permohonan_izin_id]];
$this->params['breadcrumbs'][] = 'Update';
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="kategori-izin-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
