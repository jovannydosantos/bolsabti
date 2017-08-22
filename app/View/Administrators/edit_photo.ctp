<?php 
	$this->layout = 'administrator'; 
?>
<script>
	
	$(document).ready(function() {
		// Verifica el tipo de imagen que se subira
		var file = document.getElementById("AdministratorFilename"); //El input de tipo
		file.addEventListener("change", function(){
			var fileSize = this.files[0].size; //Tamaño del archivo en Bytes
			var mb = 1024, //Cantidad de Bytes en 1 kb
			pesoFinal = fileSize / mb; //Tamaño del archivo en Megabytes
				if(pesoFinal.toFixed(2)>100){
						document.getElementById('AdministratorFilename').value = '';  
						document.getElementById('AdministratorDir').value = '';
						document.getElementById('AdministratorMimetype').value = '';
						document.getElementById('AdministratorFilesize').value = '';
						jAlert('El archivo con: '+pesoFinal.toFixed(2) + ' Kb excede el límite permitido de 100Kb','Mensaje');
						return false;
				} else{
					comprueba_extension();
				}
		}, false
		);
	});
		
		function comprueba_extension() {
				var archivo = document.getElementById('AdministratorFilename').value;
				extensiones_permitidas = new Array(".jpg",".png");
				mierror = "";
			  
				if (!archivo) {
					jAlert ("No has seleccionado ningún archivo","Mensaje");
					document.getElementById("AdministratorFilename").focus();
					return false;
				}else{
					  extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
					  permitida = false;
					  for (var i = 0; i < extensiones_permitidas.length; i++) {
						 if (extensiones_permitidas[i] == extension) {
						 permitida = true;
						 break;
						 }
					  }
					  
					  if (!permitida) {
						document.getElementById('AdministratorFilename').value = '';  
						document.getElementById('AdministratorDir').value = '';
						document.getElementById('AdministratorMimetype').value = '';
						document.getElementById('AdministratorFilesize').value = '';
						jAlert ("Comprueba la extensión de su imagen a subir. \nSólo se pueden subir imagenes con extensiones: " + extensiones_permitidas.join(),"Mensaje");
						document.getElementById("AdministratorFilename").focus();
						return false;
					   }else{
						 return true;
					   }
			   }
		} 
		
		// function comprueba_extension(formulario, archivo) {
				// extensiones_permitidas = new Array(".jpg",".png");
				// mierror = "";
			  
				// if (!archivo) {
					// jAlert('No has seleccionado ningún archivo', 'Mensaje');
					// document.getElementById("AdministratorFilename").focus();
					// return false;
				// }else{
					  // extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
					  // permitida = false;
					  // for (var i = 0; i < extensiones_permitidas.length; i++) {
						 // if (extensiones_permitidas[i] == extension) {
						 // permitida = true;
						 // break;
						 // }
					  // }
					  
					  // if (!permitida) {
						// jAlert('Comprueba la extensión de su imagen a subir. \nSólo se pueden subir imagenes con extensiones: ' + extensiones_permitidas.join(), 'Mensaje');
						// document.getElementById("AdministratorFilename").focus();
						// return false;
					   // }else{
						 // formulario.submit();
						 // return true;
					   // }
			   // }
		// } 
		
		function deletePhoto(){
			jConfirm('¿Realmente desea eliminar el logo de administrador?', 'Confirmación', function(r){
				if( r ){						
						$("#deletePhotoId").click();
				}
			});
		}
</script>
<br><br>
<?php echo $this->Session->flash(); ?>		

		<?php echo $this->Form->create('Administrator', array(
							'type' => 'file',
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'label' => array('class' => 'col-md-2 control-label '),
								'between' => '<div class="col-md-4" style="padding-left: 0px; padding-right: 0px;">',
								'after' => '</div>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
							),
							'action' => 'editPhoto',
		)); ?>		

	
		<center>
		<div class="col-md-12"> <p style=" border-width: 0pc; color: #fff;  margin-top: 50px; font-size: 24px;  margin-left: -70px;">Logo de administrador</p></div>

		<div style="background-color: #835B06; margin-bottom: 15px; padding: 50px 0;" class="col-md-7 col-md-offset-2">
		
		<fieldset>
			<?php echo $this->Form->input('Administrator.filename', array(
										'type' => 'file',
										'class' =>'btn  btn-file',
										'label' => array(
											'class' => 'col-md-4 control-label ',
											'style' => 'padding-right: 0px; padding-top: 9px; padding-left: 0px; padding-right: 0px;',
											'text' => 'Seleccione logo'),
										'style' => 'color: white;  width: 360px;'
			)); ?>
			<?php 	echo $this->Form->input('Administrator.dir', array(
										'type' => 'hidden',			
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Dirección de la imagen',),
										'placeholder' => 'Dirección de la imagen'
			)); ?>	
			<?php 	echo $this->Form->input('Administrator.mimetype', array(	
										'type' => 'hidden',				
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Tipo de imagen',),
										'placeholder' => 'Tipo de imagen'
			)); ?>	
			<?php 	echo $this->Form->input('Administrator.filesize', array(	
										'type' => 'hidden',				
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Tamaño de la imagen',),
										'placeholder' => 'Tamaño de la imagen'
			)); ?>	
			<?php 	echo $this->Form->input('Administrator.id', array(
										'type' => 'hidden',
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'id',),
										'placeholder' => 'id',
										'readonly' => 'readonly'
			)); ?>	
			<?php 	echo $this->Form->input('Administrator.username', array(
										'type' => 'hidden',		
										'label' => array(
											'class' => 'col-md-4 control-label ',
											'text' => 'Número de cuenta UNAM',),
										'placeholder' => 'Número de cuenta UNAM'
			)); ?>
			
			</div>
			<div class="col-md-6 col-md-offset-2">
				<?php if($administrator['Administrator']['filename']<>''): ?>
					<div class="col-md-3 col-md-offset-3">
				<?php else: ?>
					<div class="col-md-3 col-md-offset-5">
				<?php endif; ?>
				
				<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar Logo', array(
								'type' => 'submit',
								'div' => 'form-group',
								'class' => 'btn btnBlue btn-default',
								// 'onclick'=> 'return comprueba_extension(this.form, this.form.AdministratorFilename.value)',
								'escape' => false,
				)); ?>
				</div>
				<?php echo $this->Form->end(); ?>
				<?php if($administrator['Administrator']['filename']<>''): ?>
				<div>
						<?php
									echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar Logo','#',
											array(
												'style' => 'cursor: pointer;',
												'class' => 'btn btn-danger',
												'id' => 'focusPhotoId',
												'onclick' => 'deletePhoto();',
												'escape' => false,
												)
										);
										
								echo $this->Form->postLink(
														'<i class="glyphicon glyphicon-trash"></i>&nbsp; Eliminar Logo',							
															array(
																'controller'=>'Administrators',
																'action'=>'deletePhoto',$this->Session->read('Auth.User.id')),
															array(
																'class' => 'btn btn-danger',
																'escape' => false,
																'style' => 'display: none',
																'id' => 'deletePhotoId',
																)
														); 	
						?>
				</div>
				<?php endif; ?>
			</div>
		</fieldset>	
	
		</div>
		
	</center>
