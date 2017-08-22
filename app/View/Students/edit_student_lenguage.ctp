<?php $this->layout = 'student'; ?>
	
	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD">Editando...</p>
    </blockquote>	

	<div class="col-md-8 col-md-offset-2">	
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
						'action' => 'editStudentLenguage',
						'onsubmit' =>'return validateInputsLenguage();']); ?>	

		<fieldset>

			<?= $this->Form->input('StudentLenguage.id'); ?>

			<?= $this->Form->input('StudentLenguage.language_id', ['type'=>'select','options' => $lenguages,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Idioma','data-live-search' => "true"]); ?>

			<?= $this->Form->input('StudentLenguage.reading_level', ['type'=>'select','options' => $NivelesIdioma,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Nivel de lectura']); ?>

			<?= $this->Form->input('StudentLenguage.writing_level', ['type'=>'select','options' => $NivelesIdioma,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Nivel de escritura']); ?>

			<?= $this->Form->input('StudentLenguage.conversation_level', ['type'=>'select','options' => $NivelesIdioma,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Nivel de conversación']); ?>

			<?= $this->Form->input('StudentLenguage.certification', ['placeholder' => 'Certificación / Institución que lo acredita']); ?>

			<?= $this->Form->input('StudentLenguage.certification_year', [
							'class' => 'selectpicker show-tick form-control show-menu-arrow',
							'type' => 'date',
							'data-live-search' => 'true',
							'dateFormat' => 'Y',
							'separator' => '',
							'minYear' => date('Y') - 100,
							'maxYear' => date('Y') - 0,
							'empty' => 'Año de certificación']); ?>

			<?= $this->Form->input('StudentLenguage.score', ['placeholder' => 'Puntaje','type'=>'number','max'=>'1000','min'=>'1']); ?>

		</fieldset>

		<div class="col-md-12 text-center">
			<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
			<?= $this->Form->end(); ?>
		</div>	
	</div>


	<script type="text/javascript">
		function validateInputsLenguage(){
			var institucion = $('#StudentLenguageCertification').val();
			var year = $('#StudentLenguageCertificationYearYear').val();
			var score = $('#StudentLenguageScore').val();
			
			if ((institucion != '') && (year == '')){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione el año de certificación'});
				return false;
			} else
			if((institucion != '') && (score == '')){
				$.alert({ title: '!Aviso!',type: 'red',content: 'Ingrese el puntaje obtenido'});
				return false;
			} else {
			return true;
			}
		}	
	</script>