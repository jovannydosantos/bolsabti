	<?php 
		$this->layout = 'administrator'; 
	?>
	<script>
		$(document).ready(function() {
			typeSearch();
		});
			
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("AdministratorCriterio").selectedIndex;
					
			if(selectedIndexTypeSearch==1){
				$("#AdministratorBuscar").attr("placeholder", "Ingrese el nombre de la empresa");
			}
			else
				if(selectedIndexTypeSearch==2){
					$("#AdministratorBuscar").attr("placeholder", "Ingrese el puesto");
				}
				else
					if(selectedIndexTypeSearch==3){
						$("#AdministratorBuscar").attr("placeholder", "Ingrese el folio de la oferta");
					}
					else{
						$("#AdministratorBuscar").attr("placeholder", "Nombre de la empresa / Puesto / Folio");
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
				if(secondaryEmail!=null){
					stringMails = stringMails+';'+secondaryEmail;
				}
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
				document.getElementById("AdministratorSearchStudentForm").submit();
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
			jAlert('El universitario no cuenta con un currículum completo para ser enviado', 'Mensaje');
			return false;
		}
		
		function deleteOffer(param){
				document.getElementById('focusOfferId'+param).scrollIntoView();
				jConfirm('¿Realmente desea eliminar la oferta?', 'Confirmación', function(r){
					if( r ){						
						$("#deleteOfferId"+param).click();
					}
				});
		}
		
	</script>

	<?php 
		echo $this->Session->flash();
		$paginator = $this->Paginator;
	?>

	<div class="col-md-12" style="margin-bottom: 10px; margin-top: 15px;">
		<p>El sistema buscará por el siguiente criterio: nombre de la empresa, puesto o folio.</p>
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
									'action' => 'viewStudentPostullation',
									'onsubmit' =>'return validateEmpty();'
					)); ?>		
				<fieldset>
					<div class="col-md-6" style="padding-right: 0px;">
					<?php echo $this->Form->input('Buscar', array(
															'before' => '<div class="col-md-12" style="padding-left: 0px;">',
															'label' =>'',
															'value'	=> $this->Session->read('palabraBuscada'), 
															'placeholder' => 'Nombre de la empresa / Puesto / Folio',
															
					));	?>
					</div>
					<div  class="col-md-4" style="padding-left: 0px; padding-right: 0px;">
					<?php 	$options = array('1' => 'Nombre de la empresa', '2' => 'Puesto', '3' => 'Folio');
							echo $this->Form->input('criterio', array(
													'type'=>'select',
													'class' => 'form-control clonGiroReindexa selectpicker show-tick show-menu-arrow',
													'before' => '<div class="col-md-12" style="padding-left: 0px;">',
													'label' =>'',
													'selected' => $this->Session->read('tipoBusqueda'),
													'onchange' => 'typeSearch()',
													'options' => $options,'default'=>'0', 'empty' => 'Criterio de búsqueda'
							)); ?>
					</div>
					<div class="col-md-1" style="padding-left: 0px; padding-right: 0px;">
					<?php 
					echo $this->Form->button(
											'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
											array(
												'type' => 'submit',
												'div' => 'form-group',
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
	
		<div class="col-md-9"  style="padding-left: 0px;">
			<?php if(isset($ofertas)): 
					if(empty($ofertas)):
						echo '<div class="col-md-12"  style="padding-left: 0px; margin-left: 15px">';
							echo '<p style="font-size: 22px; ">Sin resultados</p>';
						echo '</div>';
						echo '<div class="col-md-2">';
							echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> &nbsp;&nbsp; Regresar', 
																array(
																	'controller'=>'Administrators',
																	'action'=>$this->Session->read('volver'),
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'margin-top: 5px; width: 145px;',
																	'escape' => false
																)	
								);
						echo '</div>';
					else:
			?>
			<p style=" margin-left: 15px">Resultados de Búsqueda</p>
		
		</div>
				
		<div class="col-md-10" style="max-height: 680px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-left: -32px">
					
					<?php 
						foreach($ofertas as $k => $oferta):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 160px; margin-top: 15px; padding-left: 0px; padding-right: 0px; margin-left: 25px; right: -25px;">    
						
							<div class="col-md-2" style="text-align: center; margin-top: 20px; padding-left: 0px; padding-right: 0px;">
								<?php
										if($oferta['CompanyJobOffer']['confidential_job_offer'] == 's'):
											echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '95px',
																		'height' => '80px',
																	));
										else:
											if (isset($oferta)):
												if(isset($oferta['Company']['filename'])):
												$url = WWW_ROOT.'img/uploads/company/filename/'.$oferta['Company']['filename'];
													if(!file_exists( $url )):
														echo $this->Html->image('company/imagenNoEncontrada.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '95px',
																		'height' => '80px',
																	));
													else:
														if($oferta['Company']['filename'] <> ''):
															echo $this->Html->image('uploads/company/filename/'.$oferta['Company']['filename'],
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '95px',
																			'height' => '80px',
																		));
														else:
															echo $this->Html->image('company/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '95px',
																			'height' => '80px',
																		));
														endif;
													endif;
												else:
													echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '95px',
																		'height' => '80px',	
																	));
												endif;
											else:
												echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '95px',
																		'height' => '80px',
																	));
											endif;
										endif;
									?>
									
								<p class="blackText" style="margin-top: 5px; font-size: 12px; color: #000">
									<?php 
										if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
											echo '<span>'.$oferta['CompanyJobOffer']['company_name'].'</span><br>'; 
											echo '<span>'.$oferta['Company']['CompanyProfile']['rfc'].'</span>'; 
											
										else:
											if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']=='')):
												echo 'Confidencial';
											else:
												if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
													echo '<span>'.$oferta['CompanyJobOffer']['company_name'].'</span><br>'; 
													echo '<span>'.$oferta['Company']['CompanyProfile']['rfc'].'</span>'; 
												else:
													if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']=='')):
														echo '<span>'.$oferta['Company']['CompanyProfile']['company_name'].'</span><br>'; 
														echo '<span>'.$oferta['Company']['CompanyProfile']['rfc'].'</span>'; 
													else:
														echo 'Sin especificar';
													endif;
												endif;
											endif;
										endif;
									?>
								</p>
							</div>
						
							<div class="col-xs-6" style="margin-top: 15px; text-align: left;">
								<?php
									$caracteres = strlen($oferta['CompanyJobProfile']['id']);
									$faltantes = 5 - $caracteres;	
									if($faltantes > 0):
										$ceros = '';
										for($cont=0; $cont<=$faltantes;$cont++):
											$ceros .= '0';
										endfor;
										$folio = $ceros.$oferta['CompanyJobProfile']['id'];
									else:
										$folio = strlen($oferta['CompanyJobProfile']['id']);
									endif;
								?>
								<p class="blackText">Folio:<?php echo $folio; ?></p>
								<p class="blackText">Nombre oferta: 
									<span style="font-weight: normal;">
										<?php  
											$texto = str_ireplace ( $this->Session->read('palabraBuscada'), '<strong style="font-size: 14px; color: #2D3881">'.$this->Session->read('palabraBuscada').'</strong>', $oferta['CompanyJobProfile']['job_name']); 
											echo $texto;
										?> 
									</span>
								</p>
								<p class="blackText">Número de vacantes: <span style="font-weight: normal;"><?php  echo $oferta['CompanyJobProfile']['vacancy_number']; ?> </span></p>
								<p class="blackText">Fecha publicación: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobContractType']['created'])); ?> </span></p>
								<p class="blackText">Fecha de actualización: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyLastUpdate']['modified'])); ?> </span></p>
								<p class="blackText">Fecha de postulación: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($oferta['CompanyJobContractType']['created'])); ?> </span></p>
								<p class="blackText">Responsable de la oferta:</p>
								<p class="blackText">
								<?php
									if($oferta['CompanyJobOffer']['same_contact']=='n'):
										echo '<p class="blackText">Nombre: <span style="font-weight: normal;">' . $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'].'</span></p>';
										echo '<p class="blackText">Tel.: </span> (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
										if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
											echo ' - ext. </span> '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
										endif;
										echo '</span></p>';
										if($oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']<>''):
											echo '<p class="blackText">Cel.: </span> ('.$oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']. ') ' .$oferta['CompanyJobOffer']['responsible_cell_phone'] .'</span></p>';
										endif;	
										echo '<p class="blackText">Correo:</span> '.$oferta['CompanyJobOffer']['company_email'].'</span></p>';
									else:
										echo '<p class="blackText">Nombre: </span>' . $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'].'<br>';
										echo '<p class="blackText">Tel.: </span> (' . $oferta['Company']['CompanyContact']['long_distance_cod'] .') '. $oferta['Company']['CompanyContact']['telephone_number'] . ' ';
										if($oferta['Company']['CompanyContact']['phone_extension']<>''):
											echo ' - ext. </span> '.$oferta['Company']['CompanyContact']['phone_extension'];
										endif;
										echo '<br>';
										if(($oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($oferta['Company']['CompanyContact']['cell_phone']<>'')):
											echo '<p class="blackText">Cel.: </span> ('.$oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$oferta['Company']['CompanyContact']['cell_phone'] .'</span></p>';
										endif;
										echo '<p class="blackText">Correo:</span> '.$oferta['Company']['email'].'</span></p>';
									endif;
								  ?>
								</p>
							</div>
						
						<div class="col-md-2" style=" background: #58595B; float: right;  height: 30px;  padding-left: 5px; padding-right: 0px; ">
							<div style="margin-top: 3px" class="grises2">

								<?php 
								 // Editar oferta
									echo $this->Html->image('student/lapiz.png',
											array(
												'title' => 'Editar oferta',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'companyJobOffer',
																'?' => array(
																		'id' => $oferta['CompanyJobProfile']['id'],
																		'company_id' => $oferta['Company']['id'],
																		'editar' => 1,
																		'editingAdmin' => 'yes')
																),
												));
								?>
								
								<?php 
								// Ver postulaciones del estudiante
									echo $this->Html->image('administrator/postulado.png',
											array(
												'title' => 'Ver postulaciones de la oferta',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'viewCandidateOffer','nuevaBusqueda',
																'?' => array(
																		'id' => $oferta['CompanyJobProfile']['id'], 
																		'tipoBusqueda' => 4,
																		'company_id' => $oferta['Company']['id'], 
																		'editingAdmin' => 'yes',
																		)
																),
												)
											);
								?>
						
								<?php 
								// Envia a reportar contrataciones por el alumno
									$reportado = 0;
									foreach($oferta['Report'] as $k => $ofertaReportada):
										if(($ofertaReportada['student_id'] == ($this->Session->read('student_id')) AND ($ofertaReportada['registered_by'] =='student' ))):
											$reportado = 1;
											break;
										endif;
									endforeach;
									
									if($reportado == 0):
										echo $this->Html->image('administrator/contratado.png',
											array(
												'title' => 'Reportar contratación por el alumno',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Students',
																'action'=>'report',$oferta['CompanyJobProfile']['id'],
																'?' => array(
																		'student_id' => $this->Session->read('student_id'), 
																		'editingAdmin' => 'yes',
																		)
																),
												)
											);
									else:
										echo $this->Html->image('administrator/contratado_blanco.png',
											array(
												'title' => 'Reportar contratación por el alumno',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
											));
									endif;
								?>			
								
								<?php 
								 // Eliminar oferta
								 echo $this->Html->image('administrator/x.png',
											array(
												'title' => 'Eliminar oferta',
												'style' => 'width: 20px; height: 20px; margin-right: 5px; cursor: pointer;',
												'class' => 'class="img-responsive center-block"',
												'id' => 'focusOfferId'.$oferta['CompanyJobProfile']['id'],
												'onclick' => 'deleteOffer('.$oferta['CompanyJobProfile']['id'].');'
												)
										);
										
								 echo $this->Form->postLink(
														$this->Html->image('administrator/x.png',
														array('alt' => 'Delete', 'title' =>'Eliminar oferta', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteOfferId'.$oferta['CompanyJobProfile']['id'] )), 
														array('action' => 'deleteOffer',$oferta['CompanyJobProfile']['id']), 
														array('escape' => false) 
														);
								?>
							</div>
						</div>
						
							<div class="col-xs-4" style="margin-top: 30px; text-align: left; padding-right: 0px;">
								
								<p class="blackText">Guardada por usuario: 
									<span style="font-weight: normal;">
										<?php 
											$guardado = 0;
											foreach($oferta['StudentSavedOffer'] as $k => $saveOffer):
												if($saveOffer['student_id'] == ($this->Session->read('student_id'))):
													$guardado = 1;
													 break;
												endif;
											endforeach;
							
											if($guardado == 0):
												echo 'No';
											else:
												echo 'Si';
											endif;
										?>
									</span>
								</p>

								<?php echo $this->Html->link(
														' Ver oferta completa ', 
														array(
															'controller'=>'Students',
															'action'=>'viewOffer', $oferta['CompanyJobProfile']['id']),
														array(
															'class' => 'btn btnRed col-md-10',
															'style' => 'margin-top: 15px;',
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
		
	<div class="col-md-11">
		<?php 
		if(!empty($ofertas)):
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
	<?php endif; ?>
	</div>
	
	
	
	<!--Form para reportar contratación-->
		<div class="modal fade" id="myModalReportarContratacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 630px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Reportar contratación</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 215px;">
								<?php 
									echo $this->Form->create('Company', array(
																		'class' => 'form-horizontal', 
																		'role' => 'form',
																		'inputDefaults' => array(
																				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																												'div' => array('class' => 'form-group'),
																												'class' => 'form-control',
																												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" >',
																												'between' => ' <div class="col-md-11" style="padding-right: 5px;">',
																												'after' => '</div></div>',
																												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																		),
																		'action' => 'reportarContratacion',
																		'onsubmit' =>'return validarReportarContratacionForm();'
									)); 
								?>	
						
										<div class="col-md-12 col-md-offset-0" style=" margin-top: 40px;  padding-right: 0px;">	
												<fieldset>
													<?php 	echo $this->Form->input('StudentReportarContratacion.student_id', array('type'=>'hidden')); ?>

													
													<div class="col-xs-6 col-md-offset-6" style="height: 0;">
														<p style="margin-left: -52%;margin-top: 5px;">Fecha</p>
														<label class="col-md-6 control-label"  style="margin-left: 131px; top: -37px;"></label>
													</div>
														<?php 	echo $this->Form->input('StudentReportarContratacion.fecha_contratacion', array(
																										'type' => 'date',
																										'before' => '<div class="col-md-12">',
																										'between' => ' <div class="col-md-8" style="left: 28%;">',
																										'style' => 'width: 98px;    margin-left: -10px; margin-right: 18px;padding:0px',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																											'class' => 'col-sm-0 col-md-0 col-xs-offset-1 control-label ',
																											'text' => '',),
																										'dateFormat' => 'YMD',
																										'separator' => '',
																										'minYear' => date('Y') - 20,
																										'maxYear' => date('Y') - 0,	
																
														));	?>

													<div class="form-group required">
														<div class="col-md-12" style="padding-right: 0px;">
															<label for="StudentAcademicSituationId"></label>
															<div class="col-md-11 "  style="margin-top: 15px;">
																<select  id="StudentAcademicSituationId" class="form-control" required="required" name="data[StudentReportarContratacion][company_job_profile_id]" >
																	<option value="">Seleccione el puesto que cubrió el candidato</option>
																	<?php 
																		foreach($company['CompanyJobProfile'] as $k => $companyJobProfileId):

																			$caracteres = strlen($companyJobProfileId['id']);
																			$faltantes = 5 - $caracteres;	
																			if($faltantes > 0):
																				$ceros = '';
																				for($cont=0; $cont<=$faltantes;$cont++):
																					$ceros .= '0';
																				endfor;
																				$folio = $ceros.$companyJobProfileId['id'];
																			else:
																				$folio = strlen($companyJobProfileId['id']);
																			endif;
																			
																			if(!empty($companyJobProfileId['CompanyJobContractType']) and ($companyJobProfileId['CompanyJobContractType']['salary']<>'')):
																				$salario = $Salarios[$companyJobProfileId['CompanyJobContractType']['salary']];
																			else:
																				$salario = '';
																			endif
																	?>
																			<option value=<?php echo $companyJobProfileId['id']; ?> > <?php echo $folio.' '.$companyJobProfileId['job_name'].' '.$salario; ?></option>
																	<?php 
																		endforeach;
																	?>
																	
																</select>
															</div>
														</div>
													</div>
													
												</fieldset>	
										</div>
				
				

								</div>
								<div class="modal-footer">
									<?php 	echo $this->Form->button('Reportar contratación',array(
																			'type' => 'submit', 
																			'div' => 'form-group',
																			'escape' => false,
																			'class' => 'btn btnRed btn-default col-md-4 col-md-offset-7'
																));
											echo $this->Form->end(); 
									?>
								</div>
							</div>
						</div>
					</div>