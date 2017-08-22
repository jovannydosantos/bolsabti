<?php 
	$this->layout = 'student'; 
?>

	<ol class="breadcrumb">
	    <li><?= $this->Html->link('Expectativas laborales', ['controller'=>'Students','action' => 'studentProspect'] );?></li>
	 	<li class="active"><?= '<label>Editando giro...</label>'?></li>
	 </ol>
	
	<div class="col-md-6 col-md-offset-3" style="margin-top: 30px;">	
			
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
									'action' => 'editStudentInterestJob']); ?>
	
			<fieldset>
				<?= $this->Form->input('StudentInterestJob.id'); ?>

				<?= $this->Form->input('StudentInterestJob.business_activity', ['type'=>'select','options' => $Giros,'class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Giro de interés']); ?>

				<?= $this->Form->input('StudentInterestJob.interest_area_id', ['type'=>'select','class' => 'selectpicker show-tick form-control show-menu-arrow','data-live-search' => 'true','default'=>'0', 'empty' => 'Área de interés']); ?>
			
			</fieldset>

			<div class="col-md-12 text-center">
				<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
				<?= $this->Form->end(); ?>
			</div>	
	</div>

	<?= $this->element('scriptGirosStudentProspect'); ?>