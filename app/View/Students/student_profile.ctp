<?php  $this->layout = 'student'; ?>
	<script>
		$(document).ready(function() {
			<?php if($this->request->data['StudentProfile']['date_of_birth'] <> '0000-00-00'): ?>		
				$('#StudentProfileDateOfBirthYear').prepend('<option value="" >AAAA</option>');
				$('#StudentProfileDateOfBirthMonth').prepend('<option value="" >MM</option>');
				$('#StudentProfileDateOfBirthDay').prepend('<option value="" >DD</option>');
			<?php else: ?>
				$('#StudentProfileDateOfBirthYear').prepend('<option value="" selected>AAAA</option>');
				$('#StudentProfileDateOfBirthMonth').prepend('<option value="" selected>MM</option>');
				$('#StudentProfileDateOfBirthDay').prepend('<option value="" selected>DD</option>');
			<?php endif; ?>
			
			desabilityOptions();
			ageCalculator();
			document.getElementById("StudentProfileSecondaryEmailConfirm").value = document.getElementById("StudentProfileSecondaryEmail").value;
			document.getElementById("StudentEmailConfirm").value = document.getElementById("StudentEmail").value;
			$('.selectpicker').selectpicker('refresh');
		});
		
		function emptyConfirm(){
			document.getElementById("StudentProfileSecondaryEmailConfirm").value = '';
		}
		
		function emptyStudentEmailConfirm(){
			document.getElementById("StudentEmailConfirm").value = '';
		}
		
		function ageCalculator(){
			var ano = document.getElementById("StudentProfileDateOfBirthYear").value;
			var mes = document.getElementById("StudentProfileDateOfBirthMonth").value;
			var dia = document.getElementById("StudentProfileDateOfBirthDay").value;
			
			if(ano!='' && mes!='' &&  dia!=''){
				var fecha_hoy = new Date();
				var ahora_ano = fecha_hoy.getYear();
				var ahora_mes = fecha_hoy.getMonth()+1;
				var ahora_dia = fecha_hoy.getDate();

				var edad = (ahora_ano + 1900) - ano;
				if ( ahora_mes < mes ){
					edad--;
				}
				if ((mes == ahora_mes) && (ahora_dia < dia)){
					edad--;
				}
				if (edad > 1900){
					edad -= 1900;
				}

				var meses = 0;
				if(ahora_mes > mes)
					meses = ahora_mes-mes;
				if(ahora_mes < mes)
					meses = 12 - (mes-ahora_mes);
				if(ahora_mes == mes && dia>ahora_dia)
					meses = 11;

				var dias=0;
				if(ahora_dia>dia)
					dias=ahora_dia-dia;
				if(ahora_dia<dia){
					ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
					dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
				}
				document.getElementById("idAge").innerHTML=" "+edad+" años";
			}else{
				document.getElementById("idAge").innerHTML=" 0 años";
			}
		}
		
		function desabilityOptions(){
			if(document.getElementById("StudentProfileDisability").value == 's') {  
				$('#tipoDiscapacidadId').show();
			} else {
				document.getElementById('StudentProfileDisabilityType').options[0].selected = 'selected';
				$('#tipoDiscapacidadId').hide();
			}
		}

		function disabilityValue(){
			
			var emailValue = document.getElementById("StudentProfileSecondaryEmail").value;
			var emailConfirmValue = document.getElementById("StudentProfileSecondaryEmailConfirm").value;
			
			var studentEmailValue = document.getElementById("StudentEmail").value;
			var studenteEmailConfirmValue = document.getElementById("StudentEmailConfirm").value;
			
			if((document.getElementById("StudentProfileDisability").value == 's') && (document.getElementById('StudentProfileDisabilityType').value == '')) {  
				$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione el tipo de discapacidad.'});
				document.getElementById('StudentProfileDisabilityType').focus();
				return false;
			} else
			if(studentEmailValue != studenteEmailConfirmValue){
				$.alert({ title: '!Aviso!',type: 'red',content: 'El correo de confirmación para el correo principal no coincide, verifique porfavor.'});
				document.getElementById('StudentEmailConfirm').focus();
				return false;
			} else 
			if(emailConfirmValue != emailValue){
				$.alert({ title: '!Aviso!',type: 'red',content: 'El correo de confirmación para el correo secundario no coincide, verifique porfavor.'});
				document.getElementById('StudentProfileSecondaryEmailConfirm').focus();
				return false;
			} else 
			if(emailValue == studentEmailValue){
				$.alert({ title: '!Aviso!',type: 'red',content: 'El correo electrónico secundario no debe de ser igual al principal, verifique porfavor.'});
				document.getElementById('StudentProfileSecondaryEmail').focus();
				return false;
			} else 
			if(($('#StudentProfileCellPhone').val()!='') && ($('#StudentProfileLadaCellPhone').val()=='')){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese la lada del número celular.'});
				document.getElementById('StudentProfileLadaCellPhone').focus();
				return false;
			}else {
				return true;
			}		
		}
