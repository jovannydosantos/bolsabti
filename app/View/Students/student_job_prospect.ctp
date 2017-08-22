	<?php $this->layout = 'student'; ?>
	
	<?= $this->Form->create('Student', [
							'class' => 'form-horizontal', 
							'role' => 'form',
							'inputDefaults' => [
								'format' => ['before', 'label', 'between', 'input', 'error', 'after'],
								'div' => ['class' => 'form-group'],
								'class' => 'form-control',
								'label' => ['class' => 'col-md-12 control-label', 'text'=>''],
								'between' => '<div class="col-md-8 col-md-offset-2">',
								'after' => '</div>',
								'error' => ['attributes' => ['wrap' => 'div', 'class' => 'help-inline alert alert-danger margin-reduce']]
							],
							'action' => 'studentJobProspect']); ?>
				
	<fieldset>

		<?= $this->Form->input('StudentJobProspect.id',['type' => 'hidden']); ?>

		<?= $this->Form->input('StudentJobProspect.professional_objective', ['placeholder' => 'Escriba aquí su objetivo profesional...','style' => 'max-width: 660px; max-height: 280px; margin-top: 30px;','maxlength' => '309',]); ?>
		
		<div class="col-md-10" style="text-align: right;">
			<span id="contadorComentario">0/309</span><span> caracteres máx. <img data-toggle="tooltip" data-placement="left" title="Es un resumen de máximo cuatro líneas que responde a tres preguntas: ¿Qué ofrezco? ¿A quién se lo ofrezco? ¿Para qué se lo ofrezco? En él expresará los conocimientos, experiencias y competencias que ofrecerá a la empresa o institución a la que desea ingresar de acuerdo con el perfil del puesto al que aspira. Ejemplos:Gestionar áreas o proyectos de TI que permitan hacer un uso innovador de la infraestructura tecnológica para potenciar el crecimiento de las empresas con sistemas estables y funcionales, a través de procesos y metodologías que prevengan riesgos y optimicen costos. Contribuir con mi experiencia de más de 10 años para el mejoramiento de los procesos productivos y de calidad, a fin de reducir desperdicios y tiempo de producción." class="img-circle cambia" alt="help.png" src="/unam/img/help.png"/></span>
		</div>
					
	</fieldset>

	<div class="col-md-12 text-center">
		<?= $this->Form->button('<span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>	

	<?= $this->element('contadorCaracteres'); ?>

	<script>
		init_contadorTa("StudentJobProspectProfessionalObjective","contadorComentario", 309);
		updateContadorTa("StudentJobProspectProfessionalObjective","contadorComentario", 309);
	</script>

