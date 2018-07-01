<?php 
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Reset Penghuni kamar';
$this->params['header'] = 'Reset Penghuni kamar '.$nomor_kamar;

$this->params['breadcrumbs'][] = "Delete";

//TODO: buat ui helper untuk menampilkan form konfirmasi

 ?>
 <div class="box box-solid">
 	<div class="box-header">
 		<i class="fa fa-warning"></i>
 		<h3 class="box-title">Warning</h3>
 	</div>
 	<div class="box-body">
 		<div class="alert alert-danger">
 			<i class="fa fa-ban"></i>
 			<p>Anda akan mengkosongkan penghuni kamar <?= $nomor_kamar ?></p>
 			<p>Apakah anda ingin melanjutkan ?</p>
 		</div>
	 	<div class="text-center">
	 		<a href="<?=Url::toRoute(['index', 'KamarSearch[asrama_id]' => $_GET['id']]) ?>" class="btn btn-sm btn-warning">Cancel</a>
	 		<a href="<?=Url::toRoute(['reset-kamar', 'id'=>$id, 'confirm' => 1]) ?>" class="btn btn-sm btn-danger">Confirm Delete</a>
	 	</div>
 	</div>
 </div>