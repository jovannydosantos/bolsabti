<?php 
	$this->layout = 'company'; 
?>
	<script>
		$(document).ready(function() {
			var helpText = [
							"Si el responsable de la oferta es el mismo que el contacto dado de alta en el registro, seleccione Si y automáticamente se llenarán los campos con la información proporcionada. En caso de seleccionar No le pedimos ingresar los datos para seguir con el registro de la oferta.", 
							"", 
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"",
							"Dirección electrónica otorgada por la empresa o institución al responsable de la oferta.",
							"",
							"Si desea mantener la confidencialidad de la empresa ofertante, seleccione Si y escriba en el recuadro de abajo el nombre de la empresa que se mostrará en la oferta o déjelo vacío para que solo aparezca el letrero: “Confidencial”. Si selecciona Si en esta opción, los datos de contacto del responsable de la oferta tampoco aparecerán.",
							"",
							"Si desea mantener ocultos los datos de contacto del responsable de la oferta, seleccione Si"
							];
			 
			$('.form-group').each(function(index, element) {
				$(this).find(".cambia").attr("id", index);
				$(this).find('#'+index).attr("data-original-title", helpText[index]);
			});	
			
			desabilityOptions();
			desabilityconfidencial();
			copyEmail();
		});
	
	function copyEmail(){
		document.getElementById("CompanyJobOfferCompanyEmailConfirm").value = document.getElementById("CompanyJobOfferCompanyEmail").value ;
	}
	
	function desabilityOptions(){
			if($("#CompanyJobOfferSameContactS").is(':checked')) {  
				var disabilityValue = 's';  
			} else if($("#CompanyJobOfferSameContactN").is(':checked')) {  
				var disabilityValue = 'n';   
			} else{
				var disabilityValue = '';   
			}
			
			if (disabilityValue == 'n'){
				$("#mismoContactoId").show();
				$("#mismoContactoId2").show();
			} else {
				$("#mismoContactoId").hide();
				$("#mismoContactoId2").hide();
			}	
	}
	
	function vaciarCajas(){
		$('#CompanyJobOfferResponsibleName').val('');
		$('#CompanyJobOfferResponsibleLastName').val('');
		$('#CompanyJobOfferResponsibleSecondLastName').val('');
		$('#CompanyJobOfferResponsiblePosition').val('');
		$('#CompanyJobOfferResponsibleLongDistanceCod').val('');
		$('#CompanyJobOfferResponsibleTelephone').val('');
		$('#CompanyJobOfferResponsiblePhoneExtension').val('');
		$('#CompanyJobOfferResponsibleLongDistanceCodCellPhone').val('');
		$('#CompanyJobOfferResponsibleCellPhone').val('');
		$('#CompanyJobOfferCompanyEmail').val('');
		$('#CompanyJobOfferCompanyEmailConfirm').val('');
		
		if($("#CompanyJobOfferSameContactS").is(':checked')) {  
				var disabilityValue = 's';  
			} else if($("#CompanyJobOfferSameContactN").is(':checked')) {  
				var disabilityValue = 'n';   
			} else{
				var disabilityValue = '';   
			}
			
			if (disabilityValue == 'n'){
				$("#mismoContactoId").show();
				$("#mismoContactoId2").show();
			} else {
				$("#mismoContactoId").hide();
				$("#mismoContactoId2").hide();
			}	
	}
	
	function desabilityconfidencial(){ 
		if($("#CompanyJobOfferConfidentialJobOfferS").is(':checked')) {  
            var cnfidencial = 's';  
        }  else{
			var cnfidencial = 'n';   
		}

		if(cnfidencial == 's'){
			$("#bloque1").show();
		} else {
			$("#bloque1").hide();
			 $('#CompanyJobOfferCompanyName').val('');
		}
		}
	
	function validateInputs(){

			if($("#CompanyJobOfferSameContactS").is(':checked')) {  
				var value1 = 's';  
			} else if($("#CompanyJobOfferSameContactN").is(':checked')) {  
				var value1 = 'n';   
			} else{
				var value1 = '';   
			}
			
			if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsibleName').value == '')){
				jAlert('Ingrese el nombre', 'Mensaje');
				document.getElementById('CompanyJobOfferResponsibleName').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsibleLastName').value == '')){
				jAlert('Ingrese el apellido paterno', 'Mensaje');
				document.getElementById('CompanyJobOfferResponsibleLastName').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsiblePosition').value == '')){
				jAlert('Ingrese el cargo', 'Mensaje');
				document.getElementById('CompanyJobOfferResponsiblePosition').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsibleLongDistanceCod').value == '')){
				jAlert('Ingrese la lada', 'Mensaje');
				document.getElementById('CompanyJobOfferResponsibleLongDistanceCod').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferResponsibleTelephone').value == '')){
				jAlert('Ingrese el teléfono de contacto', 'Mensaje');
				document.getElementById('CompanyJobOfferResponsibleTelephone').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferCompanyEmail').value == '')){
				jAlert('Ingrese el correo institucional', 'Mensaje');
				document.getElementById('CompanyJobOfferCompanyEmail').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferCompanyEmailConfirm').value == '')){
				jAlert('Ingrese la confirmación del correo institucional', 'Mensaje');
				document.getElementById('CompanyJobOfferCompanyEmailConfirm').focus();
				return false;
			}
			else if ((value1 == 'n') && (document.getElementById('CompanyJobOfferCompanyEmail').value != document.getElementById('CompanyJobOfferCompanyEmailConfirm').value)){
				jAlert('Los correos electrónicos no coinciden', 'Mensaje');
				document.getElementById('CompanyJobOfferCompanyEmail').focus();
				return false;
			}
			else {
				return true;
			}			
	}
	</script>

	<div style="padding-left: 0; padding-right: 0px;" class="col-md-12 ">
								
		<?php echo $this->Session->flash(); ?>	
			
		<?php
			echo $this->Form->create('Company', array(
											'class' => 'form-horizontal', 
											'role' => 'form',
											'inputDefaults' => array(
												'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
												'div' => array('class' => 'form-group'),
												'class' => 'form-control',
												'before' => '<div class="col-md-12 ">',
												'between' => '<div class="col-md-11 ">',
												'after' => '</div></div>',
												'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
											),
									'action' => 'companyJobOffer',
									'onsubmit' =>'return validateInputs();'
		)); ?>
							
		<fieldset style="margin-top: 30px; margin-bottom: 100px;">
					
				<div class="col-md-6">			
							<?php echo $this->Form->input('CompanyJobOffer.id', array(				
															'label' => '',
															'placeholder' => 'Id',					
							)); ?>
		<div class="col-md-11 col-md-offset-1" >
			<p ><span style="color:write;">*</span>¿Son los mismos datos del contacto de registro?</p>
		</div>			
		<div class="col-md-12 col-md-offset-2" >
			<?php 	
					$options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('CompanyJobOffer.same_contact', array(
										'type' => 'radio',
										// 'style' => 'margin-left: -18px; margin-top: 0; top: 1px; width: 15px;',
										'default'=> 0,
										'legend' => false,
										'before' => '<div class="col-md-9" style="color: #fff; left: 55px;""><div class="radio-inline col-xs-2 col-sm-2 col-md-2" style="margin-left: 150px;"><label>',
										'after' => '</label></div></div>',
										'separator' => '</label></div><div class="radio-inline col-md-2"><label>',
										'options' => $options,
										'onclick' => 'vaciarCajas()'
					));
			?>	
		</div>
							
					<div id='mismoContactoId' style="display:none">
							
								<?php 	echo $this->Form->input('CompanyJobOffer.responsible_name', array(	
															'before' => '<div class="col-md-11 col-md-offset-1">',					
															'label' => array(
																		'class' => 'col-md-0 control-label',
																		'text' => '<span style="color:write;">*</span>'),
															'placeholder' => 'Nombre',
								)); ?>	
								<div class="col-md-6"  style="left: 5px;">
								
								<?php 	echo $this->Form->input('CompanyJobOffer.responsible_last_name', array(
															'before' => '<div class="col-md-12 col-md-offset-1">',
															'between' => '<div class="col-md-11 ">',
															'label' => array(
																			'class' => 'col-md-0 control-label',
																			'text' => '<span style="color:write;">*</span>'),
															'placeholder' => 'Apellido paterno',					
								)); ?>
								</div>
								
								<div class="col-md-6" style="padding-left: 0px;">
								<?php echo $this->Form->input('CompanyJobOffer.responsible_second_last_name', array(	
															'before' => '<div class="col-md-12 col-md-offset-0">',
															'between' => '<div class="col-md-11"  style="padding-left: 0px;">',
															'label' => array(
																			'class' => 'col-md-0 control-label',
																			'text' => '<span style="color:write;">*</span>'),
															'placeholder' => 'Apellido materno',					
								)); ?>
								</div>
								<?php 	echo $this->Form->input('CompanyJobOffer.responsible_position', array(	
															'before' => '<div class="col-md-11 col-md-offset-1">',	
															'label' => array(
																			'class' => 'col-md-0 control-label',
																			'text' => '<span style="color:write;">*</span>'),
															'placeholder' => 'Cargo',					
								)); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div id='mismoContactoId2' style="display:none">
								<div class="col-md-3" style="padding-left: 0px; padding-right: 0px;">
								<?php echo $this->Form->input('CompanyJobOffer.responsible_long_distance_cod', array(				
												'label' => array(
																'class' => 'col-md-0 control-label',
																'text' => '<span style="color:write;">*</span>'),
												'before' => '<div class="col-md-12 " style="left: -5px;">',
												'placeholder' => 'Lada',
												'maxlength' => '5',
								)); ?>
								</div>
								<div class="col-md-6"  style="padding-left: 0px; padding-right: 0px; left: -25px;">
								<?php echo $this->Form->input('CompanyJobOffer.responsible_telephone', array(				
												'label' => '',
												'before' => '<div class="col-md-12 " style="padding-right: 0px;">',
												'between' => '<div class="col-md-10"  style="padding-right: 0px; padding-left: 7px;">',
												'placeholder' => 'Teléfono de contacto',	
												'maxlength' => '10',
								)); ?>
								</div>
								<div class="col-md-3"  style="padding-left: 0px; padding-right: 0px;  left: -35px;">
								<?php echo $this->Form->input('CompanyJobOffer.responsible_phone_extension', array(				
												'label' => '',
												'before' => '<div class="col-md-12 " style="padding-left: 0px;">',
												'between' => '<div class="col-md-11"  style="padding-right: 0px;">',
												'placeholder' => 'Extensión',
												'maxlength' => '5',
								)); ?>
								</div>
								<div class="col-md-3 " style="padding-left: 0px; padding-right: 0px;">
								<?php echo $this->Form->input('CompanyJobOffer.responsible_long_distance_cod_cell_phone', array(				
												'label' => '',
												'before' => '<div class="col-md-12 " style="left: -5px;">',
												'placeholder' => 'Lada',
												'maxlength' => '5',
								)); ?>
								</div>
								<div class="col-md-6" style="padding-left: 0px; padding-right: 0px; left: -25px;">
								<?php echo $this->Form->input('CompanyJobOffer.responsible_cell_phone', array(				
												'label' => '',
												'before' => '<div class="col-md-12 " style="padding-right: 0px;">',
												'between' => '<div class="col-md-10"  style="padding-right: 0px; padding-left: 7px;">',
												'placeholder' => 'Teléfono celular',	
												'maxlength' => '10',
								)); ?>
								</div>
								<div class="col-md-3"  style="padding-left: 0px; padding-right: 0px;  left: -35px;">
								</div>

								<?php 	echo $this->Form->input('CompanyJobOffer.company_email', array(	
															'before' => '<div class="col-md-9 " style="left: -5px;">',
															'label' => array(
																			'class' => 'col-md-0 control-label',
																			'text' => '<span style="color:write;">*</span>'),
															'placeholder' => 'Correo institucional',					
								)); ?>
								<?php 	echo $this->Form->input('CompanyJobOffer.company_email_confirm', array(	
															'before' => '<div class="col-md-9 " style="left: -5px;">',
															'label' => array(
																			'class' => 'col-md-0 control-label',
																			'text' => '<span style="color:write;">*</span>'),
															'placeholder' => 'Confirmar correo institucional',					
								)); ?>
					</div>
								<div class="col-md-12" >
									<?php 	
											$options = array('s' => 'Si', 'n' => 'No');
											echo $this->Form->input('CompanyJobOffer.confidential_job_offer', array(
																'type' => 'radio',
																// 'style' => 'margin-left: -18px; margin-top: 0; top: 1px; width: 15px;',
																'default'=> 0,
																'legend' => false,
																'before' => '<div class="col-xs-12 col-sm-12 col-md-9" style="color: #fff;"><div class="radio-inline col-xs-2 col-sm-2 col-md-2" style="margin-left: 170px;"><label>',
																'after' => '</label></div></div>',
																'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
																'options' => $options,
																'onclick' => 'desabilityconfidencial()',
											));
									?>

									<p style="position: absolute; margin-top: -46px;"><span style="color:write;">*</span>Oferta confidencial</p>
									<div class="col-md-offset-9" style="top: -45px;">
										
									</div>	
								</div>
							<div id="bloque1" style="display:none">	
								<?php echo $this->Form->input('CompanyJobOffer.company_name', array(				
															'label' => array(
																			'class' => 'col-md-0 control-label',
																			'text' => ''),
															'before' => '<div class="col-md-12">',
															'style' => 'font-size: 12px;',
															'placeholder' => 'Nombre de la empresa o institución que aparecerá en la oferta',					
								)); ?></div>
											<div class="col-md-12" >
									<?php 	
											$options = array('s' => 'Si', 'n' => 'No');
											echo $this->Form->input('CompanyJobOffer.show_details_responsible', array(
																'type' => 'radio',
																// 'style' => 'margin-left: -18px; margin-top: 0; top: 1px; width: 15px;',
																'default'=> 0,
																'legend' => false,
																'before' => '<div class="col-xs-12 col-sm-12 col-md-9" style="color: #fff;"><div class="radio-inline col-xs-2 col-sm-2 col-md-2" style="margin-left: 170px;"><label>',
																'after' => '</label></div></div>',
																'separator' => '</label></div><div class="radio-inline col-xs-2 col-sm-2 col-md-2"><label>',
																'options' => $options,
											));
									?>

									<p style="position: absolute; margin-top: -46px;margin-left: -4px;"><span style="color:write;margin-left: -5%;">*</span>¿Mostrar datos del<br>reponsable de la oferta?</p>
									<div class="col-md-offset-9" style="top: -45px;">
									</div>	
								</div>
							<div class="col-md-12" style="margin-top: 30px;">
								
								<?php if(($this->Session->check('CompanyJobOffer.id') == true) and (!empty($this->request->data))): ?>
									<div class="col-md-6">
								<?php else:;?>
									<div class="col-md-6 col-md-offset-2">
								<?php endif; ?>
								
								<?php echo $this->Form->button('<i class=" glyphicon glyphicon-floppy-save"></i>&nbsp; Guardar',array(
														'type' => 'submit', 
														'div' => 'form-group',
														'escape' => false,
														'class' => 'btn btn-primary btn-default col-md-9 col-md-offset-3',
														'escape' => false,
											));
								echo $this->Form->end(); 
								?>
								</div>
								<?php if(($this->Session->check('CompanyJobOffer.id') == true) and (!empty($this->request->data))): ?>
								<div class="col-md-6">
									<div class="btn-group">
											<?php 
													echo $this->Html->link('Continuar &nbsp; <i class="glyphicon glyphicon-arrow-right"></i>',
																				array(
																					'controller'=>'Companies',
																					'action'=>'companyJobProfile',
																				),
																				array(
																					'class' => 'btn btn-default btn-primary ',
																					'style' => 'width: 130px;',
																					'escape' => false,
																					)	
												); 	?> 
									</div>
								</div>
								<?php endif; ?>
							</div>
				</div>				
			</fieldset>	
	</div>