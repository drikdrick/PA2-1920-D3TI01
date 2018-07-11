<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratLomba */

$this->title = 'Update Surat Kompetisi';
$this->params['breadcrumbs'][] = ['label' => 'Surat Kompetisi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat', 'url' => ['view', 'id' => $model->surat_lomba_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-lomba-update">

    <h1></h1>

    <?= $this->render('_formEdit', [
        'model' => $model,
    ]) ?>

</div>
