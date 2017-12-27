<?php 
	$this->layout = 'company'; 
?>
	
<script>
	$(document).ready(function() {	
			 $('#StudentNotificationStudentInterviewDateYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentNotificationStudentInterviewDateMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentNotificationStudentInterviewDateDay').prepend('<option value="" selected>DD</option>');
			 $('#example').DataTable();
			 $('.selectpicker').selectpicker('refresh');
		});
	$(document).ready(function() {	
			 init_contadorTa("StudentTelephoneNotificationMessage","contadorTaComentario", 316);
		updateContadorTa("StudentTelephoneNotificationMessage","contadorTaComentario", 316);
		
		init_contadorTa("StudentPersonalNotificationMessage","contadorTaComentarioPropuesta", 316);
		updateContadorTa("StudentPersonalNotificationMessage","contadorTaComentarioPropuesta", 316);
		
		init_contadorTa("messageIdEmail","contadorTaComentario2", 632);
		updateContadorTa("messageIdEmail","contadorTaComentario2", 632);
		
		 $('#StudentTelephoneNotificationDateYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentTelephoneNotificationDateMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentTelephoneNotificationDateDay').prepend('<option value="" selected>DD</option>');
		 
		 $('#StudentPersonalNotificationDateYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentPersonalNotificationDateMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentPersonalNotificationDateDay').prepend('<option value="" selected>DD</option>');
		 
		 $('#StudentPropuestaFechaYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentPropuestaFechaMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentPropuestaFechaDay').prepend('<option value="" selected>DD</option>');
		 
		 $('#StudentReportarContratacionFechaContratacionYear').prepend('<option value="" selected>AAAA</option>');
		 $('#StudentReportarContratacionFechaContratacionMonth').prepend('<option value="" selected>MM</option>');
		 $('#StudentReportarContratacionFechaContratacionDay').prepend('<option value="" selected>DD</option>');
			 $('#example').DataTable();
			 $('.selectpicker').selectpicker('refresh');
		});

	function validate_fechaMayorQue(fechaInicial,fechaFinal){
		valuesStart=fechaInicial.split("/");
		valuesEnd=fechaFinal.split("/");

		// Verificamos que la fecha no sea posterior a la actual

		var dateStart=new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
		var dateEnd=new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);

		if(dateStart>dateEnd)
		{
			return 1;
		}
		return 0;
	}	
	function nuevaFechaEntrevista(id, company_job_profile_id){
		document.getElementById('StudentPropuestaId').value = id;
		document.getElementById('StudentPropuestaCompsnyaJobProfileId').value = company_job_profile_id;
		$('#myModalnotification').modal('show');
		return false;
	}	
	/* 	function deleteText(){
		document.getElementById("textFile").innerHTML = '';
		document.getElementById('StudentFile').value = '';  
		return false;
	} */
	function validarFecha(fecha){
			 //Funcion validarFecha 
			 //valida fecha en formato aaaa-mm-dd
			 var fechaArr = fecha.split('/');
			 var aho = fechaArr[2];
			 var mes = fechaArr[1];
			 var dia = fechaArr[0];
			 
			 var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0

			 if(!plantilla || plantilla.getFullYear() == aho && plantilla.getMonth() == mes -1 && plantilla.getDate() == dia){
			 return true;
			 }else{
			 return false;
			 }
		}		
	function validateNotificationFormPropuesta(){
			
			var f = new Date();
			var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
			var fechaFinal = document.getElementById('StudentPropuestaFechaDay').value	+ "/" +
									document.getElementById('StudentPropuestaFechaMonth').value	+ "/" +
									document.getElementById('StudentPropuestaFechaYear').value;
			
			
			selectedIndexDay = document.getElementById("StudentPropuestaFechaDay").selectedIndex;
			selectedIndexMonth = document.getElementById("StudentPropuestaFechaMonth").selectedIndex;
			selectedIndexYear = document.getElementById("StudentPropuestaFechaYear").selectedIndex;
			
			responseValidateDate = validarFecha(fechaFinal);
			
			if(document.getElementById('taComentarioPropuesta').value == ''){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese el mensaje para la nueva propuesta'});
				document.getElementById('taComentarioPropuesta').focus();
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				 $.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione la fecha completa para el día de la entrevista'});
				document.getElementById('StudentPropuestaFechaDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				 $.alert({ title: '!Aviso!',type: 'red',content: 'La fecha de la entrevista no debe ser menor a la actual'});
				document.getElementById('StudentPropuestaFechaDay').focus();
				return false;
			}else 
			if(responseValidateDate == false){
				 $.alert({ title: '!Aviso!',type: 'red',content: 'La fecha de la entrevista no es válida'});
				document.getElementById('StudentPropuestaFechaDay').focus();
				return false;
			}else{
				document.getElementById("formNotificacionPropuesta").submit();
			 }
		}		
	function deleteNotification(param){
			document.getElementById('focusNotificationId'+param).scrollIntoView();
			jConfirm('¿Realmente desea eliminar la notificación?', 'Confirmación', function(r){
				if( r ){						
					$("#eliminarNotificacion"+param).click();
				}
			});
		}
	function validateNotificationForm(){
	var f = new Date();
			var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
			var fechaFinal = document.getElementById('StudentPropuestaFechaDay').value	+ "/" +
									document.getElementById('StudentPropuestaFechaMonth').value	+ "/" +
									document.getElementById('StudentPropuestaFechaYear').value;
			
			
			selectedIndexDay = document.getElementById("StudentPropuestaFechaDay").selectedIndex;
			selectedIndexMonth = document.getElementById("StudentPropuestaFechaMonth").selectedIndex;
			selectedIndexYear = document.getElementById("StudentPropuestaFechaYear").selectedIndex;
			
			responseValidateDate = validarFecha(fechaFinal);
			
			if(document.getElementById('taComentarioPropuesta').value == ''){
				alert ('Ingrese el mensaje para la nueva propuesta');
				document.getElementById('taComentarioPropuesta').focus();
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				alert ('Seleccione la fecha completa para el día de la entrevista');
				document.getElementById('StudentPropuestaFechaDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				alert ('La fecha de la entrevista no debe ser menor a la actual');
				document.getElementById('StudentPropuestaFechaDay').focus();
				return false;
			}else 
			if(responseValidateDate == false){
				alert ('La fecha de la entrevista no es válida');
				document.getElementById('StudentPropuestaFechaDay').focus();
				return false;
			}else{
				document.getElementById("formNotificacionPropuesta").submit();
			 }
		}
</script>

	<?php 
		if(isset($this->request->query['tipoNotificacion']) and ($this->request->query['tipoNotificacion']<>'')):
			$tipoNotificacion=$this->request->query['tipoNotificacion'];
		else:
			if($this->Session->check('tipoNotificacion')):
				$tipoNotificacion=$this->Session->read('tipoNotificacion');
			else:
				$tipoNotificacion='';
			endif;
		endif;

		if($tipoNotificacion<>''):
			
			if($tipoNotificacion==1):
				$notificaciones=$telefonicas;
			else:
				if($tipoNotificacion==2):
					$notificaciones=$presenciales;
				else:
					if($tipoNotificacion==3):
						$notificaciones=$contrataciones;
					else:
						if($tipoNotificacion==4):
							$notificaciones=$seguimientos;
						endif;
					endif;
				endif;
			endif;
	?>
	<div class="scrollbar" id="style-2" style="margin-top: 30px">
		<table id="example" class="display table table-condensed" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Candidato</th>
					<th>Puesto</th>
					<th>Día</th>
					<th>Hora</th>
					<th>Mensaje</th>
					<th>Opciones/Estatus</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Candidato</th>
					<th>Puesto</th>
					<th>Día</th>
					<th>Hora</th>
					<th>Mensaje</th>
					<th>Opciones</th>
				</tr>
			</tfoot>
			<tbody>
			
				<?php 
					foreach($notificaciones as $k => $candidato):
				?>
					
				<?php
					if($tipoNotificacion<>''):
						if($tipoNotificacion==1):
							$titulo = 'Entrevista telefónica';
						else:
							if($tipoNotificacion==2):
								$titulo = 'Entrevista presencial';
							else:
								if($tipoNotificacion==3):
									$titulo = 'Contratación';
								else:
									if($tipoNotificacion==4):
										if($candidato['StudentNotification']['step_process']==1):
											$titulo = 'Seguimiento Entrevista Telefónica';
										else:
											if($candidato['StudentNotification']['step_process']==2):
												$titulo = 'Seguimiento Entrevista Presencial';
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					endif;

					if($candidato['StudentNotification']['student_interview_status'] == 2):
						$titulo = 'Nueva fecha propuesta';
					endif;
				?>

				<?php  						
					echo '<tr><td>';
					echo $candidato['Student']['StudentProfile']['name'].' '.$candidato['Student']['StudentProfile']['last_name'].' '.$candidato['Student']['StudentProfile']['second_last_name'];
					echo'</td><td>'.$candidato['CompanyJobProfile']['job_name'].'</td>';
					if($candidato['StudentNotification']['student_interview_status'] == 2):
						$var = 'Mensaje alumno:';
						$var1 = $candidato['StudentNotification']['student_interview_date'];
						$var2 = $candidato['StudentNotification']['student_interview_hour'];
						$var3 = $candidato['StudentNotification']['student_interview_message'];
					else:
						$var = 'Mensaje empresa:';
						$var1 = $candidato['StudentNotification']['company_interview_date'];
						$var2 = $candidato['StudentNotification']['company_interview_hour'];
						$var3 = $candidato['StudentNotification']['company_interview_message'];
					endif;

					echo'<td>'.date("d / m / Y",strtotime($var1)).'</td>';
					echo'<td>'.date("H:i", strtotime($var2)).'</td>';

					if(($tipoNotificacion==1) OR (($tipoNotificacion==2))):
						
						echo'<td><strong>'.$titulo.':</strong> '.$var3.'</td><td style="width: 130px;padding-left: 5px;padding-right: 5px;">';

						$detalle = '';
						if(($candidato['StudentNotification']['student_interview_status'] == 0) AND (($candidato['StudentNotification']['company_interview_status'] == 1) OR ($candidato['StudentNotification']['company_interview_status'] == 2))):	$detalle = 'En espera';
						else:
							if(($candidato['StudentNotification']['student_interview_status'] == 1) AND ($candidato['StudentNotification']['company_interview_status'] == 1)):$detalle = 'Confirmada por ambos';
							else:
								if(($candidato['StudentNotification']['student_interview_status'] == 3) AND (($candidato['StudentNotification']['company_interview_status'] == 2) OR ($candidato['StudentNotification']['company_interview_status'] == 1))):
									$detalle = 'Cancelada por alumno';
								else:
									if(($candidato['StudentNotification']['company_interview_status'] == 3) AND ($candidato['StudentNotification']['student_interview_status'] == 2)):
										$detalle = 'Cancelada por la empresa';
									else:
										if(($candidato['StudentNotification']['company_interview_status'] == 0) AND (($candidato['StudentNotification']['student_interview_status'] == 2)  OR ($candidato['StudentNotification']['student_interview_status'] == 1))):
							echo "<center>";
											echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>', ['controller'=>'Companies',
																						'action'=>'companyNotification',
																						'?' => ['id' => $candidato['StudentNotification']['id'],'respuestaNotificacion' => 1]],	
																						['class' => 'btn btn-primary btn-sm',
																						'title'=>'Aceptar llamada en fecha y hora','escape' => false]); 	
												
											if($tipoNotificacion<>3): 
												echo $this->Html->link('<i class="glyphicon glyphicon-calendar"></i>', ['#' => ''],
																						['class' => 'btn btn-success btn-sm',
																						'onclick' => 'return nuevaFechaEntrevista('.$candidato['StudentNotification']['id'].', '.$candidato['StudentNotification']['company_job_profile_id'].');',
																						'title'=>'Proponer otra fecha de entrevista','escape' => false]); 	
											endif; 
											
											echo $this->Html->link('<i class="glyphicon glyphicon-thumbs-down"></i>', '#',
																				['class' => 'btn btn-danger btn-sm',
																				'onclick' =>"return confirma('Notificacion".$candidato['StudentNotification']['id']."');",
																				'title'=>'Cancelar entrevista','escape' => false]); 
											
											echo '<div style="display: none">';
											echo $this->Html->link('Eliminar', ['controller'=>'Companies',
																				'action'=>'companyNotification',
																				'?' => ['id' => $candidato['StudentNotification']['id'],'respuestaNotificacion' => 3]],
																				['id'=>'eliminarNotificacion'.$candidato['StudentNotification']['id']]); 
											echo "</div>";

											echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>', ['controller'=>'Companies',
																				'action'=>'viewCvOnline',$candidato['Student']['id']],
																				['class' => 'btn btn-info btn-sm',
																				'title'=>'Ver perfil completo','escape' => false,'target' => '_blank']); 		

																	
																				
																				
																				
																				
											echo "</center>";
										endif;
									endif;
								endif;
							endif;
						endif;
						
						if($detalle <> ''): 
							echo '<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 0px;"><p style="color: #588BAD">'.$detalle.'</p></blockquote>';
						endif;
							
							echo '</td></tr>';
						endif; 
				?>
				
				<?php 
				if($tipoNotificacion==3): 
					echo'<td>'.$candidato['StudentNotification']['student_interview_message'].'</td><td>';
					echo "<center>";
					echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>', ['controller'=>'Companies',
																						'action'=>'companyNotification',
																						'?' => ['id' => $candidato['StudentNotification']['id'],'respuestaNotificacion' => 1]],	
																						['class' => 'btn btn-primary btn-sm',
																						'title'=>'Aceptar contratación','escape' => false]); 	
					echo $this->Html->link('<i class="glyphicon glyphicon-thumbs-down"></i>', '#',
																				['class' => 'btn btn-danger btn-sm',
																				'onclick' =>"return confirma('Notificacion".$candidato['StudentNotification']['id']."');",
																				'title'=>'Cancelar contratación','escape' => false]); 
											
					echo '<div style="display: none">'; 
					echo $this->Html->link('<i class="glyphicon glyphicon-thumbs-down"></i>', ['controller'=>'Companies',
																				'action'=>'companyNotification',
																				'?' => ['id' => $candidato['StudentNotification']['id'],'respuestaNotificacion' => 3]],
																				['id'=>'eliminarNotificacion'.$candidato['StudentNotification']['id']]);  
					echo "</div>";

						
					echo "</center>";
					endif; 
				?>
				
				<?php if(($tipoNotificacion==4)): 
					echo'<td><strong>Indique el estatus de la oferta</strong></td><td>';
					echo "<center>";
					echo $this->Html->link('<i class="glyphicon glyphicon-hand-right"></i>', ['controller'=>'Companies',
																						'action'=>'companyNotification',
																						'?' => ['id' => $candidato['StudentNotification']['id'],'respuestaNotificacion' => 4]],	
																						['class' => 'btn btn-primary btn-sm',
																						'title'=>'Se contratató','escape' => false]); 	

					echo $this->Html->link('<i class="glyphicon glyphicon-time"></i>', ['controller'=>'Companies',
																						'action'=>'companyNotification',
																						'?' => ['id' => $candidato['StudentNotification']['id'],'respuestaNotificacion' => 5]],	
																						['class' => 'btn btn-info btn-sm',
																						'title'=>'Quedaron de comunicarse','escape' => false]); 	

					echo $this->Html->link('<i class="glyphicon glyphicon-log-out"></i>', ['controller'=>'Companies',
																						'action'=>'companyNotification',
																						'?' => ['id' => $candidato['StudentNotification']['id'],'respuestaNotificacion' => 6]],	
																						['class' => 'btn btn-warning btn-sm',
																						'title'=>'Salí del proceso','escape' => false]); 	
					endif; 
				?>
				
				<?php 
				endforeach; 
				?>
			</tbody>
		</table>

	</div>
		
	<?php endif; ?>
	
