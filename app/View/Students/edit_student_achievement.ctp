	<?php 
		$this->layout = 'student'; 
	?>
	<?= $this->element('contadorCaracteres'); ?>
	
	<ol class="breadcrumb">
	    <li><?= $this->Html->link($this->request->data['StudentWorkArea']['job_name'], ['controller'=>'Students','action' => 'editStudentWorkArea',$this->request->data['StudentWorkArea']['id']] );?></li>
	 	<li class="active"><?= 'Editando logro...'; ?></li>
	</ol>
	
	<div class="col-md-8 col-md-offset-2" style="margin-top: 30px;">
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
							'action' => 'editStudentAchievement']); ?>
	
		<fieldset>	

			<?= $this->Form->input('StudentAchievement.id'); ?>

			<?= $this->Form->input('StudentAchievement.student_work_area_id',['type' =>'hidden']); ?>
		
			<?= $this->Form->input('StudentAchievement.achievement', ['placeholder' => 'Logro','type'=>'textarea','class' => 'form-control responsabilidadesClass','style' => 'max-width: 660px; max-height: 280px;','maxlength' => '210', 'onkeypress'=> 'caracteresCont("StudentAchievementAchievement", "contadorLogro",210)']); ?>
			<div class="col-md-10" style="text-align: right; margin-left: 15px; margin-bottom: 10px;">
				<span id="contadorLogro">0/210</span><span> caracteres máx.</span>
			</div>

		</fieldset>
	</div>

	<div class="col-md-12 text-center">
		<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>	