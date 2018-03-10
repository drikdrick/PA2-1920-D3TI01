<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\DataPaket */

$this->title = 'Create Data Paket';
$this->params['breadcrumbs'][] = ['label' => 'Data Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-paket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
