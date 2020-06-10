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
                 
                <div class="form-group">  
                     <form name="add_name" id="add_name">  
                          <div class="table-responsive">  
                               <table class="table table-bordered" id="dynamic_field" style="width: 70%">  
                                    <tr>
                                    	<td>Nama Dosen</td>
                                    	<td>Mata Kuliah</td>
                                    	<td></td>
                                    </tr>	
                                    <tr> 
                                        <td>
                                        	<div class="form-group">
                                             <select name="dosen" class="form-control">
                                                  <option>Pilih Dosen</option>
                                                  <?php foreach($list_pengajar as $pegawai){?>
                                                       <option><?= $pegawai->pengajar_id ?></option>
                                                  <?php }?>
                                             </select>
                                    		</div>
                                    	</td>  
                                        <td>
                                        	<div class="form-group">
                                             <select name="dosen" class="form-control">
                                                  <option>Pilih Mata Kuliah</option>
                                                  <?php foreach($krkm_kuliah as $matkul){?>
                                                       <option><?= $matkul->nama_kul_ind ?></option>
                                                  <?php }?>
                                             </select>
                                    		</div>
                                    	</td>   
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                    </tr>  
                               </table>  
                               <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                     </form>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'">'+'<td>'+
                                        '<div class="form-group">'+
                                             '<select name="dosen" class="form-control">'+
                                                  '<option>Pilih Dosen</option>'+
                                                  "<?php foreach($list_pengajar as $pegawai){ ?>"+
                                                       '<option><?= $pegawai->pengajar_id ?></option>'+
                                                  "<?php }?>"+
                                             '</select>'+
                                    		'</div>'+
                                    	'</td>'+
                                        '<td>'+
                                        	'<div class="form-group">'+
                                             '<select name="dosen" class="form-control">'+
                                                  '<option>Pilih Mata Kuliah</option>'+
                                                  "<?php foreach($krkm_kuliah as $matkul){?>"+
                                                       '<option><?= $matkul->nama_kul_ind ?></option>'+
                                                  "<?php }?>"+
                                             '</select>'+
                                    		'</div>'+
                                    	'</td>'+
                                         '<td>'+
                                         '<button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">'+
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