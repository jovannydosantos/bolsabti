<?php	
	$this->layout = 'company'; 
?>	
	<style>
	.required label:after {
		  content:"*";
		  display: block;
		  position: absolute;
		  top: -4px;
		  left: 23px;
		  color:red;
	}
	.container-non-responsive {
		  margin-left: auto;
		  margin-right: auto;
		  padding-left: 15px;
		  padding-right: 15px;
		  width: 1000px;
	}
	.form-group {
		margin-bottom: 10px;
	}
	.form-control{
		padding: 6px 5px;
		font-size: 12px;
	}
	.container {
		width: auto;
	}

	</style>
	
	<script>
	$(document).ready(function() {
			var helpText = [
							"", 
							"", 
							"Es el nombre oficial y legal de la empresa de acuerdo con su documentación oficial y a su Registro Federal de Contribuyentes (RFC).",
							"Nombre que identifica a una empresa o institución y la distingue entre las empresas que desarrollan actividades similares.",
							"",
							"",
							"",
							"Total del personal que labora en la empresa o institución.",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"Información y características que permitan al candidato conocer aspectos de interés y atractivos de la empresa o institución.",
							"Con el fin de validar los datos de la empresa o institución es necesario anexar la cédula de identificación fiscal (RFC).                          Ejemplo:                   Incorporar imagen de cédula de identificación fiscal.",
							"Anexar en imagen jpg el logo o escudo de la empresa o institución, con un peso no mayor de 80KB.",
							"El RFC de la empresa o institución se asignará como usuario para ingresar al portal.",
							"Clave de 6 caracteres mínimo y 10 caracteres máximo, la cual debe contener caracteres alfanuméricos, letras y signos.",
							"",
							"",
							"",
							"",
							"",
							"",
							"Dirección electrónica otorgada por la empresa o institución al responsable de registro."
							];
			 
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});
			
			$("#estado").on('change',function (){
				if($("#estado").val() != 0)
					{	
						$('#loading').show();
						$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
							{	
								$('#ciudad').empty();
								$('#ciudad').append('<option value="">Delegación / Municipio</option>');
								
								var waitCount = 0;
								$.each(JSON, function(key, val){
									waitCount++;
								});
								
								$.each(JSON, function(key, val){
									$('#ciudad').append('<option value="' + val.mun + '">' + val.mun + '</option>');
									
									if (--waitCount == 0) {
										$('#loading').hide();
										$('.selectpicker').selectpicker('refresh');
									}
									
								});
							});	
					}
					else
					{
						$('#ciudad').empty();
						$('#ciudad').append('<option value="">Delegación / Municipio</option>');
						$('.selectpicker').selectpicker('refresh');
					}
					
				});	

			$("#estado2").on('change',function (){
				if($("#estado2").val() != 0)
					{	
						$('#loading').show();
						$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado2 option:selected").text() },function(JSON)
							{	
								$('#ciudad2').empty();
								$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
								
								var waitCount = 0;
								$.each(JSON, function(key, val){
									waitCount++;
								});
							
								$.each(JSON, function(key, val){
									$('#ciudad2').append('<option value="' + val.mun + '">' + val.mun + '</option>');
									
									if (--waitCount == 0) {
										$('#loading').hide();
										$('.selectpicker').selectpicker('refresh');
									}
								
								});
							});	
					}
					else
					{
						$('#ciudad2').empty();
						$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
						$('.selectpicker').selectpicker('refresh');
					}
					
				});	
				
			// Carga automática de las ciudades si es que existe un estado seleccionado (AUTOMÁTICO)
			if($("#estado").val() != 0)
				{	
					$('#loading').show();
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
						{	
							$('#ciudad').empty();
							$('#ciudad').append('<option value="">Delegación / Municipio</option>');
							
							var waitCount = 0;
							$.each(JSON, function(key, val){
								waitCount++;
							});
							
							$.each(JSON, function(key, val){
								if(val.mun == '<?php echo (isset($this->request->data['CompanyProfile']['city']) and ($this->request->data['CompanyProfile']['city'] <> '')) ? $this->request->data['CompanyProfile']['city']: ''; ?>'){
									$('#ciudad').append('<option value="' + val.mun + '" selected>' + val.mun + '</option>');
								}else{
									$('#ciudad').append('<option value="' + val.mun + '">' + val.mun + '</option>');
								}
								
								if (--waitCount == 0) {
									$('#loading').hide();
									$('.selectpicker').selectpicker('refresh');
								}
								
							});
						});	
				}
				else
				{
					$('#ciudad').empty();
					$('#ciudad').append('<option value="">Delegación / Municipio</option>');
					$('.selectpicker').selectpicker('refresh');
				}
			
			if($("#estado2").val() != 0)
				{	
					$('#loading').show();
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
						{	
							$('#ciudad2').empty();
							$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
							
							var waitCount = 0;
							$.each(JSON, function(key, val){
								waitCount++;
							});

							$.each(JSON, function(key, val){
								if(val.mun == '<?php echo (isset($this->request->data['CompanyProfile']['city_sede']) and ($this->request->data['CompanyProfile']['city_sede'] <> '')) ? $this->request->data['CompanyProfile']['city_sede']: ''; ?>'){
									$('#ciudad2').append('<option value="' + val.mun + '" selected>' + val.mun + '</option>');
								}else{
									$('#ciudad2').append('<option value="' + val.mun + '">' + val.mun + '</option>');
								}
								
								if (--waitCount == 0) {
									$('#loading').hide();
									$('.selectpicker').selectpicker('refresh');
								}

							});
						});	
				}
				else
				{
					$('#ciudad2').empty();
					$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
					$('.selectpicker').selectpicker('refresh');
				}
				
				copyEmail();
				addhttp();
			
		});	
		
		function cambiarContenido(){
			
			var archivo = document.getElementById('CompanyFile').value;
			extensiones_permitidas = new Array(".jpg",".pdf");
			mierror = "";

			if (!archivo) {
					jAlert('Adjuntar Cédula de Identificación Fiscal', 'Mensaje');
					document.getElementById('CompanyFile').scrollIntoView();
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
						document.getElementById('CompanyFile').scrollIntoView();
						deleteText();
						return false;
					}else{
						document.getElementById("textFile").innerHTML = document.getElementById('CompanyFile').value + '<button id="deleteTextId" onclick="deleteText();" class="btnBlue" style="margin-left: 10px;" >x</button>';
						return false;
					}
			   }
		
		}
		
		function condiciones(){
			 
			if(document.getElementById('CompanyFile').value == ''){
				jAlert('Adjuntar Cédula de Identificación Fiscal', 'Mensaje');
				document.getElementById('AdjuntarRfcId').scrollIntoView();
				return false;
			}
			else if( $('#terminos').is(':checked') ) {
				//return true;
			} else {
				jAlert('No ha aceptado términos y condiciones: Aún no ha aceptado los  términos  y condiciones del SISBUT. Los puede consultar en la liga en azul: “Leer Aviso de Privacidad”', 'Mensaje');
				document.getElementById('terminos').focus();
				return false;
			}
		}
		
		function deleteText(){
			document.getElementById("textFile").innerHTML = '';
			document.getElementById('CompanyFile').value = '';  
			return false;
		}
		
		function deleteImg(){
			$("#image-container").removeAttr('src', '');
			document.getElementById("image-container").style.display = "none";
			document.getElementById("deleteImgId").style.display = "none";
			document.getElementById('CompanyFilename').value = '';  
			document.getElementById('CompanyDir').value = '';
			document.getElementById('CompanyMimetype').value = '';
			document.getElementById('CompanyFilesize').value = '';
			return false;
		}
		
		function changeImg(){
			document.getElementById("deleteImgId").style.display = "initial";
			
			var archivo = document.getElementById('CompanyFilename').value;
			extensiones_permitidas = new Array(".jpg");
			mierror = "";
			  
			if (!archivo) {
					alert ('Selecciona el logo de la empresa');
					document.getElementById('CompanyFilename').scrollIntoView();
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
						deleteImg();
						jAlert('Compruebe la extensión de su imagen de logo a subir. \nSólo se pueden subir imagenes con extensiones: "' + extensiones_permitidas.join(), 'Mensaje');
						document.getElementById('CompanyFilename').scrollIntoView();
						return false;
					} else {
						var fileInput = document.getElementById('CompanyFilename');
						var image = document.getElementById('image-container');
						var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
						image.src = fileUrl;
						document.getElementById("image-container").style.display = "initial";
						$("#image-container").css("width", "150px");
						return false;
					}
			   }

		}
		
		function copyEmail(){
			document.getElementById('CompanyEmailConfirm').value = document.getElementById('CompanyEmail').value ;
		}
		
		function emptyConfirm(){
			document.getElementById("CompanyEmailConfirm").value = '';
		}
		
		function addhttp(){
			var urlpattern = new RegExp('(http|ftp|https)://[a-z0-9\-_]+(\.[a-z0-9\-_]+)+([a-z0-9\-\.,@\?^=%&;:/~\+#]*[a-z0-9\-@\?^=%&;/~\+#])?', 'i')
			var txtfield = $('#CompanyProfileWebSite').val() /*this is a textarea*/
			
			if(txtfield!=''){
				if ( !urlpattern.test(txtfield) ){
					document.getElementById('CompanyProfileWebSite').value = "http://" + txtfield;
				}
			}
		}
		
		function clonarFormacionAcademica(){
			document.getElementById('CompanyProfileStreetSede').value = document.getElementById('CompanyProfileStreet').value;
			document.getElementById('estado2').options[$("#estado option:selected").index()].selected = 'selected';
			if($("#estado2").val() != 0)
				{	
					$('#loading').show();
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
						{	
							$('#ciudad2').empty();
							$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
							
							var waitCount = 0;
							$.each(JSON, function(key, val){
								waitCount++;
							});

							$.each(JSON, function(key, val){
								if(val.mun == $("#ciudad option:selected").text()){
									$('#ciudad2').append('<option value="' + val.mun + '" selected>' + val.mun + '</option>');
								}else{
									$('#ciudad2').append('<option value="' + val.mun + '">' + val.mun + '</option>');
								}
								
								if (--waitCount == 0) {
									$('#loading').hide();
									$('.selectpicker').selectpicker('refresh');
								}

							});
						});	
				}
				else
				{
					$('#ciudad2').empty();
					$('#ciudad2').append('<option value="">Delegación / Municipio</option>');
					$('.selectpicker').selectpicker('refresh');
				}
			document.getElementById('CompanyProfileSubdivisionSede').value = document.getElementById('CompanyProfileSubdivision').value;
			document.getElementById('CompanyProfileZipSede').value = document.getElementById('CompanyProfileZip').value;
			
			return false;
		}

	</script>
	
	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD;">Actualizar datos de registro.</p>
    </blockquote>
	
		<div class="col-md-12">
		
			<?php echo $this->Session->flash(); ?>
			
			<?php	echo $this->Form->create('Company', array(
							'type' => 'file',
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
								'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
								'div' => array('class' => 'form-group'),
								'class' => 'form-control',
								'before' => '',
								'between' => '<div class="col-md-11 ">',
								'after' => '</div></div>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;'))
							),
							'action' => 'companyContact',
			)); ?>		
		<div class="col-md-12">
			<fieldset>
				<div style="background-color: #084283; margin-bottom: 15px;  width: 370px; max-width: 370px; " class="col-md-5 ">
				<div style="text-align: left; margin-bottom: 5px;" >
				<p style="margin-left: 50px; font-size: 15px;">Datos de la Empresa o Institución</p>
				</div>
					<?php echo $this->Form->input('CompanyProfile.id'); ?>
					<?php echo $this->Form->input('CompanyProfile.rfc', array(					
								'label' =>'',
								'readonly' => 'readonly',
								'before' => '<div class="col-md-12 " style="margin-top: 50px;">',
								'placeholder' => 'RFC',
								'onblur' => 'sendRfc()'
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.social_reason', array(		
									'before' => '<div class="col-md-12">',		
									'label' => '',
									'placeholder' => 'Razón social'
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.company_name', array(
									'label' => '',
									'before' => '<div class="col-md-12">',	
									'placeholder' => 'Nombre comercial'
					)); ?>
					<?php 	echo $this->Form->input('CompanyProfile.company_type', array(				
									'type'=>'select',
									'before' => '<div class="col-md-12 " >',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'label' => '',
									'placeholder' => 'Tipo',
									'options' => $tipoEmpresas,'default'=>'0', 'empty' => 'Tipo',								
					)); ?>
					<?php 	echo $this->Form->input('CompanyProfile.sector', array(		
									'type' => 'select',
									'before' => '<div class="col-md-12 " >',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'label' => '',
									'placeholder' => 'Sector',	
									'options' => $Sectores,'default'=>'0', 'empty' => 'Sector',
					)); ?>
					<?php 	echo $this->Form->input('CompanyProfile.company_rotation', array(		
									'type' => 'select',
									'before' => '<div class="col-md-12 " >',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-live-search' => "true",
									'label' => '',
									'placeholder' => 'Giro',	
									'options' => $Giros,'default'=>'0', 'empty' => 'Giro',
					)); ?>
					<?php 	echo $this->Form->input('CompanyProfile.employees_number', array(		
									'type' => 'select',
									'before' => '<!--div class="col-md-12">',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'label' => '',
									'placeholder' => 'Número de empleados',	
									'options' => $numeroEmpleados,'default'=>'0', 'empty' => 'Número de empleados',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.web_site', array(
									'type' => 'text',
									'before' => '<div class="col-md-12 " >',
									'label' => '',
									'placeholder' => 'Sitio web',
									'onblur' => 'addhttp()'
					)); ?>
				
					<div style="margin-top: 42px;">
					   <p style="margin-left: 20px; margin-bottom: 0px; font-size: 14px;"> Domicilio Fiscal</p>  <!-- img data-toggle="tooltip" id="" data-placement="right" title="Dirección donde se encuentra ubicada la empresa, institución, de acuerdo con el Registro Federal de Contribuyentes (RFC)." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 10px;"> Panama -->
					</div>
					
					<?php echo $this->Form->input('CompanyProfile.street', array(	
									'style' =>'margin-top: 5px;',
									'label' => '',
									'before' => '<div class="col-md-12 " >',
									'placeholder' => 'Calle y Número',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.state', array(	
									'id' => 'estado',
									'type' => 'select',
									'before' => '<div class="col-md-12 " >',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-live-search' => "true",
									'label' => '',
									'placeholder' => 'Entidad Federativa / Estado',
									'options' => $Estados,'default'=>'0', 'empty' => 'Estado / Entidad Federativa',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.city', array(	
									'id' => 'ciudad',
									'type' => 'select',
									'before' => '<div class="col-md-12 " >',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-live-search' => "true",
									'label' => '',
									'placeholder' => 'Delegación / Municipio',
									'default'=>'0', 'empty' => 'Delegación / Municipio',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.subdivision', array(
									'before' => '<div class="col-md-12 " >',			
									'label' => '',
									'placeholder' => 'Población / Colonia',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.zip', array(	
									'before' => '<div class="col-md-12 " >',	
									'label' => '',
									'placeholder' => 'Código postal',
					)); ?>
					
					<div id="copy"></div>
			
				</div>
			
				<div style="background-color: #084283; margin-bottom: 15px; padding: 15px 0 0;  margin-left: 20px; " class="col-md-5 ">
					
					<div style="text-align: left; margin-bottom: 5px;" >
					   <p style="margin-left: 50px; font-size: 15px;"> Domicilio Sede</p>
								<?php 
									echo $this->Html->link('<span class="glyphicon glyphicon-transfer"></span>',		
																						array(
																							// Sin parametros
																							),
																						array(
																							'class' => 'btn btn-default btn-primary ',
																							'onclick' => 'return clonarFormacionAcademica();', 
																							'escape' => false,
																							'style' => 'float: right; margin-right: 44px; margin-top: -6px;',
																							'data-toggle' => 'tooltip',
																							'data-placement'=> 'right',
																							'title'=>'Copiar Domicilio Fiscal a Domicilio Sede en caso de ser los mismos',
																							)
														); 	
								?> 
							</p>
					</div>
					
					<?php echo $this->Form->input('CompanyProfile.street_sede', array(					
									'label' => '',
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'placeholder' => 'Calle y Número',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.state_sede', array(
									'id' => 'estado2',
									'type' => 'select',
									'label' => '',
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-live-search' => "true",
									'placeholder' => 'Entidad Federativa / Estado',
									'default'=>'0', 'empty' => 'Entidad Federativa / Estado',
									'options' => $Estados,'default'=>'0', 'empty' => 'Estado / Entidad Federativa',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.city_sede', array(
									'id' => 'ciudad2',
									'type' => 'select',
									'label' => '',
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-live-search' => "true",
									'placeholder' => 'Delegación / Municipio',
									'default'=>'0', 'empty' => 'Delegación / Municipio',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.subdivision_sede', array(					
									'label' => '',
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'placeholder' => 'Población / Colonia',
					)); ?>
					<?php echo $this->Form->input('CompanyProfile.zip_sede', array(					
									'label' => '',
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'placeholder' => 'Código postal',
					)); ?>
					
					<div style="text-align: left;" >
					   <p style="margin-left: 50px;"> Breve descripción de la empresa</p>
					</div>
					
					<?php echo $this->Form->input('CompanyProfile.company_description', array(
									'before' => '<div class="col-md-12 " style="left: 30px; padding-left: 0px; padding-right: 40px;"> ',
									'between' => '<div class="col-md-10 col-md-offset-1" style="padding-left: 0px;">',
									'style' => ' resize: none; height: 120px;',
									'label' => '',
									'placeholder' => 'Breve descripción de la empresa',
					)); ?>
					
					<?php echo $this->Form->input('Company.id'); ?>
				
					<div style="text-align: left;" >
					   <p style="margin-left: 50px;">Acceso</p>
					</div>
					
					<?php echo $this->Form->input('Company.username', array(
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'readonly' => 'true',
									'label' => '',
									'placeholder' => 'Usuario creado automáticamente (RFC)',
					)); ?>
					
				</div>
			</div>	

				<div style="background-color: #084283; margin-bottom: 15px; padding: 15px 0 0;  margin-left: 15px;  width: 370px; max-width: 370px; " class="col-md-5 ">
					<div style="text-align: left; " >
					   <p style="margin-left: 50px;"> Datos de contacto</p>
					</div>
					
					<?php echo $this->Form->input('CompanyContact.id'); ?>
					<?php echo $this->Form->input('CompanyContact.name', array(	
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'label' => '',
									'placeholder' => 'Nombre',					
					)); ?>
					
					<div class="col-md-6"  style="left: 5px;">
					<?php echo $this->Form->input('CompanyContact.last_name', array(
									'before' => '<div class="col-md-12 col-md-offset-1" style="left: -2px;">',
									'between' => '<div class="col-md-12 ">',
									'label' => '',
									'placeholder' => 'Apellido paterno',					
					)); ?>
					</div>
					
					<div class="col-md-6" style="padding-left: 0px;">
					<?php echo $this->Form->input('CompanyContact.second_last_name', array(	
									'before' => '<div class="col-md-12 col-md-offset-0">',
									'between' => '<div class="col-md-11"  style="padding-left: 0px;">',
									'label' => '',
									'placeholder' => 'Apellido materno',					
					)); ?>
					</div>

					<?php echo $this->Form->input('CompanyContact.job_title', array(				
									'label' => '',
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'placeholder' => 'Cargo',					
					)); ?>
					<?php echo $this->Form->input('CompanyContact.schedule_atention', array(				
									'label' => '',
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'placeholder' => 'Horario de atención',					
					)); ?>
					<?php echo $this->Form->input('Company.email', array(
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'label' => '',
									'placeholder' => 'Correo institucional',
									'onchange' => 'emptyConfirm()',									
					)); ?>
					<?php echo $this->Form->input('Company.email_confirm', array(				
									'label' => '',
									'before' => '<div class="col-md-11 col-md-offset-1">',
									'placeholder' => 'Confirmar correo institucional',					
					)); ?>
					<div class="col-md-3 col-md-offset-1"  style="padding-left: 0px; padding-right: 0px;">
					<?php echo $this->Form->input('CompanyContact.long_distance_cod', array(				
									'label' => '',
									'before' => '<div class="col-md-12 ">',
									'placeholder' => 'Lada',					
					)); ?>
					</div>
					<div class="col-md-5"  style="padding-left: 0px; padding-right: 0px; left: -25px;">
					<?php echo $this->Form->input('CompanyContact.telephone_number', array(				
									'label' => '',
									'before' => '<div class="col-md-12 " style="padding-right: 0px;">',
									'between' => '<div class="col-md-10"  style="padding-right: 0px; padding-left: 7px;">',
									'placeholder' => 'Teléfono de contacto',					
					)); ?>
					</div>
					<div class="col-md-3"  style="padding-left: 0px; padding-right: 0px;  left: -35px;">
					<?php echo $this->Form->input('CompanyContact.phone_extension', array(				
									'label' => '',
									'before' => '<div class="col-md-12 " style="padding-left: 0px;">',
									'between' => '<div class="col-md-11"  style="padding-right: 0px;">',
									'placeholder' => 'Extensión',					
					)); ?>
					</div>
					<div class="col-md-4 col-md-offset-1" style=" left: -15px;">
					<?php echo $this->Form->input('CompanyContact.long_distance_cod_cell_phone', array(				
									'label' => '',
									'before' => '<div class="col-md-12 ">',
									'between' => '<div class="col-md-11">',
									'placeholder' => 'Lada',					
					)); ?>
					</div>
					<div class="col-md-7">
					<?php echo $this->Form->input('CompanyContact.cell_phone', array(				
									'label' => '',
									'before' => '<div class="col-md-12 " style="padding-left: 0px; padding-right: 0px;">',
									'between' => '<div class="col-md-12" style="left: -47px; padding-left: 0px; padding-right: 0px;">',
									'placeholder' => 'Teléfono celular',
									'style' => 'width: 219px;'
					)); ?>
					</div>
				</div>
		
		</fieldset>
		
			<div class="col-md-4 col-md-offset-4" style="margin-top: 20px;">
				<div class="col-md-2">
					<?php 	echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar',array(
														'type' => 'submit', 
														'div' => 'form-group',
														'escape' => false,
														'class' => 'btn btn-primary btn-default col-md-offset-5',
														'style' => 'width:120px;'
								));
								echo $this->Form->end(); 
					?>
				</div>
			</div>
		</div>
	
	