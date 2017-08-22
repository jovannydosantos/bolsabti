<?php 
	$this->layout = 'student'; 
?>
	<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
        <p style="color: #588BAD;">Modificar Contraseña.</p>
    </blockquote>

		<div class="col-md-8 col-md-offset-2 fondoBti" style="margin-top: 30px; margin-bottom: 30px;" >
		
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
											'action' => 'changePassword']); ?>
		
		<fieldset style="margin-top: 30px; margin-bottom: 30px">
				<?= $this->Form->input('Student.id',['type' => 'hidden']); ?>
				<?= $this->Form->input('Student.username',['type' => 'hidden']); ?>
				<?= $this->Form->input('Student.password',['type' => 'hidden']); ?>
				<?= $this->Form->input('Student.old_password',['placeholder' => 'Contraseña Actual']); ?>
				<?= $this->Form->input('Student.new_password',['placeholder' => 'Escribir nueva contraseña']); ?>
				<?= $this->Form->input('Student.new_password_confirm',['placeholder' => 'Confirmar nueva contraseña']); ?>
				<?= $this->Form->input('Student.email',['type' => 'hidden']); ?>
				<?= $this->Form->input('Student.email_confirm',['placeholder' => 'Confirmar correo electrónico de registro','type'=>'email']); ?>
		</fieldset>
	</div>	

	<div class="col-md-12 text-center">
		<?= $this->Form->button('Cambiar &nbsp; <i class="glyphicon glyphicon-lock"></i>',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>	