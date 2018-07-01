<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratPengantarPa */

$this->title = 'Request Surat Pengantar Proyek';
$this->params['breadcrumbs'][] = ['label' => 'Surat Pengantar Proyek', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-pengantar-proyek-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formAdd', [
        'model' => $model,
        'dim' => $dim,
    ]) ?>

</div>
