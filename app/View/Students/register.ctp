	<?php	$this->layout = 'register'; ?>
	<script>
		$(document).ready(function() {
			desabilityconfidencial();
		});

		function condiciones(){
			if( $('#terminos').is(':checked') ) {
				return true;
			} else {
				$.alert({
				    title: '!Aviso!',
				    theme: 'supervan',
				    content: 'Aún no ha aceptado los  términos  y condiciones del SISBUT. Los puede consultar en la liga en azul: “Leer Aviso de Privacidad”',
				});
				document.getElementById('terminos').focus();
				return false;
			}
		}
				
		function desabilityconfidencial(){ 	
			if($("#StudentAcademicLevelId option:selected").index() == 0) {  
	           $("#bloque1").hide();
				document.getElementById('StudentAcademicLevelId').options[0].selected = 'selected';
	        }  else{
				$("#bloque1").show();
			}
		}
	</script>

	<?= $this->Form->create('Student', [
								'class' => 'form-horizontal', 
								'role' => 'form',
								'inputDefaults' => [
									'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
									'div' => ['class' => 'form-group'],
									'class' => ['form-control'],
									'label' => '',
									'between' => '<div class="col-md-12">',
									'after' => '</div>',
									'error' => ['attributes' => ['wrap' => 'span', 'class' => 'help-inline']],
								],
					'onsubmit' =>'return condiciones();',
					'action' => 'register',
					
	]); ?>			

<div style="margin-bottom: 15px; margin-top: 35px; padding-top: 15px; padding-bottom: 15px;" class="col-md-7 col-md-offset-2 fondoBti">
	<div class="col-md-6">
		<?= $this->Form->input('Student.username',['type'=>'number','placeholder'=> 'Número de cuenta']); ?>
	</div>
	
	<div class="col-md-6">
		<?= $this->Form->input('Student.academic_level_id',['options' => $AcademicLevels, 'default'=>'0', 'empty' => 'Nivel Académico','class'=>'form-control selectpicker show-tick show-menu-arrow','onChange' => 'desabilityconfidencial()']); ?>
	</div>
</div>

<div id="bloque1"; style="margin-bottom: 15px; padding-top: 15px; padding-bottom: 15px; display: none;" class="col-md-7 col-md-offset-2 fondoBti">
	<div class="col-md-4">
		<?= $this->Form->input('Student.institution',['type' => 'select', 'default'=>'0', 'empty' => 'Escuela / Facultad:','class'=>'form-control selectpicker show-tick show-menu-arrow','data-live-search'=>'true']); ?>
	</div>
	<div class="col-md-4">
		<?= $this->Form->input('Student.career',['type' => 'select', 'default'=>'0', 'empty' => 'Carrera / Programa:', 'selected' => $this->Session->read('carreraSeleccionada'), 'class'=>'form-control selectpicker show-tick show-menu-arrow','data-live-search'=>'true']); ?>
	</div>
	<div class="col-md-4">
		<?= $this->Form->input('Student.academic_situation_id',['options' => $AcademicSituation, 'default'=>'0', 'empty' => 'Situación académica', 'class'=>'form-control selectpicker show-tick show-menu-arrow']); ?>
	</div>
</div>

<div style="padding-top: 15px; padding-bottom: 15px;" class="col-md-7 col-md-offset-2 fondoBti" >
	
	<div class="col-md-6">
		<?= $this->Form->input('Student.password',['placeholder' => 'Contraseña 7-12 alfanumérico']); ?>
	</div>
	<div class="col-md-6">
		<?= $this->Form->input('Student.password_confirm',['placeholder' => 'Confirmar contraseña']); ?>
	</div>
	<div class="col-md-6">
		<?= $this->Form->input('Student.email',['type'=>'email','placeholder' => 'Correo electrónico principal']); ?>
	</div>
	<div class="col-md-6">
		<?= $this->Form->input('Student.email_confirm',['type'=>'email','placeholder' => 'Compruebe correo electrónico principal']); ?>
	</div>

	<div class="col-md-12 form-group required">
		<p class="whiteText"><span style="color:red">*</span> &nbsp;<input type="checkbox" id="terminos" name="terminos" value="1"  <?php echo ($this->Session->read('terminosCondiciones')==1)? 'checked' : '';?> > Acepto los términos de la UIC y del administrador del portal</p>
	</div>

</div>

<div class="col-md-7 col-md-offset-2" style="border-top: 10px">
	<a href="#" data-toggle="modal" data-target="#aviso" style="text-decoration: underline; float: right;">Leer Aviso de Privacidad</a>
</div>

<div class="col-md-2 col-md-offset-3 whiteText" style="margin-top: 2%;">
	<?=  $this->Html->link("Volver", ['controller' => 'students','action'=> 'logout'], ['class' => 'btn col-md-12']) ?>
</div>

<div class="col-md-2 col-md-offset-1 whiteText" style="margin-top: 2%;">
	<?= $this->Form->submit('Registrar', ['class' => 'btn col-md-12']); ?>
</div>

<?= $this->Form->end(); ?>

<?= $this->element('scriptRegistroStudent'); ?>

<script type="text/javascript">
	$("form-control.required").append('<span class="red-star"> *</span>');
</script>


<style type="text/css">
	.required label:after {
	  content:"*";
	  display: block;
	  position: absolute;
	  top: -7px;
	  left: 5px;
	  color:red;
	}
</style>
