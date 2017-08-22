<?php $this->layout = 'student'; ?>

<script>
	$(document).ready(function() {
		hideOther();
	});	
	
	function restart(){
		var textBox = document.getElementById("StudentTechnologicalKnowledgeOther");
		var textLength = textBox.value.length;
		if(textLength > 0){
			$("#contentName").hide();
			document.getElementById('StudentTechnologicalKnowledgeName').options[0].selected = 'selected';
		} else {
			$("#contentName").show();
		}
		$('.selectpicker').selectpicker('refresh');
	}

	function hideOther(){
		var disabilityValue = $('#StudentTechnologicalKnowledgeName').val();
		if (disabilityValue != ''){
			$("#contentOther").hide();
			$('#StudentTechnologicalKnowledgeName').val() == '';
		} else {
			$("#contentOther").show();
		}
	}
	
	function validateInputs(){
		var nombre1 = $('#StudentTechnologicalKnowledgeName').val();
		var nombre2 = $('#StudentTechnologicalKnowledgeOther').val();
		
		if ((nombre1 == '') && (nombre2 == '')){
			$.alert({ title: '!Aviso!',type: 'red',content: 'Seleccione el nombre del programa de cómputo o escribalo en el campo "Otro" si no se encuentra'});
			return false;
		} else {
		return true;
		}
	}	
	
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
	
	function validateInputsDuracion(){
		var duracion = $('#StudentJobSkillDuration').val();
		if(duracion < 0){
			$.alert({ title: '!Aviso!',type: 'red',content: 'La duración no puede ser un valor negativo'});
			return false;
		}else{
			return true;
		}
	}
