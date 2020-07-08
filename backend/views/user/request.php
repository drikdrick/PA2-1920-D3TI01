<?php
     use yii\widgets\ActiveForm;
     use yii\helpers\Html;
?>

<html>  
      <head>  
           <title>Dynamically Add or Remove input fields in PHP with JQuery</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <div class="container">  
                <br />  
                <br />  
               <?php ?>
                <div class="form-group">  
                    <?php $form = ActiveForm::begin(['id' => 'request_dosen']); ?>
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field" style="width: 70%">  
                                    <tr>
                                    	<td>Nama Dosen</td>
                                        <td>Mata Kuliah</td>
                                        <td>Prodi Tujuan</td>
                                    	<td></td>
                                    </tr>	
                                    <tr> 
                                        <td>
                                        	<div class="form-group">
                                             <select name="nama_dosen_1" class="form-control" required>
                                                  <option value="">Pilih Dosen</option>
                                                  <?php foreach($list_dosen as $pegawai){?>
                                                       <option value="<?= $pegawai['pengajar_id'] ?>"><?= $pegawai['nama_pegawai'] ?></option>
                                                  <?php }?>
                                             </select>
                                    		</div>
                                    	</td>  
                                        <td>
                                        	<div class="form-group">
                                             <select name="matkul_1" class="form-control" required>
                                                  <option value="">Pilih Mata Kuliah</option>
                                                  <?php foreach($krkm_kuliah as $matkul){?>
                                                       <option value="<?= $matkul['kode_mk'] ?>"><?= $matkul->nama_kul_ind ?></option>
                                                  <?php }?>
                                             </select>
                                    		</div>
                                         </td>
                                         <td>
                                        	<div class="form-group">
                                             <select name="prodi_1" class="form-control" required>
                                                  <option value="">Pilih prodi</option>
                                                  <?php foreach($all_prodi as $prodi){?>
                                                       <option value="<?= $prodi->ref_kbk_id ?>"><?= $prodi->singkatan_prodi ?></option>
                                                  <?php }?>
                                             </select>
                                    		</div>
                                    	</td>   
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                    </tr>  
                               </table>
                               <?= Html::submitButton('Submit',['class'=>['col-xs-1','btn btn-primary','custom-btn']]);?>
                          </div>  
                    <?php $form = ActiveForm::end(); ?>                         
                </div>
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      var i=1;
      var j=1;  
      $('#add').click(function(){  
           j++;
           $('#dynamic_field').append('<tr id="row'+j+'">'+'<td>'+
                                        '<div class="form-group">'+
                                             '<select name="nama_dosen_'+(++i)+'" class="form-control" required>'+
                                                  '<option>Pilih Dosen</option>'+
                                                  "<?php foreach($list_dosen as $pegawai){ ?>"+
                                                       '<option value="<?= $pegawai['pengajar_id'] ?>"><?= $pegawai['nama_pegawai'] ?></option>'+
                                                  "<?php }?>"+
                                             '</select>'+
                                    		'</div>'+
                                    	'</td>'+
                                        '<td>'+
                                        	'<div class="form-group">'+
                                             '<select name="matkul_'+i+'" class="form-control" required>'+
                                                  '<option>Pilih Mata Kuliah</option>'+
                                                  "<?php foreach($krkm_kuliah as $matkul){?>"+
                                                       '<option value="<?= $matkul['kode_mk'] ?>"><?= $matkul->nama_kul_ind ?></option>'+
                                                  "<?php }?>"+
                                             '</select>'+
                                    		'</div>'+
                                    	'</td>'+
                                        '<td>'+
                                        	'<div class="form-group">'+
                                             '<select name="prodi_'+i+'" class="form-control" required>'+
                                                  '<option value="">Pilih prodi</option>'+
                                                  "<?php foreach($all_prodi as $prodi){?>"+
                                                       '<option value="<?= $prodi->ref_kbk_id ?>"><?= $prodi->singkatan_prodi ?></option>'+
                                                  "<?php }?>"+
                                             '</select>'+
                                    		'</div>'+
                                    	'</td>'+
                                         '<td>'+
                                         '<button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_remove">'+
                                         'X</button></td>'+
                                         '</tr>');
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>