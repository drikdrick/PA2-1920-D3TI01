<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\AskmRStatusRequest */

$this->title = 'Create Askm Rstatus Request';
$this->params['breadcrumbs'][] = ['label' => 'Askm Rstatus Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="askm-rstatus-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
