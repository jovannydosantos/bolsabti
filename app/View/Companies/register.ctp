	<?php	$this->layout = 'register'; ?>
	
	<script>
	$(document).ready(function() {
		
		addhttp();

		var file = document.getElementById("CompanyFilename"); //El input de tipo
		file.addEventListener("change", function(){

			var archivo = document.getElementById('CompanyFilename').value;
			extensiones_permitidas = new Array('.jpg','.png','.gif','.jpeg');

			if (!archivo) {
				$.alert({
					    title: '!Aviso!',
					    theme: 'supervan',
					    content: 'No has seleccionado ningún archivo',
					});
				document.getElementById("CompanyFilename").focus();
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
					$.alert({
					    title: '!Aviso!',
					    theme: 'supervan',
					    content: 'Comprueba la extensión de su archivo a subir. Sólo se pueden subir archivos con extensiones: ' + extensiones_permitidas.join(),
					});
					document.getElementById('CompanyFile').scrollIntoView();
					document.getElementById("CompanyFilename").focus();
					document.getElementById('CompanyFilename').value = ''; 
					$("#CompanyFilename").fileinput('refresh', {previewClass: 'bg-info'});
					return false;
				}else{
					return true;
				}
			}
			
		}, false);

		// Verifica el tipo de cedula no sobrepase el tamaño
		var file = document.getElementById("CompanyFile"); //El input de tipo
		file.addEventListener("change", function(){
			
			var archivo = document.getElementById('CompanyFile').value;
			extensiones_permitidas = new Array('.jpg', '.png', '.gif','.jpeg','.pdf');

			if (!archivo) {
				alert ('Adjuntar Cédula de Identificación Fiscal');
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
					$.alert({
					    title: '!Aviso!',
					    theme: 'supervan',
					    content: 'Compruebe la extensión de su archivo de RFC a subir. Sólo se pueden subir archivos con extensiones: ' + extensiones_permitidas.join(),
					});
					
					document.getElementById('CompanyFile').scrollIntoView();
					document.getElementById('CompanyFile').value = '';  
					document.getElementById('CompanyType').value = '';
					$("#CompanyFile").fileinput('refresh', {previewClass: 'bg-info'});
					return false;
				}
			}
		}, false);
			
		// Limpia los campos para volver a ingresar la cédula y logo
		document.getElementById('CompanyFile').value = '';  
		document.getElementById('CompanyType').value = '';
		$("#CompanyFile").fileinput('refresh', {previewClass: 'bg-info'});

		document.getElementById('CompanyFilename').value = '';  
		document.getElementById('CompanyFilename').value = '';
		$("#CompanyFilename").fileinput('refresh', {previewClass: 'bg-info'});
			
	});	

