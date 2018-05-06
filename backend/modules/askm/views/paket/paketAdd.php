<?php

use yii\helpers\Html;
use backend\modules\ubux\models\PosisiPaket;

/* @var $this yii\web\View */
/* @var $model backend\modules\askm\models\Paket */

$this->title = 'Create Paket';
$this->params['breadcrumbs'][] = ['label' => 'Pakets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
