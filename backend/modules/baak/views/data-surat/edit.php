<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\DataSurat */

$this->title = 'Update Data Surat';
$this->params['breadcrumbs'][] = ['label' => 'Manajemen Data Surat', 'url' => ['view', 'id' => $model->data_surat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-surat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
