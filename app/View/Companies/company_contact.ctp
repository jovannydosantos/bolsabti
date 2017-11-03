<?php	
	$this->layout = 'company'; 
?>	

	
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
						$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
						$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado2 option:selected").text() },function(JSON)
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
					$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
					$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
					$.get('http://localhost/bolsabti/app/webroot/php/derpMun.php',{edo: $("#estado option:selected").text() },function(JSON)
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
											'action' => 'companyContact']); ?>

		<fieldset>
	
		<div class="col-md-5 col-md-offset-1 fondoBti" style="padding-top: 10px">
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff"> Datos de la Empresa o Institución.</p>
		    </blockquote>
			<?php echo $this->Form->input('CompanyProfile.id'); ?>
			<?= $this->Form->input('CompanyProfile.rfc', ['readonly' => 'readonly','placeholder' => 'RFC','onblur' => 'sendRfc()']); ?>
			<?= $this->Form->input('CompanyProfile.social_reason', ['placeholder' => 'Razón social']); ?>
			<?= $this->Form->input('CompanyProfile.company_name', ['placeholder' => 'Nombre comercial']); ?>
			<?= $this->Form->input('CompanyProfile.company_type', ['type'=>'select','options' => $tipoEmpresas,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','placeholder' => 'Tipo', 'empty' => 'Tipo']); ?>
			<?= $this->Form->input('CompanyProfile.sector', ['type'=>'select','options' => $Sectores,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','placeholder' => 'Sector', 'empty' => 'Sector']); ?>
			<?= $this->Form->input('CompanyProfile.company_rotation', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','placeholder' => 'Giro', 'empty' => 'Giro']); ?>
			<?= $this->Form->input('CompanyProfile.employees_number', ['type'=>'select','options' => $numeroEmpleados,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','placeholder' => 'Número de empleados', 'empty' => 'Número de empleados']); ?>
			<?= $this->Form->input('CompanyProfile.web_site', ['type' => 'text','placeholder' => 'Sitio web','onblur' => 'addhttp()']); ?>
		
				
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff"> Datos del contacto.</p>
		    </blockquote>
			
				<?php echo $this->Form->input('CompanyContact.id'); ?>
				<?= $this->Form->input('CompanyContact.name', ['placeholder' => 'Nombre']); ?>
				<div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">
				<?= $this->Form->input('CompanyContact.last_name', ['placeholder' => 'Apellido paterno']); ?>
				</div>
				<div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">
				<?= $this->Form->input('CompanyContact.second_last_name', ['placeholder' => 'Apellido materno']); ?>
				</div>
				<?= $this->Form->input('CompanyContact.job_title', ['placeholder' => 'Cargo']); ?>
				<?= $this->Form->input('CompanyContact.schedule_atention', ['placeholder' => 'Horario de atención']); ?>
				<?= $this->Form->input('Company.email', ['placeholder' => 'Correo institucional','onchange' => 'emptyConfirm()']); ?>
				<?= $this->Form->input('Company.email_confirm', ['placeholder' => 'Confirmar correo institucional']); ?>
			
				<div class="col-md-3" style="padding-left: 0px; padding-right: 0px;">
				<?= $this->Form->input('CompanyContact.long_distance_cod', ['placeholder' => 'Lada']); ?>
				</div>
				<div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">
				<?= $this->Form->input('CompanyContact.telephone_number', ['placeholder' => 'Teléfono de contacto']); ?>
				</div>
				<div class="col-md-3" style="padding-left: 0px; padding-right: 0px;">
				<?= $this->Form->input('CompanyContact.phone_extension', ['placeholder' => 'Extensión']); ?>
				</div>
				<div class="col-md-3" style="padding-left: 0px; padding-right: 0px;">
				<?= $this->Form->input('CompanyContact.long_distance_cod_cell_phone', ['placeholder' => 'Lada']); ?>
				</div>
				<div class="col-md-9" style="padding-left: 0px; padding-right: 0px;">
				<?= $this->Form->input('CompanyContact.cell_phone', ['placeholder' => 'Teléfono celular']); ?>
				</div>
					
				
				
			
			
		
		</div>
		<div class="col-md-5 col-md-offset-1 fondoBti" style="padding-top: 10px">
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff"> Domicilio Fiscal.</p>
		    </blockquote>
			<?= $this->Form->input('CompanyProfile.street', ['placeholder' => 'Calle y Número']); ?>
			<?= $this->Form->input('CompanyProfile.state', ['id' => 'estado','type'=>'select','data-live-search' => "true",'options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','placeholder' => 'Entidad Federativa / Estado', 'empty' => 'Entidad Federativa / Estado']); ?>
			<?= $this->Form->input('CompanyProfile.city', ['id' => 'ciudad','type'=>'select','data-live-search' => "true",'options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','placeholder' => 'Delegación / Municipio', 'empty' => 'Delegación / Municipio']); ?>
			<?= $this->Form->input('CompanyProfile.subdivision', ['placeholder' => 'Población / Colonia']); ?>
			<?= $this->Form->input('CompanyProfile.zip', ['placeholder' => 'Código postal']); ?>
			
		
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff"> Domicilio Sede.</p>
		    </blockquote>
			<?php echo $this->Html->link('<span class="glyphicon glyphicon-transfer"></span>',		
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
			));?> 
			<?= $this->Form->input('CompanyProfile.street_sede', ['placeholder' => 'Calle y Número']); ?>
			<?= $this->Form->input('CompanyProfile.state_sede', ['id' => 'estado2','type'=>'select','data-live-search' => "true",'options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','placeholder' => 'Entidad Federativa / Estado', 'empty' => 'Entidad Federativa / Estado']); ?>
			<?= $this->Form->input('CompanyProfile.city_sede', ['id' => 'ciudad2','type'=>'select','data-live-search' => "true",'options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','placeholder' => 'Delegación / Municipio', 'empty' => 'Delegación / Municipio']); ?>
			<?= $this->Form->input('CompanyProfile.subdivision_sede', ['placeholder' => 'Población / Colonia']); ?>
			<?= $this->Form->input('CompanyProfile.zip_sede', ['placeholder' => 'Código postal']); ?>
			
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff"> Breve descripción de la empresa.</p>
		    </blockquote>
			
			<?= $this->Form->input('CompanyProfile.company_description', ['placeholder' => 'Breve descripción de la empresa']); ?>
			<?php echo $this->Form->input('Company.id'); ?>
			
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff"> Acceso.</p>
		    </blockquote>
			
			<?= $this->Form->input('Company.username', ['readonly' => 'readonly','placeholder' => 'Usuario creado automáticamente (RFC)']); ?>

		</div>
		

		
		</fieldset>
	</div>	
	<div class="col-md-5 col-md-offset-4 text-center" style="margin-top: 15px;">
		<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>
	
	
	
	