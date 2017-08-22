	<?php 
		$this->layout = 'administrator'; 
	?>
	<script>
		
		$(document).ready(function() {
			$("#AdministratorProfileStartDateExpirationYear").css("width", "65px");
			$("#AdministratorProfileStartDateExpirationMonth").css("width", "90px");
			$("#AdministratorProfileStartDateExpirationDay").css("width", "60px");
			
			$("#AdministratorProfileEndDateExpirationYear").css("width", "65px");
			$("#AdministratorProfileEndDateExpirationMonth").css("width", "90px");
			$("#AdministratorProfileEndDateExpirationDay").css("width", "60px");
		
			<?php if($this->request->data['AdministratorProfile']['start_date_expiration']<>''): ?>
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
			document.getElementById("AdministratorEmailConfirm").value = document.getElementById("AdministratorEmail").value;
			
			<?php 
				$myArray = (explode(",",$this->request->data['AdministratorProfile']['access']));
			?>	
				var arrayAccesosAdmin = new Array();
				var indexArray = 0;
				<?php 
					foreach($myArray as $k => $acceso): 
				?>
					arrayAccesosAdmin[indexArray] = <?php echo $acceso ?>;
					indexArray++;
				<?php 
					endforeach;
				?>
				
				$("#AdministratorProfileAccess option").each(function () {
					for( c = 0; c < <?php echo count($myArray); ?>; c++ ){
						if($(this).val() == arrayAccesosAdmin[c]){
							$('#AdministratorProfileAccess option[value='+$(this).val()+']').attr('selected','selected');
						}
					}
				});
		
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
			if($("#AdministratorProfileAcademicLevelId").val() != 0)
				{
				$('#loading').show();
				$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpEsc.php',{level: $('#AdministratorProfileAcademicLevelId').find(":selected").index() },function(JSON)
					{
					$('#AdministratorProfileInstitution').empty();
					$('#AdministratorProfileInstitution').append('<option value="">Entidad</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
					
							if($('#AdministratorProfileAcademicLevelId').find(":selected").index() == 1){
								for (x=0;x<dejarEscuelas.length;x++){
									
									if(dejarEscuelas[x]==val.id){
										if(val.id == '<?php echo (isset($this->request->data['AdministratorProfile']['institution']) and ($this->request->data['AdministratorProfile']['institution'] <> '')) ? $this->request->data['AdministratorProfile']['institution']: ''; ?>'){
											$('#AdministratorProfileInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
										}else{
											$('#AdministratorProfileInstitution').append('<option value="' + val.id + '" >' + val.escuela + '</option>');
										}								
									}
								}
								
							}else if($('#AdministratorProfileAcademicLevelId').find(":selected").index() > 1){
								for (x=0;x<dejarEscuelas.length;x++){
									
									if(dejarFacultades[x]==val.id){
										if(val.id == '<?php echo (isset($this->request->data['AdministratorProfile']['institution']) and ($this->request->data['AdministratorProfile']['institution'] <> '')) ? $this->request->data['AdministratorProfile']['institution']: ''; ?>'){
											$('#AdministratorProfileInstitution').append('<option value="' + val.id + '" selected>' + val.escuela + '</option>');
										}else{
											$('#AdministratorProfileInstitution').append('<option value="' + val.id + '" >' + val.escuela + '</option>');
										}	
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
					$('#AdministratorProfileInstitution').empty();
					$('#AdministratorProfileInstitution').append('<option value="">Entidad</option>');
					$('.selectpicker').selectpicker('refresh');
				}
				
		// Obtener las Escuelas/Facultades dependiendo del nivel
		$("#AdministratorProfileAcademicLevelId").on('change',function (){
			if($("#AdministratorProfileAcademicLevelId").val() != 0)
				{
				$('#loading').show();
				$.get('http://bolsa.trabajo.unam.mx/unam/app/webroot/php/derpEsc.php',{level: $('#AdministratorProfileAcademicLevelId').find(":selected").index() },function(JSON)
					{
					$('#AdministratorProfileInstitution').empty();
					$('#AdministratorProfileInstitution').append('<option value="">Entidad</option>');
					
					var waitCount = 0;
					$.each(JSON, function(key, val){
						waitCount++;
					});
					
					$.each(JSON, function(key, val){
						
							if($('#AdministratorProfileAcademicLevelId').find(":selected").index() == 1){
								for (x=0;x<dejarEscuelas.length;x++){
									
									if(dejarEscuelas[x]==val.id){
										$('#AdministratorProfileInstitution').append('<option value="' + val.id + '">' + val.escuela + '</option>');
									}
								}
								
							}else if($('#AdministratorProfileAcademicLevelId').find(":selected").index() > 1){
								for (x=0;x<dejarEscuelas.length;x++){
									
									if(dejarFacultades[x]==val.id){
										$('#AdministratorProfileInstitution').append('<option value="' + val.id + '">' + val.escuela + '</option>');
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
					$('#AdministratorProfileInstitution').empty();
					$('#AdministratorProfileInstitution').append('<option value="">Entidad</option>');
					$('.selectpicker').selectpicker('refresh');
				}
		});
				
	});	
		function setDates(){
			if ($('#AdministratorProfileUnlimited').is(':checked')) {
					document.getElementById('AdministratorProfileStartDateExpirationYear').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileStartDateExpirationMonth').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileStartDateExpirationDay').options[0].selected = 'selected';
					
					document.getElementById('AdministratorProfileEndDateExpirationYear').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileEndDateExpirationMonth').options[0].selected = 'selected';
					document.getElementById('AdministratorProfileEndDateExpirationDay').options[0].selected = 'selected';
					$('.selectpicker').selectpicker('refresh');
			}
		}
		
		function validarFecha(aho,mes,dia){
			 
				 var plantilla = new Date(aho, mes - 1, dia);//mes empieza de cero Enero = 0

				 if(!plantilla || plantilla.getFullYear() == aho && plantilla.getMonth() == mes -1 && plantilla.getDate() == dia){
				 return true;
				 }else{
				 return false;
				 }
		}
	
		function validateDates(){
			var tiempoIlimitado = 0;
			if ($('#AdministratorProfileUnlimited').is(':checked')) {
				tiempoIlimitado = 1;
				setDates();
			}
			
			var year1  = $( "#AdministratorProfileStartDateExpirationYear" ).val();
			var month1 = $( "#AdministratorProfileStartDateExpirationMonth" ).val();
			var day1   = $( "#AdministratorProfileStartDateExpirationDay" ).val();
				
			var year2  = $( "#AdministratorProfileEndDateExpirationYear" ).val();
			var month2 = $( "#AdministratorProfileEndDateExpirationMonth" ).val();
			var day2   = $( "#AdministratorProfileEndDateExpirationDay" ).val();
				
			if(tiempoIlimitado == 0){
				if((year1 == '') || (month1 == '') || (day1 == '') || (year2 == '') || (month2 == '') || (day2 == '')){
					jAlert('Seleccione las fechas completas para la vigencia de acceso o en su defecto seleccione "Periodo ilimitado de tiempo" ', 'Mensaje');
					document.getElementById('AdministratorProfileStartDateExpirationYear').focus();
					return false;
				}else 
				if((year1==year2) && (month1==month2) && (day1==day2)){
					jAlert('La fecha de inicio y fin de la vigencia no pueden ser iguales', 'Mensaje');
					document.getElementById('AdministratorProfileStartDateExpirationYear').focus();
					return false;
				}else
				if(!validarFecha(year1,month1,day1)){
					jAlert('La fecha de inicio de la vigencia es incorrecta', 'Mensaje');
					document.getElementById('AdministratorProfileStartDateExpirationYear').focus();
					return false;
				}else 
				if(!validarFecha(year2,month2,day2)){
					jAlert('La fecha fin de la vigencia es incorrecta', 'Mensaje');
					document.getElementById('AdministratorProfileEndDateExpirationYear').focus();
					return false;
				}else{
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
			
	</script>
	<?php echo $this->Session->flash(); ?>
		
		<?php	echo $this->Form->create('Administrator', array(
						'type' => 'file',
						'class' => 'form-horizontal', 
						'role' => 'form',
						'inputDefaults' => array(
							'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
							'div' => array('class' => 'form-group'),
							'class' => 'form-control',
							'before' => '<div class="col-md-11 col-md-offset-1">',
							'between' => '<div class="col-md-11">',
							'after' => '</div></div>',
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style'=>'padding-left: 5px; padding-right: 5px;'))
						),
						'action' => 'editAdministratorProfile',
						'onsubmit' =>'return validateDates();'
		)); ?>		
		
		<fieldset>
		
		<div class="col-md-7 col-md-offset-2" style="padding-left: 0px; padding-right: 0px;  margin-top: 60px;">
		<?php 
			echo $this->Form->input('Administrator.id');
			echo $this->Form->input('AdministratorProfile.id');
		?>
		<?php echo $this->Form->input('Administrator.username', array('type' => 'hidden')); 
				?>
		<?php 
			$a = $EscuelasFacultades;
			unset(	$a["97"],
					$a["614"],
					$a["606"],
					$a["608"],
					$a["610"],
					$a["666"],
					$a["702"],
					$a["704"],
					$a["703"],
					$a["710"],
					$a["203"],
					$a["201"],
					$a["202"],
					$a["241"],
					$a["204"],
					$a["240"],
					$a["207"],
					$a["208"],
					$a["210"],
					$a["211"],
					$a["243"],
					$a["420"],
					$a["401"],
					$a["404"],
					$a["407"],
					$a["408"],
					$a["410"],
					$a["411"],
					$a["118"],
					$a["102"],
					$a["106"],
					$a["111"],
					$a["105"],
					$a["195"],
					$a["116"],
					$a["314"],
					$a["303"],
					$a["309"],
					$a["312"],
					$a["342"],
					$a["319"],
					$a["514"],
					$a["503"],
					$a["509"],
					$a["512"],
					$a["519"],
					$a["505"],
					$a["515"],
					$a["66"],
					$a["93"],
					$a["53"],
					$a["51"],
					$a["601"],
					$a["96"],
					$a["58"],
					$a["54"],
					$a["618"],
					$a["56"],
					$a["57"],
					$a["98"],
					$a["617"],
					$a["621"],
					$a["60"],
					$a["612"],
					$a["609"],
					$a["615"],
					$a["64"],
					$a["65"],
					$a["67"],
					$a["92"],
					$a["68"],
					$a["69"],
					$a["70"],
					$a["71"],
					$a["72"],
					$a["73"],
					$a["74"],
					$a["75"],
					$a["76"],
					$a["77"],
					$a["62"],
					$a["78"],
					$a["79"],
					$a["80"],
					$a["81"],
					$a["82"],
					$a["83"],
					$a["84"],
					$a["85"],
					$a["86"],
					$a["52"],
					$a["87"],
					$a["88"],
					$a["59"],
					$a["613"],
					$a["89"],
					$a["620"],
					$a["602"],
					$a["603"],
					$a["619"],
					$a["604"],
					$a["605"],
					$a["607"],
					$a["611"],
					$a["30"]
					);
			echo $this->Form->input('AdministratorProfile.academic_level_id', array(
					'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
					'between' => '<div class="col-md-12">',
					'class' => 'selectpicker show-tick form-control show-menu-arrow',
					'type'=>'select',
					'label' => '',
					'options' => $NivelesAcademicos, 'default'=>'0', 'empty' => 'Nivel académico'));
					
			echo $this->Form->input('AdministratorProfile.institution', array(
					'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
					'between' => '<div class="col-md-12">',
					'class' => 'selectpicker show-tick form-control show-menu-arrow',
					'data-live-search' => "true",
					'type'=>'select',
					'label' => '',
					'options' => $a, 'default'=>'0', 'empty' => 'Entidad'));
					
			
		?>
		</div>
		<div style="background-color: #835B06; margin-bottom: 15px; padding: 15px 0 0; " class="col-md-7 col-md-offset-2">
			<div class="col-md-10 col-md-offset-1">
			
				<div style="text-align: center; font-weight: bold;" >
				   <p> Datos del contacto</p>
				</div>
				
				<?php echo $this->Form->input('AdministratorProfile.contact_name', array(	
								'placeholder' => 'Nombre',
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),								
				)); ?>
				<div  class="col-md-5 col-md-offset-1" style="padding-left: 0px; padding-right: 0px;">
				<?php echo $this->Form->input('AdministratorProfile.contact_last_name', array(
								'before' => '<div class="col-md-12" style="padding-right: 5px; margin-left: 2px;">',
								'between' => '<div class="col-md-11">',
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),			
								'placeholder' => 'Apellido paterno',					
				)); ?>
				</div>
				<div class="col-md-5" style="padding-right: 0px; padding-left: 0px;">
				<?php echo $this->Form->input('AdministratorProfile.contact_second_last_name', array(	
								'before' => '<div class="col-md-12" style="padding-left: 5px; margin-left: 18px;">',
								'between' => '<div class="col-md-11">',
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),			
								'placeholder' => 'Apellido materno',					
				)); ?>
				</div>
				<?php echo $this->Form->input('AdministratorProfile.contact_position', array(				
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),			
								'placeholder' => 'Cargo',					
				)); ?>
				<?php echo $this->Form->input('Administrator.email', array(
								'before' => '<div class="col-md-11 col-md-offset-1"><img data-toggle="tooltip" id="" data-placement="right" title="Agregue el correo que le fue asignado por la UNAM" class="img-circle cambia" alt="help.png" style="margin-top: 8px;" src="/unam/img/help.png">',
								'between' => '<div class="col-md-11" >',
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),			
								'onchange' => 'emptyConfirm()',
								'placeholder' => 'Correo electrónico institucional',					
				)); ?>
				<?php echo $this->Form->input('Administrator.email_confirm', array(				
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),			
								'placeholder' => 'Confirmar correo electrónico institucional',					
				)); ?>
				<div class="col-md-3 col-md-offset-1" style="padding-left: 3px; left: 5px;">
				<?php echo $this->Form->input('AdministratorProfile.long_distance_cod', array(		
								'before' => '<div class="col-md-12" style="padding-right: 0px;">',
																'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),
								'placeholder' => 'Lada',					
				)); ?>
				</div>
				<div class="col-md-5" style="padding-left: 0px; padding-right: 0px;">
				<?php echo $this->Form->input('AdministratorProfile.telephone', array(	
								'before' => '<div class="col-md-12" style="padding-left: 0px;">',
								'between' => '<div class="col-md-11" style="padding-left: 10px;">',
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),
								'placeholder' => 'Teléfono de contacto',					
				)); ?>
				</div>
				<div class="col-md-3" style="padding-left: 0px;  padding-right: 0px; left: -18px;">
				<?php echo $this->Form->input('AdministratorProfile.phone_extension', array(		
								'before' => '<div class="col-md-12" style="padding-left: 0px;">',
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),
								'placeholder' => 'Extensión',					
				)); ?>
				</div>
				
				<div class="col-md-3 col-md-offset-1" style="padding-left: 3px; left: 5px;">
				<?php echo $this->Form->input('AdministratorProfile.long_distance_cod_cell_phone', array(		
								'before' => '<div class="col-md-12" style="padding-right: 0px;">',
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),
								'placeholder' => 'Lada',					
				)); ?>
				</div>
				<div class="col-md-5" style="padding-left: 0px; padding-right: 0px;">
				<?php echo $this->Form->input('AdministratorProfile.cell_phone', array(	
								'before' => '<div class="col-md-12" style="padding-left: 0px;">',
								'between' => '<div class="col-md-11" style="padding-left: 10px; margin-left: 7px;">',
								'label' => array(
											'class' => 'col-md-0 control-label',
											'text' => '',
											),
								'placeholder' => 'Teléfono celular',					
				)); ?>
				</div>
				
				<center>
				<div class="col-md-10" >
				<?php
					if(($administrator['Administrator']['id'] == 1) and ($this->Session->read('Auth.User.role') == 'subadministrator')):	
										echo $this->Form->button(
															'Cambiar acceso  &nbsp;&nbsp;&nbsp; <i class="glyphicon glyphicon-lock"></i>', 
															array(
																'type' => 'button',
																'div' => 'form-group',
																'class' => 'btn btnRed col-md-8',
																'style' => 'margin-top: 15px; margin-left: 115px;',
																'escape' => false,
																'onclick' => 'avisoAdmin('.$administrator['Administrator']['id'].');',
															)
										);
									else:
										echo $this->Html->link(
															'Cambiar acceso &nbsp;&nbsp; <i class="glyphicon glyphicon-lock"></i>', 
															array(
																'controller'=>'Administrators',
																'action'=>'editPasswordAdministrator', $administratorProfileEditingId['AdministratorProfile']['administrator_id']),
															array(
																'class' => 'btn btnRed col-md-8',
																'style' => 'margin-top: 15px; margin-left: 113px;',
																'escape' => false)	
									); 	
					endif;
				?>
				</div>
				</center>
				
			</div>
			
			<?php if($this->request->data['AdministratorProfile']['id']==1): ?>
				<div class="col-md-9 col-md-offset-2">
					<p>El administrador principal posee acceso a todos los módulos con periodo ilimitado de tiempo.</p>
				</div>
				<div style="display: none">
			<?php endif; ?>
			
			<div class="col-md-12"  style="margin-top: 30px;">
				<?php 	
						unset($administratorAccesos[1]);
						unset($administratorAccesos[2]);
						unset($administratorAccesos[8]);
					echo $this->Form->input('AdministratorProfile.access', array(	
								'multiple' => 'multiple',
								'type' => 'select',
								'before' => '<div class="col-md-11" >',
								'between' => '<div class="col-md-6 ">',
								'class' => 'selectpicker show-tick form-control show-menu-arrow',
								'data-selected-text-format' => 'count > 2',
								'data-actions-box' => 'true',
								'label' => array(
											'class' => 'col-md-4 control-label',
											'text' => 'Permisos:',
											),
								'options' => $administratorAccesos, 'default'=>'0', 'empty' => ''
							));
				?>	
			</div>
			
			<div class="col-md-12"  style="margin-top: 30px; padding-left: 0px; padding-right: 0px;" >
				<div style="text-align: center; font-weight: bold;" >
				   <p> <span style="color:red;">*</span>Vigencia de acceso</p>
				</div>
				<div style="text-align: center; font-weight: bold; height: 0px;" >
				   <p> a </p>
				</div>
				<div class="col-md-6" style=" padding-right: 0px;">
					<?php echo $this->Form->input('AdministratorProfile.start_date_expiration', array(
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																'between' => '<div class="col-md-12 ">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-0 col-md-offset-0 control-label',
																			'text' => '',),
																'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-inline'),
																'label' => array(
																	'class' => 'col-sm-0 col-md-0 control-label',
																	'text' => '',),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - -5,
																'maxYear' => date('Y') - 0,
																'onchange' => 'setDates();',
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								));
					?>
				</div>
				<div class="col-md-6" style=" padding-right: 0px;">
					<?php echo $this->Form->input('AdministratorProfile.end_date_expiration', array(
																'before' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">',
																'between' => '<div class="col-md-12 ">',
																'class' => 'selectpicker show-tick form-control show-menu-arrow',
																'data-width'=> '80px',
																'label' => array(
																			'class' => 'col-md-0 col-md-offset-0 control-label',
																			'text' => '',),
																'style' => 'width: 120px;  margin-left: -10px; margin-right: 18px;  padding-left: 0px; padding-right: 0px; font-size: 12px;',
																'div' => array('class' => 'form-inline'),
																'label' => array(
																	'class' => 'col-sm-0 col-md-0 control-label',
																	'text' => '',),
																'dateFormat' => 'YMD',
																'separator' => '',
																'minYear' => date('Y') - -5,
																'maxYear' => date('Y') - 0,
																'onchange' => 'setDates();',
																'placeholder' => 'Vigencia que aparecerá en la oferta',
																'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce', 'style' => 'margin-left: -11px; margin-right: 23px;'))
								)); 
					?>
				</div>			
			</div>
			
			<div class="col-md-6 col-md-offset-4"  style="margin-top: 30px; margin-bottom: 30px; padding-left: 0px; padding-right: 0px;" >
				<?php echo $this->Form->checkbox('AdministratorProfile.unlimited', array(
											'value' => '1',
											'label' => '',
											'style' => 'display: inline',
											'onClick' => 'setDates();',
					));
				?>
				<span class="titulos">Periodo ilimitado de tiempo</span>
			</div>	
			
			<?php if($this->request->data['AdministratorProfile']['id']==1): ?>
				</div>
			<?php endif; ?>
		
		</div>
		</fieldset>
		
			<div style="margin-top: 20px;" class="col-md-7 col-md-offset-2">
					<?php 
						echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar', array(
											'type' => 'submit', 
											'div' => 'form-group',
											'class' => 'btn btnRed btn-default col-md-offset-5',
											'escape' => false,
						));
						
						echo $this->Form->end(); 
					?>
			</div>
