<?php 
	$this->layout = 'student'; 
?>
<script>
	$(document).ready(function(){
		caracteresCont("StudentAcademicProjectResponsability", "contadorResponsabilidades",210);
		caracteresCont("StudentAcademicProjectAchievement", "contadorLogros",210)
	});

	function validateInputs(formType){
		var numExperiencias = $(".proyecto");
		var experiencias = $("#StudentAcademicProjectExperiencias").val();
		if((experiencias == 0) && (numExperiencias.length >= 7)){	
			$.alert({ title: '!Aviso!',type: 'red',content: 'Máximo siete proyectos'});
			return false;
		} else {
			return true; 
		}
	}
	
	function pais(){
		var pais = $( "#StudentAcademicProjectCountry option:selected" ).text();
		if(pais == "México"){
			$("#divEstado").show();
		} else{
			document.getElementById('StudentAcademicProjectState').options[0].selected = 'selected';
			$("#divEstado").hide();
		}
	}
	
</script>
	<ol class="breadcrumb">
	    <li><?= $this->Html->link('Proyectos Extracurriculares', ['controller'=>'Students','action' => 'studentAcademicProject'] );?></li>
	 	<li class="active"><?= '<label>Editando proyecto...</label>'?></li>
	 </ol>		
					
	<div class="col-md-12" style="margin-top: 30px;">	
		<div class="col-md-6">

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
									'action' => 'studentAcademicProject',
									'onsubmit' =>'return validateInputs("1");']); ?>

				<fieldset>

				<?= $this->Form->input('StudentAcademicProject.id'); ?>

				<?= $this->Form->input('StudentAcademicProject.name', ['placeholder' => 'Nombre']); ?>

				<?= $this->Form->input('StudentAcademicProject.matter', ['placeholder' => 'Materia']); ?>

				<?php $options = array('1' => 'Grupal', '2' => 'Individual'); ?>
				<?= $this->Form->input('StudentAcademicProject.team', ['type'=>'select','options' => $options,'class' => 'selectpicker show-tick form-control show-menu-arrow','default'=>'0', 'empty' => 'Proyecto']); ?>

				<?= $this->Form->input('StudentAcademicProject.country', ['type'=>'select','options' => $Paises,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'País','onchange' => 'pais()']); ?>

				<div id="divEstado" style="display: none;">
					<?= $this->Form->input('StudentAcademicProject.state', ['type'=>'select','options' => $Estados,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Entidad federativa / Estado']); ?>
				</div>

		</div>
		<div class="col-md-6">

					<?= $this->Form->input('StudentAcademicProject.company', ['placeholder' => 'Empresa / Institución']); ?>
					
					<label style="margin-top: 15px;margin-left: 15px;">Responsabilidades:</label>
					<?= $this->Form->input('StudentAcademicProject.responsability', ['placeholder' => 'Responsabilidades...','type'=>'textarea','class' => 'form-control','style' => 'max-width: 660px; max-height: 280px;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentAcademicProjectResponsability", "contadorResponsabilidades",210)']); ?>
					<div class="col-md-12" style="text-align: right;">
						<span id="contadorResponsabilidades">0/210</span><span> caracteres máx.</span>
					</div>
							
					<label style="margin-left: 15px;">Logro(s):</label>
					<?= $this->Form->input('StudentAcademicProject.achievement', ['placeholder' => 'Logro','type'=>'textarea','class'=>'form-control logrosClass','style' => 'max-width: 660px; max-height: 280px;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentAcademicProjectAchievement", "contadorLogros",210)']); ?>
					<div class="col-md-12" style="text-align: right; margin-bottom: 10px;">
						<span id="contadorLogros">0/210</span><span> caracteres máx.</span>
					</div>

					<?= $this->Form->input('StudentAcademicProject.experiencias', ['type' => 'hidden']); ?>
		</div>

		</fieldset>

		<div class="col-md-12 text-center">
			<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
			<?= $this->Form->end(); ?>
		</div>
	</div>

<?= $this->element('contadorCaracteres'); ?>