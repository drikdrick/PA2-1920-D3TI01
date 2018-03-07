<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmAsrama */

$this->title = 'Create Askm Asrama';
$this->params['breadcrumbs'][] = ['label' => 'Askm Asramas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-asrama-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
