<?php 
	foreach($candidatos as $k => $candidato):
?>
	<div class="col-md-10 col-md-offset-1 sombra" style="border: 1px solid #1a75bb; margin-bottom: 15px; background: url('/bolsabti/img/satinweave.png');">    
		
		<div class="col-md-2 visible-lg visible-md text-center" style="margin-top: 3%; padding-left: 0px; padding-right: 0px;">
			<?php
				$url = WWW_ROOT.'img/uploads/student/filename/'.$candidato['Student']['filename'];
				if( (!isset($candidato)) || (!isset($candidato['Student']['filename']) || (!file_exists( $url )) || (($candidato['Student']['filename'] == '')))):
					echo $this->Html->image('company/imagenNoEncontrada.png',['style'=>'width:85%; height: 100%; ' ]);
				else:
					echo $this->Html->image('uploads/student/filename/'.$candidato['Student']['filename'],['style'=>'width:100%; height: 100%; image-rendering: pixelated;' ]);
				endif;
			?>			
			<p style="margin-top: 5px; font-size: 10px">
				<?php echo $candidato['StudentProfile']['name'].' '.$candidato['StudentProfile']['last_name'].' '.$candidato['StudentProfile']['second_last_name']; ?>
			</p>
		</div>
	
		<div class="col-md-6" style="margin-top: 20px;font-size: 14px">
			<span><strong>Núm. de cuenta: </strong><?php echo $candidato['Student']['username']; ?></span><br />
			<span><strong>Correo electrónico: </strong><span style="font-weight: normal;"><?php  echo $candidato['Student']['email']; ?> </span></span><br />
			<span><strong>Teléfono casa: </strong><span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['telephone_contact'] <> '') ? $candidato['StudentProfile']['lada_telephone_contact'].$candidato['StudentProfile']['telephone_contact'] : 'Sin especificar';  ?> </span></span><br />
			<span><strong>Celular: </strong><span style="font-weight: normal;"><?php  echo ($candidato['StudentProfile']['cell_phone'] <> '') ? $candidato['StudentProfile']['lada_cell_phone'].$candidato['StudentProfile']['cell_phone'] : 'Sin especificar'; ?> </span></span><br />
			<span><strong>Fecha de actualización: </strong><span style="font-weight: normal;"><?php  echo ($candidato['StudentLastUpdate']['modified'] <> null) ? $candidato['StudentLastUpdate']['modified'] : 'Sin especificar'; ?> </span></span><br />
			<span><strong>Escuela / Facultad: </strong><span style="font-weight: normal;"><?php  echo $EscuelasFacultades[$candidato['Student']['institution']]; ?> </span></span><br />
		</div>
	
		<div class="col-md-4" style="margin-top: 15px;">
		<center>
			<?php
				$cvCompleto = '';
				if(($candidato['StudentProfile']['sex']<>'') and (!empty($candidato['StudentProfessionalProfile'])) and (!empty($candidato['StudentJobProspect'])) and ($candidato['StudentJobProspect']['id']<>null) and (!empty($candidato['StudentProspect']))  and ($candidato['StudentProspect']['id']<>null)):
					$cvCompleto = 'Si';
				else:
					$cvCompleto = 'No';
				endif;

				 // Descativar estudiante
				if($candidato['Student']['status'] == 0):
					$imagen = 'student/noActiva.png';
				else:
					$imagen = 'student/activa.png';
				endif
			?>

			<?= $this->Html->image($imagen,
							['title' => 'Universitario inactivo click para activar',
							'style' => 	'width: 20px; height: 20px;margin-right: 3px;',
							'class' =>	'class="img-responsive center-block"',
							'url' => [ 	'controller'=>'Administrators',
										'action'=>'enableDisableStudent',
										'?' => ['id' => $candidato['Student']['id'],'estatus' => $candidato['Student']['status']]]]); ?>

			<?= $this->Html->image('student/lapiz.png',
							['title' => 'Editar universitario',
							'class' => 	'class="img-responsive center-block"',
							'style' => 	'width: 20px; height: 20px;margin-right: 3px;',
							'url' => [	'controller'=>'Students',
										'action'=>'studentProfile',
										'?' => ['student_id' => $candidato['Student']['id'],'editingAdmin' => 'yes']]]);?>

			<?php 
			 // Enviar cv del estudiante
			 if($cvCompleto == 'Si'):
				echo $this->Html->image('administrator/sobre.png',
							['title' => 'Enviar CV del universitario',
							'class' => 	'class="img-responsive center-block"',
							'style' => 	'width: 20px; height: 20px;margin-right: 3px;',
							'url' => [	'controller'=>'Students',
										'action'=>'studentContact',
										'?' => ['student_id' => $candidato['Student']['id'],'editingAdmin' => 'yes']],
							]);
			else:
				echo $this->Html->image('administrator/sobre.png',
							['title' => 'Enviar CV del universitario',
							'class' => 'class="img-responsive center-block"',
							'onclick' => 'cvIncompleto();',
							'style' => 'cursor:pointer; width: 20px; height: 20px;margin-right: 3px;']);	
			endif;
			?>
			
			<?= $this->Html->image('administrator/candado.png',
							['title' => 'Actualizar contraseña',
							'class' => 'class="img-responsive center-block"',
							'onclick' => 'updatePassword('.$candidato['Student']['id'].',"'.$candidato['Student']['email'].'","'.$candidato['StudentProfile']['secondary_email'].'");',
							'style' => 'cursor:pointer; width: 20px; height: 20px;margin-right: 3px;']);	?>

			<?= $this->Html->image('administrator/arroba.png',
							['title' => 'Enviar correo',
							'class' => 'class="img-responsive center-block"',
							'onclick' => 'saveEmailNotification("'.$candidato['Student']['email'].'");',
							'style' => 'cursor:pointer; width: 20px; height: 20px;margin-right: 3px;',
							]);	?>
			
			<?= $this->Html->image('administrator/postulado.png',
							['title' => 'Ver postulaciones del universitario',
							'class' => 	'class="img-responsive center-block"',
							'style' => 	'cursor:pointer; width: 20px; height: 20px;margin-right: 3px;',
							'url' => [	'controller'=>'Administrators',
										'action'=>'viewStudentPostullation',
										'?' => ['student_id' => $candidato['Student']['id'], 
											'newSearch' => 'nuevaBusqueda',
											'regresar' => 'searchStudent']]]);?>
			
			<?= $this->Html->image('administrator/contratado.png',
							['title' => 'Reportar contratación por universitario',
							'class' => 	'class="img-responsive center-block"',
							'style' => 	'cursor:pointer; width: 20px; height: 20px;margin-right: 3px;',
							'url' => [	'controller'=>'Students',
										'action'=>'report','nuevaBusqueda',
											'?' => [
													'student_id' => $candidato['Student']['id'], 
													'editingAdmin' => 'yes',
													]]]);?>

			<?php 
				 // Eliminar universitario
				 echo $this->Html->image('administrator/eliminar.png',
							['title' => 'Eliminar universitario',
							'style' => 'cursor:pointer; width: 20px; height: 20px; margin-right: 3px;',
							'class' => 'class="img-responsive center-block"',
							'id' => 'focusStudentId'.$candidato['Student']['id'],
							'onclick' => 'deleteRegister('.$candidato['Student']['id'].',"'.$candidato['Student']['username'].'");']);
				
				echo $this->Form->postLink($this->Html->image('student/eliminar.png',
										array('alt' => 'Eliminar universitario', 'title' =>'Eliminar universitario', 'style' => 'width: 20px; height: 20px; display: none','id'=>'deleteStudentId'.$candidato['Student']['id'] )), 
										array('action' => 'deleteStudent',$candidato['Student']['id']), 
										array('escape' => false));

			?>
		</center>
		</div>
		
	<div class="col-md-4" style="margin-top: 15px; text-align: center; padding-right: 0px; padding-left: 0px;">
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

		<span><strong>Status laboral:</strong> <span style="font-weight: normal;"><?php  echo $trabajando; ?> </span></span><br />
		
		<strong>CV completo:</strong> <span style="font-weight: normal;"><?php  echo $cvCompleto; ?> </span>		
		

		<div class="col-md-12" style="margin-top: 5px;">
			<?= $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;Ver currículum', 
							['controller'=>'Students',
							'action'=>'viewCvOnline', '?'=>['student_id' => $candidato['Student']['id'], 'editingAdmin' => 'yes']],
							['class' => 'btn btn btn-bti col-md-12',
							'escape' => false]); ?>
			
		</div>

	</div>
</div>
<?php endforeach; ?>