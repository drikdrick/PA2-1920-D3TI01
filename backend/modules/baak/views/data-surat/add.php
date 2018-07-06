<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\baak\models\DataSurat */

$this->title = 'Create Data Surat';
$this->params['breadcrumbs'][] = ['label' => 'Data Surats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-surat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
