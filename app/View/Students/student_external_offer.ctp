<?php 
	$this->layout = 'student'; 
?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#StudentExternalOfferFechaContratacionDay').prepend('<option value="">DD</option>');
			$('#StudentExternalOfferFechaContratacionMonth').prepend('<option value="">MM</option>');
			$('#StudentExternalOfferFechaContratacionYear').prepend('<option value="">AAAA</option>');
			$("select#StudentExternalOfferFechaContratacionDay").val('');
			$("select#StudentExternalOfferFechaContratacionMonth").val('');
			$("select#StudentExternalOfferFechaContratacionYear").val('');
		});  
		
		 function validarSiNumero(numero){
			if (!/^([0-9])*$/.test(numero)){
				$.alert({ title: '!Aviso!',type: 'red',content: 'El valor ' + numero + ' no es un número'});
				$('#StudentExternalOfferEmployeesNumber').val('');
				$('#StudentExternalOfferEmployeesNumber').focus();
			}
		}
			
		function validateInputs(){
			if ($("#StudentExternalOfferExperienceRequired").val() == ''){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Selecciona si la experiencia profesional es requerida'});
				return false;
			} else {
				return true;
			}
		}
	</script>
	
	<blockquote style="border-top-width: 0px;padding-top: 0px;padding-bottom: 0px;margin-top: 10px;margin-bottom: 5px;">
        <p style="color: #588BAD">Con el fin de contar con datos estadísticos, si fue contratado, y no se postuló a través del sistema, le solicitamos llenar la información referente a su contratación.</p>
    </blockquote>

	<div class="col-md-12">
		<?= $this->Form->create('Student', [
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
									'action' => 'studentExternalOffer',
									'onsubmit' =>'return validateInputs();']); ?>
		<fieldset style="margin-top: 30px">
			<div class="col-md-4">
				<center>
				<label class="col-md-12" style="margin-top: 12px"><?= $student['StudentProfile']['name'].' '.$student['StudentProfile']['last_name'].' '.$student['StudentProfile']['second_last_name']; ?></label>
				<label class="col-md-12" style="margin-top: 12px"><?= $student['AcademicLevel']['academic_level']; ?></label>
				</center>
				
				<br />
				<label class="col-md-12" style="margin-top: 14px"><div class="asterisk">*</div>Fecha de contratación</label>
				<?= $this->Form->input('StudentExternalOffer.fecha_contratacion', [
											'class' => 'selectpicker show-tick form-control show-menu-arrow',
											'required'=> 'required',
											'data-width'=> '103px',
											'dateFormat' => 'YMD',
											'separator' => '',
											'minYear' => date('Y') - 10,
											'maxYear' => date('Y') - 0]); ?>
				<?= $this->Form->input('StudentExternalOffer.company_name', ['placeholder' =>' Empresa contratante']); ?>
				<?= $this->Form->input('StudentExternalOffer.employees_number', ['placeholder' =>' Número de empleados','onChange' => 'validarSiNumero(this.value);','type'=>'number']); ?>

			</div>
			
			<div class="col-md-4">
				<?= $this->Form->input('StudentExternalOffer.job_name', ['placeholder' =>'Nombre de la oferta / Puesto']); ?>
				<?= $this->Form->input('StudentExternalOffer.salary', ['placeholder' =>'Sueldo ejemplo (5000)','type'=>'number']); ?>
				<?= $this->Form->input('StudentExternalOffer.status_offer', ['type'=>'select','options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Lugar de la oferta']); ?>
				<?= $this->Form->input('StudentExternalOffer.company_rotation', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Giro']); ?>
			</div>
			
			<div class="col-md-4">
				<?php $options = array('s' => 'Si', 'n' => 'No'); ?>
				<?= $this->Form->input('StudentExternalOffer.experience_required', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Experiencia profesional requerida']); ?>
				<?= $this->Form->input('StudentExternalOffer.responsible_name', ['placeholder' =>'Responsable de la oferta']); ?>
				<?= $this->Form->input('StudentExternalOffer.responsible_position', ['placeholder' =>'Cargo del responsable']); ?>
				<?= $this->Form->input('StudentExternalOffer.responsible_telephone', ['placeholder' =>'Teléfono de contacto con extensión']); ?>
				<?= $this->Form->input('StudentExternalOffer.responsible_email', ['placeholder' =>'Correo del responsable','type'=>'email']); ?>
			</div>
		</fieldset>

		<div class="col-md-12 text-center">
			<?= $this->Form->button('Reportar Contratación &nbsp; <span class="glyphicon glyphicon-thumbs-up"></span> ',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
			<?= $this->Form->end(); ?>
		</div>	

	</div>