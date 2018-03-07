<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmRuangan */

$this->title = 'Create Askm Ruangan';
$this->params['breadcrumbs'][] = ['label' => 'Askm Ruangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-ruangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
