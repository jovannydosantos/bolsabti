<?php 
	$this->layout = 'student'; 
?>
<div class="scrollbar" id="style-2" >

	<!--Oferta-->
	<div class="col-md-12">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title" >Oferta</h3>
		  </div>
		  <div class="panel-body" style="text-align: center">
		  		<div class="col-md-12">
					<?php 
						$vista = 0;
						foreach($oferta['StudentViewedOffer'] as $k => $viewed):
							if($viewed['student_id'] == ($this->Session->read('student_id'))):
								$vista = 1;
								 break;
							endif;
						endforeach;

						if($vista == 0):
							echo $this->Html->image('student/noVisto.png',
									['title' => 'Oferta no vista',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono']); 
						else:
							echo $this->Html->image('student/visto.png',
									['title' => 'Oferta vista',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono']); 
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
							echo $this->Html->image('student/noPostulado.png',
								   ['title' => 'Postularme',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => [	'controller'=>'Students',
												'action'=>'postullation', $oferta['CompanyJobProfile']['id'] ]]);	
						else:
							echo $this->Html->image('student/postulado.png',
									['title' => 'Postulado',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',]);
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
							echo $this->Html->image('student/noGuardado.png',
									['title' => 'Guardar oferta',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'onclick' => 'saveOffer('.$oferta['CompanyJobProfile']['id'].',"searchOffer");',
									'class' => 'icono',]);
						else:
							echo $this->Html->image('student/guardado.png',
									['title' => 'Oferta guardada en '.$oferta['StudentFolder'][0]['name'],
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',]);
						endif;
					?>
					
					<?php 
						$reportado = 0;
						foreach($oferta['Report'] as $k => $ofertaReportada):
							if(($ofertaReportada['student_id'] == ($this->Session->read('student_id')) AND ($ofertaReportada['registered_by'] =='student' ))):
								$reportado = 1;
								break;
							endif;
						endforeach;
		
						if($reportado == 0):
							echo $this->Html->image('student/noContratado.png',
									['title' => 'Reportar contratación ',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',
									'url' => ['controller'=>'Students',
											'action'=>'report', $oferta['CompanyJobProfile']['id'] ]]
							);
						else:
							echo $this->Html->image('student/contratado.png',
									['title' => 'Contratación reportada ',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',]);
						endif;
					?>
					
					<?php 
						echo $this->Html->link($this->Html->image('student/noDescargado.png', 
									['escape' => false,'style' => 'width: 25px; height: 25px; margin-right: 6px; cursor: pointer; ']),
									['controller' => 'Students', 
									'action' => 'viewOnlyOfferPdf',$oferta['CompanyJobProfile']['id']], 
									['target' => '_blank','escape' => false,
									'title' => 'Descargar oferta en PDF',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'class' => 'icono',]);
					?>	
	
			</div>

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
			<b style="font-size: 20px;">
				<?php 
					if(($oferta['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($oferta['CompanyJobOffer']['company_name']<>'')):
						echo $oferta['CompanyJobOffer']['company_name']; 
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
									echo 'Sin nombre de empresa';
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
	
	
	<!--Responsable de la oferta-->
	<?php  if($oferta['CompanyJobOffer']['show_details_responsible']=='s'): ?>
		<div class="col-md-12">
			<div class="panel panel-default" style="padding-left: 0px;">
			  <div class="panel-heading">
				<h3 class="panel-title">Responsable de la oferta</h3>
			  </div>
			  <div class="panel-body" style="text-align: left">
			<div class="col-md-12">
			  <?php 
				if($oferta['CompanyJobOffer']['same_contact']=='n'):
					echo '<span class="catorce">Nombre: </span>' . $oferta['CompanyJobOffer']['responsible_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_last_name']. ' ' .  $oferta['CompanyJobOffer']['responsible_second_last_name'].'<br>';
					echo '<span class="catorce">Puesto: </span>' . $oferta['CompanyJobOffer']['responsible_position'] . '<br>';
					echo '<span class="catorce">Tel.: </span> (' . $oferta['CompanyJobOffer']['responsible_long_distance_cod'] .') '. $oferta['CompanyJobOffer']['responsible_telephone'] . ' ';
					if($oferta['CompanyJobOffer']['responsible_phone_extension']<>''):
						echo '<span class="catorce"> - ext. </span> '.$oferta['CompanyJobOffer']['responsible_phone_extension'];
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
					if(($oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']<>'') and ($oferta['Company']['CompanyContact']['cell_phone']<>'')):
						echo '<span class="catorce">Cel.: </span> ('.$oferta['Company']['CompanyContact']['long_distance_cod_cell_phone']. ') ' .$oferta['Company']['CompanyContact']['cell_phone'] .'<br>';
					endif;
				endif;
			  ?>
			  </div>
			  </div>
			</div>
		</div>
	<?php endif; ?>
	
	<!--Perfil de la oferta-->
	<div class="col-md-12">
		<div class="panel panel-default" style="padding-right: 0px; " >
			  <div class="panel-heading">
				<h3 class="panel-title" >Perfil de la oferta <span style="float: right;">Número de vacantes: <span style="color: #FFB71F;"><?php echo ' ' . $oferta['CompanyJobProfile']['vacancy_number']; ?> </span></span></h3>
			  </div>
			  <div class="panel-body" style="text-align: left; max-height: 200px; overflow-y: auto;">
				
				<?php 
					echo '<div class="col-md-12"><span class="catorce">Giro:</span> ' . $oferta['Rotation']['rotation'].'</div>';
					echo '<div class="col-md-6"><span class="catorce">Área de Interés:</span> ' . $oferta['ExperienceArea']['experience_area'] . '</div>';
					if($oferta['ExperienceTime']['experience_time']<>''):
						echo '<div class="col-md-6"><span class="catorce">Experiencia:</span> ' . $oferta['ExperienceTime']['experience_time'].'</div>';
					endif;
				?>
				
				<br><br><br>
				<div class="col-md-12">
					<span class="catorce">Actividades a desarrollar:</span><br><?= $oferta['CompanyJobProfile']['activity'] . '<br>'; ?>
				</div>
				
				<?php 	
					if($oferta['CompanyJobProfile']['disability'] == 's'):
				?>
					<br><br><br>
					<div class="col-md-12">
						<span class="catorce">Oferta Incluyente:</span><?php echo ' ' . $oferta['DisabilityType']['disability_type']; ?>
					</div><br>
				<?php 	
					endif;
				?>
			  </div>
		</div>
	</div>
	
	<!--Modalidad de contratación-->
	<div class="col-md-12">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title" >Modalidad de contratación</h3>
		  </div>
		  <div class="panel-body" style="text-align: left; max-height: 400px; overflow-y: auto;">
			<div class="col-md-12">
			<?php 
				if(isset($oferta['CompanyJobContractType']['confidential_salary'])):
					echo '<span class="catorce">Sueldo: </span>'; 
					if($oferta['CompanyJobContractType']['confidential_salary']=='s'):
						echo 'Confidencial';	
					else:
						echo $oferta['CompanyJobContractType']['Salary']['salary'];
					endif;
					echo '<br>';
				endif;
				
				
				if(!empty($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit'])):
					echo '<span class="catorce">Prestaciones: </span>';
					$cont = 0;
					foreach($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit'] as $beneficio):
						$cont++;
						echo $beneficio['Benefit']['benefit'];
						if(count($oferta['CompanyJobContractType']['CompanyJobContractTypeBenefit']) <> $cont):
							echo ' / ';
						else:
							echo '<br>';
						endif;
					endforeach;
				endif;
				
				if($oferta['CompanyJobContractType']['other_benefits']<>''):
					echo '<span class="catorce">Otras prestaciones: </span>'; 
					echo $oferta['CompanyJobContractType']['other_benefits'];
					echo '<br>';
				endif;
				echo '<br>';
				
			?>
			</div>
			<div class="col-md-8">
			<?php
				if(isset($oferta['CompanyJobContractType']['state'])):
					echo '<span class="catorce">Lugar de trabajo: </span>' . $oferta['CompanyJobContractType']['state'] . ' ' . $oferta['CompanyJobContractType']['subdivision'] . '<br>';
				endif;
				if(isset($oferta['CompanyJobContractType']['ContractType']['contract_type'] )):
					echo '<span class="catorce">Tipo de contrato: </span>' . $oferta['CompanyJobContractType']['ContractType']['contract_type'] . '<br>';
				endif;
				if(isset($oferta['CompanyJobContractType']['Workday']['workday'])):
					echo '<span class="catorce">Jornada laboral: </span>' . $oferta['CompanyJobContractType']['Workday']['workday'] . '<br>';
				endif;
				
				if(isset($oferta['CompanyJobContractType']['mobility'])):
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
				endif;
				
				if(isset($oferta['CompanyJobContractType']['change_residence'])):
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
				endif;
			?>
			</div>
			
			<div class="col-md-4">
				<?php 
					if(isset($oferta['CompanyJobContractType']['contract_length'])):
						echo '<span class="catorce">Duración del contrato: </span>' . $oferta['CompanyJobContractType']['contract_length'].'<br>';
					endif;
					
					if(isset($oferta['CompanyJobContractType']['schedule'])):
						echo '<span class="catorce">Horario: </span>' . $oferta['CompanyJobContractType']['schedule'].'<br>';
					endif;
				?>
			
			</div>
			
		  </div>
		</div>
	</div>
	
	<!--Perfil del candidato-->
	<?php if((!empty($oferta['CompanyCandidateProfile']) AND ($oferta['CompanyCandidateProfile']<>null)) || (!empty($computos)) || (!empty($idiomas)) || ($oferta['CompanyJobProfile']['professional_skill']<>'') || (!empty($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency']))): ?>
	<div class="col-md-12">
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title" >Perfil del candidato</h3>
		  </div>
		  <div class="panel-body" style="text-align: left">
			
			<?php if(!empty($oferta['CompanyCandidateProfile']) AND ($oferta['CompanyCandidateProfile']<>null)): ?>
			<div class="col-md-12">
				<span class="catorce">Nivel academico:</span>
				<br>
				<?php 
					foreach($oferta['CompanyCandidateProfile'] as $nivel):	
						echo $nivel['AcademicLevel']['academic_level'].' - '.$nivel['AcademicSituation']['academic_situation'];
						if($nivel['academic_situation_id']==1):
							echo ' ' . $nivel['semester'] . '° semestre';
						endif;
						echo ':<br>';
						$cont = 0;
						foreach($nivel['CompanyJobRelatedCareer'] as $k => $carrera):
							$cont++;
							echo  $CarrerasAreas[$carrera['career_id']];
							if(count($nivel['CompanyJobRelatedCareer']) <> $cont):
								echo ' / ';
							endif;
						endforeach;	
						echo '<br><br>';
					endforeach;
				?>
			</div>
			<?php endif; ?>
			
			<div class="col-md-12">
			<?php 
			if(!empty($computos)):
				echo '<span class="catorce">Cómputo: </span><br>';
				foreach($computos as $k => $computo):
					echo $Tecnologias[$computo['CompanyJobComputingSkill']['category_id']] . ': ';
					if($computo['CompanyJobComputingSkill']['name']<>''):
						echo $Programas[$computo['CompanyJobComputingSkill']['name']];
					else:
						echo $computo['CompanyJobComputingSkill']['other'];
					endif;
					echo '<br>';
				endforeach;
			endif;
			?>
			</div>
			
			<div class="col-md-7">
			<?php 
			if(!empty($idiomas)):
				echo '<span class="catorce">Idiomas: </span><br>';
				foreach($idiomas as $k => $idioma):
					echo $idioma['Lenguage']['lenguage'].': Lectura - '. $niveles[$idioma['CompanyJobLanguage']['reading_level']]
														.' / Escritura - '. $niveles[$idioma['CompanyJobLanguage']['writing_level']]
														.' / Conversación - '. $niveles[$idioma['CompanyJobLanguage']['conversation_level']].   '<br>';
				endforeach;
			endif;
			?>
			</div>
			
			<div class="col-md-5" >
				<?php 	
						if($oferta['CompanyJobProfile']['professional_skill']<>''): 
				?>
							<div class="col-md-11" style="margin-left: -15px;">
							<span class="catorce">Conocimientos y habilidades profesionales: </span><br>
				<?php 
							echo $oferta['CompanyJobProfile']['professional_skill'] . '<br>'; 
				?>
						</div>
				<?php 		
						endif;
				?>
			</div>
			
				<?php 
				$contador = 1;
				if(!empty($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'])):
				?>
					<div class="col-md-12" style="margin-bottom: 30px;">
				<?php 
						echo '<br><span class="catorce">Competencias: </span><br>';
						foreach($oferta['CompanyCandidateProfile']['CompanyJobOfferCompetency'] as $k => $competencia):
				?>
							<div class="col-md-4">
				<?php 
								echo $contador.'.- '.$tiposCompetencias[$competencia['competency_id']].'<br>';
								$contador++;
				?>
							</div>
				<?php
						endforeach;
				?>
					</div>
				<?php
				endif;
				?>
			
			</div>
		  </div>
		</div>
	<?php endif; ?>
</div>
	

	<div class="col-md-12 text-center">
		<a class="btn btn-info" style="margin-top: 5px; width: 150px;" href="javascript:window.history.back();"><i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar</a>
	</div>