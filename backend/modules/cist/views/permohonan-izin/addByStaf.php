<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\PermohonanIzin */

$this->title = 'Buat Permohonan Izin';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Izin', 'url' => ['index-by-staf']];
$this->params['breadcrumbs'][] = $this->title;
$uiHelper=\Yii::$app->uiHelper;
?>
<div class="permohonan-izin-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $uiHelper->renderLine(); ?>

    <?= $this->render('_form', [
        'model' => $model,
        'namaAtasan' => $namaAtasan,
    ]) ?>

</div>
