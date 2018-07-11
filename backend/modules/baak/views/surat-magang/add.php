<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Request Surat Magang';
$this->params['breadcrumbs'][] = ['label' => 'Surat Magang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat', 'url' => ['view', 'id' => $model->surat_magang_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-magang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formAdd', [
        'model' => $model,
        'dim' => $dim,
        
    ]) ?>

</div>
