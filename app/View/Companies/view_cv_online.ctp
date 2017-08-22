<?php 
	$this->layout = 'company'; 
?>
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
	
	<script>
	$(document).ready(function() {
			init_contadorTa("taComentario","contadorTaComentario", 316);
			updateContadorTa("taComentario","contadorTaComentario", 316);
			
			init_contadorTa("messageIdEmail","contadorTaComentario2", 632);
			updateContadorTa("messageIdEmail","contadorTaComentario2", 632);
			
			 $('#StudentNotificationCompanyInterviewDateYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentNotificationCompanyInterviewDateMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentNotificationCompanyInterviewDateDay').prepend('<option value="" selected>DD</option>');
			 
			 $('#StudentPersonalNotificationCompanyInterviewDateYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentPersonalNotificationCompanyInterviewDateMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentPersonalNotificationCompanyInterviewDateDay').prepend('<option value="" selected>DD</option>');
		});
	
		//Contador de caracteres para las notificaciones telefónicas 
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
				contador.html(max+"/"+max);
			}

		}
	

			function saveTelephoneNotification(StudentId){
				document.getElementById('StudentNotificationStudentId').value = StudentId;
				$('#myModalnotificationTelefonica').modal('show');
			}
			
			function savePersonalNotification(StudentId){
				$('.StudentNotificationStudentId').val(StudentId);
				$('#myModalnotificationPersonal').modal('show');
			}
			
			function saveEmailNotification(email){
				document.getElementById('StudentEmailTo').value = email;
				$('#myModalMail').modal('show');
			}
			
			function saveOffer(StudentId){
				document.getElementById('CompanySavedStudentStudentId').value = StudentId;
				$('#myModal1').modal('show');
			}
			
			function saveReportarContratacion(StudentId){
				document.getElementById('StudentReportarContratacionStudentId').value = StudentId;
				$('#myModalReportarContratacion').modal('show');
			}
			
			function validaFormSaveStudent(){
				var valor = document.getElementById("CompanySavedStudentStudentFolderId").value;
				if (valor == ''){
					alert('Seleccione la carpeta donde se guardará el perfil');
					document.getElementById("CompanySavedStudentStudentFolderId").focus;
					return false;
				} else {
					return true;
				}
			}
		
			function cambiarContenido(){
			
			var archivo = document.getElementById('StudentFile').value;
			extensiones_permitidas = new Array(".jpg",".pdf");
			mierror = "";

			if (!archivo) {
					alert ('Adjuntar Cédula de Identificación Fiscal');
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
						alert ("Compruebe la extensión de su imagen de RFC a subir. \nSólo se pueden subir imagenes con extensiones: " + extensiones_permitidas.join());
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
		
			function validateNotificationForm(){
			
			var f = new Date();
			var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
			var fechaFinal = document.getElementById('StudentNotificationCompanyInterviewDateDay').value	+ "/" +
									document.getElementById('StudentNotificationCompanyInterviewDateMonth').value	+ "/" +
									document.getElementById('StudentNotificationCompanyInterviewDateYear').value	;
			

			selectedIndexDay = document.getElementById("StudentNotificationCompanyInterviewDateDay").selectedIndex;
			selectedIndexMonth = document.getElementById("StudentNotificationCompanyInterviewDateMonth").selectedIndex;
			selectedIndexYear = document.getElementById("StudentNotificationCompanyInterviewDateYear").selectedIndex;
		
			if(document.getElementById('taComentario').value == ''){
				alert ('Ingrese el mensaje para la notificación telefónica');
				document.getElementById('taComentario').focus();
				return false;
				
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				alert ('Seleccione la fecha completa para el día de la entrevista telefónica');
				document.getElementById('StudentNotificationCompanyInterviewDateDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				alert ('La fecha de la entrevista telefónica no debe ser menor a la actual');
				document.getElementById('StudentNotificationCompanyInterviewDateDay').focus();
				return false;
			}else {
				document.getElementById("CompanyCompanyTelephoneNotificationForm").submit();
			 }
		}
		
			function validateNotificationPersonalForm (){
			
			var f = new Date();
			var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
			var fechaFinal = document.getElementById('StudentPersonalNotificationCompanyInterviewDateDay').value	+ "/" +
									document.getElementById('StudentPersonalNotificationCompanyInterviewDateMonth').value	+ "/" +
									document.getElementById('StudentPersonalNotificationCompanyInterviewDateYear').value	;
			

			selectedIndexDay = document.getElementById("StudentPersonalNotificationCompanyInterviewDateDay").selectedIndex;
			selectedIndexMonth = document.getElementById("StudentPersonalNotificationCompanyInterviewDateMonth").selectedIndex;
			selectedIndexYear = document.getElementById("StudentPersonalNotificationCompanyInterviewDateYear").selectedIndex;
		
			if(document.getElementById('taComentario2').value == ''){
				alert ('Ingrese el mensaje para la notificación telefónica');
				document.getElementById('taComentario2').focus();
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				alert ('Seleccione la fecha completa para el día de la entrevista personal');
				document.getElementById('StudentPersonalNotificationCompanyInterviewDateDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				alert ('La fecha de la entrevista personal no debe ser menor a la actual');
				document.getElementById('StudentPersonalNotificationCompanyInterviewDateDay').focus();
				return false;
			}else {
				document.getElementById("CompanyCompanyPersonalNotificationForm").submit();
			 }
			
		}
	</script>
	<div>
		<?php echo $this->Session->flash(); ?>
	
	<div class="col-md-12" style="max-height: 900px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-top: 40px;">
					
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Encabezado de Currículum</h3>
					<div class="col-xs-3" style=" float: right;  margin-top: -23px; width: 230px; padding-right: 0px;  padding-left: 0px;">
							<div style="margin-top: 3px; margin-left: 5px;" class="grises2">
							
								<?php 
									$var = 0;
									$vista = 0;
									foreach($student['CompanyViewedStudent'] as $k => $viewed):
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
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
										)); 
										
									else:
									
										echo $this->Html->image('student/noVisto.png',
											array(
												'title' => 'Perfil visto',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
										)); 
									endif;
								
								?>
								
								<?php 
									$guardado = 0;
									$cont = -1;
									foreach($student['CompanySavedStudent'] as $k => $saveOffer):
									$cont++;
										if($saveOffer['company_id'] == ($this->Session->read('company_id'))):
											$guardado = 1;
											 break;
										endif;
									endforeach;
									
									if($cont > -1):
										foreach($folders as $folder):
											if($folder['CompanyFolder']['id'] == $student['CompanySavedStudent'][$cont]['company_folder_id']):
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
												'onclick' => 'saveOffer('.$student['Student']['id'].');',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
											));
										
									else:
										echo $this->Html->image('student/noGuardado.png',
											array(
												'title' => 'Perfil guardado en '.$nombreFolder,
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
											));
									endif;
								?>
								
								<?php 
										echo $this->Html->image('student/phone.png',
											array(
												'title' => 'Ajendar entrevista telefónica',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveTelephoneNotification('.$student['Student']['id'].');',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
										)); 
								?>
								
								<?php 
								echo $this->Html->image('student/personal.png',
											array(
												'title' => 'Ajendar entrevista presencial',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'savePersonalNotification('.$student['Student']['id'].');',
												'style' => 'width: 17px; height: 20px; margin-right: 10px; cursor:pointer;'
											)
								); 
								?>
								
								<?php 
								echo $this->Html->image('student/contratado.png',
											array(
												'title' => 'Reportar contratación',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveReportarContratacion('.$student['Student']['id'].');',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
												)
								);	
								?>
								
								<?php 
								echo $this->Html->image('student/arroba.png',
											array(
												'title' => 'Enviar correo',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'saveEmailNotification("'.$student['Student']['email'].'");',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
												)
								);	
								?>
								
								<?php
									$cvCompleto = '';
									if(($student['StudentProfile']['sex']<>'') and (!empty($student['StudentProfessionalProfile'])) and (!empty($student['StudentJobProspect'])) and ($student['StudentJobProspect']['id']<>null) and (!empty($student['StudentProspect']))  and ($student['StudentProspect']['id']<>null)):
										$cvCompleto = 'Si';
									else:
										$cvCompleto = 'No';
									endif;
								?>
							
								<?php 
								 // Enviar cv del estudiante
								 if($cvCompleto == 'Si'):
									if($company['CompanyOfferOption']['max_cv_download'] <> null):
										if($totalDescargas>=$company['CompanyOfferOption']['max_cv_download']):
											echo $this->Html->image('student/descargado.png',
																		array(
																			'title' => 'Descargar CV en PDF',
																			'class' => 'class="img-responsive center-block"',
																			'onclick' => 'mensajeLimiteDescargas();',
																			'style' => 'width: 17px; height: 20px; margin-right: 17px; cursor: help; '
																			)
																	);	
										else:
											echo $this->Html->link(
														$this->Html->image('student/descargado.png', array('escape' => false,'style' => 'width: 17px; height: 20px; margin-right: 17px; cursor: pointer; ')),
														array(
															'controller' => 'Companies', 
															'action' => 'viewCvPdf',$student['Student']['id'] 
															), 
														array('target' => '_blank','escape' => false,'title' => 'Descargar CV en PDF',)
											);
										endif;
									else:
										echo $this->Html->image('student/descargado.png',
																		array(
																			'title' => 'Descargar CV en PDF',
																			'class' => 'class="img-responsive center-block"',
																			'onclick' => 'mensajeSinConfigurar();',
																			'style' => 'width: 17px; height: 20px; margin-right: 17px; cursor: help; '
																			)
																	);	
									endif;
								else:
									echo $this->Html->image('student/descargado.png',
											array(
												'title' => 'Descargar CV en PDF',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'cvIncompleto();',
												'style' => 'width: 17px; height: 20px; margin-right: 17px; cursor: help; '
												)
												);	
								endif;
								?>
							</div>
						</div>	
				
			  </div>
			  <div class="panel-body" style="text-align: center">
					<?php 
						if($student['StudentHeader']['header'] <> ''):
							echo '<span style="color:#000; font-size: 14px;">'.$student['StudentHeader']['header'].'<br></span>';
						endif;
						echo '<b style="font-size: 20px;">'.$student['StudentProfile']['name'].' '.$student['StudentProfile']['last_name'].' '.$student['StudentProfile']['second_last_name'].'</b><br>'; 
						echo ($student['StudentProfile']['street'] <> '') ? '<span style="color:#000; font-size: 14px;"> ' . $student['StudentProfile']['street'].' '.$student['StudentProfile']['subdivision'].' '.$student['StudentProfile']['city']. '</span><br>': '';
						echo '<span style="color:#000; font-size: 14px;"> ' . $student['StudentProfile']['date_of_birth']. '</span><br>';
						echo ($student['StudentProfile']['telephone_contact'] <> '') ? '<span style="color:#000; font-size: 14px;"> ' .'Tel: '. $student['StudentProfile']['lada_telephone_contact'].$student['StudentProfile']['telephone_contact'].'</span>' : '';
						echo ($student['StudentProfile']['cell_phone'] <> '') ? '<span style="color:#000; font-size: 14px;"> Cel: '.$student['StudentProfile']['lada_cell_phone'].$student['StudentProfile']['cell_phone'] . '</span>' : '';
						echo '<br><span style="color:#000; font-size: 14px;"> ' . $student['Student']['email'] . '</span>';
					?>
					<br>
			  </div>
			</div>
		</div>
		
		<?php 
			if($student['StudentJobProspect']['professional_objective'] <> ''):
				$colSpanAreas = 'col-md-4';
			else:
				$colSpanAreas = 'col-md-9';
			endif;
		?>
		
		<?php 
			if(empty($student['StudentInterestJob'])):
				$colObjetivo = 'col-md-9';
			else:
				$colObjetivo = 'col-md-5';
			endif;
		?>
		
		<?php 
			if((empty($student['StudentInterestJob'])) and ($student['StudentJobProspect']['professional_objective'] == '')):
				$colFoto = 'col-md-12';
			else:
				$colFoto = 'col-md-3';
			endif;
		?>
		
		<?php if($student['StudentJobProspect']['professional_objective'] <> ''): ?>
		<div class="<?php echo $colObjetivo; ?>">
			<div class="panel panel-default" style="padding-left: 0px;">
			  <div class="panel-heading">
				<h3 class="panel-title" >Objetivo professional</h3>
			  </div>
			  <div class="panel-body" style="text-align: left; height: 150px;  max-height: 200px; overflow-y: auto">
					<?php 
						echo '<span style="color:#000; font-size: 14px;"> ' . $student['StudentJobProspect']['professional_objective'] . '</span><br>';
					?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if(!empty($student['StudentInterestJob'])): ?>
		<div class="<?php echo $colSpanAreas; ?>">
			<div class="panel panel-default" style="padding-left: 0px;">
				<div class="panel-heading">
					<h3 class="panel-title" >Áreas de interés</h3>
				</div>
				<div class="panel-body" style="text-align: left;  height: 150px; max-height: 200px; overflow-y: auto">
					<?php 
						$contador = 1;
						foreach($student['StudentInterestJob'] as $k => $areaInteres):
							echo $contador.'.- '.$areaInteres['InterestArea']['interest_area'].'<br>';
							$contador++;
						endforeach;	
					?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<div class="<?php echo $colFoto; ?>">
			<div class="panel panel-default" style="padding-left: 0px;">
				<div class="panel-heading">
					<h3 class="panel-title" >Foto</h3>
				</div>
				<div class="panel-body" style="text-align: left; height: 150px;  max-height: 200px; overflow-y: auto">
					<center>
					<?php 
					if (isset($student)):
										if(isset($student['Student']['filename'])):
											if($student['Student']['filename'] <> ''):
												echo $this->Html->image('uploads/student/filename/'.$student['Student']['filename'],
															array(
																'alt' => 'Profile Photo',
																'width' => '130px',
																'height' => '130px',
															));
											else:
												echo $this->Html->image('student/avatar.png',
															array(
																'alt' => 'Profile Photo',
																'width' => '130px',
																'height' => '130px',
															));
											endif;
										else:
												echo $this->Html->image('student/avatar.png',
															array(
																'alt' => 'Profile Photo',
																'width' => '130px',
																'height' => '130px',
															));
										endif;
									else:
												echo $this->Html->image('student/avatar.png',
															array(
																'alt' => 'Profile Photo',
																'width' => '130px',
																'height' => '130px',
															));
									endif;
					?>
					</center>
				</div>
			</div>
		</div>
		
		<?php if(!empty($student['StudentProfessionalProfile'])): ?>
		<div class="col-xs-12">
			<div class="panel panel-default" style="padding-right: 0px; " >
				  <div class="panel-heading">
					<h3 class="panel-title" >Formación académica</h3>
				  </div>
				  <div class="panel-body" style="text-align: left; max-height: 200px; overflow-y: auto;">
					<?php $existenMovilidades = 0; ?>
					
					<?php 
						$cont = 0;
						foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
							if($formacionAcademica['academic_level_id']== 4):
								echo '<div class="col-xs-12">';
								if($cont==0):
									echo '<b><span style="color:#000; font-size: 14px;">' . $formacionAcademica['AcademicLevel']['academic_level'] . ' </span></b><br>';
								endif;
								echo '<div class="col-xs-8" style="padding-left: 0px; margin-bottom: 10px;">';
									if($formacionAcademica['undergraduate_institution']<>''):
										echo 'Universidad Nacional Autónoma de México <br>'; 
										echo $Facultades[$formacionAcademica['undergraduate_institution']];
									else:
										echo $formacionAcademica['another_undergraduate_institution'];
									endif;
									echo '<br>';
										if($formacionAcademica['another_career']<>''):
											echo $formacionAcademica['another_career']; 
										else:
											echo $programas[$formacionAcademica['posgrado_program_id']];
										endif;
									echo '<br>';
									if($formacionAcademica['AcademicSituation']['academic_situation'] == 'Estudiante'):
										echo 'Semestre:' . $formacionAcademica['semester'].'<br>';
									endif;
								echo '</div><div class="col-xs-4"><b>';
								if($formacionAcademica['entrance_year_degree']<>''):
									echo date("Y",strtotime($formacionAcademica['entrance_year_degree']));
								endif;
								echo ' / ';
								if($formacionAcademica['egress_year_degree']=='0000-00-00'):
									echo 'Actual';
								else:
									echo date("Y",strtotime($formacionAcademica['egress_year_degree']));
								endif;
								echo '</b> ('. $formacionAcademica['AcademicSituation']['academic_situation'].')';
								echo '</div></div>';
								$cont++;
							endif;
							if($formacionAcademica['student_mobility'] =='s'):
								$existenMovilidades++;
							endif;
						endforeach;	
						
						$cont = 0;
						foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
							if($formacionAcademica['academic_level_id']== 3):
								echo '<div class="col-xs-12">';
								if($cont==0):
									echo '<b><span style="color:#000; font-size: 14px;">' . $formacionAcademica['AcademicLevel']['academic_level'] . ' </span></b><br>';
								endif;
								echo '<div class="col-xs-8" style="padding-left: 0px; margin-bottom: 10px;">';
									if($formacionAcademica['undergraduate_institution']<>''):
									echo 'Universidad Nacional Autónoma de México <br>'; 
									echo $Facultades[$formacionAcademica['undergraduate_institution']];
									else:
										echo $formacionAcademica['another_undergraduate_institution'];
									endif;
									echo '<br>';
										if($formacionAcademica['another_career']<>''):
											echo $formacionAcademica['another_career']; 
										else:
											echo $programas[$formacionAcademica['posgrado_program_id']];
										endif;
									echo '<br>';
									if($formacionAcademica['AcademicSituation']['academic_situation'] == 'Estudiante'):
										echo 'Semestre:' . $formacionAcademica['semester'].'<br>';
									endif;
								echo '</div><div class="col-xs-4"><b>';
								if($formacionAcademica['entrance_year_degree']<>''):
									echo date("Y",strtotime($formacionAcademica['entrance_year_degree']));
								endif;
								echo ' / ';
								if($formacionAcademica['egress_year_degree']=='0000-00-00'):
									echo 'Actual';
								else:
									echo date("Y",strtotime($formacionAcademica['egress_year_degree']));
								endif;
								echo '</b> ('. $formacionAcademica['AcademicSituation']['academic_situation'].')';
								echo '</div></div>';
								$cont++;
							endif;
							if($formacionAcademica['student_mobility'] =='s'):
								$existenMovilidades++;
							endif;
						endforeach;	
						
						$cont = 0;
						foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
							if($formacionAcademica['academic_level_id']== 2):
								echo '<div class="col-xs-12">';
								if($cont==0):
									echo '<b><span style="color:#000; font-size: 14px;">' . $formacionAcademica['AcademicLevel']['academic_level'] . ' </span></b><br>';
								endif;
								echo '<div class="col-xs-8" style="padding-left: 0px; margin-bottom: 10px;">';
									if($formacionAcademica['undergraduate_institution']<>''):
										echo 'Universidad Nacional Autónoma de México <br>'; 
									echo $Facultades[$formacionAcademica['undergraduate_institution']];
									else:
										echo $formacionAcademica['another_undergraduate_institution'];
									endif;
									echo '<br>';
										if($formacionAcademica['another_career']<>''):
											echo $formacionAcademica['another_career']; 
										else:
											echo $programas[$formacionAcademica['posgrado_program_id']];
										endif;
									echo '<br>';
									if($formacionAcademica['AcademicSituation']['academic_situation'] == 'Estudiante'):
										echo 'Semestre:' . $formacionAcademica['semester'].'<br>';
									endif;
								echo '</div><div class="col-xs-4"><b>';
								if($formacionAcademica['entrance_year_degree']<>''):
									echo date("Y",strtotime($formacionAcademica['entrance_year_degree']));
								endif;
								echo ' / ';
								if($formacionAcademica['egress_year_degree']=='0000-00-00'):
									echo 'Actual';
								else:
									echo date("Y",strtotime($formacionAcademica['egress_year_degree']));
								endif;
								echo '</b> ('. $formacionAcademica['AcademicSituation']['academic_situation'].')';
								echo '</div></div>';
								$cont++;
							endif;
							if($formacionAcademica['student_mobility'] =='s'):
								$existenMovilidades++;
							endif;
						endforeach;	
						
						$cont = 0;						
						foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
							if($formacionAcademica['academic_level_id']== 1):
								echo '<div class="col-xs-12">';
								if($cont==0):
									echo '<b><span style="color:#000; font-size: 14px;">' . $formacionAcademica['AcademicLevel']['academic_level'] . ' </span></b><br>';	
								endif;
								echo '<div class="col-xs-8" style="padding-left: 0px; margin-bottom: 10px;">';
									if($formacionAcademica['undergraduate_institution']<>''):
										echo 'Universidad Nacional Autónoma de México <br>'; 
									echo $Escuelas[$formacionAcademica['undergraduate_institution']];
									else:
										echo $formacionAcademica['another_undergraduate_institution'];
									endif;
									echo '<br>';
										if($formacionAcademica['another_career']<>''):
											echo $formacionAcademica['another_career']; 
										else:
											echo $carreras[$formacionAcademica['career_id']];
										endif;
									
									echo '<br>';
									if($formacionAcademica['AcademicSituation']['academic_situation'] == 'Estudiante'):
										echo 'Semestre:' . $formacionAcademica['semester'];
									endif;
								echo '</div><div class="col-xs-4"><b>';
								if($formacionAcademica['entrance_year_degree']<>''):
									echo date("Y",strtotime($formacionAcademica['entrance_year_degree']));
								endif;
								echo ' / ';
								if($formacionAcademica['egress_year_degree']=='0000-00-00'):
									echo 'Actual';
								else:
									echo date("Y",strtotime($formacionAcademica['egress_year_degree']));
								endif;
								echo '</b> ('. $formacionAcademica['AcademicSituation']['academic_situation'].')';
								echo '</div></div>';
								$cont++;
							endif;
							if($formacionAcademica['student_mobility'] =='s'):
								$existenMovilidades++;
							endif;
						endforeach;	
						echo '</div>';
					?>
				  </div>
			</div>
	
		<?php endif; ?>
		
		<?php if(isset($existenMovilidades) and($existenMovilidades>0)): ?>
		<div class="col-xs-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Movilidad estudiantil</h3>
			  </div>
			  <div class="panel-body" style="text-align: left; max-height: 400px; overflow-y: auto;">
				
					<?php 
						foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
							if($formacionAcademica['student_mobility'] == 's'):
					?>
								<div class="col-md-4">
									<?php 
										echo '<span style="color:#000; font-size: 14px;">';
										if($formacionAcademica['student_mobility_institution']<>''):
											echo '<b>'.$formacionAcademica['student_mobility_institution'].'</b><br>';
										endif;
										if($formacionAcademica['student_mobility_program']<>''):
											echo $formacionAcademica['student_mobility_program'] .'<br>';
										endif;
										if(!empty($formacionAcademica['Country'])):
											echo $formacionAcademica['Country']['country'];
											if($formacionAcademica['mobility_start_date']<>'0000-00-00'):
												echo ' / ' . date("Y",strtotime($formacionAcademica['mobility_start_date']));
											endif;
										endif;	
										echo '<br>';
										echo '</span>';
									?>
								</div>
					<?php 
							endif;
						endforeach;
					?>
			  </div>
			</div>
		</div>
		<?php endif; ?>
		
		<?php if(!empty($student['StudentProfessionalSkill'])): ?>
		<div class="col-xs-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title" >Competencias profesionales</h3>
				  </div>
				  <div class="panel-body" style="text-align: left">
					<?php 
						$numExperiencias = count($student['StudentProfessionalSkill']);
						foreach($student['StudentProfessionalSkill'] as $k => $competencia):
							$numExperiencias--;
							echo '<span style="color:#000; font-size: 14px;"> ' . $competencia['Competency']['description'] ; echo ($numExperiencias > 0) ? ' / </span>': '</span>';
						endforeach;	
					?>
				  </div>
			</div>
		</div>
		<?php endif;  ?>
		
		<?php if(!empty($student['StudentProfessionalExperience'])): ?>
		<div class="col-xs-12">
			<div class="panel panel-default" style="margin-bottom: 0px;">
			  <div class="panel-heading">
				<h3 class="panel-title" >Experiencia profesional</h3>
			  </div>
			  <div class="panel-body" style="text-align: left; max-height: 250px; overflow-y: auto;">
				<?php 
						foreach($student['StudentProfessionalExperience'] as $k => $experiencia):
							echo '<div class="col-xs-12" style="margin-top: 10px;"><span style="color:#000; font-size: 18px;"><b> ' . $experiencia['company_name'] . ' </b></span></div>';
								$contador = 1;
							
								$actual = 0;
								
								$fechasInicio =array();
								$fechasTermino =array();
								
								unset($fechasInicio);
								unset($fechasTermino);
								
								foreach($experiencia['StudentWorkArea'] as $k => $puesto):
