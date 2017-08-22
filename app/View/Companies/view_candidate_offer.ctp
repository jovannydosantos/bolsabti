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
			 
			 $('#StudentReportarContratacionFechaContratacionYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentReportarContratacionFechaContratacionMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentReportarContratacionFechaContratacionDay').prepend('<option value="" selected>DD</option>');
			 
			 typeSearch();
		});
	
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
			
			function saveReportarContratacion(StudentId){
				document.getElementById('StudentReportarContratacionStudentId').value = StudentId;
				$('#myModalReportarContratacion').modal('show');
			}
			
			function saveOffer(StudentId){
				document.getElementById('CompanySavedStudentStudentId').value = StudentId;
				$('#myModal1').modal('show');
			}
			
			function validaFormSaveStudent(){
				var valor = document.getElementById("CompanySavedStudentStudentFolderId").value;
				if (valor == ''){
					jAlert('Seleccione la carpeta donde se guardará el perfil','Mensaje');
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
						jAlert('Adjuntar Cédula de Identificación Fiscal', 'Mensaje');
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
							jAlert('Compruebe la extensión de su imagen de RFC a subir. \nSólo se pueden subir imagenes con extensiones: ' + extensiones_permitidas.join(), 'Mensaje');
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
					jAlert('Ingrese el mensaje para la notificación telefónica', 'Mensaje');
					document.getElementById('taComentario').focus();
					return false;
					
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert('Seleccione la fecha completa para el día de la entrevista telefónica', 'Mensaje');
					document.getElementById('StudentNotificationCompanyInterviewDateDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					jAlert('La fecha de la entrevista telefónica no debe ser menor a la actual', 'Mensaje');
					document.getElementById('StudentNotificationCompanyInterviewDateDay').focus();
					return false;
				}else {
					document.getElementById("CompanyCompanyTelephoneNotificationForm").submit();
				 }
			}
		
		function validarReportarContratacionForm(){
				var fechaFinal = document.getElementById('StudentReportarContratacionFechaContratacionDay').value	+ "/" +
										document.getElementById('StudentReportarContratacionFechaContratacionMonth').value	+ "/" +
										document.getElementById('StudentReportarContratacionFechaContratacionYear').value	;
				
				selectedIndexDay = document.getElementById("StudentReportarContratacionFechaContratacionDay").selectedIndex;
				selectedIndexMonth = document.getElementById("StudentReportarContratacionFechaContratacionMonth").selectedIndex;
				selectedIndexYear = document.getElementById("StudentReportarContratacionFechaContratacionYear").selectedIndex;
			 
				responseValidateDate = validarFecha(fechaFinal);
				
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert('Seleccione la fecha completa para reportar la contratación', 'Mensaje');
					document.getElementById('StudentReportarContratacionFechaContratacionDay').focus();
					return false;
				}else  
				if(responseValidateDate == false){
					jAlert('La fecha para reportar contratación no es válida', 'Mensaje');
					document.getElementById('StudentReportarContratacionFechaContratacionDay').focus();
					return false;
				}else {
					return true;
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
				jAlert('Ingrese el mensaje para la notificación telefónica', 'Mensaje');
				document.getElementById('taComentario2').focus();
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) || (selectedIndexYear==0)){
				jAlert('Seleccione la fecha completa para el día de la entrevista personal', 'Mensaje');
				document.getElementById('StudentPersonalNotificationCompanyInterviewDateDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				jAlert('La fecha de la entrevista personal no debe ser menor a la actual', 'Mensaje');
				document.getElementById('StudentPersonalNotificationCompanyInterviewDateDay').focus();
				return false;
			}else {
				document.getElementById("CompanyCompanyPersonalNotificationForm").submit();
			 }
			
		}
	
		function validateEmpty(){
			selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
			
			if(document.getElementById('CompanyBuscar').value == ''){
				jAlert('Ingrese el nombre del candidato, correo ó folio', 'Mensaje');
				document.getElementById('CompanyBuscar').focus();
				return false;
			} else 
			if(selectedIndex == 0){
				jAlert('Seleccione el criterio de búsqueda', 'Mensaje');
				document.getElementById('CompanyCriterio').focus();
				return false;
			}else {
				return true;
			}
		}
		
		function sendLimit(){
			 selectedIndex = document.getElementById("limit").selectedIndex;
			 if(selectedIndex == 0){
				return false;
			 } else {
				document.getElementById('CompanyLimite').value = document.getElementById('limit').value;
				document.getElementById("CompanyViewCandidateOfferForm").submit();
			 }
		}
		
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;
			
			if(selectedIndexTypeSearch==1){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el nombre del candidato");
			}
			else
				if(selectedIndexTypeSearch==2){
					$("#CompanyBuscar").attr("placeholder", "Ingrese el correo electrónico");
				}
				else
					if(selectedIndexTypeSearch==3){
						$("#CompanyBuscar").attr("placeholder", "Ingrese el folio");
					}
					else{
						$("#CompanyBuscar").attr("placeholder", "Nombre candidato / Correo electrónico / Folio ");
					}
		}
	</script>

	<div class="col-md-12">
		<?php 
			echo $this->Session->flash();
			$paginator = $this->Paginator;
		?>
		<div class="col-md-12" >

			<div class="col-md-12" style="left: -35px;">
				<div class="col-md-12" style="top: 5px;">
					<p>Buscar candidatos dentro de oferta:</p>
				</div>
				
		
				<div class="col-md-9"  style="padding-left: 0px;">
					<?php 
					echo $this->Form->create('Company', array(
									'class' => 'form-horizontal', 
									'role' => 'form',
									'inputDefaults' => array(
															'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
															'div' => array('class' => 'form-group'),
															'class' => 'form-control',
															'before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">',
															'between' => ' <div class="col-md-12">',
															'after' => '</div></div>',
															'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
									),
									'action' => 'viewCandidateOffer',
									'onsubmit' =>'return validateEmpty();'
					)); ?>		
					<fieldset>
						<div class="col-md-7" style="padding-right: 0px;">
						<?php echo $this->Form->input('Buscar', array(
																'before' => '<div class="col-md-12" style="padding-left: 0px;">',
																'label' =>'',
																'value'	=> $this->Session->read('palabraBuscada'), 
																'placeholder' => 'Nombre candidato / Correo electrónico / Folio ',
																
						));	?>
						</div>
						<div  class="col-md-4" style="padding-left: 0px; padding-right: 0px;">
						<?php 	$options = array('1' => 'Nombre candidato', '2' => 'Correo electrónico', '3' => 'Folio');
								echo $this->Form->input('criterio', array(
														'type'=>'select',
														'selected' => $this->Session->read('tipoBusqueda'),
														'before' => '<div class="col-md-12" style="padding-left: 0px;">',
														'class' => 'selectpicker show-tick form-control show-menu-arrow',
														'label' =>'',
														'onchange' => 'typeSearch()',	
														'options' => $options,'default'=>'0', 'empty' => 'Criterio de búsqueda'
								)); ?>
						</div>

						<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>

						<div class="col-md-1" style="padding-left: 0px; padding-right: 0px;">
							<?php 
							echo $this->Form->button(
													'Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
													array(
														'type' => 'submit',
														'div' => 'form-group',
														'class' => 'btn btnBlue btn-default',
														'style' => 'width: 130px;',
														'escape' => false,
													)
							);

							echo $this->Form->end(); 
							?>
						</div>
					</fieldset>
				</div>
			</div>
			
			<div class="col-xs-10" style="left: -20px;">
				<p>Mostrar perfiles dentro de oferta: </p>
					<?php
						if($this->Session->read('tipoBusqueda')==4):
							$seleccionado10 = 'background-color: #e6e6e6; color: #333;';
							$seleccionado20 ='';
							$seleccionado30 = '';
							$seleccionado40 = '';
							$seleccionado50 = '';
							$seleccionado60 = '';
						else:
							if($this->Session->read('tipoBusqueda')==5):
								$seleccionado10 = '';
								$seleccionado20 = 'background-color: #e6e6e6; color: #333;';
								$seleccionado30 = '';
								$seleccionado40 = '';
								$seleccionado50 = '';
								$seleccionado60 = '';
							else:
								if($this->Session->read('tipoBusqueda')==6):
									$seleccionado10 = '';
									$seleccionado20 = '';
									$seleccionado30 = 'background-color: #e6e6e6; color: #333;';
									$seleccionado40 = '';
									$seleccionado50 = '';
									$seleccionado60 = '';
								else:
									if($this->Session->read('tipoBusqueda')==7):
										$seleccionado10 = '';
										$seleccionado20 = '';
										$seleccionado30 = '';
										$seleccionado40 = 'background-color: #e6e6e6; color: #333;';
										$seleccionado50 = '';
										$seleccionado60 = '';
									else:
										if($this->Session->read('tipoBusqueda')==8):
											$seleccionado10 = '';
											$seleccionado20 = '';
											$seleccionado30 = '';
											$seleccionado40 = '';
											$seleccionado50 = 'background-color: #e6e6e6; color: #333;';
											$seleccionado60 = '';
										else:
											if($this->Session->read('tipoBusqueda')==9):
												$seleccionado10 = '';
												$seleccionado20 = '';
												$seleccionado30 = '';
												$seleccionado40 = '';
												$seleccionado50 = '';
												$seleccionado60 = 'background-color: #e6e6e6; color: #333;';
											else:
												$seleccionado10 = '';
												$seleccionado20 = '';
												$seleccionado30 = '';
												$seleccionado40 = '';
												$seleccionado50 = '';
												$seleccionado60 = '';
											endif;
										endif;
									endif;
								endif;
							endif;
						endif;
					?>	
					<div class="btn-group" style="margin-left: 0px;">

					<?php 
							echo $this->Html->link(
													'Postulados', 
														array(
															'controller'=>'Companies',
															'action'=>'viewCandidateOffer',
															'?' => array(
																	  'tipoBusqueda' => 4,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 150px;'. $seleccionado10 ,
															)	
						); 	?> 
					</div>
					<img data-toggle="tooltip" id="" data-placement="top" title="El sistema filtrará todos los candidatos que se postularon a esta oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">
					<div class="btn-group" style="margin-left: 5px;">
						<?php 
							echo $this->Html->link(
													'Recomendados por SISBUT', 
														array(
															'controller'=>'Companies',
															'action'=>'viewCandidateOffer',
															'?' => array(
																	  'tipoBusqueda' => 5,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 210px;'. $seleccionado20 ,
															)	
						); 	?> 
					</div>
					<img data-toggle="tooltip" id="" data-placement="top" title="El sistema filtrará todos los candidatos que el SISBUT recomienda para esta oferta por su perfil" class="img-circle cambia" alt="help.png" src="/unam/img/help.png">
			</div>
			
			<div class="col-xs-12" style="left: -20px; margin-top: 15px;">
				<p>Filtrar candidatos por: </p>
					<div class="btn-group">
						<?php 
							echo $this->Html->link(
													'Todos', 
														array(
															'controller'=>'Companies',
															'action'=>'viewCandidateOffer',
															'?' => array(
																	  'tipoBusqueda' => 6,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 150px;'. $seleccionado30 ,
															)	
						); 	?> 
					</div>

					<div class="btn-group" style="margin-left: 30px;">
					<?php 
							echo $this->Html->link(
													'Entrevista Telefónicas', 
														array(
															'controller'=>'Companies',
															'action'=>'viewCandidateOffer',
															'?' => array(
																	  'tipoBusqueda' => 7,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 210px;'. $seleccionado40 ,
															)	
						); 	?> 
					</div>
					<img data-toggle="tooltip" id="" data-placement="top" title="El sistema filtrará todos los candidatos que fueron entrevistados telefónicamente." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">
					<div class="btn-group" style="margin-left: 5px;">
					<?php 
							echo $this->Html->link(
													'Entrevista Presenciales', 
														array(
															'controller'=>'Companies',
															'action'=>'viewCandidateOffer',
															'?' => array(
																	  'tipoBusqueda' => 8,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 210px;'. $seleccionado50 ,
															)	
						); 	?> 
					</div>
					<img data-toggle="tooltip" id="" data-placement="top" title="El sistema filtrará todos los candidatos que fueron entrevistados presencialmente." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">
					<div class="btn-group" style="margin-left: 5px;">
					<?php 
							echo $this->Html->link(
													'Contratados', 
														array(
															'controller'=>'Companies',
															'action'=>'viewCandidateOffer',
															'?' => array(
																	  'tipoBusqueda' => 9,
															),
														),
														array(
															'class' => 'btn btn-default btnBlue ',
															'style' => 'margin-top: 5px; width: 150px;'. $seleccionado60 ,
															)	
						); 	?> 
					</div>
					<img data-toggle="tooltip" id="" data-placement="top" title="El sistema filtrará todos los candidatos que fueron contratados para esta oferta." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">
			</div>

			<div class="col-md-9"  style="padding-left: 0px;">
			<?php if(isset($candidatos)): 
					if(empty($candidatos)):
						echo '<div class="col-md-9"  style="padding-left: 0px; margin-top: 15px;">';
							echo '<p style="font-size: 22px; ">Sin resultados</p>';
						echo '</div>';
					else:
			?>
			<div class="col-md-12" style="padding-left: 0px;">
				<p style="font-size: 20px; padding-left: 0px; margin-top: 15px;">Resultados de Búsqueda</p>
			</div>
				<?php 	$options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200);
						echo $this->Form->input('limit', array(
															'onchange' => 'sendLimit()',
															'type'=>'select',
															'style' => 'width: 200px; margin-right: 0px; margin-left: 20px;',
															'before' => '<div class="col-md-12 " style="margin-left: 130px;"',
															'selected' => $this->Session->read('limite'),
															'label' =>'',
															'options' => $options,'default'=>'0', 'empty' => 'Resultados por hoja'
					)); ?>	
					<div class="col-md-3" style="margin-top: -33px; margin-left: -20px;">
						<?php 	echo $this->Html->link(
													'Descargar Excel  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
															array(
																	'controller'=>'Companies',
																	'action'=>'viewCandidateOfferExcel',
																),
																array(
																	'class' => 'btn btn-default btnBlue ',
																	'style' => 'width: 180px; font-size: 14px; height: 32px;',
																	'escape' => false,
																	)	
												); 
						?>
					</div>
			</div>
		</div>
	</div>
		
				
		<div class="col-md-10" style="max-height: 760px; witdh:720px; overflow-y: auto; padding-left: 0px; padding-right: 0px; margin-top: 10px; margin-left: -25px;">
					
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
						
						<div class="col-md-4" style="background: #58595B; float: right; height: 30px;">
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
												'onclick' => 'saveTelephoneNotification('.$candidato['Student']['id'].');',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
										)); 
								?>
								
								<?php 
								echo $this->Html->image('student/personal.png',
											array(
												'title' => 'Ajendar entrevista presencial',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'savePersonalNotification('.$candidato['Student']['id'].');',
												'style' => 'width: 17px; height: 20px; margin-right: 10px; cursor:pointer;'
											)
								); 
								?>
								
								<?php 
								// $reportado = 0;
								// 	foreach($candidato['Report'] as $k => $studentReported):
								// 		if(($studentReported['company_id'] == ($this->Session->read('company_id')) AND ($studentReported['registered_by'] =='company' ))):
								// 			$reportado = 1;
								// 			break;
								// 		endif;
								// 	endforeach;
					
								// 	if($reportado == 0):
										echo $this->Html->image('student/contratado.png',
											array(
												'title' => 'Reportar contratación ',
												'class' => 'class="img-responsive center-block"',
												'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;',
												'onclick' => 'saveReportarContratacion('.$candidato['Student']['id'].');',
												)
										);
									// else:
									// 	echo $this->Html->image('student/noContratado.png',
									// 		array(
									// 			'title' => 'Contratación reportada',
									// 			'class' => 'class="img-responsive center-block"',
									// 			'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;',
									// 		));
									// endif;
								?>
								
								<?php 
									echo $this->Html->image('student/arroba.png',
												array(
													'title' => 'Enviar correo',
													'class' => 'class="img-responsive center-block"',
													'onclick' => 'saveEmailNotification("'.$candidato['Student']['email'].'");',
													'style' => 'width: 20px; height: 20px; margin-right: 6px; cursor:pointer;'
													)
									);	
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
								 // Descargar cv del estudiante
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
															'action' => 'viewCvPdf',$candidato['Student']['id'] 
															), 
														array('target' => '_blank','escape' => false,'title' => 'Descargar CV en PDF',)
											);
										endif;
									else:
										echo $this->Html->image('student/descargado.png',
																		array(
																			'title' => 'Descargar CV en PDF',
																			'class' => 'class="img-responsive center-block"',
																			'onclick' => 'return mensajeSinConfigurar();',
																			'style' => 'width: 17px; height: 20px; margin-right: 17px; cursor: help; '
																			)
																	);	
									endif;
								else:
									echo $this->Html->image('student/descargado.png',
											array(
												'title' => 'Descargar CV en PDF',
												'class' => 'class="img-responsive center-block"',
												'onclick' => 'return cvIncompleto();',
												'style' => 'width: 17px; height: 20px; margin-right: 17px; cursor: help; '
												)
												);	
								endif;
								?>
							</div>
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
				
			<?php 
				endif;
				endif; 
			?>
		</div>
		
		<div class="col-md-11" style="margin-left:10px;">
		<?php 
		if(!empty($candidatos)):
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
	
	<!--Form para ajendar entrevista telefónica-->
		<div class="modal fade" id="myModalnotificationTelefonica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%" height="100%">
						<div class="modal-dialog"  style="width: 630px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Enviar notificación para la entrevista telefónica</h4>
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
																												'before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="top" title="No hay sugerencias para este apartado" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" >',
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
						<div class="modal-dialog"  style="width: 670px">
							<div class="modal-content backgroundUNAM">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Enviar notificación para la entrevista personal</h4>
								</div>
								<div class="modal-body backgroundUNAM"style="height: 500px;">
									
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
																		'onsubmit' =>'return validateNotificationPersonalForm();',
																		'action' => 'companyPersonalNotification',
																		// 'onsubmit' =>'return validateNotificationPersonalForm();'
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
									<h4 class="modal-title" id="myModalLabel">Enviar de correo electrónico a perfil de candidato</h4>
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
	