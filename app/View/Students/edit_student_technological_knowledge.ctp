<?php $this->layout = 'student'; ?>

<script>
	$(document).ready(function() {
		restart();
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
</script>
	
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
						'action' => 'editStudentTechnologicalKnowledge',
						'onsubmit' =>'return validateInputs();']); ?>	

			<fieldset>
				<?= $this->Form->input('StudentTechnologicalKnowledge.id'); ?>
				
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