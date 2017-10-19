	<?php 
		$this->layout = 'administrator'; 
	?>
	<script>
		$(document).ready(function() {
			$( "#AdministratorPassword" ).val('');
			$( "#AdministratorPasswordConfirm" ).val('');
		});	
	</script>
	
		<blockquote style="border-top-width: 0px; padding-top: 0px; padding-bottom: 0px;margin-top: 15px;">
	        <p style="color: #588BAD">Editando acceso al sistema...</p>
	    </blockquote>

	    <?= $this->Form->create('Administrator', [
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
											'action' => 'editPasswordAdministrator']); ?>
	
		
		<fieldset style="margin-top: 20px; ">
		
			<div class="col-md-7 col-md-offset-2 fondoBti" >
			<div class="col-md-8 col-md-offset-2" style="margin-top: 20px; margin-bottom: 15px">
				<?= $this->Form->input('Administrator.id'); ?>
				<?= $this->Form->input('Administrator.username', ['placeholder' => 'Usuario']); ?>
				<?= $this->Form->input('Administrator.password', ['placeholder' => 'Contraseña','type'=>'password']); ?>
			    <?= $this->Form->input('Administrator.password_confirm', ['placeholder' => 'Confirmar contraseña','type'=>'password']); ?>
			</div>
			</div>

		</fieldset>
		
	<div class="col-md-3 col-md-offset-4 text-center" style="margin-top: 15px;">
		<?= $this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp; Actualizar',['type'=>'submit','class' => 'btn btn-primary','escape' => false]);?>
		<?= $this->Form->end(); ?>
	</div>	
