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

<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD;">Ver candidatos dentro de ofertas.</p>
</blockquote>

<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Buscar candidatos dentro de oferta:</label>
	</div>
</div>

<?php 
	echo $this->Session->flash();
	$paginator = $this->Paginator;
?>

<div class="col-md-12" >
<?= $this->Form->create('Company', [
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
						'action' => 'viewCandidateOffer',
						'onsubmit' =>'return validateEmpty();']); ?>
	<fieldset>
		<div class="col-md-3">	
			
			<?php $options = array('1' => 'Nombre candidato', '2' => 'Correo electrónico', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('Buscar', ['placeholder' => 'Nombre candidato / Correo electrónico / Folio ','value'	=> $this->Session->read('palabraBuscada')]); ?>
		</div>
		<div class="col-md-2">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>
</div>

<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Mostrar perfiles dentro de oferta:</label>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-12">
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
		<div class="btn-group">				
			<?= $this->Html->link('Postulados', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 4]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado10]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Recomendados', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 5]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 130px;' . $seleccionado20]); ?> 
		</div>
	</div>
</div>
				
<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Filtrar candidatos por:</label>
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-12">
		<div class="btn-group">				
			<?= $this->Html->link('Todos', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 6]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 163px;' . $seleccionado30]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Entrevista Telefónicas', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 7]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 163px;' . $seleccionado40]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Entrevista Presenciales', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 8]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 163px;' . $seleccionado50]); ?> 
		</div>
		<div class="btn-group">				
			<?= $this->Html->link('Contratados', [ 'controller'=>'Companies','action'=>'viewCandidateOffer','?' => ['tipoBusqueda' => 9]],
											['class' => 'btn btn-info ','style' => 'margin-top: 5px; width: 163px;' . $seleccionado60]); ?> 
		</div>
	</div>
</div>



<div class="col-md-12">
	<div class="col-md-12">
		<label> Resultados de busqueda</label>
	</div>
</div>

<div class="col-md-3">
		<?php $options = array('25' => 25, '50' => 50, '100' => 100, '200' => 200); ?>
						<?= $this->Form->input('limit', ['type'=>'select','options' => $options,'id'=> 'limit','class' => 'selectpicker show-tick form-control show-menu-arrow','selected' => $this->Session->read('limit'),'default'=>'0', 'empty' => 'Resultados por hoja','onchange' => 'sendLimit()']); ?>	
</div>

<div class="col-md-9">
	<div class="col-md-4">
	 <?php 	echo $this->Html->link(
									'Descargar Excel &nbsp; <i class="glyphicon glyphicon glyphicon-save"></i>', 
											array(
													'controller'=>'Companies',
													'action'=>'offerAdminExcel',
												),
												array(
													'class' => 'btn btn-primary',
													'style'=>'margin-top: 7px;',
													'escape' => false,
													)	
								); 
		?>
	</div>
</div>

<?php if(isset($candidatos)): 
		if(empty($candidatos)):
			echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sin ofertas</p></div>';
		else:
?>
	
				
<div class="col-md-12 scrollbar" id="style-2" style="margin-top: 30px">
	<?= $this->element('candidatos'); ?>
</div>					

<?php 
		endif;
	endif; 
?>	