	<?php 
		$this->layout = 'administrator'; 
	?>
	<script>
		$(document).ready(function() {
			
			init_contadorTa("messageIdEmail","contadorTaComentario2", 632);
			updateContadorTa("messageIdEmail","contadorTaComentario2", 632);
			
			//Contador de caracteres para las notificaciones telefónicas 
			function init_contadorTa(idtextarea, idcontador,max){
				$("#"+idtextarea).keyup(function()
						{
							updateContadorTa(idtextarea, idcontador,max);
						});
				
				$("#"+idtextarea).change(function()
				{
						updateContadorTa(idtextarea, idcontador,max);
				});
			}
			
		function updateContadorTa(idtextarea, idcontador,max){
			var contador = $("#"+idcontador);
			var ta =     $("#"+idtextarea);
			contador.html("0/"+max);
			
			contador.html(ta.val().length+"/"+max);
			if(parseInt(ta.val().length)>max)
			{
				ta.val(ta.val().substring(0,max-1));
				contador.html(max+"/"+max);
			}

		}
		
			typeSearch();
		});
			
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("AdministratorCriterio").selectedIndex;
					
			if(selectedIndexTypeSearch==1){
				$("#AdministratorBuscar").attr("placeholder", "Ingrese el número de cuenta");
			}
			else
				if(selectedIndexTypeSearch==2){
					$("#AdministratorBuscar").attr("placeholder", "Ingrese el nombre(s)");
				}
				else
					if(selectedIndexTypeSearch==3){
						$("#AdministratorBuscar").attr("placeholder", "Ingrese el apellido(s)");
					}
					else
						if(selectedIndexTypeSearch==4){
							$("#AdministratorBuscar").attr("placeholder", "Ingrese el correo electrónico");
						}
						else{
							$("#AdministratorBuscar").attr("placeholder", "Ingrese palabra...");
					}
		}
		
		function deleteAdministrador(param, name){
				document.getElementById('focusAdminId'+param).scrollIntoView();
				if(param==1){
					jAlert('El administrador principal no puede ser eliminado');
				}else{
					jConfirm('¿Realmente desea eliminar a este administrador: '+name+'?', 'Confirmación', function(r){
						if( r ){
							$("#deleteAdminId"+param).click();
						}
					});
				}
		}
		
		function validateEmpty(){
			selectedIndex = document.getElementById("AdministratorCriterio").selectedIndex;
			
			if(document.getElementById('AdministratorBuscar').value == ''){
				jAlert('Ingrese la palabra a buscar', 'Mensaje');
				document.getElementById('AdministratorBuscar').focus();
				return false;
			} else 
			if(selectedIndex == 0){
				$( "#AdministratorCriterio" ).focus();
				jAlert('Seleccione el criterio de búsqueda', 'Mensaje');
				document.getElementById('AdministratorCriterio').focus();
				return false;
			}else {
				return true;
			}
		}
		
		function saveEmailNotification(email){
			document.getElementById('StudentEmailTo').value = email;
			$('#myModalMail').modal('show');
		}
		
		function updatePassword(id,email,secondaryEmail){
			document.getElementById('AdministratorStudentId').value = id;
			var stringMails = email;
			if(secondaryEmail!=''){
				stringMails = stringMails+';'+secondaryEmail;
			}
			document.getElementById('AdministratorStudentEmail').value = stringMails;
			$('#myModalUpdatePassword').modal('show');
		}

		function cambiarContenido(){
				var archivo = document.getElementById('StudentFile').value;
				extensiones_permitidas = new Array(".jpg",".pdf");
				mierror = "";

				if (!archivo) {
						jAlert('No se ha adjuntado ningún archivo', 'Mensaje');
						document.getElementById('StudentFile').scrollIntoView();
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
							jAlert("Compruebe la extensión de su archivo. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(), 'Mensaje');
							document.getElementById('StudentFile').scrollIntoView();
							deleteText();
							return false;
						}else{
							document.getElementById("textFile").innerHTML = document.getElementById('StudentFile').value + '<button id="deleteTextId" onclick="deleteText();" class="btnBlue" style="margin-left: 10px;" >x</button>';
							return false;
						}
				   }
		}
			
		function deleteText(){
			document.getElementById("textFile").innerHTML = '';
			document.getElementById('StudentFile').value = '';  
			return false;
		}
		
		function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('AdministratorLimite').value = document.getElementById('limit').value;
				// document.getElementById("AdministratorSearchStudentForm").submit();
				$( "#idBucar" ).click();
			 }
		}
		
		function deleteStudent(param, name){
			document.getElementById('focusStudentId'+param).scrollIntoView();
			jConfirm('¿Realmente desea eliminar a este universitario: '+name+'?', 'Confirmación', function(r){
				if( r ){
					$("#deleteStudentId"+param).click();
					}
			});	
		}
		
		function cvIncompleto(){
			jAlert('El universitario no cuenta con un currículum completo para ser enviado, se considera cv completo ingresando información en: Datos Personales, Formación Académica, Objetivo Profesional, Competencias Profesionales y Expectativas Laborales.', 'Mensaje');
			return false;
		}
	</script>
	<div class="col-md-12">
	<?php 
		echo $this->Session->flash();
		$paginator = $this->Paginator;
	?>
	</div>
	
	<div class="col-md-12" style="margin-bottom: 10px; margin-top: 15px;">
		<p>El sistema buscará por el siguiente criterio: número de cuenta, nombre(s), apellidos(s) o correo electrónico.</p>
	</div>
	
	<div class="col-md-9"  style="padding-left: 0px;">
				<?php 
					echo $this->Form->create('Administrator', array(
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => ' <div class="col-md-12">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'searchStudentOffer',
									'onsubmit' =>'return validateEmpty();'
					)); ?>		
					<fieldset>
						<div class="col-md-7" style="padding-right: 0px;" id="idDivBuscar">
						<?php echo $this->Form->input('Buscar', array(
																'before' => '<div class="col-md-12" style="padding-left: 0px;">',
																'label' =>'',
																'value'	=> $this->Session->read('palabraBuscadaAdmin'), 
																'placeholder' => 'Buscar...',
																
						));	?>
						</div>
						<div  class="col-md-4" style="padding-left: 0px; padding-right: 0px;">
						<?php 	$options = array('11' =>'Número de cuenta', '12' => 'Nombre(s)', '13' => 'Apellidos(s)', '14' => 'Correo electrónico');
								echo $this->Form->input('criterio', array(
														'type'=>'select',
														'class' => 'selectpicker show-tick form-control show-menu-arrow',
														'selected' => $this->Session->read('tipoBusquedaAdmin'),
														'before' => '<div class="col-md-12" style="padding-left: 0px;">',
														'label' =>'',
														'onchange' => 'typeSearch()',
														'options' => $options,'default'=>'0', 'empty' => 'Criterio de búsqueda'
								)); ?>
						</div>

						<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>
						
						<div class="col-md-1" style="padding-left: 0px; padding-right: 0px;">
							<?php 
							echo $this->Form->button(
													'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
													array(
														'type' => 'submit',
														'div' => 'form-group',
														'id' => 'idBucar',
														'class' => 'btn btnBlue btn-default',
														'style' => 'width: 130px;',
														'escape' => false,
													)
							);

							echo $this->Form->end(); 
							?>
							<img data-toggle="tooltip" id="" data-placement="top" title="El sistema realiza búsquedas escribiendo alguna(s) palabra(s) clave(s) en el campo abierto. 
