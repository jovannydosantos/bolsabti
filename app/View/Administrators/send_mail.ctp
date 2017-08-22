<?php 
	$this->layout = 'administrator'; 
?>
	<script>
		$(document).ready(function() {
			
			init_contadorTa("StudentMessage","contadorTaComentario2", 500);
			updateContadorTa("StudentMessage","contadorTaComentario2", 500);
			
			
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
		
			<?php
			if($administrator['Administrator']['role'] == 'subadministrator'):
				$cont = 1;
				foreach($AcademicLevels as $AcademicLevel):
					if($cont <> $administrator['AdministratorProfile']['academic_level_id']):
			?>
					$("#AdministratorAcademicLevelId option[value='" + <?php echo $cont; ?> + "']").attr('disabled', 'disabled');
					$("#AdministratorAcademicLevelId option[value='']").attr('disabled', true);
					$('.selectpicker').selectpicker('refresh');
			<?php
					else:
			?>		
						$("#AdministratorAcademicLevelId option[value='" + <?php echo $cont; ?> + "']").attr('selected','selected');
			<?php
					endif;
					$cont++;
				endforeach;

			endif;
			?>
			
			var dejarEscuelas = [
								"1",
								"2",
								"3",
								"4",
								"6",
								"7",
								"8",
								"10",
								"11",
								"12",
								"13",
								"14",
								"15",
								"16",
								"19",
								"90",
								"91",
								"94",
								"95"
								];
								
				var dejarFacultades = [
								"1",
								"2",
								"3",
								"4",
								"6",
								"7",
								"8",
								"9",
								"10",
								"11",
								"12",
								"14",
								"15",
								"16",
								"19",
								"55",
								"61",
								"63",
								"90",
								"91",
								"95",
								"100",
								"200",
								"300",
								"400",
								"500",
								"600",
								"621",
								"700"
								];
								
			// Obtener las Escuelas/Facultades dependiendo del nivel AUTOMÁTICA
			if($("#AdministratorAcademicLevelId").val() != 0)
				{
				$('#loading').show();
				$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpEsc.php',{level: $('#AdministratorAcademicLevelId').find(":selected").index() },function(JSON)
					{
					$('#AdministratorInstitution').empty();
					$('#AdministratorInstitution').append('<option value="">Entidad</option>');
					$('#AdministratorCareer').empty();
					$('#AdministratorCareer').append('<option value="">Carrera / Programa</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
						
							if($('#AdministratorAcademicLevelId').find(":selected").index() == 1){
								for (x=0;x<dejarEscuelas.length;x++){
									
									if(dejarEscuelas[x]==val.id){
										
										if(val.id == '<?php echo (isset($this->request->data['Administrator']['institution']) and ($this->request->data['Administrator']['institution'] <> '')) ? $this->request->data['Administrator']['institution']: ''; ?>'){
											<?php
												if($administrator['Administrator']['role'] == 'subadministrator'):
											?>
													if(val.id == '<?php echo $administrator['AdministratorProfile']['institution']; ?>' ){
														$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
														$("#AdministratorInstitution option[value='']").attr('disabled', true);
													}
											<?php
												else:
											?>
													$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
											<?php
												endif;
											?>
										}else{
											<?php
												if($administrator['Administrator']['role'] == 'subadministrator'):
											?>
													if(val.id == '<?php echo $administrator['AdministratorProfile']['institution']; ?>' ){
														$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
														$("#AdministratorInstitution option[value='']").attr('disabled', true);
													}
											<?php
												else:
											?>
													$('#AdministratorInstitution').append('<option value="' + val.id + '" >' + val.escuela + '</option>');
											<?php
												endif;
											?>
										}
										
									}
									
								}
								
							}else if($('#AdministratorAcademicLevelId').find(":selected").index() > 1){
								for (x=0;x<dejarFacultades.length;x++){
									
									if(dejarFacultades[x]==val.id){
										
										if(val.id == '<?php echo (isset($this->request->data['Administrator']['institution']) and ($this->request->data['Administrator']['institution'] <> '')) ? $this->request->data['Administrator']['institution']: ''; ?>'){
											<?php
												if($administrator['Administrator']['role'] == 'subadministrator'):
											?>
													if(val.id == '<?php echo $administrator['AdministratorProfile']['institution']; ?>' ){
														$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
														$("#AdministratorInstitution option[value='']").attr('disabled', true);
													}
											<?php
												else:
											?>
													$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
											<?php
												endif;
											?>
										}else{
											<?php
												if($administrator['Administrator']['role'] == 'subadministrator'):
											?>
													if(val.id == '<?php echo $administrator['AdministratorProfile']['institution']; ?>' ){
														$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
														$("#AdministratorInstitution option[value='']").attr('disabled', true);
													}
											<?php
												else:
											?>
													$('#AdministratorInstitution').append('<option value="' + val.id + '" >' + val.escuela + '</option>');
											<?php
												endif;
											?>
										}	
										
									}
								}
							}
							
						if (--waitCount == 0) {
							// Carga de carreras/programas al terminar de cargar las escuelas
							if($("#AdministratorInstitution").val() != 0)
							{
							$('#loading').show();
							$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpCarreras.php',{escuela: $('#AdministratorInstitution').val(), level: $('#AdministratorAcademicLevelId').find(":selected").index() },function(JSON)
								{
								$('#AdministratorCareer').empty();
								$('#AdministratorCareer').append('<option value="">Carrera / Programa</option>');
								
								var waitCount2 = 0;
								$.each(JSON, function(key, val){
									waitCount2++;
								});
									
								$.each(JSON, function(key, val){
									if(val.id == '<?php echo $this->Session->read('carreraSeleccionada'); ?>'){
										$('#AdministratorCareer').append('<option value="' + val.id + '" selected>' + val.carrera + '</option>');
									}else{
										$('#AdministratorCareer').append('<option value="' + val.id + '">' + val.carrera + '</option>');
									}
									if (--waitCount2 == 0) {
										$('#loading').hide();
										$('.selectpicker').selectpicker('refresh');
									}
								});
								});
							}
							else
							{
								$('#AdministratorCareer').empty();
								$('#AdministratorCareer').append('<option value="">Carrera / Programa</option>');
								$('.selectpicker').selectpicker('refresh');
							}
							
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}
					});
					
					});
				}
				else
				{
					$('#AdministratorInstitution').empty();
					$('#AdministratorInstitution').append('<option value="">Entidad</option>');
					$('#AdministratorCareer').empty();
					$('#AdministratorCareer').append('<option value="">Carrera / Programa</option>');
					$('.selectpicker').selectpicker('refresh');
				}
				
			// Obtener las Escuelas/Facultades dependiendo del nivel
			$("#AdministratorAcademicLevelId").on('change',function (){
				if($("#AdministratorAcademicLevelId").val() != 0)
					{
					$('#loading').show();
					$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpEsc.php',{level: $('#AdministratorAcademicLevelId').find(":selected").index() },function(JSON)
						{
						$('#AdministratorInstitution').empty();
						$('#AdministratorInstitution').append('<option value="">Entidad</option>');
						$('#AdministratorCareer').empty();
						$('#AdministratorCareer').append('<option value="">Carrera / Programa</option>');
						
						var waitCount = 0;
						$.each(JSON, function(key, val){
							waitCount++;
						});
						
						$.each(JSON, function(key, val){
					
								if($('#AdministratorAcademicLevelId').find(":selected").index() == 1){
									for (x=0;x<dejarEscuelas.length;x++){
										
										if(dejarEscuelas[x]==val.id){
											
											<?php
												if($administrator['Administrator']['role'] == 'subadministrator'):
											?>
													if(val.id == '<?php echo $administrator['AdministratorProfile']['institution']; ?>' ){
														$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
													}
											<?php
												else:
											?>
													$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
											<?php
												endif;
											?>

										}
									}
									
								}else if($('#AdministratorAcademicLevelId').find(":selected").index() > 1){
									for (x=0;x<dejarFacultades.length;x++){
										
										if(dejarFacultades[x]==val.id){
											
											<?php
												if($administrator['Administrator']['role'] == 'subadministrator'):
											?>
													if(val.id == '<?php echo $administrator['AdministratorProfile']['institution']; ?>' ){
														$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
													}
											<?php
												else:
											?>
													$('#AdministratorInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
											<?php
												endif;
											?>
											
										}
									}
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
						$('#AdministratorInstitution').empty();
						$('#AdministratorInstitution').append('<option value="">Entidad</option>');
						$('#AdministratorCareer').empty();
						$('#AdministratorCareer').append('<option value="">Carrera / Programa</option>');
						$('.selectpicker').selectpicker('refresh');
					}
			});
		
			//Obtenemos las carreras programas dependiendo del la escuela y nivel
			$("#AdministratorInstitution").on('change',function (){
			if($("#AdministratorInstitution").val() != 0)
				{
				$('#loading').show();
				$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpCarreras.php',{escuela: $('#AdministratorInstitution').val(), level: $('#AdministratorAcademicLevelId').find(":selected").index() },function(JSON)
					{
					$('#AdministratorCareer').empty();
					$('#AdministratorCareer').append('<option value="">Carrera / Programa</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
						
					$.each(JSON, function(key, val){
						$('#AdministratorCareer').append('<option value="' + val.id + '">' + val.carrera + '</option>');
						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}
					});
					});
				}
				else
				{
					$('#AdministratorCareer').empty();
					$('#AdministratorCareer').append('<option value="">Carrera / Programa</option>');
					$('.selectpicker').selectpicker('refresh');
				}
			});

			desabilityconfidencial();
			var $mails = $('#AdministratorListaCorreos option');
			$( ".numeroMails" ).empty();
			$( ".numeroMails" ).append( $mails.length);
		}); 
		
		function cambiarContenido(){
				var archivo = document.getElementById('StudentFile').value;
				extensiones_permitidas = new Array(".jpg",".pdf");
				mierror = "";

				if (!archivo) {
						jAlert('No se ha adjuntado ningún archivo', 'Mensaje');
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
							jAlert("Compruebe la extensión de su archivo. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(), 'Mensaje');
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
		
		function desabilityconfidencial(){ 		
			if($("#AdministratorOptionSelect option:selected").index() == 1) {  
				$("#contenedorUniversitariosId").hide();	
				$("#contenedorEmpresasId").show();
			} else if($("#AdministratorOptionSelect option:selected").index() == 2) {  
				$("#contenedorUniversitariosId").show();	
				$("#contenedorEmpresasId").hide();
			}else{
				$("#contenedorUniversitariosId").hide();	
				$("#contenedorEmpresasId").hide();
				}
		}
		
		function negativo(){
			return false;
		}

		function selectAllMail(){
			
			expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var ban = 0;
			var otromail = document.getElementById('AdministratorEmailTo').value;
			var res = otromail.split(";");
			res.forEach(function(entry) {
				if(entry != ''){
					if ( !expr.test(entry) )
					ban = 1;
				}
			});
			
			if(document.getElementById("AdministratorListaCorreos").length == 0){
				jAlert('Sin correos en lista para enviar el email.', 'Mensaje');
				document.getElementById('AdministratorListaCorreos').focus();
				return false;
			}else
			if(ban==1){
				jAlert('Existen correos erroneos en "Agregar otro correo", ingrese correos válidos separados por punto y coma ";".', 'Mensaje');
				document.getElementById('AdministratorEmailTo').focus();
				return false;
			}else
			{
				$('#AdministratorListaCorreos option').prop('selected', true);
				return true;
			}
			return false;
		}
		
		function deleteSelected(){
			$('#AdministratorListaCorreos option:selected').remove();
			
			var $mails = $('#AdministratorListaCorreos option');
			$( ".numeroMails" ).empty();
			$( ".numeroMails" ).append( $mails.length);
			$('.selectpicker').selectpicker('refresh');
			return false;
		}
		
	</script>

	<style type="text/css">
		.upload {
			width: 154px;
			height: 35px;
			background: url("<?php echo $this->webroot; ?>/img/adjuntarboton.png");
			overflow: hidden;
			background-repeat-x: no-repeat;
			background-repeat:no-repeat;
			margin-left: 80px;
			margin-top: -28px;
		}
	</style>
	
	<div class="col-md-12">	
		<div id="loading" class="modal">
			<p><img src="<?php echo $this->webroot; ?>/img/loading.gif"  style="width: 20px; height: 20px;" /> Cargando catálogo...</p>
		</div>
		<?php echo $this->Session->flash(); ?>	
		
		<div class="col-md-10 col-md-offset-1" style="left: -30px;">	
			<div class="col-md-12">	
				<p style="font-size: 18px;">Indique a quien serán enviados los correos:</p>
			</div>
			<div class="col-md-12"  style="padding-left: 0px;">	
			<?php
				echo $this->Form->create('Administrator', array(
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => array(
									'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
									'div' => array('class' => 'form-group'),
									'class' => 'form-control',
									'label' => array('class' => 'col-md-4 control-label '),
									'before' => '<div class="col-md-12 ">',
									'between' => '<div class="col-md-5 " style="padding-right: 30px;">',
									'after' => '</div></div>',
									'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
								),
								'onsubmit' =>'return negativo();',
								'action' => 'register',
								
				)); ?>
				<fieldset>
				<?php  
					$options = array(1 => 'Empresas', 0 => 'Universitarios');
					echo $this->Form->input('Administrator.optionSelect', array(
								'type'=>'select',
								'class' => 'selectpicker show-tick form-control show-menu-arrow',
								'before' => '<div class="col-md-12 ">',
								'label' => '',
								'options' => $options,'default'=>'', 'empty' => 'Selecciona una opción',
								'onChange' => 'desabilityconfidencial()',
								));
			   ?>
			   
			   </fieldset>
				<?php
				echo $this->Form->end(); 
				?>	
			</div>
		</div>
	
		<div class="col-md-11 col-md-offset-1" style="left: -30px; display: none;" id="contenedorUniversitariosId">	
			<div class="col-md-12" >	
				<p style="font-size: 18px; ">Buscar universitarios</p>
			</div>
			
			<div class="col-md-12" style="padding-left: 0px;">
				<?php 
				echo $this->Form->create('Administrator', array(
															'class' => 'form-horizontal', 
															'role' => 'form',
															'inputDefaults' => array(
																	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																	'div' => array('class' => 'form-group '),
																	'class' => 'form-control',
																	'before' => '<div class="col-md-6 ">',
																	'between' => ' <div class="col-md-9">',
																	'after' => '</div></div>',
																	'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
															),
													'action' => 'sendMail',
				)); ?>	
				<fieldset>
				<?php  
					$options = array(1 => 'Activo', 0 => 'Inactivo');
					echo $this->Form->input('Student.status', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'label' => '',
																'options' => $options,'default'=>'', 'empty' => 'Estatus del alumno',
																));
				?>
				<?php  
					echo $this->Form->input('academic_level_id', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'label' => '',
																'selected' => $this->Session->read('academic_level_id'),
																'options' => $AcademicLevels,'default'=>'0', 'empty' => 'Nivel académico',
																));
				?>
				<?php 
					echo $this->Form->input('institution', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-live-search' => "true",
																'selected' => $this->Session->read('escuelaSeleccionada'),
																'label' => '',
																'default'=>'0', 'empty' => 'Escuela / Facultad',
						));
			   ?>
				<?php 
						echo $this->Form->input('career', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-live-search' => "true",
																'selected' => $this->Session->read('carreraSeleccionada'),
																'label' => '',
																'default'=>'0', 'empty' => 'Carrera / Programa',
						));
			   ?>
				</fieldset>
				<div class="col-md-2 col-md-offset-1">
				<?php 
					echo $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
												array(
													'type' => 'submit', 
													'style'=>'width: 115px;',
													'div' => 'form-group',
													'class' => 'btn btnBlue btn-default',
													'escape' => false,
					));
								
					echo $this->Form->end(); 
				?>
				</div>
			</div>	
		</div>
				
		<div class="col-md-11 col-md-offset-1" style="left: -30px; display: none;"  id="contenedorEmpresasId">	
			<div class="col-md-12">	
				<p style="font-size: 18px;">Buscar empresas</p>
			</div>
			
			<div class="col-md-12" style="padding-left: 0px;">
			<?php 
				echo $this->Form->create('Administrator', array(
															'class' => 'form-horizontal', 
															'role' => 'form',
															'inputDefaults' => array(
																	'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
																	'div' => array('class' => 'form-group '),
																	'class' => 'form-control',
																	'before' => '<div class="col-md-6 ">',
																	'between' => ' <div class="col-md-9">',
																	'after' => '</div></div>',
																	'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
															),
													'action' => 'sendMail',
				)); ?>	
				<fieldset>
				<?php  
					$options = array(1 => 'Activa', 0 => 'Inactiva');
					echo $this->Form->input('Company.status', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'label' => '',
																'options' => $options,'default'=>'', 'empty' => 'Estatus de la empresa',
																));
				?>
				<?php  
					echo $this->Form->input('CompanyProfile.company_type_mail', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'label' => '',
																'options' => $tipoEmpresas, 'default'=>'0', 'empty' => 'Tipo',
																));
				?>
				<?php  
					echo $this->Form->input('CompanyProfile.company_rotation_mail', array(
																'type'=>'select',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'label' => '',
																'options' => $Giros,'default'=>'0', 'empty' => 'Giro',
																));
				?>
				<?php  
					echo $this->Form->input('CompanyProfile.state_mail', array(
								'id' => 'estado',
								'type'=>'select',
								'class' => 'form-control selectpicker show-tick show-menu-arrow',
								'data-live-search' => 'true',
								'label' => '',
								'options' => $options,'default'=>'', 'empty' => 'Selecciona una opción',
								'placeholder' => 'Entidad Federativa / Estado',
								'options' => $Estados,'default'=>'0', 'empty' => 'Estado / Entidad Federativa',
								));
			   ?>
			   <?php 	echo $this->Form->input('CompanyProfile.employees_number_mail', array(		
								'type' => 'select',
								'class' => 'form-control selectpicker show-tick show-menu-arrow',
								'label' => '',
								'placeholder' => 'Número de empleados',	
								'options' => $numeroEmpleados,'default'=>'0', 'empty' => 'Número de empleados',
				)); ?>
				</fieldset>
				<div class="col-md-2 col-md-offset-1">
				<?php 
					echo $this->Form->button('Buscar  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>', 
												array(
													'type' => 'submit', 
													'style'=>'width: 115px;',
													'div' => 'form-group',
													'class' => 'btn btnBlue btn-default',
													'escape' => false,
					));
								
					echo $this->Form->end(); 
				?>
				</div>
			</div>
		</div>
		
		<div id="formMailId">
			<?php
				echo $this->Form->create('Administrator', array(
								'type' => 'file',
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => array(
									'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
									'div' => array('class' => 'form-group'),
									'class' => 'form-control',
									'label' => array('class' => 'col-md-3 control-label '),
									'before' => '<div class="col-md-12 ">',
									'between' => '<div class="col-md-8">',
									'after' => '</div></div>',
									'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
								),
								'onsubmit' => 'return selectAllMail();',
								'action' => 'sendMail'
				)); ?>
				

			<div style="background-color: #835B06; margin-bottom: 15px; margin-top: 20px; padding: 25px 0px 0px;" class="col-md-10 col-md-offset-1 col-centered ">
				<fieldset>
				<?php 
					if((isset($studentsSendMail)) and ($studentsSendMail<>'')):
						//
					else:
						$studentsSendMail = array();
					endif;
				?>
					<?php echo $this->Form->input('lista_correos', array(
																	'type'=>'select',
																	'multiple' => 'multiple',
																	'class' => 'selectpicker show-tick form-control show-menu-arrow',
																	'data-live-search' => "true",
																	'title' => 'Para eliminar correos seleccione y de clic en Eliminar seleccionados',
																	'data-selected-text-format' => 'count > 3',
																	'data-actions-box' => 'true',
																	'label' => array(
																				'class' => 'col-md-3 control-label ',
																				'text' => 'Lista de correos:',
																				'style' => 'padding-right: 0px;',
																			),
																	'div' => array('class' => 'form-group', 'style'=> 'margin-bottom: 3px;'),
																	'options' => $studentsSendMail,
																	));
					?>
					<div class="col-md-4 col-md-offset-3" >	
						<p style="font-size: 18px; ">Total de correos: <span style="color: #FFB71F;"  class="numeroMails"> </span></p>
					</div>
					<div class="col-md-4">
						
						<?php 
							echo $this->Html->link('Eliminar seleccionados <span class="glyphicon glyphicon-trash"></span>', 
														array(
															''=>''
															),
														array(
															'class' => 'btn btn-default btnRed ',
															'onclick' => 'return deleteSelected();',
															'style' => 'margin-bottom: 15px; margin-left: 50px; width: 193px;',
															'escape' => false
															)	
						); 	?> 
					</div>
					<?php echo $this->Form->input('emailTo', array(	
															'before' => '<div class="col-md-12 ">',				
															'label' => array(
																			'class' => 'col-md-3 control-label ',
																			'text' => 'Agregar otro correo:',
																			'style' => 'padding-right: 0px;',
																		),
															
															'placeholder' => 'Los correos deberan estar separados por un punto y coma ";"',
					)); ?>
					<?php echo $this->Form->input('Student.title', array(
															'before' => '<div class="col-md-12 ">',
															'style' => 'margin-left: -5px;',				
															'label' => array(
																			'class' => 'col-md-3 control-label ',
																			'text' => 'Título:',
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
																						'class' => 'col-md-5  control-label',
																							'text' => 'máx. 200kb'
																						),
																		'onchange' => 'cambiarContenido()'
																						
												)); ?>
					<div class="col-md-12" >
						<p id="textFile" style="border-top-width: 0px; margin-left: 66px; "></p>
					</div>
					<?php echo $this->Form->input('Student.message', array(	
																'type' => 'textarea',
																'rows' => '5',
																'cols' => '5',
																'before' => '<div class="col-md-12 ">',
																'between' => '<div class="col-md-10">',
																'style' => 'margin-left: -25px; resize: vertical; min-height: 75px;  max-height: 150px; height: 130px;',
																'label' => array(
																				'class' => 'col-xs-11 col-sm-1 col-md-1 control-label ',
																				'text' => '',
																				'style' => 'margin-left: 23px; margin-top: -5px;',
																),
																'placeholder' => 'Mensaje'
					)); ?>
					<div class="col-md-11 form-group row" style="text-align: right; top: -10px; margin-left: 7px; margin-bottom: 0px;padding-right: 22px;">
						<span id="contadorTaComentario2" style="color: white">0/632</span><span style="color: white"> caracteres máx.</span>
						<img data-toggle="tooltip" id="" data-placement="left" title="Mensaje que le será enviado al usuario." class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-top: -4px;">
					</div>
					<?php echo $this->Form->input('Student.sign', array(	
															'before' => '<div class="col-md-6 ">',
															'style' => 'margin-left: -10px;',
															'label' => array(
																			'class' => 'col-xs-11 col-sm-1 col-md-2 control-label ',
																			'text' => 'Firma:',
																			'style' => 'margin-left: 10px;',
																			),
															'placeholder' => 'Firma',
															'between' => '<div class="col-xs-11 col-sm-8 col-md-4 ">',

					));
					?>
					<div class="col-md-1 col-md-offset-5">
						<img data-toggle="tooltip" id="" data-placement="top" title="Texto de identificación que aparecerá en todos los correos que envíe. Ejemplo:
Saludos cordiales.
Juan Perez
Dpto. de servicios escolares
j.perez@mail.com
Tel. 55 1234 5678" 
							class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: -30px; margin-top: -83px;">
					</div>
						<div class="col-md-3 col-md-offset-8">
										<?php echo $this->Form->button('Enviar &nbsp; <i class="glyphicon glyphicon-send"></i>',array(
																'type' => 'submit', 
																'div' => 'form-group',
																'escape' => false,
																'class' => 'btn btnBlue btn-default col-md-9 col-md-offset-3',
																'style' => 'margin-top: 0px; top: -65px;'
													));
										echo $this->Form->end(); 
										?>
						</div>
				</fieldset>
			</div>
		</div>
	</div>