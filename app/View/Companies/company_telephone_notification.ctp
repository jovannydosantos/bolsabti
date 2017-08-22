<?php 
	$this->layout = 'company'; 
?>
	<script>
	
		$(document).ready(function() {
			init_contadorTa("taComentario","contadorTaComentario", 316);
			updateContadorTa("taComentario","contadorTaComentario", 316);
		});
	
		//<![CDATA[	
		function init_contadorTa(idtextarea, idcontador,max)
		{
			$("#"+idtextarea).keyup(function()
					{
						updateContadorTa(idtextarea, idcontador,max);
					});
			
			$("#"+idtextarea).change(function()
			{
					updateContadorTa(idtextarea, idcontador,max);
			});
			
		}

		function updateContadorTa(idtextarea, idcontador,max)
		{
			var contador = $("#"+idcontador);
			var ta =     $("#"+idtextarea);
			contador.html("0/"+max);
			
			contador.html(ta.val().length+"/"+max);
			if(parseInt(ta.val().length)>max)
			{
				ta.val(ta.val().substring(0,max-1));
				ta.val(ta.val().substring(0,max-1));
				contador.html(max+"/"+max);
			}

		}
	//]]> 
	
	</script>
		<?php echo $this->Session->flash(); ?>	

				
		<div class="col-md-10" style="max-height: 760px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-top: 10px;">
					
					<?php 
						foreach($candidatos as $k => $candidato):
					?>
						<div class="col-md-11" style="background: #fff none repeat scroll 0 0; min-height: 135px; margin-top: 15px; padding-left: 0px; padding-right: 0px; margin-left: 25px; right: -25px;">    
						
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
								<?php
									$caracteres = strlen($candidato['Student']['id']);
									$faltantes = 5 - $caracteres;	
									if($faltantes > 0):
										$ceros = '';
										for($cont=0; $cont<=$faltantes;$cont++):
											$ceros .= '0';
										endfor;
										$folio = $ceros.$candidato['Student']['id'];
									else:
										$folio = strlen($candidato['Student']['id']);
									endif;
									
									// Cálculo de edad
									$fecha1 = explode("-",$candidato['StudentProfile']['date_of_birth']); // fecha nacimiento
									$fecha2 = explode("-",date("Y-m-d")); // fecha actual

									$Edad = $fecha2[0]-$fecha1[0];
									if($fecha2[1]<=$fecha1[1] and $fecha2[2]<=$fecha1[2]){
									$Edad = $Edad - 1;
									}
									
									if($candidato['StudentProfile']['date_of_birth'] == '0000-00-00'):
										$Edad = 'Sin especificar';
									endif;


									// Obtiene información de idioma
									if(!empty($candidato['StudentLenguage'])):
										$numeroIdiomas = count($candidato['StudentLenguage']);
										
										if((isset($candidato['StudentLenguage'][0]['Lenguage']['lenguage'])) and (!empty($candidato['StudentLenguage'][0]['Lenguage']['lenguage']))):
											$primerIdioma = $candidato['StudentLenguage'][0]['Lenguage']['lenguage'] ;
										else:
											$primerIdioma = 'Sin especificar';
										endif;
									else:
										$numeroIdiomas = 0;
										$primerIdioma = 'Sin especificar';
									endif;
									
									// Obtiene información de áreas de interés
									if(!empty($candidato['StudentInterestJob'])):
										$numeroAreas = count($candidato['StudentInterestJob']);
										
										if((isset($candidato['StudentInterestJob'][0]['InterestArea']['interest_area'])) and (!empty($candidato['StudentInterestJob'][0]['InterestArea']['interest_area']))):
											$primerArea = $candidato['StudentInterestJob'][0]['InterestArea']['interest_area'] ;
										else:
											$primerArea = 'Sin especificar';
										endif;
									else:
										$numeroAreas = 0;
										$primerArea = 'Sin especificar';
									endif;
									

									
								?>
								<p class="blackText">Folio: <?php echo $folio; ?></p>
								<p class="blackText">Nivel académico: <span style="font-weight: normal;"><?php  echo $candidato['AcademicLevel']['academic_level']; ?> </span></p>
								<p class="blackText">Situación académica: <span style="font-weight: normal;"><?php  echo $candidato['AcademicSituation']['academic_situation']; ?> </span></p>
								<p class="blackText">Sexo: <span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['sex'] == 1) ? 'Femenino' : 'Masculino'; ?> </span></p>
								<p class="blackText">Edad: <span style="font-weight: normal;"><?php  echo $Edad; ?> </span></p>
								<p class="blackText">Idioma y nivel: <span style="font-weight: normal;"><?php  echo ($numeroIdiomas > 1) ? '<strong>('.$numeroIdiomas.'):</strong> '. $primerIdioma : $primerIdioma; ?> </span></p>
								<p class="blackText">Área de interés: <span style="font-weight: normal;"><?php  echo ($numeroAreas > 1) ? '<strong>('.$numeroAreas.'):</strong> '. $primerArea : $primerArea; ?> </span></p>
								<p class="blackText">Residencia: <span style="font-weight: normal;"><?php  echo (($candidato['StudentProfile']['state'] <> '') and ($candidato['StudentProfile']['subdivision'] <> '')) ? $candidato['StudentProfile']['state'] . ', ' . $candidato['StudentProfile']['subdivision'] : 'Sin especificar' ; ?> </span></p>
							</div>
						
						<div class="col-md-4" style=" background: #58595B; float: right;  height: 30px; padding-left: 25px;">
							
								<?php 
									$var = 0;
									$vista = 0;
									foreach($candidato['CompanyViewedStudent'] as $k => $viewed):
										if($viewed['company_id'] == ($this->Session->read('company_id'))):
											$vista = 1;
											 break;
										endif;
									endforeach;
					
									if($vista == 0):
										echo $this->Html->image('student/visto.png',
											array(
												'title' => 'Perfil no visto',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:default;'
										)); 
										
									else:
									
										echo $this->Html->image('student/noVisto.png',
											array(
												'title' => 'Perfil vistO',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:default;'
										)); 
									endif;
								
								?>
								
								<?php 
									$guardado = 0;
									$cont = -1;
									foreach($candidato['CompanySavedStudent'] as $k => $saveOffer):
									$cont++;
										if($saveOffer['company_id'] == ($this->Session->read('company_id'))):
											$guardado = 1;
											 break;
										endif;
									endforeach;
									
									if($cont > -1):
										foreach($folders as $folder):
											if($folder['CompanyFolder']['id'] == $candidato['CompanySavedStudent'][$cont]['company_folder_id']):
												$nombreFolder = $folder['CompanyFolder']['name'];
												break;
											else:
												$nombreFolder = 'Sin especificar';
											endif;
										endforeach;
									endif;
					
									if($guardado == 0):
										echo $this->Html->image('student/guardado.png',
											array(
												'title' => 'Guardar perfil',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveOffer('.$candidato['Student']['id'].');',
												'style' => 'cursor:pointer;'
											));
										
									else:
										echo $this->Html->image('student/noGuardado.png',
											array(
												'title' => 'Perfil guardado en '.$nombreFolder,
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:default;'
											));
									endif;
								
								?>
								
								<?php 
								echo $this->Html->image('student/phone.png',
											array(
												'title' => 'Postularme',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'companyTelephoneNotification', $candidato['Student']['id']
																),
												)
												);	
								
								?>
								
								<?php 
								echo $this->Html->image('student/personal.png',
											array(
												'title' => 'Postularme',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'profile'
																),
												)
												);	
								
								?>
								
								<?php 
								echo $this->Html->image('student/contratado.png',
											array(
												'title' => 'Postularme',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'profile'
																),
												)
												);	
								
								?>
								
								<?php 
								echo $this->Html->image('student/arroba.png',
											array(
												'title' => 'Postularme',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'profile'
																),
												)
												);	
								
								?>
								
								<?php 
									echo $this->Html->image('student/descargado.png',
											array(
												'title' => 'Descargar PDF',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Companies',
																'action'=>'profile'
																),
												)
											);
								?>
							
							</div>
							
								
							<div class="col-xs-4" style="margin-top: 10px; text-align: left; padding-right: 0px; padding-left: 0px;">
								<p class="blackText">Correo: <span style="font-weight: normal;"><?php  echo $candidato['Student']['email']; ?> </span></p>
								<p class="blackText">Teléfono casa: <span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['telephone_contact'] <> '') ? $candidato['StudentProfile']['lada_telephone_contact'].$candidato['StudentProfile']['telephone_contact'] : 'Sin especificar';  ?> </span></p>
								<p class="blackText">Celular: <span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['cell_phone'] <> '') ? $candidato['StudentProfile']['lada_cell_phone'].$candidato['StudentProfile']['cell_phone'] : 'Sin especificar'; ?> </span></p>
								
								<?php echo $this->Html->link(
														' Ver perfil completo ', 
														array(
															'controller'=>'Companies',
															'action'=>'viewCvOnline', $candidato['Student']['id']),
														array(
															'class' => 'btn btnRed col-md-8',
															'style' => 'margin-top: 5px;margin-left: 70px;',
															'escape' => false)	
								); 	?>
							
							</div>
						
						</div>
					<?php endforeach; ?>
		</div>
					
					
					
					
			
				
				
