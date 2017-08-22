<?php 
	$this->layout = 'company'; 
?>
<script>
	
	$(document).ready(function() {
		document.getElementById("CompanyEmailConfirm").value = document.getElementById("CompanyEmail").value;
	});
		function comprueba_extension(formulario, archivo) {
				extensiones_permitidas = new Array(".jpg");
				mierror = "";
			  
				if (!archivo) {
					jAlert('No has seleccionado ningún archivo', 'Mensaje');
					document.getElementById("CompanyFilename").focus();
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
						jAlert('Comprueba la extensión de su imagen a subir. \nSólo se pueden subir imagenes con extensiones: ' + extensiones_permitidas.join(), 'Mensaje');
						document.getElementById("CompanyFilename").focus();
						return false;
					   }else{
						 formulario.submit();
						 return true;
					   }
			   }
		}

	$(document).ready(function() {
		document.getElementById("CompanyEmailConfirm").value = document.getElementById("CompanyEmail").value;
		
		var file = document.getElementById("CompanyFilename"); //El input de tipo
			file.addEventListener("change", function(){
					var fileSize = this.files[0].size; //Tamaño del archivo en Bytes
					var mb = 1024, //Cantidad de Bytes en 1 kb
					pesoFinal = fileSize / mb; //Tamaño del archivo en Megabytes
					if(pesoFinal.toFixed(2)>100){
						document.getElementById('CompanyFilename').value = '';  
						document.getElementById('CompanyDir').value = '';
						document.getElementById('CompanyMimetype').value = '';
						document.getElementById('CompanyFilesize').value = '';
						jAlert('Tu imagen de foto de perfil con: '+pesoFinal.toFixed(2) + ' Kb excede el límite permitido de 100Kb','Mensaje');
						return false;
					} else{
						comprueba_extension()
					}
			}, false);
	});
		function comprueba_extension() {
				var archivo = document.getElementById('CompanyFilename').value;
				extensiones_permitidas = new Array(".jpg",".png");
				mierror = "";
			  
				if (!archivo) {
					jAlert ("No has seleccionado ningún archivo","Mensaje");
					document.getElementById("CompanyFilename").focus();
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
						document.getElementById('CompanyFilename').value = '';  
						document.getElementById('CompanyDir').value = '';
						document.getElementById('CompanyMimetype').value = '';
						document.getElementById('CompanyFilesize').value = '';
						jAlert ("Comprueba la extensión de su imagen a subir. \nSólo se pueden subir imagenes con extensiones: " + extensiones_permitidas.join(),"Mensaje");
						document.getElementById("CompanyFilename").focus();
						return false;
					   }else{
						 return true;
					   }
			   }
		} 
		
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

		<?php echo $this->Form->create('Company', array(
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
							'action' => 'updateRegister',
							'onsubmit' => 'return comprueba_extension()'
		)); ?>		

	
		<center>
		<div class="col-md-3 col-md-offset-4"> <p style=" border-width: 0pc; color: #fff; margin-bottom: -40px;  margin-top: 50px; font-size: 22px;">Logo de la empresa</p></div>

		<div style="background-color: #835B06; margin-bottom: 15px; margin-top: 50px; padding: 20px 0px;" class="col-md-7 col-md-offset-2">
		
		<fieldset>
			<?php echo $this->Form->input('Company.filename', array(
										'type' => 'file',
										'class' =>'btn  btn-file',
										'label' => array(
											'class' => 'col-md-4 control-label ',
											'style' => 'text-align: center; left: 35px; ',
											'text' => 'Seleccione el logo <br> <span style=" font-size: 11px; line-height: 16px; font-weight: normal;"> Dimensión: 150x150px <br> Tamaño máx.: 100Kb <br> Formatos: .jpg y .png <span/>'),
										'style' => 'color: white;  width: 360px; '
			)); ?>
			<?php 	echo $this->Form->input('Company.dir', array(
										'type' => 'hidden',			
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Dirección de la imagen',),
										'placeholder' => 'Dirección de la imagen'
			)); ?>	
			<?php 	echo $this->Form->input('Company.mimetype', array(	
										'type' => 'hidden',				
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Tipo de imagen',),
										'placeholder' => 'Tipo de imagen'
			)); ?>	
			<?php 	echo $this->Form->input('Company.filesize', array(	
										'type' => 'hidden',				
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Tamaño de la imagen',),
										'placeholder' => 'Tamaño de la imagen'
			)); ?>	
			<?php 	echo $this->Form->input('Company.id', array(
										'type' => 'hidden',
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'id',),
										'placeholder' => 'id',
										'readonly' => 'readonly'
			)); ?>	
			<?php 	echo $this->Form->input('Company.username', array(
										'type' => 'hidden',		
										'label' => array(
											'class' => 'col-md-4 control-label ',
											'text' => 'Número de cuenta UNAM',),
										'placeholder' => 'Número de cuenta UNAM'
			)); ?>
			<?php   echo $this->Form->input('Company.academic_level_id', array(
										'type' => 'hidden',	
										'label' => array(
											'class' => 'col-md-2 control-label col-md-offset-2',
											'text' => 'Nivel máximo de estudios')
			)); ?>
			<?php 	echo $this->Form->input('Company.institution', array(
											'type' => 'hidden',
											'label' => array(
												'class' => 'col-md-4 control-label',
												'text' => 'Escuela o facultad',),
											'readonly' => 'readonly',
			)); ?>
			<?php 	echo $this->Form->input('Company.career', array(
											'type' => 'hidden',
											'label' => array(
												'class' => 'col-md-4 control-label',
												'text' => 'Carrera / Área')
										
			)); ?>
			<?php 	echo $this->Form->input('Company.academic_situation_id', array(	
											'type' => 'hidden',	
											'label' => array(
												'class' => 'col-md-4 control-label',
												'text' => 'Situación académica'),
			)); ?>
			<?php   echo $this->Form->input('Company.email', array(		
											'type' => 'hidden',	
											'label' => array(
												'class' => 'col-md-4 control-label ',
												'text'=>'Correo de registro'),
											'placeholder' => 'Correo de registro',
											'onchange' => 'emptyConfirm()',								
			)); ?>			
			<?php   echo $this->Form->input('Company.email_confirm', array(
											'type' => 'hidden',	
											'label' => array(
												'class' => 'col-md-4 control-label ',
												'text' => 'Confirma tu correo'),
											'placeholder' => 'Confirma tu correo',
			)); ?>
			<!--div class="col-md-6 col-md-offset-1" style="text-align: left; top: -15px; padding-left: 20px;">
				<p style="font-size: 12px; line-height: 7px;">Dimensión: 150x150px</p>
				<p style="font-size: 12px; line-height: 7px;">Tamaño máx.: 100Kb</p>
				<p style="font-size: 12px; line-height: 7px;">Formatos: .jpg y .png</p>
			</div-->
					
			</div>
			
			<div class="col-md-6 col-md-offset-2">
				<?php if($company['Company']['filename']<>''): ?>
					<div class="col-md-3 col-md-offset-3">
				<?php else: ?>
					<div class="col-md-3 col-md-offset-5">
				<?php endif; ?>
				<?php 
					if($company['Company']['filename']<>''): 
						$textBoton = 'Actualizar logo';
					else:
						$textBoton = 'Agregar logo';
					endif;
				?>
				<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp;'.$textBoton, array(
								'type' => 'submit',
								'div' => 'form-group',
								'class' => 'btn btnBlue btn-default',
								// 'onclick'=> 'return comprueba_extension(this.form, this.form.CompanyFilename.value)',
								'escape' => false,
				)); ?>
				</div>
				<?php echo $this->Form->end(); ?>
				<?php if($company['Company']['filename']<>''): ?>
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
																'controller'=>'Companies',
																'action'=>'deleteRegister',$this->Session->read('Auth.User.id')),
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