Ejemplos: 
Analista en Mercadotecnia
MySQL" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 220%; margin-top: -90%;">
						</div>
					</fieldset>
	</div>
	
	<?php 
		$opcionElegida = $this->Session->read('optionSearchStudentOffer');
		if($opcionElegida == 1):
			$texto = 'Entrevistas telefónicas: ';
		else:
			if($opcionElegida == 2):
				$texto = 'Entrevistas presenciales: ';
			else:
				if($opcionElegida == 3):
					$texto = 'Contrataciones: ';
				else:
					if($opcionElegida == 4):
						$texto = 'Postulaciones: ';
					endif;
				endif;
			endif;
		endif;
	?>
	
	<div class="col-md-12" style="margin-bottom: 10px; margin-top: 15px;">
		<p><?php echo $texto. $this->Session->read('totalStudents'); ?></p>
	</div>
		<div class="col-md-10"  style="padding-left: 0px;">
			<?php if(isset($candidatos)): 
					if(empty($candidatos)):
						echo '<div class="col-md-9"  style="padding-left: 0px; margin-left: 15px">';
							echo '<p style="font-size: 22px; ">Sin resultados</p>';
						echo '</div>';
					else:
			?>
			

			<div class="col-md-12" style="padding-left: 0px;">
				<p style=" margin-left: 15px">Resultados de Búsqueda</p>
			</div>
				<div class="col-md-3" >
						<?php 	echo $this->Html->link(
													'Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
															array(
																	'controller'=>'Administrators',
																	'action'=>'searchStudentOfferExcel',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 180px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
				</div>
				
				<div class="col-md-3" style="padding-left: 0px;  left: -25px;">
					<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
							echo $this->Form->input('limit', array(
																'onchange' => 'sendLimit()' ,
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width' => '180px',
																'style' => 'width: 180px; height: 32px;',
																'before' => '<div class="col-md-12 "',
																'selected' => $this->Session->read('limite'),
																'label' =>'',
																'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
					)); ?>
				</div>
				
		</div>
				
		<div class="col-md-11" style="max-height: 760px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-top: 10px;">
					
					<?php 
						foreach($candidatos as $k => $candidato):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 135px; margin-top: 15px; padding-left: 0px; padding-right: 0px; margin-left: 0px; right: -25px;">    
						
							<div class="col-md-2" style="text-align: center; margin-top: 20px; padding-left: 0px; padding-right: 0px;">
								<?php
											if (isset($candidato)):
												if(isset($candidato['Student']['filename'])):
													$url = WWW_ROOT.'img/uploads/student/filename/'.$candidato['Student']['filename'];
													if(!file_exists( $url )):
														echo $this->Html->image('student/imagenNoEncontrada.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',
																	));
													else:
														if($candidato['Student']['filename'] <> ''):
															echo $this->Html->image('uploads/student/filename/'.$candidato['Student']['filename'],
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '80px',
																			'height' => '80px',
																		));
														else:
															echo $this->Html->image('student/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '80px',
																			'height' => '80px',
																		));
														endif;
													endif;
												else:
													echo $this->Html->image('student/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',	
																	));
												endif;
											else:
												echo $this->Html->image('student/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',
																	));
											endif;
									?>
									
								<p class="blackText" style="margin-top: 5px;">
									<?php echo $candidato['StudentProfile']['name'].' '.$candidato['StudentProfile']['last_name'].' '.$candidato['StudentProfile']['second_last_name']; ?>
								</p>
							</div>
						
							<div class="col-xs-6" style="margin-top: 10px; text-align: left;">
								<p class="blackText">Núm. de cuenta: <?php echo $candidato['Student']['username']; ?></p>
								<p class="blackText">Nombre: <span style="font-weight: normal;"> <?php echo $candidato['StudentProfile']['name'].' '.$candidato['StudentProfile']['last_name']; ?></span></p>
								<p class="blackText">Correo electrónico: <span style="font-weight: normal;"><?php  echo $candidato['Student']['email']; ?> </span></p>
								<p class="blackText">Teléfono casa: <span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['telephone_contact'] <> '') ? $candidato['StudentProfile']['lada_telephone_contact'].$candidato['StudentProfile']['telephone_contact'] : 'Sin especificar';  ?> </span></p>
								<p class="blackText">Celular: <span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['cell_phone'] <> '') ? $candidato['StudentProfile']['lada_cell_phone'].$candidato['StudentProfile']['cell_phone'] : 'Sin especificar'; ?> </span></p>
								<p class="blackText">Fecha de actualización: <span style="font-weight: normal;"><?php  echo ($candidato['StudentLastUpdate']['modified'] <> null) ? $candidato['StudentLastUpdate']['modified'] : 'Sin especificar'; ?> </span></p>		
								<p class="blackText">Escuela / Facultad: <span style="font-weight: normal;"><?php  echo $EscuelasFacultades[$candidato['Student']['institution']]; ?> </span></p>	
							</div>
						
						<div class="col-md-4" style=" background: #58595B; float: right;  height: 30px; padding-left: 5px; padding-right: 5px; ">
							<div style="margin-top: 3px"  class="grises2" >
							<?php
								$cvCompleto = '';
								if(($candidato['StudentProfile']['sex']<>'') and (!empty($candidato['StudentProfessionalProfile'])) and (!empty($candidato['StudentJobProspect'])) and ($candidato['StudentJobProspect']['id']<>null) and (!empty($candidato['StudentProspect']))  and ($candidato['StudentProspect']['id']<>null)):
									$cvCompleto = 'Si';
								else:
									$cvCompleto = 'No';
								endif;
							?>
							
								<?php 
								 // Descativar estudiante
									if($candidato['Student']['status'] == 0):
										echo $this->Html->image('student/noActiva.png',
											array(
												'title' => 'Universitario inactivo click para activar',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; margin-left: 15px;',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'enableDisableStudent',
																'?' => array(
																			'id' => $candidato['Student']['id'],
																			'estatus' => $candidato['Student']['status'],
																		)
																),
												)
										);
									else:
										echo $this->Html->image('student/activa.png',
											array(
												'title' => 'Universitario activo click para desactivar',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; margin-left: 15px;',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'enableDisableStudent',
																'?' => array(
																			'id' => $candidato['Student']['id'],
																			'estatus' => $candidato['Student']['status'],
																		)
																),
											));
									endif;
								?>
								
								<?php 
								 // Editar estudiante
									echo $this->Html->image('student/lapiz.png',
											array(
												'title' => 'Editar universitario',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Students',
																'action'=>'studentProfile',
																'?' => array(
																		'student_id' => $candidato['Student']['id'], 
																		'editingAdmin' => 'yes')
																),
												));
								?>

								<?php 
								 // Enviar cv del estudiante
								 if($cvCompleto == 'Si'):
									echo $this->Html->image('administrator/sobre.png',
											array(
												'title' => 'Enviar CV del universitario',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Students',
																'action'=>'studentContact',
																'?' => array(
																		'student_id' => $candidato['Student']['id'], 
																		'editingAdmin' => 'yes')
																),
												));
								else:
									echo $this->Html->image('administrator/sobre.png',
											array(
												'title' => 'Enviar CV del universitario',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'cvIncompleto();',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												)
												);	
								endif;
								?>
								
								<?php 
								// Actualizar contraseña de universitario
									echo $this->Html->image('administrator/candado.png',
											array(
												'title' => 'Actualizar contraseña',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'updatePassword('.$candidato['Student']['id'].',"'.$candidato['Student']['email'].'","'.$candidato['StudentProfile']['secondary_email'].'");',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												)
												);	
								
								?>

								<?php 
								// Enviar email del estudiante
									echo $this->Html->image('administrator/arroba.png',
											array(
												'title' => 'Enviar correo',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveEmailNotification("'.$candidato['Student']['email'].'");',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												)
												);	
								
								?>
								
								<?php 
								// Ver postulaciones del estudiante
									echo $this->Html->image('administrator/postulado.png',
											array(
												'title' => 'Ver postulaciones del universitario',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'viewStudentPostullation',
																'?' => array(
																			'student_id' => $candidato['Student']['id'], 
																			'newSearch' => 'nuevaBusqueda',
																			'regresar' => 'searchStudentOffer',
																			)
																),
												)
											);
								?>
								
								<?php 
								// Envia a reportar contrataciones
									echo $this->Html->image('administrator/contratado.png',
											array(
												'title' => 'Reportar contratación por universitario',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Students',
																'action'=>'report','nuevaBusqueda',
																'?' => array(
																		'student_id' => $candidato['Student']['id'], 
																		'editingAdmin' => 'yes',
																		)
																),
												)
											);
								?>

								<?php 
									 // Eliminar universitario
									 echo $this->Html->image('student/eliminar.png',
												array(
													'title' => 'Eliminar universitario',
													'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
													'class' => 'class="img-responsive center-block"',
													'id' => 'focusStudentId'.$candidato['Student']['id'],
													'onclick' => 'deleteStudent('.$candidato['Student']['id'].',"'.$candidato['Student']['username'].'");'
													)
											);
											
									 echo $this->Form->postLink(
															$this->Html->image('student/eliminar.png',
															array('alt' => 'Eliminar universitario', 'title' =>'Eliminar universitario', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteStudentId'.$candidato['Student']['id'] )), 
															array('action' => 'deleteStudent',$candidato['Student']['id']), 
															array('escape' => false) 
															);
								?>
							</div>
						</div>
							
						<div class="col-xs-4" style="margin-top: 25px; text-align: left; padding-right: 0px; padding-left: 0px;">
							<?php
								$trabajando = 'No laborando';
								if(!empty($candidato['StudentProfessionalExperience'])):
									foreach($candidato['StudentProfessionalExperience'] as $experiencia):
										foreach($experiencia['StudentWorkArea'] as $puesto):
											if($puesto['current'] == 1):
												$trabajando = 'Laborando';
											endif;
										endforeach;
									endforeach;
								endif;
							?>

							<p class="blackText">Status laboral: <span style="font-weight: normal;"><?php  echo $trabajando; ?> </span></p>
							
							<p class="blackText">CV completo: <span style="font-weight: normal;"><?php  echo $cvCompleto; ?> </span></p>		
								
							<?php echo $this->Html->link(
														'Ver curriculum', 
														array(
															'controller'=>'Students',
															'action'=>'viewCvOnline',
															'?' => array(
																		'student_id' => $candidato['Student']['id'], 
																		'editingAdmin' => 'yes')
															),
														array(
															'class' => 'btn btnRed col-md-8',
															'style' => 'margin-top: 10px;',
															'escape' => false)	
								); 	?>
							
							</div>
						
						</div>
					<?php endforeach; ?>
				
			<?php 
				endif;
				endif; 
			?>
		</div>
		
		<div class="col-md-11" style="margin-left:10px;">
		<?php 
		if(!empty($candidatos)):
		?>
		<p>
		<?php echo $this->Paginator->counter(
		array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')
		); ?>
		</p>
		
		<div class="pagin" style="">
		<?php echo $this->Paginator->first('<< primero');?>
		<?php echo $this->Paginator->prev('< anterior', array(), null, array('class' => 'prev disabled')); ?>
		<?php echo $this->Paginator->numbers(array('separator'=>'')); ?>
		<?php echo $this->Paginator->next('siguiente >', array(), null, array('class' => 'next disabled'));?>
		<?php echo $this->Paginator->last('último >>');?>
		</div>	
		
		<?php endif; ?>
		</div>
		<?php
		echo '<div class="col-md-2 col-md-offset-7" style="top: -55px; left: 72px;">';
							echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> &nbsp;&nbsp; Regresar', 
																array(
																	'controller'=>'Administrators',
																	'action'=>$this->Session->read('volver'),
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'margin-top: 5px; width: 145px;',
																	'escape' => false,
																)	
								);
						echo '</div>';
		?>
		
		<!--Form para envio de correo -->
					<div class="modal fade" id="myModalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Envio de correo electrónico </h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 440px;">
									<?php
										echo $this->Form->create('Administrator', array(
														'type' => 'file',
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4 control-label '),
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " >',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
														),
														'action' => 'sendEmailStudent'
									)); ?>
										<style type="text/css">
											.upload {
												width: 154px;
												height: 35px;
												background: url("<?php echo $this->webroot; ?>/img/adjuntarboton.png");
												overflow: hidden;
												background-repeat-x: no-repeat;
												background-repeat:no-repeat;
												margin-left: 35px;
												margin-top: -28px;
											}
										</style>

										<fieldset style="margin-top: 30px;">
											
											<?php echo $this->Form->input('Student.emailTo', array(
																					'readonly' => 'readonly',
																					'before' => '<div class="col-md-9 ">',	
																					'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " style="padding-left: 5px; padding-right: 5px;">',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'style' => 'left: 6px;',
																									'text' => '',
																								),
																					'placeholder' => 'Correo',
											)); ?>
											<?php echo $this->Form->input('Student.CC', array(	
																					'type' => 'hidden',
																					'before' => '<div class="col-md-12 ">',	
																					'style'	=> 'margin-left: -15px;',		
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => 'CC:',
																									'style' => 'margin-left: 15px;',
																								),
																					'placeholder' => 'CC',
											)); ?>
											<?php echo $this->Form->input('Student.CCO', array(	
																					'type' => 'hidden',
																					'before' => '<div class="col-md-12 ">',	
																					'style' => 'margin-left: -15px;',			
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => 'CCO:',
																									'style' => 'margin-left: 15px;',
																								),
																					'placeholder' => 'CCO',
											)); ?>
											<?php echo $this->Form->input('Student.title', array(
																					'before' => '<div class="col-md-9 "><img data-toggle="tooltip" id="" data-placement="top" title="Ingresar asunto del mensaje, breve y conciso." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 8px;">',
																					'between' => '<div class="col-xs-11 col-sm-10 col-md-10 " style="padding-left: 5px; padding-right: 5px;">',
																					'style' => 'margin-left: -5px;',				
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => '',
																									'style' => 'margin-left: 5px;',
																									),
																					'placeholder' => 'Título',
											)); ?>
											
											<?php echo $this->Form->input('Student.file', array(
																					'type' => 'file',
																					'before' => '<div class="col-md-12 ">',
																					'between' => '<div class="col-xs-11 col-sm-9 col-md-8 upload">',
																					'style' => 'display: block !important;
																														width: 157px !important;
																														height: 57px !important;
																														opacity: 0 !important;
																														overflow: hidden !important;
																														background-repeat-y: no-repeat;
																														cursor: pointer;',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-6 col-md-3 control-label',
																									'text' => 'máx. 200kb'
																									),
																					'onchange' => 'cambiarContenido()'
																					
											)); ?>
											<div class="col-md-12" >
												<p id="textFile" style="border-top-width: 0px; margin-left: 18px; "></p>
											</div>
											<?php echo $this->Form->input('Student.message', array(	
																						'type' => 'textarea',
																						'rows' => '5',
																						'cols' => '5',
																						'maxlength' => '632',
																						'id' => 'messageIdEmail',
																						'before' => '<div class="col-md-12 ">',
																						'style' => 'margin-left: -25px; resize: vertical; min-height: 75px;  max-height: 150px; height: 130px;',
																						'label' => array(
																										'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																										'text' => '',
																										'style' => 'margin-top: -5px;left: -7px;',
																						),
																						'placeholder' => 'Cuerpo del correo'
											)); ?>
											<div class="col-md-11 form-group row" style="text-align: right; top: -10px; margin-left: 7px; margin-bottom: 0px;padding-right: 22px;">
												<span id="contadorTaComentario2" style="color: white">0/632</span><span style="color: white"> caracteres máx.</span>
												<img data-toggle="tooltip" id="" data-placement="left" title="Mensaje que le será enviado al candidato" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: -55px;">
											</div>
													
											<?php echo $this->Form->input('Student.sign', array(	
																					'before' => '<div class="col-md-6 "><img data-toggle="tooltip" id="" data-placement="top" title="Texto de identificación que será presentado en todos los correos que envíe.Se sugiere los siguientes datos: nombre, cargo y empresa, teléfono de contacto, redes sociales." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: -5px;margin-top: 8px;">',
																					'style' => 'margin-left: -10px;',
																					'label' => array(
																									'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																									'text' => '',
																									'style' => 'margin-left: 10px;',
																									),
																					'placeholder' => 'Firma',
																					'between' => '<div class="col-xs-11 col-sm-8 col-md-4 ">',

											)); ?>
										</fieldset>

								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Enviar',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-3 col-md-offset-8'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>

		<!--Form para actualizar password -->
		<div class="modal fade" id="myModalUpdatePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Modificar contraseña del universitario</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 270px;">
									<?php 
										echo $this->Form->create('Administrator', array(
														'class' => 'form-horizontal', 
														'role' => 'form',
														'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'label' => array('class' => 'col-xs-4 col-sm-4 col-md-2 col-md-4 control-label '),
															'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => '<div class="col-md-7">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
														),
														'action' => 'updateStudentPassword'
										)); ?>
										<fieldset style="margin-top: 30px;">
												<?php echo $this->Form->input('student_id', array(					
																'label' => array(
																	'class' => 'col-xs-12 col-sm-4 col-md-5 control-label ',
																	'text' => 'id de usuario',
																	),
																'placeholder' => 'id de usuario',
																'type' => 'hidden',
												)); ?>
												<?php echo $this->Form->input('password', array(
													'before' => '<div class="col-md-12 ">',
																'type' => 'password',
																'readonly' => 'readonly',
																'value' => $this->Session->read('randomPass'),
																'label' => array(
																	'class' => 'col-xs-5 control-label',
																	'text' => 'Contraseña generada automaticamente:'),
																'placeholder' => 'Escribir nueva contraseña'
												)); ?>	
												<?php echo $this->Form->input('student_email', array(	
													'before' => '<div class="col-md-12 ">',
														'readonly' => 'readonly',
														'type' => 'text',
														'label' => array(
															'class' => 'col-xs-5 control-label',
															'text'=>'Envio de notificación al correo:'),
														'placeholder' => 'Envio de notificación al correo',					
												)); ?>
												<?php echo $this->Form->input('student_email_alternativo', array(
														'before' => '<div class="col-md-12 ">',	
														'type' => 'text',
														'label' => array(
															'class' => 'col-xs-5 control-label',
															'text'=>'Correo alternativo:'),
														'placeholder' => 'Correo alternativo',					
												)); ?>
											<p style="font-size: 12px;">Si necesita agregar más de un correo alternativo estos deberan estar separados por un punto y coma ';'</p>
										</fieldset>
								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Modificar&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-lock"></i>',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-3 col-md-offset-8'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
		</div>