<?php 
	$this->layout = 'student'; 
?>
<script>
	$(document).ready(function() {
		 var helpText = [
						"Guarda y nombra las consultas de ofertas en carpetas para una mejor organización. Las carpetas creadas se ordenarán alfabéticamente.",
						]; 
				 
				$('.form-group').each(function(index, element) {
					$(this).find(".cambia").attr("id", index);
					$(this).find('#'+index).attr("data-original-title", helpText[index]);
				});
		
		});	
</script>
	<style>
		.panel-default > .panel-heading {
			background: #002377 none repeat scroll 0 0;
			color: #fff;
		}
		.panel-heading {
			border-top-left-radius: 0px;
			border-top-right-radius: 0px;
		}
		.panel {
			border-radius: 0px;
		}
		.panel-body {
			background: #fff none repeat scroll 0 0;
			color: #000;
		}
		h3{
			font-weight: bold;
		}
		.panel {
			box-shadow:  0 0 0 rgba(0, 0, 0, 0.8);
		}
		.catorce{
			font-size: 14px;
			font-weight: bold;
		}
	</style>
	
	
	<div>
		<?php echo $this->Session->flash(); ?>
		
		<div class="col-xs-12" style="margin-top: 40px;">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Oferta</h3>
				
						<div class="col-xs-3" style=" float: right;  margin-top: -23px; width: 175px;">
								
								<?php 
									$var = 0;
									$vista = 0;
									foreach($oferta['StudentViewedOffer'] as $k => $viewed):
										if($viewed['student_id'] == ($this->Session->read('student_id'))):
											$vista = 1;
											 break;
										endif;
									endforeach;
					
									if($vista == 0):
										echo $this->Html->image('student/visto.png',
											array(
												'title' => 'Oferta no vista',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:default;'
										)); 
										
									else:
									
										echo $this->Html->image('student/noVisto.png',
											array(
												'title' => 'Oferta vista',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:default;'
										)); 
									endif;
								
								?>
								
								
								<?php 
									$postulado = 0;
									foreach($oferta['Application'] as $k => $application):
										if($application['student_id'] == ($this->Session->read('student_id'))):
											$postulado = 1;
											 break;
										endif;
									endforeach;
					
									if($postulado == 0):
										echo $this->Html->image('student/perfilEnviado.png',
											array(
												'title' => 'Postularme',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Students',
																'action'=>'postullation', $oferta['CompanyJobProfile']['id'] ),
																)
												);	
									else:
										echo $this->Html->image('student/noPerfilEnviado.png',
											array(
												'title' => 'Postulado',
												'class' => 'class="img-responsive center-block"',
											));
									endif;
								
								?>
								
								<?php 
									$guardado = 0;
									foreach($oferta['StudentSavedOffer'] as $k => $saveOffer):
										if($saveOffer['student_id'] == ($this->Session->read('student_id'))):
											$guardado = 1;
											 break;
										endif;
									endforeach;
					
									if($guardado == 0):
										echo $this->Html->image('student/guardado.png',
											array(
												'title' => 'Guardar oferta',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveOffer('.$oferta['CompanyJobProfile']['id'].',"searchOffer");',
												'style' => 'cursor:pointer;'
											));
										
									else:
									
										echo $this->Html->image('student/noGuardado.png',
											array(
												'title' => 'Oferta guardada en '.$oferta['StudentFolder'][0]['name'],
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:default;'
											));
									endif;
								
								?>
								
								<?php 
									$reportado = 0;
									foreach($oferta['Report'] as $k => $ofertaReportada):
										if($ofertaReportada['student_id'] == ($this->Session->read('student_id'))):
											$reportado = 1;
											break;
										endif;
									endforeach;
					
									if($reportado == 0):
										echo $this->Html->image('student/contratado.png',
											array(
												'title' => 'Reportar contratación ',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Students',
																'action'=>'report', $oferta['CompanyJobProfile']['id'] 
																),
												)
										);
									else:
										echo $this->Html->image('student/noContratado.png',
											array(
												'title' => 'Contratación reportada ',
												'class' => 'class="img-responsive center-block"',
												'style' => 'cursor:default;'
											));
									endif;
								?>
								
								<?php 
									echo $this->Html->image('student/descargado.png',
											array(
												'title' => 'Descargar PDF',
												'class' => 'class="img-responsive center-block"',
												'url' => array(
																'controller'=>'Students',
																'action'=>'profile'),
											));

								
								?>
								
							</div>
			  </div>
			  <div class="panel-body" style="text-align: center">
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
						
						// echo '<b style="font-size: 14px;">'.$oferta['CompanyJobOffer']['company_name']; echo ($oferta['CompanyJobOffer']['confidential_job_offer']=='s') ? ' / Oferta Confidencial</b><br>' :'</b><br>'; 
						?>
						<b style="font-size: 24px;">
									<?php 
										if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
											echo 'Confidencial'; 
										else:
											if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']=='')):
												echo 'Confidencial';
											else:
												if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
													echo $oferta['CompanyJobOffer']['company_name']; 
												else:
													if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($oferta['CompanyJobOffer']['company_name']=='')):
														echo $oferta['Company']['CompanyProfile']['company_name'];
													else:
														echo 'Sin especificar';
													endif;
												endif;
											endif;
										endif;
									?>
						</b><br>
						<?php
						echo '<b style="font-size: 14px;">Puesto:</b><span style="color:#000; font-size: 14px;"> ' . $oferta['CompanyJobProfile']['job_name'] . '</span><br>';
						echo '<b style="font-size: 14px;">Folio:</b><span style="color:#000; font-size: 14px;">  ' .$folio. '</span><br>';
						echo '<b style="font-size: 14px;">Vigencia:</b><span style="color:#000; font-size: 14px;">  ' . date("d/m/Y",strtotime($oferta['CompanyJobProfile']['expiration'])) . '</span>';
					?>
					<br>
			  </div>
			</div>
		</div>
		
		<?php if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): ?>
		<div class="col-xs-12">
			<div class="panel panel-default" style="padding-left: 0px;">
					<div class="panel-heading">
						<h3 class="panel-title" >Responsable de la oferta</h3>
					</div>
					<div class="panel-body" style="text-align: left">
						<div class="col-md-12">
							  <?php 
									if($oferta['CompanyJobOffer']['same_contact']=='n'):
										echo '<span class="catorce">Nombre: </span>' . $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'].'<br>';
										echo '<span class="catorce">Puesto: </span>' . $oferta['CompanyJobOffer']['responsible_position'] . '<br>';
										echo '<span class="catorce">Tel.: </span> (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
											if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
												echo ' <span class="catorce"> - ext. </span> '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
											endif;
											echo '<br>';
										if($oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']<>''):
											echo '<span class="catorce">Cel.: </span> ('.$oferta['CompanyJobOffer']['responsible_long_distance_cod_cell_phone']. ') ' .$oferta['CompanyJobOffer']['responsible_cell_phone'] .'<br>';
										endif;
										
									else:
										echo '<span class="catorce">Nombre: </span>' . $oferta['Company']['CompanyContact']['name']. ' ' .  $oferta['Company']['CompanyContact']['last_name']. ' ' .  $oferta['Company']['CompanyContact']['second_last_name'].'<br>';
										echo '<span class="catorce">Puesto: </span>' . $oferta['Company']['CompanyContact']['job_title'] . '<br>';
										echo '<span class="catorce">Tel.: </span> (' . $oferta['Company']['CompanyContact']['long_distance_cod'] .') '. $oferta['Company']['CompanyContact']['telephone_number'] . ' ';
											if($oferta['Company']['CompanyContact']['phone_extension']<>''):
												echo ' <span class="catorce"> - ext. </span> '.$oferta['Company']['CompanyContact']['phone_extension'];
											endif;
										echo '<br>';
										if($oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']<>''):
											echo '<span class="catorce">Cel.: </span> ('.$oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$oferta['Company']['CompanyContact']['cell_phone'] .'<br>';
										endif;
										
									endif;
							
								if($oferta['Company']['CompanyProfile']['state_sede']<>''):
									echo 	'<span class="catorce">Sede: </span> ' . $oferta['Company']['CompanyProfile']['state_sede'] . ' ' .
											$oferta['Company']['CompanyProfile']['city_sede'] . ' ' .
											$oferta['Company']['CompanyProfile']['subdivision_sede'] . ' ' .
											$oferta['Company']['CompanyProfile']['street_sede'] . ' ' .
											'<br>';
								endif;
							  ?>
						  <br><br>
						</div>
					</div>
			</div>
		</div>
		<?php endif; ?>
		
		<div class="col-md-12">
			<div class="panel panel-default" style="padding-right: 0px; " >
				  <div class="panel-heading">
					<h3 class="panel-title" >Perfil de la oferta <span style="float: right;">Número de vacantes: <span style="color: #FFB71F;"><?php echo ' ' . $oferta['CompanyJobProfile']['vacancy_number']; ?> </span></span></h3>
				  </div>
				  <div class="panel-body" style="text-align: left; max-height: 200px; overflow-y: auto;">
					
					<?php 
						echo '<div class="col-md-12"><span class="catorce">Giro:</span> ' . $oferta['Rotation']['rotation'].'</div>';
						echo '<div class="col-md-6"><span class="catorce">Área de Interés:</span> ' . $oferta['InterestArea']['interest_area'] . '</div>';
						if($oferta['ExperienceTime']['experience_time']<>''):
							echo '<div class="col-md-6"><span class="catorce">Tiempo de Experiencia:</span> ' . $oferta['ExperienceTime']['experience_time'].'</div>';
						endif;
						echo '<div class="col-md-12"><span class="catorce">Subárea de Experiencia:</span> ' . $oferta['ExperienceSubarea']['experience_subarea'] . '</div><br>';
					?>
					
					<br><br><br>
					<div class="col-md-12">
						Actividades a desarrollar:
						<br><br>
						
						<?php 	
							echo $oferta['CompanyJobProfile']['activity'] . '<br>'; 
						?>
					</div>
					
					<?php 	
						if($oferta['CompanyJobProfile']['disability'] == 's'):
					?>
						<br><br><br><br>
						<div class="col-md-12">
							<span class="catorce">Oferta Incluyente:</span><?php echo ' ' . $oferta['DisabilityType']['disability_type']; ?>
						</div><br><br>
					<?php 	
						endif;
					?>
					
					
				  </div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Modalidad de contratación</h3>
			  </div>
			  <div class="panel-body" style="text-align: left; max-height: 400px; overflow-y: auto;">
				<div class="col-md-12">
				<?php 
					echo '<span class="catorce">Sueldo: </span>'; 
							if($oferta['CompanyJobContractType']['confidential_salary']=='s'):
								echo 'Confidencial';
							else:
								echo  $oferta['CompanyJobContractType']['Salary']['salary']; 
							endif;
					echo '<br>';
					// echo '<span class="catorce">Prestaciones: </span>' . $oferta['CompanyJobContractType']['Benefit']['benefit'] . '<br><br>';
					if(!empty($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit'])):
						echo '<span class="catorce">Prestaciones: </span>';
						$cont = 0;
						foreach($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit'] as $beneficio):
							$cont++;
							echo $beneficio['Benefit']['benefit'];
							if(count($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit']) <> $cont):
								echo ' / ';
							endif;
						endforeach;
						'<br><br>';
					endif;
				?>
				</div>
				<div class="col-md-8">
				<?php
					echo '<span class="catorce">Lugar de trabajo: </span>' . $oferta['CompanyJobContractType']['state'] . ' ' . $oferta['CompanyJobContractType']['subdivision'] . '<br>';
					echo '<span class="catorce">Tipo de contrato: </span>' . $oferta['CompanyJobContractType']['ContractType']['contract_type'] . '<br>';
					echo '<span class="catorce">Jornada laboral: </span>' . $oferta['CompanyJobContractType']['Workday']['workday'] . '<br>';
							if($oferta['CompanyJobContractType']['mobility']=='s'):
								echo '<span class="catorce">Disponibilidad para viajar: </span>' ;
								if($oferta['CompanyJobContractType']['mobility_option']=='1'):
									echo 'Dentro del país - '. $oferta['CompanyJobContractType']['mobility_city'];
								else:
									echo 'Fuera del país  - '. $oferta['CompanyJobContractType']['mobility_city'];
								endif;
								echo  '<br>';
							else:
								echo '<span class="catorce">Disponibilidad para viajar:</span> No <br>';
							endif;
							
							if($oferta['CompanyJobContractType']['change_residence']=='s'):
								echo '<span class="catorce">Disponibilidad para cambiar de residencia: </span>' ;
								if($oferta['CompanyJobContractType']['change_residence_option']=='1'):
									echo 'Dentro del país - '. $oferta['CompanyJobContractType']['change_residence_option'];
								else:
									echo 'Fuera del país  - '. $oferta['CompanyJobContractType']['change_residence_state'];
								endif;
								echo  '<br>';
							else:
								echo '<span class="catorce">Disponibilidad para cambiar de residencia:</span> No <br>';
							endif;
				?>
				</div>
				
				<div class="col-md-4">
					<?php 
						echo '<span class="catorce">Duración del contrato: </span>' . $oferta['CompanyJobContractType']['contract_length'].'<br>';
						echo '<span class="catorce">Horario: </span>' . $oferta['CompanyJobContractType']['schedule'].'<br>';
					?>
				
				</div>
				
			  </div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Perfil del candidato</h3>
			  </div>
			  <div class="panel-body" style="text-align: left">
				
				<div class="col-md-7">
				
					<?php 
					$ban = 0;
					if($oferta['CompanyCandidateProfile']['licenciatura'] <> 0):
						echo  '<span class="catorce">Licenciatura</span><br> ' ; $ban = 1;
					 endif;
					 
					 if($oferta['CompanyCandidateProfile']['especialidad'] <> 0): 
						echo  '<span class="catorce">Especialidad</span><br> ' ; $ban = 1;
					 endif;
					 
					 if($oferta['CompanyCandidateProfile']['maestria'] <> 0):
						echo  '<span class="catorce">Maestria</span> <br> ' ; $ban = 1;
					 endif;
					 
					  if($oferta['CompanyCandidateProfile']['doctorado'] <> 0):
						echo  '<span class="catorce">Doctorado</span><br> ' ; $ban = 1;
					 endif;
					
					if($ban > 0):
						echo $situacionAcademica[$oferta['CompanyCandidateProfile']['academic_situation']];
					endif;
					
					
					?>
				
			
				
				</div>
				
				<div class="col-md-5">
				<?php 
				if(!empty($computos)):
					echo '<span class="catorce">Cómputo: </span><br>';
					foreach($computos as $k => $computo):
						echo 'Software: '.$programas[$computo['CompanyJobComputingSkill']['name']].'<br>';
					endforeach;
				endif;
				?><br>
				</div>
				
				
				<div class="col-md-7">
				<?php 
				if(!empty($idiomas)):
					echo '<span class="catorce">Idiomas: </span><br>';
					foreach($idiomas as $k => $idioma):
						echo $idioma['Lenguage']['lenguage'].': lectura - '. $niveles[$idioma['CompanyJobLanguage']['reading_level']]
															.' / escritura - '. $niveles[$idioma['CompanyJobLanguage']['writing_level']]
															.' / conversación - '. $niveles[$idioma['CompanyJobLanguage']['conversation_level']].   '<br>';
					endforeach;
				endif;
				?><br>
				</div>
				
				<div class="col-md-5">
					<?php if($oferta['CompanyJobProfile']['professional_skill']<>''): ?>
						<span class="catorce">Conocimientos y habilidades profesionales: </span><br>
					<?php 
						echo $oferta['CompanyJobProfile']['professional_skill'] . '<br>'; 
						endif;
					?>
					
				</div>
				
				<div class="col-md-7">
				<?php 
				$contador = 1 ;
				if(!empty($competencias)):
					echo '<span class="catorce">Competencias: </span><br>';
					foreach($competencias as $k => $competencia):
						echo $contador.'.- '.$tiposCompetencias[$competencia['CompanyJobOfferCompetency']['competency_id']].'<br>';
						$contador++;
					endforeach;
				endif;
				?><br>
				</div>
			  </div>
			</div>
		</div>
		
	</div>	
	
		<div class="col-md-offset-10">
			<a class="btn btn-default btnBlue " style="margin-top: 5px; width: 150px;" onclick="goBack();"><i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar</a>
		</div>
		</div>