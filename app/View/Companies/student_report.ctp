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
			 
			 $('#StudentReportarContratacionFechaContratacionYear').prepend('<option value="" selected>AAAA</option>');
			 $('#StudentReportarContratacionFechaContratacionMonth').prepend('<option value="" selected>MM</option>');
			 $('#StudentReportarContratacionFechaContratacionDay').prepend('<option value="" selected>DD</option>');
			 
			typeSearch();
			<?php if($this->Session->check('companyJobProfileId')): ?>
				if ($('#'+'<?php echo $this->Session->read('companyJobProfileId'); ?>').length){
					document.getElementById('<?php echo $this->Session->read('companyJobProfileId'); ?>').scrollIntoView();
				}
			<?php endif; ?>
			typeSearchStudent();
			typeSearch();
		});	
		
		function validateEmpty(){
			selectedIndex = document.getElementById("CompanyCriterio").selectedIndex;
			var palabraBuscar = document.getElementById('CompanyBuscar').value ;
			var sueldo = document.getElementById("CompanyBuscarSalary").selectedIndex;
			
			
			if(selectedIndex == 0){
				$.alert({ title: '¡Aviso!',type: 'blue',content: 'Seleccione el criterio de búsqueda'});
				$( "#CompanyCriterio" ).focus();
				document.getElementById('CompanyCriterio').focus();
				return false;
			}else 
			if((palabraBuscar == '') && (sueldo == '')){
				
				if(selectedIndex == 1){
					$.alert({ title: '¡Aviso!',type: 'blue',content: 'Ingrese el puesto'});
					document.getElementById('CompanyBuscar').focus();
				} else
				if(selectedIndex == 2){
					$.alert({ title: '¡Aviso!',type: 'blue',content: 'Seleccione el rango de sueldo'});
					document.getElementById('CompanyBuscarSalary').focus();
				}else{
					$.alert({ title: '¡Aviso!',type: 'blue',content: 'Ingrese el folio'});
					document.getElementById('CompanyBuscar').focus();
				}
				return false;
			}else {
				return true;
			}
		}
		
		// function saveVigencia(idJobProfile,fecha){
			// var fechaArr = fecha.split('-');
			// var aho = fechaArr[0];
			// var mes = fechaArr[1];
			// var dia = fechaArr[2];
			
			// $("#CompanyJobProfileExpirationYear option[value='"+aho+"']").prop('selected', true);
			// $("#CompanyJobProfileExpirationMonth option[value='"+mes+"']").prop('selected', true);
			// $("#CompanyJobProfileExpirationDay option[value='"+dia+"']").prop('selected', true);
		
			// document.getElementById('CompanyJobProfileId').value = idJobProfile;
			// $('#myModalVigencia').modal('show');
		// }
		
		function saveVigencia(idJobProfile,fecha, fechaCreacion){
			var fechaArr = fecha.split('-');
			var aho = fechaArr[0];
			var mes = fechaArr[1];
			var dia = fechaArr[2];
			
			$("#CompanyJobProfileExpirationYear option[value='"+aho+"']").prop('selected', true);
			$("#CompanyJobProfileExpirationMonth option[value='"+mes+"']").prop('selected', true);
			$("#CompanyJobProfileExpirationDay option[value='"+dia+"']").prop('selected', true);
			
			var fechaArr = fechaCreacion.split('-');
			var aho = fechaArr[0];
			var mes = fechaArr[1];
			var dia = fechaArr[2];
			
			$("#CompanyJobProfileCreatedYear option[value='"+aho+"']").prop('selected', true);
			$("#CompanyJobProfileCreatedMonth option[value='"+mes+"']").prop('selected', true);
			$("#CompanyJobProfileCreatedDay option[value='"+dia+"']").prop('selected', true);
		
			document.getElementById('CompanyJobProfileId').value = idJobProfile;
			$('#myModalVigencia').modal('show');
		}
		
		function fechaMax(fecha, fechaCreacion){
			<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1; //hoy es 0!
				var yyyy = hoy.getFullYear();
				hoy = yyyy+'-'+mm+'-'+dd;
				var fechaCreacion = hoy;
			<?php else: ?>
				var fechaCreacion = fechaCreacion;
			<?php endif; ?>
			
				var fechaArrCreacion = fechaCreacion.split('-');
				var aho2 = fechaArrCreacion[0];
				var mes2 = fechaArrCreacion[1];
				var dia2 = fechaArrCreacion[2];
				var fechaCreacionOferta = new Date(aho2,mes2,dia2);

				var fechaArr = fecha.split('/');
				var aho = fechaArr[2];
				var mes = fechaArr[1];
				var dia = fechaArr[0];
				var fechaPropuesta = new Date(aho, mes-1, dia); 

				if(fechaPropuesta > fechaCreacionOferta){
					return false;
				} else{
					return true;
				}
	}
	
		function validateVigenciaForm(){
				var f = new Date();
				var fechaInicial = f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();
				var fechaFinal = document.getElementById('CompanyJobProfileExpirationDay').value	+ "/" +
										document.getElementById('CompanyJobProfileExpirationMonth').value	+ "/" +
										document.getElementById('CompanyJobProfileExpirationYear').value	;
				
				var fechaCreacion = document.getElementById('CompanyJobProfileCreatedYear').value	+ "-" +
										document.getElementById('CompanyJobProfileCreatedMonth').value	+ "-" +
										document.getElementById('CompanyJobProfileCreatedDay').value;
				

				selectedIndexDay = document.getElementById("CompanyJobProfileExpirationDay").selectedIndex;
				selectedIndexMonth = document.getElementById("CompanyJobProfileExpirationMonth").selectedIndex;
				selectedIndexYear = document.getElementById("CompanyJobProfileExpirationYear").selectedIndex;
				
				responseValidateDate = validarFecha(fechaFinal);
				fechaMaxima = fechaMax(fechaFinal,fechaCreacion);
				
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert ('Seleccione la fecha completa para la vigencia','Mensaje');
					document.getElementById('CompanyJobProfileExpirationYear','Mensaje').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					jAlert('La fecha de vigencia no debe ser menor a la actual', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationYear').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					jAlert('La fecha de vigencia es incorrecta', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationYear').focus();
					return false;
				}else
				if(fechaMaxima == false){
					<?php if(($this->Session->read('Auth.User.role')=='administrator') OR ($this->Session->read('Auth.User.role')=='subadministrator')): ?>
						jAlert('La fecha de vigencia es de máximo 1 mes respecto a la fecha actual', 'Mensaje');
					<?php else: ?>
						jAlert('La fecha de vigencia es de máximo 1 mes respecto a la fecha de creación de la oferta', 'Mensaje');
					<?php endif; ?>		
					document.getElementById('CompanyJobProfileExpirationYear').focus();
					return false;
				}else
				if(responseValidateDate == false){
					jAlert('La fecha de vigencia es incorrecta', 'Mensaje');
					document.getElementById('CompanyJobProfileExpirationYear').focus();
					return false;
				}else{
					return true;
				 }
		}
			
		function typeSearch(){
			selectedIndexTypeSearch = document.getElementById("CompanyCriterio").selectedIndex;
			
			
				if(selectedIndexTypeSearch==0){
						$("#CompanyBuscar").attr("placeholder", "Ingrese el Puesto, Sueldo o Folio");
						
				}else
			if(selectedIndexTypeSearch==2){
				$("#idDivBuscar").hide();
				$("#idDivBuscarSelect").show();
				
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
					jAlert ('Ingrese el mensaje para la notificación telefónica','Mensaje');
					document.getElementById('StudentTelephoneNotificationMessage').focus();
					return false;
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert ('Seleccione la fecha completa para el día de la entrevista telefónica','Mensaje');
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					jAlert ('La fecha de la entrevista telefónica no debe ser menor a la actual','Mensaje');
					document.getElementById('StudentTelephoneNotificationDateDay').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					jAlert ('La fecha de la entrevista telefónica no es válida','Mensaje');
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
				jAlert ('Ingrese el mensaje para la notificación personal','Mensaje');
				document.getElementById('StudentPersonalNotificationMessage').focus();
				return false;
			} else
			if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
				jAlert ('Seleccione la fecha completa para el día de la entrevista personal','Mensaje');
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else 
			 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
				jAlert ('La fecha de la entrevista personal no debe ser menor a la actual','Mensaje');
				document.getElementById('StudentPersonalNotificationDateDay').focus();
				return false;
			}else 
			if(responseValidateDate == false){
				jAlert ('La fecha de la entrevista personal no es válida','Mensaje');
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
					jAlert ('Ingrese el mensaje para la nueva propuesta','Mensaje');
					document.getElementById('taComentarioPropuesta').focus();
					return false;
				} else
				if((selectedIndexDay==0) || (selectedIndexMonth==0) ||(selectedIndexYear==0)){
					jAlert ('Seleccione la fecha completa para el día de la entrevista','Mensaje');
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else 
				 if(validate_fechaMayorQue(fechaInicial,fechaFinal)){
					jAlert ('La fecha de la entrevista no debe ser menor a la actual','Mensaje');
					document.getElementById('StudentPropuestaFechaDay').focus();
					return false;
				}else 
				if(responseValidateDate == false){
					jAlert ('La fecha de la entrevista no es válida','Mensaje');
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
					jAlert ('Seleccione la fecha completa para reportar la contratación','Mensaje');
					document.getElementById('StudentReportarContratacionFechaContratacionDay').focus();
					return false;
				}else  
				if(responseValidateDate == false){
					jAlert ('La fecha para reportar contratación no es válida','Mensaje');
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
<?php 
	echo $this->Session->flash();
	$paginator = $this->Paginator;
?>	
<script>
function openModalReporte(id){
			document.getElementById('ReportCompanyJobProfileId').value = id;
			$('#openModal').modal('show');
		}
</script>
<div class="col-md-12">
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
      <p style="color: #588BAD">Buscar oferta publicada:</p>
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
								'onsubmit' =>'return validateEmpty();']); ?>
	
	<fieldset>
		<div class="col-md-3">
			<?php $options = array('1' => 'Puesto', '2' => 'Sueldo', '3' => 'Folio'); ?>
			<?= $this->Form->input('criterio', ['type'=>'select','options' => $options,'selected' => $this->Session->read('tipoBusqueda'),'onchange' => 'typeSearch()','class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Criterio de búsqueda']); ?>
		</div>

		<div class="col-md-6" id="idDivBuscar" style="display: none;" >
			<?= $this->Form->input('Buscar', ['placeholder' => 'Puesto / Sueldo / Folio','value'=> $this->Session->read('palabraBuscada'),]); ?>
		</div>

		<div class="col-md-6" id="idDivBuscarSelect" style="display: none;" >
			<?= $this->Form->input('buscarSalary', ['type'=>'select','options' => $Salarios,'selected' => $this->Session->read('palabraBuscada'),'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Sueldo (Neto)']); ?>
		</div>

		<?= $this->Form->input('limite', ['type'=>'hidden']); ?>

		<div class="col-md-2 text-center" style="margin-top: 6px;">
			<?= $this->Form->button('Buscar <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary col-md-12','escape' => false]);?>
			<?= $this->Form->end(); ?>
		</div>	
	</fieldset>
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
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 0px;margin-bottom: 5px;">
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
		<div class="col-md-2 text-center" style="margin-top: 6px;">
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
		
	