</script>
		
	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD">Ingrese la información requerida para su currículum</p>
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
											'action' => 'studentProfile',
											'onsubmit' =>'return disabilityValue();']); ?>
		<fieldset>

			<div class="col-md-6">
				
				<?= $this->Form->input('StudentProfile.id',['type' => 'hidden']); ?>

				<div class="col-md-12">
					<p style="font-weight: bold;font-size: 14px;">Número de cuenta: <?= $student['Student']['username']; ?></p>
				</div>

				<div class="col-md-12">
					<p style="font-weight: bold;font-size: 14px;">Nombre: <?= $student['StudentProfile']['name']; ?></p>
				</div>

				<div class="col-md-12">
					<p style="font-weight: bold;font-size: 14px;">Apellido Paterno: <?= $student['StudentProfile']['last_name']; ?></p>
				</div>

				<div class="col-md-12" style="margin-bottom: 23px;">
					<p style="font-weight: bold;font-size: 14px;">Apellido Materno: <?= $student['StudentProfile']['second_last_name']; ?></p>
				</div>

				<?= $this->Form->input('StudentProfile.sex', ['type'=>'select','options' => $Sexos,'default'=>'0','empty' => 'Sexo','class' => 'selectpicker show-tick form-control show-menu-arrow']); ?>
				
				<label>Fecha de nacimiento</label>

				<?= $this->Form->input('StudentProfile.date_of_birth', [
												'class' => 'selectpicker show-tick form-control show-menu-arrow',
												'data-width'=> '113px',
												'dateFormat' => 'YMD',
												'separator' => '',
												'minYear' => date('Y') - 100,
												'maxYear' => date('Y') - 0,
												'after' => '<div class="col-md-3 text-center" style="margin-top: 5px;" id="idAge"></div></div>',
												'onchange'=> 'ageCalculator()']); ?>

				<?= $this->Form->input('StudentProfile.born_country', ['type'=>'select','options' => $Paises,'data-live-search' => "true",'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Pais de nacimiento']); ?>
				
				<?= $this->Form->input('StudentProfile.marital_status', ['type'=>'select','options' => $EstadoCivil,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Estado civil']); ?>

				<?= $this->Form->input('Student.id'); ?>
			
				<?= $this->Form->input('Student.email', ['type'=>'email','placeholder' => 'Correo electrónico','onchange' => 'emptyStudentEmailConfirm()']); ?>
				
				<?= $this->Form->input('Student.email_confirm', ['type'=>'email','placeholder' => 'Comprueba correo electrónico']); ?>
				
				<?= $this->Form->input('StudentProfile.secondary_email', ['type'=>'email','placeholder' => 'Correo electrónico secundario','onchange' => 'emptyConfirm()']); ?>
				
				<?= $this->Form->input('StudentProfile.secondary_email_confirm', ['type'=>'email','placeholder' => 'Comprueba correo electrónico secundario']); ?>

			</div>

			<div class="col-md-6">
				
				<?= $this->Form->input('StudentProfile.street', ['placeholder' => 'Dirección (Calle y Número)']); ?>
				
				<?= $this->Form->input('StudentProfile.state', ['id' => 'estado','type' => 'select','data-live-search' => "true",'class' => 'selectpicker show-tick form-control show-menu-arrow','options' => $Estados,'default'=>'0', 'empty' => 'Estado / Entidad Federativa']); ?>
				
				<?= $this->Form->input('StudentProfile.city', ['id' => 'ciudad','type' => 'select','data-live-search' => "true",'class' => 'selectpicker show-tick form-control show-menu-arrow','options' => $Municipios,'default'=>'0', 'empty' => 'Delegación / Municipio']); ?>
				
				<?= $this->Form->input('StudentProfile.subdivision', ['placeholder' => 'Población / Colonia']); ?>
				
				<?= $this->Form->input('StudentProfile.zip', ['type'=>'number','placeholder' => 'Código Postal']); ?>
				
				<?= $this->Form->input('StudentProfile.lada_telephone_contact', ['type'=>'number','placeholder' => 'Lada']); ?>

				<?= $this->Form->input('StudentProfile.telephone_contact', ['type'=>'number','placeholder' => 'Teléfono de casa']); ?>
					
				<?= $this->Form->input('StudentProfile.lada_cell_phone', ['type'=>'number','placeholder' => 'Lada']); ?>

				<?= $this->Form->input('StudentProfile.cell_phone', ['type'=>'number','placeholder' => 'Teléfono celular']); ?>

				<?php $options = array('s' => 'Si', 'n' => 'No');
					echo $this->Form->input('StudentProfile.disability', ['type' => 'select','default'=> 0,'empty' => '¿Tiene alguna discapacidad?','options' => $options,'onchange' => 'desabilityOptions()','class' => 'selectpicker show-tick form-control show-menu-arrow']);
				?>

				<div id="tipoDiscapacidadId" style="display: none">
					<?= $this->Form->input('StudentProfile.disability_type', ['type' => 'select','class' => 'selectpicker show-tick form-control show-menu-arrow','options' => $TiposDiscapacidad,'default'=>'0', 'empty' => 'Tipo de discapacidad']); ?>
				</div>
			</div>	

		</fieldset>	
	</div>

	<div class="col-md-12 text-center">
		<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary btn-bti','escape' => false]);?>

		<?= $this->Form->end(); ?>

		<!-- <?= $this->Html->link('Continuar&nbsp;<i class="glyphicon glyphicon-arrow-right"></i>',
														['controller'=>'Students',
														'action'=>'studentProfessionalProfile',1],
														['class' => 'btn btn-default',
														'escape' => false]); ?>  -->
	</div>
	
	<?= $this->element('direccion'); ?>