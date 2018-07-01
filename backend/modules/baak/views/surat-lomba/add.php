<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\SuratLomba */

$this->title = 'Request Surat Kompetisi';
$this->params['breadcrumbs'][] = ['label' => 'Surat Kompetisi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-lomba-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formAdd', [
        'model' => $model,
        'dim' => $dim,
    ]) ?>

</div>
