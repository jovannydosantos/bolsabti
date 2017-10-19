<?php 
	$this->layout = 'administrator'; 
?>
	<script type="text/javascript">
		
		$(document).ready(function() {
		
			<?php if(($this->request->data['AdministratorProfile']['start_date_expiration']<>'') and (($this->request->data['AdministratorProfile']['start_date_expiration'] <> '0000-00-00') && ($this->request->data['AdministratorProfile']['start_date_expiration'] <> null) )): ?>
				 $('#AdministratorProfileStartDateExpirationYear').prepend('<option value="">AAAA</option>');
				 $('#AdministratorProfileStartDateExpirationMonth').prepend('<option value="">MM</option>');
				 $('#AdministratorProfileStartDateExpirationDay').prepend('<option value="">DD</option>');
				 
				 $('#AdministratorProfileEndDateExpirationYear').prepend('<option value="">AAAA</option>');
				 $('#AdministratorProfileEndDateExpirationMonth').prepend('<option value="">MM</option>');
				 $('#AdministratorProfileEndDateExpirationDay').prepend('<option value="">DD</option>');
			 <?php else: ?>
				 $('#AdministratorProfileStartDateExpirationYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorProfileStartDateExpirationMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorProfileStartDateExpirationDay').prepend('<option value="" selected>DD</option>');
				 
				 $('#AdministratorProfileEndDateExpirationYear').prepend('<option value="" selected>AAAA</option>');
				 $('#AdministratorProfileEndDateExpirationMonth').prepend('<option value="" selected>MM</option>');
				 $('#AdministratorProfileEndDateExpirationDay').prepend('<option value="" selected>DD</option>');
			 <?php endif; ?>
			 
			setDates();
			$('#AdministratorEmailConfirm').val($('#AdministratorEmail').val());

			//Marca los aceesos que tiene el administador
			<?php if(isset($this->request->data['AdministratorProfile']) and (!empty($this->request->data['AdministratorProfile'])) and ($this->request->data['AdministratorProfile']['access']<>'')) { ?>
				var stringAccesos = "<?php echo $this->request->data['AdministratorProfile']['access']; ?>";
				var arrayAccesos = stringAccesos.split(',');
				var arrayAccessoAdmin = new Array();
				var indexArray = 0;
				
				arrayAccesos.forEach(function(valor) {
					arrayAccessoAdmin[indexArray] = valor;
					indexArray++;
				});
				
				$("#AdministratorProfileAccess option").each(function () {
					for( c = 0; c < indexArray; c++ ){
						if($(this).val() == arrayAccessoAdmin[c]){
							$('#AdministratorProfileAccess option[value='+$(this).val()+']').attr('selected','selected');
						}
					}
				});
					
			<?php } ?>		
							
			// Obtener las Escuelas/Facultades dependiendo del nivel AUTOMÁTICA
			if($("#AdministratorProfileAcademicLevelId").val() != 0) {
				$('#loading').show();
				$.get('http://localhost/bolsabti/app/webroot/php/derpEsc.php',{level: $('#AdministratorProfileAcademicLevelId').find(":selected").index() },function(JSON){
					$('#AdministratorProfileInstitution').empty();
					$('#AdministratorProfileInstitution').append('<option value="">Entidad</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){	
						if(val.id == '<?php echo (isset($this->request->data['AdministratorProfile']['institution']) and ($this->request->data['AdministratorProfile']['institution'] <> '')) ? $this->request->data['AdministratorProfile']['institution']: ''; ?>'){
							$('#AdministratorProfileInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
						}else{
							$('#AdministratorProfileInstitution').append('<option value="' + val.id + '" >' + val.escuela + '</option>');
						}

						if (--waitCount == 0) {
							$('#loading').hide();
							$('.selectpicker').selectpicker('refresh');
						}
					});
					
					});
				} else {
					$('#AdministratorProfileInstitution').empty();
					$('#AdministratorProfileInstitution').append('<option value="">Entidad</option>');
					$('.selectpicker').selectpicker('refresh');
				}
				
				// Obtener las Escuelas/Facultades dependiendo del nivel
				$("#AdministratorProfileAcademicLevelId").on('change',function (){
					if($("#AdministratorProfileAcademicLevelId").val() != 0){
						$('#loading').show();
						$.get('http://localhost/bolsabti/app/webroot/php/derpEsc.php',{level: $('#AdministratorProfileAcademicLevelId').find(":selected").index() },function(JSON){
							$('#AdministratorProfileInstitution').empty();
							$('#AdministratorProfileInstitution').append('<option value="">Entidad</option>');
							
							var waitCount = 0;
							$.each(JSON, function(key, val){
								waitCount++;
							});
							
							$.each(JSON, function(key, val){
								$('#AdministratorProfileInstitution').append('<option value="' + val.id + '">' + val.escuela + '</option>');
									
								if (--waitCount == 0) {
									$('#loading').hide();
									$('.selectpicker').selectpicker('refresh');
								}
							});
							
						});
					} else {
						$('#AdministratorProfileInstitution').empty();
						$('#AdministratorProfileInstitution').append('<option value="">Entidad</option>');
						$('.selectpicker').selectpicker('refresh');
					}
				});

		$('.selectpicker').selectpicker('refresh');	
	});	
		
	function setDates(){
		if ($('#AdministratorProfileUnlimited').val()=='1') {
			document.getElementById('AdministratorProfileStartDateExpirationYear').options[0].selected = 'selected';
			document.getElementById('AdministratorProfileStartDateExpirationMonth').options[0].selected = 'selected';
			document.getElementById('AdministratorProfileStartDateExpirationDay').options[0].selected = 'selected';
			
			document.getElementById('AdministratorProfileEndDateExpirationYear').options[0].selected = 'selected';
			document.getElementById('AdministratorProfileEndDateExpirationMonth').options[0].selected = 'selected';
			document.getElementById('AdministratorProfileEndDateExpirationDay').options[0].selected = 'selected';
			$('.selectpicker').selectpicker('refresh');
		}
	}
		
	function validarFecha(fecha){
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
	
	function validateDates(){
		var tiempoIlimitado = 0;
		if ($('#AdministratorProfileUnlimited').val()==1) {
			tiempoIlimitado = 1;
			setDates();
		}
		
		var fecha1 = document.getElementById('AdministratorProfileStartDateExpirationDay').value	+ "/" +
					document.getElementById('AdministratorProfileStartDateExpirationMonth').value	+ "/" +
					document.getElementById('AdministratorProfileStartDateExpirationYear').value;
		
		var fecha2 = document.getElementById('AdministratorProfileEndDateExpirationDay').value	+ "/" +
					document.getElementById('AdministratorProfileEndDateExpirationMonth').value	+ "/" +
					document.getElementById('AdministratorProfileEndDateExpirationYear').value;
					
		vigenciaFecha1 = validarFecha(fecha1);
		vigenciaFecha2 = validarFecha(fecha2);
	
		if(tiempoIlimitado == 0){
			var year1  = $( "#AdministratorProfileStartDateExpirationYear" ).val();
			var month1 = $( "#AdministratorProfileStartDateExpirationMonth" ).val();
			var day1   = $( "#AdministratorProfileStartDateExpirationDay" ).val();
			
			var year2  = $( "#AdministratorProfileEndDateExpirationYear" ).val();
			var month2 = $( "#AdministratorProfileEndDateExpirationMonth" ).val();
			var day2   = $( "#AdministratorProfileEndDateExpirationDay" ).val();
			
			if((year1 == '') || (month1 == '') || (day1 == '') || (year2 == '') || (month2 == '') || (day2 == '')){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione las fechas completas para la vigencia de acceso o en su defecto seleccione "Periodo ilimitado de tiempo" '});
				return false;
			} else if(vigenciaFecha1 == false){
				$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha inicio de la vigencia es incorrecta'});
				return false;
			} else if(vigenciaFecha2 == false){
				$.alert({ title: '!Aviso!',type: 'red',content: 'La fecha fin de la vigencia es incorrecta'});
				return false;
			} else {
				return true;
			}
		}
	}
		
	function emptyConfirm(){
		document.getElementById("AdministratorEmailConfirm").value = '';
	}
	
	<?php 
		$permiso = explode(",", $administrator['AdministratorProfile']['access']);
		foreach($permiso as $conPermiso):
	?>
		$('#menuId'+<?php echo $conPermiso; ?>).show();
	<?php 
		endforeach;	
	?>
	
	function avisoAdmin(){
		$.alert({ title: '!Aviso!',type: 'red',content: 'Sin permisos para modificar al administrador principal'});
		return false;
	}

	</script>

	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD">Editando administrador...</p>
    </blockquote>

    <div class="col-md-12" >

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
											'action' => 'editAdministratorProfile',
											'onsubmit' =>'return validateDates();']); ?>

		<fieldset>
		<div class="col-md-4 col-md-offset-1 fondoBti" style="padding-top: 10px">
			<?= $this->Form->input('AdministratorProfile.academic_level_id', ['type'=>'select','options' => $NivelesAcademicos,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Nivel académico']); ?>
			<?= $this->Form->input('AdministratorProfile.institution', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Entidad']); ?>
			
			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff"> Datos del contacto.</p>
		    </blockquote>
			
			<?= $this->Form->input('Administrator.id'); ?>
			<?= $this->Form->input('Administrator.username', ['type' => 'hidden']); ?>
			<?= $this->Form->input('AdministratorProfile.id'); ?>
			<?= $this->Form->input('AdministratorProfile.contact_name', ['placeholder' => 'Nombre']); ?>
			<?= $this->Form->input('AdministratorProfile.contact_last_name', ['placeholder' => 'Apellido paterno']); ?>
			<?= $this->Form->input('AdministratorProfile.contact_second_last_name', ['placeholder' => 'Apellido materno']); ?>
			<?= $this->Form->input('AdministratorProfile.contact_position', ['placeholder' => 'Cargo']); ?>
			<?= $this->Form->input('Administrator.email', ['type'=>'email','placeholder' => 'Correo electrónico institucional','onchange' => 'emptyConfirm()']); ?>
			<?= $this->Form->input('Administrator.email_confirm', ['type'=>'email','placeholder' => 'Confirmar correo electrónico institucional']); ?>
			<?= $this->Form->input('AdministratorProfile.long_distance_cod', ['type'=>'number','placeholder' => 'Lada']); ?>
			<?= $this->Form->input('AdministratorProfile.telephone', ['type'=>'number','placeholder' => 'Teléfono de contacto']); ?>
			<?= $this->Form->input('AdministratorProfile.phone_extension', ['type'=>'number','placeholder' => 'Extensión']); ?>
		</div>
		<div class="col-md-4 col-md-offset-1 fondoBti" style="padding-top: 10px">
			<?= $this->Form->input('AdministratorProfile.long_distance_cod_cell_phone', ['type'=>'number','placeholder' => 'Lada']); ?>
			<?= $this->Form->input('AdministratorProfile.cell_phone', ['type'=>'number','placeholder' => 'Teléfono celula']); ?>

			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff">Modificar datos de acceso.</p>
		    </blockquote>

		    <?php if(($administrator['Administrator']['id'] == 1) and ($this->Session->read('Auth.User.role') == 'subadministrator')): ?>
				<div class="col-md-12">
				<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
			        <p style="color: #000;">Sin privilegios.</p>
			    </blockquote>
			    </div>
		    <?php else: ?>
			    <center>
				    <?= $this->Html->link('Cambiar acceso  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-lock"></i>', 
															['controller'=>'Administrators',
															'action'=>'editPasswordAdministrator', $administratorProfileEditingId['AdministratorProfile']['administrator_id']],
															['class' => 'btn btn-info ',
															'escape' => false]); ?> 
				</center>
			<?php endif; ?>

			<?php if($this->Session->read('Auth.User.role')<>'administrator'): ?>
				<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
			        <p style="color: #000;">El administrador principal posee acceso a todos los módulos con período ilimitado de tiempo y no es posible modificarlos.</p>
			    </blockquote>

				<div style="display: none">
			<?php endif; ?>

			<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff">Módulos permitidos.</p>
		    </blockquote>

			<?php 	
				unset($administratorAccesos[1]); //Se quitan los módulos donde sólo el administrador 'admin' puede acceder
				unset($administratorAccesos[2]);
				unset($administratorAccesos[8]);
			?>
			<?= $this->Form->input('AdministratorProfile.access', ['type'=>'select','options' => $administratorAccesos,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Módulos permitidos','multiple' => 'multiple','data-selected-text-format' => 'count > 2']); ?>
		    
		    <blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
		        <p style="color: #fff">Vigencia del acceso.</p>
		    </blockquote>

		    <div class="asterisk">*</div>
			<label style="font-weight: normal;margin-top: 9px;">Fecha de inicio</label>
			<?= $this->Form->input('AdministratorProfile.start_date_expiration', [
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-width'=> '102px',
									'dateFormat' => 'YMD',
									'separator' => '',
									'minYear' => date('Y') - -2,
									'maxYear' => date('Y') - 0,
									'onchange' => 'setDates();']); ?>
			
			<div class="asterisk">*</div>
			<label style="font-weight: normal;margin-top: 9px;">Fecha de término</label>
			<?= $this->Form->input('AdministratorProfile.end_date_expiration', [
									'class' => 'selectpicker show-tick form-control show-menu-arrow',
									'data-width'=> '102px',
									'dateFormat' => 'YMD',
									'separator' => '',
									'minYear' => date('Y') - -2,
									'maxYear' => date('Y') - 0,
									'onChange' => 'setDates();']); ?>

			<?php $opction = array(1=>'Si',0=>'No'); ?>
			<?= $this->Form->input('AdministratorProfile.unlimited', ['type'=>'select','options' => $opction,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Período ilimitado de tiempo','onChange' => 'setDates();']); ?>
			<?php if($this->Session->read('Auth.User.role')<>'administrator'): ?>
				</div>
			<?php endif; ?>
		</div>
		</fieldset>
	
	</div>	

	<div class="col-md-3 col-md-offset-4 text-center" style="margin-top: 15px;">
		<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>	

