<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cist\models\PermohonanIzin */

$this->title = 'Form Permohonan Izin';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Izin', 'url' => ['index-by-wr2']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['header'] = $this->title;
?>
<div class="permohonan-izin-create">

    <?= $this->render('_formByWr2', [
        'model' => $model,
        'namaPegawai' => $namaPegawai,
    ]) ?>

</div>
