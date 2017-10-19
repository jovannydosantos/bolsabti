<?php 
	$this->layout = 'administrator'; 
?>
<?= $this->element('contadorCaracteres'); ?>
	<script>
		$(document).ready(function() {
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
			
			// Obtener las Escuelas/Facultades dependiendo del nivel AUTOMÁTICA
			if($("#AdministratorAcademicLevelId").val() != 0)
				{
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpEsc.php',{level: $('#AdministratorAcademicLevelId').find(":selected").index() },function(JSON)
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
										
								
							}else if($('#AdministratorAcademicLevelId').find(":selected").index() > 1){

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
							
						if (--waitCount == 0) {
							// Carga de carreras/programas al terminar de cargar las escuelas
							if($("#AdministratorInstitution").val() != 0)
							{
							$('#loading').show();
							$.get('http://localhost/bolsabti/app/webroot/php/derpCarreras.php',{escuela: $('#AdministratorInstitution').val(), level: $('#AdministratorAcademicLevelId').find(":selected").index() },function(JSON)
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
					$.get('http://localhost/bolsabti/app/webroot/php/derpEsc.php',{level: $('#AdministratorAcademicLevelId').find(":selected").index() },function(JSON)
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

									
								}else if($('#AdministratorAcademicLevelId').find(":selected").index() > 1){
											
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
				$.get('http://localhost/bolsabti/app/webroot/php/derpCarreras.php',{escuela: $('#AdministratorInstitution').val(), level: $('#AdministratorAcademicLevelId').find(":selected").index() },function(JSON)
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
	
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Indique a quien serán enviados los correos:</p>
    </blockquote>

	<div class="col-md-12">	
		
		<?= $this->Form->create('Administrator', [
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
									'onsubmit' =>'return negativo();',
									'action' => 'register',]); ?>

			<fieldset>
				<?php $options = array(1 => 'Empresas', 0 => 'Universitarios'); ?>
				<?= $this->Form->input('Administrator.optionSelect', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'', 'empty' => 'Selecciona una opción','onChange' => 'desabilityconfidencial()']); ?>			   
			</fieldset>
				<?= $this->Form->end(); ?>
	</div>
	
	<div class="col-md-12" style="display: none;" id="contenedorUniversitariosId">	
		
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Buscar universitarios</p>
	    </blockquote>

	    <?= $this->Form->create('Administrator', [
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
									'action' => 'sendMail',]); ?>
			<fieldset>
				<?php $options = array(1 => 'Activo', 0 => 'Inactivo'); ?>
				<div class="col-md-3">
				<?= $this->Form->input('Student.status', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Estatus de alumnos']); ?>
				</div>
				<div class="col-md-3">
				<?= $this->Form->input('academic_level_id', ['type'=>'select','selected' => $this->Session->read('academic_level_id'),'options' => $AcademicLevels,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Nivel académico']); ?>
				</div>
				<div class="col-md-3">
				<?= $this->Form->input('institution', ['type'=>'select','selected' => $this->Session->read('escuelaSeleccionada'),'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => "true",'default'=>'0', 'empty' => 'Escuela / Facultad']); ?>
				</div>
				<div class="col-md-3">
				<?= $this->Form->input('career', ['type'=>'select','selected' => $this->Session->read('carreraSeleccionada'),'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => "true",'default'=>'0', 'empty' => 'Carrera / Programa']); ?>
				</div>
			</fieldset>

			<div class="col-md-12 text-center">
				<?= $this->Form->button('Buscar&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
				<?= $this->Form->end(); ?>
			</div>	
	</div>
				
	<div class="col-md-12" style="display: none;"  id="contenedorEmpresasId">	
			
		<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
	        <p style="color: #588BAD">Buscar empresas</p>
	    </blockquote>
		
		<?= $this->Form->create('Administrator', [
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
								'action' => 'sendMail',]); ?>

		<fieldset>
			<?php $options = array(1 => 'Activa', 0 => 'Inactiva'); ?>
			<div class="col-md-3">
			<?= $this->Form->input('Company.status', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Estatus de las empresas']); ?>
			</div>
			<div class="col-md-3">
			<?= $this->Form->input('CompanyProfile.company_type_mail', ['type'=>'select','options' => $tipoEmpresas,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Tipo']); ?>
			</div>
			<div class="col-md-3">
			<?= $this->Form->input('CompanyProfile.company_rotation_mail', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Giro']); ?>
			</div>
			<div class="col-md-3">
			<?= $this->Form->input('CompanyProfile.state_mail', ['type'=>'select','options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0','data-live-search' => 'true','empty' => 'Estado / Entidad Federativa']); ?>
			</div>
			<div class="col-md-3">
			<?= $this->Form->input('CompanyProfile.employees_number_mail', ['type'=>'select','options' => $numeroEmpleados,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Número de empleados']); ?>
			</div>
		</fieldset>
		<div class="col-md-12 text-center">
			<?= $this->Form->button('Buscar&nbsp;&nbsp; <i class="glyphicon glyphicon-search"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
			<?= $this->Form->end(); ?>
		</div>	
	</div>
		
	<div class="col-md-10 col-md-offset-1 fondoBti" id="formMailId" style="margin-top: 20px;">
		
		<?= $this->Form->create('Administrator', [
								'type' => 'file',
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
								'onsubmit' => 'return selectAllMail();',
								'action' => 'sendMail',]); ?>


		<fieldset>
			<?php 
				if((isset($studentsSendMail)) and ($studentsSendMail<>'')):
				else:
					$studentsSendMail = array();
				endif;
			?>

			<div class="col-md-12">
			<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
		        <p style="color: #fff">Total de correos: <span style="color: #FFB71F;"  class="numeroMails"> </span></p>
		    </blockquote>
		    </div>

			<div class="col-md-9">
			<?= $this->Form->input('lista_correos', ['type'=>'select','multiple' => 'multiple','data-actions-box' => 'true','data-selected-text-format' => 'count > 3','data-live-search' => "true",'title' => 'Para eliminar correos seleccione y de clic en Eliminar seleccionados','options' => $studentsSendMail,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0']); ?>
			</div>
			
			<div class="col-md-2">
				<?= $this->Html->link('Eliminar seleccionados <span class="glyphicon glyphicon-trash"></span>', 
												[''=>''],
												['class' => 'btn btn-default btnRed ',
												'onclick' => 'return deleteSelected();',
												'style' => ' margin-top: 7px;',
												'escape' => false]); ?> 
			</div>
			
			<div class="col-md-12">
			<label style="color: #fff">Agregar correo(s):</label>
			<?= $this->Form->input('emailTo', ['placeholder' => 'Los correos deberan estar separados por un punto y coma ";"']); ?>
			</div>
				
			<div class="col-md-12">
			<label style="color: #fff">Título:</label>
			<?= $this->Form->input('Student.title', ['placeholder' => 'Título']); ?>
			</div>

			<div class="col-md-12">
			<label style="color: #fff">Adjuntar archivo .jpg ó .pdf</label>
			<?= $this->Form->input('Student.file', ['type' => 'file','placeholder' => 'Título','onchange' => 'cambiarContenido()','class' =>'file']); ?>
			</div>

			<div class="col-md-12">
			<label style="color: #fff">Mensaje:</label>
			<?= $this->Form->input('Student.message', ['placeholder' => 'Mensaje','type'=>'textarea','class' => 'form-control responsabilidadesClass','style' => 'max-height: 280px;','maxlength' => '632', 'onkeypress'=> 'caracteresCont("StudentMessage", "contadorMensaje",632)']); ?>
			</div>

			<div class="col-md-12" style="float: right;">
				<div style="float: right;"><span id="contadorMensaje" style="color: white">0/632</span><span style="color: white"> caracteres máx.</span></div>
			</div>

			<div class="col-md-6">
			<label style="color: #fff">Firma:</label>
			<?= $this->Form->input('Student.sign', ['placeholder' => 'Firma']); ?>
			</div>

			<?php if(!empty($studentsSendMail)): ?>
			<div class="col-md-12 text-center" style="margin-bottom: 15px">
				<?= $this->Form->button('Enviar &nbsp; <i class="glyphicon glyphicon-send"></i>',['type'=>'submit','class' => 'btn btn-default','escape' => false,'style'=>'float: right']);?>
				<?= $this->Form->end(); ?>
			</div>	
			<?php endif; ?>
			</fieldset>
		</div>
	</div>
</div>