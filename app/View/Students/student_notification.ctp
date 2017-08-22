	<?php 
		$this->layout = 'student'; 
	?>
	<?= $this->element('contadorCaracteres'); ?>
	<script>
		$(document).ready(function() {	
			 $('#StudentNotificationStudentInterviewDateYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentNotificationStudentInterviewDateMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentNotificationStudentInterviewDateDay').prepend('<option value="" selected>DD</option>');
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
			
		function validateNotificationForm(){
			var f = new Date();
			var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
			var fechaFinal = document.getElementById('StudentNotificationStudentInterviewDateDay').value	+ "/" +
							document.getElementById('StudentNotificationStudentInterviewDateMonth').value	+ "/" +
							document.getElementById('StudentNotificationStudentInterviewDateYear').value	;
			
			selectedIndexDay = document.getElementById("StudentNotificationStudentInterviewDateDay").selectedIndex;
			selectedIndexMonth = document.getElementById("StudentNotificationStudentInterviewDateMonth").selectedIndex;
			selectedIndexYear = document.getElementById("StudentNotificationStudentInterviewDateYear").selectedIndex;
			
			responseValidateDate = validarFecha(fechaFinal);
			
			if(document.getElementById('StudentNotificationStudentInterviewMessage').value == ''){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese un mensaje para la nueva propuesta'});
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione la fecha completa para el día de la entrevista'});
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
			 	$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha de la entrevista no debe ser menor a la actual'});
				return false;
			}else 
			if(responseValidateDate == false){
				$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha de la entrevista no es válida'});
				return false;
			}else{
				document.getElementById("StudentStudentNotificationForm").submit();
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
				$ofertas=$telefonicas;
			else:
				if($tipoNotificacion==2):
					$ofertas=$presenciales;
				else:
					if($tipoNotificacion==3):
						$ofertas=$contrataciones;
					else:
						if($tipoNotificacion==4):
							$ofertas=$seguimientos;
						endif;
					endif;
				endif;
			endif;
		?>

		<div class="scrollbar" id="style-2" style="margin-top: 30px">
			<table id="example" class="display table table-condensed" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th>Empresa</th>
		                <th>Puesto</th>
		                <th>Día</th>
		                <th>Hora</th>
		                <th>Mensaje</th>
		                <th>Opciones/Estatus</th>
		            </tr>
		        </thead>
		        <tfoot>
		            <tr>
		                <th>Empresa</th>
		                <th>Puesto</th>
		                <th>Día</th>
		                <th>Hora</th>
		                <th>Mensaje</th>
		                <th>Opciones</th>
		            </tr>
		        </tfoot>
		        <tbody>

				<?php 
				foreach($ofertas as $k => $notificacion):
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
											if($notificacion['StudentNotification']['step_process']==1):
												$titulo = 'Seguimiento Entrevista Telefónica';
											else:
												if($notificacion['StudentNotification']['step_process']==2):
													$titulo = 'Seguimiento Entrevista Presencial';
												endif;
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;

						if($notificacion['StudentNotification']['company_interview_status'] == 2):
							$titulo = 'Nueva fecha propuesta';
						endif;
					?>

					<?php 
						 						
						echo '<tr><td>';

						if(($notificacion['CompanyJobProfile']['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($notificacion['CompanyJobProfile']['CompanyJobOffer']['company_name']<>'')):
							echo $notificacion['CompanyJobProfile']['CompanyJobOffer']['company_name']; 
						else:
							if(($notificacion['CompanyJobProfile']['CompanyJobOffer']['confidential_job_offer'] == 's') AND ($notificacion['CompanyJobProfile']['CompanyJobOffer']['company_name']=='')):
								echo 'Confidencial';
							else:
								if(($notificacion['CompanyJobProfile']['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($notificacion['CompanyJobProfile']['CompanyJobOffer']['company_name']<>'')):
									echo $notificacion['CompanyJobProfile']['CompanyJobOffer']['company_name']; 
								else:
									if(($notificacion['CompanyJobProfile']['CompanyJobOffer']['confidential_job_offer'] == 'n') AND ($notificacion['CompanyJobProfile']['CompanyJobOffer']['company_name']=='')):
										echo $notificacion['CompanyJobProfile']['Company']['CompanyProfile']['company_name'];
									else:
										echo 'Sin especificar';
									endif;
								endif;
							endif;
						endif;

						echo'</td><td>'.$notificacion['CompanyJobProfile']['job_name'].'</td>';
						
						if($notificacion['StudentNotification']['student_interview_status'] == 2):
							$var = 'Candidato:';
							$var1 = $notificacion['StudentNotification']['student_interview_date'];
							$var2 = $notificacion['StudentNotification']['student_interview_hour'];
							$var3 = $notificacion['StudentNotification']['student_interview_message'];
						else:
							$var = 'Empresa:';
							$var1 = $notificacion['StudentNotification']['company_interview_date'];
							$var2 = $notificacion['StudentNotification']['company_interview_hour'];
							$var3 = $notificacion['StudentNotification']['company_interview_message'];
						endif;

						echo'<td>'.date("d / m / Y",strtotime($var1)).'</td>';
						echo'<td>'.date("H:i", strtotime($var2)).'</td>';

						if(($tipoNotificacion==1) OR (($tipoNotificacion==2))):
							
							echo'<td><strong>'.$titulo.':</strong> '.$var3.'</td><td style="width: 130px;padding-left: 5px;padding-right: 5px;">';

							$detalle = '';
							if(($notificacion['StudentNotification']['company_interview_status'] == 0) AND ($notificacion['StudentNotification']['student_interview_status'] == 2)):
								$detalle = 'En espera';
							else:
								if(($notificacion['StudentNotification']['student_interview_status'] == 1) AND ($notificacion['StudentNotification']['company_interview_status'] == 1)):
									$detalle = 'Confirmada por ambos';
								else:
									if(($notificacion['StudentNotification']['student_interview_status'] == 3) AND (($notificacion['StudentNotification']['company_interview_status'] == 2) OR ($notificacion['StudentNotification']['company_interview_status'] == 1))):
										$detalle = 'Cancelada por alumno';
									else:
										if(($notificacion['StudentNotification']['company_interview_status'] == 3) AND ($notificacion['StudentNotification']['student_interview_status'] == 2)):
											$detalle = 'Cancelada por la empresa';
										else:
											if(($notificacion['StudentNotification']['student_interview_status'] == 0) AND (($notificacion['StudentNotification']['company_interview_status'] == 2)  OR ($notificacion['StudentNotification']['company_interview_status'] == 1))):
												echo "<center>";
												echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>', ['controller'=>'Students',
																							'action'=>'studentNotification',
																							'?' => ['id' => $notificacion['StudentNotification']['id'],'respuestaNotificacion' => 1]],	
																							['class' => 'btn btn-primary btn-sm',
																							'title'=>'Aceptar llamada en fecha y hora','escape' => false]); 	
													
												if($tipoNotificacion<>3): 
													echo $this->Html->link('<i class="glyphicon glyphicon-calendar"></i>', ['#' => ''],
																							['class' => 'btn btn-success btn-sm',
																							'onclick' => 'return nuevaFechaEntrevista('.$notificacion['StudentNotification']['id'].', '.$notificacion['StudentNotification']['company_job_profile_id'].');',
																							'title'=>'Proponer otra fecha de entrevista','escape' => false]); 	
												endif; 
												
												echo $this->Html->link('<i class="glyphicon glyphicon-thumbs-down"></i>', '#',
																					['class' => 'btn btn-danger btn-sm',
																					'onclick' =>"return confirma('Notificacion".$notificacion['StudentNotification']['id']."');",
																					'title'=>'Cancelar entrevista','escape' => false]); 
												
												echo '<div style="display: none">';
												echo $this->Html->link('Eliminar', ['controller'=>'Students',
																					'action'=>'studentNotification',
																					'?' => ['id' => $notificacion['StudentNotification']['id'],'respuestaNotificacion' => 3]],
																					['id'=>'eliminarNotificacion'.$puesto['id']]); 
												echo "</div>";

												echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>', ['controller'=>'Students',
																					'action'=>'viewOffer',$notificacion['CompanyJobProfile']['id']],
																					['class' => 'btn btn-info btn-sm',
																					'title'=>'Ver oferta completa','escape' => false,'target' => '_blank']); 		

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
						
					<?php if($tipoNotificacion==3): 
						echo'<td>'.$notificacion['StudentNotification']['company_interview_message'].'</td><td>';
						echo "<center>";
						echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>', ['controller'=>'Students',
																							'action'=>'studentNotification',
																							'?' => ['id' => $notificacion['StudentNotification']['id'],'respuestaNotificacion' => 1]],	
																							['class' => 'btn btn-primary btn-sm',
																							'title'=>'Aceptar contratación','escape' => false]); 	
						echo $this->Html->link('<i class="glyphicon glyphicon-thumbs-down"></i>', '#',
																					['class' => 'btn btn-danger btn-sm',
																					'onclick' =>"return confirma('Notificacion".$notificacion['StudentNotification']['id']."');",
																					'title'=>'Cancelar contratación','escape' => false]); 
												
						echo '<div style="display: none">';
						echo $this->Html->link('<i class="glyphicon glyphicon-thumbs-down"></i>', ['controller'=>'Students',
																					'action'=>'studentNotification',
																					'?' => ['id' => $notificacion['StudentNotification']['id'],'respuestaNotificacion' => 3]],
																					['id'=>'eliminarNotificacion'.$puesto['id']]);  
						echo "</div>";

						echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>', ['controller'=>'Students',
													'action'=>'viewOffer',$notificacion['CompanyJobProfile']['id']],
																					['class' => 'btn btn-info btn-sm',
																					'title'=>'Ver oferta completa','escape' => false,'target' => '_blank']); 	
						echo "</center>";
						endif; 
					?>
					
					<?php if(($tipoNotificacion==4)): 
						echo'<td><strong>Indique el estatus de la oferta</strong></td><td>';
						echo "<center>";
						echo $this->Html->link('<i class="glyphicon glyphicon-hand-right"></i>', ['controller'=>'Students',
																							'action'=>'studentNotification',
																							'?' => ['id' => $notificacion['StudentNotification']['id'],'respuestaNotificacion' => 4]],	
																							['class' => 'btn btn-primary btn-sm',
																							'title'=>'Me contrataron para la oferta','escape' => false]); 	

						echo $this->Html->link('<i class="glyphicon glyphicon-calendar"></i>', ['controller'=>'Students',
																							'action'=>'studentNotification',
																							'?' => ['id' => $notificacion['StudentNotification']['id'],'respuestaNotificacion' => 5]],	
																							['class' => 'btn btn-success btn-sm',
																							'title'=>'Agendé entrevista presencial','escape' => false]); 	

						echo $this->Html->link('<i class="glyphicon glyphicon-time"></i>', ['controller'=>'Students',
																							'action'=>'studentNotification',
																							'?' => ['id' => $notificacion['StudentNotification']['id'],'respuestaNotificacion' => 6]],	
																							['class' => 'btn btn-info btn-sm',
																							'title'=>'Quedaron de comunicarse','escape' => false]); 	

						echo $this->Html->link('<i class="glyphicon glyphicon-log-out"></i>', ['controller'=>'Students',
																							'action'=>'studentNotification',
																							'?' => ['id' => $notificacion['StudentNotification']['id'],'respuestaNotificacion' => 7]],	
																							['class' => 'btn btn-warning btn-sm',
																							'title'=>'Salí del proceso','escape' => false]); 	
						echo $this->Html->link('<i class="glyphicon glyphicon-eye-open"></i>', ['controller'=>'Students',
																					'action'=>'viewOffer',$notificacion['CompanyJobProfile']['id']],
																					['class' => 'btn btn-info btn-sm',
																					'title'=>'Ver oferta completa','escape' => false,'target' => '_blank']); 	

					endif; ?>
					
				<?php 
				endforeach; 
				?>

				</tbody>
    		</table>

		</div>
	
	<?php endif; ?>