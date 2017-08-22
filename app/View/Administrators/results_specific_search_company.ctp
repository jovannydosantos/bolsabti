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
		
		});
	
		
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
		
		function saveEmailNotification(email){
			document.getElementById('StudentEmailTo').value = email;
			$('#myModalMail').modal('show');
		}
		
		function updatePassword(id,email,secondaryEmail){
			document.getElementById('AdministratorCompanyId').value = id;
			var stringMails = email;
			if(secondaryEmail!=''){
				if(secondaryEmail!=null){
					stringMails = stringMails+';'+secondaryEmail;
				}
			}
			document.getElementById('AdministratorCompanyEmail').value = stringMails;
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
			 selectedIndex = document.getElementById("AdministratorLimit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				// document.getElementById('AdministratorLimit').value = document.getElementById('AdministratorLimit').value;
				document.getElementById("AdministratorResultsSpecificSearchCompanyForm").submit();
			 }
		}
		
		function deleteCompany(param){
			document.getElementById('focusCompanyId'+param).scrollIntoView();
			jConfirm('¿Realmente desea eliminar a esta empresa?', 'Confirmación', function(r){
				if( r ){
					$("#deleteCompanyId"+param).click();
					}
			});	
		}
	</script>
		<div class="col-md-12">
		<?php 
			echo $this->Session->flash();
			$paginator = $this->Paginator;
		?>
		</div>
		
		
		<div class="col-md-9"  style="padding-left: 0px; margin-top: 15px;">
			<?php if(isset($empresas)): 
					if(empty($empresas)):
						echo '<div class="col-md-12"  style="padding-left: 0px; margin-left: 15px">';
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
																	'action'=>'resultsSpecificSearchCompanyExcel',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 180px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
				</div>
				<?php	echo $this->Form->create('Administrator', array(
							'type' => 'file',
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'before' => '<div class="col-md-12 ">',
								'between' => '<div class="col-md-11 ">',
								'after' => '</div></div>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;'))
							),
							'action' => 'resultsSpecificSearchCompany',
				)); ?>		
				<div class="col-md-3" style="padding-left: 0px;">
					<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
							echo $this->Form->input('limit', array(
																'onchange' => 'sendLimit()' ,
																'type'=>'select',
																'style' => 'width: 180px; height: 32px;',
																'before' => '<div class="col-md-12 "',
																'selected' => $this->Session->read('limit'),
																'label' =>'',
																'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
					)); 
					
					echo $this->Form->end(); 
					?>
				</div>
		
		</div>
				
		<div class="col-md-10" style="max-height: 880px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-left: -32px">
					
					<?php 
						foreach($empresas as $k => $empresa):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 160px; margin-top: 15px; padding-left: 0px; padding-right: 0px; margin-left: 25px; right: -25px;">    
						
							<div class="col-md-2" style="text-align: center; margin-top: 20px; padding-left: 0px; padding-right: 0px;">
								<?php
											if (isset($empresa)):
												if(isset($empresa['Company']['filename'])):
													$url = WWW_ROOT.'img/uploads/company/filename/'.$empresa['Company']['filename'];
													if(!file_exists( $url )):
														echo $this->Html->image('company/imagenNoEncontrada.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',
																	));
													else:
														if($empresa['Company']['filename'] <> ''):
															echo $this->Html->image('uploads/company/filename/'.$empresa['Company']['filename'],
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '80px',
																			'height' => '80px',
																		));
														else:
															echo $this->Html->image('company/imagenNoDisponible.png',
																		array(
																			'alt' => 'Profile Photo',
																			'width' => '80px',
																			'height' => '80px',
																		));
														endif;
													endif;
												else:
													echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',	
																	));
												endif;
											else:
												echo $this->Html->image('company/imagenNoDisponible.png',
																	array(
																		'alt' => 'Profile Photo',
																		'width' => '80px',
																		'height' => '80px',
																	));
											endif;
									?>
									
								<p class="blackText" style="margin-top: 10px; font-size: 12px; color: #000">
									<?php echo '<span>'.$empresa['CompanyProfile']['company_name'].'</span><br>'; ?>
								</p>
								<p class="blackText" style="font-size: 12px; color: #000">
									<?php echo '<span>'.$empresa['CompanyProfile']['rfc'].'</span>'; ?>
								</p>
							</div>
						
							<div class="col-xs-6" style="margin-top: 15px; text-align: left;">
								<p class="blackText" style="font-size: 14px;">Usuario: <?php echo $empresa['Company']['username']; ?></p>
								<p class="blackText">Razón social: <?php echo $empresa['CompanyProfile']['social_reason']; ?></p>
								<p class="blackText">Fecha de registro: <span style="font-weight: normal;"><?php  echo ' ' . date("d/m/Y",strtotime($empresa['Company']['created'])); ?> </span></p>
								<p class="blackText">Fecha de último movimiento: <span style="font-weight: normal;">
								<?php  
									if(empty($empresa['CompanyLastUpdate'])):
										echo ' ' . date("d/m/Y",strtotime($empresa['Company']['created'])); 
									else:
										echo ' ' . date("d/m/Y",strtotime($empresa['CompanyLastUpdate'][0]['modified'])); 
									endif;
								?> 
									
									</span></p>
								<p class="blackText">Contacto de la empresa:</p>
								<span class="blackText">
								<?php
									if($empresa['CompanyContact']['name']==null):
										echo '<p class="blackText"> - Nombre: </span> Sin especificar <br>';
										echo '<p class="blackText"> - Tel.: Sin especificar <br>';
										echo '<p class="blackText"> - Cel.: </span> Sin especificar </span></p>';
										echo '<p class="blackText"> - Correo: </span> Sin especificar</span></p>';
									else:
										echo '<p class="blackText"> - Nombre: </span>' . $empresa['CompanyContact']['name']. ' ' .  $empresa['CompanyContact']['last_name']. ' ' .  $empresa['CompanyContact']['second_last_name'].'<br>';
										echo '<p class="blackText"> - Tel.: </span> (' . $empresa['CompanyContact']['long_distance_cod'] .') '. $empresa['CompanyContact']['telephone_number'] . ' ';
										if($empresa['CompanyContact']['phone_extension']<>''):
											echo ' - ext. </span> '.$empresa['CompanyContact']['phone_extension'];
										endif;
										echo '<br>';
										if(($empresa['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($empresa['CompanyContact']['cell_phone']<>'')):
											echo '<p class="blackText"> - Cel.: </span> ('.$empresa['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$empresa['CompanyContact']['cell_phone'] .'</span></p>';
										endif;
										echo '<p class="blackText"> - Correo: </span> '.$empresa['Company']['email'].'</span></p>';
									endif;

									
								  ?>
								</span>
								
								
							</div>
						
						<div class="col-md-4" style=" background: #58595B; float: right;  height: 30px; padding-left: 5px; padding-right: 0px; ">
							<div style="margin-top: 3px" class="grises2">
							
								<?php 
								 // Descativar/activar empresa
									if($empresa['Company']['status'] == 0):
										echo $this->Html->image('student/noActiva.png',
											array(
												'title' => 'Empresa/Institución inactiva click para activar',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'enableDisableCompany',
																'?' => array(
																			'id' => $empresa['Company']['id'],
																			'estatus' => $empresa['Company']['status'],
																		)
																),
												)
										);
									else:
										echo $this->Html->image('student/activa.png',
											array(
												'title' => 'Empresa/Institución activa click para desactivar',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'enableDisableCompany',
																'?' => array(
																			'id' => $empresa['Company']['id'],
																			'estatus' => $empresa['Company']['status'],
																		)
																),
											));
									endif;
								?>
								
								<?php 
								 // Redirecciona a revisión
									echo $this->Html->image('administrator/r.png',
											array(
												'title' => 'Editar lineamientos de publicación y descarga de cv´s',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'companyOfferOption',$empresa['Company']['id'],
																),
												));
								?>
								
								<?php 
								 // Editar oferta
									echo $this->Html->image('student/lapiz.png',
											array(
												'title' => 'Editar Empresa/Institución',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'companyContact',
																'?' => array(
																		'company_id' => $empresa['Company']['id'],
																		'editingAdmin' => 'yes')
																),
												));
								?>
								
								<?php 
								// Actualizar contraseña de la empresa
									echo $this->Html->image('administrator/candado.png',
											array(
												'title' => 'Actualizar contraseña',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'updatePassword('.$empresa['Company']['id'].',"'.$empresa['Company']['email'].'");',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												)
												);	
								
								?>
								
								<?php 
								// Enviar email a la empresa
									echo $this->Html->image('administrator/arroba.png',
											array(
												'title' => 'Enviar correo',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveEmailNotification("'.$empresa['Company']['email'].'");',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												)
												);	
								
								?>
								
								<?php 
								 // Ver historial de la empresa
									echo $this->Html->image('administrator/clock.png',
											array(
												'title' => 'Historial de la Empresa/Institución',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Administrators',
																'action'=>'companyHistory',
																'?' => array(
																		'id' => $empresa['Company']['id'],
																		'newSearch' => 'nuevaBusqueda',
																	)
																),
												));
								?>

								<?php 
								// Envia a reportar contrataciones
									echo $this->Html->image('administrator/contratado.png',
											array(
												'title' => 'Reportar contratación',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'studentReport','nuevaBusqueda',
																'?' => array(
																		'company_id' => $empresa['Company']['id'], 
																		'editingAdmin' => 'yes',
																		)
																),
												)
											);
								?>
								
								<?php 
									 // Eliminar empresa
									 echo $this->Html->image('student/eliminar.png',
												array(
													'title' => 'Eliminar Empresa/Institución',
													'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 6px;',
													'class' => 'class="img-responsive center-block"',
													'id' => 'focusCompanyId'.$empresa['Company']['id'],
													'onclick' => 'deleteCompany('.$empresa['Company']['id'].');'
													)
											);
											
									 echo $this->Form->postLink(
															$this->Html->image('student/eliminar.png',
															array('alt' => 'Eliminar universitario', 'title' =>'Eliminar universitario', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteCompanyId'.$empresa['Company']['id'] )), 
															array('action' => 'deleteCompany',$empresa['Company']['id']), 
															array('escape' => false) 
															);
								?>
							</div>
						</div>
						
							<div class="col-xs-4" style="margin-top: 30px; text-align: left; padding-right: 0px;">
								
								<p class="blackText">
									Ofertas a publicar: <?php echo ($empresa['CompanyOfferOption']['max_offer_publication']<>null) ? $empresa['CompanyOfferOption']['max_offer_publication'] : 'Sin especificar'; ?>
									<?php echo (!empty($empresa['CompanyJobProfile'])) ? '('.count($empresa['CompanyJobProfile']).')' : ''; ?>
								</p>
								<p class="blackText">
									Curriculums a extraer: <?php echo ($empresa['CompanyOfferOption']['max_cv_download']<>null) ? $empresa['CompanyOfferOption']['max_cv_download'] : 'Sin especificar'; ?>
									<?php echo (!empty($empresa['CompanyDownloadedStudent'])) ? '('.count($empresa['CompanyDownloadedStudent']).')' : ''; ?>
								</p>
								
								
								<?php echo $this->Html->link(
														' Ver registro completo ', 
														array(
															'controller'=>'Companies',
															'action'=>'companyContact',
																'?' => array(
																		'company_id' => $empresa['Company']['id'],
																		'editingAdmin' => 'yes')
															),
														array(
															'class' => 'btn btnRed col-md-10',
															'style' => 'margin-top: 15px;',
															'escape' => false
															)	
								); 	?>
							
							</div>
						
						</div>
					<?php endforeach; ?>
				
			<?php 
				endif;
				endif; 
			?>
		</div>
		
	<div class="col-md-11" style="padding-left: 17px;">
		<?php 
		if(!empty($empresas)):
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
		echo '<div class="col-md-2 col-md-offset-7" style="top: -55px; left: 40px;">';
							echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> &nbsp;&nbsp; Regresar', 
																array(
																	'controller'=>'Administrators',
																	'action'=>'specificSearchCompany',
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
									<h4 class="modal-title" id="myModalLabel">Modificar contraseña de Empresa/Institucón</h4>
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
														'action' => 'updateCompanyPassword'
										)); ?>
										<fieldset style="margin-top: 30px;">
												<?php echo $this->Form->input('company_id', array(					
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
												<?php echo $this->Form->input('company_email', array(	
													'before' => '<div class="col-md-12 ">',
														'readonly' => 'readonly',
														'type' => 'text',
														'label' => array(
															'class' => 'col-xs-5 control-label',
															'text'=>'Envio de notificación al correo:'),
														'placeholder' => 'Envio de notificación al correo',					
												)); ?>
												<?php echo $this->Form->input('company_email_alternativo', array(
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