</script>
	
	<blockquote style="padding-top: 0px; padding-bottom: 0px; margin-top: 15px">
        <p style="color: #588BAD">Ingrese la información solicitada y guarde cada categoría que registre.</p>
    </blockquote>	

		<div class="col-md-6">
			<blockquote style="padding-top: 0px; padding-bottom: 0px;">
		        <p style="color: #588BAD">Cursos / Talleres / Diplomados / Certificaciones</p>
		    </blockquote>
				
			<?= $this->Form->postLink(''); ?>

			<?php foreach($conocimientos as $k => $conocimiento): ?>	
				<div class="col-md-9" style="margin-top: 3px; border-left: 6px solid #1a75bb; background-color: #f8f8f8;">
					<?php echo $conocimiento['StudentJobSkill']['name']; ?>
				</div>
				<div class="col-md-3" style="margin-top: 3px;">
					<?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', 
										['controller'=>'Students',
										'action'=>'editStudentJobSkill',$conocimiento['StudentJobSkill']['id']],
										['class' => 'btn btn-primary btn-sm',
										'escape' => false]);?>
					<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>', '#',[
										'onclick' =>"return confirma('Curso".$conocimiento['StudentJobSkill']['id']."');",
										'class' => 'btn btn-danger btn-sm',
										'escape'=> false]);?>
					<div style="display: none">
					<?= $this->Form->postLink('Eliminar',							
										['controller'=>'Students',
										'action'=>'deleteStudentJobSkill',$conocimiento['StudentJobSkill']['id']],
										['id'=>'eliminarCurso'.$conocimiento['StudentJobSkill']['id']]);?>
					</div>
				</div>
			<?php endforeach; ?>

			<div class="col-md-12" style="margin-top: 30px">
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
									'action' => 'studentJobSkill',
									'onsubmit' =>'return validateInputsDuracion();']); ?>

				<fieldset>

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
		</div>
		<div class="col-md-6">	
				<blockquote style="padding-top: 0px; padding-bottom: 0px;">
			        <p style="color: #588BAD">Idiomas</p>
			    </blockquote>
						
				<?= $this->Form->postLink(''); ?>

				<?php foreach($idiomas as $k => $idioma): ?>	
					<div class="col-md-9" style="margin-top: 3px; border-left: 6px solid #1a75bb; background-color: #f8f8f8;">
						<?php echo $idioma['Lenguage']['lenguage']; ?>
					</div>
					<div class="col-md-3" style="margin-top: 3px;">
						<?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', 
									['controller'=>'Students',
									'action'=>'editStudentLenguage',$idioma['StudentLenguage']['id']],
									['class' => 'btn btn-primary btn-sm',
									'escape' => false]); ?>
						<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>', '#',[
									'onclick' =>"return confirma('Idioma".$idioma['StudentLenguage']['id']."');",
									'class' => 'btn btn-danger btn-sm',
									'escape'=> false]);?>
						<div style="display: none">
							<?= $this->Form->postLink('Eliminar',							
									['controller'=>'Students',
									'action'=>'deleteStudentLenguage',$idioma['StudentLenguage']['id']],
									['id'=>'eliminarIdioma'.$idioma['StudentLenguage']['id']]);?>
						</div>
					</div>
				<?php endforeach; ?>	

				<div class="col-md-12" style="margin-top: 30px">
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
									'action' => 'studentLenguage',
									'onsubmit' =>'return validateInputsLenguage();']); ?>	

					<fieldset>

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
		</div>
	</div>
		
		
	<div class="col-md-12">
		<div class="col-md-6">	
			<blockquote style="padding-top: 0px; padding-bottom: 0px;">
		        <p style="color: #588BAD">Cómputo.</p>
		    </blockquote>		
		
			<?= $this->Form->postLink(''); ?>
				<?php foreach($tecnologias as $k => $tecnologia): ?>	
				<div class="col-md-9" style="margin-top: 3px; border-left: 6px solid #1a75bb; background-color: #f8f8f8;">
					<?php 
						if($tecnologia['StudentTechnologicalKnowledge']['name'] ==''):
							echo $tecnologia['StudentTechnologicalKnowledge']['other']; 
						else:
							echo $tecnologia['Program']['program']; 
						endif;	
					?>
				</div>
				<div class="col-md-3" style="margin-top: 3px;">
						<?= $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', 
										['controller'=>'Students',
										'action'=>'editStudentTechnologicalKnowledge',$tecnologia['StudentTechnologicalKnowledge']['id']],
										['class' => 'btn btn-primary btn-sm',
								'escape' => false]);?>
						<?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>', '#',[
										'onclick' =>"return confirma('Computo".$tecnologia['StudentTechnologicalKnowledge']['id']."');",
										'class' => 'btn btn-danger btn-sm',
										'escape'=> false]);?>
						<div style="display: none">
						<?= $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>',							
										['controller'=>'Students',
										'action'=>'deleteStudentTechnologicalKnowledge',$tecnologia['StudentTechnologicalKnowledge']['id']],
										['id'=>'eliminarComputo'.$tecnologia['StudentTechnologicalKnowledge']['id']]);?>
						</div>
				</div>
			<?php endforeach; ?>

				<div class="col-md-12" style="margin-top: 15px">
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
							'action' => 'studentTechnologicalKnowledge',
							'onsubmit' =>'return validateInputs();']); ?>	

					<fieldset>
						<?= $this->Form->input('StudentTechnologicalKnowledge.tecnology_id', ['type'=>'select','options' => $Tecnologies,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Categoría']); ?>

						<div id="contentName">
							<?= $this->Form->input('StudentTechnologicalKnowledge.name', ['type'=>'select','options' => $Programas,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Nombre','data-live-search' => "true",'onchange' => 'hideOther()']); ?>
						</div>
						<div id="contentOther">
							<?= $this->Form->input('StudentTechnologicalKnowledge.other', ['placeholder' => 'Otro','onblur' => 'restart()']); ?>
						</div>

						<?= $this->Form->input('StudentTechnologicalKnowledge.level', ['type'=>'select','options' => $NivelesSoftware,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Nivel']); ?>

						<?= $this->Form->input('StudentTechnologicalKnowledge.institution', ['placeholder' => 'Certificación']); ?>

					</fieldset>
					<div class="col-md-12 text-center">
						<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
						<?= $this->Form->end(); ?>
					</div>
			</div>
		</div>
	</div>