<div class="modal fade" id="myModalnotification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content fondoBti">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel" style="color: white;">Seleccione la fecha de propuesta para la entrevista</h4>
			</div>
			<div class="modal-body">
						<?= $this->Form->create('Company', [
						'id' => 'formNotificacionPropuesta',
						'class' => 'form-horizontal', 
						'role' => 'form',
						'inputDefaults' => [
						'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
						'div' => ['class' => 'form-group'],
						'class' => 'form-control',
						'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
						'between' => '<div class="col-md-12">',
						'after' => '</div>',
						'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
					],
						'action' => 'companyNotification',
						'onsubmit' =>'return validateNotificationFormPropuesta();']); ?>			

				<fieldset>
				<center>
					<?php 	echo $this->Form->input('StudentNotification.id', ['type'=>'hidden','id' => 'StudentPropuestaId',]);?>
					<?php 	echo $this->Form->input('StudentNotification.company_job_profile_id', ['type'=>'hidden','id' => 'StudentPropuestaCompsnyaJobProfileId',]);?>
					<label style="font-weight: normal;margin-top: 3px; color: white;">Mensaje:</label>
					<?= $this->Form->input('StudentNotification.company_interview_message', ['placeholder' => 'Mensaje','type'=>'textarea','class'=>'form-control logrosClass','id' => 'taComentarioPropuesta','style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;','maxlength' => '316']); ?>
						
					
					<label style="font-weight: normal;margin-top: 3px; color: white;">Fecha:</label>
					<?= $this->Form->input('StudentNotification.company_interview_date', [
					'id' => 'StudentPropuestaFecha',
										'class' => 'selectpicker show-tick form-control show-menu-arrow',
										'data-width'=> '160px',
										'dateFormat' => 'YMD',
										'separator' => '',
										'minYear' => date('Y') - -1,
										'maxYear' => date('Y') - 0]); ?>	
					<label style="font-weight: normal;margin-top: 3px; color: white;">Hora:</label>		
					<?= $this->Form->input('StudentNotification.company_interview_hour', [
										'class' => 'selectpicker show-tick form-control show-menu-arrow',
										'type' => 'time',
										'timeFormat' => '24',
										'interval' => 15,
										'data-width'=> '160px']);?>	
								
									
								
													
									
				</center>			
				</fieldset>
			</div>	
			<div class="modal-footer">
				<?php 	echo $this->Form->button('<i class="glyphicon glyphicon-calendar"></i>&nbsp; Reagendar',[
														'type' => 'submit', 
														'div' => 'form-group',
														'escape' => false,
														'class' => 'btn btnRed btn-default'
											]);
						echo $this->Form->end(); 
				?>
			</div>
		</div>
	</div>
</div>