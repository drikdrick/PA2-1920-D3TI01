<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\Ktm */

$this->title = 'Update Pengajuan';
$this->params['breadcrumbs'][] = ['label' => 'Update Pengajuan Kartu Tanda Mahasiswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ktm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formEdit', [
        'model' => $model,
    ]) ?>

</div>