</script>

	<div class="col-md-12">
		
		<?= $this->Form->create('Company',[
			'type' => 'file',
			'class' => 'form-horizontal', 
			'role' => 'form',
			'inputDefaults' => [
				'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
				'div' => ['class' => 'form-group'],
				'class' => 'form-control',
				'before' => '<div class="col-md-12">',
				'label' => '',
				'between' => '<div class="col-md-11">',
				'after' => '</div></div>',
				'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;']]
				],
			'onsubmit' =>'return condiciones();',
			'action' => 'register',
			]); ?>		

		<fieldset style="margin-top: 30px;">

			<div style="margin-bottom: 15px; padding: 15px 0 0; padding-top: 15px; padding-bottom: 15px;" class="col-md-3 col-md-offset-1 fondoBti">
				<div class="col-md-12 whiteText">
					<p style="margin-bottom: 0px; font-weight: bold;">Datos de la Empresa o Institución</p>
				</div>
				
				<?= $this->Form->input('CompanyProfile.rfc',['placeholder'=> 'RFC','onblur' => 'sendRfc()','before' => '<div class="col-md-12 " style="margin-top: 15px;"><img data-toggle="tooltip" data-placement="right" title="Registro Federal de Contribuyentes (RFC), es una clave alfanumérica que expide el Servicio de Administración Tributaria (SAT) a las empresas o instituciones legalmente constituidas en México. Se activará su registro únicamente como persona física con actividad empresarial o como persona moral." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">']); ?>
				<?= $this->Form->input('CompanyProfile.social_reason',['placeholder'=> 'Razón social','before' => '<div class="col-md-12"><img data-toggle="tooltip" data-placement="right" title="Es el nombre oficial y legal de la empresa de acuerdo con su documentación oficial y a su Registro Federal de Contribuyentes (RFC)." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">']); ?>
				<?= $this->Form->input('CompanyProfile.company_name',['placeholder'=> 'Nombre comercial','before' => '<div class="col-md-12"><img data-toggle="tooltip" data-placement="right" title="Nombre que identifica a una empresa o institución y la distingue entre las empresas que desarrollan actividades similares." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">']); ?>
				<?= $this->Form->input('CompanyProfile.company_type',['options' => $tipoEmpresas, 'default'=>'0', 'empty' => 'Tipo','class'=>'form-control selectpicker show-tick show-menu-arrow']); ?>
				<?= $this->Form->input('CompanyProfile.sector',['options' => $Sectores, 'default'=>'0', 'empty' => 'Sector','class'=>'form-control selectpicker show-tick show-menu-arrow']); ?>
				<?= $this->Form->input('CompanyProfile.company_rotation',['options' => $Giros, 'default'=>'0', 'empty' => 'Giro','class'=>'form-control selectpicker show-tick show-menu-arrow']); ?>
				<?= $this->Form->input('CompanyProfile.employees_number',['options' => $numeroEmpleados, 'default'=>'0', 'empty' => 'Número de empleados','class'=>'form-control selectpicker show-tick show-menu-arrow']); ?>
				<?= $this->Form->input('CompanyProfile.web_site',['type' => 'text','placeholder'=> 'Sitio web','onblur' => 'addhttp()']); ?>

				<div class="col-md-12 whiteText" style="margin-top: 35px;" >
					<p style="font-weight: bold;"> Domicilio Fiscal<img data-toggle="tooltip" id="" data-placement="right" title="Dirección donde se encuentra ubicada la empresa, institución, de acuerdo con el Registro Federal de Contribuyentes (RFC)." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 10px;"></p>
				</div>

				<?= $this->Form->input('CompanyProfile.street',['placeholder'=> 'Calle y Número','before' => '<div class="col-md-12 " style="margin-top: 15px;">']); ?>
				<?= $this->Form->input('CompanyProfile.state',['options' => $Estados, 'default'=>'0','id' => 'estado','empty' => 'Estado / Entidad Federativa','class'=>'form-control selectpicker show-tick show-menu-arrow']); ?>
				<?= $this->Form->input('CompanyProfile.city',['type' => 'select', 'id' => 'ciudad','default'=>'0','empty' => 'Delegación / Municipio','class'=>'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true']); ?>
				<?= $this->Form->input('CompanyProfile.subdivision',['placeholder'=> 'Población / Colonia','before' => '<div class="col-md-12 ">']); ?>
				<?= $this->Form->input('CompanyProfile.zip',['type'=>'number','placeholder'=> 'Código postal','before' => '<div class="col-md-12 ">']); ?>

				<div id="copy"></div>
			</div>

			<div style="margin-bottom: 15px; padding: 15px 0 0; margin-left: 5px; margin-right: 5px; padding-top: 15px; padding-bottom: 15px;" class="col-md-4 fondoBti">

				<div class="col-md-11 whiteText">
					<p style="font-weight: bold;">Domicilio Sede<img data-toggle="tooltip" id="" data-placement="right" title="Dirección donde se encuentra ubicada la empresa, institución o alguna de sus sucursales, donde puede ser localizado el responsable de registro." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 10px;">
						<button type="button" data-toggle='tooltip' data-placement="bottom" onclick='return clonarDireccion();' title='Copiar Domicilio Fiscal a Domicilio Sede en caso de ser los mismos' style="float: right;  margin-top: -11px;" class="btn btn-default"><span class="glyphicon glyphicon-transfer"></span></button>
					</p>
				</div>
				<?= $this->Form->input('CompanyProfile.street_sede',['placeholder'=> 'Calle y Número']); ?>
				<?= $this->Form->input('CompanyProfile.state_sede',['options' => $Estados, 'default'=>'0','id' => 'estado2','empty' => 'Estado / Entidad Federativa','class'=>'form-control selectpicker show-tick show-menu-arrow']); ?>
				<?= $this->Form->input('CompanyProfile.city_sede',['type' => 'select', 'id' => 'ciudad2','default'=>'0','empty' => 'Delegación / Municipio','class'=>'form-control selectpicker show-tick show-menu-arrow','data-live-search' => 'true']); ?>
				<?= $this->Form->input('CompanyProfile.subdivision_sede',['placeholder'=> 'Población / Colonia','before' => '<div class="col-md-12">']); ?>
				<?= $this->Form->input('CompanyProfile.zip_sede',['type'=>'number','placeholder'=> 'Código postal','before' => '<div class="col-md-12 ">']); ?>

				<div class="col-md-12 whiteText" >
					<p> Breve descripción de la empresa</p>
				</div>
					
				<?= $this->Form->input('CompanyProfile.company_description',['placeholder'=> 'Breve descripción de la empresa','before' => '<div class="col-md-12 "><img data-toggle="tooltip" id="" data-placement="right" title="Información y características que permitan al candidato conocer aspectos de interés y atractivos de la empresa o institución." class="img-circle cambia" alt="help.png" src="/unam/img/help.png"">','style' => 'resize: none; height: 120px;']); ?>

				<div class="col-md-12 whiteText" >
					<p> Adjuntar RFC de la empresa</p>
				</div>

				<?= $this->Form->input('Company.file',['type' => 'file','class'=>'file',]); ?>
				<?= $this->Form->input('Company.type',['type' => 'hidden']); ?>

				<div class="col-md-12 whiteText" >
					<p> Adjuntar logotipo de la empresa</p>
				</div>
					
				<?= $this->Form->input('Company.filename',['type' => 'file','class'=>'file',]); ?>
				<?= $this->Form->input('Company.dir',['type' => 'hidden']); ?>
				<?= $this->Form->input('Company.mimetype',['type' => 'hidden']); ?>
				<?= $this->Form->input('Company.filesize',['type' => 'hidden']); ?>

				<div class="col-md-12 whiteText">
					<p style="font-weight: bold;">Acceso</p>
				</div>

				<?= $this->Form->input('Company.username',['placeholder'=> 'Usuario creado automáticamente (RFC)','before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="right" title="El RFC de la empresa o institución se asignará como usuario para ingresar al portal." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">','readonly' => 'true']); ?>
				<?= $this->Form->input('Company.password',['type'=>'password','placeholder'=> 'Contraseña alfanumérica (letras y números)']); ?>
				<?= $this->Form->input('Company.password_confirm',['type'=>'password','placeholder'=> 'Confirma contraseña alfanumérica (letras y números)','before' => '<div class="col-md-12"><img data-toggle="tooltip" id=""  data-placement="right" title="Clave de 6 caracteres mínimo y 10 caracteres máximo, la cual debe contener caracteres alfanuméricos, letras y números. " class="img-circle cambia" alt="help.png" src="/unam/img/help.png">']); ?>
			</div>

			<div style="margin-bottom: 15px; padding: 15px 0 0; padding-top: 15px; padding-bottom: 15px;" class="col-md-3 fondoBti">
				<div class="col-md-12 whiteText">
					<p style="font-weight: bold;" > Datos de contacto</p>
				</div>

				<?= $this->Form->input('CompanyContact.name',['placeholder'=> 'Nombre']); ?>
				<?= $this->Form->input('CompanyContact.last_name',['placeholder'=> 'Apellido paterno']); ?>
				<?= $this->Form->input('CompanyContact.second_last_name',['placeholder'=> 'Apellido materno']); ?>
				<?= $this->Form->input('CompanyContact.job_title',['placeholder'=> 'Cargo']); ?>
				<?= $this->Form->input('CompanyContact.schedule_atention',['placeholder'=> 'Horario de atención']); ?>
				<?= $this->Form->input('Company.email',['type'=>'email','placeholder'=> 'Correo institucional','before' => '<div class="col-md-12"><img data-toggle="tooltip" id="" data-placement="left" title="Dirección electrónica otorgada por la empresa o institución al responsable de registro." class="img-circle cambia" alt="help.png" src="/unam/img/help.png">']); ?>
				<?= $this->Form->input('Company.email_confirm',['type'=>'email','placeholder'=> 'Confirmar correo institucional']); ?>
				<?= $this->Form->input('CompanyContact.long_distance_cod',['placeholder'=> 'Lada']); ?>
				<?= $this->Form->input('CompanyContact.telephone_number',['placeholder'=> 'Teléfono de contacto']); ?>
				<?= $this->Form->input('CompanyContact.phone_extension',['placeholder'=> 'Extensión']); ?>
				<?= $this->Form->input('CompanyContact.long_distance_cod_cell_phone',['placeholder'=> 'Lada']); ?>
				<?= $this->Form->input('CompanyContact.cell_phone',['placeholder'=> 'Teléfono celular']); ?>
			

			<div class="col-md-10 col-md-offset-1 fondoBti" style="margin-top: 30px;">
				<div class="form-group required">
					<p><span style="color:red">*</span> &nbsp;<input type="checkbox" id="terminos" name="terminos" value="1" <?php echo ((isset($this->request->data['terminos'])) and ($this->request->data['terminos'] == 1)) ? 'checked='.$this->request->data['terminos']   : ''; ?> >&nbsp; Acepto términos y condiciones de la universidad y del administrador del portal</p>
					<p class="whiteText"><a href="#" data-toggle="modal" data-target="#aviso" style=" text-decoration: underline;">Leer Aviso de Privacidad</a></p>
				</div>
			</div>
			</div>
		</fieldset>
		
		<div class="col-md-2 col-md-offset-4 whiteText" style="margin-bottom: 30px;">
			<?=  $this->Html->link("Volver", array('controller' => 'students','action'=> 'logout'), array( 'class' => 'btn col-md-12' )) ?>
		</div>

		<div class="col-md-2  whiteText" style="margin-bottom: 30px;">
			<?= $this->Form->submit('Registrar', ['class' => 'btn col-md-12']); ?>
		</div>

</div>

<?= $this->element('scriptRegistroCompany'); ?>

<style type="text/css">
	.required label:after {
		content:"*";
		display: block;
		display:inline;
		position: absolute;
		top: -7px;
		left: 23px;
		color:red;
	}
</style>