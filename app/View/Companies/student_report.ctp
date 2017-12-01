<?php 
	$this->layout = 'company'; 
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
			
			 $('#CompanyJobProfileExpirationYear').prepend('<option value="" selected>AAAA</option>');
			 $('#CompanyJobProfileExpirationMonth').prepend('<option value="" selected>MM</option>');
			 $('#CompanyJobProfileExpirationDay').prepend('<option value="" selected>DD</option>');
			 
			typeSearch();
		});		
	function validateEmptyCompany(){
			selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
			var palabraBuscar = document.getElementById('CompanyBuscar').value ;
			var sueldo = document.getElementById("CompanyBuscarSalary").selectedIndex;

			if(selectedIndex == 0){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda'});
				document.getElementById('CompanyCriterio').focus();
				return false;
			}else 
			if((palabraBuscar == '') && (sueldo == '')){
				
				if(selectedIndex == 1){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el puesto'});
					document.getElementById('CompanyBuscar').focus();
				} else
				if(selectedIndex == 2){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el rango de sueldo'});
					document.getElementById('CompanyBuscarSalary').focus();
				}else{
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el folio'});
						document.getElementById('CompanyBuscar').focus();
				}
				
				return false;
			}else {
				return true;
			}
		}
	function typeSearchStudent(){
			if ( $("#CompanyCriterioStudent").length > 0 ) {
				selectedIndexTypeSearch = document.getElementById("CompanyCriterioStudent").selectedIndex;
			
				if(selectedIndexTypeSearch==1){
					$("#CompanyBuscarStudent").attr("placeholder", "Ingrese el nombre del candidato");
				}
				else
					if(selectedIndexTypeSearch==2){
						$("#CompanyBuscarStudent").attr("placeholder", "Ingrese el correo electrónico");
					}
					else
						if(selectedIndexTypeSearch==3){
							$("#CompanyBuscarStudent").attr("placeholder", "Ingrese el folio");
						}
						else{
							$("#CompanyBuscarStudent").attr("placeholder", "Nombre candidato / Correo electrónico / Folio ");
						}
			}
		}
	function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;

			if(selectedIndexTypeSearch==2){
				$("#idDivBuscar").hide();
				$("#idDivBuscarSelect").show();
				$('#CompanyBuscar').val('');
				
			} else {
				$("#idDivBuscar").show();
				$("#idDivBuscarSelect").hide();
				
				document.getElementById('CompanyBuscarSalary').options[0].selected = 'selected';
			}
			
			if(selectedIndexTypeSearch==1){
				$("#CompanyBuscar").attr("placeholder", "Ingrese el puesto");
			}
			else
				if(selectedIndexTypeSearch==3){
						$("#CompanyBuscar").attr("placeholder", "Ingrese el folio");
				}
			
		}
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
	function saveTelephoneNotification(StudentId){
				document.getElementById('StudentTelephoneNotificationId').value = StudentId;
				$('#myModalnotificationTelefonica').modal('show');
			}
	function savePersonalNotification(StudentId){
				document.getElementById('StudentPersonalNotificationId').value = StudentId;
				$('#myModalnotificationPersonal').modal('show');
			}
	function saveEmailNotification(email){
				document.getElementById('StudentEmailTo').value = email;
				$('#myModalMail').modal('show');
			}
	function nuevaFechaEntrevista(id, company_job_profile_id){
				document.getElementById('StudentPropuestaId').value = id;
				document.getElementById('StudentPropuestaCompsnyaJobProfileId').value = company_job_profile_id;
				$('#myModalnotification').modal('show');
				return false;
			}
	function saveOffer(StudentId){
				document.getElementById('CompanySavedStudentStudentId').value = StudentId;
				$('#myModal1').modal('show');
			}
	function validaFormSaveStudent(){
				var valor = document.getElementById("CompanySavedStudentCompanyFolderId").value;
				if (valor == ''){
					alert('Seleccione la carpeta donde se guardará el perfil');
					document.getElementById("CompanySavedStudentCompanyFolderId").focus;
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
						jAlert('Adjuntar Cédula de Identificación Fiscal','Mensaje');
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
	function saveReportarContratacion(StudentId){
				document.getElementById('StudentReportarContratacionStudentId').value = StudentId;
				$('#myModalReportarContratacion').modal('show');
			}
	function validateTelephoneNotificationForm(){
				var f = new Date();
				var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
				var fechaFinal = document.getElementById('StudentTelephoneNotificationDateDay').value	+ "/" +
										document.getElementById('StudentTelephoneNotificationDateMonth').value	+ "/" +
										document.getElementById('StudentTelephoneNotificationDateYear').value;
				
				
				selectedIndexDay = document.getElementById("StudentTelephoneNotificationDateDay").selectedIndex;
				selectedIndexMonth = document.getElementById("StudentTelephoneNotificationDateMonth").selectedIndex;
				selectedIndexYear = document.getElementById("StudentTelephoneNotificationDateYear").selectedIndex;
				
				responseValidateDate = validarFecha(fechaFinal);
				
				if(document.getElementById('StudentTelephoneNotificationMessage').value == ''){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el mensaje para la notificación telefónica'});
					document.getElementById('StudentTelephoneNotificationMessage').focus();
					return false;
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione la fecha completa para el día de la entrevista telefónica'});
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					 $.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de la entrevista telefónica no debe ser menor a la actual'});
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					 $.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de la entrevista telefónica no es válida'});
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else{
					document.getElementById("FormTelephoneNotification").submit();
				 }
			}
	function validatePersonalNotificationForm(){
			
			var f = new Date();
			var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
			var fechaFinal = document.getElementById('StudentPersonalNotificationDateDay').value	+ "/" +
									document.getElementById('StudentPersonalNotificationDateMonth').value	+ "/" +
									document.getElementById('StudentPersonalNotificationDateYear').value	;
			

			selectedIndexDay = document.getElementById("StudentPersonalNotificationDateDay").selectedIndex;
			selectedIndexMonth = document.getElementById("StudentPersonalNotificationDateMonth").selectedIndex;
			selectedIndexYear = document.getElementById("StudentPersonalNotificationDateYear").selectedIndex;
			
			responseValidateDate = validarFecha(fechaFinal);
			
			if(document.getElementById('StudentPersonalNotificationMessage').value == ''){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el mensaje para la notificación personal'});
				document.getElementById('StudentPersonalNotificationMessage').focus();
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione la fecha completa para el día de la entrevista personal'});
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
			 $.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de la entrevista personal no debe ser menor a la actual'});
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else 
			if(responseValidateDate == false){
				 $.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de la entrevista personal no es válida'});
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else{
				document.getElementById("FormPersonalNotification").submit();
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
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el mensaje para la nueva propuesta'});
					document.getElementById('taComentarioPropuesta').focus();
					return false;
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione la fecha completa para el día de la entrevista'});
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					 $.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de la entrevista no debe ser menor a la actual'});
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					 $.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha de la entrevista no es válida'});
		
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else{
					document.getElementById("formNotificacionPropuesta").submit();
				 }
			}
	function validateEmptyStudent(){
			selectedIndex = document.getElementById("CompanyCriterioStudent").selectedIndex;
			
			if(document.getElementById('CompanyBuscarStudent').value == ''){
			//	jAlert ('Ingrese el nombre del candidato, correo ó folio','Mensaje');
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Ingrese el nombre del candidato, correo ó folio'});
				document.getElementById('CompanyBuscarStudent').focus();
				return false;
			} else 
			if(selectedIndex == 0){
			//	jAlert ('Seleccione el criterio de búsqueda','Mensaje');
				$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda'});
				document.getElementById('CompanyCriterioStudent').focus();
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
				document.getElementById("CompanySearchCandidateForm").submit();
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
	
					$.alert({ title: '!Aviso!',type: 'blue',content: 'Seleccione la fecha completa para reportar la contratación'});
					document.getElementById('StudentReportarContratacionFechaContratacionDay').focus();
					return false;
				}else  
				if(responseValidateDate == false){
					$.alert({ title: '!Aviso!',type: 'blue',content: 'La fecha para reportar contratación no es válida'});
					document.getElementById('StudentReportarContratacionFechaContratacionDay').focus();
					return false;
				}else {
					return true;
				 }
		}
	function deleteOffer(param){
				document.getElementById('focusOfferId'+param).scrollIntoView();
				jConfirm('¿Realmente desea eliminar la oferta?', 'Confirmación', function(r){
					if( r ){						
						$("#deleteOfferId"+param).click();
					}
				});
		}
</script>
	
<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Administrar ofertas guardadas.
        <?php if((isset($intoFolder)) and ($intoFolder<>'')): ?>
				<img class="estatica" src="<?php echo $this->webroot; ?>img/student/folder1.png" style="width: 25px; ">   
				<label><?php echo $foldersList[$intoFolder]; ?> </label>
		<?php endif?></p>
</blockquote>

<div class="col-md-12" >
	<div class="col-md-12" >
		<label>Buscar oferta:</label>
	</div>
</div>

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
						'action' => 'studentReport',
						'onsubmit' =>'return validateEmptyCompany();']); ?>

	<fieldset>
		<div class="col-md-3">
			<?php $options = array('1' => 'Puesto', '2' => 'Sueldo', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'onchange' => 'typeSearch()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6" id="idDivBuscar">
			<?= $this->Form->input('Buscar', ['placeholder' => 'Puesto / Sueldo / Folio ','value'	=> $this->Session->read('palabraBuscada')]); ?>
		</div>
		<div class="col-md-6" id="idDivBuscarSelect">
			<?= $this->Form->input('buscarSalary', ['placeholder' => 'Puesto / Sueldo / Folio ','value'	=> $this->Session->read('palabraBuscada'),'options' => $Salarios,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Sueldo (Neto)']); ?>
		</div>
		<?php echo $this->Form->input('limite', array('type'=>'hidden')); ?>
		<div class="col-md-2">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>
</div>

		
<div class="col-md-12">
	<div class="col-md-12">
		<label> Resultados de busqueda</label>
	</div>
</div>



<?php if(isset($ofertas)): 
		if(empty($ofertas)):
			echo '<div class="col-md-12" style="margin-top: 15px;"> <p style="font-size: 22px;margin-left: -20px;">Sin ofertas</p></div>';
		else:
?>
	
				
<div class="col-md-12 scrollbar" id="style-2" >
<?= $this->element('ReportarOfertasCom'); ?>
		
	<div class="col-md-12">
		<center>
			<?php 
				if(!empty($ReportarOfertasCom)):
			?>
		
			<div class="pagination" style="margin-top: 5px;margin-bottom: 15px;">
					<p style="margin-bottom: 0px;">
						<?= $this->Paginator->counter(array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')); ?>
					</p>
		    		<ul class="pagination pagination-sm" style="margin-top: 5px;margin-bottom: 5px;">  
						<?= $this->Paginator->first('<<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1)); ?>
						<?= $this->Paginator->next('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->last('>>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
			        </ul>
		    </div>
			
			<?php endif; ?>
		</center>
	</div>			
</div>					

<?php 
		endif;
	endif; 
?>	

		
<?php if(isset($ofertaSeleccionada) and ($ofertaSeleccionada <> '')): ?>
		
<div class="col-md-12" >
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 50px;margin-bottom: 5px;">
	    <p style="color: #588BAD">Buscar candidatos dentro de oferta:</p>
	</blockquote>
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
						'action' => 'studentReport',
						'onsubmit' =>'return validateEmptyStudent();']); ?>

	<fieldset>
		<?php echo $this->Form->input('limiteStudent', array('type'=>'hidden')); ?>
		<div class="col-md-3">
			<?php $options = array('1' => 'Nombre candidato', '2' => 'Correo electrónico', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterioStudent', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusquedaStudent'),'class' => 'selectpicker show-tick form-control show-menu-arrow','onchange' => 'typeSearchStudent()','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>
		<div class="col-md-6">
			<?= $this->Form->input('BuscarStudent', ['placeholder' => 'Nombre candidato / Correo electrónico / Folio ','value'	=> $this->Session->read('palabraBuscadaStudent')]); ?>
		</div>
		<div class="col-md-2 text-center">
			<?= $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false,'style'=>'margin-top: 7px;']);?>
			<?= $this->Form->end(); ?>
		</div>
	</fieldset>
</div>
		
<?php endif; ?>
		
<?php if(isset($candidatos)): 
		if(empty($candidatos)):
			echo '<div class="col-md-9"  style="padding-left: 0px; margin-left: 15px; margin-bottom: 100px; margin-left: 45px;"">';
			echo '<p style="font-size: 22px; ">Sin candidatos</p>';
			echo '</div>';
		else:
?>
			
<?php 
	foreach($candidatos as $k => $candidato):
?>

<div class="col-md-12" style="margin-top: 30px">
	<?= $this->element('candidatos'); ?>
		
<div class="col-md-12">
		<center>
			<?php 
				if(!empty($candidatos)):
			?>
		
			<div class="pagination" style="margin-top: 5px;margin-bottom: 15px;">
					<p style="margin-bottom: 0px;">
						<?= $this->Paginator->counter(array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')); ?>
					</p>
		    		<ul class="pagination pagination-sm" style="margin-top: 5px;margin-bottom: 5px;">  
						<?= $this->Paginator->first('<<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1)); ?>
						<?= $this->Paginator->next('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->last('>>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
			        </ul>
		    </div>
			
			<?php endif; ?>
		</center>
	</div>			
</div>	


<?php endforeach; ?>

		
<?php 
	endif;
		endif;		
?>
		
