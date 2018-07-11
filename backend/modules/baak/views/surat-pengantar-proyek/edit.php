<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarPa */

$this->title = 'Update Surat Pengantar Proyek';
$this->params['breadcrumbs'][] = ['label' => 'Surat Pengantar Proyek', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat', 'url' => ['view', 'id' => $model->surat_pengantar_proyek_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="surat-pengantar-proyek-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEdit', [
        'model' => $model,
    ]) ?>

</div>
