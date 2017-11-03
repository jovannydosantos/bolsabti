<?php 
	foreach($candidatos as $k => $candidato):

?>
<script>


</script>

<div class="col-md-12 sombra" style="border: 1px solid #1a75bb; margin-bottom: 15px; background: url('/bolsabti/img/satinweave.png');">    	
	<div class="col-md-2 visible-lg visible-md" style="margin-top: 1%; padding-left: 0px; padding-right: 0px;">
		<center>
		<?php
			if (isset($candidato)):
				if(isset($candidato['Student']['filename'])):
					$url = WWW_ROOT.'img/uploads/student/filename/'.$candidato['Student']['filename'];
					if(!file_exists( $url )):
						echo $this->Html->image('student/imagenNoEncontrada.png',
									array(
										'alt' => 'Profile Photo',
										'style' => 'width:100px; height: 100px; '
									));
					else:
						if($candidato['Student']['filename'] <> ''):
							echo $this->Html->image('uploads/student/filename/'.$candidato['Student']['filename'],
										array(
											'alt' => 'Profile Photo',
											'style' => 'width:100px; height: 100px; '
										));
						else:
							echo $this->Html->image('student/imagenNoDisponible.png',
										array(
											'alt' => 'Profile Photo',
											'style' => 'width:100px; height: 100px; '
										));
						endif;
					endif;
				else:
					echo $this->Html->image('student/imagenNoDisponible.png',
									array(
										'alt' => 'Profile Photo',
										'width' => '100px',
										'height' => '100px',	
									));
				endif;
			else:
				echo $this->Html->image('student/imagenNoDisponible.png',
									array(
										'alt' => 'Profile Photo',
										'width' => '100px',
										'height' => '100px',
									));
			endif;
		?>
		<p class="blackText" style="margin-top: 5px;">
			<?php echo $candidato['StudentProfile']['name'].' '.$candidato['StudentProfile']['last_name'].' '.$candidato['StudentProfile']['second_last_name']; ?>
		</p>
		</center>
	</div>			
				
	<div class="col-md-5" style="margin-top: 5px;margin-bottom: 5px;">
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
		<span><strong>Folio: </strong><?php echo $folio; ?></span><br />
		<span><strong>Nivel acedemico: </strong><?php echo $candidato['AcademicLevel']['academic_level']; ?> </span></br>
		<span><strong>Situación académica: </strong><?php  echo $candidato['AcademicSituation']['academic_situation']; ?> </span></br>
		<span><strong>Sexo: </strong><?php  echo ($candidato['StudentProfile']['sex'] == 1) ? 'Femenino' : 'Masculino'; ?> </span></br>
		<span><strong>Edad: </strong><?php  echo $Edad; ?> </span></br>
		<span><strong>Idioma y nivel: </strong><?php  echo ($numeroIdiomas > 1) ? '<strong>('.$numeroIdiomas.'):</strong> '. $primerIdioma : $primerIdioma; ?> </span></br>
		<span><strong>Área de interés: </strong><?php  echo ($numeroAreas > 1) ? '<strong>('.$numeroAreas.'):</strong> '. $primerArea : $primerArea; ?> </span></br>
		<span><strong>Residencia: </strong><?php  echo (($candidato['StudentProfile']['state'] <> '') and ($candidato['StudentProfile']['subdivision'] <> '')) ? $candidato['StudentProfile']['state'] . ', ' . $candidato['StudentProfile']['subdivision'] : 'Sin especificar' ; ?></span></br>
		
	</div>
					
	<div class="col-md-4" style="margin-top: 15px;">
		<center>
			<div style="margin-top: 3px; margin-left: 5px;" class="grises2">
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
						echo $this->Html->image('student/noVisto.png',
								['title' => 'Perfil no visto',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',]);
						
					else:
						echo $this->Html->image('student/visto.png',
							['title' => 'Perfil visto',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'class' => 'icono',]);
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
								'class' => 'icono',
								'onclick' => 'saveOffer('.$candidato['Student']['id'].');',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
					));
						
					else:
						echo $this->Html->image('student/noGuardado.png',
							array(
								'title' => 'Perfil guardado en '.$nombreFolder,
								'class' => 'icono',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
						));
					endif;
				?>
				<?php 
					echo $this->Html->image('student/phone.png',
						['title' => 'Agendar entrevista telefónica',
							'data-toggle'=>'tooltip',
							'data-placement'=>'left',
							'onclick' => 'saveTelephoneNotification('.$candidato['Student']['id'].');',
							'class' => 'icono',]);
					
				?>
				<?php 
				echo $this->Html->image('student/personal.png',
							['title' => 'Agendar entrevista presencial',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
									'onclick' => 'savePersonalNotification('.$candidato['Student']['id'].');',
							'class' => 'icono',]);		
				?>
				<?php 
					echo $this->Html->image('student/contratado.png',
						['title' => 'Reportar contratación',
							'data-toggle'=>'tooltip',
							'data-placement'=>'left',
							'onclick' => 'saveReportarContratacion('.$candidato['Student']['id'].');',
							'class' => 'icono',]);
				?>  
				
				<?php 
					echo $this->Html->image('student/arroba.png',
						['title' => 'Enviar correo',
								'data-toggle'=>'tooltip',
								'data-placement'=>'left',
								'onclick' => 'saveEmailNotification("'.$candidato['Student']['email'].'");',
								'class' => 'icono',]);		
				?>
				<?php
					$cvCompleto = '';
					if(($candidato['StudentProfile']['sex']<>'') and (!empty($candidato['StudentProfessionalProfile'])) and (!empty($candidato['StudentJobProspect'])) and ($candidato['StudentJobProspect']['id']<>null) and (!empty($candidato['StudentProspect']))  and ($candidato['StudentProspect']['id']<>null)):
						$cvCompleto = 'Si';
					else:
						$cvCompleto = 'No';
					endif;
				?>
				<?php 
				 if($cvCompleto == 'Si'):
					if($company['CompanyOfferOption']['max_cv_download'] <> null):
						if($totalDescargas>=$company['CompanyOfferOption']['max_cv_download']):
							echo $this->Html->image('student/noDescargado.png',
								array(
									'title' => 'Descargar CV en PDF',
									'class' => 'icono',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'onclick' => 'mensajeLimiteDescargas();',
									));	
						else:
							echo $this->Html->link(
								$this->Html->image('student/noDescargado.png', array('escape' => false,'style' => 'width: 17px; height: 20px; margin-right: 6px; cursor: pointer; ')),
								array(
									'controller' => 'Companies', 
									'action' => 'viewCvPdf',$candidato['Student']['id'] 
									), 
								array('target' => '_blank',
									'escape' => false,
									'title' => 'Descargar CV en PDF',
									'class' => 'icono',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									));
							endif;
						else:
							echo $this->Html->image('student/noDescargado.png',
								array(
									'title' => 'Descargar CV en PDF',
									'class' => 'icono',
									'data-toggle'=>'tooltip',
									'data-placement'=>'left',
									'onclick' => 'mensajeSinConfigurar();', 
									));	
							endif;
						else:
							echo $this->Html->image('student/noDescargado.png',
									array(
										'title' => 'Descargar CV en PDF',
										'class' => 'icono',
										'data-toggle'=>'tooltip',
										'data-placement'=>'left',
										'onclick' => 'cvIncompleto();',
										));	
						endif;
				?>
			</div>
				<span><strong>Correo: </strong><?php  echo $candidato['Student']['email']; ?></span><br />
				<span><strong>Teléfono casa: </strong><?php  echo ($candidato['StudentProfile']['telephone_contact'] <> '') ? $candidato['StudentProfile']['lada_telephone_contact'].$candidato['StudentProfile']['telephone_contact'] : 'Sin especificar';  ?></span><br />
				<span><strong>Celular: </strong><?php  echo ($candidato['StudentProfile']['cell_phone'] <> '') ? $candidato['StudentProfile']['lada_cell_phone'].$candidato['StudentProfile']['cell_phone'] : 'Sin especificar'; ?></span><br />

			<div class="col-md-12" style="margin-top: 10px;">
				<?= $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;Ver perfil completo', 
								['controller'=>'Companies',
								'action'=>'viewCvOnline', $candidato['Student']['id']],
								['class' => 'btn btn btn-bti col-md-12',
								'escape' => false]); ?>
			
			</div>
		</center>
	</div>
	

	
</div>
	<?php endforeach; ?>



