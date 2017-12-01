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
	
			
	function validateInputs(){
		if ($("#CompanyExternalOfferExperienceRequired").val() == ''){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Selecciona si la experiencia profesional es requerida'});
			return false;
		} else {
			return true;
		}
	}
	</script>
	
<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Reporte de contratacion</p>
</blockquote>

<div class="col-md-12">
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
							'action' => 'companyExternalOffer',
							'onsubmit' =>'return validateInputs();']); 
		?>
	<fieldset style="margin-top: 30px">
		<div class="col-md-4">
			<?= $this->Form->input('CompanyExternalOffer.student_name', ['placeholder' =>' Nombre del candidato']); ?>
			<?= $this->Form->input('CompanyExternalOffer.student_academic_level', ['type'=>'select','options' => $NivelesAcademicos,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Ultimo nivel de estudios']); ?>			
			<br />
			<label class="col-md-12" style="margin-top: 14px"><div class="asterisk">*</div>Fecha de termino</label>
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
			<center>
			<?php echo $this->Form->input('CompanyExternalOffer.employees_number', array(
						'type' => 'hidden',
						'value' => $company['CompanyProfile']['employees_number']
						));
			?>
			<?php echo $this->Form->input('CompanyExternalOffer.company_name', array( 
						'type' => 'hidden',
						'value' => $company['CompanyProfile']['company_name'] 
						)); 
			?>
			<label class="col-md-12" style="margin-top: 12px"><?= $company['CompanyProfile']['company_name']; ?></label>
			<label class="col-md-12" style="margin-top: 12px"><?php echo 'Número de empleados: '.$company['CompanyProfile']['employees_number']; ?></label>
			</center>
		</div>
		
		<div class="col-md-4">
			<?= $this->Form->input('CompanyExternalOffer.job_name', ['placeholder' =>'Nombre de la oferta / Puesto']); ?>
			<?= $this->Form->input('CompanyExternalOffer.salary', ['placeholder' =>'Sueldo ejemplo (5000)','type'=>'number']); ?>
			<?= $this->Form->input('CompanyExternalOffer.state', ['type'=>'select','options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Lugar de la oferta']); ?>
			<?= $this->Form->input('CompanyExternalOffer.rotation', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Giro']); ?>
		</div>
		
		<div class="col-md-4">
			<?php $options = array('s' => 'Si', 'n' => 'No'); ?>
			<?= $this->Form->input('CompanyExternalOffer.experience_required', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Experiencia profesional requerida']); ?>
			<?= $this->Form->input('CompanyExternalOffer.responsible_name', ['placeholder' =>'Responsable de la oferta']); ?>
			<?= $this->Form->input('CompanyExternalOffer.responsible_position', ['placeholder' =>'Cargo del responsable']); ?>
			<?= $this->Form->input('CompanyExternalOffer.responsible_telephone', ['placeholder' =>'Teléfono de contacto con extensión']); ?>
			<?= $this->Form->input('CompanyExternalOffer.responsible_email', ['placeholder' =>'Correo del responsable','type'=>'email']); ?>

		</div>
	</fieldset>

	<div class="col-md-12 text-center">
		<?= $this->Form->button('Reportar Contratación &nbsp; <span class="glyphicon glyphicon-thumbs-up"></span> ',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>	

</div>

