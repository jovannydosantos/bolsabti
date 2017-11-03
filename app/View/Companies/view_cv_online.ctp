<?php 
	$this->layout = 'company'; 
?>

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
				document.getElementById('StudentTelephoneNotificationId').value = StudentId;
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
	
<div class="scrollbar" id="style-2" >		
	<div class="col-md-12">	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Encabezado de Currículum</h3>
			</div>
		    <div class="panel-body" style="text-align: center">
				<div class="col-md-12">
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
									'class' => 'icono',
									'onclick' => 'saveOffer('.$student['Student']['id'].');',
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
							'onclick' => 'saveTelephoneNotification('.$student['Student']['id'].');',
							'class' => 'icono',]);
					
				?>							
					<?php 
						echo $this->Html->image('student/personal.png',
							['title' => 'Agendar entrevista presencial',
							'data-toggle'=>'tooltip',
							'data-placement'=>'left',
							'onclick' => 'savePersonalNotification('.$student['Student']['id'].');',
							'class' => 'icono',]);	
					?>							
					<?php 
						echo $this->Html->image('student/noContratado.png',
							['title' => 'Reportar contratación',
							'data-toggle'=>'tooltip',
							'data-placement'=>'left',
							'onclick' => 'saveReportarContratacion('.$student['Student']['id'].');',
							'class' => 'icono',]);
					?>						
					<?php 
						echo $this->Html->image('student/arroba.png',
							['title' => 'Enviar correo',
							'data-toggle'=>'tooltip',
							'data-placement'=>'left',
							'onclick' => 'saveEmailNotification("'.$student['Student']['email'].'");',
							'class' => 'icono',]);	
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
						// Descargar cv del estudiante
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
											'action' => 'viewCvPdf',$student['Student']['id'] 
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
											'onclick' => 'mensajeSinConfigurar();', //nose que onda :/
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
			</div>
		</div>
	</div>
		
	<?php 
		if($student['StudentJobProspect']['professional_objective'] <> ''):
			$colSpanAreas = 'col-md-4';
		else:
			$colSpanAreas = 'col-md-9';
		endif;

		if(empty($student['StudentInterestJob'])):
			$colObjetivo = 'col-md-9';
		else:
			$colObjetivo = 'col-md-5';
		endif;

		if((empty($student['StudentInterestJob'])) and ($student['StudentJobProspect']['professional_objective'] == '')):
			$colFoto = 'col-md-12';
		else:
			$colFoto = 'col-md-3';
		endif;
	?>
		
	<?php if($student['StudentJobProspect']['professional_objective'] <> ''): ?>
		<div class="<?php echo $colObjetivo; ?>">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title">Objetivo profesional</h3>
			  </div>
			  <div class="panel-body" style="height: 150px;">
					<?php 
						echo '<span style="color:#000; font-size: 14px;"> ' . $student['StudentJobProspect']['professional_objective'] . '</span><br>';
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php if(!empty($student['StudentInterestJob'])): ?>
		<div class="<?php echo $colSpanAreas; ?>">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title" >Áreas de interés</h3>
				</div>
				<div class="panel-body" style="height: 150px;">
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
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Foto de perfil</h3>
			</div>
			<div class="panel-body" style="height: 150px;"><center>
					<?php
						$path = WWW_ROOT.'img'.DS.'uploads'.DS.'student'.DS.'filename'.DS;
						if (isset($student) and isset($student['Student']['filename']) and ($student['Student']['filename'] <> '' and file_exists($path.$student['Student']['filename']))):
							echo $this->Html->image('uploads/student/filename/'.$student['Student']['filename'],
														['alt' => 'Cargar Foto de Perfil',
														'width' => '120px',
														'height' => '120px',
														'class' => 'img-responsive']);
						else:
							echo $this->Html->image('http://ofcoursesocial.com/wp-content/uploads/2017/06/7.png',
														['alt' => 'Cargar Foto de Perfil',
														'width' => '120px',
														'height' => '120px',
														'class' => 'img-responsive']);
						endif;
										
					?>
				</center>
			</div>
		</div>
	</div>
		
	<?php if(!empty($student['StudentProfessionalProfile'])): ?>
		<div class="col-md-12">
			<div class="panel panel-default" >
				  <div class="panel-heading">
					<h3 class="panel-title">Formación académica</h3>
				  </div>
				  <div class="panel-body">
					<?php 
						$existenMovilidades = 0; 
						for ($i=4; $i>0 ; $i--) { 
							$cont = 0;
							foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
								if($formacionAcademica['academic_level_id']==$i):
									echo '<div class="col-md-12">';
									
									if($cont==0):
										echo '<div class="col-md-12"><b style="color:#000; font-size: 14px;">'.$formacionAcademica['AcademicLevel']['academic_level'].'</b></div>';
									endif;

									echo '<div class="col-md-8" style="margin-bottom: 10px;">';
									
										if($formacionAcademica['undergraduate_institution']<>''):
											echo 'Universidad Nacional Autónoma de México <br />'; 
											echo $Facultades[$formacionAcademica['undergraduate_institution']].'<br />';
										else:
											echo $formacionAcademica['another_undergraduate_institution'];
										endif;

										if($formacionAcademica['another_career']<>''):
											echo $formacionAcademica['another_career'].'<br />'; 
										else:
											if($i==1):
												echo $carreras[$formacionAcademica['career_id']].'<br />';
											else:
												echo $programas[$formacionAcademica['posgrado_program_id']].'<br />';
											endif;
										endif;

										if($formacionAcademica['AcademicSituation']['academic_situation'] == 'Estudiante'):
											echo 'Semestre:' . $formacionAcademica['semester'].'<br />';
										endif;

									echo '</div><div class="col-md-4"><b>';

									if($formacionAcademica['entrance_year_degree']<>''):
										echo date("Y",strtotime($formacionAcademica['entrance_year_degree'])).' / ';
									endif;

									if(($formacionAcademica['egress_year_degree']=='0000-00-00') || ($formacionAcademica['egress_year_degree']==null)):
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
						}
					?>
				  </div>
			</div>
		</div>
	<?php endif; ?>
		
	<?php if(isset($existenMovilidades) and($existenMovilidades>0)): ?>
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title" >Movilidad estudiantil</h3>
			  </div>
			  <div class="panel-body">
					<div class="col-md-12">
					<?php 
						foreach($student['StudentProfessionalProfile'] as $k => $formacionAcademica):
							if($formacionAcademica['student_mobility'] == 's'):
					?>
								<div class="col-md-4">
									<?php 
										echo '<span style="color:#000; font-size: 14px;">';
										if($formacionAcademica['student_mobility_institution']<>''):
											echo '<b>'.$formacionAcademica['student_mobility_institution'].'</b><br />';
										endif;
										if($formacionAcademica['student_mobility_program']<>''):
											echo $formacionAcademica['student_mobility_program'] .'<br />';
										endif;
										if(!empty($formacionAcademica['Country'])):
											echo $formacionAcademica['Country']['country'];
											if(($formacionAcademica['mobility_start_date']<>'0000-00-00') && ($formacionAcademica['mobility_start_date']<>null)):
												echo ' / ' . date("Y",strtotime($formacionAcademica['mobility_start_date']));
											endif;
										endif;	
										echo '<br />';
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
		</div>
	<?php endif; ?>
		
	<?php if(!empty($student['StudentProfessionalSkill'])): ?>
		<div class="col-md-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Competencias profesionales</h3>
				  </div>
				  <div class="panel-body">
				  	<div class="col-md-12">
				  	<div class="col-md-12">
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
			</div>
		</div>
	<?php endif;  ?>
		
	<?php if(!empty($student['StudentProfessionalExperience'])): ?>
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
				<h3 class="panel-title">Experiencia profesional</h3>
			  </div>
			  <div class="panel-body" style="padding-top: 0px;">
			  	<div class="col-md-12">
					<?php 
						$fechasInicio =array();
						$fechasTermino =array();
						foreach($student['StudentProfessionalExperience'] as $k => $experiencia):
							echo '<div class="col-md-12" style="margin-top: 10px;"><span style="color:#000; font-size: 16px;"><b> ' . $experiencia['company_name'] . ' </b></span></div>';
							$contador = 1;
							$actual = 0;
							unset($fechasInicio);
							unset($fechasTermino);
								
							foreach($experiencia['StudentWorkArea'] as $k => $puesto):
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
								
								echo '<div class="col-md-6" style="margin-top: 5px">';
									echo '<b>Área: </b><span style="color:#000; font-size: 14px;">'. $puesto['ExperienceArea']['experience_area'].'</span>';
								echo '</div>';
								
								echo '<div class="col-md-6" style="margin-top: 5px">';
									echo '<span style="color:#000; font-size: 14px;"><b>Años de experiencia: </b>'.$resAnosExperiencia.'</span>';
								echo '</div>';

								if($band == 0):
									echo '<div class="col-md-6">';
								else:
									echo '<div class="col-md-12">';
								endif;
									echo '<b>Puesto:</b><span style="color:#000; font-size: 14px;">'.$puesto['job_name'].'</span>';
								echo '</div>';
								
								if($band == 0):
									echo '<div class="col-md-6">';
										echo '<b><span style="color:#000; font-size: 14px;">' . date("m-Y",strtotime($fechasInicio[0])) .' / '; echo ($actual == 1) ? 'Actual' : date("m-Y",strtotime($fechasTermino[0]));
									echo '</span></b></div>';
								endif;
								
								if(($contador == 1) and (!empty($puesto['StudentResponsability']))):
									echo '<div class="col-md-12"><span style="color:#000; font-size: 14px;"><b>Principales responsabilidades</b></span></div>';							
									foreach($puesto['StudentResponsability'] as $k => $responsabilidades):
										echo '<div class="col-md-12" style="padding-left: 30px;"><span style="color:#000; font-size: 14px;"><li type="disc"> ' . $responsabilidades['responsability'] . ' </li></span></div></li>';
									endforeach;
								endif;
								
								if(($contador == 1) and (!empty($puesto['StudentAchievement']))):
									echo '<div class="col-md-12" ><span style="color:#000; font-size: 14px;"><b>Principales logros</b></span></div>';							
									echo '<div class="col-md-12" style="margin-bottom: 10px;">';
									foreach($puesto['StudentAchievement'] as $k => $logros):
										echo '<div class="col-md-12" style="padding-left: 15px;"><span style="color:#000; font-size: 14px;"><li type="square">  ' . $logros['achievement'] . ' </li></span></div><br>';
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
			</div>
		</div>
	<?php endif;  ?>
		
	<?php if(!empty($student['StudentAcademicProject'])): ?>
		<div class="col-md-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Proyectos Extracurriculares</h3>
				  </div>
				  <div class="panel-body" style="padding-top: 0px;">
				  	<div class="col-md-12">
					<?php 
						foreach($student['StudentAcademicProject'] as $k => $proyecto):
							echo '<div class="col-md-12" style="margin-top: 10px;">';
								echo '<b><span style="color:#000; font-size: 16px;"> ' . $proyecto['name'] . ' </span></b>';
							echo '</div>';
							
							echo '<div class="col-md-6">';
								echo '<b><span style="color:#000; font-size: 14px;">' . $proyecto['company'] . ' </span></b>';
							echo '</div>';
							
							echo '<div class="col-md-6">';
								echo '<b><span style="color:#000; font-size: 14px;">País: ' . $Paises[$proyecto['country']] . ' </span></b>';
							echo '</div>';
						
							echo '<div class="col-md-12">';
								echo '<b><span style="color:#000; font-size: 14px;"> Principal responsabilidad:</span></b>';
							echo '</div>';
							
							echo '<div class="col-md-12" style="padding-left: 30px;">';
								echo '<span style="color:#000; font-size: 14px;"> <li type="disc">' . $proyecto['responsability'] . '</li> </span>';
							echo '</div>';
							
							echo '<div class="col-md-12">';
								echo '<b><span style="color:#000; font-size: 14px;"> Principal logro:</span></b>';
							echo '</div>';
							
							echo '<div class="col-md-12" style="padding-left: 30px;">';
								echo '<span style="color:#000; font-size: 14px;"> <li type="disc">' . $proyecto['achievement'] . '</li> </span>';
							echo '</div>';
						
						endforeach;	
					?>
				  </div>
				</div>
			</div>
		</div>
	<?php endif;  ?>
		
	<?php if(!empty($student['StudentLenguage'])): ?>
		<div class="col-md-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Idioma</h3>
				  </div>
				  <div class="panel-body" style="padding-top: 0px;">
				  <div class="col-md-12">
					<?php 
						foreach($student['StudentLenguage'] as $k => $idioma):
							if(!empty($idioma['Lenguage']['lenguage'])):
								echo '<div class="col-md-12" style="margin-top: 10px;">'.
									 	'<b><span style="color:#000; font-size: 14px;">'.
											'<li type="disc"> ' . 
												$idioma['Lenguage']['lenguage'] .'</b>: '.
												'Lectura - '.$NivelesIdioma[$idioma['reading_level']]. ' / '.
												'Escritura - '.$NivelesIdioma[$idioma['writing_level']]. ' / '.
												'Conversación - '.$NivelesIdioma[$idioma['conversation_level']].
											'</li></span></div>';
							endif;
							
						endforeach;	
					?>
				  </div>
				</div>
			</div>
		</div>
	<?php endif;  ?>
		
	<?php if(!empty($student['StudentJobSkill'])): ?>
		<div class="col-md-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title" >Conocimientos y habilidades profesionales</h3>
				  </div>
				  <div class="panel-body" style="padding-top: 0px;">
				  	<div class="col-md-12">
					<?php 
						foreach($student['StudentJobSkill'] as $k => $curso):
								echo '<div class="col-md-12" style="margin-top: 10px;">'.
									 	'<b><span style="color:#000; font-size: 14px;">'.
											'<li type="disc">'.$TipoCursos[$curso['type_course_id']].'</b>: '.$curso['name'].' / '.$curso['company'].'</li></span>'.
								 	'</div>';
						endforeach;	
					?>
					</div>
				  </div>
			</div>
		</div>
	<?php endif;  ?>
		
	<?php if(!empty($student['StudentTechnologicalKnowledge'])): ?>
		<div class="col-md-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Cómputo</h3>
				  </div>
				  <div class="panel-body" style="padding-top: 0px;">
				  	<div class="col-md-12">
					<?php 
						foreach($student['StudentTechnologicalKnowledge'] as $k => $computo):
								echo '<div class="col-md-12" style="margin-top: 10px;">';
									echo '<b><span style="color:#000; font-size: 14px;">
											<li type="disc">'.$computo['Tecnology']['tecnology'] .'</b>: ';
												if($computo['name']<>''):
													echo $software[$computo['name']];
												else:
													echo $computo['other'];
												endif;
												echo ' / '.$NivelesSoftware[$computo['level']];
												if($computo['institution']<>''):
													echo ' / Certificación: '.$computo['institution'];
												endif;
										echo '</li></span></div>';
						endforeach;	
					?>
				  </div>
				</div>
			</div>
		</div>
	<?php endif;  ?>
		
	<?php if(!empty($student['StudentProspect'])): ?>
		<div class="col-md-12">
			<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title" ></h3>
				  </div>
				  <div class="panel-body">
				  	<div class="col-md-12">
					<?php 
						echo '<div class="col-md-12">';
							echo '<b><span style="font-size: 14px;">Disponibilidad para viajar: </b>';
								if($student['StudentProspect']['can_travel']=='s'):
									echo 'Sí / ';
									if($student['StudentProspect']['can_travel_option']=='1'):
										echo 'Dentro del país';
									else:
										echo 'Fuera del país';
									endif;
								else:
									echo 'No';
								endif;
							echo '</span></div>';
						
						echo '<div class="col-md-12" style="margin-top: 10px;">';
							echo '<b><span style="font-size: 14px;">Disponibilidad para cambiar de residencia: </b>'; 
								if($student['StudentProspect']['change_residence']=='s'):
									echo 'Sí / ';
									if($student['StudentProspect']['change_residence_option']=='1'):
										echo 'Dentro del país';
									else:
										echo 'Fuera del país';
									endif;
								else:
									echo 'No';
								endif;	
							echo '</span></div>';
					?>
				 	 </div>
				</div>
			</div>
		</div>
	<?php endif;  ?>		
</div>	

	<div class="col-md-12"  style="text-align: left; margin-top: 10px">
		<div class="col-md-9" style="padding-left: 0px;">
			<label>Fecha de última actualización:<?php echo ' '.date("d/m/Y",strtotime($student['StudentLastUpdate']['modified'])); ?></label>
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
			<label style="float: right;">Folio:<span style="color: #FFB71F;"><?php echo ' '.$folio; ?></span></label>
		</div>
	</div>
	
		<div class="col-md-12 text-center">
		<a class="btn btn-info" style="margin-top: 5px; width: 150px;" href="javascript:window.history.back();"><i class="glyphicon glyphicon-arrow-left"></i> &nbsp; Regresar</a>
	</div>