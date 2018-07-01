<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Alert;

$this->title = 'Kesalahan';
?>
<div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Alert::widget([
        'options' => [
            'class' => 'alert-danger',
        ],
        'body' => 'Tidak Bisa Mengubah atau Menghapus karena Sudah Disetujui atau Ditolak',
    ]);
    ?>
    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-success']) ?>

</div>
