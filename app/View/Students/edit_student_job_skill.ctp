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
						'action' => 'editStudentJobSkill']); ?>

			<fieldset>
				<?= $this->Form->input('StudentJobSkill.id'); ?>

				<?= $this->Form->input('StudentJobSkill.type_course_id', ['type'=>'select','options' => $TipoCursos,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Categoría']); ?>

				<?= $this->Form->input('StudentJobSkill.name', ['placeholder' => 'Nombre del curso, taller, diplomado']); ?>

				<?= $this->Form->input('StudentJobSkill.company', ['placeholder' => 'Empresa / Institución']); ?>

				<?= $this->Form->input('StudentJobSkill.duration', ['placeholder' => 'Duración (Horas)','type'=>'number','max'=>'1000','min'=>'1']); ?>

				<?= $this->Form->input('StudentJobSkill.date', [
							'class' => 'selectpicker show-tick form-control show-menu-arrow',
							'data-live-search' => 'true',
							'dateFormat' => 'Y',
							'separator' => '',
							'minYear' => date('Y') - 100,
							'maxYear' => date('Y') - 0,
							'empty' => 'Año']); ?>
			</fieldset>

			<div class="col-md-12 text-center">
				<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
				<?= $this->Form->end(); ?>
			</div>	
	</div>	
