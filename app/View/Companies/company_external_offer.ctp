<?php 
	$this->layout = 'company'; 
?>

	<script>

	$(document).ready(function() {
		
		var helpText = [
						"Puede guardar las ofertas  en carpetas para una mejor organización. Las carpetas creadas se ordenarán alfabéticamente y nombrarlas a su gusto.",					
						];
		 
		$('.form-group').each(function(index, element) {
			$(this).find(".cambia").attr("id", index);
			$(this).find('#'+index).attr("data-original-title", helpText[index]);
		});
		$("#reportId").hide();
		
		<?php if(isset($this->request->data['CompanyExternalOffer'])): ?>
			$('#CompanyExternalOfferFechaContratacionDay').prepend('<option value="">DD</option>');
			$('#CompanyExternalOfferFechaContratacionMonth').prepend('<option value="">MM</option>');
			$('#CompanyExternalOfferFechaContratacionYear').prepend('<option value="">AAAA</option>');
		 <?php else: ?>
			$('#CompanyExternalOfferFechaContratacionDay').prepend('<option value="" selected>DD</option>');
			$('#CompanyExternalOfferFechaContratacionMonth').prepend('<option value="" selected>MM</option>');
			$('#CompanyExternalOfferFechaContratacionYear').prepend('<option value="" selected>AAAA</option>');
		 <?php endif; ?>

	});  
	
	 function validarSiNumero(numero){
		if (!/^([0-9])*$/.test(numero)){
			alert("El valor " + numero + " no es un número");
			$('#CompanyExternalOfferSalary').val('');
			$('#CompanyExternalOfferSalary').focus();
		}
	}
		
	</script>
	
		<?php echo $this->Session->flash(); ?>
		<div class="col-md-12" style="margin-top: 30px; margin-bottom: 30px; margin-left: 30px;">
			<p style="font-size: 20px;">Reporte de contratación</p>
		</div>

		<?php 
				echo $this->Form->create('Company', array(
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => array(
							'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
							'div' => array('class' => 'form-group'),
							'class' => 'form-control',
							'label' => array('class' => 'col-md-12 control-label '),
							'before' => '<div class="col-md-12">',
							'between' => '<div class="col-md-12" >',
							'after' => '</div></div>',
							'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce'))
														),
							'action' => 'companyExternalOffer',
				)); 
		?>
						
			<div class="col-md-4">
			
						<div class="col-md-12 " style="margin-top: 5px;">
								
							<?php echo $this->Form->input('CompanyExternalOffer.student_name', array(	
														    'before' => '<div class="col-md-12" style="margin-top: 5px;">',
														    'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',
															'style' => 'height: 10px;'),
															'placeholder' => 'Nombre del candidato',						
							)); ?>
							<?php echo $this->Form->input('CompanyExternalOffer.student_academic_level', array(	
															'type' => 'select',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'before' => '<div class="col-md-12"  style="height: 35px;">',
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',
															'style' => 'height: 10px;'),
															'options' => $NivelesAcademicos,'default'=>'0', 'empty' => 'Último nivel de estudios',
															'placeholder' => 'Último nivel de estudios',						
							)); ?>
							
							<div class="col-md-12 " style="margin-top: 5px;">
								<div class="col-md-12">
									<div class="form-group" style="margin-bottom: 5px;">
										<label class="col-md-10 control-label"><span style="color:red;">*</span>Fecha de termino</label>
									</div>
								</div>
							</div>
								
							<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;margin-top: 17px; left: -5px;">
									<?php echo $this->Form->input('CompanyExternalOffer.fecha_contratacion', array(
															'type' => 'date',
															'befoe' => '<div class="col-md-12" style="padding-left: 0px; padding-right: 0px; ">',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-width'=> '75px',
															'between' => '<div class="col-md-12" style="padding-right: 0px;left: -2px;">',
															'style' => 'font-size: 11px; width: 75px; margin-left: -10px; margin-right: 18px; padding-left: 0px; padding-right: 0px;',
															'div' => array('class' => 'form-inline'),
															'label' => '',
															'dateFormat' => 'DMY',
															'separator' => '',
															'minYear' => date('Y') - 5,
															'maxYear' => date('Y') - 0,
									)); ?>
							</div>
							<?php echo $this->Form->input('CompanyExternalOffer.employees_number', array( 
																										'type' => 'hidden',
																										'value' => $company['CompanyProfile']['employees_number']
																										)
														); 
																										?>
							<?php echo $this->Form->input('CompanyExternalOffer.company_name', array( 
																										'type' => 'hidden',
																										'value' => $company['CompanyProfile']['company_name'] 
																									)
														); 
																										?>
							
							<div class="col-md-12"  style="color: #FFB71F; text-align: center; margin-top: 25px;">
								<?php 
									echo $company['CompanyProfile']['company_name'];
								?>
							</div>
							
							<div class="col-md-12"  style="color: #FFB71F; text-align: center; margin-top: 25px;">
								<?php 
									echo 'Número de empleados: '.$company['CompanyProfile']['employees_number'];
								?>
							</div>
							
						</div>
			</div>
			
			<div class="col-md-4"  style="margin-left: -10px;">
							<?php echo $this->Form->input('CompanyExternalOffer.job_name', array(	
															'before' => '<div class="col-md-12"  style="height: 35px;">',
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',
															'style' => 'height: 10px;'),
															'placeholder' => 'Nombre de la oferta / Puesto',						
							)); ?>
							<?php echo $this->Form->input('CompanyExternalOffer.salary', array(	
															'before' => '<div class="col-md-12" style="height: 35px;">',
															'onChange' => 'validarSiNumero(this.value);',
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',
															'style' => 'height: 10px;'),
															'placeholder' => 'Sueldo ejemplo (5000)',						
							)); ?>
							<?php echo $this->Form->input('CompanyExternalOffer.state', array(	
															'type' => 'select',
															'before' => '<div class="col-md-12"  style="height: 35px;">',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-live-search' => "true",
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',
															'style' => 'height: 10px;'),
															'placeholder' => 'Estado de la oferta',		
															'options' => $Estados,'default'=>'0', 'empty' => 'Estado de la oferta'
							)); ?>
							<?php 	echo $this->Form->input('CompanyExternalOffer.rotation', array(
															'type' => 'select',
															'class' => 'selectpicker show-tick form-control show-menu-arrow',
															'data-live-search' => "true",
															'before' => '<div class="col-md-12"  style="height: 35px;">',
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',
															'style' => 'height: 10px;'),
															'options' => $Giros,'default'=>'0', 'empty' => 'Giro'
							));?>
			</div>
		
			<div class="col-md-4" style="margin-left: -10px;">
							<?php 	
									$options = array('s' => 'Si', 'n' => 'No');
									echo $this->Form->input('CompanyExternalOffer.experience_required', array(
													'type' => 'radio',
													'style' => 'margin-left: -5px; margin-top: 0px; top: 17px; width: 15px;',
													'default'=> 0,
													'legend' => false,
													'before' => '<div class="col-md-5 col-md-offset-6" style="left: 50px;  padding-left: 0px; padding-right: 0px;"><div class="radio-inline col-md-2"><label>',
													'after' => '</label></div></div>',
													'separator' => '</label></div><div class="radio-inline col-md-2"><label>',
													'options' => $options,
									));
							?>
							
							<div class="col-md-8" style="top: -47px; margin-bottom: -30px; padding-left: 5px; padding-right: 0px;"> 
								<p style="font-size: 12px;" ><span style="color:red;">*</span>Experiencia profesional requerida</p>	
							</div>
							
							<?php echo $this->Form->input('CompanyExternalOffer.responsible_name', array(	
															'before' => '<div class="col-md-12">',
															'style' => 'margin-top: -5px;',
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',),
															'placeholder' => 'Responsable de la oferta',						
							)); ?>
							<?php echo $this->Form->input('CompanyExternalOffer.responsible_position', array(	
															'before' => '<div class="col-md-12">',
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',),
															'placeholder' => 'Cargo del responsable',						
							)); ?>
							<?php echo $this->Form->input('CompanyExternalOffer.responsible_telephone', array(	
															'before' => '<div class="col-md-12">',
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',),
															'placeholder' => 'Teléfono de contacto con extensión',						
							)); ?>
							<?php echo $this->Form->input('CompanyExternalOffer.responsible_email', array(	
															'before' => '<div class="col-md-12">',
															'label' => array(
															'class' => 'col-md-0 control-label',
															'text' => '',),
															'placeholder' => 'Correo del responsable',						
							)); ?>
			</div>
							
			<div class="col-md-3 col-md-offset-9" style="top: -30px;">
							<?php echo $this->Form->submit('Reportar contratación', array(
															'div' => 'form-group col-md-offset-1',
															'class' => 'btn btnBlue btn-default',
															'after' => '<img data-toggle="tooltip" id="" data-placement="top" title="Importante. Al cubrir una oferta reportar contratación con el fin de contar con datos estadísticos. (Completar datos)" class="img-circle cambia" alt="help.png" src="/unam/img/help.png" style="margin-left: 5px;"></div></div>',
							));?>
							<?php echo $this->Form->end(); ?>
			</div>