//								if 	($puesto['end_date'] == '0000-00-00'):
										
//$puesto['end_date'] = date ( format [AAAA/MM/DD] );
									$fechasInicio[]=$puesto['start_date'];
									$fechasTermino[]=$puesto['end_date'];
									if($puesto['current'] == 1):
										$actual = 1;
									endif;
								endforeach;
								
								if(!empty($fechasInicio)):
									sort($fechasInicio);
									rsort($fechasTermino);	
								endif;			
								
								$band = 0;
								
								foreach($experiencia['StudentWorkArea'] as $k => $puesto):
									$anosExperiencia = 0;
									$mesesExperiencia = 0;
									$mesesToYear = 0;
									$resAnosExperiencia = 0;
									$fecha1 = new DateTime($puesto['start_date'] . "00:00:00");
									if 	($puesto['end_date'] == '0000-00-00'):
										$puesto['end_date'] = date ("Y/m/d");
									endif;
									$fecha2 = new DateTime($puesto['end_date']. "00:00:00");
									$fecha = $fecha1->diff($fecha2);
									$anosExperiencia = $anosExperiencia + $fecha->y;
									$mesesExperiencia = $mesesExperiencia + $fecha->m;
									$mesesToYear = round ($mesesExperiencia / 12);
									$resAnosExperiencia = $anosExperiencia + $mesesToYear;
									if($resAnosExperiencia==0):
										$resAnosExperiencia = 'menor a 6 meses';
									endif;
									
									echo '<div class="col-xs-6">';
										echo '<b>Área:</b><span style="color:#000; font-size: 14px;"> ' . $puesto['ExperienceArea']['experience_area'] . ' </span>';
									echo '</div>';
									
									echo '<div class="col-xs-6">';
										echo '<span style="color:#000; font-size: 14px;"><b> Años de experiencia: </b>' . $resAnosExperiencia . ' </span>';
									echo '</div>';

									if($band == 0):
										echo '<div class="col-xs-6">';
									else:
										echo '<div class="col-xs-12">';
									endif;
										echo '<b>Puesto:</b><span style="color:#000; font-size: 14px;"> ' . $puesto['job_name'] .' </span>';
									echo '</div>';
									
									if($band == 0):
										echo '<div class="col-xs-6">';
											echo '<b><span style="color:#000; font-size: 14px;">' . date("m-Y",strtotime($fechasInicio[0])) .' / '; echo ($actual == 1) ? 'Actual' : date("m-Y",strtotime($fechasTermino[0]));
										echo '</span></b></div>';
									endif;
									
									if(($contador == 1) and (!empty($puesto['StudentResponsability']))):
										echo '<div class="col-xs-12"><span style="color:#000; font-size: 14px;"><b>Principales responsabilidades</b></span></div>';							
										foreach($puesto['StudentResponsability'] as $k => $responsabilidades):
											echo '<div class="col-xs-12" style="padding-left: 30px;"><span style="color:#000; font-size: 14px;"><li type="disc"> ' . $responsabilidades['responsability'] . ' </li></span></div></li>';
										endforeach;
									endif;
									
									if(($contador == 1) and (!empty($puesto['StudentAchievement']))):
										echo '<div class="col-xs-12" ><span style="color:#000; font-size: 14px;"><b>Principales logros</b></span></div>';							
										echo '<div class="col-xs-12" style="margin-bottom: 10px;">';
										foreach($puesto['StudentAchievement'] as $k => $logros):
											echo '<div class="col-xs-12" style="padding-left: 15px;"><span style="color:#000; font-size: 14px;"><li type="square">  ' . $logros['achievement'] . ' </li></span></div><br>';
										endforeach;
										echo '</div>';
									endif;
									$band++;	
								endforeach;	
							$contador++;
						endforeach;	
				?>
			  </div>
			</div>
			<p></p>
		</div>
		<div class='col-md-12'>
			
		</div>
		<?php endif;  ?>
		
		<?php if(!empty($student['StudentAcademicProject'])): ?>
		<div class="col-xs-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title" >Proyectos Académicos</h3>
				  </div>
				  <div class="panel-body" style="text-align: left;max-height: 250px; overflow-y: auto;">
					<?php 
						foreach($student['StudentAcademicProject'] as $k => $proyecto):
							echo '<div class="col-xs-12" style="margin-top: 10px;">';
								echo '<b><span style="color:#000; font-size: 16px;"> ' . $proyecto['name'] . ' </span></b>';
							echo '</div>';
							
							echo '<div class="col-xs-6">';
								echo '<span style="color:#000; font-size: 14px;"> ' . $proyecto['company'] . ' </span>';
							echo '</div>';
							
							echo '<div class="col-xs-6">';
								echo '<b><span style="color:#000; font-size: 14px;">País: ' . $Paises[$proyecto['country']] . ' </span></b>';
							echo '</div>';
						
							echo '<div class="col-xs-12">';
								echo '<b><span style="color:#000; font-size: 14px;"> Principal responsabilidad</span></b>';
							echo '</div>';
							
							echo '<div class="col-xs-12" style="padding-left: 30px;">';
								echo '<span style="color:#000; font-size: 14px;"> <li type="disc">' . $proyecto['responsability'] . '</li> </span>';
							echo '</div>';
							
							echo '<div class="col-xs-12">';
								echo '<b><span style="color:#000; font-size: 14px;"> Principal logro</span></b>';
							echo '</div>';
							
							echo '<div class="col-xs-12" style="padding-left: 30px;">';
								echo '<span style="color:#000; font-size: 14px;"> <li type="disc">' . $proyecto['achievement'] . '</li> </span>';
							echo '</div>';
						
						endforeach;	
					?>
				  </div>
			</div>
		</div>
		<?php endif;  ?>
		
		<?php if(!empty($student['StudentLenguage'])): ?>
		<div class="col-xs-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title" >Idioma</h3>
				  </div>
				  <div class="panel-body" style="text-align: left">
					<?php 
						foreach($student['StudentLenguage'] as $k => $idioma):
							if(!empty($idioma['Lenguage']['lenguage'])):
								echo '<div class="col-xs-12" style="margin-top: 10px;">';
									echo '<b><span style="color:#000; font-size: 14px;">
											<li type="disc"> ' . 
												$idioma['Lenguage']['lenguage'] .'</b>: '.
												'Lectura - '.$NivelesIdioma[$idioma['reading_level']]. ' / '.
												'Escritura - '.$NivelesIdioma[$idioma['writing_level']]. ' / '.
												'Conversación - '.$NivelesIdioma[$idioma['conversation_level']].
											'</li></span>';
								echo '</div>';
							endif;
							
						endforeach;	
					?>
				  </div>
			</div>
		</div>
		<?php endif;  ?>
		
		<?php if(!empty($student['StudentJobSkill'])): ?>
		<div class="col-xs-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title" >Conocimientos y habilidades profesionales</h3>
				  </div>
				  <div class="panel-body" style="text-align: left">
					<?php 
						foreach($student['StudentJobSkill'] as $k => $curso):
								echo '<div class="col-xs-12" style="margin-top: 10px;">';
									echo '<b><span style="color:#000; font-size: 14px;">
											<li type="disc"> ' . 
												$TipoCursos[$curso['type_course_id']] . '  </b>: '.
												$curso['name'].
												' / '.
												$curso['company'].
											'</li></span>';
								echo '</div>';
						endforeach;	
					?>
				  </div>
			</div>
		</div>
		<?php endif;  ?>
		
		<?php if(!empty($student['StudentTechnologicalKnowledge'])): ?>
		<div class="col-xs-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title" >Cómputo</h3>
				  </div>
				  <div class="panel-body" style="text-align: left">
					<?php 
						foreach($student['StudentTechnologicalKnowledge'] as $k => $computo):
								echo '<div class="col-xs-12" style="margin-top: 10px;">';
									echo '<b><span style="color:#000; font-size: 14px;">
											<li type="disc"> ' . 
												$computo['Tecnology']['tecnology'] .'</b>: ';
												if($computo['name']<>''):
													echo $software[$computo['name']];
												else:
													echo $computo['other'];
												endif;
												echo ' / '.$NivelesSoftware[$computo['level']]. ' / '.
												$computo['institution'].
											'</li></span>';
								echo '</div>';
						endforeach;	
					?>
				  </div>
			</div>
		</div>
		<?php endif;  ?>
		
		<?php if(!empty($student['StudentProspect'])): ?>
		<div class="col-xs-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title" ></h3>
				  </div>
				  <div class="panel-body" style="text-align: left">
					<?php 
								echo '<div class="col-xs-12" style="margin-top: 10px;">';
									echo '<b><span style="color:#000; font-size: 14px;">
											DISPONIBILIDAD PARA VIAJAR: </b>';
												if($student['StudentProspect']['can_travel']=='s'):
													echo 'sí / ';
													if($student['StudentProspect']['can_travel_option']=='1'):
														echo 'dentro del país';
													else:
														echo 'fuera del país';
													endif;
												else:
													echo 'no';
												endif;
												
											echo '</span>';
								echo '</div>';
								
								echo '<div class="col-xs-12" style="margin-top: 10px;">';
									echo '<b><span style="color:#000; font-size: 14px;">
											DISPONIBILIDAD PARA CAMBIAR DE RESIDENCIA: </b>'; 
												if($student['StudentProspect']['change_residence']=='s'):
													echo 'sí / ';
													if($student['StudentProspect']['change_residence_option']=='1'):
														echo 'dentro del país';
													else:
														echo 'fuera del país';
													endif;
												else:
													echo 'no';
												endif;
												
											echo '</span>';
								echo '</div>';
					?>
				  </div>
			</div>
		</div>
		<?php endif;  ?>
		
		
		</div>	
	</div>	
	<div class="col-md-12"  style="text-align: left; margin-top: 10px;">
		
		<div class="col-md-9" style="padding-left: 0px;">
			<p>Fecha de última actualización:<?php echo ' '.date("d / m / Y",strtotime($student['StudentLastUpdate']['modified'])); ?></p>

		</div>
		<div class="col-md-3">
			<?php 
			$caracteres = strlen($student['Student']['id']);
						$faltantes = 5 - $caracteres;	
						if($faltantes > 0):
							$ceros = '';
							for($cont=0; $cont<=$faltantes;$cont++):
								$ceros .= '0';
							endfor;
							$folio = $ceros.$student['Student']['id'];
						else:
							$folio = strlen($student['Student']['id']);
						endif;
			?>
			<p style="margin-left: 90px;">Folio:<span style="color: #FFB71F;"><?php echo ' '.$folio; ?></span>
			<img class="img-circle cambia" src="<?php echo $this->webroot; ?>/img/help.png" alt="help.png" title="Número de registro con el cual queda registrado su currículum." data-placement="top" data-toggle="tooltip" data-original-title="Sin sugerencias.">
			</p>
		</div>
	</div>
	
	<div class="col-md-offset-10">
		<a class="btn btn-default btnBlue " style="margin-top: 5px; width: 150px;" onclick="goBack();"><i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar</a>
	</div>
	
		<!--Form para ajendar entrevista telefónica-->
		<div class="modal fade" id="myModalnotificationTelefonica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 630px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Seleccione el día y la hora para la entrevista telefónica</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 350;">
									
					
								<?php 
									echo $this->Form->create('Company', array(
																		'class' => 'form-horizontal', 
																		'role' => 'form',
																		'inputDefaults' => array(
																				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																												'div' => array('class' => 'form-group'),
																												'class' => 'form-control',
																												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="Crear un mensaje genérico con el fin de programar una entrevista telefónica." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" >',
																												'between' => ' <div class="col-md-11" style="padding-right: 5px;">',
																												'after' => '</div></div>',
																												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																		),
																		'action' => 'companyTelephoneNotification',
																		'onsubmit' =>'return validateNotificationForm();'
									)); 
								?>	
						
										<div class="col-md-12 col-md-offset-0" style=" margin-top: 40px;  padding-right: 0px;">	
												<fieldset>
													<?php 	echo $this->Form->input('StudentNotification.student_id', array('type'=>'hidden')); ?>
													<?php 	echo $this->Form->input('CompanyInterviewMessage.id', array(
																												'type'=>'hidden',
																												'value'=>$company['CompanyInterviewMessage']['id'],
																										)); ?>
													<?php 	echo $this->Form->input('StudentNotification.company_interview_message', array(
																										'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="Crear un mensaje genérico con el fin de programar una entrevista telefónica." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 50px;">',
																										'style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;',
																										'maxlength' => '316',
																										'type' => 'textarea',
																										'value'=>$company['CompanyInterviewMessage']['telehone_interview_message'],
																										'id' => 'taComentario',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																													'placeholder' => 'Mensaje ',
													));	?>
													<div class="col-md-11 form-group row" style="text-align: right; top: -10px; margin-left: 7px; margin-bottom: 0px;">
														<span id="contadorTaComentario" style="color: white">0/316</span><span style="color: white"> caracteres máx.</span>
													</div>
													
													<div class="col-xs-6 col-md-offset-6" style="height: 0;">
														<p style="margin-left: -52%;margin-top: 5px;">Fecha</p>
														<p style="margin-left: -8%;margin-top: 30px;">Hora</p>
														<label class="col-md-6 control-label"  style="margin-left: 131px; top: -37px;"></label>
													</div>
														<?php 	echo $this->Form->input('StudentNotification.company_interview_date', array(
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
																										'minYear' => date('Y') - -2,
																										'maxYear' => date('Y') - 0,	
																
														));	?>
												
														<?php 	echo $this->Form->input('StudentNotification.company_interview_hour', array(
																										'type' => 'time',
																										'timeFormat' => '24',
																										'interval' => 15,
																										'before' => '<div class="col-md-12" style="left: -15px; margin-top: 15px;"><img data-toggle="tooltip" id="" data-placement="left" title="Podrá seleccionar dos opciones de día y hora para programar la entrevista telefónica." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="left: 95%; position: absolute; z-index: 10;margin-top: 15px;">',
																										'between' => ' <div class="col-md-6 col-md-offset-6" style="padding-left: 46px;">',
																										'style' => 'width: 98px; margin-left: 4px; border-left-width: 0; padding-left: 0;  padding-left: 0px; padding-right: 0px;',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																														'class' => 'col-md-2 control-label',
																														'text' => ''),
														));?>
														<div class="form-group required">
														<div class="col-md-12" style="padding-right: 0px;">
															<label for="StudentAcademicSituationId"></label>
															<div class="col-md-11 "  style="margin-top: 15px;">
																<select  id="StudentAcademicSituationId" class="form-control" required="required" name="data[StudentNotification][company_job_profile_id]" >
																	<option value="">Seleccione el puesto interesado en el perfil</option>
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
	
	<!--Form para ajendar entrevista personal-->
		<div class="modal fade" id="myModalnotificationPersonal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 675px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Indique los datos para la entrevista personal</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 470px;">
									
								<?php 
									echo $this->Form->create('Company', array(
																		'class' => 'form-horizontal', 
																		'role' => 'form',
																		'inputDefaults' => array(
																				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																												'div' => array('class' => 'form-group'),
																												'class' => 'form-control',
																												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="Documentación requerida para la entrevista presencial.Ejemplo:IFE, Currículum impreso, etcétera" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 6px;margin-top: 6px;" >',
																												'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
																												'after' => '</div></div>',
																												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-warning margin-reduce'))
																		),
																		'action' => 'companyPersonalNotification',
																		'onsubmit' =>'return validateNotificationPersonalForm();'
									)); 
								?>	
						
										<div class="col-md-12 col-md-offset-0" style=" margin-top: 5px;  padding-right: 0px;">	
												<fieldset>
													<?php 	echo $this->Form->input('StudentNotification.student_id', array('type'=>'hidden', 'class'=>'StudentNotificationStudentId')); ?>
													<?php 	echo $this->Form->input('CompanyInterviewMessage.id', array(
																												'type'=>'hidden',
																												'value'=>$company['CompanyInterviewMessage']['id'],
																										)); ?>
													<?php 	echo $this->Form->input('StudentNotification.company_interview_message', array(
																										'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="left" title="Crear un mensaje genérico con el fin de programar una entrevista presencial." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 52px;margin-left: 5px;">',
																										'style' => 'resize: vertical; min-height: 75px;  max-height: 120px; height: 75px;',
																										'maxlength' => '316',
																										'type' => 'textarea',
																										'value'=>$company['CompanyInterviewMessage']['personal_interview_message'],
																										'id' => 'taComentario2',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																													'placeholder' => 'Mensaje ',
													));	?>
													
													<div class="col-xs-6 col-md-offset-6" style="height: 0;">
														<p style="margin-left: -41%;margin-top: 12px;">Fecha</p>
														<p style="margin-left: 1%;margin-top: 27px;">Hora</p>
														<label class="col-md-6 control-label"  style="margin-left: 131px; top: -37px;"></label>
													</div>

														<?php 	echo $this->Form->input('StudentPersonalNotification.company_interview_date', array(
																										'type' => 'date',
																										'before' => '<div class="col-md-11" style="margin-left: 62px;"">',
																										'between' => ' <div class="col-md-8 col-md-offset-4">',
																										'style' => 'width: 98px; margin-left: -10px; margin-right: 18px; padding:0px',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																											'class' => 'col-xs-offset-3 control-label ',
																											'text' => '',),
																										'dateFormat' => 'YMD',
																										'separator' => '',
																										'minYear' => date('Y') - -2,
																										'maxYear' => date('Y') - 0,	
																
														));	?>
														
												
														<?php 	echo $this->Form->input('StudentPersonalNotification.company_interview_hour', array(
																										'type' => 'time',
																										'timeFormat' => '24',
																										'interval' => 15,
																										'before' => '<div class="col-md-11" style="left: 58px; margin-top: 10px;">',
																										'between' => ' <div class="col-md-6 col-md-offset-6" style="padding-left: 20px;">',
																										'style' => 'width: 98px; margin-left: 4px; border-left-width: 0; padding-left: 0;  padding-left: 0px; padding-right: 0px;',
																										'div' => array('class' => 'form-inline'),
																										'label' => array(
																														'class' => 'col-md-1 col-md-offset-5 control-label',
																														'text' => ''),
														));?>
														
														<?php 	echo $this->Form->input('StudentNotification.company_interview_direction', array(
																										'before' => '<div class="col-md-12 ">',
																										'between' => ' <div class="col-md-11" style="margin-top: 20px; padding-right: 0px;">',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																										'placeholder' => 'Dirección ',
														));	?>
														<?php 	echo $this->Form->input('StudentNotification.company_contact_name', array(
																										'before' => '<div class="col-md-12 ">',
																										'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																										'placeholder' => 'Nombre del entrevistador ',
														));	?>
														<?php 	echo $this->Form->input('StudentNotification.company_contact', array(
																										'before' => '<div class="col-md-12 ">',
																										'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																										'placeholder' => 'Contacto entrevistador',
														));	?>
														<?php 	echo $this->Form->input('StudentNotification.company_interview_document', array(
// 																										'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="left" title="Documentación requerida para la entrevista presencial.
// Ejemplo:
// IFE, Currículum impreso, etcétera." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: 6px;margin-left: 6px;">',
																										'between' => ' <div class="col-md-11" style="padding-right: 0px;">',
																										'label' => array(
																													'class' => 'col-md-0 control-label',
																													'text' => ''),
																										'placeholder' => 'Documentos',
														));	?>

														<div class="form-group required">
														<div class="col-md-12" style="padding-right: 0px;">
															<label for="StudentAcademicSituationId"></label>
															<div class="col-md-11 " >
																<select  id="StudentAcademicSituationId" class="form-control" required="required" name="data[StudentNotification][company_job_profile_id]" >
																	<option value="">Seleccione el puesto interesado en el perfil</option>
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

	<!--Form para envio de correo -->
		<div class="modal fade" id="myModalMail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 650px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Envio de correo electrónico a perfil de student</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 440px;">
									<?php
										echo $this->Form->create('Company', array(
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
														'action' => 'companyEmailNotification'
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
												<img data-toggle="tooltip" id="" data-placement="left" title="Mensaje que le será enviado al student" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: -55px;">
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
					