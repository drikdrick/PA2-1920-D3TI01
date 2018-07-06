<?php 
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Hapus kamar';
$this->params['header'] = $this->title;

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
 			<p>Anda akan menghapus kamar</p>
 			<p>Apakah anda ingin melanjutkan ?</p>
 		</div>
	 	<div class="text-center">
	 		<a href="<?=Url::toRoute(['index', 'KamarSearch[asrama_id]' => $_GET['id_asrama'], 'id_asrama' => $_GET['id_asrama']]) ?>" class="btn btn-sm btn-warning">Cancel</a>
	 		<a href="<?=Url::toRoute(['del-kamar', 'id'=>$id, 'confirm' => 1, 'id_asrama' => $_GET['id_asrama']]) ?>" class="btn btn-sm btn-danger">Confirm Delete</a>
	 	</div>
 	</div>
 </div>