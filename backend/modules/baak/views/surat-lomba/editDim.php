<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratMagang */

$this->title = 'Tambah Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Surat Kompetisi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detail Surat', 'url' => ['view', 'id' => $model->surat_lomba_id]];
$this->params['breadcrumbs'][] = 'Tambah Mahasiswa';
?>
<div class="surat-magang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'attributes' => [
            'dims',
        ],
    ]) ?>

    <?= $this->render('_formEditDim', [
        'model' => $model,
        'dim' => $dim,
    ]) ?>

</div>
